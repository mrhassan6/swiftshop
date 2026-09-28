/**
 * SwiftShop - Core Vanilla JavaScript Controller
 *
 * Ultra-fast, zero-jQuery ES6+ implementation for mobile navigation,
 * accessible slide-out cart drawer, and high-conversion e-commerce features.
 *
 * @package SwiftShop
 * @author  SwiftShop Core Team
 * @license GPL-2.0-or-later
 */

'use strict';

document.addEventListener('DOMContentLoaded', () => {
	// Initialize features with defensive guard checks.
	initCartDrawer();
	initFreeShippingBar();
	initStickyAddToCart();
});

/**
 * Screen Reader Accessible Live Region Announcement (WCAG 2.1 AA)
 *
 * @param {string} message Text to announce to assistive devices.
 */
function announceToScreenReader(message) {
	if (!message) return;

	let liveRegion = document.getElementById('swiftshop-a11y-status');
	if (!liveRegion) {
		liveRegion = document.createElement('div');
		liveRegion.id = 'swiftshop-a11y-status';
		liveRegion.className = 'screen-reader-text';
		liveRegion.setAttribute('role', 'status');
		liveRegion.setAttribute('aria-live', 'polite');
		document.body.appendChild(liveRegion);
	}

	liveRegion.textContent = '';
	setTimeout(() => {
		liveRegion.textContent = message;
	}, 50);
}

/**
 * Slide-out Ajax Mini-Cart Drawer Controller
 */
function initCartDrawer() {
	const drawer = document.getElementById('swiftshop-cart-drawer');
	const backdrop = document.getElementById('swiftshop-cart-backdrop');
	const triggers = document.querySelectorAll('.swiftshop-cart-trigger');
	const closeButtons = document.querySelectorAll('.swiftshop-drawer-close');

	if (!drawer || !backdrop) {
		return;
	}

	// Update dynamic cart and checkout URLs from localized data if available.
	if (typeof swiftshopData !== 'undefined') {
		const checkoutBtn = drawer.querySelector('.swiftshop-drawer-checkout-btn');
		const viewCartBtn = drawer.querySelector('.swiftshop-drawer-viewcart-btn');

		if (checkoutBtn && swiftshopData.checkoutUrl) {
			checkoutBtn.setAttribute('href', swiftshopData.checkoutUrl);
		}
		if (viewCartBtn && swiftshopData.cartUrl) {
			viewCartBtn.setAttribute('href', swiftshopData.cartUrl);
		}
	}

	let lastFocusedElement = null;

	const openDrawer = () => {
		lastFocusedElement = document.activeElement;
		drawer.removeAttribute('hidden');
		backdrop.removeAttribute('hidden');

		// Force reflow for CSS transitions.
		void drawer.offsetWidth;

		drawer.classList.add('is-open');
		backdrop.classList.add('is-active');
		document.body.style.overflow = 'hidden';

		// Update ARIA states.
		triggers.forEach((trigger) => trigger.setAttribute('aria-expanded', 'true'));

		// Focus on first focusable element inside drawer.
		const focusable = drawer.querySelectorAll('button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])');
		if (focusable.length > 0) {
			focusable[0].focus();
		}
	};

	const closeDrawer = () => {
		drawer.classList.remove('is-open');
		backdrop.classList.remove('is-active');
		document.body.style.overflow = '';

		// Update ARIA states.
		triggers.forEach((trigger) => trigger.setAttribute('aria-expanded', 'false'));

		setTimeout(() => {
			if (!drawer.classList.contains('is-open')) {
				drawer.setAttribute('hidden', '');
				backdrop.setAttribute('hidden', '');
			}
		}, 350);

		if (lastFocusedElement) {
			lastFocusedElement.focus();
		}
	};

	// Trigger click handlers.
	triggers.forEach((trigger) => {
		trigger.setAttribute('aria-expanded', 'false');
		trigger.addEventListener('click', (e) => {
			e.preventDefault();
			openDrawer();
		});
	});

	closeButtons.forEach((btn) => {
		btn.addEventListener('click', (e) => {
			e.preventDefault();
			closeDrawer();
		});
	});

	backdrop.addEventListener('click', closeDrawer);

	// Keyboard accessibility: ESC key to close and focus trap.
	document.addEventListener('keydown', (e) => {
		if (e.key === 'Escape' && drawer.classList.contains('is-open')) {
			closeDrawer();
		}

		if (e.key === 'Tab' && drawer.classList.contains('is-open')) {
			const focusable = drawer.querySelectorAll('button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])');
			if (focusable.length === 0) return;

			const first = focusable[0];
			const last = focusable[focusable.length - 1];

			if (e.shiftKey && document.activeElement === first) {
				e.preventDefault();
				last.focus();
			} else if (!e.shiftKey && document.activeElement === last) {
				e.preventDefault();
				first.focus();
			}
		}
	});

	// Native WooCommerce DOM events.
	document.body.addEventListener('added_to_cart', () => {
		openDrawer();
		updateCartData();
		if (typeof swiftshopData !== 'undefined' && swiftshopData.i18n) {
			announceToScreenReader(swiftshopData.i18n.cartUpdated);
		}
	});

	document.body.addEventListener('wc_fragments_refreshed', () => {
		updateCartData();
	});

	// Safe jQuery event bridge for third-party plugins that dispatch via jQuery.
	if (typeof window.jQuery !== 'undefined') {
		window.jQuery(document.body).on('added_to_cart', () => {
			openDrawer();
			updateCartData();
			if (typeof swiftshopData !== 'undefined' && swiftshopData.i18n) {
				announceToScreenReader(swiftshopData.i18n.cartUpdated);
			}
		});
		window.jQuery(document.body).on('wc_fragments_refreshed', () => {
			updateCartData();
		});
	}

	// Modern WooCommerce Blocks Store listener (@wordpress/data).
	if (window.wp && window.wp.data && typeof window.wp.data.subscribe === 'function') {
		let previousItemCount = -1;
		window.wp.data.subscribe(() => {
			try {
				const cartStore = window.wp.data.select('wc/store/cart');
				if (cartStore && typeof cartStore.getCartData === 'function') {
					const cartData = cartStore.getCartData();
					if (cartData && typeof cartData.total_items === 'number') {
						if (previousItemCount !== -1 && cartData.total_items > previousItemCount) {
							openDrawer();
							if (typeof swiftshopData !== 'undefined' && swiftshopData.i18n) {
								announceToScreenReader(swiftshopData.i18n.cartUpdated);
							}
						}
						previousItemCount = cartData.total_items;
					}
				}
			} catch (_) {
				// Ignore store select errors silently.
			}
		});
	}

	// Handle item deletion via dedicated AJAX endpoint or URL fallback.
	drawer.addEventListener('click', async (e) => {
		const removeLink = e.target.closest('.swiftshop-item-remove');
		if (!removeLink) return;

		e.preventDefault();
		const cartItemKey = removeLink.getAttribute('data-cart_item_key');
		const removeUrl = removeLink.getAttribute('href');

		// Provide instant visual loading indicator.
		removeLink.style.opacity = '0.5';
		removeLink.textContent = '...';

		if (cartItemKey && typeof swiftshopData !== 'undefined' && swiftshopData.ajaxUrl && swiftshopData.nonce) {
			try {
				const formData = new FormData();
				formData.append('action', 'swiftshop_remove_cart_item');
				formData.append('cart_item_key', cartItemKey);
				formData.append('nonce', swiftshopData.nonce);

				const response = await fetch(swiftshopData.ajaxUrl, {
					method: 'POST',
					body: formData,
					headers: { 'X-Requested-With': 'XMLHttpRequest' }
				});

				if (!response.ok) throw new Error('Network error on remove item');

				const result = await response.json();
				if (result.success && result.data) {
					// Apply updated fragments directly in one round trip.
					applyCartData(result.data);
					if (typeof swiftshopData.i18n !== 'undefined') {
						announceToScreenReader(swiftshopData.i18n.itemRemoved);
					}
					return;
				}
			} catch (err) {
				console.warn('Dedicated AJAX remove failed, falling back to URL fetch:', err);
			}
		}

		// Fallback to URL request if dedicated AJAX was unavailable or failed.
		if (removeUrl) {
			try {
				const response = await fetch(removeUrl, {
					headers: { 'X-Requested-With': 'XMLHttpRequest' }
				});

				if (response.ok) {
					updateCartData();
					if (typeof swiftshopData !== 'undefined' && swiftshopData.i18n) {
						announceToScreenReader(swiftshopData.i18n.itemRemoved);
					}
				} else {
					window.location.href = removeUrl;
				}
			} catch (error) {
				console.error('Failed to remove item from cart:', error);
				window.location.href = removeUrl;
			}
		}
	});
}

/**
 * Apply updated cart payload directly to DOM.
 *
 * @param {Object} data Cart payload with count, subtotal, itemsHtml, subtotalHtml.
 */
function applyCartData(data) {
	if (!data) return;

	// Update badge counts.
	const badges = document.querySelectorAll('.swiftshop-cart-badge');
	badges.forEach((badge) => {
		badge.textContent = data.count;
		badge.setAttribute('data-swiftshop-cart-count', data.count);
	});

	// Update drawer body.
	const drawerBody = document.querySelector('.swiftshop-drawer-body');
	if (drawerBody && data.itemsHtml) {
		drawerBody.innerHTML = data.itemsHtml;
	}

	// Update subtotal.
	const subtotalContainer = document.querySelector('.swiftshop-drawer-subtotal-amount');
	if (subtotalContainer && data.subtotalHtml) {
		subtotalContainer.innerHTML = data.subtotalHtml;
	}

	// Update free shipping bar calculation.
	updateFreeShippingProgress(data.subtotal);
}

/**
 * Fetch and update cart data (drawer items, subtotal, and badge count).
 */
async function updateCartData() {
	if (typeof swiftshopData === 'undefined') return;

	try {
		const formData = new FormData();
		formData.append('action', 'swiftshop_get_cart_data');
		formData.append('nonce', swiftshopData.nonce);

		const res = await fetch(swiftshopData.ajaxUrl, {
			method: 'POST',
			body: formData,
			headers: { 'X-Requested-With': 'XMLHttpRequest' }
		});

		if (!res.ok) {
			throw new Error(`HTTP error ${res.status}`);
		}

		const result = await res.json();

		if (result.success && result.data) {
			applyCartData(result.data);
		}
	} catch (err) {
		console.warn('Could not sync SwiftShop cart data:', err);
	}
}

/**
 * Free Shipping Progress Bar Controller
 */
function initFreeShippingBar() {
	if (typeof swiftshopData === 'undefined') return;
	updateFreeShippingProgress(swiftshopData.cartSubtotal || 0);
}

/**
 * Calculate and render progress bar state.
 *
 * @param {number} subtotal Current cart subtotal.
 */
function updateFreeShippingProgress(subtotal) {
	const bars = document.querySelectorAll('.swiftshop-free-shipping-bar');
	if (bars.length === 0 || typeof swiftshopData === 'undefined') return;

	// Defensive check against division by zero.
	const rawThreshold = Number(swiftshopData.freeShippingThreshold);
	const threshold = rawThreshold > 0 ? rawThreshold : 75;
	const currency = swiftshopData.currencySymbol || '$';
	const safeSubtotal = Number(subtotal) || 0;
	const percentage = Math.min(100, Math.round((safeSubtotal / threshold) * 100));

	bars.forEach((bar) => {
		const fill = bar.querySelector('.swiftshop-fs-fill');
		const msg = bar.querySelector('.swiftshop-fs-message span, .swiftshop-fs-message');

		if (fill) {
			fill.style.width = `${percentage}%`;
			if (percentage >= 100) {
				fill.classList.add('is-unlocked');
			} else {
				fill.classList.remove('is-unlocked');
			}
		}

		if (msg) {
			if (percentage >= 100) {
				msg.textContent = swiftshopData.i18n.freeShippingUnlocked;
			} else {
				const remaining = Math.max(0, threshold - safeSubtotal).toFixed(2);
				msg.textContent = swiftshopData.i18n.freeShippingRemaining.replace('%s', `${currency}${remaining}`);
			}
		}
	});
}

/**
 * Sticky Mobile "Add to Cart" Bar Controller
 */
function initStickyAddToCart() {
	const stickyBar = document.querySelector('.swiftshop-sticky-bar');
	const mainAddToCart = document.querySelector('.single_add_to_cart_button') ||
		document.querySelector('.wc-block-add-to-cart-form button[type="submit"]') ||
		document.querySelector('.wp-block-woocommerce-add-to-cart-form button');

	if (!stickyBar || !mainAddToCart) {
		return;
	}

	// Use IntersectionObserver for high-performance viewport detection.
	const observer = new IntersectionObserver((entries) => {
		entries.forEach((entry) => {
			if (!entry.isIntersecting) {
				stickyBar.classList.add('is-visible');
			} else {
				stickyBar.classList.remove('is-visible');
			}
		});
	}, {
		root: null,
		threshold: 0,
	});

	observer.observe(mainAddToCart);

	// Synchronize variation changes with sticky bar (price & image).
	if (typeof window.jQuery !== 'undefined') {
		window.jQuery(document.body).on('found_variation', 'form.variations_form', (event, variation) => {
			if (!variation) return;
			const priceContainer = stickyBar.querySelector('.swiftshop-sticky-price');
			const img = stickyBar.querySelector('.swiftshop-sticky-thumbnail');

			if (priceContainer && variation.price_html) {
				priceContainer.innerHTML = variation.price_html;
			}
			if (img && variation.image && variation.image.thumb_src) {
				img.src = variation.image.thumb_src;
			}
		});
	}

	// Wire sticky button to submit the main add to cart form or scroll to options.
	const stickyBtn = stickyBar.querySelector('.swiftshop-sticky-cta');
	if (stickyBtn) {
		stickyBtn.addEventListener('click', (e) => {
			e.preventDefault();

			// For variable products, if required attributes are not chosen, scroll to options form smoothly.
			const variationsForm = document.querySelector('form.variations_form');
			if (variationsForm) {
				const unselectedAttributes = variationsForm.querySelectorAll('select[data-attribute_name]:not([value]), select[data-attribute_name][value=""]');
				if (unselectedAttributes.length > 0) {
					variationsForm.scrollIntoView({ behavior: 'smooth', block: 'center' });
					unselectedAttributes[0].focus();
					return;
				}
			}

			// Provide brief loading state feedback on button.
			stickyBtn.style.opacity = '0.7';
			stickyBtn.textContent = '...';

			setTimeout(() => {
				stickyBtn.style.opacity = '1';
				stickyBtn.innerHTML = (typeof swiftshopData !== 'undefined' && swiftshopData.i18n && swiftshopData.i18n.closeCart)
					? 'Add to Cart &rarr;'
					: 'Add to Cart &rarr;';
			}, 1500);

			// Trigger submission on the main add-to-cart button.
			mainAddToCart.click();
		});
	}
}

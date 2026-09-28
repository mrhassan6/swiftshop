<?php
/**
 * SwiftShop Theme Functions and Definitions
 *
 * @package SwiftShop
 * @author  SwiftShop Core Team
 * @license GPL-2.0-or-later
 * @link    https://swiftshop.dev
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Prevent direct access.
}

/**
 * Define Theme Constants
 */
define( 'SWIFTSHOP_VERSION', '1.0.0' );
define( 'SWIFTSHOP_DIR', get_template_directory() );
define( 'SWIFTSHOP_URI', get_template_directory_uri() );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function swiftshop_content_width(): void {
	$GLOBALS['content_width'] = apply_filters( 'swiftshop_content_width', 1280 );
}
add_action( 'after_setup_theme', 'swiftshop_content_width', 0 );

if ( ! function_exists( 'swiftshop_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * @return void
	 */
	function swiftshop_setup(): void {
		// Make theme available for translation.
		load_theme_textdomain( 'swiftshop', SWIFTSHOP_DIR . '/languages' );

		// Core theme supports.
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'responsive-embeds' );
		add_theme_support( 'editor-styles' );
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		) );

		// Add editor style.
		add_editor_style( 'style.css' );

		// WooCommerce Theme Support with optimized gallery features.
		add_theme_support(
			'woocommerce',
			array(
				'thumbnail_image_width' => 450,
				'single_image_width'    => 800,
				'product_grid'          => array(
					'default_rows'    => 4,
					'min_rows'        => 1,
					'max_rows'        => 12,
					'default_columns' => 4,
					'min_columns'     => 2,
					'max_columns'     => 6,
				),
			)
		);
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );
	}
endif;
add_action( 'after_setup_theme', 'swiftshop_setup' );

/**
 * Register block pattern categories.
 *
 * @return void
 */
function swiftshop_register_pattern_categories(): void {
	register_block_pattern_category(
		'swiftshop-conversion',
		array(
			'label'       => esc_html__( 'SwiftShop: Conversion Boosters', 'swiftshop' ),
			'description' => esc_html__( 'High-converting e-commerce patterns like sticky add to cart and trust badges.', 'swiftshop' ),
		)
	);

	register_block_pattern_category(
		'swiftshop-ecommerce',
		array(
			'label'       => esc_html__( 'SwiftShop: E-Commerce Layouts', 'swiftshop' ),
			'description' => esc_html__( 'Product catalogs, banners, and cart drawer layouts.', 'swiftshop' ),
		)
	);
}
add_action( 'init', 'swiftshop_register_pattern_categories' );

/**
 * Register custom block styles.
 *
 * @return void
 */
function swiftshop_register_block_styles(): void {
	register_block_style(
		'core/button',
		array(
			'name'  => 'swiftshop-pill',
			'label' => esc_html__( 'Pill Button', 'swiftshop' ),
		)
	);

	register_block_style(
		'core/button',
		array(
			'name'  => 'swiftshop-outline',
			'label' => esc_html__( 'Outline Button', 'swiftshop' ),
		)
	);

	register_block_style(
		'core/group',
		array(
			'name'  => 'swiftshop-card',
			'label' => esc_html__( 'Elevated Card', 'swiftshop' ),
		)
	);
}
add_action( 'init', 'swiftshop_register_block_styles' );


/**
 * Enqueue scripts and styles.
 *
 * Zero jQuery dependencies, deferred modern vanilla JS, and Core Web Vitals optimization.
 *
 * @return void
 */
function swiftshop_enqueue_assets(): void {
	// Main theme stylesheet.
	wp_enqueue_style(
		'swiftshop-style',
		get_stylesheet_uri(),
		array(),
		SWIFTSHOP_VERSION
	);

	// WooCommerce performance stylesheet if WooCommerce is active.
	if ( class_exists( 'WooCommerce' ) ) {
		wp_enqueue_style(
			'swiftshop-woocommerce',
			SWIFTSHOP_URI . '/assets/css/woocommerce.css',
			array( 'swiftshop-style' ),
			SWIFTSHOP_VERSION
		);
	}

	// Modern Vanilla JS enqueued with defer strategy (WP 6.3+ native).
	wp_enqueue_script(
		'swiftshop-main',
		SWIFTSHOP_URI . '/assets/js/main.js',
		array(),
		SWIFTSHOP_VERSION,
		array(
			'in_footer' => true,
			'strategy'  => 'defer',
		)
	);

	// Localization payload for dynamic cart interactions and free shipping calculation.
	$free_shipping_threshold = (float) apply_filters( 'swiftshop_free_shipping_threshold', 75.0 );
	$cart_count              = 0;
	$cart_subtotal           = 0.0;

	if ( function_exists( 'WC' ) && WC()->cart ) {
		$cart_count    = WC()->cart->get_cart_contents_count();
		$cart_subtotal = (float) WC()->cart->get_subtotal();
	}

	// Enqueue comment-reply script for threaded comments if enabled.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_localize_script(
		'swiftshop-main',
		'swiftshopData',
		array(
			'ajaxUrl'               => esc_url_raw( admin_url( 'admin-ajax.php' ) ),
			'nonce'                 => wp_create_nonce( 'swiftshop_cart_nonce' ),
			'isWooCommerce'         => class_exists( 'WooCommerce' ),
			'cartUrl'               => function_exists( 'wc_get_cart_url' ) ? esc_url( wc_get_cart_url() ) : esc_url( home_url( '/cart' ) ),
			'checkoutUrl'           => function_exists( 'wc_get_checkout_url' ) ? esc_url( wc_get_checkout_url() ) : esc_url( home_url( '/checkout' ) ),
			'cartCount'             => absint( $cart_count ),
			'cartSubtotal'          => floatval( $cart_subtotal ),
			'freeShippingThreshold' => floatval( $free_shipping_threshold ),
			'currencySymbol'        => function_exists( 'get_woocommerce_currency_symbol' ) ? esc_html( get_woocommerce_currency_symbol() ) : '$',
			'i18n'                  => array(
				'freeShippingUnlocked' => esc_html__( 'Congratulations! You unlocked Free Shipping!', 'swiftshop' ),
				'freeShippingRemaining' => esc_html__( 'Add %s more to get Free Shipping!', 'swiftshop' ),
				'cartEmpty'             => esc_html__( 'Your cart is currently empty.', 'swiftshop' ),
				'closeCart'             => esc_html__( 'Close Cart', 'swiftshop' ),
				'cartUpdated'           => esc_html__( 'Cart updated.', 'swiftshop' ),
				'itemRemoved'           => esc_html__( 'Item removed from cart.', 'swiftshop' ),
			),
		)
	);
}
add_action( 'wp_enqueue_scripts', 'swiftshop_enqueue_assets' );

/**
 * Filter WooCommerce fragments for seamless, real-time AJAX cart drawer updates.
 *
 * @param array<string, string> $fragments Existing WooCommerce fragments.
 * @return array<string, string> Updated fragments.
 */
function swiftshop_cart_fragments( array $fragments ): array {
	if ( ! function_exists( 'WC' ) || ! WC()->cart ) {
		return $fragments;
	}

	$count = WC()->cart->get_cart_contents_count();

	// Badge count fragment.
	ob_start();
	?>
	<span class="swiftshop-cart-badge" data-swiftshop-cart-count="<?php echo esc_attr( (string) $count ); ?>">
		<?php echo esc_html( (string) $count ); ?>
	</span>
	<?php
	$fragments['span.swiftshop-cart-badge'] = ob_get_clean();

	// Cart Drawer Items fragment.
	ob_start();
	swiftshop_render_cart_drawer_items();
	$fragments['div.swiftshop-drawer-body-inner'] = ob_get_clean();

	// Cart Drawer Subtotal fragment.
	ob_start();
	?>
	<div class="swiftshop-drawer-subtotal-amount">
		<?php
		if ( function_exists( 'wc_cart_totals_subtotal_html' ) ) {
			wc_cart_totals_subtotal_html();
		} elseif ( WC()->cart ) {
			echo wp_kses_post( WC()->cart->get_cart_subtotal() );
		}
		?>
	</div>
	<?php
	$fragments['div.swiftshop-drawer-subtotal-amount'] = ob_get_clean();

	return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'swiftshop_cart_fragments' );

/**
 * Render dynamic Cart Drawer contents.
 *
 * @return void
 */
function swiftshop_render_cart_drawer_items(): void {
	if ( ! function_exists( 'WC' ) || ! WC()->cart ) {
		return;
	}

	$cart = WC()->cart;
	?>
	<div class="swiftshop-drawer-body-inner">
		<?php if ( $cart->is_empty() ) : ?>
			<div class="swiftshop-cart-empty-state">
				<svg class="swiftshop-empty-icon" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
					<circle cx="8" cy="21" r="1"></circle>
					<circle cx="19" cy="21" r="1"></circle>
					<path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"></path>
				</svg>
				<p class="swiftshop-cart-empty-text" style="font-weight:600;margin-bottom:0.35rem;"><?php esc_html_e( 'Your bag is currently empty', 'swiftshop' ); ?></p>
				<p style="font-size:0.875rem;color:var(--wp--preset--color--text-muted);margin-bottom:1.5rem;"><?php esc_html_e( 'Take your time exploring our hand-crafted new arrivals.', 'swiftshop' ); ?></p>
				<?php if ( function_exists( 'wc_get_page_permalink' ) ) : ?>
					<a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="wp-element-button swiftshop-shop-link" style="padding:0.65rem 1.5rem;font-size:0.875rem;text-decoration:none;">
						<?php esc_html_e( 'Discover Goods', 'swiftshop' ); ?> &rarr;
					</a>
				<?php endif; ?>
			</div>
		<?php else : ?>
			<ul class="swiftshop-drawer-items-list" role="list">
				<?php
				foreach ( $cart->get_cart() as $cart_item_key => $cart_item ) :
					$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
					$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

					if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) :
						$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
						?>
						<li class="swiftshop-drawer-item" data-cart-item-key="<?php echo esc_attr( $cart_item_key ); ?>">
							<div class="swiftshop-item-image">
								<?php
								$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image( 'woocommerce_thumbnail' ), $cart_item, $cart_item_key );
								if ( ! $product_permalink ) {
									echo wp_kses_post( $thumbnail );
								} else {
									printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), wp_kses_post( $thumbnail ) );
								}
								?>
							</div>
							<div class="swiftshop-item-details">
								<h4 class="swiftshop-item-title">
									<?php
									if ( ! $product_permalink ) {
										echo esc_html( $_product->get_name() );
									} else {
										echo wp_kses_post( sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), esc_html( $_product->get_name() ) ) );
									}
									?>
								</h4>
								<div class="swiftshop-item-meta">
									<span class="swiftshop-item-qty"><?php echo esc_html( sprintf( '%s ×', $cart_item['quantity'] ) ); ?></span>
									<span class="swiftshop-item-price"><?php echo wp_kses_post( $cart->get_product_price( $_product ) ); ?></span>
								</div>
								<?php
								echo wp_kses_post(
									apply_filters(
										'woocommerce_cart_item_remove_link',
										sprintf(
											'<a href="%s" class="swiftshop-item-remove" aria-label="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s">&times; %s</a>',
											esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
											/* translators: %s is product name */
											esc_attr( sprintf( __( 'Remove %s from cart', 'swiftshop' ), wp_strip_all_tags( $_product->get_name() ) ) ),
											esc_attr( (string) $product_id ),
											esc_attr( $cart_item_key ),
											esc_attr( $_product->get_sku() ),
											esc_html__( 'Remove', 'swiftshop' )
										),
										$cart_item_key
									)
								);
								?>
							</div>
						</li>
					<?php endif; ?>
				<?php endforeach; ?>
			</ul>
		<?php endif; ?>
	</div>
	<?php
}

/**
 * Secure AJAX endpoint to fetch updated cart data and items markup.
 *
 * @return void
 */
function swiftshop_ajax_get_cart_data(): void {
	// Verify nonce for security.
	if ( ! check_ajax_referer( 'swiftshop_cart_nonce', 'nonce', false ) ) {
		wp_send_json_error( array( 'message' => esc_html__( 'Security check failed.', 'swiftshop' ) ), 403 );
	}

	if ( ! function_exists( 'WC' ) || ! WC()->cart ) {
		wp_send_json_error( array( 'message' => esc_html__( 'WooCommerce is not active.', 'swiftshop' ) ), 400 );
	}

	ob_start();
	swiftshop_render_cart_drawer_items();
	$items_html = ob_get_clean();

	ob_start();
	if ( function_exists( 'wc_cart_totals_subtotal_html' ) ) {
		wc_cart_totals_subtotal_html();
	} elseif ( WC()->cart ) {
		echo wp_kses_post( WC()->cart->get_cart_subtotal() );
	}
	$subtotal_html = ob_get_clean();

	wp_send_json_success(
		array(
			'count'        => absint( WC()->cart->get_cart_contents_count() ),
			'subtotal'     => floatval( WC()->cart->get_subtotal() ),
			'subtotalHtml' => wp_kses_post( $subtotal_html ),
			'itemsHtml'    => $items_html,
		)
	);
}
add_action( 'wp_ajax_swiftshop_get_cart_data', 'swiftshop_ajax_get_cart_data' );
add_action( 'wp_ajax_nopriv_swiftshop_get_cart_data', 'swiftshop_ajax_get_cart_data' );

/**
 * Dedicated AJAX endpoint for removing an item from the cart.
 *
 * @return void
 */
function swiftshop_ajax_remove_cart_item(): void {
	// Verify nonce for security.
	if ( ! check_ajax_referer( 'swiftshop_cart_nonce', 'nonce', false ) ) {
		wp_send_json_error( array( 'message' => esc_html__( 'Security check failed.', 'swiftshop' ) ), 403 );
	}

	if ( ! function_exists( 'WC' ) || ! WC()->cart ) {
		wp_send_json_error( array( 'message' => esc_html__( 'WooCommerce is not active.', 'swiftshop' ) ), 400 );
	}

	$cart_item_key = sanitize_text_field( wp_unslash( $_POST['cart_item_key'] ?? '' ) );

	if ( empty( $cart_item_key ) || ! WC()->cart->get_cart_item( $cart_item_key ) ) {
		wp_send_json_error( array( 'message' => esc_html__( 'Item not found in cart.', 'swiftshop' ) ), 404 );
	}

	$removed = WC()->cart->remove_cart_item( $cart_item_key );

	if ( ! $removed ) {
		wp_send_json_error( array( 'message' => esc_html__( 'Could not remove item from cart.', 'swiftshop' ) ), 500 );
	}

	ob_start();
	swiftshop_render_cart_drawer_items();
	$items_html = ob_get_clean();

	ob_start();
	if ( function_exists( 'wc_cart_totals_subtotal_html' ) ) {
		wc_cart_totals_subtotal_html();
	} elseif ( WC()->cart ) {
		echo wp_kses_post( WC()->cart->get_cart_subtotal() );
	}
	$subtotal_html = ob_get_clean();

	wp_send_json_success(
		array(
			'count'        => absint( WC()->cart->get_cart_contents_count() ),
			'subtotal'     => floatval( WC()->cart->get_subtotal() ),
			'subtotalHtml' => wp_kses_post( $subtotal_html ),
			'itemsHtml'    => $items_html,
			'message'      => esc_html__( 'Item removed from cart.', 'swiftshop' ),
		)
	);
}
add_action( 'wp_ajax_swiftshop_remove_cart_item', 'swiftshop_ajax_remove_cart_item' );
add_action( 'wp_ajax_nopriv_swiftshop_remove_cart_item', 'swiftshop_ajax_remove_cart_item' );

/**
 * Include Freemius Integration Wrapper safely.
 */
require_once SWIFTSHOP_DIR . '/inc/freemius.php';

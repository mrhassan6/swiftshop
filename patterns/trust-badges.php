<?php
/**
 * Title: Trust Badges & Secure Checkout Strip
 * Slug: swiftshop/trust-badges
 * Categories: swiftshop-conversion
 * Description: High-conversion reassurance strip featuring security, shipping, and guarantee trust badges.
 * Inserter: true
 *
 * @package SwiftShop
 * @license GPL-2.0-or-later
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!-- wp:html -->
<div class="swiftshop-trust-badges" role="region" aria-label="<?php esc_attr_e( 'Customer Guarantees and Trust Badges', 'swiftshop' ); ?>">
	<div class="swiftshop-badge-item">
		<div class="swiftshop-badge-icon" aria-hidden="true">
			<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
				<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
			</svg>
		</div>
		<div class="swiftshop-badge-text">
			<h5><?php esc_html_e( 'Ethically Sourced', 'swiftshop' ); ?></h5>
			<p><?php esc_html_e( 'Consciously made by artisans', 'swiftshop' ); ?></p>
		</div>
	</div>

	<div class="swiftshop-badge-item">
		<div class="swiftshop-badge-icon" aria-hidden="true">
			<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
				<rect x="1" y="3" width="15" height="13"></rect>
				<polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon>
				<circle cx="5.5" cy="18.5" r="2.5"></circle>
				<circle cx="18.5" cy="18.5" r="2.5"></circle>
			</svg>
		</div>
		<div class="swiftshop-badge-text">
			<h5><?php esc_html_e( 'Carbon-Neutral Delivery', 'swiftshop' ); ?></h5>
			<p><?php esc_html_e( 'Free on orders over $75', 'swiftshop' ); ?></p>
		</div>
	</div>

	<div class="swiftshop-badge-item">
		<div class="swiftshop-badge-icon" aria-hidden="true">
			<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
				<polyline points="23 4 23 10 17 10"></polyline>
				<path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"></path>
			</svg>
		</div>
		<div class="swiftshop-badge-text">
			<h5><?php esc_html_e( '30-Day Happiness Guarantee', 'swiftshop' ); ?></h5>
			<p><?php esc_html_e( 'Effortless, friendly returns', 'swiftshop' ); ?></p>
		</div>
	</div>

	<div class="swiftshop-badge-item">
		<div class="swiftshop-badge-icon" aria-hidden="true">
			<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
				<path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
			</svg>
		</div>
		<div class="swiftshop-badge-text">
			<h5><?php esc_html_e( 'Real Human Support', 'swiftshop' ); ?></h5>
			<p><?php esc_html_e( 'Friendly help around the clock', 'swiftshop' ); ?></p>
		</div>
	</div>
</div>
<!-- /wp:html -->

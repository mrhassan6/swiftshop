<?php
/**
 * Title: Free Shipping Progress Bar
 * Slug: swiftshop/free-shipping-progress
 * Categories: swiftshop-conversion
 * Description: Interactive animated free shipping progress bar calculating real-time remaining threshold.
 * Inserter: true
 *
 * @package SwiftShop
 * @license GPL-2.0-or-later
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$threshold = (float) apply_filters( 'swiftshop_free_shipping_threshold', 75.0 );
if ( $threshold <= 0.0 ) {
	$threshold = 75.0;
}
$subtotal  = 0.0;

if ( function_exists( 'WC' ) && WC()->cart ) {
	$subtotal = (float) WC()->cart->get_subtotal();
}

$remaining  = max( 0.0, $threshold - $subtotal );
$percent    = min( 100, (int) round( ( $subtotal / $threshold ) * 100 ) );
$currency   = function_exists( 'get_woocommerce_currency_symbol' ) ? get_woocommerce_currency_symbol() : '$';
$is_unlocked = ( $percent >= 100 );
?>
<!-- wp:html -->
<div class="swiftshop-free-shipping-bar" role="region" aria-label="<?php esc_attr_e( 'Free Shipping Promotion', 'swiftshop' ); ?>">
	<div class="swiftshop-fs-message">
		<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
			<rect x="1" y="3" width="15" height="13"></rect>
			<polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon>
			<circle cx="5.5" cy="18.5" r="2.5"></circle>
			<circle cx="18.5" cy="18.5" r="2.5"></circle>
		</svg>
		<span>
			<?php if ( $is_unlocked ) : ?>
				<?php esc_html_e( 'Congratulations! You unlocked Free Shipping!', 'swiftshop' ); ?>
			<?php else : ?>
				<?php
				/* translators: %s: formatted price remaining */
				printf( esc_html__( 'Add %s more to get Free Shipping!', 'swiftshop' ), esc_html( $currency . number_format( $remaining, 2 ) ) );
				?>
			<?php endif; ?>
		</span>
	</div>
	<div class="swiftshop-fs-track">
		<div class="swiftshop-fs-fill <?php echo $is_unlocked ? 'is-unlocked' : ''; ?>" style="width: <?php echo esc_attr( (string) $percent ); ?>%;"></div>
	</div>
</div>
<!-- /wp:html -->

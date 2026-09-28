<?php
/**
 * Title: Sticky Mobile Add to Cart Bar
 * Slug: swiftshop/sticky-add-to-cart
 * Categories: swiftshop-conversion
 * Description: High-converting sticky bottom bar for mobile screens that appears when the main buy button scrolls out of view.
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
<div class="swiftshop-sticky-bar" id="swiftshop-sticky-bar" role="complementary" aria-label="<?php esc_attr_e( 'Quick Purchase Bar', 'swiftshop' ); ?>">
	<div class="swiftshop-sticky-product-info">
		<?php
		global $product;
		$thumbnail_url = '';
		$product_title = '';
		$product_price = '';

		if ( is_a( $product, 'WC_Product' ) ) {
			$image_id      = $product->get_image_id();
			$thumbnail_url = $image_id ? wp_get_attachment_image_url( $image_id, 'thumbnail' ) : ( function_exists( 'wc_placeholder_img_src' ) ? wc_placeholder_img_src() : '' );
			$product_title = $product->get_name();
			$product_price = $product->get_price_html();
		} else {
			$thumbnail_url = function_exists( 'wc_placeholder_img_src' ) ? wc_placeholder_img_src() : '';
			$product_title = get_the_title() ? get_the_title() : esc_html__( 'Product Name', 'swiftshop' );
			$product_price = '<span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">$</span>49.00</bdi></span>';
		}
		?>
		<?php if ( ! empty( $thumbnail_url ) ) : ?>
			<img src="<?php echo esc_url( $thumbnail_url ); ?>" alt="<?php echo esc_attr( $product_title ); ?>" class="swiftshop-sticky-thumbnail" width="44" height="44" loading="lazy" />
		<?php endif; ?>
		<div>
			<h4 class="swiftshop-sticky-title"><?php echo esc_html( $product_title ); ?></h4>
			<p class="swiftshop-sticky-price"><?php echo wp_kses_post( $product_price ); ?></p>
		</div>
	</div>
	<button type="button" class="swiftshop-sticky-cta">
		<?php esc_html_e( 'Add to Cart', 'swiftshop' ); ?> &rarr;
	</button>
</div>
<!-- /wp:html -->

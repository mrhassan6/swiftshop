<?php
/**
 * Title: Featured Product Categories Grid
 * Slug: swiftshop/featured-categories
 * Categories: swiftshop-ecommerce
 * Description: 4-column visual category navigation cards for quick catalog exploration.
 * Inserter: true
 *
 * @package SwiftShop
 * @license GPL-2.0-or-later
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$shop_url = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/shop' );
?>
<!-- wp:group {"align":"wide","style":{"spacing":{"margin":{"top":"3.5rem","bottom":"3.5rem"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide" style="margin-top:3.5rem;margin-bottom:3.5rem">
	<!-- wp:group {"layout":{"type":"flex","justifyContent":"space-between","verticalAlignment":"center"},"style":{"spacing":{"margin":{"bottom":"2rem"}}}} -->
	<div class="wp-block-group" style="margin-bottom:2rem">
		<div>
			<!-- wp:heading {"level":2,"style":{"typography":{"fontSize":"1.875rem","fontWeight":"800"}}} -->
			<h2 class="wp-block-heading" style="font-size:1.875rem;font-weight:800"><?php esc_html_e( 'Curated Collections', 'swiftshop' ); ?></h2>
			<!-- /wp:heading -->
			<!-- wp:paragraph {"style":{"typography":{"fontSize":"0.925rem"},"color":{"text":"var:preset|color|text-muted"}}} -->
			<p class="has-text-muted-color has-text-color" style="font-size:0.925rem"><?php esc_html_e( 'Explore essentials crafted with intentional design and everyday comfort in mind.', 'swiftshop' ); ?></p>
			<!-- /wp:paragraph -->
		</div>

		<!-- wp:paragraph {"style":{"typography":{"fontSize":"0.875rem","fontWeight":"600"}}} -->
		<p style="font-size:0.875rem;font-weight:600"><a href="<?php echo esc_url( $shop_url ); ?>" style="text-decoration:none"><?php esc_html_e( 'View All Categories', 'swiftshop' ); ?> &rarr;</a></p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->

	<!-- wp:columns {"style":{"spacing":{"blockGap":{"top":"1.25rem","left":"1.25rem"}}}} -->
	<div class="wp-block-columns">
		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:group {"className":"is-style-swiftshop-card","style":{"spacing":{"padding":{"top":"2rem","bottom":"2rem","left":"1.5rem","right":"1.5rem"}},"border":{"radius":"12px","width":"1px","color":"var:preset|color|border"}},"backgroundColor":"surface"} -->
			<div class="wp-block-group is-style-swiftshop-card has-border-color has-surface-background-color has-background" style="border-color:var(--wp--preset--color--border);border-width:1px;border-radius:12px;padding-top:2rem;padding-right:1.5rem;padding-bottom:2rem;padding-left:1.5rem;text-align:center">
				<!-- wp:paragraph {"style":{"typography":{"fontSize":"2rem"},"spacing":{"margin":{"bottom":"0.5rem"}}}} -->
				<p style="font-size:2rem;margin-bottom:0.5rem">👔</p>
				<!-- /wp:paragraph -->
				<!-- wp:heading {"level":3,"style":{"typography":{"fontSize":"1.15rem","fontWeight":"700"},"spacing":{"margin":{"bottom":"0.25rem"}}}} -->
				<h3 class="wp-block-heading" style="font-size:1.15rem;font-weight:700;margin-bottom:0.25rem"><?php esc_html_e( 'Apparel', 'swiftshop' ); ?></h3>
				<!-- /wp:heading -->
				<!-- wp:paragraph {"style":{"typography":{"fontSize":"0.8125rem"},"color":{"text":"var:preset|color|text-muted"},"spacing":{"margin":{"bottom":"1.25rem"}}}} -->
				<p class="has-text-muted-color has-text-color" style="font-size:0.8125rem;margin-bottom:1.25rem"><?php esc_html_e( 'Organic tees & chore jackets', 'swiftshop' ); ?></p>
				<!-- /wp:paragraph -->
				<!-- wp:paragraph {"style":{"typography":{"fontSize":"0.8125rem"}}} -->
				<p style="font-size:0.8125rem"><a href="<?php echo esc_url( home_url( '/product-category/apparel' ) ); ?>" class="wp-element-button" style="padding:0.55rem 1.25rem;font-size:0.8125rem"><?php esc_html_e( 'Explore', 'swiftshop' ); ?> &rarr;</a></p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:group {"className":"is-style-swiftshop-card","style":{"spacing":{"padding":{"top":"2rem","bottom":"2rem","left":"1.5rem","right":"1.5rem"}},"border":{"radius":"12px","width":"1px","color":"var:preset|color|border"}},"backgroundColor":"surface"} -->
			<div class="wp-block-group is-style-swiftshop-card has-border-color has-surface-background-color has-background" style="border-color:var(--wp--preset--color--border);border-width:1px;border-radius:12px;padding-top:2rem;padding-right:1.5rem;padding-bottom:2rem;padding-left:1.5rem;text-align:center">
				<!-- wp:paragraph {"style":{"typography":{"fontSize":"2rem"},"spacing":{"margin":{"bottom":"0.5rem"}}}} -->
				<p style="font-size:2rem;margin-bottom:0.5rem">👟</p>
				<!-- /wp:paragraph -->
				<!-- wp:heading {"level":3,"style":{"typography":{"fontSize":"1.15rem","fontWeight":"700"},"spacing":{"margin":{"bottom":"0.25rem"}}}} -->
				<h3 class="wp-block-heading" style="font-size:1.15rem;font-weight:700;margin-bottom:0.25rem"><?php esc_html_e( 'Footwear', 'swiftshop' ); ?></h3>
				<!-- /wp:heading -->
				<!-- wp:paragraph {"style":{"typography":{"fontSize":"0.8125rem"},"color":{"text":"var:preset|color|text-muted"},"spacing":{"margin":{"bottom":"1.25rem"}}}} -->
				<p class="has-text-muted-color has-text-color" style="font-size:0.8125rem;margin-bottom:1.25rem"><?php esc_html_e( 'Leather sneakers & boots', 'swiftshop' ); ?></p>
				<!-- /wp:paragraph -->
				<!-- wp:paragraph {"style":{"typography":{"fontSize":"0.8125rem"}}} -->
				<p style="font-size:0.8125rem"><a href="<?php echo esc_url( home_url( '/product-category/footwear' ) ); ?>" class="wp-element-button" style="padding:0.55rem 1.25rem;font-size:0.8125rem"><?php esc_html_e( 'Explore', 'swiftshop' ); ?> &rarr;</a></p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:group {"className":"is-style-swiftshop-card","style":{"spacing":{"padding":{"top":"2rem","bottom":"2rem","left":"1.5rem","right":"1.5rem"}},"border":{"radius":"12px","width":"1px","color":"var:preset|color|border"}},"backgroundColor":"surface"} -->
			<div class="wp-block-group is-style-swiftshop-card has-border-color has-surface-background-color has-background" style="border-color:var(--wp--preset--color--border);border-width:1px;border-radius:12px;padding-top:2rem;padding-right:1.5rem;padding-bottom:2rem;padding-left:1.5rem;text-align:center">
				<!-- wp:paragraph {"style":{"typography":{"fontSize":"2rem"},"spacing":{"margin":{"bottom":"0.5rem"}}}} -->
				<p style="font-size:2rem;margin-bottom:0.5rem">🎒</p>
				<!-- /wp:paragraph -->
				<!-- wp:heading {"level":3,"style":{"typography":{"fontSize":"1.15rem","fontWeight":"700"},"spacing":{"margin":{"bottom":"0.25rem"}}}} -->
				<h3 class="wp-block-heading" style="font-size:1.15rem;font-weight:700;margin-bottom:0.25rem"><?php esc_html_e( 'Accessories', 'swiftshop' ); ?></h3>
				<!-- /wp:heading -->
				<!-- wp:paragraph {"style":{"typography":{"fontSize":"0.8125rem"},"color":{"text":"var:preset|color|text-muted"},"spacing":{"margin":{"bottom":"1.25rem"}}}} -->
				<p class="has-text-muted-color has-text-color" style="font-size:0.8125rem;margin-bottom:1.25rem"><?php esc_html_e( 'Canvas totes & wallets', 'swiftshop' ); ?></p>
				<!-- /wp:paragraph -->
				<!-- wp:paragraph {"style":{"typography":{"fontSize":"0.8125rem"}}} -->
				<p style="font-size:0.8125rem"><a href="<?php echo esc_url( home_url( '/product-category/accessories' ) ); ?>" class="wp-element-button" style="padding:0.55rem 1.25rem;font-size:0.8125rem"><?php esc_html_e( 'Explore', 'swiftshop' ); ?> &rarr;</a></p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:group {"className":"is-style-swiftshop-card","style":{"spacing":{"padding":{"top":"2rem","bottom":"2rem","left":"1.5rem","right":"1.5rem"}},"border":{"radius":"12px","width":"1px","color":"var:preset|color|border"}},"backgroundColor":"surface"} -->
			<div class="wp-block-group is-style-swiftshop-card has-border-color has-surface-background-color has-background" style="border-color:var(--wp--preset--color--border);border-width:1px;border-radius:12px;padding-top:2rem;padding-right:1.5rem;padding-bottom:2rem;padding-left:1.5rem;text-align:center">
				<!-- wp:paragraph {"style":{"typography":{"fontSize":"2rem"},"spacing":{"margin":{"bottom":"0.5rem"}}}} -->
				<p style="font-size:2rem;margin-bottom:0.5rem">🌿</p>
				<!-- /wp:paragraph -->
				<!-- wp:heading {"level":3,"style":{"typography":{"fontSize":"1.15rem","fontWeight":"700"},"spacing":{"margin":{"bottom":"0.25rem"}}}} -->
				<h3 class="wp-block-heading" style="font-size:1.15rem;font-weight:700;margin-bottom:0.25rem"><?php esc_html_e( 'Home Goods', 'swiftshop' ); ?></h3>
				<!-- /wp:heading -->
				<!-- wp:paragraph {"style":{"typography":{"fontSize":"0.8125rem"},"color":{"text":"var:preset|color|text-muted"},"spacing":{"margin":{"bottom":"1.25rem"}}}} -->
				<p class="has-text-muted-color has-text-color" style="font-size:0.8125rem;margin-bottom:1.25rem"><?php esc_html_e( 'Ceramics & linen throws', 'swiftshop' ); ?></p>
				<!-- /wp:paragraph -->
				<!-- wp:paragraph {"style":{"typography":{"fontSize":"0.8125rem"}}} -->
				<p style="font-size:0.8125rem"><a href="<?php echo esc_url( add_query_arg( 'on_sale', '1', $shop_url ) ); ?>" class="wp-element-button" style="padding:0.55rem 1.25rem;font-size:0.8125rem"><?php esc_html_e( 'Explore', 'swiftshop' ); ?> &rarr;</a></p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</div>
<!-- /wp:group -->

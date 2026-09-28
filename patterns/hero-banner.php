<?php
/**
 * Title: E-Commerce Hero Banner
 * Slug: swiftshop/hero-banner
 * Categories: swiftshop-ecommerce
 * Description: Bold, high-conversion homepage hero banner with promotional callouts and action buttons.
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
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"clamp(2.5rem, 6vw, 5rem)","bottom":"clamp(2.5rem, 6vw, 5rem)","left":"clamp(1rem, 3vw, 2.5rem)","right":"clamp(1rem, 3vw, 2.5rem)"},"margin":{"top":"0px","bottom":"2rem"}}},"backgroundColor":"surface","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-surface-background-color has-background" style="margin-top:0px;margin-bottom:2rem;padding-top:clamp(2.5rem, 6vw, 5rem);padding-right:clamp(1rem, 3vw, 2.5rem);padding-bottom:clamp(2.5rem, 6vw, 5rem);padding-left:clamp(1rem, 3vw, 2.5rem)">
	<!-- wp:columns {"align":"wide","verticalAlignment":"center","style":{"spacing":{"blockGap":{"top":"2rem","left":"3rem"}}}} -->
	<div class="wp-block-columns alignwide are-vertically-aligned-center">
		<!-- wp:column {"verticalAlignment":"center","width":"55%"} -->
		<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:55%">
			<!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap"},"style":{"spacing":{"margin":{"bottom":"1rem"}}}} -->
			<div class="wp-block-group" style="margin-bottom:1rem">
				<!-- wp:paragraph {"style":{"typography":{"fontSize":"0.75rem","fontWeight":"700","textTransform":"uppercase","letterSpacing":"0.08em"},"color":{"background":"var:preset|color|highlight","text":"var:preset|color|primary"},"spacing":{"padding":{"top":"0.35rem","bottom":"0.35rem","left":"0.75rem","right":"0.75rem"}},"border":{"radius":"9999px"}}} -->
				<p class="has-primary-color has-highlight-background-color has-text-color has-background" style="border-radius:9999px;padding-top:0.35rem;padding-right:0.75rem;padding-bottom:0.35rem;padding-left:0.75rem;font-size:0.75rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase"><?php esc_html_e( '✨ New Season Arrivals', 'swiftshop' ); ?></p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->

			<!-- wp:heading {"level":1,"style":{"typography":{"fontSize":"clamp(2.25rem, 5vw, 3.5rem)","fontWeight":"800","lineHeight":"1.15"},"spacing":{"margin":{"bottom":"1.25rem"}}}} -->
			<h1 class="wp-block-heading" style="font-size:clamp(2.25rem, 5vw, 3.5rem);font-weight:800;line-height:1.15;margin-bottom:1.25rem"><?php esc_html_e( 'Mindful Design for Everyday Living.', 'swiftshop' ); ?></h1>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"style":{"typography":{"fontSize":"1.125rem","lineHeight":"1.7"},"color":{"text":"var:preset|color|text-muted"},"spacing":{"margin":{"bottom":"2rem"}}}} -->
			<p class="has-text-muted-color has-text-color" style="font-size:1.125rem;line-height:1.7;margin-bottom:2rem"><?php esc_html_e( 'Thoughtfully crafted goods designed with enduring craftsmanship, natural materials, and carbon-neutral worldwide shipping.', 'swiftshop' ); ?></p>
			<!-- /wp:paragraph -->

			<!-- wp:buttons {"style":{"spacing":{"blockGap":"1rem"}}} -->
			<div class="wp-block-buttons">
				<!-- wp:button {"backgroundColor":"primary","style":{"typography":{"fontWeight":"700"},"border":{"radius":"8px"}}} -->
				<div class="wp-block-button"><a class="wp-block-button__link has-primary-background-color has-background wp-element-button" href="<?php echo esc_url( $shop_url ); ?>" style="border-radius:8px;font-weight:700"><?php esc_html_e( 'Explore Collection', 'swiftshop' ); ?> &rarr;</a></div>
				<!-- /wp:button -->

				<!-- wp:button {"backgroundColor":"base","textColor":"contrast","style":{"typography":{"fontWeight":"600"},"border":{"radius":"8px","width":"1px","color":"var:preset|color|border"}}} -->
				<div class="wp-block-button"><a class="wp-block-button__link has-contrast-color has-base-background-color has-text-color has-background wp-element-button" href="<?php echo esc_url( add_query_arg( 'on_sale', '1', $shop_url ) ); ?>" style="border-radius:8px;border-width:1px;border-color:var(--wp--preset--color--border);font-weight:600"><?php esc_html_e( 'View Seasonal Deals', 'swiftshop' ); ?></a></div>
				<!-- /wp:button -->
			</div>
			<!-- /wp:buttons -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column {"verticalAlignment":"center","width":"45%"} -->
		<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:45%">
			<!-- wp:group {"style":{"border":{"radius":"16px"},"spacing":{"padding":{"top":"0px","bottom":"0px","left":"0px","right":"0px"}}},"backgroundColor":"base"} -->
			<div class="wp-block-group has-base-background-color has-background" style="border-radius:16px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px;overflow:hidden;box-shadow:0 20px 35px -10px rgba(0,0,0,0.06);border:1px solid var(--wp--preset--color--border)">
				<!-- wp:image {"aspectRatio":"4/3","scale":"cover","sizeSlug":"large","style":{"border":{"radius":"16px"}}} -->
				<figure class="wp-block-image size-large"><img src="<?php echo esc_url( get_template_directory_uri() . '/screenshot.png' ); ?>" alt="<?php esc_attr_e( 'SwiftShop Featured Collection', 'swiftshop' ); ?>" style="aspect-ratio:4/3;object-fit:cover;border-radius:16px"/></figure>
				<!-- /wp:image -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</div>
<!-- /wp:group -->

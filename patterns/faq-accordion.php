<?php
/**
 * Title: E-Commerce Store FAQ Section
 * Slug: swiftshop/faq-accordion
 * Categories: swiftshop-ecommerce
 * Description: Accessible accordion-style questions and answers addressing customer objections.
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
<!-- wp:group {"align":"wide","style":{"spacing":{"margin":{"top":"4rem","bottom":"4rem"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide" style="margin-top:4rem;margin-bottom:4rem">
	<!-- wp:heading {"textAlign":"center","level":2,"style":{"typography":{"fontSize":"2rem","fontWeight":"800"},"spacing":{"margin":{"bottom":"0.5rem"}}}} -->
	<h2 class="wp-block-heading has-text-align-center" style="font-size:2rem;font-weight:800;margin-bottom:0.5rem"><?php esc_html_e( 'Frequently Asked Questions', 'swiftshop' ); ?></h2>
	<!-- /wp:heading -->

	<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"1rem"},"color":{"text":"var:preset|color|text-muted"},"spacing":{"margin":{"bottom":"2.5rem"}}}} -->
	<p class="has-text-align-center has-text-muted-color has-text-color" style="font-size:1rem;margin-bottom:2.5rem"><?php esc_html_e( 'Everything you need to know about our products, shipping, and guarantees.', 'swiftshop' ); ?></p>
	<!-- /wp:paragraph -->

	<!-- wp:columns {"style":{"spacing":{"blockGap":{"top":"1.5rem","left":"2rem"}}}} -->
	<div class="wp-block-columns">
		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:details {"style":{"spacing":{"padding":{"top":"1.25rem","bottom":"1.25rem","left":"1.25rem","right":"1.25rem"}},"border":{"radius":"8px","width":"1px","color":"var:preset|color|border"}}} -->
			<details class="wp-block-details has-border-color" style="border-color:var(--wp--preset--color--border);border-width:1px;border-radius:8px;padding-top:1.25rem;padding-right:1.25rem;padding-bottom:1.25rem;padding-left:1.25rem"><summary><strong><?php esc_html_e( 'How fast is express delivery?', 'swiftshop' ); ?></strong></summary>
				<!-- wp:paragraph {"style":{"typography":{"fontSize":"0.925rem"},"color":{"text":"var:preset|color|text-muted"}}} -->
				<p class="has-text-muted-color has-text-color" style="font-size:0.925rem"><?php esc_html_e( 'Orders are dispatched within 24 hours. Domestic express orders typically arrive within 2-3 business days with real-time tracking provided.', 'swiftshop' ); ?></p>
				<!-- /wp:paragraph -->
			</details>
			<!-- /wp:details -->

			<!-- wp:details {"style":{"spacing":{"padding":{"top":"1.25rem","bottom":"1.25rem","left":"1.25rem","right":"1.25rem"},"margin":{"top":"1rem"}},"border":{"radius":"8px","width":"1px","color":"var:preset|color|border"}}} -->
			<details class="wp-block-details has-border-color" style="border-color:var(--wp--preset--color--border);border-width:1px;border-radius:8px;margin-top:1rem;padding-top:1.25rem;padding-right:1.25rem;padding-bottom:1.25rem;padding-left:1.25rem"><summary><strong><?php esc_html_e( 'What is your return policy?', 'swiftshop' ); ?></strong></summary>
				<!-- wp:paragraph {"style":{"typography":{"fontSize":"0.925rem"},"color":{"text":"var:preset|color|text-muted"}}} -->
				<p class="has-text-muted-color has-text-color" style="font-size:0.925rem"><?php esc_html_e( 'We offer a 30-day money-back guarantee. If you are not 100% satisfied with your item, you can return it hassle-free for a full refund.', 'swiftshop' ); ?></p>
				<!-- /wp:paragraph -->
			</details>
			<!-- /wp:details -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:details {"style":{"spacing":{"padding":{"top":"1.25rem","bottom":"1.25rem","left":"1.25rem","right":"1.25rem"}},"border":{"radius":"8px","width":"1px","color":"var:preset|color|border"}}} -->
			<details class="wp-block-details has-border-color" style="border-color:var(--wp--preset--color--border);border-width:1px;border-radius:8px;padding-top:1.25rem;padding-right:1.25rem;padding-bottom:1.25rem;padding-left:1.25rem"><summary><strong><?php esc_html_e( 'Are transactions secure?', 'swiftshop' ); ?></strong></summary>
				<!-- wp:paragraph {"style":{"typography":{"fontSize":"0.925rem"},"color":{"text":"var:preset|color|text-muted"}}} -->
				<p class="has-text-muted-color has-text-color" style="font-size:0.925rem"><?php esc_html_e( 'Yes. All payments are encrypted using 256-bit bank-grade SSL security. We never store credit card numbers on our servers.', 'swiftshop' ); ?></p>
				<!-- /wp:paragraph -->
			</details>
			<!-- /wp:details -->

			<!-- wp:details {"style":{"spacing":{"padding":{"top":"1.25rem","bottom":"1.25rem","left":"1.25rem","right":"1.25rem"},"margin":{"top":"1rem"}},"border":{"radius":"8px","width":"1px","color":"var:preset|color|border"}}} -->
			<details class="wp-block-details has-border-color" style="border-color:var(--wp--preset--color--border);border-width:1px;border-radius:8px;margin-top:1rem;padding-top:1.25rem;padding-right:1.25rem;padding-bottom:1.25rem;padding-left:1.25rem"><summary><strong><?php esc_html_e( 'How do I qualify for Free Shipping?', 'swiftshop' ); ?></strong></summary>
				<!-- wp:paragraph {"style":{"typography":{"fontSize":"0.925rem"},"color":{"text":"var:preset|color|text-muted"}}} -->
				<p class="has-text-muted-color has-text-color" style="font-size:0.925rem"><?php esc_html_e( 'Free standard shipping is automatically applied at checkout once your cart total reaches $75 or more. Track your progress via the live cart bar.', 'swiftshop' ); ?></p>
				<!-- /wp:paragraph -->
			</details>
			<!-- /wp:details -->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</div>
<!-- /wp:group -->

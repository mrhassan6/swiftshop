<?php
/**
 * Title: Conversion Newsletter & Promo Strip
 * Slug: swiftshop/newsletter-signup
 * Categories: swiftshop-conversion
 * Description: High-converting lead capture banner offering exclusive discounts and perks.
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
<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"3.5rem","bottom":"3.5rem","left":"clamp(1.5rem, 5vw, 3.5rem)","right":"clamp(1.5rem, 5vw, 3.5rem)"},"margin":{"top":"4rem","bottom":"2rem"}},"border":{"radius":"16px","width":"1px","color":"var:preset|color|border"}},"backgroundColor":"surface","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide has-border-color has-surface-background-color has-background" style="border-color:var(--wp--preset--color--border);border-width:1px;border-radius:16px;margin-top:4rem;margin-bottom:2rem;padding-top:3.5rem;padding-right:clamp(1.5rem, 5vw, 3.5rem);padding-bottom:3.5rem;padding-left:clamp(1.5rem, 5vw, 3.5rem);box-shadow:0 10px 30px -10px rgba(0,0,0,0.04)">
	<!-- wp:columns {"verticalAlignment":"center","style":{"spacing":{"blockGap":{"top":"2rem","left":"3rem"}}}} -->
	<div class="wp-block-columns are-vertically-aligned-center">
		<!-- wp:column {"width":"55%"} -->
		<div class="wp-block-column" style="flex-basis:55%">
			<!-- wp:paragraph {"style":{"typography":{"fontSize":"0.75rem","fontWeight":"700","textTransform":"uppercase","letterSpacing":"0.08em"},"color":{"background":"var:preset|color|highlight","text":"var:preset|color|primary"},"spacing":{"padding":{"top":"0.35rem","bottom":"0.35rem","left":"0.75rem","right":"0.75rem"}},"border":{"radius":"9999px"}}} -->
			<p class="has-primary-color has-highlight-background-color has-text-color has-background" style="border-radius:9999px;padding-top:0.35rem;padding-right:0.75rem;padding-bottom:0.35rem;padding-left:0.75rem;font-size:0.75rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;display:inline-block;margin-bottom:0.75rem"><?php esc_html_e( 'VIP Community Perks', 'swiftshop' ); ?></p>
			<!-- /wp:paragraph -->

			<!-- wp:heading {"level":2,"style":{"typography":{"fontSize":"clamp(1.5rem, 3vw, 2.25rem)","fontWeight":"800","lineHeight":"1.2"},"spacing":{"margin":{"bottom":"0.5rem"}}}} -->
			<h2 class="wp-block-heading" style="font-size:clamp(1.5rem, 3vw, 2.25rem);font-weight:800;line-height:1.2;margin-bottom:0.5rem"><?php esc_html_e( 'Receive 10% Off Your First Purchase', 'swiftshop' ); ?></h2>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"style":{"typography":{"fontSize":"0.95rem"},"color":{"text":"var:preset|color|text-muted"}}} -->
			<p class="has-text-muted-color has-text-color" style="font-size:0.95rem"><?php esc_html_e( 'Join our insider club for exclusive product drops, member-only flash events, and styling guides.', 'swiftshop' ); ?></p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column {"width":"45%"} -->
		<div class="wp-block-column" style="flex-basis:45%">
			<!-- wp:html -->
			<form class="swiftshop-newsletter-form" onsubmit="event.preventDefault(); alert('Thank you for subscribing! Your 10% discount code has been sent to your inbox.');" style="display:flex;gap:0.5rem;flex-wrap:wrap;">
				<input type="email" required placeholder="<?php esc_attr_e( 'Your email address...', 'swiftshop' ); ?>" aria-label="<?php esc_attr_e( 'Email Address', 'swiftshop' ); ?>" style="flex:1;min-width:200px;padding:0.875rem 1.25rem;border-radius:8px;border:1px solid #cbd5e1;background:#ffffff;font-size:0.925rem;outline:none;" />
				<button type="submit" class="wp-element-button" style="background:var(--wp--preset--color--secondary-accent, #059669);color:#ffffff;padding:0.875rem 1.5rem;font-weight:700;border:none;border-radius:8px;cursor:pointer;transition:transform 0.15s ease;">
					<?php esc_html_e( 'Claim 10% Off', 'swiftshop' ); ?> &rarr;
				</button>
			</form>
			<!-- /wp:html -->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</div>
<!-- /wp:group -->

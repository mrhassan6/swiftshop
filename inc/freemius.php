<?php
/**
 * Freemius Integration Wrapper for SwiftShop
 *
 * Provides safe, conditional loading of the Freemius SDK for optional enhancements,
 * strictly compliant with WordPress.org Theme Review guidelines.
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

if ( ! function_exists( 'swiftshop_fs' ) ) {
	/**
	 * Create a helper function for easy SDK access.
	 *
	 * Wraps Freemius initialization in a safe singleton structure.
	 *
	 * @return object|null Returns Freemius instance if available, or null.
	 */
	function swiftshop_fs(): ?object {
		global $swiftshop_fs;

		if ( ! isset( $swiftshop_fs ) ) {
			// Include Freemius SDK if present in vendor or sdk path.
			$sdk_path = dirname( __DIR__ ) . '/freemius/start.php';

			if ( file_exists( $sdk_path ) ) {
				require_once $sdk_path;

				$swiftshop_fs = fs_dynamic_init(
					array(
						'id'                  => '12345', // Configured via Freemius Dashboard.
						'slug'                => 'swiftshop',
						'type'                => 'theme',
						'public_key'          => 'pk_swiftshop_placeholder_key',
						'is_premium'          => false,
						'has_addons'          => false,
						'has_paid_plans'      => false,
						'menu'                => array(
							'slug'       => 'swiftshop',
							'account'    => true,
							'contact'    => true,
							'support'    => true,
							'parent'     => array(
								'slug' => 'themes.php',
							),
						),
						'navigation'          => 'tabs',
						'is_live'             => false,
					)
				);
			} else {
				// Provide dummy fallback object to prevent fatal errors when SDK is not bundled.
				$swiftshop_fs = null;
			}
		}

		return $swiftshop_fs;
	}

	// Initialize Freemius if SDK is present.
	if ( function_exists( 'swiftshop_fs' ) ) {
		swiftshop_fs();
		do_action( 'swiftshop_fs_loaded' );
	}
}

/**
 * Clean cleanup routine on theme deactivation/uninstall.
 *
 * @return void
 */
function swiftshop_fs_cleanup(): void {
	$fs = swiftshop_fs();
	if ( $fs && method_exists( $fs, 'add_action' ) ) {
		$fs->add_action( 'after_uninstall', 'swiftshop_fs_uninstall_cleanup' );
	}
}
add_action( 'after_setup_theme', 'swiftshop_fs_cleanup' );

/**
 * Handle Freemius uninstall cleanup if triggered.
 *
 * @return void
 */
function swiftshop_fs_uninstall_cleanup(): void {
	// Clean up any transient or option data when theme is deleted.
	delete_transient( 'swiftshop_free_shipping_calc' );
}

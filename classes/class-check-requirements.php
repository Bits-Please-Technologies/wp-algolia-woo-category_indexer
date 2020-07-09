<?php
/**
 * Class for checking plugin requirements
 * Like checking PHP version, WordPress version and so on
 *
 * @package algolia-woo-indexer
 */

namespace Algowoo;

/**
 * Define minimum required versions of PHP and WordPress
 */
define( 'ALGOLIA_MIN_PHP_VERSION', '7.2' );
define( 'ALGOLIA_MIN_WP_VERSION', '5.4' );

if ( ! class_exists( 'Algolia_Check_Requirements' ) ) {
	/**
	 * Check requirements for Algolia plugin
	 */
	class Algolia_Check_Requirements {

		/**
		 * Check for required PHP version.
		 *
		 * @return bool
		 */
		public static function algolia_php_version_check() {
			if ( version_compare( PHP_VERSION, ALGOLIA_MIN_PHP_VERSION, '<' ) ) {
				return false;
			}
			return true;
		}

		/**
		 * Check for required WordPress version.
		 *
		 * @return bool
		 */
		public static function algolia_wp_version_check() {
			if ( version_compare( $GLOBALS['wp_version'], ALGOLIA_MIN_WP_VERSION, '<' ) ) {
				return false;
			}
			return true;
		}

		/**
		 * Check that we have all of the required PHP extensions installed
		 *
		 * @return void
		 */
		public static function check_unmet_requirements() {
			if ( ! extension_loaded( 'mbstring' ) ) {
				echo '<div class="error notice">
					  <p>' . esc_html__( 'Algolia Woo Indexer requires the "mbstring" PHP extension to be enabled. Please contact your hosting provider.', 'algolia-woo-indexer' ) . '</p>
				  </div>';
			} elseif ( ! function_exists( 'mb_ereg_replace' ) ) {
				echo '<div class="error notice">
					  <p>' . esc_html__( 'Algolia Woo Indexer needs "mbregex" NOT to be disabled. Please contact your hosting provider.', 'algolia-woo-indexer' ) . '</p>
				  </div>';
			}
			if ( ! extension_loaded( 'curl' ) ) {
				echo '<div class="error notice">
					  <p>' . esc_html__( 'Algolia Woo Indexer requires the "cURL" PHP extension to be enabled. Please contact your hosting provider.', 'algolia-woo-indexer' ) . '</p>
				  </div>';
				return;
			}
		}

		/**
		 * Check if Woocommerce is activated
		 *
		 * @return boolean
		 */
		public static function is_woocommerce_plugin_active() {
			return in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ), true );
		}
	}
}
<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://github.com/jsphpl/affiliatewp-create-woocommerce-coupon
 * @since      1.0.0
 *
 * @package    AffiliateWP_Create_WooCommerce_Coupon
 * @subpackage AffiliateWP_Create_WooCommerce_Coupon/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    AffiliateWP_Create_WooCommerce_Coupon
 * @subpackage AffiliateWP_Create_WooCommerce_Coupon/includes
 * @author     Your Name <email@example.com>
 */
class AffiliateWP_Create_WooCommerce_Coupon_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'affiliatewp-create-woocommerce-coupon',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}

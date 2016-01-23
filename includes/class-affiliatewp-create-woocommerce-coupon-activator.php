<?php

/**
 * Fired during plugin activation
 *
 * @link       https://github.com/jsphpl/affiliatewp-create-woocommerce-coupon
 * @since      1.0.0
 *
 * @package    AffiliateWP_Create_WooCommerce_Coupon
 * @subpackage AffiliateWP_Create_WooCommerce_Coupon/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    AffiliateWP_Create_WooCommerce_Coupon
 * @subpackage AffiliateWP_Create_WooCommerce_Coupon/includes
 * @author     Your Name <email@example.com>
 */
class AffiliateWP_Create_WooCommerce_Coupon_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {

		add_option('awpwcc_auto_create', 1);
		add_option('awpwcc_auto_delete', 1);
		add_option('awpwcc_default_type', 'percent');
		add_option('awpwcc_default_value', 5);

	}

}

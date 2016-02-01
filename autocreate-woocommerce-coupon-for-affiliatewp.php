<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/jsphpl/autocreate-woocommerce-coupon-for-affiliatewp
 * @package           Autocreate_WooCommerce_Coupon_for_AffiliateWP
 *
 * @wordpress-plugin
 * Plugin Name:       Autocreate WooCommerce Coupon for AffiliateWP
 * Plugin URI:        https://github.com/jsphpl/autocreate-woocommerce-coupon-for-affiliatewp/
 * Description:       Auto-create WooCommerce Coupons for new affiliates
 * Version:           1.0.0
 * Author:            Joseph Paul <mail@jsph.pl>
 * Author URI:        https://github.com/jsphpl/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       acwccawp
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-autocreate-woocommerce-coupon-for-affiliatewp-activator.php
 */
function activate_autocreate_woocommerce_coupon_for_affiliatewp() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-autocreate-woocommerce-coupon-for-affiliatewp-activator.php';
	Autocreate_WooCommerce_Coupon_for_AffiliateWP_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-autocreate-woocommerce-coupon-for-affiliatewp-deactivator.php
 */
function deactivate_autocreate_woocommerce_coupon_for_affiliatewp() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-autocreate-woocommerce-coupon-for-affiliatewp-deactivator.php';
	Autocreate_WooCommerce_Coupon_for_AffiliateWP_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_autocreate_woocommerce_coupon_for_affiliatewp' );
register_deactivation_hook( __FILE__, 'deactivate_autocreate_woocommerce_coupon_for_affiliatewp' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-autocreate-woocommerce-coupon-for-affiliatewp.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 */
function run_autocreate_woocommerce_coupon_for_affiliatewp() {

	$plugin = new Autocreate_WooCommerce_Coupon_for_AffiliateWP();
	$plugin->run();

}
run_autocreate_woocommerce_coupon_for_affiliatewp();

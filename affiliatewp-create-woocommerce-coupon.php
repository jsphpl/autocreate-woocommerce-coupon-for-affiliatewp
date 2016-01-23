<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/jsphpl/affiliatewp-create-woocommerce-coupon
 * @since             1.0.0
 * @package           AffiliateWP_Create_WooCommerce_Coupon
 *
 * @wordpress-plugin
 * Plugin Name:       AffiliateWP Create WooCommerce Coupon
 * Plugin URI:        https://github.com/jsphpl/affiliatewp-create-woocommerce-coupon/
 * Description:       Auto-create WooCommerce Coupons for new affiliates
 * Version:           1.0.0
 * Author:            Joseph Paul <mail@jsph.pl>
 * Author URI:        https://github.com/jsphpl/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       awpwcc
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-affiliatewp-create-woocommerce-coupon-activator.php
 */
function activate_affiliatewp_create_woocommerce_coupon() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-affiliatewp-create-woocommerce-coupon-activator.php';
	AffiliateWP_Create_WooCommerce_Coupon_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-affiliatewp-create-woocommerce-coupon-deactivator.php
 */
function deactivate_affiliatewp_create_woocommerce_coupon() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-affiliatewp-create-woocommerce-coupon-deactivator.php';
	AffiliateWP_Create_WooCommerce_Coupon_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_affiliatewp_create_woocommerce_coupon' );
register_deactivation_hook( __FILE__, 'deactivate_affiliatewp_create_woocommerce_coupon' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-affiliatewp-create-woocommerce-coupon.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_affiliatewp_create_woocommerce_coupon() {

	$plugin = new AffiliateWP_Create_WooCommerce_Coupon();
	$plugin->run();

}
run_affiliatewp_create_woocommerce_coupon();

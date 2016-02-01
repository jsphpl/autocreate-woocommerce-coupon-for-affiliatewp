<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://github.com/jsphpl/autocreate-woocommerce-coupon-for-affiliatewp
 *
 * @package    Autocreate_WooCommerce_Coupon_for_AffiliateWP
 * @subpackage Autocreate_WooCommerce_Coupon_for_AffiliateWP/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @package    Autocreate_WooCommerce_Coupon_for_AffiliateWP
 * @subpackage Autocreate_WooCommerce_Coupon_for_AffiliateWP/includes
 * @author     Joseph Paul <mail@jsph.pl>
 */
class Autocreate_WooCommerce_Coupon_for_AffiliateWP {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @access   protected
	 * @var      Autocreate_WooCommerce_Coupon_for_AffiliateWP_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @access   protected
	 * @var      string    $autocreate_woocommerce_coupon_for_affiliatewp    The string used to uniquely identify this plugin.
	 */
	protected $autocreate_woocommerce_coupon_for_affiliatewp;

	/**
	 * The current version of the plugin.
	 *
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 */
	public function __construct() {

		$this->autocreate_woocommerce_coupon_for_affiliatewp = 'autocreate-woocommerce-coupon-for-affiliatewp';
		$this->version = '1.0.0';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Autocreate_WooCommerce_Coupon_for_AffiliateWP_Loader. Orchestrates the hooks of the plugin.
	 * - Autocreate_WooCommerce_Coupon_for_AffiliateWP_i18n. Defines internationalization functionality.
	 * - Autocreate_WooCommerce_Coupon_for_AffiliateWP_Admin. Defines all hooks for the admin area.
	 * - Autocreate_WooCommerce_Coupon_for_AffiliateWP_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-autocreate-woocommerce-coupon-for-affiliatewp-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-autocreate-woocommerce-coupon-for-affiliatewp-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-autocreate-woocommerce-coupon-for-affiliatewp-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-autocreate-woocommerce-coupon-for-affiliatewp-public.php';

		$this->loader = new Autocreate_WooCommerce_Coupon_for_AffiliateWP_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Autocreate_WooCommerce_Coupon_for_AffiliateWP_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Autocreate_WooCommerce_Coupon_for_AffiliateWP_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Autocreate_WooCommerce_Coupon_for_AffiliateWP_Admin( $this->get_autocreate_woocommerce_coupon_for_affiliatewp(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

		# Add Settings Link & Register Settings
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'add_settings_page' );
		$this->loader->add_action( 'plugin_action_links', $plugin_admin, 'settings_link', 10, 2 );
		$this->loader->add_action( 'admin_init', $plugin_admin, 'register_settings' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Autocreate_WooCommerce_Coupon_for_AffiliateWP_Public( $this->get_autocreate_woocommerce_coupon_for_affiliatewp(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

		# Create coupon on affiliate creation
		if (get_option('acwccawp_auto_create'))
		{
			$this->loader->add_action( 'affwp_insert_affiliate', $plugin_public, 'after_insert_affiliate' );
		}

		# Delete coupons on affiliate deletion
		if (get_option('acwccawp_auto_delete'))
		{
			$this->loader->add_action( 'affwp_affiliate_deleted', $plugin_public, 'after_delete_affiliate', 10, 2 );
		}
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @return    string    The name of the plugin.
	 */
	public function get_autocreate_woocommerce_coupon_for_affiliatewp() {
		return $this->autocreate_woocommerce_coupon_for_affiliatewp;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @return    Autocreate_WooCommerce_Coupon_for_AffiliateWP_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}

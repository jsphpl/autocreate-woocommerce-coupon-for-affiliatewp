<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://github.com/jsphpl/affiliatewp-create-woocommerce-coupon
 * @since      1.0.0
 *
 * @package    AffiliateWP_Create_WooCommerce_Coupon
 * @subpackage AffiliateWP_Create_WooCommerce_Coupon/includes
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
 * @since      1.0.0
 * @package    AffiliateWP_Create_WooCommerce_Coupon
 * @subpackage AffiliateWP_Create_WooCommerce_Coupon/includes
 * @author     Joseph Paul <mail@jsph.pl>
 */
class AffiliateWP_Create_WooCommerce_Coupon {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      AffiliateWP_Create_WooCommerce_Coupon_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $affiliatewp_create_woocommerce_coupon    The string used to uniquely identify this plugin.
	 */
	protected $affiliatewp_create_woocommerce_coupon;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
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
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->affiliatewp_create_woocommerce_coupon = 'affiliatewp-create-woocommerce-coupon';
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
	 * - AffiliateWP_Create_WooCommerce_Coupon_Loader. Orchestrates the hooks of the plugin.
	 * - AffiliateWP_Create_WooCommerce_Coupon_i18n. Defines internationalization functionality.
	 * - AffiliateWP_Create_WooCommerce_Coupon_Admin. Defines all hooks for the admin area.
	 * - AffiliateWP_Create_WooCommerce_Coupon_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-affiliatewp-create-woocommerce-coupon-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-affiliatewp-create-woocommerce-coupon-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-affiliatewp-create-woocommerce-coupon-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-affiliatewp-create-woocommerce-coupon-public.php';

		$this->loader = new AffiliateWP_Create_WooCommerce_Coupon_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the AffiliateWP_Create_WooCommerce_Coupon_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new AffiliateWP_Create_WooCommerce_Coupon_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new AffiliateWP_Create_WooCommerce_Coupon_Admin( $this->get_affiliatewp_create_woocommerce_coupon(), $this->get_version() );

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
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new AffiliateWP_Create_WooCommerce_Coupon_Public( $this->get_affiliatewp_create_woocommerce_coupon(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

		# Create coupon on affiliate creation
		if (get_option('awpwcc_auto_create'))
		{
			$this->loader->add_action( 'affwp_insert_affiliate', $plugin_public, 'after_insert_affiliate' );
		}

		# Delete coupons on affiliate deletion
		if (get_option('awpwcc_auto_delete'))
		{
			$this->loader->add_action( 'affwp_affiliate_deleted', $plugin_public, 'after_delete_affiliate', 10, 2 );
		}
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_affiliatewp_create_woocommerce_coupon() {
		return $this->affiliatewp_create_woocommerce_coupon;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    AffiliateWP_Create_WooCommerce_Coupon_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}

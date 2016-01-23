<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com/jsphpl/affiliatewp-create-woocommerce-coupon
 * @since      1.0.0
 *
 * @package    AffiliateWP_Create_WooCommerce_Coupon
 * @subpackage AffiliateWP_Create_WooCommerce_Coupon/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    AffiliateWP_Create_WooCommerce_Coupon
 * @subpackage AffiliateWP_Create_WooCommerce_Coupon/admin
 * @author     Your Name <email@example.com>
 */
class AffiliateWP_Create_WooCommerce_Coupon_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $affiliatewp_create_woocommerce_coupon    The ID of this plugin.
	 */
	private $affiliatewp_create_woocommerce_coupon;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $affiliatewp_create_woocommerce_coupon       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $affiliatewp_create_woocommerce_coupon, $version ) {

		$this->affiliatewp_create_woocommerce_coupon = $affiliatewp_create_woocommerce_coupon;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in AffiliateWP_Create_WooCommerce_Coupon_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The AffiliateWP_Create_WooCommerce_Coupon_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->affiliatewp_create_woocommerce_coupon, plugin_dir_url( __FILE__ ) . 'css/affiliatewp-create-woocommerce-coupon-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in AffiliateWP_Create_WooCommerce_Coupon_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The AffiliateWP_Create_WooCommerce_Coupon_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->affiliatewp_create_woocommerce_coupon, plugin_dir_url( __FILE__ ) . 'js/affiliatewp-create-woocommerce-coupon-admin.js', array( 'jquery' ), $this->version, false );

	}

	public function settings_link( $links, $file )
	{
		if ($file == 'affiliatewp-create-woocommerce-coupon/affiliatewp-create-woocommerce-coupon.php')
		{
			$settings_link = '<a href="options-general.php?page=affiliatewp-create-woocommerce-coupon">Settings</a>';
			array_unshift($links, $settings_link); 
		}
		
		return $links; 
	}

	public function register_settings()
	{
		register_setting('awpwcc-settings-general', 'awpwcc_auto_create');
		register_setting('awpwcc-settings-general', 'awpwcc_auto_delete');
		register_setting('awpwcc-settings-general', 'awpwcc_default_type');
		register_setting('awpwcc-settings-general', 'awpwcc_default_value');
	}

	public function add_settings_page()
	{
		add_submenu_page(null, 'Plugin Settings', 'Plugin Settings', 'administrator', 'affiliatewp-create-woocommerce-coupon', [ $this, 'render_settings_page' ] );
	}

	public function render_settings_page()
	{
		load_template(plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/affiliatewp-create-woocommerce-coupon-admin-display.php');
	}

}

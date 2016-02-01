<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com/jsphpl/autocreate-woocommerce-coupon-for-affiliatewp
 *
 * @package    Autocreate_WooCommerce_Coupon_for_AffiliateWP
 * @subpackage Autocreate_WooCommerce_Coupon_for_AffiliateWP/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Autocreate_WooCommerce_Coupon_for_AffiliateWP
 * @subpackage Autocreate_WooCommerce_Coupon_for_AffiliateWP/admin
 * @author     Joseph Paul <mail@jsph.pl>
 */
class Autocreate_WooCommerce_Coupon_for_AffiliateWP_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @access   private
	 * @var      string    $autocreate_woocommerce_coupon_for_affiliatewp    The ID of this plugin.
	 */
	private $autocreate_woocommerce_coupon_for_affiliatewp;

	/**
	 * The version of this plugin.
	 *
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @param      string    $autocreate_woocommerce_coupon_for_affiliatewp       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $autocreate_woocommerce_coupon_for_affiliatewp, $version ) {

		$this->autocreate_woocommerce_coupon_for_affiliatewp = $autocreate_woocommerce_coupon_for_affiliatewp;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Autocreate_WooCommerce_Coupon_for_AffiliateWP_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Autocreate_WooCommerce_Coupon_for_AffiliateWP_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->autocreate_woocommerce_coupon_for_affiliatewp, plugin_dir_url( __FILE__ ) . 'css/autocreate-woocommerce-coupon-for-affiliatewp-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Autocreate_WooCommerce_Coupon_for_AffiliateWP_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Autocreate_WooCommerce_Coupon_for_AffiliateWP_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->autocreate_woocommerce_coupon_for_affiliatewp, plugin_dir_url( __FILE__ ) . 'js/autocreate-woocommerce-coupon-for-affiliatewp-admin.js', array( 'jquery' ), $this->version, false );

	}

	public function settings_link( $links, $file )
	{
		if ($file == 'autocreate-woocommerce-coupon-for-affiliatewp/autocreate-woocommerce-coupon-for-affiliatewp.php')
		{
			$settings_link = '<a href="options-general.php?page=autocreate-woocommerce-coupon-for-affiliatewp">Settings</a>';
			array_unshift($links, $settings_link); 
		}
		
		return $links; 
	}

	public function register_settings()
	{
		register_setting('acwccawp-settings-general', 'acwccawp_auto_create');
		register_setting('acwccawp-settings-general', 'acwccawp_auto_delete');
		register_setting('acwccawp-settings-general', 'acwccawp_code_length');
	}

	public function add_settings_page()
	{
		add_submenu_page(null, 'Plugin Settings', 'Plugin Settings', 'administrator', 'autocreate-woocommerce-coupon-for-affiliatewp', [ $this, 'render_settings_page' ] );
	}

	public function render_settings_page()
	{
		load_template(plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/autocreate-woocommerce-coupon-for-affiliatewp-admin-display.php');
	}

}

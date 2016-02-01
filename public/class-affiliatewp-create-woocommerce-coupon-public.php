<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://github.com/jsphpl/affiliatewp-create-woocommerce-coupon
 * @since      1.0.0
 *
 * @package    AffiliateWP_Create_WooCommerce_Coupon
 * @subpackage AffiliateWP_Create_WooCommerce_Coupon/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    AffiliateWP_Create_WooCommerce_Coupon
 * @subpackage AffiliateWP_Create_WooCommerce_Coupon/public
 * @author     Your Name <email@example.com>
 */
class AffiliateWP_Create_WooCommerce_Coupon_Public {

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
	 * Which meta keys to include when copying template to actual coupon.
	 *
	 * @since	1.0.0
	 * @access	private
	 * @var		array	$meta_whitelist		Which meta keys to include when copying template to actual coupon.
	 */
	private $meta_whitelist = [
		'discount_type',
		'coupon_amount',
		'individual_use',
		'product_ids',
		'exclude_product_ids',
		'usage_limit',
		'usage_limit_per_user',
		'limit_usage_to_x_items',
		'expiry_date',
		'free_shipping',
		'exclude_sale_items',
		'product_categories',
		'exclude_product_categories',
		'minimum_amount',
		'maximum_amount',
		'customer_email'
	];

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $affiliatewp_create_woocommerce_coupon       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $affiliatewp_create_woocommerce_coupon, $version ) {

		$this->affiliatewp_create_woocommerce_coupon = $affiliatewp_create_woocommerce_coupon;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->affiliatewp_create_woocommerce_coupon, plugin_dir_url( __FILE__ ) . 'css/affiliatewp-create-woocommerce-coupon-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script( $this->affiliatewp_create_woocommerce_coupon, plugin_dir_url( __FILE__ ) . 'js/affiliatewp-create-woocommerce-coupon-public.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Create a coupon for the specified affiliate
	 *
	 * @since 1.0.0
	 */
	public function create_coupon($affiliate_id, $code_length = 6)
	{
		global $wpdb;

		// Generate random code
		$coupon_code = static::random_code($code_length);

		// Check if code already exists in db
		while (true)
		{
			$wpdb->get_results(
				"
				SELECT ID
				FROM $wpdb->posts
				WHERE
					post_type = 'shop_coupon'
					AND post_name = '$coupon_code'
				"
			);
			
			if (0 === $wpdb->num_rows)
			{
				// Unique code found
				break;
			}
			else
			{
				// Code exists, generate new one
				$coupon_code = static::random_code($code_length);
			}
		}
		
		// Add coupon		
		$coupon = [
			'post_title'	=> $coupon_code,
			'post_content'	=> '',
			'post_status'	=> 'publish',
			'post_author'	=> 1,
			'post_type'		=> 'shop_coupon'
		];
		$new_coupon_id = wp_insert_post( $coupon );
		
		// Attach to affiliate
		update_post_meta($new_coupon_id, 'affwp_discount_affiliate', $affiliate_id);
		update_post_meta($new_coupon_id, 'awpwcc_version', $this->version);
		
		// Fetch template meta
		$template_id = get_option('awpwcc_template_id');
		$template = get_post_meta($template_id);

		// Copy remaining meta values over from template
		foreach ($this->meta_whitelist as $key) {
			$value = $template[$key][0];
			update_post_meta($new_coupon_id, $key, $value);
		}
	}

	/**
	 * Delete all coupons for the specified affiliate
	 *
	 * @since 1.0.0
	 */
	public function delete_coupons($affiliate_id)
	{
		global $wpdb;

		$posts = $wpdb->get_results(
			"
			SELECT post_id
			FROM $wpdb->postmeta
			WHERE
				meta_key = 'affwp_discount_affiliate'
				AND meta_value = $affiliate_id
			"
		);

		$post_ids = wp_list_pluck($posts, 'post_id');

		foreach ($post_ids as $post_id) {
			wp_delete_post($post_id, false);
		}
	}

	/**
	 * Hook that gets triggered after creation of a new affiliate
	 * Creates a coupon code for the new affiliate
	 *
	 * @since 1.0.0
	 */
	public function after_insert_affiliate($affiliate_id)
	{	
		$this->create_coupon($affiliate_id);
	}

	/**
	 * Hook that gets triggered after deletion of an affiliate
	 * Deletes all coupons for the affiliate
	 *
	 * @since 1.0.0
	 */
	public function after_delete_affiliate($affiliate_id, $delete_data)
	{
		if ($delete_data)
		{
			$this->delete_coupons($affiliate_id);
		}
	}

	/**
	 * Generate a random coupon code of given length
	 *
	 * @since 1.0.0
	 * @return string a random code of given length
	 */
	public static function random_code($length = 6, $chars = '0123456789abcdefghijklmnopqrstuvwxyz')
	{
		$chars_len = strlen($chars);
		$result = '';
		
		for ($i = 0; $i < $length; $i++) {
			$result .= $chars[rand(0, $chars_len - 1)];
		}
		
		return $result;
	}

}

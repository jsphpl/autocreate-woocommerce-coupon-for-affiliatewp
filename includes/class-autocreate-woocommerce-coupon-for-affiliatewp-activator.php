<?php

/**
 * Fired during plugin activation
 *
 * @link       https://github.com/jsphpl/autocreate-woocommerce-coupon-for-affiliatewp
 *
 * @package    Autocreate_WooCommerce_Coupon_for_AffiliateWP
 * @subpackage Autocreate_WooCommerce_Coupon_for_AffiliateWP/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @package    Autocreate_WooCommerce_Coupon_for_AffiliateWP
 * @subpackage Autocreate_WooCommerce_Coupon_for_AffiliateWP/includes
 * @author     Joseph Paul <mail@jsph.pl>
 */
class Autocreate_WooCommerce_Coupon_for_AffiliateWP_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 */
	public static function activate()
	{
		// Set default options
		add_option('acwccawp_auto_create', 1);
		add_option('acwccawp_auto_delete', 1);
		add_option('acwccawp_code_length', 6);


		// Find or create the template coupon
		$template_id = get_option('acwccawp_template_id', null);

		if (!(
				0 < $template_id
				AND 'shop_coupon' === get_post_type($template_id)
				AND 'yes' === get_post_meta($template_id, 'acwccawp_template', True)
				AND 'publish' === get_post_status($template_id)
			))
		{
			// No valid template coupon there, create one
			$random_suffix = Autocreate_WooCommerce_Coupon_for_AffiliateWP_Public::random_code(6);
			$template_coupon = [
				'post_title'	=> 'acwccawp_template_' . $random_suffix,
				'post_excerpt'	=> 'This is the template for coupons auto-created for new affiliates. Do not remove this coupon. Already existing coupons will not be affected by changes made here.',
				'post_status'	=> 'publish',
				'post_author'	=> 1,
				'post_type'		=> 'shop_coupon'
			];

			$template_id = wp_insert_post( $template_coupon );
			update_post_meta($template_id, 'acwccawp_template', 'yes');

			update_option('acwccawp_template_id', $template_id);
		}
	}

}

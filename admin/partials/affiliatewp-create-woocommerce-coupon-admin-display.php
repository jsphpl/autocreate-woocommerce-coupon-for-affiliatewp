<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://github.com/jsphpl/affiliatewp-create-woocommerce-coupon
 * @since      1.0.0
 *
 * @package    AffiliateWP_Create_WooCommerce_Coupon
 * @subpackage AffiliateWP_Create_WooCommerce_Coupon/admin/partials
 */
?>

<div class="wrap">
	<h2>AffiliateWP Woocommerce Coupon Settings</h2>

	<form method="post" action="options.php">
		<?php settings_fields( 'awpwcc-settings-general' ); ?>
		<?php do_settings_sections( 'awpwcc-settings-general' ); ?>
		<table class="form-table">
			<tr valign="top">
				<th scope="row">Auto-Create Coupon</th>
				<td>
					<input name="awpwcc_auto_create" type="checkbox" value="1" <?php checked( '1', get_option( 'awpwcc_auto_create' ) ); ?> />
				</td>
				<td>
					<span>Check if you want to auto-create a coupon code when a new affiliate is created</span>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">Auto-Delete Coupons</th>
				<td>
					<input name="awpwcc_auto_delete" type="checkbox" value="1" <?php checked( '1', get_option( 'awpwcc_auto_delete' ) ); ?> />
				</td>
				<td>
					<span>Check if you want to delete all coupons when an affiliate is deleted</span>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">Coupon Type</th>
				<td>
					<select name="awpwcc_default_type">
						<option value="percent" <?php selected( get_option('awpwcc_default_type'), 'percent' ); ?>>Percent</option>
						<option value="fixed_cart" <?php selected( get_option('awpwcc_default_type'), 'fixed_cart' ); ?>>Fixed</option>
					</select>
				</td>
				<td>
					<span>Type of the voucher (percent or fixed)</span>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">Coupon Value</th>
				<td>
					<input name="awpwcc_default_value" type="text" value="<?php echo get_option( 'awpwcc_default_value' ); ?>" />
				</td>
				<td>
					<span>The value of the voucher</span>
				</td>
			</tr>
		</table>
		
		<?php submit_button(); ?>

	</form>
</div>
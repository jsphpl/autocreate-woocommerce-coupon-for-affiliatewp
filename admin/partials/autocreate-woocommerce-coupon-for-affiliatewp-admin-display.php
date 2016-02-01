<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://github.com/jsphpl/autocreate-woocommerce-coupon-for-affiliatewp
 *
 * @package    Autocreate_WooCommerce_Coupon_for_AffiliateWP
 * @subpackage Autocreate_WooCommerce_Coupon_for_AffiliateWP/admin/partials
 */
?>

<div class="wrap">
	<h2>Autocreate WooCommerce Coupon for AffiliateWP Settings</h2>

	<p><strong>In order to change the settings for the generated coupons, such as value or type, please edit the <a href="<?php echo get_edit_post_link(get_option('acwccawp_template_id'));  ?>">Template-Coupon</a>.</strong></p>

	<form method="post" action="options.php">
		<?php settings_fields( 'acwccawp-settings-general' ); ?>
		<?php do_settings_sections( 'acwccawp-settings-general' ); ?>
		<table class="form-table">
			<tr valign="top">
				<th scope="row">Auto-Create Coupon</th>
				<td>
					<input name="acwccawp_auto_create" type="checkbox" value="1" <?php checked( '1', get_option( 'acwccawp_auto_create' ) ); ?> />
				</td>
				<td>
					<span>Check if you want to auto-create a coupon code when a new affiliate is created</span>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">Auto-Delete Coupons</th>
				<td>
					<input name="acwccawp_auto_delete" type="checkbox" value="1" <?php checked( '1', get_option( 'acwccawp_auto_delete' ) ); ?> />
				</td>
				<td>
					<span>Check if you want to delete all coupons when an affiliate is deleted</span>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">Coupon Code Length</th>
				<td>
					<input name="acwccawp_code_length" type="number" min="3" max="32" steps="1" value="<?php echo get_option( 'acwccawp_code_length' ); ?>" />
				</td>
				<td>
					<span>Of how many random letters/numbers shall the coupon code consist?</span>
				</td>
			</tr>
		</table>
		
		<?php submit_button(); ?>

	</form>
</div>
<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://inmomentum.io/
 * @since      1.0.0
 *
 * @package    Im_Custom_Css
 * @subpackage Im_Custom_Css/admin/partials
 */
?>

<div class="wrap">

	<h1>IM Custom CSS<br />
		<small class="inmomentum-plugin-author">
			<?php esc_html_e( 'by', 'im-custom-css' ); ?>
			<a href="http://inmomentum.io/">InMomentum</a>
		</small>
	</h1>

	<p><?php wp_kses( _e( 'Cascading Style Sheets or CSS, is a style sheet language. It is used for styling of the HTML markup of your WordPress page.<br>It helps you create a visually engaging webpage. If you are new to CSS we recommend you <a href="http://www.w3schools.com/css/" target="_blank">w3schools CSS tutorials.</a>', 'im-custom-css' ), array('a' => array('href' => array(), 'target' => array()), 'br' => array())); ?></p>

	<h2 class="nav-tab-wrapper">
		<a href="#" class="nav-tab nav-tab-active" imcc-nav-tab-for="css"><?php esc_html_e( 'CSS', 'im-custom-css' ); ?></a>
		<a href="#" class="nav-tab" imcc-nav-tab-for="settings"><?php esc_html_e( 'Settings', 'im-custom-css' ); ?></a>
	</h2>

	<form method="post" action="options.php">
		<?php settings_fields( 'im_custom_css_settings' ); ?>
		<div class="imcc-nav-tab-content" imcc-nav-tab-content="css">
			<table class="form-table">
				<tr>
					<td>
					<p>
						<textarea id="imcc-editor" name="im_custom_css_options[css_code]" rows="10" cols="50" class="large-text code"><?php echo esc_attr( get_option('im_custom_css_options')['css_code'] ); ?></textarea>
					</p>
					</td>
				</tr>
			</table>
		</div>

		<div class="imcc-nav-tab-content" imcc-nav-tab-content="settings">
			<table class="form-table">
				<tr>
					<th scope="row"><?php esc_html_e( 'Status', 'im-custom-css' ); ?></th>
					<td>
						<fieldset>
							<legend class="screen-reader-text"><span><?php esc_html_e( 'Status', 'im-custom-css' ); ?></span></legend>
							<p>
								<label><input name="im_custom_css_options[settings_status]" type="radio" value="1" <?php if(get_option('im_custom_css_options')['settings_status'] == true){ echo 'checked="checked"'; } ?>><?php esc_html_e( 'Enabled', 'im-custom-css' ); ?></label><br>
								<label><input name="im_custom_css_options[settings_status]" type="radio" value="0" <?php if(get_option('im_custom_css_options')['settings_status'] == false){ echo 'checked="checked"'; } ?>><?php esc_html_e( 'Disabled', 'im-custom-css' ); ?></label>
							</p>
							<p class="description"><?php esc_html_e( 'Turns on / off the rendering of your custom CSS.', 'im-custom-css' ); ?></p>
						</fieldset>
					</td>
				</tr>
			</table>
		</div>

		<?php submit_button(); ?>

	</form>
</div>

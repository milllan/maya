	<?php

/**
 * Provides a markup for creating Custom select
 *
 * This file is used to markup the public view aspects of the plugin.
 * You can access all the required variables throught $_POST
 *
 * @link       http://pixel-industry.com/
 * @since      1.0.0
 *
 * @package    My_Mayan_Sign
 * @subpackage My_Mayan_Sign/public/views
 */

require_once(rtrim($_SERVER['DOCUMENT_ROOT'], '/') . '/wp-load.php');
?>
<?php //if( empty (get_user_meta(get_current_user_id(), 'first_name', true) ) ) : ?>
	<div id="mymasi-ca-wrap">
			<div class="mymasi-ca-item">
				<div class="two-columns">
					<div class="two-columns_right">
						<span class="two-columns_heading"><?php _e('Your Name', 'my-mayan-sign'); ?><abbr class="required" title="required">*</abbr></span>
							<div class="two-columns_form">
									<p class="form-row form-row-wide validate-required" data-priority="110">
										<input type="text" class="input-text " name="your_name" id="first_name" placeholder="Enter your name" value="" autocomplete="first_name">
									</p>
							</div>
					</div>
				</div>
			</div>
	</div>
<?php //endif; ?>
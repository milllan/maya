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

  <div id="mymasi-ca-wrap">
      <div class="mymasi-ca-item">
        <div class="two-columns">
          <div class="two-columns_right">
             <span class="two-columns_heading"><?php _e('Your Gender', 'my-mayan-sign'); ?></span>
             <p></p>
             <div class="two-columns_form">
                <span class="wpcf7-form-control-wrap menu-gender">
                   <select id="gender" class="wpcf7-form-control wpcf7-select" aria-invalid="false" tabindex="-1" aria-hidden="true">
                      <option value=""><?php _e('Please select your gender', 'my-mayan-sign'); ?></option>
                      <option value="Male"><?php _e('Male', 'my-mayan-sign'); ?></option>
                      <option value="Female"><?php _e('Female', 'my-mayan-sign'); ?></option>
                   </select>
                </span>
             </div>
          </div>
        </div>
      </div>
  </div>
  <style>
#gender {
  width:100%
}
</style>
<?php

/**
 * Provides a markup for the 'Mayan Sign Detailed Report Adult stage' view.
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

<div class="report-single_main-heading">
  <p>
    <?php echo $_POST['static_text']['detailed_report_adult']['text']; ?>
  </p>
</div>

<div class="report-single">
  <div class="report-single_heading">
    <img src="<?php echo $_POST['day_sign']['img']; ?>">
    <h2><?php _e('Your Day (Adult) Sign - ', 'my-mayan-sign'); ?><?php echo $_POST['day_sign']['title']; ?></h2>
  </div>
  <p><?php echo $_POST['day_sign']['content']; ?></p>
</div>

<div class="report-single">
  <div class="report-single_heading">
    <img src="<?php echo $_POST['tone']['core_tone_img_number_f']; ?>">
    <h2><?php _e('Your Galactic Tone - ', 'my-mayan-sign'); ?><?php echo $_POST['tone']['core_tone_txt']['title']; ?></h2>
  </div>
  <p><?php echo $_POST['tone']['core_tone_txt']['minor_text']; ?></p>
</div>

<div class="report-single">
  <div class="report-single_heading">
    <img src="<?php echo $_POST['tercana']['img']; ?>">
    <h2><?php _e('Your Trecana Sign - ', 'my-mayan-sign'); ?><?php echo $_POST['tercana']['title']; ?></h2>
  </div>
  <p><?php echo $_POST['tercana']['minor_text']; ?></p>
</div>

<div class="report-single">
  <div class="report-single_heading">
    <img src="<?php echo $_POST['female']['img']; ?>">
    <h2><?php _e('Your Female Sign - ', 'my-mayan-sign'); ?><?php echo $_POST['female']['title']; ?></h2>
  </div>
  <p><?php echo $_POST['female']['minor_text']; ?></p>
</div>

<div class="report-single">
  <div class="report-single_heading">
    <img src="<?php echo $_POST['tone']['female_tone_txt']['img']; ?>">
    <h2><?php _e('Your Female Tone - ', 'my-mayan-sign'); ?><?php echo $_POST['tone']['female_tone_txt']['title']; ?></h2>
  </div>
  <p><?php echo $_POST['tone']['female_tone_txt']['minor_text']; ?></p>
</div>

<div class="report-single">
  <div class="report-single_heading">
    <img src="<?php echo $_POST['male']['img']; ?>">
    <h2><?php _e('Your Male Sign - ', 'my-mayan-sign'); ?><?php echo $_POST['male']['title']; ?></h2>
  </div>
  <p><?php echo $_POST['male']['minor_text']; ?></p>
</div>

<div class="report-single">
  <div class="report-single_heading">
    <img src="<?php echo $_POST['tone']['male_tone_txt']['img']; ?>">
    <h2><?php _e('Your Male Tone - ', 'my-mayan-sign'); ?><?php echo $_POST['tone']['male_tone_txt']['title']; ?></h2>
  </div>
  <p><?php echo $_POST['tone']['male_tone_txt']['minor_text']; ?></p>
</div>

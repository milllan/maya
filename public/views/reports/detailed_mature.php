<?php

/**
 * Provides a markup for the 'Mayan Sign Detailed Report Mature stage' view.
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
$_POST = stripslashes_deep( $_POST );
?>

<div class="back-button">
  <a href="<?php echo $_POST['url'] ?>"><span><?php _e('Back to My Reports', 'my-mayan-sign'); ?></span></a>
</div>

<div class="report-single_main-heading">
  <h2><?php echo wp_sprintf('Dear %s,',  $_POST['user_name'] ); ?></h2>
  <p>
    <?php echo $_POST['static_text']['detailed_report_mature']['text']; ?>
  </p>
</div>

<div class="report-single">
  <div class="report-single_heading">
    <img src="<?php echo $_POST['future']['img']; ?>">
    <h2><?php _e('Your Mature Sign - ', 'my-mayan-sign'); ?><?php echo $_POST['future']['title']; ?></h2>
  </div>
  <p><?php echo $_POST['future']['content']; ?></p>
</div>

<div class="report-single">
  <div class="report-single_heading">
    <img src="<?php echo $_POST['tone']['future_tone_txt']['img']; ?>">
    <h2><?php _e('Your Mature Tone - ', 'my-mayan-sign'); ?><?php echo $_POST['tone']['future_tone_txt']['title']; ?></h2>
  </div>
  <p><?php echo $_POST['tone']['future_tone_txt']['content']; ?></p>
</div>

<div class="report-single">
  <div class="report-single_heading">
    <img src="<?php echo $_POST['destiny_female']['img']; ?>">
    <h2><?php _e('Your Mature Female Sign - ', 'my-mayan-sign'); ?><?php echo $_POST['destiny_female']['title']; ?></h2>
  </div>
  <p><?php echo $_POST['destiny_female']['minor_text']; ?></p>
</div>

<div class="report-single">
  <div class="report-single_heading">
    <img src="<?php echo $_POST['tone']['destiny_female_tone_txt']['img']; ?>">
    <h2><?php _e('Your Mature Female Tone - ', 'my-mayan-sign'); ?><?php echo $_POST['tone']['destiny_female_tone_txt']['title']; ?></h2>
  </div>
  <p><?php echo $_POST['tone']['destiny_female_tone_txt']['minor_text']; ?></p>
</div>

<div class="report-single">
  <div class="report-single_heading">
    <img src="<?php echo $_POST['destiny_male']['img']; ?>">
    <h2><?php _e('Your Mature Male Sign - ', 'my-mayan-sign'); ?><?php echo $_POST['destiny_male']['title']; ?></h2>
  </div>
  <p><?php echo $_POST['destiny_male']['minor_text']; ?></p>
</div>

<div class="report-single">
  <div class="report-single_heading">
    <img src="<?php echo $_POST['tone']['destiny_male_tone_txt']['img']; ?>">
    <h2><?php _e('Your Mature Male Tone - ', 'my-mayan-sign'); ?><?php echo $_POST['tone']['destiny_male_tone_txt']['title']; ?></h2>
  </div>
  <p><?php echo $_POST['tone']['destiny_male_tone_txt']['minor_text']; ?></p>
</div>

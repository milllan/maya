<?php

/**
 * Provides a markup for the 'Mayan Sign Core Sign' view for boath simple and standard packages.
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
    <?php echo $_POST['static_text']['core']['text']; ?>
  </p>

</div>

<div class="report-single">
  <div class="report-single_heading">
    <img src="<?php echo $_POST['day_sign']['img']; ?>">
    <h2><?php _e('Your Day Sign - ', 'my-mayan-sign'); ?><?php echo $_POST['day_sign']['title']; ?></h2>
  </div>
  <p><?php echo $_POST['day_sign']['content']; ?></p>
</div>

<div class="report-single">
  <div class="report-single_heading">
    <img src="<?php echo $_POST['tone_txt']['img']; ?>">
    <h2><?php _e('Your Galactic Tone - ', 'my-mayan-sign'); ?><?php echo $_POST['tone_txt']['title']; ?></h2>
  </div>
  <p><?php echo $_POST['tone_txt']['content']; ?></p>
</div>

<div class="report-single">
  <div class="report-single_heading">
    <img src="<?php echo $_POST['tercana']['img']; ?>">
    <h2><?php _e('Your Trecana Sign - ', 'my-mayan-sign'); ?><?php echo $_POST['tercana']['title']; ?></h2>
  </div>
  <p><?php echo $_POST['tercana']['minor_text']; ?></p>
</div>

<?php

/**
 * Provides a markup for the 'Mayan Sign Eight Directions' view.
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

<div class="back-button">
  <a href="<?php echo $_POST['url'] ?>"><span><?php _e('Back to Comptency Analysis', 'my-mayan-sign'); ?></span></a>
</div>

<div class="competency-single_main-heading">
  <h2><?php _e('Compentency analysis for : ', 'my-mayan-sign'); ?></h2>
  <h2><?php echo $_POST['names']; ?></h2>
</div>

<div class="competency-single">
  <div class="competency-single_heading">
    <img src="<?php echo $_POST['youth']['img']; ?>">
    <h2><?php _e('Your Youth Sign - ', 'my-mayan-sign'); ?><?php echo $_POST['youth_ca']['title']; ?></h2>
  </div>
  <p><?php echo $_POST['youth_ca']['content']; ?></p>
</div>

<div class="competency-single">
  <div class="competency-single_heading">
    <img src="<?php echo $_POST['future']['img']; ?>">
    <h2><?php _e('Your Future Sign - ', 'my-mayan-sign'); ?><?php echo $_POST['future_ca']['title']; ?></h2>
  </div>
  <p><?php echo $_POST['future_ca']['content']; ?></p>
</div>

<div class="competency-single">
  <div class="competency-single_heading">
    <img src="<?php echo $_POST['youth_male']['img']; ?>">
    <h2><?php _e('Your Youth Male Sign - ', 'my-mayan-sign'); ?><?php echo $_POST['youth_male_ca']['title']; ?></h2>
  </div>
  <p><?php echo $_POST['youth_male_ca']['content']; ?></p>
</div>

<div class="competency-single">
  <div class="competency-single_heading">
    <img src="<?php echo $_POST['youth_female']['img']; ?>">
    <h2><?php _e('Your Youth Female Sign - ', 'my-mayan-sign'); ?><?php echo $_POST['youth_female_ca']['title']; ?></h2>
  </div>
  <p><?php echo $_POST['youth_female_ca']['content']; ?></p>
</div>

<div class="competency-single">
  <div class="competency-single_heading">
    <img src="<?php echo $_POST['male']['img']; ?>">
    <h2><?php _e('Your Male Sign - ', 'my-mayan-sign'); ?><?php echo $_POST['male_ca']['title']; ?></h2>
  </div>
  <p><?php echo $_POST['male_ca']['content']; ?></p>
</div>

<div class="competency-single">
  <div class="competency-single_heading">
    <img src="<?php echo $_POST['female']['img']; ?>">
    <h2><?php _e('Your Female Sign - ', 'my-mayan-sign'); ?><?php echo $_POST['female_ca']['title']; ?></h2>
  </div>
  <p><?php echo $_POST['female_ca']['content']; ?></p>
</div>

<div class="competency-single">
  <div class="competency-single_heading">
    <img src="<?php echo $_POST['destiny_male']['img']; ?>">
    <h2><?php _e('Your Destiny Male Sign - ', 'my-mayan-sign'); ?><?php echo $_POST['destiny_male_ca']['title']; ?></h2>
  </div>
  <p><?php echo $_POST['destiny_male_ca']['content']; ?></p>
</div>

<div class="competency-single">
  <div class="competency-single_heading">
    <img src="<?php echo $_POST['destiny_female']['img']; ?>">
    <h2><?php _e('Your Destiny Female Sign - ', 'my-mayan-sign'); ?><?php echo $_POST['destiny_female_ca']['title']; ?></h2>
  </div>
  <p><?php echo $_POST['destiny_female_ca']['content']; ?></p>
</div>

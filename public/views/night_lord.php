<?php

/**
 * Provides a markup for the 'Mayan Night Lord' view.
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
$_POST = stripslashes_deep( $_POST ); ?>

<div class="back-button">
  <a href="<?php echo $_POST['url'] ?>"><span><?php _e('Back to My Reports', 'my-mayan-sign'); ?></span></a>
</div>

<div class="report-single">
  <h1><?php echo $_POST['static_text']['night_lord_title']['text'] ?></h1>
  <p><?php echo $_POST['static_text']['night_lord_text']['text'] ?></p>

  <h2><?php echo $_POST['night_lord']['title'] ?></h2>

  <p><?php echo $_POST['night_lord']['content']; ?></p>
</div>
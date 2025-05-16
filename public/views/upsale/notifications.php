<?php

/**
 * Provides a markup for the 'Mayan Sign Notifications' overview.
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

<div class="notification-wrapper">
  <p><span><?php _e('You have not purchased any notifications yet. ', 'my-mayan-sign'); ?></p>
</div>

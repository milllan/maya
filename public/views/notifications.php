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

$notifications = $_POST['notifications'];
?>

<div class="notification-wrapper">
<?php
if (!empty($notifications)) {
	foreach ($notifications as $notification) { ?>

  <div class="notification-item">
    <div class="notification-img">
      <img src='/wp-content/plugins/maya/public/images/ca-overview-item.png' />
    </div>
    <div class="notification-text">
      <h2><?php echo $notification['name']; ?></h2>

      <ul class="notification_list">
        <li>
          <p><span><?php _e('Day Sign: ', 'my-mayan-sign'); ?></span><?php echo $_POST['burcName']; ?></p>
        </li>
        <li>
          <p><span><?php _e('Expires in: ', 'my-mayan-sign'); ?></span><?php echo $notification['expires']; ?></p>
        </li>
        <li class="notification_status">
          <p><span><?php _e('Status: ', 'my-mayan-sign'); ?></span><span class="<?php echo $notification['status_class']; ?>"><?php echo $notification['status']; ?></span></p>
        </li>
      </ul>
      <a href="<?php echo $notification['url']; ?>"><?php _e('Purchase Notifications', 'my-mayan-sign'); ?></a>
      <a class="<?php echo $notification['disable_class']; ?> prevent-notifications" href="<?php echo $notification['disable_url']; ?>"><?php echo $notification['disable_text']; ?></a>
    </div>
  </div>
<?php 
}
} ?>
</div>

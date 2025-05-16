<?php
/**
 * Provides a markup for creating Custom popup
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

<div class="mms-overlay email-notification">
	<div id="popup1" class="prev-notif-popup">
	<div class="prev-notif-popup__close"></div>
	<div class="prev-notif-popup__heading">
		<h2><?php _e( 'Are you sure?', 'my-mayan-sign' ) ?></h2>
		<p><?php _e( 'You will stop receiving email notifications for your Important Days, but you can enable them later.', 'my-mayan-sign' ) ?></p>
	</div>
	<div class="prev-notif-popup__body">
		<form action="/disable-notification" method="post" >
			<input type="hidden" name="my_custom_notification_disable" value="true">
		<button type="submit"><?php _e( 'Disable email notifications', 'my-mayan-sign' ) ?></button>
		</form>
	</div>
	</div>

	<div id="popup2" class="prev-notif-popup">
	<div class="prev-notif-popup__close"></div>
	<div class="prev-notif-popup__heading">
		<h2><?php _e( 'Are you sure?', 'my-mayan-sign' ) ?></h2>
		<p><?php _e( 'You will stop receiving email notifications for your Daily Mayan Wisdom, but you can enable them later.', 'my-mayan-sign' ) ?></p>
	</div>
	<div class="prev-notif-popup__body">
		<form action="/disable-notification" method="post" >
			<input type="hidden" name="important_notification_disable" value="true">
			<button type="submit"><?php _e( 'Disable email notifications', 'my-mayan-sign' ) ?></button>
		</form>
	</div>
	</div>

	<div id="popup3" class="prev-notif-popup">
	<div class="prev-notif-popup__close"></div>
	<div class="prev-notif-popup__heading">
		<h2><?php _e( 'Are you sure?', 'my-mayan-sign' ) ?></h2>
		<p><?php _e( 'You will start receiving email notifications for your Important Days, but you can disable them later.', 'my-mayan-sign' ) ?></p>
	</div>
	<div class="prev-notif-popup__body">
		<form action="/disable-notification" method="post" >
			<input type="hidden" name="my_custom_notification_enable" value="true">
			<button type="submit"><?php _e( 'Enable email notifications', 'my-mayan-sign' ) ?></button>
		</form>
	</div>
	</div>

	<div id="popup4" class="prev-notif-popup">
	<div class="prev-notif-popup__close"></div>
	<div class="prev-notif-popup__heading">
		<h2><?php _e( 'Are you sure?', 'my-mayan-sign' ) ?></h2>
		<p><?php _e( 'You will start receiving email notifications for your Daily Mayan Wisdom, but you can disable them later.', 'my-mayan-sign' ) ?></p>
	</div>
	<div class="prev-notif-popup__body">
		<form action="/disable-notification" method="post" >
			<input type="hidden" name="important_notification_enable" value="true">
			<button type="submit"><?php _e( 'Enable email notifications', 'my-mayan-sign' ) ?></button>
		</form>
	</div>
	</div>
</div>
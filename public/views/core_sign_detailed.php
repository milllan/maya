<?php

/**
 * Provides a markup for the 'Mayan Sign Core Sign' view.
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

<h2><?php _e('Your Day Sign', 'my-mayan-sign'); ?></h2>

<h3><?php echo $_POST['day_sign']['title']; ?></h3>
<img src="<?php echo $_POST['day_sign']['img']; ?>">
<p><?php echo $_POST['day_sign']['content']; ?></p>

<h2><?php _e('Your Tone', 'my-mayan-sign'); ?></h2>

<h3><?php echo $_POST['tone']['title']; ?></h3>
<img src="<?php echo $_POST['tone']['img']; ?>">
<p><?php echo $_POST['tone']['content']; ?></p>

<h2><?php _e('Your Trecana Sign', 'my-mayan-sign'); ?> </h2>

<h3><?php echo $_POST['tercana']['title']; ?></h3>
<img src="<?php echo $_POST['tercana']['img']; ?>">
<p><?php echo $_POST['tercana']['minor_text']; ?></p>

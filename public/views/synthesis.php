<?php

/**
 * Provides a markup for the 'Mayan Sign Synthesis' view.
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

<div class="report-single">
  <div class="back-button">
    <a href="<?php echo $_POST['url'] ?>"><span><?php _e('Back to My Reports', 'my-mayan-sign'); ?></span></a>
  </div>
  <?php if(isset($_POST['synthesis']['img']) && $_POST['synthesis']['img'] !== "0") : ?>
    <div class="report-single_heading">
      <img src="<?php echo $_POST['synthesis']['img']; ?>">
    </div>
  <?php endif; ?>

  <p><?php echo $_POST['synthesis']['content']; ?></p>
</div>

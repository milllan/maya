<?php

/**
 * Provides a markup for the 'Mayan Sign Custom calendar top' view.
 *
 * This will be loaded before your custom calendar view
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
  <a href="<?php echo $_POST['url'] ?>"><span><?php _e('Back to My Reports', 'my-mayan-sign'); ?></span></a>
</div>

<div class="report-single_main-heading">
  <h2><?php _e('Your Significant Days', 'my-mayan-sign'); ?></h2>
</div>

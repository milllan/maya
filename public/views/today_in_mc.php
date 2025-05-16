<?php

/**
 * Provides a markup for the 'Mayan Sign Today in Mayan Calendar' view.
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


<div class="report-calculator-preview today">
  <div class="col1">
    <div class="vc_row" data-day="<?php echo $_POST['today_in_mc']['day'] ?>">
      <div class="report_icon-details-single">
        <a href="#day-sign">
          <h4><?php _e( 'Day Sign', 'my-mayan-sign' ); ?></h4>
            <img src="<?php echo $_POST['sign']['img']; ?>">
        </a>
      </div>
      <div class="report_icon-details-single">
        <a href="#tone">
          <h4><?php _e( 'Galactic Tone', 'my-mayan-sign' ); ?></h4>
          <img src="<?php echo $_POST['tone']['img']; ?>">
        </a>
      </div>
      <div class="report_icon-details-single">
        <a href="#tercana">
          <h4><?php _e( 'Trecana Sign', 'my-mayan-sign' ); ?></h4>
          <img src="<?php echo $_POST['tracana']['img']; ?>">
        </a>
      </div>
    </div>
  </div>
</div>

<div class="report-single">
  <div class="report-single_heading">
    <h2><?php echo $_POST['today_in_mc']['title']; ?></h2>
  </div>
  <p><?php echo $_POST['today_in_mc']['content']; ?></p>
</div>
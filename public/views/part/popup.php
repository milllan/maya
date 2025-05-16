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

<div class="mms-overlay <?php echo $_POST['class'] ?>">
    <div class="mms-popup">
        <a href="#" class="mms-popup_close"></a>
        <div class="mms-popup_heading">
            <?php echo $_POST['heading']; ?>
            <?php echo $_POST['body']; ?>
        </div>
        <div class="mms-popup_form">
        <?php echo stripslashes($_POST['form']) ?>
        </div>
    </div>
</div>
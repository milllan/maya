<?php

/**
 * Provides a markup for the 'Mayan Sign Detailed Report Graphic representation of your sign' view.
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
<!-- Detailed Report Graph -->
<div class="report_icon-details">
  <div class="report_icon-details-single">
    <p><?php _e('Day Sign:', 'my-mayan-sign'); ?></p>
    <img src="<?php echo $_POST['day_sign']['img']; ?>">
  </div>
  <div class="report_icon-details-single">
    <p><?php _e('Galactic tone:', 'my-mayan-sign'); ?></p>
    <img src="<?php echo $_POST['tone']['core_tone_img_number']; ?>">
  </div>
  <div class="report_icon-details-single">
    <p><?php _e('Trecana sign:', 'my-mayan-sign'); ?></p>
    <img src="<?php echo $_POST['tercana']['img']; ?>">
  </div>
</div>

<div class="center-table report-table influence-off">
  <div class="report-single_icon-heading">
    <h3><?php _e('Tree of Life', 'my-mayan-sign'); ?></h3>
  </div>
  <table>
    <tr class="table-row_details">
      <td></td>
      <td></td>
      <td>
        <div class="report_icon-details-single">
          <p><?php _e('Male', 'my-mayan-sign'); ?></p>
        </div>
      </td>
      <td>
        <div class="report_icon-details-single">
          <p><?php _e('Center', 'my-mayan-sign'); ?></p>
        </div>
      </td>
      <td>
        <div class="report_icon-details-single">
          <p><?php _e('Female', 'my-mayan-sign'); ?></p>
        </div>
      </td>
      <td></td>
      <td></td>
    </tr>
	<?php if($_POST['life_phase'] == 'youth') : ?>
    <tr class="table-row_active">
      <td>
        <span></span>
        <a href="#" class="active-info_btn"></a>
        <div class="active-info_popup">
          <p><?php _e('You are here, at this moment of your life.', 'my-mayan-sign'); ?></p>
        </div>
      </td>
	<?php else: ?>

	<tr>
      <td></td>

	<?php endif; ?>
      <td>
        <div class="report_icon-details-single">
          <p><?php _e('Youth', 'my-mayan-sign'); ?></p>
        </div>
      </td>
      <td class="sign-size_<?php echo $_POST['tone']['youth_male_tone']; ?>">
        <div class="sign-images">
          <div class="sign-images_overlay-wrapper">
            <img class="mymasi_sign_image" src="<?php echo $_POST['youth_male']['img']; ?>">
          </div>
          <img src="<?php echo $_POST['tone']['youth_male_tone_img']; ?>">
        </div>
      </td>
      <td class="sign-size_<?php echo $_POST['tone']['youth_tone']; ?>">
        <div class="sign-images">
          <div class="sign-images_overlay-wrapper">
            <img class="mymasi_sign_image" src="<?php echo $_POST['youth']['img']; ?>">
          </div>
          <img src="<?php echo $_POST['tone']['youth_tone_img']; ?>">
        </div>
      </td>
      <td class="sign-size_<?php echo $_POST['tone']['youth_female_tone']; ?>">
        <div class="sign-images">
          <div class="sign-images_overlay-wrapper">
            <img src="<?php echo $_POST['youth_female']['img']; ?>">
          </div>
            <img src="<?php echo $_POST['tone']['youth_female_tone_img']; ?>">
        </div>
      </td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
	<?php if($_POST['life_phase'] == 'youth_adult' || $_POST['life_phase'] == 'adult') : ?>
    <tr class="table-row_active">
      <td>
        <span></span>
        <a href="#" class="active-info_btn"></a>
        <div class="active-info_popup">
          <p><?php _e('You are here, at this moment of your life.', 'my-mayan-sign'); ?></p>
        </div>
      </td>
	<?php else: ?>

	<tr>
      <td></td>

	<?php endif; ?>

      <td>
        <div class="report_icon-details-single">
          <p><?php _e('Adult', 'my-mayan-sign'); ?></p>
        </div>
      </td>
      <td class="sign-size_<?php echo $_POST['tone']['male_tone']; ?>">
        <div class="sign-images">
          <div class="sign-images_overlay-wrapper">
            <img src="<?php echo $_POST['male']['img']; ?>">
          </div>
          <img src="<?php echo $_POST['tone']['male_tone_img']; ?>">
        </div>
      </td>
      <td class="sign-size_<?php echo $_POST['tone']['core_tone']; ?>">
        <div class="sign-images">
          <div class="sign-images_overlay-wrapper">
            <img src="<?php echo $_POST['day_sign']['img']; ?>">
          </div>
          <img src="<?php echo $_POST['tone']['core_tone_img']; ?>">
        </div>
      </td>
      <td class="sign-size_<?php echo $_POST['tone']['female_tone']; ?>">
        <div class="sign-images">
          <div class="sign-images_overlay-wrapper">
            <img src="<?php echo $_POST['female']['img']; ?>">
          </div>
          <img src="<?php echo $_POST['tone']['female_tone_img']; ?>">
        </div>
      </td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
	<?php if($_POST['life_phase'] == 'adult_mature' || $_POST['life_phase'] == 'mature') : ?>
    <tr class="table-row_active">
      <td>
        <span></span>
        <a href="#" class="active-info_btn"></a>
        <div class="active-info_popup">
          <p><?php _e('You are here, at this moment of your life.', 'my-mayan-sign'); ?></p>
        </div>
      </td>
	<?php else: ?>

	<tr>
      <td></td>

	<?php endif; ?>
      <td>
        <div class="report_icon-details-single">
          <p><?php _e('Mature', 'my-mayan-sign'); ?></p>
        </div>
      </td>
      <td class="sign-size_<?php echo $_POST['tone']['destiny_male_tone']; ?>">
        <div class="sign-images">
          <div class="sign-images_overlay-wrapper">
            <img src="<?php echo $_POST['destiny_male']['img']; ?>">
          </div>
          <img src="<?php echo $_POST['tone']['destiny_male_tone_img']; ?>">
        </div>
      </td>
      <td class="sign-size_<?php echo $_POST['tone']['future_tone']; ?>">
        <div class="sign-images">
          <div class="sign-images_overlay-wrapper">
            <img src="<?php echo $_POST['future']['img']; ?>">
          </div>
          <img src="<?php echo $_POST['tone']['future_tone_img']; ?>">
        </div>
      </td>
      <td class="sign-size_<?php echo $_POST['tone']['destiny_female_tone']; ?>">
        <div class="sign-images">
          <div class="sign-images_overlay-wrapper">
            <img src="<?php echo $_POST['destiny_female']['img']; ?>">
          </div>
          <img src="<?php echo $_POST['tone']['destiny_female_tone_img']; ?>">
        </div>
      </td>
      <td></td>
      <td></td>
    </tr>
  </table>
</div>

<div class="simple-report_right-btn">
  <a href="#" class="report-btn style-switch">
    <div class="btn-tooltip"><?php _e('Lorem ipsum', 'my-mayan-sign'); ?></div>
    <?php _e('Tone Influences Off', 'my-mayan-sign'); ?>
  </a>
  <a href="#" onclick="javascript:printAll('<?php echo $_POST['print_url']; ?>')" class="report-btn print"></a>
</div>


<!--
<input type="button" value="Print" onclick="javascript:printAll('<?php echo $_POST['print_url']; ?>')">
<input type="button" value="Email" onclick="window.location.href = window.location.href + '&pdf=true';">

   -->

<?php require_once(rtrim($_SERVER['DOCUMENT_ROOT'], '/') . '/wp-load.php'); ?>

<!-- Simple Report Graph -->
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
    <tr>
      <td></td>
      <td></td>
      <td class="sign-size_<?php echo $_POST['tone']['youth_male_tone']; ?>">
        <a href="<?php echo $_POST['upgrade_to_detailed']; ?>" class="sign-images">
          <div class="sign-tooltip"><?php _e('Buy Detailed Report', 'my-mayan-sign'); ?></div>
          <div class="sign-images_overlay-wrapper">
            <img class="mymasi_sign_image" src="<?php echo $_POST['youth_male']['img']; ?>">
            <div class="sign-images_overlay"></div>
          </div>
          <img src="<?php echo $_POST['tone']['youth_male_tone_img']; ?>">
        </a>
      </td>
      <td class="sign-size_<?php echo $_POST['tone']['youth_tone']; ?>">
        <a href="<?php echo $_POST['upgrade_to_standard']; ?>" class="sign-images white">
          <div class="sign-tooltip"><?php _e('Buy Standard Report', 'my-mayan-sign'); ?></div>
          <div class="sign-images_overlay-wrapper">
            <img class="mymasi_sign_image" src="<?php echo $_POST['youth']['img']; ?>">
            <div class="sign-images_overlay"></div>
          </div>
          <img src="<?php echo $_POST['tone']['youth_tone_img']; ?>">
        </a>
      </td>
      <td class="sign-size_<?php echo $_POST['tone']['youth_female_tone']; ?>">
        <a href="<?php echo $_POST['upgrade_to_detailed']; ?>" class="sign-images">
          <div class="sign-tooltip"><?php _e('Buy Detailed Report', 'my-mayan-sign'); ?></div>
          <div class="sign-images_overlay-wrapper">
            <img src="<?php echo $_POST['youth_female']['img']; ?>">
            <div class="sign-images_overlay"></div>
          </div>
          <img src="<?php echo $_POST['tone']['youth_female_tone_img']; ?>">
        </a>
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
    <tr class="table-row_active">
      <td></td>
      <td></td>
      <td class="sign-size_<?php echo $_POST['tone']['male_tone']; ?>">
        <a href="<?php echo $_POST['upgrade_to_standard']; ?>" class="sign-images white">
          <div class="sign-tooltip"><?php _e('Buy Standard Report', 'my-mayan-sign'); ?></div>
          <div class="sign-images_overlay-wrapper">
            <img src="<?php echo $_POST['male']['img']; ?>">
            <div class="sign-images_overlay"></div>
          </div>
          <img src="<?php echo $_POST['tone']['male_tone_img']; ?>">
        </a>
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
        <a href="<?php echo $_POST['upgrade_to_standard']; ?>" class="sign-images white">
          <div class="sign-tooltip"><?php _e('Buy Standard Report', 'my-mayan-sign'); ?></div>
          <div class="sign-images_overlay-wrapper">
            <img src="<?php echo $_POST['female']['img']; ?>">
            <div class="sign-images_overlay"></div>
          </div>
          <img src="<?php echo $_POST['tone']['female_tone_img']; ?>">
        </a>
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
    <tr>
      <td></td>
      <td></td>
      <td class="sign-size_<?php echo $_POST['tone']['destiny_male_tone']; ?>">
        <a href="<?php echo $_POST['upgrade_to_detailed']; ?>" class="sign-images">
          <div class="sign-tooltip"><?php _e('Buy Detailed Report', 'my-mayan-sign'); ?></div>
          <div class="sign-images_overlay-wrapper">
            <img src="<?php echo $_POST['destiny_male']['img']; ?>">
            <div class="sign-images_overlay"></div>
          </div>
          <img src="<?php echo $_POST['tone']['destiny_male_tone_img']; ?>">
        </a>
      </td>
      <td class="sign-size_<?php echo $_POST['tone']['future_tone']; ?>">
        <a href="<?php echo $_POST['upgrade_to_standard']; ?>" class="sign-images white">
          <div class="sign-tooltip"><?php _e('Buy Standard Report', 'my-mayan-sign'); ?></div>
          <div class="sign-images_overlay-wrapper">
            <img src="<?php echo $_POST['future']['img']; ?>">
            <div class="sign-images_overlay"></div>
          </div>
          <img src="<?php echo $_POST['tone']['future_tone_img']; ?>">
        </a>
      </td>
      <td class="sign-size_<?php echo $_POST['tone']['destiny_female_tone']; ?>">
        <a href="<?php echo $_POST['upgrade_to_detailed']; ?>" class="sign-images">
          <div class="sign-tooltip"><?php _e('Buy Detailed Report', 'my-mayan-sign'); ?></div>
          <div class="sign-images_overlay-wrapper">
            <img src="<?php echo $_POST['destiny_female']['img']; ?>">
            <div class="sign-images_overlay"></div>
          </div>
          <img src="<?php echo $_POST['tone']['destiny_female_tone_img']; ?>">
        </a>
      </td>
      <td></td>
      <td></td>
    </tr>
  </table>
</div>

<!-- <input type="button" value="Print" onclick="javascript:printAll('<?php echo $_POST['print_url']; ?>')">
<input type="button" value="Email" onclick="window.location.href = window.location.href + '&pdf=true';"> -->

<div class="simple-report_left-btn">
  <a href="<?php echo $_POST['upgrade_to_standard']; ?>" class="report-btn white"><?php _e('Standard Report', 'my-mayan-sign'); ?></a>
  <a href="<?php echo $_POST['upgrade_to_detailed']; ?>" class="report-btn"><?php _e('Detailed Report', 'my-mayan-sign'); ?></a>
</div>
<div class="simple-report_right-btn">
  <a href="#" class="report-btn style-switch">
    <div class="btn-tooltip"><?php _e('Lorem ipsum', 'my-mayan-sign'); ?></div>
    <?php _e('Tone Influences Off', 'my-mayan-sign'); ?>
  </a>
  <a href="#" onclick="javascript:printAll('<?php echo $_POST['print_url']; ?>')" class="report-btn print"></a>
</div>

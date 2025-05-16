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
<!-- Calculator Report Graph -->
<div class="calculator_graph">
  <div class="report-single_icon-heading">
    <h3><?php _e('Tree of Life', 'my-mayan-sign'); ?></h3>
  </div>
  <table>
    <tr class="<?php if($_POST['life_phase'] == 'youth') echo 'table-row_active'?>">



      <td class="sign-size_">
        <?php //if ( get_field('first_sign', 'options') ) : ?>
         <a href="<?php echo get_field('first_sign', 'options'); ?>">              
            <div class="sign-images">
              <div class="sign-images_overlay-wrapper">
                <img class="mymasi_sign_image" src="<?php echo $_POST['youth_male']['img']; ?>">
                <div class="sign-images_overlay"></div>
              </div>
              <img src="<?php echo $_POST['tone']['youth_male_tone_img_abs']; ?>">
            </div>
          </a>
        <?php //endif; ?>              
      </td>


      <td class="sign-size_">
        <?php //if ( get_field('second_sign', 'options') ) : ?>
          <a href="<?php echo get_field('second_sign', 'options'); ?>">           
            <div class="sign-images">
              <div class="sign-images_overlay-wrapper">
                <img class="mymasi_sign_image" src="<?php echo $_POST['youth']['img']; ?>">
                <div class="sign-images_overlay"></div>
              </div>
              <img src="<?php echo $_POST['tone']['youth_tone_img_abs']; ?>">
            </div>
          </a>
        <?php //endif; ?>            
      </td>

      <td class="sign-size_">
      <?php //if ( get_field('third_sign', 'options') ) : ?>
         <a href="<?php echo get_field('third_sign', 'options'); ?>">          
            <div class="sign-images">
              <div class="sign-images_overlay-wrapper">
                <img src="<?php echo $_POST['youth_female']['img']; ?>">
                <div class="sign-images_overlay"></div>
              </div>
                <img src="<?php echo $_POST['tone']['youth_female_tone_img_abs']; ?>">
            </div>
          </a>
        <?php //endif; ?>           
      </td>

      <td></td>
      <td></td>
    </tr>
    <tr class="empty">
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr class="<?php if($_POST['life_phase'] == 'youth_adult') echo 'table-row_active'?>">

      <td class="sign-size_">
        <?php //if ( get_field('fourth_sign', 'options') ) : ?>
          <a href="<?php echo get_field('fourth_sign', 'options'); ?>">           
            <div class="sign-images">
              <div class="sign-images_overlay-wrapper">
                <img src="<?php echo $_POST['male']['img']; ?>">
                <div class="sign-images_overlay"></div>
              </div>
              <img src="<?php echo $_POST['tone']['male_tone_img_abs']; ?>">
            </div>
          </a>
        <?php //endif; ?>           
      </td>

      <td class="sign-size_">
        <?php //if ( get_field('fifth_sign', 'options') ) : ?>
          <a href="<?php echo get_field('fifth_sign', 'options'); ?>">                
            <div class="sign-images">
              <div class="sign-images_overlay-wrapper">
                <img src="<?php echo $_POST['day_sign']['img']; ?>">
              </div>
              <img src="<?php echo $_POST['tone']['core_tone_img_abs']; ?>">
            </div>
          </a>
        <?php //endif; ?>          
      </td>

      <td class="sign-size_">
        <?php //if ( get_field('sixth_sign', 'options') ) : ?>
          <a href="<?php echo get_field('sixth_sign', 'options'); ?>">               
              <div class="sign-images">
                <div class="sign-images_overlay-wrapper">
                  <img src="<?php echo $_POST['female']['img']; ?>">
                  <div class="sign-images_overlay"></div>
                </div>
                <img src="<?php echo $_POST['tone']['female_tone_img_abs']; ?>">
              </div>
          </a>
        <?php //endif; ?>           
      </td>

      <td></td>
      <td></td>
    </tr>
    <tr class="empty">
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr class="<?php if($_POST['life_phase'] == 'adult_mature') echo 'table-row_active'?>">

      <td class="sign-size_">
        <?php //if ( get_field('seventh_sign', 'options') ) : ?>
          <a href="<?php echo get_field('seventh_sign', 'options'); ?>">           
            <div class="sign-images">
              <div class="sign-images_overlay-wrapper">
                <img src="<?php echo $_POST['destiny_male']['img']; ?>">
                <div class="sign-images_overlay"></div>
              </div>
              <img src="<?php echo $_POST['tone']['destiny_male_tone_img_abs']; ?>">
            </div>
          </a>
        <?php //endif; ?>        
      </td>

      <td class="sign-size_">
      <?php //if ( get_field('eighth_sign', 'options') ) : ?>
          <a href="<?php echo get_field('eighth_sign', 'options'); ?>">          
        <div class="sign-images">
          <div class="sign-images_overlay-wrapper">
            <img src="<?php echo $_POST['future']['img']; ?>">
			<div class="sign-images_overlay"></div>
          </div>
          <img src="<?php echo $_POST['tone']['future_tone_img_abs']; ?>">
        </div>
        </a>
        <?php //endif; ?>          
      </td>

      <td class="sign-size_">
        <?php //if ( get_field('ninth_sign', 'options') ) : ?>
          <a href="<?php echo get_field('ninth_sign', 'options'); ?>">          
            <div class="sign-images">
              <div class="sign-images_overlay-wrapper">
                <img src="<?php echo $_POST['destiny_female']['img']; ?>">
                <div class="sign-images_overlay"></div>
              </div>
              <img src="<?php echo $_POST['tone']['destiny_female_tone_img_abs']; ?>">
            </div>
          </a>
        <?php //endif; ?>          
      </td>

      <td></td>
      <td></td>
    </tr>
  </table>
</div>

<?php

/**
 * Provides a markup for the 'Mayan Sign Four Directions' view.
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
<br><br>

<input type="button" value="Print" onclick="javascript:printAll('<?php echo $_POST['print_url']; ?>')">
<input type="button" value="Email" onclick="window.location.href = window.location.href + '?pdf=true';">



  <table style="width:500px">
  <tr>
    <td class="mymasi_sign_image_size_1 mymasi_hidden">
      <img class="mymasi_sign_image" src="<?php echo $_POST['youth_male']['img']; ?>">
      <img src="<?php echo $_POST['tone']['youth_male_tone_img']; ?>">
    </td>
    <td class="mymasi_sign_image_size_2">
      <img class="mymasi_sign_image" src="<?php echo $_POST['youth']['img']; ?>">
      <img src="<?php echo $_POST['tone']['youth_tone_img']; ?>">
    </td>
    <td class="mymasi_hidden">
      <img src="<?php echo $_POST['youth_female']['img']; ?>">
      <img src="<?php echo $_POST['tone']['youth_female_tone_img']; ?>">
    </td>
  </tr>
  <tr>
    <td style="width:200px">
      <img src="<?php echo $_POST['male']['img']; ?>">
      <img src="<?php echo $_POST['tone']['male_tone_img']; ?>">
    </td>
    <td style="width:200px">
      <img src="<?php echo $_POST['day_sign']['img']; ?>">
      <img src="<?php echo $_POST['tone']['core_tone_img']; ?>">
    </td>
    <td style="width:200px">
      <img src="<?php echo $_POST['female']['img']; ?>">
      <img src="<?php echo $_POST['tone']['female_tone_img']; ?>">
    </td>
  </tr>
  <tr>
    <td class="mymasi_hidden">
      <img src="<?php echo $_POST['destiny_male']['img']; ?>">
      <img src="<?php echo $_POST['tone']['destiny_male_tone_img']; ?>">
    </td>
    <td>
      <img src="<?php echo $_POST['future']['img']; ?>">
      <img src="<?php echo $_POST['tone']['future_tone_img']; ?>">
    </td>
    <td class="mymasi_hidden">
      <img src="<?php echo $_POST['destiny_female']['img']; ?>">
      <img src="<?php echo $_POST['tone']['destiny_female_tone_img']; ?>">
    </td>
  </tr>
</table>


<h2><?php _e('Your Youth Sign', 'my-mayan-sign'); ?></h2>

<h3><?php echo $_POST['youth']['title']; ?></h3>
<img src="<?php echo $_POST['youth']['img']; ?>">
<p><?php echo $_POST['youth']['content']; ?></p>

<h2><?php _e('Your Future Sign', 'my-mayan-sign'); ?></h2>

<h3><?php echo $_POST['future']['title']; ?></h3>
<img src="<?php echo $_POST['future']['img']; ?>">
<p><?php echo $_POST['future']['content']; ?></p>

<h2><?php _e('Your Male Sign', 'my-mayan-sign'); ?></h2>

<h3><?php echo $_POST['male']['title']; ?></h3>
<img src="<?php echo $_POST['male']['img']; ?>">
<p><?php echo $_POST['male']['content']; ?></p>

<h2><?php _e('Your Female Sign', 'my-mayan-sign'); ?></h2>

<h3><?php echo $_POST['female']['title']; ?></h3>
<img src="<?php echo $_POST['female']['img']; ?>">
<p><?php echo $_POST['female']['content']; ?></p>

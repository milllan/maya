<?php require_once(rtrim($_SERVER['DOCUMENT_ROOT'], '/') . '/wp-load.php'); 
$_POST = stripslashes_deep( $_POST ); ?>

<div class="back-button">
  <a href="<?php echo $_POST['url'] ?>"><span><?php _e('Back to My Reports', 'my-mayan-sign'); ?></span></a>
</div>

<div class="report-single_main-heading">
  <p>
    <?php echo $_POST['static_text']['four_directions']['text']; ?>
  </p>
</div>

<div class="report-single">
  <div class="report-single_heading">
    <img src="<?php echo $_POST['youth']['img']; ?>">
    <h2><?php _e('Your Youth Sign - ', 'my-mayan-sign'); ?><?php echo $_POST['youth']['title']; ?></h2>
  </div>
  <p><?php echo $_POST['youth']['content']; ?></p>
</div>

<div class="report-single">
  <div class="report-single_heading">
    <img src="<?php echo $_POST['tone']['youth_tone_txt']['img']; ?>">
    <h2><?php _e('Your Youth Tone -', 'my-mayan-sign'); ?><?php echo $_POST['tone']['youth_tone_txt']['title']; ?></h2>
  </div>
  <p><?php echo $_POST['tone']['youth_tone_txt']['content']; ?></p>
</div>

<div class="report-single">
  <div class="report-single_heading">
    <img src="<?php echo $_POST['future']['img']; ?>">
    <h2><?php _e('Your Mature Sign - ', 'my-mayan-sign'); ?><?php echo $_POST['future']['title']; ?></h2>
  </div>
  <p><?php echo $_POST['future']['content']; ?></p>
</div>

<div class="report-single">
  <div class="report-single_heading">
    <img src="<?php echo $_POST['tone']['future_tone_txt']['img']; ?>">
    <h2><?php _e('Your Mature Tone - ', 'my-mayan-sign'); ?><?php echo $_POST['tone']['future_tone_txt']['title']; ?></h2>
  </div>
  <p><?php echo $_POST['tone']['future_tone_txt']['content']; ?></p>
</div>

<div class="report-single_main-heading">
	<h2><?php _e('Male and Female Signs', 'my-mayan-sign'); ?></h2>
	<p>
		<?php echo $_POST['static_text']['four_directions_male_female_text']['text']; ?>
	</p>
</div>

<div class="report-single">
  <div class="report-single_heading">
    <img src="<?php echo $_POST['male']['img']; ?>">
    <h2><?php _e('Your Male Sign - ', 'my-mayan-sign'); ?><?php echo $_POST['male']['title']; ?></h2>
  </div>
  <p><?php echo $_POST['male']['minor_text']; ?></p>
</div>

<div class="report-single">
  <div class="report-single_heading">
    <img src="<?php echo $_POST['tone']['male_tone_txt']['img']; ?>">
    <h2><?php _e('Your Male Tone - ', 'my-mayan-sign'); ?><?php echo $_POST['tone']['male_tone_txt']['title']; ?></h2>
  </div>
  <p><?php echo $_POST['tone']['male_tone_txt']['minor_text']; ?></p>
</div>

<div class="report-single">
  <div class="report-single_heading">
    <img src="<?php echo $_POST['female']['img']; ?>">
    <h2><?php _e('Your Female Sign - ', 'my-mayan-sign'); ?><?php echo $_POST['female']['title']; ?></h2>
  </div>
  <p><?php echo $_POST['female']['minor_text']; ?></p>
</div>

<div class="report-single">
  <div class="report-single_heading">
    <img src="<?php echo $_POST['tone']['female_tone_txt']['img']; ?>">
    <h2><?php _e('Your Female Tone - ', 'my-mayan-sign'); ?><?php echo $_POST['tone']['female_tone_txt']['title']; ?></h2>
  </div>
  <p><?php echo $_POST['tone']['female_tone_txt']['minor_text']; ?></p>
</div>

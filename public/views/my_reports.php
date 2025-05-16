<?php
require_once(rtrim($_SERVER['DOCUMENT_ROOT'], '/') . '/wp-load.php');
foreach ($_POST['reports'] as $report) { ?>

  <div class="report">
    <div class="report_image">
      <img src='<?php echo $report['thumb'] ?>' />
    </div>
    <div class="report_text">
      <h2><?php echo $report['name']?></h2>
      <?php if($report['date'] != ''){ ?>
      <div class="report_price">
      </div>

      <ul class="report_list">
        <li>
          <p><span><?php _e('Birthday: ', 'my-mayan-sign'); ?></span><?php echo $report['date_formated']?></p>
        </li>
        <li>
          <p><span><?php _e('Day Sign: ', 'my-mayan-sign'); ?></span><?php echo $report['day_sign']?></p>
        </li>
        <li>
          <p><span><?php _e('Galactic Tone: ', 'my-mayan-sign'); ?></span><?php echo $report['galactic_tone']?></p>
        </li>
        <li>
          <p><span><?php _e('Tercana Sign: ', 'my-mayan-sign'); ?></span><?php echo $report['trecana_sign']?></p>
        </li>
      </ul>

      <a href="<?php echo $report['report_url']?>"><?php _e('Read The Report', 'my-mayan-sign'); ?></a><br><br>
      <?php } else { ?>
      <a href="#" id="<?php echo $report['id']?>" class="mms-popup_btn2"><?php _e('Set the Date of Birth', 'my-mayan-sign'); ?></a>
      <?php 
      } ?>

    </div>
  </div>

  <?php } ?>

	<script>
		jQuery('.mms-popup_btn2').on('click', function(event) {

			jQuery( "#add_report_id" ).remove();
		jQuery( "#add_report_url" ).remove();

		jQuery( "#mms_calculator_form" ).append( '<input style="visibility: hidden;" type="text" id ="add_report_id" name="id" value="'+event.target.id+'"></input>' );
		jQuery( "#mms_calculator_form" ).append( '<input style="visibility: hidden;" type="text" id ="add_report_url" name="url" value="<?php echo $report['report_url']; ?>"></input>' );
		var postURL = '<?php echo get_site_url() . '/update-report'; ?>';
		jQuery('#mms_calculator_form').attr('action', postURL );

		jQuery(function() {
      jQuery("#year").val('<?php echo isset($_POST['year']) ? $_POST['year'] : ''; ?>');
      jQuery("#month").val('<?php echo isset($_POST['month']) ? $_POST['month'] : ''; ?>');
      jQuery("#day").val('<?php echo isset($_POST['day']) ? $_POST['day'] : ''; ?>');

		});

		jQuery('body').toggleClass('popup-open');
		if (jQuery('body').hasClass('popup-open')) {
		jQuery('.mms-popup_close').on('click', function() {
			jQuery('body').removeClass('popup-open');
		});
		}
	});
	</script>

  
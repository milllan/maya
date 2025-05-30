<?php

/**
 * Provides a markup for the 'Mayan Sign Calculator' view.
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
$_POST = stripslashes_deep($_POST); ?>

<div class="calculator-page">
	<div class="report-calculator-preview">
		<div class="col1">
			<div class="vc_row">
				<div class="report_icon-details-single">
					<a href="#day-sign">
						<h4>
							<?php _e('Day Sign', 'my-mayan-sign'); ?>
						</h4>
					</a>
					<a href="#day-sign" class="link-image" title="Click to Read">
						<img src="<?php echo $_POST['day_sign']['img']; ?>">
					</a>
				</div>
				<div class="report_icon-details-single">
					<a href="#tone">
						<h4>
							<?php _e('Galactic Tone', 'my-mayan-sign'); ?>
						</h4>
					</a>
					<a href="#tone" class="link-image" title="Click to Read">
						<img src="<?php echo $_POST['tone']['core_tone_img_number_f']; ?>">
					</a>
				</div>
				<div class="report_icon-details-single">
					<a href="#tercana">
						<h4>
							<?php _e('Trecana Sign', 'my-mayan-sign'); ?>
						</h4>
					</a>
					<a href="#tercana" class="link-image" title="Click to Read">
						<img src="<?php echo $_POST['tercana']['img']; ?>">
					</a>
				</div>
			</div>
			<div class="vc_row">
				<?php if ($_POST['is_user_logged_in'] == 0) : ?>
				<p class="please-register-msg">
					<?php //_e(sprintf('We want to know a little bit more about you before checking the Mayan Signs of people around you. Would you please kindly <a href="%s">register here</a>.', get_home_url() . "/login/?re=mayan-sign-calculator"), 'my-mayan-sign'); ?>
				</p>
				<?php endif; ?>
				<?php echo mymasi_calculator_select($_POST); ?>
			</div>
		</div>
		<div class="col2" id="tree_of_life">
			<!-- <a href="<?php //echo $_POST['shop_url']; ?>"> -->
				<?php include 'reports/calculator_graph.php'; ?>
			<!-- </a> -->
		</div>
	</div>

	<!-- ---------------------------------------------------- -->

	<div id="day-sign" class="report-single_main-heading">
		<h2>
			<?php _e('Your Day Sign', 'my-mayan-sign'); ?>
		</h2>
	</div>

	<div class="report-single">
		<div class="report-single_heading">
			<img src="<?php echo $_POST['day_sign']['img']; ?>">
			<h2>
				<?php echo $_POST['day_sign']['title']; ?>
			</h2>
		</div>
		<p>
			<?php echo $_POST['day_sign']['content']; ?>
		</p>
	</div>

	<div class="calc_cta"  id="calc_cta_first">
		<p>
			<?php echo $_POST['static_text']['calc_cta']['text']; ?>
			<?php echo $_POST['link_to_shop']; ?>
		</p>
	</div>

	<div id="intro" class="report-intro">
		<p>
			<?php echo $_POST['static_text']['core']['text']; ?>
		</p>
	</div>

	<div id="tone" class="report-single_main-heading">
		<h2>
			<?php _e('Your Tone', 'my-mayan-sign'); ?>
		</h2>
	</div>

	<div class="report-single">
		<div class="report-single_heading">
			<img src="<?php echo $_POST['tone']['core_tone_img_abs']; ?>">
			<h2>
				<?php echo $_POST['tone']['core_tone_txt']['title']; ?>
			</h2>
		</div>
		<p>
			<?php echo $_POST['tone']['content']; ?>
		</p>
	</div>

	<div id="tercana" class="report-single_main-heading">
		<h2>
			<?php _e('Your Trecana Sign', 'my-mayan-sign'); ?>
		</h2>
	</div>

	<div class="report-single">
		<div class="report-single_heading">
			<img src="<?php echo $_POST['tercana']['img']; ?>">
			<h2>
				<?php echo $_POST['tercana']['title']; ?>
			</h2>
		</div>
		<p>
			<?php echo $_POST['tercana']['content']; ?>
		</p>
	</div>

	<div class="calc_cta" id="calc_cta_latest">
		<p>
			<?php echo $_POST['static_text']['calc_cta']['text']; ?>
			<?php echo $_POST['link_to_shop']; ?>
		</p>
	</div>
</div>
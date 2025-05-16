<?php

/**
 * Provides a markup for the 'Mayan Sign standard pdf.
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

$logo = NorebroSettings::get_logo(); ?>

<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<style>
		.report-single {
			padding: 40px 0;
		}

		h2,
		h3 {
			color: #404044
		}

		p {
			color: #242424 !important;
			font-family: 'DejaVu Sans', sans-serif;
		}

		.report-single_main-heading h2,
		.report-single .report-single_heading h2 {
			font-family: 'DejaVu Sans', sans-serif;
			font-size: 26px;
			font-weight: 600;
		}

		.report-single_main-heading h2 {
			background-color: #f0e5bb;
			margin: 0;
			padding: 1em;
			border-left: 10px solid rgba(233, 192, 27, 0.2);
		}

		.report-single .report-single_heading h2 {
			display: inline-block;
			vertical-align: top;
			line-height: 29px;
			margin: 0;
			padding-top: 15px;
			padding-left: 1em;
		}

		.report-single .report-single_heading img {
			height: 100px;
			display: inline-block;
		}

		.report-single p,
		.report-single div,
		.report-single_main-heading p,
		.report-footer {
			font-family: 'DejaVu Sans', sans-serif;
			font-size: 16px;
		}

		/* ---------------------------------- */
		.report_icon-details {
			background-color: #F8F6EC;
			padding: 20px 20px 0;
		}

		.report_icon-details-single {
			display: inline-block;
			width: 33%;
			text-align: center;
		}

		.report_icon-details .report_icon-details-single{
			padding: 20px 0 0;
		}

		.report_icon-details-single p,
		.report_icon-details-single-inner p,
		.report_icon-details-single-label {
			text-align: center;
			font-family: 'DejaVu Sans', sans-serif;
			font-weight: 600;
		}

		.report_icon-details-single-label{
			line-height: 2em;
		}

		.report_icon-details-single img {
			max-width: 80px;
		}

		.report-table {
			background-color: #f1efe4;
			/* padding-top: 35px; */
			padding-bottom: 35px;
		}

		.report-table h3 {
			margin-block-start: 0;
			font-family: 'DejaVu Sans', sans-serif;
			font-size: 26px;
			font-weight: 600;
			text-align: center;
		}

		.report-table-inner {
			width: 100%;
			margin-left: 5px;
			border-collapse: collapse;
		}

		.report-table-inner .report_icon-details-single {
			width: auto;
		}

		.report-table-inner .sign-images {
			width: 56px;
			text-align: center;
			margin-left: auto;
			margin-right: auto;
			display: block;
		}

		.report-table-inner .sign-images .sign-images_overlay-wrapper {
			width: 56px;
		}

		.report-table-inner .sign-images img {
			width: 56px;
			display: block;
		}

		.report-table-inner .sign-images .sign-images_overlay-wrapper img {
			width: 100%;
		}

		.report-table-inner tr:nth-child(3),
		.report-table-inner tr:nth-child(5) {
			height: 60px;
			border: none;
		}

		.active-info_popup p {
			font-family: 'DejaVu Sans', sans-serif;
			font-size: 12px;
			font-weight: 500;
			padding-left: 20px;
		}

		/* .report-table-inner .table-row_active {
	background: #f0e5bb;
}

.report-table-inner .table-row_active td:first-child {
	border-left: 10px solid #e9c01b;
	height: 116px;
}

.report-table-inner tr td:first-child {
	border-left: 10px solid #f0e5bb;
}

.report-table-inner tr:nth-child(1) td:first-child,
.report-table-inner tr:nth-child(3) td:first-child,
.report-table-inner tr:nth-child(5) td:first-child {
	border-left: 10px solid #f0e5bb;
} */

		.report-table-inner tr {
			height: 80px;
		}

		.spacing {
			height: 60px;
		}

		.treeOfLife-wrapper {
			padding-bottom: 50px;
		}

		.center-table.report-table table .table-row_active td {
			width: 14.286%
		}

		.center-table.report-table table .table-row_active td:first-child span {
			display: block;
			padding: 5px 20px 0 5px;
		}

		.report-header,
		.report-footer {
			text-align: center;
			padding: 15px
		}

		.report-header a {
			display: block;
			width: 144px;
			margin: 0 auto;
		}

		.report-footer {
			background-color: #f8f6ec;
		}

		/* ------------------ */

		.report-upgrade-wrapper {
			padding-bottom: 40px;
			text-align: center;
		}

		.report-upgrade-wrapper p {
			max-width: 700px;
			margin: 0 auto;
		}

		.upgrade-button-wrapper {
			padding-top: 40px;
		}

		.upgrade-button {
			font-family: 'DejaVu Sans', sans-serif;
			font-size: 16px;
			font-weight: 600;
			color: #242424;
			display: inline-block;
			width: 300px;
			padding: 15px 20px;
			background-color: #e9c01b;
			border-radius: 10px;
			margin: 0 auto;
		}

		.sign-images .sign-images_overlay {
			opacity: 0.5;
		}
	</style>
</head>

<body>
	<div class="report-header">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" target="_blank" rel="My Mayan Sign">
			<img src="<?php echo $logo['default'] ?>" />
		</a>
	</div>
	<!-- Detailed Report Graph -->
	<div class="treeOfLife-wrapper">
		<div class="report_icon-details">
			<div class="report_icon-details-single">
				<div class="report_icon-details-single-label">
					<?php _e('Day Sign:', 'my-mayan-sign'); ?>
				</div>
				<div class="report_icon-details-single-image">
					<img src="<?php echo $_POST['day_sign']['img']; ?>">
				</div>
			</div>
			<div class="report_icon-details-single">
				<div class="report_icon-details-single-label">
					<?php _e('Galactic tone:', 'my-mayan-sign'); ?>
				</div>
				<div class="report_icon-details-single-image">
					<img src="<?php echo $_POST['tone']['core_tone_img_number_f']; ?>">
				</div>
			</div>
			<div class="report_icon-details-single">
				<div class="report_icon-details-single-label">
					<?php _e('Trecana sign:', 'my-mayan-sign'); ?>
				</div>
				<div class="report_icon-details-single-image">
					<img src="<?php echo $_POST['tercana']['img']; ?>">
				</div>
			</div>
		</div>

		<div class="center-table report-table ">
			<div class="report-single_icon-heading">
				<h3>
					<?php _e('Tree of Life', 'my-mayan-sign'); ?>
				</h3>
			</div>
			<table class="report-table-inner">
				<tr class="table-row_details">
					<td></td>
					<td></td>
					<td>
						<div class="report_icon-details-single-inner">
							<p>
								<?php _e('Male', 'my-mayan-sign'); ?>
							</p>
						</div>
					</td>
					<td>
						<div class="report_icon-details-single-inner">
							<p>
								<?php _e('Center', 'my-mayan-sign'); ?>
							</p>
						</div>
					</td>
					<td>
						<div class="report_icon-details-single-inner">
							<p>
								<?php _e('Female', 'my-mayan-sign'); ?>
							</p>
						</div>
					</td>

				</tr>
				<tr class="<?php if($_POST['life_phase'] == 'youth' || $_POST['life_phase'] == 'youth_adult') echo 'table-row_active'?>">
					<td></td>
					<td>
						<div class="report_icon-details-single">
							<!-- <p><?php _e('Youth', 'my-mayan-sign'); ?></p> -->
						</div>
					</td>
					<td class="sign-size_<?php echo $_POST['tone']['youth_male_tone']; ?>">
						<a href="<?php echo $_POST['upgrade_to_detailed']; ?>" target="_blank" class="sign-images">
							<div class="sign-images_overlay-wrapper">
								<img class="mymasi_sign_image sign-images_overlay" src="<?php echo $_POST['youth_male']['img']; ?>">
								<img src="<?php echo $_POST['tone']['youth_male_tone_img_abs']; ?>">
							</div>
						</a>
					</td>
					<td class="sign-size_<?php echo $_POST['tone']['youth_tone']; ?>">
						<div class="sign-images">
							<div class="sign-images_overlay-wrapper">
								<img class="mymasi_sign_image" src="<?php echo $_POST['youth']['img']; ?>">
								<img src="<?php echo $_POST['tone']['youth_tone_img_abs']; ?>">
							</div>
						</div>
					</td>
					<td class="sign-size_<?php echo $_POST['tone']['youth_female_tone']; ?>">
						<a href="<?php echo $_POST['upgrade_to_detailed']; ?>" target="_blank" class="sign-images">
							<div class="sign-images_overlay-wrapper">
								<img class="mymasi_sign_image sign-images_overlay" src="<?php echo $_POST['youth_female']['img']; ?>">
								<img src="<?php echo $_POST['tone']['youth_female_tone_img_abs']; ?>">
							</div>
						</a>
					</td>

				</tr>
				<tr>
					<td>
						<div class="spacing"></div>
					</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr class="<?php if($_POST['life_phase'] == 'youth_adult' || $_POST['life_phase'] == 'adult') echo 'table-row_active'?>">
					<td></td>
					<td>
						<div class="report_icon-details-single">
							<!-- <p><?php _e('Adult', 'my-mayan-sign'); ?></p> -->
						</div>
					</td>
					<td class="sign-size_<?php echo $_POST['tone']['male_tone']; ?>">
						<div class="sign-images">
							<div class="sign-images_overlay-wrapper">
								<img src="<?php echo $_POST['male']['img']; ?>">
								<img src="<?php echo $_POST['tone']['male_tone_img_abs']; ?>">
							</div>
						</div>
					</td>
					<td class="sign-size_<?php echo $_POST['tone']['core_tone']; ?>">
						<div class="sign-images">
							<div class="sign-images_overlay-wrapper">
								<img src="<?php echo $_POST['day_sign']['img']; ?>">
								<img src="<?php echo $_POST['tone']['core_tone_img_abs']; ?>">
							</div>
						</div>
					</td>
					<td class="sign-size_<?php echo $_POST['tone']['female_tone']; ?>">
						<div class="sign-images">
							<div class="sign-images_overlay-wrapper">
								<img src="<?php echo $_POST['female']['img']; ?>">
								<img src="<?php echo $_POST['tone']['female_tone_img_abs']; ?>">
							</div>
						</div>
					</td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td>
						<div class="spacing"></div>
					</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr class="<?php if($_POST['life_phase'] == 'adult_mature' || $_POST['life_phase'] == 'mature') echo 'table-row_active'?>">
					<td></td>
					<td>
						<div class="report_icon-details-single">
							<!-- <p><?php _e('Mature', 'my-mayan-sign'); ?></p>	 -->
						</div>
					</td>
					<td class="sign-size_<?php echo $_POST['tone']['destiny_male_tone']; ?>">
						<a href="<?php echo $_POST['upgrade_to_detailed']; ?>" target="_blank" class="sign-images">
							<div class="sign-images_overlay-wrapper">
								<img class="mymasi_sign_image sign-images_overlay" src="<?php echo $_POST['destiny_male']['img']; ?>">
								<img src="<?php echo $_POST['tone']['destiny_male_tone_img_abs']; ?>">
							</div>
						</a>
					</td>
					<td class="sign-size_<?php echo $_POST['tone']['future_tone']; ?>">
						<div class="sign-images">
							<div class="sign-images_overlay-wrapper">
								<img src="<?php echo $_POST['future']['img']; ?>">
								<img src="<?php echo $_POST['tone']['future_tone_img_abs']; ?>">
							</div>
						</div>
					</td>
					<td class="sign-size_<?php echo $_POST['tone']['destiny_female_tone']; ?>">
						<a href="<?php echo $_POST['upgrade_to_detailed']; ?>" target="_blank" class="sign-images">
							<div class="sign-images_overlay-wrapper">
								<img class="mymasi_sign_image sign-images_overlay" src="<?php echo $_POST['destiny_female']['img']; ?>">
								<img src="<?php echo $_POST['tone']['destiny_female_tone_img_abs']; ?>">
							</div>
						</a>
					</td>
					<td></td>
					<td></td>
				</tr>
			</table>
		</div>
	</div>

	<!-- ----------------------------------------------------------------- -->

	<div class="report-upgrade-wrapper">
		<p>
			<?php echo $_POST['static_text']['pdf_cta']['text']; ?>
		</p>
		<p class="upgrade-button-wrapper">
			<a href="<?php echo $_POST['upgrade_to_detailed']; ?>" target="_blank" class="upgrade-button">
				<?php _e('Upgrade to Detailed report', 'my-mayan-sign'); ?>
			</a>
		</p>
	</div>

	<!-- ----------------------------------------------------------------- -->

	<div class="report-single_main-heading">
		<h2>
			<?php echo wp_sprintf('Dear %s',  $_POST['user_name'] ); ?>
		</h2>
		<p>
			<?php echo $_POST['static_text']['core']['text']; ?>
		</p>
	</div>
	<!-- ----------------------------------------------------------------- -->
	<div class="report-single_main-heading">
		<h2>
			<?php _e('Core Sign', 'my-mayan-sign'); ?>
		</h2>
	</div>

	<div class="report-single">
		<div class="report-single_heading">
			<img src="<?php echo $_POST['day_sign']['img']; ?>">
			<h2>
				<?php _e('Your Day Sign - ', 'my-mayan-sign'); ?>
				<?php echo $_POST['day_sign']['title']; ?>
			</h2>
		</div>
		<p>
			<?php echo $_POST['day_sign']['content']; ?>
		</p>
	</div>

	<div class="report-single">
		<div class="report-single_heading">
			<img src="<?php echo $_POST['tone']['core_tone_img_number_f']; ?>">
			<h2>
				<?php _e('Your Galactic Tone - ', 'my-mayan-sign'); ?>
				<?php echo $_POST['tone']['core_tone_txt']['title']; ?>
			</h2>
		</div>
		<p>
			<?php echo $_POST['tone']['core_tone_txt']['minor_text']; ?>
		</p>
	</div>

	<div class="report-single">
		<div class="report-single_heading">
			<img src="<?php echo $_POST['tercana']['img']; ?>">
			<h2>
				<?php _e('Your Trecana Sign - ', 'my-mayan-sign'); ?>
				<?php echo $_POST['tercana']['title']; ?>
			</h2>
		</div>
		<p>
			<?php echo $_POST['tercana']['minor_text']; ?>
		</p>
	</div>

	<!-- ----------------------------------------------------------------- -->

	<div class="report-single_main-heading">
		<h2>
			<?php _e('Four Directions', 'my-mayan-sign'); ?>
		</h2>
		<p>
			<?php echo $_POST['static_text']['four_directions']['text']; ?>
		</p>
	</div>

	<div class="report-single">
		<div class="report-single_heading">
			<img src="<?php echo $_POST['youth']['img']; ?>">
			<h2>
				<?php _e('Your Youth Sign - ', 'my-mayan-sign'); ?>
				<?php echo $_POST['youth']['title']; ?>
			</h2>
		</div>
		<p>
			<?php echo $_POST['youth']['content']; ?>
		</p>
	</div>

	<div class="report-single">
		<div class="report-single_heading">
			<img src="<?php echo $_POST['tone']['youth_tone_txt']['img']; ?>">
			<h2>
				<?php _e('Your Youth Tone - ', 'my-mayan-sign'); ?>
				<?php echo $_POST['tone']['youth_tone_txt']['title']; ?>
			</h2>
		</div>
		<p>
			<?php echo $_POST['tone']['youth_tone_txt']['content']; ?>
		</p>
	</div>

	<div class="report-single">
		<div class="report-single_heading">
			<img src="<?php echo $_POST['future']['img']; ?>">
			<h2>
				<?php _e('Your Mature Sign - ', 'my-mayan-sign'); ?>
				<?php echo $_POST['future']['title']; ?>
			</h2>
		</div>
		<p>
			<?php echo $_POST['future']['content']; ?>
		</p>
	</div>

	<div class="report-single">
		<div class="report-single_heading">
			<img src="<?php echo $_POST['tone']['future_tone_txt']['img']; ?>">
			<h2>
				<?php _e('Your Mature Tone - ', 'my-mayan-sign'); ?>
				<?php echo $_POST['tone']['future_tone_txt']['title']; ?>
			</h2>
		</div>
		<p>
			<?php echo $_POST['tone']['future_tone_txt']['content']; ?>
		</p>
	</div>

	<div class="report-single_main-heading">
		<h2>
			<?php _e('Male and Female Signs', 'my-mayan-sign'); ?>
		</h2>
		<p>
			<?php echo $_POST['static_text']['four_directions_male_female_text']['text']; ?>
		</p>
	</div>

	<div class="report-single">
		<div class="report-single_heading">
			<img src="<?php echo $_POST['male']['img']; ?>">
			<h2>
				<?php _e('Your Male Sign - ', 'my-mayan-sign'); ?>
				<?php echo $_POST['male']['title']; ?>
			</h2>
		</div>
		<p>
			<?php echo $_POST['male']['minor_text']; ?>
		</p>
	</div>

	<div class="report-single">
		<div class="report-single_heading">
			<img src="<?php echo $_POST['tone']['male_tone_txt']['img']; ?>">
			<h2>
				<?php _e('Your Male Tone - ', 'my-mayan-sign'); ?>
				<?php echo $_POST['tone']['male_tone_txt']['title']; ?>
			</h2>
		</div>
		<p>
			<?php echo $_POST['tone']['male_tone_txt']['minor_text']; ?>
		</p>
	</div>

	<div class="report-single">
		<div class="report-single_heading">
			<img src="<?php echo $_POST['female']['img']; ?>">
			<h2>
				<?php _e('Your Female Sign - ', 'my-mayan-sign'); ?>
				<?php echo $_POST['female']['title']; ?>
			</h2>
		</div>
		<p>
			<?php echo $_POST['female']['minor_text']; ?>
		</p>
	</div>

	<div class="report-single">
		<div class="report-single_heading">
			<img src="<?php echo $_POST['tone']['female_tone_txt']['img']; ?>">
			<h2>
				<?php _e('Your Female Tone - ', 'my-mayan-sign'); ?>
				<?php echo $_POST['tone']['female_tone_txt']['title']; ?>
			</h2>
		</div>
		<p>
			<?php echo $_POST['tone']['female_tone_txt']['minor_text']; ?>
		</p>
	</div>

	<!-- ----------------------------------------------------------------- -->

	<div class="report-single_main-heading">
		<h2>
			<?php _e('Synthesis', 'my-mayan-sign'); ?>
		</h2>
	</div>

	<div class="report-single">
		<p>
			<?php echo $_POST['synthesis']['content']; ?>
		</p>
	</div>
	<!-- ----------------------------------------------------------------- -->

	<div class="report-footer">
		<?php _e('© 2019, My Mayan Sign', 'my-mayan-sign'); ?>
	</div>
</body>

</html>
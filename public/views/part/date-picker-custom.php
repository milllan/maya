<?php

	/**
	 * Provides a markup for creating Custom select
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

	require_once rtrim( $_SERVER['DOCUMENT_ROOT'], '/' ) . '/wp-load.php';
if ( isset( $_POST['date'] ) ) : ?>
		<script>
			var postedDate = "<?php echo $_POST['date']; ?>";  // Pass the PHP variable to JavaScript
			console.log(postedDate);
		</script>
		<?php
		endif;

?>
	<div id="mymasi-ca-wrap" class="mms_date">
		<div class="mymasi-ca-item">
		<div class="two-columns">
			<div class="two-columns_right">
			<span class="two-columns_heading"><?php _e( 'Your Birthday', 'my-mayan-sign' ); ?></span>
			<!-- <p></p> -->
			<div class="two-columns_form">
				<span class="wpcf7-form-control-wrap menu-day">
					<select id="day" class="wpcf7-form-control wpcf7-select select2-hidden-accessible" aria-invalid="false" tabindex="-1" aria-hidden="true" required>
						<option value="" disabled="disabled"><?php _e( 'Day', 'WordPress' ); ?></option>
						<option value="01">01</option>
						<option value="02">02</option>
						<option value="03">03</option>
						<option value="04">04</option>
						<option value="05">05</option>
						<option value="06">06</option>
						<option value="07">07</option>
						<option value="08">08</option>
						<option value="09">09</option>
						<option value="10">10</option>
						<option value="11">11</option>
						<option value="12">12</option>
						<option value="13">13</option>
						<option value="14">14</option>
						<option value="15">15</option>
						<option value="16">16</option>
						<option value="17">17</option>
						<option value="18">18</option>
						<option value="19">19</option>
						<option value="20">20</option>
						<option value="21">21</option>
						<option value="22">22</option>
						<option value="23">23</option>
						<option value="24">24</option>
						<option value="25">25</option>
						<option value="26">26</option>
						<option value="27">27</option>
						<option value="28">28</option>
						<option value="29">29</option>
						<option value="30">30</option>
						<option value="31">31</option>
					</select>
				</span>
				<br>
				<span class="wpcf7-form-control-wrap menu-month">
					<select id="month" class="wpcf7-form-control wpcf7-select select2-hidden-accessible" aria-invalid="false" tabindex="-1" aria-hidden="true" required>
						<option value="" disabled="disabled"><?php _e( 'Month', 'WordPress' ); ?></option>
						<option value="01"><?php _e( 'January', 'my-mayan-sign' ); ?></option>
						<option value="02"><?php _e( 'February', 'my-mayan-sign' ); ?></option>
						<option value="03"><?php _e( 'March', 'my-mayan-sign' ); ?></option>
						<option value="04"><?php _e( 'April', 'my-mayan-sign' ); ?></option>
						<option value="05"><?php _e( 'May', 'my-mayan-sign' ); ?></option>
						<option value="06"><?php _e( 'June', 'my-mayan-sign' ); ?></option>
						<option value="07"><?php _e( 'July', 'my-mayan-sign' ); ?></option>
						<option value="08"><?php _e( 'August', 'my-mayan-sign' ); ?></option>
						<option value="09"><?php _e( 'September', 'my-mayan-sign' ); ?></option>
						<option value="10"><?php _e( 'October', 'my-mayan-sign' ); ?></option>
						<option value="11"><?php _e( 'November', 'my-mayan-sign' ); ?></option>
						<option value="12"><?php _e( 'December', 'my-mayan-sign' ); ?></option>
					</select>
				</span>
				<br>
				<span class="wpcf7-form-control-wrap menu-year">
					<select id="year" class="wpcf7-form-control wpcf7-select select2-hidden-accessible" aria-invalid="false" tabindex="-1" aria-hidden="true" required>
						<option value="" disabled="disabled"><?php _e( 'Year', 'WordPress' ); ?></option>
						<?php
						for ( $i = date( 'Y' ); $i > 1900; $i-- ) {
							echo '<option value="' . $i . '">' . $i . '</option>';}
						?>
					</select>
				</span>
			</div>
			</div>
		</div>
		</div>
	<input type="number" id="mms_birthday_container" style="display:none" name="your_birthday" value="<?php echo isset( $_POST['date'] ) ? $_POST['date'] : ''; ?>" autocomplete="off" />

<script>
		jQuery( "#year, #month, #day" ).change(function() {

		var day = date_fixer(jQuery( "#day" ).val());
		var month = date_fixer(jQuery( "#month" ).val());
		var year = date_fixer(jQuery( "#year" ).val());
		jQuery("#mms_birthday_container").attr('value', year + month + day);//.val( year + month + day );
	});

</script>
<!-- <script>
jQuery(document).ready(function($) {
	console.log("Document is ready.");

	// Check if the postedDate variable is defined
	if (typeof postedDate === 'undefined') {
		console.log("postedDate is not defined.");
		return;
	}

	console.log("postedDate: ", postedDate);

	// Ensure the date is at least 7 characters (for 'YYYYMDD') and no more than 8 characters
	if (postedDate.length < 7 || postedDate.length > 8) {
		console.log("postedDate does not have a valid length. Length is: " + postedDate.length);
		return;
	}

	// Function to ensure month and day are two digits
	function padDateComponent(component) {
		return component.length === 1 ? '0' + component : component;
	}

	// Parse year, month, and day from postedDate
	var year = postedDate.substring(0, 4);
	var monthDay = postedDate.substring(4); // This will be MMDD or MDD
	var month = padDateComponent(monthDay.length === 3 ? monthDay.substring(0, 1) : monthDay.substring(0, 2));
	var day = padDateComponent(monthDay.length === 3 ? monthDay.substring(1) : monthDay.substring(2));

	console.log("Extracted year: " + year + ", month: " + month + ", day: " + day);

	// Set the selected value for year, month, and day dropdowns
	date_fixer(jQuery('#year').val(year));
	date_fixer(jQuery('#month').val(month));
	date_fixer(jQuery('#day').val(day));

	// Debugging logs to confirm the values are set
	console.log("Set year to: " + $('#year').val());
	console.log("Set month to: " + $('#month').val());
	console.log("Set day to: " + $('#day').val());
});
</script> -->


	</div>

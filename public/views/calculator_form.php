<?php

require_once rtrim( $_SERVER['DOCUMENT_ROOT'], '/' ) . '/wp-load.php';

if ( ( isset( $_POST['mms_calculator_active'] ) && $_POST['mms_calculator_active'] == 'visited' ) && $_POST['is_user_logged_in'] == '0' ) {

	$buttonValue = _x( 'Register and recalculate', 'my-mayan-sign' );

	echo '<div class="two-columns">';
	echo ' <div class="two-columns_left">';
	echo '    <input type="submit" onclick="goToLogin()" value="' . $buttonValue . '" class="wpcf7-form-control wpcf7-submit calendar-submit goToLogin">';
	echo ' </div>';
	echo '</div>';
	// echo '<div class="scroll-down-wrap">';
	// echo '<a href="#intro" class="scroll-down"><span></span></a>';
	// echo '</div>';
	echo '<script>';
	echo '  function goToLogin() {';
	echo '    window.location.href="/login/?re=mayan-sign-calculator";';
	echo '  }';
	echo '</script>';
	die();
}

?>

<div id="mms_calculator_form_wrapper">
	<form id="mms_calculator_form" action="<?php echo $_POST['url']; ?>" method="post">
		<div class="two-columns">
		<?php
		echo mymasi_view(
			'/public/views/part/date-picker-custom.php',
			array(
				'date' => isset( $_POST['date'] ) ? $_POST['date'] : date( 'Ymd' ),
			)
		)
		
		?>

		</div>
		<div class="one-column">
			<input type="submit" id="submit_to_calc" value="<?php _e( 'Show My Mayan Sign Report', 'my-mayan-sign' ); ?>" class="wpcf7-form-control wpcf7-submit calendar-submit">
			<div id="notice_holder">
				<div class="notice"></div>
			</div>
		</div>
		<!-- <div class="scroll-down-wrap"><a href="#intro" class="scroll-down"><span></span></a></div> -->
	</form>
</div>
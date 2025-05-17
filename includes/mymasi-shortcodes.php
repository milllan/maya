<?php

/*
* [mayan_sign_calculator] - shortcode
*/
function mymasi_calculator( $atts ){

    return My_Mayan_Sign_Pages::getCalculatorFormPage();

}
add_shortcode( 'mayan_sign_calculator', 'mymasi_calculator' );

/*
* [mayan_sign_test] - shortcode
*/
function mymasi_test( $atts ){

    return My_Mayan_Sign_Pages::getTestmPage();

}
add_shortcode( 'mayan_sign_test', 'mymasi_test' );

/*
* [mayan_sign_calculator_view] - shortcode
*/
function mymasi_calculator_view( $atts ){
    $year_to_use = '';
    $month_to_use = '';
    $day_to_use = '';
    $is_today_default = true; // Assume today by default, or if POSTed date is invalid

    // Check if a specific birthday is provided via POST
    if (isset($_POST['your_birthday']) && !empty(trim($_POST['your_birthday']))) {
        $birthday_input_str = trim($_POST['your_birthday']);
        
        // Validate YYYYMMDD format
        if (preg_match("/^(\d{4})(\d{2})(\d{2})$/", $birthday_input_str, $matches)) {
            $posted_year = $matches[1];
            $posted_month = $matches[2];
            $posted_day = $matches[3];

            // Validate if it's a real date using checkdate()
            if (checkdate((int)$posted_month, (int)$posted_day, (int)$posted_year)) {
                $year_to_use = $posted_year;
                $month_to_use = $posted_month;
                $day_to_use = $posted_day;
                $is_today_default = false; // A specific, valid date was provided
            }
            // If checkdate fails, it will fall through to use today's date (as $is_today_default remains true)
        }
        // If regex fails, it will fall through to use today's date
    }

    // If no valid specific date was processed (either not provided or invalid), default to today's date
    if ($is_today_default) {
        $current_time_ts = current_time('timestamp'); // WordPress way to get current time respecting site timezone
        $year_to_use = date('Y', $current_time_ts);
        $month_to_use = date('m', $current_time_ts);
        $day_to_use = date('d', $current_time_ts);
    }

    // Create a unique date string for the cache key, e.g., "2023-10-27"
    // Using sprintf ensures leading zeros for month and day, making the key consistent.
    $cache_date_str = sprintf('%04d-%02d-%02d', $year_to_use, $month_to_use, $day_to_use);

    // Cache versioning: Increment 'msc_v1.0' (e.g., to 'msc_v1.1') if you change
    // the HTML structure or text significantly in My_Mayan_Sign_Pages::getCalculatorPage
    // to ensure users get the updated content.
    $cache_version = 'msc_v1.0'; 
    $transient_key_base = $cache_version . '_calc_view_' . $cache_date_str;
    // Sanitize the key to ensure it's valid for WordPress transients.
    $transient_key = sanitize_key($transient_key_base); 

    // Try to get the cached HTML from the transient
    $cached_html = get_transient($transient_key);

    if (false !== $cached_html) {
        return $cached_html; // Return cached HTML if available
    }

    // If not cached, call the original function to generate the HTML.
    // My_Mayan_Sign_Pages::getCalculatorPage expects month, day, year parameters in that order.
    $generated_html = My_Mayan_Sign_Pages::getCalculatorPage($month_to_use, $day_to_use, $year_to_use);

    // Set the transient with the newly generated HTML.
    // Expiration:
    // - For "today's date" (default view): cache for 12 hours. Updates twice a day.
    // - For specific birth dates (user input): cache for 1 year, as these don't change.
    // WordPress constants HOUR_IN_SECONDS, YEAR_IN_SECONDS make this clear.
    $expiration = $is_today_default ? (6 * HOUR_IN_SECONDS) : YEAR_IN_SECONDS;
    set_transient($transient_key, $generated_html, $expiration);

    return $generated_html;
}
add_shortcode( 'mayan_sign_calculator_view', 'mymasi_calculator_view' );

/*
* [mayan_core_sign] - shortcode
*/
function mymasi_core_sign( $atts ){
  $usrID = get_current_user_id();
  $page = new My_Mayan_Sign_Pages($usrID);
  return $page->getCoreSignPage('standard');
}
add_shortcode( 'mayan_core_sign', 'mymasi_core_sign' );

/*
* [mayan_core_sign_free] - shortcode
*/
function mymasi_core_sign_free( $atts ){
  $usrID = get_current_user_id();
  $page = new My_Mayan_Sign_Pages($usrID);
  return $page->getCoreSignPage('free');
}
add_shortcode( 'mayan_core_sign_free', 'mymasi_core_sign_free' );

/*
* [mayan_four_directions] - shortcode
*/
function mymasi_four_directions( $atts ){
  $usrID = get_current_user_id();
  $page = new My_Mayan_Sign_Pages($usrID);
  return $page->getFourDirectionsPage();
}
add_shortcode( 'mayan_four_directions', 'mymasi_four_directions' );

/*
* [mayan_eight_directions] - shortcode
*/
function mymasi_eight_directions( $atts ){
  $usrID = get_current_user_id();
  $page = new My_Mayan_Sign_Pages($usrID);
  return $page->getEightDirectionsPage();
}
add_shortcode( 'mayan_eight_directions', 'mymasi_eight_directions' );



/*
* [mayan_synthesis] - shortcode
*/
function mymasi_synthesis( $atts ){
  $usrID = get_current_user_id();
  $page = new My_Mayan_Sign_Pages($usrID);
  return $page->getSynthesisPage();
}
add_shortcode( 'mayan_synthesis', 'mymasi_synthesis' );

/*
* [mayan_night_lord] - shortcode
*/
function mymasi_night_lord_shortcode( $atts ){
  $usrID = get_current_user_id();
  $page = new My_Mayan_Sign_Pages($usrID);
  return $page->getNightLordPage();
}
add_shortcode( 'mayan_night_lord', 'mymasi_night_lord_shortcode' );

/*
* [mayan_today_in_mc] - shortcode
*/
function mymasi_today_in_mc_shortcode( $atts ){
  return My_Mayan_Sign_Pages::getTodayInMcPage();
}
add_shortcode( 'mayan_today_in_mc', 'mymasi_today_in_mc_shortcode' );

/*
* [mayan_your_custom_calendar] - shortcode
*/
function mymasi_your_custom_calendar_shortcode( $atts ){
  $usrID = get_current_user_id();
  $page = new My_Mayan_Sign_Pages($usrID);
  return $page->getYourCustomCalendar();
}
add_shortcode( 'mayan_your_custom_calendar', 'mymasi_your_custom_calendar_shortcode' );

/*
* [mayan_print] - shortcode
*/

function mymasi_print_shortcode( $atts ){
  $usrID = get_current_user_id();
  $page = new My_Mayan_Sign_Pages($usrID);
  return $page->getPrint();
}
add_shortcode( 'mayan_print', 'mymasi_print_shortcode' );

/*
* [mayan_my_reports] - shortcode
*/
function mymasi_my_reports_shortcode( $atts ){
  $usrID = get_current_user_id();
  $page = new My_Mayan_Sign_Pages($usrID);
  return $page->getMyReports();
}
add_shortcode( 'mayan_my_reports', 'mymasi_my_reports_shortcode' );

/*
* [mayan_my_report view=""] - shortcode
*/

function mymasi_my_report_shortcode( $atts ){
  $usrID = get_current_user_id();
  $page = new My_Mayan_Sign_Pages($usrID);
  return $page->getMyReport($atts['view']);
}
add_shortcode( 'mayan_my_report', 'mymasi_my_report_shortcode' );

/*
* [mayan_compentency_analysis] - shortcode
*/
function mymasi_compentency_analysis_shortcode( $atts ){
  $usrID = get_current_user_id();
  $page = new My_Mayan_Sign_Pages($usrID);
  $content = $page->getCompetency($atts['view']);

  return $content;
}
add_shortcode( 'mayan_compentency_analysis', 'mymasi_compentency_analysis_shortcode' );

/*
* [mayan_notifications] - shortcode
*/
function mymasi_notifications_shortcode( $atts ){
  $usrID = get_current_user_id();
  $page = new My_Mayan_Sign_Pages($usrID);
  $content = $page->getNotifications();

  return $content;
}
add_shortcode( 'mayan_notifications', 'mymasi_notifications_shortcode' );
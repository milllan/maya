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
  $birthday = isset($_POST['your_birthday']) ? $_POST['your_birthday'] : date("Ymd");
  $year = substr($birthday, 0, 4);
  $month = substr($birthday, 4, 2);
  $day = substr($birthday, 6, 2);

  return My_Mayan_Sign_Pages::getCalculatorPage($month,$day,$year);
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

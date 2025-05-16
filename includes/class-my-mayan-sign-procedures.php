<?php

function mymasi_night_lord( $birthmonth = 1, $birthday = 24, $birthyear = 1900 ) {
	$a        = strtotime( $birthyear . '-' . $birthmonth . '-' . $birthday );
	$b        = strtotime( '1900-01-08' );
	$datediff = $a - $b;
	$datediff = round( $datediff / ( 60 * 60 * 24 ) );

	return ( $datediff % 9 ) + 1;
}

function mymasi_today_in_mc() {
	list($burcToday, $numberToday, $tracaToday) = calculateMaya( date( 'n' ), date( 'j' ), date( 'Y' ), 'yes' );

	$mayaValues = fillValues( $burcToday, $numberToday, $tracaToday );

	return $mayaValues;
}

function calculateMaya( $birthmonth = 1, $birthday = 24, $birthyear = 1900, $sun = '' ) {
	$sun = 'yes';

	// Validate input.
	if ( ! is_numeric( $birthmonth ) || ! is_numeric( $birthday ) || ! is_numeric( $birthyear ) ) {
		return 'Invalid input: Date must be numeric.';
	}

	// date_default_timezone_set('UTC');
	// Ensure the variables are of integer type (added 16-10-2023)
	// $birthmonth = (int) $birthmonth;
	// $birthday   = (int) $birthday;
	// $birthyear  = (int) $birthyear;

	// Check for valid date.
	// if ( ! checkdate( $birthmonth, $birthday, $birthyear ) ) {
	// return 'Invalid input: Not a valid date.';
	// }

	$birthTime    = mktime( 0, 0, 0, $birthmonth, $birthday, $birthyear );
	$kerterizTime = mktime( 0, 0, 0, 4, 29, 1983 );

	$seconds = $birthTime - $kerterizTime;

	$dayPassed = floor( $seconds / 86400 );

	if ( $sun == 'no' ) {
		--$dayPassed;
	}

	$kerterizNumber = 4;
	$kerterizBurc   = 11;

	$burc   = ( $kerterizBurc + ( $dayPassed % 20 ) ) % 20;
	$number = ( $kerterizNumber + ( $dayPassed % 13 ) ) % 13;

	if ( $number < 1 ) {
		$number += 13;
	}
	if ( $burc < 1 ) {
		$burc += 20;
	}

	$tracana = $burc - ( $number - 1 );
	if ( $tracana < 1 ) {
		$tracana += 20;
	}

	return array( $burc, $number, $tracana );
}

function getBurcNames() {
	$burcName     = array();
	$burcName[1]  = 'Crocodile';
	$burcName[2]  = 'Wind';
	$burcName[3]  = 'Night';
	$burcName[4]  = 'Seed';
	$burcName[5]  = 'Serpent';
	$burcName[6]  = 'Death';
	$burcName[7]  = 'Deer';
	$burcName[8]  = 'Rabbit';
	$burcName[9]  = 'Water';
	$burcName[10] = 'Dog';
	$burcName[11] = 'Monkey';
	$burcName[12] = 'Road';
	$burcName[13] = 'Reed';
	$burcName[14] = 'Jaguar';
	$burcName[15] = 'Eagle';
	$burcName[16] = 'Owl';
	$burcName[17] = 'Earth';
	$burcName[18] = 'Knife';
	$burcName[19] = 'Storm';
	$burcName[20] = 'Light';
	return $burcName;
}

function getKicheNames() {
	$burcName = array();

	$burcName[1]  = 'Monkey';
	$burcName[2]  = 'Road';
	$burcName[3]  = 'Reed';
	$burcName[4]  = 'Jaguar';
	$burcName[5]  = 'Eagle';
	$burcName[6]  = 'Owl';
	$burcName[7]  = 'Earth';
	$burcName[8]  = 'Knife';
	$burcName[9]  = 'Storm';
	$burcName[10] = 'Light';
	$burcName[11] = 'Crocodile';
	$burcName[12] = 'Wind';
	$burcName[13] = 'Night';
	$burcName[14] = 'Seed';
	$burcName[15] = 'Serpent';
	$burcName[16] = 'Death';
	$burcName[17] = 'Deer';
	$burcName[18] = 'Rabbit';
	$burcName[19] = 'Water';
	$burcName[20] = 'Dog';

	return $burcName;
}

function fillValues( $burc, $number, $tracana ) {
    $burcName  = getBurcNames();
    $synthesis = mysasi_get_custom_type( 'synthesis' );

    $rv = array();

    $rv['burc']        = $burc;
    $rv['burcName']    = isset($burcName[$burc]) ? $burcName[$burc] : null;
    $rv['number']      = $number;
    $rv['tracana']     = $tracana;
    $rv['tracanaName'] = isset($burcName[$tracana]) ? $burcName[$tracana] : null;
    $rv['yonFile']     = isset($synthesis[$burc]['img']) ? $synthesis[$burc]['img'] : null;

    return $rv;
}


function mymasi_to_mayan_calendar( $birthmonth = 1, $birthday = 24, $birthyear = 1900, $sun = '' ) {

		// Validate input.
	if ( ! is_numeric( $birthmonth ) || ! is_numeric( $birthday ) || ! is_numeric( $birthyear ) ) {
		return 'Invalid input: Date must be numeric.';
	}

	// $birthmonth = (int) $birthmonth;
	// $birthday   = (int) $birthday;
	// $birthyear  = (int) $birthyear;

	// Check for valid date.
	// if ( ! checkdate( $birthmonth, $birthday, $birthyear ) ) {
	// return 'Invalid input: Not a valid date.';
	// }

	$birthTime = mktime( 0, 0, 0, $birthmonth, $birthday, $birthyear );
	$startTime = mktime( 0, 0, 0, 1, 24, 1900 );

	$datediff = $birthTime - $startTime;
	$datediff = round( $datediff / ( 60 * 60 * 24 ) );

	if ( $sun == 'yes' ) {
		++$datediff;
	}

	return ( $datediff % 260 );
}
function mymasi_get_tone( $birth, $sun ) {
	$map  = mymasi_tone_map();
	$day  = mymasi_to_mayan_calendar( date( 'm', $birth ), date( 'd', $birth ), date( 'Y', $birth ), $sun );
	$maya = calculateMaya( date( 'm', $birth ), date( 'd', $birth ), date( 'Y', $birth ), $sun );
	return $maya[1];
}

function mymasi_get_tones_from_map( $coreTone, $map ) {
	$result                         = array();
	$result['core_tone']            = $coreTone;
	$result['core_tone_img_number'] = plugins_url( 'public/images/sign-number/' . $result['core_tone'] . '.svg', __DIR__ );
	$result['core_tone_img']        = plugins_url( 'public/images/sign/' . $result['core_tone'] . '.svg', __DIR__ );

	$result['youth_tone']     = $map['youth'];
	$result['youth_tone_img'] = plugins_url( 'public/images/sign/' . $result['youth_tone'] . '.svg', __DIR__ );

	$result['future_tone']     = $map['future'];
	$result['future_tone_img'] = plugins_url( 'public/images/sign/' . $result['future_tone'] . '.svg', __DIR__ );

	$result['youth_male_tone']     = $map['youth_male'];
	$result['youth_male_tone_img'] = plugins_url( 'public/images/sign/' . $result['youth_male_tone'] . '.svg', __DIR__ );

	$result['youth_female_tone']     = $map['youth_female'];
	$result['youth_female_tone_img'] = plugins_url( 'public/images/sign/' . $result['youth_female_tone'] . '.svg', __DIR__ );

	$result['male_tone']     = $map['male'];
	$result['male_tone_img'] = plugins_url( 'public/images/sign/' . $result['male_tone'] . '.svg', __DIR__ );

	$result['female_tone']     = $map['female'];
	$result['female_tone_img'] = plugins_url( 'public/images/sign/' . $result['female_tone'] . '.svg', __DIR__ );

	$result['destiny_male_tone']     = $map['destiny_male'];
	$result['destiny_male_tone_img'] = plugins_url( 'public/images/sign/' . $result['destiny_male_tone'] . '.svg', __DIR__ );

	$result['destiny_female_tone']     = $map['destiny_female'];
	$result['destiny_female_tone_img'] = plugins_url( 'public/images/sign/' . $result['destiny_female_tone'] . '.svg', __DIR__ );

	return $result;
}

function mymasi_get_eight_tones( $birthmonth = 1, $birthday = 24, $birthyear = 1900, $sun = '' ) {

	// Validate input.
	if ( ! is_numeric( $birthmonth ) || ! is_numeric( $birthday ) || ! is_numeric( $birthyear ) ) {
		return 'Invalid input: Date must be numeric.';
	}

	// $birthmonth = (int) $birthmonth;
	// $birthday   = (int) $birthday;
	// $birthyear  = (int) $birthyear;

	// // Check for valid date.
	// if ( ! checkdate( $birthmonth, $birthday, $birthyear ) ) {
	// return 'Invalid input: Not a valid date.';
	// }

	$result = array();

	$images_dir = $_SERVER['DOCUMENT_ROOT'] . '/wp-content/plugins/maya/public/images/';

	$numbers = mysasi_get_custom_type( 'numbers' );

	$result['stage_line_img'] = plugins_url( 'public/images/tol-stage-line.png', __DIR__ );

	// error_log('--------- mymasi_get_eight_tones() Arguments ---------');
	// error_log('Month: ' . $month);
	// error_log('Day: ' . $day);
	// error_log('Year: ' . $year);
	// error_log('Sun: ' . $sun);

	$result['core_tone']              = mymasi_get_tone( mktime( 0, 0, 0, $birthmonth, $birthday, $birthyear ), $sun );
	$result['core_tone_img_number']   = plugins_url( 'public/images/sign-number/' . $result['core_tone'] . '.svg', __DIR__ );
	$result['core_tone_img_number_f'] = plugins_url( 'public/images/sign-number/' . $result['core_tone'] . '.png', __DIR__ );
	$result['core_tone_img']          = plugins_url( 'public/images/sign/' . $result['core_tone'] . '.svg', __DIR__ );
	$result['core_tone_img_abs']      = plugins_url( 'public/images/tone/' . $result['core_tone'] . '.png', __DIR__ );
	$result['core_tone_img_f']        = $images_dir . 'tone/' . $result['core_tone'] . '.png';
	$result['core_tone_txt']          = $numbers[ $result['core_tone'] ];

	$result['youth_tone']         = mymasi_get_tone( mktime( 0, 0, 0, $birthmonth, $birthday - 8, $birthyear ), $sun );
	$result['youth_tone_img']     = plugins_url( 'public/images/sign/' . $result['youth_tone'] . '.svg', __DIR__ );
	$result['youth_tone_img_abs'] = plugins_url( 'public/images/tone/' . $result['youth_tone'] . '.png', __DIR__ );
	$result['youth_tone_img_f']   = $images_dir . 'tone/' . $result['youth_tone'] . '.png';
	$result['youth_tone_txt']     = $numbers[ $result['youth_tone'] ];

	$result['future_tone']         = mymasi_get_tone( mktime( 0, 0, 0, $birthmonth, $birthday + 8, $birthyear ), $sun );
	$result['future_tone_img']     = plugins_url( 'public/images/sign/' . $result['future_tone'] . '.svg', __DIR__ );
	$result['future_tone_img_abs'] = plugins_url( 'public/images/tone/' . $result['future_tone'] . '.png', __DIR__ );
	$result['future_tone_img_f']   = $images_dir . 'tone/' . $result['future_tone'] . '.png';
	$result['future_tone_txt']     = $numbers[ $result['future_tone'] ];

	$result['youth_male_tone']         = mymasi_get_tone( mktime( 0, 0, 0, $birthmonth, $birthday - 14, $birthyear ), $sun );
	$result['youth_male_tone_img']     = plugins_url( 'public/images/sign/' . $result['youth_male_tone'] . '.svg', __DIR__ );
	$result['youth_male_tone_img_abs'] = plugins_url( 'public/images/tone/' . $result['youth_male_tone'] . '.png', __DIR__ );
	$result['youth_male_tone_img_f']   = $images_dir . 'tone/' . $result['youth_male_tone'] . '.png';
	$result['youth_male_tone_txt']     = $numbers[ $result['youth_male_tone'] ];

	$result['youth_female_tone']         = mymasi_get_tone( mktime( 0, 0, 0, $birthmonth, $birthday - 2, $birthyear ), $sun );
	$result['youth_female_tone_img']     = plugins_url( 'public/images/sign/' . $result['youth_female_tone'] . '.svg', __DIR__ );
	$result['youth_female_tone_img_abs'] = plugins_url( 'public/images/tone/' . $result['youth_female_tone'] . '.png', __DIR__ );
	$result['youth_female_tone_img_f']   = $images_dir . 'tone/' . $result['youth_female_tone'] . '.png';
	$result['youth_female_tone_txt']     = $numbers[ $result['youth_female_tone'] ];

	$result['male_tone']         = mymasi_get_tone( mktime( 0, 0, 0, $birthmonth, $birthday - 6, $birthyear ), $sun );
	$result['male_tone_img']     = plugins_url( 'public/images/sign/' . $result['male_tone'] . '.svg', __DIR__ );
	$result['male_tone_img_abs'] = plugins_url( 'public/images/tone/' . $result['male_tone'] . '.png', __DIR__ );
	$result['male_tone_img_f']   = $images_dir . 'tone/' . $result['male_tone'] . '.png';
	$result['male_tone_txt']     = $numbers[ $result['male_tone'] ];

	$result['female_tone']         = mymasi_get_tone( mktime( 0, 0, 0, $birthmonth, $birthday + 6, $birthyear ), $sun );
	$result['female_tone_img']     = plugins_url( 'public/images/sign/' . $result['female_tone'] . '.svg', __DIR__ );
	$result['female_tone_img_abs'] = plugins_url( 'public/images/tone/' . $result['female_tone'] . '.png', __DIR__ );
	$result['female_tone_img_f']   = $images_dir . 'tone/' . $result['female_tone'] . '.png';
	$result['female_tone_txt']     = $numbers[ $result['female_tone'] ];

	$result['destiny_male_tone']         = mymasi_get_tone( mktime( 0, 0, 0, $birthmonth, $birthday + 2, $birthyear ), $sun );
	$result['destiny_male_tone_img']     = plugins_url( 'public/images/sign/' . $result['destiny_male_tone'] . '.svg', __DIR__ );
	$result['destiny_male_tone_img_abs'] = plugins_url( 'public/images/tone/' . $result['destiny_male_tone'] . '.png', __DIR__ );
	$result['destiny_male_tone_img_f']   = $images_dir . 'tone/' . $result['destiny_male_tone'] . '.png';
	$result['destiny_male_tone_txt']     = $numbers[ $result['destiny_male_tone'] ];

	$result['destiny_female_tone']         = mymasi_get_tone( mktime( 0, 0, 0, $birthmonth, $birthday + 14, $birthyear ), $sun );
	$result['destiny_female_tone_img']     = plugins_url( 'public/images/sign/' . $result['destiny_female_tone'] . '.svg', __DIR__ );
	$result['destiny_female_tone_img_abs'] = plugins_url( 'public/images/tone/' . $result['destiny_female_tone'] . '.png', __DIR__ );
	$result['destiny_female_tone_img_f']   = $images_dir . 'tone/' . $result['destiny_female_tone'] . '.png';
	$result['destiny_female_tone_txt']     = $numbers[ $result['destiny_female_tone'] ];

	return $result;
}

function mymasi_eight_dirtection_map() {
	$result     = array();
	$directions = array(
		'youth',
		'future',
		'youth_male',
		'youth_female',
		'male',
		'female',
		'destiny_male',
		'destiny_female',
	);

	// start : 1 13  9 7 19  15  7 3 15
	$result[1]['youth']          = 13;
	$result[1]['future']         = 9;
	$result[1]['youth_male']     = 7;
	$result[1]['youth_female']   = 19;
	$result[1]['male']           = 15;
	$result[1]['female']         = 7;
	$result[1]['destiny_male']   = 3;
	$result[1]['destiny_female'] = 15;

	for ( $i = 2; $i <= 20; $i++ ) {
		foreach ( $directions as $direction ) {
			$result[ $i ][ $direction ] = $result[ $i - 1 ][ $direction ] + 1;
			if ( $result[ $i ][ $direction ] == 21 ) {
				$result[ $i ][ $direction ] = 1;
			}
		}
	}

	return $result;
}

function mymasi_tone_map() {
	$result = array();
	$day    = 0;
	$tone   = 0;

	for ( $j = 1; $j <= 13; $j++ ) {
		for ( $i = 1; $i <= 20; $i++ ) {
			++$day;
			++$tone;

			if ( $tone > 13 ) {
				$tone = 1;
			}

			$result[ $i ][ $j ]['day']  = $day;
			$result[ $i ][ $j ]['sign'] = $i;
			$result[ $i ][ $j ]['tone'] = $j;
		}
	}

	return $result;
}

function mymasi_get_mayan_day( $cSign, $cTone ) {
	$result = array();
	$day    = 0;
	$tone   = 0;

	for ( $j = 1; $j <= 13; $j++ ) {
		for ( $i = 1; $i <= 20; $i++ ) {
			++$day;
			++$tone;

			if ( $tone > 13 ) {
				$tone = 1;
			}
			if ( $tone ) {
				$result[ $i ][ $j ]['day'] = $day;
			}
			$result[ $i ][ $j ]['sign'] = $i;
			$result[ $i ][ $j ]['tone'] = $j;
		}
	}

	return $result;
}

/*
 * Function shows your life phase
 *
 * Youth birth - 13yrs
 * Youth - adult (13 - 26y)
 * Adult: 26 - 39
 * Adult-mature: 39 - 52
 * Mature: 52-65
 * After: 65 you are in mature phase
 *
 */
function mymasi_life_phase( $birthmonth = 1, $birthday = 24, $birthyear = 1900 ) {

	// Validate input.
	if ( ! is_numeric( $birthmonth ) || ! is_numeric( $birthday ) || ! is_numeric( $birthyear ) ) {
		return 'Invalid input: Date must be numeric.';
	}

	// $birthmonth = (int) $birthmonth;
	// $birthday   = (int) $birthday;
	// $birthyear  = (int) $birthyear;

	// // Check for valid date.
	// if ( ! checkdate( $birthmonth, $birthday, $birthyear ) ) {
	// return 'Invalid input: Not a valid date.';
	// }

	$birth = mktime( 0, 0, 0, $birthmonth, $birthday, $birthyear );
	$now   = time();

	$time_difference = $now - $birth;

	$seconds_per_year = 60 * 60 * 24 * 365;
	$phase            = round( $time_difference / $seconds_per_year );

	if ( $phase < 13 ) {
		return 'youth';
	}
	if ( $phase < 26 ) {
		return 'youth_adult';
	}
	if ( $phase < 39 ) {
		return 'adult';
	}
	if ( $phase < 52 ) {
		return 'adult_mature';
	}

	return 'mature';
}
/*
 *  We are calculating if $m,$d,$y is a first day of the 13day special week fot the $sign
 */
function special_week( $m, $d, $y, $sign ) {
	$mayan_calendar_day = mymasi_to_mayan_calendar( $m, $d, $y, 'yes' );
	// take into account only first tone days
	if ( ( $mayan_calendar_day % 13 ) == 1 ) {
		// calculate what sign of 20 is mayan_calendar_day in
		$day  = 0;
		$tone = 0;
		for ( $j = 1; $j <= 13; $j++ ) {
			for ( $i = 1; $i <= 20; $i++ ) {
				++$day;
				++$tone;

				if ( $tone > 13 ) {
					$tone = 1;
				}

				if ( $mayan_calendar_day == $day && $i == $sign && $tone == 1 ) {
					return true;
				}
			}
		}
	}
	return false;
}

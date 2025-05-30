<?php

function mymasi_today_in_your_mc( $values, $user, $startOn ) {
	$result = array();

	// $upgradeURL = '';
	$upgradeURL = isset($values['upgrade_to_standard']) ? $values['upgrade_to_standard'] : get_site_url() . '/shop/';

	$destek = $values['burc'] - 8;
	if ( $destek < 1 ) {
		$destek += 20;
	}
	$rehber = $values['burc'] + 8;
	if ( $rehber > 20 ) {
		$rehber -= 20;
	}
	$disi = $values['burc'] + 6;
	if ( $disi > 20 ) {
		$disi -= 20;
	}

	$erkek = $values['burc'] - 6;
	if ( $erkek < 1 ) {
		$erkek += 20;
	}

	$mature_female_sign = $values['burc'] + 14;
	if ( $mature_female_sign > 20 ) {
		$mature_female_sign -= 20;
	}

	$childhood_male_sign = $values['burc'] - 14;
	if ( $childhood_male_sign < 1 ) {
		$childhood_male_sign += 20;
	}

	$youth_female = $values['burc'] - 2;
	if ( $youth_female < 1 ) {
		$youth_female += 20;
	}

	$destiny_male = $values['burc'] + 2;
	if ( $destiny_male > 20 ) {
		$destiny_male -= 20;
	}

	// for special weeks
	$values['disi']   = $disi;
	$values['erkek']  = $erkek;
	$values['destek'] = $destek;
	$values['rehber'] = $rehber;

	$custom_tekst = mysasi_get_your_dates_cpt();

	list($year, $month, $day) = explode( '-', $startOn );

	list($b, $n, $t) = calculateMaya( $month, $day, $year, 'yes' );

	$time13 = mktime( 0, 0, 0, $month, $day, $year ) + 13 * 60 * 60 * 24;

	$year13  = date( 'Y', $time13 );
	$day13   = date( 'j', $time13 );
	$month13 = date( 'n', $time13 );

	list($b13, $n13, $t13) = calculateMaya( $month13, $day13, $year13, 'yes' );

	$time65before1               = mktime( 0, 0, 0, $month, $day, $year ) + 65 * 60 * 60 * 24;
	$year65b1                    = date( 'Y', $time65before1 );
	$day65b1                     = date( 'j', $time65before1 );
	$month65b1                   = date( 'n', $time65before1 );
	list($b65b1, $n65b1, $t65b1) = calculateMaya( $month65b1, $day65b1, $year65b1, 'yes' );

	$time65before2               = mktime( 0, 0, 0, $month, $day, $year ) + 65 * 2 * 60 * 60 * 24;
	$year65b2                    = date( 'Y', $time65before2 );
	$day65b2                     = date( 'j', $time65before2 );
	$month65b2                   = date( 'n', $time65before2 );
	list($b65b2, $n65b2, $t65b2) = calculateMaya( $month65b2, $day65b2, $year65b2, 'yes' );

	$time65after                 = mktime( 0, 0, 0, $month, $day, $year ) - 65 * 60 * 60 * 24;
	$year65b3                    = date( 'Y', $time65after );
	$day65b3                     = date( 'j', $time65after );
	$month65b3                   = date( 'n', $time65after );
	list($b65b3, $n65b3, $t65b3) = calculateMaya( $month65b3, $day65b3, $year65b3, 'yes' );

	$time6513before1                   = mktime( 0, 0, 0, $month, $day, $year ) + 65 * 60 * 60 * 24 + 13 * 60 * 60 * 24;
	$year65b3                          = date( 'Y', $time6513before1 );
	$day65b3                           = date( 'j', $time6513before1 );
	$month65b3                         = date( 'n', $time6513before1 );
	list($b6513b1, $n6513b1, $t6513b1) = calculateMaya( $month65b3, $day65b3, $year65b3, 'yes' );

	$time6513before2                   = mktime( 0, 0, 0, $month, $day, $year ) + 65 * 2 * 60 * 60 * 24 + 13 * 60 * 60 * 24;
	$year65b3                          = date( 'Y', $time6513before2 );
	$day65b3                           = date( 'j', $time6513before2 );
	$month65b3                         = date( 'n', $time6513before2 );
	list($b6513b2, $n6513b2, $t6513b2) = calculateMaya( $month65b3, $day65b3, $year65b3, 'yes' );

	$time6513after                     = mktime( 0, 0, 0, $month, $day, $year ) - 65 * 60 * 60 * 24 + 13 * 60 * 60 * 24;
	$year65b3                          = date( 'Y', $time6513after );
	$day65b3                           = date( 'j', $time6513after );
	$month65b3                         = date( 'n', $time6513after );
	list($b6513b3, $n6513b3, $t6513b3) = calculateMaya( $month65b3, $day65b3, $year65b3, 'yes' );

	$timeForTrecana1                         = mktime( 0, 0, 0, $month, $day, $year ) - ( $values['number'] - 1 ) * 60 * 60 * 24;
	$year65b3                                = date( 'Y', $timeForTrecana1 );
	$day65b3                                 = date( 'j', $timeForTrecana1 );
	$month65b3                               = date( 'n', $timeForTrecana1 );
	list($btrecana1, $ntrecana1, $ttrecana1) = calculateMaya( $month65b3, $day65b3, $year65b3, 'yes' );

	$names    = getBurcNames();
	$boxArray = array();
	if ( $n == $values['number'] && $b == $values['burc'] ) {
		$boxArray[] = array( $custom_tekst['tzolkin_birthday']['title'], 0, parseSpecial( $custom_tekst['tzolkin_birthday']['content'], $values ), true, '' );
	}
	if ( $n13 == $values['number'] && $b13 == $values['burc'] ) {
		$boxArray[] = array( $custom_tekst['left_to_birthday_13']['title'], 0, $custom_tekst['left_to_birthday_13']['content'], true, '' );
	}
	if ( ( $n65b1 == $values['number'] && $b65b1 == $values['burc'] ) || ( $n65b2 == $values['number'] && $b65b2 == $values['burc'] ) || ( $n65b3 == $values['number'] && $b65b3 == $values['burc'] ) ) {
		$boxArray[] = array( $custom_tekst['breakthrough_days']['title'], 0, $custom_tekst['breakthrough_days']['content'], true, '' );
	}
	if ( ( $values['number'] == $n6513b1 && $values['burc'] == $b6513b1 ) || ( $values['number'] == $n6513b2 && $values['burc'] == $b6513b2 ) || ( $values['number'] == $n6513b3 && $values['burc'] == $b6513b3 ) ) {
		$boxArray[] = array( $custom_tekst['left_before_day_13']['title'], 0, $custom_tekst['left_before_day_13']['content'], true, '' );
	}
	if ( $n == $values['number'] ) {
		$boxArray[] = array( $custom_tekst['galactic_tone']['title'], 2, parseSpecial( $custom_tekst['galactic_tone']['content'], $values ), true, '' );
	}
	if ( $b == $values['burc'] ) {
		$boxArray[] = array( $custom_tekst['day_sign']['title'], 1, parseSpecial( $custom_tekst['day_sign']['content'], $values ), true, '' );
	}
	if ( $b == $values['trecana'] ) {
		$boxArray[] = array( $custom_tekst['trecana_sign']['title'], 2, parseSpecial( $custom_tekst['trecana_sign']['content'], $values ), true, '' );
	}
	if ( $n == 1 && $b == $values['burc'] ) {
		$boxArray[] = array( $custom_tekst['trecanas_burc']['title'], 2, parseSpecial( $custom_tekst['trecanas_burc']['content'], $values ), true, '' );
	}
	if ( $n == 1 && $b == $values['trecana'] ) {
		$boxArray[] = array( $custom_tekst['trecanas']['title'], 2, parseSpecial( $custom_tekst['trecanas']['content'], $values ), true, '' );
	}
	if ( $b == $destek ) {
		$canView    = true;
		$upgradeURL = isset($values['upgrade_to_standard']) ? $values['upgrade_to_standard'] : get_site_url() . '/shop/';

		$boxArray[] = array( $custom_tekst['past_sign']['title'], 2, parseSpecial( $custom_tekst['past_sign']['content'], $values ), $canView, $upgradeURL );
	}
	if ( $b == $rehber ) {
		$canView    = true;
		$upgradeURL = isset($values['upgrade_to_standard']) ? $values['upgrade_to_standard'] : get_site_url() . '/shop/';

		$boxArray[] = array( $custom_tekst['destiny_sign']['title'], 2, parseSpecial( $custom_tekst['destiny_sign']['content'], $values ), $canView, $upgradeURL );
	}
	if ( $b == $erkek ) {
		$canView    = true;
		$upgradeURL = isset($values['upgrade_to_standard']) ? $values['upgrade_to_standard'] : get_site_url() . '/shop/';

		$boxArray[] = array( $custom_tekst['male_sign']['title'], 2, parseSpecial( $custom_tekst['male_sign']['content'], $values ), $canView, $upgradeURL );
	}
	if ( $b == $disi ) {
		$canView    = true;
		$boxArray[] = array( $custom_tekst['female_sign']['title'], 2, parseSpecial( $custom_tekst['female_sign']['content'], $values ), $canView, $upgradeURL );
	}

	if ( special_week( $month, $day, $year, $disi ) ) {
		$boxArray[] = array( 'Week of the ' . $names[ $disi ], 2, parseSpecial( $custom_tekst['week_of_the_female']['content'], $values ), true, '' );
	}
	if ( special_week( $month, $day, $year, $destek ) ) {
		$canView    = true;
		$boxArray[] = array( 'Week of the ' . $names[ $destek ], 2, parseSpecial( $custom_tekst['week_of_the_youth']['content'], $values ), $canView, $upgradeURL );
	}
	if ( special_week( $month, $day, $year, $rehber ) ) {
		$canView    = true;
		$boxArray[] = array( 'Week of the ' . $names[ $rehber ], 2, parseSpecial( $custom_tekst['week_of_the_mature']['content'], $values ), $canView, $upgradeURL );
	}
	if ( special_week( $month, $day, $year, $erkek ) ) {
		$canView    = true;
		$boxArray[] = array( 'Week of the ' . $names[ $erkek ], 2, parseSpecial( $custom_tekst['week_of_the_male']['content'], $values ), $canView, $upgradeURL );
	}
		/*
		if(special_week($month, $day, $year, $disi)){
			if($level > 1) $canView = true;
			else $canView = false;

			// $result .= putItem($day,$month,$year,"Week of the ".$names[$disi],2,parseSpecial($custom_tekst['week_of_the']['content'],$values),$canView,$upgradeURL);
		}*/
	if ( $b == $mature_female_sign ) {
		$canView    = true;
		$boxArray[] = array( $custom_tekst['mature_female_sign']['title'], 2, parseSpecial( $custom_tekst['mature_female_sign']['content'], $values ), $canView, $upgradeURL );
	}

	if ( $b == $childhood_male_sign ) {
		$canView    = true;
		$boxArray[] = array( $custom_tekst['childhood_male_sign']['title'], 2, parseSpecial( $custom_tekst['childhood_male_sign']['content'], $values ), $canView, $upgradeURL );
	}

	if ( $b == $youth_female ) {
		$canView    = true;
		$boxArray[] = array( $custom_tekst['childhood_female_sign']['title'], 2, parseSpecial( $custom_tekst['childhood_female_sign']['content'], $values ), $canView, $upgradeURL );
	}

	if ( $b == $destiny_male ) {
		$canView    = true;
		$boxArray[] = array( $custom_tekst['mature_male_sign']['title'], 2, parseSpecial( $custom_tekst['mature_male_sign']['content'], $values ), $canView, $upgradeURL );
	}

	$result = '';

	foreach ( $boxArray as $_group ) {

		$result .= '<h2>' . $_group[0] . '</h2>' . $_group[2];
	}
	if ( $result == '' ) {
		return false;
	}

	return mymasi_notification_email_content( '', $result, $user );
}

function mymasi_notification_email_content( $title, $content, $user ) {
	$data['name']    = $user->user_nicename;
	$data['title']   = $title;
	$data['content'] = $content;

	$view = mymasi_view( '/public/report/email/today_in_your_mc.php', $data );
	return $view;
}

function mymasi_your_custom_dates( $values, $level ) {

	if (!is_array($values) || !isset($values['burc']) || !isset($values['number']) || !isset($values['trecana'])) {
        return '';
    }

	$result  = '';
	$startOn = date( 'Y-m-d' );

	$burc = (int)$values['burc'];
	
	$destek = $burc - 8;
	if ( $destek < 1 ) {
		$destek += 20;
	}
	$rehber = $burc + 8;
	if ( $rehber > 20 ) {
		$rehber -= 20;
	}
	$disi = $burc + 6;
	if ( $disi > 20 ) {
		$disi -= 20;
	}
	$erkek = $burc - 6;
	if ( $erkek < 1 ) {
		$erkek += 20;
	}
	$mature_female_sign = $burc + 14;
	if ( $mature_female_sign > 20 ) {
		$mature_female_sign -= 20;
	}
	$childhood_male_sign = $burc - 14;
	if ( $childhood_male_sign < 1 ) {
		$childhood_male_sign += 20;
	}
	$youth_female = $burc - 2;
	if ( $youth_female < 1 ) {
		$youth_female += 20;
	}
	$destiny_male = $burc + 2;
	if ( $destiny_male > 20 ) {
		$destiny_male -= 20;
	}
	

	// for special weeks
	$values['disi']   = $disi;
	$values['erkek']  = $erkek;
	$values['destek'] = $destek;
	$values['rehber'] = $rehber;

	$custom_tekst = mysasi_get_your_dates_cpt();

	list($year, $month, $day) = explode( '-', $startOn );

	for ( $i = 0; $i < 366; $i++ ) {

		list($b, $n, $t) = calculateMaya( $month, $day, $year, 'yes' );

		$time13 = mktime( 0, 0, 0, $month, $day, $year ) + 13 * 60 * 60 * 24;

		$year13  = date( 'Y', $time13 );
		$day13   = date( 'j', $time13 );
		$month13 = date( 'n', $time13 );

		list($b13, $n13, $t13) = calculateMaya( $month13, $day13, $year13, 'yes' );

		$time65before1               = mktime( 0, 0, 0, $month, $day, $year ) + 65 * 60 * 60 * 24;
		$year65b1                    = date( 'Y', $time65before1 );
		$day65b1                     = date( 'j', $time65before1 );
		$month65b1                   = date( 'n', $time65before1 );
		list($b65b1, $n65b1, $t65b1) = calculateMaya( $month65b1, $day65b1, $year65b1, 'yes' );

		$time65before2               = mktime( 0, 0, 0, $month, $day, $year ) + 65 * 2 * 60 * 60 * 24;
		$year65b2                    = date( 'Y', $time65before2 );
		$day65b2                     = date( 'j', $time65before2 );
		$month65b2                   = date( 'n', $time65before2 );
		list($b65b2, $n65b2, $t65b2) = calculateMaya( $month65b2, $day65b2, $year65b2, 'yes' );

		$time65after                 = mktime( 0, 0, 0, $month, $day, $year ) - 65 * 60 * 60 * 24;
		$year65b3                    = date( 'Y', $time65after );
		$day65b3                     = date( 'j', $time65after );
		$month65b3                   = date( 'n', $time65after );
		list($b65b3, $n65b3, $t65b3) = calculateMaya( $month65b3, $day65b3, $year65b3, 'yes' );

		$time6513before1                   = mktime( 0, 0, 0, $month, $day, $year ) + 65 * 60 * 60 * 24 + 13 * 60 * 60 * 24;
		$year65b3                          = date( 'Y', $time6513before1 );
		$day65b3                           = date( 'j', $time6513before1 );
		$month65b3                         = date( 'n', $time6513before1 );
		list($b6513b1, $n6513b1, $t6513b1) = calculateMaya( $month65b3, $day65b3, $year65b3, 'yes' );

		$time6513before2                   = mktime( 0, 0, 0, $month, $day, $year ) + 65 * 2 * 60 * 60 * 24 + 13 * 60 * 60 * 24;
		$year65b3                          = date( 'Y', $time6513before2 );
		$day65b3                           = date( 'j', $time6513before2 );
		$month65b3                         = date( 'n', $time6513before2 );
		list($b6513b2, $n6513b2, $t6513b2) = calculateMaya( $month65b3, $day65b3, $year65b3, 'yes' );

		$time6513after                     = mktime( 0, 0, 0, $month, $day, $year ) - 65 * 60 * 60 * 24 + 13 * 60 * 60 * 24;
		$year65b3                          = date( 'Y', $time6513after );
		$day65b3                           = date( 'j', $time6513after );
		$month65b3                         = date( 'n', $time6513after );
		list($b6513b3, $n6513b3, $t6513b3) = calculateMaya( $month65b3, $day65b3, $year65b3, 'yes' );

		$timeForTrecana1                         = mktime( 0, 0, 0, $month, $day, $year ) - ( $values['number'] - 1 ) * 60 * 60 * 24;
		$year65b3                                = date( 'Y', $timeForTrecana1 );
		$day65b3                                 = date( 'j', $timeForTrecana1 );
		$month65b3                               = date( 'n', $timeForTrecana1 );
		list($btrecana1, $ntrecana1, $ttrecana1) = calculateMaya( $month65b3, $day65b3, $year65b3, 'yes' );

		$names    = getBurcNames();
		$boxArray = array();

		if ( $n == $values['number'] && $b == $values['burc'] ) {
			$boxArray[ $day ][] = array( $day, $month, $year, $custom_tekst['tzolkin_birthday']['title'], 0, parseSpecial( $custom_tekst['tzolkin_birthday']['content'], $values ), true, '' );
		}
		if ( $n13 == $values['number'] && $b13 == $values['burc'] ) {
			$boxArray[ $day ][] = array( $day, $month, $year, $custom_tekst['left_to_birthday_13']['title'], 0, $custom_tekst['left_to_birthday_13']['content'], true, '' );
		}
		if ( ( $n65b1 == $values['number'] && $b65b1 == $values['burc'] ) || ( $n65b2 == $values['number'] && $b65b2 == $values['burc'] ) || ( $n65b3 == $values['number'] && $b65b3 == $values['burc'] ) ) {
			$boxArray[ $day ][] = array( $day, $month, $year, $custom_tekst['breakthrough_days']['title'], 0, $custom_tekst['breakthrough_days']['content'], true, '' );
		}
		if ( ( $values['number'] == $n6513b1 && $values['burc'] == $b6513b1 ) || ( $values['number'] == $n6513b2 && $values['burc'] == $b6513b2 ) || ( $values['number'] == $n6513b3 && $values['burc'] == $b6513b3 ) ) {
			$boxArray[ $day ][] = array( $day, $month, $year, $custom_tekst['left_before_day_13']['title'], 0, $custom_tekst['left_before_day_13']['content'], true, '' );
		}
		if ( $n == $values['number'] ) {
			$boxArray[ $day ][] = array( $day, $month, $year, $custom_tekst['galactic_tone']['title'], 2, parseSpecial( $custom_tekst['galactic_tone']['content'], $values ), true, '' );
		}
		if ( $b == $values['burc'] ) {
			$boxArray[ $day ][] = array( $day, $month, $year, $custom_tekst['day_sign']['title'], 1, parseSpecial( $custom_tekst['day_sign']['content'], $values ), true, '' );
		}
		if ( $b == $values['trecana'] ) {
			$boxArray[ $day ][] = array( $day, $month, $year, $custom_tekst['trecana_sign']['title'], 2, parseSpecial( $custom_tekst['trecana_sign']['content'], $values ), true, '' );
		}
		if ( $n == 1 && $b == $values['burc'] ) {
			$boxArray[ $day ][] = array( $day, $month, $year, $custom_tekst['trecanas_burc']['title'], 2, parseSpecial( $custom_tekst['trecanas_burc']['content'], $values ), true, '' );
		}
		if ( $n == 1 && $b == $values['trecana'] ) {
			$boxArray[ $day ][] = array( $day, $month, $year, $custom_tekst['trecanas']['title'], 2, parseSpecial( $custom_tekst['trecanas']['content'], $values ), true, '' );
		}
		if ( $b == $destek ) {
			if ( $level > 1 ) {
				$canView = true;
			} else {
				$canView = false;
			}
			$upgradeURL = isset($values['upgrade_to_standard']) ? $values['upgrade_to_standard'] : get_site_url() . '/shop/';

			$boxArray[ $day ][] = array( $day, $month, $year, $custom_tekst['past_sign']['title'], 2, parseSpecial( $custom_tekst['past_sign']['content'], $values ), $canView, $upgradeURL );
		}
		if ( $b == $rehber ) {
			if ( $level > 1 ) {
				$canView = true;
			} else {
				$canView = false;
			}
			$upgradeURL = isset($values['upgrade_to_standard']) ? $values['upgrade_to_standard'] : get_site_url() . '/shop/';

			$boxArray[ $day ][] = array( $day, $month, $year, $custom_tekst['destiny_sign']['title'], 2, parseSpecial( $custom_tekst['destiny_sign']['content'], $values ), $canView, $upgradeURL );
		}
		if ( $b == $erkek ) {
			if ( $level > 1 ) {
				$canView = true;
			} else {
				$canView = false;
			}
			$upgradeURL = isset($values['upgrade_to_standard']) ? $values['upgrade_to_standard'] : get_site_url() . '/shop/';

			$boxArray[ $day ][] = array( $day, $month, $year, $custom_tekst['male_sign']['title'], 2, parseSpecial( $custom_tekst['male_sign']['content'], $values ), $canView, $upgradeURL );
		}
		if ( $b == $disi ) {
			if ( $level > 1 ) {
				$canView = true;
			} else {
				$canView = false;
			}
			$upgradeURL = isset($values['upgrade_to_standard']) ? $values['upgrade_to_standard'] : get_site_url() . '/shop/';

			$boxArray[ $day ][] = array( $day, $month, $year, $custom_tekst['female_sign']['title'], 2, parseSpecial( $custom_tekst['female_sign']['content'], $values ), $canView, $upgradeURL );
		}

		if ( special_week( $month, $day, $year, $disi ) ) {
			$boxArray[ $day ][] = array( $day, $month, $year, 'Week of the ' . $names[ $disi ], 2, parseSpecial( $custom_tekst['week_of_the_female']['content'], $values ), true, '' );
		}
		if ( special_week( $month, $day, $year, $destek ) ) {
			if ( $level > 1 ) {
				$canView = true;
			} else {
				$canView = false;
			}
			$upgradeURL = isset($values['upgrade_to_standard']) ? $values['upgrade_to_standard'] : get_site_url() . '/shop/';

			$boxArray[ $day ][] = array( $day, $month, $year, 'Week of the ' . $names[ $destek ], 2, parseSpecial( $custom_tekst['week_of_the_youth']['content'], $values ), $canView, $upgradeURL );
		}
		if ( special_week( $month, $day, $year, $rehber ) ) {
			if ( $level > 1 ) {
				$canView = true;
			} else {
				$canView = false;
			}
			$upgradeURL = isset($values['upgrade_to_standard']) ? $values['upgrade_to_standard'] : get_site_url() . '/shop/';

			$boxArray[ $day ][] = array( $day, $month, $year, 'Week of the ' . $names[ $rehber ], 2, parseSpecial( $custom_tekst['week_of_the_mature']['content'], $values ), $canView, $upgradeURL );
		}
		if ( special_week( $month, $day, $year, $erkek ) ) {
			if ( $level > 1 ) {
				$canView = true;
			} else {
				$canView = false;
			}
			$upgradeURL = isset($values['upgrade_to_standard']) ? $values['upgrade_to_standard'] : get_site_url() . '/shop/';

			$boxArray[ $day ][] = array( $day, $month, $year, 'Week of the ' . $names[ $erkek ], 2, parseSpecial( $custom_tekst['week_of_the_male']['content'], $values ), $canView, $upgradeURL );
		}
		/*
		if(special_week($month, $day, $year, $disi)){
			if($level > 1) $canView = true;
			else $canView = false;

			// $result .= putItem($day,$month,$year,"Week of the ".$names[$disi],2,parseSpecial($custom_tekst['week_of_the']['content'],$values),$canView,$upgradeURL);
		}*/
		if ( $b == $mature_female_sign ) {
			if ( $level > 2 ) {
				$canView = true;
			} else {
				$canView = false;
			}
			$upgradeURL = isset($values['upgrade_to_standard']) ? $values['upgrade_to_standard'] : get_site_url() . '/shop/';

			$boxArray[ $day ][] = array( $day, $month, $year, $custom_tekst['mature_female_sign']['title'], 2, parseSpecial( $custom_tekst['mature_female_sign']['content'], $values ), $canView, $upgradeURL );
		}

		if ( $b == $childhood_male_sign ) {
			if ( $level > 2 ) {
				$canView = true;
			} else {
				$canView = false;
			}
			$upgradeURL = isset($values['upgrade_to_standard']) ? $values['upgrade_to_standard'] : get_site_url() . '/shop/';

			$boxArray[ $day ][] = array( $day, $month, $year, $custom_tekst['childhood_male_sign']['title'], 2, parseSpecial( $custom_tekst['childhood_male_sign']['content'], $values ), $canView, $upgradeURL );
		}

		if ( $b == $youth_female ) {
			if ( $level > 2 ) {
				$canView = true;
			} else {
				$canView = false;
			}
			$upgradeURL = isset($values['upgrade_to_standard']) ? $values['upgrade_to_standard'] : get_site_url() . '/shop/';

			$boxArray[ $day ][] = array( $day, $month, $year, $custom_tekst['childhood_female_sign']['title'], 2, parseSpecial( $custom_tekst['childhood_female_sign']['content'], $values ), $canView, $upgradeURL );
		}

		if ( $b == $destiny_male ) {
			if ( $level > 2 ) {
				$canView = true;
			} else {
				$canView = false;
			}
			$upgradeURL = isset($values['upgrade_to_standard']) ? $values['upgrade_to_standard'] : get_site_url() . '/shop/';

			$boxArray[ $day ][] = array( $day, $month, $year, $custom_tekst['mature_male_sign']['title'], 2, parseSpecial( $custom_tekst['mature_male_sign']['content'], $values ), $canView, $upgradeURL );
		}

		++$day;

		switch ( $month ) {
			case 1:
			case 3:
			case 5:
			case 7:
			case 8:
			case 10:
				if ( $day == 32 ) {
					$day = 1;
					++$month;
				}
				break;
			case 4:
			case 6:
			case 9:
			case 11:
				if ( $day == 31 ) {
					$day = 1;
					++$month;
				}
				break;
			case 2:
				if ( $year % 4 == 0 ) {
					if ( $day == 30 ) {
						$day = 1;
						++$month;
					}
				} elseif ( $day == 29 ) {
						++$month;
						$day = 1;
				}
				break;
			case 12:
				if ( $day == 32 ) {
					$day   = 1;
					$month = 1;
					++$year;
				}
		}

		foreach ( $boxArray as $_group ) {

			if ( sizeof( $_group ) > 0 ) {
				$result .= putItemsGroup( $_group );
			} else {
				$result .= putItem( $_item[0], $_item[1], $_item[2], $_item[3], $_item[4], $_item[5], $_item[6] );
			}
		}
	}
	return $result;
}

$oldMonth = null;
$itemID   = 0;

function putItemsGroup( $items ) {

	global $oldMonth, $itemID;

	if ( $itemID == null ) {
		$itemID = 0;
	}

	$day = $month = $year = $title = $prior = $content = $hasPermission = $upgradeURL = '';
	$url = get_site_url() . '/shop/';

	$day   = $items[0][0];
	$month = $items[0][1];
	$year  = $items[0][2];
	$prior = $items[0][4];

	foreach ( $items as $key => $_item ) {

		$hasPermission = $_item[6];
		$upgradeURL    = $_item[7];

		if ( $key > 0 ) {
			if ( sizeof( $items ) > $key + 1 ) {
				$title .= __( ', ', 'my-mayan-sign' ) . $_item[3];
			} else {
				$title .= __( ' and ', 'my-mayan-sign' ) . $_item[3];
			}

			if ( $hasPermission ) {
				$content .= '<h4>' . $_item[3] . '</h4><p>' . $_item[5] . '</p>';
			} else {
				$content .= '<h4>' . $_item[3] . '</h4><p>' . __( 'To view this please <a href="' . $upgradeURL . '">upgrade</a> your package', 'my-mayan-sign' ) . '</p>';
			}
		} else {
			$title = $_item[3];

			if ( sizeof( $items ) > 1 ) {
				$content = '<h4>' . $_item[3] . '</h4>';
			}

			if ( $hasPermission ) {
				$content .= '<p>' . $_item[5] . '</p>';
			} else {
				$content .= '<p>' . __( 'To view this please <a href="' . $upgradeURL . '">upgrade</a> your package.', 'my-mayan-sign' ) . '</p>';
			}
		}

		$prior = $_item[4];
	}

	$monthText = '';

	switch ( $month ) {
		case 1:
			$monthText = __( 'JANUARY', 'my-mayan-sign' );
			break;
		case 2:
			$monthText = __( 'FEBRUARY', 'my-mayan-sign' );
			break;
		case 3:
			$monthText = __( 'MARCH', 'my-mayan-sign' );
			break;
		case 4:
			$monthText = __( 'APRIL', 'my-mayan-sign' );
			break;
		case 5:
			$monthText = __( 'MAY', 'my-mayan-sign' );
			break;
		case 6:
			$monthText = __( 'JUNE', 'my-mayan-sign' );
			break;
		case 7:
			$monthText = __( 'JULY', 'my-mayan-sign' );
			break;
		case 8:
			$monthText = __( 'AUGUST', 'my-mayan-sign' );
			break;
		case 9:
			$monthText = __( 'SEPTEMBER', 'my-mayan-sign' );
			break;
		case 10:
			$monthText = __( 'OCTOBER', 'my-mayan-sign' );
			break;
		case 11:
			$monthText = __( 'NOVEMBER', 'my-mayan-sign' );
			break;
		case 12:
			$monthText = __( 'DECEMBER', 'my-mayan-sign' );
			break;
	}

	switch ( $prior ) {

		case 0:
			$titleWithPrior = '<span style="color:#9c1e21; font-weight:bold">' . $title . '</span>';
			break;
		case 1:
			$titleWithPrior = '<span style="font-weight:bold">' . $title . '</span>';
			break;
		case 2:
			$titleWithPrior = $title;
			break;

	}
	$result = '';
	$margin = '';

	if ( $oldMonth != null && $oldMonth != $month ) {
		$margin = 'margin-top:40px';
	}

	$result .= '<div class="accordion-item" style="' . $margin . '">';
	$result .= '<div class="accordion-item_date">';
	$result .= '    <ul>';
	$result .= '        <li><p>' . $monthText . '</p></li>';
	$result .= '        <li><p>' . $day . '</p></li>';
	$result .= '        <li><p>' . $year . '</p></li>';
	$result .= '        </ul>';
	$result .= '</div>';

	$result .= '<div class="accordion-item_heading"><a href="#">' . $titleWithPrior . '</a></div>';
	$result .= '</div>';

	if ( $content != null ) {
		$result .= '<div id="ic' . $itemID . '"class="itemcontent">' . $content . '</div>';
	}

	$oldMonth = $month;
	++$itemID;

	return $result;
}

$oldMonth = null;
$itemID   = 0;

function putItem( $day, $month, $year, $title, $prior, $content, $hasPermission, $upselURL ) {

	global $oldMonth, $itemID;

	if ( $itemID == null ) {
		$itemID = 0;
	}

	$monthText = '';

	switch ( $month ) {
		case 1:
			$monthText = __( 'JANUARY', 'my-mayan-sign' );
			break;
		case 2:
			$monthText = __( 'FEBRUARY', 'my-mayan-sign' );
			break;
		case 3:
			$monthText = __( 'MARCH', 'my-mayan-sign' );
			break;
		case 4:
			$monthText = __( 'APRIL', 'my-mayan-sign' );
			break;
		case 5:
			$monthText = __( 'MAY', 'my-mayan-sign' );
			break;
		case 6:
			$monthText = __( 'JUNE', 'my-mayan-sign' );
			break;
		case 7:
			$monthText = __( 'JULY', 'my-mayan-sign' );
			break;
		case 8:
			$monthText = __( 'AUGUST', 'my-mayan-sign' );
			break;
		case 9:
			$monthText = __( 'SEPTEMBER', 'my-mayan-sign' );
			break;
		case 10:
			$monthText = __( 'OCTOBER', 'my-mayan-sign' );
			break;
		case 11:
			$monthText = __( 'NOVEMBER', 'my-mayan-sign' );
			break;
		case 12:
			$monthText = __( 'DECEMBER', 'my-mayan-sign' );
			break;
	}

	switch ( $prior ) {

		case 0:
			$titleWithPrior = '<span style="color:#9c1e21; font-weight:bold">' . $title . '</span>';
			break;
		case 1:
			$titleWithPrior = '<span style="font-weight:bold">' . $title . '</span>';
			break;
		case 2:
			$titleWithPrior = $title;
			break;

	}
	$result = '';
	$margin = '';

	if ( $oldMonth != null && $oldMonth != $month ) {
		$margin = 'margin-top:40px';
	}

	$result .= '<div class="accordion-item" style="' . $margin . '">';
	$result .= '<div class="accordion-item_date">';
	$result .= '    <ul>';
	$result .= '        <li><p>' . $monthText . '</p></li>';
	$result .= '        <li><p>' . $day . '</p></li>';
	$result .= '        <li><p>' . $year . '</p></li>';
	$result .= '        </ul>';
	$result .= '</div>';

	$result .= '<div class="accordion-item_heading"><a href="#">' . $titleWithPrior . '</a></div>';
	$result .= '</div>';

	$url = $upselURL;// get_site_url() . '/shop/';

	if ( $content != null ) {
		if ( $hasPermission ) {
			$result .= '<div id="ic' . $itemID . '"class="itemcontent">' . $content . '</div>';
		} else {
			$result .= '<div id="ic' . $itemID . '"class="itemcontent">To view this please <a href="' . $url . '">upgrade</a> your package</div>';
		}
	}

	$oldMonth = $month;
	++$itemID;

	return $result;
}

function putItemold( $day, $month, $year, $title, $prior, $content = null ) {

	global $oldMonth, $itemID;

	if ( $itemID == null ) {
		$itemID = 0;
	}

	$monthText = '';

	switch ( $month ) {
		case 1:
			$monthText = __( 'JANUARY', 'my-mayan-sign' );
			break;
		case 2:
			$monthText = __( 'FEBRUARY', 'my-mayan-sign' );
			break;
		case 3:
			$monthText = __( 'MARCH', 'my-mayan-sign' );
			break;
		case 4:
			$monthText = __( 'APRIL', 'my-mayan-sign' );
			break;
		case 5:
			$monthText = __( 'MAY', 'my-mayan-sign' );
			break;
		case 6:
			$monthText = __( 'JUNE', 'my-mayan-sign' );
			break;
		case 7:
			$monthText = __( 'JULY', 'my-mayan-sign' );
			break;
		case 8:
			$monthText = __( 'AUGUST', 'my-mayan-sign' );
			break;
		case 9:
			$monthText = __( 'SEPTEMBER', 'my-mayan-sign' );
			break;
		case 10:
			$monthText = __( 'OCTOBER', 'my-mayan-sign' );
			break;
		case 11:
			$monthText = __( 'NOVEMBER', 'my-mayan-sign' );
			break;
		case 12:
			$monthText = __( 'DECEMBER', 'my-mayan-sign' );
			break;
	}

	switch ( $prior ) {

		case 0:
			$titleWithPrior = '<span style="color:#9c1e21; font-weight:bold">' . $title . '</span>';
			break;
		case 1:
			$titleWithPrior = '<span style="font-weight:bold">' . $title . '</span>';
			break;
		case 2:
			$titleWithPrior = $title;
			break;

	}

	?>
	<div class="accordion-item" style="
	<?php
	if ( $oldMonth != null && $oldMonth != $month ) {
		?>
		margin-top:40px 
												<?php
	}
	?>
																																																																																																															">
		<div class="accordion-item_date">
			<ul>
				<li>
				<p><?php echo $monthText; ?></p>
				</li>
				<li>
				<p><?php echo $day; ?></p>
				</li>
				<li>
				<p><?php echo $year; ?></p>
				</li>
			</ul>
		</div>
		<div class="accordion-item_heading"><a href="#"><?php echo $titleWithPrior; ?></a></div>
	</div>
	<?php if ( $content != null ) { ?>
		<div id="ic<?php echo $itemID; ?>"class="itemcontent"><?php echo $content; ?></div>
		<?php
	}
	?>

	<?php

			$oldMonth = $month;
			++$itemID;
}

function parseSpecial( $input, $values, $cat = 'genel' ) {
	$burcNames = getBurcNames();

	// Debug: Log the structure of $burcNames and $values to understand the mismatch
    // error_log("burcNames: " . print_r($burcNames, true));
    // error_log("values: " . print_r($values, true));

    // Helper function to safely get a name from $burcNames
    $getSafeName = function ($key) use ($burcNames) {
        if (is_numeric($key) && isset($burcNames[$key])) {
            return $burcNames[$key];
        } elseif (is_string($key) && in_array($key, $burcNames)) {
            return $key; // If $key is already a name, return it
        }
        return "Unknown"; // Fallback for undefined keys
    };

	// $input = str_replace( '$(number)', $values['number'], $input );
	// $input = str_replace( '$(burc)', $burcNames[ $values['burc'] ], $input );
	// $input = str_replace( '$(tracanaName)', $burcNames[ $values['tracana'] ], $input );
	// // ------------------- not the same
	// $input = str_replace( '$(trecanaName)', $burcNames[ $values['trecana'] ], $input );

	// $input = str_replace( '{sign}', $burcNames[ $values['burc'] ], $input );
	// $input = str_replace( '{disi}', $burcNames[ $values['disi'] ], $input );
	// $input = str_replace( '{erkek}', $burcNames[ $values['erkek'] ], $input );
	// $input = str_replace( '{destek}', $burcNames[ $values['destek'] ], $input );
	// $input = str_replace( '{rehber}', $burcNames[ $values['rehber'] ], $input );

	$input = str_replace("\$(number)", $values["number"] ?? "", $input);
    $input = str_replace("\$(burc)", $getSafeName($values["burc"] ?? ""), $input);
    $input = str_replace("\$(tracanaName)", $getSafeName($values["tracana"] ?? ""), $input);
	// // ------------------- not the same
    $input = str_replace("\$(trecanaName)", $getSafeName($values["trecana"] ?? ""), $input);

    $input = str_replace("{sign}", $getSafeName($values["burc"] ?? ""), $input);
    $input = str_replace("{disi}", $getSafeName($values["disi"] ?? ""), $input);
    $input = str_replace("{erkek}", $getSafeName($values["erkek"] ?? ""), $input);
    $input = str_replace("{destek}", $getSafeName($values["destek"] ?? ""), $input);
    $input = str_replace("{rehber}", $getSafeName($values["rehber"] ?? ""), $input);

	// $input = str_replace("\$(tracana)",$cat($values[ "tracana"]),$input);
	// $input = str_replace("\$(trecana)",$cat($values[ "tracana"]),$input);

	$destek = $values['burc'] - 8;
	if ( $destek < 1 ) {
		$destek += 20;
	}
	$rehber = $values['burc'] + 8;
	if ( $rehber > 20 ) {
		$rehber -= 20;
	}
	$disi = $values['burc'] + 6;
	if ( $disi > 20 ) {
		$disi -= 20;
	}
	$erkek = $values['burc'] - 6;
	if ( $erkek < 1 ) {
		$erkek += 20;
	}

	$core = $values['burc'];

	$youth_female = $core - 2;
	if ( $youth_female < 1 ) {
		$youth_female += 20;
	}

	$youth_male = $core - 14;
	if ( $youth_male < 1 ) {
		$youth_male += 20;
	}

	$mature_female = $core + 14;
	if ( $mature_female > 20 ) {
		$mature_female -= 20;
	}

	$mature_male = $core + 2;
	if ( $mature_male > 20 ) {
		$mature_male -= 20;
	}

	$input = str_replace( '{youth_female}', $burcNames[ $youth_female ], $input );
	$input = str_replace( '{youth_male}', $burcNames[ $youth_male ], $input );
	$input = str_replace( '{mature_female}', $burcNames[ $mature_female ], $input );
	$input = str_replace( '{mature_male}', $burcNames[ $mature_male ], $input );

	// echo "<br/>".$destek;

	// $input = str_replace("\$(destek)",$cat($destek),$input);
	$input = str_replace( '$(destekName)', $burcNames[ $destek ], $input );
	// $input = str_replace("\$(rehber)",$cat($rehber),$input);
	$input = str_replace( '$(rehberName)', $burcNames[ $rehber ], $input );
	// $input = str_replace("\$(disi)",$cat($disi),$input);
	$input = str_replace( '$(disiName)', $burcNames[ $disi ], $input );
	// $input = str_replace("\$(erkek)",$cat($erkek),$input);
	$input = str_replace( '$(erkekName)', $burcNames[ $erkek ], $input );
	/*
	$input = str_replace("\$(destekdemo)",demo($destek),$input);
	$input = str_replace("\$(rehberdemo)",demo($rehber),$input);
	$input = str_replace("\$(disidemo)",demo($disi),$input);
	$input = str_replace("\$(erkekdemo)",demo($erkek),$input);
	 */
	/*
	$input = str_replace("\$(teracana-image)",image1($values),$input);
	$input = str_replace("\$(ozimage)",image("oz","burc",$values),$input);
	$input = str_replace("\$(noimage)",image("sayi","number",$values),$input);
	$input = str_replace("\$(yonimage)",image("yon","burc",$values),$input);
	 */
	// $first = strpos($input,"<value>")+7;
	// $end   = strpos($input,"</value>");

	// $input = str_replace("<value>".substr($input,$first,$end-$first)."</value>",image2("oz",substr($input,$first,$end-$first)),$input);
	// $input = str_replace("\$(tracanaDemo)",demo($values[ "tracana"]),$input);
	// $input = str_replace("\$(tracanaDemo)",demo($values[ "tracana"]),$input);
	return $input;
}

<?php

/**
 * Provides all functionality for my mayan sign required custom post types
 *
 * @link       http://pixel-industry.com/
 * @since      1.0.0
 *
 * @package    My_Mayan_Sign
 * @subpackage My_Mayan_Sign/includes
 */

/**
 * Provides all functionality for my mayan sign required custom post types
 *
 * @since      1.0.0
 * @package    My_Mayan_Sign
 * @subpackage My_Mayan_Sign/includes
 * @author     PIXEL INDUSTRY <info@http://pixel-industry.com>
 */

// require_once WP_CONTENT_DIR . '/plugins/advanced-custom-fields/acf.php';
// require_once WP_CONTENT_DIR . '/plugins/advanced-custom-fields-pro/includes/api/api-template.php';
/*
 * Signs custom post type creation
 */
add_action( 'init', 'mymasi_signs_cpt' );

function mymasi_signs_cpt() {
	register_post_type(
		'signs',
		array(
			'labels'        => array(
				'name'          => 'Sign',
				'singular_name' => 'Signs',
			),
			'show_in_menu'  => 'mymasi-top-level-menu',
			'description'   => 'Here will be a short desctiption for signs',
			'public'        => true,
			'menu_position' => 10,
			'has_archive'   => false,
			'public'        => false,
			'show_ui'       => true,
			'supports'      => array( 'title', 'editor', 'thumbnail', 'revisions' ),
		)
	);
}

/*
 * Trecana custom post type creation
 */
add_action( 'init', 'mymasi_numbers_cpt' );

function mymasi_numbers_cpt() {
	register_post_type(
		'numbers',
		array(
			'labels'        => array(
				'name'          => 'Number',
				'singular_name' => 'Numbers',
			),
			'show_in_menu'  => 'mymasi-top-level-menu',
			'description'   => 'Here will be a short desctiption for numbers',
			'public'        => true,
			'menu_position' => 11,
			'has_archive'   => false,
			'public'        => false,
			'show_ui'       => true,
			'supports'      => array( 'title', 'editor', 'thumbnail', 'revisions' ),
		)
	);
}

/*
 * Synthesis custom post type creation
 */
add_action( 'init', 'mymasi_synthesis_cpt' );

function mymasi_synthesis_cpt() {
	register_post_type(
		'synthesis',
		array(
			'labels'        => array(
				'name'          => 'Synthesis',
				'singular_name' => 'Synthesis',
			),
			'show_in_menu'  => 'mymasi-top-level-menu',
			'description'   => 'Here will be a short desctiption for Synthesis',
			'public'        => true,
			'menu_position' => 14,
			'has_archive'   => false,
			'public'        => false,
			'show_ui'       => true,
			'supports'      => array( 'title', 'editor', 'thumbnail', 'revisions' ),
		)
	);
}

/*
 * Night Lord custom post type creation
 */
add_action( 'init', 'mymasi_night_lord_cpt' );

function mymasi_night_lord_cpt() {
	register_post_type(
		'night_lord',
		array(
			'labels'        => array(
				'name'          => 'Night Lords',
				'singular_name' => 'Night Lord',
			),
			'show_in_menu'  => 'mymasi-top-level-menu',
			'description'   => 'Here will be a short desctiption for Night Lords',
			'public'        => true,
			'menu_position' => 15,
			'has_archive'   => false,
			'public'        => false,
			'show_ui'       => true,
			'supports'      => array( 'title', 'editor', 'thumbnail', 'revisions' ),
		)
	);
}

/*
 * Today in Mayan Calendar custom post type creation
 */
add_action( 'init', 'mymasi_today_in_mc_cpt' );

function mymasi_today_in_mc_cpt() {
	register_post_type(
		'today_in_mc',
		array(
			'labels'        => array(
				'name'          => 'Today in Mayan Calendar',
				'singular_name' => 'Today in Mayan Calendar',
			),
			'show_in_menu'  => 'mymasi-top-level-menu',
			'description'   => 'Here will be a short desctiption for Today in Mayan Calendar',
			'public'        => true,
			'menu_position' => 16,
			'has_archive'   => false,
			'public'        => false,
			'show_ui'       => true,
			'supports'      => array( 'title', 'editor', 'thumbnail', 'revisions' ),
		)
	);
}

/*
 * Competency Analysis custom post type
 */
add_action( 'init', 'mymasi_compentency_analysis_cpt' );

function mymasi_compentency_analysis_cpt() {
	register_post_type(
		'compentency_analysis',
		array(
			'labels'        => array(
				'name'          => 'Competency Analysis',
				'singular_name' => 'Competency Analysis',
			),
			'show_in_menu'  => 'mymasi-top-level-menu',
			'description'   => 'Here will be a short desctiption for Competency Analysis',
			'public'        => true,
			'menu_position' => 17,
			'has_archive'   => false,
			'public'        => false,
			'show_ui'       => true,
			'supports'      => array( 'title', 'author' ),
		)
	);
}

/*
 * Competency Analysis Signs custom post type
 */
add_action( 'init', 'mymasi_compentency_analysis_signs_cpt' );

function mymasi_compentency_analysis_signs_cpt() {
	register_post_type(
		'ca_sign',
		array(
			'labels'        => array(
				'name'          => 'Competency Analysis Sign',
				'singular_name' => 'Competency Analysis Sign',
			),
			'show_in_menu'  => 'mymasi-top-level-menu',
			'description'   => 'Here will be a short desctiption for Competency Analysis Sign',
			'public'        => true,
			'menu_position' => 18,
			'has_archive'   => false,
			'public'        => false,
			'show_ui'       => true,
			'supports'      => array( 'title', 'editor', 'thumbnail', 'revisions' ),
		)
	);
}

/*
 * Competency Analysis Tones custom post type
 */
add_action( 'init', 'mymasi_compentency_analysis_tones_cpt' );

function mymasi_compentency_analysis_tones_cpt() {
	register_post_type(
		'ca_tones',
		array(
			'labels'        => array(
				'name'          => 'Competency Analysis Tones',
				'singular_name' => 'Competency Analysis Tones',
			),
			'show_in_menu'  => 'mymasi-top-level-menu',
			'description'   => 'Here will be a short desctiption for Competency Analysis Tones',
			'public'        => true,
			'menu_position' => 19,
			'has_archive'   => false,
			'public'        => false,
			'show_ui'       => true,
			'supports'      => array( 'title', 'editor', 'thumbnail', 'revisions' ),
		)
	);
}

/*
 * Your custom calendar custom post type
 */
add_action( 'init', 'mymasi_your_custom_calendar_cpt' );

function mymasi_your_custom_calendar_cpt() {
	register_post_type(
		'your_custom_calendar',
		array(
			'labels'        => array(
				'name'          => 'Your custom calendar',
				'singular_name' => 'My Mayan Calendar',
			),
			'show_in_menu'  => 'mymasi-top-level-menu',
			'description'   => 'Here will be a short desctiption for your custom calendar',
			'public'        => true,
			'menu_position' => 20,
			'has_archive'   => false,
			'supports'      => array( 'title', 'editor', 'revisions' ),
		)
	);
}

/*
 * Four Directions custom post type creation
 */
// add_action( 'init', 'mymasi_trecana_cpt' );

function mymasi_trecana_cpt() {
	register_post_type(
		'trecana',
		array(
			'labels'        => array(
				'name'          => 'Trecana',
				'singular_name' => 'Trecanas',
			),
			'show_in_menu'  => 'mymasi-top-level-menu',
			'description'   => 'Here will be a short desctiption for Trecanas',
			'public'        => true,
			'menu_position' => 12,
			'has_archive'   => false,
			'public'        => false,
			'show_ui'       => true,
			'supports'      => array( 'title', 'editor', 'thumbnail', 'revisions' ),
		)
	);
}

/*
 * Static texts custom post type
 */
add_action( 'init', 'mymasi_static_text_cpt' );

function mymasi_static_text_cpt() {
	register_post_type(
		'static_text',
		array(
			'labels'        => array(
				'name'          => 'Static Texts',
				'singular_name' => 'Static Text',
			),
			'show_in_menu'  => 'mymasi-top-level-menu',
			'description'   => 'All the text we need for my mayan sings web page.',
			'public'        => true,
			'menu_position' => 21,
			'has_archive'   => false,
			'public'        => false,
			'show_ui'       => true,
			'supports'      => array( 'title', 'editor', 'revisions' ),
		)
	);
}


/**
 * Today in Mayan Calendar CPT column
 */
// Add the custom columns to the today_in_mc post type:
add_filter( 'manage_today_in_mc_posts_columns', 'set_custom_edit_mms_today_in_mc_columns' );

function set_custom_edit_mms_today_in_mc_columns( $columns ) {
	$columns['day'] = __( 'Day', 'mms' );
	return $columns;
}

// Add the data to the custom columns for the today_in_mc post type:
add_action( 'manage_today_in_mc_posts_custom_column', 'mms_today_in_mc_column', 10, 2 );

function mms_today_in_mc_column( $column, $post_id ) {
	switch ( $column ) {
		case 'day':
			the_field( 'number', $post_id );
			break;
	}
}

/*
 * Static texts custom post type
 */
add_action( 'init', 'mymasi_cron_log_cpt' );

function mymasi_cron_log_cpt() {
	register_post_type(
		'mms_cron_log',
		array(
			'labels'        => array(
				'name'          => 'CRON Log',
				'singular_name' => 'CRON Log',
			),
			'show_in_menu'  => 'mymasi-top-level-menu',
			'description'   => '',
			'public'        => true,
			'menu_position' => 21,
			'has_archive'   => false,
			'public'        => false,
			'show_ui'       => true,
			'supports'      => array( 'title', 'editor', 'custom-fields' ),
		)
	);
}

/*
 * Static texts custom post type
 */
add_action( 'init', 'mymasi_mms_user_email_notifications' );

function mymasi_mms_user_email_notifications() {
	register_post_type(
		'mms_user_email',
		array(
			'labels'        => array(
				'name'          => 'User Notifications',
				'singular_name' => 'User Notifications',
			),
			'show_in_menu'  => 'mymasi-top-level-menu',
			'description'   => 'List of users that are receving notifications',
			'public'        => true,
			'menu_position' => 22,
			'has_archive'   => false,
			'public'        => false,
			'show_ui'       => true,
			'supports'      => array( 'title', 'custom-fields' ),
		)
	);
}

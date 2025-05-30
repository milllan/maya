<?php
/*
 * Defining unique identifier for every product in shop
 */

 // ===================== maintenance_mode
define( 'MAINTENTANCE_MODE', false );
 // ===================== /maintenance_mode

define( 'SIMPLE_REPORT_SKU', 'MAYA-1000-10' );
define( 'STANDARD_REPORT_SKU', 'MAYA-1000-20' );
define( 'DETAILED_REPORT_SKU', 'MAYA-1000-30' );

define( 'MY_MAYAN_DATES_SKU', 'MAYA-2000-00' );
define( 'MY_MAYAN_DATES_1_SKU', 'MAYA-2000-100' );
define( 'MY_MAYAN_DATES_3_SKU', 'MAYA-2000-200' );
define( 'MY_MAYAN_DATES_6_SKU', 'MAYA-2000-300' );
define( 'MY_MAYAN_DATES_12_SKU', 'MAYA-2000-400' );
define( 'MY_MAYAN_DATES_24_SKU', 'MAYA-2000-500' );

define( 'IMPORTANT_MAYAN_DATES_SKU', 'MAYA-3000-00' );
define( 'IMPORTANT_MAYAN_DATES_1_SKU', 'MAYA-3000-1000' );
define( 'IMPORTANT_MAYAN_DATES_2_SKU', 'MAYA-3000-2000' );
define( 'IMPORTANT_MAYAN_DATES_3_SKU', 'MAYA-3000-3000' );
define( 'IMPORTANT_MAYAN_DATES_6_SKU', 'MAYA-3000-4000' );
define( 'IMPORTANT_MAYAN_DATES_12_SKU', 'MAYA-3000-5000' );

define( 'COMPENTENCY_ANALYSIS_SKU', 'MAYA-4000-00' );
define( 'COMPENTENCY_ANALYSIS_1_SKU', 'MAYA-4000-100' );
define( 'COMPENTENCY_ANALYSIS_5_SKU', 'MAYA-4000-200' );
define( 'COMPENTENCY_ANALYSIS_10_SKU', 'MAYA-4000-300' );
define( 'COMPENTENCY_ANALYSIS_30_SKU', 'MAYA-4000-400' );
define( 'OLD_CUSTOMER_CREATE_DATE', '07-01-2019' );

define( 'SIMPLE_REPORT_PRODUCT_ID', 355 );
define( 'STANDARD_REPORT_PRODUCT_ID', 359 );
define( 'DETAILED_REPORT_PRODUCT_ID', 363 );

/*
 * Defining reserved page url's
 */

define( 'COMPENTENCY_VIEW_URL', '/compentency-analysis/' );

define( 'MMS_BDAY_KEY', 'mms-bday' );

add_action( 'admin_menu', 'mymasi_menu' );

function mymasi_menu() {
	add_menu_page( 'My Mayan Sign Options', 'My Mayan Sign', 'read', 'mymasi-top-level-menu', 'mymasi_settings_view', '', 5 );

	add_submenu_page( 'mymasi-top-level-menu', 'Settings', 'Settings', 'read', 'mymasi-top-level-menu', 'mymasi_settings_view' );
}

function mymasi_settings_view() {
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	include_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/views/settings.php';

	if ( isset( $_POST['give_cust_free_sub'] ) ) {
		create_vip_order();
	}

	if ( isset( $_POST['clear_cart'] ) && isset( $_POST['clear_cart_user_id'] ) ) {
		mms_admin_clear_cart( $_POST['clear_cart_user_id'] );
	}
}

/*
 * Real cron job
 * To work propertly:
 *   - Disable the WP Cron System in wp-config.php file -> define('DISABLE_WP_CRON', true);
 *   - Setup your event code using wp_schedule_event
 *   - Define a cron job externaly (eg. /15 * * * wget -q -O - http://www.mymayansign.com/wp-cron.php?doing_wp_cron)
 */

add_action( 'mymasi_cron_event', 'mymasi_cron_job' );

function mymasi_cron_job() {
	$userPosts = mms_users_to_be_notified();

	var_dump( 'cron start...' . '<br><br>' );
	$cron_log  = 'cron start...<br><br>';
	$cron_log .= 'Users in list: ' . count( $userPosts ) . '<br><br>';

	foreach ( $userPosts as $userPost ) {
		$now           = time();
		$email         = get_field( 'user_email', $userPost->ID );
		$user          = get_user_by( 'email', $email );
		$importantDate = get_field( 'important_notification_expiration', $userPost->ID );
		$myDate        = get_field( 'my_custom_notification_expiration', $userPost->ID );

		$disableMy        = get_field( 'my_custom_notification_disable', $userPost->ID );
		$disableImportant = get_field( 'important_notification_disable', $userPost->ID );

		if ( $user ) {

			$notify = new My_Mayan_Sign_Notifications( $user->ID );

			if ( $importantDate != null ) {
				if ( strtotime( $importantDate ) > $now ) {
					if ( $disableImportant != 'disable' ) {
						$cron_log .= 'sending Important Notification for ' . $email . ' ';
						$cron_log .= $notify->handleImportantNotification() . '<br>';
					}
				}
			}

			if ( $myDate != null ) {
				if ( strtotime( $myDate ) > $now ) {
					if ( $disableMy != 'disable' ) {
						$cron_log .= 'sending My Mayan Notification for ' . $email . ' ';
						$cron_log .= $notify->handleMyMayanNotification() . '<br>';
					}
				}
			}
		} else {
			// User from this post doesn't exist
			// Send it to review
			wp_update_post(
				array(
					'ID'          => $userPost->ID,
					'post_status' => 'pending',
				)
			);
		}
	}

	mms_cron_logger( $cron_log );
}

/**
 * adds new schedules intervals for debugging cron
 */
function mms_cron_schedules( $schedules ) {
	if ( ! isset( $schedules['5min'] ) ) {
		$schedules['5min'] = array(
			'interval' => 5 * 60,
			'display'  => __( 'Once every 5 minutes' ),
		);
	}
	if ( ! isset( $schedules['30min'] ) ) {
		$schedules['30min'] = array(
			'interval' => 30 * 60,
			'display'  => __( 'Once every 30 minutes' ),
		);
	}
	return $schedules;
}
add_filter( 'cron_schedules', 'mms_cron_schedules' );

/**
 * schedule new event for cron notification sending
 */
function mms_cron_schedule_task() {
	 // wp_clear_scheduled_hook('mymasi_cron_event');
	if ( ! wp_next_scheduled( 'mymasi_cron_event' ) ) {
		wp_schedule_event( time(), 'daily', 'mymasi_cron_event' );
	}
}
add_filter( 'init', 'mms_cron_schedule_task' );

function mymasi_view( $path, $data ) {
	extract($data);
	ob_start();
	include plugin_dir_path(__DIR__) . 'public' . $path;
	return ob_get_clean();
}

/*
 *   Returnes all instances of selected custom post type
 */
function mysasi_get_custom_type( $cpt ) {
	// for Calculator page
	$purchase_label = __( 'Would you like to read more? Please click here to order.', 'my-mayan-sign' );
	// $link_to_shop = ' <a href="' . get_permalink(wc_get_page_id('shop')) . '" title="' . $purchase_label . '">&#91;...&#93;</a>';
	$link_to_shop = ' <a href="' . get_site_url() . '/get-detailed-report/" title="' . $purchase_label . '">&#91;...&#93;</a>';

	$args = array(
		'posts_per_page' => 20,
		'post_type'      => $cpt,
	);

	$posts_array = get_posts( $args );

	$result = array();

	foreach ( $posts_array as $post ) {
		$no                          = get_field( 'number', $post->ID );
		$result[ $no ]['title']      = $post->post_title;
		$result[ $no ]['content']    = str_replace( array( "\r\n", "\n", "\r" ), '<br/>', $post->post_content );
		// $result[ $no ]['minor_text'] = str_replace( array( "\r\n", "\n", "\r" ), '<br/>', get_field( 'minor_text', $post->ID ) );
		$result[ $no ]['minor_text'] = str_replace(
			array( "\r\n", "\n", "\r" ),
			'<br/>',
			get_field( 'minor_text', $post->ID ) ?? ''
		);
		
		if ( $cpt == 'synthesis' ) {
			$result[ $no ]['detailed_synthesis'] = get_field( 'detailed_synthesis', $post->ID );
		}

		$post_thumbnail_id = get_post_thumbnail_id( $post );
		if ( $post_thumbnail_id ) {
			$url                  = wp_get_attachment_image_url( $post_thumbnail_id, 'full' );
			$part                 = explode( 'wp-content', $url );
			$result[ $no ]['img'] = add_query_arg('v', filemtime($result[ $no ]['img_f']), $url);
			if ( isset( $part[1] ) ) {
				$result[ $no ]['img_f'] = $_SERVER['DOCUMENT_ROOT'] . '/wp-content' . $part[1];
			} else {
				$result[ $no ]['img_f'] = '';
			}
		}

		if ( $calc_text = get_field( 'calculator_text', $post->ID ) ) {

			$calc_text = str_replace( '...', $link_to_shop, $calc_text );
			$calc_text = str_replace( '…', $link_to_shop, $calc_text );

			$result[ $no ]['calculator_text'] = str_replace( array( "\r\n", "\n", "\r" ), '<br/>', $calc_text );
		}
	}

	return $result;
}

function mysasi_get_today_in_mayan_calendar( $day ) {
	$size = 260;
	$args = array(
		'posts_per_page' => $size,
		'post_type'      => 'today_in_mc',
	);

	$posts_array = get_posts( $args );

	$result = array();
	foreach ( $posts_array as $post ) {
		$no = get_field( 'number', $post->ID );
		if ( $day == $no ) {
			$result['title']   = $post->post_title;
			$result['content'] = str_replace( array( "\r\n", "\n", "\r" ), '<br/>', $post->post_content );

			$post_thumbnail_id = get_post_thumbnail_id( $post );
			if ( $post_thumbnail_id ) {
				$result['img'] = wp_get_attachment_image_url( $post_thumbnail_id, 'full' );
			}
			$result['day'] = $day;
			return $result;
		}
	}

	return $result;
}


/*
 *   Returnes all instances of selected custom post type
 */
function mysasi_get_your_dates_cpt() {
	$args = array(
		'posts_per_page' => 40,
		'post_type'      => 'your_custom_calendar',
	);

	$posts_array = get_posts( $args );

	$result = array();

	foreach ( $posts_array as $post ) {
		$no                       = get_field( 'id', $post->ID );
		$result[ $no ]['title']   = $post->post_title;
		$result[ $no ]['content'] = str_replace( array( "\r\n", "\n", "\r", '<p>' ), '<br>', $post->post_content );
		$result[ $no ]['content'] = str_replace( array( '</p>' ), '', $post->post_content );
	}

	return $result;
}

/*
 *   Returnes all instances of selected custom post type
 */
function mysasi_get_static_text_cpt() {
	 $args = array(
		 'posts_per_page' => 40,
		 'post_type'      => 'static_text',
	 );

	 $posts_array = get_posts( $args );

	 $result = array();

	 foreach ( $posts_array as $post ) {
		 $no                     = get_field( 'type_id', $post->ID );
		 $result[ $no ]['title'] = $post->post_title;
		 $result[ $no ]['text']  = str_replace( array( "\r\n", "\n", "\r" ), '<br/>', $post->post_content );
	 }

	 return $result;
}

/*
 *  Adding date of birth to register form
 */
// add_action( 'register_form', 'mymasi_register_form' );
function mymasi_register_form() {
	$date_of_birth = ( ! empty( $_POST['date_of_birth'] ) ) ? sanitize_text_field( $_POST['date_of_birth'] ) : '';
	?>
	  <p>
		  <label for="date_of_birth"><?php _e( 'Birthday', 'my-mayan-sign' ); ?><br />
			  <input type="text" name="date_of_birth" id="date_of_birth" class="input" value="<?php echo esc_attr( $date_of_birth ); ?>" size="25" /></label>
	  </p>
	<?php

}

/*
 *  Validating date of birth after register form is subbmited
 */
// add_filter( 'registration_errors', 'mymasi_registration_errors', 10, 3 );
function mymasi_registration_errors( $errors, $sanitized_user_login, $user_email ) {
	if ( empty( $_POST['date_of_birth'] ) || ! empty( $_POST['date_of_birth'] ) && trim( $_POST['date_of_birth'] ) == '' ) {
		$errors->add( 'date_of_birth_error', sprintf( '<strong>%s</strong>: %s', __( 'ERROR', 'my-mayan-sign' ), __( 'You must include a first name.', 'my-mayan-sign' ) ) );
	}

	return $errors;
}

/*
 *  Save date of birth to users meta table
 */
// add_action( 'user_register', 'mymasi_user_register' );
function mymasi_user_register( $user_id ) {
	if ( ! empty( $_POST['date_of_birth'] ) ) {
		update_user_meta( $user_id, 'date_of_birth', sanitize_text_field( $_POST['date_of_birth'] ) );
	}
}

function mymasi_memberships( $user_id ) {
	$result = array();
	foreach ( wc_memberships_get_user_active_memberships( 1 ) as $membership ) {
		$product  = $membership->get_product();
		$data     = $product->get_data();
		$result[] = explode( '-', $data['sku'] );

	}
	return $result;
}


function mymasi_get_products( $user ) {
	 $result = array();
	  // $user = wp_get_current_user();
	$args = array(
		'post_type'   => 'product_variation',
		'post_status' => 'publish',
	);
	$loop = new WP_Query( $args );

	$_pf = new WC_Product_Factory();
	while ( $loop->have_posts() ) :
		$loop->the_post();
		$theid = get_the_ID();

		if ( wc_customer_bought_product( $user->user_email, $user->ID, $theid ) ) {
			$product      = $_pf->get_product( $theid );
			$product_data = explode( '-', $product->get_sku() );
			$result[]     = array( $theid, $product->get_sku(), get_post_meta( $theid, 'wccpf_your_birthday' ) );
		}
	endwhile;

	wp_reset_postdata();

	return $result;
}

function mymasi_fill_product_data($id, $force = false) {
	$order = null;
    try {
		if (!is_numeric($id) || $id <= 0) {
            throw new Exception("Invalid order item ID: $id");
        }
        $order_item = new WC_Order_Item_Product($id);
        if (!$order_item->get_id()) {
            throw new Exception("Order item not found for ID: $id");
        }
        $order = $order_item->get_order();
        if (!$order || !is_a($order, 'WC_Order')) {
            throw new Exception("Order not found or invalid for ID: $id");
        }

        $product = $order_item->get_product();
        if (!empty($product)) {
            $sku = $product->get_sku();
        } else {
            // error_log('Product SKU is not set for ID: ' . $id);
            $sku = '';
        }

        $order_data = $order->get_data();
    } catch (Exception $e) {
        error_log('--------- mymasi_fill_product_data try-catch redirect --------- ID: ' . $id);
        if (isset($order) && is_a($order, 'WC_Order')) {
            error_log('Order ID: ' . $order->get_id());
        }
		// else {
        //     error_log('Order is not a WC_Order object: ' . var_export($order, true));
        // }
        error_log($e->getMessage());
        return [];
    }

	if ( ! $force ) {
		if ( isset( $order ) ) {
			if ( get_current_user_id() != $order->get_user_id() ) {
				if ( is_user_logged_in() ) {
					wp_redirect( get_home_url() . '/dashboard' );
				} else {
					wp_redirect( get_home_url() );
				}
				exit;
			}
		}
	}

	if ( ! empty( $order ) ) {

		$birthday = wc_get_order_item_meta( $id, MMS_BDAY_KEY );
		// $birthdayArr = explode('-', $birthday);
		$year  = substr( $birthday, 0, 4 );
		$month = substr( $birthday, 4, 2 );
		$day   = substr( $birthday, 6, 2 );

		$maya = calculateMaya( $month, $day, $year );
		$data = fillValues( $maya[0], $maya[1], $maya[2] );

		$map              = mymasi_eight_dirtection_map();
		$sign_map         = mymasi_tone_map();
		// $eight_directions = $map[ $data['burc'] ];
		$eight_directions = isset($data['burc']) && array_key_exists($data['burc'], $map) ? $map[$data['burc']] : [];
		$data['tone']     = mymasi_get_eight_tones( $month, $day, $year, 'yes' );

		$signs   = mysasi_get_custom_type( 'signs' );
		$numbers = mysasi_get_custom_type( 'numbers' );

		$data['birthday'] = $birthday;
		// $data['day_sign'] = $signs[ $data['burc'] ];
		// $data['tone_txt'] = $numbers[ $data['number'] ];
		$data['day_sign'] = isset($data['burc']) && array_key_exists($data['burc'], $signs) ? $signs[$data['burc']] : '';
    	$data['tone_txt'] = isset($data['number']) && array_key_exists($data['number'], $numbers) ? $numbers[$data['number']] : '';

		// $data['youth']          = $signs[ $eight_directions['youth'] ];
		// $data['future']         = $signs[ $eight_directions['future'] ];
		// $data['youth_male']     = $signs[ $eight_directions['youth_male'] ];
		// $data['youth_female']   = $signs[ $eight_directions['youth_female'] ];
		// $data['male']           = $signs[ $eight_directions['male'] ];
		// $data['female']         = $signs[ $eight_directions['female'] ];
		// $data['destiny_male']   = $signs[ $eight_directions['destiny_male'] ];
		// $data['destiny_female'] = $signs[ $eight_directions['destiny_female'] ];

		$data['youth'] = !empty($eight_directions) && isset($eight_directions['youth']) ? $signs[$eight_directions['youth']] : '';
		$data['future'] = !empty($eight_directions) && isset($eight_directions['future']) ? $signs[$eight_directions['future']] : '';
		$data['youth_male'] = !empty($eight_directions) && isset($eight_directions['youth_male']) ? $signs[$eight_directions['youth_male']] : '';
		$data['youth_female'] = !empty($eight_directions) && isset($eight_directions['youth_female']) ? $signs[$eight_directions['youth_female']] : '';
		$data['male'] = !empty($eight_directions) && isset($eight_directions['male']) ? $signs[$eight_directions['male']] : '';
		$data['female'] = !empty($eight_directions) && isset($eight_directions['female']) ? $signs[$eight_directions['female']] : '';
		$data['destiny_male'] = !empty($eight_directions) && isset($eight_directions['destiny_male']) ? $signs[$eight_directions['destiny_male']] : '';
		$data['destiny_female'] = !empty($eight_directions) && isset($eight_directions['destiny_female']) ? $signs[$eight_directions['destiny_female']] : '';		

		$data['life_phase'] = mymasi_life_phase( $month, $day, $year );

		$data['print_url'] = get_site_url() . '/print/?id=' . $id;

		$nonce              = wp_create_nonce( 'mms_upgrade_request' );
		$data_hash_standard = urlencode(
			base64_encode(
				json_encode(
					array(
						'subscription-id' => $order->get_order_number(),
						'report-id'       => $id,
						'product-id'      => $product->get_ID(),
						'upgrade-to'      => STANDARD_REPORT_PRODUCT_ID,
					)
				)
			)
		);

			$data_hash_detailed = urlencode(
				base64_encode(
					json_encode(
						array(
							'subscription-id' => $order->get_order_number(),
							'report-id'       => $id,
							'product-id'      => $product->get_ID(),
							'upgrade-to'      => DETAILED_REPORT_PRODUCT_ID,
						)
					)
				)
			);

			$data['upgrade_to_standard'] = get_site_url() . '/checkout-2/?upgrade-subscription=' . $data_hash_standard . '&_wpnonce=' . $nonce . '&add-to-cart=' . STANDARD_REPORT_PRODUCT_ID; // upgrade-subscription = [subscription-id, report-id, product-id]
			$data['upgrade_to_detailed'] = get_site_url() . '/checkout-2/?upgrade-subscription=' . $data_hash_detailed . '&_wpnonce=' . $nonce . '&add-to-cart=' . DETAILED_REPORT_PRODUCT_ID;
			$data['static_text']         = mysasi_get_static_text_cpt();

			// $data['trecana'] = $data['tracana'];
			// $data['tercana'] = $signs[ $data['tracana'] ];

			// $data['synthesis'] = mysasi_get_custom_type( 'synthesis' )[ $data['burc'] ];

			$data['trecana'] = $data['tracana'] ?? '';
			$data['tercana'] = isset($data['tracana']) && array_key_exists($data['tracana'], $signs) ? $signs[$data['tracana']] : '';
			$data['synthesis'] = ($synthesis = mysasi_get_custom_type('synthesis')) && isset($data['burc']) && array_key_exists($data['burc'], $synthesis) ? $synthesis[$data['burc']] : '';

			$lord_no            = mymasi_night_lord( $month, $day, $year );
			$data['night_lord'] = mysasi_get_custom_type( 'night_lord' )[ $lord_no ];

			$data['sku'] = $sku;

			$data['user_name'] = ( wp_get_current_user()->user_firstname !== '' || wp_get_current_user()->user_lastname !== '' ) ? wp_get_current_user()->user_firstname . ' ' . wp_get_current_user()->user_lastname : wp_get_current_user()->display_name;

			$data['debug'] = $order;

			return $data;
	} else {
		error_log( '--------- mymasi_fill_product_data empty $order ---------' . $order );  // added  17-10-2023
		return array();
	}
}

function mymasi_fill_data_from_date( $d, $m, $y ) {
	 $maya = calculateMaya( $m, $d, $y );
	$data  = fillValues( $maya[0], $maya[1], $maya[2] );

	$map              = mymasi_eight_dirtection_map();
	$sign_map         = mymasi_tone_map();
	$eight_directions = $map[ $data['burc'] ];
	$data['tone']     = mymasi_get_eight_tones( $m, $d, $y, 'yes' );

	$signs   = mysasi_get_custom_type( 'signs' );
	$numbers = mysasi_get_custom_type( 'numbers' );

	$data['day_sign'] = $signs[ $data['burc'] ];
	$data['tone_txt'] = $numbers[ $data['number'] ];

	$data['youth']          = $signs[ $eight_directions['youth'] ];
	$data['future']         = $signs[ $eight_directions['future'] ];
	$data['youth_male']     = $signs[ $eight_directions['youth_male'] ];
	$data['youth_female']   = $signs[ $eight_directions['youth_female'] ];
	$data['male']           = $signs[ $eight_directions['male'] ];
	$data['female']         = $signs[ $eight_directions['female'] ];
	$data['destiny_male']   = $signs[ $eight_directions['destiny_male'] ];
	$data['destiny_female'] = $signs[ $eight_directions['destiny_female'] ];

	$data['life_phase'] = mymasi_life_phase( $m, $d, $y, 'yes' );

	$trecana = mysasi_get_custom_type( 'signs' );

	$data['trecana'] = $trecana[ $data['tracana'] ];
	$data['tercana'] = $signs[ $data['tracana'] ];

	return $data;
}

function mymasi_get_my_reports( $user_id ) {
	if ( ! $user_id ) {
		return;
	}

	// Get all customers subscriptions
	$customer_subscriptions = get_posts(
		array(
			'numberposts' => -1,
			'meta_key'    => '_customer_user',
			'meta_value'  => $user_id, // Or $user_id
			'post_type'   => 'shop_subscription', // WC orders post type
			'post_status' => 'wc-active', // Only orders with status "completed"
		)
	);

	$result = array();

	// Iterating through each post subscription object
	foreach ( $customer_subscriptions as $customer_subscription ) {
		// The subscription ID
		$subscription_id = $customer_subscription->ID;

		// Get an instance of the WC_Subscription Object
		$subscription = new WC_Subscription( $subscription_id );
		$orderid      = $customer_subscription->post_parent;
		$order        = new WC_Order( $orderid );

		$products = $subscription->get_items();

		// if( ! empty( $product ) ) {
		foreach ( $products as $orderkey => $product_order ) {
			$product  = $product_order->get_product();
			if ( ! $product ) {
				// error_log('Failed to retrieve product for order key: ' . $orderkey);
				continue; // Skip this iteration as the product is not valid
			}
			$order_id = $product_order->get_id();
			// echo '<pre>';
			// var_dump ($order_id);
			// echo '</pre>';

			if ( ! empty( $product ) ) {
				$thumbnail = get_the_post_thumbnail_url( $product->get_id(), 'shop_catalog' );
			} else {
				error_log( 'Product ID is not set' );
			}

			if ( ! empty( $product ) ) {
				$sku = $product->get_sku();
			} else {
				error_log( 'Product SKU is not set' );
			}
			// $sku = 'MAYA-1000-30';

			if ( mymasi_is_my_report( $sku ) ) {

				$birthday = wc_get_order_item_meta( $orderkey, MMS_BDAY_KEY );

				$tSign = $tTone = $tTrecana = $day = $month = $year = '';

				if ( $birthday != '' ) {
					$year  = substr( $birthday, 0, 4 );
					$month = substr( $birthday, 4, 2 );
					$day   = substr( $birthday, 6, 2 );

					$maya = calculateMaya( $month, $day, $year );
					$data = fillValues( $maya[0], $maya[1], $maya[2] );

					$tSign    = $data['burcName'];
					$tTone    = $data['number'];
					$tTrecana = $data['tracanaName'];
				}

				if ( ! empty( $product ) && $product->get_sku() == SIMPLE_REPORT_SKU ) {
					$report_url = get_home_url() . '/simple-report/?id=' . $orderkey;
				}
				if ( ! empty( $product ) && $product->get_sku() == STANDARD_REPORT_SKU ) {
					$report_url = get_home_url() . '/standard-report/?id=' . $orderkey;
				}
				if ( ! empty( $product ) && $product->get_sku() == DETAILED_REPORT_SKU ) {
					$report_url = get_home_url() . '/detailed-report/?id=' . $orderkey;
				}

				$is_gift = wc_get_order_item_meta( $orderkey, 'Gift to friend' );
				if ( ! $is_gift ) {
					$result[] = array(
						'id'              => $orderkey,
						'name'            => $product->get_name(),
						'sku'             => $product->get_sku(),
						'day_sign'        => $tSign,
						'subscription_id' => $subscription_id,
						'galactic_tone'   => $tTone,
						'trecana_sign'    => $tTrecana,
						'date_created'    => $order->get_date_completed(), // $order->get_date_completed()
						'date_formated'   => date( 'jS F, Y', strtotime( $day . '-' . $month . '-' . $year ) ),
						'report_url'      => $report_url,
						'date'            => $birthday,
						'thumb'           => $thumbnail,
					);
				}
			}
		}
		// }
	}
	return $result;
}

function mymasi_get_products_by_orders( $user_id ) {
	$result          = array();
	$customer_orders = get_posts(
		array(
			'numberposts' => -1,
			'meta_key'    => '_customer_user',
			'meta_value'  => $user_id, // get_current_user_id(),
			'post_type'   => wc_get_order_types(),
			'post_status' => array_keys( wc_get_order_statuses() ),
		)
	);

	foreach ( $customer_orders as $key => $post ) {
		$order = new WC_Order( $post->ID );
		foreach ( $order->get_items() as $key => $item ) {
			$product = $item->get_product();

			// Check if product exists
			if ( $product !== false ) { // 26-06-2023
				$is_gift = wc_get_order_item_meta( $key, 'Gift to friend' );
				if ( ! $is_gift ) {
					$result[] = array(
						'id'   => $key,
						'name' => $product->get_name(),
						'sku'  => $product->get_sku(),
						'date' => wc_get_order_item_meta( $key, MMS_BDAY_KEY ),
					);
				}
			}
		}
	}
	return $result;
}

/*
 * Returns the count of all Compentency Analysis  items
 */
function mymasi_count_ca_items( $user_id ) {
	$products = mymasi_get_products_by_orders( $user_id );

	$count = 0;

	foreach ( $products as $product ) {
		if ( $product['sku'] == COMPENTENCY_ANALYSIS_1_SKU ) {
			$count += 1;
		}
		if ( $product['sku'] == COMPENTENCY_ANALYSIS_5_SKU ) {
			$count += 5;
		}
		if ( $product['sku'] == COMPENTENCY_ANALYSIS_10_SKU ) {
			$count += 10;
		}
		if ( $product['sku'] == COMPENTENCY_ANALYSIS_30_SKU ) {
			$count += 30;
		}
	}

	return $count;
}

function get_disabled_notification_email() {
	$current_user = wp_get_current_user();

	$email = $current_user->user_email;

	$my_post = get_page_by_title( $email, OBJECT, 'mms_user_email' );

	if ( $my_post !== null ) {
		$post_id   = $my_post->ID;
		$my        = get_field( 'my_custom_notification_disable', $post_id );
		$important = get_field( 'important_notification_disable', $post_id );

		return array(
			'my'        => $my,
			'important' => $important,
		);
	}

	return false;
}

/*
 * We will pre initialize notifications with report purchase
 * If the user byis report and not the notification, he will
 * get a couple of months free notifications
 */
function get_notifications_from_reports( $user_id ) {
	$reports = mymasi_get_my_reports( $user_id );
	if ( empty( $reports ) ) {
		return array();
	}

	$report_first = $reports[0];// date_created
	$date_created = $report_first['date_created'];
	$date_created = explode( ' ', $date_created );
	$start        = strtotime( $date_created[0] );
	$expires      = strtotime( $date_created[0] . ' +' . mymasi_subscription_lenght( $report_first['sku'] ) . ' month' );
	$url          = get_site_url() . '/shop/';
	$status       = 'Active';
	$class        = 'active';

	$disable_text = '';
	$disable_url  = '';

	if ( time() > $expires ) {
		$class  = 'inactive';
		$status = 'Expired';
	}
	// THIS EXCLUDES ALL OLD CUSTOMERS
	if ( strtotime( $date_created[0] ) < strtotime( OLD_CUSTOMER_CREATE_DATE ) ) {
		$class  = 'inactive';
		$status = 'Expired';
	}

	$disable_text1  = '';
	$disable_url1   = '';
	$disable_class1 = '';

	$disable_text2  = '';
	$disable_url2   = '';
	$disable_class2 = '';

	if ( $class == 'active' ) {
		$disabled     = get_disabled_notification_email();
		$disable_text = 'Disable email notifications';
		if ( $disabled ) {
			if ( $disabled['my'] == 'enable' ) {
				$disable_text1  = 'Disable email notifications';
				$disable_url1   = '#one';
				$disable_class1 = 'mms_notifications_red';

			} else {
				$disable_text1  = 'Enable email notifications';
				$disable_url1   = '#three';
				$disable_class1 = 'mms_notifications_green';
			}
			if ( $disabled['important'] == 'enable' ) {
				$disable_text2  = 'Disable email notifications';
				$disable_url2   = '#two';
				$disable_class2 = 'mms_notifications_red';
			} else {
				$disable_text2  = 'Enable email notifications';
				$disable_url2   = '#four';
				$disable_class2 = 'mms_notifications_green';
			}
		}

		// $disable_url = get_site_url() . '/';
	}

	$result['my'] = array(
		'name'          => __( 'My Mayan Dates', 'my-mayan-sign' ),
		'sku'           => MY_MAYAN_DATES_1_SKU,
		'url'           => $url,
		'status'        => $status,
		'starts'        => substr( $report_first['date_created'], 0, 10 ),
		'start_date'    => date( 'jS F, Y', $start ),
		'expires'       => date( 'jS F, Y', $expires ),
		'expires_time'  => $expires,
		'next_bill'     => date( 'jS F, Y', $expires ),
		'status_class'  => $class,
		'disable_text'  => $disable_text1,
		'disable_url'   => $disable_url1,
		'disable_class' => $disable_class1,
	);
	/*
	$result['important'] = array('name' => __( "Important Mayan Dates", 'my-mayan-sign' ),
	  'sku' => IMPORTANT_MAYAN_DATES_1_SKU,
	  'url' => $url,
	  'status' => $status,
	  'starts' => substr($report_first['date_created'],0,10),
	  'start_date' => date("jS F, Y", $start),
	  'expires' => date("jS F, Y", $expires),
	  'next_bill' => date("jS F, Y", $expires),
	  'status_class' => $class,
	  'disable_text' => $disable_text2,
	  'disable_url' => $disable_url2,
	  'disable_class' => $disable_class2
	  );
	 */
	// no more free important notifications
	$result['important'] = array(
		'name'          => __( 'Important Mayan Dates', 'my-mayan-sign' ),
		'sku'           => 0,
		'url'           => $url,
		'status'        => 'Inactive',
		'starts'        => 'N/A',
		'start_date'    => 'N/A',
		'expires'       => 'N/A',
		'next_bill'     => 'N/A',
		'status_class'  => '',
		'disable_text'  => '',
		'disable_url'   => '',
		'disable_class' => '',
	);

	return $result;

}

function get_notifications_old( $user_id ) {
	$result   = get_notifications_from_reports( $user_id );
	$disabled = get_disabled_notification_email();

	$expiresMy        = 0;
	$expiresImportant = 0;

	$enableLinks  = array(
		'my'        => '#one',
		'important' => '#two',
	);
	$disableLinks = array(
		'my'        => '#three',
		'important' => '#four',
	);

	$orders = wc_get_orders(
		array(
			'customer_id' => get_current_user_id(),
			'return'      => 'ids',
		)
	);

	foreach ( $orders as $order_id ) {

		$order = new WC_Order( $order_id );
		foreach ( $order->get_items() as $key => $item ) {
			if ( $order->get_status() == 'completed' ) {
				$product = $item->get_product();

				if ( mymasi_is_my_mayan_dates_subscriber( $product->get_sku() ) || mymasi_is_important_dates_subscriber( $product->get_sku() ) ) {

					$is_gift = wc_get_order_item_meta( $key, 'Gift to friend' );
					if ( ! $is_gift ) {

						$lenght = mymasi_subscription_lenght( $product->get_sku() );

						if ( $key == 'my' ) {
							$lenght    = $lenght + $expiresMy;
							$expiresMy = $lenght;
						} else {
							$lenght           = $lenght + $expiresImportant;
							$expiresImportant = $lenght;
						}

						// 'date_formated' => date("jS F, Y", strtotime($day . '-' . $month . '-'. $year)),
						$expires = strtotime( '+' . $lenght . ' months', $order->get_date_completed() );

						$key = 'my';
						if ( mymasi_is_important_dates_subscriber( $product->get_sku() ) ) {
							$key = 'important';
						}

						if ( $key == 'my' ) {
							$disable_url = '#one';
						} else {
							$disable_url = '#two';
						}

						$disable_text = 'Disable email notifications';
						if ( $disabled ) {
							if ( $disabled[ $key ] == 'enable' ) {
								$disable_text  = 'Disable email notifications';
								$disable_url   = $enableLinks[ $key ];
								$disable_class = 'mms_notifications_red';

							} else {
								$disable_text  = 'Enable email notifications';
								$disable_url   = $disableLinks[ $key ];
								$disable_class = 'mms_notifications_green';
							}
						}

						$status = $order->get_status();

						if ( $expires > time() ) {
							$status = 'Expired';
						}

						$result[ $key ] = array(
							'name'          => $product->get_name(),
							'sku'           => $product->get_sku(),
							'url'           => get_site_url() . '/shop/',
							'status'        => $status,
							'starts'        => substr( $product->get_date_created()->__toString(), 0, 10 ),
							'start_date'    => date( 'jS F, Y', $order->get_date_completed() ),
							'expires'       => date( 'jS F, Y', $expires ),
							'expires_time'  => $expires,
							'next_bill'     => date( 'jS F, Y', $expires ),
							'status_class'  => 'active',
							'disable_text'  => $disable_text,
							'disable_url'   => $disable_url,
							'disable_class' => $disable_class,
						);
					}
				}
			}
		}
	}
	return $result;

}

function get_notifications( $user_id ) {
	$current_user = get_userdata( $user_id );
	if ( ! $current_user ) {
		return __( 'Something went wrong...' );
	}

	$result = array();

	$notif_list = mms_users_to_be_notified();
	foreach ( $notif_list as $key => $notif ) {

		$notif_id   = $notif->ID; // notification user DI
		$user_email = get_field( 'user_email', $notif_id );

		if ( $user_email == $current_user->user_email ) {

			$importantDate = get_field( 'important_notification_expiration', $notif_id );
			$myDate        = get_field( 'my_custom_notification_expiration', $notif_id );

			$disableImportant = get_field( 'important_notification_disable', $notif_id );
			$disableMy        = get_field( 'my_custom_notification_disable', $notif_id );

			if ( ! empty( $importantDate ) ) {

				if ( $disableImportant == 'enable' ) {
					$important_status       = __( 'Active', 'my-mayan-sign' );
					$important_status_class = 'active';

					$disable_text  = __( 'Disable email notifications', 'my-mayan-sign' );
					$disable_url   = '#two';
					$disable_class = 'mms_notifications_red';
				} else {
					$important_status       = __( 'Inactive', 'my-mayan-sign' );
					$important_status_class = 'inactive';

					$disable_text  = __( 'Enable email notifications', 'my-mayan-sign' );
					$disable_url   = '#four';
					$disable_class = 'mms_notifications_green';
				}

				$expired = 0;
				if ( strtotime( $importantDate ) < time() ) {
					$important_status       = __( 'Expired', 'my-mayan-sign' );
					$important_status_class = 'inactive';
					$expired                = 1;
				}

				$importantDate = strtotime( $importantDate );
				$result[]      = array(
					'notif_id'      => $notif_id,
					'name'          => mms_get_product_title_by_sku( IMPORTANT_MAYAN_DATES_SKU ),
					'sku'           => IMPORTANT_MAYAN_DATES_SKU,
					'url'           => get_permalink( wc_get_page_id( 'shop' ) ),
					'status'        => $important_status,
					'status_class'  => $important_status_class,
					'expires'       => date( 'jS F, Y', $importantDate ),
					'expires_time'  => $importantDate,
					'disable_text'  => $disable_text,
					'disable_url'   => $disable_url,
					'disable_class' => $disable_class,
					'expired'       => $expired,
				);
			}

			if ( ! empty( $myDate ) ) {

				if ( $disableMy == 'enable' ) {
					$my_status       = __( 'Active', 'my-mayan-sign' );
					$my_status_class = 'active';

					$disable_text  = __( 'Disable email notifications', 'my-mayan-sign' );
					$disable_url   = '#one';
					$disable_class = 'mms_notifications_red';
				} else {
					$my_status       = __( 'Inactive', 'my-mayan-sign' );
					$my_status_class = 'inactive';

					$disable_text  = __( 'Enable email notifications', 'my-mayan-sign' );
					$disable_url   = '#three';
					$disable_class = 'mms_notifications_green';
				}

				$expired = 0;
				if ( strtotime( $myDate ) < time() ) {
					$my_status       = __( 'Expired', 'my-mayan-sign' );
					$my_status_class = 'inactive';
					$expired         = 1;
				}

				$myDate   = strtotime( $myDate );
				$result[] = array(
					'notif_id'      => $notif_id,
					'name'          => mms_get_product_title_by_sku( MY_MAYAN_DATES_SKU ),
					'sku'           => MY_MAYAN_DATES_SKU,
					'url'           => get_permalink( wc_get_page_id( 'shop' ) ),
					'status'        => $my_status,
					'status_class'  => $my_status_class,
					'expires'       => date( 'jS F, Y', $myDate ),
					'expires_time'  => $myDate,
					'disable_text'  => $disable_text,
					'disable_url'   => $disable_url,
					'disable_class' => $disable_class,
					'expired'       => $expired,
				);
			}
		}
	}

	return $result;
}

function mms_get_product_title_by_sku( $sku ) {
	 $product_id = wc_get_product_id_by_sku( $sku );
	$product     = wc_get_product( $product_id );
	if ( $product ) {
		return $product->get_name();
	}

	return;
}

/*
 * Get's all wo users
 */
function mymasi_get_users() {
	$args = array(
		'role'         => '',
		'role__in'     => array(),
		'role__not_in' => array(),
		'meta_key'     => '',
		'meta_value'   => '',
		'meta_compare' => '',
		'meta_query'   => array(),
		'date_query'   => array(),
		'include'      => array(),
		'exclude'      => array(),
		'orderby'      => 'login',
		'order'        => 'ASC',
		'offset'       => '',
		'search'       => '',
		'number'       => '',
		'count_total'  => false,
		'fields'       => 'all',
		'who'          => '',
	);

	return get_users( $args );
}

function mymasi_is_important_dates_subscriber( $sku ) {
	return in_array(
		$sku,
		array(
			IMPORTANT_MAYAN_DATES_1_SKU,
			IMPORTANT_MAYAN_DATES_2_SKU,
			IMPORTANT_MAYAN_DATES_3_SKU,
			IMPORTANT_MAYAN_DATES_6_SKU,
			IMPORTANT_MAYAN_DATES_12_SKU,
		)
	);
}

function mymasi_is_my_mayan_dates_subscriber( $sku ) {
	return in_array(
		$sku,
		array(
			MY_MAYAN_DATES_1_SKU,
			MY_MAYAN_DATES_3_SKU,
			MY_MAYAN_DATES_6_SKU,
			MY_MAYAN_DATES_12_SKU,
			MY_MAYAN_DATES_24_SKU,
		)
	);
}
function mymasi_is_my_report( $sku ) {
	return in_array(
		$sku,
		array(
			SIMPLE_REPORT_SKU,
			STANDARD_REPORT_SKU,
			DETAILED_REPORT_SKU,
		)
	);
}

function mymasi_subscription_lenght( $sku ) {
	if ( $sku == IMPORTANT_MAYAN_DATES_1_SKU ) {
		return '1';
	}
	if ( $sku == IMPORTANT_MAYAN_DATES_2_SKU ) {
		return '2';
	}
	if ( $sku == IMPORTANT_MAYAN_DATES_3_SKU ) {
		return '3';
	}
	if ( $sku == IMPORTANT_MAYAN_DATES_6_SKU ) {
		return '4';
	}
	if ( $sku == IMPORTANT_MAYAN_DATES_12_SKU ) {
		return '12';
	}

	if ( $sku == MY_MAYAN_DATES_1_SKU ) {
		return '1';
	}
	if ( $sku == MY_MAYAN_DATES_3_SKU ) {
		return '3';
	}
	if ( $sku == MY_MAYAN_DATES_6_SKU ) {
		return '6';
	}
	if ( $sku == MY_MAYAN_DATES_12_SKU ) {
		return '12';
	}
	if ( $sku == MY_MAYAN_DATES_24_SKU ) {
		return '24';
	}

	if ( $sku == SIMPLE_REPORT_SKU ) {
		return '1';
	}
	if ( $sku == STANDARD_REPORT_SKU ) {
		return '3';
	}
	if ( $sku == DETAILED_REPORT_SKU ) {
		return '6';
	}

	return '0';
}

function mms_remove_my_account_links( $menu_links ) {
	unset( $menu_links['members-area'] ); // Membership area
	unset( $menu_links['dashboard'] ); // Dashboard
	unset( $menu_links['memberships'] ); // Memberships
	unset( $menu_links['downloads'] ); // Downloads
	return $menu_links;
}
add_filter( 'woocommerce_account_menu_items', 'mms_remove_my_account_links', 1001 );

function get_compentency_view_url( $post_id ) {
	 return get_site_url() . COMPENTENCY_VIEW_URL . '?id=' . $post_id;
}

function custom_pre_get_posts_query( $q ) {
	 $tax_query = (array) $q->get( 'tax_query' );

	$tax_query[] = array(
		'taxonomy' => 'product_cat',
		'field'    => 'slug',
		'terms'    => array( 'other' ), // Don't display products in the other category on the shop page.
		'operator' => 'NOT IN',
	);

	$q->set( 'tax_query', $tax_query );
}
add_action( 'woocommerce_product_query', 'custom_pre_get_posts_query' );

function get_compentency_analysis() {
	$args = array(
		'posts_per_page' => -1,
		'orderby'        => 'date',
		'order'          => 'DESC',
		'post_type'      => 'post',
		'post_type'      => 'compentency_analysis',
		'post_status'    => 'publish',
		'author'         => get_current_user_id(),
	);
	return get_posts( $args );
}
/*
 * This will insert custom date picker for simple standard and detailed report.
 */
function mms_custom_option() {
	$url = $_SERVER['REQUEST_URI'];

	$simple   = strpos( $url, 'simple-' );
	$standard = strpos( $url, 'standard-' );
	$detailed = strpos( $url, 'detailed-' );

	if ( ( $simple !== false ) || ( $standard !== false ) || ( $detailed !== false ) ) {
		$html = mymasi_view( '/public/views/part/date-picker-custom.php', array() );
		echo $html;
	}
}
// add_action( 'woocommerce_before_add_to_cart_button', 'mms_custom_option', 9 );

function mms_payment_complete( $order_id ) {
	// error_log('--------- woocommerce_order_status_completed ---------');
	$order = wc_get_order( $order_id );
	$email = $order->get_billing_email();
	$name  = $order->get_billing_first_name();

	foreach ( $order->get_items() as $key => $item ) {
		$product = $item->get_product();

		// error_log('--------- checking mms_user_eligible_for_notifications for :' . $email . ' - ' . $product->get_sku() . ' ---------');
		mms_user_eligible_for_notifications( $email, $product->get_sku() );
	}
}
add_action( 'woocommerce_order_status_completed', 'mms_payment_complete', 10, 1 );
// add_action( 'woocommerce_payment_complete', 'mms_payment_complete' );

function mymasi_copy_bday_on_subscription_switch( $order ) {
	// get order data and meta data
	$order_data = $order->get_data();
	$order_meta = $order_data['meta_data'];

	foreach ( $order_meta as $meta ) {

		// process only switch data
		if ( $meta->key == '_subscription_switch_data' ) {

			// get old order item id
			$old_order_item_id = reset( $meta->value );
			$old_order_item_id = $old_order_item_id['switches'];
			$old_order_item_id = reset( $old_order_item_id );
			$old_order_item_id = $old_order_item_id['remove_line_item'];

			// get new order item id
			$new_order_item_id = reset( $meta->value );
			$new_order_item_id = $new_order_item_id['switches'];
			$new_order_item_id = reset( $new_order_item_id );
			$new_order_item_id = $new_order_item_id['add_line_item'];

			$order_number = $order->get_order_number();
			$birthday     = wc_get_order_item_meta( $old_order_item_id, 'mms-bday' );

			wc_update_order_item_meta( $new_order_item_id, 'mms-bday', $birthday );

		}
	}
}
add_action( 'woocommerce_subscriptions_switch_completed', 'mymasi_copy_bday_on_subscription_switch' );

/**
 * Send report on subscription switch
 */
function mms_subscription_upgrade_send_report( $order ) {
	// error_log("mms_subscription_upgrade_send_report", 0);
	$email = $order->get_billing_email();
	$name  = $order->get_billing_first_name();

	foreach ( $order->get_items() as $key => $item ) {
		$product = $item->get_product();
		if ( $email ) {
			mms_send_pdf( $name, $email, $item->get_id(), $product->get_sku() );
		}
	}
}
add_action( 'woocommerce_subscriptions_switch_completed', 'mms_subscription_upgrade_send_report' );

function mms_send_pdf( $name, $email, $productID, $sku ) {
	$report = new My_Mayan_Sign_Report_Mailer( $name, $email );

	switch ( $sku ) {
		case SIMPLE_REPORT_SKU:
			$data    = mymasi_fill_product_data( $productID, true );
			$content = mymasi_view( '/public/report/pdf/simple.php', $data );
			$report->report_send( 'simple', $content );
			break;
		case STANDARD_REPORT_SKU:
			$data    = mymasi_fill_product_data( $productID, true );
			$content = mymasi_view( '/public/report/pdf/standard.php', $data );
			$report->report_send( 'standard', $content );
			break;
		case DETAILED_REPORT_SKU:
			$data    = mymasi_fill_product_data( $productID, true );
			$content = mymasi_view( '/public/report/pdf/detailed.php', $data );
			$report->report_send( 'detailed', $content );
			break;
	}
}

/*
 * This will insert custom email field for gifting
 */
function mms_gifting_email_field() {
	global $product;
	if ( ! $product->is_type( 'grouped' ) && ! is_single( '28444' ) && ! is_single( '28450' ) ) {

		$html = mymasi_view( '/public/views/part/gifting-email-field.php', array() );
		echo $html;
	}
}
add_action( 'woocommerce_before_add_to_cart_button', 'mms_gifting_email_field', 10 );

function test_order() {
	 // Get the $order object from an ID (if needed only)
	$order = wc_get_order( 15262 );

	// Loop through order line items
	foreach ( $order->get_items() as $item ) {
		// get order item data (in an unprotected array)
		$item_data = $item->get_data();

		// get order item meta data (in an unprotected array)
		$item_meta_data = $item->get_meta_data();

		// get only additional meta data (formatted in an unprotected array)
		$formatted_meta_data = $item->get_formatted_meta_data();

		$gift       = $item->get_meta( 'Gift this product' );
		$gift_email = $item->get_meta( 'Gift to friend' );
		// Display the raw outputs (for testing)
		echo '<pre style="max-width:80%;margin:0 auto;">';
		print_r( $item_meta_data );
		print_r( $gift );
		print_r( $gift_email );
		echo '</pre>';
	}
}
// add_action( 'wp_footer', 'test_order', 10 );
/**
 * This will generate coupon code, and send it to recipient if order is checked as gift
 */
function mms_gifting_on_order_complete( $order_id ) {
	// error_log( "Order complete for order $order_id. Gifting debugging...", 0 );
	$order     = wc_get_order( $order_id );
	$user = get_user_by( 'id', $order->get_user() );
	$user_name = $user ? $user->display_name : '';

	// $user_name = get_user_by( 'id', $order->get_user() )['display_name'];

	$gift_email = '';

	foreach ( $order->get_items() as $key => $item ) {

		$gift_email = $item->get_meta( 'Gift to friend' );
		// error_log( "friend email: $gift_email", 0 );

		if ( $gift_email !== '' ) {
			$sender_name = $order->get_billing_first_name() . ' ' . $order->get_billing_last_name();

			$coupon_url = mms_get_add_to_cart_url( mms_generate_coupon( $order_id, $item ), $item );
			// error_log( "Coupon URL: $coupon_url", 0 );

			if ( $coupon_url ) {
				$static_text        = mysasi_get_static_text_cpt();
				$gift_email_content = $static_text['gift_email']['text'];
				$gift_email_content = str_replace( '{receiver_name}', $gift_email, $gift_email_content );
				$gift_email_content = str_replace( '{sender_name}', $sender_name, $gift_email_content );

				$html = mymasi_view(
					'/public/report/email/gift.php',
					array(
						'body'   => $gift_email_content,
						'coupon' => $coupon_url,
					)
				);

				gift_send( $gift_email, $html );
			}

			// Empty cart
			try {
				if ( function_exists( 'wc_empty_cart' ) ) {
					wc_empty_cart();
				}
				// $WC_Session = new WC_Session();
				// $WC_Session->set( 'cart', array() );
				if ( isset( WC()->session ) && ! WC()->session->has_session() ) {
					WC()->session->set( 'cart', array() );
				}
			} catch ( Exception $e ) {
			}
		}
	}
	// error_log( "END of gifting debugging for order $order_id", 0 );
}
add_action( 'woocommerce_order_status_completed', 'mms_gifting_on_order_complete', 10, 1 );

/**
 * Send generated gift to recipients mail
 */
function gift_send( $email, $html ) {
	$to      = $email;
	$subject = 'MyMayanSign Gift';
	$body    = $html;
	$headers = array( 'Content-Type: text/html; charset=UTF-8' );

	$sent = wp_mail( $to, $subject, $body, $headers );
	// error_log( "email status: $sent", 0 );
}

/**
 * This generates coupon code for gift
 */
function mms_generate_coupon( $order_id, $product ) {
	if ( empty( $product ) ) {
		return false;
	}

	$coupon_code   = 'mms-' . $order_id; // Code
	$discount_type = 'percent_product'; // Type: fixed_cart, percent, fixed_product, percent_product
	$amount        = '100'; // 100% discount

	$coupon = array(
		'post_title'   => $coupon_code,
		'post_content' => '',
		'post_status'  => 'publish',
		'post_author'  => 1,
		'post_type'    => 'shop_coupon',
	);

	$new_coupon_id = wp_insert_post( $coupon );
	$coupon_url    = mms_generate_coupon_url( $coupon_code );
	$product_id    = $product->get_product_id();
	// Add meta
	update_post_meta( $new_coupon_id, 'discount_type', $discount_type );
	update_post_meta( $new_coupon_id, 'coupon_amount', $amount );
	update_post_meta( $new_coupon_id, 'individual_use', 'no' );
	update_post_meta( $new_coupon_id, 'product_ids', $product_id );
	update_post_meta( $new_coupon_id, 'exclude_product_ids', '' );
	update_post_meta( $new_coupon_id, 'usage_limit', 1 );
	update_post_meta( $new_coupon_id, 'usage_limit_per_user', 1 );
	update_post_meta( $new_coupon_id, 'expiry_date', '' );
	update_post_meta( $new_coupon_id, 'apply_before_tax', 'yes' );
	update_post_meta( $new_coupon_id, 'free_shipping', 'no' );
	update_post_meta( $new_coupon_id, 'ucfw_coupon_url', $coupon_url );
	// error_log("mms_generate_coupon: $new_coupon_id. ", 0);

	return $coupon_url;
}

/**
 * Get coupon URL for plugin UCFW
 * https://wordpress.org/plugins/url-coupons-for-woocommerce/
 */
function mms_generate_coupon_url( $coupon ) {
	$url = get_home_url() . '/coupon/?code=' . $coupon;
	// error_log( "mms_generate_coupon_url: $url. ", 0 );

	return $url;
}

/**
 * Generate add to cart URL
 */
function mms_get_add_to_cart_url( $coupon_url, $product ) {
	if ( empty( $coupon_url ) ) {
		return false;
	}

	$id              = $product->get_product_id();
	$variation_id    = $product->get_variation_id();
	$attribute_name  = 'pa_number-of-reports';
	$attribute_value = $product->get_meta( $attribute_name );
	$url             = $coupon_url;

	if ( ! empty( $id ) ) {

		$url .= '&add-to-cart=' . $id;
	}
	if ( ! empty( $variation_id ) && ! empty( $attribute_name ) && ! empty( $attribute_value ) ) {

		$url .= '&variation_id=' . $variation_id;
		$url .= '&attribute_' . $attribute_name . '=' . $attribute_value;
	}

	return $url;
}

/**
 *  This adds birthday and gender fields to WC account edit form
 */
function mms_add_date_and_gender_to_edit_account_form() {
	$gender = mms_get_user_gender();
	$date   = mms_get_user_birthday();

	echo '<div class="woocommerce-FormRow woocommerce-FormRow--first form-row half-column first-column">';
	echo mymasi_view(
		'/public/views/part/date-picker-custom.php',
		array(
			'date' => $date,
		)
	);
	echo '</div>';

	woocommerce_form_field(
		'gender',
		array(
			'type'     => 'select',
			'label'    => __( 'Gender', 'my-mayan-sign' ),
			'class'    => array( 'last form-row half-column' ),
			'required' => true,
			'options'  => array(
				''       => __( 'Please select a value', 'my-mayan-sign' ),
				'Male'   => __( 'Male', 'my-mayan-sign' ),
				'Female' => __( 'Female', 'my-mayan-sign' ),
			),
		),
		$gender
	);
}
add_action( 'woocommerce_edit_account_form', 'mms_add_date_and_gender_to_edit_account_form' );

/**
 *  save date_and_gender fields
 */
function save_date_and_gender_details( $data = array() ) {
	// $gender = isset($_POST['gender']) ? $_POST['gender'] : $data['gender'];
	$first_name = isset( $_POST['your_name'] ) ? $_POST['your_name'] : $data['first_name'];
	$bday       = isset( $_POST['your_birthday'] ) ? $_POST['your_birthday'] : $data['date'];
	$status     = array();

	// update gender
		// if (mms_set_user_gender($gender)) {
		// $status['gender'] = array(
		// 'status' => 'success'
		// );
		// } else {
		// $status['gender'] = array(
		// 'status' => 'failed',
		// );
		// }

	// update first name
	if ( mms_set_user_first_name( $first_name ) ) {
		$status['first_name'] = array(
			'status' => 'success',
		);
	} else {
		$status['first_name'] = array(
			'status' => 'failed',
		);
	}

	// update date_of_birth
	if ( mms_set_user_birthday( $bday ) ) {
		$status['birthday'] = array(
			'status' => 'success',
		);
	} else {
		$status['birthday'] = array(
			'status' => 'failed',
		);
	}
	return $status;
}
add_action( 'woocommerce_save_account_details_errors', 'save_date_and_gender_details' );

/**
 * add required fields to woocommerce acc check
 */
function custom_woocommerce_save_account_details_required_fields( $required_fields ) {
	unset( $required_fields['account_display_name'] );
	$required_fields['your_birthday'] = __( 'Date of Birth', 'my-mayan-sign' );
	$required_fields['gender']        = __( 'Gender', 'my-mayan-sign' );
	// print_r($required_fields);
	return $required_fields;
}
add_filter( 'woocommerce_save_account_details_required_fields', 'custom_woocommerce_save_account_details_required_fields' );

/**
 * Show popup to update gender and date of birth info
 */
function mms_check_for_bday_and_gender() {
	if ( ! is_user_logged_in() ) {
		return;
	}

	if ( is_page( 'dashboard' ) || is_page( 'home' ) ) {
		// if (is_page('unknown')) {

		// $gender = mms_get_user_gender();
		$bday       = mms_get_user_birthday();
		$first_name = mms_get_user_firstname();

		// if (empty($gender) || empty($bday)) {
		if ( empty( $bday ) || empty( $first_name ) ) {

			$static_text = mysasi_get_static_text_cpt();

			$form = '<form id="mms_info_form">
			  ' .
			  mymasi_view( '/public/views/part/date-picker-custom.php', array( 'date' => $bday ) )
			  .
			  mymasi_view( '/public/views/part/first-name-picker.php', array( 'first_name' => $first_name ) )
			  .
			  // mymasi_view('/public/views/part/gender-picker.php', array())
			  // .
			 '
				  <div class="one-column">
					  <input type="submit" value="Save" id="mms_save_info" class="wpcf7-form-control wpcf7-submit calendar-submit">
					  <div id="notice_holder"></div>
				  </div>

			  </form>';

			$html = mymasi_view(
				'/public/views/part/popup.php',
				array(
					'heading' => __( sprintf( '<h2>%s</h2>', $static_text['popup_bday_gender']['title'] ), 'my-mayan-sign' ),
					'body'    => __( sprintf( '<p>%s</p>', $static_text['popup_bday_gender']['text'] ), 'my-mayan-sign' ),
					'class'   => 'one_last_step',
					'form'    => $form,
				)
			);

				echo $html;
		}
	}

	echo mymasi_view( '/public/views/part/popups-email-notifications.php', array() );

}
add_action( 'wp_footer', 'mms_check_for_bday_and_gender' );

/**
 * Ajax for saving user date and gender
 */
function mms_ajax_save_info() {
	 check_ajax_referer( 'mms_save_info_ajax', 'nonce' );

	$data = isset( $_POST['data'] ) ? $_POST['data'] : false;
	if ( ! $data ) {
		wp_send_json_error( array( 'message' => __( 'Please fill the fields.', 'my-mayan-sign' ) ) );
		wp_die();
	}

	$return = save_date_and_gender_details( $data );

	if ( $return ) {
		wp_send_json_success(
			array(
				'message' => __( 'Details saved. Thank you.', 'my-mayan-sign' ),
				'return'  => $return,
			)
		);
	} else {
		wp_send_json_error(
			array(
				'message' => __( 'Someting went wrong. Please try later.', 'my-mayan-sign' ),
				'return'  => $return,
			)
		);
	}

	wp_die();
}
add_action( 'wp_ajax_mms_save_info', 'mms_ajax_save_info' );


/**
 * Show popup to update date of birth info
 */
function mms_popup_insert_bday() {
	if ( is_user_logged_in() && is_page( 'dashboard' ) ) {

		$static_text = mysasi_get_static_text_cpt();
		$form        = do_shortcode( '[mayan_sign_calculator]' );

		$html = mymasi_view(
			'/public/views/part/popup.php',
			array(
				'heading' => __( sprintf( '<h2>%s</h2>', $static_text['popup_report_date']['title'] ), 'my-mayan-sign' ),
				'body'    => __( sprintf( '<p>%s</p>', $static_text['popup_report_date']['text'] ), 'my-mayan-sign' ),
				'class'   => '',
				'form'    => $form,
			)
		);

		  echo $html;
	}
}
add_action( 'wp_footer', 'mms_popup_insert_bday' );

/**
 * get clean birthday date from user
 */
function mms_get_user_birthday() {
	global $user;
	$bday = '';

	if ( is_user_logged_in() ) {

		$date = get_user_meta( get_current_user_id(), 'date_of_birth', true );

		if ( ! empty( $date ) && validateDate( $date ) ) {
			$bday = $date;
		}
	}

	return $bday;
}

/**
 * get clean first name from user
 */
function mms_get_user_firstname() {
	 global $user;
	$first_name = '';

	if ( is_user_logged_in() ) {

		$first_name = get_user_meta( get_current_user_id(), 'first_name', true );

		// if (!empty($first_name)) {
		// $first_name = $first_name;
		// }
	}

	return $first_name;
}

/**
 * set user birthday
 */
function mms_set_user_birthday( $bday ) {
	global $user;

	if ( empty( $bday ) ) {
		return false;
	}

	$user_id = get_current_user_id();

	if ( validateDate( $bday ) ) {
		if ( update_user_meta( $user_id, 'date_of_birth', $bday ) ) {

			do_action(
				'mms_user_date_of_birth_is_set',
				array(
					'user_id' => $user_id,
					'bday'    => $bday,
				)
			);

			return true;
		}
	}

	return false;
}

/**
 * set user first name
 */
function mms_set_user_firstname( $first_name ) {
	global $user;

	if ( empty( $first_name ) ) {
		return false;
	}

	$user_id = get_current_user_id();

	// if (validateDate($first_name)) {
	if ( update_user_meta( $user_id, 'first_name', $first_name ) ) {

		do_action(
			'mms_user_date_of_birth_is_set',
			array(
				'user_id'    => $user_id,
				'first_name' => $first_name,
			)
		);

		return true;
	}
	// }

	return false;
}

/**
 * validate date format
 */
function validateDate( $date, $format = 'Ymd' ) {
	$d = DateTime::createFromFormat( $format, $date );
	return $d && $d->format( $format ) === $date;
}

/**
 * get user gender
 */
function mms_get_user_gender() {
	global $user;
	$gender = '';
	if ( is_user_logged_in() ) {

		$data                      = get_user_meta( get_current_user_id(), 'gender', true );
		! empty( $data ) ? $gender = $data : '';
	}

	return $gender;
}

/**
 * set user gender
 */
function mms_set_user_gender( $gender ) {
	if ( empty( $gender ) ) {
		return;
	}

	$user_id = get_current_user_id();

	if ( ( $gender === 'Male' || $gender === 'Female' ) ) {
		update_user_meta( $user_id, 'gender', $gender );
		return true;
	}
}

/**
 * get user first name
 */
function mms_get_user_first_name() {
	global $user;
	$first_name = '';
	if ( is_user_logged_in() ) {

		$data                          = get_user_meta( get_current_user_id(), 'first_name', true );
		! empty( $data ) ? $first_name = $data : '';
	}

	return $first_name;
}

/**
 * set user first name
 */
function mms_set_user_first_name( $first_name ) {
	if ( empty( $first_name ) ) {
		return;
	}

	$user_id = get_current_user_id();

	if ( ( ! empty( $first_name ) ) ) {
		update_user_meta( $user_id, 'first_name', $first_name );
		return true;
	}
}

function mymasi_calculator_select( $data ) {
	return My_Mayan_Sign_Pages::getCalculatorFormPage( $data );
}


/*
 *  Date of important mayan dates notification expiery
 */
function mymasi_im_expires_on() {
	$user_id  = get_current_user_id();
	$all      = get_notifications( $user_id );
	$dates    = array();
	$freeUsed = false;

	/*
	 *  Look for notification purchase
	 */
	foreach ( $all as $noty ) {
		if ( mymasi_is_important_dates_subscriber( $noty['sku'] ) ) {
			$dates[]  = $noty['expires'];
			$freeUsed = true;
		}
	}

	  /*
	 *  Look for free notification with report
	 */
	if ( ! $freeUsed ) {
		$customer_orders = get_posts(
			array(
				'numberposts' => -1,
				'meta_key'    => '_customer_user',
				'meta_value'  => $user_id,
				'post_type'   => wc_get_order_types(),
				'post_status' => 'wc-completed',
			)
		);

		foreach ( $customer_orders as $key => $post ) {
			$order = new WC_Order( $post->ID );
			foreach ( $order->get_items() as $key => $item ) {
				$product   = $item->get_product();
				$thumbnail = get_the_post_thumbnail_url( $product->get_id(), 'shop_catalog' );

				if ( mymasi_is_my_report( $product->get_sku() ) ) {
					$date     = $product->get_date_created();
					$interval = new DateInterval( 'P1M' );
					$date->add( $interval );
					$created = $date->format( 'Y-m-d' );
					$dates[] = $created;
				}
			}//foreach get_items()
		}// foreach $customer_orders
	}//if(!$freeUsed){

}

function mms_admin_clear_cart( $user_id ) {
	 $user = get_userdata( $user_id );
	if ( $user !== false ) {
		// persistent carts created in WC 3.2+
		if ( metadata_exists( 'user', $user->ID, '_woocommerce_persistent_cart_1' ) ) {
			if ( delete_user_meta( $user->ID, '_woocommerce_persistent_cart_1' ) ) {
				echo '<p>Deleted</p>';
			}
		} else {
			echo '<p>No cart data found...</p>';
		}
	} else {
		echo '<p>Wrong user ID!</p>';
	}
}

function create_vip_order() {
	global $woocommerce;
	$blogusers = get_users(
		array(
			'blog_id' => $GLOBALS['blog_id'],
			'role'    => 'customer',
			'number'  => 100,
		)
	);

	// $user = get_user_by('id', 6143);

	// Array of WP_User objects.
	foreach ( $blogusers as $user ) {

		echo '<span>' . esc_html( $user->user_email ) . '</span><br>';

		if ( date( 'Ymd', strtotime( $user->user_registered ) ) !== date( 'Ymd' ) ) {
			echo ' |-> failed.<br>';
		} else {

			echo ' |-> pass.<br>';

			$address = array(
				'first_name' => $user->display_name,
				'email'      => $user->user_email,
			);

			$default_args = array(
				'customer_id' => $user->ID,
			);

			// Now we create the order
			$order = wc_create_order( $default_args );

			// The add_product() function below is located in /plugins/woocommerce/includes/abstracts/abstract_wc_order.php
			$order->add_product( wc_get_product( STANDARD_REPORT_PRODUCT_ID ), 1 ); // This is an existing STANDARD product
			$order->set_address( $address, 'billing' );
						$order->calculate_totals();
			$order->set_status( 'wc-completed', 'Imported order, ', false );
			$order->save();

			mms_create_subscription( $order, STANDARD_REPORT_PRODUCT_ID );
		}
	}
}

function mms_create_subscription( $order, $product_id ) {
	$quantity   = 1;
	$start_date = $order->get_date_completed();

	$product = wc_get_product( $product_id );

	$period   = WC_Subscriptions_Product::get_period( $product );
	$interval = WC_Subscriptions_Product::get_interval( $product );
	$sub      = wcs_create_subscription(
		array(
			'order_id'         => $order->get_ID(),
			'billing_period'   => $period,
			'billing_interval' => $interval,
			'start_date'       => $start_date->date( 'Y-m-d H:i:s' ),
		)
	);

	$sub->add_product( $product, $quantity );
	$sub->calculate_totals();
	WC_Subscriptions_Manager::activate_subscriptions_for_order( $order );
}

/**
 * block sending all emails
 */
function disabling_emails( $args ) {
	if ( MAINTENTANCE_MODE ) {
		unset( $args['to'] );
	} else {
		if ( strpos( $_SERVER['SERVER_NAME'], 'volcanno.com' ) !== false ) {
			if ( ( strpos( $args['to'], '@pixel-industry.com' ) !== false ) || ( strpos( $args['to'], '@getnada.com' ) !== false ) || $args['to'] == 'gbanina@gmail.com' ) {
				return $args;
			} else {
				unset( $args['to'] );
			}
		}
	}

	return $args;
}
add_filter( 'wp_mail', 'disabling_emails', 10, 1 );

// Activate WordPress Maintenance Mode
function wp_maintenance_mode() {
	if ( MAINTENTANCE_MODE ) {
		if ( ! current_user_can( 'administrator' ) ) {
			wp_die(
				'<h1>We&rsquo;ll be back soon!</h1><br /><p>Sorry for the inconvenience but we&rsquo;re performing some maintenance at the moment. If you need to you can always <a href="mailto:info@mymayansign.com">contact us</a>, otherwise we&rsquo;ll be back online shortly!</p>
			<p>&mdash; The MyMayanSign Team</p>'
			);
		}
	}
}
add_action( 'get_header', 'wp_maintenance_mode' );

/*
 * Indicate maintenance mode is turned on
 */
function mms_maintenance_mode_toolbar_button( $wp_admin_bar ) {
	if ( MAINTENTANCE_MODE ) {
		$args = array(
			'id'    => 'maintenance_mode',
			'title' => '<span style="background: red;color:white">Maintenance Mode</span>',
			'meta'  => array( 'title' => 'Maintenance mode is turned on in main configuration!' ),
		);
		$wp_admin_bar->add_node( $args );
	}
}
add_action( 'admin_bar_menu', 'mms_maintenance_mode_toolbar_button', 999 );

/**
 *  CRON Log
 */
function mms_cron_logger( $content = '' ) {
	$response = wp_insert_post(
		array(
			'post_type'    => 'mms_cron_log',
			'post_status'  => 'private',
			'post_title'   => current_time( 'mysql' ),
			'post_content' => $content,
		)
	);

	// return $response;
}
// add_action('init', 'mms_cron_logger');

function mms_add_user_to_email_list( $usrEmail, $my_expiery, $important_expiery ) {
	 $current_user = get_user_by( 'email', $usrEmail );// wp_get_current_user();

	if ( ! $current_user ) {
		error_log( 'mms_add_user_to_email_list failed: ' . $usrEmail );
		return false;
	}

	$email = $current_user->user_email;
	$name  = $current_user->user_firstname;

	// update existing user entry
	$my_post = get_page_by_title( $email, OBJECT, 'mms_user_email' );

	// or create new post object
	if ( $my_post == null ) {
		$my_post = array(
			'post_title'  => wp_strip_all_tags( $email ),
			'post_type'   => 'mms_user_email',
			'post_status' => 'publish',
			'post_author' => $current_user->ID,
		);

		// Insert the post into the database
		$post_id = wp_insert_post( $my_post );

		update_field( 'my_custom_notification_disable', 'disable', $post_id );
		update_field( 'important_notification_disable', 'disable', $post_id );
	} else {
		$post_id = $my_post->ID;
	}

	update_field( 'user_email', $email, $post_id );
	update_field( 'user_name', $name, $post_id );

	if ( $important_expiery != null ) {
		update_field( 'important_notification_expiration', $important_expiery, $post_id );
		update_field( 'important_notification_disable', 'enable', $post_id );
	}
	if ( $my_expiery != null ) {
		update_field( 'my_custom_notification_expiration', $my_expiery, $post_id );
		update_field( 'my_custom_notification_disable', 'enable', $post_id );
	}

	return $post_id;
}

function mms_user_eligible_for_notifications( $email, $sku ) {
	// error_log('--------- mms_user_eligible_for_notifications --------- sku: ' . $sku);
	// calculate free period
	$month_lenght = mymasi_subscription_lenght( $sku );
	$date         = date( 'd-m-Y', strtotime( '+' . $month_lenght . ' month' ) );

	// if product is report
	if ( mymasi_is_my_report( $sku ) ) {
		  // check if it is eligible for free notifications
		$post = get_page_by_title( $email, OBJECT, 'mms_user_email' );
		if ( $post == null ) { // give free notification
			// we add user for my notifications, but not for important
			error_log( 'we add user for my notifications - email: ' . $email );
			return mms_add_user_to_email_list( $email, $date, null );
		} else {
			if ( $post->post_status !== 'publish' ) {
				wp_update_post(
					array(
						'ID'          => $post->ID,
						'post_status' => 'publish',
					)
				);
			}

			return 'user already on list';
		}
	} else { // if product is notification
		if ( mymasi_is_important_dates_subscriber( $sku ) ) {
			error_log( 'mymasi_is_important_dates_subscriber' );
			error_log( mms_add_user_to_email_list( $email, null, $date ) );
		}
		if ( mymasi_is_my_mayan_dates_subscriber( $sku ) ) {
			error_log( 'mymasi_is_my_mayan_dates_subscriber' );
			error_log( mms_add_user_to_email_list( $email, $date, null ) );
		}

		return 'notification updated';
	}
}

function mms_users_to_be_notified() {
	$posts = get_posts(
		array(
			'post_type'   => 'mms_user_email',
			'post_status' => 'publish',
			'numberposts' => -1,
		)
	);
	return $posts;
}

function mms_sample_report_links() {
	global $product;

	if ( $product->get_sku() == SIMPLE_REPORT_SKU ) {
		echo '<p><a href="' . esc_url( get_site_url() . '/wp-content/plugins/maya/public/report/pdf/samples/simple_report_sample.pdf' ) . '" target="_blank">' . _x( 'View Sample', 'my-mayan-sign' ) . '</a></p>';
	}

	if ( $product->get_sku() == STANDARD_REPORT_SKU ) {
		echo '<p><a href="' . esc_url( get_site_url() . '/wp-content/plugins/maya/public/report/pdf/samples/standard_report_sample.pdf' ) . '" target="_blank">' . _x( 'View Sample', 'my-mayan-sign' ) . '</a></p>';
	}

	if ( $product->get_sku() == DETAILED_REPORT_SKU ) {
		echo '<p><a href="' . esc_url( get_site_url() . '/wp-content/plugins/maya/public/report/pdf/samples/detailed_report_sample.pdf' ) . '" target="_blank">' . _x( 'View Sample', 'my-mayan-sign' ) . '</a></p>';
	}

	if ( $product->get_sku() == 'MAYA-4000-000' ) {
		echo '<p><a href="' . esc_url( get_site_url() . '/wp-content/uploads/competency-sample-report.pdf' ) . '" target="_blank">' . _x( 'View Sample', 'my-mayan-sign' ) . '</a></p>';
	}

}
add_filter( 'woocommerce_custom_sample_report_link', 'mms_sample_report_links' );
add_filter( 'woocommerce_single_product_summary', 'mms_sample_report_links', 30 );

/*
 * -----------------------------
 */
function mms_report_upgrade( $order_id ) {
	if ( ! wcs_get_subscriptions_for_order( $order_id ) ) {
		return $order_id;
	}

	$order         = wc_get_order( $order_id );
	$products      = $order->get_items();
	$order_user_id = $order->get_user_id();
	$order_user    = get_userdata( $order_user_id );

	$subscriptions = wcs_get_subscriptions_for_order( $order );

	foreach ( $products as $orderkey => $order_item ) {

		$item_data = wc_get_order_item_meta( $orderkey, 'mms_upgrade_request' );
		if ( ! isset( $item_data['report-id'] ) ) {
			continue;
		}

		$birthday   = wc_get_order_item_meta( $item_data['report-id'], MMS_BDAY_KEY );
		$sub_id     = $item_data['subscription-id'];
		$upgrade_to = $item_data['upgrade-to'];

		// dohvati stari subs i obriši stari report tj. produkt
		$subscriptionOld = new WC_Subscription( $sub_id );
		$sub_products    = $subscriptionOld->get_items();
		foreach ( $sub_products as $sub_key => $product_item ) {
			if ( $sub_key == $item_data['report-id'] ) {

				$subscriptionOld->add_order_note( 'Upgraded: ' . print_r( $item_data, true ) );
				$product_item->delete();
			}
		}

		// dohvati novi subs dodaj metu salji mail
		foreach ( $subscriptions as $sub_key => $single_sub ) {
			foreach ( $single_sub->get_items() as $sub_item_key => $sub_item ) {
				if ( $upgrade_to == $sub_item->get_product_id() ) {
					wc_update_order_item_meta( $sub_item_key, MMS_BDAY_KEY, $birthday );
					$single_sub->update_status( 'active' );

					$item_data['birthday'] = $birthday;
					$order->add_order_note( print_r( $item_data, true ) );

					$upgrade_to_product = wc_get_product( $upgrade_to );
					if ( ! empty( $birthday ) ) {
						mms_send_pdf( $order_user->user_firstname, $order_user->user_email, $sub_item->get_ID(), $upgrade_to_product->get_sku() );
					}

					// set a meta for PROMO users
					if ( isset( $item_data['promo'] ) ) {
						$note = sprintf( 'Promo code "%s" used in order #%s.', $item_data['promo'], $order->get_order_number() );
						add_user_meta( $order_user->ID, '_subscription_promo_upgrade_used', $note, true );
					}
				}
			}
		}
	}

	// Save the data
	$order->save();
}
add_action( 'woocommerce_order_status_completed', 'mms_report_upgrade', 5, 1 );

/**
 *  Adds meta data to product in cart
 */
function mms_add_data_to_cart_item( $cart_item_data, $product_id, $variation_id ) {
	if ( ! isset( $_GET['upgrade-subscription'] ) ) {
		return $cart_item_data;
	}

	$nonce = $_REQUEST['_wpnonce'];
	if ( wp_verify_nonce( $nonce, 'mms_upgrade_request' ) ) {

		$data = mms_decode_upgrade_data( $_GET['upgrade-subscription'] ); // [subscription-id, report-id, product-id]

		if ( is_array( $data ) ) {
			$cart_item_data['upgrade-subscription-data'] = $data;
		}
	}

	return $cart_item_data;
}
add_filter( 'woocommerce_add_cart_item_data', 'mms_add_data_to_cart_item', 10, 3 );

/**
 * just for debugging
 */
function mms_display_data_in_cart( $item_data, $cart_item ) {
	if ( empty( $cart_item['upgrade-subscription-data'] ) ) {
		return $item_data;
	}

	$item_data[] = array(
		'key'     => __( 'Debug meta' ),
		'value'   => wc_clean( print_r( $cart_item['upgrade-subscription-data'], true ) ),
		'display' => '',
	);

	return $item_data;
}
// add_filter( 'woocommerce_get_item_data', 'mms_display_data_in_cart', 10, 2 );

/**
 * Add upgrade data to order.
 *
 * @param WC_Order_Item_Product $item
 * @param string                $cart_item_key
 * @param array                 $values
 * @param WC_Order              $order
 */
function mms_add_data_to_order_items( $item, $cart_item_key, $values, $order ) {
	if ( empty( $values['upgrade-subscription-data'] ) ) {
		return;
	}

	$item->add_meta_data( 'mms_upgrade_request', $values['upgrade-subscription-data'] );
}
add_action( 'woocommerce_checkout_create_order_line_item', 'mms_add_data_to_order_items', 10, 4 );

/**
 * apply coupon if upgrading
 */
function mms_upgrade_apply_coupon() {
	$coupon_codes = mms_get_upgrade_coupon_codes();

	foreach ( WC()->cart->get_cart() as $cart_item ) {

		if ( isset( $cart_item['upgrade-subscription-data'] ) ) {

			$upgrade_data = $cart_item['upgrade-subscription-data'];

			if ( $cart_item['product_id'] == $upgrade_data['upgrade-to'] ) {

				// from simple to standard
				if ( $upgrade_data['upgrade-to'] == STANDARD_REPORT_PRODUCT_ID ) {
					if ( ! in_array( $coupon_codes[0], WC()->cart->get_applied_coupons() ) ) {
						WC()->cart->apply_coupon( $coupon_codes[0] );
					}
				}

				// from simple to detailed
				if ( $upgrade_data['upgrade-to'] == DETAILED_REPORT_PRODUCT_ID && $upgrade_data['product-id'] == SIMPLE_REPORT_PRODUCT_ID ) {
					if ( ! in_array( $coupon_codes[1], WC()->cart->get_applied_coupons() ) ) {
						WC()->cart->apply_coupon( $coupon_codes[1] );
					}
				}

				// from standard to detailed
				if ( $upgrade_data['upgrade-to'] == DETAILED_REPORT_PRODUCT_ID && $upgrade_data['product-id'] == STANDARD_REPORT_PRODUCT_ID ) {
					if ( ! in_array( $coupon_codes[2], WC()->cart->get_applied_coupons() ) ) {
						WC()->cart->apply_coupon( $coupon_codes[2] );
					}
				}

				// check if upgrade has any special coupon codes
				if ( isset( $upgrade_data['promo'] ) && ! empty( $upgrade_data['promo'] ) ) {

					$promo_coupon = new WC_Coupon( $upgrade_data['promo'] );
					$discounts    = new WC_Discounts( WC()->cart );
					$valid        = $discounts->is_coupon_valid( $promo_coupon );

					if ( ! is_wp_error( $valid ) ) {
						if ( ! in_array( $upgrade_data['promo'], WC()->cart->get_applied_coupons() ) ) {
							WC()->cart->apply_coupon( $upgrade_data['promo'] );
						}
					}
				}

				// dump_data( WC()->cart->get_applied_coupons() );
			}
		}
	}
}
add_action( 'woocommerce_check_cart_items', 'mms_upgrade_apply_coupon' );

/**
 * prevent showing coupon messages on report upgrade
 */
function mms_disable_coupon_message( $err, $err_code, $coupon ) {

	// Check if $coupon is a valid object before proceeding
	if ( ! is_object( $coupon ) || ! method_exists( $coupon, 'get_code' ) ) {
		return $err; // Return the original error/message if $coupon is not valid
	}

	$coupon_codes = mms_get_upgrade_coupon_codes();

	if ( in_array( $coupon->get_code(), $coupon_codes ) ) {
		return;
	}

	if ( $err_code == 101 ) {
		return;
	}

	return $err;
}
add_action( 'woocommerce_coupon_error', 'mms_disable_coupon_message', 10, 3 );
add_action( 'woocommerce_coupon_message', 'mms_disable_coupon_message', 10, 3 );

/**
 * return decoded hash
 */
function mms_decode_upgrade_data( $hash ) {
	 return $data = json_decode( base64_decode( $hash ), true );
}

function mms_change_order_items_name( $item_name, $cart_item, $cart_item_key ) {
	if ( isset( $cart_item['upgrade-subscription-data'] ) ) {
		// dump_data($cart_item['upgrade-subscription-data']);
		return $item_name . ' ' . _x( '(Upgrade)', 'my-mayan-sign' );
	}

	return $item_name;
};
add_filter( 'woocommerce_cart_item_name', 'mms_change_order_items_name', 10, 3 );

/**
 * Changes the coupon label
 *
 * @param string     $label the cart / checkout label
 * @param \WC_Coupon $coupon coupon object
 * @return string updated label
 */
function mms_change_coupon_preview_on_upgrade( $label, $coupon ) {
	$coupon_codes = mms_get_upgrade_coupon_codes();

	$coupon_post = get_post( $coupon->get_ID() );
	$coupon_name = ! empty( $coupon_post->post_title ) ? $coupon_post->post_title : null;

	if ( in_array( $coupon_name, $coupon_codes ) ) {
		return esc_html__( 'Upgrade discount', 'my-mayan-sign' );
	}

	return $label;
}
add_filter( 'woocommerce_cart_totals_coupon_label', 'mms_change_coupon_preview_on_upgrade', 20, 2 );

function mms_change_coupon_html_on_upgrade( $coupon_html, $coupon, $discount_amount_html ) {
	$coupon_post  = get_post( $coupon->get_ID() );
	$coupon_name  = ! empty( $coupon_post->post_title ) ? $coupon_post->post_title : null;
	$coupon_codes = mms_get_upgrade_coupon_codes();

	if ( in_array( $coupon_name, $coupon_codes ) ) {
		return $discount_amount_html;
	}

	return $coupon_html;
}
add_filter( 'woocommerce_cart_totals_coupon_html', 'mms_change_coupon_html_on_upgrade', 30, 3 );

function mms_upgrade_order_details( $order ) {
	dump_data( $order );
}
// add_filter( 'woocommerce_order_details_before_order_table_items', 'mms_upgrade_order_details', 20, 1 );

function mms_upgrade_order_item_name( $name, $item ) {
	$item_data = wc_get_order_item_meta( $item->get_ID(), 'mms_upgrade_request' );
	if ( ! empty( $item_data ) ) {
		$name = $item->get_name() . ' ' . _x( '(Upgrade)', 'my-mayan-sign' );
	}

	return $name;
}
add_filter( 'woocommerce_order_item_name', 'mms_upgrade_order_item_name', 10, 2 );

function mms_get_upgrade_coupon_codes() {
	return array(
		'upgradetostandard',
		'upgradefromsimpletodetailed',
		'upgradefromstandardtodetailed',
		'olduser',
	);
}

/**
 * Add old user to notification list
 */
function mms_add_old_user_to_notification_list( $data ) {
	if ( ! isset( $data['user_id'] ) ) {
		return false;
	}

	$user            = get_user_by( 'id', $data['user_id'] );
	$date_registered = strtotime( $user->user_registered );
	$user_email      = $user->user_email;

	if ( $date_registered <= strtotime( OLD_CUSTOMER_CREATE_DATE ) ) {
		return mms_user_eligible_for_notifications( $user_email, MY_MAYAN_DATES_3_SKU );
	}

	return false;
}
add_filter( 'mms_user_date_of_birth_is_set', 'mms_add_old_user_to_notification_list', 10, 2 );

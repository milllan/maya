<?php

/**
 * Provides all template_redirect files and logic
 *
 * @link       http://pixel-industry.com/
 * @since      1.0.0
 *
 * @package    My_Mayan_Sign
 * @subpackage My_Mayan_Sign/includes
 */

function mymasi_print_handle() {
	if ( is_page( 'print' ) && is_user_logged_in() ) {

		$usrID = get_current_user_id();
		$page  = new My_Mayan_Sign_Pages( $usrID );
		echo $page->getPrint( get_current_user_id() );
		die();
	}
}
add_action( 'template_redirect', 'mymasi_print_handle' );

function mymasi_test_pdf_handle() {
	if ( is_page( 'test-pdf' ) && is_user_logged_in() ) {

		$usrName = wp_get_current_user()->display_name;
		$id      = isset( $_GET['id'] ) ? $_GET['id'] : false;
		$report  = isset( $_GET['report'] ) ? $_GET['report'] : 'detailed';
		$send    = isset( $_GET['send'] ) ? $_GET['send'] : false;
		$sample  = isset( $_GET['sample'] ) ? $_GET['sample'] : false;

		if ( $sample ) {
			$email = 'ikancijan@pixel-industry.com';
		} else {
			$email = wp_get_current_user()->user_email;
		}

		/*
		if($report == "free"){
		   // for simple
		   if($send){
			   mms_send_pdf($usrName, $email, $id, FREE_REPORT_SKU);
		   }
		} */

		if ( $report == 'simple' ) {
			// for simple
			if ( $send ) {
				mms_send_pdf( $usrName, $email, $id, SIMPLE_REPORT_SKU );
			}
		}

		if ( $report == 'standard' ) {
			// for standard
			if ( $send ) {
				mms_send_pdf( $usrName, $email, $id, STANDARD_REPORT_SKU );
			}
		}

		if ( $report == 'detailed' ) {
			// for detailed
			if ( $send ) {
				mms_send_pdf( $usrName, $email, $id, DETAILED_REPORT_SKU );
			}
		}

		if ( ! $send ) {
			echo "Sending report to email is NOT enabled. Set '?send=1'<br>";
		}

		if ( ! isset( $_GET['report'] ) ) {
			echo "REPORT TYPE is missing. Set '?report=REPORT_TYPE'. Default value is 'detailed'.<br>";
		}

		if ( ! $id ) {
			echo "ID of report is missing. Set '?id=REPORT_ID'<br>";
		} else {
			$data = mymasi_fill_product_data( $id );
			echo mymasi_view( '/public/report/pdf/' . $report . '.php', $data );
		}

		die();
	}
}
add_action( 'template_redirect', 'mymasi_test_pdf_handle' );

function mymasi_compentency_analysis_add() {
	global $wp;

	if ( $wp->request === 'process-ca-add' && is_user_logged_in() ) {

		$current_user = wp_get_current_user();

		$names = $_POST['names'];

		$months = $_POST['menu-month'];
		$days   = $_POST['menu-day'];
		$years  = $_POST['menu-year'];

		$sumSign    = 0;
		$sumTone    = 0;
		$sumTracana = 0;
		$allNames   = '';

		foreach ( $names as $key => $val ) {

			$allNames .= $names[ $key ] . ', ';

			$maya = calculateMaya( $months[ $key ], $days[ $key ], $years[ $key ], 'yes' );

			/*
			 * Competency analysis information is coming from Kiche Mayas,
			 * therefore it is relevant to use how they count the Mayan daysigns.
			 * For them the Monkey is the first sign, Road second, Crocodile 11th,
			 * Seed 14th and Water 19th. Therefore when we calculate competency,
			 * number should be taken account accordingly. If person A is seed,
			 * his sign number should be 14, and with person B water, 19,
			 * the result is 14+19=33 and minus 20 = 13 because it is a 20 based system.
			 * What is the 13th sign? Night. (which is the 3rd sign in our system)
			 */

			if ( $maya[0] > 10 ) {
				$maya[0] = $maya[0] - 10;
			}
			if ( $maya[0] < 10 ) {
				$maya[0] = $maya[0] + 10;
			}
			if ( $maya[0] == 10 ) {
				$maya[0] = 20;
			}

			$sumSign    += intval( $maya[0] );
			$sumTone    += intval( $maya[1] );
			$sumTracana += intval( $maya[2] );

			if ( $sumSign > 20 ) {
				$sumSign -= 20;
			}
			if ( $sumTone > 13 ) {
				$sumTone -= 12;
			}
			if ( $sumTracana > 20 ) {
				$sumTracana -= 20;
			}
		}

		$allNames = substr( $allNames, 0, -2 );

		// Create post object
		$my_post = array(
			'post_title'  => wp_strip_all_tags( $allNames ),
			'post_type'   => 'compentency_analysis',
			'post_status' => 'publish',
			'post_author' => get_current_user_id(),
		);

		// Insert the post into the database
		$post_id = wp_insert_post( $my_post );

		update_field( 'user', get_current_user_id(), $post_id );
		update_field( 'names', $allNames, $post_id );
		update_field( 'sign', $sumSign, $post_id );
		update_field( 'tone', $sumTone, $post_id );
		update_field( 'tracana', $sumTracana, $post_id );
		update_field( 'data', 'TODO', $post_id );
		update_field( 'locked', true, $post_id );

		echo '<p>' . __( 'Redirecting to content...', 'my-mayan-sign' ) . '</p><script>window.location.href = "' . get_compentency_view_url( $post_id ) . '"</script>';
	}
}
add_action( 'template_redirect', 'mymasi_compentency_analysis_add' );


function mymasi_calculator_handle() {
	if ( is_page( 'mayan-sign-calculator' ) && ! is_user_logged_in() && isset( $_POST['your_birthday'] ) ) {
		setcookie( 'mms_calculator_active', 'visited', time() + ( 86400 * 30 ), COOKIEPATH, COOKIE_DOMAIN );
	}
}
// add_action('template_redirect', 'mymasi_calculator_handle');

function mymasi_update_bday_handle() {
	if ( is_page( 'update-report' ) ) {

		if ( $_SERVER['REQUEST_METHOD'] !== 'POST' ) {
			return;
		}

		if (headers_sent($file, $line)) {
            error_log("Headers already sent before mymasi_update_bday_handle logic at $file:$line");
        }
		
		$item_id = $_POST['id'];
		// $value = $_POST['menu-year'] . $_POST['menu-month'] . $_POST['menu-day'];
		$value = $_POST['your_birthday'];
		// $url = $_POST['url'];

		wc_update_order_item_meta( $item_id, MMS_BDAY_KEY, $value );

		$current_user = wp_get_current_user();
		$order_item   = new WC_Order_Item_Product( $_POST['id'] );
		$order        = $order_item->get_order();
		$product      = $order_item->get_product();

		//30-05-2024
		if ( ! $product ) {
			error_log( 'Product not found for order item ID: ' . $_POST['id'] );
			return;
		}

		$sku = $product->get_sku();
		// if ( function_exists( 'get_sku' ) ) {
		// 	$sku = $product->get_sku();
		// }
		// $sku = ( !empty( $product ) && $product->get_sku() ) ?: MAYA - 1000 - 10; // 21-10-2021 fix

		$url = '';
		if ( !empty( $product ) && $product->get_sku() == SIMPLE_REPORT_SKU ) {
			$url = get_home_url() . '/simple-report/?id=' . $_POST['id'];
		}
		if ( !empty( $product ) && $product->get_sku() == STANDARD_REPORT_SKU ) {
			$url = get_home_url() . '/standard-report/?id=' . $_POST['id'];
		}
		if ( !empty( $product ) && $product->get_sku() == DETAILED_REPORT_SKU ) {
			$url = get_home_url() . '/detailed-report/?id=' . $_POST['id'];
		}

		mms_send_pdf( $current_user->user_firstname, $current_user->user_email, $_POST['id'], $sku );

		$data['url'] = $url;
		// echo mymasi_view('/public/views/part/redirect-loader.php', $data);
		// echo '<script>window.location.href = "' . $_POST['url'] . ' "</script>';
		wp_redirect($_POST['url']);

		if (headers_sent($file, $line)) {
            error_log("Headers sent after echo in mymasi_update_bday_handle at $file:$line");
        }

	}

}
add_action( 'template_redirect', 'mymasi_update_bday_handle' );

function mymasi_not_logged_in_handle() {
	$escape_pages = array( 'dashboard' );
	if ( is_page( $escape_pages ) ) {
		if ( get_current_user_id() == 0 ) {
			// if ( !is_user_logged_in() ) {
			// wp_redirect(get_home_url());
			wp_redirect( '/my-account/' );
			exit();
		}
	}
}
add_action( 'template_redirect', 'mymasi_not_logged_in_handle' );

function calc_page_redirect_transient() {
	$redirectTo = isset( $_GET['re'] ) ? $_GET['re'] : '';
	if ( $redirectTo == 'mayan-sign-calculator' ) {
		set_transient( 'calc_page_redirect_transient', 'mayan-sign-calculator', 60 * 60 );
		// die(get_transient( 'calc_page_redirect_transient' ));
	}

	if ( is_page( 'mayan-sign-calculator' ) ) {
		delete_transient( 'calc_page_redirect_transient' );
	}
}
add_action( 'template_redirect', 'calc_page_redirect_transient' );

// function disable_notification_email() {
// 	if ( is_page( 'disable-notification' ) && is_user_logged_in() ) {
// 		$current_user = wp_get_current_user();

// 		$email = $current_user->user_email;

// 		$my_post = get_page_by_title( $email, OBJECT, 'mms_user_email' );
// 		$post_id = $my_post->ID;
// 		if ( $my_post !== null ) {

// 			if ( isset( $_POST['my_custom_notification_disable'] ) ) {
// 				update_field( 'my_custom_notification_disable', 'disable', $post_id );
// 			}
// 			if ( isset( $_POST['important_notification_disable'] ) ) {
// 				update_field( 'important_notification_disable', 'disable', $post_id );
// 			}

// 			if ( $_POST['important_notification_enable'] ) {
// 				update_field( 'important_notification_disable', 'enable', $post_id );
// 			}
// 			if ( $_POST['my_custom_notification_enable'] ) {
// 				update_field( 'my_custom_notification_disable', 'enable', $post_id );
// 			}
// 		}

// 		$data['url'] = get_site_url() . '/dashboard/#notifications';
// 		// echo mymasi_view('/public/views/part/redirect-loader.php', $data);
// 		echo '<script>window.location.href = "https://mymayansign.com/dashboard/#notifications"</script>';
// 	}
// }
// add_action( 'template_redirect', 'disable_notification_email' );


function disable_notification_email() {
    if ( is_page( 'disable-notification' ) && is_user_logged_in() ) {
        $current_user = wp_get_current_user();
        $email = $current_user->user_email;

        $my_post = get_page_by_title( $email, OBJECT, 'mms_user_email' );

        if ( $my_post === null ) {
            // error_log( "No 'mms_user_email' post found for email: $email" );
            $data['url'] = get_site_url() . '/dashboard/#notifications';
            echo '<script>window.location.href = "https://mymayansign.com/dashboard/#notifications"</script>';
            exit;
        }

        $post_id = $my_post->ID;

        if ( isset( $_POST['my_custom_notification_disable'] ) ) {
            update_field( 'my_custom_notification_disable', 'disable', $post_id );
        }
        if ( isset( $_POST['important_notification_disable'] ) ) {
            update_field( 'important_notification_disable', 'disable', $post_id );
        }
        if ( isset( $_POST['important_notification_enable'] ) ) {
            update_field( 'important_notification_disable', 'enable', $post_id );
        }
        if ( isset( $_POST['my_custom_notification_enable'] ) ) {
            update_field( 'my_custom_notification_disable', 'enable', $post_id );
        }

        $data['url'] = get_site_url() . '/dashboard/#notifications';
        echo '<script>window.location.href = "https://mymayansign.com/dashboard/#notifications"</script>';
    }
}
add_action( 'template_redirect', 'disable_notification_email' );

function upgrade_to_detailed_page_redirect() {
	if ( is_page( 'upgrade-to-detailed' ) ) {

		if ( is_user_logged_in() ) {
			// in case user was not logged in the first time he was here
			delete_transient( 'upgrade_to_detailed_page_redirect_transient' );

			$user_id = get_current_user_id();
			// delete_user_meta($user_id, '_subscription_promo_upgrade_used');
			// check if user already used promo feature
			if ( $upgrade_meta = get_user_meta( $user_id, '_subscription_promo_upgrade_used', true ) ) {
				global $post;
				$post->post_content = sprintf( '<h2 style="text-align: center;">%s</h2>', $upgrade_meta );
			} else {

				// Getting current customer orders
				$customer_orders = wcs_get_users_subscriptions( $user_id );

				// Loop through each customer WC_Order objects
				foreach ( $customer_orders as $order ) {

					// Order ID (added WooCommerce 3+ compatibility)
					$order_id = method_exists( $order, 'get_id' ) ? $order->get_id() : $order->id;

					// Iterating through current order items
					foreach ( $order->get_items() as $item_id => $item ) {

						$order_item = new WC_Order_Item_Product( $item_id );
						$product    = $order_item->get_product();
						$sku        = $product->get_sku();

						// if user has standard report, redirect him to checkout
						if ( $sku == STANDARD_REPORT_SKU ) {

							$nonce              = wp_create_nonce( 'mms_upgrade_request' );
							$data_hash_detailed = urlencode(
								base64_encode(
									json_encode(
										array(
											'subscription-id' => $order->get_order_number(),
											'report-id'  => $item_id,
											'product-id' => $product->get_ID(),
											'upgrade-to' => DETAILED_REPORT_PRODUCT_ID,
											'promo'      => 'OLDUSER',
										)
									)
								)
							);

							$upgrade_to_detailed = get_site_url() . '/checkout/?upgrade-subscription=' . $data_hash_detailed . '&_wpnonce=' . $nonce . '&add-to-cart=' . DETAILED_REPORT_PRODUCT_ID;

							if ( wp_redirect( $upgrade_to_detailed ) ) {
								exit;
							}
						}
					}
				}
			}
		} else {
			set_transient( 'upgrade_to_detailed_page_redirect_transient', 'upgrade-to-detailed', 60 * 60 );
			// die(get_transient( 'upgrade_to_detailed_page_redirect_transient' ));
			if ( wp_redirect( get_home_url() . '/login/?re=upgrade-to-detailed' ) ) {
				exit;
			}
		}
	}
}
add_action( 'template_redirect', 'upgrade_to_detailed_page_redirect' );

function subs_test() {
	if ( is_page( 'subscription-test' ) && is_user_logged_in() ) {
		$order         = wc_get_order( 27067 );
		$subscriptions = wcs_get_subscriptions_for_order( $order );
		foreach ( $subscriptions as $sub ) {
			$sub_items = $sub->get_items();
		}
		dump_data( $sub_items );
	}
}
// add_action( 'template_redirect', 'subs_test' );

function mms_test_page() {
	/*
	 if (is_page('mcfix')) {

		$args = array(
			'posts_per_page' => -1,
			'post_type' => 'today_in_mc',
			'order' => 'ASC'
		);

		$posts_array = get_posts($args);
		$return = array();
		$no = 1;
		foreach ($posts_array as $key => $post) {

			$day = (int)get_field("number", $post->ID);

			if($no != $day){

				$signs = explode(" ", $post->post_title);

				$day--;
				if($no != $day){
					echo "----->";

					$day--;
					if($no != $day){
						echo "================>";
					}
				}
				echo $no . " | " . $day . " - " . $post->post_title . "<br>";

				if($signs[0] == "13"){
					echo "<hr>";
				}

				if($no == $day)
					update_field('number', $day, $post->ID);
			}

			$no++;
		}
		die();
	} */

	/*
	 if (is_page('test')) {
		$notifs = mms_users_to_be_notified();
		$output = array();
		foreach ($notifs as $notif) {

			$email = get_field('user_email', $notif->ID);
			$user = get_user_by('email', $email);
			$date_registered = strtotime($user->user_registered);

			$myDate = get_field('my_custom_notification_expiration', $user->ID);
			$disableMy = get_field('my_custom_notification_disable', $user->ID);

			$date_of_birth = get_user_meta($user->ID, 'date_of_birth');

			if ($date_registered <= strtotime(OLD_CUSTOMER_CREATE_DATE)) {
				if ($disableMy == "enable") {
					if (empty($myDate)) {
							$output[] = $email;
					}
				}
			}
		}
		dump_data($output);
	} */

	if ( is_page( 'test' ) ) {
		// stats
		$stats = array();

		// get all subs with Standard Report
		$subscriptions        = wcs_get_subscriptions_for_product( STANDARD_REPORT_PRODUCT_ID, 'sub' );
		$stats['subscribers'] = count( $subscriptions );

		foreach ( $subscriptions as $sub ) {

			$sub_user      = $sub->get_user(); // get user from sub
			$date_of_birth = get_user_meta( $sub_user->ID, 'date_of_birth', true ); // get user birthday meta

			if ( ! in_array( $sub_user->user_email, $stats['processed_user'] ) ) {
				// dump_data($sub_user->user_email, "user_email");

				// if user has date_of_birth check for Notifications
				if ( ! empty( $date_of_birth ) ) {
					$stats['has_date_of_birth'] += 1;
					// dump_data($date_of_birth, "date_of_birth");

					$notif = get_page_by_title( $sub_user->user_email, OBJECT, 'mms_user_email' ); // get Notification CPT by user email

					// Notif duration of Standard R.
					$month_lenght = mymasi_subscription_lenght( STANDARD_REPORT_SKU );
					$date         = date( 'd-m-Y', strtotime( '+' . $month_lenght . ' month' ) );

					if ( $notif ) {
						// My Important Days
						$midDate    = get_field( 'my_custom_notification_expiration', $notif->ID );
						$midDisable = get_field( 'my_custom_notification_disable', $notif->ID );

						if ( ! empty( $midDate ) && ( strtotime( $midDate ) > time() ) ) {
							// dump_data($midDate, "midDate");
							$date = date( 'd-m-Y', strtotime( $midDate . ' +' . $month_lenght . ' month' ) );
						}

						/*
						 update_field('my_custom_notification_expiration', $date, $notif->ID);
						update_field('my_custom_notification_disable', "enable", $notif->ID); */

						$stats['updating_expiration_date'] += 1;
						$stats['processed_user'][]          = $sub_user->user_email;

						// dump_data($date, "updating expiration date:");
						// dump_data($midDisable, "midDisable");
					} else {
						$stats['adding_user_to_list'] += 1;
						$stats['processed_user'][]     = $sub_user->user_email;
						// dump_data($sub_user->user_email, "adding user to email list:");
						// mms_add_user_to_email_list($sub_user->user_email, $date, null);
					}
				} else {
					$stats['no_date_of_birth'] += 1;
					// dump_data("", "NO date_of_birth");
				}
			}
		}

		dump_data( $stats, 'stats' );

		die();
	}
}
// add_action('template_redirect', 'mms_test_page');

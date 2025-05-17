<?php



/**

 * Provides all functionality for generating my mayan sign pages
 *
 * @link       http://pixel-industry.com/

 * @since      1.0.0
 *
 * @package    My_Mayan_Sign

 * @subpackage My_Mayan_Sign/includes
 */



/**

 * Provides all functionality for generating my mayan sign pages
 *
 * @since      1.0.0

 * @package    My_Mayan_Sign

 * @subpackage My_Mayan_Sign/includes

 * @author     PIXEL INDUSTRY <info@http://pixel-industry.com>
 */



class My_Mayan_Sign_Pages {





	/**

	 * Day of logged users birth
	 *
	 * @since    1.0.0

	 * @access   private

	 * @var      int    $day    email of WordPress user.
	 */

	private $day;



	/**

	 * Month of logged users birth
	 *
	 * @since    1.0.0

	 * @access   private

	 * @var      int    $day    email of WordPress user.
	 */

	private $month;



	/**

	 * Year of logged users birth
	 *
	 * @since    1.0.0

	 * @access   private

	 * @var      int    $day    email of WordPress user.
	 */

	private $year;



	/**

	 * Is the user born before sunset ('yes'|'no')
	 *
	 * @since    1.0.0

	 * @access   private

	 * @var      int    $day    email of WordPress user.
	 */

	private $sun;



	/**

	 * Initialize all required variables for showing yxour custom pages.

	 * Also we are checking if user has the right to to view the pages
	 *
	 * @since    1.0.0
	 */



	public function __construct( $userid ) {

		if ( empty( get_user_meta( $userid, 'date_of_birth' ) ) ||

			empty( get_user_meta( $userid, 'gender' ) ) ) {

				// wp_die( __( 'Go to "My Account" and fill all required data!' ) );

		} else {

			$this->user = get_userdata( $userid );

			$birthdate = get_user_meta( $userid, 'date_of_birth' );

			$birthdate = $birthdate[0];

			$this->year = intval( substr( $birthdate, 0, 4 ) );

			$this->month = intval( substr( $birthdate, 5, 2 ) );

			$this->day = intval( substr( $birthdate, 7, 2 ) );

			$this->gender = get_user_meta( $userid, 'gender' );

			$this->sun = 'yes';

		}
	}



	/*
	 *   Provides populated calculator view

	 */

	public static function getCalculatorPage( $month, $day, $year ) {

		// Validate input.
		if ( ! is_numeric( $month ) || ! is_numeric( $day ) || ! is_numeric( $year ) ) {
			return 'Invalid input: Date must be numeric.';
		}

		// $month = (int) $month;
		// $day   = (int) $day;
		// $year  = (int) $year;

		// Check for valid date.
		// if ( ! checkdate( $month, $day, $year ) ) {
		// 	return 'Invalid input: Not a valid date.';
		// }

		$maya = calculateMaya( $month, $day, $year, 'yes' );

		$data = mymasi_fill_data_from_date( $day, $month, $year );

		$numbers = mysasi_get_custom_type( 'numbers' );

		$signs = mysasi_get_custom_type( 'signs' );

		// $shop_url = get_permalink( wc_get_page_id( 'shop' ));
		$shop_url = get_site_url() . '/get-detailed-report/';

		$purchase_label = __( 'Claim My Full Report!', 'my-mayan-sign' );

		$data['link_to_shop'] = '<p><a href="' . $shop_url . '" class="btn calc_cta_btn">' . $purchase_label . '</a></p>';
		// Pass graph data
		$data['graph_data'] = [
			'youth_male' => $data['youth_male'],
			'youth' => $data['youth'],
			'youth_female' => $data['youth_female'],
			'tone' => $data['tone'],
			'male' => $data['male'],
			'female' => $data['female'],
			'destiny_male' => $data['destiny_male'],
			'destiny_female' => $data['destiny_female'],
			'future' => $data['future']
		];

		$data['day_sign']['content'] = $data['day_sign']['calculator_text'];

		$data['tone']['content'] = $data['tone_txt']['calculator_text'];

		$data['tercana']['content'] = $data['tercana']['calculator_text'];

		$data['shop_url'] = $shop_url;

		$data['static_text'] = mysasi_get_static_text_cpt();

		$data['date'] = $year . $month . $day;

		$data['is_user_logged_in'] = is_user_logged_in();

		if ( isset( $_COOKIE['mms_calculator_active'] ) ) {

			$data['mms_calculator_active'] = $_COOKIE['mms_calculator_active'];

		} else {

			$data['mms_calculator_active'] = false;

		}

		$content = mymasi_view( '/public/views/calculator.php', $data );

		return $content;
	}



	/*
	 *   Provides calculator_form view

	 */

	public static function getCalculatorFormPage( $post = false ) {

		$data['url'] = get_site_url() . '/mayan-sign-calculator/';

		if ( is_user_logged_in() ) {

			$data['is_user_logged_in'] = is_user_logged_in();

			$data['date'] = get_user_meta( get_current_user_id(), 'date_of_birth', true );

		} elseif ( isset( $post['is_user_logged_in'] ) ) {

			$data['is_user_logged_in'] = $post['is_user_logged_in'];

		} elseif ( ! isset( $post['is_user_logged_in'] ) ) {

			$data['is_user_logged_in'] = 0;

		}

		if ( $post ) {

			$data['date'] = $post['date'];

		}

		// $data['mms_calculator_active'] = $post['mms_calculator_active'];
		$data['mms_calculator_active'] = isset( $post['mms_calculator_active'] ) ? $post['mms_calculator_active'] : 'default';

		$content = mymasi_view( '/public/views/calculator_form.php', $data );

		return $content;
	}



	/*
	 *   Provides populated core sign view

	 */

	public function getCoreSignPage( $purchase ) {

		if ( ! isset( $_GET['id'] ) ) {

			if ( is_user_logged_in() ) {
				wp_redirect( get_home_url() . '/dashboard' );

			} else {
				wp_redirect( get_home_url() );
			}

			exit;

		}

		$data = mymasi_fill_product_data( $_GET['id'] );

		$data['url'] = get_home_url() . '/dashboard';

		if ( $purchase == 'free' ) {

			$data['day_sign']['content'] = wp_trim_words( $data['day_sign']['content'], 30, ' <a href="#">Purchase to see full report</a>' );

			$data['tone']['content'] = wp_trim_words( $data['tone']['content'], 30, ' <a href="#">Purchase to see full report</a>' );

			$data['tercana']['content'] = wp_trim_words( $data['tercana']['content'], 30, ' <a href="#">Purchase to see full report</a>' );

			$content = mymasi_view( '/public/views/core_sign_free.php', $data );

		} else {

			$content = mymasi_view( '/public/views/core_sign_standard.php', $data );

		}

		return $content;
	}



	public function getSynthesisPage() {
		if (!isset($_GET['id'])) {
			if (is_user_logged_in()) {
				wp_redirect(get_home_url() . '/dashboard');
			} else {
				wp_redirect(get_home_url());
			}
			exit;
		}
	
		$id = (int)$_GET['id'];
		$data = mymasi_fill_product_data($id);
	
		$data['url'] = get_home_url() . '/dashboard';
	
		$synthesis = mysasi_get_custom_type('synthesis');
		$data['synthesis'] = isset($data['burc'], $synthesis[$data['burc']]) ? $synthesis[$data['burc']] : [];
	
		if (isset($data['sku']) && $data['sku'] === DETAILED_REPORT_SKU && isset($data['synthesis']['detailed_synthesis'])) {
			$data['synthesis']['content'] = $data['synthesis']['detailed_synthesis'];
		}
	
		$content = mymasi_view('/public/views/synthesis.php', $data);
	
		return $content;
	}



	/*
	 *   Provides populated four directions view

	 */

	 public function getNightLordPage() {
		if (!isset($_GET['id']) || !is_numeric($_GET['id']) || $_GET['id'] <= 0) {
			if (is_user_logged_in()) {
				wp_redirect(get_home_url() . '/dashboard');
			} else {
				wp_redirect(get_home_url());
			}
			exit;
		}
	
		$id = (int)$_GET['id'];
		$data = [
			'night_lord' => '',
			'static_text' => mysasi_get_static_text_cpt(),
			'url' => get_home_url() . '/dashboard'
		];
	
		try {
			$order_item = new WC_Order_Item_Product($id);
			if (!$order_item->get_id()) {
				return mymasi_view('/public/views/night_lord.php', $data);
			}
	
			$order = $order_item->get_order();
			if (!$order || !is_a($order, 'WC_Order') || get_current_user_id() != $order->get_user_id()) {
				return mymasi_view('/public/views/night_lord.php', $data);
			}
	
			$birthday = wc_get_order_item_meta($id, MMS_BDAY_KEY);
			if (empty($birthday) || strlen($birthday) < 8) {
				return mymasi_view('/public/views/night_lord.php', $data);
			}
	
			$year = substr($birthday, 0, 4);
			$month = substr($birthday, 4, 2);
			$day = substr($birthday, 6, 2);
	
			$night_lord = mysasi_get_custom_type('night_lord');
			$lord_no = mymasi_night_lord($month, $day, $year);
	
			$data['night_lord'] = $night_lord[$lord_no] ?? '';
		} catch (Exception $e) {
			// Silently return view with minimal data
			return mymasi_view('/public/views/night_lord.php', $data);
		}
	
		return mymasi_view('/public/views/night_lord.php', $data);
	}

	/*
	 *   Provides populated today im mayan calendar view

	 *   Same for all the users so no need to initialize My_Mayan_Sign_Pages

	 */



	public static function getTodayInMcPage() {

		$values = mymasi_today_in_mc();

		$signs = mysasi_get_custom_type( 'signs' );

		$numbers = mysasi_get_custom_type( 'numbers' );

		$tracana = mysasi_get_custom_type( 'tracana' );

		$day = mymasi_to_mayan_calendar( date( 'm' ), date( 'd' ), date( 'Y' ), 'yes' );

		if ( $day > 260 ) {
			$day = 1;
		}

		$today_in_mc = mysasi_get_today_in_mayan_calendar( $day );

		$data['sign'] = $signs[ $values['burc'] ];

		$data['tone'] = $numbers[ $values['number'] ];

		$data['tracana'] = $signs[ $values['tracana'] ];

		$data['today_in_mc'] = $today_in_mc;

		$content = mymasi_view( '/public/views/today_in_mc.php', $data );

		return $content;
	}



	public function getYourCustomCalendar() {

		if ( ! isset( $_GET['id'] ) ) {

			if ( is_user_logged_in() ) {
				wp_redirect( get_home_url() . '/dashboard' );

			} else {
				wp_redirect( get_home_url() );
			}

			exit;

		}

		$data = mymasi_fill_product_data( $_GET['id'] );

		$data['url'] = get_home_url() . '/dashboard';

		$level = 0;

		if ( $data['sku'] == SIMPLE_REPORT_SKU ) {
			$level = 1;
		}

		if ( $data['sku'] == STANDARD_REPORT_SKU ) {
			$level = 2;
		}

		if ( $data['sku'] == DETAILED_REPORT_SKU ) {
			$level = 3;
		}

		$content = mymasi_view( '/public/views/custom_calendar_top.php', $data );

		$content .= mymasi_your_custom_dates( $data, $level );

		return stripslashes( $content );

		// return $content;
	}



	public function getPrint() {

		$user = get_current_user_id();

		if ( ! isset( $_GET['id'] ) ) {

			return 'no report selected';

		}

		$data = mymasi_fill_product_data( $_GET['id'] );

		$content = mymasi_view( '/public/views/print_head.php', $data );

		switch ( $data['sku'] ) {

			case SIMPLE_REPORT_SKU:
				$content .= $this->getMyReport( 'core' );

				break;

			case STANDARD_REPORT_SKU:
				$content .= $this->getMyReport( 'standard_graph' );

				$content .= $this->getMyReport( 'standard_four_directions' );

				$content .= $this->getMyReport( 'core' );

				break;

			case DETAILED_REPORT_SKU:
				$content .= $this->getMyReport( 'detailed_graph' );

				$content .= $this->getMyReport( 'detailed_youth_print' );

				$content .= $this->getMyReport( 'detailed_adult_print' );

				$content .= $this->getMyReport( 'detailed_mature_print' );

				$content .= $this->getNightLordPage();

				break;

			default:
				$content .= $this->getCoreSignPage( 'free' );

				break;

		}

		$content .= '<script>window.print();</script>';

		return $content;
	}



	function getMyReports() {

		$data['reports'] = mymasi_get_my_reports( get_current_user_id() );

		$data['url'] = get_home_url();

		$birthday = get_user_meta( get_current_user_id(), 'date_of_birth', true );

		$data['year'] = substr( $birthday, 0, 4 );

		$data['month'] = substr( $birthday, 4, 2 );

		$data['day'] = substr( $birthday, 6, 2 );

		if ( empty( $data['reports'] ) ) {

			return mymasi_view( '/public/views/reports/upsale.php', $data );
		}

		return mymasi_view( '/public/views/my_reports.php', $data );
	}



	function getMyReport( $viewID ) {

		if ( ! isset( $_GET['id'] ) ) {

			if ( is_user_logged_in() ) {
				wp_redirect( get_home_url() . '/dashboard' );

			} else {
				wp_redirect( get_home_url() );
			}

			exit;

		}

		$data = mymasi_fill_product_data( $_GET['id'] );

		$data['url'] = get_home_url() . '/dashboard';

		$content = mymasi_view( '/public/views/reports/' . $viewID . '.php', $data );

		return $content;
	}

	function getCompetency( $view ) {

		if ( $view == 'index' ) {

			return $this->getCompetencyIndex();

		} elseif ( $view == 'view' ) {

			return $this->getCompetencyView();

		} elseif ( $view == 'create' ) {

			return $this->getCompetencyCreate();

		} elseif ( $view == 'graph' ) {

			return $this->getCompetencyGraph();

		}
	}



	function getCompetencyGraph() {

		if ( ! isset( $_GET['id'] ) ) {

			return __( 'You do not have sufficient permissions to access this page.', 'my-mayan-sign' );

		}

		$meta = get_post_meta( $_GET['id'] );

		$user = $meta['user'][0];

		$names = $meta['names'][0];

		$sign = $meta['sign'][0];

		$tone = $meta['tone'][0];

		$tracana = $meta['tracana'][0];

		if ( $user != get_current_user_id() ) {

			wp_die( __( 'Action not allowed!' ) );

		}

		$data = fillValues( $sign, $tone, $tracana );

		/* Get images from core sign */

		$map = mymasi_eight_dirtection_map();

		$eight_directions = $map[ $data['burc'] ];

		$signs = mysasi_get_custom_type( 'signs' );

		$data['day_sign'] = $signs[ $data['burc'] ];

		$data['youth'] = $signs[ $eight_directions['youth'] ];

		$data['future'] = $signs[ $eight_directions['future'] ];

		$data['youth_male'] = $signs[ $eight_directions['youth_male'] ];

		$data['youth_female'] = $signs[ $eight_directions['youth_female'] ];

		$data['male'] = $signs[ $eight_directions['male'] ];

		$data['female'] = $signs[ $eight_directions['female'] ];

		$data['destiny_male'] = $signs[ $eight_directions['destiny_male'] ];

		$data['destiny_female'] = $signs[ $eight_directions['destiny_female'] ];

		$content = mymasi_view( '/public/views/competency/graph.php', $data );

		return $content;
	}

	function getCompetencyView() {

		if ( ! isset( $_GET['id'] ) ) {

			return __( 'You do not have sufficient permissions to access this page.', 'my-mayan-sign' );

		}

		$meta = get_post_meta( $_GET['id'] );

		if ( empty( $meta ) ) {

			return mymasi_view( '/public/views/competency/empty.php', array() );
		}

		$user = $meta['user'][0];

		$names = $meta['names'][0];

		$sign = $meta['sign'][0];

		$tone = $meta['tone'][0];

		$tracana = $meta['tracana'][0];

		if ( $user != get_current_user_id() ) {

			wp_die( __( 'Action not allowed!' ) );

		}

		$data = fillValues( $sign, $tone, $tracana );

		$map = mymasi_eight_dirtection_map();

		$sign_map = mymasi_tone_map();

		$eight_directions = $map[ $data['burc'] ];

		$data['tone'] = mymasi_get_tones_from_map( $data['number'], $eight_directions );

		$CASigns = mysasi_get_custom_type( 'ca_sign' );

		$data['names'] = $names;

		/* Get images from core sign */

		$signs = mysasi_get_custom_type( 'signs' );

		$data['day_sign'] = $signs[ $data['burc'] ];

		$data['youth'] = $signs[ $eight_directions['youth'] ];

		$data['future'] = $signs[ $eight_directions['future'] ];

		$data['youth_male'] = $signs[ $eight_directions['youth_male'] ];

		$data['youth_female'] = $signs[ $eight_directions['youth_female'] ];

		$data['male'] = $signs[ $eight_directions['male'] ];

		$data['female'] = $signs[ $eight_directions['female'] ];

		$data['destiny_male'] = $signs[ $eight_directions['destiny_male'] ];

		$data['destiny_female'] = $signs[ $eight_directions['destiny_female'] ];

		/* Get texts from cpt */

		$data['youth_ca'] = $CASigns[ $eight_directions['youth'] ];

		$data['future_ca'] = $CASigns[ $eight_directions['future'] ];

		$data['youth_male_ca'] = $CASigns[ $eight_directions['youth_male'] ];

		$data['youth_female_ca'] = $CASigns[ $eight_directions['youth_female'] ];

		$data['male_ca'] = $CASigns[ $eight_directions['male'] ];

		$data['female_ca'] = $CASigns[ $eight_directions['female'] ];

		$data['destiny_male_ca'] = $CASigns[ $eight_directions['destiny_male'] ];

		$data['destiny_female_ca'] = $CASigns[ $eight_directions['destiny_female'] ];

		$data['url'] = get_home_url() . '/dashboard/#competency-analysis';

		$content = mymasi_view( '/public/views/competency/view.php', $data );

		return $content;
	}



	function getCompetencyCreate() {

		$data = array( 'url' => get_home_url() . '/process-ca-add' );

		$combinations = count( get_compentency_analysis() );

		$packages = mymasi_count_ca_items( $this->user->ID );

		$data['packages_left'] = $packages - $combinations;

		$data['upgrade_url'] = get_site_url() . '/product/competency-analysis/';

		if ( $packages <= $combinations ) {

			return mymasi_view( '/public/views/competency/upsale.php', $data );
		}

		$content = mymasi_view( '/public/views/competency/create.php', $data );

		return $content;
	}

	function getCompetencyIndex() {

		global $wp;

		$data['view_url'] = home_url( $wp->request );

		$data['ca_posts'] = get_compentency_analysis();

		$data['ca_count'] = mymasi_count_ca_items( $this->user->ID );

		$data['view_url'] = get_site_url() . COMPENTENCY_VIEW_URL;

		$data['plugin_url'] = plugins_url( 'public/', __DIR__ );

		$content = mymasi_view( '/public/views/competency/index.php', $data );

		return $content;
	}



	function getNotifications() {

		$data = array();

		$maya = calculateMaya( $this->month, $this->day, $this->year, 'yes' );

		$data = fillValues( $maya[0], $maya[1], $maya[2] );

		$data['notifications'] = get_notifications( get_current_user_id() );

		$data['birthday'] = $this->month . '-' . $this->day . '-' . $this->year;

		if ( empty( $data['notifications'] ) ) {

			$content = mymasi_view( '/public/views/upsale/notifications.php', $data );

		} else {
			$content = mymasi_view( '/public/views/notifications.php', $data );
		}

		return $content;
	}



	/*
	 *   Provides test_form view

	 */



	public static function getTestmPage() {

		$userPosts = mms_users_to_be_notified();

		var_dump( 'fake cron start...' . '<br><br>' );

		var_dump( 'now  : ---' . time() . '---' . '<br><br>' );

		var_dump( date( 'm-d-Y', strtotime( '+1 month' ) ) );

		foreach ( $userPosts as $userPost ) {

			$now = time();

			$email = get_field( 'user_email', $userPost->ID );

			$user = get_user_by( 'email', $email );

			$importantDate = get_field( 'important_notification_expiration', $userPost->ID );

			$myDate = get_field( 'my_custom_notification_expiration', $userPost->ID );

			$disableMy = get_field( 'my_custom_notification_disable', $userPost->ID );

			$disableImportant = get_field( 'important_notification_disable', $userPost->ID );

			$notify = new My_Mayan_Sign_Notifications( $user->ID );

			var_dump( 'checking user : ' . $email . ' - ' . $myDate . ' - ' . $importantDate . '...<br><br>' );

			var_dump( 'my date [' . $myDate . ']: ---' . strtotime( $myDate ) . '---<br><br>' );

			if ( $importantDate != null ) {

				if ( strtotime( $importantDate ) > $now ) {

					if ( $disableImportant != 'disable' ) {

						/*
							$notify->handleImportantNotification();

						var_dump('sending important notification for ' . $email . '...<br><br>'); */

					}
				}
			}

			if ( $myDate != null ) {

				if ( strtotime( $myDate ) > $now ) {

					if ( $disableMy != 'disable' ) {

						$notify->handleMyMayanNotification();

						var_dump( 'sending my notification for ' . $email . '...<br><br>' );

					}
				}
			}
		}

		$data = array();

		$name = 'Ivan';

		$email = 'ikancijan@pixel-industry.com';

		$content = '';

		$count = 0;

		/*
			mms_send_pdf($name, $email, 497, SIMPLE_REPORT_SKU);

		mms_send_pdf($name, $email, 497, STANDARD_REPORT_SKU);

		mms_send_pdf($name, $email, 497, DETAILED_REPORT_SKU); */

		return $content;
	}
}

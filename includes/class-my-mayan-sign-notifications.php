<?php

/**
 * Provides notifications functionality for My Mayan sign and Important Mayan dates
 *
 *
 * @link       http://pixel-industry.com/
 * @since      1.0.0
 *
 * @package    My_Mayan_Sign
 * @subpackage My_Mayan_Sign/includes
 */

class My_Mayan_Sign_Notifications
{

	/**
	 * The email of Wordpress user.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $email    email of Wordpress user.
	 */
	private $email;

	/**
	 * The name of Wordpress user.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $email    name of Wordpress user.
	 */
	private $name;

	/**
	 * Wordpress user obj
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      WP_User    $user   Wordpress user obj.
	 */
	private $user;

	/**
	 * Initialize all required variables to load user, generate and send the report
	 *
	 * @since    1.0.0
	 */

	public function __construct($userid)
	{
		$user = get_userdata($userid);
		if($user){
			$this->email = $user->user_email;
			$this->name = $user->user_nicename;
			$this->user = $user;
		}
	}


  /*
	 *   Feeds a view for Importanrt Mayan dates with content
	 */
	protected function important_content($content)
	{

		$data = array('name' => $this->name, 'email' => $this->email, 'content' => $content);
		$content = mymasi_view('/public/report/email/important-mayan.php', $data);

		return $content;
	}

    /*
	 *   Feeds a view for Importanrt Mayan dates with content
	 */
	protected function today_content($content)
	{

		$data = array('name' => $this->name, 'email' => $this->email, 'content' => $content);
		$content = mymasi_view('/public/report/email/today_in_your_mc.php', $data);

		return $content;
	}

  /*
	 *   Get the data for the coresponding user and send him the email
	 *   with important mayan date.
	 */
	public function handleImportantNotification()
	{
		$values = mymasi_today_in_mc();
		$signs = mysasi_get_custom_type('signs');
	
		$day = mymasi_to_mayan_calendar(date('m'), date('d'), date('Y'), "yes");
		$today_in_mc = mysasi_get_today_in_mayan_calendar($day);
	
		$data['sign'] = isset($values['burc'], $signs[$values['burc']]) ? $signs[$values['burc']] : [];
		$title = is_array($today_in_mc) && isset($today_in_mc['title']) ? $today_in_mc['title'] : '';
		$content_text = is_array($today_in_mc) && isset($today_in_mc['content']) ? $today_in_mc['content'] : '';
		$content = '<h2>' . __('Today is ', 'my-mayan-sign') . $title . '</h2>' . $content_text;
	
		$to = $this->email;
		$subject = __('Today in Mayan Calendar ', 'my-mayan-sign');
		$body = $this->important_content($content);
		$headers = array('Content-Type: text/html; charset=UTF-8');
		if (!wp_mail($to, $subject, $body, $headers)) {
			return "----- failed to send email! -----";
		}
	}

  /*
	 *   Calculate my mayan date from legacy functions for the coresponding user
	 *   and send him the email with his/her custom mayan date.
	 *   In this development iteration we are pulling date of birth directly from user object.
	 *   In the future we can implement birthday directly on WC product
	 */
	public function handleMyMayanNotification()
	{
		if($this->user){
			$birthday = get_user_meta($this->user->ID, 'date_of_birth', true);

			if(!empty($birthday)){
				$year = substr($birthday, 0, 4);
				$month = substr($birthday, 4, 2);
				$day = substr($birthday, 6, 2);

				$maya = calculateMaya($month, $day, $year, 'yes');
				$data = fillValues($maya[0], $maya[1], $maya[2]);
				$trecana = mysasi_get_custom_type('signs');
				$data['trecana'] = $trecana[$maya[0]]['title'];
				$body = mymasi_today_in_your_mc($data, $this->user, date('Y-m-d'));

				if ($body) {
					$to = $this->email;
					$subject = __('Today in your custom Calendar ', 'my-mayan-sign');
					$headers = array('Content-Type: text/html; charset=UTF-8');
					if(!wp_mail($to, $subject, $body, $headers)){
						return "----- failed to send email! -----";
					}
				}else{
					return " - no notif for today";
				}
			}else{
				return "----- missing user birthday! -----";
			}
		}else{
			return "----- invalid user! -----";
		}
	}
}

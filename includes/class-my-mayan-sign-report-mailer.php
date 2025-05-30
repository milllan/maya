<?php

/**
 * Provides all email and PDF functionality for MY Mayan Sign project
 *
 *
 * @link       http://pixel-industry.com/
 * @since      1.0.0
 *
 * @package    My_Mayan_Sign
 * @subpackage My_Mayan_Sign/includes
 */

/**
 * Provides all email and PDF functionality for MY Mayan Sign project
 *
 *
 * @since      1.0.0
 * @package    My_Mayan_Sign
 * @subpackage My_Mayan_Sign/includes
 * @author     PIXEL INDUSTRY <info@http://pixel-industry.com>
 */

require_once plugin_dir_path(dirname(__FILE__)) . 'vendor/dompdf/lib/html5lib/Parser.php';
// require_once plugin_dir_path(dirname(__FILE__)) . 'vendor/dompdf/lib/php-font-lib/src/FontLib/Autoloader.php';
// require_once plugin_dir_path(dirname(__FILE__)) . 'vendor/dompdf/lib/php-svg-lib/src/autoload.php';
require_once plugin_dir_path(dirname(__FILE__)) . 'vendor/dompdf/src/Autoloader.php';
require_once plugin_dir_path(dirname(__FILE__)) . 'vendor/autoload.php';


Dompdf\Autoloader::register();
use Dompdf\Dompdf;
define('DOMPDF_UNICODE_ENABLED', true);

class My_Mayan_Sign_Report_Mailer
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
	 * Initialize all required variables to load user, generate and send the report
	 *
	 * @since    1.0.0
	 */

	public function __construct($name, $email)
	{
		$this->email = $email;
		$this->name = $name;
	}

	protected function email_content()
	{
		$static = mysasi_get_static_text_cpt();
		$data = array(
			'name' => $this->name,
			'email' => $this->email,
			'body' => $static['report_email_content']['text']
		);
		$content = mymasi_view('/public/report/email/report.php', $data);

		return $content;
	}

	protected function pdf_content($plan, $data)
	{
		$content = mymasi_view('/public/report/pdf/' . $plan . '.php', $data);
		return $content;
	}

	protected function generate_pdf($plan, $html)
	{
    // instantiate and use the dompdf class
		$dompdf = new Dompdf(array('enable_remote' => true));
		$dompdf->loadHtml($html, 'UTF-8');

    // (Optional) Setup the paper size and orientation
		$dompdf->setPaper('A4', 'portrait');
		// $dompdf->set_paper(array(0, 0, 1000, 3000));
		$dompdf->set_paper('A4', 'portrait');

    // Render the HTML as PDF
		$dompdf->render();

		$output = $dompdf->output();

    // Generate temp file location
		$path = plugin_dir_path(dirname(__FILE__)) . 'files/' . $plan . '_report_' . time() . '.pdf';

    // save output to file
		file_put_contents($path, $output);

		return $path;
	}

	// public function report_send($plan = 'free', $html)
	public function report_send($plan, $html)
	{
		$to = $this->email;
		$subject = 'Hi ' . $this->name . ', here is your report - MyMayanSign';
		$body = $this->email_content();
		$headers = array('Content-Type: text/html; charset=UTF-8');
		$attach = $this->generate_pdf($plan, $html);
		wp_mail($to, $subject, $body, $headers, $attach);
	}

}

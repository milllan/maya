<?php
/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    My_Mayan_Sign
 * @subpackage My_Mayan_Sign/includes
 * @author     PIXEL INDUSTRY <info@pixel-industry.com>
 */
class My_Mayan_Sign_Activator {

	/**
	 * On plugin activation, schedule event to send notification email's
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		if ( ! wp_next_scheduled( 'mymasi_cron_event' ) ) {
			wp_schedule_event( time(), 'daily', 'mymasi_cron_event' );
		}
	}

}

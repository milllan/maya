<?php

/**
 * Fired during plugin deactivation
 *
 * @link       http://pixel-industry.com/
 * @since      1.0.0
 *
 * @package    My_Mayan_Sign
 * @subpackage My_Mayan_Sign/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    My_Mayan_Sign
 * @subpackage My_Mayan_Sign/includes
 * @author     PIXEL INDUSTRY <info@http://pixel-industry.com>
 */
class My_Mayan_Sign_Deactivator {

	/**
	 * On plugin deactivation, clear event to send notification email's
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
    wp_clear_scheduled_hook('mymasi_cron_event');
	}

}

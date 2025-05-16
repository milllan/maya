<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://pixel-industry.com/
 * @since             1.0.0
 * @package           My_Mayan_Sign
 *
 * @wordpress-plugin
 * Plugin Name:       My Mayan Sign
 * Plugin URI:        http://pixel-industry.com/
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            PIXEL INDUSTRY
 * Author URI:        http://pixel-industry.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       my-mayan-sign
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'PLUGIN_NAME_VERSION', '1.0.3' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-my-mayan-sign-activator.php
 */
function activate_my_mayan_sign() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-my-mayan-sign-activator.php';
	My_Mayan_Sign_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-my-mayan-sign-deactivator.php
 */
function deactivate_my_mayan_sign() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-my-mayan-sign-deactivator.php';
	My_Mayan_Sign_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_my_mayan_sign' );
register_deactivation_hook( __FILE__, 'deactivate_my_mayan_sign' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-my-mayan-sign.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_my_mayan_sign() {

	$plugin = new My_Mayan_Sign();
	$plugin->run();

}
run_my_mayan_sign();

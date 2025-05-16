<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://pixel-industry.com/
 * @since      1.0.0
 *
 * @package    My_Mayan_Sign
 * @subpackage My_Mayan_Sign/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    My_Mayan_Sign
 * @subpackage My_Mayan_Sign/includes
 * @author     PIXEL INDUSTRY <info@http://pixel-industry.com>
 */
class My_Mayan_Sign {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      My_Mayan_Sign_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'PLUGIN_NAME_VERSION' ) ) {
			$this->version = PLUGIN_NAME_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'my-mayan-sign';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - My_Mayan_Sign_Loader. Orchestrates the hooks of the plugin.
	 * - My_Mayan_Sign_i18n. Defines internationalization functionality.
	 * - My_Mayan_Sign_Admin. Defines all hooks for the admin area.
	 * - My_Mayan_Sign_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-my-mayan-sign-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-my-mayan-sign-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-my-mayan-sign-admin.php';

		/**
		 * The class responsible for PDF reports and sending email
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-my-mayan-sign-report-mailer.php';

		/**
		 * The class responsible for all procedures of mayan sign calculations
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-my-mayan-sign-procedures.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-my-mayan-sign-procedures-unsorted.php';

		/**
		 * The class responsible for all page creation
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-my-mayan-sign-pages.php';
		/**
		 * The class responsible for loading all front end pages
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/mymasi-shortcodes.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-my-mayan-sign-public.php';

		/**
		 * The class responsible for handling mymaca admin views logic and various functions
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/functions.php';

		/**
		 * The class responsible for adding custom post types
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/mymasi-custom-post-types.php';

		/**
		 * Responsible for adding additional setings for:
		 * https://wordpress.org/plugins/if-menu/
		 * which is needed for showing and hiding menu items by user membership
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/mymasi-menu-settings.php';

		/**
		 * The class responsible all template_redirect's
		 */

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/mymasi-redirects.php';

		/**
		 * The class responsible for all email notifications
		 */

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-my-mayan-sign-notifications.php';


		$this->loader = new My_Mayan_Sign_Loader();



	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the My_Mayan_Sign_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new My_Mayan_Sign_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new My_Mayan_Sign_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	*/
	private function define_public_hooks() {

		$plugin_public = new My_Mayan_Sign_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    My_Mayan_Sign_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}


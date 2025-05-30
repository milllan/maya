<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://pixel-industry.com/
 * @since      1.0.0
 *
 * @package    My_Mayan_Sign
 * @subpackage My_Mayan_Sign/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    My_Mayan_Sign
 * @subpackage My_Mayan_Sign/public
 * @author     PIXEL INDUSTRY <info@http://pixel-industry.com>
 */
class My_Mayan_Sign_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in My_Mayan_Sign_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The My_Mayan_Sign_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/my-mayan-sign-public.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name, '//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in My_Mayan_Sign_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The My_Mayan_Sign_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		// wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/my-mayan-sign-public.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/my-mayan-sign-public.js', array( 'jquery' ), 557, false );
		// wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/my-mayan-sign-public.js', array( 'jquery' ), NULL, false );
		// wp_enqueue_script( $this->plugin_name, 'https://code.jquery.com/ui/1.12.1/jquery-ui.js', '','',true);
		wp_localize_script( $this->plugin_name, 'mms', array(
			'ajax_url' => admin_url( 'admin-ajax.php' ),
			'nonce'    => wp_create_nonce( 'mms_save_info_ajax' ),
			'text'     => array(
			  'loading' => __( 'Loading...', 'my-mayan-sign' ),
			  'empty'  => __( 'Please fill all fields.', 'my-mayan-sign' ),
			  'error'  => __( 'Error.', 'my-mayan-sign' ),
			  'calc_label' => __('Register and recalculate', 'my-mayan-sign')
			)
		));
	}

}

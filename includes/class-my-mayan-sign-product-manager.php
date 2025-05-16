<?php

/**
 * Provides all functionality for product security management and routing
 *
 *
 * @link       http://pixel-industry.com/
 * @since      1.0.0
 *
 * @package    My_Mayan_Sign
 * @subpackage My_Mayan_Sign/includes
 */

/**
 * Provides all functionality for product security management and routing
 *
 *
 * @since      1.0.0
 * @package    My_Mayan_Sign
 * @subpackage My_Mayan_Sign/includes
 * @author     PIXEL INDUSTRY <info@http://pixel-industry.com>
 */

class My_Mayan_Sign_Product_Manager {

  /**
   * WP user
   *
   * @since    1.0.0
   * @access   private
   * @var      int    $day    email of Wordpress user.
   */
  private $user;

  /**
   * WC Product
   *
   * @since    1.0.0
   * @access   private
   * @var      int    $day    email of Wordpress user.
   */
  private $product;

   /**
   * Date for which we are checking the data
   *
   * @since    1.0.0
   * @access   private
   * @var      int    $day    email of Wordpress user.
   */
  private $date;

   /**
   * Is user born after the sundown? (yes|no)
   *
   * @since    1.0.0
   * @access   private
   * @var      int    $day    email of Wordpress user.
   */
  private $sun;


  public function __construct($productId, $orderItemId) {
    // Get the user
    $this->user = wp_get_current_user();
    // Check for rights
    if(!wc_customer_bought_product($this->user->user_email, $this->user->ID, $productId)) {
      wp_die( __( 'Action not allowed!' ) );
    }
    //Get product from factory
    $_pf = new WC_Product_Factory();
    $this->product = $_pf->get_product($productId);

    // Get other data
    $this->date = wc_get_order_item_meta($orderItemId, MMS_BDAY_KEY);
    $this->sun = wc_get_order_item_meta($orderItemId, 'Were you born after the sunrise');
  }

  public function getCoreSignView() {

  }

}

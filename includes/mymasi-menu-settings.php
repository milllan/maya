<?php
/**
*     Responsible for adding additional setings for:
*     https://wordpress.org/plugins/if-menu/
*     which is needed for showing and hiding menu items by user membership
 *
 *
 * @link       http://pixel-industry.com/
 * @since      1.0.0
 *
 * @package    My_Mayan_Sign
 * @subpackage My_Mayan_Sign/includes
 */

add_filter( 'if_menu_conditions', 'mymasi_menu_condition_free' );

function mymasi_menu_condition_free( $conditions ) {
  $conditions[] = array(
    'id'      => 'mymasi-menu-free',
    'name'    => 'Free User', // name of the condition
    'condition' =>  function($item) {          // callback - must return TRUE or FALSE
      if ( ! function_exists( 'wc_memberships' ) )
        return true;
      else
        return wc_memberships_is_user_active_member( get_current_user_id(), 'maya-member-free' );
    }
  );

  return $conditions;
}

add_filter( 'if_menu_conditions', 'mymasi_menu_condition_simple' );

function mymasi_menu_condition_simple( $conditions ) {
  $conditions[] = array(
    'id'      => 'mymasi-menu-simple',
    'name'    =>  'Simple Member', // name of the condition
    'condition' =>  function($item) {          // callback - must return TRUE or FALSE
    if ( ! function_exists( 'wc_memberships' ) )
        return true;
    else
      return wc_memberships_is_user_active_member( get_current_user_id(), 'maya-member-simple' );
    }
  );

  return $conditions;
}

add_filter( 'if_menu_conditions', 'mymasi_menu_condition_standard' );

function mymasi_menu_condition_standard( $conditions ) {
  $conditions[] = array(
    'id'      => 'mymasi-menu-standard',
    'name'    =>  'Standard Member', // name of the condition
    'condition' =>  function($item) {          // callback - must return TRUE or FALSE
    if ( ! function_exists( 'wc_memberships' ) )
        return true;
    else
      return wc_memberships_is_user_active_member( get_current_user_id(), 'maya-member-standard' );
    }
  );

  return $conditions;
}

add_filter( 'if_menu_conditions', 'mymasi_menu_condition_detailed' );

function mymasi_menu_condition_detailed( $conditions ) {
  $conditions[] = array(
    'id'      => 'mymasi-menu-detailed',
    'name'    =>  'Detailed Member', // name of the condition
    'condition' =>  function($item) {          // callback - must return TRUE or FALSE
    if ( ! function_exists( 'wc_memberships' ) )
        return true;
    else
      return wc_memberships_is_user_active_member( get_current_user_id(), 'maya-member-detailed' );
    }
  );

  return $conditions;
}

add_filter( 'if_menu_conditions', 'mymasi_menu_condition_competency' );

function mymasi_menu_condition_competency( $conditions ) {
  $conditions[] = array(
    'id'      => 'mymasi-menu-detailed',
    'name'    =>  'Competency Member', // name of the condition
    'condition' =>  function($item) {          // callback - must return TRUE or FALSE
    if ( ! function_exists( 'wc_memberships' ) )
        return true;
    else
      return wc_memberships_is_user_active_member( get_current_user_id(), 'maya-member-competency' );
    }
  );

  return $conditions;
}

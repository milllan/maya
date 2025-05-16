<?php

/**
 * Provide a view for the 'Mayan Sign Calculator' admin area
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://pixel-industry.com/
 * @since      1.0.0
 *
 * @package    My_Mayan_Sign
 * @subpackage My_Mayan_Sign/admin/views
 */
?>

<h1>Mayan Sign Calculator</h1>

<p>Calculator shortcode       : <code>[mayan_sign_calculator]</code></p>
<p>Core Sign shortcode        : <code>[mayan_core_sign]</code></p>
<p>Four Directions shortcode  : <code>[mayan_four_directions]</code></p>
<p>Synthesis shortcode        : <code>[mayan_synthesis]</code></p>

<hr>
<p>
	<form method="post" action="admin.php?page=mymasi-top-level-menu" >
		<input type="number" name="clear_cart_user_id" value="1">
		<input type="submit" name="clear_cart" value="Clear user cart by user ID">
	</form>
</p>

<hr>

<p>
	<b>Only use this feature when site is in maintenance mode!</b> <small>maya/includes/functions.php:7 - set to true</small><br>
	...because we don't want to send order confirmation emails to users! <br><br>
	Function is executed in batch of 100 because of server load and server execution time.<br><br>
	This will only work if user is created or imported on the same day as you're executing this function, <br>and you'll see label "pass" bellow user email, otherwise you'll see label "failed".<br>
	We don't want someone to accidentally execute this function.
</p>
<p>
	<form method="post" action="admin.php?page=mymasi-top-level-menu" >
		<input type="submit" name="give_cust_free_sub" value="Give all customers free standard report" <?php echo (!MAINTENTANCE_MODE ? "disabled" : "") ?>>
	</form>
</p>

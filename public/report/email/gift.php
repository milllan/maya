<?php
/**
 * MMS gift mail layout
 */

require_once(rtrim($_SERVER['DOCUMENT_ROOT'], '/') . '/wp-load.php');
$_POST = stripslashes_deep( $_POST );
$_POST['body'] = str_replace( array('\r\n'), "<br>", $_POST['body']);
$logo = NorebroSettings::get_logo();
?>

<div style="background-color: #f8f6ec; padding: 60px  15px; font-family: 'Poppins', sans-serif; font-weight: 300; color: #565656;">
  <div style="max-width: 500px; min-width: 200px; margin: 0 auto; background-color: #ffffff; padding: 40px; border-radius: 20px;">
  	<img src="<?php echo $logo['default'] ?>" alt="MyMayanSign logo">

    <p style="font-weight: light;color: #000; white-space: pre-wrap;"><?php echo $_POST['body']; ?></p>
    <br><br>
    <a style="text-decoration: none; color: #242424; margin: 0 5px; padding: 12px 28px; background: #E9C01B; border-radius: 50px; font-weight: 600; font-size: 13px; display: inline-block; box-shadow: 0px 1px 5px 0 rgba(0, 0, 0, 0.15); border-color: #E9C01B;" href="<?php echo $_POST['coupon']; ?>"><?php _e("Get your gift", "my-mayan-sign"); ?></a>
  </div>
</div>

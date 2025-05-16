<?php

// You can manipulate PHP variables here
require_once(rtrim($_SERVER['DOCUMENT_ROOT'], '/') . '/wp-load.php');
$_POST = stripslashes_deep( $_POST );
$logo = NorebroSettings::get_logo();
?>

<div style="background-color: #f8f6ec; padding: 60px  15px; font-family: 'Poppins', sans-serif; font-weight: 300; color: #565656;">
  <div style="max-width: 500px; min-width: 200px; margin: 0 auto; background-color: #ffffff; padding: 40px; border-radius: 20px;">
    <img src="<?php echo $logo['default'] ?>" alt="MyMayanSign logo">
    <h1 style="font-weight: 600;"><?php _e('Hi', 'my-mayan-sign') ?> <?php echo $_POST['name']; ?>,</h1>
    <p style="font-weight: light"><?php echo $_POST['content']; ?></p>
    <a href="<?php echo get_home_url() ?>/dashboard/#notifications"><p><?php _e('Disable email notifications in your dashboard', 'my-mayan-sign') ?></p></a>
  </div>
</div>

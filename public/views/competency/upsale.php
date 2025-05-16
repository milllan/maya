<?php
require_once(rtrim($_SERVER['DOCUMENT_ROOT'], '/') . '/wp-load.php'); ?>
<p><?php _e("You don't have sufficient number of packages.", 'my-mayan-sign'); ?> <?php _e("Please go to", 'my-mayan-sign'); ?> <a href="<?php echo get_home_url() . '/shop'; ?>"> <?php _e("shop", 'my-mayan-sign'); ?></a> <?php _e("and buy more!", 'my-mayan-sign'); ?></p>

<a class="btn shop-item" rel="nofollow" href="<?php echo $_POST['upgrade_url']; ?>">Buy now</a>

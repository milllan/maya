<?php

/**
 * Provides a markup for creating Competency Analysis view.
 * This is the view where user enters n combinations upon Competency
 * will be calculated
 *
 * This file is used to markup the public view aspects of the plugin.
 * You can access all the required variables throught $_POST
 *
 * @link       http://pixel-industry.com/
 * @since      1.0.0
 *
 * @package    My_Mayan_Sign
 * @subpackage My_Mayan_Sign/public/views
 */
?>
<?php

/**
 * Provides a markup for displaying Competency Analysis view user has previously created.
 *
 * This file is used to markup the public view aspects of the plugin.
 * You can access all the required variables throught $_POST
 *
 * @link       http://pixel-industry.com/
 * @since      1.0.0
 *
 * @package    My_Mayan_Sign
 * @subpackage My_Mayan_Sign/public/views
 */

require_once(rtrim($_SERVER['DOCUMENT_ROOT'], '/') . '/wp-load.php');
?>

<?php
  if (isset($_POST['ca_posts'])) {
    $items = $_POST['ca_posts'];
    $url = $_POST['view_url'];
    $itemCount = 1;
    foreach($items as $item) {
      $date_stamp = strtotime($item['post_date']);
      $postdate = date("jS F, Y", $date_stamp);

      echo '<div class="competency">';
      echo '<div class="competency_img">';
      echo '<img src="'.$_POST['plugin_url'] . 'images/ca-overview-item.png' . '" />';
      echo '</div>';
      echo '<div class="competency_text">';
      echo '<h2>' . _x('Competency analysis', 'my-mayan-sign') . '</h2>';
      /*echo '<div class="competency_price">
              <p>20 combinations   /   $40</p>
            </div>';*/
      echo '<ul>
              <li><p><span>' . _x('For:', 'my-mayan-sign') . '</span> ' . $item['post_title'] .  '</p></li>
              <li><p><span>' . _x('Created:', 'my-mayan-sign') . '</span> ' . /*$item['post_date']*/$postdate . '</p></li>
              <li><p><span>' . _x('Item:', 'my-mayan-sign') . '</span> ' . $itemCount . '/'.$_POST['ca_count'] . '</p></li>
            </ul>';
      echo '<a href="' . $_POST['view_url'] . '?id=' . $item['ID'] . '">' . _x('View Details', 'my-mayan-sign') . '</a>';
      echo '</div>';
      echo '</div>';
      $itemCount++;
    }
  } else {
    echo '<p>' . _x('There is nothing to display.', 'my-mayan-sign') . '</p>';
  }
?>
<br><br>

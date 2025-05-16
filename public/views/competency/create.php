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

require_once(rtrim($_SERVER['DOCUMENT_ROOT'], '/') . '/wp-load.php');
$packages_left = $_POST['packages_left'];
?>
<div class="competency_items">
  <p><?php _e('Items left in package: ', 'my-mayan-sign'); ?><span><?php echo sprintf( _n( '%s combination', '%s combinations', $packages_left, 'my-mayan-sign' ), $packages_left ); ?></span></p>
</div>

<form action="<?php echo $_POST['url']; ?>" method="post">
  <div id="mymasi-ca-wrap">
      <div id="mymasi_zero_ca_element" class="mymasi-ca-add-item">
        <div class="two-columns">
          <div class="two-columns_left">
            <label><?php _e('Name', 'my-mayan-sign'); ?></label>
            <input name="names[]" class="mms-names" type="text">
          </div>
          <div class="two-columns_right">
             <span class="two-columns_heading"><?php _e('Your Birthday', 'my-mayan-sign'); ?></span>
             <p></p>
             <div class="two-columns_form">
                <span class="wpcf7-form-control-wrap menu-day">
                   <select name="menu-day[]" class="wpcf7-form-control wpcf7-select select2-hidden-accessible" aria-invalid="false" tabindex="-1" aria-hidden="true">
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                      <option value="6">6</option>
                      <option value="7">7</option>
                      <option value="8">8</option>
                      <option value="9">9</option>
                      <option value="10">10</option>
                      <option value="11">11</option>
                      <option value="12">12</option>
                      <option value="13">13</option>
                      <option value="14">14</option>
                      <option value="15">15</option>
                      <option value="16">16</option>
                      <option value="17">17</option>
                      <option value="18">18</option>
                      <option value="19">19</option>
                      <option value="20">20</option>
                      <option value="21">21</option>
                      <option value="22">22</option>
                      <option value="23">23</option>
                      <option value="24">24</option>
                      <option value="25">25</option>
                      <option value="26">26</option>
                      <option value="27">27</option>
                      <option value="28">28</option>
                      <option value="29">29</option>
                      <option value="30">30</option>
                      <option value="31">31</option>
                   </select>
                </span>
                <br>
                <span class="wpcf7-form-control-wrap menu-month">
                   <select name="menu-month[]" class="wpcf7-form-control wpcf7-select select2-hidden-accessible" aria-invalid="false" tabindex="-1" aria-hidden="true">
                      <option value="1"><?php _e('January', 'my-mayan-sign'); ?></option>
                      <option value="2"><?php _e('February', 'my-mayan-sign'); ?></option>
                      <option value="3"><?php _e('March', 'my-mayan-sign'); ?></option>
                      <option value="4"><?php _e('April', 'my-mayan-sign'); ?></option>
                      <option value="5"><?php _e('May', 'my-mayan-sign'); ?></option>
                      <option value="6"><?php _e('June', 'my-mayan-sign'); ?></option>
                      <option value="7"><?php _e('July', 'my-mayan-sign'); ?></option>
                      <option value="8"><?php _e('August', 'my-mayan-sign'); ?></option>
                      <option value="9"><?php _e('September', 'my-mayan-sign'); ?></option>
                      <option value="10"><?php _e('October', 'my-mayan-sign'); ?></option>
                      <option value="11"><?php _e('November', 'my-mayan-sign'); ?></option>
                      <option value="12"><?php _e('December', 'my-mayan-sign'); ?></option>
                   </select>
                </span>
                <br>
                <span class="wpcf7-form-control-wrap menu-year">
                   <select name="menu-year[]" class="wpcf7-form-control wpcf7-select select2-hidden-accessible" aria-invalid="false" tabindex="-1" aria-hidden="true">
                      <?php for($i = date('Y'); $i > 1900; $i--)
                        echo '<option value="'.$i.'">'.$i.'</option>';
                      ?>
                   </select>
                </span>
             </div>
          </div>
        </div>
      </div>
      <div id="mymasi_first_ca_element" class="mymasi-ca-add-item">
        <a href="#" class="mms-remove_person_field" onclick="mms_remove_person(this)"></a>
        <div class="two-columns">
          <div class="two-columns_left">
            <label><?php _e('Name', 'my-mayan-sign'); ?></label>
            <input name="names[]" class="mms-names" type="text">
          </div>
          <div class="two-columns_right">
             <span class="two-columns_heading"><?php _e('Your Birthday', 'my-mayan-sign'); ?></span>
             <p></p>
             <div class="two-columns_form">
                <span class="wpcf7-form-control-wrap menu-day">
                   <select name="menu-day[]" class="wpcf7-form-control wpcf7-select select2-hidden-accessible" aria-invalid="false" tabindex="-1" aria-hidden="true">
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                      <option value="6">6</option>
                      <option value="7">7</option>
                      <option value="8">8</option>
                      <option value="9">9</option>
                      <option value="10">10</option>
                      <option value="11">11</option>
                      <option value="12">12</option>
                      <option value="13">13</option>
                      <option value="14">14</option>
                      <option value="15">15</option>
                      <option value="16">16</option>
                      <option value="17">17</option>
                      <option value="18">18</option>
                      <option value="19">19</option>
                      <option value="20">20</option>
                      <option value="21">21</option>
                      <option value="22">22</option>
                      <option value="23">23</option>
                      <option value="24">24</option>
                      <option value="25">25</option>
                      <option value="26">26</option>
                      <option value="27">27</option>
                      <option value="28">28</option>
                      <option value="29">29</option>
                      <option value="30">30</option>
                      <option value="31">31</option>
                   </select>
                </span>
                <br>
                <span class="wpcf7-form-control-wrap menu-month">
                   <select name="menu-month[]" class="wpcf7-form-control wpcf7-select select2-hidden-accessible" aria-invalid="false" tabindex="-1" aria-hidden="true">
                      <option value="1"><?php _e('January', 'my-mayan-sign'); ?></option>
                      <option value="2"><?php _e('February', 'my-mayan-sign'); ?></option>
                      <option value="3"><?php _e('March', 'my-mayan-sign'); ?></option>
                      <option value="4"><?php _e('April', 'my-mayan-sign'); ?></option>
                      <option value="5"><?php _e('May', 'my-mayan-sign'); ?></option>
                      <option value="6"><?php _e('June', 'my-mayan-sign'); ?></option>
                      <option value="7"><?php _e('July', 'my-mayan-sign'); ?></option>
                      <option value="8"><?php _e('August', 'my-mayan-sign'); ?></option>
                      <option value="9"><?php _e('September', 'my-mayan-sign'); ?></option>
                      <option value="10"><?php _e('October', 'my-mayan-sign'); ?></option>
                      <option value="11"><?php _e('November', 'my-mayan-sign'); ?></option>
                      <option value="12"><?php _e('December', 'my-mayan-sign'); ?></option>
                   </select>
                </span>
                <br>
                <span class="wpcf7-form-control-wrap menu-year">
                   <select name="menu-year[]" class="wpcf7-form-control wpcf7-select select2-hidden-accessible" aria-invalid="false" tabindex="-1" aria-hidden="true">
                      <?php for($i = date('Y'); $i > 1900; $i--)
                        echo '<option value="'.$i.'">'.$i.'</option>';
                      ?>
                   </select>
                </span>
             </div>
          </div>
        </div>
      </div>
  </div>
  <div class="competency-buttons">
    <button id="mymasi-ca-add"><?php _e('Add a person', 'my-mayan-sign'); ?></button>
    <button id="mymasi-ca-submit" type="submit" id="mymasi-ca-save"><?php _e('Generate', 'my-mayan-sign'); ?></button>
  </div>

</form>

<script>
  (function($){
      $( "#mymasi-ca-add" ).click(function( event ) {
        event.preventDefault();

        var rand_id = Math.floor((Math.random() * 968465) + 1);
        var html = '<div id="mymasi_ca_element_' + rand_id + '" class="mymasi-ca-add-item">';
        html += '<a href="#" class="mms-remove_person_field" onclick="event.preventDefault(); mms_remove_person(this)"></a>';
        html += $( ".mymasi-ca-add-item" ).first().html();
        html += '</div>';
        $('#mymasi-ca-wrap').append( html );

        $(document).find('select').select2({
          minimumResultsForSearch: Infinity
        });  

        $selects = $(document).find('#mymasi_ca_element_' + rand_id + ' .wpcf7-form-control-wrap span.select2:last-child');
        $.each( $selects, function( key, value ){
          $(value).last().remove();
        });
      });

      $( "#mymasi-ca-submit" ).click(function( event ) {

        var countBoxes = $('.mms-names').length;

        if(countBoxes < 2){
            var r = confirm("Please select at least two names");
            if (r == true) {
              return false;
            } else {
                  return false;
            }
        }

        $( ".mms-names" ).each(function( index ) {
          if($( this ).val() == ''){
            event.preventDefault();
            var r = confirm("Please fill all names!");
            if (r == true) {
              return false;
            } else {
                  return false;
            }
          }
        });
      });

  })(jQuery);
        function mms_remove_person(obj, event){
          jQuery(obj).parent().remove();
      }

</script>

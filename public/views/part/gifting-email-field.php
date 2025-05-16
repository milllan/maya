  <?php

/**
 * Provides a markup for creating Custom select
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

  <div id="mymasi-ca-wrap">
      <div class="mymasi-ca-item">
        <div class="two-columns">
          <label><input type="checkbox" id="gift_this" name="gift_this"> <?php _e("Gift this product", "my-mayan-sign"); ?></label>
        </div>
        <div id="gift_email_field" class="two-columns" style ="display:none">
          <div class="two-columns_right">
            <p class="form-row form-row-wide validate-required validate-email" id="gift_email_field" data-priority="110"><label for="gift_email" class="">Email address <abbr class="required" title="required">*</abbr></label><input type="email" class="input-text " name="gift_email" id="gift_email" placeholder="Email" value="" autocomplete="email username"></p>
          </div>
        </div>
      </div>
  </div>  
  <style>
.wccpf_fields_table {
    visibility: hidden;
    display: table-column-group;
  }
</style>
  <script>
    (function($){
      $("#gift_this").change(function(){ 
        if(this.checked){
          $("#gift_email_field").show("slow");
          $('input[name="gift_this_product[]"]').attr("checked", "checked");
          $('#pay_now_btn').hide();
          $('.single_add_to_cart_button').show();
        }else{
          $("#gift_email_field").hide("slow");
          $('input[name="gift_this_product[]"]').removeAttr("checked");
          $('#gift_email, input[name="gift_to_friend"]').val("");
          $('#pay_now_btn').show();
          $('.single_add_to_cart_button').hide();
        }
      });

      $("#gift_email").change(function(){
        $('input[name="gift_to_friend"]').val($(this).val());
      });
    })(jQuery);
  </script>
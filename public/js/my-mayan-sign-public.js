function printAll(e) { printWindow = window.open(e, "printWindow", "width=900,height=600") }

function date_fixer(e) { return e ? e : e = "" }

function getCookie(e) { for (var t = e + "=", n = window.document.cookie.split(";"), i = 0; i < n.length; i++) { var a = n[i].trim(); if (0 == a.indexOf(t)) return a.substring(t.length, a.length) } return "" }(function(e) {
    "use strict";
    e(document).ready(function() {
        e("#mms_save_info").on("click", function(t) {
            t.preventDefault();
            var n = e("#mms_info_form"),
                i = n.find('input[name="your_birthday"]').val(),
                // a = n.find("#gender").val(),
                a = n.find("#first_name").val(),
                o = n.find("#notice_holder");
            if (i && a) {
            // if (i) {
                o.html('<div class="notice notice-loading"><p>' + mms.text.loading + "</p></div>").fadeIn(300);
                // var s = { date: i, gender: a };
                var s = { date: i, first_name: a };
                // var s = { date: i };
                e.ajax({ url: mms.ajax_url, method: "POST", data: { action: "mms_save_info", data: s, nonce: mms.nonce }, success: function(t) { t.success ? (o.html('<div class="notice notice-success"><p>' + t.data.message + "</p></div>").fadeIn(300), setTimeout(function() { e(".page-preloader").fadeIn("fast").removeClass("closed"), location.reload() }, 2e3)) : o.html('<div class="notice notice-error"><p>' + t.data.message + "</p></div>").fadeIn(300) }, error: function() { o.html('<div class="notice notice-error"><p>' + mms.text.error + "</p></div>").fadeIn(300) } })
            } else o.html('<div class="notice notice-error"><p>' + mms.text.empty + "</p></div>").fadeIn(300)
        });
        var t = e(".mms-overlay.one_last_step");
        t.length && (console.log("popup"), setTimeout(function() { console.log("show"), t.fadeIn("slow"), t.find(".mms-popup").show() }, 2e3), t.find(".mms-popup_close").click(function() { t.fadeOut("slow") }));
        var n = e("#mms_info_form");
        n.find("#year, #month, #day").change(function() {
            var t = date_fixer(n.find("#day").val()),
                i = date_fixer(n.find("#month").val()),
                a = date_fixer(n.find("#year").val());
            e(this).closest(".mms_date").find("input[name='your_birthday']").val(a + i + t)
        });
        var i = e("#mms_calculator_form");
        i.find("#year, #month, #day").change(function() {
            var t = date_fixer(i.find("#day").val()),
                n = date_fixer(i.find("#month").val()),
                a = date_fixer(i.find("#year").val());
            e(this).closest(".mms_date").find("input[name='your_birthday']").val(a + n + t)
        });
        var a = e(document).find(".mms_date input[name='your_birthday']");
        e.each(a, function() {
            if (e(this).length) var t = e(this).val(),
                n = t.substring(0, 4),
                i = t.substring(4, 6),
                a = t.substring(6, 8),
                a = e(this).closest(".mms_date").find("#day").val(a),
                i = e(this).closest(".mms_date").find("#month").val(i),
                n = e(this).closest(".mms_date").find("#year").val(n)
        });
        // var o = e("#submit_to_calc").not(".goToLogin");
        // if (o.click(function(t) {
        //         var n = e("#mms_calculator_form"),
        //             i = n.find("#notice_holder"),
        //             a = date_fixer(n.find("#day").val()),
        //             o = date_fixer(n.find("#month").val()),
        //             s = date_fixer(n.find("#year").val());
        //         a && o && s ? e(".page-preloader").fadeIn("fast").removeClass("closed") : (t.preventDefault(), i.find(".notice").html("<p>" + mms.text.empty + "</p>").show("fast").delay(2e3).fadeOut(300))
        //     }), !e("body").hasClass("logged-in")) {
        //     var s = getCookie("mms_calculator_active");
        //     if ("visited" == s) {
        //         var r = e("#mms_calculator_form_wrapper");
        //         r.html('<div class="two-columns"><div class="two-columns_left"><input type="submit" onclick="goToLogin()" value="' + mms.text.calc_label + '" class="wpcf7-form-control wpcf7-submit calendar-submit goToLogin"></div><div class="scroll-down-wrap"><a href="#intro" class="scroll-down"><span></span></a></div><script>  function goToLogin() {    window.location.href=window.location.origin + "/login/?re=mayan-sign-calculator";  }</script></div>')
        //     } else e(".please-register-msg").length && e(".please-register-msg").hide()
        // }
        // e(".calculator-page a[href*=#]").on("click", function(t) { t.preventDefault(), e("html, body").animate({ scrollTop: e(e(this).attr("href")).offset().top - 200 }, 500, "linear") })
    })
})(jQuery);
var printWindow;
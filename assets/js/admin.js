!(function (n) {
    n(document).on("ready", function () {
        0 < n(".chp_ads_color_picker").length && n(".chp_ads_color_picker").wpColorPicker();
    });

    function get_tinymce_content(id) {
        let content = '';
        let inputid = id;
        try {
            let editor = tinyMCE.get(inputid);
            let textArea = jQuery('textarea#' + inputid);
            if (textArea.length > 0 && textArea.is(':visible')) {
                content = textArea.val();
            } else {
                content = editor.getContent();
            }
        } catch (error) {
            content = jQuery('textarea#' + inputid).val();
        }
        return content;
    }
    
    n(document).on("click", "#chp_ads_save_settings", function (t) {
        t.preventDefault();
        var e = n(this),
            c = e.html();
        e.html('<img style="width:15px;" src="' + chpadb.plugin_path + 'assets/img/load.gif">');
        var i = { content: get_tinymce_content("chp_ads_content") };

        n(document).find(".chpabd_form_settings.include").each(function () {
            if (n(this).attr('type') == 'checkbox')
                i[n(this).attr('name')] = n(this).is(':checked') ? 'true' : 'false';
            else
                i[n(this).attr('name')] = n(this).val();
        });
        t = { action: "chp_abd_action", settings: i };

        jQuery.post(ajaxurl, t, function (t) {
            alert(t);
            e.html(c);
        });
    });

    n(document).on("click", "#chp_ads_reset_settings", function (t) {
        t.preventDefault();
        var e = n(this),
            c = e.html();
        e.html('<img style="width:15px;" src="' + chpadb.plugin_path + 'assets/img/load.gif">');
        jQuery.post(ajaxurl, { action: "chp_abd_action", reset: "reset" }, function (t) {
            alert(t);
            window.location.href = window.location.href;
        });
    });
})(jQuery);

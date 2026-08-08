!(function ($) {
    $(document).on("ready", function () {
        0 < $(".chp_ads_color_picker").length && $(".chp_ads_color_picker").wpColorPicker();
    });

    function get_tinymce_content(id) {
        let content = '';
        let inputid = id;
        try {
            let editor = tinyMCE.get(inputid);
            let textArea = $('textarea#' + inputid);
            if (textArea.length > 0 && textArea.is(':visible')) {
                content = textArea.val();
            } else {
                content = editor.getContent();
            }
        } catch (error) {
            content = $('textarea#' + inputid).val();
        }
        return content;
    }
    
    $(document).on("click", "#chp_ads_save_settings", function (t) {
        t.preventDefault();
        var e = $(this),
            c = e.html();
        e.html('<img style="width:15px;" src="' + chpadb.plugin_path + 'assets/img/load.gif">');
        var i = { content: get_tinymce_content("chp_ads_content") };

        $(document).find(".chpabd_form_settings.include").each(function () {
            if ($(this).attr('type') == 'checkbox')
                i[$(this).attr('name')] = $(this).is(':checked') ? 'true' : 'false';
            else
                i[$(this).attr('name')] = $(this).val();
        });
        t = { action: "chp_abd_action", settings: i };
        t._wpnonce = $(document).find("#_wpnonce").val();
        
        $.post(ajaxurl, t, function (t) {
            alert(t);
            e.html(c);
        });
    });

    $(document).on("click", "#chp_ads_reset_settings", function (t) {
        t.preventDefault();
        var e = $(this),
            c = e.html();
        e.html('<img style="width:15px;" src="' + chpadb.plugin_path + 'assets/img/load.gif">');
        $.post(ajaxurl, { 
            action: "chp_abd_action", 
            reset: "reset" ,
            _wpnonce : $(document).find("#_wpnonce").val()
        }, function (t) {
            alert(t);
            window.location.href = window.location.href;
        });
    });
})(jQuery);

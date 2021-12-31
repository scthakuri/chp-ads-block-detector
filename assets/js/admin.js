!(function (n) {
    n(document).on("ready", function () {
        0 < n(".chp_ads_color_picker").length && n(".chp_ads_color_picker").wpColorPicker();
    });
    
    n(document).on("click", "#chp_ads_save_settings", function (t) {
        t.preventDefault();
        var e = n(this),
            c = e.html();
        e.html('<img style="width:15px;" src="' + chpadb.plugin_path + 'assets/img/load.gif">');
        var i = { content: tinyMCE.activeEditor.getContent() };
        n(document)
            .find("#chp_ads_block_table .chpabd_form_settings.include")
            .each(function () {
                "checkbox" == n(this).attr("type") ? (i[n(this).attr("name")] = n(this).is(":checked") ? "true" : "false") : (i[n(this).attr("name")] = n(this).val());
            });
        t = { action: "chp_abd_action", settings: i };
        jQuery.post(ajaxurl, t, function (t) {
            let called = false;
            alerty.alert(
                t,
                {
                    title: chpadb.response,
                },
                function () {
                    called = true;
                    e.html(c);
                }
            );

            if( ! called ){
                alert(t);
                e.html(c);
            }
        });
    });

    n(document).on("click", "#chp_ads_reset_settings", function (t) {
        t.preventDefault();
        var e = n(this),
            c = e.html();
        e.html('<img style="width:15px;" src="' + chpadb.plugin_path + 'assets/img/load.gif">');
        jQuery.post(ajaxurl, { action: "chp_abd_action", reset: "reset" }, function (t) {
            
            let called = false;
            alerty.alert(
                t,
                {
                    title: chpadb.response,
                },
                function () {
                    called = true;
                    window.location.href = window.location.href;
                }
            );
            
            if( ! called ){
                alert(t);
                window.location.href = window.location.href;
            }
            
        });
    });
})(jQuery);

<div class="chp_ads_blocker-overlay" id="chp_ads_blocker-overlay" tabindex="-1"></div>
<div class="chp_ads_blocker_detector chp_ads_blocker_detector-hide" id="chp_ads_blocker-modal"><?php echo $iconCode; ?>
    <div class="chp_ads_blocker_detector-title"><?php echo $settings['title']; ?></div>
    <div class="chp_ads_blocker_detector-content">
        <?php echo str_replace('<p', '<p class="chp_ads_blocker_detector-message"', $settings['content']); ?></div>
    <div class="chp_ads_blocker_detector-action">
        <?php if( filter_var( $settings['btn2_show'], FILTER_VALIDATE_BOOLEAN ) ): ?><a
            class="chp_ads_blocker_detector-action-btn-close"
            onclick="chp_ads_blocker_detector(false)"><?php echo $settings['btn2_text']; ?></a><?php endif; ?><?php if( filter_var( $settings['btn1_show'], FILTER_VALIDATE_BOOLEAN ) ): ?><a
            class="chp_ads_blocker_detector-action-btn-ok"
            onclick="reload()"><?php echo $settings['btn1_text']; ?></a><?php endif; ?></div>
</div>



<?php
    /**
     * Hooks to enable or disbale google
     * ads detetcion method
     * 
     * @since 5.1.2
     */
    $googleAds = apply_filters('adb/checkby/googleads', true);
    $imageAds = apply_filters('adb/checkby/imageads', true);
    $debug = apply_filters('adb/debug/js', false);
    $checkinterval = apply_filters('adb/check/interval', 0);
    $branding = apply_filters('adb/branding', true);

    if( $branding ){
        echo sprintf('<div id="chp_branding" class="chp_branding"><a href="https://codehelppro.com/product/wordpress/plugin/chp-ads-block-detector-pro/" target="_blank" rel="noopener noreferrer"><span class="chp_brading_powered_by" style="color: rgb(9, 13, 22);">Powered By</span> <div class="chp_brading_svg"><img src="%sassets/img/branding.svg" alt="CHP Adblock Detector Plugin | Codehelppro" /></div></a></div>', CHP_ADSB_URL);
    }else{
        echo '<div id="chp_branding" class="chp_branding"></div>';
    }

    /**
     * Enable or Disable Image Ads Request
     * 
     * @since 5.1.2
     */
    if( $imageAds ){
        echo '<div class="demo-wrapper" style="display:none;"><div class="ads"><img id="chp-ads-image" src="images/ads.jpg" height="250" width="300" alt=""></div></div>';
    }else{
        echo '<div class="demo-wrapper" style="display:none;"><div id="chp-ads-image"></div></div>';
    }


?>

<script>
const debug = <?php echo $debug ? 'true' : 'false'; ?>;const checkinterval = <?php echo $checkinterval; ?>;const adbVersion = "<?php echo CHP_ADSB_VERSION; ?>";function adsBlocked(enable) {<?php if( $googleAds ): ?>var t = new Request("https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js", {method: "HEAD",mode: "no-cors"});  fetch(t).then(function(t) {if (debug) {console.log('[ADB DEBUG] Google Ads Request Passed!!!');};enable(!1);}).catch(function(t) {if (debug) {console.warn('[ADB DEBUG] Google Ads Request Failed!!!');console.warn(`[ADB DEBUG] ${t}`);}enable(!0);});<?php else: ?>console.warn('[ADB DEBUG] Google Ads Request Blocked by Filter Hook!!!');enable(!1);<?php endif; ?>}function isHidden(e){return"none"===window.getComputedStyle(e).display}function reload(){window.location.href=window.location.href}function hasClass(e,d){return!!e.className.match(new RegExp("(\\s|^)"+d+"(\\s|$)"))}function addClass(e,d){hasClass(e,d)||(e.className+=" "+d)}function removeClass(e,d){if(hasClass(e,d)){var a=new RegExp("(\\s|^)"+d+"(\\s|$)");e.className=e.className.replace(a," ")}}document.addEventListener("DOMContentLoaded",init,!1);let intervalId,count=0;function chp_ads_blocker_detector(e){let d=document.getElementById("chp_ads_blocker-overlay"),a=document.getElementById("chp_ads_blocker-modal"),n=document.getElementById("chp_branding");e?(clearInterval(intervalId),null!==d&&addClass(d,"active"),addClass(a,"chp_ads_blocker_detector-show"),removeClass(a,"chp_ads_blocker_detector-hide"),removeClass(n,"hide")):(null!==d&&removeClass(d,"active"),removeClass(a,"chp_ads_blocker_detector-show"),addClass(a,"chp_ads_blocker_detector-hide"),addClass(n,"hide"))}function checkMultiple(){let e=!1,d=document.createElement("div");d.innerHTML="&nbsp;",d.className="ad ads doubleclick ad-placement ad-placeholder adbadge BannerAd adsbox";try{document.body.appendChild(d);var a=document.querySelector(".adsbox");e=!a||0===a.offsetHeight,debug&&(e?console.warn("[ADB DEBUG] Class Add Request Failed!!!"):console.log("[ADB DEBUG] Class Add Request Passed!!!"))}finally{d.parentNode.removeChild(d)}return e}function init(){adsBlocked(function(e){if(e)chp_ads_blocker_detector(!0);else{const e=isHidden(document.getElementById("chp-ads-image"));debug&&(e?console.warn("[ADB DEBUG] Image Ads Request Failed!!!"):console.log("[ADB DEBUG] Image Ads Request Passed!!!")),chp_ads_blocker_detector(e)}})}checkinterval>0?window.onload=(e=>{intervalId=window.setInterval(function(){init()},checkinterval)}):init();
</script>
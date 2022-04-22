const adblockModal = document.getElementById("chp_ads_block_modal_new<?php echo $this->randnum; ?>");
const adbEnableForPage = true;
const debug = <?php echo $debug ? 'true' : 'false'; ?>;
const adbVersion = "<?php echo CHP_ADSB_VERSION; ?>";
const ajaxurl = "<?php echo admin_url( 'admin-ajax.php' ); ?>";
let onPageLoad = <?php echo filter_var($onPageFullyLoaded, FILTER_VALIDATE_BOOLEAN) ? "true" : "false"; ?>;
let googleAdsControl = <?php echo filter_var($googleAds, FILTER_VALIDATE_BOOLEAN) ? "true" : "false"; ?>;
let imageAdsControl = <?php echo filter_var($imageAds, FILTER_VALIDATE_BOOLEAN) ? "true" : "false"; ?>;
let classAdsControl = <?php echo filter_var($classAds, FILTER_VALIDATE_BOOLEAN) ? "true" : "false"; ?>;
let displayOnce = 0;
let adsRequestURL = "<?php echo $adsrequest; ?>";


/**
 * Hide on click
 */
const brandingBtn = document.getElementById("chp_branding<?php echo $this->randnum; ?>");
if(brandingBtn){
    brandingBtn.addEventListener("click", function(event){
        event.preventDefault();
        window.location.href = "https://codehelppro.com/product/wordpress/plugin/chp-ads-block-detector-pro/";
        return false;
    });
}
const adblockCloseBtn = document.getElementById("close_btn_adblock<?php echo $this->randnum; ?>");
if(adblockCloseBtn){
    adblockCloseBtn.onclick = function(){
        hide_model();
    }
}

/**
 * Check internet connection
 */
function is_connected() {
    try {
        return window.navigator.onLine;
    } catch (error) {
        return true;
    }
}

/**
 * Send google Ads Request
 *
 * @param One Callback function
 */
function adsBlocked(callBackFunc) {

    if (googleAdsControl && is_connected()) {
        let adsRequest = new Request(adsRequestURL, {
            method: "HEAD",
            mode: "no-cors"
        });
        fetch(adsRequest).then(function(res) {
            if (debug) {
                console.warn("[ADB DEBUG] Google Ads Request Passed!!!");
            }
            callBackFunc(false);
        }).catch(function(res) {
            if (debug) {
                console.warn("[ADB DEBUG] Google Ads Request Failed!!!");
                console.warn(`[ADB DEBUG] ${res}`)
            }
            callBackFunc(true);
        })
    } else {
        if (debug) {
            console.warn("[ADB DEBUG] Google Ads Request Blocked by Filter Hook or Offline!!!");
        }
    }

    callBackFunc(false);
}


/**
 * Default callback function
 *
 * @param e as data
 */
function chpadb_default_callback(e) {
    console.log(e)
}


/**
 * Reload page
 *
 */
function reload() {
    window.location.href = window.location.href
}


/**
 * Redirect to certain page
 *
 * @param e as url
 */
function redirect(e) {
    window.location.href = e
}


/**
 * 
 *
 * @param e as data
 */
function hasClass(e, t) {
    return !!e.className.match(new RegExp("(\\s|^)" + t + "(\\s|$)"))
}

function addClass(e, t) {
    hasClass(e, t) || (e.className += " " + t)
}

function removeClass(e, t) {
    if (hasClass(e, t)) {
        var o = new RegExp("(\\s|^)" + t + "(\\s|$)");
        e.className = e.className.replace(o, " ")
    }
}

let count = 0;


function hide_model() {
    try{
        if (typeof adblockModal == 'object') {
            removeClass(adblockModal, "chp_ads_blocker_detector-show<?php echo $this->randnum; ?>");
            removeClass(document.body, "chp_ads_blocker_detector_active<?php echo $this->randnum; ?>")
        }
    }catch(e){
        console.warn(e);
    }
}

function show_modal(modal) {
    if (modal != null && 0 == displayOnce) {
        displayOnce++;
        addClass(modal, "chp_ads_blocker_detector-show<?php echo $this->randnum; ?>");
        addClass(document.body, "chp_ads_blocker_detector_active<?php echo $this->randnum; ?>")
    }
}

function chp_adblock_browser() {
    return /Opera[\/\s](\d+\.\d+)/.test(navigator.userAgent) ? "Opera" : /MSIE (\d+\.\d+);/.test(navigator.userAgent) ?
        "MSIE" : /Navigator[\/\s](\d+\.\d+)/.test(navigator.userAgent) ? "Netscape" : /Chrome[\/\s](\d+\.\d+)/.test(
            navigator.userAgent) ? "Chrome" : /Safari[\/\s](\d+\.\d+)/.test(navigator.userAgent) ? "Safari" :
        /Firefox[\/\s](\d+\.\d+)/.test(navigator.userAgent) ? "Firefox" : "Unknown"
}

function chp_ads_blocker_detector(enable) {
    if (enable) {
        show_modal(adblockModal);
    }
}

let prevCount = 0;
function checkMultiple() {
    let enable = false;
    if (classAdsControl) {
        let divEle = document.createElement("div");
        divEle.innerHTML = "&nbsp;";
        divEle.className = "ad ads doubleclick ad-placement ad-placeholder adbadge BannerAd adsbox";
        divEle.id = "filter_ads_by_classname";

        try {
            if (!document.body.contains(document.getElementById('filter_ads_by_classname'))) {
                document.body.appendChild(divEle);
                let adBoxEle = document.querySelector(".adsbox");
                enable = !adBoxEle || adBoxEle.offsetHeight == 0;

                if (debug) {
                    if (enable) {
                        console.warn("[ADB DEBUG] Class Add Request Failed!!!");
                    } else {
                        console.log("[ADB DEBUG] Class Add Request Passed!!!");
                    }
                }
            } else {
                let adBoxEleId = document.getElementById("filter_ads_by_classname");
                removeClass(adBoxEleId, ` ads_${prevCount}`);
                removeClass(adBoxEleId, `ads_${prevCount}`);
                prevCount++;
                addClass(adBoxEleId, `ads_${prevCount}`);
            }
        } catch (error) {
            divEle.parentNode.removeChild(divEle);
        }
    }else{
        if(debug){
            console.warn("[ADS PRO DEBUG] Check Multiple Request Blocked by Filter Hook or Offline");
        }
    }
    return enable;
}

function isHidden(e) {
    return "none" === window.getComputedStyle(e).display
}

function init() {
    adsBlocked(function(enable) {
        if (enable) {
            chp_ads_blocker_detector(true);
        } else {
            if (imageAdsControl) {
                enable = isHidden(document.getElementById("chp-ads-image"));
                if (debug) {
                    if (enable) {
                        console.warn("[ADB DEBUG] Image Ads Request Failed!!!");
                    } else {
                        console.log("[ADB DEBUG] Image Ads Request Passed!!!");
                    }
                }
            }

            if (!enable) {
                enable = checkMultiple();
                if (debug) {
                    if (enable) {
                        console.warn("[ADB DEBUG] Check Multiple Request Failed!!!");
                    } else {
                        console.log("[ADB DEBUG] Check Multiple Request Passed!!!");
                    }
                }
            }
            chp_ads_blocker_detector(enable)
        }
    })
}


function startCheckingAdblock() {
    init();
}

if (adbEnableForPage) {
    if (onPageLoad) {
        document.addEventListener("DOMContentLoaded", function(e) {
            startCheckingAdblock();
        }, false);
    } else {
        startCheckingAdblock();
    }
}
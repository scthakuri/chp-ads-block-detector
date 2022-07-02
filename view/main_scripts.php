const adblockModal = document.getElementById("<?php echo $this->rclass("modal"); ?>");
const adbEnableForPage = true;
const debug = <?php echo $debug ? 'true' : 'false'; ?>;
const adbVersion = "<?php echo CHP_ADSB_VERSION; ?>";
const ajaxurl = "<?php echo admin_url( 'admin-ajax.php' ); ?>";
let onPageLoad = <?php echo filter_var($onPageFullyLoaded, FILTER_VALIDATE_BOOLEAN) ? "true" : "false"; ?>;
let googleAdsControl = <?php echo filter_var($googleAds, FILTER_VALIDATE_BOOLEAN) ? "true" : "false"; ?>;
let imageAdsControl = <?php echo filter_var($imageAds, FILTER_VALIDATE_BOOLEAN) ? "true" : "false"; ?>;
let classAdsControl = <?php echo filter_var($classAds, FILTER_VALIDATE_BOOLEAN) ? "true" : "false"; ?>;
let displayOnce = 0;
const reqServers = [<?php echo $this->request_servers(); ?>];


/**
 * Hide on click
 */
const brandingBtn = document.getElementById("<?php echo $this->rclass("chp_branding"); ?>");
if(brandingBtn){
    brandingBtn.addEventListener("click", function(event){
        event.preventDefault();
        window.location.href = "https://chpadblock.com/pricing/";
        return false;
    });
}
const adblockCloseBtn = document.getElementById("<?php echo $this->rclass("close_btn_adblock"); ?>");
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
let serverReqCount = 0;
let adreqfound = false;
function adsBlocked(callBackFunc) {

    if( adreqfound ) return true;
    if( serverReqCount >= reqServers.length ){
        callBackFunc(adreqfound);
        return true;
    }

    if( reqServers.length > 0 && is_connected() ){
        const reqURL = reqServers[serverReqCount];
        const adsRequest = new Request(reqURL, {
            method: "HEAD",
            mode: "no-cors"
        });

        fetch(adsRequest).then(function(res) {
            if (debug) {
                console.warn(`[ADB DEBUG] Ads Request [${reqURL}] Passed!!!`);
            }
            serverReqCount++;
            adreqfound = false;
            adsBlocked(callBackFunc);
        }).catch(function(res) {
            if (debug) {
                console.error(`[ADB DEBUG] Ads Request [${reqURL}] Failed!!!`);
                console.error(`[ADB DEBUG] ${res}`)
            }
            callBackFunc(true);
            adreqfound = true;
        })
    } else {
        if (debug) {
            console.warn("[ADB DEBUG] Ads Request Failed. Reason: Blocked by Filter Hook or Offline!!!");
        }
    }
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
            removeClass(adblockModal, "<?php echo $this->rclass("show"); ?>");
            removeClass(document.body, "<?php echo $this->rclass("active"); ?>")
        }
    }catch(e){
        console.warn(e);
    }
}

function show_modal(modal) {
    if (modal != null && 0 == displayOnce) {
        displayOnce++;
        addClass(modal, "<?php echo $this->rclass("show"); ?>");
        addClass(document.body, "<?php echo $this->rclass("active"); ?>")
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
        divEle.className = "ad ads doubleclick ad-placement ad-placeholder adbadge BannerAd adsbox ad-large ad-large ad-left ad-limits ad-link ad-live ad-loading ad-map ad-marker ad-master ad-pixel ad-random ad-refresh ad-300x250";
        divEle.id = "<?php echo $this->rclass("filter_ads_by_classname"); ?>";

        try {
            if (!document.body.contains(document.getElementById('<?php echo $this->rclass("filter_ads_by_classname"); ?>'))) {
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
                let adBoxEleId = document.getElementById("<?php echo $this->rclass("filter_ads_by_classname"); ?>");
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
    try{
        return "none" === window.getComputedStyle(e).display;
    }catch(error){
        
    }
    return false;
}

function init() {
    adsBlocked(function(enable) {
        if (enable) {
            chp_ads_blocker_detector(true);
        } else {
            if (imageAdsControl) {
                enable = isHidden(document.getElementById("<?php echo $this->rclass("chp-ads-image"); ?>"));
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
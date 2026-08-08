const <?php echo $this->rclass("adblockModal"); ?> = document.getElementById("<?php echo $this->rclass("modal"); ?>");
const adbEnableForPage = true;
const adbdebug = <?php echo $debug ? 'true' : 'false'; ?>;
const adbVersion = "<?php echo CHP_ADSB_VERSION; ?>";
let onPageLoad = <?php echo filter_var($onPageFullyLoaded, FILTER_VALIDATE_BOOLEAN) ? "true" : "false"; ?>;
let displayOnce = 0;

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
        <?php echo $this->rclass("hide_model"); ?>();
    }
}

/**
 * Check internet connection
 */
function <?php echo $this->rclass("is_connected"); ?>() {
    try {
        return window.navigator.onLine;
    } catch (error) {
        return true;
    }
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
function <?php echo $this->rclass("hide_model"); ?>() {
    try{
        if (<?php echo $this->rclass("adblockModal"); ?>) {
            removeClass(<?php echo $this->rclass("adblockModal"); ?>, "<?php echo $this->rclass("show"); ?>");
            removeClass(document.body, "<?php echo $this->rclass("active"); ?>")
        }
    }catch(e){

    }
}

function <?php echo $this->rclass("show_modal"); ?>() {
    const modal = <?php echo $this->rclass("adblockModal"); ?>;
    if (modal != null && 0 == displayOnce) {
        displayOnce++;
        addClass(modal, "<?php echo $this->rclass("show"); ?>");
        addClass(document.body, "<?php echo $this->rclass("active"); ?>")
    }
}

function chp_ads_blocker_detector(enable) {
    if (enable) {
        <?php echo $this->rclass("show_modal"); ?>();
    }
}

function fairAdblock() {
    let stndzStyle = document.getElementById('stndz-style');
    return null !== stndzStyle;
}

/**
* Check by adding servers
* */
function adsBlocked( callback ){
    let head = document.getElementsByTagName('head')[0];
    let script = document.createElement('script');
    let done = false;

    if( ! <?php echo $this->rclass('is_connected'); ?>() ){
        callback(false);
        return false;
    }
    
    const reqURL = "https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js";
    script.setAttribute( "src", reqURL );
    script.setAttribute( "type", "text/javascript" );
    script.setAttribute( "charset", "utf-8" );

    script.onload = script.onreadstatechange = function() {
        if ( ! done && ( ! this.readyState || this.readyState === 'loaded' || this.readyState === 'complete') ) {
            done = true;
            script.onload = script.onreadystatechange = null;
                    
            if ( 'undefined' === typeof window.adsbygoogle ) {
                callback( true, 2 );
            } else {
                callback( false );
            }

            script.parentNode.removeChild( script );
        }
    };

    /** On Error. */
    script.onerror = function() {
        callback( true, 2 );
    };
            
    /** Async */
    let callbacked = false;            
    const request = new XMLHttpRequest();  
    request.open( 'GET', reqURL, true );            
    request.onreadystatechange = function(){
        if (this.status === 0 || (this.status >= 200 && this.status < 400)) {
            if(
                this.responseText.toLowerCase().indexOf("ublock") > -1
                || this.responseText.toLowerCase().indexOf("height:1px") > -1
            ){
                if( callbacked ){
                    callback(true, 2);
                }
                callbacked = true;
            }
        }

        if ( ! callbacked ) {
            callback( request.responseURL !== reqURL, request.readyState );
            callbacked = true;
        }        
    };         
    
    request.send();
    head.insertBefore( script, head.firstChild );
}

let prevCount = 0;
function checkMultiple(callback) {
    let enable = false;
    try{
        let divEle = document.createElement("div");
        divEle.className = "adsbygoogle Ad-Container sidebar-ad ad-slot ad ads doubleclick ad-placement ad-placeholder adbadge BannerAd adsbox";
        divEle.style = "width: 1px !important; height: 1px !important; position: absolute !important; left: -10000px !important; top: -1000px !important;";
        divEle.setAttribute("data-ad-manager-id", "1");
        divEle.setAttribute("data-ad-module", "1");
        divEle.setAttribute("data-ad-width", "100");
        divEle.setAttribute("data-adblockkey", "200");
        divEle.setAttribute("data-advadstrackid", "1");
        divEle.id = "<?php echo $this->rclass('filter_ads_by_classname'); ?>";
        divEle.innerHTML = '<div style="z-index:-1; height:0; width:1px; visibility: hidden; bottom: -1px; left: 0;"></div>';

        try {
            if (!document.body.contains(document.getElementById('<?php echo $this->rclass('filter_ads_by_classname'); ?>'))) {
                document.body.appendChild(divEle);
                const adBoxEle = document.querySelector(".Ad-Container");
                enable = !adBoxEle || adBoxEle.offsetHeight == 0;
            } else {
                let adBoxEleId = document.getElementById("<?php echo $this->rclass('filter_ads_by_classname'); ?>");
                <?php echo $this->rclass("removeClass"); ?>(adBoxEleId, 'ads_' + prevCount);
                <?php echo $this->rclass("removeClass"); ?>(adBoxEleId, 'ads_' + prevCount);
                prevCount++;
                <?php echo $this->rclass("addClass"); ?>(adBoxEleId, 'ads_' + prevCount);
            }
        } catch (error) {
            divEle?.parentNode?.removeChild(divEle);
        }
    }catch(e){
        
    }
    return callback(enable);
}

function init() {
    if( fairAdblock() ){
        chp_ads_blocker_detector(true);
    }else{
        adsBlocked(function(blocked){
            if ( blocked ) {
                chp_ads_blocker_detector(true);
            }else{
                checkMultiple(function(classenable){
                    chp_ads_blocker_detector(classenable);
                });
            }
        });
    }
}

if (adbEnableForPage) {
    if (onPageLoad) {
        document.addEventListener("DOMContentLoaded", function(e) {
            init();
        }, false);
    } else {
        init();
    }
}
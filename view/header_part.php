<style>
.chp_ads_blocker_detector-show<?php echo $this->randnum; ?> {
    -webkit-animation: bounceIn .35s ease;
    -o-animation: bounceIn .35s ease;
    animation: bounceIn .35s ease;
}

.chp_ads_blocker_detector-hide {
    -webkit-animation: bounceOut .35s ease;
    -o-animation: bounceOut .35s ease;
    animation: bounceOut .35s ease;
}

.chp_ads_blocker_detector-message {
    margin: 0;
    padding: 0;
    color: #000;
    font-size: 13px;
    line-height: 1.5;
}

.chp_ads_blocker_detector-action {
    padding: 8px;
    text-align: right;
}

.chp_ads_blocker_detector-action-btn-ok,
.chp_ads_blocker_detector-action-btn-close<?php echo $this->randnum; ?> {
    cursor: pointer;
    text-align: center;
    outline: none !important;
    display: inline-block;
    -webkit-tap-highlight-color: rgba(0, 0, 0, 0.12);
    -webkit-transition: all 0.45s cubic-bezier(0.23, 1, 0.32, 1);
    -o-transition: all 0.45s cubic-bezier(0.23, 1, 0.32, 1);
    transition: all 0.45s cubic-bezier(0.23, 1, 0.32, 1);
}

.chp_ads_blocker_detector-action-btn-ok {
    color: #000;
    width: 100%;
}

.chp_ads_blocker_detector-action-btn-close {
    color: #1e8cbe;
}

.chp_ads_blocker_detector-icon.svg {
    padding-top: 1rem;
}

img.chp_ads_blocker_detector-icon {
    width: 100px;
    padding: 1rem;
}

.chp_ads_blocker_detector {
    padding: 5px;
}

.chp_ads_blocker_detector-footer {
    padding: 10px;
    padding-top: 0;
}

.chp_ads_blocker_detector-footer a {
    font-size: 14px;
}

.theme2_close_btn,
.theme2_close_btn:active,
.theme2_close_btn:focus {
    background: #fff;
    border-radius: 50%;
    height: 35px;
    width: 35px;
    padding: 7px;
    position: absolute;
    right: -12px;
    top: -12px;
    cursor: pointer;
    outline: none;
    border: none;
    box-shadow: none;
    display: flex;
    justify-content: center;
    align-items: center;
}

.chp_ads_blocker_wrapper {
    padding-top: 10px;
    margin-bottom: 10px;
    display: flex;
    justify-content: center;
}

.fadeInDown {
    -webkit-animation-name: fadeInDown;
    animation-name: fadeInDown;
}

@keyframes fadeInDown {
    0% {
        opacity: 0;
        transform: translateY(-20px);
    }

    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

.chp_ads_block_pro<?php echo $this->randnum; ?>:not(.chp_ads_blocker_detector-show<?php echo $this->randnum; ?>),
.chp_ads_block_modal<?php echo $this->randnum; ?>:not(.chp_ads_blocker_detector-show<?php echo $this->randnum; ?>) {
    display: none;
}

.chp_ads_block_modal .chp_ads_block_modal_content .chp_ads_block_image_wrapper {
    padding-top: 1rem;
    padding-bottom: 0;
}

.chp_ads_block_modal .chp_ads_block_modal_content .adblock_title,
.chpadbpro_wrap_title {
    margin: 1.3rem 0;
}

.chp_ads_block_modal .chp_ads_block_modal_content .adblock_subtitle {
    padding: 0 1rem;
    padding-bottom: 1rem;
}

.chp_ads_block_pro_buttons {
    width: 100%;
    align-items: center;
    display: flex;
    justify-content: space-around;
    border-top: 1px solid #d6d6d6;
    border-bottom: 1px solid #d6d6d6;
}

.chp_ads_block_pro_buttons_row+.chp_ads_block_pro_buttons_row {
    border-left: 1px solid #d6d6d6;
}

.chp_ads_block_pro_buttons .chp_ads_block_pro_buttons_row {
    flex: 1 1 auto;
    padding: 1rem;
}

.chp_ads_block_pro_buttons_row p {
    margin: 0;
    font-size: 16px;
    font-weight: bold;
    text-transform: uppercase;
    margin-bottom: 0.3rem;
}

.chp_ads_block_pro_buttons_row button,
.chp_ads_block_pro_buttons_row a {
    background: #fff;
    border: 1px solid #fff;
    color: #000;
    text-transform: uppercase;
    font-weight: bold;
    cursor: pointer;
    text-decoration: none;
}

.chp_ads_block_pro_footer {
    display: flex;
    justify-content: space-between;
    padding: 1rem;
}

.chp_ads_block_pro_footer a,
.chp_ads_block_pro_footer a:focus {
    text-decoration: none;
    color: #000;
    font-size: 12px;
    font-weight: bold;
    border: none;
    outline: none;
}

body .ofs-admin-doc-box .chp_ad_block_pro_admin_preview #chp_ads_blocker-modal {
    display: block !important;
}

body .ofs-admin-doc-box .chp_ad_block_pro_admin_preview #chp_ads_blocker-modal {
    position: inherit;
    width: <?php echo $settings->width + 30;
    ?>%;
    left: 0;
    box-shadow: none;
    border: 3px solid #ddd;
}

#chp_adb_instruction_close_btn {
    border: none;
    position: absolute;
    top: -3.5%;
    right: -1.5%;
    background: #fff;
    border-radius: 100%;
    height: 45px;
    outline: none;
    border: none;
    width: 45px;
    box-shadow: 0px 6px 18px -5px #fff;
    z-index: 9990099;
    display: flex;
    justify-content: center;
    align-items: center;
    text-decoration: none;
}

#chp_adb_instruction_close_btn svg {
    margin: 0 -1rem;
}


body #chp_ads_blocker-modal.active {
    width: 60%;
    left: 20%;
    top: 10%;
    height: 80vh;
}

@media only screen and (max-width:800px) {
    body #chp_ads_blocker-modal.active {
        width: 80%;
        left: 10%;
        top: 5%;
        height: 99vh;
    }
}

@media only screen and (max-width:550px) {
    body #chp_ads_blocker-modal.active {
        width: 100%;
        left: 0%;
        top: 0%;
        height: 99vh;
    }

    #chp_adb_instruction_close_btn {
        top: 2%;
        right: 2%;
    }
}

.howToBlock_color {
    color: #fff !important;
}

.adblock_btn,
.adblock_btn_secondary {
    border: none;
    border-radius: 5px;
    padding: 9px 20px !important;
    font-size: 12px;
    color: white !important;
    margin-top: 0.5rem;
    transition: 0.3s;
    border: 2px solid;
}

.adblock_btn:hover,
.adblock_btn_secondary:hover {
    background: none;
    box-shadow: none;
}

.adblock_btn:hover {
    color: #fff !important;
}

.adblock_btn_secondary:hover {
    color: #888 !important;
}

.adblock_btn {
    background-color: #fff;
    box-shadow: 0px 6px 18px -5px #fff;
    border-color: #fff;
}

.adblock_btn_secondary {
    background-color: #8a8a8a;
    box-shadow: 0px 6px 18px -5px #8a8a8a;
    border-color: #8a8a8a;
}


body .chp_ads_block_modal<?php echo $this->randnum; ?> {
    position: fixed;
    z-index: 9999999999;
    padding-top: <?php echo $settings->top;
    ?>%;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: #000;
    background-color: rgba(0, 0, 0, 0.6);
}

.chp_ads_block_modal<?php echo $this->randnum; ?> .chp_ads_blocker_detector-show<?php echo $this->randnum; ?> {
    display: block;
}


.chp_ads_block_modal<?php echo $this->randnum; ?> .chp_ads_block_modal_content {
    background-color: #fff;
    margin: auto;
    padding: 20px;
    border: 1px solid <?php echo $settings->back_color;
    ?>;
    width: <?php echo $settings->width;
    ?>%;
    border-radius: 5%;
    position: relative;
}

.chp_ads_block_detector_theme.theme3 {
    text-align: center;
}

.chp_ads_block_detector_theme * {
    color: #000;
    text-align: center;
}

.chp_ads_block_detector_theme.theme2 a {
    text-decoration: none;
}

.chp_ads_block_detector_theme.theme2 a:first-child {
    margin-bottom: 0.5rem !important;
}

.adblock_new_icon .image-container {
    width: 100px;
    text-align: center;
    margin-bottom: -20px;
}

.adblock_new_icon .image-container .image {
    position: relative;
}

.adblock_new_icon .image-container .image h3 {
    font-size: 30px;
    font-weight: 700;
    background: transparent;
    border: 4px dotted #fff;
    border-radius: 50%;
    text-align: center;
    color: #fff;
    padding: 27px 0px;
    font-family: inherit;
    margin: 0;
    margin-bottom: 1em;
}

.adblock_new_icon .image-container .image i.exclametry_icon {
    position: absolute;
    right: 0;
    top: 8%;
    background: #fff;
    width: 20px;
    height: 20px;
    border-radius: 100%;
    font-size: 15px;
    display: flex;
    justify-content: center;
    align-items: center;
    color: #fff;
    font-style: inherit;
    font-weight: bold;
}

@media only screen and (max-width:1000px) {
    .chp_ads_block_modal .chp_ads_block_modal_content {
        width: calc(<?php echo $settings->width; ?>% + 15%);
    }
}

@media only screen and (max-width:800px) {
    .chp_ads_block_modal .chp_ads_block_modal_content {
        width: calc(<?php echo $settings->width; ?>% + 25%);
    }
}

@media only screen and (max-width:700px) {
    .chp_ads_block_modal .chp_ads_block_modal_content {
        width: calc(<?php echo $settings->width; ?>% + 35%);
    }
}

@media only screen and (max-width:500px) {
    .chp_ads_block_modal .chp_ads_block_modal_content {
        width: 95%;
    }
}

#chp_adb_instruction_close_btn {
    color: #fff !important;
}

.chp_branding<?php echo $this->randnum; ?> {
    display: inline-block;
    height: 40px;
    padding: 10px 20px;
    text-align: center;
    background-color: white;
    border-radius: 20px;
    box-sizing: border-box;
    position: fixed;
    bottom: 2%;
    z-index: 9999999;
    right: 2%;
}

.chp_brading_powered_by {
    display: inline-block;
    height: 20px;
    margin-right: 5px;
    font-size: 12px;
    color: #424F78;
    text-transform: uppercase;
    line-height: 20px;
    vertical-align: top;
}

.chp_brading_svg {
    display: inline-block;
    height: 20px;
    vertical-align: top;
}

.chp_brading_svg img {
    display: block;
    height: 100%;
    width: auto;
}

.chp_branding<?php echo $this->randnum; ?>.hide {
    display: none !important
}
</style>
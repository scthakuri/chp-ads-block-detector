<style>
.<?php echo esc_attr($this->rclass("message")); ?>{
    margin: 0;
    padding: 0;
    color: #000;
    font-size: 13px;
    line-height: 1.5;
}

.<?php echo esc_attr($this->rclass("action")); ?>{
    padding: 8px;
    text-align: right;
}


.<?php echo esc_attr($this->rclass("action-button-ok")); ?>,
.<?php echo esc_attr($this->rclass("action-button-close")); ?>{
    cursor: pointer;
    text-align: center;
    outline: none !important;
    display: inline-block;
    -webkit-tap-highlight-color: rgba(0, 0, 0, 0.12);
    -webkit-transition: all 0.45s cubic-bezier(0.23, 1, 0.32, 1);
    -o-transition: all 0.45s cubic-bezier(0.23, 1, 0.32, 1);
    transition: all 0.45s cubic-bezier(0.23, 1, 0.32, 1);
}

.<?php echo esc_attr($this->rclass("action-button-ok")); ?>{
    color: #000;
    width: 100%;
}


.<?php echo esc_attr($this->rclass("action-button-close")); ?>{
    color: #1e8cbe;
}


.<?php echo esc_attr($this->rclass("icon")); ?>.svg{
    padding-top: 1rem;
}


img.<?php echo esc_attr($this->rclass("icon")); ?>{
    width: 100px;
    padding: 0;
    margin-bottom:10px;
}


.<?php echo $this->rclass(""); ?>{
    padding: 5px;
}


.<?php echo esc_attr($this->rclass("footer")); ?>{
    padding: 10px;
    padding-top: 0;
}


.<?php echo esc_attr($this->rclass("footer")); ?> a{
    font-size: 14px;
}


.<?php echo esc_attr($this->rclass("theme2_close_btn")); ?>,
.<?php echo esc_attr($this->rclass("theme2_close_btn")); ?>:active,
.<?php echo esc_attr($this->rclass("theme2_close_btn")); ?>:focus{
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


.<?php echo esc_attr($this->rclass("wrapper")); ?>{
    padding-top: 10px;
    margin-bottom: 10px;
    display: flex;
    justify-content: center;
}

.<?php echo esc_attr($this->rclass("fadeInDown")); ?>{
    -webkit-animation-name: fadeInDown;
    animation-name: fadeInDown;
    -webkit-animation-duration: 0.3s;
    animation-duration: 0.3s;
    -webkit-animation-fill-mode: both;
    animation-fill-mode: both;
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


.<?php echo esc_attr($this->rclass("pro")); ?>:not(.<?php echo esc_attr($this->rclass("show")); ?>),
.<?php echo esc_attr($this->rclass("modal")); ?>:not(.<?php echo esc_attr($this->rclass("show")); ?>){
    display: none;
}


.<?php echo esc_attr($this->rclass("modal")); ?> .<?php echo esc_attr($this->rclass("content")); ?> .<?php echo esc_attr($this->rclass("image_wrapper")); ?>{
    padding-top: 1rem;
    padding-bottom: 0;
}


.<?php echo esc_attr($this->rclass("modal")); ?> .<?php echo esc_attr($this->rclass("content")); ?> .adblock_title,
.chpadbpro_wrap_title {
    margin: 1.3rem 0;
}


.<?php echo esc_attr($this->rclass("modal")); ?> .<?php echo esc_attr($this->rclass("content")); ?> .adblock_subtitle{
    padding: 0 1rem;
    padding-bottom: 1rem;
}


.<?php echo esc_attr($this->rclass("pro_buttons")); ?>{
    width: 100%;
    align-items: center;
    display: flex;
    justify-content: space-around;
    border-top: 1px solid #d6d6d6;
    border-bottom: 1px solid #d6d6d6;
}


.<?php echo esc_attr($this->rclass("pro_buttons_row")); ?>+.<?php echo esc_attr($this->rclass("pro_buttons_row")); ?>{
    border-left: 1px solid #d6d6d6;
}


.<?php echo esc_attr($this->rclass("pro_buttons")); ?> .<?php echo esc_attr($this->rclass("pro_buttons_row")); ?>{
    flex: 1 1 auto;
    padding: 1rem;
}


.<?php echo esc_attr($this->rclass("pro_buttons_row")); ?> p{
    margin: 0;
    font-size: 16px;
    font-weight: bold;
    text-transform: uppercase;
    margin-bottom: 0.3rem;
}


.<?php echo esc_attr($this->rclass("pro_buttons")); ?> button,
.<?php echo esc_attr($this->rclass("pro_buttons")); ?> a{
    background: #fff;
    border: 1px solid #fff;
    color: #000;
    text-transform: uppercase;
    font-weight: bold;
    cursor: pointer;
    text-decoration: none;
}


.<?php echo esc_attr($this->rclass("pro_footer")); ?>{
    display: flex;
    justify-content: space-between;
    padding: 1rem;
}


.<?php echo esc_attr($this->rclass("pro_footer")); ?> a,
.<?php echo esc_attr($this->rclass("pro_footer")); ?> a:focus{
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
    width: <?php echo @$this->settings->width + 30;
    ?>%;
    left: 0;
    box-shadow: none;
    border: 3px solid #ddd;
}

#<?php echo esc_attr($this->rclass("instruction_close_btn")) ?>{
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


#<?php echo esc_attr($this->rclass("instruction_close_btn")) ?> svg{
    margin: 0 -1rem;
}


body #<?php echo esc_attr($this->rclass("modal")); ?>.active{
    width: 60%;
    left: 20%;
    top: 10%;
    height: 80vh;
}

@media only screen and (max-width:800px) {
    body #<?php echo esc_attr($this->rclass("modal")); ?>.active{
        width: 80%;
        left: 10%;
        top: 5%;
        height: 99vh;
    }
}

@media only screen and (max-width:550px) {
    body #<?php echo esc_attr($this->rclass("modal")); ?>.active{
        width: 100%;
        left: 0%;
        top: 0%;
        height: 99vh;
    }

    #<?php echo esc_attr($this->rclass("instruction_close_btn")) ?>{
        top: 2%;
        right: 2%;
    }
}

.howToBlock_color {
    color: #fff !important;
}

.<?php echo esc_attr($this->rclass("adblock_btn")); ?>,
.<?php echo esc_attr($this->rclass("adblock_btn_secondary")); ?>{
    border: none;
    border-radius: 5px;
    padding: 9px 20px !important;
    font-size: 12px;
    color: white !important;
    margin-top: 0.5rem;
    transition: 0.3s;
    border: 2px solid;
}

.<?php echo esc_attr($this->rclass("adblock_btn")); ?>:hover,
.<?php echo esc_attr($this->rclass("adblock_btn_secondary")); ?>:hover{
    background: none;
    box-shadow: none;
}

.<?php echo esc_attr($this->rclass("adblock_btn")); ?>:hover{
    color: #fff !important;
}

.<?php echo esc_attr($this->rclass("adblock_btn_secondary")); ?>:hover{
    color: #888 !important;
}

.<?php echo esc_attr($this->rclass("adblock_btn")); ?>{
    background-color: #fff;
    box-shadow: 0px 6px 18px -5px #fff;
    border-color: #fff;
}


.<?php echo esc_attr($this->rclass("adblock_btn_secondary")); ?>{
    background-color: #8a8a8a;
    box-shadow: 0px 6px 18px -5px #8a8a8a;
    border-color: #8a8a8a;
}


body .<?php echo esc_attr($this->rclass("modal")); ?>{
    position: fixed;
    z-index: 9999999999;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: #000;
    background-color: rgba(0, 0, 0, 0.7);
    display: flex;
    justify-content: center;
    align-items: center;
}

.<?php echo esc_attr($this->rclass("modal")); ?> .<?php echo esc_attr($this->rclass("show")); ?>{
    display: block;
}

.<?php echo esc_attr($this->rclass("modal")); ?> .<?php echo esc_attr($this->rclass("content")); ?>{
    background-color: #fff;
    margin: auto;
    padding: 20px;
    border: none;
    width: <?php echo @$this->settings->width; ?>%;
    border-radius: 5%;
    position: relative;
}

.<?php echo esc_attr($this->rclass("theme")); ?>.theme3{
    text-align: center;
}


.<?php echo esc_attr($this->rclass("theme")); ?> *{
    color: #000;
    text-align: center;
    text-decoration: none;
}

.<?php echo esc_attr($this->rclass("theme")); ?> a{
    cursor: pointer;
}

.<?php echo esc_attr($this->rclass("theme")); ?> a:first-child{
    margin-right:1rem;
}

.<?php echo esc_attr($this->rclass("theme")); ?> a{
    text-decoration: none;
}


.<?php echo esc_attr($this->rclass("theme")); ?>.theme2 a:first-child{
    margin-bottom: 0.5rem !important;
}


.<?php echo esc_attr($this->rclass("adblock_new_icon")); ?> .image-container{
    width: 100px;
    text-align: center;
    margin-bottom: -20px;
}

.<?php echo esc_attr($this->rclass("adblock_new_icon")); ?> .image-container .image{
    position: relative;
}


.<?php echo esc_attr($this->rclass("adblock_new_icon")); ?> .image-container .image h3{
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

.<?php echo esc_attr($this->rclass("adblock_new_icon")); ?> .image-container .image i.exclametry_icon{
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
    .<?php echo esc_attr($this->rclass("modal")); ?> .<?php echo esc_attr($this->rclass("content")); ?>{
        width: calc(<?php echo @$this->settings->width; ?>% + 15%);
    }
}

@media only screen and (max-width:800px) {
    .<?php echo esc_attr($this->rclass("modal")); ?> .<?php echo esc_attr($this->rclass("content")); ?>{
        width: calc(<?php echo @$this->settings->width; ?>% + 25%);
    }
}

@media only screen and (max-width:700px) {
    .<?php echo esc_attr($this->rclass("modal")); ?> .<?php echo esc_attr($this->rclass("content")); ?>{
        width: calc(<?php echo @$this->settings->width; ?>% + 35%);
    }
}

@media only screen and (max-width:500px) {
    .<?php echo esc_attr($this->rclass("modal")); ?> .<?php echo esc_attr($this->rclass("content")); ?>{
        width: 95%;
    }
}

#<?php echo esc_attr($this->rclass("instruction_close_btn")); ?>{
    color: #fff !important;
}

#<?php echo esc_attr($this->rclass("filter_ads_by_classname")); ?>{
    position:absolute;
    z-index:-20;
    bottom:0;
}

.<?php echo $this->rclass("chp_branding"); ?>{
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

.<?php echo $this->rclass("powered_by"); ?>,
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


.<?php echo $this->rclass("chp_brading_svg"); ?>{
    display: inline-block;
    height: 20px;
    vertical-align: top;
}

.<?php echo $this->rclass("chp_brading_svg"); ?> img{
    display: block;
    height: 100%;
    width: auto;
}

.<?php echo $this->rclass("chp_branding"); ?>.hide {
    display: none !important
}
</style>
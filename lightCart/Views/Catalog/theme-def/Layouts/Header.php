<!DOCTYPE html>
<html lang="ru-RU" dir="ltr">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <meta name="format-detection" content="telephone=no">
    <meta name="PalmComputingPlatform" content="true">
    <meta name="apple-touch-fullscreen" content="yes">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <meta charset="UTF-8">
    <title><?php echo $dataPage['text_header_title']; ?></title>
    <meta name="robots" content="max-image-preview:large">
    <link rel="dns-prefetch" href="//fonts.googleapis.com">
    <link rel="dns-prefetch" href="//s.w.org">
    <link rel="stylesheet" id="nunito-sans-css" href="https://fonts.googleapis.com/css?family=Nunito%3A300%2C300i%2C400%2C400i%2C600%2C600i%2C700%2C700i&amp;display=swap&amp;subset=cyrillic%2Ccyrillic-ext%2Clatin-ext&amp;ver=2.2" type="text/css" media="all">
    <link rel="stylesheet" id="theme-style-distr" href="<?php echo $dataPage['url_assets']; ?>css/dist/block-library/style.min.css" type="text/css" media="all">
    <link rel="stylesheet" id="theme-style-css" href="<?php echo $dataPage['url_assets']; ?>css/style.css?ver=1664983429" type="text/css" media="all">
    <script type="text/javascript" src="<?php echo $dataPage['url_assets']; ?>js/jquery/script.min.js?ver=3.5.1" id="jquery-js"></script>
    <script type="text/javascript" src="<?php echo $dataPage['url_assets']; ?>js/jquery/jquery-ui/script.min.js?ver=1.12.1" id="jquery-ui-js"></script>
    <script type="text/javascript" src="<?php echo $dataPage['url_assets']; ?>js/jquery/jquery-forms/script.min.js?ver=3.51" id="jquery-forms-js"></script>
    <script type="text/javascript" src="<?php echo $dataPage['url_assets']; ?>js/jquery/jquery-cook/script.min.js?ver=3.0.0" id="jquery-cookie-js"></script>
    <script type="text/javascript" src="<?php echo $dataPage['url_assets']; ?>js/jquery/jquery-clipboard/script.min.js?ver=2.0.6" id="jquery-clipboard-js"></script>
    <script type="text/javascript" src="<?php echo $dataPage['url_assets']; ?>js/jquery/jquery-window/script.min.js?ver=0.5" id="jquery-window-js"></script>
    <script type="text/javascript" src="<?php echo $dataPage['url_assets']; ?>js/jquery/jquery-changeinput/script.min.js?ver=0.1" id="jquery-changeinput-js"></script>
    <script type="text/javascript" src="<?php echo $dataPage['url_assets']; ?>js/jquery/jquery-select.js?ver=0.6" id="jquery select-js"></script>
    <script type="text/javascript" src="<?php echo $dataPage['url_assets']; ?>js/jquery/jquery-table/script.min.js?ver=0.2" id="jquery-table-js"></script>
    <script type="text/javascript" src="<?php echo $dataPage['url_assets']; ?>js/jquery/jquery-checkbox/script.min.js?ver=0.2" id="jquery-checkbox-js"></script>
    <script type="text/javascript" src="<?php echo $dataPage['url_assets']; ?>js/site.js?ver=1664983429" id="jquery-site-js-js"></script>
    <script type="text/javascript" src="<?php echo $dataPage['url_assets']; ?>js/jquery/jquery-timer/script.min.js?ver=0.2" id="jquery js timer-js"></script>
    <script type="text/javascript" src="<?php echo $dataPage['url_assets']; ?>js/jquery/jquery-qrcode/script.min.js?ver=1664983429" id="jquery js qr-js"></script>
    <script type="text/javascript" src="<?php echo $dataPage['url_assets']; ?>js/premium_script.js?lang=ru&amp;ver=1664994229" id="jquery-premium-js-js"></script>
    <link rel="canonical" href="<?php echo $dataPage['url']; ?>">
    <meta name="keywords" content="">
    <meta name="description" content="<?php echo $dataPage['text_meta_description']; ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo $dataPage['url']; ?>">
    <meta property="og:site_name" content="<?php echo $dataPage['og_site_name']; ?>">
    <meta property="og:description" content="<?php echo $dataPage['og_meta_description']; ?>">
    <meta property="og:title" content="<?php echo $dataPage['og_meta_title']; ?>">
    <meta name="yandex-verification" content="<?php echo $dataPage['yandex_verification']; ?>">
    <meta name="google-site-verification" content="<?php echo $dataPage['google_site_verification']; ?>">
    <link rel="shortcut icon" href="<?php echo $dataPage['favicon']; ?>" type="">
    <link rel="icon" href="<?php echo $dataPage['favicon']; ?>" type="">
</head>

<body class="home page-template page-template-pn-homepage page-template-pn-homepage-php page page-id-4 ">
    <div id="container">
        <div class="container">
            <div class="only_mobile">
                <div class="mobile_menu_abs"></div>
                <div class="mobile_menu">
                    <div class="mobile_menu_title"><?php echo $dataPage['text_label_menu'];?></div>
                    <div class="mobile_menu_close"></div>
                    <div class="mobile_menu_ins">
                        <div class="clear"></div>
                    </div>
                </div>
            </div>

            <div class="tophead_wrap" id="fix_div">
                <div class="tophead_ins" id="fix_elem" style="position: absolute; top: 0px;">
                    <div class="tophead ccenter flex vcenter">
                        <div class="logoblock">
                            <div class="logoblock_ins">
                                <a href="<?php echo $dataPage['url']; ?>">
                                    <img src="<?php echo $dataPage['logo']; ?>" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="topmenu js_menu only_web">
                            <?php if (!empty($dataPage['header_menu'])) { ?>
                                <ul id="menu-verhnee-menyu-top-menu" class="hmenu">
                                    <?php foreach ($dataPage['header_menu'] as $key => $menu) { ?>
                                        <li id="menu-item" class="menu-item menu-item-type-post_type menu-item-object-page"><a href="<?php echo $menu['href'];?>"><span><?php echo $menu['name'];?></span></a></li>
                                    <?php }; ?>
                                </ul>
                            <?php }; ?>
                            <div class="clear"></div>
                        </div>
                        <div class="right_links flex">
                            <a href="<?php echo $dataPage['href_login'];?>" class="toplink toplink_signin js_window_login">
                                <span><?php echo $dataPage['text_login_header'];?></span>
                            </a>
                            <a href="<?php echo $dataPage['href_register'];?>" class="toplink toplink_signup js_window_join">
                                <span><?php echo $dataPage['text_register_header'];?></span>
                            </a>
                            <div class="topmenu_ico only_mobile">
                                <span></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
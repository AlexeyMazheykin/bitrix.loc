<? if (!defined ( "B_PROLOG_INCLUDED" ) || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Page\Asset;


Asset::getInstance ()->addCss ( SITE_TEMPLATE_PATH . '/css/bootstrap.min.css' );
Asset::getInstance ()->addCss ( SITE_TEMPLATE_PATH . '/css/owl.carousel.css' );
Asset::getInstance ()->addCss ( SITE_TEMPLATE_PATH . '/css/animate-text.css' );
Asset::getInstance ()->addCss ( SITE_TEMPLATE_PATH . '/css/magnific-popup.css' );
Asset::getInstance ()->addCss ( SITE_TEMPLATE_PATH . '/css/et-line.css' );
Asset::getInstance ()->addCss ( SITE_TEMPLATE_PATH . '/css/pe-icon-7-stroke.css' );
Asset::getInstance ()->addCss ( SITE_TEMPLATE_PATH . '/css/shortcode/shortcodes.css' );
Asset::getInstance ()->addCss ( SITE_TEMPLATE_PATH . '/css/meanmenu.min.css' );
Asset::getInstance ()->addCss ( SITE_TEMPLATE_PATH . '/css/style.css' );
Asset::getInstance ()->addCss ( SITE_TEMPLATE_PATH . '/css/responsive.css' );
Asset::getInstance ()->addJs ( SITE_TEMPLATE_PATH . '/js/vendor/modernizr-2.8.3.min.js' );
Asset::getInstance ()->addJs ( SITE_TEMPLATE_PATH . '/js/vendor/jquery-1.12.0.min.js' );
Asset::getInstance ()->addJs ( SITE_TEMPLATE_PATH . '/js/bootstrap.min.js' );
Asset::getInstance ()->addJs ( SITE_TEMPLATE_PATH . '/js/owl.carousel.min.js' );
Asset::getInstance ()->addJs ( SITE_TEMPLATE_PATH . '/js/jquery.counterup.min.js' );
Asset::getInstance ()->addJs ( SITE_TEMPLATE_PATH . '/js/waypoints.min.js' );
Asset::getInstance ()->addJs ( SITE_TEMPLATE_PATH . '/js/jquery.magnific-popup.min.js' );
Asset::getInstance ()->addJs ( SITE_TEMPLATE_PATH . '/js/jquery.mixitup.min.js' );
Asset::getInstance ()->addJs ( SITE_TEMPLATE_PATH . '/js/jquery.meanmenu.js' );
Asset::getInstance ()->addJs ( SITE_TEMPLATE_PATH . '/js/jquery.nav.js' );
Asset::getInstance ()->addJs ( SITE_TEMPLATE_PATH . '/js/jquery.parallax-1.1.3.js' );
Asset::getInstance ()->addJs ( SITE_TEMPLATE_PATH . '/js/animate-text.js' );
Asset::getInstance ()->addJs ( SITE_TEMPLATE_PATH . '/js/plugins.js' );
Asset::getInstance ()->addJs ( SITE_TEMPLATE_PATH . '/js/main.js' );


Asset::getInstance ()->addString ( '<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet">' );
?>

<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title><? $APPLICATION->ShowTitle (); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" type="image/x-icon" href="<?= SITE_TEMPLATE_PATH ?>/assets/img/favicon.png">
    <? $APPLICATION->ShowHead (); ?>
</head>
<body>

<div id="panel">
    <? $APPLICATION->ShowPanel (); ?>
</div>

<!--[if lt IE 8]>
<p class="browserupgrade">???? ?????????????????????? <strong>????????????????????</strong> ??????????????. ????????????????????
    <a href="http://browsehappy.com/">???????????????? ??????</a>
</p>
<![endif]-->


<!-- ?????????? ?? ???????????????????? -->
<div class="header-top-area bg-color ptb-10 hidden-xs">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <div class="welcome">
                    <span><i class="fa fa-envelope"></i> admin@domain.com</span>
                    <span><i class="fa fa-phone"></i> +012 345 6789</span>
                </div>
            </div>
            <div class="col-md-6 col-sm-6">
                <div class="social-icon-header text-right">
                    <a href="#"><i class="fa fa-facebook-official" aria-hidden="true"></i></i></a>
                    <a href="#"><i class="fa fa-twitter"></i></a>
                    <a href="#"><i class="fa fa-linkedin"></i></a>
                    <a href="#"><i class="fa fa-google-plus"></i></a>
                    <a href="#"><i class="fa fa-youtube"></i></a>
                    <a href="#"><i class="fa fa-dribbble"></i></a>
                    <a href="#"><i class="fa fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ?????????? ?????????? (????????) -->
<header id="sticky-header" class="header-area header-wrapper white-bg">
    <!-- ???????? (?????? ????????????????) -->
    <div class="header-middle-area full-width">
        <div class="container">
            <div class="full-width-mega-dropdown">
                <div class="row">
                    <!-- ?????????????? -->
                    <div class="col-md-2 col-sm-3 col-xs-8">
                        <div class="logo ptb-22">
                            <a href="index.html">
                                <img src="<?= SITE_TEMPLATE_PATH ?>/assets/img/logo/logo.png" alt="main logo">
                            </a>
                        </div>
                    </div>

                    <!-- ???????? (????????????????) -->
                    <div class="col-md-10 col-sm-9 col-xs-4 text-right dark-menu">

                        <? $APPLICATION->IncludeComponent (
                            "bitrix:menu",
                            "am_top_menu",
                            array(
                                "ALLOW_MULTI_SELECT" => "N",
                                "CHILD_MENU_TYPE" => "",
                                "DELAY" => "N",
                                "MAX_LEVEL" => "2",
                                "MENU_CACHE_GET_VARS" => array(),
                                "MENU_CACHE_TIME" => "3600",
                                "MENU_CACHE_TYPE" => "N",
                                "MENU_CACHE_USE_GROUPS" => "N",
                                "ROOT_MENU_TYPE" => "top",
                                "USE_EXT" => "N",
                                "COMPONENT_TEMPLATE" => "am_top_menu"
                            ),
                            false
                        ); ?>


                        <!-- ?????????? -->
                        <div class="header-right">
                            <div class="header-search">
                                <div class="search-wrapper">
                                    <a href="javascript:void(0);" class="search-open">
                                        <i class="pe-7s-search"></i>
                                    </a>
                                    <div class="search-inside animated bounceInUp">
                                        <i class="icon-close search-close fa fa-times"></i>
                                        <div class="search-overlay"></div>
                                        <div class="position-center-center">
                                            <div class="search">
                                                <form>
                                                    <input type="search" placeholder="?????????? ???? ??????????">
                                                    <button type="submit"><i class="fa fa-search"></i></button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ???????? (?????? ??????????????) -->
    <div class="mobile-menu-area visible-xs">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="mobile-menu">
                        <nav id="dropdown">
                            <ul>
                                <li>
                                    <a href="index.html">??????????????</a>
                                </li>
                                <li>
                                    <a href="about_us.html">?? ??????</a>
                                </li>
                                <li>
                                    <a href="services.html">????????????</a>
                                    <ul>
                                        <li>
                                            <a href="services_landing.html">??????????????</a>
                                        </li>
                                        <li>
                                            <a href="services_online_shop.html">????????????????-??????????????</a>
                                        </li>
                                    </ul>
                                </li>
                                <li><a href="portfolio.html">??????????????????</a></li>

                                <li>
                                    <a href="blog.html">????????</a>
                                </li>
                                <li>
                                    <a href="contacts.html">????????????????</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- ?????????????? ???????????? (??????????????????) -->
<div class="breadcrumb-area brand-bg ptb-100">
    <div class="container width-100">
        <div class="row z-index">
            <div class="col-md-7 col-sm-6">
                <div class="breadcrumb-title">
                    <h2 class="white-text"><?php $APPLICATION->ShowTitle () ?></h2>
                </div>
            </div>
            <div class="col-md-5 col-sm-6">
                <div class="breadcrumb-menu">
                    <ol class="breadcrumb text-right">
                        <li>
                            <a href="index.html">??????????????</a>
                        </li>
                        <li>
                            <a href="#">?? ??????</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
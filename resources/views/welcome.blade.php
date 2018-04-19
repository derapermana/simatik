
<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.2.0
Version: 3.3.1
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest (the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

<!-- Head BEGIN -->
<head>
    <meta charset="utf-8">
    <title>SIMATIK | Home</title>

    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <meta content="Metronic Shop UI description" name="description">
    <meta content="Metronic Shop UI keywords" name="keywords">
    <meta content="keenthemes" name="author">

    <meta property="og:site_name" content="-CUSTOMER VALUE-">
    <meta property="og:title" content="-CUSTOMER VALUE-">
    <meta property="og:description" content="-CUSTOMER VALUE-">
    <meta property="og:type" content="website">
    <meta property="og:image" content="-CUSTOMER VALUE-"><!-- link to image for socio -->
    <meta property="og:url" content="-CUSTOMER VALUE-">

    <link rel="shortcut icon" href="favicon.ico">

    <!-- Fonts START -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|PT+Sans+Narrow|Source+Sans+Pro:200,300,400,600,700,900&amp;subset=all" rel="stylesheet" type="text/css">
    <!-- Fonts END -->

    <!-- Global styles START -->
    <link href="{!! asset('assets') !!}/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="{!! asset('assets') !!}/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Global styles END -->

    <!-- Page level plugin styles START -->
    <link href="{!! asset('assets') !!}/global/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet">
    <link href="{!! asset('assets') !!}/global/plugins/carousel-owl-carousel/owl-carousel/owl.carousel.css" rel="stylesheet">
    <link href="{!! asset('assets') !!}/global/plugins/slider-revolution-slider/rs-plugin/css/settings.css" rel="stylesheet">
    <!-- Page level plugin styles END -->

    <!-- Theme styles START -->
    <link href="{!! asset('assets') !!}/global/css/components.css" rel="stylesheet">
    <link href="{!! asset('assets') !!}/frontend/layout/css/style.css" rel="stylesheet">
    <link href="{!! asset('assets') !!}/frontend/pages/css/style-revolution-slider.css" rel="stylesheet"><!-- metronic revo slider styles -->
    <link href="{!! asset('assets') !!}/frontend/layout/css/style-responsive.css" rel="stylesheet">
    <link href="{!! asset('assets') !!}/frontend/layout/css/themes/red.css" rel="stylesheet" id="style-color">
    <link href="{!! asset('assets') !!}/frontend/layout/css/custom.css" rel="stylesheet">
    <!-- Theme styles END -->
</head>
<!-- Head END -->

<!-- Body BEGIN -->
<body class="corporate">
<!-- BEGIN STYLE CUSTOMIZER -->
<div class="color-panel hidden-sm">
    <div class="color-mode-icons icon-color"></div>
    <div class="color-mode-icons icon-color-close"></div>
        <div class="color-mode">
        <p>THEME COLOR</p>
        <ul class="inline">
            <li class="color-red current color-default" data-style="red"></li>
            <li class="color-blue" data-style="blue"></li>
            <li class="color-green" data-style="green"></li>
            <li class="color-orange" data-style="orange"></li>
            <li class="color-gray" data-style="gray"></li>
            <li class="color-turquoise" data-style="turquoise"></li>
        </ul>
    </div>
</div>
<!-- END BEGIN STYLE CUSTOMIZER -->

<!-- BEGIN TOP BAR -->
<div class="pre-header">
    <div class="container">
        <div class="row">
            <!-- BEGIN TOP BAR LEFT PART -->
            <div class="col-md-6 col-sm-6 additional-shop-info">
                <ul class="list-unstyled list-inline">
                    <li><i class="fa fa-phone"></i><span>1-500-005</span></li>
                    <li><i class="fa fa-envelope-o"></i><span>simatik@kemdikbud.go.id</span></li>
                </ul>
            </div>
            <!-- END TOP BAR LEFT PART -->
            <!-- BEGIN TOP BAR MENU -->
            <div class="col-md-6 col-sm-6 additional-nav">
                <ul class="list-unstyled list-inline pull-right">
                    <li><a href="{{ route('login') }}">Log In</a></li>
                </ul>
            </div>
            <!-- END TOP BAR MENU -->
        </div>
    </div>
</div>
<!-- END TOP BAR -->
<!-- BEGIN HEADER -->
<div class="header">
    <div class="container">
        <a class="site-logo" href="{{ url('/') }}"><img src="{!! asset('img/logo.png') !!}"> SIMATIK</a>

        <a href="javascript:void(0);" class="mobi-toggler"><i class="fa fa-bars"></i></a>

    </div>
</div>
<!-- Header END -->

<div class="main">
    <div class="container">
        <div class="row">
            <h1>Sistem Manajemen Aset TIK</h1>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat blue-madison">
                    <div class="visual">

                    </div>
                    <div class="details">
                        <div class="number">
                            {{ count($servers) }}
                        </div>
                        <div class="desc">
                            Server
                        </div>
                    </div>
                    @can('server.b')
                        <a class="more" href="{{ route('servers') }}">
                            View more <i class="m-icon-swapright m-icon-white"></i>
                        </a>
                    @endcan
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat red-intense">
                    <div class="visual">

                    </div>
                    <div class="details">
                        <div class="number">
                            {{ count($applications) }}
                        </div>
                        <div class="desc">
                            Aplikasi
                        </div>
                    </div>
                    @can('application.b')
                        <a class="more" href="{{ route('applications') }}">
                            View more <i class="m-icon-swapright m-icon-white"></i>
                        </a>
                    @endcan
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat green-haze">
                    <div class="visual">

                    </div>
                    <div class="details">
                        <div class="number">
                            {{ count($people) }}
                        </div>
                        <div class="desc">
                            Pengelola TIK
                        </div>
                    </div>
                    @can('person.b')
                        <a class="more" href="{{ route('persons') }}">
                            View more <i class="m-icon-swapright m-icon-white"></i>
                        </a>
                    @endcan
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat purple-plum">
                    <div class="visual">

                    </div>
                    <div class="details">
                        <div class="number">
                            {{ count($licenses) }}
                        </div>
                        <div class="desc">
                            Lisensi
                        </div>
                    </div>
                    @can('license.b')
                        <a class="more" href="{{ route('licenses') }}">
                            View more <i class="m-icon-swapright m-icon-white"></i>
                        </a>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>
<hr>

<!-- BEGIN SLIDER -->
<div class="page-slider">
    <div class="fullwidthbanner-container revolution-slider">
        <div class="fullwidthabnner">
            <ul id="revolutionul">
                    <li data-transition="fade" data-slotamount="8" data-masterspeed="700" data-delay="9400" data-thumb="{{ asset('metronic/assets/frontend/pages/img/revolutionslider/thumbs/thumb2.jpg') }}">
                        <!-- THE MAIN IMAGE IN THE FIRST SLIDE -->
                        <img src="{{ asset('img/cloud-hosting.png') }}" alt="" class="img-responsive">

                    </li>

            </ul>
            <div class="tp-bannertimer tp-bottom"></div>
        </div>
    </div>
</div>
<!-- END SLIDER -->



<!-- BEGIN FOOTER -->
{{--<div class="footer">--}}
    {{--<div class="container">--}}
        {{--<div class="row">--}}
            {{--<!-- BEGIN COPYRIGHT -->--}}
            {{--<div class="col-md-6 col-sm-6 padding-top-10">--}}
                {{--2014 © Metronic Shop UI. ALL Rights Reserved. <a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a>--}}
            {{--</div>--}}
            {{--<!-- END COPYRIGHT -->--}}
            {{--<!-- BEGIN PAYMENTS -->--}}
            {{--<div class="col-md-6 col-sm-6">--}}
                {{--<ul class="social-footer list-unstyled list-inline pull-right">--}}
                    {{--<li><a href="#"><i class="fa fa-facebook"></i></a></li>--}}
                    {{--<li><a href="#"><i class="fa fa-google-plus"></i></a></li>--}}
                    {{--<li><a href="#"><i class="fa fa-dribbble"></i></a></li>--}}
                    {{--<li><a href="#"><i class="fa fa-linkedin"></i></a></li>--}}
                    {{--<li><a href="#"><i class="fa fa-twitter"></i></a></li>--}}
                    {{--<li><a href="#"><i class="fa fa-skype"></i></a></li>--}}
                    {{--<li><a href="#"><i class="fa fa-github"></i></a></li>--}}
                    {{--<li><a href="#"><i class="fa fa-youtube"></i></a></li>--}}
                    {{--<li><a href="#"><i class="fa fa-dropbox"></i></a></li>--}}
                {{--</ul>--}}
            {{--</div>--}}
            {{--<!-- END PAYMENTS -->--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}
<!-- END FOOTER -->

<!-- Load javascripts at bottom, this will reduce page load time -->
<!-- BEGIN CORE PLUGINS (REQUIRED FOR ALL PAGES) -->
<!--[if lt IE 9]>
<script src="{!! asset('assets') !!}/global/plugins/respond.min.js"></script>
<![endif]-->
<script src="{!! asset('assets') !!}/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="{!! asset('assets') !!}/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<script src="{!! asset('assets') !!}/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="{!! asset('assets') !!}/frontend/layout/scripts/back-to-top.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->

<!-- BEGIN PAGE LEVEL JAVASCRIPTS (REQUIRED ONLY FOR CURRENT PAGE) -->
<script src="{!! asset('assets') !!}/global/plugins/fancybox/source/jquery.fancybox.pack.js" type="text/javascript"></script><!-- pop up -->
<script src="{!! asset('assets') !!}/global/plugins/carousel-owl-carousel/owl-carousel/owl.carousel.min.js" type="text/javascript"></script><!-- slider for products -->

<!-- BEGIN RevolutionSlider -->

<script src="{!! asset('assets') !!}/global/plugins/slider-revolution-slider/rs-plugin/js/jquery.themepunch.revolution.min.js" type="text/javascript"></script>
<script src="{!! asset('assets') !!}/global/plugins/slider-revolution-slider/rs-plugin/js/jquery.themepunch.tools.min.js" type="text/javascript"></script>
<script src="{!! asset('assets') !!}/frontend/pages/scripts/revo-slider-init.js" type="text/javascript"></script>
<!-- END RevolutionSlider -->

<script src="{!! asset('assets') !!}/frontend/layout/scripts/layout.js" type="text/javascript"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {
        Layout.init();
        Layout.initOWL();
        RevosliderInit.initRevoSlider();
        Layout.initTwitter();
        //Layout.initFixHeaderWithPreHeader(); /* Switch On Header Fixing (only if you have pre-header) */
        //Layout.initNavScrolling(); 
    });
</script>
<!-- END PAGE LEVEL JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
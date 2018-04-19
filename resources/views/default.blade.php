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
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>SIMATIK | {{ $page_title or 'page_title' }}</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta content="" name="description"/>
<meta content="" name="author"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="{!! asset('assets') !!}/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="{!! asset('assets') !!}/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
<link href="{!! asset('assets') !!}/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="{!! asset('assets') !!}/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<link href="{!! asset('assets') !!}/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>
<link href="{!! asset('assets') !!}/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->

<link rel="stylesheet" type="text/css" href="{!! asset('assets') !!}/global/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="{!! asset('assets') !!}/global/plugins/datatables/extensions/Scroller/css/dataTables.scroller.min.css"/>
<link rel="stylesheet" type="text/css" href="{!! asset('assets') !!}/global/plugins/datatables/extensions/ColReorder/css/dataTables.colReorder.min.css"/>
<link rel="stylesheet" type="text/css" href="{!! asset('assets') !!}/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>


<!-- BEGIN THEME STYLES -->
<link href="{!! asset('assets') !!}/global/css/components.css" rel="stylesheet" type="text/css"/>
<link href="{!! asset('assets') !!}/global/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="{!! asset('assets') !!}/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
<link id="style_color" href="{!! asset('assets') !!}/admin/layout/css/themes/default.css" rel="stylesheet" type="text/css"/>
<link href="{!! asset('assets') !!}/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="favicon.ico"/>
@yield('css')
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<!-- DOC: Apply "page-header-fixed-mobile" and "page-footer-fixed-mobile" class to body element to force fixed header or footer in mobile devices -->
<!-- DOC: Apply "page-sidebar-closed" class to the body and "page-sidebar-menu-closed" class to the sidebar menu element to hide the sidebar by default -->
<!-- DOC: Apply "page-sidebar-hide" class to the body to make the sidebar completely hidden on toggle -->
<!-- DOC: Apply "page-sidebar-closed-hide-logo" class to the body element to make the logo hidden on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-hide" class to body element to completely hide the sidebar on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-fixed" class to have fixed sidebar -->
<!-- DOC: Apply "page-footer-fixed" class to the body element to have fixed footer -->
<!-- DOC: Apply "page-sidebar-reversed" class to put the sidebar on the right side -->
<!-- DOC: Apply "page-full-width" class to the body element to have full width page without the sidebar menu -->
<body class="page-header-fixed page-quick-sidebar-over-content page-full-width">
@include('partials.header')
<div class="clearfix">
</div>
<!-- BEGIN CONTAINER -->
<div class="page-container">
	@include('partials.sidebar')
	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN PAGE HEADER-->
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="index.html">{{ $page_title or 'page_title' }}</a>
						<i class="fa fa-angle-right"></i>
					</li>
					@if(isset($page_subtitle))
					<li>
						<a href="#">{{ $page_subtitle }}</a>
						<i class="fa fa-angle-right"></i>
					</li>
					@endif
				</ul>
			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN DASHBOARD STATS -->
			<div class="row">

			</div>
			<!-- END DASHBOARD STATS -->
			<div class="clearfix">
			</div>
            <div class="row">
				@include('flash::message')
                <div class="col-md-12 ">
					<!-- BEGIN Portlet PORTLET-->
					<div class="portlet light bordered">
						<div class="portlet-title">
							<div class="caption">
								<i class="icon-puzzle font-red-flamingo"></i>
								<span class="caption-subject bold font-red-flamingo uppercase">
								{{ (isset($page_subtitle) ? $page_subtitle : $page_title) }} </span>
								{{-- <span class="caption-helper">more samples...</span> --}}
							</div>
							<div class="tools">
								<a href="" class="collapse" data-original-title="" title="">
								</a>
								<a href="" class="reload" data-original-title="" title="">
								</a>
								<a href="" class="fullscreen" data-original-title="" title="">
								</a>
							</div>
						</div>
						<div class="portlet-body" style="display: block;">
							@yield('content')
						</div>
					</div>
					<!-- END GRID PORTLET-->
				</div>
            </div>
		</div>
	</div>
	<!-- END CONTENT -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="page-footer">
	<div class="page-footer-inner">
		 2018 &copy; SIMATIK by Pustekkom.
	</div>
	<div class="scroll-to-top">
		<i class="icon-arrow-up"></i>
	</div>
</div>
<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="{!! asset('assets') !!}/global/plugins/respond.min.js"></script>
<script src="{!! asset('assets') !!}/global/plugins/excanvas.min.js"></script>
<![endif]-->
<script src="{!! asset('assets') !!}/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="{!! asset('assets') !!}/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="{!! asset('assets') !!}/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
<script src="{!! asset('assets') !!}/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="{!! asset('assets') !!}/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="{!! asset('assets') !!}/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="{!! asset('assets') !!}/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="{!! asset('assets') !!}/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="{!! asset('assets') !!}/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script type="text/javascript" src="{!! asset('assets') !!}/global/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="{!! asset('assets') !!}/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="{!! asset('assets') !!}/global/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
<script type="text/javascript" src="{!! asset('assets') !!}/global/plugins/datatables/extensions/ColReorder/js/dataTables.colReorder.min.js"></script>
<script type="text/javascript" src="{!! asset('assets') !!}/global/plugins/datatables/extensions/Scroller/js/dataTables.scroller.min.js"></script>
<script type="text/javascript" src="{!! asset('assets') !!}/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>

<script src="{!! asset('assets') !!}/global/scripts/metronic.js" type="text/javascript"></script>
<script src="{!! asset('assets') !!}/admin/layout/scripts/layout.js" type="text/javascript"></script>


<!-- END PAGE LEVEL SCRIPTS -->
<script>
jQuery(document).ready(function() {
   Metronic.init(); // init metronic core components
   Layout.init(); // init
});
</script>
@yield('js')
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>

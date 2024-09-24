<!DOCTYPE html>
<html lang="en">
<!-- Mirrored from demos.creative-tim.com/material-dashboard-pro/examples/pages/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 30 Jun 2018 10:39:33 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<!-- /Added by HTTrack -->
<head>
    <meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="{{url('/')}}/assets/img/apple-icon.png">
	<link rel="icon" type="image/png" href="{{url('/')}}/assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>
	{{ isset($page_title)?$page_title:"" }} - {{ config('app.project.name') }}
	</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
	<!-- Extra details for Live View on GitHub Pages -->
	
	<!--     Fonts and icons     -->
	
	<link rel="stylesheet" type="text/css" href="{{url('/')}}/css/admin/roboto.css" />
	<link rel="stylesheet" href="{{url('/')}}/css/admin/font-awesome.min.css">
	<!-- CSS Files -->
	<link href="{{url('/')}}/css/admin/material-dashboard.min40a0.css?v=2.0.2" rel="stylesheet" />
	<!-- CSS Just for demo purpose, don't include it in your project -->
	
	<link href="{{url('/')}}/assets/demo/demo.css" rel="stylesheet" />
	<link href="{{url('/')}}/css/admin/common.css" rel="stylesheet" />   
	
	<!-- JS Files -->
	<script type="text/javascript" src="{{url('/')}}/js/admin/core/jquery.min.js"></script>    
	<script src="{{url('/')}}/js/admin/core/popper.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="{{url('/')}}/js/admin/pages/image_validation.js"></script>
	<script src="{{url('/')}}/js/admin/core/bootstrap-material-design.min.js" type="text/javascript"></script>
	<script src="{{url('/')}}/js/admin/plugins/perfect-scrollbar.jquery.min.js" ></script>
	
	<!--  Google Maps Plugin    -->

	
	<input type="hidden" value="{{ csrf_token() }}" name="token" id="token">
   

	<style type="text/css">
		.form-control { width: 50% !important; }
		.error { color: red; margin-left: 50px; }
	</style>

</head>
<body class="off-canvas-sidebar">

		<!-- Navbar -->
		<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top text-white" id="navigation-example">
			<div class="container">
				<div class="navbar-wrapper">
					<!-- <a class="navbar-brand" href="#pablo">{{ $module_title or '' }}</a> -->
				</div>
				<button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation" data-target="#navigation-example">
					<span class="sr-only">Toggle navigation</span>
					<span class="navbar-toggler-icon icon-bar"></span>
					<span class="navbar-toggler-icon icon-bar"></span>
					<span class="navbar-toggler-icon icon-bar"></span>
				</button>
			</div>
		</nav>
		<!-- End Navbar -->

		<div class="wrapper wrapper-full-page">
			<div class="page-header login-page header-filter" filter-color="black" style="background-image: url('assets/img/class9.JPG'); background-size: cover; background-position: top center;">
				<div class="container">
					<div class="col-lg-5 col-md-6 col-sm-6 ml-auto mr-auto">
						<form action="{{url('/supervisor/validate_login')}}" id="frm_login" method="post" class="form form-validate">
						{{csrf_field()}}

							<div class="card card-login card-hidden">
								<div class="card-header card-header-rose text-center">
									<h4 class="card-title">{{ $module_title or '' }}</h4>
								</div>

								<div class="card-body" style="padding: 0 10px !important;">
									@include('supervisor.layout._operation_status')
								</div>
								
								<div class="card-body">
									<span class="bmd-form-group">
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text">
													<i class="material-icons">email</i>
												</span>
											</div>
											<input type="text" class="form-control" placeholder="Email address *" autofocus="true" name="email" id="email" value="{{ $_COOKIE['remember_me_email'] or '' }}" required="true">
										</div>
									</span>
									<span class="bmd-form-group">
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text">
													<i class="material-icons">lock_outline</i>
												</span>
											</div>
											<input type="password" class="form-control" placeholder="Password *" name="password" id="password" required="required" minlength="6" data-rule-maxlength="16">
										</div>
									</span>
									
									<div class="row login-remember-me-section">
                                        <div class="form-check col-md-6 remember-me-button">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" value="">
                                                <span class="form-check-sign">
                                                    <span class="check"></span>
                                                </span> Remember me
                                            </label>
                                        </div>
                                        <div class="forgot-pass-section col-md-6">
                                            <a href="{{url('/')}}/supervisor/forgot_password" class="btn btn-rose btn-link btn-lg">Forgot password?</a>
                                        </div>
                                    </div>																	
								</div>
								<div class="card-footer justify-content-center">
									<button type="submit" class="btn btn-rose btn-link btn-lg">Login</button>
<!--									<a href="{{url('/')}}/supervisor/forgot_password" class="btn btn-rose btn-link btn-lg">Forgot password?</a>-->
								</div>
							</div>
						</form>
					</div>
				</div>
				
				
			</div>
		</div>

		<!--   Core JS Files   -->
		<script src="{{ url('/') }}/js/admin/core/jquery.min.js" type="text/javascript"></script>
		<script src="{{ url('/') }}/js/admin/core/popper.min.js" type="text/javascript"></script>
		<script src="{{ url('/') }}/js/admin/core/bootstrap-material-design.min.js" type="text/javascript"></script>
		<script src="{{ url('/') }}/js/admin/plugins/perfect-scrollbar.jquery.min.js" ></script>
		<!-- Plugin for the momentJs  -->
		<script src="{{ url('/') }}/js/admin/plugins/moment.min.js"></script>
		<!--  Plugin for Sweet Alert -->
		<script src="{{ url('/') }}/js/admin/plugins/sweetalert2.js"></script>
		<!-- Forms Validations Plugin -->
		<script src="{{ url('/') }}/js/admin/plugins/jquery.validate.min.js"></script>
		<!--  Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
		<script src="{{ url('/') }}/js/admin/plugins/jquery.bootstrap-wizard.js"></script>
		<!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
		<script src="{{ url('/') }}/js/admin/plugins/bootstrap-selectpicker.js" ></script>
		<!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
		<script src="{{ url('/') }}/js/admin/plugins/bootstrap-datetimepicker.min.js"></script>
		<!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
		<script src="{{ url('/') }}/js/admin/plugins/jquery.dataTables.min.js"></script>
		<!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
		<script src="{{ url('/') }}/js/admin/plugins/bootstrap-tagsinput.js"></script>
		<!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
		<script src="{{ url('/') }}/js/admin/plugins/jasny-bootstrap.min.js"></script>
		<!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
		<script src="{{ url('/') }}/js/admin/plugins/fullcalendar.min.js"></script>
		<!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
		<script src="{{ url('/') }}/js/admin/plugins/jquery-jvectormap.js"></script>
		<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
		<script src="{{ url('/') }}/js/admin/plugins/nouislider.min.js" ></script>
		<!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
		<script src="{{url('/')}}/js/admin/core.js"></script>
		<!-- Library for adding dinamically elements -->
		<script src="{{ url('/') }}/js/admin/plugins/arrive.min.js"></script>		
		
		<!-- Place this tag in your head or just before your close body tag. -->
		<script async defer src="{{url('/')}}/js/admin/buttons.js"></script>
		<!-- Chartist JS -->
		<script src="{{ url('/') }}/js/admin/plugins/chartist.min.js"></script>
		<!--  Notifications Plugin    -->
		<script src="{{ url('/') }}/js/admin/plugins/bootstrap-notify.js"></script>
		<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
		<script src="{{ url('/') }}/js/admin/material-dashboard.min40a0.js?v=2.0.2" type="text/javascript"></script>
		<!-- Material Dashboard DEMO methods, don't include it in your project! -->
		<script src="{{url('/')}}/assets/demo/demo.js"></script>
		<script>
			$(document).ready(function(){
				jQuery('#frm_login').validate({
					errorClass: "error",
					highlight: function(element) { },
					errorElement: "div",
					rules: {
						email: {
							required: true,
							email: true,
							pattern: /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/
						}
					},
					messages: {
						email: {
							pattern: "Please enter a valid email address.",

						},
					}

				});
			});

			$(document).ready(function(){
				$().ready(function(){
					$sidebar = $('.sidebar');

					$sidebar_img_container = $sidebar.find('.sidebar-background');

					$full_page = $('.full-page');

					$sidebar_responsive = $('body > .navbar-collapse');

					window_width = $(window).width();

					fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();

					if (window_width > 767 && fixed_plugin_open == 'Dashboard') {
						if ($('.fixed-plugin .dropdown').hasClass('show-dropdown')) {
							$('.fixed-plugin .dropdown').addClass('open');
						}

					}

					$('.fixed-plugin a').click(function(event) {
                 // Alex if we click on switch, stop propagation of the event, so the dropdown will not be hide, otherwise we set the  section active
                 if ($(this).hasClass('switch-trigger')) {
                 	if (event.stopPropagation) {
                 		event.stopPropagation();
                 	} else if (window.event) {
                 		window.event.cancelBubble = true;
                 	}
                 }
             });

					$('.fixed-plugin .active-color span').click(function() {
						$full_page_background = $('.full-page-background');

						$(this).siblings().removeClass('active');
						$(this).addClass('active');

						var new_color = $(this).data('color');

						if ($sidebar.length != 0) {
							$sidebar.attr('data-color', new_color);
						}

						if ($full_page.length != 0) {
							$full_page.attr('filter-color', new_color);
						}

						if ($sidebar_responsive.length != 0) {
							$sidebar_responsive.attr('data-color', new_color);
						}
					});

					$('.fixed-plugin .background-color .badge').click(function() {
						$(this).siblings().removeClass('active');
						$(this).addClass('active');

						var new_color = $(this).data('background-color');

						if ($sidebar.length != 0) {
							$sidebar.attr('data-background-color', new_color);
						}
					});

					$('.fixed-plugin .img-holder').click(function() {
						$full_page_background = $('.full-page-background');

						$(this).parent('li').siblings().removeClass('active');
						$(this).parent('li').addClass('active');


						var new_image = $(this).find("img").attr('src');

						if ($sidebar_img_container.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
							$sidebar_img_container.fadeOut('fast', function() {
								$sidebar_img_container.css('background-image', 'url("' + new_image + '")');
								$sidebar_img_container.fadeIn('fast');
							});
						}

						if ($full_page_background.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
							var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

							$full_page_background.fadeOut('fast', function() {
								$full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
								$full_page_background.fadeIn('fast');
							});
						}

						if ($('.switch-sidebar-image input:checked').length == 0) {
							var new_image = $('.fixed-plugin li.active .img-holder').find("img").attr('src');
							var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

							$sidebar_img_container.css('background-image', 'url("' + new_image + '")');
							$full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
						}

						if ($sidebar_responsive.length != 0) {
							$sidebar_responsive.css('background-image', 'url("' + new_image + '")');
						}
					});

					$('.switch-sidebar-image input').change(function() {
						$full_page_background = $('.full-page-background');

						$input = $(this);

						if ($input.is(':checked')) {
							if ($sidebar_img_container.length != 0) {
								$sidebar_img_container.fadeIn('fast');
								$sidebar.attr('data-image', '#');
							}

							if ($full_page_background.length != 0) {
								$full_page_background.fadeIn('fast');
								$full_page.attr('data-image', '#');
							}

							background_image = true;
						} else {
							if ($sidebar_img_container.length != 0) {
								$sidebar.removeAttr('data-image');
								$sidebar_img_container.fadeOut('fast');
							}

							if ($full_page_background.length != 0) {
								$full_page.removeAttr('data-image', '#');
								$full_page_background.fadeOut('fast');
							}

							background_image = false;
						}
					});

					$('.switch-sidebar-mini input').change(function() {
						$body = $('body');

						$input = $(this);

						if (md.misc.sidebar_mini_active == true) {
							$('body').removeClass('sidebar-mini');
							md.misc.sidebar_mini_active = false;

							$('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar();

						} else {

							$('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar('destroy');

							setTimeout(function() {
								$('body').addClass('sidebar-mini');

								md.misc.sidebar_mini_active = true;
							}, 300);
						}

                 // we simulate the window Resize so the charts will get updated in realtime.
                 var simulateWindowResize = setInterval(function() {
                 	window.dispatchEvent(new Event('resize'));
                 }, 180);

                 // we stop the simulation of Window Resize after the animations are completed
                 setTimeout(function() {
                 	clearInterval(simulateWindowResize);
                 }, 1000);

             });
				});
});
</script>
       <script>
       	$(document).ready(function(){
       		demo.checkFullPageBackgroundImage();setTimeout(function(){
               // after 1000 ms we add the class animated to the login/register card
               $('.card').removeClass('card-hidden');
           }, 700);});
       </script>
   </body>
   </html>

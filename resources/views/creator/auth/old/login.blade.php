<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>{{ isset($page_title)?$page_title:"" }} - {{ config('app.project.name') }}</title>

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="{{url('/')}}/css/admin/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="{{url('/')}}/css/admin/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="{{url('/')}}/css/admin/core.css" rel="stylesheet" type="text/css">
	<link href="{{url('/')}}/css/admin/components.css" rel="stylesheet" type="text/css">
	<link href="{{url('/')}}/css/admin/colors.css" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script type="text/javascript" src="{{url('/')}}/js/admin/plugins/loaders/pace.min.js"></script>
	<script type="text/javascript" src="{{url('/')}}/js/admin/core/libraries/jquery.min.js"></script>
	<script type="text/javascript" src="{{url('/')}}/js/admin/pages/jquery.validate.min.js"></script>
	<script type="text/javascript" src="{{url('/')}}/js/admin/pages/additional-methods.min.js"></script>

	<script type="text/javascript" src="{{url('/')}}/js/admin/core/libraries/bootstrap.min.js"></script>
	<script type="text/javascript" src="{{url('/')}}/js/admin/plugins/loaders/blockui.min.js"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script type="text/javascript" src="{{url('/')}}/js/admin/plugins/forms/styling/uniform.min.js"></script>

	<script type="text/javascript" src="{{url('/')}}/js/admin/core/app.js"></script>
	<script type="text/javascript" src="{{url('/')}}/js/admin/pages/login.js"></script>
	<link rel="shortcut icon" type="image/png" href="{{ url('/assets/images/fav_icon.png') }}"/>
</head>

<body class="login-container login-cover">
	<style type="text/css">
		.error_class
		{
			color:red;
		}
		.alert {
			margin: 24px!important;
		}
		.close-btn
		{
			position: relative;
			top: -5px!important;
			right: -15px!important;
			color: inherit;
		}
	</style>
	<!-- Page container -->
	<div class="page-container">

		<!-- Page content -->
		<div class="page-content">

			<!-- Main content -->
			<div class="content-wrapper">

				<!-- Content area -->
				<div class="content pb-20">

					<!-- Tabbed form -->
					<div class="tabbable panel login-form width-400">
						@include('admin.layout._operation_status') 
						<div class="tab-content panel-body">
							<div class="tab-pane fade in active" id="basic-tab1">
								<form action="{{url($admin_panel_slug.'/validate_login')}}" id="frm_login" method="post"  class="form-validate">
									{{csrf_field()}}
									<div class="text-center">
										<div class="icon-object border-slate-300 text-slate-300"><i class="icon-reading"></i></div>
										<h5 class="content-group">Login to your account</h5>
									</div>

									<div class="form-group has-feedback has-feedback-left">
										<input type="text" class="form-control" autofocus="true" placeholder="Email address" name="email" id="email" value="{{$_COOKIE['remember_me_email'] or ''}}">
										<div class="form-control-feedback">
											<i class="icon-user text-muted"></i>
										</div>
										<span class="error_class" style="color:red;">{{ $errors->first('email') }} </span>
									</div>

									<div class="form-group has-feedback has-feedback-left">
										<input type="password" class="form-control" placeholder="Password" name="password" id="password" required="required" minlength="6" data-rule-maxlength="16">
										<div class="form-control-feedback">
											<i class="icon-lock2 text-muted"></i>
										</div>
										<span class="error_class" style="color:red;">{{ $errors->first('password') }} </span>
									</div>

									<div class="form-group login-options">
										<div class="row">
											<div class="col-sm-6">
												<label class="checkbox-inline">
													<input type="checkbox" class="styled" @if(!empty($_COOKIE['remember_me_email'])) ? checked : '' @endif name="remember_me" id="remember_me">
													Remember me
												</label>
											</div>

											<div class="col-sm-6 text-right">
												<a href="{{url('/')}}/admin/forgot_password">Forgot password?</a>
											</div>
										</div>
									</div>

									<div class="form-group">
										<button type="submit" class="btn bg-blue btn-block">Login <i class="icon-arrow-right14 position-right"></i></button>
									</div>
								</form>

								<div class="content-divider text-muted form-group"><span>{{config('app.project.name')}}</span></div>
								
							</div>
						</div>
					</div>
					<!-- /tabbed form -->

				</div>
				<!-- /content area -->

			</div>
			<!-- /main content -->

		</div>
		<!-- /page content -->

	</div>
	<!-- /page container -->

	<script>
		$(document).ready(function(){
			jQuery('#frm_login').validate({
				errorClass: "error_class",
				highlight: function(element) { },
				errorElement: "span",
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
	</script>

</body>
</html>

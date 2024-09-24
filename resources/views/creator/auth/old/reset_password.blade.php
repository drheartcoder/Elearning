<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>{{ $module_title or '' }}</title>

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="{{url('/')}}/css/admin/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="{{url('/')}}/css/admin/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="{{url('/')}}/css/admin/core.css" rel="stylesheet" type="text/css">
	<link href="{{url('/')}}/css/admin/components.css" rel="stylesheet" type="text/css">
	<link href="{{url('/')}}/css/admin/colors.css" rel="stylesheet" type="text/css">
	<link href="{{url('/')}}/css/admin/loading_animate.css" rel="stylesheet" type="text/css">
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
	<script type="text/javascript" src="{{url('/')}}/js/admin/pages/loader.js"></script>
	<link rel="shortcut icon" type="image/png" href="{{ url('/assets/images/fav_icon.png') }}"/>
	


</head>

<body class="login-container login-cover">
	<style type="text/css">
		.error_class
		{
			color:red;
		}


		.pull-right {
			text-align: right!important;
			padding-top: 20px!important;
		}

		.close-btn {

    padding: 10px!important;
    padding-right: 10px!important;
}

	</style>
	<!-- Page container -->
	<div class="page-container">

		<!-- Page content -->
		<div class="page-content">

			<!-- Main content -->
			<div class="content-wrapper">

				<!-- Content area -->
				<div class="content">
					<!-- Password recovery -->
					<form action="{{url('/')}}/admin/forgot_password/postReset" method="post" id="frm_forgot">

						{{csrf_field()}}
						<div class="panel panel-body login-form">
							@include('admin.layout._operation_status') 
							<div class="text-center">
								<div class="icon-object border-success text-success"><i class="icon-lock2"></i></div>
								<h5 class="content-group">Password Reset <small class="display-block">Add Your New Password</small></h5>
							</div>

							<div class="form-group has-feedback">
								<input type="password" name="password" id="password" class="form-control" placeholder="Your New Password">
								<div class="form-control-feedback">
									<i class="icon-lock2 text-muted"></i>
								</div>
							</div>

							<div class="form-group has-feedback">
								<input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirm Password" data-rule-required="true">
								<div class="form-control-feedback">
									<i class="icon-lock2 text-muted"></i>
								</div>
							</div>

							<input type="hidden" name="token" value="{{ $token or ''}}" />
							<input type="hidden" name="email" value="{{ $password_reset['email'] or ''}}" />

							<button type="submit" class="btn bg-blue btn-block">Reset <i class="icon-arrow-right14 position-right"></i></button>

							<div class="col-sm-6 pull-right">
								<a href="{{url('/')}}/admin">Back To Login</a>
							</div>
						</div>

					</form>
					<!-- /password recovery -->


					<!-- Footer -->
					<div class="footer text-muted text-center">
						Copyright &copy; 2014. <a href="#">{{config('app.project.name')}}</a> by <a href="http://interface.club">Eugene Kopyov</a>
					</div>
					<!-- /footer -->

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
			jQuery('#frm_forgot').validate({
				errorClass: "error_class",
				highlight: function(element) { },
				errorElement: "span",
				ignore: [],
				rules: {
					'password': {
						pattern: /(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^])(?=.*\d).*/,
						required: true,
						minlength:6,
					},
					'password_confirmation': {
						required: true,
						equalTo: "#password"
					}
				},
				messages: {
					password_confirmation: {
						equalTo: "Please enter same password again"

					},
					password: {
						pattern: "Password contain at least (1) lowercase and (1) uppercase and (1) special character and (1) letter."
					},

				}
			});

			$('#frm_forgot').submit(function(){
				if($("#frm_forgot").valid())
				{
					showProcessingOverlay();
				}
			});
		});
	</script>



</body>
</html>

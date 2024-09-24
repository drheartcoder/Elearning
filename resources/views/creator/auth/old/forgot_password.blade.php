<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>{{ $module_title or '' }}</title>

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
			text-align: right;
			padding-top: 20px;
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
					<form action="{{url('/')}}/admin/forgot_password/post_email" method="post" id="frm_forgot">

						{{csrf_field()}}
						<div class="panel panel-body login-form">
							@include('admin.layout._operation_status') 
							<div class="text-center">
								<div class="icon-object border-warning text-warning"><i class="icon-spinner11"></i></div>
								<h5 class="content-group">Password recovery <small class="display-block">We'll send you link in email</small></h5>
							</div>

							<div class="form-group has-feedback">
								<input type="text" name="email" id="email" class="form-control" placeholder="Your email" data-rule-required="true">
								<div class="form-control-feedback">
									<i class="icon-mail5 text-muted"></i>
								</div>
							</div>

							<button type="submit" class="btn bg-blue btn-block">Recover <i class="icon-arrow-right14 position-right"></i></button>

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
			/*jQuery('#frm_forgot').validate({
				errorClass: "error_class",
				highlight: function(element) { },
				errorElement: "span"

			});
			$('#frm_forgot').submit();

		});*/


		$('#frm_forgot').on('submit',function()
    { 
        var form = $( "#frm_forgot");
        if(form.valid())
        {
            showProcessingOverlay();
            return true;
        }
    });
	jQuery('#frm_forgot').validate({
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

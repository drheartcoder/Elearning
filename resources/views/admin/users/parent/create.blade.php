
@extends('admin.layout.master')    
@section('main_content')
 <!-- Page header -->
         @include('admin.layout.breadcrumb')  
<!-- /page header -->

<!-- BEGIN Main Content -->

	<!-- Content area -->
	<div class="content">
		<div class="row">
			<div class="col-md-12">

				<div class="panel panel-flat">
					@include('admin.layout._operation_status')
				<div class="panel-heading">
					<h5 class="panel-title">{{$module_title or ''}}</h5>
				</div>

				<div class="panel-body">
					<form class="form-horizontal" id="frm_account_setting" name="frm_account_setting" action="{{$module_url_path}}/store" method="post" enctype="multipart/form-data">						
						{{csrf_field()}}
						<fieldset class="content-group">	
							<div class="form-group">
								<label class="control-label col-lg-2" for="contact">User Type<i class="red">*</i></label>
								<div class="col-lg-5">
									<select class="form-control" data-rule-required="true" name="user_type" id="user_type">
										<option value="">Select User Type</option>	
										<option value="program-creator">Program Creator</option>	
										<option value="supervisor">Supervisor</option>	
									</select>	
									<span class="error">{{ $errors->first('user_type') }} </span>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-lg-2" for="first_name">First Name<i class="red">*</i></label>
								<div class="col-lg-5">
									<input type="text" name="first_name" id="first_name"  class="form-control" placeholder="First Name" data-rule-required="true" data-rule-maxlength="60" value="{{$arr_admin_details['first_name'] or ''}}" onkeyup="chk_validation(this)">
									<span class="error">{{ $errors->first('first_name') }} </span>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-lg-2" for="last_name">Last Name<i class="red">*</i></label>
								<div class="col-lg-5">
									<input type="text" name="last_name" id="last_name"  class="form-control" placeholder="Last Name" data-rule-required="true" data-rule-maxlength="60" value="{{$arr_admin_details['last_name'] or ''}}" onkeyup="chk_validation(this)">
									<span class="error">{{ $errors->first('last_name') }} </span>
								</div>
							</div>														
							<div class="form-group">
								<input type="hidden" name="isvalid" id="isvalid" value="">									
								<label class="control-label col-lg-2" for="email">Email<i class="red">*</i></label>
								<div class="col-lg-5">
									<input type="text" name="email" id="email" class="form-control chk_email" placeholder="Email" data-rule-required="true" data-rule-email value="{{$arr_admin_details['email'] or ''}}">
									<span class="error" id="err_email">{{ $errors->first('email') }} </span>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-lg-2" for="contact">Phone Number<i class="red">*</i></label>
								<div class="col-lg-5">
									<input type="text" name="contact" id="contact" class="form-control" data-rule-required="true" data-rule-pattern="[- +()0-9]+" data-rule-minlength="7" data-rule-maxlength="16" data-msg-minlength="Phone no should be atleast 7 numbers" data-msg-maxlength="Phone no should not be more than 16 numbers" placeholder="Phone Number" value="{{$arr_admin_details['contact'] or ''}}">
									<span class="error">{{ $errors->first('contact') }} </span>
								</div>
							</div>							
							<div class="form-group">
								<label class="control-label col-lg-2" for="address">Address<i class="red">*</i></label>
								<div class="col-lg-5">
									<input type="text" name="address" id="address" class="form-control" data-rule-required="true" data-rule-maxlength="255" placeholder="Address" value="{{$arr_admin_details['address'] or ''}}">
									<span class="error">{{ $errors->first('address') }} </span>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-lg-2" for="password">Password<i class="red">*</i></label>
								<div class="col-lg-5">
									<input type="password" name="password" id="password" class="form-control" data-rule-pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^])(?=.*\d).*" data-rule-required="true" data-rule-maxlength="255" placeholder="Password" value="">
									<span class="error">{{ $errors->first('password') }} </span>
									<div class="clearfix"></div>
									<span style="font-weight: 10px;color:#000000;font-family: 'heeboregular', sans-serif;" ><i class="fa fa-exclamation-triangle" style="font-weight: 10px;color: red;"><span style="font-family: 'heeboregular', sans-serif;">Note</span></i> : Password must contain at least (1) lowercase and (1) uppercase and (1) special character and greater than or equal to 6 character.</span>
								</div>

							</div>
							<div class="form-group">
								<label class="control-label col-lg-2" for="confirm_password">Confirm Password<i class="red">*</i></label>
								<div class="col-lg-5">
									<input type="password" name="confirm_password" id="confirm_password" class="form-control" data-rule-required="true" data-rule-maxlength="255" data-rule-equalto="#password" placeholder="Confirm Password" value="">
									<span class="error">{{ $errors->first('confirm_password') }} </span>
								</div>
							</div>
							<div class="form-group text-center">
								<div class="col-lg-7">
									<button type="submit" class="btn btn-primary">Add</button>
									<a href="{{$module_url_path}}" class="btn btn-primary">Cancel</a>
								</div>
							</div>
						</fieldset>						
					</form>
				</div>
			</div>
		</div>
	</div>



{{-- <script src="https://maps.googleapis.com/maps/api/js?v=3&key=AIzaSyCccvQtzVx4aAt05YnfzJDSWEzPiVnNVsY&libraries=places"></script>

<script src="{{ url('/') }}/js/admin/pages/jquery.geocomplete.js"></script> --}}

<script>

	/*$(document).ready(function(){
      $("#address").geocomplete();
    });*/

    $(document).on("change",".validate-image", function()
    {        
        var file=this.files;
        validateImage(this.files, 250,250);
    });

    $(document).on("click","#remove", function()
    {   
        removeFile();
    });



    $(document).ready(function(){    	
    	$('#frm_account_setting').validate({
    		ignore: [],
    		highlight: function(element) { },
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
            },
               errorPlacement: function(error, element) 
               { 
                  var name = $(element).attr("name");
                  if (name === "profile_image") 
                  {
                    error.insertAfter('.err_image');
                  } 
                  else
                  {
                    error.insertAfter(element);
                  }
                
               } 
    	});

    	$('#frm_account_setting').submit(function(){
			
			if($('#frm_account_setting').valid() == true)  
			{
				var isvalid = $("input[name='isvalid']").val();	    		
	    		if(isvalid == 'invalid')
				{
					return false;
				}
				else
				{
					return true;	
				}
			}			

    	});
    });

    function chk_validation(ref)
      {
          var yourInput = $(ref).val();
          re = /[0-9`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi;
          var isSplChar = re.test(yourInput);
          if(isSplChar)
          {
            var no_spl_char = yourInput.replace(/[0-9`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi, '');
            $(ref).val(no_spl_char);
          }
      }

</script>

@endsection


			
@extends('creator.layout.master')    
@section('main_content')
<!-- BEGIN Main Content -->
<!-- Page header -->
    @include('creator.layout.breadcrumb')  
<!-- /page header -->
<!-- Content area -->
<div class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="card-body-section">
            <div class="card">
               <div class="card-header card-header-icon card-header-rose">
                  <div class="card-icon">
                     <i class="fa fa-key"></i>
                  </div>
                  <h4 class="card-title">{{$module_title or ''}} </h4>
               </div>
               <div class="card-body">
               	@include('creator.layout._operation_status')
                  <form class="form-horizontal" id="frm_change_password" name="frm_change_password" action="{{$module_url_path}}/password/update" method="post">
                  	{{csrf_field()}}
		                  <h4 class="title">&nbsp;</h4>    
		                <div class="form-group has-default bmd-form-group is-filled">
		                    <label class="bmd-label-floating">Current Password <i class="red">*</i></label>
		                	<input type="password" name="current_password" id="current_password" class="form-control" data-rule-required="true" data-rule-minlength="6" data-rule-maxlength="16" data-rule-pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^])(?=.*\d).*" data-msg-pattern="Password must contain at least (1) lowercase, (1) uppercase, (1) special character, (1) letter.">
							<span class="error">{{ $errors->first('current_password') }} </span>
		                </div>		              
		                <div class="form-group has-default bmd-form-group is-filled">
                            <label class="bmd-label-floating">New Password <i class="red">*</i></label>
		                  	<input type="password" name="new_password" id="new_password" class="form-control" data-rule-required="true" data-rule-minlength="6" data-rule-maxlength="16" data-rule-pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^])(?=.*\d).*" data-msg-pattern="Password must contain at least (1) lowercase, (1) uppercase, (1) special character, (1) letter.">
							<span class="error">{{ $errors->first('new_password') }} </span>
		                </div>
		              
		            

		            
		              
		                <div class="form-group has-default bmd-form-group is-filled">
                          <label class="bmd-label-floating">Confirm New Password <i class="red">*</i></label>		              
		                  	<input type="password" name="confirm_password" id="confirm_password" class="form-control" data-rule-required="true" data-rule-equalto="#new_password" data-rule-maxlength="16" data-rule-pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^])(?=.*\d).*" data-msg-pattern="Password must contain at least (1) lowercase, (1) uppercase, (1) special character, (1) letter.">
							<span class="error">{{ $errors->first('confirm_password') }} </span>
		                </div>
		              
		            
                     <button type="submit" class="btn btn-rose pull-right">Save</button>
                     <div class="clearfix"></div>
                  </form>
               </div>
            </div>
         </div>                 
      </div>
   </div>
</div>
		
<script>
    $(document).ready(function(){
    	$('#frm_change_password').validate({
    		highlight: function(element) { }
    	});
    });
</script>

@endsection


			
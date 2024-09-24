@extends('admin.layout.master')    
@section('main_content')
<!-- BEGIN Main Content -->
<!-- Page header -->
    @include('admin.layout.breadcrumb')  
<!-- /page header -->

<!-- Content area -->
<div class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="card-body-section">
            <div class="card">
               <div class="card-header card-header-icon card-header-rose">
                  <div class="card-icon">
                     <i class="fa fa-gear"></i>
                  </div>
                  <h4 class="card-title">{{$module_title or ''}} </h4>
               </div>
               <div class="card-body">

               	@include('admin.layout._operation_status')

                <?php
                  $child_limit          = isset($arr_global_setting['child_limit']) && !empty($arr_global_setting['child_limit']) ? $arr_global_setting['child_limit'] : '';
                  $daily_lesson_limit   = isset($arr_global_setting['daily_lesson_limit']) && !empty($arr_global_setting['daily_lesson_limit']) ? $arr_global_setting['daily_lesson_limit'] : '';
                  $daily_homework_limit = isset($arr_global_setting['daily_homework_limit']) && !empty($arr_global_setting['daily_homework_limit']) ? $arr_global_setting['daily_homework_limit'] : '';
                  $daily_textbook_limit = isset($arr_global_setting['daily_textbook_limit']) && !empty($arr_global_setting['daily_textbook_limit']) ? $arr_global_setting['daily_textbook_limit'] : '';
        				?>

                  <form class="form-horizontal" id="frm_global_setting" name="frm_global_setting" action="{{ $module_url_path }}/update" method="post">
                  	{{csrf_field()}}
                  	<h4 class="title">&nbsp;</h4>                   
                      
                      <div class="row">
                       	<div class="col-md-6">
                        <div class="form-group has-default bmd-form-group is-filled">
                          	<label class="bmd-label-floating">Child Limit <i class="red">*</i></label>
                          	<input type="text" name="child_limit" id="child_limit" class="form-control digits" data-rule-required="true" data-rule-maxlength="2" maxlength="2" value="{{ $child_limit }}">
                          	<span class="error">{{ $errors->first('child_limit') }}</span>
                       	</div>
                        </div>
                        
                        <div class="col-md-6">
                       	<div class="form-group has-default bmd-form-group is-filled">
                          	<label class="bmd-label-floating">Daily Lesson Limit <i class="red">*</i></label>
                          	<input type="text" name="daily_lesson_limit" id="daily_lesson_limit" class="form-control digits" data-rule-required="true" data-rule-maxlength="2" maxlength="2" value="{{ $daily_lesson_limit }}">
                          	<span class="error">{{ $errors->first('daily_lesson_limit') }} </span>
                       	</div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                        <div class="form-group has-default bmd-form-group is-filled">
                            <label class="bmd-label-floating">Daily Homework Limit <i class="red">*</i></label>
                            <input type="text" name="daily_homework_limit" id="daily_homework_limit" class="form-control digits" data-rule-required="true" data-rule-maxlength="2" maxlength="2" value="{{ $daily_homework_limit }}">
                            <span class="error">{{ $errors->first('daily_homework_limit') }} </span>
                        </div>
                        </div>

                        <div class="col-md-6">
                        <div class="form-group has-default bmd-form-group is-filled">
                            <label class="bmd-label-floating">Daily Book Limit <i class="red">*</i></label>
                            <input type="text" name="daily_textbook_limit" id="daily_textbook_limit" class="form-control digits" data-rule-required="true" data-rule-maxlength="2" maxlength="2" value="{{ $daily_textbook_limit }}">
                            <span class="error">{{ $errors->first('daily_textbook_limit') }} </span>
                        </div>
                        </div>
                      </div>
                    
                     <button type="submit" class="btn btn-rose pull-right">Update</button>
                     <div class="clearfix"></div>
                  </form>
               </div>
            </div>
         </div>                 
      </div>
   </div>
</div>

<script>
		var rules = new Object();
    $(document).ready(function(){
			$('#frm_global_setting').validate({
				highlight: function (element) {},
        ignore: [],
        rules: rules,
				errorPlacement: function(error, element) 
				{ 
				  var name = $(element).attr("name");
				  error.insertAfter(element);
				} 
			});

			// Allow only Numeric Characters
      $(document).on('keydown blur', '.digits', function() {
        if (this.value.match(/[^.0-9]/g)) {
          this.value = this.value.replace(/[^.0-9]/g, '');
        }
	    });

		});
	</script>

@endsection


			
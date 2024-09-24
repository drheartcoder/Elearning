
@extends('admin.layout.master')    
@section('main_content')
<!-- Page header -->
@include('admin.layout.breadcrumb')  
<!-- /page header -->

<!-- BEGIN Main Content -->

<div class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="card-body-section">
            <div class="card">
               <div class="card-header card-header-icon card-header-rose">
                  <div class="card-icon">
                     <i class="fa fa-bank"></i>
                  </div>
                  <h4 class="card-title">{{$sub_module_title or ''}}
                  </h4>
               </div>
            <?php
              $first_name         = isset($arr_classroom['user_data']['first_name']) ? ucfirst($arr_classroom['user_data']['first_name']) : '';
              $last_name          = isset($arr_classroom['user_data']['last_name']) ? ucfirst($arr_classroom['user_data']['last_name']) : '';
              $email              = isset($arr_classroom['user_data']['email']) ? $arr_classroom['user_data']['email'] : '';
              $subject_traslation = isset($arr_classroom['subject_details']['subject_traslation']) ? $arr_classroom['subject_details']['subject_traslation'] : '';
              $grade_traslation   = isset($arr_classroom['grade_details']['grade_traslation']) ? $arr_classroom['grade_details']['grade_traslation'] : '';
              $enrollment_code    = isset($arr_classroom['class_enrollment_code']) ? $arr_classroom['class_enrollment_code'] : '';
              $end_date           = isset($arr_classroom['end_date']) ? get_added_on_date($arr_classroom['end_date']) : 'NA';
              $name               = isset($arr_classroom['name']) ? $arr_classroom['name'] : '';
              $transfer           = isset($arr_classroom['is_transfer']) ? ucfirst($arr_classroom['is_transfer']) : '';
              $transfer_fname     = isset($arr_classroom['transfer_user_details']['first_name']) ? ucfirst($arr_classroom['transfer_user_details']['first_name']) : '';
              $transfer_lname     = isset($arr_classroom['transfer_user_details']['last_name']) ? ucfirst($arr_classroom['transfer_user_details']['last_name']) : '';
              $transfer_email     = isset($arr_classroom['transfer_user_details']['email']) ? $arr_classroom['transfer_user_details']['email'] : '';
              $enc_class_id       = isset($arr_classroom['id']) ? base64_encode($arr_classroom['id']) : '';
              $enc_teacher_id     = isset($arr_classroom['user_data']['id']) ? base64_encode($arr_classroom['user_data']['id']) : '';
            ?>
               <div class="card-body">
                    <div class="program-details-main">
                        <div class="program-details-head">
                            Details
                        </div>
                        <div class="border-bottom padding-10">
                            <div class="row">
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="program-details-section">
                                        <div class="program-head">
                                            <b>Teacher Name <span>:</span> </b> 
                                        </div>
                                        <div class="program-content-txt">
                                            {{ $first_name.' '.$last_name }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="program-details-section">
                                        <div class="program-head">
                                            <b>Teacher Email <span>:</span></b>
                                        </div>
                                        <div class="program-content-txt">
                                            {{ $email }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="border-bottom padding-10">
                            <div class="row">
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="program-details-section">
                                        <div class="program-head">
                                            <b>Class Name <span>:</span></b>
                                        </div>
                                        <div class="program-content-txt">
                                            {{isset($name) && $name!=''?$name:''}}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="program-details-section">
                                        <div class="program-head">
                                            <b>End Date <span>:</span> </b> 
                                        </div>
                                        <div class="program-content-txt">
                                            {{ $end_date }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="border-bottom padding-10">
                            <div class="row">
                                @if(sizeof($subject_traslation) > 0)
                                    @foreach($subject_traslation as $subject)
                                        @if(isset($arr_lang) && sizeof($arr_lang)>0)
                                            @foreach($arr_lang as $lang)
                                                @if($subject['locale'] == $lang['locale'])
                                                <div class="col-sm-6 col-md-6 col-lg-6">
                                                    <div class="program-details-section">
                                                        <div class="program-head">
                                                            <b>Subject ({{ $lang['title'] }}) <span>:</span></b>
                                                        </div>
                                                        <div class="program-content-txt">
                                                            {{ isset($subject['name']) ? $subject['name'] : '' }}
                                                        </div>
                                                    </div>
                                                </div>                                
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="border-bottom padding-10">
                            <div class="row">
                                @if(sizeof($grade_traslation) > 0)
                                @foreach($grade_traslation as $grade)
                                  @if(isset($arr_lang) && sizeof($arr_lang)>0)
                                    @foreach($arr_lang as $lang)
                                      @if($grade['locale'] == $lang['locale'])
                                      <div class="col-sm-6 col-md-6 col-lg-6">
                                        <div class="program-details-section">
                                            <div class="program-head">
                                                <b>Grade ({{ $lang['title'] }})<span>:</span></b>
                                            </div>
                                            <div class="program-content-txt">
                                                {{ isset($grade['name']) ? $grade['name'] : '' }}
                                            </div>
                                        </div>
                                    </div>  
                                      @endif
                                    @endforeach
                                  @endif
                                @endforeach
                              @endif                       
                            </div>
                        </div>

                        <div class="border-bottom padding-10">
                            <div class="row">
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="program-details-section">
                                        <div class="program-head">
                                            <b>Enrollment Code <span>:</span> </b> 
                                        </div>
                                        <div class="program-content-txt">
                                            {{ $enrollment_code }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="program-details-section">
                                        <div class="program-head">
                                            <b>Transfer<span>:</span> </b> 
                                        </div>
                                        <div class="program-content-txt">
                                            {{ $transfer }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if($transfer == "Yes")
                        <div class="border-bottom padding-10">
                            <div class="row">
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="program-details-section">
                                        <div class="program-head">
                                            <b>Transfer User Name<span>:</span> </b> 
                                        </div>
                                        <div class="program-content-txt">
                                            {{ $transfer_fname.' '.$transfer_lname }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="program-details-section">
                                        <div class="program-head">
                                            <b>Transfer User Email<span>:</span> </b> 
                                        </div>
                                        <div class="program-content-txt">
                                            {{ $transfer_email }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                    </div>
                                                                              
               </div>
               <br>
               <div class="form-group text-center">
                  <div class="col-lg-12">
                     <a href="{{$module_url_path}}" class="btn btn-rose pull-right">Back</a>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- BEGIN Main Content -->

<div class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-md-12">
            <div class="card">
               <div class="card-header card-header-primary card-header-icon">
                  <div class="card-icon">
                     <i class="{{ $student_module_icon }}"></i>            
                  </div>
                  <h4 class="card-title">{{ $student_module_title or '' }}</h4>
               </div>
               <div class="card-body">
                  
                  @include('admin.layout._operation_status')

                  <?php $keyword = Request::input('keyword'); $join_date = Request::input('join_date'); ?>

                  <form name="frm-manage" id="frm-manage" method="get" action="{{ $student_module_path }}" class="form-horizontal" >

                     <div class="row">
                        <div class="col-md-3">
                           <div class="form-group has-default bmd-form-group is-filled">
                              <label class="bmd-label-floating">Keyword </label>
                              <input type="text" name="keyword" id="keyword"  class="form-control" data-rule-required="true" data-rule-maxlength="60" value="{{$keyword or ''}}" >
                           </div>
                        </div>
                        <div class="col-md-3">
                           <div class="form-group has-default bmd-form-group is-filled">
                              <input type="text" name="join_date" id="join_date"  class="form-control datepicker" placeholder="Date" data-rule-required="true" data-rule-maxlength="60" value="{{ $join_date or ''}}" >                          
                           </div>
                        </div>
                        <div class="col-md-6">
                           <button type="submit" class="btn btn-rose">search</button>
                           <a href="{{ $student_module_path }}" class="btn btn-default">Clear</a>
                        </div>
                     </div>
                  </form>
                  <div class="clearfix"></div>
                  <form class="form-horizontal" id="frm_manage" name="frm_manage" action="{{ $module_url_path }}/students/multi_action" method="post">
                     {{csrf_field()}} 
                     
                     <input type="hidden" id="multi_action"   name="multi_action"   >
                     <input type="hidden" id="enc_class_id"   name="enc_class_id"   value="{{ $enc_class_id   }}" >
                     <input type="hidden" id="enc_teacher_id" name="enc_teacher_id" value="{{ $enc_teacher_id }}" >

                     <div class="toolbar">
                        <a href="javascript:void(0)" class="btn btn-link btn-warning btn-just-icon like" title="Deactivate Multiple" onclick="check_multi_action('frm_manage','deactivate')"><i class="material-icons">lock</i></a>
                        <a href="javascript:void(0)" class="btn btn-link btn-success btn-just-icon like" title="Activate Multiple" onclick="check_multi_action('frm_manage','activate')"><i class="material-icons">lock_open</i></a>
                        <a href="{{ $student_module_path }}" class="btn btn-link btn-primary btn-just-icon like" title="Refresh"><i class="material-icons">autorenew</i></a>
                     </div>
                     <div class="material-datatables">
                        <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                           <thead>
                              <tr class="border-solid">
                                 <th style="width:18px">
                                    <div class="form-check">
                                       <label class="form-check-label">
                                       <input class="form-check-input" type="checkbox" name="selectall" id="selectall" onchange="chk_all(this);" value="selectall">
                                       <span class="form-check-sign">
                                       <span class="check"></span>
                                       </span>
                                       </label>
                                    </div>
                                 </th>
                                 <th>Pin</th>
                                 <th>First Name</th>
                                 <th>Last Name</th>
                                 <th>Join Date</th>
                                 <th>Status</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody>
                           </tbody>
                        </table>
                     </div>
                  </form>
               </div>
               <!-- end content-->
            </div>
            <!--  end card  -->
         </div>
         <!-- end col-md-12 -->
      </div>
      <!-- end row -->
   </div>
</div>

<script>
$(document).ready(function() {
  	var enc_class_id    = $('#enc_class_id').val();
  	var enc_teacher_id  = $('#enc_teacher_id').val();
  	var keyword         = $('#keyword').val();
  	var join_date       = $('#join_date').val();
  	var module_url_path = "{{ url($module_url_path) }}";
  	var temp_url        = module_url_path + '/load-students';
  	var url             = temp_url.replace(/&amp;/g, '&');

	$('#datatables').DataTable({
		"pagingType": "full_numbers",
		"lengthMenu": [
			[10, 25, 50, -1],
			[10, 25, 50, "All"]
		],
		responsive: true,
		language: {
			search: "_INPUT_",
			searchPlaceholder: "Search records",
		},
		"processing" : true,
		"serverSide" : true,
		"paging"     : true,
		"searching"  : false,
		"ordering"   : true,
		"destroy"    : true,
		ajax :
		{
			'url'  : temp_url,
			'data' : { 'keyword': keyword, 'join_date': join_date, 'enc_class_id':enc_class_id, 'enc_teacher_id':enc_teacher_id  }
		},
		"columnDefs" : [
			{ orderable : false, targets: [0,6] }
		],
		"aaSorting" : []
	});

	var table = $('#datatable').DataTable();

	// Edit record
	table.on('click', '.edit', function() {
		$tr = $(this).closest('tr');
		var data = table.row($tr).data();
		alert('You press on Row: ' + data[0] + ' ' + data[1] + ' ' + data[2] + '\'s row.');
	});

	// Delete a record
	table.on('click', '.remove', function(e) {
		$tr = $(this).closest('tr');
		table.row($tr).remove().draw();
		e.preventDefault();
	});

	//Like record
	table.on('click', '.like', function() {
		alert('You clicked on Like button');
	});


  $(document).on('click', '.share_class', function() {
      var class_id = $(this).data('class_id');
      $("#share_class_id").val(class_id);
    });

    $(document).on('click', '.transfer_class', function() {
      var class_id = $(this).data('class_id');
      $("#transfer_class_id").val(class_id);
    });

    $(".btn_modal_form_cancel, .close").click(function(){
      $(".modal_input").val();
      $(".modal_form")[0].reset();

      $("#transfer_class_form")[0].reset();
      $("#share_class_form")[0].reset();
    });

    /*share_email*/

    $(document).on('click', '#btn_transfer_form_submit', function() {
      var email  = $("#transfer_email").val();
      var output = EmailFormat(email, 'transfer_email');

      if(output == 0) {
            return false;
        } else {
            return true;
        }
    });

    $(document).on('click', '#btn_share_form_submit', function() {
      var email  = $("#share_email").val();
      var output = EmailFormat(email, 'share_email');

      if(output == 0) {
            return false;
        } else {
            return true;
        }
    });

    function EmailFormat(email, type) {
      var email_filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
      var flag         = 1;

      if($.trim(email) == '') {
            $("#err_"+type).html('Please enter email');
            $("#"+type).focus();
            $("#"+type).on('keyup',function(){ $("#err_"+type).html(""); });
            flag = 0;
        } else if(!email_filter.test(email)) {
            $("#err_"+type).html('Please enter vaild email');
            $("#"+type).focus();
            $("#"+type).on('keyup',function(){ $("#err_"+type).html(""); });
            flag = 0;
        }

        return flag;
    }


});
</script>

@endsection
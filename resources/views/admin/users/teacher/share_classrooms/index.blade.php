@extends('admin.layout.master')    
@section('main_content')
<!-- Page header -->
@include('admin.layout.breadcrumb')  
<!-- /page header -->		
<div class="content">
	<div class="container-fluid">
	  <div class="row">
	    <div class="col-md-12">
	      <div class="card">
	        <div class="card-header card-header-primary card-header-icon">
	          <div class="card-icon">
	            <i class="fa fa-bank"></i>            
	          </div>
	          <h4 class="card-title">{{ $sub_module_title or '' }}</h4>
	        </div>
	        <div class="card-body">

	        	@include('admin.layout._operation_status')

	        	<?php $keyword  = Request::input('keyword'); $end_date = Request::input('end_date'); ?>

				<form name="frm-manage" id="frm-manage" method="get" action="{{$module_url_path}}" class="form-horizontal" >

					<div class="row">
	                    <div class="col-md-3">
	                    	<div class="form-group has-default bmd-form-group is-filled">
	                    	<label class="bmd-label-floating">Keyword </label>
	                    <input type="text" name="keyword" id="keyword"  class="form-control" data-rule-required="true" data-rule-maxlength="60" value="{{$keyword or ''}}" >                          
	                       </div>
	                    </div>                   

	                    <div class="col-md-3">
	                       <div class="form-group has-default bmd-form-group is-filled">
	                        <input type="text" name="end_date" id="end_date"  class="form-control datepicker" placeholder="Date" data-rule-required="true" data-rule-maxlength="60" value="{{$end_date or ''}}" >
	                       </div>
	                    </div>  
	                    <div class="col-md-3">
	                        <button type="submit" class="btn btn-rose">search</button>
	                        <a href="{{ $module_url_path }}" class="btn btn-default">Clear</a>
	                    </div>
	                </div>
				</form>	
				<div class="clearfix"></div>

	          	<form class="form-horizontal" id="frm_manage" name="frm_manage" action="{{ url('/') }}/admin/classrooms/multi_action" method="post">
	            {{csrf_field()}}	
	              <input type="hidden" name="multi_action" id="multi_action">
		          <div class="toolbar">

		            <a href="javascript:void(0)" class="btn btn-link btn-warning btn-just-icon like" title="Deactivate Multiple" onclick="check_multi_action('frm_manage','deactivate')"><i class="material-icons">lock</i></a>

		            <a href="javascript:void(0)" class="btn btn-link btn-success btn-just-icon like" title="Activate Multiple" onclick="check_multi_action('frm_manage','activate')"><i class="material-icons">lock_open</i></a>

		            <a href="{{ $module_url_path }}" class="btn btn-link btn-primary btn-just-icon like" title="Refresh"><i class="material-icons">autorenew</i></a>

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
							<th>Enrollment Code</th>
							<th>Class Name</th>
							<th>Share With</th>
							<th>Subject</th>
							<th>Grade</th>
							<th>End Date</th>
							<th>Status</th>
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
  	var keyword         = $('#keyword').val();
    var end_date        = $('#end_date').val();
    var module_url_path = "{{ url($module_url_path) }}";
    var temp_url        = module_url_path + '/load_data';
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
			'data' : { 'keyword': keyword, 'end_date': end_date  }
		},
		"columnDefs" : [
			{ orderable : false, targets: [0,1,2,3,4,5,6,7] }
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
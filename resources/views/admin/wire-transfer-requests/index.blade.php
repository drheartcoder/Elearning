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
            <i class="{{ $module_icon or ''}}"> </i>
          </div>
          <h4 class="card-title">{{ $module_title or '' }}</h4>
        </div>
        <div class="card-body">
        	
        	@include('admin.layout._operation_status')
        	<?php $keyword = Request::input('keyword'); $search_date = Request::input('search_date'); ?>

			<form name="frm-manage" id="frm-manage" method="get" action="{{ $module_url_path }}" class="form-horizontal" >
				
				<div class="row">
                    <div class="col-md-3">
                       <div class="form-group has-default bmd-form-group is-filled">
                            <label class="bmd-label-floating">Keyword </label>
                          <input type="text" name="keyword" id="keyword"  class="form-control" data-rule-required="true" data-rule-maxlength="60" value="{{ $keyword or '' }}" >
                          <span class="error">{{ $errors->first('keyword') }} </span>
                       </div>
                    </div>

                    <div class="col-md-3">
                       	<div class="form-group has-default bmd-form-group is-filled">
                            <label class="bmd-label-floating">Date </label>
                          <input type="text" name="search_date" id="search_date" class="form-control datepicker" value="{{ $search_date or '' }}" >
                          <span class="error">{{ $errors->first('search_date') }} </span>
                       </div>
                    </div>

                    <div class="col-md-6">
                        <button type="submit" class="btn btn-rose">search</button>
                        <a href="{{ $module_url_path }}" class="btn btn-default">Clear</a>
                        <button type="button" id="btn_export_data" class="btn btn-info"><i class="material-icons">insert_chart_outlined</i> Export</button>
                    </div>
                </div>
			</form>	
			<div class="clearfix"></div>

          	<form class="form-horizontal" id="frm_manage" name="frm_manage" action="{{ $module_url_path }}/multi_action" method="post">
            {{csrf_field()}}	
			<input type="hidden" name="multi_action" id="multi_action">
			<div class="toolbar">
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
						<th>Plan</th>
						<th>User Name</th>
						<th>Email</th>
						<th>Contact Number</th>
						<th>Registered On</th>
						<th>Requested Date</th>
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

<div class="modal fade" id="UpdatePlanModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <form name="frmUpdatePlan" id="frmUpdatePlan" action="" method="post">
    {{ csrf_field() }}
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Subscription Plan</h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            <i class="material-icons">clear</i>
          </button>
        </div>
        <div class="modal-body">
        	@if(isset($arr_plan) && count($arr_plan)>0)
	        	@foreach($arr_plan as $plan)
		          <div class="radio-btn radio-first-option">
		            <input type="radio" class="rdoOption" id="rdoOption_{{($plan['id'])}}" name="plan_id" value="{{base64_encode($plan['id'])}}">
		            <label for="rdoOption_{{($plan['id'])}}" style="cursor: pointer;">{{$plan['name']}}({{$plan['price']}}<i class="fa fa-jpy" aria-hidden="true"></i>)</label>
		            <div class="check"></div>
		          </div>
		        @endforeach
	        @endif
	         <span class="error" id="err_plan_id"></span>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-rose" id="btnUpdate">Update</button>&nbsp;
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </form>
</div>

<form id="export_form" method="post" action="{{ $module_url_path }}/export-csv">
    {{ csrf_field() }}
    <input type="hidden" name="export_keyword" id="export_keyword" value=""  />
    <input type="hidden" name="export_date"    id="export_date"    value=""  />
</form>
<script>
	
	$('#btnUpdate').on('click',function()
	{
		var plan_id = $('input[name=plan_id]:checked').val();
		if (plan_id == undefined) 
		{
			$('#err_plan_id').html('Please select plan');
			$('.rdoOption').on('change',function(){ $('#err_plan_id').html('');});
			return false;
		}
	});

	function UpdatePlan(ref)
    {
    	var dataUrl = $(ref).attr('data-url');
    	var plan_id = $(ref).attr('data-plan_id');
    	if(dataUrl!='')
    	{
    		$('.rdoOption').attr('checked',false);
    		$('#frmUpdatePlan').attr('action', dataUrl);
	    	$('#UpdatePlanModal').modal();
    		$('#rdoOption_'+plan_id).attr('checked',true);
    	}
    }

$(document).ready(function() {
	var search_keyword         = $('#keyword').val();
	var requested_date     = $('#search_date').val();
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
			'data' : { 'search_keyword':search_keyword,'requested_date':requested_date }
		},
		"columnDefs" : [
			{ orderable : false, targets: [0] }
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

	$("#btn_export_data").click(function(){
        var keyword = $('#keyword').val();
        var date    = $('#search_date').val();

        if(keyword == '' && date == '')
        {
            swal({
                title: 'Are you sure?',
                text: 'Do you want to export all records?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                buttonsStyling: false
            }).then(function() {
            	$('#export_form').submit();
            }).catch(swal.noop);
        }
        else
        {
            $('#export_keyword').val(keyword);
            $('#export_date').val(date);
            $('#export_form').submit();
        }
    });

});
</script>

@endsection

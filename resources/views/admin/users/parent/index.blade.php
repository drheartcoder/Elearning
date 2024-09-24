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
            <!-- <i class="material-icons">assignment</i> -->
            <i class="{{ $module_icon or ''}}"> </i>
          </div>
          <h4 class="card-title">{{ $module_title or '' }}</h4>
        </div>
        <div class="card-body">
        	@include('admin.layout._operation_status')

        	<?php $keyword = Request::input('keyword'); $search_date = Request::input('search_date'); ?>

			<form name="frm-manage" id="frm-manage" method="get" action="{{$module_url_path}}" class="form-horizontal" >

				<div class="row">
                    <div class="col-md-3">
                       <div class="form-group has-default bmd-form-group is-filled">
                        <label class="bmd-label-floating">Keyword </label>
                          <input type="text" name="keyword" id="keyword"  class="form-control" data-rule-required="true" data-rule-maxlength="60" value="{{$keyword or ''}}" >
                          <span class="error">{{ $errors->first('keyword') }} </span>
                       </div>
                    </div>

                    <div class="col-md-3">
                       	<div class="form-group has-default bmd-form-group is-filled">
                            <label class="bmd-label-floating">Date </label>
                          <input type="text" name="search_date" id="search_date"  class="form-control datepicker" data-rule-required="true" data-rule-maxlength="60" value="{{$search_date or ''}}" >
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

          	<form class="form-horizontal" id="frm_manage" name="frm_manage" action="{{$module_url_path}}/multi_action" method="post">
            {{csrf_field()}}
          	  <input type="hidden" name="multi_action" id="multi_action">
	          <div class="toolbar">            
	            <!-- <a href="{{ $module_url_path.'/create' }}" class="btn btn-link btn-info btn-just-icon like" title="Add"><i class="material-icons">add</i></a> -->

	            <a href="javascript:void(0)" class="btn btn-link btn-warning btn-just-icon like" title="Deactivate Multiple" onclick="check_multi_action('frm_manage','deactivate')"><i class="material-icons">lock</i></a>

	            <a href="javascript:void(0)" class="btn btn-link btn-success btn-just-icon like" title="Activate Multiple" onclick="check_multi_action('frm_manage','activate')"><i class="material-icons">lock_open</i></a>

	            @if(($arr_current_user_access!=null && count($arr_current_user_access)>0 && array_key_exists('users.delete', $arr_current_user_access)) || $shared_admin_details['user_type'] == 'admin')
	            <a href="javascript:void(0)" class="btn btn-link btn-danger btn-just-icon like" title="Delete Multiple" onclick="check_multi_action('frm_manage','delete')"><i class="material-icons">delete_forever</i></a>
	            @endif

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
						<th>Pin</th>
						<th>Name</th>
						<th>Email</th>
						<th>Contact No.</th>
						<th>Gender</th>
						<th>Registration Date</th>
						<th>Expiration Date</th>
						<th>Extension Date</th>
						<th>Membership Status</th>
						<!-- <th>Upgrade Plan</th> -->
						<th>Status</th>
						<th style="min-width: 90px;">Action</th>
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

<div class="modal fade" id="UpgradePlanModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <form name="frmUpgradePlan" id="frmUpgradePlan" action="" method="post">
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
		            <input type="radio" class="rdoOption" id="rdoOption{{$plan['id']}}" name="plan_id" value="{{$plan['id']}}">
		            <label for="rdoOption1">{{$plan['name']}}({{$plan['price']}}<i class="fa fa-jpy" aria-hidden="true"></i>)</label>
		            <div class="check"></div>
		          </div>
		        @endforeach
	        @endif
	         <span class="error" id="err_plan_id"></span>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-rose" id="btnUpgrade">Upgrade</button>&nbsp;
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
	$('#btnUpgrade').on('click',function()
	{
		var plan_id = $('input[name=plan_id]:checked').val();
		if (plan_id == undefined) 
		{
		alert(plan_id);
			$('#err_plan_id').html('Please select at least plan');
			$('.rdoOption').on('change',function(){ $('#err_plan_id').html('');});
			return false;
		}
	});
	$(document).on('click', '.upgradePlan', function()
	{
		var dataUrl       = $(this).attr('data-url');
	/*	swal({
                title: 'Are you sure?',
                text: "Do you really want to reject this record ?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                buttonsStyling: false
            }).then(function() {*/
                upgradePlan(dataUrl);
/*
            }).catch(swal.noop)*/
	});


	function upgradePlan(dataUrl)
    {
    	if(dataUrl!='')
    	{
    		$('#frmUpgradePlan').attr('action', dataUrl);
	    	$('#UpgradePlanModal').modal();
    	}
    }
$(document).ready(function() {
	var keyword         = $('#keyword').val();
    var search_date     = $('#search_date').val();
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
			'data' : { 'keyword':keyword,'search_date':search_date }
		},
		"columnDefs" : [
			{ orderable : false, targets: [0,7,8] }
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
	table.on('click', '.like', function() { alert('You clicked on Like button'); });


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

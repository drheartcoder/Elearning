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
            
        	<?php $title = Request::input('title'); ?>

			<!-- <form name="frm-manage" id="frm-manage" method="get" action="{{$module_url_path}}" class="form-horizontal" >

				<div class="row">
                    <label class="col-md-1 col-form-label">Title </label>
                    <div class="col-md-3">
                       <div class="form-group has-default bmd-form-group is-filled">
                          <input type="text" name="title" id="title"  class="form-control" data-rule-required="true" data-rule-maxlength="60" value="{{$title or ''}}" >                          
                       </div>
                    </div>                   

                    <button type="submit" class="btn btn-rose pull-right"><i class="material-icons">search</i></button>
					<a href="{{ $module_url_path }}" class="btn btn-default">Clear</a>
                </div>
			</form>	 -->
			<div class="clearfix"></div>
			 <?php $currency_sym = isset($arr_currency['html_code']) && !empty($arr_currency['html_code']) ? $arr_currency['html_code'] : ''; ?>
          	<form class="form-horizontal" id="frm_manage" name="frm_manage" action="{{$module_url_path}}/multi_action" method="post">
            {{csrf_field()}}	
              <input type="hidden" name="multi_action" id="multi_action">
	          <div class="toolbar">            
	            <a href="{{ $module_url_path.'/create' }}" class="btn btn-link btn-info btn-just-icon like" title="Add"><i class="material-icons">add</i></a>

	            <a href="javascript:void(0)" class="btn btn-link btn-warning btn-just-icon like" title="Deactivate Multiple" onclick="check_multi_action('frm_manage','deactivate')"><i class="material-icons">lock</i></a>

	            <a href="javascript:void(0)" class="btn btn-link btn-success btn-just-icon like" title="Activate Multiple" onclick="check_multi_action('frm_manage','activate')"><i class="material-icons">lock_open</i></a>

	            @if($arr_current_user_access!=null && count($arr_current_user_access)>0 && array_key_exists('account_setting/contact_address_manage.delete', $arr_current_user_access)) || $shared_admin_details['user_type'] == 'admin')
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
						<th>Address</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
	              </thead>             
	              <tbody>
	              	@if(isset($arr_settings) && count($arr_settings)>0)
	              		@foreach($arr_settings as $row)
		                <tr>
		                	<td>
		                		<div class="form-check">
		                            <label class="form-check-label">
		                                <input class="form-check-input checked_record" type="checkbox" name="checked_record[]" id="checked_record" value="{{base64_encode($row['id'])}}">
		                                <span class="form-check-sign">
		                                    <span class="check"></span>
		                                </span>
		                            </label>
		                        </div>
                    		</td>
		                	<td>{{ isset($row['address_translation'][0]['address']) ? $row['address_translation'][0]['address']: "N/A" }}</td>
		                	<td>
		                		@if($row['status'] == "0")			                       
			                        <a class="btn btn-link btn-warning btn-just-icon like" title="Deactive" href="{{ $module_url_path }}/activate/{{base64_encode($row['id'])}}" onclick="return confirm_action(this,event,\'Do you really want to Activate this record ?\')" ><i class="material-icons">lock</i></a>			                    
			                    @else			                    
			                       <a class="btn btn-link btn-success btn-just-icon like" title="Active" href="{{ $module_url_path }}/deactivate/{{base64_encode($row['id'])}}" onclick="return confirm_action(this,event,\'Do you really want to Deactivate this record ?\')" ><i class="material-icons">lock_open</i></a>			                    
			                    @endif

		                	</td>
		                	<td>
		                		<a class="btn btn-link btn-warning btn-just-icon like" href="{{ $module_url_path }}/edit/{{base64_encode($row['id'])}}" title="Edit"><i class="material-icons" >create </i></a>
		                		<a class="btn btn-link btn-danger btn-just-icon like" href="{{ $module_url_path }}/delete/{{base64_encode($row['id'])}}" onclick="return confirm_action(this,event,\'Do you really want to delete this record ?\')"  title="Delete"><i class="material-icons">delete_forever</i></a>
		                	</td>
		                </tr>
	                	@endforeach
	                @else
	                <tr>
	                	<td colspan="5" style="text-align: center;">No data available in table </td>
	                </tr>	
	                @endif
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

<!-- <script>
$(document).ready(function() {
	var title='';
  	//var title           = $('#title').val();
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
			'data' : { 'title':'title' }
		},
		"columnDefs" : [
			{ orderable : false, targets: [0,2,3] }
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
});
</script> -->

@endsection
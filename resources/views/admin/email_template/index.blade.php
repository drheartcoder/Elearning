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

        	<?php $template_name = Request::input('template_name'); ?>

			<form name="frm-manage" id="frm-manage" method="get" action="{{$module_url_path}}" class="form-horizontal" >

				<div class="row">
                    <div class="col-md-6">
                       <div class="form-group has-default bmd-form-group is-filled">
                            <label class="bmd-label-floating">Title </label>
                          <input type="text" name="template_name" id="template_name"  class="form-control" data-rule-required="true" data-rule-maxlength="60" value="{{$template_name or ''}}" >
                       </div>
                    </div>                   
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-rose">search</button>
                        <a href="{{ $module_url_path }}" class="btn btn-default">Clear</a>
                    </div>
                </div>
			</form>	
			<div class="clearfix"></div>

          	<form class="form-horizontal" id="frm_manage" name="frm_manage" action="{{$module_url_path}}/multi_action" method="post">
            {{csrf_field()}}	
              <input type="hidden" name="multi_action" id="multi_action">
	          <div class="toolbar">            
	            <!-- <a href="{{ $module_url_path.'/create' }}" class="btn btn-link btn-info btn-just-icon like" title="Add"><i class="material-icons">add</i></a> -->

	           <!--  <a href="javascript:void(0)" class="btn btn-link btn-warning btn-just-icon like" title="Deactivate Multiple" onclick="check_multi_action('frm_manage','deactivate')"><i class="material-icons">lock</i></a>

	            <a href="javascript:void(0)" class="btn btn-link btn-success btn-just-icon like" title="Activate Multiple" onclick="check_multi_action('frm_manage','activate')"><i class="material-icons">lock_open</i></a> -->

	            <!-- <a href="javascript:void(0)" class="btn btn-link btn-danger btn-just-icon like" title="Delete Multiple" onclick="check_multi_action('frm_manage','delete')"><i class="material-icons">delete_forever</i></a> -->

	            <a href="{{ $module_url_path }}" class="btn btn-link btn-primary btn-just-icon like" title="Refresh"><i class="material-icons">autorenew</i></a>

	          </div>
	          <div class="material-datatables">
	            <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
	              <thead>
	                <tr class="border-solid">						
						<th>Name</th>
						<th>Subject</th>
						<th>From</th>
						<th>From Email</th>						
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
  	var template_name           = $('#template_name').val();
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
			'data' : { 'template_name':template_name }
		},
		"columnDefs" : [
			{ orderable : false, targets: [4] }
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
</script>

@endsection
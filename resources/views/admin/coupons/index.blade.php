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
            <i class="{{$module_icon or ''}}"></i>            
          </div>
          <h4 class="card-title">{{ $module_title or '' }}</h4>
        </div>
        <div class="card-body">
        	@include('admin.layout._operation_status')
        	
        	<?php $search_keyword  = Request::input('search_keyword');?>

			<form name="frm-manage" id="frm-manage" method="get" action="{{$module_url_path}}" class="form-horizontal" >

				<div class="row">
                    <div class="col-md-6">
                       <div class="form-group has-default bmd-form-group is-filled">
                        <label class="bmd-label-floating">Code/Title </label>
                          <input type="text" name="search_keyword" id="search_keyword"  class="form-control" data-rule-required="true" data-rule-maxlength="60" value="{{$search_keyword or ''}}" >                          
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
	          {{-- 	<a href="{{ url('/admin/reference_code') }}" class="btn btn-link btn-info btn-just-icon like" title="Reference code settings"><i class="fa fa-gear"></i></a> --}}

	            <a href="{{ $module_url_path.'/create' }}" class="btn btn-link btn-info btn-just-icon like" title="Add"><i class="material-icons">add</i></a>

	            <a href="javascript:void(0)" class="btn btn-link btn-warning btn-just-icon like" title="Deactivate Multiple" onclick="check_multi_action('frm_manage','deactivate')"><i class="material-icons">lock</i></a>

	            <a href="javascript:void(0)" class="btn btn-link btn-success btn-just-icon like" title="Activate Multiple" onclick="check_multi_action('frm_manage','activate')"><i class="material-icons">lock_open</i></a>

	            @if( ($arr_current_user_access!=null && count($arr_current_user_access)>0 && array_key_exists('coupons.delete', $arr_current_user_access)) || $shared_admin_details['user_type'] == 'admin')       
	            <a href="javascript:void(0)" class="btn btn-link btn-danger btn-just-icon like" title="Delete Multiple" onclick="check_multi_action('frm_manage','delete')"><i class="material-icons">delete_forever</i></a>
	            @endif

	            <a href="{{ $module_url_path }}" class="btn btn-link btn-primary btn-just-icon like" title="Refresh"><i class="material-icons">autorenew</i></a>

	          </div>
	          <?php $currency_sym = isset($arr_currency['html_code']) && !empty($arr_currency['html_code']) ? $arr_currency['html_code'] : ''; ?>
	          <div class="material-datatables">
            <div class="table-responsive">
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
						<th>Code</th>
						<th style="min-width: 100px;">Title</th>
						<th>Discount Amt ({!! $currency_sym !!})</th>
						<th style="min-width: 80px;">Start Date</th>
						<th style="min-width: 80px;">End Date</th>
						<th>Owner</th>
						<th>User Type</th>
						<th>Remaining Incentive Amount</th>
						<th>Total Incentive Amount</th>
						<th>Usage</th>
						<th style="min-width: 80px;">Action</th>
					</tr>
	              </thead>             
	              <tbody>
	                
	              </tbody>
	            </table>
	            </div>
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
<!--redeem modal--->
<div class="modal fade" id="redeemModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
     <form method="post" action="{{ $module_url_path }}/redeem_amount" id="frm_redeem" name="frm_redeem">
     	{{ csrf_field() }}
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Redeem Amount</h4>
        </div>
        <div class="modal-body">
        	<input type="hidden" name="coupon_id" id="coupon_id">
        	<div class="col-md-6">
                <div class="form-group has-default bmd-form-group is-filled">
                    <label class="bmd-label-floating">Enter Amount <i class="red">*</i></label>
                    <input type="text" name="redeem_amount" data-rule-number=true data-rule-min=1 id="redeem_amount" class="form-control" data-rule-required="true">
                </div>
            </div>                                

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-rose pull-right">Submit</button>
          <div class="clearfix"></div>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      </form>
    </div>
  </div>


<script>
$(document).ready(function() {
  	var search_keyword       = $('#search_keyword').val();
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
			'data' : { 'search_keyword': search_keyword  }
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
	table.on('click', '.like', function() {
		alert('You clicked on Like button');
	});	
	$('#frm_redeem').validate();

});
function showReedemModal(coupon_id)
{
	$('#coupon_id').val(coupon_id);
	$('#redeemModal').modal('show');
}
$('#frm_redeem').on('submit',function(){
	if($('#frm_redeem').valid())
	{
		showProcessingOverlay();	
	}
	
})
</script>
@endsection
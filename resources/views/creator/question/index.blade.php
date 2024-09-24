
@extends('creator.layout.master')    
@section('main_content')
 <!-- Page header -->
         @include('creator.layout.breadcrumb')  
<!-- /page header -->
		
				<!-- Content area -->
				<div class="content">
					<div class="panel panel-flat">
							@include('creator.layout._operation_status')
						<div class="panel-heading">
							<h5 class="panel-title">{{$module_title or ''}}</h5>
							<div class="heading-elements">
								<ul class="icons-list">
									<li><a href="{{ $module_url_path.'/create' }}" class="btn btn-default btn-rounded show-tooltip" title="Add Subject"><i class="fa fa-plus"></i></a></li>
									<li><a href="javascript:void(0)" class="btn btn-default btn-rounded show-tooltip" title="Deactivate Multiple" onclick="check_multi_action('frm_manage','deactivate')"><i class="fa fa-lock"></i></a></li>
									<li><a href="javascript:void(0)" class="btn btn-default btn-rounded show-tooltip" title="Activate Multiple" onclick="check_multi_action('frm_manage','activate')"><i class="fa fa-unlock"></i></a></li>
									<li><a href="javascript:void(0)" class="btn btn-default btn-rounded show-tooltip" title="Delete Multiple" onclick="check_multi_action('frm_manage','delete')"><i class="fa fa-trash"></i></a></li>
									<li><a href="{{ $module_url_path }}" class="btn btn-default btn-rounded show-tooltip" title="Refresh"><i class="fa fa-refresh"></i></a></li>
								</ul>
		                	</div>
						</div>
						<hr class="horizotal-line">
						<?php $keyword = Request::input('keyword'); ?>
						<form name="frm-manage" id="frm-manage" method="get" action="{{ $module_url_path }}" class="form-inline" >
							<div class="form-group col-md-5 text-center" style="margin-top: 10px;">
			                  	<label>Keyword: </label>
			                 	<input type="text" placeholder="Keyword" id="keyword" name="keyword" class="form-control" value="{{ $keyword }}">
			                 	&nbsp;&nbsp;
								<button type="submit" class="btn btn-info">Search</button>
								<a href="{{ $module_url_path }}" class="btn btn-default">Clear</a>
							</div>
						</form>	
						<div class="clearfix"></div>
						<br />

						<form name="frm_manage" id="frm_manage" method="POST" class="form-horizontal" action="{{url($module_url_path)}}/multi_action">
							{{ csrf_field() }}
							<input type="hidden" name="multi_action" value="" />
							<div class="table-responsive">
								<table id="myTable" class="table table-advance">
									<thead>
										<tr class="border-solid">
											<th style="width:18px"><input type="checkbox" name="mult_change" id="mult_change" value="delete" /></th>
											<th>Name</th>
											<th>Description</th>
											<th>Date</th>
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


<script type="text/javascript"> 
    var keyword         = $('#keyword').val();
    var module_url_path = "{{ url($module_url_path) }}";
    var temp_url        = module_url_path + '/load_data';
    var url             = temp_url.replace(/&amp;/g, '&');
    
    table_module    = $('#myTable').DataTable({
          "processing": true,
          "serverSide": true,
          "paging": true,
          "searching":false,
          "ordering": true,
          "destroy": true,
      ajax: 
      {
        'url'     : temp_url,
        'data'    : { 'keyword' : keyword  }
      },
       "columnDefs": [
            { orderable: false, targets: [ 0,4] }
        ],
        "aaSorting": [] 
    });  
</script>

<script type="text/javascript">

	$('#mult_change').click(function (e)
	{
		$(this).closest('table').find('td input:checkbox').prop('checked', this.checked);
	});
  
</script>
@endsection


			
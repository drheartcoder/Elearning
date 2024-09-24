@extends('supervisor.layout.master')
@section('main_content')
<!-- Page header -->
@include('supervisor.layout.breadcrumb')
<!-- /page header -->		
<script src="{{url('/')}}/js/admin/jquery.form.js"></script> 
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
        	@include('supervisor.layout._operation_status')

        	<?php
				$keyword = Request::input('keyword');
			?>

			<form name="frm-manage" id="frm-manage" method="get" action="{{$module_url_path}}" class="form-horizontal" >

				<div class="row">
                    <div class="col-md-4">
                       <div class="form-group has-default bmd-form-group is-filled">
                            <label class="bmd-label-floating">Keyword </label>
                          <input type="text" name="keyword" id="keyword"  class="form-control" data-rule-required="true" data-rule-maxlength="60" value="{{$keyword or ''}}" >
                          <span class="error">{{ $errors->first('keyword') }} </span>
                       </div>
                    </div>
                    <div class="col-md-8">
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

	            <a href="javascript:void(0)" class="btn btn-link btn-warning btn-just-icon like" title="Deactivate Multiple" onclick="check_multi_action('frm_manage','deactivate')"><i class="material-icons">lock</i></a>

	            <a href="javascript:void(0)" class="btn btn-link btn-success btn-just-icon like" title="Activate Multiple" onclick="check_multi_action('frm_manage','activate')"><i class="material-icons">lock_open</i></a>

	            <!-- <a href="javascript:void(0)" class="btn btn-link btn-danger btn-just-icon like" title="Delete Multiple" onclick="check_multi_action('frm_manage','delete')"><i class="material-icons">delete_forever</i></a> -->

	            <a href="{{ $module_url_path }}" class="btn btn-link btn-primary btn-just-icon like" title="Refresh"><i class="material-icons">autorenew</i></a>

	          </div>
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
						<th>Name</th>
						<th>Subject</th>
						<th>Grade</th>
						<th>Created On</th>
						<th>Approve Status</th>
						<th>Challenge Program</th>
						<th>Status</th>
						<th style="min-width: 60px;">Action</th>
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
<div class="modal fade" id="reasonModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <form name="frmReasonUpdate" id="frmReasonUpdate" action="" method="post">
    {{ csrf_field() }}
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Reason</h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            <i class="material-icons">clear</i>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group bmd-form-group is-filled">
              <label class="bmd-label-floating">Reason <span class="red">*</span></label>                    
              <div class="form-group">
                <textarea name="reason" id="reason" class="form-control" rows="5">{{ old('reason') }}</textarea>
                <span class="error" id="err_reason"> @if($errors->has('reason')) {{ $errors->first('reason') }} @endif</span>
              </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-rose" id="btnAddReason">Add</button>&nbsp;
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </form>
</div>
<script type="text/javascript">
    function rejectProgram(dataUrl)
    {
    	if(dataUrl!='')
    	{
    		$('#frmReasonUpdate').attr('action', dataUrl);
	    	$('#reasonModal').modal();
    	}
    }

    $(document).on('click', '#btnAddReason', function(){
    var reason = $('#reason').val();
    var flag   = 0;

    $('#btnAddReason').attr('disabled', true);

    $('#err_reason').html('');

    if(reason=='')
    {
      $('#err_reason').html('This field is required.');
      flag = 1;
    }

    $('#btnAddReason').attr('disabled', false);

    if(flag == 1)
    {
      return false;
    }
    else
    {
        $("#frmReasonUpdate").ajaxSubmit({
           headers:{'X-CSRF-Token': $('input[name="_token"]').val()},
           dataType: 'json',
           beforeSend: function(data, statusText, xhr, wrapper) 
           {
               
           },
           success: function(data, statusText, xhr, wrapper)
           {
               if(data.status == "success")
               {
               	  swal('Record updated successfully.');
               		setTimeout(function() {
                  		window.location.reload();
               		}, 1000);
               }
               else
               {
                  $('.error').html('');
                   if(data.status == 'fail'){
                       var errorsHtml = '';
                       $.each( data.errors, function( key, value ) {
                           $('#err_'+key).addClass('validation-error-label');
                           errorsHtml = $('#err_'+key).html(value[0]);
                       });
                   }
               }
           },
           error: function(data, statusText, xhr, wrapper)
           {
               
           }
        });
    }

  });
		
	$(document).on('click', '.rejectProgram', function(){
		var dataUrl       = $(this).attr('data-url');
		var dataProgramId = $(this).attr('data-programId');

		/*alert(dataUrl);*/
		swal({
                title: 'Are you sure?',
                text: "Do you really want to reject this record ?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                buttonsStyling: false
            }).then(function() {
                /*swal({
                    title: 'Deleted!',
                    text: 'Your file has been deleted.',
                    type: 'success',
                    confirmButtonClass: "btn btn-success",
                    buttonsStyling: false
                })*/

                rejectProgram(dataUrl,dataProgramId);

            }).catch(swal.noop)

		/*swal({
		  title: "Are you sure?",
		  text: "Do you really want to reject this record 111 ?",
		  type: "warning",
		  showCancelButton: true,
		  confirmButtonClass: "btn-danger",
		  confirmButtonText: "Yes",
		  cancelButtonText: "No",
		  closeOnConfirm: false,
		  closeOnCancel: false
		},
		function(isConfirm) {
		  if (isConfirm) {
		    swal("Deleted!", "Your imaginary file has been deleted.", "success");
		    
		  } else {
		    swal("Cancelled", "Your imaginary file is safe :)", "error");
		  }
		});	*/

		/*swal({
		  title: 'Are you sure?',
		  text: "Do you really want to reject this record 111 ?",
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Yes'
		}).then((result) => {
		  if (result.value) {
		    swal(
		      'Deleted!',
		      'Your file has been deleted.',
		      'success'
		    )
		  }
		})*/

		/*swal({
		  title: 'Are you sure?',
		  text: 'Do you really want to reject this record 111 ?',
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonText: 'Yes',
		  cancelButtonText: 'No'
		}).then((result) => {
		  if (result.value) {
		  	swal("IF");
		    swal(
		      'Deleted!',
		      'Your imaginary file has been deleted.',
		      'success'
		    )
		  // For more information about handling dismissals please visit
		  // https://sweetalert2.github.io/#handling-dismissals
		  } else if (result.dismiss === swal.DismissReason.cancel) {
		    swal(
		      'Cancelled',
		      'Your imaginary file is safe :)',
		      'error'
		    )
		  }
		})*/

	});

	

</script>
<script>
$(document).ready(function() {
	var keyword         = $('#keyword').val();
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
			'data' : { 'keyword':keyword }
		},
		"columnDefs" : [
			{ orderable : false, targets: [0,2,3,4,5,6,7] }
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

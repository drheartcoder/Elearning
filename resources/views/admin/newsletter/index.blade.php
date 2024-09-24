
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
            <i class="{{$module_icon}}"></i>            
          </div>
          <h4 class="card-title">{{ $module_title or '' }}</h4>
        </div>
        <div class="card-body">
            @include('admin.layout._operation_status')

            <?php $search_keyword  = Request::input('search_keyword');?>

            <form name="frm-manage" id="frm-manage" method="get" action="{{$module_url_path}}" class="form-horizontal" >
                <div class="row">
                    <div class="col-md-3">
                       <div class="form-group has-default bmd-form-group is-filled">
                        <label class="bmd-label-floating">Name/ Email </label>
                          <input type="text" name="search_keyword" id="search_keyword"  class="form-control" data-rule-required="true" data-rule-maxlength="60" value="{{$search_keyword or ''}}" >                          
                       </div>
                    </div>                                      
                    <div class="col-md-3">
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
                @if( ($arr_current_user_access!=null && count($arr_current_user_access)>0 && array_key_exists('newsletter.create', $arr_current_user_access)) || $shared_admin_details['user_type'] == 'admin')
                    <a href="{{$module_url_path}}/create" class="btn btn-link btn-warning btn-just-icon like" title="Create"><i class="material-icons">add</i></a>
                @endif
                <a href="javascript:void(0)" class="btn btn-link btn-warning btn-just-icon like" title="Deactivate Multiple" onclick="check_multi_action('frm_manage','deactivate')"><i class="material-icons">lock</i></a>

                <a href="javascript:void(0)" class="btn btn-link btn-success btn-just-icon like" title="Activate Multiple" onclick="check_multi_action('frm_manage','activate')"><i class="material-icons">lock_open</i></a>

                @if( ($arr_current_user_access!=null && count($arr_current_user_access)>0 && array_key_exists('newsletter.delete', $arr_current_user_access)) || $shared_admin_details['user_type'] == 'admin')       
                <a href="javascript:void(0)" class="btn btn-link btn-danger btn-just-icon like" title="Delete Multiple" onclick="check_multi_action('frm_manage','delete')"><i class="material-icons">delete_forever</i></a>
                @endif

                <a href="{{ Request::url() }}" class="btn btn-link btn-primary btn-just-icon" title="Refresh"><i class="material-icons">autorenew</i></a>
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
                                <th>Title</th>
                                <th>User Type</th>
                                <th>Broadcast Date</th>
                                <th>Created Date</th>
                                <th>Progress Status</th>
                                @if( ($arr_current_user_access != null && count($arr_current_user_access) > 0 && array_key_exists('newsletter.delete', $arr_current_user_access)) || $shared_admin_details['user_type'] == 'admin')       
                                    <th>Status</th>
                                    <th>Action</th>
                                @endif
                            </tr>
                        </thead>             
                        <tbody>

                        </tbody>
                    </table>
              </div>
            </form>  
        </div>
        
      </div>
      
    </div>
    
  </div>
  
</div>
</div>

<script type="text/javascript">
    function delete_record(id)
    {
        swal({
            title: "Are you sure",
            text: "Do you want to remove this user from subscriber list?",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, remove it!",
            closeOnConfirm: false
        },
        function(){
            location.href = "{{url($module_url_path)}}/delete/"+id;
        });
    }
</script>

<script>
$(document).ready(function() {
    var search_keyword       = $('#search_keyword').val();
    var module_url_path = "{{ url($parent_module_url) }}";
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
        ajax : {
                    'url'  : temp_url,
                    'data' : { 'search_keyword': search_keyword  }
                },
        "columnDefs" : [
                            { orderable : false, targets: [0, 6] }
                        ],
        "aaSorting" : []
    });

    var table = $('#datatable').DataTable();

    // Delete a record
    table.on('click', '.remove', function(e) {
        $tr = $(this).closest('tr');
        table.row($tr).remove().draw();
        e.preventDefault();
    });
});
</script>
@endsection
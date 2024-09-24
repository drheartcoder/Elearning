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

          <?php
              $first_name = Request::input('first_name');
              $last_name  = Request::input('last_name');
              $email      = Request::input('email');
              $mobile     = Request::input('mobile');
            ?>

      		<form name="frm-manage" id="frm-manage" method="get" action="{{$module_url_path}}" class="form-horizontal" >
                <h4 class="title"></h4>
        		<div class="row">
                    <div class="col-md-3">
                        <div class="form-group has-default bmd-form-group is-filled">
                            <label class="bmd-label-floating">First Name </label>
                            <input type="text" name="first_name" id="first_name"  class="form-control" value="{{ $first_name or '' }}" >
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group has-default bmd-form-group is-filled">
                            <label class="bmd-label-floating">Last Name </label>
                            <input type="text" name="last_name" id="last_name"  class="form-control" value="{{ $last_name or '' }}" >
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group has-default bmd-form-group is-filled">
                            <label class="bmd-label-floating">Email </label>
                            <input type="text"  id="email" name="email" class="form-control" value="{{ $email }}">
                        </div>
                    </div>    
                    <div class="col-md-3">
                        <div class="form-group has-default bmd-form-group is-filled">
                            <label class="bmd-label-floating">Contact No </label>
                            <input type="text" id="mobile" name="mobile" class="form-control" value="{{ $mobile }}">
                        </div>
                    </div>    
                    <div class="col-md-6" style="margin: 0 0 30px;">
                        <button type="submit" class="btn btn-rose">Search</button>
                        <a href="{{ $module_url_path }}" class="btn btn-default">Clear</a>
                    </div>
                </div>
      		</form> 
      		<div class="clearfix"></div>
            <form name="frm_manage" id="frm_manage" method="POST" class="form-horizontal" action="{{url($module_url_path)}}/multi_action">
            {{csrf_field()}}  
              <input type="hidden" name="multi_action" id="multi_action">
            <div class="toolbar">           

              @if($arr_current_user_access!=null && count($arr_current_user_access)>0 && array_key_exists('contact_enquiry.delete', $arr_current_user_access)) || $shared_admin_details['user_type'] == 'admin')       
              <a href="javascript:void(0)" class="btn btn-link btn-danger btn-just-icon like" title="Delete Multiple" onclick="check_multi_action('frm_manage','delete')"><i class="material-icons">delete_forever</i></a>
              @endif

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
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Phone Code</th>
                        <th>Contact No.</th>
                        <th>Subject</th>
                        <th style="min-width: 140px;">Message</th>
                        <th style="min-width: 100px;">Action</th>
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

<script>
$(document).ready(function() {
    var first_name      = $('#first_name').val();
    var last_name       = $('#last_name').val();
    var email           = $('#email').val();
    var mobile          = $('#mobile').val();

    var module_url_path = "{{url($module_url_path)}}";
    var temp_url        = module_url_path+'/load_data';

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
      'data'    : {'first_name':first_name,'last_name':last_name,'email':email,'mobile':mobile}
    },
    "columnDefs" : [
      { orderable : false, targets: [0,7] }
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
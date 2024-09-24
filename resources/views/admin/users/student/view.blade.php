
@extends('admin.layout.master')    
@section('main_content')
<!-- Page header -->
@include('admin.layout.breadcrumb')  
<!-- /page header -->

<!-- BEGIN Main Content -->

<!-- Content area -->
<div class="content">
    <div class="card-body-section">  
    <div class="card">
       <div class="card-header card-header-icon card-header-rose">
            <div class="card-icon">
                <i class="fa fa-envelope-square"></i>
            </div>
            <h4 class="card-title">{{ $sub_module_title or '' }}</h4>
        </div>            

    <div class="card-body">
        <fieldset class="content-group">
            
            <div class="program-details-main">
                <div class="program-details-head">
                    Student Details
                </div>

                <input type="hidden" id="student_id" name="student_id" value="{{ isset($arr_data['id']) ? $arr_data['id'] : '' }}">

                <div class="border-bottom padding-10">
                    <div class="row">
                        <div class="col-sm-6 col-md-6 col-lg-6">
                            <div class="program-details-section">
                                <div class="program-head">
                                    <b>Pin <span>:</span> </b> 
                                </div>
                                <div class="program-content-txt">
                                    {{ isset($arr_data['pin']) ? $arr_data['pin'] : '-' }}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6">
                            <div class="program-details-section">
                                <div class="program-head">
                                    <b>Name <span>:</span></b>
                                </div>
                                <div class="program-content-txt">
                                    {{ isset($arr_data['first_name']) && $arr_data['last_name'] ? ucfirst($arr_data['first_name'])." ".ucfirst($arr_data['last_name']) : ''}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="border-bottom padding-10">
                    <div class="row">
                        <div class="col-sm-6 col-md-6 col-lg-6">
                            <div class="program-details-section">
                                <div class="program-head">
                                    <b>Enrollment Code <span>:</span></b>
                                </div>
                                <div class="program-content-txt">
                                    {{ isset($arr_data['enrollment_code']) ? $arr_data['enrollment_code'] : '' }}
                                </div>
                            </div>
                        </div>                        
                        <div class="col-sm-6 col-md-6 col-lg-6">
                            <div class="program-details-section">
                                <div class="program-head">
                                    <b>Registration Date <span>:</span></b>
                                </div>
                                <div class="program-content-txt">
                                    {{ isset($arr_data['created_at']) ? get_added_on_date_time($arr_data['created_at']) : '' }}
                                </div>
                            </div>
                        </div>                        
                    </div>
                </div>
            </div>
            
            <div class="program-details-main">
                <div class="program-details-head">
                    Parent Details
                </div>

     
                <div class="border-bottom padding-10">
                    <div class="row">
                        <div class="col-sm-6 col-md-6 col-lg-6">
                            <div class="program-details-section">
                                <div class="program-head">
                                    <b>Name <span>:</span> </b> 
                                </div>
                                <div class="program-content-txt">
                                    {{ $arr_data['student_details']['parent_data']['first_name'] or '' }}
                                    {{ $arr_data['student_details']['parent_data']['last_name'] or '' }}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6">
                            <div class="program-details-section">
                                <div class="program-head">
                                    <b>Email id <span>:</span></b>
                                </div>
                                <div class="program-content-txt">
                                   {{ isset($arr_data['student_details']['parent_data']['email']) ? $arr_data['student_details']['parent_data']['email'] : '' }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="border-bottom padding-10">
                    <div class="row">
                        <div class="col-sm-6 col-md-6 col-lg-6">
                            <div class="program-details-section">
                                <div class="program-head">
                                    <b>Mobile Number <span>:</span></b>
                                </div>
                                <div class="program-content-txt">
                                     {{ isset($arr_data['student_details']['parent_data']['contact']) ? $arr_data['student_details']['parent_data']['contact'] : '' }}
                                </div>
                            </div>
                        </div>                        
                                
                    </div>
                </div>
            </div>

            <br>
            <div class="form-group text-center">
              <div class="col-lg-12">
                <a href="{{$module_url_path}}" class="btn btn-rose pull-right">Back</a>
              </div>
            </div>
        </fieldset>
    </div>
    </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary card-header-icon">
              <div class="card-icon">
                <!-- <i class="material-icons">assignment</i> -->
                <i class="{{ $program_module_icon or ''}}"> </i>
              </div>
              <h4 class="card-title">{{ $program_module_title or '' }}</h4>
            </div>
            <div class="card-body">

                @include('admin.layout._operation_status')

                <?php $keyword = Request::input('keyword'); $search_date = Request::input('search_date'); ?>

                <form name="frm-manage" id="frm-manage" method="get" action="{{ $program_module_url }}" class="form-horizontal" >

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
                              <input type="text" name="search_date" id="search_date"  class="form-control datepicker" data-rule-required="true" data-rule-maxlength="60" value="{{ $search_date or '' }}" >
                              <span class="error">{{ $errors->first('search_date') }} </span>
                           </div>
                        </div>
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-rose">search</button>
                            <a href="{{ $program_module_url }}" class="btn btn-default">Clear</a>
                        </div>
                    </div>
                </form> 
                <div class="clearfix"></div>

                <form class="form-horizontal" id="frm_manage" name="frm_manage" action="{{ $program_module_url }}/multi_action" method="post">
                {{csrf_field()}}
                  <input type="hidden" name="multi_action" id="multi_action">
                  <div class="toolbar">

                    <!-- <a href="javascript:void(0)" class="btn btn-link btn-warning btn-just-icon like" title="Deactivate Multiple" onclick="check_multi_action('frm_manage','deactivate')"><i class="material-icons">lock</i></a>

                    <a href="javascript:void(0)" class="btn btn-link btn-success btn-just-icon like" title="Activate Multiple" onclick="check_multi_action('frm_manage','activate')"><i class="material-icons">lock_open</i></a>

                    <a href="javascript:void(0)" class="btn btn-link btn-danger btn-just-icon like" title="Delete Multiple" onclick="check_multi_action('frm_manage','delete')"><i class="material-icons">delete_forever</i></a> -->

                    <a href="{{ $program_module_url }}" class="btn btn-link btn-primary btn-just-icon like" title="Refresh"><i class="material-icons">autorenew</i></a>

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
                            <th>Program Name</th>
                            <th>Assign By</th>
                            <th>Name</th>
                            <th>Assign Date</th>
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

<script>
$(document).ready(function() {
    var keyword         = $('#keyword').val();
    var search_date     = $('#search_date').val();
    var student_id      = $('#student_id').val();
    var module_url_path = "{{ url($module_url_path) }}";
    var temp_url        = module_url_path + '/load-programs';
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
            'data' : { 'keyword':keyword,'search_date':search_date, 'student_id':student_id }
        },
        "columnDefs" : [
            { orderable : false, targets: [0,5,6] }
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

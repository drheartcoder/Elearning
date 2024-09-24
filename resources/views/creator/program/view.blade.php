@extends('creator.layout.master') @section('main_content')
<!-- Page header -->
@include('creator.layout.breadcrumb')
<!-- /page header -->
<!-- @include('creator.layout.breadcrumb') -->
<style type="text/css">  
  input{cursor: pointer;}

  .breadcrumb ul li{display:inline-block;}
  .pagination-dv {text-align: center;}
   .pagination-dv ul li{display: inline-block; padding: 5px 10px;}
  }
  .pagination-dv ul li a{  display: block; color: #0f6bb0; font-weight: normal;}
   .pagination-dv ul li a:hover{color: #333;}
   .pagination-dv .pagination{float: right;}
</style>
<!-- <ul class="breadcrumb">
  <li class="{{isset($module_title) && !empty($module_title) ? '' : 'active'}}">
      @if(isset($module_title) && !empty($module_title))
          <a href="{{isset($module_title) && isset($parent_module_url) ? $parent_module_url : 'javascript:void(0)'}}">
            <i class="{{$parent_module_icon or ''}}"></i> {{$parent_module_title or ''}}
            <span class=""><i class="fa fa-angle-right"></i> </span>
          </a>
      @else
          <i class="{{$parent_module_icon or ''}}"></i> {{$parent_module_title or ''}}
      @endif
  </li>
  <li class="{{isset($module_title) && !empty($module_title) ? '' : 'active'}}">
          <a href="{{ $module_url_path }}">
            <i class="fa fa-tasks"></i> Manage Program
            <span class=""><i class="fa fa-angle-right"></i> </span>
          </a>
  </li>
  @if(isset($module_title) && !empty($module_title))
      <li class="">
        <i class="fa fa-plus"> </i> {{$module_title or ''}}
      </li>
  @endif
</ul> -->
<!-- /page header -->
<style type="text/css">
  .form-back-button{position: absolute;top: -15px;right: 0;z-index: 9;}
</style>
<script src="{{url('/')}}/js/admin/jquery.form.js"></script> 
<!-- Content area -->

   <?php $student_assign_program = false; ?>
  @if(isset($arrProgram['student_assign_program']) && sizeof($arrProgram['student_assign_program'])>0)
    <?php $student_assign_program = true; ?>
  @endif

<div class="content" style="position: relative;">
<a href="{{ $base_module_url_path }}" class="btn btn-rose form-back-button">Back</a>
<div class="panel panel-flat">
<div class="container-fluid">
   <div class="row">
      <div class="col-xl-8">
        <div class="card">
          <div class="card-header card-header-icon card-header-rose">
            <div class="card-icon">
              <i class="material-icons">assignment</i>
            </div>
            <h4 class="card-title ">Program Details : {{ (isset($arrProgram['name']) && $arrProgram['name']!='') ? $arrProgram['name'] : 'NA' }}  </h4>
              @if($student_assign_program==false || $arrProgram['approve_status']=='pending')
            <a class="btn btn-link btn-warning btn-just-icon like program-edit-btn" href="{{ $base_module_url_path.'/edit/'.base64_encode($arrProgram['id']) }}" title="Edit"><i class="material-icons" >create</i> <span>Edit</span></a>
            @endif
             <div class="clearfix"></div>

          </div>

          <div class="card-body">
            <!-- <div class="row"> -->
                <!-- <div class="col-sm-7 col-md-7 col-lg-7"> -->
                    <div class="program-details-main">
                        <div class="program-details-head">
                            Details
                        </div>
                        <div class="border-bottom padding-10">
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <div class="program-details-section">
                                        <div class="program-head">
                                            <b>Name <span>:</span></b>
                                        </div>
                                        <div class="program-content-txt">
                                            {{ (isset($arrProgram['name']) && $arrProgram['name']!='') ? $arrProgram['name'] : 'NA' }}
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
                                            <b>Subject <span>:</span> </b> 
                                        </div>
                                        <div class="program-content-txt">
                                            @if(isset($arrProgram['subject_data']))
                                              @if(count($arrProgram['subject_data']) > 0)
                                                @if(isset($arrProgram['subject_data']['name']))
                                                  {{ $arrProgram['subject_data']['name'] }}
                                                @endif    
                                              @endif  
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="program-details-section">
                                        <div class="program-head">
                                            <b>Approve Status <span>:</span></b>
                                        </div>
                                        <div class="program-content-txt">
                                            @if(isset($arrProgram['approve_status']))
                                              {{ ucfirst($arrProgram['approve_status']) }}
                                              <?php
                                              $userName = $userType = $reason = $reasonDate = '';
                                              if($arrProgram['approve_status']=='disapproved' )
                                              {
                                                if(isset($arrProgram['program_reason_data']))
                                                {

                                                  if(count($arrProgram['program_reason_data']) > 0)
                                                  {
                                                    if(isset($arrProgram['program_reason_data'][0]['reason']))
                                                    {
                                                      $reason = $arrProgram['program_reason_data'][0]['reason'];
                                                    }
                                                    if(isset($arrProgram['program_reason_data'][0]['created_at']))
                                                    {
                                                      $reasonDate = date('dS M,Y', strtotime($arrProgram['program_reason_data'][0]['created_at']));
                                                    }
                                                    if(isset($arrProgram['program_reason_data'][0]['user_data']))
                                                    {
                                                      if(count($arrProgram['program_reason_data'][0]['user_data']) > 0)
                                                      {
                                                        if(isset($arrProgram['program_reason_data'][0]['user_data']['first_name']))
                                                        {
                                                          $userName = $arrProgram['program_reason_data'][0]['user_data']['first_name'];
                                                        }
                                                        if(isset($arrProgram['program_reason_data'][0]['user_data']['last_name']))
                                                        {
                                                          $userName.=' '.$arrProgram['program_reason_data'][0]['user_data']['last_name'];
                                                        }
                                                        if(isset($arrProgram['program_reason_data'][0]['user_data']['user_type']))
                                                        {
                                                          $userType = ucfirst($arrProgram['program_reason_data'][0]['user_data']['user_type']);
                                                        }
                                                      }
                                                    }
                                                  }
                                                }
                                                if($userName!='' && $userType!='' && $reason!='' && $reasonDate!='')
                                                {
                                                  ?>
                                                    <a href="javascript:void(0);" class="viewReason" data-userName="{{ $userName }}" data-userType="{{ $userType }}" data-reason="{{ $reason }}" data-reasonDate="{{ $reasonDate }}" ><i class="fa fa-eye"></i></a>
                                                  <?php
                                                }
                                              }
                                              ?>
                                            @endif
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
                                            <b>Grade <span>:</span></b>
                                        </div>
                                        <div class="program-content-txt">
                                            @if(isset($arrProgram['grade_data']))
                                              @if(count($arrProgram['grade_data']) > 0)
                                                @if(isset($arrProgram['grade_data']['name']))
                                                  {{ $arrProgram['grade_data']['name'] }}
                                                @endif    
                                              @endif  
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="program-details-section">
                                        <div class="program-head">
                                            <b>Status <span>:</span></b>
                                        </div>
                                        <div class="program-content-txt">
                                            @if(isset($arrProgram['status']))
                                              @if($arrProgram['status']==1)
                                                Active
                                              @else
                                                Inactive
                                              @endif  
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="border-bottom padding-10 border-none">
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <div class="program-details-section">
                                        <div class="program-head">
                                            <b>Description <span>:</span></b>
                                        </div>
                                        <div class="program-content-txt">
                                            @if(isset($arrProgram['description']))
                                              {{ $arrProgram['description'] }}
                                            @endif
                                        </div>
                                    </div>
                                </div>                        
                            </div>
                        </div>
                        <span>
                          <a style="float:right;" href="{{ $base_module_url_path.'/material/'.base64_encode($programId) }}" class="btn btn-fill btn-rose" > <i class="fa fa-eye"></i> Material</a>
                          <a style="float:right;" href="{{ $base_module_url_path.'/homework/'.base64_encode($programId) }}" class="btn btn-fill btn-rose" > <i class="fa fa-eye"></i> Homework</a>
                        </span>
                    </div> 
          </div>
        </div>
      </div>
      <div class="col-xl-4">
        <div class="card">
          <div class="card-header card-header-icon card-header-rose">
            <div class="card-icon">
              <i class="material-icons">assignment</i>
            </div>
            <h4 class="card-title ">Lessons </h4>
          </div>
          <div class="card-body">
              <div class="material-datatables" style="height: 298px;overflow: auto;">
                <table id="datatables2" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                  <thead>
                    <tr class="border-solid">
                      <th>Lesson</th>
                      <th>Action</th>
                    </tr>
                  </thead>             
                  <tbody>
                    <?php
                    if(count($arrLesson) > 0)
                    {
                      foreach ($arrLesson as $arrLessonVal)
                      {
                        $viewUrl = 'javascript:void(0);';
                        if(isset($arrLessonVal['id']) && $arrLessonVal['id']!='')
                        {
                          $viewUrl = $base_module_url_path.'/lesson/view/'.base64_encode($programId).'/'.base64_encode($arrLessonVal['id']);
                        }
                        ?>
                        <tr>
                          <td>{{ (isset($arrLessonVal['name']) && $arrLessonVal['name']!='') ? ucwords($arrLessonVal['name']) : 'NA' }}</td>
                          <td>
                            <a href="{{ $viewUrl }}"><i class="fa fa-eye"></i></a>
                          </td>
                        </tr>
                        <?php
                      }
                    }
                    else
                    {
                      ?>
                      <tr class="odd"><td valign="top" colspan="2" class="dataTables_empty" style="text-align: center;">No data available in table</td></tr>
                      <?php
                    }
                    ?>
                  </tbody>
                </table>
              </div>
          </div>
        </div>
      </div>

      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary card-header-icon">
            <h4 class="card-title">Questions</h4>
            <a style="float:right;" href="{{ $base_module_url_path.'/create/'.base64_encode($programId) }}" class="btn btn-fill btn-rose" >+ Add Question</a><!-- title="Add Question" -->
           @if(isset($arrQuestion) && count($arrQuestion) > 0)
              <a style="float:right;" href="{{ $base_module_url_path.'/export/'.base64_encode($programId) }}" class="btn btn-fill btn-rose" >Export</a>
           @endif

          </div>
          <div class="card-body">
            @include('creator.layout._operation_status')
            <?php
              $keyword = Request::input('keyword');
            ?>
            <div class="clearfix"></div>
              
              <form class="form-horizontal" id="frmView" name="frmView" method="get">
              {{csrf_field()}}  
              <div class="toolbar">            
                <!-- <a href="{{ $base_module_url_path.'/create/'.base64_encode($programId) }}" class="btn btn-fill btn-rose" title="Add">+ Add Question</a> -->
              </div>
              <div class="material-datatables">
                <table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                  <thead>
                    <tr class="border-solid">
                      <th>Question</th>
                      <th>Lesson</th>
                      <th>Question Number</th>
                      <th>Template</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>             
                  <tbody>
                  <?php
                  if(count($arrQuestion) > 0)
                  {
                    if(count($arrQuestion['data']) > 0)
                    {
                      $lessonName = 'NA';
                      $lastLessonName = '';
                      $count = 1;
                      foreach ($arrQuestion['data'] as $lesson_no => $arrQuestionVal)
                      {
                        $strQuestion = 'NA';
                        if(isset($arrQuestionVal['lesson_data']))
                        {
                          if(count($arrQuestionVal['lesson_data']) > 0)
                          {
                            if(isset($arrQuestionVal['lesson_data']['name']) && $arrQuestionVal['lesson_data']['name']!='')
                            {
                              $lessonName = ucwords($arrQuestionVal['lesson_data']['name']);
                            }
                          }
                        }
                        $questionStatus = '';
                        $arrQuestion = [];
                        if( (isset($arrQuestionVal['template_id']) && $arrQuestionVal['template_id']!='') && (isset($arrQuestionVal['question_id']) && $arrQuestionVal['question_id']!='') )
                        {
                          $arrQuestion = getQuestionInfo($arrQuestionVal['template_id'],$arrQuestionVal['question_id']);
                        }
                        if(count($arrQuestion) > 0)
                        {
                          if(isset($arrQuestion['question']) && $arrQuestion['question']!='')
                          {
                            $strQuestion = $arrQuestion['question'];
                          }
                          if(isset($arrQuestion['status']) && $arrQuestion['status']!='')
                          {
                            $questionStatus = $arrQuestion['status'];
                          }
                        }
                        ?>
                        <tr>
                          <td>{{ $strQuestion }}</td>
                          <td>{{ $lessonName }}</td>
                          <td>
                            @if($lastLessonName==$lessonName && $lastLessonName!='')
                            @else
                              <?php $count = 1; ?>
                            @endif
                              {{$count++}}
                          </td>
                          <td>{{ (isset($arrQuestionVal['template_id']) && $arrQuestionVal['template_id']!='') ? $arrQuestionVal['template_id'] : 'NA' }}</td>
                          <td>
                            @if($questionStatus=='0')
                              <a class="btn btn-link btn-warning btn-just-icon like" title="Deactive" href="{{ $module_url_path.'/activate/'.$arrQuestionVal['template_id'].'/'.base64_encode($arrQuestionVal['question_id']) }}" onclick="return confirm_action(this,event,'Do you really want to Activate this record ?')" ><i class="material-icons">lock</i></a>
                            @elseif($questionStatus=='1')
                              <a class="btn btn-link btn-success btn-just-icon like" title="Active" href="{{ $module_url_path.'/deactivate/'.$arrQuestionVal['template_id'].'/'.base64_encode($arrQuestionVal['question_id']) }}" onclick="return confirm_action(this,event,'Do you really want to Deactivate this record ?')" ><i class="material-icons">lock_open</i></a>
                            @endif
                          </td>
                          <td>
                            <a class="btn btn-link btn-danger btn-just-icon like" href="{{ $base_module_url_path.'/question/edit/'.base64_encode($programId).'/'.$arrQuestionVal['template_id'].'/'.base64_encode($arrQuestionVal['question_id']) }}" title="Edit"><i class="material-icons">edit</i></a>
                            <a class="btn btn-link btn-danger btn-just-icon like" href="{{ $module_url_path.'/delete/'.$arrQuestionVal['template_id'].'/'.base64_encode($arrQuestionVal['question_id']) }}" onclick="return confirm_action(this,event,'Do you really want to Delete this record ?')" title="Delete"><i class="material-icons">delete_forever</i></a>
                          </td>
                        </tr>
                        <?php
                        if($lessonName!='NA')
                        {
                          $lastLessonName = $lessonName;
                        }
                      }
                    }
                    else
                    {
                      ?>
                      <tr class="odd"><td valign="top" colspan="5" class="dataTables_empty" style="text-align: center;">No data available in table</td></tr>
                      <?php
                    }
                  }
                  else
                  {
                    ?>
                      <tr class="odd"><td valign="top" colspan="5" class="dataTables_empty" style="text-align: center;">No data available in table</td></tr>
                    <?php
                  }
                  ?>
                  </tbody>

                </table>
                @if(count($arrQuestionPagination) > 0) <div class="pagination-dv pull-right"> {{ $arrQuestionPagination }} </div> @endif
              </div>
            </form>  
          </div>
          <!-- end content-->
        </div>
        <!--  end card  -->
      </div>

   </div>
</div>
<!-- REason : view [Pop-Up] -->
<div class="modal fade" id="viewReasonModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Reason</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
          <i class="material-icons">clear</i>
        </button>
      </div>
      <div class="modal-body">
        <p id="reasonDiv"></p>
        <div class="form-group bmd-form-group is-filled">
          <label class="label-control" id="userDiv"></label>
          <!-- <input type="text" class="form-control datetimepicker" value="07/02/2018"> -->
          <p id="dateDiv"></p>
          <span class="material-input"></span>
          <span class="material-input"></span>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-link" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">

  $(document).on('click', '.viewReason', function(){
    var userName   = $(this).attr('data-userName');
    var userType   = $(this).attr('data-userType');
    var reason     = $(this).attr('data-reason');
    var reasonDate = $(this).attr('data-reasonDate');

    $('#viewReasonModal').modal();
    $('#reasonDiv').html(reason);
    $('#userDiv').html(userName+' ('+userType+')');
    $('#dateDiv').html(reasonDate);
  });

$(document).ready(function() {
  var keyword         = $('#keyword').val();
    var module_url_path = "{{ url($module_url_path) }}";
    var temp_url        = module_url_path + '/load_data';
    var url             = temp_url.replace(/&amp;/g, '&');

  $('#datatables1').DataTable({
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
      { orderable : false, targets: [0,5,6,7] }
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
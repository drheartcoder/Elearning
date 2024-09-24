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

<style type="text/css">
  .form-back-button{position: absolute;top: -15px;right: 0;}
</style>

<script src="{{url('/')}}/js/admin/jquery.form.js"></script> 
<!-- Content area -->
<div class="content" style="position: relative;">
<a href="{{ $base_module_url_path.'/view/'.base64_encode($programId) }}" class="btn btn-rose form-back-button">Back</a>
<div class="panel panel-flat">
<div class="container-fluid">
   <div class="row">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header card-header-icon card-header-rose">
            <div class="card-icon">
              <i class="material-icons">assignment</i>
            </div>
            <h4 class="card-title ">Lesson Details : {{ (isset($arrLesson['name']) && $arrLesson['name']!='') ? $arrLesson['name'] : 'NA' }}  </h4>
            <!-- <a class="btn btn-link btn-warning btn-just-icon like program-edit-btn lessonEdit" href="javascript:void(0);" title="Edit"><i class="material-icons" >create</i> <span>Edit</span></a> --> 
            <a style="float:right;" href="{{url('/')}}/program-creator/program/create/{{base64_encode($programId)}}/{{ (isset($arrLesson['id']) && $arrLesson['id']!='') ? base64_encode($arrLesson['id']) : '' }}" class="btn btn-fill btn-rose">+ Add Question<div class="ripple-container"></div></a>
            <div class="clearfix"></div>
          </div>
          <div class="card-body">
            
            <div class="alert alert-success alert-success" style="display: none;">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <i class="material-icons">close</i>
              </button>
              <span class="alert-success-msg"><b> Success - </b> </span>
            </div>

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
                                            {{ (isset($arrLesson['name']) && $arrLesson['name']!='') ? $arrLesson['name'] : 'NA' }}
                                        </div>
                                    </div>
                                </div>                        
                            </div>
                        </div>
                        <div class="border-bottom padding-10">
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <div class="program-details-section">
                                        <div class="program-head">
                                            <b>Program <span>:</span></b>
                                        </div>
                                        <div class="program-content-txt">
                                            @if(isset($arrLesson['program_data']))
                                              @if(count($arrLesson['program_data']) > 0)
                                                @if(isset($arrLesson['program_data']['name']))
                                                  {{ $arrLesson['program_data']['name'] }}
                                                @endif    
                                              @endif  
                                            @endif
                                        </div>
                                    </div>
                                </div>                        
                            </div>
                        </div>
                        <div class="border-bottom padding-10">
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <div class="program-details-section">
                                        <div class="program-head">
                                            <b>No Of Questions <span>:</span></b>
                                        </div>
                                        <div class="program-content-txt">
                                            {{ isset($arrQuestion['total']) && $arrQuestion['total']!=null ? $arrQuestion['total'] : 0 }}
                                        </div>
                                    </div>
                                </div>                        
                            </div>
                        </div>
                    </div> 
          </div>
        </div>
      </div>
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary card-header-icon">
            <h4 class="card-title">Questions</h4>
          </div>
          <div class="card-body">
            @include('creator.layout._operation_status')

            <?php
          $keyword = Request::input('keyword');
        ?>

        <div class="clearfix"></div>
              
              <form class="form-horizontal" id="frmView" name="frmView" method="get">
              {{csrf_field()}}  
                
              <div class="material-datatables">
                <table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                  <thead>
                    <tr class="border-solid">
                      <th>Question Number</th>
                      <th>Question</th>
                      <!-- <th>Lesson</th> -->
                      <th>Template</th>
                      <th>Status</th>
                      <!-- <th>Action</th> -->
                    </tr>
                  </thead>             
                  <tbody>
                  <?php
                  if(count($arrQuestion['data']) > 0)
                  {
                    $lessonName = 'NA';
                    $lastLessonName = '';
                    $count = 1;
                    foreach ($arrQuestion['data'] as $arrQuestionVal)
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
                        <td>
                            @if($lastLessonName==$lessonName && $lastLessonName!='')
                            @else
                              <?php $count = 1; ?>
                            @endif
                              {{$count++}}
                        </td>
                        <td>{{ $strQuestion }}</td>
                        <!--<td>{{ $lessonName }}</td>-->
                        <td>{{ (isset($arrQuestionVal['template_id']) && $arrQuestionVal['template_id']!='') ? $arrQuestionVal['template_id'] : 'NA' }}</td>
                        <td>
                          @if($questionStatus=='0')
                            <a><i class="material-icons">lock</i></a>
                          @elseif($questionStatus=='1')
                            <a><i class="material-icons">lock_open</i></a>
                          @endif
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
                    <tr class="odd"><td valign="top" colspan="3" class="dataTables_empty" style="text-align: center;">No data available in table</td></tr>
                    <?php
                  }
                  ?>
                  </tbody>

                </table>
                  <div class="pagination-dv pull-right"> {{ isset($arrQuestionPagination) && $arrQuestionPagination!=null ? $arrQuestionPagination : "" }} </div>
              </div>
            </form>  
          </div>
          <!-- end content-->
        </div>
        <!--  end card  -->
      </div>

   </div>
</div>
<div class="modal fade" id="lessonEditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <form name="frmLessonEdit" id="frmLessonEdit" action="{{ $base_module_url_path.'/lesson/update/'.base64_encode($programId).'/'.base64_encode($lessonId) }}" method="post">
    {{ csrf_field() }}
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Lesson</h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            <i class="material-icons">clear</i>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group bmd-form-group is-filled">
              <label class="bmd-label-floating">Lesson Name <span class="red">*</span></label>                    
              <div class="form-group">
                <input type="text" name="name" id="name" class="form-control" value="{{ (isset($arrLesson['name']) && $arrLesson['name']!='') ? $arrLesson['name'] : '' }}">
                <span class="error" id="err_name"> @if($errors->has('name')) {{ $errors->first('name') }} @endif</span>
              </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-rose" id="btnUpdateLesson">Update</button>&nbsp;
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </form>
</div>
<script type="text/javascript">
  $(document).on('click', '.lessonEdit', function(){
    $('#lessonEditModal').modal();
  });
  $(document).on('click', '#btnUpdateLesson', function(){
    var name = $('#name').val();
    var flag = 0;

    $('#btnUpdateLesson').attr('disabled', true);

    $('#err_name').html('');

    if(name=='')
    {
      $('#err_name').html('This field is required.');
      flag = 1;
    }

    $('#btnUpdateLesson').attr('disabled', false);

    if(flag == 1)
    {
      return false;
    }
    else
    {
        $("#frmLessonEdit").ajaxSubmit({
           headers:{'X-CSRF-Token': $('input[name="_token"]').val()},
           dataType: 'json',
           beforeSend: function(data, statusText, xhr, wrapper) 
           {
               
           },
           success: function(data, statusText, xhr, wrapper)
           {
               if(data.status == "success")
               {
                  /*$('#lessonEditModal').modal('toggle');*/
                  /*$('.alert-success').show();
                  $('.alert-success-msg').html('<b> Success - </b>Record updated successfully.');*/
                  /*$('#lessonEditModal').modal('toggle');
                  swal('Record updated successfully.')*/
                  window.location.reload();
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
</script>
@endsection
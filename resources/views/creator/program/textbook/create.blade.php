@extends('creator.layout.master')
@section('main_content')
<!-- Page header -->
@include('creator.layout.breadcrumb')
<!-- /page header -->
<!-- BEGIN Main Content -->
<style type="text/css">
  .text-area{ height: 100px !important;  }
  .delete-section-button{font-size: 20px;color: #0f6bb0;display: block;margin-top: 39px;}
</style>
<!-- Content area -->
<div class="content">

  <div class="panel panel-flat">
    <div class="container-fluid">
      <div class="row">
        <div class="card-body-section">
        <div class="card ">
          <div class="card-header card-header-rose card-header-text">
            <div class="card-text">
              <h4 class="card-title">{{ $sub_module_title or '' }}</h4>
            </div>
          </div>
          <form method="post" name="frmProgramCreate" id="frmProgramCreate" action="{{ $module_url_path.'/store' }}" class="form-horizontal" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="card-body">
              @include('creator.layout._operation_status')     
                  
                  <div class="row">
                    <div class="col-lg-6">
                        <label class="bmd-label-floating">Subject <span class="red">*</span></label>                        
                          <div class="form-group">
                          
                          <select name="subject_id" id="subject" class="selectpicker" data-style="select-with-transition" title="Select Subject" data-size="7">
                            @if( isset($arr_program_details['subject_data']) && !empty($arr_program_details['subject_data']) )
                                <option value="{{ $arr_program_details['subject_data']['id'] }}" selected="">{{ $arr_program_details['subject_data']['name'] }}</option>
                            @endif
                          </select>

                          <span class="error" id="err_subject">@if($errors->has('subject')) {{ $errors->first('subject') }} @endif</span>
                        </div>                        
                    </div>
                    <div class="col-lg-6">
                        <label class="bmd-label-floating">Grade <span class="red">*</span></label>                        
                          <div class="form-group">
                          <select name="grade_id" id="grade" class="selectpicker" data-style="select-with-transition" title="Select Grade" data-size="7">
                            @if( isset($arr_program_details['grade_data']) && !empty($arr_program_details['grade_data']) )
                                <option value="{{ $arr_program_details['grade_data']['id'] }}" selected="">{{ $arr_program_details['grade_data']['name'] }}</option>
                            @endif
                          </select>
                          <span class="error" id="err_grade">@if($errors->has('grade')) {{ $errors->first('grade') }} @endif</span>
                        </div>                        
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-lg-6">
                        <label class="bmd-label-floating">Program <span class="red">*</span></label>
                          <div class="form-group">
                          <select name="program_id" id="program" class="selectpicker" data-style="select-with-transition" title="Select Program" data-size="7">
                            @if( isset($arr_program_details) && !empty($arr_program_details) )
                                <option value="{{ $arr_program_details['id'] }}" selected="">{{ $arr_program_details['name'] }}</option>
                            @endif
                          </select>
                          <span class="error" id="err_program">@if($errors->has('program')) {{ $errors->first('program') }} @endif</span>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <label class="bmd-label-floating">Lesson <span class="red">*</span></label>
                          <div class="form-group">
                          <select name="lesson_id" id="lesson" class="selectpicker" data-style="select-with-transition" title="Select Lesson" data-size="7">
                            @if( isset($arr_program_details['lesson_data']) && !empty($arr_program_details['lesson_data']) )
                              @foreach($arr_program_details['lesson_data'] as $lesson)
                                <option value="{{ $lesson['id'] }}" >{{ $lesson['name'] }}</option>
                              @endforeach
                            @endif
                          </select>
                          <span class="error" id="err_lesson">@if($errors->has('lesson')) {{ $errors->first('lesson') }} @endif</span>
                        </div>
                    </div>
                  </div>

                  <div class="row cloneDiv">
                    <div class="col-sm-5">
                          <label class="bmd-label-floating">Textbook Name<span class="red">*</span></label>
                      <div class="form-group textbookWrapper">
                          <input type="text" name="textbookName[]" id="textbookName" class="form-control textbookName" value="">
                          <span class="error" id="err_row">@if($errors->has('textbookName')) {{ $errors->first('textbookName') }} @endif</span>
                      </div>
                    </div>
                    <div class="col-sm-5">
                        <label class="bmd-label-floating">Files [Select multiple files by press <b>ctrl</b>]</label>
                          <div class="form-group upload-block m-b-10">
                              <input type="file" name="files1[]" multiple id="files1" class="uploadFile" style="visibility:hidden; height: 0;position: absolute;" >
                               <div class="input-div">
                                  <input type="text" class="form-control file-caption kv-fileinput-caption uploadFileName" />
                                  <div class="btn btn-primary btn-file"><a class="file" onclick="$('#files1').click();">Browse...</a></div>
                               </div>
                              <span class="error" id="err_files1"> @if($errors->has('files')) {{ $errors->first('files') }} @endif </span>
                          </div>
                          <span class="note-section-block form-note-section mb20"><b>Note :</b> <span>Allowed file types are png, jpg, jpeg, mp4, docx, xlsx, pdf, pptx.</span></span>
                    </div>
                    <div class="col-sm-2">
                      <a href="javascript:void(0)" style="display: none;" class="delete-section-button remove">  <span><i class="fa fa-trash-o"></i></span></a>
                    </div>
                  </div> 
                  <div class="row">
                    <div class="col-sm-10"></div>
                    <div class="col-sm-2">
                          <div class="form-group">
                              <button type="button" class="btn btn-primary addRow">Add</button>
                            <!-- <a href="" class="btn btn-primary">Cancel</a> -->
                          </div>
                    </div>
                  </div>            
                     
            </div>
            <div class="form-group text-center">                
                <div class="col-md-12">
                  <button type="button" name="btnSubmit" id="btnSubmit" class="btn btn-fill btn-rose pull-right">Add Material</button>
                </div>              
                <div class="clearfix"></div>
            </div>
          </form>
        </div>
      </div>
      </div>
    </div>
    
    <script type="text/javascript">
      $(document).on('change', '.uploadFile', function(){
        var uploadFile = $(this).val();
        if(uploadFile!='')
        {
            $(this).closest('.upload-block').find('.uploadFileName').val(uploadFile);
        }
    });

      $('.addRow').click(function(){
        $('.cloneDiv').last().clone().insertAfter($('.cloneDiv').last());
        $('.cloneDiv').last().find('input').val('');
        var len = $('.cloneDiv').length;
        $('.cloneDiv').last().find('.uploadFile').val('');
        $('.cloneDiv').last().find('.uploadFile').attr('id','files'+len);
        $('.cloneDiv').last().find('.uploadFile').attr('name','files'+len+'[]');
        $('.cloneDiv').last().find('.file').attr('onclick','$("#files'+len+'").click();');
        $('.remove').show();
      })

      $(document).on('click','.remove',function(){
        var len = $('.cloneDiv').length;
        if(len==2)
        {
          $('.remove').hide();
          $(this).closest('.cloneDiv').remove();
        }
        else
        {
          $(this).closest('.cloneDiv').remove();
          /*alert($('.cloneDiv').length);*/
          var count = 1;
          $('.cloneDiv').each(function(){
            $(this).find('.uploadFile').attr('id','files'+count);
            $(this).find('.uploadFile').attr('name','files'+count+'[]');
            $(this).find('.file').attr('onclick','$("#files'+count+'").click();');
            console.log(count);
            count++;
          });
        }
      })

    $(document).on('click', '#btnSubmit', function(){
      var textbookName = $('input[name="textbookName[]"]').val();
      var flag         = 0;

      var subject      = $("#subject").val();
      var grade        = $("#grade").val();
      var program      = $("#program").val();
      var lesson       = $("#lesson").val();
      var flag         = 0;

      $("#err_subject").html('');
      $("#err_grade").html('');
      $("#err_program").html('');
      $("#err_lesson").html('');

      if($.trim(subject)=='')
      {
        $("#err_subject").html('Subject field is required.');
        flag = 1;
      }
      if($.trim(grade)=='')
      {
        $("#err_grade").html('Grade field is required.');
        flag = 1;
      }
      if($.trim(program)=='')
      {
        $("#err_program").html('Program field is required.');
        flag = 1;
      }
      if($.trim(lesson)=='')
      {
        $("#err_lesson").html('Lesson field is required.');
        flag = 1;
      }      

      $('.textbookName').each(function(){
        $(this).closest('.textbookWrapper').find('.error').html('');
        if($.trim($(this).val()) == '')
        {
           $(this).closest('.textbookWrapper').find('.error').html('This fiels is required');
           flag = 1;
        }
      });

      $(this).attr('disabled', false);
      $(this).html('Add Material');
      if(flag == 1)
      {
        return false;
      }
      else
      {
        $('#frmProgramCreate').submit();
      }
    });

    $(document).on('change', '#subject', function(){
      var subject = $(this).val();
      if(subject!=''){
        $.ajax({
          headers : {'X-CSRF-Token': $('input[name="_token"]').val() },
          url     : '{{ $module_url_path }}/getGrade',
          type    : 'post',
          dataType: 'json',
          data    : {subject:subject},
          success:function(resp){
            if(resp.status=='success')
            {
              if(parseInt(resp.strHTML.length) > 0)
              {
                $('#grade').html(resp.strHTML);
                $('#grade').selectpicker('refresh');
              }
              else
              {
                $('#grade').html('<option value="">No Grade Available</option>');
                $('#grade').selectpicker('refresh');
              }
            }
          },
          error:function(resp){
          }
        })
      }
    });
    </script>
@endsection

@extends('supervisor.layout.master')
@section('main_content')
<!-- Page header -->
@include('supervisor.layout.breadcrumb')  
<!-- /page header -->
<!-- BEGIN Main Content -->
<style type="text/css">
  .text-area{ height: 100px !important;  }
  .form-control.class-textarea{ height: auto;  }
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
          <form method="post" name="frmProgramCreate" id="frmProgramCreate" action="{{ $module_url_path.'/update' }}" class="form-horizontal">
            {{ csrf_field() }}
            <div class="card-body">
              @include('supervisor.layout._operation_status')
                  <div class="row">
                    <div class="col-lg-6">                      
                        <label class="bmd-label-floating">Subject <span class="red">*</span></label>                        
                          <div class="form-group">
                          <select name="subject" id="subject" class="selectpicker" data-style="select-with-transition" title="Select Subject" data-size="7">
                            <?php
                            if(count($arrSubject) > 0)
                            {
                              foreach ($arrSubject as $arrSubjectVal)
                              {
                                ?>
                                <option value="{{ (isset($arrSubjectVal['id'])) ? $arrSubjectVal['id'] : '' }}" <?php if(isset($arrProgram['subject']) && $arrProgram['subject']!=''){ if($arrProgram['subject']==$arrSubjectVal['id']){ echo "selected"; } } ?> >{{ (isset($arrSubjectVal['name'])) ? ucfirst($arrSubjectVal['name']) : '' }}</option>
                                <?php
                              }
                            }
                            ?>
                          </select>
                        </div>
                        <span class="error" id="err_subject">@if($errors->has('subject')) {{ $errors->first('subject') }} @endif</span>
                    </div>

                    <div class="col-lg-6">                       
                        <label class="bmd-label-floating">Grade <span class="red">*</span></label>                        
                          <div class="form-group">
                          <select name="grade" id="grade" class="selectpicker" data-style="select-with-transition" title="Select Grade" data-size="7">
                            <?php
                            if(count($arrGrade) > 0)
                            {
                              foreach ($arrGrade as $arrGradeVal)
                              {
                                ?>
                                <option value="{{ (isset($arrGradeVal['id'])) ? $arrGradeVal['id'] : '' }}" <?php if(isset($arrProgram['grade']) && $arrProgram['grade']!=''){ if($arrProgram['grade']==$arrGradeVal['id']){ echo "selected"; } } ?> >{{ (isset($arrGradeVal['name'])) ? ucfirst($arrGradeVal['name']) : '' }}</option>
                                <?php
                              }
                            }
                            ?>
                          </select>
                        </div>
                        <span class="error" id="err_grade">@if($errors->has('grade')) {{ $errors->first('grade') }} @endif</span>                                              
                    </div>
                  </div>

                  <label class="bmd-label-floating">Name <span class="red">*</span></label>                    
                  <div class="form-group">
                    <input type="text" name="name" id="name" class="form-control" placeholder="Program Name" value="{{ (isset($arrProgram['name']) && $arrProgram['name']!='') ? $arrProgram['name'] : '' }}">
                  </div>
                  <span class="error" id="err_name"> @if($errors->has('name')) {{ $errors->first('name') }} @endif</span>                  
                <label class="bmd-label-floating">Description <span class="red">*</span></label>                    
                  <div class="form-group">
                    <textarea name="description" id="description" class="form-control class-textarea" placeholder="Program Description" rows="5">{{ (isset($arrProgram['description']) && $arrProgram['description']!='') ? $arrProgram['description'] : '' }}</textarea>
                  </div>
                  <span class="error" id="err_description"> @if($errors->has('description')) {{ $errors->first('description') }} @endif</span>                    
                  
            </div>
            <div class="form-group text-center">                
                <div class="col-md-12">
                  <button type="button" name="btnSubmit" id="btnSubmit" class="btn btn-fill btn-rose pull-right">Update Program</button>
                  <button type="button" onclick="window.location.href='{{ $base_module_url_path }}/view/{{ base64_encode($programId) }}'" class="btn btn-fill btn-rose pull-right">Cancel</button>
                </div>              
                <div class="clearfix"></div>                
            </div>
          </form>
        </div>
      </div>
      </div>
    </div>
    
    <script type="text/javascript">

    $(document).on('change', '#subject', function(){
      var subject = $(this).val();
      if(subject!=''){
        $.ajax({
          headers : {'X-CSRF-Token': $('input[name="_token"]').val() },
          url     : '{{ $base_module_url_path }}/getGrade',
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

    $(document).on('click', '#btnSubmit', function(){
      var subject      = $("#subject").val();
      var grade        = $("#grade").val();
      var name         = $("#name").val();
      var description  = $("#description").val();
      var flag         = 0;

      $(this).attr('disabled', true);
      $(this).html('Processing...');

      $("#err_subject").html('');
      $("#err_grade").html('');
      $("#err_name").html('');
      $("#err_description").html('');

      if($.trim(subject)=='')
      {
        $("#err_subject").html('The subject field is required.');
        flag = 1;
      }
      if($.trim(grade)=='')
      {
        $("#err_grade").html('The grade field is required.');
        flag = 1;
      }
      if($.trim(name)=='')
      {
        $("#err_name").html('The name field is required.');
        flag = 1;
      }
      if($.trim(description)=='')
      {
        $("#err_description").html('The description field is required.');
        flag = 1;
      }
      $(this).attr('disabled', false);
      $(this).html('Update Program');
      if(flag == 1)
      {
        return false;
      }
      else
      {
        $('#frmProgramCreate').submit();
      }
    });    
    </script>
  

  @endsection



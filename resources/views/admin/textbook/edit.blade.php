@extends('admin.layout.master')
@section('main_content')
<!-- Page header -->
@include('admin.layout.breadcrumb')
<!-- /page header -->
<!-- BEGIN Main Content -->
<style type="text/css">
  .text-area{ height: 100px !important;  }
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
          <form method="post" name="frmUpdate" id="frmUpdate" action="{{ $base_module_url_path.'/update/'.base64_encode($textbookId) }}" class="form-horizontal" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="card-body">
              @include('admin.layout._operation_status')     
                  
                @php

                $subject_id = isset($arrMaterial['subject_id']) && !empty($arrMaterial['subject_id']) ? $arrMaterial['subject_id'] : '';
                $grade_id   = isset($arrMaterial['grade_id']) && !empty($arrMaterial['grade_id']) ? $arrMaterial['grade_id'] : '';

                @endphp

                  <div class="row">
                    <div class="col-lg-6">
                        <label class="bmd-label-floating">Subject <span class="red">*</span></label>                        
                          <div class="form-group">
                          
                          <select name="subject" id="subject" class="selectpicker" data-style="select-with-transition" title="Select Subject" data-size="7" >
                            @if( isset($arr_subject) && !empty($arr_subject) )
                              @foreach($arr_subject as $subject)
                                <option value="{{ $subject['id'] }}" @if($subject_id == $subject['id']) selected @endif>{{ $subject['name'] }}</option>
                              @endforeach
                            @endif
                          </select>

                          <span class="error" id="err_subject">@if($errors->has('subject')) {{ $errors->first('subject') }} @endif</span>
                        </div>                        
                    </div>
                    <div class="col-lg-6">
                        <label class="bmd-label-floating">Grade <span class="red">*</span></label>                        
                          <div class="form-group">
                          <select name="grade" id="grade" class="selectpicker" data-style="select-with-transition" title="Select Grade" data-size="7">
                            @if( isset($arr_grade) && !empty($arr_grade) )
                              @foreach($arr_grade as $grade)
                                <option value="{{ $grade['id'] }}" @if($grade_id == $grade['id']) selected @endif>{{ $grade['name'] }}</option>
                              @endforeach
                            @endif
                          </select>
                          <span class="error" id="err_grade">@if($errors->has('grade')) {{ $errors->first('grade') }} @endif</span>
                        </div>                        
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-5">
                          <label class="bmd-label-floating">Textbook Name<span class="red">*</span></label>
                      <div class="form-group">
                          <input type="text" name="textbookName" id="textbookName" class="form-control" value="{{ (isset($arrMaterial['name']) && $arrMaterial['name']!='') ? $arrMaterial['name'] : '' }}">
                          <span class="error" id="err_textbookName">@if($errors->has('textbookName')) {{ $errors->first('textbookName') }} @endif</span>
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
                    </div>
                    <div class="col-sm-2">
                      <button style="margin-top: 29px;" type="button" name="btnSubmit" id="btnSubmit" class="btn btn-fill btn-rose pull-right">Update</button>
                    </div>
                  </div>  
                  <?php
                  if(count($arrMaterial) > 0)
                  {
                    if(isset($arrMaterial['textbook_images_data']))
                    {
                      if(count($arrMaterial['textbook_images_data']) > 0)
                      {
                        ?>
                        <div class="row">
                        <?php
                        /*dd($arrMaterial['textbook_images_data']);*/
                        foreach ($arrMaterial['textbook_images_data'] as $arrMaterialVal) {
                          if(isset($arrMaterialVal['file']) && $arrMaterialVal['file']!='')
                          {
                            if(file_exists($textbook_file_base_img_path.$arrMaterialVal['file']))
                            {
                              $fileUrl = $textbook_file_public_img_path.$arrMaterialVal['file'];
                              $fileExt = strtolower(pathinfo($arrMaterialVal['file'], PATHINFO_EXTENSION));
                              $fileDeleteUrl = 'javascript:void(0);';
                              if(isset($arrMaterialVal['id']) && $arrMaterialVal['id']!='')
                              {
                                $fileDeleteUrl = $base_module_url_path.'/deleteFile/'.base64_encode($textbookId).'/'.base64_encode($arrMaterialVal['id']);
                              }
                              ?>
                                <div class="col-sm-2">
                                  <div class="box-content-section @if($fileExt=='txt' || $fileExt=='pdf' || $fileExt=='docx' || $fileExt=='xlsx' || $fileExt=='pptx') doc-icon-section  @endif">
                                      <?php
                                      /*'png','jpg','jpeg','mp4','docx','xlsx','pdf','pptx'*/
                                      if($fileExt=='png' || $fileExt=='jpg' || $fileExt=='jpeg')
                                      {
                                        ?>
                                        <img src="{{ $fileUrl }}" alt="Material" />
                                        <?php
                                      }
                                      else if($fileExt=='mp4')
                                      {
                                        ?>
                                        <video id="video1" controls>
                                            <source src="{{ $fileUrl }}" type="video/mp4"> Your browser does not support HTML5 video.
                                        </video>  
                                        <?php 
                                      }
                                      else if($fileExt=='pdf')
                                      {
                                        ?>
                                        <img src="{{ url( '/' ) }}/images/icon-pdf-file.png" alt="Material" />
                                        <?php 
                                      }
                                      else if($fileExt=='txt')
                                      {
                                        ?>
                                        <img src="{{ url( '/' ) }}/images/icon-txt-text-file.png" alt="Material" />
                                        <?php 
                                      }
                                      else if($fileExt=='docx' || $fileExt=='xlsx' || $fileExt=='pptx')
                                      {
                                        ?>
                                        <img src="{{ url( '/' ) }}/images/icon-doc-file.png" alt="Material" />
                                        <?php 
                                      }
                                      ?>
                                      <div class="action-button-section">
                                          <a href="{{ $fileDeleteUrl }}" onclick="return confirm_action(this,event,'Do you really want to delete this file ?')" ><i class="fa fa-trash-o"></i> </a>
                                          <a href="{{ $fileUrl }}" download><i class="fa fa-download"></i> </a>
                                      </div>
                                  </div>
                              </div>
                              <?php
                            }
                          }
                          
                        }
                        ?>
                        </div>
                        <?php
                      }
                    }
                  }
                  ?>
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

    $(document).on('click', '#btnSubmit', function(){
      var textbookName = $("#textbookName").val();
      var files1       = $('input[name="files1[]"]').val();
      var flag         = 0;

      /*console.log(files1);
      return false;
*/
      $(this).attr('disabled', true);
      $(this).html('Processing...');

      $("#err_textbookName").html('');
      $("#err_files1").html('');

      if($.trim(textbookName)=='')
      {
        $("#err_textbookName").html('This field is required.');
        flag = 1;
      }
      var selection = document.getElementById('files1');
      for (var i=0; i<selection.files.length; i++) {
          var ext = selection.files[i].name.substr(-3);
          if(ext!== "jpg" && ext!== "JPG" && ext!== "jpeg" && ext!== "JPEG" && ext!== "png" && ext!== "PNG" && ext!== "mp4" && ext!== "docx" && ext!== "xlsx" && ext!== "pdf" && ext!== "pptx")  {
              $("#err_files1").html('Invalid file type.');
              flag = 1;
          }
      } 

      $(this).attr('disabled', false);
      $(this).html('Update');

      if(flag == 1)
      {
        return false;
      }
      else
      {
        $('#frmUpdate').submit();
      }
    });

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
    </script>


  @endsection



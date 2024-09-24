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

          <form method="post" name="frmUpdate" id="frmUpdate" action="{{ $base_module_url_path.'/update/'.base64_encode($homeworkId) }}" class="form-horizontal" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="card-body">
              @include('admin.layout._operation_status')     
                  <div class="row">

                    <div class="col-sm-5">
                          <label class="bmd-label-floating">Homework Name<span class="red">*</span></label>
                      <div class="form-group">
                          <input type="text" name="textbookName" id="textbookName" class="form-control" value="{{ (isset($arrHomework['name']) && $arrHomework['name']!='') ? $arrHomework['name'] : '' }}">
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
                          <span class="note-section-block form-note-section mb20"><b>Note :</b> <span>Allowed file types are png, jpg, jpeg, mp4, docx, xlsx, pdf, pptx.</span></span>
                    </div>

                    <div class="col-sm-2">
                      <button style="margin-top: 29px;" type="button" name="btnSubmit" id="btnSubmit" class="btn btn-fill btn-rose pull-right">Update</button>
                    </div>
                  </div>

                  <?php
                  if(count($arrHomework) > 0)
                  {
                    if(isset($arrHomework['homework_images_data']))
                    {
                      if(count($arrHomework['homework_images_data']) > 0)
                      {
                        ?>
                        <div class="row">
                        <?php
                        /*dd($arrHomework['homework_images_data']);*/
                        foreach ($arrHomework['homework_images_data'] as $arrHomeworkVal) {
                          if(isset($arrHomeworkVal['file']) && $arrHomeworkVal['file']!='')
                          {
                            if(file_exists($homework_file_base_img_path.$arrHomeworkVal['file']))
                            {
                              $fileUrl = $homework_file_public_img_path.$arrHomeworkVal['file'];
                              $fileExt = strtolower(pathinfo($arrHomeworkVal['file'], PATHINFO_EXTENSION));
                              $fileDeleteUrl = 'javascript:void(0);';
                              if(isset($arrHomeworkVal['id']) && $arrHomeworkVal['id']!='')
                              {
                                $fileDeleteUrl = $base_module_url_path.'/deleteFile/'.base64_encode($homeworkId).'/'.base64_encode($arrHomeworkVal['id']);
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
          var filename = selection.files[i];
          var ext = filename.name.substr((filename.name.lastIndexOf('.') +1));
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
    </script>

@endsection

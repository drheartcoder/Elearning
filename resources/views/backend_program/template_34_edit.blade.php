@extends($role_slug.'.layout.master')    
@section('main_content')
<!-- BEGIN Main Content -->
<!-- Page header -->
@include($role_slug.'.layout.breadcrumb')  
<!-- /page header -->
<script src="{{url('/')}}/js/admin/jquery.form.js"></script> 
<!-- Content area -->
<div class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="card-body-section">
            <div class="card">
               <div class="card-header card-header-icon card-header-rose">
                  <div class="card-icon">
                     <i class="fa fa-gear"></i>
                  </div>
                  <h4 class="card-title">{{$sub_module_title or ''}}</h4>
               </div>
               <div class="card-body">
                  @include($role_slug.'.layout._operation_status')
                  <form name="frmUpdate" id="frmUpdate" method="post" action="{{ $module_url_path.'/update' }}" enctype="multipart/form-data">
                     {{ csrf_field() }}
                     @if(isset($arrQuestion['file_type']) && $arrQuestion['file_type']!='')
                     <input type="hidden" name="oldFileType" id="oldFileType" value="{{ $arrQuestion['file_type'] }}">
                     @endif
                     <input type="hidden" name="programId" value="{{ $programId }}">
                     <input type="hidden" name="templateId" value="{{ $templateId }}">
                     <input type="hidden" name="questionId" value="{{ $questionId }}">
                     <div class="devSubWrapper">
                        <div class="row">
                           <div class="col-sm-12">
                              <div class="form-group">
                                 <label class="bmd-label-floating">Direction </label>
                                 <input type="text" name="direction" id="direction" class="form-control" value="{{ (isset($arrQuestion['question']) && $arrQuestion['question']!='') ? $arrQuestion['question'] : '' }}" >
                                 <span class="error" id="err_direction"> @if($errors->has('direction')) {{ $errors->first('direction') }} @endif </span>
                              </div>
                           </div>
                           <div class="col-sm-12">
                              <label class="col-form-label">Question File (Image) <span class="red">*</span></label>
                              <div style="position: relative;" class="form-group">
                                 <div class="profile-img-block temp-img-block">
                                    <div class="pro-img">
                                       <?php
                                          $imageUrl = $default_public_img_path.'default.png';
                                          if(isset($arrQuestion['question_file']) && $arrQuestion['question_file']!='')
                                          {
                                            if(file_exists($question_image_base_path.$arrQuestion['question_file']))
                                            {
                                              $imageUrl = $question_image_public_path.$arrQuestion['question_file'];
                                            }
                                          }
                                          ?>
                                       <img src="{{ $imageUrl }}" id="imgFilePreview" class="img-responsive img-preview imgFilePreview" alt=""/>
                                       <input style="height: 100%; width: 100%; z-index: 99;" id="flQuestion" name="flQuestion"  type="file" class="attachment_upload imgFile" data-error="no" />
                                    </div>
                                    <span class="error" id="err_flQuestion"> @if($errors->has('flQuestion')) {{ $errors->first('flQuestion') }} @endif </span>
                                    <span class="note-section-block"><b>Note :</b> <span>Allowed only jpg | jpeg | png, <br/> Upload image greater than or equal to 583 X 560 for best result.</span></span>
                                 </div>
                              </div>
                           </div>
                           <div class="col-sm-12 wrapperDiv1">
                              <div class="row wrapperDiv">
                                 <div class="col-sm-3">
                                    <div class="form-group">
                                       <label class="bmd-label-floating">Digit 1<span class="red">*</span></label>
                                       <input type="text" name="digit1_1" id="digit1_1" class="form-control digit1Common digitCommon" value="<?php if(isset($arrQuestion['digit1_1'])){ echo $arrQuestion['digit1_1']; } ?>" >
                                       <span class="error err_digit1Common" id="err_digit1_1"> @if($errors->has('digit1_1')) {{ $errors->first('digit1_1') }} @endif </span>
                                    </div>
                                 </div>
                                 <div class="col-sm-3">
                                    <div class="form-group has-default bmd-form-group is-filled">
                                       <select class="selectpicker dwCommon operatorCommon" data-rule-required="true" data-style="select-with-transition" name="operator1" id="operator1">
                                          <option value="">Select Sign</option>
                                          <option value="+" <?php if(isset($arrQuestion['operator1']) && $arrQuestion['operator1']=='+'){ echo 'selected'; } ?> >+</option>
                                          <option value="-" <?php if(isset($arrQuestion['operator1']) && $arrQuestion['operator1']=='-'){ echo 'selected'; } ?> >-</option>
                                          <option value="x" <?php if(isset($arrQuestion['operator1']) && $arrQuestion['operator1']=='x'){ echo 'selected'; } ?> >x</option>
                                          <option value="/" <?php if(isset($arrQuestion['operator1']) && $arrQuestion['operator1']=='/'){ echo 'selected'; } ?> >&#247;</option>
                                       </select>
                                       <span class="error err_operatorCommon" id="err_operator1"> @if($errors->has('operator1')) {{ $errors->first('operator1') }} @endif </span>
                                    </div>
                                 </div>
                                 <div class="col-sm-3">
                                    <div class="form-group">
                                       <label class="bmd-label-floating">Digit 2<span class="red">*</span></label>
                                       <input type="text" name="digit1_2" id="digit1_2" class="form-control digit2Common digitCommon" value="<?php if(isset($arrQuestion['digit1_2'])){ echo $arrQuestion['digit1_2']; } ?>" >
                                       <span class="error err_digit2Common" id="err_digit1_2"> @if($errors->has('digit1_2')) {{ $errors->first('digit1_2') }} @endif </span>
                                    </div>
                                 </div>
                                 <div class="col-sm-3">
                                    <div class="form-group">
                                       <!--                                              <label class="bmd-label-floating">Answer<span class="red">*</span></label>-->
                                       <input type="text" name="answer1" placeholder="Answer" style="padding: 8px 10px;" id="answer1" class="form-control answerCommon digitCommon" readonly="readonly" value="<?php if(isset($arrQuestion['answer1'])){ echo $arrQuestion['answer1']; } ?>" >
                                       <span class="error" id="err_answer1"> @if($errors->has('answer1')) {{ $errors->first('answer1') }} @endif </span>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!-- <div class="row">
                           <div class="col-sm-12">      
                             <div class="row">
                                 <div class="col-sm-4">
                                     <?php
                              $hornUrl = '';
                              if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                              {
                                if(file_exists($question_audio_base_path.$arrQuestion['horn']))
                                {
                                  $hornUrl = $question_audio_public_path.$arrQuestion['horn'];
                                }
                              }
                              if($hornUrl!='')
                              {
                                ?>
                                       <audio controls="controls" src="{{ $hornUrl }}"></audio>
                                       <?php
                              }
                              ?>
                                 </div>
                                 <div class="col-sm-8">
                                     <label class="bmd-label-floating col-form-label">Audio (HORN) </label>
                                     <div class="form-group upload-block m-b-10">
                                        <input type="file" id="flHorn" name="flHorn" class="uploadFile" style="visibility:hidden; height: 0;position: absolute;">
                                        <div class="input-div">
                                           <input type="text" class="form-control file-caption  kv-fileinput-caption uploadFileName" />
                                           <div class="btn btn-primary btn-file"><a class="file" onclick="$('#flHorn').click();">Browse...</a></div>
                                        </div>
                                         <span class="error" id="err_flHorn"> @if($errors->has('flHorn')) {{ $errors->first('flHorn') }} @endif </span>      
                                     </div>
                                     <span class="note-section-block form-note-section mb20"><b>Note :</b> <span>Allowed file type mp3, m4a, wave (Audio) format.</span></span>   
                                 </div>
                             </div>                            
                           </div>
                           </div> -->
                        <div class="row">
                           <div class="col-sm-12">
                              <div class="col-sm-6">
                                 <label class="bmd-label-floating" style="margin-bottom: 0;">Duration </label>                          
                                 <div class="form-group upload-block m-b-10">                        
                                    <?php 
                                       $min = $sec = 0;
                                       if(isset($arrQuestion['duration']) && $arrQuestion['duration']!='')
                                       {
                                          $time = [];
                                          $time = explode(':', $arrQuestion['duration']);
                                          if(count($time)>0) 
                                          {
                                             $min = $time[1]; $sec = $time[2];
                                          }
                                       }
                                       ?>                       
                                    <input type="text" name="duration" id="duration" class="timing" />
                                    <span class="error" id="err_duration"> @if($errors->has('duration')) {{ $errors->first('duration') }} @endif </span>      
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <script type="text/javascript">
                        $('.dwCommon').selectpicker();
                     </script>
                     <button type="button" id="btnShowPreview" class="btn btn-fill btn-rose">Preview</button>
                     <button type="button" id="btnSubmit" class="btn btn-fill btn-rose pull-right">Update</button>
                     <a id="btnCancel" class="btn btn-fill btn-rose pull-right" href="{{ $module_url.'/view/'.base64_encode($programId) }}">Cancel</a>
               </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
</div>
  
  <!-- Template Preview Modal Start  -->
  <div id="popup_template_preview" class="modal fade temp-preview" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="close-temp" onClick="close_popup()" data-dismiss="modal"><img src="{{url('/')}}/images/close.png" alt="close" /></div>
            <div class="modal-body">
                 <span id="resultPreview"></span>
                 <!--<div class="modal-button-section">
                    <button onClick="close_popup()" type="button" class="btn btn-fill btn-rose" data-dismiss="modal">{{trans('home.Ok')}}</button>
                 </div>-->
             </div>
        </div>
    </div>
  </div>

<script type="text/javascript">
   $('.imgFile').change(function(){
       var tempThis = $(this);
       var files = $(this.files);
       imageSizeValidate(tempThis, files, '583', '560');
   });
    function imageSizeValidate (tempThis,files,width,height) 
    {
      var image_height = height || 0;
      var image_width = width || 0;
var max_file_size = 400;
      var file_size     = 0;
      if (typeof files !== "undefined") 
      {
        for (var i=0, l=files.length; i<l; i++) 
        {
              var blnValid = false;
              var ext = files[0]['name'].substring(files[0]['name'].lastIndexOf('.') + 1);
              var file_size =  Math.round((files[0].size/ 1024) * 100) / 100;
              if(ext == "JPEG" || ext == "jpeg" || ext == "jpg" || ext == "JPG" || ext == "png" || ext == "PNG")
              {
                          blnValid = true;
              }
              
              if(blnValid ==false) 
              {
                  showAlert("Sorry, " + files[0]['name'] + " is invalid, allowed extensions are: jpeg , jpg , png","error");
                  $(".fileupload-preview").html("");
                  $(".fileupload").attr('class',"fileupload fileupload-new");
                  $("#image").val('');
                  return false;
              }
              else
              {              
                    var reader = new FileReader();
if(file_size>max_file_size)

                  {
                      swal("Sorry, max "+max_file_size+" Kb size is allowed");
                      
                      $(".imgFile").val('');
                      return false;
                  }
                    reader.readAsDataURL(files[0]);
                    reader.onload = function (e) 
                    {
                      var image = new Image();
                      image.src = e.target.result;
                         
                      image.onload = function () 
                      {
                          var height = this.height;
                          var width = this.width;
                          console.log("current height:"+height+"  validate height:"+image_height );

                          console.log("current width:"+width+" validate width:"+image_width);

                          if (height < image_height || width < image_width ) 
                          {
                              swal("File must be grater than / equal to "+image_width+" X "+image_height);
                              $(".imgFile").val('');
                              return false;
                          }
                          else
                          {
                            var id = tempThis.closest('.profile-img-block').find('.imgFilePreview').attr('id');
                             $('#'+id).attr('src', e.target.result);
                             //swal("Uploaded image has valid Height and Width.");
                             return true;
                          }
                      };
                    }
              }                
          }
      }
      else
      {
        swal("No support for the File API in this web browser" ,"error");
      } 
    }
   $(document).ready(function() {
       $(".digitCommon").keydown(function (e) {
           // Allow: backspace, delete, tab, escape, enter and .
           if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
                // Allow: Ctrl+A, Command+A
               (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
                // Allow: home, end, left, right, down, up
               (e.keyCode >= 35 && e.keyCode <= 40)) {
                    // let it happen, don't do anything
                    return;
           }
           // Ensure that it is a number and stop the keypress
           if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
               e.preventDefault();
           }
       });
   });
   
   $(document).on('blur', '.digit1Common', function(){
       $(this).closest('.wrapperDiv').find('.operatorCommon').trigger('change');
   });
   $(document).on('blur', '.digit2Common', function(){
       $(this).closest('.wrapperDiv').find('.operatorCommon').trigger('change');
   });
   
   $(document).on('change','.operatorCommon', function(){
       var operatorCommon = $(this).val();
       var tempThis = $(this);
       
       if(operatorCommon!='')
       {
           var digit1Common = $(this).closest('.wrapperDiv').find('.digit1Common').val();
           var digit2Common = $(this).closest('.wrapperDiv').find('.digit2Common').val();
           if((digit1Common!=null && digit1Common!='') && (digit2Common!=null && digit2Common!=''))
           {
               if(operatorCommon == '+')
               {
                   var answerCommon = parseInt(digit1Common) + parseInt(digit2Common);
               }
               else if(operatorCommon == '-')
               {
                   var answerCommon = parseInt(digit1Common) - parseInt(digit2Common);
               }
               else if(operatorCommon == 'x')
               {
                   var answerCommon = parseInt(digit1Common) * parseInt(digit2Common);
               }
               else if(operatorCommon == '/')
               {
                   var answerCommon = parseInt(digit1Common) / parseInt(digit2Common);
               }
               tempThis.closest('.wrapperDiv').find('.err_digit1Common').html('');
               tempThis.closest('.wrapperDiv').find('.err_digit2Common').html('');
               tempThis.closest('.wrapperDiv').find('.answerCommon').val(answerCommon);
           }
           else
           {
               tempThis.closest('.wrapperDiv').find('.err_digit1Common').html('');
               if(digit1Common=='')
               {
                   tempThis.closest('.wrapperDiv').find('.err_digit1Common').html('This field is required');
               }
               tempThis.closest('.wrapperDiv').find('.err_digit2Common').html('');
               if(digit2Common=='')
               {
                   tempThis.closest('.wrapperDiv').find('.err_digit2Common').html('This field is required');
               }    
           }
       }
       else
       {
           var digit1Common = $(this).closest('.wrapperDiv').find('.digit1Common').val();
           var digit2Common = $(this).closest('.wrapperDiv').find('.digit2Common').val();   
           if(digit1Common=='' || digit2Common=='')
           {
             tempThis.closest('.wrapperDiv').find('.answerCommon').val('');
           }
           return false;
       }
   });
   function validateForm(){
       var direction = $('#direction').val();
       var flQuestion = $('#flQuestion').val();
       var flQuestionExt = flQuestion.substring(flQuestion.lastIndexOf('.')+1);
       var digit1_1 = $('#digit1_1').val();
       var operator1 = $('#operator1').val();
       var digit1_2 = $('#digit1_2').val();
       var answer1 = $('#answer1').val();
       /*var flHorn   = $('#flHorn').val();
       var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);*/
   
       var minute      = $('input[name="minute"]').val();
       var second      = $('input[name="second"]').val();
       var duration    = parseInt(minute)*60 + parseInt(second);
   
       var flag = 0;
   
       $('#err_direction').html('');
       $('#err_flQuestion').html('');
       $('#err_digit1_1').html('');
       $('#err_operator1').html('');
       $('#err_digit1_2').html('');
       $('#err_answer1').html('');
       /*$('#err_flHorn').html('');*/
       $('#err_duration').html('');
   
        if($.trim(direction)=='')
        {
           $('#err_direction').html('This field is required.');
           flag = 1;  
        }
   
        if(flQuestion != '')
        {
           if(!(flQuestionExt == "jpg" || flQuestionExt == "jpeg" || flQuestionExt == "gif" || flQuestionExt == "png" || flQuestionExt == "GIF" || flQuestionExt == "JPG" || flQuestionExt == "JPEG" || flQuestionExt == "PNG"))
            {
                $('#err_flQuestion').html('Invalid file type.');
                flag=1;
            }
            else if($('#flQuestion').attr('data-error')=='yes')
            {
               $('#err_flQuestion').html('File must be grater than / equal to 583 X 560.');
               flag=1;  
            }  
        }
   
        if($.trim(digit1_1)=='')
        {
           $('#err_digit1_1').html('This field is required.');
           flag=1;
        }
        else if(isNaN(digit1_1))
        {
           $('#err_digit1_1').html('Invalid field value.');
           flag=1;
        }
        if($.trim(operator1)=='')
        {
           $('#err_operator1').html('This field is required.');
           flag=1;
        }
        if($.trim(digit1_2)=='')
        {
           $('#err_digit1_2').html('This field is required.');
           flag=1;
        }
        else if(isNaN(digit1_2))
        {
           $('#err_digit1_2').html('Invalid field value.');
           flag=1;
        }
        if($.trim(answer1)=='')
        {
           $('#err_answer1').html('This field is required.');
           flag=1;
        }
        else if(isNaN(answer1))
        {
           $('#err_answer1').html('Invalid field value.');
           flag=1;
        }
   
        /*if(flHorn != '')
        {
           if(!(flHornExt == "mp3" || flHornExt == "MP3" || flHornExt == "wave"))
            {
                $('#err_flHorn').html('Invalid file type.');
                flag = 1;
            }    
        }*/
   
        if($.trim(duration)=='' || parseInt(duration)==0)
        {
           $('#err_duration').html('This field is required.');
           flag = 1;
        }
        else if(isNaN(duration))
        {
           $('#err_duration').html('Invalid time.');
           flag = 1;
        }
   
        if(flag==1)
        {
         return false;
        }
        else
        {
          $('#duration').val(duration);
          return true;
        }
   }

     $('#btnSubmit').click(function(){
      
        var flag = validateForm();
        if(flag==true)
        {
           $('#frmUpdate').submit();
        }
        else
        {
          return false;
        }

   })

  $('#btnShowPreview').click(function(){
    var flag = validateForm();
    if(flag==true)
    {
          var programId = '{{base64_encode($programId)}}';
          var formData = new FormData($("#frmUpdate")[0]);
          $.ajax({
            type:"POST",
            url:'{{ url('/') }}/edit_template_preview/'+programId,
            data:formData,
            processData: false,
            contentType: false,
            cache: false,
            success: function(response){
                if(response.status=='success'){
                  $('#resultPreview').html('');
                  $('#resultPreview').html(response.view);
                  $('#popup_template_preview').modal({
                      backdrop: 'static',
                      keyboard: false,
                      show: true
                  });
                }
              }
          });
    }
    else
    {
      return false;
    }
 })
 
 function close_popup(){
   $('html').addClass('perfect-scrollbar-on');
     $('.modal-backdrop').removeClass('dark-bg');     
 }

  /*dynamic height script*/
	$( "#popup_template_preview" ).on('shown.bs.modal', function(){
        $('html').removeClass('perfect-scrollbar-on');
        $('.modal-backdrop').addClass('dark-bg');
        if($(".game-img-section").height() != 'undefined')
        { $(".game-fill-text-section").css('height', $(".game-img-section").height());}
    });
</script>
<!-- DESIGN -->
<script type="text/javascript">
   /*FILE NAME : PREVIEW*/
   $(document).on('change', '.uploadFile', function(){
       var uploadFile = $(this).val();
       if(uploadFile!='')
       {
           $(this).closest('.upload-block').find('.uploadFileName').val(uploadFile);
       }
   });
</script>
<link href="{{ url ('/') }}/css/admin/timingfield.css" type="text/css" rel="stylesheet" media="screen" />
<script src="{{ url ('/') }}/js/admin/timingfield.js"></script>
<script type="text/javascript">
   jQuery(document).ready(function($) {
       $(".timing").timingfield();
       $('input[name="minute"]').val({{$min}});
       $('input[name="second"]').val({{$sec}});
   });
   
</script>
<!-- for template all end here -->
@endsection
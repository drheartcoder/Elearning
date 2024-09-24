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
                  <h4 class="card-title">{{$module_title or ''}}</h4>
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
                        </div>
                        <div class="upload-section-main">
                           <div class="row">
                              <div class="col-sm-4">
                                 <div class="">
                                    <label class="col-form-label bmd-label-floating">File Type <span class="red">*</span></label>
                                    <div class="form-group">
                                       <div class="dropdown bootstrap-select">
                                          <select name="fileType" id="fileType" class="selectpicker dwCommon fileType" data-style="select-with-transition" title="Select File Type" data-size="7" tabindex="-98">
                                          <option value="image" {{ (isset($arrQuestion['file_type']) && $arrQuestion['file_type']=='image') ? 'selected' : '' }} >Image</option>
                                          <option value="video" {{ (isset($arrQuestion['file_type']) && $arrQuestion['file_type']=='video') ? 'selected' : '' }} >Video</option>
                                          </select>
                                       </div>
                                    </div>
                                    <span class="error" id="err_fileType"> @if($errors->has('fileType')) {{ $errors->first('fileType') }} @endif </span>     
                                 </div>
                              </div>
                              <div class="col-sm-8">
                                 <div id="divVideo" style="display: {{ (isset($arrQuestion['file_type']) && $arrQuestion['file_type']=='video') ? 'block;' : 'none' }}">
                                    <div class="row">
                                       <?php
                                          $videoUrl = '';
                                          if(isset($arrQuestion['file']) && $arrQuestion['file']!='')
                                          {
                                            if(file_exists($question_video_base_path.$arrQuestion['file']))
                                            {
                                              $videoUrl = $question_video_public_path.$arrQuestion['file'];
                                            }
                                          }
                                          ?>
                                       <?php
                                          if($videoUrl!='')
                                          {
                                            ?>
                                       <div class="col-sm-5">
                                          <video width="200" height="120" controls>
                                             <source src="{{ $videoUrl }}">
                                          </video>
                                       </div>
                                       <?php
                                          }
                                          ?>
                                       <div class=" @if($videoUrl!='') col-sm-7 @else col-sm-12 @endif">
                                          <label class="bmd-label-floating col-form-label">Video <span class="red">*</span></label>
                                          <div class="form-group upload-block">
                                             <input type="file" name="vdoFile" id="vdoFile" class="uploadFile" style="visibility:hidden; height: 0;position: absolute;" >
                                             <div class="input-div">
                                                <input type="text" class="form-control file-caption kv-fileinput-caption uploadFileName" />
                                                <div class="btn btn-primary btn-file"><a class="file" onclick="$('#vdoFile').click();">Browse...</a></div>
                                             </div>
                                             <span class="error" id="err_vdoFile"> @if($errors->has('vdoFile')) {{ $errors->first('vdoFile') }} @endif </span>            
                                          </div>
                                       </div>
                                    </div>
                                    <span class="note-section-block form-note-section mb20"><b>Note :</b> <span>Allowed file type mp4 (Video) format.</span></span>
                                 </div>
                                 <div id="divImage" style="display: {{ (isset($arrQuestion['file_type']) && $arrQuestion['file_type']=='image') ? 'block;' : 'none' }}">
                                    <div class="col-sm-12">
                                       <label class="bmd-label-floating col-form-label">Image <span class="red">*</span></label>
                                       <div style="position: relative;" class="profile-img-block temp-img-block">
                                          <div class="pro-img">
                                             <?php
                                                $imageUrl = $default_public_img_path.'default.png';
                                                if(isset($arrQuestion['file']) && $arrQuestion['file']!='')
                                                {
                                                  if(file_exists($question_image_base_path.$arrQuestion['file']))
                                                  {
                                                    $imageUrl = $question_image_public_path.$arrQuestion['file'];
                                                  }
                                                }
                                                ?>
                                             <img src="{{ $imageUrl }}" id="imgFilePreview" class="img-responsive imgFilePreview" alt=""/>
                                             <input style="height: 100%; width: 100%; z-index: 99;" id="imgFile" name="imgFile" type="file" class="attachment_upload imgFile" data-error="no" />
                                          </div>
                                          <span class="note-section-block"><b>Note :</b> <b>Note :</b> <span>Allowed only jpg | jpeg | png, <br/> Upload image greater than or equal to 570 X 442 for best result.</span></span>
                                       </div>
                                       <span class="error" id="err_imgFile"> @if($errors->has('imgFile')) {{ $errors->first('imgFile') }} @endif </span>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-sm-8">
                              <div class="form-group">
                                 <label class="bmd-label-floating">Question (Word)<span class="red">*</span></label>
                                 <input type="text" name="question" id="question" class="form-control classWord" value="{{ (isset($arrQuestion['question_text']) && $arrQuestion['question_text']!='') ? $arrQuestion['question_text'] : '' }}" maxlength="45" >
                                 <span class="error" id="err_question"> @if($errors->has('question_text')) {{ $errors->first('question_text') }} @endif </span>
                              </div>
                           </div>
                           <div class="col-sm-2">
                              <button type="button" class="btn btn-fill btn-rose ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" id="btnGenerate">
                                 <span class="ui-button-text">Generate</span>
                                 <div class="ripple-container"></div>
                              </button>
                           </div>
                           <?php
                              $arrQuestionLetter = [];
                              if(isset($arrQuestion['question_text']) && $arrQuestion['question_text']!='')
                              {
                                $arrQuestionLetter = str_split($arrQuestion['question_text']);
                              }
                              $arrAnswerPosition = [];
                              if(isset($arrQuestion['answer_position']) && $arrQuestion['answer_position']!='')
                              {
                                $arrAnswerPosition = str_split($arrQuestion['answer_position']);
                              }
                              ?>
                           <div class="col-sm-12" id="wrapperDivBlankLetter" style="display: @if(count($arrQuestionLetter) > 0) block @else none @endif;">
                              <div class="form-group">
                                 <div id="divBlankLetter">
                                    <?php
                                       if(count($arrQuestionLetter) > 0)
                                       {
                                         foreach ($arrQuestionLetter as $arrQuestionLetterKey => $arrQuestionLetterVal)
                                         {
                                           ?>
                                    <div class="alphabate-letter-section">
                                       <input type="text" name="blankLetter[]" class="form-control blankLetter" id="blankLetter{{ $arrQuestionLetterKey }}" maxlength="1" value="{{ $arrQuestionLetterVal }}" readonly />
                                       <div class="check-block">
                                          <input name="chkBlankLetter[]" id="chkBlankLetter{{ $arrQuestionLetterKey }}" class="filled-in" type="checkbox" value="{{ $arrQuestionLetterKey }}" <?php if($arrAnswerPosition[$arrQuestionLetterKey] == 0){ echo "checked"; } ?> >
                                          <label for="chkBlankLetter{{ $arrQuestionLetterKey }}"></label>
                                       </div>
                                    </div>
                                    <?php
                                       }
                                       }
                                       ?>
                                 </div>
                                 <div class="form-note">
                                    <b>Note : </b>
                                    <span>Please Select the checkbox which letter you want to hide.</span>
                                 </div>
                                 <span class="error" id="err_chkBlankLetter"></span>         
                              </div>
                           </div>
                           <div class="col-sm-12">
                              <div class="row">
                                 <div class="col-sm-6">
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
                                 <div class="col-sm-6">
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
                        </div>
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
                <!-- <div class="modal-button-section">
                    <button onClick="close_popup()" type="button" class="btn btn-fill btn-rose" data-dismiss="modal">{{trans('home.Ok')}}</button>
                 </div>-->
             </div>
        </div>
    </div>
  </div>
<!-- Template Preview Modal End  -->

<script type="text/javascript">
   $('.imgFile').change(function(){
       var tempThis = $(this);
       var files = $(this.files);
       imageSizeValidate(tempThis, files, '570', '442');
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
   $(document).on('change', '#fileType', function(){
       var fileType = $(this).val();
       if(fileType!='')
       {
           if(fileType == 'image')
           {
               $('#divVideo').hide();
               $('#divImage').show();
           }
           else if(fileType == 'video')
           {
               $('#divImage').hide();
               $('#divVideo').show();
           }
       }
       else
       {
           $('#err_fileType').html('This field is required.');
       }
   });
   $(document).on('change', '#fileType', function(){
       var fileType = $(this).val();
       if(fileType!='')
       {
           if(fileType == 'image')
           {
               $('#divVideo').hide();
               $('#divImage').show();
           }
           else if(fileType == 'video')
           {
               $('#divImage').hide();
               $('#divVideo').show();
           }
       }
       else
       {
           $('#err_fileType').html('This field is required.');
       }
   });
   
   $(document).on('keydown', '.classWord', function(e){
     var keyVal = (e.which) ? e.which : e.keyVal;
     if(parseInt(keyVal) != 32)
     {
        return;
     }
     else
     {
        e.preventDefault();
     }
   });
   
   $(document).on('blur', '#question', function(){
       $('#btnGenerate').trigger('click');
   });
   
   $(document).on('click', '#btnGenerate', function(){
       var question = $('#question').val();
       if(question!='' && question.length > 0)
       {
           var strDivBlankLetter = '';
           for(var i = 0; i < question.length; i++)
           {
               if(question[i]!='')
               {
                   strDivBlankLetter+='<div class="alphabate-letter-section"><input type="text" name="blankLetter[]" class="form-control blankLetter" id="blankLetter'+i+'" maxlength="1" value="'+question[i]+'" readonly /><div class="check-block"><input name="chkBlankLetter[]" id="chkBlankLetter'+i+'" class="filled-in" type="checkbox" value="'+i+'"><label for="chkBlankLetter'+i+'"></label></div></div>';
               }
           }
           if(strDivBlankLetter!='')
           {
               $('#wrapperDivBlankLetter').show();
               $('#divBlankLetter').html(strDivBlankLetter);
   
           }
       }
       else
       {
           $('#divBlankLetter').html('');
           $('#err_question').html('This field is required.');
           $('#wrapperDivBlankLetter').hide();
           return false;
       }
   });
   function validateForm()
   {
        var direction = $('#direction').val();
        var fileType    = $('#fileType').val();
        var oldFileType = $('#oldFileType').val();
        var question    = $('#question').val();
        var flHorn      = $('#flHorn').val();
        var flHornExt   = flHorn.substring(flHorn.lastIndexOf('.') + 1);
        var minute      = $('input[name="minute"]').val();
        var second      = $('input[name="second"]').val();
        var duration    = parseInt(minute)*60 + parseInt(second);
        var flag        = 0;
   
        $('#err_direction').html('');
        $('#err_fileType').html('');
        $('#err_imgFile').html('');
        $('#err_vdoFile').html('');
        $('#err_question').html('');
        $('#err_flHorn').html('');
        $('#err_question').html('');
        $('#err_duration').html('');
        $('#err_chkBlankLetter').html('');
   
   
        if($.trim(direction)=='')
        {
           $('#err_direction').html('This field is required.');
           flag = 1;  
        }
        if(fileType=='')
        {
            $('#err_fileType').html('This field is required.');
            flag = 1;
        }
        else
        {
           if($('#imgFile').attr('data-error')=='yes')
           {
               $('#err_imgFile').html('File must be grater than / equal to 570 X 442.');
               flag=1;  
           }
           if(fileType != oldFileType)
           {
              if(fileType=='image')
              {
                  var imgFile = $('#imgFile').val();
                  var imgFileExt = imgFile.substring(imgFile.lastIndexOf('.') + 1);
                  if(imgFile == '')
                  {
                      $('#err_imgFile').html('This field is required.');
                      flag = 1;
                  }
                  else if(!(imgFileExt == "jpg" || imgFileExt == "jpeg" || imgFileExt == "gif" || imgFileExt == "png" || imgFileExt == "GIF" || imgFileExt == "JPG" || imgFileExt == "JPEG" || imgFileExt == "PNG"))
                  {
                      $('#err_imgFile').html('Invalid file type.');
                      flag=1;
                  }
                  else if($('#imgFile').attr('data-error')=='yes')
                  {
                     $('#err_imgFile').html('File must be grater than / equal to 570 X 442.');
                     flag=1;  
                  }
              }
              else if(fileType=='video')
              {
                  var vdoFile = $('#vdoFile').val();
                  var vdoFileExt = vdoFile.substring(vdoFile.lastIndexOf('.') + 1);
                  
                  if(vdoFile == '')
                  {
                      $('#err_vdoFile').html('This field is required.');
                      flag = 1;
                  }
                  else if(!(vdoFileExt == "mp4" || vdoFileExt == "MP4"))
                  {
                      $('#err_vdoFile').html('Invalid file type.');
                      flag = 1;
                  }
              }
           }
        }
   
        if($.trim(question)=='')
        {
            $('#err_question').html('This field is required.');
            flag = 1;
        }
        else
        {
           if($('input[name="chkBlankLetter[]"]:checked').length == 0)
           {
             $('#err_chkBlankLetter').html('Please checked atleast one checkbox');
             flag = 1;    
           }
        }
   
        if(flHorn != '')
        {
            if(!(flHornExt == "mp3" || flHornExt == "MP3" || flHornExt == "wave" || flHornExt == "m4a"))
            {
                $('#err_flHorn').html('Invalid file type.');
                flag = 1;
            }
        }
   
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
         return true;
        }
         
   }
   $('#btnSubmit').click(function()
   {  
      var flag = validateForm();
      if(flag==true)
      {
        $('#frmUpdate').submit(); 
      }  
   });

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
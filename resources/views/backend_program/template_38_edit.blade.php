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
                              <label class="col-form-label">Question 1 File <span class="red">*</span></label>
                              <div style="position: relative;" class="form-group">
                                 <div class="profile-img-block temp-img-block">
                                    <div class="pro-img">
                                       <?php
                                          $imageUrl1 = $default_public_img_path.'default.png';
                                          if(isset($arrQuestion['question_file']) && $arrQuestion['question_file']!='')
                                          {
                                            if(file_exists($question_image_base_path.$arrQuestion['question_file']))
                                            {
                                              $imageUrl1 = $question_image_public_path.$arrQuestion['question_file'];
                                            }
                                          }
                                          ?>
                                       <img src="{{ $imageUrl1 }}" id="imgFilePreview1" class="img-responsive img-preview imgFilePreview" alt=""/>
                                       <input style="height: 100%; width: 100%; z-index: 99;" id="flQuestion1" name="flQuestion1"  type="file" class="attachment_upload imgFile" data-error="no" />
                                    </div>
                                    <span class="error" id="err_flQuestion1"> @if($errors->has('flQuestion1')) {{ $errors->first('flQuestion1') }} @endif </span>
                                    <span class="note-section-block"><b>Note :</b> <span>Allowed only jpg | jpeg | png, <br/> Upload image greater than or equal to 498 X 384 for best result.</span></span>
                                 </div>
                              </div>
                           </div>
                           <div class="col-sm-8">
                              <div class="form-group">
                                 <label class="bmd-label-floating">Question 1<span class="red">*</span></label>
                                 <input type="text" name="question1" id="question1" class="form-control" value="{{ (isset($arrQuestion['question_1']) && $arrQuestion['question_1']!='') ? $arrQuestion['question_1'] : '' }}" >
                                 <span class="error" id="err_question1"> @if($errors->has('question1')) {{ $errors->first('question1') }} @endif </span>
                              </div>
                           </div>
                           <div class="col-sm-4">
                              <div class="form-group">
                                 <label class="bmd-label-floating">Answer 1<span class="red">*</span></label>
                                 <input type="text" name="answer1" id="answer1" class="form-control" value="{{ (isset($arrQuestion['answer_1']) && $arrQuestion['answer_1']!='') ? $arrQuestion['answer_1'] : '' }}" maxlength="6">
                                 <span class="error" id="err_answer1"> @if($errors->has('answer1')) {{ $errors->first('answer1') }} @endif </span>
                              </div>
                           </div>
                           <div class="col-sm-8">
                              <div class="form-group">
                                 <label class="bmd-label-floating">Question 2<span class="red">*</span></label>
                                 <input type="text" name="question2" id="question2" class="form-control" value="{{ (isset($arrQuestion['question_2']) && $arrQuestion['question_2']!='') ? $arrQuestion['question_2'] : '' }}" >
                                 <span class="error" id="err_question2"> @if($errors->has('question2')) {{ $errors->first('question2') }} @endif </span>
                              </div>
                           </div>
                           <div class="col-sm-4">
                              <div class="form-group">
                                 <label class="bmd-label-floating">Answer 2<span class="red">*</span></label>
                                 <input type="text" name="answer2" id="answer2" class="form-control" value="{{ (isset($arrQuestion['answer_2']) && $arrQuestion['answer_2']!='') ? $arrQuestion['answer_2'] : '' }}" maxlength="6">
                                 <span class="error" id="err_answer2"> @if($errors->has('answer2')) {{ $errors->first('answer2') }} @endif </span>
                              </div>
                           </div>
                           <div class="col-sm-8">
                              <div class="form-group">
                                 <label class="bmd-label-floating">Question 3</label>
                                 <input type="text" name="question3" id="question3" class="form-control" value="{{ (isset($arrQuestion['question_3']) && $arrQuestion['question_3']!='') ? $arrQuestion['question_3'] : '' }}" >
                                 <span class="error" id="err_question3"> @if($errors->has('question3')) {{ $errors->first('question3') }} @endif </span>
                              </div>
                           </div>
                           <div class="col-sm-4">
                              <div class="form-group">
                                 <label class="bmd-label-floating">Answer 3</label>
                                 <input type="text" name="answer3" id="answer3" class="form-control" value="{{ (isset($arrQuestion['answer_3']) && $arrQuestion['answer_3']!='') ? $arrQuestion['answer_3'] : '' }}" maxlength="6">
                                 <span class="error" id="err_answer3"> @if($errors->has('answer3')) {{ $errors->first('answer3') }} @endif </span>
                              </div>
                           </div>
                           <div class="col-sm-8">
                              <div class="form-group">
                                 <label class="bmd-label-floating">Question 4</label>
                                 <input type="text" name="question4" id="question4" class="form-control" value="{{ (isset($arrQuestion['question_4']) && $arrQuestion['question_4']!='') ? $arrQuestion['question_4'] : '' }}" >
                                 <span class="error" id="err_question4"> @if($errors->has('question4')) {{ $errors->first('question4') }} @endif </span>
                              </div>
                           </div>
                           <div class="col-sm-4">
                              <div class="form-group">
                                 <label class="bmd-label-floating">Answer 4</label>
                                 <input type="text" name="answer4" id="answer4" class="form-control" value="{{ (isset($arrQuestion['answer_4']) && $arrQuestion['answer_4']!='') ? $arrQuestion['answer_4'] : '' }}" maxlength="6">
                                 <span class="error" id="err_answer4"> @if($errors->has('answer4')) {{ $errors->first('answer4') }} @endif </span>
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
       $('.dwCommon').selectpicker();
   });

   $('.imgFile').change(function(){
       var tempThis = $(this);
       var files = $(this.files);
       imageSizeValidate(tempThis, files, '498', '384');
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
   
    function validateForm(){
       var direction = $('#direction').val();
       var flQuestion1 = $('#flQuestion1').val();
       var flQuestion1Ext = flQuestion1.substring(flQuestion1.lastIndexOf('.') + 1);
       var question1 = $('#question1').val();
       var answer1 = $('#answer1').val();
       var question2 = $('#question2').val();
       var answer2 = $('#answer2').val();
       var question3 = $('#question3').val();
       var answer3 = $('#answer3').val();
       var question4 = $('#question4').val();
       var answer4 = $('#answer4').val();
       /*var flHorn   = $('#flHorn').val();
       var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);*/
   
       var minute      = $('input[name="minute"]').val();
       var second      = $('input[name="second"]').val();
       var duration    = parseInt(minute)*60 + parseInt(second);
   
       var flag = 0;
   
       $('#err_direction').html('');
       $('#err_flQuestion1').html('');
       $('#err_question1').html('');
       $('#err_answer1').html('');
       $('#err_question2').html('');
       $('#err_answer2').html('');
       $('#err_question3').html('');
       $('#err_answer3').html('');
       $('#err_question4').html('');
       $('#err_answer4').html('');
       /*$('#err_flHorn').html('');*/
       $('#err_duration').html('');
   
        if($.trim(direction)=='')
        {
           $('#err_direction').html('This field is required.');
           flag = 1;  
        }
   
        if(flQuestion1 != '')
        {
            if(!(flQuestion1Ext == "jpg" || flQuestion1Ext == "jpeg" || flQuestion1Ext == "gif" || flQuestion1Ext == "png" || flQuestion1Ext == "GIF" || flQuestion1Ext == "JPG" || flQuestion1Ext == "JPEG" || flQuestion1Ext == "PNG"))
            {
                $('#err_flQuestion1').html('Invalid file type.');
                flag=1;
            }
            else if($('#flQuestion1').attr('data-error')=='yes')
            {
               $('#err_flQuestion1').html('File must be grater than / equal to 498 X 384.');
               flag=1;  
            }  
        }
   
        if($.trim(question1)=='')
        {
           $('#err_question1').html('This field is required.');
           flag = 1;  
        }
        if($.trim(answer1)=='')
        {
           $('#err_answer1').html('This field is required.');
           flag = 1;  
        }
   
        if($.trim(question2)!='')
        {
           if($.trim(answer2)=='')
           {
              $('#err_answer2').html('This field is required.');
              flag = 1;  
           }
        }
        if($.trim(answer2)!='')
        {
            if($.trim(question2)=='')
            {
               $('#err_question2').html('This field is required.');
               flag = 1;  
            }
        }
   
   
        if($.trim(question3)!='')
        {
            if($.trim(answer3)=='')
            {
               $('#err_answer3').html('This field is required.');
               flag = 1;  
            }
        }
        if($.trim(answer3)!='')
        {
            if($.trim(question3)=='')
            {
               $('#err_question3').html('This field is required.');
               flag = 1;  
            }
        }
   
        if($.trim(question4)!='')
        {
            if($.trim(answer4)=='')
            {
               $('#err_answer4').html('This field is required.');
               flag = 1;  
            }
        }
        if($.trim(answer4)!='')
        {
            if($.trim(question4)=='')
            {
               $('#err_question4').html('This field is required.');
               flag = 1;  
            }
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
         /*return true;*/
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

    $( "#popup_template_preview" ).on('shown.bs.modal', function(){
        $('html').removeClass('perfect-scrollbar-on');
        $('.modal-backdrop').addClass('dark-bg');
        if($(".game-img-section").height() != 'undefined' && $(".game-fill-text-section").height() != 'undefined'){
			if($(".game-img-section").height() > $(".game-fill-text-section").height()){
				$(".game-fill-text-section").css('height', $(".game-img-section").height());
			}else{
				$(".game-img-section").css('height', $(".game-fill-text-section").height());
			}
		}
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
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
                           <!-- QUESTION : 1 -->
                           <div class="col-sm-12">
                              <label class="col-form-label">Question 1 File (Image) <span class="red">*</span></label>
                              <div style="position: relative;" class="form-group">
                                 <div class="profile-img-block temp-img-block">
                                    <div class="pro-img">
                                       <?php
                                          $imageUrl1 = $default_public_img_path.'default.png';
                                          if(isset($arrQuestion['question_1_file']) && $arrQuestion['question_1_file']!='')
                                          {
                                            if(file_exists($question_image_base_path.$arrQuestion['question_1_file']))
                                            {
                                              $imageUrl1 = $question_image_public_path.$arrQuestion['question_1_file'];
                                            }
                                          }
                                          ?>
                                       <img src="{{ $imageUrl1 }}" id="imgFilePreview1" class="img-responsive img-preview imgFilePreview" alt=""/>
                                       <input style="height: 100%; width: 100%; z-index: 99;" id="flQuestion1" name="flQuestion1"  type="file" class="attachment_upload imgFile" data-error="no" />
                                    </div>
                                    <span class="error" id="err_flQuestion1"> @if($errors->has('flQuestion1')) {{ $errors->first('flQuestion1') }} @endif </span>
                                    <span class="note-section-block"><b>Note :</b> <span>Allowed only jpg | jpeg | png, <br/> Upload image greater than or equal to 429 X 269 for best result.</span></span>
                                 </div>
                              </div>
                           </div>
                           <div class="col-sm-7">
                              <div class="form-group m-b-10">
                                 <label class="bmd-label-floating">Question 1 <span class="red">*</span></label>
                                 <input type="text" name="question1_1" id="question1_1" class="form-control" value="{{ (isset($arrQuestion['question1_1']) && $arrQuestion['question1_1']!='') ? $arrQuestion['question1_1'] : '' }}" >
                                 <span class="error" id="err_question1_1"> @if($errors->has('question1_1')) {{ $errors->first('question1_1') }} @endif </span>
                              </div>
                              <span class="note-section-block form-note-section"><b>Note :</b> <span><i><b>#BLANK#</b></i> This keyword is used for <b>Blank Word</b>.</span></span>                                       
                           </div>
                           <div class="col-sm-5">
                              <div class="form-group m-b-10">
                                 <label class="bmd-label-floating">Answer 1 <span class="red">*</span></label>
                                 <input type="text" name="answer1_1" id="answer1_1" class="form-control" value="{{ (isset($arrQuestion['answer1_1']) && $arrQuestion['answer1_1']!='') ? $arrQuestion['answer1_1'] : '' }}" >
                                 <span class="error" id="err_answer1_1"> @if($errors->has('answer1_1')) {{ $errors->first('answer1_1') }} @endif </span>
                              </div>
                              <span class="note-section-block form-note-section m-b-10"><b>Note :</b> <span>Enter answers(Words) by comma-separated [Multiple answers]</span></span>
                           </div>
                           <div class="col-sm-7">
                              <div class="form-group m-b-10">
                                 <label class="bmd-label-floating">Question 2 </label>
                                 <input type="text" name="question1_2" id="question1_2" class="form-control" value="{{ (isset($arrQuestion['question1_2']) && $arrQuestion['question1_2']!='') ? $arrQuestion['question1_2'] : '' }}" >
                                 <span class="error" id="err_question1_2"> @if($errors->has('question1_2')) {{ $errors->first('question1_2') }} @endif </span>
                              </div>
                              <span class="note-section-block form-note-section"><b>Note :</b> <span><i><b>#BLANK#</b></i> This keyword is used for <b>Blank Word</b>.</span></span>                                       
                           </div>
                           <div class="col-sm-5">
                              <div class="form-group m-b-10">
                                 <label class="bmd-label-floating">Answer 2 </label>
                                 <input type="text" name="answer1_2" id="answer1_2" class="form-control" value="{{ (isset($arrQuestion['answer1_2']) && $arrQuestion['answer1_2']!='') ? $arrQuestion['answer1_2'] : '' }}" >
                                 <span class="error" id="err_answer1_2"> @if($errors->has('answer1_2')) {{ $errors->first('answer1_2') }} @endif </span>
                              </div>
                              <span class="note-section-block form-note-section m-b-10"><b>Note :</b> <span>Enter answers(Words) by comma-separated [Multiple answers]</span></span>
                           </div>
                           <div class="col-sm-7">
                              <div class="form-group m-b-10">
                                 <label class="bmd-label-floating">Question 3</label>
                                 <input type="text" name="question1_3" id="question1_3" class="form-control" value="{{ (isset($arrQuestion['question1_3']) && $arrQuestion['question1_3']!='') ? $arrQuestion['question1_3'] : '' }}" >
                                 <span class="error" id="err_question1_3"> @if($errors->has('question1_3')) {{ $errors->first('question1_3') }} @endif </span>
                              </div>
                              <span class="note-section-block form-note-section"><b>Note :</b> <span><i><b>#BLANK#</b></i> This keyword is used for <b>Blank Word</b>.</span></span>                                       
                           </div>
                           <div class="col-sm-5">
                              <div class="form-group m-b-10">
                                 <label class="bmd-label-floating">Answer 3 </label>
                                 <input type="text" name="answer1_3" id="answer1_3" class="form-control" value="{{ (isset($arrQuestion['answer1_3']) && $arrQuestion['answer1_3']!='') ? $arrQuestion['answer1_3'] : '' }}" >
                                 <span class="error" id="err_answer1_3"> @if($errors->has('answer1_3')) {{ $errors->first('answer1_3') }} @endif </span>
                              </div>
                              <span class="note-section-block form-note-section m-b-10"><b>Note :</b> <span>Enter answers(Words) by comma-separated [Multiple answers]</span></span>
                           </div>
                           <!-- QUESTION : 2 -->
                           <div class="col-sm-12">
                              <label class="col-form-label">Question 2 File (Image) <span class="red">*</span></label>
                              <div style="position: relative;" class="form-group">
                                 <div class="profile-img-block temp-img-block">
                                    <div class="pro-img">
                                       <?php
                                          $imageUrl2 = $default_public_img_path.'default.png';
                                          if(isset($arrQuestion['question_2_file']) && $arrQuestion['question_2_file']!='')
                                          {
                                            if(file_exists($question_image_base_path.$arrQuestion['question_2_file']))
                                            {
                                              $imageUrl2 = $question_image_public_path.$arrQuestion['question_2_file'];
                                            }
                                          }
                                          ?>
                                       <img src="{{ $imageUrl2 }}" id="imgFilePreview2" class="img-responsive img-preview imgFilePreview" alt=""/>
                                       <input style="height: 100%; width: 100%; z-index: 99;" id="flQuestion2" name="flQuestion2"  type="file" class="attachment_upload imgFile" data-error="no" />
                                    </div>
                                    <span class="error" id="err_flQuestion2"> @if($errors->has('flQuestion2')) {{ $errors->first('flQuestion2') }} @endif </span>
                                    <span class="note-section-block"><b>Note :</b> <span>Allowed only jpg | jpeg | png, <br/> Upload image greater than or equal to 429 X 269 for best result.</span></span>
                                 </div>
                              </div>
                           </div>
                           <div class="col-sm-7">
                              <div class="form-group m-b-10">
                                 <label class="bmd-label-floating">Question 1 <span class="red">*</span></label>
                                 <input type="text" name="question2_1" id="question2_1" class="form-control" value="{{ (isset($arrQuestion['question2_1']) && $arrQuestion['question2_1']!='') ? $arrQuestion['question2_1'] : '' }}" >
                                 <span class="error" id="err_question2_1"> @if($errors->has('question2_1')) {{ $errors->first('question2_1') }} @endif </span>
                              </div>
                              <span class="note-section-block form-note-section"><b>Note :</b> <span><i><b>#BLANK#</b></i> This keyword is used for <b>Blank Word</b>.</span></span>                                       
                           </div>
                           <div class="col-sm-5">
                              <div class="form-group m-b-10">
                                 <label class="bmd-label-floating">Answer 1 <span class="red">*</span></label>
                                 <input type="text" name="answer2_1" id="answer2_1" class="form-control" value="{{ (isset($arrQuestion['answer2_1']) && $arrQuestion['answer2_1']!='') ? $arrQuestion['answer2_1'] : '' }}" >
                                 <span class="error" id="err_answer2_1"> @if($errors->has('answer2_1')) {{ $errors->first('answer2_1') }} @endif </span>
                              </div>
                              <span class="note-section-block form-note-section m-b-10"><b>Note :</b> <span>Enter answers(Words) by comma-separated [Multiple answers]</span></span>
                           </div>
                           <div class="col-sm-7">
                              <div class="form-group m-b-10">
                                 <label class="bmd-label-floating">Question 2</label>
                                 <input type="text" name="question2_2" id="question2_2" class="form-control" value="{{ (isset($arrQuestion['question2_2']) && $arrQuestion['question2_2']!='') ? $arrQuestion['question2_2'] : '' }}" >
                                 <span class="error" id="err_question2_2"> @if($errors->has('question2_2')) {{ $errors->first('question2_2') }} @endif </span>
                              </div>
                              <span class="note-section-block form-note-section"><b>Note :</b> <span><i><b>#BLANK#</b></i> This keyword is used for <b>Blank Word</b>.</span></span>                                       
                           </div>
                           <div class="col-sm-5">
                              <div class="form-group m-b-10">
                                 <label class="bmd-label-floating">Answer 2 </label>
                                 <input type="text" name="answer2_2" id="answer2_2" class="form-control" value="{{ (isset($arrQuestion['answer2_2']) && $arrQuestion['answer2_2']!='') ? $arrQuestion['answer2_2'] : '' }}" >
                                 <span class="error" id="err_answer2_2"> @if($errors->has('answer2_2')) {{ $errors->first('answer2_2') }} @endif </span>
                              </div>
                              <span class="note-section-block form-note-section m-b-10"><b>Note :</b> <span>Enter answers(Words) by comma-separated [Multiple answers]</span></span>
                           </div>
                           <div class="col-sm-7">
                              <div class="form-group m-b-10">
                                 <label class="bmd-label-floating">Question 3 </label>
                                 <input type="text" name="question2_3" id="question2_3" class="form-control" value="{{ (isset($arrQuestion['question2_3']) && $arrQuestion['question2_3']!='') ? $arrQuestion['question2_3'] : '' }}" >
                                 <span class="error" id="err_question2_3"> @if($errors->has('question2_3')) {{ $errors->first('question2_3') }} @endif </span>
                              </div>
                              <span class="note-section-block form-note-section"><b>Note :</b> <span><i><b>#BLANK#</b></i> This keyword is used for <b>Blank Word</b>.</span></span>                                       
                           </div>
                           <div class="col-sm-5">
                              <div class="form-group m-b-10">
                                 <label class="bmd-label-floating">Answer 3 </label>
                                 <input type="text" name="answer2_3" id="answer2_3" class="form-control" value="{{ (isset($arrQuestion['answer2_3']) && $arrQuestion['answer2_3']!='') ? $arrQuestion['answer2_3'] : '' }}" >
                                 <span class="error" id="err_answer2_3"> @if($errors->has('answer2_3')) {{ $errors->first('answer2_3') }} @endif </span>
                              </div>
                              <span class="note-section-block form-note-section m-b-10"><b>Note :</b> <span>Enter answers(Words) by comma-separated [Multiple answers]</span></span>
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
   $('.imgFile').change(function(){
       var tempThis = $(this);
       var files = $(this.files);
       imageSizeValidate(tempThis, files, '429', '269');
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
   function validateForm()
   {
       var direction = $('#direction').val();
   
       var flQuestion1 = $('#flQuestion1').val();
       var flQuestion1Ext = flQuestion1.substring(flQuestion1.lastIndexOf('.')+1);
       var question1_1 = $('#question1_1').val();
       var answer1_1 = $('#answer1_1').val();
       var question1_2 = $('#question1_2').val();
       var answer1_2 = $('#answer1_2').val();
       var question1_3 = $('#question1_3').val();
       var answer1_3 = $('#answer1_3').val();
   
       var flQuestion2 = $('#flQuestion2').val();
       var flQuestion2Ext = flQuestion2.substring(flQuestion2.lastIndexOf('.')+1);
       var question2_1 = $('#question2_1').val();
       var answer2_1 = $('#answer2_1').val();
       var question2_2 = $('#question2_2').val();
       var answer2_2 = $('#answer2_2').val();
       var question2_3 = $('#question2_3').val();
       var answer2_3 = $('#answer2_3').val();
   
       /*var flHorn   = $('#flHorn').val();
       var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);*/
   
       var minute      = $('input[name="minute"]').val();
       var second      = $('input[name="second"]').val();
       var duration    = parseInt(minute)*60 + parseInt(second);
   
       var flag = 0;
   
       $('#err_direction').html('');
       
       $('#err_flQuestion1').html('');
       $('#err_question1_1').html('');
       $('#err_answer1_1').html('');
       $('#err_question1_2').html('');
       $('#err_answer1_2').html('');
       $('#err_question1_3').html('');
       $('#err_answer1_3').html('');
   
       $('#err_flQuestion2').html('');
       $('#err_question2_1').html('');
       $('#err_answer2_1').html('');
       $('#err_question2_2').html('');
       $('#err_answer2_2').html('');
       $('#err_question2_3').html('');
       $('#err_answer2_3').html('');
   
       /*$('#err_flHorn').html('');*/
   
       $('#err_duration').html('');
   
        if($.trim(direction)=='')
        {
           $('#err_direction').html('This field is required.');
           flag = 1;  
        }
   
        /*Question : 1*/
        if(flQuestion1 != '')
        {
            if(!(flQuestion1Ext == "jpg" || flQuestion1Ext == "jpeg" || flQuestion1Ext == "gif" || flQuestion1Ext == "png" || flQuestion1Ext == "GIF" || flQuestion1Ext == "JPG" || flQuestion1Ext == "JPEG" || flQuestion1Ext == "PNG"))
            {
                $('#err_flQuestion1').html('Invalid file type.');
                flag=1;
            }
            else if($('#flQuestion1').attr('data-error')=='yes')
            {
               $('#err_flQuestion1').html('File must be grater than / equal to 429 X 269.');
               flag=1;  
            }  
        }
   
        if($.trim(question1_1)=='')
        {
           $('#err_question1_1').html('This field is required.');
           flag = 1;  
        }
        else
        {
           var questionAnsArr = question1_1.match(/#BLANK#/g);
           if(questionAnsArr==null)
           {
             $('#err_question1_1').html('#BLANK# is missing');
             flag = 1;    
           }
           /*else
           {
             var questionAnsCount = questionAnsArr.length;  
             if(parseInt(questionAnsCount)!=1)
             {
               $('#err_question1_1').html('Only one #BLANK# is allowed');
               flag = 1;       
             }
           }*/
        }
        if($.trim(answer1_1)=='')
        {
           $('#err_answer1_1').html('This field is required.');
           flag = 1;  
        }
        else
        {
            if($.trim(question1_1)!='')
            {
               var questionAnsArr = question1_1.match(/#BLANK#/g);
               var questionAnsCount = questionAnsArr.length;
               var answerCount = answer1_1.split(',').length;
               if(parseInt(answerCount) != parseInt(questionAnsCount))
               {
                 $('#err_answer1_1').html('Please enter all answers.');
                 flag = 1;          
               }
            }  
            else
            {
             $('#err_question1_1').html('This field is required.');
               flag = 1;  
            }              
        }
        
         if($.trim(question1_2)!='' || $.trim(answer1_2)!='')
         {
           if($.trim(question1_2)=='')
           {
              $('#err_question1_2').html('This field is required.');
              flag = 1;  
           }
           else
           {
              var questionAnsArr = question1_2.match(/#BLANK#/g);
              if(questionAnsArr==null)
              {
                $('#err_question1_2').html('#BLANK# is missing');
                flag = 1;    
              }
           }

           if($.trim(answer1_2)=='')
           {
              $('#err_answer1_2').html('This field is required.');
              flag = 1;  
           }
           else
           {
               if($.trim(question1_2)!='')
               {
                  var questionAnsArr = question1_2.match(/#BLANK#/g);
                  var questionAnsCount = questionAnsArr.length;
                  var answerCount = answer1_2.split(',').length;
                  if(parseInt(answerCount) != parseInt(questionAnsCount))
                  {
                    $('#err_answer1_2').html('Please enter all answers.');
                    flag = 1;          
                  }
               }  
               else
               {
                $('#err_question1_2').html('This field is required.');
                  flag = 1;  
               }              
           }
         }

         if($.trim(question1_3)!='' || $.trim(answer1_3)!='')
         {
             if($.trim(question1_3)=='')
             {
                $('#err_question1_3').html('This field is required.');
                flag = 1;  
             }
             else
             {
                var questionAnsArr = question1_3.match(/#BLANK#/g);
                if(questionAnsArr==null)
                {
                  $('#err_question1_3').html('#BLANK# is missing');
                  flag = 1;    
                }
             }
             if($.trim(answer1_3)=='')
             {
                $('#err_answer1_3').html('This field is required.');
                flag = 1;  
             }
             else
             {
                 if($.trim(question1_3)!='')
                 {
                    var questionAnsArr = question1_3.match(/#BLANK#/g);
                    var questionAnsCount = questionAnsArr.length;
                    var answerCount = answer1_3.split(',').length;
                    if(parseInt(answerCount) != parseInt(questionAnsCount))
                    {
                      $('#err_answer1_3').html('Please enter all answers.');
                      flag = 1;          
                    }
                 }  
                 else
                 {
                  $('#err_question1_3').html('This field is required.');
                    flag = 1;
                 }              
             }
         }
   
        /*Question : 2*/
        if(flQuestion2 != '')
        {
            if(!(flQuestion2Ext == "jpg" || flQuestion2Ext == "jpeg" || flQuestion2Ext == "gif" || flQuestion2Ext == "png" || flQuestion2Ext == "GIF" || flQuestion2Ext == "JPG" || flQuestion2Ext == "JPEG" || flQuestion2Ext == "PNG"))
            {
                $('#err_flQuestion2').html('Invalid file type.');
                flag=1;
            }
            else if($('#flQuestion2').attr('data-error')=='yes')
            {
               $('#err_flQuestion2').html('File must be grater than / equal to 429 X 269.');
               flag=1;  
            }   
        }
   
        if($.trim(question2_1)=='')
        {
           $('#err_question2_1').html('This field is required.');
           flag = 1;  
        }
        else
        {
           var questionAnsArr = question2_1.match(/#BLANK#/g);
           if(questionAnsArr==null)
           {
             $('#err_question2_1').html('#BLANK# is missing');
             flag = 1;    
           }
           /*else
           {
             var questionAnsCount = questionAnsArr.length;  
             if(parseInt(questionAnsCount)!=1)
             {
               $('#err_question2_1').html('Only one #BLANK# is allowed');
               flag = 1;       
             }
           }*/
        }
        if($.trim(answer2_1)=='')
        {
           $('#err_answer2_1').html('This field is required.');
           flag = 1;  
        }
        else
        {
            if($.trim(question2_1)!='')
            {
               var questionAnsArr = question2_1.match(/#BLANK#/g);
               var questionAnsCount = questionAnsArr.length;
               var answerCount = answer2_1.split(',').length;
               if(parseInt(answerCount) != parseInt(questionAnsCount))
               {
                 $('#err_answer2_1').html('Please enter all answers.');
                 flag = 1;          
               }
            }  
            else
            {
             $('#err_question2_1').html('This field is required.');
               flag = 1;  
            }              
        }
        
         if($.trim(question2_2)!='' || $.trim(answer2_2)!='')
         {
           if($.trim(question2_2)=='')
           {
              $('#err_question2_2').html('This field is required.');
              flag = 1;  
           }
           else
           {
              var questionAnsArr = question2_2.match(/#BLANK#/g);
              if(questionAnsArr==null)
              {
                $('#err_question2_2').html('#BLANK# is missing');
                flag = 1;    
              }
              
           }

           if($.trim(answer2_2)=='')
           {
              $('#err_answer2_2').html('This field is required.');
              flag = 1;  
           }
           else
           {
               if($.trim(question2_2)!='')
               {
                  var questionAnsArr = question2_2.match(/#BLANK#/g);
                  var questionAnsCount = questionAnsArr.length;
                  var answerCount = answer2_2.split(',').length;
                  if(parseInt(answerCount) != parseInt(questionAnsCount))
                  {
                    $('#err_answer2_2').html('Please enter all answers.');
                    flag = 1;          
                  }
               }  
               else
               {
                $('#err_question2_2').html('This field is required.');
                  flag = 1;  
               }              
           }
         }

         if($.trim(question2_3)!='' || $.trim(answer2_3)!='')
         {
           if($.trim(question2_3)=='')
           {
              $('#err_question2_3').html('This field is required.');
              flag = 1;  
           }
           else
           {
              var questionAnsArr = question2_3.match(/#BLANK#/g);
              if(questionAnsArr==null)
              {
                $('#err_question2_3').html('#BLANK# is missing');
                flag = 1;    
              }
              /*else
              {
                var questionAnsCount = questionAnsArr.length;  
                if(parseInt(questionAnsCount)!=1)
                {
                  $('#err_question2_3').html('Only one #BLANK# is allowed');
                  flag = 1;       
                }
              }*/
           }
           if($.trim(answer2_3)=='')
           {
              $('#err_answer2_3').html('This field is required.');
              flag = 1;  
           }
           else
           {
               if($.trim(question2_3)!='')
               {
                  var questionAnsArr = question2_3.match(/#BLANK#/g);
                  var questionAnsCount = questionAnsArr.length;
                  var answerCount = answer2_3.split(',').length;
                  if(parseInt(answerCount) != parseInt(questionAnsCount))
                  {
                    $('#err_answer2_3').html('Please enter all answers.');
                    flag = 1;          
                  }
               }  
               else
               {
                $('#err_question2_3').html('This field is required.');
                  flag = 1;  
               }              
           }
         }
        /*if(flHorn != '')
        {
            if(!(flHornExt == "mp3" || flHornExt == "MP3" || flHornExt == "wave" || flHornExt == "m4a"))
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
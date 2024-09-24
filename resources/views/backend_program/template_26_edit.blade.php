@extends($role_slug.'.layout.master')    
@section('main_content')
<!-- BEGIN Main Content -->
<!-- Page header -->
@include($role_slug.'.layout.breadcrumb')  
<!-- /page header -->
<style type="text/css">
   .radio-btns .radio-btn.radio-first-option{margin-bottom: 10px}
   .radio-btns .radio-btn label{margin: 0 auto;}
   .note-section-block{ margin-bottom: 10px;  }
</style>
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
                        </div>
                        <div class="row">
                           <div class="col-sm-12">
                              <div class="form-group m-b-10">
                                 <label class="bmd-label-floating">Question 1 <span class="red">*</span></label>
                                 <input type="text" name="question1" id="question1" class="form-control" value="{{ (isset($arrQuestion['question_1_text']) && $arrQuestion['question_1_text']!='') ? $arrQuestion['question_1_text'] : '' }}" >
                                 <span class="error" id="err_question1"> @if($errors->has('question1')) {{ $errors->first('question1') }} @endif</span>
                              </div>
                           </div>
                           <div class="col-sm-3">
                              <div class="form-group">
                                 <label class="bmd-label-floating">Option 1 (Word)<span class="red">*</span></label>
                                 <input type="text" name="option1_1" id="option1_1" class="form-control classWord" value="{{ (isset($arrQuestion['question_1_option1']) && $arrQuestion['question_1_option1']!='') ? $arrQuestion['question_1_option1'] : '' }}" >
                                 <span class="error" id="err_option1_1"> @if($errors->has('option1_1')) {{ $errors->first('option1_1') }} @endif</span>
                              </div>
                           </div>
                           <div class="col-sm-3">
                              <div class="form-group">
                                 <label class="bmd-label-floating">Option 2 (Word)<span class="red">*</span></label>
                                 <input type="text" name="option1_2" id="option1_2" class="form-control classWord" value="{{ (isset($arrQuestion['question_1_option2']) && $arrQuestion['question_1_option2']!='') ? $arrQuestion['question_1_option2'] : '' }}" >
                                 <span class="error" id="err_option1_2"> @if($errors->has('option1_2')) {{ $errors->first('option1_2') }} @endif </span>
                              </div>
                           </div>
                           <div class="col-sm-3">
                              <div class="form-group">
                                 <label class="bmd-label-floating">Option 3 (Word)<span class="red">*</span></label>
                                 <input type="text" name="option1_3" id="option1_3" class="form-control classWord" value="{{ (isset($arrQuestion['question_1_option3']) && $arrQuestion['question_1_option3']!='') ? $arrQuestion['question_1_option3'] : '' }}" >
                                 <span class="error" id="err_option1_3"> @if($errors->has('option1_3')) {{ $errors->first('option1_3') }} @endif </span>
                              </div>
                           </div>
                        </div>
                        <div class="row" style="position: relative;">
                           <div class="col-sm-3">
                              <div class="radio-btns">
                                 <div class="radio-btn radio-first-option">
                                    <input type="radio" id="rdoOption1_1" name="rdoOption1" value="1" @if(isset($arrQuestion['question_1_answer']) && $arrQuestion['question_1_answer']==1) checked @endif >
                                    <label for="rdoOption1_1">Option 1</label>
                                    <div class="check"></div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-sm-3">
                              <div class="radio-btns">
                                 <div class="radio-btn radio-first-option">
                                    <input type="radio" id="rdoOption1_2" name="rdoOption1" value="2" @if(isset($arrQuestion['question_1_answer']) && $arrQuestion['question_1_answer']==2) checked @endif >
                                    <label for="rdoOption1_2">Option 2</label>
                                    <div class="check"></div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-sm-3">
                              <div class="radio-btns">
                                 <div class="radio-btn radio-first-option">
                                    <input type="radio" id="rdoOption1_3" name="rdoOption1" value="3" @if(isset($arrQuestion['question_1_answer']) && $arrQuestion['question_1_answer']==3) checked @endif >
                                    <label for="rdoOption1_3">Option 3</label>
                                    <div class="check"></div>
                                 </div>
                              </div>
                           </div>
                           <span class="error" id="err_rdoOption1" style="left: 15px;bottom: -15px;"> @if($errors->has('rdoOption1')) {{ $errors->first('rdoOption1') }} @endif</span>        
                        </div>
                        <span class="note-section-block form-note-section" style="margin-top: 15px;"><b>Note :</b> <span><span>Select any one option which is correct answer</span></span></span>
                        <div class="row">
                           <div class="col-sm-12">
                              <div class="form-group m-b-10">
                                 <label class="bmd-label-floating">Question 2 <span class="red">*</span></label>
                                 <input type="text" name="question2" id="question2" class="form-control" value="{{ (isset($arrQuestion['question_2_text']) && $arrQuestion['question_2_text']!='') ? $arrQuestion['question_2_text'] : '' }}" >
                                 <span class="error" id="err_question2"> @if($errors->has('question2')) {{ $errors->first('question2') }} @endif </span>
                              </div>
                           </div>
                           <div class="col-sm-3">
                              <div class="form-group">
                                 <label class="bmd-label-floating">Option 1 (Word)<span class="red">*</span></label>
                                 <input type="text" name="option2_1" id="option2_1" class="form-control classWord" value="{{ (isset($arrQuestion['question_2_option1']) && $arrQuestion['question_2_option1']!='') ? $arrQuestion['question_2_option1'] : '' }}" >
                                 <span class="error" id="err_option2_1"> @if($errors->has('option2_1')) {{ $errors->first('option2_1') }} @endif </span>
                              </div>
                           </div>
                           <div class="col-sm-3">
                              <div class="form-group">
                                 <label class="bmd-label-floating">Option 2 (Word)<span class="red">*</span></label>
                                 <input type="text" name="option2_2" id="option2_2" class="form-control classWord" value="{{ (isset($arrQuestion['question_2_option2']) && $arrQuestion['question_2_option2']!='') ? $arrQuestion['question_2_option2'] : '' }}" >
                                 <span class="error" id="err_option2_2"> @if($errors->has('option2_2')) {{ $errors->first('option2_2') }} @endif </span>
                              </div>
                           </div>
                           <div class="col-sm-3">
                              <div class="form-group">
                                 <label class="bmd-label-floating">Option 3 (Word)<span class="red">*</span></label>
                                 <input type="text" name="option2_3" id="option2_3" class="form-control classWord" value="{{ (isset($arrQuestion['question_2_option3']) && $arrQuestion['question_2_option3']!='') ? $arrQuestion['question_2_option3'] : '' }}" >
                                 <span class="error" id="err_option2_3"> @if($errors->has('option2_3')) {{ $errors->first('option2_3') }} @endif </span>
                              </div>
                           </div>
                        </div>
                        <div class="row" style="position: relative;">
                           <div class="col-sm-3">
                              <div class="radio-btns">
                                 <div class="radio-btn radio-first-option">
                                    <input type="radio" id="rdoOption2_1" name="rdoOption2" value="1" @if(isset($arrQuestion['question_2_answer']) && $arrQuestion['question_2_answer']==1) checked @endif >
                                    <label for="rdoOption2_1">Option 1</label>
                                    <div class="check"></div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-sm-3">
                              <div class="radio-btns">
                                 <div class="radio-btn radio-first-option">
                                    <input type="radio" id="rdoOption2_2" name="rdoOption2" value="2" @if(isset($arrQuestion['question_2_answer']) && $arrQuestion['question_2_answer']==2) checked @endif>
                                    <label for="rdoOption2_2">Option 2</label>
                                    <div class="check"></div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-sm-3">
                              <div class="radio-btns">
                                 <div class="radio-btn radio-first-option">
                                    <input type="radio" id="rdoOption2_3" name="rdoOption2" value="3" @if(isset($arrQuestion['question_2_answer']) && $arrQuestion['question_2_answer']==3) checked @endif >
                                    <label for="rdoOption2_3">Option 3</label>
                                    <div class="check"></div>
                                 </div>
                              </div>
                           </div>
                           <span class="error" id="err_rdoOption2" style="left: 15px;bottom: -15px;"> @if($errors->has('rdoOption2')) {{ $errors->first('rdoOption2') }} @endif</span>        
                        </div>
                        <span class="note-section-block form-note-section" style="margin-top: 15px;"><b>Note :</b> <span><span>Select any one option which is correct answer</span></span></span>
                        <div class="row">
                           <div class="col-sm-12">
                              <div class="form-group m-b-10">
                                 <label class="bmd-label-floating">Question 3 <span class="red">*</span></label>
                                 <input type="text" name="question3" id="question3" class="form-control" value="{{ (isset($arrQuestion['question_3_text']) && $arrQuestion['question_3_text']!='') ? $arrQuestion['question_3_text'] : '' }}" >
                                 <span class="error" id="err_question3"> @if($errors->has('question3')) {{ $errors->first('question3') }} @endif </span>
                              </div>
                           </div>
                           <div class="col-sm-3">
                              <div class="form-group">
                                 <label class="bmd-label-floating">Option 1 (Word)<span class="red">*</span></label>
                                 <input type="text" name="option3_1" id="option3_1" class="form-control classWord" value="{{ (isset($arrQuestion['question_3_option1']) && $arrQuestion['question_3_option1']!='') ? $arrQuestion['question_3_option1'] : '' }}" >
                                 <span class="error" id="err_option3_1"> @if($errors->has('option3_1')) {{ $errors->first('option3_1') }} @endif </span>
                              </div>
                           </div>
                           <div class="col-sm-3">
                              <div class="form-group">
                                 <label class="bmd-label-floating">Option 2 (Word)<span class="red">*</span></label>
                                 <input type="text" name="option3_2" id="option3_2" class="form-control classWord" value="{{ (isset($arrQuestion['question_3_option2']) && $arrQuestion['question_3_option2']!='') ? $arrQuestion['question_3_option2'] : '' }}" >
                                 <span class="error" id="err_option3_2"> @if($errors->has('option3_2')) {{ $errors->first('option3_2') }} @endif </span>
                              </div>
                           </div>
                           <div class="col-sm-3">
                              <div class="form-group">
                                 <label class="bmd-label-floating">Option 3 (Word)<span class="red">*</span></label>
                                 <input type="text" name="option3_3" id="option3_3" class="form-control classWord" value="{{ (isset($arrQuestion['question_3_option3']) && $arrQuestion['question_3_option3']!='') ? $arrQuestion['question_3_option3'] : '' }}" >
                                 <span class="error" id="err_option3_3"> @if($errors->has('option3_3')) {{ $errors->first('option3_3') }} @endif </span>
                              </div>
                           </div>
                        </div>
                        <div class="row" style="position: relative;">
                           <div class="col-sm-3">
                              <div class="radio-btns">
                                 <div class="radio-btn radio-first-option">
                                    <input type="radio" id="rdoOption3_1" name="rdoOption3" value="1" @if(isset($arrQuestion['question_3_answer']) && $arrQuestion['question_3_answer']==1) checked @endif >
                                    <label for="rdoOption3_1">Option 1</label>
                                    <div class="check"></div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-sm-3">
                              <div class="radio-btns">
                                 <div class="radio-btn radio-first-option">
                                    <input type="radio" id="rdoOption3_2" name="rdoOption3" value="2" @if(isset($arrQuestion['question_3_answer']) && $arrQuestion['question_3_answer']==2) checked @endif>
                                    <label for="rdoOption3_2">Option 2</label>
                                    <div class="check"></div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-sm-3">
                              <div class="radio-btns">
                                 <div class="radio-btn radio-first-option">
                                    <input type="radio" id="rdoOption3_3" name="rdoOption3" value="3" @if(isset($arrQuestion['question_3_answer']) && $arrQuestion['question_3_answer']==3) checked @endif >
                                    <label for="rdoOption3_3">Option 3</label>
                                    <div class="check"></div>
                                 </div>
                              </div>
                           </div>
                           <span class="error" id="err_rdoOption3" style="left: 15px;bottom: -15px;"> @if($errors->has('rdoOption3')) {{ $errors->first('rdoOption3') }} @endif</span>        
                        </div>
                        <span class="note-section-block form-note-section" style="margin-top: 15px;"><b>Note :</b> <span><span>Select any one option which is correct answer</span></span></span>
                        <div class="row">
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
   function validateForm(){
          var direction = $('#direction').val();
          var question1 = $('#question1').val();
          var option1_1 = $('#option1_1').val();
          var option1_2 = $('#option1_2').val();
          var option1_3 = $('#option1_3').val();
          var rdoOption1 = $('input[name="rdoOption1"]:checked').val();
          var question2 = $('#question2').val();
          var option2_1 = $('#option2_1').val();
          var option2_2 = $('#option2_2').val();
          var option2_3 = $('#option2_3').val();
          var rdoOption2 = $('input[name="rdoOption2"]:checked').val();
          var question3 = $('#question3').val();
          var option3_1 = $('#option3_1').val();
          var option3_2 = $('#option3_2').val();
          var option3_3 = $('#option3_3').val();
          var rdoOption3 = $('input[name="rdoOption3"]:checked').val();
          var flHorn   = $('#flHorn').val();
          var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);
   
          var minute      = $('input[name="minute"]').val();
          var second      = $('input[name="second"]').val();
          var duration    = parseInt(minute)*60 + parseInt(second);
          
          var flag = 0;
   
          $('#err_direction').html('');
          $('#err_question1').html('');
          $('#err_option1_1').html('');
          $('#err_option1_2').html('');
          $('#err_option1_3').html('');
          $('#err_rdoOption1').html('');
          $('#err_question2').html('');
          $('#err_option2_1').html('');
          $('#err_option2_2').html('');
          $('#err_option2_3').html('');
          $('#err_rdoOption2').html('');
          $('#err_question3').html('');
          $('#err_option3_1').html('');
          $('#err_option3_2').html('');
          $('#err_option3_3').html('');
          $('#err_rdoOption3').html('');
          $('#err_flHorn').html('');
          $('#err_duration').html('');
   
          if($.trim(direction)=='')
          {
             $('#err_direction').html('This field is required.');
             flag = 1;
          }
   
          if($.trim(question1)=='')
          {
             $('#err_question1').html('This field is required.');
             flag = 1;
          }
          if($.trim(option1_1)=='')
          {
             $('#err_option1_1').html('This field is required.');
             flag = 1;
          }
          if($.trim(option1_2)=='')
          {
             $('#err_option1_2').html('This field is required.');
             flag = 1;
          }
          if($.trim(option1_3)=='')
          {
             $('#err_option1_3').html('This field is required.');
             flag = 1;
          }
          if(rdoOption1==null)
          {
              $('#err_rdoOption1').html('Choose one option as answer');
              flag = 1;
          }
   
          if($.trim(question2)=='')
          {
             $('#err_question2').html('This field is required.');
             flag = 1;
          }
          if($.trim(option2_1)=='')
          {
             $('#err_option2_1').html('This field is required.');
             flag = 1;
          }
          if($.trim(option2_2)=='')
          {
             $('#err_option2_2').html('This field is required.');
             flag = 1;
          }
          if($.trim(option2_3)=='')
          {
             $('#err_option2_3').html('This field is required.');
             flag = 1;
          }
          if(rdoOption2==null)
          {
              $('#err_rdoOption2').html('Choose one option as answer');
              flag = 1;
          }
   
          if($.trim(question3)=='')
          {
             $('#err_question3').html('This field is required.');
             flag = 1;
          }
          if($.trim(option3_1)=='')
          {
             $('#err_option3_1').html('This field is required.');
             flag = 1;
          }
          if($.trim(option3_2)=='')
          {
             $('#err_option3_2').html('This field is required.');
             flag = 1;
          }
          if($.trim(option3_3)=='')
          {
             $('#err_option3_3').html('This field is required.');
             flag = 1;
          }
          if(rdoOption3==null)
          {
              $('#err_rdoOption3').html('Choose one option as answer');
              flag = 1;
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
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
                        </div>
                        <div class="row">
                           <div class="col-sm-12">
                              <div class="form-group m-b-10">
                                 <label class="bmd-label-floating">Question <span class="red">*</span></label>
                                 <input type="text" name="question" id="question" class="form-control" value="{{ (isset($arrQuestion['question_text']) && $arrQuestion['question_text']!='') ? $arrQuestion['question_text'] : '' }}" >
                                 <span class="error" id="err_question"> @if($errors->has('question')) {{ $errors->first('question') }} @endif </span>
                              </div>
                              <span class="note-section-block form-note-section"><b>Note :</b> <span><i><b>#BLANK#</b></i> This keyword is used for <b>Blank Word</b>.</span></span>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-sm-3">
                              <div class="form-group">
                                 <label class="bmd-label-floating">Option 1 (Word)<span class="red">*</span></label>
                                 <input type="text" name="option1" id="option1" class="form-control classWord" value="{{ (isset($arrQuestion['option1']) && $arrQuestion['option1']!='') ? $arrQuestion['option1'] : '' }}" >
                                 <span class="error" id="err_option1"> @if($errors->has('option1')) {{ $errors->first('option1') }} @endif </span>
                              </div>
                              <div class="radio-btns">
                                 <div class="radio-btn radio-first-option m-b-20">
                                    <input type="radio" id="rdoOption1" name="rdoOption" value="1" @if(isset($arrQuestion['answer']) && $arrQuestion['answer']==1) checked @endif >
                                    <label for="rdoOption1">Option 1</label>
                                    <div class="check"></div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-sm-3">
                              <div class="form-group">
                                 <label class="bmd-label-floating">Option 2 (Word)</label>
                                 <input type="text" name="option2" id="option2" class="form-control classWord" value="{{ (isset($arrQuestion['option2']) && $arrQuestion['option2']!='') ? $arrQuestion['option2'] : '' }}" >
                                 <span class="error" id="err_option2"> @if($errors->has('option2')) {{ $errors->first('option2') }} @endif </span>
                              </div>
                              <div class="radio-btns">
                                 <div class="radio-btn m-b-20">
                                    <input type="radio" id="rdoOption2" name="rdoOption" value="2" @if(isset($arrQuestion['answer']) && $arrQuestion['answer']==2) checked @endif>
                                    <label for="rdoOption2">Option 1</label>
                                    <div class="check"></div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-sm-3">
                              <div class="form-group">
                                 <label class="bmd-label-floating">Option 3 (Word)</label>
                                 <input type="text" name="option3" id="option3" class="form-control classWord" value="{{ (isset($arrQuestion['option3']) && $arrQuestion['option3']!='') ? $arrQuestion['option3'] : '' }}" >
                                 <span class="error" id="err_option3"> @if($errors->has('option3')) {{ $errors->first('option3') }} @endif </span>
                              </div>
                              <div class="radio-btns">
                                 <div class="radio-btn m-b-20">
                                    <input type="radio" id="rdoOption3" name="rdoOption" value="3" @if(isset($arrQuestion['answer']) && $arrQuestion['answer']==3) checked @endif >
                                    <label for="rdoOption3">Option 3</label>
                                    <div class="check"></div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-sm-3">
                              <div class="form-group">
                                 <label class="bmd-label-floating">Option 4 (Word)</label>
                                 <input type="text" name="option4" id="option4" class="form-control classWord" value="{{ (isset($arrQuestion['option4']) && $arrQuestion['option4']!='') ? $arrQuestion['option4'] : '' }}" >
                                 <span class="error" id="err_option4"> @if($errors->has('option4')) {{ $errors->first('option4') }} @endif </span>
                              </div>
                              <div class="radio-btns">
                                 <div class="radio-btn m-b-20">
                                    <input type="radio" id="rdoOption4" name="rdoOption" value="4" @if(isset($arrQuestion['answer']) && $arrQuestion['answer']==4) checked @endif >
                                    <label for="rdoOption4">Option 4</label>
                                    <div class="check"></div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-sm-12">                                        
                              <span class="error" id="err_rdoOption"> @if($errors->has('rdoOption')) {{ $errors->first('rdoOption') }} @endif </span>
                           </div>
                           <!-- <span class="note-section-block"><b>Note :</b> <span><span>Select any one option which is correct answer</span></span></span> -->       
                           <div class="clearfix"></div>
                           <span class="note-section-block form-note-section m-t-10 m-b-20"><b>Note :</b> <span>Select any one option which is correct answer</span></span>
                        </div>
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
<!-- Template Preview Modal End  -->

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
 
   function validateForm()
   {
          var direction = $('#direction').val();
          var question  = $('#question').val();
          var option1   = $('#option1').val();
          var option2   = $('#option2').val();
          var option3   = $('#option3').val();
          var option4   = $('#option4').val();
          var rdoOption = $('input[name="rdoOption"]:checked').val();
          var flHorn    = $('#flHorn').val();
          var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);
     
          var minute     = $('input[name="minute"]').val();
          var second     = $('input[name="second"]').val();
          var duration   = parseInt(minute)*60 + parseInt(second);
     
          var flag = 0;
     
          $('#err_direction').html('');
          $('#err_question').html('');
          $('#err_option1').html('');
          $('#err_option2').html('');
          $('#err_option3').html('');
          $('#err_option4').html('');
          $('#err_rdoOption').html('');
          $('#err_flHorn').html('');
          $('#err_duration').html('');
     
          if($.trim(direction)=='')
          {
             $('#err_direction').html('This field is required.');
             flag = 1;
          }
     
          if($.trim(question)=='')
          {
             $('#err_question').html('This field is required.');
             flag = 1;
          }
          else
          {
             var questionAnsArr = question.match(/#BLANK#/g);
             if(questionAnsArr==null)
             {
               $('#err_question').html('#BLANK# is missing');
               flag = 1;    
             }
             else
             {
               var questionAnsCount = questionAnsArr.length;  
               if(parseInt(questionAnsCount)!=1)
               {
                 $('#err_question').html('Only one #BLANK# is allowed');
                 flag = 1;       
               }
             }
          }
     
          if($.trim(option1)=='')
          {
             $('#err_option1').html('This field is required.');
             flag = 1;
          }
     
          if($.trim(option2)=='')
          {
             $('#err_option2').html('This field is required.');
             flag = 1;
          }
     
          if($.trim(option3)=='')
          {
             $('#err_option3').html('This field is required.');
             flag = 1;
          }
     
          if($.trim(option4)=='')
          {
             $('#err_option4').html('This field is required.');
             flag = 1;
          }
     
          if(rdoOption==null)
          {
              $('#err_rdoOption').html('Check one option as answer');
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

    $("#popup_template_preview").on('shown.bs.modal', function(){
        $('html').removeClass('perfect-scrollbar-on');
        $('.modal-backdrop').addClass('dark-bg');
        if($(".game-img-section").height() != 'undefined')
        { $(".game-fill-text-section").css('height', $(".game-img-section").height());}
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
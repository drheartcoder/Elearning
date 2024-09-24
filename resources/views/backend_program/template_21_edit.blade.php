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
                           <div class="col-sm-6">
                              <div class="form-group">
                                 <label class="bmd-label-floating">Question 1 (Word) <span class="red">*</span></label>
                                 <input type="text" name="question1" id="question1" class="form-control classWord" value="{{ (isset($arrQuestion['question_1']) && $arrQuestion['question_1']!='') ? $arrQuestion['question_1'] : '' }}" >
                                 <span class="error" id="err_question1"> @if($errors->has('question1')) {{ $errors->first('question1') }} @endif </span>
                              </div>
                           </div>
                           <div class="col-sm-6">
                              <div class="form-group">
                                 <label class="bmd-label-floating">Question 1 Answer (Word)<span class="red">*</span></label>
                                 <input type="text" name="answer1" id="answer1" class="form-control classWord" value="{{ (isset($arrQuestion['answer_1']) && $arrQuestion['answer_1']!='') ? $arrQuestion['answer_1'] : '' }}" >
                                 <span class="error" id="err_answer1"> @if($errors->has('answer1')) {{ $errors->first('answer1') }} @endif </span>
                              </div>
                           </div>
                           <div class="col-sm-6">
                              <div class="form-group">
                                 <label class="bmd-label-floating">Question 2 (Word) <span class="red">*</span></label>
                                 <input type="text" name="question2" id="question2" class="form-control classWord" value="{{ (isset($arrQuestion['question_2']) && $arrQuestion['question_2']!='') ? $arrQuestion['question_2'] : '' }}" >
                                 <span class="error" id="err_question2"> @if($errors->has('question2')) {{ $errors->first('question2') }} @endif </span>
                              </div>
                           </div>
                           <div class="col-sm-6">
                              <div class="form-group">
                                 <label class="bmd-label-floating">Question 2 Answer (Word)<span class="red">*</span></label>
                                 <input type="text" name="answer2" id="answer2" class="form-control classWord" value="{{ (isset($arrQuestion['answer_2']) && $arrQuestion['answer_2']!='') ? $arrQuestion['answer_2'] : '' }}" >
                                 <span class="error" id="err_answer2"> @if($errors->has('answer2')) {{ $errors->first('answer2') }} @endif </span>
                              </div>
                           </div>
                           <div class="col-sm-6">
                              <div class="form-group">
                                 <label class="bmd-label-floating">Question 3 (Word) <span class="red">*</span></label>
                                 <input type="text" name="question3" id="question3" class="form-control classWord" value="{{ (isset($arrQuestion['question_3']) && $arrQuestion['question_3']!='') ? $arrQuestion['question_3'] : '' }}" >
                                 <span class="error" id="err_question3"> @if($errors->has('question3')) {{ $errors->first('question3') }} @endif </span>
                              </div>
                           </div>
                           <div class="col-sm-6">
                              <div class="form-group">
                                 <label class="bmd-label-floating">Question 3 Answer (Word)<span class="red">*</span></label>
                                 <input type="text" name="answer3" id="answer3" class="form-control classWord" value="{{ (isset($arrQuestion['answer_3']) && $arrQuestion['answer_3']!='') ? $arrQuestion['answer_3'] : '' }}" >
                                 <span class="error" id="err_answer3"> @if($errors->has('answer3')) {{ $errors->first('answer3') }} @endif </span>
                              </div>
                           </div>
                           <div class="col-sm-6">
                              <div class="form-group">
                                 <label class="bmd-label-floating">Question 4 (Word) <span class="red">*</span></label>
                                 <input type="text" name="question4" id="question4" class="form-control classWord" value="{{ (isset($arrQuestion['question_4']) && $arrQuestion['question_4']!='') ? $arrQuestion['question_4'] : '' }}" >
                                 <span class="error" id="err_question4"> @if($errors->has('question4')) {{ $errors->first('question4') }} @endif </span>
                              </div>
                           </div>
                           <div class="col-sm-6">
                              <div class="form-group">
                                 <label class="bmd-label-floating">Question 4 Answer (Word)<span class="red">*</span></label>
                                 <input type="text" name="answer4" id="answer4" class="form-control classWord" value="{{ (isset($arrQuestion['answer_4']) && $arrQuestion['answer_4']!='') ? $arrQuestion['answer_4'] : '' }}" >
                                 <span class="error" id="err_answer4"> @if($errors->has('answer4')) {{ $errors->first('answer4') }} @endif </span>
                              </div>
                           </div>
                           <div class="col-sm-6">
                              <div class="form-group">
                                 <label class="bmd-label-floating">Question 5 (Word) <span class="red">*</span></label>
                                 <input type="text" name="question5" id="question5" class="form-control classWord" value="{{ (isset($arrQuestion['question_5']) && $arrQuestion['question_5']!='') ? $arrQuestion['question_5'] : '' }}" >
                                 <span class="error" id="err_question5"> @if($errors->has('question5')) {{ $errors->first('question5') }} @endif </span>
                              </div>
                           </div>
                           <div class="col-sm-6">
                              <div class="form-group">
                                 <label class="bmd-label-floating">Question 5 Answer (Word)<span class="red">*</span></label>
                                 <input type="text" name="answer5" id="answer5" class="form-control classWord" value="{{ (isset($arrQuestion['answer_5']) && $arrQuestion['answer_5']!='') ? $arrQuestion['answer_5'] : '' }}" >
                                 <span class="error" id="err_answer5"> @if($errors->has('answer5')) {{ $errors->first('answer5') }} @endif </span>
                              </div>
                           </div>
                           <div class="col-sm-6">
                              <div class="form-group">
                                 <label class="bmd-label-floating">Question 6 (Word) <span class="red">*</span></label>
                                 <input type="text" name="question6" id="question6" class="form-control classWord" value="{{ (isset($arrQuestion['question_6']) && $arrQuestion['question_6']!='') ? $arrQuestion['question_6'] : '' }}" >
                                 <span class="error" id="err_question6"> @if($errors->has('question6')) {{ $errors->first('question6') }} @endif </span>
                              </div>
                           </div>
                           <div class="col-sm-6">
                              <div class="form-group">
                                 <label class="bmd-label-floating">Question 6 Answer (Word)<span class="red">*</span></label>
                                 <input type="text" name="answer6" id="answer6" class="form-control classWord" value="{{ (isset($arrQuestion['answer_6']) && $arrQuestion['answer_6']!='') ? $arrQuestion['answer_6'] : '' }}" >
                                 <span class="error" id="err_answer6"> @if($errors->has('answer6')) {{ $errors->first('answer6') }} @endif </span>
                              </div>
                           </div>
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
   function validateForm()
   {
        var direction = $('#direction').val();
       var question1 = $('#question1').val();
       var answer1 = $('#answer1').val();
       var question2 = $('#question2').val();
       var answer2 = $('#answer2').val();
       var question3 = $('#question3').val();
       var answer3 = $('#answer3').val();
       var question4 = $('#question4').val();
       var answer4 = $('#answer4').val();
       var question5 = $('#question5').val();
       var answer5 = $('#answer5').val();
       var question6 = $('#question6').val();
       var answer6 = $('#answer6').val();
       var flHorn   = $('#flHorn').val();
       var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);
   
       var minute      = $('input[name="minute"]').val();
       var second      = $('input[name="second"]').val();
       var duration    = parseInt(minute)*60 + parseInt(second);
   
       var flag = 0;
   
       $('#err_direction').html('');
       $('#err_question1').html('');
       $('#err_answer1').html('');
       $('#err_question2').html('');
       $('#err_answer2').html('');
       $('#err_question3').html('');
       $('#err_answer3').html('');
       $('#err_question4').html('');
       $('#err_answer4').html('');
       $('#err_question5').html('');
       $('#err_answer5').html('');
       $('#err_question6').html('');
       $('#err_answer6').html('');
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
        if($.trim(answer1)=='')
        {
           $('#err_answer1').html('This field is required.');
           flag = 1;  
        }
   
        if($.trim(question2)=='')
        {
           $('#err_question2').html('This field is required.');
           flag = 1;  
        }
        if($.trim(answer2)=='')
        {
           $('#err_answer2').html('This field is required.');
           flag = 1;  
        }
   
        if($.trim(question3)=='')
        {
           $('#err_question3').html('This field is required.');
           flag = 1;  
        }
        if($.trim(answer3)=='')
        {
           $('#err_answer3').html('This field is required.');
           flag = 1;  
        }
   
        if($.trim(question4)=='')
        {
           $('#err_question4').html('This field is required.');
           flag = 1;  
        }
        if($.trim(answer4)=='')
        {
           $('#err_answer4').html('This field is required.');
           flag = 1;  
        }
   
        if($.trim(question5)=='')
        {
           $('#err_question5').html('This field is required.');
           flag = 1;  
        }
        if($.trim(answer5)=='')
        {
           $('#err_answer5').html('This field is required.');
           flag = 1;  
        }
   
        if($.trim(question6)=='')
        {
           $('#err_question6').html('This field is required.');
           flag = 1;  
        }
        if($.trim(answer6)=='')
        {
           $('#err_answer6').html('This field is required.');
           flag = 1;  
        }
   
        if(flHorn != '')
        {
            if(!(flHornExt == "mp3" || flHornExt == "MP3" || flHornExt == "wave"))
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
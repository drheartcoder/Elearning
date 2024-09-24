@extends($role_slug.'.layout.master')    
@section('main_content')
<!-- BEGIN Main Content -->
<!-- Page header -->
@include($role_slug.'.layout.breadcrumb')  
<!-- /page header -->
<script src="{{url('/')}}/js/admin/jquery.form.js"></script> 
<script type="text/javascript" src="{{url('/')}}/js/MathJax-master/MathJax.js?config=TeX-AMS-MML_HTMLorMML" ></script>
<script type="text/javascript" src="{{url('/')}}/js/MathJax-master/MathJax.js?config=TeX-AMS_HTML" ></script>
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
                           <div class="col-sm-12">
                              <div class="row">
                                 <div class="col-sm-6">
                                    <label class="bmd-label-floating">Question 1 <span class="red">*</span></label>
                                    <div class="form-group editor-section-block">
                                       <textarea class="form-control ckeditor" name="question1_1" id="question1_1" placeholder="Question 1">{{ (isset($arrQuestion['question1']) && $arrQuestion['question1']!='') ? $arrQuestion['question1'] : '' }}</textarea> 
                                       <span class="error" id="err_question1_1"> @if($errors->has('question1_1')) {{ $errors->first('question1_1') }} @endif </span>
                                    </div>
                                 </div>
                                 <div class="col-sm-6">
                                    <div class="value-input-section">
                                       <?php
                                          $answer1_1 = $answer1_2 = '';
                                          $arrAnswer = [];
                                          if(isset($arrQuestion['answer1']) && $arrQuestion['answer1']!='')
                                          {
                                            $arrAnswer = explode(',', $arrQuestion['answer1']);
                                          }
                                          if(count($arrAnswer) > 0)
                                          {
                                            $answer1_1 = $arrAnswer[0];
                                            $answer1_2 = $arrAnswer[1];
                                          }
                                          ?>
                                       <label class="bmd-label-floating">Answer 1 <span class="red">*</span></label>
                                       <div class="value-input-section-one">
                                          <input type="text" class="digitCommon" name="answer1_1" id="answer1_1" value="{{ $answer1_1 }}" placeholder="3" maxlength="3" >
                                          <span class="error" id="err_answer1_1"> @if($errors->has('answer1_1')) {{ $errors->first('answer1_1') }} @endif </span>
                                       </div>
                                       <div class="underline-section"></div>
                                       <div class="value-input-section-one">
                                          <input type="text" class="digitCommon" name="answer1_2" id="answer1_2" value="{{ $answer1_2 }}" placeholder="7" maxlength="3" >
                                          <span class="error" id="err_answer1_2"> @if($errors->has('answer1_2')) {{ $errors->first('answer1_2') }} @endif </span>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-sm-12">
                              <div class="row">
                                 <div class="col-sm-6">
                                    <label class="bmd-label-floating">Question 2 </label>
                                    <div class="form-group editor-section-block">
                                       <textarea class="form-control ckeditor" name="question2_1" id="question2_1" placeholder="Question 2">{{ (isset($arrQuestion['question2']) && $arrQuestion['question2']!='') ? $arrQuestion['question2'] : '' }}</textarea> 
                                       <span class="error" id="err_question2_1"> @if($errors->has('question2_1')) {{ $errors->first('question2_1') }} @endif </span>
                                    </div>
                                 </div>
                                 <div class="col-sm-6">
                                    <div class="value-input-section">
                                       <?php
                                          $answer2_1 = $answer2_2 = '';
                                          $arrAnswer = [];
                                          if(isset($arrQuestion['answer2']) && $arrQuestion['answer2']!='')
                                          {
                                            $arrAnswer = explode(',', $arrQuestion['answer2']);
                                          }
                                          if(count($arrAnswer) > 0)
                                          {
                                            $answer2_1 = $arrAnswer[0];
                                            $answer2_2 = $arrAnswer[1];
                                          }
                                          ?>
                                       <label class="bmd-label-floating">Answer 2 </label>
                                       <div class="value-input-section-one">
                                          <input type="text" class="digitCommon" name="answer2_1" id="answer2_1" value="{{ $answer2_1 }}" placeholder="3" maxlength="3" >
                                          <span class="error" id="err_answer2_1"> @if($errors->has('answer2_1')) {{ $errors->first('answer2_1') }} @endif </span>
                                       </div>
                                       <div class="underline-section"></div>
                                       <div class="value-input-section-one">
                                          <input type="text" class="digitCommon" name="answer2_2" id="answer2_2" value="{{ $answer2_2 }}" placeholder="7" maxlength="3" >
                                          <span class="error" id="err_answer2_2"> @if($errors->has('answer2_2')) {{ $errors->first('answer2_2') }} @endif </span>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-sm-12">
                              <div class="row">
                                 <div class="col-sm-6">
                                    <label class="bmd-label-floating">Question 3 </label>
                                    <div class="form-group editor-section-block">
                                       <textarea class="form-control ckeditor" name="question3_1" id="question3_1" placeholder="Question 3">{{ (isset($arrQuestion['question3']) && $arrQuestion['question3']!='') ? $arrQuestion['question3'] : '' }}</textarea> 
                                       <span class="error" id="err_question3_1"> @if($errors->has('question3_1')) {{ $errors->first('question3_1') }} @endif </span>
                                    </div>
                                 </div>
                                 <div class="col-sm-6">
                                    <div class="value-input-section">
                                       <?php
                                          $answer3_1 = $answer3_2 = '';
                                          $arrAnswer = [];
                                          if(isset($arrQuestion['answer3']) && $arrQuestion['answer3']!='')
                                          {
                                            $arrAnswer = explode(',', $arrQuestion['answer3']);
                                          }
                                          if(count($arrAnswer) > 0)
                                          {
                                            $answer3_1 = $arrAnswer[0];
                                            $answer3_2 = $arrAnswer[1];
                                          }
                                          ?>
                                       <label class="bmd-label-floating">Answer 3 </label>
                                       <div class="value-input-section-one">
                                          <input type="text" class="digitCommon" name="answer3_1" id="answer3_1" value="{{ $answer3_1 }}" placeholder="3" maxlength="3" >
                                          <span class="error" id="err_answer3_1"> @if($errors->has('answer3_1')) {{ $errors->first('answer3_1') }} @endif </span>
                                       </div>
                                       <div class="underline-section"></div>
                                       <div class="value-input-section-one">
                                          <input type="text" class="digitCommon" name="answer3_2" id="answer3_2" value="{{ $answer3_2 }}" placeholder="7" maxlength="3" >
                                          <span class="error" id="err_answer3_2"> @if($errors->has('answer3_2')) {{ $errors->first('answer3_2') }} @endif </span>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-sm-12">
                              <div class="row">
                                 <div class="col-sm-6">
                                    <label class="bmd-label-floating">Question 4 </label>
                                    <div class="form-group editor-section-block">
                                       <textarea class="form-control ckeditor" name="question4_1" id="question4_1" placeholder="Question 4">{{ (isset($arrQuestion['question4']) && $arrQuestion['question4']!='') ? $arrQuestion['question4'] : '' }}</textarea> 
                                       <span class="error" id="err_question4_1"> @if($errors->has('question4_1')) {{ $errors->first('question4_1') }} @endif </span>
                                    </div>
                                 </div>
                                 <div class="col-sm-6">
                                    <div class="value-input-section">
                                       <?php
                                          $answer4_1 = $answer4_2 = '';
                                          $arrAnswer = [];
                                          if(isset($arrQuestion['answer4']) && $arrQuestion['answer4']!='')
                                          {
                                            $arrAnswer = explode(',', $arrQuestion['answer4']);
                                          }
                                          if(count($arrAnswer) > 0)
                                          {
                                            $answer4_1 = $arrAnswer[0];
                                            $answer4_2 = $arrAnswer[1];
                                          }
                                          ?>
                                       <label class="bmd-label-floating">Answer 4 </label>
                                       <div class="value-input-section-one">
                                          <input type="text" class="digitCommon" name="answer4_1" id="answer4_1" value="{{ $answer4_1 }}" placeholder="3" maxlength="3" >
                                          <span class="error" id="err_answer4_1"> @if($errors->has('answer4_1')) {{ $errors->first('answer4_1') }} @endif </span>
                                       </div>
                                       <div class="underline-section"></div>
                                       <div class="value-input-section-one">
                                          <input type="text" class="digitCommon" name="answer4_2" id="answer4_2" value="{{ $answer4_2 }}" placeholder="7" maxlength="3" >
                                          <span class="error" id="err_answer4_2"> @if($errors->has('answer4_2')) {{ $errors->first('answer4_2') }} @endif </span>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-sm-12">
                              <div class="row">
                                 <div class="col-sm-6">
                                    <label class="bmd-label-floating">Question 5 </label>
                                    <div class="form-group editor-section-block">
                                       <textarea class="form-control ckeditor" name="question5_1" id="question5_1" placeholder="Question 5">{{ (isset($arrQuestion['question5']) && $arrQuestion['question5']!='') ? $arrQuestion['question5'] : '' }}</textarea> 
                                       <span class="error" id="err_question5_1"> @if($errors->has('question5_1')) {{ $errors->first('question5_1') }} @endif </span>
                                    </div>
                                 </div>
                                 <div class="col-sm-6">
                                    <div class="value-input-section">
                                       <?php
                                          $answer5_1 = $answer5_2 = '';
                                          $arrAnswer = [];
                                          if(isset($arrQuestion['answer5']) && $arrQuestion['answer5']!='')
                                          {
                                            $arrAnswer = explode(',', $arrQuestion['answer5']);
                                          }
                                          if(count($arrAnswer) > 0)
                                          {
                                            $answer5_1 = $arrAnswer[0];
                                            $answer5_2 = $arrAnswer[1];
                                          }
                                          ?>
                                       <label class="bmd-label-floating">Answer 5 </label>
                                       <div class="value-input-section-one">
                                          <input type="text" class="digitCommon" name="answer5_1" id="answer5_1" value="{{ $answer5_1 }}" placeholder="3" maxlength="3" >
                                          <span class="error" id="err_answer5_1"> @if($errors->has('answer5_1')) {{ $errors->first('answer5_1') }} @endif </span>
                                       </div>
                                       <div class="underline-section"></div>
                                       <div class="value-input-section-one">
                                          <input type="text" class="digitCommon" name="answer5_2" id="answer5_2" value="{{ $answer5_2 }}" placeholder="7" maxlength="3" >
                                          <span class="error" id="err_answer5_2"> @if($errors->has('answer5_2')) {{ $errors->first('answer5_2') }} @endif </span>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-sm-12">
                              <div class="row">
                                 <div class="col-sm-6">
                                    <label class="bmd-label-floating">Question 6 </label>
                                    <div class="form-group editor-section-block">
                                       <textarea class="form-control ckeditor" name="question6_1" id="question6_1" placeholder="Question 6">{{ (isset($arrQuestion['question6']) && $arrQuestion['question6']!='') ? $arrQuestion['question6'] : '' }}</textarea> 
                                       <span class="error" id="err_question6_1"> @if($errors->has('question6_1')) {{ $errors->first('question6_1') }} @endif </span>
                                    </div>
                                 </div>
                                 <div class="col-sm-6">
                                    <div class="value-input-section">
                                       <?php
                                          $answer6_1 = $answer6_2 = '';
                                          $arrAnswer = [];
                                          if(isset($arrQuestion['answer6']) && $arrQuestion['answer6']!='')
                                          {
                                            $arrAnswer = explode(',', $arrQuestion['answer6']);
                                          }
                                          if(count($arrAnswer) > 0)
                                          {
                                            $answer6_1 = $arrAnswer[0];
                                            $answer6_2 = $arrAnswer[1];
                                          }
                                          ?>
                                       <label class="bmd-label-floating">Answer 6 <span class="red">*</span></label>
                                       <div class="value-input-section-one">
                                          <input type="text" class="digitCommon" name="answer6_1" id="answer6_1" value="{{ $answer6_1 }}" placeholder="3" maxlength="3" >
                                          <span class="error" id="err_answer6_1"> @if($errors->has('answer6_1')) {{ $errors->first('answer6_1') }} @endif </span>
                                       </div>
                                       <div class="underline-section"></div>
                                       <div class="value-input-section-one">
                                          <input type="text" class="digitCommon" name="answer6_2" id="answer6_2" value="{{ $answer6_2 }}" placeholder="7" maxlength="3" >
                                          <span class="error" id="err_answer6_2"> @if($errors->has('answer5_2')) {{ $errors->first('answer6_2') }} @endif </span>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!-- <div class="col-sm-12">      
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
                              </div> -->
                           <div class="row">
                              <div class="col-sm-12">
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

<script type="text/javascript" language="javascript" src="{{url('/')}}/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
   $(document).ready(function(){
     $('.dwCommon').selectpicker();
   });
   function validateForm(){
       var direction = $('#direction').val();
             
       var question1_1=CKEDITOR.instances['question1_1'].getData().replace(/<[^>]*>/gi, '').length;
       var answer1_1 = $('#answer1_1').val();
       var answer1_2 = $('#answer1_2').val();

       
       /*var flHorn   = $('#flHorn').val();
       var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);*/
   
       var minute      = $('input[name="minute"]').val();
       var second      = $('input[name="second"]').val();
       var duration    = parseInt(minute)*60 + parseInt(second);
   
       var flag = 0;
   
       $('#err_direction').html('');
   
       $('#err_question1_1').html('');
       $('#err_answer1_1').html('');
       $('#err_answer1_2').html('');

       
       /*$('#err_flHorn').html('');*/
   
       $('#err_duration').html('');
       
        if($.trim(direction)=='')
        {
            $('#err_direction').html('This field is required.');
            flag = 1;
        }
   
        if(question1_1=='')
        {
            $('#err_question1_1').html('This field is required.');
            flag = 1;
        }
        if(answer1_1=='')
        {
            $('#err_answer1_1').html('This field is required.');
            flag = 1;
        }
        else if(isNaN(answer1_1))
        {
            $('#err_answer1_1').html('Invalid field value.');
            flag = 1;
        }
        if(answer1_2=='')
        {
            $('#err_answer1_2').html('This field is required.');
            flag = 1;
        }
        else if(isNaN(answer1_2))
        {
            $('#err_answer1_2').html('Invalid field value.');
            flag = 1;
        }
         for (var i = 2; i <= 6; i++)
         {

               var question  =CKEDITOR.instances['question'+i+'_1'].getData().replace(/<[^>]*>/gi, '').length;
               var answer1 = $('#answer'+i+'_1').val();
               var answer2 = $('#answer'+i+'_2').val();

               $('#err_question'+i+'_1').html('');
               $('#err_answer'+i+'_1').html('');
               $('#err_answer'+i+'_2').html('');

               if($.trim(question)!=0 || $.trim(answer1)!='' || $.trim(answer2)!='')
               {
                  if(question=='')
                  {
                      $('#err_question'+i+'_1').html('This field is required.');
                      flag = 1;
                  }
                  if(answer1=='')
                  {
                      $('#err_answer'+i+'_1').html('This field is required.');
                      flag = 1;
                  }
                  else if(isNaN(answer1))
                  {
                      $('#err_answer'+i+'_1').html('Invalid field value.');
                      flag = 1;
                  }
                  if(answer2=='')
                  {
                      $('#err_answer'+i+'_2').html('This field is required.');
                      flag = 1;
                  }
                  else if(isNaN(answer2))
                  {
                      $('#err_answer'+i+'_2').html('Invalid field value.');
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

          var question1_1=CKEDITOR.instances['question1_1'].getData();
          var question2_1=CKEDITOR.instances['question2_1'].getData();
          var question3_1=CKEDITOR.instances['question3_1'].getData();
          var question4_1=CKEDITOR.instances['question4_1'].getData();
          var question5_1=CKEDITOR.instances['question5_1'].getData();
          var question6_1=CKEDITOR.instances['question6_1'].getData();

          formData.append('question1_1',question1_1);
          formData.append('question2_1',question2_1);
          formData.append('question3_1',question3_1);
          formData.append('question4_1',question4_1);
          formData.append('question5_1',question5_1);
          formData.append('question6_1',question6_1);


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
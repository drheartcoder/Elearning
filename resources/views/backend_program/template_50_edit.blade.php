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
               <div class="card-body temp-50">
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
                              <label class="bmd-label-floating">Clock A <span class="red">*</span></label>                          
                              <div class="form-group">
                                 <input type="text" name="question1" id="question1" class="form-control timepicker" value="{{ (isset($arrQuestion['question_1']) && $arrQuestion['question_1']!='') ? $arrQuestion['question_1'] : '' }}" >
                                 <span class="error" id="err_question1"> @if($errors->has('question1')) {{ $errors->first('question1') }} @endif </span>
                              </div>
                           </div>
                           <div class="col-sm-6">
                              <label class="bmd-label-floating">Clock B <span class="red">*</span></label>                          
                              <div class="form-group">
                                 <input type="text" name="question2" id="question2" class="form-control timepicker" value="{{ (isset($arrQuestion['question_2']) && $arrQuestion['question_2']!='') ? $arrQuestion['question_2'] : '' }}" >
                                 <span class="error" id="err_question2"> @if($errors->has('question2')) {{ $errors->first('question2') }} @endif </span>
                              </div>
                           </div>
                           <div class="col-sm-4">
                              <div class="form-group">
                                 <label class="bmd-label-floating">Option 1 <span class="red">*</span></label>
                                 <input type="text" name="option_1" id="option_1" class="form-control classWord" value="{{ (isset($arrQuestion['option_1']) && $arrQuestion['option_1']!='') ? $arrQuestion['option_1'] : '' }}" >
                                 <span class="error" id="err_option_1"> @if($errors->has('option_1')) {{ $errors->first('option_1') }} @endif </span>
                              </div>
                              <div class="form-group">
                                 <label class="bmd-label-floating">Option 2 <span class="red">*</span></label>
                                 <input type="text" name="option_2" id="option_2" class="form-control classWord" value="{{ (isset($arrQuestion['option_2']) && $arrQuestion['option_2']!='') ? $arrQuestion['option_2'] : '' }}" >
                                 <span class="error" id="err_option_2"> @if($errors->has('option_2')) {{ $errors->first('option_2') }} @endif </span>
                              </div>
                              <div class="form-group">
                                 <label class="bmd-label-floating">Option 3 </label>
                                 <input type="text" name="option_3" id="option_3" class="form-control classWord" value="{{ (isset($arrQuestion['option_3']) && $arrQuestion['option_3']!='') ? $arrQuestion['option_3'] : '' }}" >
                                 <span class="error" id="err_option_3"> @if($errors->has('option_3')) {{ $errors->first('option_3') }} @endif </span>
                              </div>
                              <div class="form-group">
                                 <label class="bmd-label-floating">Option 4 </label>
                                 <input type="text" name="option_4" id="option_4" class="form-control classWord" value="{{ (isset($arrQuestion['option_4']) && $arrQuestion['option_4']!='') ? $arrQuestion['option_4'] : '' }}" >
                                 <span class="error" id="err_option_4"> @if($errors->has('option_4')) {{ $errors->first('option_4') }} @endif </span>
                              </div>
                           </div>
                           <div class="col-sm-4">
                              <div class="radio-btns" style="padding-top: 15px;">
                                 <div class="radio-btn radio-first-option">
                                    <input type="radio" id="rdoOption_1" name="rdoOption1" value="1" @if(isset($arrQuestion['answer']) && $arrQuestion['answer']==1) checked @endif >
                                    <label for="rdoOption_1">Option 1</label>
                                    <div class="check"></div>
                                 </div>
                                 <div class="radio-btn radio-first-option">
                                    <input type="radio" id="rdoOption_2" name="rdoOption1" value="2" @if(isset($arrQuestion['answer']) && $arrQuestion['answer']==2) checked @endif >
                                    <label for="rdoOption_2">Option 2</label>
                                    <div class="check"></div>
                                 </div>
                                 <div class="radio-btn radio-first-option">
                                    <input type="radio" id="rdoOption_3" name="rdoOption1" value="3" @if(isset($arrQuestion['answer']) && $arrQuestion['answer']==3) checked @endif >
                                    <label for="rdoOption_3">Option 3</label>
                                    <div class="check"></div>
                                 </div>
                                 <div class="radio-btn">
                                    <input type="radio" id="rdoOption_4" name="rdoOption1" value="4" @if(isset($arrQuestion['answer']) && $arrQuestion['answer']==4) checked @endif >
                                    <label for="rdoOption_4">Option 4</label>
                                    <div class="check"></div>
                                 </div>
                                 <span class="error" id="err_rdoOption1"> @if($errors->has('rdoOption1')) {{ $errors->first('rdoOption1') }} @endif </span>
                                 <span class="note-section-block radio-note-section-temo-20"><b>Note :</b> <span><span>Select any one option which is correct answer
                                 </span></span></span>
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
   $(document).ready(function(){
       // initialise Datetimepicker and Sliders
       md.initFormExtendedDatetimepickers();
       if($('.slider').length != 0){
         md.initSliders();
       }
     });

   function validateForm()
   {
     var direction = $('#direction').val();
     var question1 = $('#question1').val();
     var question2 = $('#question2').val();
     var option_1  = $('#option_1').val();
     var rdoOption_1 = $('input[name="rdoOption_1"]:checked').val();
     /*var flHorn   = $('#flHorn').val();
     var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);*/

     var minute      = $('input[name="minute"]').val();
     var second      = $('input[name="second"]').val();
     var duration    = parseInt(minute)*60 + parseInt(second);

     var flag = 0;

     $('#err_direction').html('');
     $('#err_question1').html('');
     $('#err_question2').html('');
     $('#err_option_1').html('');
     $('#err_rdoOption_1').html('');
     /*$('#err_flHorn').html('');*/
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
      if($.trim(question2)=='')
      {
         $('#err_question2').html('This field is required.');
         flag = 1;  
      }
      if($.trim(option_1)=='')
      {
         $('#err_option_1').html('This field is required.');
         flag = 1;  
      }
      for (var i = 2; i <= 4; i++)
      {
          $('#err_option_'+i).html('');
          var option  = $('#option_'+i).val();
           if($("#rdoOption_"+i).prop("checked"))
           {
               if($.trim(option)=='')
               {
                  $('#err_option_'+i).html('This field is required.');
                  flag = 1;  
               }
           }
      }
      if($.trim(rdoOption_1)==null)
      {
         $('#err_rdoOption_1').html('This field is required.');
         flag = 1;  
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
        if(flag==false)
        {
         return false;
        }
        else
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
   /*IMAGE : PREVIEW*/
   $(document).on('change', '.imgFile', function(){
      var id = $(this).closest('.profile-img-block').find('.imgFilePreview').attr('id'); 
      readURL(this, id);
   });
   function readURL(input, id) {
     if (input.files && input.files[0]) {
       var reader = new FileReader();
if(file_size>max_file_size)

                  {
                      swal("Sorry, max "+max_file_size+" Kb size is allowed");
                      
                      $(".imgFile").val('');
                      return false;
                  }
       var defaultImage = '{{ url("/") }}/images/default.jpg';
       var extension = input.files[0]['name'].substr( input.files[0]['name'].lastIndexOf('.') +1 );
       /*console.log(defaultImage+'===='+extension);*/
       /*console.log(input);
       console.log(input.files[0]['name']);*/
       reader.onload = function(e) {
         if(extension.toLowerCase()=='jpg' || extension.toLowerCase()=='jpeg' || extension.toLowerCase()=='png')
         {
           $('#'+id).attr('src', e.target.result);
         }
         else
         {
           $('#'+id).attr('src', defaultImage); 
         }
       }
       reader.readAsDataURL(input.files[0]);
     }
   }
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
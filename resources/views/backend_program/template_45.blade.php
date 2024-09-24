<div class="devSubWrapper">
   <div class="row">
      <div class="col-sm-12">
         <div class="form-group">
            <label class="bmd-label-floating">Direction </label>
            <input type="text" name="direction" id="direction" class="form-control" value="{{ old('direction') }}">
            <span class="error" id="err_direction"> @if($errors->has('direction')) {{ $errors->first('direction') }} @endif </span>
         </div>
      </div>
      <!-- QUESTION : 1 -->
      <div class="col-sm-12">
         <label class="col-form-label">Question 1 File (Image) <span class="red">*</span></label>
         <div style="position: relative;" class="form-group">
            <div class="profile-img-block temp-img-block">
               <div class="pro-img">
                  <img src="{{ url('/') }}/images/default.jpg" id="imgFilePreview1" class="img-responsive img-preview imgFilePreview" alt=""/>
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
            <input type="text" name="question1_1" id="question1_1" class="form-control" value="{{ old('question1_1') }}" >
            <span class="error" id="err_question1_1"> @if($errors->has('question1_1')) {{ $errors->first('question1_1') }} @endif </span>
         </div>
         <span class="note-section-block form-note-section"><b>Note :</b> <span><i><b>#BLANK#</b></i> This keyword is used for <b>Blank Word</b>.</span></span>                                       
      </div>
      <div class="col-sm-5">
         <div class="form-group m-b-10">
            <label class="bmd-label-floating">Answer 1 <span class="red">*</span></label>
            <input type="text" name="answer1_1" id="answer1_1" class="form-control" value="{{ old('answer1_1') }}" >
            <span class="error" id="err_answer1_1"> @if($errors->has('answer1_1')) {{ $errors->first('answer1_1') }} @endif </span>
         </div>
         <span class="note-section-block form-note-section m-b-10"><b>Note :</b> <span>Enter answers(Words) by comma-separated [Multiple answers]</span></span>
      </div>
      <div class="col-sm-7">
         <div class="form-group m-b-10">
            <label class="bmd-label-floating">Question 2 </label>
            <input type="text" name="question1_2" id="question1_2" class="form-control" value="{{ old('question1_2') }}" >
            <span class="error" id="err_question1_2"> @if($errors->has('question1_2')) {{ $errors->first('question1_2') }} @endif </span>
         </div>
         <span class="note-section-block form-note-section"><b>Note :</b> <span><i><b>#BLANK#</b></i> This keyword is used for <b>Blank Word</b>.</span></span>                                       
      </div>
      <div class="col-sm-5">
         <div class="form-group m-b-10">
            <label class="bmd-label-floating">Answer 2 </label>
            <input type="text" name="answer1_2" id="answer1_2" class="form-control" value="{{ old('answer1_2') }}" >
            <span class="error" id="err_answer1_2"> @if($errors->has('answer1_2')) {{ $errors->first('answer1_2') }} @endif </span>
         </div>
         <span class="note-section-block form-note-section m-b-10"><b>Note :</b> <span>Enter answers(Words) by comma-separated [Multiple answers]</span></span>
      </div>
      <div class="col-sm-7">
         <div class="form-group m-b-10">
            <label class="bmd-label-floating">Question 3 </label>
            <input type="text" name="question1_3" id="question1_3" class="form-control" value="{{ old('question1_3') }}" >
            <span class="error" id="err_question1_3"> @if($errors->has('question1_3')) {{ $errors->first('question1_3') }} @endif </span>
         </div>
         <span class="note-section-block form-note-section"><b>Note :</b> <span><i><b>#BLANK#</b></i> This keyword is used for <b>Blank Word</b>.</span></span>                                       
      </div>
      <div class="col-sm-5">
         <div class="form-group m-b-10">
            <label class="bmd-label-floating">Answer 3 </label>
            <input type="text" name="answer1_3" id="answer1_3" class="form-control" value="{{ old('answer1_3') }}" >
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
                  <img src="{{ url('/') }}/images/default.jpg" id="imgFilePreview2" class="img-responsive img-preview imgFilePreview" alt=""/>
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
            <input type="text" name="question2_1" id="question2_1" class="form-control" value="{{ old('question2_1') }}" >
            <span class="error" id="err_question2_1"> @if($errors->has('question2_1')) {{ $errors->first('question2_1') }} @endif </span>
         </div>
         <span class="note-section-block form-note-section"><b>Note :</b> <span><i><b>#BLANK#</b></i> This keyword is used for <b>Blank Word</b>.</span></span>                                       
      </div>
      <div class="col-sm-5">
         <div class="form-group m-b-10">
            <label class="bmd-label-floating">Answer 1 <span class="red">*</span></label>
            <input type="text" name="answer2_1" id="answer2_1" class="form-control" value="{{ old('answer2_1') }}" >
            <span class="error" id="err_answer2_1"> @if($errors->has('answer2_1')) {{ $errors->first('answer2_1') }} @endif </span>
         </div>
         <span class="note-section-block form-note-section m-b-10"><b>Note :</b> <span>Enter answers(Words) by comma-separated [Multiple answers]</span></span>
      </div>
      <div class="col-sm-7">
         <div class="form-group m-b-10">
            <label class="bmd-label-floating">Question 2 </label>
            <input type="text" name="question2_2" id="question2_2" class="form-control" value="{{ old('question2_2') }}" >
            <span class="error" id="err_question2_2"> @if($errors->has('question2_2')) {{ $errors->first('question2_2') }} @endif </span>
         </div>
         <span class="note-section-block form-note-section"><b>Note :</b> <span><i><b>#BLANK#</b></i> This keyword is used for <b>Blank Word</b>.</span></span>                                       
      </div>
      <div class="col-sm-5">
         <div class="form-group m-b-10">
            <label class="bmd-label-floating">Answer 2</label>
            <input type="text" name="answer2_2" id="answer2_2" class="form-control" value="{{ old('answer2_2') }}" >
            <span class="error" id="err_answer2_2"> @if($errors->has('answer2_2')) {{ $errors->first('answer2_2') }} @endif </span>
         </div>
         <span class="note-section-block form-note-section m-b-10"><b>Note :</b> <span>Enter answers(Words) by comma-separated [Multiple answers]</span></span>
      </div>
      <div class="col-sm-7">
         <div class="form-group m-b-10">
            <label class="bmd-label-floating">Question 3 </label>
            <input type="text" name="question2_3" id="question2_3" class="form-control" value="{{ old('question2_3') }}" >
            <span class="error" id="err_question2_3"> @if($errors->has('question2_3')) {{ $errors->first('question2_3') }} @endif </span>
         </div>
         <span class="note-section-block form-note-section"><b>Note :</b> <span><i><b>#BLANK#</b></i> This keyword is used for <b>Blank Word</b>.</span></span>                                       
      </div>
      <div class="col-sm-5">
         <div class="form-group m-b-10">
            <label class="bmd-label-floating">Answer 3 </label>
            <input type="text" name="answer2_3" id="answer2_3" class="form-control" value="{{ old('answer2_3') }}" >
            <span class="error" id="err_answer2_3"> @if($errors->has('answer2_3')) {{ $errors->first('answer2_3') }} @endif </span>
         </div>
         <span class="note-section-block form-note-section m-b-10"><b>Note :</b> <span>Enter answers(Words) by comma-separated [Multiple answers]</span></span>
      </div>
   </div>
   <div class="col-sm-12">
      <div class="row">
         <div class="col-sm-6">
            <label class="bmd-label-floating" style="margin-bottom: 0;">Duration <span class="red">*</span></label>                          
            <div class="form-group upload-block m-b-10">                                                
               <input type="text" name="duration" id="duration" class="timing" value="30" />
               <span class="error" id="err_duration"> @if($errors->has('duration')) {{ $errors->first('duration') }} @endif </span>      
            </div>
         </div>
      </div>
   </div>
   <!-- <div class="row">
      <div class="col-sm-12">
         <label class="bmd-label-floating">Audio (HORN) </label>                          
         <div class="form-group upload-block m-b-10">
            <input type="file" id="flHorn" name="flHorn" class="uploadFile" style="visibility:hidden; height: 0;position: absolute;">
            <div class="input-div ">
               <input type="text" class="form-control file-caption  kv-fileinput-caption uploadFileName" />
               <div class="btn btn-primary btn-file"><a class="file" onclick="$('#flHorn').click();">Browse...</a></div>
            </div>
             <span class="error" id="err_flHorn"> @if($errors->has('flHorn')) {{ $errors->first('flHorn') }} @endif </span>         
         </div>
         <span class="note-section-block form-note-section mb20"><b>Note :</b> <span>Allowed file type mp3, m4a, wave (Audio) format.</span></span>
      </div>
      </div> -->
</div>
<link href="{{ url ('/') }}/css/admin/timingfield.css" type="text/css" rel="stylesheet" media="screen" />
<script src="{{ url ('/') }}/js/admin/timingfield.js"></script>
<script type="text/javascript">
   jQuery(document).ready(function($) {
       $(".timing").timingfield();
   });
   $('.imgFile').change(function(){
       var tempThis = $(this);
       var files = $(this.files);
       imageSizeValidate(tempThis, files, '429', '269');
   });
</script>
<div class="devSubWrapper">
   <div class="row">
      <div class="col-sm-12">
         <div class="form-group">
            <label class="bmd-label-floating">Direction</label>
            <input type="text" name="direction" id="direction" class="form-control" value="{{ old('direction') }}">
            <span class="error" id="err_direction"> @if($errors->has('direction')) {{ $errors->first('direction') }} @endif </span>
         </div>
      </div>
      <div class="col-sm-6">
         <div class="form-group">
            <label class="bmd-label-floating">Question 1 <span class="red">*</span></label>
            <input type="text" name="question1" id="question1" class="form-control" value="{{ old('question1') }}">
            <span class="error" id="err_question1"> @if($errors->has('question1')) {{ $errors->first('question1') }} @endif </span>
         </div>
      </div>
      <div class="col-sm-6">
         <div class="form-group">
            <label class="bmd-label-floating">Question 1 Answer <span class="red">*</span></label>
            <input type="text" name="answer1" id="answer1" class="form-control" value="{{ old('answer1') }}">
            <span class="error" id="err_answer1"> @if($errors->has('answer1')) {{ $errors->first('answer1') }} @endif </span>
         </div>
      </div>
      <div class="col-sm-6">
         <div class="form-group">
            <label class="bmd-label-floating">Question 2 <span class="red">*</span></label>
            <input type="text" name="question2" id="question2" class="form-control" value="{{ old('question2') }}">
            <span class="error" id="err_question2"> @if($errors->has('question2')) {{ $errors->first('question2') }} @endif </span>
         </div>
      </div>
      <div class="col-sm-6">
         <div class="form-group">
            <label class="bmd-label-floating">Question 2 Answer <span class="red">*</span></label>
            <input type="text" name="answer2" id="answer2" class="form-control" value="{{ old('answer2') }}">
            <span class="error" id="err_answer2"> @if($errors->has('answer2')) {{ $errors->first('answer2') }} @endif </span>
         </div>
      </div>
      <div class="col-sm-6">
         <div class="form-group">
            <label class="bmd-label-floating">Question 3 <span class="red">*</span></label>
            <input type="text" name="question3" id="question3" class="form-control " value="{{ old('question3') }}">
            <span class="error" id="err_question3"> @if($errors->has('question3')) {{ $errors->first('question3') }} @endif </span>
         </div>
      </div>
      <div class="col-sm-6">
         <div class="form-group">
            <label class="bmd-label-floating">Question 3 Answer <span class="red">*</span></label>
            <input type="text" name="answer3" id="answer3" class="form-control " value="{{ old('answer3') }}">
            <span class="error" id="err_answer3"> @if($errors->has('answer3')) {{ $errors->first('answer3') }} @endif </span>
         </div>
      </div>
      <div class="col-sm-6">
         <div class="form-group">
            <label class="bmd-label-floating">Question 4 <span class="red">*</span></label>
            <input type="text" name="question4" id="question4" class="form-control " value="{{ old('question4') }}">
            <span class="error" id="err_question4"> @if($errors->has('question4')) {{ $errors->first('question4') }} @endif </span>
         </div>
      </div>
      <div class="col-sm-6">
         <div class="form-group">
            <label class="bmd-label-floating">Question 4 Answer <span class="red">*</span></label>
            <input type="text" name="answer4" id="answer4" class="form-control " value="{{ old('answer4') }}">
            <span class="error" id="err_answer4"> @if($errors->has('answer4')) {{ $errors->first('answer4') }} @endif </span>
         </div>
      </div>
      <div class="col-sm-6">
         <div class="form-group">
            <label class="bmd-label-floating">Question 5</label>
            <input type="text" name="question5" id="question5" class="form-control " value="{{ old('question5') }}">
            <span class="error" id="err_question5"> @if($errors->has('question5')) {{ $errors->first('question5') }} @endif </span>
         </div>
      </div>
      <div class="col-sm-6">
         <div class="form-group">
            <label class="bmd-label-floating">Question 5 Answer</label>
            <input type="text" name="answer5" id="answer5" class="form-control " value="{{ old('answer5') }}">
            <span class="error" id="err_answer5"> @if($errors->has('answer5')) {{ $errors->first('answer5') }} @endif </span>
         </div>
      </div>
      <div class="col-sm-6">
         <div class="form-group">
            <label class="bmd-label-floating">Question 6 </label>
            <input type="text" name="question6" id="question6" class="form-control " value="{{ old('question6') }}">
            <span class="error" id="err_question6"> @if($errors->has('question6')) {{ $errors->first('question6') }} @endif </span>
         </div>
      </div>
      <div class="col-sm-6">
         <div class="form-group">
            <label class="bmd-label-floating">Question 6 Answer</label>
            <input type="text" name="answer6" id="answer6" class="form-control " value="{{ old('answer6') }}">
            <span class="error" id="err_answer6"> @if($errors->has('answer6')) {{ $errors->first('answer6') }} @endif </span>
         </div>
      </div>
      <div class="col-sm-6">
         <div class="form-group">
            <label class="bmd-label-floating">Question 7</label>
            <input type="text" name="question7" id="question7" class="form-control " value="{{ old('question7') }}">
            <span class="error" id="err_question7"> @if($errors->has('question7')) {{ $errors->first('question7') }} @endif </span>
         </div>
      </div>
      <div class="col-sm-6">
         <div class="form-group">
            <label class="bmd-label-floating">Question 7 Answer</label>
            <input type="text" name="answer7" id="answer7" class="form-control " value="{{ old('answer7') }}">
            <span class="error" id="err_answer7"> @if($errors->has('answer7')) {{ $errors->first('answer7') }} @endif </span>
         </div>
      </div>
      <div class="col-sm-6">
         <div class="form-group">
            <label class="bmd-label-floating">Question 8</label>
            <input type="text" name="question8" id="question8" class="form-control " value="{{ old('question8') }}">
            <span class="error" id="err_question8"> @if($errors->has('question8')) {{ $errors->first('question8') }} @endif </span>
         </div>
      </div>
      <div class="col-sm-6">
         <div class="form-group">
            <label class="bmd-label-floating">Question 8 Answer</label>
            <input type="text" name="answer8" id="answer8" class="form-control " value="{{ old('answer8') }}">
            <span class="error" id="err_answer8"> @if($errors->has('answer8')) {{ $errors->first('answer8') }} @endif </span>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-sm-6">
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
      <div class="col-sm-6">
         <label class="bmd-label-floating" style="margin-bottom: 0;">Duration <span class="red">*</span></label>                          
         <div class="form-group upload-block m-b-10">                                                
            <input type="text" name="duration" id="duration" class="timing" value="30" />
            <span class="error" id="err_duration"> @if($errors->has('duration')) {{ $errors->first('duration') }} @endif </span>      
         </div>
      </div>
   </div>
</div>
<link href="{{ url ('/') }}/css/admin/timingfield.css" type="text/css" rel="stylesheet" media="screen" />
<script src="{{ url ('/') }}/js/admin/timingfield.js"></script>
<script type="text/javascript">
   jQuery(document).ready(function($) {
       $(".timing").timingfield();
   });
</script>
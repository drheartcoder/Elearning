<div class="devSubWrapper template-28-main">
   <div class="row m-b-20">
      <div class="col-sm-12">
         <div class="form-group">
            <label class="bmd-label-floating">Direction </label>
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
         <div class="radio-btns">
            <div class="radio-btn radio-first-option">
               <input type="radio" id="rdoOption1_1" name="rdoOption1" value="c">
               <label for="rdoOption1_1">C</label>
               <div class="check"></div>
            </div>
            <div class="radio-btn radio-first-option">
               <input type="radio" id="rdoOption1_2" name="rdoOption1" value="f">
               <label for="rdoOption1_2">F</label>
               <div class="check"></div>
            </div>
            <span class="note-section-block radio-note-section-temo-20"><b>Note :</b> <span><span>Select any one option which is correct answer</span></span></span>
            <span class="error" id="err_rdoOption1"> @if($errors->has('rdoOption1')) {{ $errors->first('rdoOption1') }} @endif </span>
         </div>
      </div>
   </div>
   <div class="row m-b-20">
      <div class="col-sm-6">
         <div class="form-group">
            <label class="bmd-label-floating">Question 2 <!-- <span class="red">*</span> --></label>
            <input type="text" name="question2" id="question2" class="form-control" value="{{ old('question2') }}">
            <span class="error" id="err_question2"> @if($errors->has('question2')) {{ $errors->first('question2') }} @endif </span>
         </div>
      </div>
      <div class="col-sm-6">
         <div class="radio-btns">
            <div class="radio-btn radio-first-option">
               <input type="radio" id="rdoOption2_1" name="rdoOption2" value="c">
               <label for="rdoOption2_1">C</label>
               <div class="check"></div>
            </div>
            <div class="radio-btn radio-first-option">
               <input type="radio" id="rdoOption2_2" name="rdoOption2" value="f">
               <label for="rdoOption2_2">F</label>
               <div class="check"></div>
            </div>
            <span class="note-section-block radio-note-section-temo-20"><b>Note :</b> <span><span>Select any one option which is correct answer</span></span></span>
            <span class="error" id="err_rdoOption2"> @if($errors->has('rdoOption2')) {{ $errors->first('rdoOption2') }} @endif </span>
         </div>
      </div>
   </div>
   <div class="row m-b-20">
      <div class="col-sm-6">
         <div class="form-group">
            <label class="bmd-label-floating">Question 3 <!-- <span class="red">*</span> --></label>
            <input type="text" name="question3" id="question3" class="form-control" value="{{ old('question3') }}">
            <span class="error" id="err_question3"> @if($errors->has('question3')) {{ $errors->first('question3') }} @endif </span>
         </div>
      </div>
      <div class="col-sm-6">
         <div class="radio-btns">
            <div class="radio-btn radio-first-option">
               <input type="radio" id="rdoOption3_1" name="rdoOption3" value="c">
               <label for="rdoOption3_1">C</label>
               <div class="check"></div>
            </div>
            <div class="radio-btn radio-first-option">
               <input type="radio" id="rdoOption3_2" name="rdoOption3" value="f">
               <label for="rdoOption3_2">F</label>
               <div class="check"></div>
            </div>
            <span class="note-section-block radio-note-section-temo-20"><b>Note :</b> <span><span>Select any one option which is correct answer</span></span></span>
            <span class="error" id="err_rdoOption3"> @if($errors->has('rdoOption3')) {{ $errors->first('rdoOption3') }} @endif </span>
         </div>
      </div>
   </div>
   <div class="row m-b-20">
      <div class="col-sm-6">
         <div class="form-group">
            <label class="bmd-label-floating">Question 4 <!-- <span class="red">*</span> --></label>
            <input type="text" name="question4" id="question4" class="form-control" value="{{ old('question4') }}">
            <span class="error" id="err_question4"> @if($errors->has('question4')) {{ $errors->first('question4') }} @endif </span>
         </div>
      </div>
      <div class="col-sm-6">
         <div class="radio-btns">
            <div class="radio-btn radio-first-option">
               <input type="radio" id="rdoOption4_1" name="rdoOption4" value="c">
               <label for="rdoOption4_1">C</label>
               <div class="check"></div>
            </div>
            <div class="radio-btn radio-first-option">
               <input type="radio" id="rdoOption4_2" name="rdoOption4" value="f">
               <label for="rdoOption4_2">F</label>
               <div class="check"></div>
            </div>
            <span class="note-section-block radio-note-section-temo-20"><b>Note :</b> <span><span>Select any one option which is correct answer</span></span></span>
            <span class="error" id="err_rdoOption4"> @if($errors->has('rdoOption4')) {{ $errors->first('rdoOption4') }} @endif </span>
         </div>
      </div>
   </div>
   <div class="row m-b-20">
      <div class="col-sm-6">
         <div class="form-group">
            <label class="bmd-label-floating">Question 5 <!-- <span class="red">*</span> --></label>
            <input type="text" name="question5" id="question5" class="form-control" value="{{ old('question5') }}">
            <span class="error" id="err_question5"> @if($errors->has('question5')) {{ $errors->first('question5') }} @endif </span>
         </div>
      </div>
      <div class="col-sm-6">
         <div class="radio-btns">
            <div class="radio-btn radio-first-option">
               <input type="radio" id="rdoOption5_1" name="rdoOption5" value="c">
               <label for="rdoOption5_1">C</label>
               <div class="check"></div>
            </div>
            <div class="radio-btn radio-first-option">
               <input type="radio" id="rdoOption5_2" name="rdoOption5" value="f">
               <label for="rdoOption5_2">F</label>
               <div class="check"></div>
            </div>
            <span class="note-section-block radio-note-section-temo-20"><b>Note :</b> <span><span>Select any one option which is correct answer</span></span></span>
            <span class="error" id="err_rdoOption5"> @if($errors->has('rdoOption5')) {{ $errors->first('rdoOption5') }} @endif </span>
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
<div class="devSubWrapper">
   <div class="row">
      <div class="col-sm-12">
         <div class="form-group">
            <label class="bmd-label-floating">Direction </label>
            <input type="text" name="direction" id="direction" class="form-control" value="{{ old('direction') }}">
            <span class="error" id="err_direction"> @if($errors->has('direction')) {{ $errors->first('direction') }} @endif </span>
         </div>
      </div>
   </div>
   <div class="row wrapperDiv">
      <div class="col-sm-3">
         <label class="col-form-label">Question 1 File (Image) <span class="red">*</span></label>
         <div style="position: relative;" class="form-group">
            <div class="profile-img-block temp-img-block">
               <div class="pro-img">
                  <img src="{{ url('/') }}/images/default.jpg" id="imgFilePreview1" class="img-responsive img-preview imgFilePreview" alt=""/>
                  <input style="height: 100%; width: 100%; z-index: 99;" id="flQuestion1" name="flQuestion1"  type="file" class="attachment_upload imgFile" data-error="no" />
               </div>
               <span class="error" id="err_flQuestion1"> @if($errors->has('flQuestion1')) {{ $errors->first('flQuestion1') }} @endif </span>
               <span class="note-section-block"><b>Note :</b> <span>Allowed only jpg | jpeg | png, <br/> Upload image greater than or equal to 504 X 106 for best result.</span></span>
            </div>
         </div>
      </div>
      <div class="col-sm-2">
        <div class="ques-text">
         <div class="form-group">
            <label class="bmd-label-floating">Digit 1<span class="red">*</span></label>
            <input type="text" name="digit1_1" id="digit1_1" class="form-control digit1Common digitCommon" value="{{ old('digit1_1') }}">
            <span class="error err_digit1Common" id="err_digit1_1"> @if($errors->has('digit1_1')) {{ $errors->first('digit1_1') }} @endif </span>
         </div>
         </div>
      </div>
      <div class="col-sm-3">
        <div class="ques-text">
         <div class="form-group has-default bmd-form-group is-filled">
            <select class="selectpicker dwCommon operatorCommon" data-rule-required="true" data-style="select-with-transition" name="operator1" id="operator1">
               <option value="">Select Sign</option>
               <option value="+">+</option>
               <option value="-">-</option>
               <option value="x">x</option>
               <option value="/">&#247;</option>
            </select>
            <span class="error err_operatorCommon" id="err_operator1"> @if($errors->has('operator1')) {{ $errors->first('operator1') }} @endif </span>
         </div>
		  </div>
      </div>
      <div class="col-sm-2">
        <div class="ques-text">
         <div class="form-group">
            <label class="bmd-label-floating">Digit 2<span class="red">*</span></label>
            <input type="text" name="digit1_2" id="digit1_2" class="form-control digit2Common digitCommon" value="{{ old('digit1_2') }}">
            <span class="error err_digit2Common" id="err_digit1_2"> @if($errors->has('digit1_2')) {{ $errors->first('digit1_2') }} @endif </span>
         </div>
		  </div>
      </div>
      <div class="col-sm-2">
        <div class="ques-text">
         <div class="form-group">
            <!--                <label class="bmd-label-floating">Answer<span class="red">*</span></label>-->
            <input type="text" placeholder="Answer" style="padding: 8px 10px;" name="answer1" id="answer1" class="form-control answerCommon digitCommon" value="{{ old('answer1') }}" readonly="readonly" >
            <span class="error" id="err_answer1"> @if($errors->has('answer1')) {{ $errors->first('answer1') }} @endif </span>
         </div>
		  </div>
      </div>
   </div>
   <div class="row wrapperDiv">
      <div class="col-sm-3">
         <label class="col-form-label">Question 2 File (Image) </label>
         <div style="position: relative;" class="form-group">
            <div class="profile-img-block temp-img-block">
               <div class="pro-img">
                  <img src="{{ url('/') }}/images/default.jpg" id="imgFilePreview2" class="img-responsive img-preview imgFilePreview" alt=""/>
                  <input style="height: 100%; width: 100%; z-index: 99;" id="flQuestion2" name="flQuestion2"  type="file" class="attachment_upload imgFile" data-error="no" />
               </div>
               <span class="error" id="err_flQuestion2"> @if($errors->has('flQuestion2')) {{ $errors->first('flQuestion2') }} @endif </span>
               <span class="note-section-block"><b>Note :</b> <span>Allowed only jpg | jpeg | png, <br/> Upload image greater than or equal to 504 X 106 for best result.</span></span>
            </div>
         </div>
      </div>
      <div class="col-sm-2">
        <div class="ques-text">
         <div class="form-group">
            <label class="bmd-label-floating">Digit 1 </label>
            <input type="text" name="digit2_1" id="digit2_1" class="form-control digit1Common digitCommon" value="{{ old('digit2_1') }}">
            <span class="error err_digit1Common" id="err_digit2_1"> @if($errors->has('digit2_1')) {{ $errors->first('digit2_1') }} @endif </span>
         </div>
		  </div>
      </div>
      <div class="col-sm-3">
        <div class="ques-text">
         <div class="form-group has-default bmd-form-group is-filled">
            <select class="selectpicker dwCommon operatorCommon" data-rule-required="true" data-style="select-with-transition" name="operator2" id="operator2">
               <option value="">Select Sign</option>
               <option value="+">+</option>
               <option value="-">-</option>
               <option value="x">x</option>
               <option value="/">&#247;</option>
            </select>
            <span class="error err_operatorCommon" id="err_operator2"> @if($errors->has('operator2')) {{ $errors->first('operator2') }} @endif </span>
			</div>
         </div>
      </div>
      <div class="col-sm-2">
        <div class="ques-text">
         <div class="form-group">
            <label class="bmd-label-floating">Digit 2 </label>
            <input type="text" name="digit2_2" id="digit2_2" class="form-control digit2Common digitCommon" value="{{ old('digit2_2') }}">
            <span class="error err_digit2Common" id="err_digit2_2"> @if($errors->has('digit2_2')) {{ $errors->first('digit2_2') }} @endif </span>
         </div>
		  </div>
      </div>
      <div class="col-sm-2">
        <div class="ques-text">
         <div class="form-group">
            <!--                <label class="bmd-label-floating">Answer<span class="red">*</span></label>-->
            <input type="text" name="answer2" placeholder="Answer" style="padding: 8px 10px;" id="answer2" class="form-control answerCommon digitCommon" value="{{ old('answer2') }}" readonly="readonly" >
            <span class="error" id="err_answer2"> @if($errors->has('answer2')) {{ $errors->first('answer2') }} @endif </span>
         </div>
		  </div>
      </div>
   </div>
   <div class="row wrapperDiv">
      <div class="col-sm-3">
         <label class="col-form-label">Question 3 File (Image) </label>
         <div style="position: relative;" class="form-group">
            <div class="profile-img-block temp-img-block">
               <div class="pro-img">
                  <img src="{{ url('/') }}/images/default.jpg" id="imgFilePreview3" class="img-responsive img-preview imgFilePreview" alt=""/>
                  <input style="height: 100%; width: 100%; z-index: 99;" id="flQuestion3" name="flQuestion3"  type="file" class="attachment_upload imgFile" data-error="no" />
               </div>
               <span class="error" id="err_flQuestion3"> @if($errors->has('flQuestion3')) {{ $errors->first('flQuestion3') }} @endif </span>
               <span class="note-section-block"><b>Note :</b> <span>Allowed only jpg | jpeg | png, <br/> Upload image greater than or equal to 504 X 106 for best result.</span></span>
            </div>
         </div>
      </div>
      <div class="col-sm-2">
        <div class="ques-text">
         <div class="form-group">
            <label class="bmd-label-floating">Digit 1 </label>
            <input type="text" name="digit3_1" id="digit3_1" class="form-control digit1Common digitCommon" value="{{ old('digit3_1') }}">
            <span class="error err_digit1Common" id="err_digit3_1"> @if($errors->has('digit3_1')) {{ $errors->first('digit3_1') }} @endif </span>
         </div>
		  </div>
      </div>
      <div class="col-sm-3">
        <div class="ques-text">
         <div class="form-group has-default bmd-form-group is-filled">
            <select class="selectpicker dwCommon operatorCommon" data-rule-required="true" data-style="select-with-transition" name="operator3" id="operator3">
               <option value="">Select Sign</option>
               <option value="+">+</option>
               <option value="-">-</option>
               <option value="x">x</option>
               <option value="/">&#247;</option>
            </select>
            <span class="error err_operatorCommon" id="err_operator3"> @if($errors->has('operator3')) {{ $errors->first('operator3') }} @endif </span>
         </div>
		  </div>
      </div>
      <div class="col-sm-2">
        <div class="ques-text">
         <div class="form-group">
            <label class="bmd-label-floating">Digit 2 </label>
            <input type="text" name="digit3_2" id="digit3_2" class="form-control digit2Common digitCommon" value="{{ old('digit3_2') }}">
            <span class="error err_digit2Common" id="err_digit3_2"> @if($errors->has('digit3_2')) {{ $errors->first('digit3_2') }} @endif </span>
         </div>
		  </div>
      </div>
      <div class="col-sm-2">
        <div class="ques-text">
         <div class="form-group">
            <!--                <label class="bmd-label-floating">Answer<span class="red">*</span></label>-->
            <input type="text" name="answer3" placeholder="Answer" style="padding: 8px 10px;" id="answer3" class="form-control answerCommon digitCommon" value="{{ old('answer3') }}" readonly="readonly" >
            <span class="error" id="err_answer3"> @if($errors->has('answer3')) {{ $errors->first('answer3') }} @endif </span>
         </div>
		  </div>
      </div>
   </div>
   <div class="row wrapperDiv">
      <div class="col-sm-3">
         <label class="col-form-label">Question 4 File (Image) </label>
         <div style="position: relative;" class="form-group">
            <div class="profile-img-block temp-img-block">
               <div class="pro-img">
                  <img src="{{ url('/') }}/images/default.jpg" id="imgFilePreview4" class="img-responsive img-preview imgFilePreview" alt=""/>
                  <input style="height: 100%; width: 100%; z-index: 99;" id="flQuestion4" name="flQuestion4"  type="file" class="attachment_upload imgFile" data-error="no" />
               </div>
               <span class="error" id="err_flQuestion4"> @if($errors->has('flQuestion4')) {{ $errors->first('flQuestion4') }} @endif </span>
               <span class="note-section-block"><b>Note :</b> <span>Allowed only jpg | jpeg | png, <br/> Upload image greater than or equal to 504 X 106 for best result.</span></span>
            </div>
         </div>
      </div>
      <div class="col-sm-2">
        <div class="ques-text">
         <div class="form-group">
            <label class="bmd-label-floating">Digit 1 </label>
            <input type="text" name="digit4_1" id="digit4_1" class="form-control digit1Common digitCommon" value="{{ old('digit4_1') }}">
            <span class="error err_digit1Common" id="err_digit4_1"> @if($errors->has('digit4_1')) {{ $errors->first('digit4_1') }} @endif </span>
         </div>
		  </div>
      </div>
      <div class="col-sm-3">
        <div class="ques-text">
         <div class="form-group has-default bmd-form-group is-filled">
            <select class="selectpicker dwCommon operatorCommon" data-rule-required="true" data-style="select-with-transition" name="operator4" id="operator4">
               <option value="">Select Sign</option>
               <option value="+">+</option>
               <option value="-">-</option>
               <option value="x">x</option>
               <option value="/">&#247;</option>
            </select>
            <span class="error err_operatorCommon" id="err_operator4"> @if($errors->has('operator4')) {{ $errors->first('operator4') }} @endif </span>
         </div>
		  </div>
      </div>
      <div class="col-sm-2">
        <div class="ques-text">
         <div class="form-group">
            <label class="bmd-label-floating">Digit 2 </label>
            <input type="text" name="digit4_2" id="digit4_2" class="form-control digit2Common digitCommon" value="{{ old('digit4_2') }}">
            <span class="error err_digit2Common" id="err_digit4_2"> @if($errors->has('digit4_2')) {{ $errors->first('digit4_2') }} @endif </span>
         </div>
		  </div>
      </div>
      <div class="col-sm-2">
        <div class="ques-text">
         <div class="form-group">
            <!--                <label class="bmd-label-floating">Answer<span class="red">*</span></label>-->
            <input type="text" name="answer4" placeholder="Answer" style="padding: 8px 10px;" id="answer4" class="form-control answerCommon digitCommon" value="{{ old('answer4') }}" readonly="readonly" >
            <span class="error" id="err_answer4"> @if($errors->has('answer4')) {{ $errors->first('answer4') }} @endif </span>
         </div>
		  </div>
      </div>
   </div>
   <div class="row">
      <div class="col-sm-6">
         <label class="bmd-label-floating" style="margin-bottom: 0;">Duration <span class="red">*</span></label>                          
         <div class="form-group upload-block m-b-10">                                                
            <input type="text" name="duration" id="duration" class="timing" value="30" />
            <span class="error" id="err_duration"> @if($errors->has('duration')) {{ $errors->first('duration') }} @endif </span>      
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
   $('.dwCommon').selectpicker();
   $('.imgFile').change(function(){
       var tempThis = $(this);
       var files = $(this.files);
       //imageSizeValidate(tempThis, files, '504', '106');
       imageSizeValidate(tempThis, files, '504', '106');
   });
</script>
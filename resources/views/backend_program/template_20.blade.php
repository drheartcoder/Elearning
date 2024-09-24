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
   <div class="row">
      <div class="col-lg-12 col-xl-3">
         <label class="col-form-label">Question 1 File <span class="red">*</span></label>
         <div style="position: relative;" class="form-group">
            <div class="profile-img-block temp-img-block">
               <div class="pro-img">
                  <img src="{{ url('/') }}/images/default.jpg" id="imgFilePreview1" class="img-responsive img-preview imgFilePreview" alt=""/>
                  <input style="height: 100%; width: 100%; z-index: 99;" id="flQuestion1" name="flQuestion1"  type="file" class="attachment_upload imgFile" data-error="no" />
               </div>
               <span class="error" id="err_flQuestion1"> @if($errors->has('flQuestion1')) {{ $errors->first('flQuestion1') }} @endif </span>
               <span class="note-section-block"><b>Note :</b> <span>Allowed only jpg | jpeg | png, <br/> Upload image greater than or equal to 570 X 442 for best result.</span></span>
            </div>
         </div>
      </div>
      <div class="col-lg-6 col-xl-4">
         <div class="form-group">
            <label class="bmd-label-floating">Option 1 (Word)<span class="red">*</span></label>
            <input type="text" name="option1_1" id="option1_1" class="form-control classWord" value="{{ old('option1_1') }}" >
            <span class="error" id="err_option1_1"> @if($errors->has('option1_1')) {{ $errors->first('option1_1') }} @endif </span>
         </div>
         <div class="form-group">
            <label class="bmd-label-floating">Option 2 (Word)<span class="red">*</span></label>
            <input type="text" name="option1_2" id="option1_2" class="form-control classWord" value="{{ old('option1_2') }}" >
            <span class="error" id="err_option1_2"> @if($errors->has('option1_2')) {{ $errors->first('option1_2') }} @endif </span>
         </div>
         <div class="form-group">
            <label class="bmd-label-floating">Option 3 (Word)<span class="red">*</span></label>
            <input type="text" name="option1_3" id="option1_3" class="form-control classWord" value="{{ old('option1_3') }}" >
            <span class="error" id="err_option1_3"> @if($errors->has('option1_3')) {{ $errors->first('option1_3') }} @endif </span>
         </div>
      </div>
      <div class="col-lg-6 col-xl-4">
         <div class="radio-btns">
            <div class="radio-btn radio-first-option">
               <input type="radio" id="rdoOption1_1" name="rdoOption1" value="1">
               <label for="rdoOption1_1">Option 1</label>
               <div class="check"></div>
            </div>
            <div class="radio-btn radio-first-option">
               <input type="radio" id="rdoOption1_2" name="rdoOption1" value="2">
               <label for="rdoOption1_2">Option 2</label>
               <div class="check"></div>
            </div>
            <div class="radio-btn">
               <input type="radio" id="rdoOption1_3" name="rdoOption1" value="3">
               <label for="rdoOption1_3">Option 3</label>
               <div class="check"></div>
            </div>
            <span class="error" id="err_rdoOption1"> @if($errors->has('rdoOption1')) {{ $errors->first('rdoOption1') }} @endif </span>
            <span class="note-section-block"><b>Note :</b> <span><span>Select any one option which is correct answer</span></span></span>
            <span class="note-section-block always-show-note"><b>Note :</b> <span><span>Select any one option which is correct answer</span></span></span>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-lg-12 col-xl-3">
         <label class="col-form-label">Question 2 File <span class="red">*</span></label>
         <div style="position: relative;" class="form-group">
            <div class="profile-img-block temp-img-block">
               <div class="pro-img">
                  <img src="{{ url('/') }}/images/default.jpg" id="imgFilePreview2" class="img-responsive img-preview imgFilePreview" alt=""/>
                  <input style="height: 100%; width: 100%; z-index: 99;" id="flQuestion2" name="flQuestion2"  type="file" class="attachment_upload imgFile" data-error="no" />
               </div>
               <span class="error" id="err_flQuestion2"> @if($errors->has('flQuestion2')) {{ $errors->first('flQuestion2') }} @endif </span>
               <span class="note-section-block"><b>Note :</b> <span>Allowed only jpg | jpeg | png, <br/> Upload image greater than or equal to 570 X 442 for best result.</span></span>
            </div>
         </div>
      </div>
      <div class="col-lg-6 col-xl-4">
         <div class="form-group">
            <label class="bmd-label-floating">Option 1 (Word)<span class="red">*</span></label>
            <input type="text" name="option2_1" id="option2_1" class="form-control classWord" value="{{ old('option2_1') }}" >
            <span class="error" id="err_option2_1"> @if($errors->has('option2_1')) {{ $errors->first('option2_1') }} @endif </span>
         </div>
         <div class="form-group">
            <label class="bmd-label-floating">Option 2 (Word)<span class="red">*</span></label>
            <input type="text" name="option2_2" id="option2_2" class="form-control classWord" value="{{ old('option2_2') }}" >
            <span class="error" id="err_option2_2"> @if($errors->has('option2_2')) {{ $errors->first('option2_2') }} @endif </span>
         </div>
         <div class="form-group">
            <label class="bmd-label-floating">Option 3 (Word)<span class="red">*</span></label>
            <input type="text" name="option2_3" id="option2_3" class="form-control classWord" value="{{ old('option2_3') }}" >
            <span class="error" id="err_option2_3"> @if($errors->has('option2_3')) {{ $errors->first('option2_3') }} @endif </span>
         </div>
      </div>
      <div class="col-lg-6 col-xl-4">
         <div class="radio-btns">
            <div class="radio-btn radio-first-option">
               <input type="radio" id="rdoOption2_1" name="rdoOption2" value="1">
               <label for="rdoOption2_1">Option 1</label>
               <div class="check"></div>
            </div>
            <div class="radio-btn radio-first-option">
               <input type="radio" id="rdoOption2_2" name="rdoOption2" value="2">
               <label for="rdoOption2_2">Option 2</label>
               <div class="check"></div>
            </div>
            <div class="radio-btn">
               <input type="radio" id="rdoOption2_3" name="rdoOption2" value="3">
               <label for="rdoOption2_3">Option 3</label>
               <div class="check"></div>
            </div>
            <span class="error" id="err_rdoOption2"> @if($errors->has('rdoOption2')) {{ $errors->first('rdoOption2') }} @endif </span>
            <span class="note-section-block"><b>Note :</b> <span><span>Select any one option which is correct answer</span></span></span>
            <span class="note-section-block always-show-note"><b>Note :</b> <span><span>Select any one option which is correct answer</span></span></span>
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
   
   $('.dwCommon').selectpicker();
   $('.imgFile').change(function(){
       var tempThis = $(this);
       var files = $(this.files);
       imageSizeValidate(tempThis, files, '570', '442');
   });
</script>
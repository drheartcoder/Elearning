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
      <div class="col-sm-12">
         <label class="bmd-label-floating">Question File (Video)<span class="red">*</span></label>                          
         <div class="form-group upload-block m-b-10">
            <input type="file" name="flQuestion" id="flQuestion" class="uploadFile" style="visibility:hidden; height: 0;position: absolute;" >
            <div class="input-div ">
               <input type="text" class="form-control file-caption kv-fileinput-caption uploadFileName" />
               <div class="btn btn-primary btn-file"><a class="file" onclick="$('#flQuestion').click();">Browse...</a></div>
            </div>
            <span class="error" id="err_flQuestion"> @if($errors->has('flQuestion')) {{ $errors->first('flQuestion') }} @endif </span>
         </div>
         <span class="note-section-block form-note-section mb20"><b>Note :</b> <span>Allowed file type mp4 (Video) format.</span></span>
      </div>
   </div>
   <div class="row">
      <div class="col-sm-6">
         <div class="form-group">
            <label class="bmd-label-floating">Option 1 <span class="red">*</span></label>
            <input type="text" name="option1" id="option1" class="form-control" value="{{ old('option1') }}" >
            <span class="error" id="err_option1"> @if($errors->has('option1')) {{ $errors->first('option1') }} @endif </span>
         </div>
         <div class="form-group">
            <label class="bmd-label-floating">Option 2 <span class="red">*</span></label>
            <input type="text" name="option2" id="option2" class="form-control" value="{{ old('option2') }}" >
            <span class="error" id="err_option2"> @if($errors->has('option2')) {{ $errors->first('option2') }} @endif </span>
         </div>
      </div>
      <div class="col-sm-6">
         <div class="radio-btns">
            <div class="radio-btn radio-first-option">
               <input type="radio" id="rdoOption1" name="rdoOption" value="1">
               <label for="rdoOption1">Option 1</label>
               <div class="check"></div>
            </div>
            <div class="radio-btn">
               <input type="radio" id="rdoOption2" name="rdoOption" value="2">
               <label for="rdoOption2">Option 2</label>
               <div class="check"></div>
            </div>
            <span class="error" id="err_rdoOption"> @if($errors->has('rdoOption')) {{ $errors->first('rdoOption') }} @endif </span>
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
</script>
<div class="devSubWrapper">
   <div class="row">
      <div class="col-sm-12">
         <div class="form-group">
            <label class="bmd-label-floating">Direction </label>
            <input type="text" name="direction" id="direction" class="form-control" value="{{ old('direction') }}">
            <span class="error" id="err_direction"> @if($errors->has('direction')) {{ $errors->first('direction') }} @endif </span>
         </div>
      </div>
      <div class="col-sm-6">
         <label class="col-form-label">Question 1 File (Image) <span class="red">*</span></label>
         <div style="position: relative;" class="form-group">
            <div class="profile-img-block temp-img-block">
               <div class="pro-img">
                  <img src="{{ url('/') }}/images/default.jpg" id="imgFilePreview1" class="img-responsive img-preview imgFilePreview" alt=""/>
                  <input style="height: 100%; width: 100%; z-index: 99;" id="flQuestion1" name="flQuestion1"  type="file" class="attachment_upload imgFile" data-error="no" />
               </div>
               <span class="note-section-block"><b>Note :</b> <span>Allowed only jpg | jpeg | png, <br/> Upload image greater than or equal to 570 X 442 for best result.</span>
               </span>
            </div>
            <span class="error" id="err_flQuestion1"> @if($errors->has('flQuestion1')) {{ $errors->first('flQuestion1') }} @endif </span>
         </div>
      </div>
      <div class="col-sm-6">
        <div class="ques-text">
         <div class="form-group">
            <label class="bmd-label-floating">Question 1 Answer (Word)<span class="red">*</span></label>
            <input type="text" name="answer1" id="answer1" class="form-control classWord" value="{{ old('answer1') }}">
            <span class="error" id="err_answer1"> @if($errors->has('answer1')) {{ $errors->first('answer1') }} @endif </span>
         </div>
            <span class="note-section-block form-note-section mb20"><b>Note :</b> <span>This field will be displayed to student.</span></span>
         </div>
      </div>

      <div class="col-sm-6">
         <label class="col-form-label">Question 2 File (Image) <span class="red">*</span></label>
         <div style="position: relative;" class="form-group">
            <div class="profile-img-block temp-img-block">
               <div class="pro-img">
                  <img src="{{ url('/') }}/images/default.jpg" id="imgFilePreview2" class="img-responsive img-preview imgFilePreview" alt=""/>
                  <input style="height: 100%; width: 100%; z-index: 99;" id="flQuestion2" name="flQuestion2"  type="file" class="attachment_upload imgFile" data-error="no" />
               </div>
               <span class="note-section-block"><b>Note :</b> <span>Allowed only jpg | jpeg | png, <br/> Upload image greater than or equal to 570 X 442 for best result.</span></span>
            </div>
               <span class="error" id="err_flQuestion2"> @if($errors->has('flQuestion2')) {{ $errors->first('flQuestion2') }} @endif </span>
         </div>
      </div>
      <div class="col-sm-6">
        <div class="ques-text">
         <div class="form-group">
            <label class="bmd-label-floating">Question 2 Answer (Word)<span class="red">*</span></label>
            <input type="text" name="answer2" id="answer2" class="form-control classWord" value="{{ old('answer2') }}">
            <span class="error" id="err_answer2"> @if($errors->has('answer2')) {{ $errors->first('answer2') }} @endif </span>
         </div>
         <span class="note-section-block form-note-section mb20"><b>Note :</b> <span>On this field student needs to take action.</span></span>
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
   $('.imgFile').change(function(){
       var tempThis = $(this);
       var files = $(this.files);
       imageSizeValidate(tempThis, files, '570', '442');
   });
</script>
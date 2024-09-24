<div class="devSubWrapper temp-11">
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
               <span class="error" id="err_flQuestion1"> @if($errors->has('flQuestion1')) {{ $errors->first('flQuestion1') }} @endif </span>
               <span class="note-section-block"><b>Note :</b> <span>Allowed only jpg | jpeg | png, <br/> Upload image greater than or equal to 270 X 270 for best result.</span></span>
            </div>
         </div>
      </div>
      <div class="col-sm-6">
         <div class="ques-text">
			 <div class="form-group">
				<label class="bmd-label-floating">Question 1 Answer <span class="red">*</span></label>
				<input type="text" name="answer1" id="answer1" class="form-control" value="{{ old('answer1') }}">
				<span class="error" id="err_answer1"> @if($errors->has('answer1')) {{ $errors->first('answer1') }} @endif </span>
			 </div>
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
               <span class="error" id="err_flQuestion2"> @if($errors->has('flQuestion2')) {{ $errors->first('flQuestion2') }} @endif </span>
               <span class="note-section-block"><b>Note :</b> <span>Allowed only jpg | jpeg | png, <br/> Upload image greater than or equal to 270 X 270 for best result.</span></span>
            </div>
         </div>
      </div>
      <div class="col-sm-6">
        <div class="ques-text">
         <div class="form-group">
            <label class="bmd-label-floating">Question 2 Answer <span class="red">*</span></label>
            <input type="text" name="answer2" id="answer2" class="form-control" value="{{ old('answer2') }}">
            <span class="error" id="err_answer2"> @if($errors->has('answer2')) {{ $errors->first('answer2') }} @endif </span>
         </div>
		  </div>
      </div>
      <div class="col-sm-6">
         <label class="col-form-label">Question 3 File (Image) <span class="red">*</span></label>
         <div style="position: relative;" class="form-group">
            <div class="profile-img-block temp-img-block">
               <div class="pro-img">
                  <img src="{{ url('/') }}/images/default.jpg" id="imgFilePreview3" class="img-responsive img-preview imgFilePreview" alt=""/>
                  <input style="height: 100%; width: 100%; z-index: 99;" id="flQuestion3" name="flQuestion3"  type="file" class="attachment_upload imgFile" data-error="no" />
               </div>
               <span class="error" id="err_flQuestion3"> @if($errors->has('flQuestion3')) {{ $errors->first('flQuestion3') }} @endif </span>
               <span class="note-section-block"><b>Note :</b> <span>Allowed only jpg | jpeg | png, <br/> Upload image greater than or equal to 270 X 270 for best result.</span></span>
            </div>
         </div>
      </div>
      <div class="col-sm-6">
         <div class="form-group">
            <label class="bmd-label-floating">Question 3 Answer <span class="red">*</span></label>
            <input type="text" name="answer3" id="answer3" class="form-control" value="{{ old('answer3') }}">
            <span class="error" id="err_answer3"> @if($errors->has('answer3')) {{ $errors->first('answer3') }} @endif </span>
         </div>
      </div>
      <div class="col-sm-6">
         <label class="col-form-label">Question 4 File (Image) <span class="red">*</span></label>
         <div style="position: relative;" class="form-group">
            <div class="profile-img-block temp-img-block">
               <div class="pro-img">
                  <img src="{{ url('/') }}/images/default.jpg" id="imgFilePreview4" class="img-responsive img-preview imgFilePreview" alt=""/>
                  <input style="height: 100%; width: 100%; z-index: 99;" id="flQuestion4" name="flQuestion4"  type="file" class="attachment_upload imgFile" data-error="no" />
               </div>
               <span class="error" id="err_flQuestion4"> @if($errors->has('flQuestion4')) {{ $errors->first('flQuestion4') }} @endif </span>
               <span class="note-section-block"><b>Note :</b> <span>Allowed only jpg | jpeg | png, <br/> Upload image greater than or equal to 270 X 270 for best result.</span></span>
            </div>
         </div>
      </div>
      <div class="col-sm-6">
         <div class="form-group">
            <label class="bmd-label-floating">Question 4 Answer <span class="red">*</span></label>
            <input type="text" name="answer4" id="answer4" class="form-control" value="{{ old('answer4') }}">
            <span class="error" id="err_answer4"> @if($errors->has('answer4')) {{ $errors->first('answer4') }} @endif </span>
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
         <label class="bmd-label-floating">Audio (HORN) <span class="red">*</span></label>                          
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
       imageSizeValidate(tempThis, files, '270', '270');
   });
</script>
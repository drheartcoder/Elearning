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
   <div class="row question-1-section">
      <div class="col-sm-4">
         <label class="col-form-label">Question 1 File <span class="red">*</span></label>
         <div style="position: relative;" class="form-group">
            <div class="profile-img-block temp-img-block">
               <div class="pro-img">
                  <img src="{{ url('/') }}/images/default.jpg" id="imgFilePreview1" class="img-responsive img-preview imgFilePreview" alt=""/>
                  <input style="height: 100%; width: 100%; z-index: 99;" id="flQuestion1" name="flQuestion1"  type="file" class="attachment_upload imgFile" data-error="no" />
               </div>
               <span class="error" id="err_flQuestion1"> @if($errors->has('flQuestion1')) {{ $errors->first('flQuestion1') }} @endif </span>
               <span class="note-section-block"><b>Note :</b> <span>Allowed only jpg | jpeg | png, <br/> Upload image greater than or equal to 185 X 121 for best result.</span></span>
            </div>
         </div>
      </div>
      <div class="col-sm-8">
        <div class="ques-text">
         <div class="row">
            <div class="col-sm-9">
               <div class="form-group">
                  <label class="bmd-label-floating">Question 1 (Word) <span class="red">*</span></label>
                  <input type="text" name="question1" id="question1" class="form-control classWord" value="{{ old('question1') }}" maxlength="45" >
                  <span class="error" id="err_question1"> @if($errors->has('question1')) {{ $errors->first('question1') }} @endif </span>
               </div>
            </div>
            <div class="col-sm-3">
               <button type="button" class="btn btn-fill btn-rose ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" id="btnGenerate1">
                  <span class="ui-button-text">Generate</span>
                  <div class="ripple-container"></div>
               </button>
            </div>
            <div class="col-sm-12" id="wrapperDivBlankLetter1" style="display: none;">
               <label class="col-form-label">Fill the Letters <span class="red">*</span></label>
               <div class="form-group" style="margin-top: 0 !important;">
                  <div id="divBlankLetter1">
                  </div>
                  <div class="clearfix"></div>
                  <span class="error" id="err_chkBlankLetter1"></span>
               </div>
               <div class="note-section-block form-note-section m-b-20"><b>Note :</b> <span>Please Select checkbox which letters you want to hide.</span></div>
            </div>
         </div>
		  </div>
      </div>
   </div>
   <div class="row question-2-section">
      <div class="col-sm-4">
         <label class="col-form-label">Question 2 File <span class="red">*</span></label>
         <div style="position: relative;" class="form-group">
            <div class="profile-img-block temp-img-block">
               <div class="pro-img">
                  <img src="{{ url('/') }}/images/default.jpg" id="imgFilePreview2" class="img-responsive img-preview imgFilePreview" alt=""/>
                  <input style="height: 100%; width: 100%; z-index: 99;" id="flQuestion2" name="flQuestion2"  type="file" class="attachment_upload imgFile" data-error="no" />
               </div>
               <span class="error" id="err_flQuestion2"> @if($errors->has('flQuestion2')) {{ $errors->first('flQuestion2') }} @endif </span>
               <span class="note-section-block"><b>Note :</b> <span>Allowed only jpg | jpeg | png, <br/> Upload image greater than or equal to 185 X 121 for best result.</span></span>
            </div>
         </div>
      </div>
      <div class="col-sm-8">
        <div class="ques-text">
         <div class="row">
            <div class="col-sm-9">
               <div class="form-group">
                  <label class="bmd-label-floating">Question 2 (Word) <span class="red">*</span></label>
                  <input type="text" name="question2" id="question2" class="form-control classWord" value="{{ old('question2') }}" maxlength="45" >
                  <span class="error" id="err_question2"> @if($errors->has('question2')) {{ $errors->first('question2') }} @endif </span>
               </div>
            </div>
            <div class="col-sm-3">
               <button type="button" class="btn btn-fill btn-rose ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" id="btnGenerate2">
                  <span class="ui-button-text">Generate</span>
                  <div class="ripple-container"></div>
               </button>
            </div>
            <div class="col-sm-12" id="wrapperDivBlankLetter2" style="display: none;">
               <label class="col-form-label">Fill the Letters <span class="red">*</span></label>
               <div class="form-group" style="margin-top: 0 !important;">
                  <div id="divBlankLetter2">
                  </div>
                  <div class="clearfix"></div>
                  <span class="error" id="err_chkBlankLetter2"></span>
               </div>
               <div class="note-section-block form-note-section m-b-20"><b>Note :</b> <span>Please Select checkbox which letters you want to hide.</span></div>
            </div>
         </div>
		  </div>
      </div>
   </div>
   <div class="row question-3-section">
      <div class="col-sm-4">
         <label class="col-form-label">Question 3 File <span class="red">*</span></label>
         <div style="position: relative;" class="form-group">
            <div class="profile-img-block temp-img-block">
               <div class="pro-img">
                  <img src="{{ url('/') }}/images/default.jpg" id="imgFilePreview3" class="img-responsive img-preview imgFilePreview" alt=""/>
                  <input style="height: 100%; width: 100%; z-index: 99;" id="flQuestion3" name="flQuestion3"  type="file" class="attachment_upload imgFile" data-error="no" />
               </div>
               <span class="error" id="err_flQuestion3"> @if($errors->has('flQuestion3')) {{ $errors->first('flQuestion3') }} @endif </span>
               <span class="note-section-block"><b>Note :</b> <span>Allowed only jpg | jpeg | png, <br/> Upload image greater than or equal to 185 X 121 for best result.</span></span>
            </div>
         </div>
      </div>
      <div class="col-sm-8">
        <div class="ques-text">
         <div class="row">
            <div class="col-sm-9">
               <div class="form-group">
                  <label class="bmd-label-floating">Question 3 (Word) <span class="red">*</span></label>
                  <input type="text" name="question3" id="question3" class="form-control classWord" value="{{ old('question3') }}" maxlength="45" >
                  <span class="error" id="err_question3"> @if($errors->has('question3')) {{ $errors->first('question3') }} @endif </span>
               </div>
            </div>
            <div class="col-sm-3">
               <button type="button" class="btn btn-fill btn-rose ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" id="btnGenerate3">
                  <span class="ui-button-text">Generate</span>
                  <div class="ripple-container"></div>
               </button>
            </div>
            <div class="col-sm-12" id="wrapperDivBlankLetter3" style="display: none;">
               <label class="col-form-label">Fill the Letters <span class="red">*</span></label>
               <div class="form-group" style="margin-top: 0 !important;">
                  <div id="divBlankLetter3">
                  </div>
                  <div class="clearfix"></div>
                  <span class="error" id="err_chkBlankLetter3"></span>
               </div>
               <div class="note-section-block form-note-section m-b-20"><b>Note :</b> <span>Please Select checkbox which letters you want to hide.</span></div>
            </div>
         </div>
		  </div>
      </div>
   </div>
   <div class="row question-4-section">
      <div class="col-sm-4">
         <label class="col-form-label">Question 4 File <span class="red">*</span></label>
         <div style="position: relative;" class="form-group">
            <div class="profile-img-block temp-img-block">
               <div class="pro-img">
                  <img src="{{ url('/') }}/images/default.jpg" id="imgFilePreview4" class="img-responsive img-preview imgFilePreview" alt=""/>
                  <input style="height: 100%; width: 100%; z-index: 99;" id="flQuestion4" name="flQuestion4"  type="file" class="attachment_upload imgFile" data-error="no" />
               </div>
               <span class="error" id="err_flQuestion4"> @if($errors->has('flQuestion4')) {{ $errors->first('flQuestion4') }} @endif </span>
               <span class="note-section-block"><b>Note :</b> <span>Allowed only jpg | jpeg | png, <br/> Upload image greater than or equal to 185 X 121 for best result.</span></span>
            </div>
         </div>
      </div>
      <div class="col-sm-8">
        <div class="ques-text">
         <div class="row">
            <div class="col-sm-9">
               <div class="form-group">
                  <label class="bmd-label-floating">Question 4 (Word) <span class="red">*</span></label>
                  <input type="text" name="question4" id="question4" class="form-control classWord" value="{{ old('question4') }}" maxlength="45" >
                  <span class="error" id="err_question4"> @if($errors->has('question4')) {{ $errors->first('question4') }} @endif </span>
               </div>
            </div>
            <div class="col-sm-3">
               <button type="button" class="btn btn-fill btn-rose ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" id="btnGenerate4">
                  <span class="ui-button-text">Generate</span>
                  <div class="ripple-container"></div>
               </button>
            </div>
            <div class="col-sm-12" id="wrapperDivBlankLetter4" style="display: none;">
               <label class="col-form-label">Fill the Letters <span class="red">*</span></label>
               <div class="form-group" style="margin-top: 0 !important;">
                  <div id="divBlankLetter4">
                  </div>
                  <div class="clearfix"></div>
                  <span class="error" id="err_chkBlankLetter4"></span>
               </div>
               <div class="note-section-block form-note-section m-b-20"><b>Note :</b> <span>Please Select checkbox which letters you want to hide.</span></div>
            </div>
         </div>
		  </div>
      </div>
   </div>
   <div class="row question-5-section">
      <div class="col-sm-4">
         <label class="col-form-label">Question 5 File <span class="red">*</span></label>
         <div style="position: relative;" class="form-group">
            <div class="profile-img-block temp-img-block">
               <div class="pro-img">
                  <img src="{{ url('/') }}/images/default.jpg" id="imgFilePreview5" class="img-responsive img-preview imgFilePreview" alt=""/>
                  <input style="height: 100%; width: 100%; z-index: 99;" id="flQuestion5" name="flQuestion5"  type="file" class="attachment_upload imgFile" data-error="no" />
               </div>
               <span class="error" id="err_flQuestion5"> @if($errors->has('flQuestion5')) {{ $errors->first('flQuestion5') }} @endif </span>
               <span class="note-section-block"><b>Note :</b> <span>Allowed only jpg | jpeg | png, <br/> Upload image greater than or equal to 185 X 121 for best result.</span></span>
            </div>
         </div>
      </div>
      <div class="col-sm-8">
        <div class="ques-text">
         <div class="row">
            <div class="col-sm-9">
               <div class="form-group">
                  <label class="bmd-label-floating">Question 5 (Word) <span class="red">*</span></label>
                  <input type="text" name="question5" id="question5" class="form-control classWord" value="{{ old('question5') }}" maxlength="45" >
                  <span class="error" id="err_question5"> @if($errors->has('question5')) {{ $errors->first('question5') }} @endif </span>
               </div>
            </div>
            <div class="col-sm-3">
               <button type="button" class="btn btn-fill btn-rose ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" id="btnGenerate5">
                  <span class="ui-button-text">Generate</span>
                  <div class="ripple-container"></div>
               </button>
            </div>
            <div class="col-sm-12" id="wrapperDivBlankLetter5" style="display: none;">
               <label class="col-form-label">Fill the Letters <span class="red">*</span></label>
               <div class="form-group" style="margin-top: 0 !important;">
                  <div id="divBlankLetter5">
                  </div>
                  <div class="clearfix"></div>
                  <span class="error" id="err_chkBlankLetter5"></span>
               </div>
               <div class="note-section-block form-note-section m-b-20"><b>Note :</b> <span>Please Select checkbox which letters you want to hide.</span></div>
            </div>
         </div>
		  </div>
      </div>
   </div>
   <div class="row question-6-section">
      <div class="col-sm-4">
         <label class="col-form-label">Question 6 File <span class="red">*</span></label>
         <div style="position: relative;" class="form-group">
            <div class="profile-img-block temp-img-block">
               <div class="pro-img">
                  <img src="{{ url('/') }}/images/default.jpg" id="imgFilePreview6" class="img-responsive img-preview imgFilePreview" alt=""/>
                  <input style="height: 100%; width: 100%; z-index: 99;" id="flQuestion6" name="flQuestion6"  type="file" class="attachment_upload imgFile" data-error="no" />
               </div>
               <span class="error" id="err_flQuestion6"> @if($errors->has('flQuestion6')) {{ $errors->first('flQuestion6') }} @endif </span>
               <span class="note-section-block"><b>Note :</b> <span>Allowed only jpg | jpeg | png, <br/> Upload image greater than or equal to 185 X 121 for best result.</span></span>
            </div>
         </div>
      </div>
      <div class="col-sm-8">
        <div class="ques-text">
         <div class="row">
            <div class="col-sm-9">
               <div class="form-group">
                  <label class="bmd-label-floating">Question 6 (Word) <span class="red">*</span></label>
                  <input type="text" name="question6" id="question6" class="form-control classWord" value="{{ old('question6') }}" maxlength="45" >
                  <span class="error" id="err_question6"> @if($errors->has('question6')) {{ $errors->first('question6') }} @endif </span>
               </div>
            </div>
            <div class="col-sm-3">
               <button type="button" class="btn btn-fill btn-rose ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" id="btnGenerate6">
                  <span class="ui-button-text">Generate</span>
                  <div class="ripple-container"></div>
               </button>
            </div>
            <div class="col-sm-12" id="wrapperDivBlankLetter6" style="display: none;">
               <label class="col-form-label">Fill the Letters <span class="red">*</span></label>
               <div class="form-group" style="margin-top: 0 !important;">
                  <div id="divBlankLetter6">
                  </div>
                  <div class="clearfix"></div>
                  <span class="error" id="err_chkBlankLetter6"></span>
               </div>
               <div class="note-section-block form-note-section m-b-20"><b>Note :</b> <span>Please Select checkbox which letters you want to hide.</span></div>
            </div>
         </div>
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
       imageSizeValidate(tempThis, files, '185', '121');
   });
</script>
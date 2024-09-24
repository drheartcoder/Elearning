<div class="devSubWrapper">
   <div class="row">
      <div class="col-sm-12">
         <div class="form-group">
            <label class="bmd-label-floating">Direction </label>
            <input type="text" name="direction" id="direction" class="form-control" value="{{ old('direction') }}">
            <span class="error" id="err_direction"> @if($errors->has('direction')) {{ $errors->first('direction') }} @endif </span>
         </div>
      </div>
      <div class="col-sm-8">
         <div class="form-group">
            <label class="bmd-label-floating">Question (Word)<span class="red">*</span></label>
            <input type="text" name="question" id="question" class="form-control classWord" value="{{ old('question') }}" maxlength="45" >
            <span class="error" id="err_question"> @if($errors->has('question')) {{ $errors->first('question') }} @endif </span>
         </div>
      </div>
      <div class="col-sm-2">
         <button type="button" class="btn btn-fill btn-rose ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" id="btnGenerate">
            <span class="ui-button-text">Generate</span>
            <div class="ripple-container"></div>
         </button>
      </div>
      <div class="col-sm-12" id="wrapperDivBlankLetter" style="display: none;">
         <div class="form-group m-b-10">
            <div id="divBlankLetter">
            </div>
            <span class="error" id="err_chkBlankLetter"></span>         
         </div>
         <div class="note-section-block form-note-section m-b-20"><b>Note :</b> <span>Please Select checkbox which letters you want to hide.</span></div>
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
      <!-- <div class="col-sm-12">                  
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
         </div> -->
   </div>
</div>
<link href="{{ url ('/') }}/css/admin/timingfield.css" type="text/css" rel="stylesheet" media="screen" />
<script src="{{ url ('/') }}/js/admin/timingfield.js"></script>
<script type="text/javascript">
   jQuery(document).ready(function($) {
       $(".timing").timingfield();
   });
   $('.dwCommon').selectpicker();
</script>
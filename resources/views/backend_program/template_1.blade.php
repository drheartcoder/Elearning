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
   <div class="upload-section-main">
      <div class="row">
         <div class="col-sm-4">
            <div class="">
               <label class="col-form-label bmd-label-floating">File Type <span class="red">*</span></label>
               <div class="form-group">
                  <div class="dropdown bootstrap-select">
                     <select name="fileType" id="fileType" class="selectpicker dwCommon fileType" data-style="select-with-transition" title="Select File Type" data-size="7" tabindex="-98">
                        <option value="image" selected="">Image</option>
                        <option value="video">Video</option>
                     </select>
                  </div>
               </div>
               <span class="error" id="err_fileType"> @if($errors->has('fileType')) {{ $errors->first('fileType') }} @endif </span>     
            </div>
         </div>
         <div class="col-sm-8">
            <div id="divVideo" style="display: none;">
               <label class="bmd-label-floating col-form-label">Video <span class="red">*</span></label>
               <div class="form-group upload-block m-b-10">
                  <input type="file" name="vdoFile" id="vdoFile" class="uploadFile" style="visibility:hidden; height: 0;position: absolute;" >
                  <div class="input-div">
                     <input type="text" class="form-control file-caption kv-fileinput-caption uploadFileName" />
                     <div class="btn btn-primary btn-file"><a class="file" onclick="$('#vdoFile').click();">Browse...</a></div>
                  </div>
                  <span class="error" id="err_vdoFile"> @if($errors->has('vdoFile')) {{ $errors->first('vdoFile') }} @endif </span>            
               </div>
               <span class="note-section-block form-note-section mb20"><b>Note :</b> <span>Allowed file type mp4 (Video) format.</span></span>
            </div>
            <div id="divImage">
               <div class="col-sm-12">
                  <label class="bmd-label-floating col-form-label">Image <span class="red">*</span></label>
                  <div style="position: relative;" class="profile-img-block temp-img-block">
                     <div class="pro-img"><img src="{{ url('/') }}/images/default.jpg" id="imgFilePreview" class="img-responsive imgFilePreview" alt=""/>
                        <input style="height: 100%; width: 100%; z-index: 99;" id="imgFile" name="imgFile" type="file" class="attachment_upload imgFile" data-error="no" />
                     </div>
                     <span class="note-section-block"><b>Note :</b> <span>Allowed only jpg | jpeg | png, <br/> Upload image greater than or equal to 570 X 442 for best result.</span></span>
                  </div>
                  <span class="error" id="err_imgFile"> @if($errors->has('imgFile')) {{ $errors->first('imgFile') }} @endif </span>
               </div>
            </div>
         </div>
      </div>
   </div>
  
      <div class="form-group">
         <label class="bmd-label-floating col-form-label">Question <span class="red">*</span></label>
         <input type="text" name="question" id="question" class="form-control" value="{{ old('question') }}">
         <span class="error" id="err_question"> @if($errors->has('question')) {{ $errors->first('question') }} @endif </span>
      </div>
 
   <div class="row">
      <div class="col-sm-6">
         <label class="bmd-label-floating col-form-label">Audio (HORN)</label>
         <div class="form-group upload-block m-b-10">
            <input type="file" id="flHorn" name="flHorn" class="uploadFile" style="visibility:hidden; height: 0;position: absolute;">
            <div class="input-div">
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
<script type="text/javascript">
   $('.dwCommon').selectpicker();
   $('.imgFile').change(function(){
      var tempThis = $(this);
      var files = $(this.files);
      imageSizeValidate(tempThis, files, '570', '442');
   });
</script>
<link href="{{ url ('/') }}/css/admin/timingfield.css" type="text/css" rel="stylesheet" media="screen" />
<script src="{{ url ('/') }}/js/admin/timingfield.js"></script>
<script type="text/javascript">
   jQuery(document).ready(function($) {
       $(".timing").timingfield();
   });
</script>
<!-- for template all end here -->
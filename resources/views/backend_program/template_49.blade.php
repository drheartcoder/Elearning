<script type="text/javascript" src="{{url('/')}}/js/MathJax-master/MathJax.js?config=TeX-AMS-MML_HTMLorMML" ></script>
<script type="text/javascript" src="{{url('/')}}/js/MathJax-master/MathJax.js?config=TeX-AMS_HTML" ></script>
<div class="devSubWrapper temp-49">
   <div class="row">
      <div class="col-sm-12">
         <div class="form-group">
            <label class="bmd-label-floating">Direction </label>
            <input type="text" name="direction" id="direction" class="form-control" value="{{ old('direction') }}">
            <span class="error" id="err_direction"> @if($errors->has('direction')) {{ $errors->first('direction') }} @endif </span>
         </div>
      </div>
      <div class="col-sm-12">
         <label class="bmd-label-floating">Question <span class="red">*</span></label>
         <div class="form-group editor-section-block">
            <textarea class="form-control ckeditor" name="question" id="question" placeholder="Question"></textarea> 
            <span class="error" id="err_question"> @if($errors->has('question')) {{ $errors->first('question') }} @endif </span>
         </div>
      </div>
      <div class="clearfix"></div>
      <div class="col-sm-12">
         <div class="row">
            <div class="col-sm-6">
               <label class="bmd-label-floating">Option 1 <span class="red">*</span></label>
               <div class="form-group editor-section-block">
                  <textarea class="form-control ckeditor" name="option_1" id="option_1" placeholder="Option 1"></textarea> 
                  <span class="error" id="err_option_1"> @if($errors->has('option_1')) {{ $errors->first('option_1') }} @endif </span>
               </div>
            </div>
            <div class="col-sm-6">
               <div class="radio-btns">
                  <div class="radio-btn radio-first-option">
                     <input type="radio" id="rdoOption_1" name="rdoOption" value="1">
                     <label for="rdoOption_1">Option 1</label>
                     <div class="check"></div>
                  </div>
                  <span class="note-section-block radio-note-section-temo-20" style="margin-top: 30px;"><b>Note :</b> <span><span>Select any one option which is correct answer
                  </span></span></span>
               </div>
            </div>
         </div>
      </div>
      <div class="col-sm-12">
         <div class="row">
            <div class="col-sm-6">
               <label class="bmd-label-floating">Option 2 </label>
               <div class="form-group editor-section-block">
                  <textarea class="form-control ckeditor" name="option_2" id="option_2" placeholder="Option 2"></textarea> 
                  <span class="error" id="err_option_2"> @if($errors->has('option_2')) {{ $errors->first('option_2') }} @endif </span>
               </div>
            </div>
            <div class="col-sm-6">
               <div class="radio-btns">
                  <div class="radio-btn radio-first-option">
                     <input type="radio" id="rdoOption_2" name="rdoOption" value="2">
                     <label for="rdoOption_2">Option 2</label>
                     <div class="check"></div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="col-sm-12">
         <div class="row">
            <div class="col-sm-6">
               <label class="bmd-label-floating">Option 3 </label>
               <div class="form-group editor-section-block">
                  <textarea class="form-control ckeditor" name="option_3" id="option_3" placeholder="Option 3"></textarea> 
                  <span class="error" id="err_option_3"> @if($errors->has('option_3')) {{ $errors->first('option_3') }} @endif </span>
               </div>
            </div>
            <div class="col-sm-6">
               <div class="radio-btns">
                  <div class="radio-btn radio-first-option">
                     <input type="radio" id="rdoOption_3" name="rdoOption" value="3">
                     <label for="rdoOption_3">Option 3</label>
                     <div class="check"></div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="col-sm-12">
         <div class="row">
            <div class="col-sm-6">
               <label class="bmd-label-floating">Option 4 </label>
               <div class="form-group editor-section-block">
                  <textarea class="form-control ckeditor" name="option_4" id="option_4" placeholder="Option 4"></textarea> 
                  <span class="error" id="err_option_4"> @if($errors->has('option_4')) {{ $errors->first('option_4') }} @endif </span>
               </div>
            </div>
            <div class="col-sm-6">
               <div class="radio-btns">
                  <div class="radio-btn radio-first-option">
                     <input type="radio" id="rdoOption_4" name="rdoOption" value="4">
                     <label for="rdoOption_4">Option 4</label>
                     <div class="check"></div>
                  </div>
               </div>
            </div>
         </div>
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
         <label class="bmd-label-floating">Audio (HORN)</label>                          
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
<script type="text/javascript" language="javascript" src="{{url('/')}}/ckeditor/ckeditor.js"></script>
<link href="{{ url ('/') }}/css/admin/timingfield.css" type="text/css" rel="stylesheet" media="screen" />
<script src="{{ url ('/') }}/js/admin/timingfield.js"></script>
<script type="text/javascript">
   jQuery(document).ready(function($) {
       $(".timing").timingfield();
   });
</script>
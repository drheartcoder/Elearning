<script type="text/javascript" src="{{url('/')}}/js/MathJax-master/MathJax.js?config=TeX-AMS-MML_HTMLorMML" ></script>
<script type="text/javascript" src="{{url('/')}}/js/MathJax-master/MathJax.js?config=TeX-AMS_HTML" ></script>
<div class="devSubWrapper temp-42">
   <div class="row">
      <div class="col-sm-12">
         <div class="form-group">
            <label class="bmd-label-floating">Direction </label>
            <input type="text" name="direction" id="direction" class="form-control" value="{{ old('direction') }}">
            <span class="error" id="err_direction"> @if($errors->has('direction')) {{ $errors->first('direction') }} @endif </span>
         </div>
      </div>
      <div class="col-sm-12">
         <div class="row">
            <div class="col-sm-6">
               <label class="bmd-label-floating">Question 1 <span class="red">*</span></label>
               <div class="form-group editor-section-block">
                  <textarea class="form-control ckeditor" name="question1_1" id="question1_1" placeholder="Question 1"></textarea> 
                  <span class="error" id="err_question1_1"> @if($errors->has('question1_1')) {{ $errors->first('question1_1') }} @endif </span>
               </div>
            </div>
            <div class="col-sm-6">
               <div class="value-input-section">
                  <label class="bmd-label-floating">Answer 1 <span class="red">*</span></label>
                  <div class="value-input-section-one">
                     <input type="text" class="digitCommon" name="answer1_1" id="answer1_1" value="{{ old('answer1_1') }}" placeholder="3" maxlength="3" >
                     <span class="error" id="err_answer1_1"> @if($errors->has('answer1_1')) {{ $errors->first('answer1_1') }} @endif </span>
                  </div>
                  <div class="underline-section"></div>
                  <div class="value-input-section-one">
                     <input type="text" class="digitCommon" name="answer1_2" id="answer1_2" value="{{ old('answer1_2') }}" placeholder="7" maxlength="3" >
                     <span class="error" id="err_answer1_2"> @if($errors->has('answer1_2')) {{ $errors->first('answer1_2') }} @endif </span>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="col-sm-12">
         <div class="row">
            <div class="col-sm-6">
               <label class="bmd-label-floating">Question 2 </label>
               <div class="form-group editor-section-block">
                  <textarea class="form-control ckeditor" name="question2_1" id="question2_1" placeholder="Question 2"></textarea> 
                  <span class="error" id="err_question2_1"> @if($errors->has('question2_1')) {{ $errors->first('question2_1') }} @endif </span>
               </div>
            </div>
            <div class="col-sm-6">
               <div class="value-input-section">
                  <label class="bmd-label-floating">Answer 2 </label>
                  <div class="value-input-section-one">
                     <input type="text" class="digitCommon" name="answer2_1" id="answer2_1" value="{{ old('answer2_1') }}" placeholder="3" maxlength="3" >
                     <span class="error" id="err_answer2_1"> @if($errors->has('answer2_1')) {{ $errors->first('answer2_1') }} @endif </span>
                  </div>
                  <div class="underline-section"></div>
                  <div class="value-input-section-one">
                     <input type="text" class="digitCommon" name="answer2_2" id="answer2_2" value="{{ old('answer2_2') }}" placeholder="7" maxlength="3" >
                     <span class="error" id="err_answer2_2"> @if($errors->has('answer2_2')) {{ $errors->first('answer2_2') }} @endif </span>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="col-sm-12">
         <div class="row">
            <div class="col-sm-6">
               <label class="bmd-label-floating">Question 3 </label>
               <div class="form-group editor-section-block">
                  <textarea class="form-control ckeditor" name="question3_1" id="question3_1" placeholder="Question 3"></textarea> 
                  <span class="error" id="err_question3_1"> @if($errors->has('question3_1')) {{ $errors->first('question3_1') }} @endif </span>
               </div>
            </div>
            <div class="col-sm-6">
               <div class="value-input-section">
                  <label class="bmd-label-floating">Answer 3 </label>
                  <div class="value-input-section-one">
                     <input type="text" class="digitCommon" name="answer3_1" id="answer3_1" value="{{ old('answer3_1') }}" placeholder="3" maxlength="3" >
                     <span class="error" id="err_answer3_1"> @if($errors->has('answer3_1')) {{ $errors->first('answer3_1') }} @endif </span>
                  </div>
                  <div class="underline-section"></div>
                  <div class="value-input-section-one">
                     <input type="text" class="digitCommon" name="answer3_2" id="answer3_2" value="{{ old('answer3_2') }}" placeholder="7" maxlength="3" >
                     <span class="error" id="err_answer3_2"> @if($errors->has('answer3_2')) {{ $errors->first('answer3_2') }} @endif </span>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="col-sm-12">
         <div class="row">
            <div class="col-sm-6">
               <label class="bmd-label-floating">Question 4 </label>
               <div class="form-group editor-section-block">
                  <textarea class="form-control ckeditor" name="question4_1" id="question4_1" placeholder="Question 4"></textarea> 
                  <span class="error" id="err_question4_1"> @if($errors->has('question4_1')) {{ $errors->first('question4_1') }} @endif </span>
               </div>
            </div>
            <div class="col-sm-6">
               <div class="value-input-section">
                  <label class="bmd-label-floating">Answer 4 </label>
                  <div class="value-input-section-one">
                     <input type="text" class="digitCommon" name="answer4_1" id="answer4_1" value="{{ old('answer4_1') }}" placeholder="3" maxlength="3" >
                     <span class="error" id="err_answer4_1"> @if($errors->has('answer4_1')) {{ $errors->first('answer4_1') }} @endif </span>
                  </div>
                  <div class="underline-section"></div>
                  <div class="value-input-section-one">
                     <input type="text" class="digitCommon" name="answer4_2" id="answer4_2" value="{{ old('answer4_2') }}" placeholder="7" maxlength="3" >
                     <span class="error" id="err_answer4_2"> @if($errors->has('answer4_2')) {{ $errors->first('answer4_2') }} @endif </span>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="col-sm-12">
         <div class="row">
            <div class="col-sm-6">
               <label class="bmd-label-floating">Question 5 </label>
               <div class="form-group editor-section-block">
                  <textarea class="form-control ckeditor" name="question5_1" id="question5_1" placeholder="Question 5"></textarea> 
                  <span class="error" id="err_question5_1"> @if($errors->has('question5_1')) {{ $errors->first('question5_1') }} @endif </span>
               </div>
            </div>
            <div class="col-sm-6">
               <div class="value-input-section">
                  <label class="bmd-label-floating">Answer 5 </label>
                  <div class="value-input-section-one">
                     <input type="text" class="digitCommon" name="answer5_1" id="answer5_1" value="{{ old('answer5_1') }}" placeholder="3" maxlength="3" >
                     <span class="error" id="err_answer5_1"> @if($errors->has('answer5_1')) {{ $errors->first('answer5_1') }} @endif </span>
                  </div>
                  <div class="underline-section"></div>
                  <div class="value-input-section-one">
                     <input type="text" class="digitCommon" name="answer5_2" id="answer5_2" value="{{ old('answer5_2') }}" placeholder="7" maxlength="3" >
                     <span class="error" id="err_answer5_2"> @if($errors->has('answer5_2')) {{ $errors->first('answer5_2') }} @endif </span>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="col-sm-12">
         <div class="row">
            <div class="col-sm-6">
               <label class="bmd-label-floating">Question 6 </label>
               <div class="form-group editor-section-block">
                  <textarea class="form-control ckeditor" name="question6_1" id="question6_1" placeholder="Question 6"></textarea> 
                  <span class="error" id="err_question6_1"> @if($errors->has('question6_1')) {{ $errors->first('question6_1') }} @endif </span>
               </div>
            </div>
            <div class="col-sm-6">
               <div class="value-input-section">
                  <label class="bmd-label-floating">Answer 6 <span class="red">*</span></label>
                  <div class="value-input-section-one">
                     <input type="text" class="digitCommon" name="answer6_1" id="answer6_1" value="{{ old('answer6_1') }}" placeholder="3" maxlength="3" >
                     <span class="error" id="err_answer6_1"> @if($errors->has('answer6_1')) {{ $errors->first('answer6_1') }} @endif </span>
                  </div>
                  <div class="underline-section"></div>
                  <div class="value-input-section-one">
                     <input type="text" class="digitCommon" name="answer6_2" id="answer6_2" value="{{ old('answer6_2') }}" placeholder="7" maxlength="3" >
                     <span class="error" id="err_answer6_2"> @if($errors->has('answer5_2')) {{ $errors->first('answer6_2') }} @endif </span>
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
<script type="text/javascript" language="javascript" src="{{url('/')}}/ckeditor/ckeditor.js"></script>
<link href="{{ url ('/') }}/css/admin/timingfield.css" type="text/css" rel="stylesheet" media="screen" />
<script src="{{ url ('/') }}/js/admin/timingfield.js"></script>
<script type="text/javascript">
   jQuery(document).ready(function($) {
       $(".timing").timingfield();
   });
   $('.dwCommon').selectpicker();
</script>
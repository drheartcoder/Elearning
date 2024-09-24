<script type="text/javascript" src="{{url('/')}}/js/MathJax-master/MathJax.js?config=TeX-AMS-MML_HTMLorMML" ></script>
<script type="text/javascript" src="{{url('/')}}/js/MathJax-master/MathJax.js?config=TeX-AMS_HTML" ></script>
<div class="devSubWrapper">
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
            <div class="col-sm-4">
               <label class="bmd-label-floating">Question 1 <span class="red">*</span></label>
               <div class="form-group editor-section-block">
                  <textarea class="form-control ckeditor" name="question1_1" id="question1_1" placeholder="Question 1"></textarea> 
                  <span class="error" id="err_question1_1"> @if($errors->has('question1_1')) {{ $errors->first('question1_1') }} @endif </span>
               </div>
            </div>
            <div class="col-sm-4">
               <div class="form-group has-default bmd-form-group is-filled">
                  <select class="selectpicker dwCommon operatorCommon" data-rule-required="true" data-style="select-with-transition" name="operator1" id="operator1">
                     <option value="">Select Operator</option>
                     <option value=">">></option>
                     <option value="<"><</option>
                     <option value="=">=</option>
                  </select>
                  <span class="error" id="err_operator1"> <?php if($errors->has('operator1')) { echo $errors->first('operator1'); }  ?></span>
               </div>
            </div>
            <div class="col-sm-4">
               <label class="bmd-label-floating">Question 1 <span class="red">*</span></label>
               <div class="form-group editor-section-block">
                  <textarea class="form-control ckeditor" name="question1_2" id="question1_2" placeholder="Question 1"></textarea> 
                  <span class="error" id="err_question1_2"> @if($errors->has('question1_2')) {{ $errors->first('question1_2') }} @endif </span>
               </div>
            </div>
         </div>
      </div>
      <div class="col-sm-12">
         <div class="row">
            <div class="col-sm-4">
               <label class="bmd-label-floating">Question 2</label>
               <div class="form-group editor-section-block">
                  <textarea class="form-control ckeditor" name="question2_1" id="question2_1" placeholder="Question 2"></textarea> 
                  <span class="error" id="err_question2_1"> @if($errors->has('question2_1')) {{ $errors->first('question2_1') }} @endif </span>
               </div>
            </div>
            <div class="col-sm-4">
               <div class="form-group has-default bmd-form-group is-filled">
                  <select class="selectpicker dwCommon operatorCommon" data-rule-required="true" data-style="select-with-transition" name="operator2" id="operator2">
                     <option value="">Select Operator</option>
                     <option value=">">></option>
                     <option value="<"><</option>
                     <option value="=">=</option>
                  </select>
                  <span class="error" id="err_operator2"> <?php if($errors->has('operator2')) { echo $errors->first('operator2'); }  ?></span>
               </div>
            </div>
            <div class="col-sm-4">
               <label class="bmd-label-floating">Question 2</label>
               <div class="form-group editor-section-block">
                  <textarea class="form-control ckeditor" name="question2_2" id="question2_2" placeholder="Question 2"></textarea> 
                  <span class="error" id="err_question2_2"> @if($errors->has('question2_2')) {{ $errors->first('question2_2') }} @endif </span>
               </div>
            </div>
         </div>
      </div>
      <div class="col-sm-12">
         <div class="row">
            <div class="col-sm-4">
               <label class="bmd-label-floating">Question 3 </label>
               <div class="form-group editor-section-block">
                  <textarea class="form-control ckeditor" name="question3_1" id="question3_1" placeholder="Question 3"></textarea> 
                  <span class="error" id="err_question3_1"> @if($errors->has('question3_1')) {{ $errors->first('question3_1') }} @endif </span>
               </div>
            </div>
            <div class="col-sm-4">
               <div class="form-group has-default bmd-form-group is-filled">
                  <select class="selectpicker dwCommon operatorCommon" data-rule-required="true" data-style="select-with-transition" name="operator3" id="operator3">
                     <option value="">Select Operator</option>
                     <option value=">">></option>
                     <option value="<"><</option>
                     <option value="=">=</option>
                  </select>
                  <span class="error" id="err_operator3"> <?php if($errors->has('operator3')) { echo $errors->first('operator3'); }  ?></span>
               </div>
            </div>
            <div class="col-sm-4">
               <label class="bmd-label-floating">Question 3 </label>
               <div class="form-group editor-section-block">
                  <textarea class="form-control ckeditor" name="question3_2" id="question3_2" placeholder="Question 3"></textarea> 
                  <span class="error" id="err_question3_2"> @if($errors->has('question3_2')) {{ $errors->first('question3_2') }} @endif </span>
               </div>
            </div>
         </div>
      </div>
      <div class="col-sm-12">
         <div class="row">
            <div class="col-sm-4">
               <label class="bmd-label-floating">Question 4 </label>
               <div class="form-group editor-section-block">
                  <textarea class="form-control ckeditor" name="question4_1" id="question4_1" placeholder="Question 4"></textarea> 
                  <span class="error" id="err_question4_1"> @if($errors->has('question4_1')) {{ $errors->first('question4_1') }} @endif </span>
               </div>
            </div>
            <div class="col-sm-4">
               <div class="form-group has-default bmd-form-group is-filled">
                  <select class="selectpicker dwCommon operatorCommon" data-rule-required="true" data-style="select-with-transition" name="operator4" id="operator4">
                     <option value="">Select Operator</option>
                     <option value=">">></option>
                     <option value="<"><</option>
                     <option value="=">=</option>
                  </select>
                  <span class="error" id="err_operator4"> <?php if($errors->has('operator4')) { echo $errors->first('operator4'); }  ?></span>
               </div>
            </div>
            <div class="col-sm-4">
               <label class="bmd-label-floating">Question 4 </label>
               <div class="form-group editor-section-block">
                  <textarea class="form-control ckeditor" name="question4_2" id="question4_2" placeholder="Question 4"></textarea> 
                  <span class="error" id="err_question4_2"> @if($errors->has('question4_2')) {{ $errors->first('question4_2') }} @endif </span>
               </div>
            </div>
         </div>
      </div>
      <div class="col-sm-12">
         <div class="row">
            <div class="col-sm-4">
               <label class="bmd-label-floating">Question 5 </label>
               <div class="form-group editor-section-block">
                  <textarea class="form-control ckeditor" name="question5_1" id="question5_1" placeholder="Question 5"></textarea> 
                  <span class="error" id="err_question5_1"> @if($errors->has('question5_1')) {{ $errors->first('question5_1') }} @endif </span>
               </div>
            </div>
            <div class="col-sm-4">
               <div class="form-group has-default bmd-form-group is-filled">
                  <select class="selectpicker dwCommon operatorCommon" data-rule-required="true" data-style="select-with-transition" name="operator5" id="operator5">
                     <option value="">Select Operator</option>
                     <option value=">">></option>
                     <option value="<"><</option>
                     <option value="=">=</option>
                  </select>
                  <span class="error" id="err_operator5"> <?php if($errors->has('operator5')) { echo $errors->first('operator5'); }  ?></span>
               </div>
            </div>
            <div class="col-sm-4">
               <label class="bmd-label-floating">Question 5 </label>
               <div class="form-group editor-section-block">
                  <textarea class="form-control ckeditor" name="question5_2" id="question5_2" placeholder="Question 5"></textarea> 
                  <span class="error" id="err_question5_2"> @if($errors->has('question5_2')) {{ $errors->first('question5_2') }} @endif </span>
               </div>
            </div>
         </div>
      </div>
      <div class="col-sm-12">
         <div class="row">
            <div class="col-sm-4">
               <label class="bmd-label-floating">Question 6 </label>
               <div class="form-group editor-section-block">
                  <textarea class="form-control ckeditor" name="question6_1" id="question6_1" placeholder="Question 6"></textarea> 
                  <span class="error" id="err_question6_1"> @if($errors->has('question6_1')) {{ $errors->first('question6_1') }} @endif </span>
               </div>
            </div>
            <div class="col-sm-4">
               <div class="form-group has-default bmd-form-group is-filled">
                  <select class="selectpicker dwCommon operatorCommon" data-rule-required="true" data-style="select-with-transition" name="operator6" id="operator6">
                     <option value="">Select Operator</option>
                     <option value=">">></option>
                     <option value="<"><</option>
                     <option value="=">=</option>
                  </select>
                  <span class="error" id="err_operator6"> <?php if($errors->has('operator6')) { echo $errors->first('operator6'); }  ?></span>
               </div>
            </div>
            <div class="col-sm-4">
               <label class="bmd-label-floating">Question 6 </label>
               <div class="form-group editor-section-block">
                  <textarea class="form-control ckeditor" name="question6_2" id="question6_2" placeholder="Question 6"></textarea> 
                  <span class="error" id="err_question6_2"> @if($errors->has('question6_2')) {{ $errors->first('question6_2') }} @endif </span>
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
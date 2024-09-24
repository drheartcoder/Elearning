<div class="devSubWrapper">
   <div class="row">
      <div class="col-sm-12">
         <div class="form-group">
            <label class="bmd-label-floating">Direction </label>
            <input type="text" name="direction" id="direction" class="form-control" value="{{ old('direction') }}">
            <span class="error" id="err_direction"> @if($errors->has('direction')) {{ $errors->first('direction') }} @endif </span>
         </div>
      </div>

      <?php
         for ($i=1; $i <= 5; $i++)
         { 
           ?>
      <div class="col-sm-6">
         <label class="col-form-label">Question {{$i}} File (Image) @if($i==1)<span class="red">*</span>@endif</label>
         <div style="position: relative;" class="form-group">
            <div class="profile-img-block temp-img-block">
               <div class="pro-img">
                  <img src="{{ url('/') }}/images/default.jpg" id="imgFilePreview{{$i}}" class="img-responsive img-preview imgFilePreview" alt=""/>
                  <input style="height: 100%; width: 100%; z-index: 99;" id="flQuestion{{$i}}" name="flQuestion{{$i}}"  type="file" class="attachment_upload imgFile" data-error="no" />
               </div>
               <span class="error" id="err_flQuestion{{$i}}"> @if($errors->has('flQuestion')) {{ $errors->first('flQuestion') }} @endif </span>
               <span class="note-section-block"><b>Note :</b> <span>Allowed only jpg | jpeg | png, <br/> Upload image greater than or equal to 283 X 185 for best result.</span></span>
            </div>
         </div>
      </div>           
      <div class="col-sm-12 wrapperDiv1">
         <div class="row wrapperDiv">
            <div class="col-sm-3">
               <div class="form-group">
                  <label class="bmd-label-floating">Digit 1 @if($i==1)<span class="red">*</span>@endif</label>
                  <input type="text" name="digit{{$i}}_1" id="digit{{$i}}_1" class="form-control digit1Common digitCommon" value="<?php echo old('digit'.$i.'_1'); ?>" >
                  <span class="error err_digit1Common" id="err_digit{{$i}}_1"> <?php if($errors->has('digit'.$i.'_1')){ echo $errors->first('digit'.$i.'_1'); }  ?></span>
               </div>
               <div class="alphabate-letter-section checkbox-center">
                  <div class="check-block">
                     <input id="chk_digit{{$i}}_1" class="filled-in" type="checkbox" name="chkBlankLetter_{{ $i }}[]" value="1" >
                     <label for="chk_digit{{$i}}_1"></label>
                  </div>
               </div>
            </div>
            <div class="col-sm-3">
               <div class="form-group has-default bmd-form-group is-filled">
                  <select class="selectpicker dwCommon operatorCommon" @if($i==1) data-rule-required="true" @endif data-style="select-with-transition" name="operator{{$i}}" id="operator{{$i}}">
                     <option value="">Select Operator</option>
                     <option value="+">+</option>
                     <option value="-">-</option>
                     <option value="x">x</option>
                     <option value="/">&#247;</option>
                  </select>
                  <span class="error err_operatorCommon" id="err_operator{{$i}}"> <?php if($errors->has('operator'.$i)) { echo $errors->first('operator'.$i); }  ?></span>
               </div>
            </div>
            <div class="col-sm-3">
               <div class="form-group">
                  <label class="bmd-label-floating">Digit 2 @if($i==1)<span class="red">*</span>@endif</label>
                  <input type="text" name="digit{{$i}}_2" id="digit{{$i}}_2" class="form-control digit2Common digitCommon" value="<?php echo old('digit'.$i.'_2'); ?>" >
                  <span class="error err_digit2Common" id="err_digit{{$i}}_2"> <?php if($errors->has('digit'.$i.'_2')){ echo $errors->first('digit'.$i.'_2'); }  ?> </span>
               </div>
               <div class="alphabate-letter-section checkbox-center">
                  <div class="check-block">
                     <input id="chk_digit{{$i}}_2" class="filled-in" type="checkbox" name="chkBlankLetter_{{ $i }}[]" value="2" >
                     <label for="chk_digit{{$i}}_2"></label>
                  </div>
               </div>
            </div>
            <div class="col-sm-3">
               <div class="form-group">
                  <label class="bmd-label-floating">Answer @if($i==1)<span class="red">*</span>@endif</label>
                  <input type="text" name="answer{{$i}}" id="answer{{$i}}" class="form-control answerCommon digitCommon" value="<?php echo old('answer'.$i); ?>" readonly="readonly" >
                  <span class="error" id="err_answer{{$i}}"> <?php if($errors->has('digit'.$i)){ echo $errors->first('answer'.$i); }  ?>  </span>
               </div>
               <div class="alphabate-letter-section checkbox-center">
                  <div class="check-block">
                     <input id="chk_answer{{$i}}" class="filled-in" type="checkbox" name="chkBlankLetter_{{ $i }}[]" value="3" >
                     <label for="chk_answer{{$i}}"></label>
                  </div>
               </div>
            </div>
            <div class="col-sm-12">
               <span class="error" id="err_chkBlankLetter_{{ $i }}"> <?php if($errors->has('chkBlankLetter_'.$i)) { echo $errors->first('chkBlankLetter_'.$i); }  ?></span>
               <!--<div class="text-center">-->
               <span class="note-section-block form-note-section mb20 new-nots"><b>Note :</b> <span>Please select checkbox which field you want to hide.</span></span>
               <!--</div>-->
            </div>
         </div>
      </div>
      <?php
         }
         ?>
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
      </div> -->
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
       imageSizeValidate(tempThis, files, '283', '185');
   });
</script>

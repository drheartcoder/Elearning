<div class="devSubWrapper">
   <div class="row">
      <div class="col-sm-12">
         <div class="form-group">
            <label class="bmd-label-floating">Direction </label>
            <input type="text" name="direction" id="direction" class="form-control" value="{{ old('direction') }}">
            <span class="error" id="err_direction"> @if($errors->has('direction')) {{ $errors->first('direction') }} @endif </span>
         </div>
      </div>
      <div class="eqation-table">
         <span class="note-section-block form-note-section mb20"><b>Note :</b> <span>Please select checkbox which block you want to hide.</span></span>
         <table>
            <tr>
               <td class="td-input">
                  <input type="text" name="question[]" class="classQuestion digitCommon" maxlength="3" >
                  <div class="alphabate-letter-section checkbox-center">
                     <div class="check-block">
                        <input name="chkBlankLetter[]" id="chkBlankLetter1" class="filled-in chkBlankLetter" type="checkbox" value="1" >
                        <label for="chkBlankLetter1"></label>
                     </div>
                  </div>
               </td>
               <td class="td-input">
                  <div class="dropdown bootstrap-select">
                     <select name="operator" class="selectpicker dwCommon operator" data-style="select-with-transition" title="Select Operator" data-size="7" tabindex="-98">
                        <option value="+">+</option>
                        <option value="-">-</option>
                        <option value="X" selected >X</option>
                        <option value="/">&#247;</option>
                     </select>
                  </div>
                  <input type="hidden" name="question[]" class="classQuestion" maxlength="3" value="X" >
                  <!-- <div class="alphabate-letter-section checkbox-center">
                     <div class="check-block">
                         <input name="chkBlankLetter[]" id="chkBlankLetter2" class="filled-in chkBlankLetter" type="checkbox" value="2" >
                         <label for="chkBlankLetter2"></label>
                     </div>
                     </div>   -->
               </td>
               <td class="td-input">
                  <input type="text" name="question[]" class="classQuestion digitCommon" maxlength="3" >
                  <div class="alphabate-letter-section checkbox-center">
                     <div class="check-block">
                        <input name="chkBlankLetter[]" id="chkBlankLetter3" class="filled-in chkBlankLetter" type="checkbox" value="3" >
                        <label for="chkBlankLetter3"></label>
                     </div>
                  </div>
               </td>
               <td class="td-input">
                  <input type="text" name="question[]" class="classQuestion" maxlength="3" value="=" readonly="readonly">
                  <!-- <div class="alphabate-letter-section checkbox-center">
                     <div class="check-block">
                         <input name="chkBlankLetter[]" id="chkBlankLetter4" class="filled-in chkBlankLetter" type="checkbox" value="4" >
                         <label for="chkBlankLetter4"></label>
                     </div>
                     </div>   -->
               </td>
               <td class="td-input">
                  <input type="text" name="question[]" class="classQuestion digitCommon" maxlength="3" >
                  <div class="alphabate-letter-section checkbox-center">
                     <div class="check-block">
                        <input name="chkBlankLetter[]" id="chkBlankLetter5" class="filled-in chkBlankLetter" type="checkbox" value="5" >
                        <label for="chkBlankLetter5"></label>
                     </div>
                  </div>
               </td>
               <td></td>
               <td class="td-input">
                  <input type="text" name="question[]" class="classQuestion digitCommon" maxlength="3" >
                  <div class="alphabate-letter-section checkbox-center">
                     <div class="check-block">
                        <input name="chkBlankLetter[]" id="chkBlankLetter6" class="filled-in chkBlankLetter" type="checkbox" value="6" >
                        <label for="chkBlankLetter6"></label>
                     </div>
                  </div>
               </td>
               <td class="td-input">
                  <div class="dropdown bootstrap-select">
                     <select name="operator" class="selectpicker dwCommon operator" data-style="select-with-transition" title="Select Operator" data-size="7" tabindex="-98">
                        <option value="+">+</option>
                        <option value="-">-</option>
                        <option value="X" selected >X</option>
                        <option value="/">&#247;</option>
                     </select>
                  </div>
                  <input type="hidden" name="question[]" class="classQuestion" maxlength="3" value="X" >
                  <!-- <div class="alphabate-letter-section checkbox-center">
                     <div class="check-block">
                         <input name="chkBlankLetter[]" id="chkBlankLetter7" class="filled-in chkBlankLetter" type="checkbox" value="7" >
                         <label for="chkBlankLetter7"></label>
                     </div>
                     </div>   -->
               </td>
               <td class="td-input">
                  <input type="text" name="question[]" class="classQuestion digitCommon" maxlength="3" >
                  <div class="alphabate-letter-section checkbox-center">
                     <div class="check-block">
                        <input name="chkBlankLetter[]" id="chkBlankLetter8" class="filled-in chkBlankLetter" type="checkbox" value="8" >
                        <label for="chkBlankLetter8"></label>
                     </div>
                  </div>
               </td>
               <td class="td-input">
                  <input type="text" name="question[]" class="classQuestion" maxlength="3" value="=" readonly="readonly" >
                  <!-- <div class="alphabate-letter-section checkbox-center">
                     <div class="check-block">
                         <input name="chkBlankLetter[]" id="chkBlankLetter9" class="filled-in chkBlankLetter" type="checkbox" value="9" >
                         <label for="chkBlankLetter9"></label>
                     </div>
                     </div>   -->
               </td>
               <td class="td-input">
                  <input type="text" name="question[]" class="classQuestion digitCommon" maxlength="3" >
                  <div class="alphabate-letter-section checkbox-center">
                     <div class="check-block">
                        <input name="chkBlankLetter[]" id="chkBlankLetter10" class="filled-in chkBlankLetter" type="checkbox" value="10" >
                        <label for="chkBlankLetter10"></label>
                     </div>
                  </div>
               </td>
            </tr>
            <tr>
               <td></td>
               <td></td>
               <td></td>
               <td></td>
               <td class="td-input">
                  <div class="dropdown bootstrap-select">
                     <select name="operator" class="selectpicker dwCommon operator" data-style="select-with-transition" title="Select Operator" data-size="7" tabindex="-98">
                        <option value="+">+</option>
                        <option value="-">-</option>
                        <option value="X" selected >X</option>
                        <option value="/">&#247;</option>
                     </select>
                  </div>
                  <input type="hidden" name="question[]" class="classQuestion" maxlength="3" value="X" >
                  <!-- <div class="alphabate-letter-section checkbox-center">
                     <div class="check-block">
                         <input name="chkBlankLetter[]" id="chkBlankLetter11" class="filled-in chkBlankLetter" type="checkbox" value="11" >
                         <label for="chkBlankLetter11"></label>
                     </div>
                     </div>   -->
               </td>
               <td></td>
               <td class="td-input">
                  <div class="dropdown bootstrap-select">
                     <select name="operator" class="selectpicker dwCommon operator" data-style="select-with-transition" title="Select Operator" data-size="7" tabindex="-98">
                        <option value="+">+</option>
                        <option value="-">-</option>
                        <option value="X" selected >X</option>
                        <option value="/">&#247;</option>
                     </select>
                  </div>
                  <input type="hidden" name="question[]" class="classQuestion" maxlength="3" value="X" >
                  <!-- <div class="alphabate-letter-section checkbox-center">
                     <div class="check-block">
                         <input name="chkBlankLetter[]" id="chkBlankLetter12" class="filled-in chkBlankLetter" type="checkbox" value="12" >
                         <label for="chkBlankLetter12"></label>
                     </div>
                     </div>   -->
               </td>
               <td></td>
               <td></td>
               <td></td>
               <td></td>
            </tr>
            <tr>
               <td class="td-input">
                  <input type="text" name="question[]" class="classQuestion digitCommon" maxlength="3" >
                  <div class="alphabate-letter-section checkbox-center">
                     <div class="check-block">
                        <input name="chkBlankLetter[]" id="chkBlankLetter13" class="filled-in chkBlankLetter" type="checkbox" value="13" >
                        <label for="chkBlankLetter13"></label>
                     </div>
                  </div>
               </td>
               <td class="td-input">
                  <div class="dropdown bootstrap-select">
                     <select name="operator" class="selectpicker dwCommon operator" data-style="select-with-transition" title="Select Operator" data-size="7" tabindex="-98">
                        <option value="+">+</option>
                        <option value="-">-</option>
                        <option value="X" selected >X</option>
                        <option value="/">&#247;</option>
                     </select>
                  </div>
                  <input type="hidden" name="question[]" class="classQuestion" maxlength="3" value="X" >
                  <!-- <div class="alphabate-letter-section checkbox-center">
                     <div class="check-block">
                         <input name="chkBlankLetter[]" id="chkBlankLetter14" class="filled-in chkBlankLetter" type="checkbox" value="14" >
                         <label for="chkBlankLetter14"></label>
                     </div>
                     </div>   -->
               </td>
               <td class="td-input">
                  <input type="text" name="question[]" class="classQuestion digitCommon" maxlength="3" >
                  <div class="alphabate-letter-section checkbox-center">
                     <div class="check-block">
                        <input name="chkBlankLetter[]" id="chkBlankLetter15" class="filled-in chkBlankLetter" type="checkbox" value="15" >
                        <label for="chkBlankLetter15"></label>
                     </div>
                  </div>
               </td>
               <td class="td-input">
                  <input type="text" name="question[]" class="classQuestion" maxlength="3" value="=" readonly="readonly" >
                  <!-- <div class="alphabate-letter-section checkbox-center">
                     <div class="check-block">
                         <input name="chkBlankLetter[]" id="chkBlankLetter16" class="filled-in chkBlankLetter" type="checkbox" value="16" >
                         <label for="chkBlankLetter16"></label>
                     </div>
                     </div>   -->
               </td>
               <td class="td-input">
                  <input type="text" name="question[]" class="classQuestion digitCommon" maxlength="3" >
                  <div class="alphabate-letter-section checkbox-center">
                     <div class="check-block">
                        <input name="chkBlankLetter[]" id="chkBlankLetter17" class="filled-in chkBlankLetter" type="checkbox" value="17" >
                        <label for="chkBlankLetter17"></label>
                     </div>
                  </div>
               </td>
               <td></td>
               <td class="td-input">
                  <input type="text" name="question[]" class="classQuestion digitCommon" maxlength="3" >
                  <div class="alphabate-letter-section checkbox-center">
                     <div class="check-block">
                        <input name="chkBlankLetter[]" id="chkBlankLetter18" class="filled-in chkBlankLetter" type="checkbox" value="18" >
                        <label for="chkBlankLetter18"></label>
                     </div>
                  </div>
               </td>
               <td class="td-input">
                  <div class="dropdown bootstrap-select">
                     <select name="operator" class="selectpicker dwCommon operator" data-style="select-with-transition" title="Select Operator" data-size="7" tabindex="-98">
                        <option value="+">+</option>
                        <option value="-">-</option>
                        <option value="X" selected >X</option>
                        <option value="/">&#247;</option>
                     </select>
                  </div>
                  <input type="hidden" name="question[]" class="classQuestion" maxlength="3" value="X" >
                  <!-- <div class="alphabate-letter-section checkbox-center">
                     <div class="check-block">
                         <input name="chkBlankLetter[]" id="chkBlankLetter19" class="filled-in chkBlankLetter" type="checkbox" value="19" >
                         <label for="chkBlankLetter19"></label>
                     </div>
                     </div>   -->
               </td>
               <td class="td-input">
                  <input type="text" name="question[]" class="classQuestion digitCommon" maxlength="3" >
                  <div class="alphabate-letter-section checkbox-center">
                     <div class="check-block">
                        <input name="chkBlankLetter[]" id="chkBlankLetter20" class="filled-in chkBlankLetter" type="checkbox" value="20" >
                        <label for="chkBlankLetter20"></label>
                     </div>
                  </div>
               </td>
               <td class="td-input">
                  <input type="text" name="question[]" class="classQuestion" maxlength="3" value="=" readonly="readonly">
                  <!-- <div class="alphabate-letter-section checkbox-center">
                     <div class="check-block">
                         <input name="chkBlankLetter[]" id="chkBlankLetter21" class="filled-in chkBlankLetter" type="checkbox" value="21" >
                         <label for="chkBlankLetter21"></label>
                     </div>
                     </div>   -->
               </td>
               <td class="td-input">
                  <input type="text" name="question[]" class="classQuestion digitCommon" maxlength="3" >
                  <div class="alphabate-letter-section checkbox-center">
                     <div class="check-block">
                        <input name="chkBlankLetter[]" id="chkBlankLetter22" class="filled-in chkBlankLetter" type="checkbox" value="22" >
                        <label for="chkBlankLetter22"></label>
                     </div>
                  </div>
               </td>
            </tr>
            <tr>
               <td></td>
               <td></td>
               <td></td>
               <td></td>
               <td class="td-input">
                  <input type="text" name="question[]" class="classQuestion" maxlength="3" value="=" readonly="readonly" >
                  <!-- <div class="alphabate-letter-section checkbox-center">
                     <div class="check-block">
                         <input name="chkBlankLetter[]" id="chkBlankLetter23" class="filled-in chkBlankLetter" type="checkbox" value="23" >
                         <label for="chkBlankLetter23"></label>
                     </div>
                     </div>   -->
               </td>
               <td></td>
               <td class="td-input">
                  <input type="text" name="question[]" class="classQuestion" maxlength="3" value="=" readonly="readonly" value="X" >
                  <!-- <div class="alphabate-letter-section checkbox-center">
                     <div class="check-block">
                         <input name="chkBlankLetter[]" id="chkBlankLetter24" class="filled-in chkBlankLetter" type="checkbox" value="24" >
                         <label for="chkBlankLetter24"></label>
                     </div>
                     </div>   -->
               </td>
               <td></td>
               <td></td>
               <td></td>
               <td></td>
            </tr>
            <tr>
               <td></td>
               <td></td>
               <td class="td-input">
                  <input type="text" name="question[]" class="classQuestion digitCommon" maxlength="3" >
                  <div class="alphabate-letter-section checkbox-center">
                     <div class="check-block">
                        <input name="chkBlankLetter[]" id="chkBlankLetter25" class="filled-in chkBlankLetter" type="checkbox" value="25" >
                        <label for="chkBlankLetter25"></label>
                     </div>
                  </div>
               </td>
               <td class="td-input">
                  <div class="dropdown bootstrap-select">
                     <select name="operator" class="selectpicker dwCommon operator" data-style="select-with-transition" title="Select Operator" data-size="7" tabindex="-98">
                        <option value="+">+</option>
                        <option value="-">-</option>
                        <option value="X" selected >X</option>
                        <option value="/">&#247;</option>
                     </select>
                  </div>
                  <input type="hidden" name="question[]" class="classQuestion" maxlength="3" value="X" >
                  <!-- <div class="alphabate-letter-section checkbox-center">
                     <div class="check-block">
                         <input name="chkBlankLetter[]" id="chkBlankLetter26" class="filled-in chkBlankLetter" type="checkbox" value="26" >
                         <label for="chkBlankLetter26"></label>
                     </div>
                     </div>   -->
               </td>
               <td class="td-input">
                  <input type="text" name="question[]" class="classQuestion digitCommon" maxlength="3" >
                  <div class="alphabate-letter-section checkbox-center">
                     <div class="check-block">
                        <input name="chkBlankLetter[]" id="chkBlankLetter27" class="filled-in chkBlankLetter" type="checkbox" value="27" >
                        <label for="chkBlankLetter27"></label>
                     </div>
                  </div>
               </td>
               <td class="td-input">
                  <input type="text" name="question[]" class="classQuestion" maxlength="3" value="=" readonly="readonly" >
                  <!-- <div class="alphabate-letter-section checkbox-center">
                     <div class="check-block">
                         <input name="chkBlankLetter[]" id="chkBlankLetter28" class="filled-in chkBlankLetter" type="checkbox" value="28" >
                         <label for="chkBlankLetter28"></label>
                     </div>
                     </div>   -->
               </td>
               <td class="td-input">
                  <input type="text" name="question[]" class="classQuestion digitCommon" maxlength="3" >
                  <div class="alphabate-letter-section checkbox-center">
                     <div class="check-block">
                        <input name="chkBlankLetter[]" id="chkBlankLetter29" class="filled-in chkBlankLetter" type="checkbox" value="29" >
                        <label for="chkBlankLetter29"></label>
                     </div>
                  </div>
               </td>
               <td></td>
               <td></td>
               <td></td>
               <td></td>
            </tr>
         </table>
      </div>
   </div>
   <br/>
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
   $('.dwCommon').selectpicker();
   jQuery(document).ready(function($) {
       $(".timing").timingfield();
   });
   
   $(document).on('change', '.operator', function(){
       var operator = $(this).val();
       if(operator!='')
       {
           $(this).closest('.td-input').find('.classQuestion').val(operator);
       }
   });
</script>
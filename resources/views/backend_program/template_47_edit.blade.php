@extends($role_slug.'.layout.master')    
@section('main_content')
<!-- BEGIN Main Content -->
<!-- Page header -->
@include($role_slug.'.layout.breadcrumb')  
<!-- /page header -->
<script src="{{url('/')}}/js/admin/jquery.form.js"></script> 
<!-- Content area -->
<div class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="card-body-section">
            <div class="card">
               <div class="card-header card-header-icon card-header-rose">
                  <div class="card-icon">
                     <i class="fa fa-gear"></i>
                  </div>
                  <h4 class="card-title">{{$module_title or ''}}</h4>
               </div>
               <div class="card-body">
                  @include($role_slug.'.layout._operation_status')
                  <form name="frmUpdate" id="frmUpdate" method="post" action="{{ $module_url_path.'/update' }}" enctype="multipart/form-data">
                     {{ csrf_field() }}
                     @if(isset($arrQuestion['file_type']) && $arrQuestion['file_type']!='')
                     <input type="hidden" name="oldFileType" id="oldFileType" value="{{ $arrQuestion['file_type'] }}">
                     @endif
                     <input type="hidden" name="programId" value="{{ $programId }}">
                     <input type="hidden" name="templateId" value="{{ $templateId }}">
                     <input type="hidden" name="hiddenTemplate" value="{{ $templateId }}">
                     <input type="hidden" name="questionId" value="{{ $questionId }}">
                     <div class="devSubWrapper">
                        <div class="row">
                           <div class="col-sm-12">
                              <div class="form-group">
                                 <label class="bmd-label-floating">Direction </label>
                                 <input type="text" name="direction" id="direction" class="form-control" value="{{ (isset($arrQuestion['question']) && $arrQuestion['question']!='') ? $arrQuestion['question'] : '' }}" >
                                 <span class="error" id="err_direction"> @if($errors->has('direction')) {{ $errors->first('direction') }} @endif </span>
                              </div>
                           </div>
                        </div>
                        <?php
                           $arrQuestionText = $arrAnswer = [];
                           if(isset($arrQuestion['question_text']) && $arrQuestion['question_text']!='')
                           {
                              $arrQuestionText = explode(',', $arrQuestion['question_text']);
                           }
                           if(isset($arrQuestion['answer']) && $arrQuestion['answer']!='')
                           {
                              $arrAnswer = explode(',', $arrQuestion['answer']);
                           }
                           //dd($arrQuestionText, $arrAnswer);
                           ?>
                        <div class="eqation-table">
                           <span class="note-section-block form-note-section mb20"><b>Note :</b> <span>Please select checkbox which block you want to hide.</span></span>
                           <table>
                              <!-- 1 -->
                              <tr>
                                 <td class="td-input">
                                    <input type="text" name="question[]" class="classQuestion digitCommon" maxlength="3" value="{{ (count($arrQuestionText) > 0 && $arrQuestionText[0]!='') ? $arrQuestionText[0] : '' }}" >
                                    <div class="alphabate-letter-section checkbox-center">
                                       <div class="check-block">
                                          <input name="chkBlankLetter[]" id="chkBlankLetter1" class="filled-in chkBlankLetter" type="checkbox" value="1" @if(count($arrAnswer) > 0 && $arrAnswer[0]=='0') checked  @endif >
                                          <label for="chkBlankLetter1"></label>
                                       </div>
                                    </div>
                                 </td>
                                 <td class="td-input">
                                    <div class="dropdown bootstrap-select">
                                       <select name="operator" class="selectpicker dwCommon operator" data-style="select-with-transition" title="Select Operator" data-size="7" tabindex="-98">                                  
                                       <option value="+" @if(count($arrQuestionText) > 0 && $arrQuestionText[1]=='+') selected  @endif >+</option>
                                       <option value="-" @if(count($arrQuestionText) > 0 && $arrQuestionText[1]=='-') selected  @endif >-</option>
                                       <option value="X" @if(count($arrQuestionText) > 0 && $arrQuestionText[1]=='X') selected  @endif >X</option>
                                       <option value="/" @if(count($arrQuestionText) > 0 && $arrQuestionText[1]=='/') selected  @endif >&#247;</option>
                                       </select>
                                    </div>
                                    <input type="hidden" name="question[]" class="classQuestion" maxlength="3" value="{{ (count($arrQuestionText) > 0 && $arrQuestionText[1]!='') ? $arrQuestionText[1] : '' }}" >
                                    <!-- <div class="alphabate-letter-section checkbox-center">
                                       <div class="check-block">
                                           <input name="chkBlankLetter[]" id="chkBlankLetter2" class="filled-in chkBlankLetter" type="checkbox" value="2" >
                                           <label for="chkBlankLetter2"></label>
                                       </div>
                                       </div>   -->
                                 </td>
                                 <td class="td-input">
                                    <input type="text" name="question[]" class="classQuestion digitCommon" maxlength="3" value="{{ (count($arrQuestionText) > 0 && $arrQuestionText[2]!='') ? $arrQuestionText[2] : '' }}" >
                                    <div class="alphabate-letter-section checkbox-center">
                                       <div class="check-block">
                                          <input name="chkBlankLetter[]" id="chkBlankLetter3" class="filled-in chkBlankLetter" type="checkbox" value="3" @if(count($arrAnswer) > 0 && $arrAnswer[2]=='0') checked  @endif >
                                          <label for="chkBlankLetter3"></label>
                                       </div>
                                    </div>
                                 </td>
                                 <td class="td-input">
                                    <input type="text" name="question[]" class="classQuestion" maxlength="3" readonly="readonly" value="{{ (count($arrQuestionText) > 0 && $arrQuestionText[3]!='') ? $arrQuestionText[3] : '' }}" >
                                    <!-- <div class="alphabate-letter-section checkbox-center">
                                       <div class="check-block">
                                           <input name="chkBlankLetter[]" id="chkBlankLetter4" class="filled-in chkBlankLetter" type="checkbox" value="4" >
                                           <label for="chkBlankLetter4"></label>
                                       </div>
                                       </div>   -->
                                 </td>
                                 <td class="td-input">
                                    <input type="text" name="question[]" class="classQuestion digitCommon" maxlength="3" value="{{ (count($arrQuestionText) > 0 && $arrQuestionText[4]!='') ? $arrQuestionText[4] : '' }}" >
                                    <div class="alphabate-letter-section checkbox-center">
                                       <div class="check-block">
                                          <input name="chkBlankLetter[]" id="chkBlankLetter5" class="filled-in chkBlankLetter" type="checkbox" value="5" @if(count($arrAnswer) > 0 && $arrAnswer[4]=='0') checked  @endif >
                                          <label for="chkBlankLetter5"></label>
                                       </div>
                                    </div>
                                 </td>
                                 <td></td>
                                 <td class="td-input">
                                    <input type="text" name="question[]" class="classQuestion digitCommon" maxlength="3" value="{{ (count($arrQuestionText) > 0 && $arrQuestionText[5]!='') ? $arrQuestionText[5] : '' }}" >
                                    <div class="alphabate-letter-section checkbox-center">
                                       <div class="check-block">
                                          <input name="chkBlankLetter[]" id="chkBlankLetter6" class="filled-in chkBlankLetter" type="checkbox" value="6" @if(count($arrAnswer) > 0 && $arrAnswer[5]=='0') checked  @endif >
                                          <label for="chkBlankLetter6"></label>
                                       </div>
                                    </div>
                                 </td>
                                 <td class="td-input">
                                    <div class="dropdown bootstrap-select">
                                       <select name="operator" class="selectpicker dwCommon operator" data-style="select-with-transition" title="Select Operator" data-size="7" tabindex="-98">                                  
                                       <option value="+" @if(count($arrQuestionText) > 0 && $arrQuestionText[6]=='+') selected  @endif >+</option>
                                       <option value="-" @if(count($arrQuestionText) > 0 && $arrQuestionText[6]=='-') selected  @endif >-</option>
                                       <option value="X" @if(count($arrQuestionText) > 0 && $arrQuestionText[6]=='X') selected  @endif >X</option>
                                       <option value="/" @if(count($arrQuestionText) > 0 && $arrQuestionText[6]=='/') selected  @endif >&#247;</option>
                                       </select>
                                    </div>
                                    <input type="hidden" name="question[]" class="classQuestion" maxlength="3" value="{{ (count($arrQuestionText) > 0 && $arrQuestionText[6]!='') ? $arrQuestionText[6] : '' }}" >
                                    <!-- <div class="alphabate-letter-section checkbox-center">
                                       <div class="check-block">
                                           <input name="chkBlankLetter[]" id="chkBlankLetter7" class="filled-in chkBlankLetter" type="checkbox" value="7" >
                                           <label for="chkBlankLetter7"></label>
                                       </div>
                                       </div>   -->
                                 </td>
                                 <td class="td-input">
                                    <input type="text" name="question[]" class="classQuestion digitCommon" maxlength="3" value="{{ (count($arrQuestionText) > 0 && $arrQuestionText[7]!='') ? $arrQuestionText[7] : '' }}" >
                                    <div class="alphabate-letter-section checkbox-center">
                                       <div class="check-block">
                                          <input name="chkBlankLetter[]" id="chkBlankLetter8" class="filled-in chkBlankLetter" type="checkbox" value="8" @if(count($arrAnswer) > 0 && $arrAnswer[7]=='0') checked  @endif >
                                          <label for="chkBlankLetter8"></label>
                                       </div>
                                    </div>
                                 </td>
                                 <td class="td-input">
                                    <input type="text" name="question[]" class="classQuestion" maxlength="3" readonly="readonly" value="{{ (count($arrQuestionText) > 0 && $arrQuestionText[8]!='') ? $arrQuestionText[8] : '' }}" >
                                    <!-- <div class="alphabate-letter-section checkbox-center">
                                       <div class="check-block">
                                           <input name="chkBlankLetter[]" id="chkBlankLetter9" class="filled-in chkBlankLetter" type="checkbox" value="9" >
                                           <label for="chkBlankLetter9"></label>
                                       </div>
                                       </div>   -->
                                 </td>
                                 <td class="td-input">
                                    <input type="text" name="question[]" class="classQuestion digitCommon" maxlength="3" value="{{ (count($arrQuestionText) > 0 && $arrQuestionText[9]!='') ? $arrQuestionText[9] : '' }}" >
                                    <div class="alphabate-letter-section checkbox-center">
                                       <div class="check-block">
                                          <input name="chkBlankLetter[]" id="chkBlankLetter10" class="filled-in chkBlankLetter" type="checkbox" value="10" @if(count($arrAnswer) > 0 && $arrAnswer[9]=='0') checked  @endif >
                                          <label for="chkBlankLetter10"></label>
                                       </div>
                                    </div>
                                 </td>
                              </tr>
                              <!-- 2 -->
                              <tr>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td class="td-input">
                                    <div class="dropdown bootstrap-select">
                                       <select name="operator" class="selectpicker dwCommon operator" data-style="select-with-transition" title="Select Operator" data-size="7" tabindex="-98">                                  
                                       <option value="+" @if(count($arrQuestionText) > 0 && $arrQuestionText[10]=='+') selected  @endif >+</option>
                                       <option value="-" @if(count($arrQuestionText) > 0 && $arrQuestionText[10]=='-') selected  @endif >-</option>
                                       <option value="X" @if(count($arrQuestionText) > 0 && $arrQuestionText[10]=='X') selected  @endif >X</option>
                                       <option value="/" @if(count($arrQuestionText) > 0 && $arrQuestionText[10]=='/') selected  @endif >&#247;</option>
                                       </select>
                                    </div>
                                    <input type="hidden" name="question[]" class="classQuestion" maxlength="3" value="{{ (count($arrQuestionText) > 0 && $arrQuestionText[10]!='') ? $arrQuestionText[10] : '' }}" >
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
                                       <option value="+" @if(count($arrQuestionText) > 0 && $arrQuestionText[11]=='+') selected  @endif >+</option>
                                       <option value="-" @if(count($arrQuestionText) > 0 && $arrQuestionText[11]=='-') selected  @endif >-</option>
                                       <option value="X" @if(count($arrQuestionText) > 0 && $arrQuestionText[11]=='X') selected  @endif >X</option>
                                       <option value="/" @if(count($arrQuestionText) > 0 && $arrQuestionText[11]=='/') selected  @endif >&#247;</option>
                                       </select>
                                    </div>
                                    <input type="hidden" name="question[]" class="classQuestion" maxlength="3" value="{{ (count($arrQuestionText) > 0 && $arrQuestionText[11]!='') ? $arrQuestionText[11] : '' }}" >
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
                              <!-- 3 -->
                              <tr>
                                 <td class="td-input">
                                    <input type="text" name="question[]" class="classQuestion digitCommon" maxlength="3" value="{{ (count($arrQuestionText) > 0 && $arrQuestionText[12]!='') ? $arrQuestionText[12] : '' }}" >
                                    <div class="alphabate-letter-section checkbox-center">
                                       <div class="check-block">
                                          <input name="chkBlankLetter[]" id="chkBlankLetter13" class="filled-in chkBlankLetter" type="checkbox" value="13" @if(count($arrAnswer) > 0 && $arrAnswer[12]=='0') checked  @endif >
                                          <label for="chkBlankLetter13"></label>
                                       </div>
                                    </div>
                                 </td>
                                 <td class="td-input">
                                    <div class="dropdown bootstrap-select">
                                       <select name="operator" class="selectpicker dwCommon operator" data-style="select-with-transition" title="Select Operator" data-size="7" tabindex="-98">                                  
                                       <option value="+" @if(count($arrQuestionText) > 0 && $arrQuestionText[13]=='+') selected  @endif >+</option>
                                       <option value="-" @if(count($arrQuestionText) > 0 && $arrQuestionText[13]=='-') selected  @endif >-</option>
                                       <option value="X" @if(count($arrQuestionText) > 0 && $arrQuestionText[13]=='X') selected  @endif >X</option>
                                       <option value="/" @if(count($arrQuestionText) > 0 && $arrQuestionText[13]=='/') selected  @endif >&#247;</option>
                                       </select>
                                    </div>
                                    <input type="hidden" name="question[]" class="classQuestion" maxlength="3" value="{{ (count($arrQuestionText) > 0 && $arrQuestionText[13]!='') ? $arrQuestionText[13] : '' }}" >
                                    <!-- <div class="alphabate-letter-section checkbox-center">
                                       <div class="check-block">
                                           <input name="chkBlankLetter[]" id="chkBlankLetter14" class="filled-in chkBlankLetter" type="checkbox" value="14" >
                                           <label for="chkBlankLetter14"></label>
                                       </div>
                                       </div>   -->
                                 </td>
                                 <td class="td-input">
                                    <input type="text" name="question[]" class="classQuestion digitCommon" maxlength="3" value="{{ (count($arrQuestionText) > 0 && $arrQuestionText[14]!='') ? $arrQuestionText[14] : '' }}" >
                                    <div class="alphabate-letter-section checkbox-center">
                                       <div class="check-block">
                                          <input name="chkBlankLetter[]" id="chkBlankLetter15" class="filled-in chkBlankLetter" type="checkbox" value="15" @if(count($arrAnswer) > 0 && $arrAnswer[14]=='0') checked  @endif >
                                          <label for="chkBlankLetter15"></label>
                                       </div>
                                    </div>
                                 </td>
                                 <td class="td-input">
                                    <input type="text" name="question[]" class="classQuestion" maxlength="3" readonly="readonly" value="{{ (count($arrQuestionText) > 0 && $arrQuestionText[15]!='') ? $arrQuestionText[15] : '' }}" >
                                    <!-- <div class="alphabate-letter-section checkbox-center">
                                       <div class="check-block">
                                           <input name="chkBlankLetter[]" id="chkBlankLetter16" class="filled-in chkBlankLetter" type="checkbox" value="16" >
                                           <label for="chkBlankLetter16"></label>
                                       </div>
                                       </div>   -->
                                 </td>
                                 <td class="td-input">
                                    <input type="text" name="question[]" class="classQuestion digitCommon" maxlength="3" value="{{ (count($arrQuestionText) > 0 && $arrQuestionText[16]!='') ? $arrQuestionText[16] : '' }}" >
                                    <div class="alphabate-letter-section checkbox-center">
                                       <div class="check-block">
                                          <input name="chkBlankLetter[]" id="chkBlankLetter17" class="filled-in chkBlankLetter" type="checkbox" value="17" @if(count($arrAnswer) > 0 && $arrAnswer[16]=='0') checked  @endif >
                                          <label for="chkBlankLetter17"></label>
                                       </div>
                                    </div>
                                 </td>
                                 <td></td>
                                 <td class="td-input">
                                    <input type="text" name="question[]" class="classQuestion digitCommon" maxlength="3" value="{{ (count($arrQuestionText) > 0 && $arrQuestionText[17]!='') ? $arrQuestionText[17] : '' }}" >
                                    <div class="alphabate-letter-section checkbox-center">
                                       <div class="check-block">
                                          <input name="chkBlankLetter[]" id="chkBlankLetter18" class="filled-in chkBlankLetter" type="checkbox" value="18" @if(count($arrAnswer) > 0 && $arrAnswer[17]=='0') checked  @endif >
                                          <label for="chkBlankLetter18"></label>
                                       </div>
                                    </div>
                                 </td>
                                 <td class="td-input">
                                    <div class="dropdown bootstrap-select">
                                       <select name="operator" class="selectpicker dwCommon operator" data-style="select-with-transition" title="Select Operator" data-size="7" tabindex="-98">                                  
                                       <option value="+" @if(count($arrQuestionText) > 0 && $arrQuestionText[18]=='+') selected  @endif >+</option>
                                       <option value="-" @if(count($arrQuestionText) > 0 && $arrQuestionText[18]=='-') selected  @endif >-</option>
                                       <option value="X" @if(count($arrQuestionText) > 0 && $arrQuestionText[18]=='X') selected  @endif >X</option>
                                       <option value="/" @if(count($arrQuestionText) > 0 && $arrQuestionText[18]=='/') selected  @endif >&#247;</option>
                                       </select>
                                    </div>
                                    <input type="hidden" name="question[]" class="classQuestion" maxlength="3" value="{{ (count($arrQuestionText) > 0 && $arrQuestionText[18]!='') ? $arrQuestionText[18] : '' }}" >
                                    <!-- <div class="alphabate-letter-section checkbox-center">
                                       <div class="check-block">
                                           <input name="chkBlankLetter[]" id="chkBlankLetter19" class="filled-in chkBlankLetter" type="checkbox" value="19" >
                                           <label for="chkBlankLetter19"></label>
                                       </div>
                                       </div>   -->
                                 </td>
                                 <td class="td-input">
                                    <input type="text" name="question[]" class="classQuestion digitCommon" maxlength="3" value="{{ (count($arrQuestionText) > 0 && $arrQuestionText[19]!='') ? $arrQuestionText[19] : '' }}" >
                                    <div class="alphabate-letter-section checkbox-center">
                                       <div class="check-block">
                                          <input name="chkBlankLetter[]" id="chkBlankLetter20" class="filled-in chkBlankLetter" type="checkbox" value="20" @if(count($arrAnswer) > 0 && $arrAnswer[19]=='0') checked  @endif >
                                          <label for="chkBlankLetter20"></label>
                                       </div>
                                    </div>
                                 </td>
                                 <td class="td-input">
                                    <input type="text" name="question[]" class="classQuestion" maxlength="3" readonly="readonly" value="{{ (count($arrQuestionText) > 0 && $arrQuestionText[20]!='') ? $arrQuestionText[20] : '' }}" >
                                    <!-- <div class="alphabate-letter-section checkbox-center">
                                       <div class="check-block">
                                           <input name="chkBlankLetter[]" id="chkBlankLetter21" class="filled-in chkBlankLetter" type="checkbox" value="21" >
                                           <label for="chkBlankLetter21"></label>
                                       </div>
                                       </div>   -->
                                 </td>
                                 <td class="td-input">
                                    <input type="text" name="question[]" class="classQuestion digitCommon" maxlength="3" value="{{ (count($arrQuestionText) > 0 && $arrQuestionText[21]!='') ? $arrQuestionText[21] : '' }}" >
                                    <div class="alphabate-letter-section checkbox-center">
                                       <div class="check-block">
                                          <input name="chkBlankLetter[]" id="chkBlankLetter22" class="filled-in chkBlankLetter" type="checkbox" value="22" @if(count($arrAnswer) > 0 && $arrAnswer[21]=='0') checked  @endif >
                                          <label for="chkBlankLetter22"></label>
                                       </div>
                                    </div>
                                 </td>
                              </tr>
                              <!-- 4 -->
                              <tr>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td class="td-input">
                                    <input type="text" name="question[]" class="classQuestion" maxlength="3" readonly="readonly" value="{{ (count($arrQuestionText) > 0 && $arrQuestionText[22]!='') ? $arrQuestionText[22] : '' }}" >
                                    <!-- <div class="alphabate-letter-section checkbox-center">
                                       <div class="check-block">
                                           <input name="chkBlankLetter[]" id="chkBlankLetter23" class="filled-in chkBlankLetter" type="checkbox" value="23" >
                                           <label for="chkBlankLetter23"></label>
                                       </div>
                                       </div>   -->
                                 </td>
                                 <td></td>
                                 <td class="td-input">
                                    <input type="text" name="question[]" class="classQuestion" maxlength="3" readonly="readonly" value="{{ (count($arrQuestionText) > 0 && $arrQuestionText[23]!='') ? $arrQuestionText[23] : '' }}" >
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
                                    <input type="text" name="question[]" class="classQuestion digitCommon" maxlength="3" value="{{ (count($arrQuestionText) > 0 && $arrQuestionText[24]!='') ? $arrQuestionText[24] : '' }}" >
                                    <div class="alphabate-letter-section checkbox-center">
                                       <div class="check-block">
                                          <input name="chkBlankLetter[]" id="chkBlankLetter25" class="filled-in chkBlankLetter" type="checkbox" value="25" @if(count($arrAnswer) > 0 && $arrAnswer[24]=='0') checked  @endif >
                                          <label for="chkBlankLetter25"></label>
                                       </div>
                                    </div>
                                 </td>
                                 <td class="td-input">
                                    <div class="dropdown bootstrap-select">
                                       <select name="operator" class="selectpicker dwCommon operator" data-style="select-with-transition" title="Select Operator" data-size="7" tabindex="-98">                                  
                                       <option value="+" @if(count($arrQuestionText) > 0 && $arrQuestionText[25]=='+') selected  @endif >+</option>
                                       <option value="-" @if(count($arrQuestionText) > 0 && $arrQuestionText[25]=='-') selected  @endif >-</option>
                                       <option value="X" @if(count($arrQuestionText) > 0 && $arrQuestionText[25]=='X') selected  @endif >X</option>
                                       <option value="/" @if(count($arrQuestionText) > 0 && $arrQuestionText[25]=='/') selected  @endif >&#247;</option>
                                       </select>
                                    </div>
                                    <input type="hidden" name="question[]" class="classQuestion" maxlength="3" value="{{ (count($arrQuestionText) > 0 && $arrQuestionText[25]!='') ? $arrQuestionText[25] : '' }}" >
                                    <!-- <div class="alphabate-letter-section checkbox-center">
                                       <div class="check-block">
                                           <input name="chkBlankLetter[]" id="chkBlankLetter26" class="filled-in chkBlankLetter" type="checkbox" value="26" >
                                           <label for="chkBlankLetter26"></label>
                                       </div>
                                       </div>   -->
                                 </td>
                                 <td class="td-input">
                                    <input type="text" name="question[]" class="classQuestion digitCommon" maxlength="3" value="{{ (count($arrQuestionText) > 0 && $arrQuestionText[26]!='') ? $arrQuestionText[26] : '' }}" >
                                    <div class="alphabate-letter-section checkbox-center">
                                       <div class="check-block">
                                          <input name="chkBlankLetter[]" id="chkBlankLetter27" class="filled-in chkBlankLetter" type="checkbox" value="27" @if(count($arrAnswer) > 0 && $arrAnswer[26]=='0') checked  @endif >
                                          <label for="chkBlankLetter27"></label>
                                       </div>
                                    </div>
                                 </td>
                                 <td class="td-input">
                                    <input type="text" name="question[]" class="classQuestion" maxlength="3" value="=" readonly="readonly" value="{{ (count($arrQuestionText) > 0 && $arrQuestionText[27]!='') ? $arrQuestionText[27] : '' }}" >
                                    <!-- <div class="alphabate-letter-section checkbox-center">
                                       <div class="check-block">
                                           <input name="chkBlankLetter[]" id="chkBlankLetter28" class="filled-in chkBlankLetter" type="checkbox" value="28" >
                                           <label for="chkBlankLetter28"></label>
                                       </div>
                                       </div>   -->
                                 </td>
                                 <td class="td-input">
                                    <input type="text" name="question[]" class="classQuestion digitCommon" maxlength="3" value="{{ (count($arrQuestionText) > 0 && $arrQuestionText[28]!='') ? $arrQuestionText[28] : '' }}">
                                    <div class="alphabate-letter-section checkbox-center">
                                       <div class="check-block">
                                          <input name="chkBlankLetter[]" id="chkBlankLetter29" class="filled-in chkBlankLetter" type="checkbox" value="29" @if(count($arrAnswer) > 0 && $arrAnswer[28]=='0') checked  @endif >
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
                        <div class="row">
                           <div class="col-sm-12">
                              <div class="col-sm-6">
                                 <label class="bmd-label-floating" style="margin-bottom: 0;">Duration </label>                          
                                 <div class="form-group upload-block m-b-10">                        
                                    <?php 
                                       $min = $sec = 0;
                                       if(isset($arrQuestion['duration']) && $arrQuestion['duration']!='')
                                       {
                                          $time = [];
                                          $time = explode(':', $arrQuestion['duration']);
                                          if(count($time)>0) 
                                          {
                                             $min = $time[1]; $sec = $time[2];
                                          }
                                       }
                                       ?>                       
                                    <input type="text" name="duration" id="duration" class="timing"/>
                                    <span class="error" id="err_duration"> @if($errors->has('duration')) {{ $errors->first('duration') }} @endif </span>      
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <button type="button" id="btnShowPreview" class="btn btn-fill btn-rose">Preview</button>
                     <button type="button" id="btnSubmit" class="btn btn-fill btn-rose pull-right">Update</button>
                     <a id="btnCancel" class="btn btn-fill btn-rose pull-right" href="{{ $module_url.'/view/'.base64_encode($programId) }}">Cancel</a>
               </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
</div>

<!-- Template Preview Modal Start  -->
  <div id="popup_template_preview" class="modal fade temp-preview" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="close-temp" onClick="close_popup()" data-dismiss="modal"><img src="{{url('/')}}/images/close.png" alt="close" /></div>
            <div class="modal-body">
                 <span id="resultPreview"></span>
                 <!--<div class="modal-button-section">
                    <button onClick="close_popup()" type="button" class="btn btn-fill btn-rose" data-dismiss="modal">{{trans('home.Ok')}}</button>
                 </div>-->
             </div>
        </div>
    </div>
  </div>
<!-- Template Preview Modal End  -->
<!-- DESIGN -->
<link href="{{ url ('/') }}/css/admin/timingfield.css" type="text/css" rel="stylesheet" media="screen" />
<script src="{{ url ('/') }}/js/admin/timingfield.js"></script>
<script type="text/javascript">
   jQuery(document).ready(function($) {
       $(".timing").timingfield();
       $('input[name="minute"]').val('{{$min}}');
       $('input[name="second"]').val('{{$sec}}');
   });
   
</script>

<script type="text/javascript">
   //$('.dwCommon').selectpicker();
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
   $(document).ready(function() {
       $(".digitCommon").keydown(function (e) {
           // Allow: backspace, delete, tab, escape, enter and .
           if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
                // Allow: Ctrl+A, Command+A
               (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
                // Allow: home, end, left, right, down, up
               (e.keyCode >= 35 && e.keyCode <= 40)) {
                    // let it happen, don't do anything
                    return;
           }
           // Ensure that it is a number and stop the keypress
           if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
               e.preventDefault();
           }
       });
   });
   
   $('#btnSubmit').click(function(){
       var direction = $('#direction').val();
       var questionFlag = 0;
       var chkBlankLetterFlag = 0;
       
       var minute      = $('input[name="minute"]').val();
       var second      = $('input[name="second"]').val();
       var duration    = parseInt(minute)*60 + parseInt(second);
   
       var flag = 0;
       
       $('#err_direction').html('');
       $('#err_duration').html('');
   
       if($.trim(direction)=='')
       {
           $('#err_direction').html('This field is required.');
           flag = 1;
       }
   
       $('.classQuestion').each(function(){
         if($(this).val() == '')
         {
           questionFlag = 1;
         }
       });
   
       if(parseInt(questionFlag) == 1)
       {
         swal('Please enter all question values.');
         flag = 1;
       }
   
       $('.chkBlankLetter').each(function(){
         if($(this).prop("checked") == true)
         {
           chkBlankLetterFlag = 1;
         }
       });
   
       if(parseInt(chkBlankLetterFlag) == 0)
       {
         swal('Please check atleast one checkbox.');
         flag = 1;
       }
   
        if($.trim(duration)=='' || parseInt(duration)==0)
        {
           $('#err_duration').html('This field is required.');
           flag = 1;
        }
        else if(isNaN(duration))
        {
           $('#err_duration').html('Invalid time.');
           flag = 1;
        }
   
        if(flag==1)
        {
         return false;
        }
        else
        {
         $('#duration').val(duration);
         /*return true;*/
         $('#frmUpdate').submit();
        }
   })

      $('#btnShowPreview').click(function(){
       var direction = $('#direction').val();
       var questionFlag = 0;
       var chkBlankLetterFlag = 0;
       
       var minute      = $('input[name="minute"]').val();
       var second      = $('input[name="second"]').val();
       var duration    = parseInt(minute)*60 + parseInt(second);
       var flag = 0;
       
       $('#err_direction').html('');
       $('#err_duration').html('');
   
       if($.trim(direction)=='')
       {
           $('#err_direction').html('This field is required.');
           flag = 1;
       }
   
       $('.classQuestion').each(function(){
         if($(this).val() == '')
         {
           questionFlag = 1;
         }
       });
   
       if(parseInt(questionFlag) == 1)
       {
         swal('Please enter all question values.');
         flag = 1;
       }
   
       $('.chkBlankLetter').each(function(){
         if($(this).prop("checked") == true)
         {
           chkBlankLetterFlag = 1;
         }
       });
   
       if(parseInt(chkBlankLetterFlag) == 0)
       {
         swal('Please check atleast one checkbox.');
         flag = 1;
       }
   
        if($.trim(duration)=='' || parseInt(duration)==0)
        {
           $('#err_duration').html('This field is required.');
           flag = 1;
        }
        else if(isNaN(duration))
        {
           $('#err_duration').html('Invalid time.');
           flag = 1;
        }
   
        if(flag==1)
        {
         return false;
        }
        else
        {
         
         $('#duration').val(duration);
         /*return true;*/
            var programId = '{{base64_encode($programId)}}';
            var formData = new FormData($("#frmUpdate")[0]);
            $.ajax({
              type:"POST",
              url:'{{ url('/') }}/template_preview/'+programId,
              data:formData,
              processData: false,
              contentType: false,
              cache: false,
              success: function(response){
                  if(response.status=='success'){
                    $('#resultPreview').html('');
                    $('#resultPreview').html(response.view);
                    $('#popup_template_preview').modal({
                        backdrop: 'static',
                        keyboard: false,
                        show: true
                    });
                  }
                }
            });
        }
   })

   $( "#popup_template_preview" ).on('shown.bs.modal', function(){
       $('html').removeClass('perfect-scrollbar-on');
       $('.modal-backdrop').addClass('dark-bg');
       if($(".game-img-section").height() != 'undefined')
       { $(".game-fill-text-section").css('height', $(".game-img-section").height());}
   });

   function close_popup(){
     $('html').addClass('perfect-scrollbar-on');
       $('.modal-backdrop').removeClass('dark-bg');     
   }
</script>

<!-- for template all end here -->
@endsection
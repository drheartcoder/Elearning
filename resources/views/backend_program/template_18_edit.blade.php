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
                        <div class="row question-1-section">
                           <div class="col-sm-4">
                              <label class="col-form-label">Question 1 File <span class="red">*</span></label>
                              <div style="position: relative;" class="form-group">
                                 <div class="profile-img-block temp-img-block">
                                    <div class="pro-img">
                                       <?php
                                          $imageUrl1 = $default_public_img_path.'default.png';
                                          if(isset($arrQuestion['question_1_file']) && $arrQuestion['question_1_file']!='')
                                          {
                                            if(file_exists($question_image_base_path.$arrQuestion['question_1_file']))
                                            {
                                              $imageUrl1 = $question_image_public_path.$arrQuestion['question_1_file'];
                                            }
                                          }
                                          ?>
                                       <img src="{{ $imageUrl1 }}" id="imgFilePreview1" class="img-responsive img-preview imgFilePreview" alt=""/>
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
                                       <input type="text" name="question1" id="question1" class="form-control classWord" value="{{ (isset($arrQuestion['question_1_text']) && $arrQuestion['question_1_text']!='') ? $arrQuestion['question_1_text'] : '' }}" maxlength="45" >
                                       <span class="error" id="err_question1"> @if($errors->has('question1')) {{ $errors->first('question1') }} @endif </span>
                                    </div>
                                 </div>
                                 <div class="col-sm-3">
                                    <button type="button" class="btn btn-fill btn-rose ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" id="btnGenerate1">
                                       <span class="ui-button-text">Generate</span>
                                       <div class="ripple-container"></div>
                                    </button>
                                 </div>
                                 <?php
                                    $arrQuestionLetter1 = [];
                                    if(isset($arrQuestion['question_1_text']) && $arrQuestion['question_1_text']!='')
                                    {
                                      $arrQuestionLetter1 = str_split($arrQuestion['question_1_text']);
                                    }
                                    $arrAnswerPosition1 = [];
                                    if(isset($arrQuestion['question_1_answer_position']) && $arrQuestion['question_1_answer_position']!='')
                                    {
                                      $arrAnswerPosition1 = str_split($arrQuestion['question_1_answer_position']);
                                    }
                                    ?>
                                 <div class="col-sm-12" id="wrapperDivBlankLetter1" style="display: @if(count($arrQuestionLetter1) > 0) block @else none @endif;">
                                    <label class="col-form-label">Fill the Letters <span class="red">*</span></label>
                                    <div class="form-group" style="margin-top: 0 !important;">
                                       <div id="divBlankLetter1">
                                          <?php
                                             if(count($arrQuestionLetter1) > 0)
                                             {
                                               foreach ($arrQuestionLetter1 as $arrQuestionLetterKey => $arrQuestionLetterVal)
                                               {
                                                 ?>
                                          <div class="alphabate-letter-section">
                                             <input type="text" name="blankLetter1[]" class="form-control blankLetter" id="blankLetter1_{{ $arrQuestionLetterKey }}" maxlength="1" value="{{ $arrQuestionLetterVal }}" readonly />
                                             <div class="check-block">
                                                <input name="chkBlankLetter1[]" id="chkBlankLetter1_{{ $arrQuestionLetterKey }}" class="filled-in" type="checkbox" value="{{ $arrQuestionLetterKey }}" <?php if($arrAnswerPosition1[$arrQuestionLetterKey] == 0){ echo "checked"; } ?> >
                                                <label for="chkBlankLetter1_{{ $arrQuestionLetterKey }}"></label>
                                             </div>
                                          </div>
                                          <?php
                                             }
                                             }
                                             ?>
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
                                       <?php
                                          $imageUrl2 = $default_public_img_path.'default.png';
                                          if(isset($arrQuestion['question_2_file']) && $arrQuestion['question_2_file']!='')
                                          {
                                            if(file_exists($question_image_base_path.$arrQuestion['question_2_file']))
                                            {
                                              $imageUrl2 = $question_image_public_path.$arrQuestion['question_2_file'];
                                            }
                                          }
                                          ?>
                                       <img src="{{ $imageUrl2 }}" id="imgFilePreview2" class="img-responsive img-preview imgFilePreview" alt=""/>
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
                                       <input type="text" name="question2" id="question2" class="form-control classWord" value="{{ (isset($arrQuestion['question_2_text']) && $arrQuestion['question_2_text']!='') ? $arrQuestion['question_2_text'] : '' }}" maxlength="45" >
                                       <span class="error" id="err_question2"> @if($errors->has('question2')) {{ $errors->first('question2') }} @endif </span>
                                    </div>
                                 </div>
                                 <div class="col-sm-3">
                                    <button type="button" class="btn btn-fill btn-rose ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" id="btnGenerate2">
                                       <span class="ui-button-text">Generate</span>
                                       <div class="ripple-container"></div>
                                    </button>
                                 </div>
                                 <?php
                                    $arrQuestionLetter2 = [];
                                    if(isset($arrQuestion['question_2_text']) && $arrQuestion['question_2_text']!='')
                                    {
                                      $arrQuestionLetter2 = str_split($arrQuestion['question_2_text']);
                                    }
                                    $arrAnswerPosition2 = [];
                                    if(isset($arrQuestion['question_2_answer_position']) && $arrQuestion['question_2_answer_position']!='')
                                    {
                                      $arrAnswerPosition2 = str_split($arrQuestion['question_2_answer_position']);
                                    }
                                    ?>
                                 <div class="col-sm-12" id="wrapperDivBlankLetter2" style="display: @if(count($arrQuestionLetter2) > 0) block @else none @endif;" >
                                    <label class="col-form-label">Fill the Letters <span class="red">*</span></label>
                                    <div class="form-group" style="margin-top: 0 !important;">
                                       <div id="divBlankLetter2">
                                          <?php
                                             if(count($arrQuestionLetter2) > 0)
                                             {
                                               foreach ($arrQuestionLetter2 as $arrQuestionLetterKey => $arrQuestionLetterVal)
                                               {
                                                 ?>
                                          <div class="alphabate-letter-section">
                                             <input type="text" name="blankLetter2[]" class="form-control blankLetter" id="blankLetter2_{{ $arrQuestionLetterKey }}" maxlength="1" value="{{ $arrQuestionLetterVal }}" readonly />
                                             <div class="check-block">
                                                <input name="chkBlankLetter2[]" id="chkBlankLetter2_{{ $arrQuestionLetterKey }}" class="filled-in" type="checkbox" value="{{ $arrQuestionLetterKey }}" <?php if($arrAnswerPosition2[$arrQuestionLetterKey] == 0){ echo "checked"; } ?> >
                                                <label for="chkBlankLetter2_{{ $arrQuestionLetterKey }}"></label>
                                             </div>
                                          </div>
                                          <?php
                                             }
                                             }
                                             ?>
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
                                       <?php
                                          $imageUrl3 = $default_public_img_path.'default.png';
                                          if(isset($arrQuestion['question_3_file']) && $arrQuestion['question_3_file']!='')
                                          {
                                            if(file_exists($question_image_base_path.$arrQuestion['question_3_file']))
                                            {
                                              $imageUrl3 = $question_image_public_path.$arrQuestion['question_3_file'];
                                            }
                                          }
                                          ?>
                                       <img src="{{ $imageUrl3 }}" id="imgFilePreview3" class="img-responsive img-preview imgFilePreview" alt=""/>
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
                                       <input type="text" name="question3" id="question3" class="form-control classWord" value="{{ (isset($arrQuestion['question_3_text']) && $arrQuestion['question_3_text']!='') ? $arrQuestion['question_3_text'] : '' }}" maxlength="45" >
                                       <span class="error" id="err_question3"> @if($errors->has('question3')) {{ $errors->first('question3') }} @endif </span>
                                    </div>
                                 </div>
                                 <div class="col-sm-3">
                                    <button type="button" class="btn btn-fill btn-rose ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" id="btnGenerate3">
                                       <span class="ui-button-text">Generate</span>
                                       <div class="ripple-container"></div>
                                    </button>
                                 </div>
                                 <?php
                                    $arrQuestionLetter3 = [];
                                    if(isset($arrQuestion['question_3_text']) && $arrQuestion['question_3_text']!='')
                                    {
                                      $arrQuestionLetter3 = str_split($arrQuestion['question_3_text']);
                                    }
                                    $arrAnswerPosition3 = [];
                                    if(isset($arrQuestion['question_3_answer_position']) && $arrQuestion['question_3_answer_position']!='')
                                    {
                                      $arrAnswerPosition3 = str_split($arrQuestion['question_3_answer_position']);
                                    }
                                    ?>
                                 <div class="col-sm-12" id="wrapperDivBlankLetter3" style="display: @if(count($arrQuestionLetter3) > 0) block @else none @endif;" >
                                    <label class="col-form-label">Fill the Letters <span class="red">*</span></label>
                                    <div class="form-group" style="margin-top: 0 !important;">
                                       <div id="divBlankLetter3">
                                          <?php
                                             if(count($arrQuestionLetter3) > 0)
                                             {
                                               foreach ($arrQuestionLetter3 as $arrQuestionLetterKey => $arrQuestionLetterVal)
                                               {
                                                 ?>
                                          <div class="alphabate-letter-section">
                                             <input type="text" name="blankLetter3[]" class="form-control blankLetter" id="blankLetter3_{{ $arrQuestionLetterKey }}" maxlength="1" value="{{ $arrQuestionLetterVal }}" readonly />
                                             <div class="check-block">
                                                <input name="chkBlankLetter3[]" id="chkBlankLetter3_{{ $arrQuestionLetterKey }}" class="filled-in" type="checkbox" value="{{ $arrQuestionLetterKey }}" <?php if($arrAnswerPosition3[$arrQuestionLetterKey] == 0){ echo "checked"; } ?> >
                                                <label for="chkBlankLetter3_{{ $arrQuestionLetterKey }}"></label>
                                             </div>
                                          </div>
                                          <?php
                                             }
                                             }
                                             ?>
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
                                       <?php
                                          $imageUrl4 = $default_public_img_path.'default.png';
                                          if(isset($arrQuestion['question_4_file']) && $arrQuestion['question_4_file']!='')
                                          {
                                            if(file_exists($question_image_base_path.$arrQuestion['question_4_file']))
                                            {
                                              $imageUrl4 = $question_image_public_path.$arrQuestion['question_4_file'];
                                            }
                                          }
                                          ?>
                                       <img src="{{ $imageUrl4 }}" id="imgFilePreview4" class="img-responsive img-preview imgFilePreview" alt=""/>
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
                                       <input type="text" name="question4" id="question4" class="form-control classWord" value="{{ (isset($arrQuestion['question_4_text']) && $arrQuestion['question_4_text']!='') ? $arrQuestion['question_4_text'] : '' }}" maxlength="45" >
                                       <span class="error" id="err_question4"> @if($errors->has('question4')) {{ $errors->first('question4') }} @endif </span>
                                    </div>
                                 </div>
                                 <div class="col-sm-3">
                                    <button type="button" class="btn btn-fill btn-rose ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" id="btnGenerate4">
                                       <span class="ui-button-text">Generate</span>
                                       <div class="ripple-container"></div>
                                    </button>
                                 </div>
                                 <?php
                                    $arrQuestionLetter4 = [];
                                    if(isset($arrQuestion['question_4_text']) && $arrQuestion['question_4_text']!='')
                                    {
                                      $arrQuestionLetter4 = str_split($arrQuestion['question_4_text']);
                                    }
                                    $arrAnswerPosition4 = [];
                                    if(isset($arrQuestion['question_4_answer_position']) && $arrQuestion['question_4_answer_position']!='')
                                    {
                                      $arrAnswerPosition4 = str_split($arrQuestion['question_4_answer_position']);
                                    }
                                    ?>
                                 <div class="col-sm-12" id="wrapperDivBlankLetter4" style="display: @if(count($arrQuestionLetter4) > 0) block @else none @endif;" >
                                    <label class="col-form-label">Fill the Letters <span class="red">*</span></label>
                                    <div class="form-group" style="margin-top: 0 !important;">
                                       <div id="divBlankLetter4">
                                          <?php
                                             if(count($arrQuestionLetter4) > 0)
                                             {
                                               foreach ($arrQuestionLetter4 as $arrQuestionLetterKey => $arrQuestionLetterVal)
                                               {
                                                 ?>
                                          <div class="alphabate-letter-section">
                                             <input type="text" name="blankLetter4[]" class="form-control blankLetter" id="blankLetter4_{{ $arrQuestionLetterKey }}" maxlength="1" value="{{ $arrQuestionLetterVal }}" readonly />
                                             <div class="check-block">
                                                <input name="chkBlankLetter4[]" id="chkBlankLetter4_{{ $arrQuestionLetterKey }}" class="filled-in" type="checkbox" value="{{ $arrQuestionLetterKey }}" <?php if($arrAnswerPosition4[$arrQuestionLetterKey] == 0){ echo "checked"; } ?> >
                                                <label for="chkBlankLetter4_{{ $arrQuestionLetterKey }}"></label>
                                             </div>
                                          </div>
                                          <?php
                                             }
                                             }
                                             ?>
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
                                       <?php
                                          $imageUrl5 = $default_public_img_path.'default.png';
                                          if(isset($arrQuestion['question_5_file']) && $arrQuestion['question_5_file']!='')
                                          {
                                            if(file_exists($question_image_base_path.$arrQuestion['question_5_file']))
                                            {
                                              $imageUrl5 = $question_image_public_path.$arrQuestion['question_5_file'];
                                            }
                                          }
                                          ?>
                                       <img src="{{ $imageUrl5 }}" id="imgFilePreview5" class="img-responsive img-preview imgFilePreview" alt=""/>
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
                                       <input type="text" name="question5" id="question5" class="form-control classWord" value="{{ (isset($arrQuestion['question_5_text']) && $arrQuestion['question_5_text']!='') ? $arrQuestion['question_5_text'] : '' }}" maxlength="45" >
                                       <span class="error" id="err_question5"> @if($errors->has('question5')) {{ $errors->first('question5') }} @endif </span>
                                    </div>
                                 </div>
                                 <div class="col-sm-3">
                                    <button type="button" class="btn btn-fill btn-rose ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" id="btnGenerate5">
                                       <span class="ui-button-text">Generate</span>
                                       <div class="ripple-container"></div>
                                    </button>
                                 </div>
                                 <?php
                                    $arrQuestionLetter5 = [];
                                    if(isset($arrQuestion['question_5_text']) && $arrQuestion['question_5_text']!='')
                                    {
                                      $arrQuestionLetter5 = str_split($arrQuestion['question_5_text']);
                                    }
                                    $arrAnswerPosition5 = [];
                                    if(isset($arrQuestion['question_5_answer_position']) && $arrQuestion['question_5_answer_position']!='')
                                    {
                                      $arrAnswerPosition5 = str_split($arrQuestion['question_5_answer_position']);
                                    }
                                    ?>
                                 <div class="col-sm-12" id="wrapperDivBlankLetter5" style="display: @if(count($arrQuestionLetter5) > 0) block @else none @endif;" >
                                    <label class="col-form-label">Fill the Letters <span class="red">*</span></label>
                                    <div class="form-group" style="margin-top: 0 !important;">
                                       <div id="divBlankLetter5">
                                          <?php
                                             if(count($arrQuestionLetter5) > 0)
                                             {
                                               foreach ($arrQuestionLetter5 as $arrQuestionLetterKey => $arrQuestionLetterVal)
                                               {
                                                 ?>
                                          <div class="alphabate-letter-section">
                                             <input type="text" name="blankLetter5[]" class="form-control blankLetter" id="blankLetter5_{{ $arrQuestionLetterKey }}" maxlength="1" value="{{ $arrQuestionLetterVal }}" readonly />
                                             <div class="check-block">
                                                <input name="chkBlankLetter5[]" id="chkBlankLetter5_{{ $arrQuestionLetterKey }}" class="filled-in" type="checkbox" value="{{ $arrQuestionLetterKey }}" <?php if($arrAnswerPosition5[$arrQuestionLetterKey] == 0){ echo "checked"; } ?> >
                                                <label for="chkBlankLetter5_{{ $arrQuestionLetterKey }}"></label>
                                             </div>
                                          </div>
                                          <?php
                                             }
                                             }
                                             ?>
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
                                       <?php
                                          $imageUrl6 = $default_public_img_path.'default.png';
                                          if(isset($arrQuestion['question_6_file']) && $arrQuestion['question_6_file']!='')
                                          {
                                            if(file_exists($question_image_base_path.$arrQuestion['question_6_file']))
                                            {
                                              $imageUrl6 = $question_image_public_path.$arrQuestion['question_6_file'];
                                            }
                                          }
                                          ?>
                                       <img src="{{ $imageUrl6 }}" id="imgFilePreview6" class="img-responsive img-preview imgFilePreview" alt=""/>
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
                                       <input type="text" name="question6" id="question6" class="form-control classWord" value="{{ (isset($arrQuestion['question_6_text']) && $arrQuestion['question_6_text']!='') ? $arrQuestion['question_6_text'] : '' }}" maxlength="45" >
                                       <span class="error" id="err_question6"> @if($errors->has('question6')) {{ $errors->first('question6') }} @endif </span>
                                    </div>
                                 </div>
                                 <div class="col-sm-3">
                                    <button type="button" class="btn btn-fill btn-rose ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" id="btnGenerate6">
                                       <span class="ui-button-text">Generate</span>
                                       <div class="ripple-container"></div>
                                    </button>
                                 </div>
                                 <?php
                                    $arrQuestionLetter6 = [];
                                    if(isset($arrQuestion['question_6_text']) && $arrQuestion['question_6_text']!='')
                                    {
                                      $arrQuestionLetter6 = str_split($arrQuestion['question_6_text']);
                                    }
                                    $arrAnswerPosition6 = [];
                                    if(isset($arrQuestion['question_6_answer_position']) && $arrQuestion['question_6_answer_position']!='')
                                    {
                                      $arrAnswerPosition6 = str_split($arrQuestion['question_6_answer_position']);
                                    }
                                    ?>
                                 <div class="col-sm-12" id="wrapperDivBlankLetter6" style="display: @if(count($arrQuestionLetter6) > 0) block @else none @endif;" >
                                    <label class="col-form-label">Fill the Letters <span class="red">*</span></label>
                                    <div class="form-group" style="margin-top: 0 !important;">
                                       <div id="divBlankLetter6">
                                          <?php
                                             if(count($arrQuestionLetter6) > 0)
                                             {
                                               foreach ($arrQuestionLetter6 as $arrQuestionLetterKey => $arrQuestionLetterVal)
                                               {
                                                 ?>
                                          <div class="alphabate-letter-section">
                                             <input type="text" name="blankLetter6[]" class="form-control blankLetter" id="blankLetter6_{{ $arrQuestionLetterKey }}" maxlength="1" value="{{ $arrQuestionLetterVal }}" readonly />
                                             <div class="check-block">
                                                <input name="chkBlankLetter6[]" id="chkBlankLetter6_{{ $arrQuestionLetterKey }}" class="filled-in" type="checkbox" value="{{ $arrQuestionLetterKey }}" <?php if($arrAnswerPosition6[$arrQuestionLetterKey] == 0){ echo "checked"; } ?> >
                                                <label for="chkBlankLetter5_{{ $arrQuestionLetterKey }}"></label>
                                             </div>
                                          </div>
                                          <?php
                                             }
                                             }
                                             ?>
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
                           <div class="col-sm-12">
                              <div class="row">
                                 <div class="col-sm-6">
                                    <?php
                                       $hornUrl = '';
                                       if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                                       {
                                         if(file_exists($question_audio_base_path.$arrQuestion['horn']))
                                         {
                                           $hornUrl = $question_audio_public_path.$arrQuestion['horn'];
                                         }
                                       }
                                       if($hornUrl!='')
                                       {
                                         ?>
                                    <audio controls="controls" src="{{ $hornUrl }}"></audio>
                                    <?php
                                       }
                                       ?>
                                 </div>
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
                                       <input type="text" name="duration" id="duration" class="timing" />
                                       <span class="error" id="err_duration"> @if($errors->has('duration')) {{ $errors->first('duration') }} @endif </span>      
                                    </div>
                                 </div>
                                 <div class="col-sm-6">
                                    <label class="bmd-label-floating col-form-label">Audio (HORN) </label>                                
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


<script type="text/javascript">
      $('.imgFile').change(function(){
       var tempThis = $(this);
       var files = $(this.files);
       imageSizeValidate(tempThis, files, '185', '121');
      });
    function imageSizeValidate (tempThis,files,width,height) 
    {
      var image_height = height || 0;
      var image_width = width || 0;
var max_file_size = 400;
      var file_size     = 0;
      if (typeof files !== "undefined") 
      {
        for (var i=0, l=files.length; i<l; i++) 
        {
              var blnValid = false;
              var ext = files[0]['name'].substring(files[0]['name'].lastIndexOf('.') + 1);
              var file_size =  Math.round((files[0].size/ 1024) * 100) / 100;
              if(ext == "JPEG" || ext == "jpeg" || ext == "jpg" || ext == "JPG" || ext == "png" || ext == "PNG")
              {
                          blnValid = true;
              }
              
              if(blnValid ==false) 
              {
                  showAlert("Sorry, " + files[0]['name'] + " is invalid, allowed extensions are: jpeg , jpg , png","error");
                  $(".fileupload-preview").html("");
                  $(".fileupload").attr('class',"fileupload fileupload-new");
                  $("#image").val('');
                  return false;
              }
              else
              {              
                    var reader = new FileReader();
if(file_size>max_file_size)

                  {
                      swal("Sorry, max "+max_file_size+" Kb size is allowed");
                      
                      $(".imgFile").val('');
                      return false;
                  }
                    reader.readAsDataURL(files[0]);
                    reader.onload = function (e) 
                    {
                      var image = new Image();
                      image.src = e.target.result;
                         
                      image.onload = function () 
                      {
                          var height = this.height;
                          var width = this.width;
                          console.log("current height:"+height+"  validate height:"+image_height );

                          console.log("current width:"+width+" validate width:"+image_width);

                          if (height < image_height || width < image_width ) 
                          {
                              swal("File must be grater than / equal to "+image_width+" X "+image_height);
                              $(".imgFile").val('');
                              return false;
                          }
                          else
                          {
                            var id = tempThis.closest('.profile-img-block').find('.imgFilePreview').attr('id');
                             $('#'+id).attr('src', e.target.result);
                             //swal("Uploaded image has valid Height and Width.");
                             return true;
                          }
                      };
                    }
              }                
          }
      }
      else
      {
        swal("No support for the File API in this web browser" ,"error");
      } 
    }
   $(document).on('keydown', '.classWord', function(e){
     var keyVal = (e.which) ? e.which : e.keyVal;
     if(parseInt(keyVal) != 32)
     {
        return;
     }
     else
     {
        e.preventDefault();
     }
   });
   
   $(document).on('blur', '#question1', function(){
       $('#btnGenerate1').trigger('click');
   });
   $(document).on('click', '#btnGenerate1', function(){
       var question1 = $('#question1').val();
       if(question1!='' && question1.length > 0)
       {
           var strDivBlankLetter1 = '';
           for(var i = 0; i < question1.length; i++)
           {
               if(question1[i]!='')
               {
                   strDivBlankLetter1+='<div class="alphabate-letter-section"><input type="text" name="blankLetter1[]" class="form-control blankLetter" id="blankLetter1_'+i+'" maxlength="1" value="'+question1[i]+'" readonly /><div class="check-block"><input name="chkBlankLetter1[]" id="chkBlankLetter1_'+i+'" class="filled-in" type="checkbox" value="'+i+'"><label for="chkBlankLetter1_'+i+'"></label></div></div>';
               }
           }
           if(strDivBlankLetter1!='')
           {
               $('#wrapperDivBlankLetter1').show();
               $('#divBlankLetter1').html(strDivBlankLetter1);
   
           }
       }
       else
       {
           $('#divBlankLetter1').html('');
           $('#err_question1').html('This field is required.');
           $('#wrapperDivBlankLetter1').hide();
           return false;
       }
   });
   $(document).on('blur', '#question2', function(){
       $('#btnGenerate2').trigger('click');
   });
   $(document).on('click', '#btnGenerate2', function(){
       var question2 = $('#question2').val();
       if(question2!='' && question2.length > 0)
       {
           var strDivBlankLetter2 = '';
           for(var i = 0; i < question2.length; i++)
           {
               if(question2[i]!='')
               {
                   strDivBlankLetter2+='<div class="alphabate-letter-section"><input type="text" name="blankLetter2[]" class="form-control blankLetter" id="blankLetter2_'+i+'" maxlength="1" value="'+question2[i]+'" readonly /><div class="check-block"><input name="chkBlankLetter2[]" id="chkBlankLetter2_'+i+'" class="filled-in" type="checkbox" value="'+i+'"><label for="chkBlankLetter2_'+i+'"></label></div></div>';
               }
           }
           if(strDivBlankLetter2!='')
           {
               $('#wrapperDivBlankLetter2').show();
               $('#divBlankLetter2').html(strDivBlankLetter2);
   
           }
       }
       else
       {
           $('#divBlankLetter2').html('');
           $('#err_question2').html('This field is required.');
           $('#wrapperDivBlankLetter2').hide();
           return false;
       }
   });
   $(document).on('blur', '#question3', function(){
       $('#btnGenerate3').trigger('click');
   });
   $(document).on('click', '#btnGenerate3', function(){
       var question3 = $('#question3').val();
       if(question3!='' && question3.length > 0)
       {
           var strDivBlankLetter3 = '';
           for(var i = 0; i < question3.length; i++)
           {
               if(question3[i]!='')
               {
                   strDivBlankLetter3+='<div class="alphabate-letter-section"><input type="text" name="blankLetter3[]" class="form-control blankLetter" id="blankLetter3_'+i+'" maxlength="1" value="'+question3[i]+'" readonly /><div class="check-block"><input name="chkBlankLetter3[]" id="chkBlankLetter3_'+i+'" class="filled-in" type="checkbox" value="'+i+'"><label for="chkBlankLetter3_'+i+'"></label></div></div>';
               }
           }
           if(strDivBlankLetter3!='')
           {
               $('#wrapperDivBlankLetter3').show();
               $('#divBlankLetter3').html(strDivBlankLetter3);
   
           }
       }
       else
       {
           $('#divBlankLetter3').html('');
           $('#err_question3').html('This field is required.');
           $('#wrapperDivBlankLetter3').hide();
           return false;
       }
   });
   $(document).on('blur', '#question4', function(){
       $('#btnGenerate4').trigger('click');
   });
   $(document).on('click', '#btnGenerate4', function(){
       var question4 = $('#question4').val();
       if(question4!='' && question4.length > 0)
       {
           var strDivBlankLetter4 = '';
           for(var i = 0; i < question4.length; i++)
           {
               if(question4[i]!='')
               {
                   strDivBlankLetter4+='<div class="alphabate-letter-section"><input type="text" name="blankLetter4[]" class="form-control blankLetter" id="blankLetter4_'+i+'" maxlength="1" value="'+question4[i]+'" readonly /><div class="check-block"><input name="chkBlankLetter4[]" id="chkBlankLetter4_'+i+'" class="filled-in" type="checkbox" value="'+i+'"><label for="chkBlankLetter4_'+i+'"></label></div></div>';
               }
           }
           if(strDivBlankLetter4!='')
           {
               $('#wrapperDivBlankLetter4').show();
               $('#divBlankLetter4').html(strDivBlankLetter4);
           }
       }
       else
       {
           $('#divBlankLetter4').html('');
           $('#err_question4').html('This field is required.');
           $('#wrapperDivBlankLetter4').hide();
           return false;
       }
   });
   $(document).on('blur', '#question5', function(){
       $('#btnGenerate5').trigger('click');
   });
   $(document).on('click', '#btnGenerate5', function(){
       var question5 = $('#question5').val();
       if(question5!='' && question5.length > 0)
       {
           var strDivBlankLetter5 = '';
           for(var i = 0; i < question5.length; i++)
           {
               if(question5[i]!='')
               {
                   strDivBlankLetter5+='<div class="alphabate-letter-section"><input type="text" name="blankLetter5[]" class="form-control blankLetter" id="blankLetter5_'+i+'" maxlength="1" value="'+question5[i]+'" readonly /><div class="check-block"><input name="chkBlankLetter5[]" id="chkBlankLetter5_'+i+'" class="filled-in" type="checkbox" value="'+i+'"><label for="chkBlankLetter5_'+i+'"></label></div></div>';
               }
           }
           if(strDivBlankLetter5!='')
           {
               $('#wrapperDivBlankLetter5').show();
               $('#divBlankLetter5').html(strDivBlankLetter5);
           }
       }
       else
       {
           $('#divBlankLetter5').html('');
           $('#err_question5').html('This field is required.');
           $('#wrapperDivBlankLetter5').hide();
           return false;
       }
   });
   $(document).on('blur', '#question6', function(){
       $('#btnGenerate6').trigger('click');
   });
   $(document).on('click', '#btnGenerate6', function(){
       var question6 = $('#question6').val();
       if(question6!='' && question6.length > 0)
       {
           var strDivBlankLetter6 = '';
           for(var i = 0; i < question6.length; i++)
           {
               if(question6[i]!='')
               {
                   strDivBlankLetter6+='<div class="alphabate-letter-section"><input type="text" name="blankLetter6[]" class="form-control blankLetter" id="blankLetter6_'+i+'" maxlength="1" value="'+question6[i]+'" readonly /><div class="check-block"><input name="chkBlankLetter6[]" id="chkBlankLetter6_'+i+'" class="filled-in" type="checkbox" value="'+i+'"><label for="chkBlankLetter6_'+i+'"></label></div></div>';
               }
           }
           if(strDivBlankLetter6!='')
           {
               $('#wrapperDivBlankLetter6').show();
               $('#divBlankLetter6').html(strDivBlankLetter6);
           }
       }
       else
       {
           $('#divBlankLetter6').html('');
           $('#err_question6').html('This field is required.');
           $('#wrapperDivBlankLetter6').hide();
           return false;
       }
   });
   
   function validateForm()
   {
        var direction      = $('#direction').val();
        var flQuestion1    = $('#flQuestion1').val();
        var flQuestion1Ext = flQuestion1.substring(flQuestion1.lastIndexOf('.') + 1);
        var question1      = $('#question1').val();
   
        var flQuestion2 = $('#flQuestion2').val();
        var flQuestion2Ext = flQuestion2.substring(flQuestion2.lastIndexOf('.') + 1);
        var question2 = $('#question2').val();
   
        var flQuestion3 = $('#flQuestion3').val();
        var flQuestion3Ext = flQuestion3.substring(flQuestion3.lastIndexOf('.') + 1);
        var question3 = $('#question3').val();
   
        var flQuestion4 = $('#flQuestion4').val();
        var flQuestion4Ext = flQuestion4.substring(flQuestion4.lastIndexOf('.') + 1);
        var question4 = $('#question4').val();
   
        var flQuestion5 = $('#flQuestion5').val();
        var flQuestion5Ext = flQuestion5.substring(flQuestion5.lastIndexOf('.') + 1);
        var question5 = $('#question5').val();
   
        var flQuestion6 = $('#flQuestion6').val();
        var flQuestion6Ext = flQuestion6.substring(flQuestion6.lastIndexOf('.') + 1);
        var question6 = $('#question6').val();
   
        var flHorn   = $('#flHorn').val();
        var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);
   
        var minute      = $('input[name="minute"]').val();
        var second      = $('input[name="second"]').val();
        var duration    = parseInt(minute)*60 + parseInt(second);
   
        var flag = 0;
   
        $('#err_direction').html('');
        
        $('#err_flQuestion1').html('');
        $('#err_question1').html('');
        $('#err_chkBlankLetter1').html('');
   
        $('#err_flQuestion2').html('');
        $('#err_question2').html('');
        $('#err_chkBlankLetter2').html('');
   
        $('#err_flQuestion3').html('');
        $('#err_question3').html('');
        $('#err_chkBlankLetter3').html('');
   
        $('#err_flQuestion4').html('');
        $('#err_question4').html('');
        $('#err_chkBlankLetter4').html('');
   
        $('#err_flQuestion5').html('');
        $('#err_question5').html('');
        $('#err_chkBlankLetter5').html('');
   
        $('#err_flQuestion6').html('');
        $('#err_question6').html('');
        $('#err_chkBlankLetter6').html('');
   
        $('#err_flHorn').html('');
   
        $('#err_duration').html('');
   
        if($.trim(direction)=='')
        {
           $('#err_direction').html('This field is required.');
           flag = 1;  
        }
   
        if(flQuestion1 != '')
        {
           if(!(flQuestion1Ext == "jpg" || flQuestion1Ext == "jpeg" || flQuestion1Ext == "gif" || flQuestion1Ext == "png" || flQuestion1Ext == "GIF" || flQuestion1Ext == "JPG" || flQuestion1Ext == "JPEG" || flQuestion1Ext == "PNG"))
            {
                $('#err_flQuestion1').html('Invalid file type.');
                flag=1;
            }  
            else if($('#flQuestion1').attr('data-error')=='yes')
            {
               $('#err_flQuestion1').html('File must be grater than / equal to 185 X 121.');
               flag=1;  
            }  
        }
        if($.trim(question1)=='')
        {
           $('#err_question1').html('This field is required.');
           flag = 1;
        }
        else
        {
           if($('input[name="chkBlankLetter1[]"]:checked').length == 0)
           {
             $('#err_chkBlankLetter1').html('Please checked atleast one checkbox');
             flag = 1;
           }
        }
   
        if(flQuestion2 != '')
        {
           if(!(flQuestion2Ext == "jpg" || flQuestion2Ext == "jpeg" || flQuestion2Ext == "gif" || flQuestion2Ext == "png" || flQuestion2Ext == "GIF" || flQuestion2Ext == "JPG" || flQuestion2Ext == "JPEG" || flQuestion2Ext == "PNG"))
           {
                $('#err_flQuestion2').html('Invalid file type.');
                flag=1;
           }    
           else if($('#flQuestion2').attr('data-error')=='yes')
            {
               $('#err_flQuestion2').html('File must be grater than / equal to 185 X 121.');
               flag=1;  
            }  
        }
        if($.trim(question2)=='')
        {
           $('#err_question2').html('This field is required.');
           flag = 1;
        }
        else
        {
           if($('input[name="chkBlankLetter2[]"]:checked').length == 0)
           {
             $('#err_chkBlankLetter2').html('Please checked atleast one checkbox');
             flag = 1;
           }
        }
   
        if(flQuestion3 != '')
        {
           if(!(flQuestion3Ext == "jpg" || flQuestion3Ext == "jpeg" || flQuestion3Ext == "gif" || flQuestion3Ext == "png" || flQuestion3Ext == "GIF" || flQuestion3Ext == "JPG" || flQuestion3Ext == "JPEG" || flQuestion3Ext == "PNG"))
           {
              $('#err_flQuestion3').html('Invalid file type.');
              flag=1;
           }    
           else if($('#flQuestion3').attr('data-error')=='yes')
            {
               $('#err_flQuestion3').html('File must be grater than / equal to 185 X 121.');
               flag=1;  
            }  
        }
        if($.trim(question3)=='')
        {
           $('#err_question3').html('This field is required.');
           flag = 1;
        }
        else
        {
           if($('input[name="chkBlankLetter3[]"]:checked').length == 0)
           {
             $('#err_chkBlankLetter3').html('Please checked atleast one checkbox');
             flag = 1;
           }
        }
   
        if(flQuestion4 != '')
        {
           if(!(flQuestion4Ext == "jpg" || flQuestion4Ext == "jpeg" || flQuestion4Ext == "gif" || flQuestion4Ext == "png" || flQuestion4Ext == "GIF" || flQuestion4Ext == "JPG" || flQuestion4Ext == "JPEG" || flQuestion4Ext == "PNG"))
           {
                $('#err_flQuestion4').html('Invalid file type.');
                flag=1;
           }    
           else if($('#flQuestion4').attr('data-error')=='yes')
            {
               $('#err_flQuestion4').html('File must be grater than / equal to 185 X 121.');
               flag=1;  
            }  
        }
        if($.trim(question4)=='')
        {
           $('#err_question4').html('This field is required.');
           flag = 1;
        }
        else
        {
           if($('input[name="chkBlankLetter4[]"]:checked').length == 0)
           {
             $('#err_chkBlankLetter4').html('Please checked atleast one checkbox');
             flag = 1;
           }
        }
   
        if(flQuestion5 != '')
        {
           if(!(flQuestion5Ext == "jpg" || flQuestion5Ext == "jpeg" || flQuestion5Ext == "gif" || flQuestion5Ext == "png" || flQuestion5Ext == "GIF" || flQuestion5Ext == "JPG" || flQuestion5Ext == "JPEG" || flQuestion5Ext == "PNG"))
           {
                $('#err_flQuestion5').html('Invalid file type.');
                flag=1;
           }    
           else if($('#flQuestion5').attr('data-error')=='yes')
            {
               $('#err_flQuestion5').html('File must be grater than / equal to 185 X 121.');
               flag=1;  
            }  
        }
        if($.trim(question5)=='')
        {
           $('#err_question5').html('This field is required.');
           flag = 1;
        }
        else
        {
           if($('input[name="chkBlankLetter5[]"]:checked').length == 0)
           {
             $('#err_chkBlankLetter5').html('Please checked atleast one checkbox');
             flag = 1;
           }
        }
   
        if(flQuestion6 != '')
        {
           if(!(flQuestion6Ext == "jpg" || flQuestion6Ext == "jpeg" || flQuestion6Ext == "gif" || flQuestion6Ext == "png" || flQuestion6Ext == "GIF" || flQuestion6Ext == "JPG" || flQuestion6Ext == "JPEG" || flQuestion6Ext == "PNG"))
           {
               $('#err_flQuestion6').html('Invalid file type.');
               flag=1;
           }    
           else if($('#flQuestion6').attr('data-error')=='yes')
            {
               $('#err_flQuestion6').html('File must be grater than / equal to 185 X 121.');
               flag=1;  
            }  
        }
        if($.trim(question6)=='')
        {
           $('#err_question6').html('This field is required.');
           flag = 1;
        }
        else
        {
           if($('input[name="chkBlankLetter6[]"]:checked').length == 0)
           {
             $('#err_chkBlankLetter6').html('Please checked atleast one checkbox');
             flag = 1;
           }
        }
   
        if(flHorn != '')
        {
           if(!(flHornExt == "mp3" || flHornExt == "MP3" || flHornExt == "wave" || flHornExt == "m4a"))
           {
                $('#err_flHorn').html('Invalid file type.');
                flag = 1;
           }    
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
         return true;
        }

   }

   $('#btnSubmit').click(function(){
      
        var flag = validateForm();
        if(flag==true)
        {
           $('#frmUpdate').submit();
        }
        else
        {
          return false;
        }
   })

   $('#btnShowPreview').click(function(){
      var flag = validateForm();
      if(flag==true)
      {
            var programId = '{{base64_encode($programId)}}';
            var formData = new FormData($("#frmUpdate")[0]);
            $.ajax({
              type:"POST",
              url:'{{ url('/') }}/edit_template_preview/'+programId,
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
      else
      {
        return false;
      }
   })

   function close_popup(){
     $('html').addClass('perfect-scrollbar-on');
       $('.modal-backdrop').removeClass('dark-bg');     
   }

    $("#popup_template_preview").on('shown.bs.modal', function(){
        $('html').removeClass('perfect-scrollbar-on');
        $('.modal-backdrop').addClass('dark-bg');
        if($(".game-img-section").height() != 'undefined')
        { $(".game-fill-text-section").css('height', $(".game-img-section").height());}
    });

</script>
<!-- DESIGN -->
<script type="text/javascript">
   /*FILE NAME : PREVIEW*/
   $(document).on('change', '.uploadFile', function(){
       var uploadFile = $(this).val();
       if(uploadFile!='')
       {
           $(this).closest('.upload-block').find('.uploadFileName').val(uploadFile);
       }
   });

</script>
<link href="{{ url ('/') }}/css/admin/timingfield.css" type="text/css" rel="stylesheet" media="screen" />
<script src="{{ url ('/') }}/js/admin/timingfield.js"></script>
<script type="text/javascript">
   jQuery(document).ready(function($) {
       $(".timing").timingfield();
       $('input[name="minute"]').val({{$min}});
       $('input[name="second"]').val({{$sec}});
   });
   
</script>
<!-- for template all end here -->
@endsection
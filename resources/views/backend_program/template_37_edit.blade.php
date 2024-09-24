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
                  <h4 class="card-title">{{$sub_module_title or ''}}</h4>
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
                        <div class="row wrapperDiv">
                           <div class="col-sm-3">
                              <label class="col-form-label">Question 1 File (Image) <span class="red">*</span></label>
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
                                    <span class="note-section-block"><b>Note :</b> <span>Allowed only jpg | jpeg | png, <br/> Upload image greater than or equal to 504 X 106 for best result.</span></span>
                                 </div>
                              </div>
                           </div>
                           <div class="col-sm-2">
                             <div class="ques-text">
                              <div class="form-group">
                                 <label class="bmd-label-floating">Digit 1<span class="red">*</span></label>
                                 <input type="text" name="digit1_1" id="digit1_1" class="form-control digit1Common digitCommon" value="<?php if(isset($arrQuestion['digit1_1'])){ echo $arrQuestion['digit1_1']; } ?>" >
                                 <span class="error err_digit1Common" id="err_digit1_1"> @if($errors->has('digit1_1')) {{ $errors->first('digit1_1') }} @endif </span>
                              </div>
							   </div>
                           </div>
                           <div class="col-sm-2">
                             <div class="ques-text">
                              <div class="form-group has-default bmd-form-group is-filled">
                                 <select class="selectpicker dwCommon operatorCommon" data-rule-required="true" data-style="select-with-transition" name="operator1" id="operator1">
                                    <option value="">Select Sign</option>
                                    <option value="+" <?php if(isset($arrQuestion['operator1']) && $arrQuestion['operator1']=='+'){ echo 'selected'; } ?> >+</option>
                                    <option value="-" <?php if(isset($arrQuestion['operator1']) && $arrQuestion['operator1']=='-'){ echo 'selected'; } ?> >-</option>
                                    <option value="x" <?php if(isset($arrQuestion['operator1']) && $arrQuestion['operator1']=='x'){ echo 'selected'; } ?> >x</option>
                                    <option value="/" <?php if(isset($arrQuestion['operator1']) && $arrQuestion['operator1']=='/'){ echo 'selected'; } ?> >&#247;</option>
                                 </select>
                                 <span class="error err_operatorCommon" id="err_operator1"> @if($errors->has('operator1')) {{ $errors->first('operator1') }} @endif </span>
                              </div>
							   </div>
                           </div>
                           <div class="col-sm-2">
                             <div class="ques-text">
                              <div class="form-group">
                                 <label class="bmd-label-floating">Digit 2<span class="red">*</span></label>
                                 <input type="text" name="digit1_2" id="digit1_2" class="form-control digit2Common digitCommon" value="<?php if(isset($arrQuestion['digit1_2'])){ echo $arrQuestion['digit1_2']; } ?>" >
                                 <span class="error err_digit2Common" id="err_digit1_2"> @if($errors->has('digit1_2')) {{ $errors->first('digit1_2') }} @endif </span>
                              </div>
							   </div>
                           </div>
                           <div class="col-sm-2">
                             <div class="ques-text">
                              <div class="form-group">
                                 <!--                                      <label class="bmd-label-floating">Answer<span class="red">*</span></label>-->
                                 <input type="text" name="answer1" placeholder="Answer" style="padding: 8px 10px;" id="answer1" class="form-control answerCommon digitCommon" readonly="readonly" value="<?php if(isset($arrQuestion['answer1'])){ echo $arrQuestion['answer1']; } ?>" >
                                 <span class="error" id="err_answer1"> @if($errors->has('answer1')) {{ $errors->first('answer1') }} @endif </span>
                              </div>
							   </div>
                           </div>
                        </div>
                        <div class="row wrapperDiv">
                           <div class="col-sm-3">
                              <label class="col-form-label">Question 2 File (Image) </label>
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
                                    <span class="note-section-block"><b>Note :</b> <span>Allowed only jpg | jpeg | png, <br/> Upload image greater than or equal to 504 X 106 for best result.</span></span>
                                 </div>
                              </div>
                           </div>
                           <div class="col-sm-2">
                             <div class="ques-text">
                              <div class="form-group">
                                 <label class="bmd-label-floating">Digit 1 </label>
                                 <input type="text" name="digit2_1" id="digit2_1" class="form-control digit1Common digitCommon" value="<?php if(isset($arrQuestion['digit2_1']) && $arrQuestion['digit2_1']!=null){ echo $arrQuestion['digit2_1']; } ?>" >
                                 <span class="error err_digit1Common" id="err_digit2_1"> @if($errors->has('digit2_1')) {{ $errors->first('digit2_1') }} @endif </span>
                              </div>
							   </div>
                           </div>
                           <div class="col-sm-2">
                             <div class="ques-text">
                              <div class="form-group has-default bmd-form-group is-filled">
                                 <select class="selectpicker dwCommon operatorCommon" data-rule-required="true" data-style="select-with-transition" name="operator2" id="operator2">
                                    <option value="">Select Sign</option>
                                    <option value="+" <?php if(isset($arrQuestion['operator2']) && $arrQuestion['operator1']=='+'){ echo 'selected'; } ?> >+</option>
                                    <option value="-" <?php if(isset($arrQuestion['operator2']) && $arrQuestion['operator1']=='-'){ echo 'selected'; } ?> >-</option>
                                    <option value="x" <?php if(isset($arrQuestion['operator2']) && $arrQuestion['operator1']=='x'){ echo 'selected'; } ?> >x</option>
                                    <option value="/" <?php if(isset($arrQuestion['operator2']) && $arrQuestion['operator1']=='/'){ echo 'selected'; } ?> >&#247;</option>
                                 </select>
                                 <span class="error err_operatorCommon" id="err_operator2"> @if($errors->has('operator2')) {{ $errors->first('operator2') }} @endif </span>
                              </div>
							   </div>
                           </div>
                           <div class="col-sm-2">
                             <div class="ques-text">
                              <div class="form-group">
                                 <label class="bmd-label-floating">Digit 2 </label>
                                 <input type="text" name="digit2_2" id="digit2_2" class="form-control digit2Common digitCommon" value="<?php if(isset($arrQuestion['digit2_2']) && $arrQuestion['digit2_2']!=null){ echo $arrQuestion['digit2_2']; } ?>" >
                                 <span class="error err_digit2Common" id="err_digit2_2"> @if($errors->has('digit2_2')) {{ $errors->first('digit2_2') }} @endif </span>
                              </div>
							   </div>
                           </div>
                           <div class="col-sm-2">
                             <div class="ques-text">
                              <div class="form-group">
                                 <!--                                      <label class="bmd-label-floating">Answer<span class="red">*</span></label>-->
                                 <input type="text" name="answer2" placeholder="Answer" style="padding: 8px 10px;" id="answer2" class="form-control answerCommon digitCommon" readonly="readonly" value="<?php if(isset($arrQuestion['answer2']) && $arrQuestion['answer2']!=null){ echo $arrQuestion['answer2']; } ?>" >
                                 <span class="error" id="err_answer2"> @if($errors->has('answer2')) {{ $errors->first('answer2') }} @endif </span>
                              </div>
							   </div>
                           </div>
                           <div class="col-sm-1 delete-button-section">
                              <?php
                                 $urlDelete2 = 'javascript:void(0);';
                                 if($arrQuestion['digit2_1']!=null && $arrQuestion['operator2']!=null && $arrQuestion['digit2_2']!=null && $arrQuestion['answer2']!=null)
                                 {
                                   $urlDelete2 = url(config('app.project.creator_panel_slug')."/program/deleteQuestionOption/".base64_encode($programId).'/'.base64_encode($templateId).'/'.base64_encode($questionId).'/2');
                                   ?>
                              <a href="{{ $urlDelete2 }}" title="Delete" onclick="return confirm_action(this,event,'Do you really want to Delete an option ?')" ><i class="fa fa-trash-o"></i></a>
                              <?php
                                 }
                                 else
                                 {
                                   ?>
                              <a href="{{ $urlDelete2 }}" title="Delete" ><i class="fa fa-trash-o"></i></a>
                              <?php
                                 }
                                 ?>
                           </div>
                        </div>
                        <div class="row wrapperDiv">
                           <div class="col-sm-3">
                              <label class="col-form-label">Question 3 File (Image) </label>
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
                                    <span class="note-section-block"><b>Note :</b> <span>Allowed only jpg | jpeg | png, <br/> Upload image greater than or equal to 504 X 106 for best result.</span></span>
                                 </div>
                              </div>
                           </div>
                           <div class="col-sm-2">
                             <div class="ques-text">
                              <div class="form-group">
                                 <label class="bmd-label-floating">Digit 1 </label>
                                 <input type="text" name="digit3_1" id="digit3_1" class="form-control digit1Common digitCommon" value="<?php if(isset($arrQuestion['digit3_1']) && $arrQuestion['digit3_1']!=null){ echo $arrQuestion['digit3_1']; } ?>" >
                                 <span class="error err_digit1Common" id="err_digit3_1"> @if($errors->has('digit3_1')) {{ $errors->first('digit3_1') }} @endif </span>
                              </div>
							           </div>
                           </div>
                           <div class="col-sm-2">
                             <div class="ques-text">
                              <div class="form-group has-default bmd-form-group is-filled">
                                 <select class="selectpicker dwCommon operatorCommon" data-rule-required="true" data-style="select-with-transition" name="operator3" id="operator3">
                                    <option value="">Select Sign</option>
                                    <option value="+" <?php if(isset($arrQuestion['operator3']) && $arrQuestion['operator1']=='+'){ echo 'selected'; } ?> >+</option>
                                    <option value="-" <?php if(isset($arrQuestion['operator3']) && $arrQuestion['operator1']=='-'){ echo 'selected'; } ?> >-</option>
                                    <option value="x" <?php if(isset($arrQuestion['operator3']) && $arrQuestion['operator1']=='x'){ echo 'selected'; } ?> >x</option>
                                    <option value="/" <?php if(isset($arrQuestion['operator3']) && $arrQuestion['operator1']=='/'){ echo 'selected'; } ?> >&#247;</option>
                                 </select>
                                 <span class="error err_operatorCommon" id="err_operator3"> @if($errors->has('operator3')) {{ $errors->first('operator3') }} @endif </span>
                              </div>
							           </div>
                           </div>
                           <div class="col-sm-2">
                             <div class="ques-text">
                              <div class="form-group">
                                 <label class="bmd-label-floating">Digit 2 </label>
                                 <input type="text" name="digit3_2" id="digit3_2" class="form-control digit2Common digitCommon" value="<?php if(isset($arrQuestion['digit3_2']) && $arrQuestion['digit3_2']!=null){ echo $arrQuestion['digit3_2']; } ?>" >
                                 <span class="error err_digit2Common" id="err_digit3_2"> @if($errors->has('digit3_2')) {{ $errors->first('digit3_2') }} @endif </span>
                              </div>
							              </div>
                           </div>
                           <div class="col-sm-2">
                             <div class="ques-text">
                              <div class="form-group">
                                 <!--                                      <label class="bmd-label-floating">Answer<span class="red">*</span></label>-->
                                 <input type="text" name="answer3" placeholder="Answer" style="padding: 8px 10px;" id="answer3" class="form-control answerCommon digitCommon" readonly="readonly" value="<?php if(isset($arrQuestion['answer3']) && $arrQuestion['answer3']!=null){ echo $arrQuestion['answer3']; } ?>" >
                                 <span class="error" id="err_answer3"> @if($errors->has('answer3')) {{ $errors->first('answer3') }} @endif </span>
                              </div>
							   </div>
                           </div>
                           <div class="col-sm-1 delete-button-section">
                              <?php
                                 $urlDelete3 = 'javascript:void(0);';
                                 if($arrQuestion['digit3_1']!=null && $arrQuestion['operator3']!=null && $arrQuestion['digit3_2']!=null && $arrQuestion['answer3']!=null)
                                 {
                                   $urlDelete3 = url(config('app.project.creator_panel_slug')."/program/deleteQuestionOption/".base64_encode($programId).'/'.base64_encode($templateId).'/'.base64_encode($questionId).'/3');
                                   ?>
                              <a href="{{ $urlDelete3 }}" title="Delete" onclick="return confirm_action(this,event,'Do you really want to Delete an option ?')" ><i class="fa fa-trash-o"></i></a>
                              <?php
                                 }
                                 else
                                 {
                                   ?>
                              <a href="{{ $urlDelete3 }}" title="Delete" ><i class="fa fa-trash-o"></i></a>
                              <?php
                                 }
                                 ?>
                           </div>
                        </div>
                        <div class="row wrapperDiv">
                           <div class="col-sm-3">
                              <label class="col-form-label">Question 4 File (Image) </label>
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
                                    <span class="note-section-block"><b>Note :</b> <span>Allowed only jpg | jpeg | png, <br/> Upload image greater than or equal to 504 X 106 for best result.</span></span>
                                 </div>
                              </div>
                           </div>
                           <div class="col-sm-2">
                             <div class="ques-text">
                              <div class="form-group">
                                 <label class="bmd-label-floating">Digit 1 </label>
                                 <input type="text" name="digit4_1" id="digit4_1" class="form-control digit1Common digitCommon" value="<?php if(isset($arrQuestion['digit4_1']) && $arrQuestion['digit4_1']!=null){ echo $arrQuestion['digit4_1']; } ?>" >
                                 <span class="error err_digit1Common" id="err_digit4_1"> @if($errors->has('digit4_1')) {{ $errors->first('digit4_1') }} @endif </span>
                              </div>
							   </div>
                           </div>
                           <div class="col-sm-2">
                             <div class="ques-text">
                              <div class="form-group has-default bmd-form-group is-filled">
                                 <select class="selectpicker dwCommon operatorCommon" data-rule-required="true" data-style="select-with-transition" name="operator4" id="operator4">
                                    <option value="">Select Sign</option>
                                    <option value="+" <?php if(isset($arrQuestion['operator4']) && $arrQuestion['operator1']=='+'){ echo 'selected'; } ?> >+</option>
                                    <option value="-" <?php if(isset($arrQuestion['operator4']) && $arrQuestion['operator1']=='-'){ echo 'selected'; } ?> >-</option>
                                    <option value="x" <?php if(isset($arrQuestion['operator4']) && $arrQuestion['operator1']=='x'){ echo 'selected'; } ?> >x</option>
                                    <option value="/" <?php if(isset($arrQuestion['operator4']) && $arrQuestion['operator1']=='/'){ echo 'selected'; } ?> >&#247;</option>
                                 </select>
                                 <span class="error err_operatorCommon" id="err_operator4"> @if($errors->has('operator4')) {{ $errors->first('operator4') }} @endif </span>
                              </div>
							   </div>
                           </div>
                           <div class="col-sm-2">
                             <div class="ques-text">
                              <div class="form-group">
                                 <label class="bmd-label-floating">Digit 2 </label>
                                 <input type="text" name="digit4_2" id="digit4_2" class="form-control digit2Common digitCommon" value="<?php if(isset($arrQuestion['digit4_2']) && $arrQuestion['digit4_2']!=null){ echo $arrQuestion['digit4_2']; } ?>" >
                                 <span class="error err_digit2Common" id="err_digit4_2"> @if($errors->has('digit4_2')) {{ $errors->first('digit4_2') }} @endif </span>
                              </div>
							   </div>
                           </div>
                           <div class="col-sm-2">
                             <div class="ques-text">
                              <div class="form-group">
                                 <!--                                      <label class="bmd-label-floating">Answer<span class="red">*</span></label>-->
                                 <input type="text" name="answer4" placeholder="Answer" style="padding: 8px 10px;" id="answer4" class="form-control answerCommon digitCommon" readonly="readonly" value="<?php if(isset($arrQuestion['answer4']) && $arrQuestion['answer4']!=null){ echo $arrQuestion['answer4']; } ?>" >
                                 <span class="error" id="err_answer4"> @if($errors->has('answer4')) {{ $errors->first('answer4') }} @endif </span>
                              </div>
							   </div>
                           </div>
                           <div class="col-sm-1 delete-button-section">
                              <?php
                                 $urlDelete4 = 'javascript:void(0);';
                                 if($arrQuestion['digit4_1']!=null && $arrQuestion['operator4']!=null && $arrQuestion['digit4_2']!=null && $arrQuestion['answer4']!=null)
                                 {
                                   $urlDelete4 = url(config('app.project.creator_panel_slug')."/program/deleteQuestionOption/".base64_encode($programId).'/'.base64_encode($templateId).'/'.base64_encode($questionId).'/4');
                                   ?>
                              <a href="{{ $urlDelete4 }}" title="Delete" onclick="return confirm_action(this,event,'Do you really want to Delete an option ?')" ><i class="fa fa-trash-o"></i></a>
                              <?php
                                 }
                                 else
                                 {
                                   ?>
                              <a href="{{ $urlDelete4 }}" title="Delete" ><i class="fa fa-trash-o"></i></a>
                              <?php
                                 }
                                 ?>
                           </div>
                        </div>
                        <!-- <div class="row">
                           <div class="col-sm-12">      
                             <div class="row">
                                 <div class="col-sm-4">
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
                                 <div class="col-sm-8">
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
                           </div> -->
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
                                    <input type="text" name="duration" id="duration" class="timing" />
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

<script type="text/javascript">
   $('.imgFile').change(function(){
       var tempThis = $(this);
       var files = $(this.files);
       imageSizeValidate(tempThis, files, '504', '106');
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
       $('.dwCommon').selectpicker();
   });
   
   $(document).on('blur', '.digit1Common', function(){
       $(this).closest('.wrapperDiv').find('.operatorCommon').trigger('change');
   });
   $(document).on('blur', '.digit2Common', function(){
       $(this).closest('.wrapperDiv').find('.operatorCommon').trigger('change');
   });
   
   $(document).on('change','.operatorCommon', function(){
       var operatorCommon = $(this).val();
       var tempThis = $(this);
       
       if(operatorCommon!='')
       {
           var digit1Common = $(this).closest('.wrapperDiv').find('.digit1Common').val();
           var digit2Common = $(this).closest('.wrapperDiv').find('.digit2Common').val();
           if((digit1Common!=null && digit1Common!='') && (digit2Common!=null && digit2Common!=''))
           {
               if(operatorCommon == '+')
               {
                   var answerCommon = parseInt(digit1Common) + parseInt(digit2Common);
               }
               else if(operatorCommon == '-')
               {
                   var answerCommon = parseInt(digit1Common) - parseInt(digit2Common);
               }
               else if(operatorCommon == 'x')
               {
                   var answerCommon = parseInt(digit1Common) * parseInt(digit2Common);
               }
               else if(operatorCommon == '/')
               {
                   var answerCommon = parseInt(digit1Common) / parseInt(digit2Common);
               }
               tempThis.closest('.wrapperDiv').find('.err_digit1Common').html('');
               tempThis.closest('.wrapperDiv').find('.err_digit2Common').html('');
               tempThis.closest('.wrapperDiv').find('.answerCommon').val(answerCommon);
           }
           else
           {
               tempThis.closest('.wrapperDiv').find('.err_digit1Common').html('');
               if(digit1Common=='')
               {
                   tempThis.closest('.wrapperDiv').find('.err_digit1Common').html('This field is required');
               }
               tempThis.closest('.wrapperDiv').find('.err_digit2Common').html('');
               if(digit2Common=='')
               {
                   tempThis.closest('.wrapperDiv').find('.err_digit2Common').html('This field is required');
               }    
           }
       }
       else
       {
           var digit1Common = $(this).closest('.wrapperDiv').find('.digit1Common').val();
           var digit2Common = $(this).closest('.wrapperDiv').find('.digit2Common').val();   
           if(digit1Common=='' || digit2Common=='')
           {
             tempThis.closest('.wrapperDiv').find('.answerCommon').val('');
           }
           return false;
       }
   });
   
   function validateForm(){
       var direction = $('#direction').val();
             
       var flQuestion1 = $('#flQuestion1').val();
       var flQuestion1Ext = flQuestion1.substring(flQuestion1.lastIndexOf('.')+1);
       var digit1_1 = $('#digit1_1').val();
       var operator1 = $('#operator1').val();
       var digit1_2 = $('#digit1_2').val();
       var answer1 = $('#answer1').val();
   
       var flQuestion2 = $('#flQuestion2').val();
       var flQuestion2Ext = flQuestion2.substring(flQuestion2.lastIndexOf('.')+1);
       var digit2_1 = $('#digit2_1').val();
       var operator2 = $('#operator2').val();
       var digit2_2 = $('#digit2_2').val();
       var answer2 = $('#answer2').val();
   
       var flQuestion3 = $('#flQuestion3').val();
       var flQuestion3Ext = flQuestion3.substring(flQuestion3.lastIndexOf('.')+1);
       var digit3_1 = $('#digit3_1').val();
       var operator3 = $('#operator3').val();
       var digit3_2 = $('#digit3_2').val();
       var answer3 = $('#answer3').val();
   
       var flQuestion4 = $('#flQuestion4').val();
       var flQuestion4Ext = flQuestion4.substring(flQuestion4.lastIndexOf('.')+1);
       var digit4_1 = $('#digit4_1').val();
       var operator4 = $('#operator4').val();
       var digit4_2 = $('#digit4_2').val();
       var answer4 = $('#answer4').val();
   
       /*var flHorn   = $('#flHorn').val();
       var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);*/
   
       var minute      = $('input[name="minute"]').val();
       var second      = $('input[name="second"]').val();
       var duration    = parseInt(minute)*60 + parseInt(second);
   
       var flag = 0;
   
       $('#err_direction').html('');
   
       $('#err_flQuestion1').html('');
       $('#err_digit1_1').html('');
       $('#err_operator1').html('');
       $('#err_digit1_2').html('');
       $('#err_answer1').html('');
   
       $('#err_flQuestion2').html('');
       $('#err_digit2_1').html('');
       $('#err_operator2').html('');
       $('#err_digit2_2').html('');
       $('#err_answer2').html('');
   
       $('#err_flQuestion3').html('');
       $('#err_digit3_1').html('');
       $('#err_operator3').html('');
       $('#err_digit3_2').html('');
       $('#err_answer3').html('');
   
       $('#err_flQuestion4').html('');
       $('#err_digit4_1').html('');
       $('#err_operator4').html('');
       $('#err_digit4_2').html('');
       $('#err_answer4').html('');
       
       /*$('#err_flHorn').html('');*/
   
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
               $('#err_flQuestion1').html('File must be grater than / equal to 504 X 106.');
               flag=1;  
            }   
        }
        
        if($.trim(digit1_1)=='')
        {
           $('#err_digit1_1').html('This field is required.');
           flag=1;
        }
        else if(isNaN(digit1_1))
        {
           $('#err_digit1_1').html('Invalid field value.');
           flag=1;
        }
        if($.trim(operator1)=='')
        {
           $('#err_operator1').html('This field is required.');
           flag=1;
        }
        if($.trim(digit1_2)=='')
        {
           $('#err_digit1_2').html('This field is required.');
           flag=1;
        }
        else if(isNaN(digit1_2))
        {
           $('#err_digit1_2').html('Invalid field value.');
           flag=1;
        }
        if($.trim(answer1)=='')
        {
           $('#err_answer1').html('This field is required.');
           flag=1;
        }
        else if(isNaN(answer1))
        {
           $('#err_answer1').html('Invalid field value.');
           flag=1;
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
               $('#err_flQuestion2').html('File must be grater than / equal to 504 X 106.');
               flag=1;  
            }
            if($.trim(digit2_1)=='')
            {
               $('#err_digit2_1').html('This field is required.');
               flag=1;
            }
            else if(isNaN(digit2_1))
            {
               $('#err_digit2_1').html('Invalid field value.');
               flag=1;
            }
            if($.trim(operator2)=='')
            {
               $('#err_operator2').html('This field is required.');
               flag=1;
            }
            if($.trim(digit2_2)=='')
            {
               $('#err_digit2_2').html('This field is required.');
               flag=1;
            }
            else if(isNaN(digit2_2))
            {
               $('#err_digit2_2').html('Invalid field value.');
               flag=1;
            }
            if($.trim(answer2)=='')
            {
               $('#err_answer2').html('This field is required.');
               flag=1;
            }
            else if(isNaN(answer2))
            {
               $('#err_answer2').html('Invalid field value.');
               flag=1;
            }
        }
        if($.trim(digit2_1)!='' || $.trim(operator2)!='' || $.trim(digit2_2)!='' || $.trim(answer2)!='')
        {
            if(flQuestion2 != '')
            {
                if(!(flQuestion2Ext == "jpg" || flQuestion2Ext == "jpeg" || flQuestion2Ext == "gif" || flQuestion2Ext == "png" || flQuestion2Ext == "GIF" || flQuestion2Ext == "JPG" || flQuestion2Ext == "JPEG" || flQuestion2Ext == "PNG"))
                {
                    $('#err_flQuestion2').html('Invalid file type.');
                    flag=1;
                }  
                else if($('#flQuestion2').attr('data-error')=='yes')
                {
                   $('#err_flQuestion2').html('File must be grater than / equal to 504 X 106.');
                   flag=1;  
                }  
            }
            if($.trim(digit2_1)=='')
            {
               $('#err_digit2_1').html('This field is required.');
               flag=1;
            }
            else if(isNaN(digit2_1))
            {
               $('#err_digit2_1').html('Invalid field value.');
               flag=1;
            }
            if($.trim(operator2)=='')
            {
               $('#err_operator2').html('This field is required.');
               flag=1;
            }
            if($.trim(digit2_2)=='')
            {
               $('#err_digit2_2').html('This field is required.');
               flag=1;
            }
            else if(isNaN(digit2_2))
            {
               $('#err_digit2_2').html('Invalid field value.');
               flag=1;
            }
            if($.trim(answer2)=='')
            {
               $('#err_answer2').html('This field is required.');
               flag=1;
            }
            else if(isNaN(answer2))
            {
               $('#err_answer2').html('Invalid field value.');
               flag=1;
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
               $('#err_flQuestion3').html('File must be grater than / equal to 504 X 106.');
               flag=1;  
            }
            if($.trim(digit3_1)=='')
            {
               $('#err_digit3_1').html('This field is required.');
               flag=1;
            }
            else if(isNaN(digit3_1))
            {
               $('#err_digit3_1').html('Invalid field value.');
               flag=1;
            }
            if($.trim(operator3)=='')
            {
               $('#err_operator3').html('This field is required.');
               flag=1;
            }
            if($.trim(digit3_2)=='')
            {
               $('#err_digit3_2').html('This field is required.');
               flag=1;
            }
            else if(isNaN(digit3_2))
            {
               $('#err_digit3_2').html('Invalid field value.');
               flag=1;
            }
            if($.trim(answer3)=='')
            {
               $('#err_answer3').html('This field is required.');
               flag=1;
            }
            else if(isNaN(answer3))
            {
               $('#err_answer3').html('Invalid field value.');
               flag=1;
            }
        }
        if($.trim(digit3_1)!='' || $.trim(operator3)!='' || $.trim(digit3_2)!='' || $.trim(answer3)!='')
        {
            if(flQuestion3 != '')
            {
                if(!(flQuestion3Ext == "jpg" || flQuestion3Ext == "jpeg" || flQuestion3Ext == "gif" || flQuestion3Ext == "png" || flQuestion3Ext == "GIF" || flQuestion3Ext == "JPG" || flQuestion3Ext == "JPEG" || flQuestion3Ext == "PNG"))
                {
                    $('#err_flQuestion3').html('Invalid file type.');
                    flag=1;
                }  
                else if($('#flQuestion3').attr('data-error')=='yes')
                {
                   $('#err_flQuestion3').html('File must be grater than / equal to 504 X 106.');
                   flag=1;  
                }  
            }
            if($.trim(digit3_1)=='')
            {
               $('#err_digit3_1').html('This field is required.');
               flag=1;
            }
            else if(isNaN(digit3_1))
            {
               $('#err_digit3_1').html('Invalid field value.');
               flag=1;
            }
            if($.trim(operator3)=='')
            {
               $('#err_operator3').html('This field is required.');
               flag=1;
            }
            if($.trim(digit3_2)=='')
            {
               $('#err_digit3_2').html('This field is required.');
               flag=1;
            }
            else if(isNaN(digit3_2))
            {
               $('#err_digit3_2').html('Invalid field value.');
               flag=1;
            }
            if($.trim(answer3)=='')
            {
               $('#err_answer3').html('This field is required.');
               flag=1;
            }
            else if(isNaN(answer3))
            {
               $('#err_answer3').html('Invalid field value.');
               flag=1;
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
               $('#err_flQuestion4').html('File must be grater than / equal to 504 X 106.');
               flag=1;  
            }
            if($.trim(digit4_1)=='')
            {
               $('#err_digit4_1').html('This field is required.');
               flag=1;
            }
            else if(isNaN(digit4_1))
            {
               $('#err_digit4_1').html('Invalid field value.');
               flag=1;
            }
            if($.trim(operator4)=='')
            {
               $('#err_operator4').html('This field is required.');
               flag=1;
            }
            if($.trim(digit4_2)=='')
            {
               $('#err_digit4_2').html('This field is required.');
               flag=1;
            }
            else if(isNaN(digit4_2))
            {
               $('#err_digit4_2').html('Invalid field value.');
               flag=1;
            }
            if($.trim(answer4)=='')
            {
               $('#err_answer4').html('This field is required.');
               flag=1;
            }
            else if(isNaN(answer4))
            {
               $('#err_answer4').html('Invalid field value.');
               flag=1;
            }
        }
        if($.trim(digit4_1)!='' || $.trim(operator4)!='' || $.trim(digit4_2)!='' || $.trim(answer4)!='')
        {
            if(flQuestion4 != '')
            {
                if(!(flQuestion4Ext == "jpg" || flQuestion4Ext == "jpeg" || flQuestion4Ext == "gif" || flQuestion4Ext == "png" || flQuestion4Ext == "GIF" || flQuestion4Ext == "JPG" || flQuestion4Ext == "JPEG" || flQuestion4Ext == "PNG"))
                {
                    $('#err_flQuestion4').html('Invalid file type.');
                    flag=1;
                }
                else if($('#flQuestion4').attr('data-error')=='yes')
                {
                   $('#err_flQuestion4').html('File must be grater than / equal to 504 X 106.');
                   flag=1;  
                }    
            }
            if($.trim(digit4_1)=='')
            {
               $('#err_digit4_1').html('This field is required.');
               flag=1;
            }
            else if(isNaN(digit4_1))
            {
               $('#err_digit4_1').html('Invalid field value.');
               flag=1;
            }
            if($.trim(operator4)=='')
            {
               $('#err_operator4').html('This field is required.');
               flag=1;
            }
            if($.trim(digit4_2)=='')
            {
               $('#err_digit4_2').html('This field is required.');
               flag=1;
            }
            else if(isNaN(digit4_2))
            {
               $('#err_digit4_2').html('Invalid field value.');
               flag=1;
            }
            if($.trim(answer4)=='')
            {
               $('#err_answer4').html('This field is required.');
               flag=1;
            }
            else if(isNaN(answer4))
            {
               $('#err_answer4').html('Invalid field value.');
               flag=1;
            }
        }
   
        /*if(flHorn != '')
        {
            if(!(flHornExt == "mp3" || flHornExt == "MP3" || flHornExt == "wave"))
            {
                $('#err_flHorn').html('Invalid file type.');
                flag = 1;
            }    
        }*/
   
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
         /*return true;*/
         $('#duration').val(duration);
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

  $( "#popup_template_preview" ).on('shown.bs.modal', function(){
      $('html').removeClass('perfect-scrollbar-on');
      $('.modal-backdrop').addClass('dark-bg');
      if($(".game-img-section").height() != 'undefined' && $(".game-fill-text-section").height() != 'undefined'){
			if($(".game-img-section").height() > $(".game-fill-text-section").height()){
				$(".game-fill-text-section").css('height', $(".game-img-section").height());
			}else{
				$(".game-img-section").css('height', $(".game-fill-text-section").height());
			}
		}
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
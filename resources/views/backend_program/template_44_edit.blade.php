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
                              <input type="hidden" readonly="" name="row" id="row" class="form-control" value="1">
                              <input type="hidden" readonly="" name="column" id="column" class="form-control" value="10">
                           <!-- <div class="col-sm-3">
                              <div class="form-group">
                                 <label class="bmd-label-floating">Table From<span class="red">*</span></label>
                                 <input type="text" name="row" id="row" class="form-control" value="{{ (isset($arrQuestion['table_from']) && $arrQuestion['table_from']!='') ? $arrQuestion['table_from'] : '' }}">
                                 <span class="error" id="err_row">@if($errors->has('row')) {{ $errors->first('row') }} @endif</span>
                              </div>
                           </div>
                           <div class="col-sm-3">
                              <div class="form-group">
                                 <label class="bmd-label-floating">Table To<span class="red">*</span></label>
                                 <input type="text" name="column" id="column" class="form-control" value="{{ (isset($arrQuestion['table_to']) && $arrQuestion['table_to']!='') ? $arrQuestion['table_to'] : '' }}">
                                 <span class="error" id="err_column">@if($errors->has('column')) {{ $errors->first('column') }} @endif</span>
                              </div>
                           </div>
                           <div class="col-sm-6">
                              <div class="gen-table">
                                 <input type="button" name="" class="btn btn-fill btn-rose ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover generate" value="Generate">
                              </div>
                           </div> -->
                           <div class="col-sm-12" id="DEV">
                              <div class="table-boxmain">
                                 <div class="header-cal-default rows">
                                 </div>
                                 <div class="header-cal-default-left column">
                                 </div>
                                 <div class="content-cal-default-left result">
                                 </div>
                                 <div class="clearfix"></div>
                              </div>
                           </div>
                           <div class="col-sm-12">&nbsp;</div>
                           <div class="col-sm-12 wrapperDiv1">
                              <div class="row wrapperDiv">
                                 <div class="col-sm-3">
                                    <div class="form-group">
                                       <label class="bmd-label-floating">Digit 1<span class="red">*</span></label>
                                       <input type="text" name="digit1_1" id="digit1_1" class="form-control digit1Common digitCommon" value="<?php if(isset($arrQuestion['digit1_1'])){ echo $arrQuestion['digit1_1']; } ?>" >
                                       <span class="error err_digit1Common" id="err_digit1_1"> @if($errors->has('digit1_1')) {{ $errors->first('digit1_1') }} @endif </span>
                                    </div>
                                 </div>
                                 <div class="col-sm-3">
                                    <div class="form-group has-default bmd-form-group is-filled">
                                       <select class="selectpicker dwCommon operatorCommon" data-rule-required="true" data-style="select-with-transition" name="operator1" id="operator1">
                                          <option value="x" <?php if(isset($arrQuestion['operator1']) && $arrQuestion['operator1']=='x'){ echo 'selected'; } ?> >x</option>
                                          <!-- <option value="+" <?php if(isset($arrQuestion['operator1']) && $arrQuestion['operator1']=='+'){ echo 'selected'; } ?> >+</option>
                                             <option value="-" <?php if(isset($arrQuestion['operator1']) && $arrQuestion['operator1']=='-'){ echo 'selected'; } ?> >-</option>
                                             <option value="/" <?php if(isset($arrQuestion['operator1']) && $arrQuestion['operator1']=='/'){ echo 'selected'; } ?> >&#247;</option> -->
                                       </select>
                                       <span class="error err_operatorCommon" id="err_operator1"> @if($errors->has('operator1')) {{ $errors->first('operator1') }} @endif </span>
                                    </div>
                                 </div>
                                 <div class="col-sm-3">
                                    <div class="form-group">
                                       <label class="bmd-label-floating">Digit 2<span class="red">*</span></label>
                                       <input type="text" name="digit1_2" id="digit1_2" class="form-control digit2Common digitCommon" value="<?php if(isset($arrQuestion['digit1_2'])){ echo $arrQuestion['digit1_2']; } ?>" >
                                       <span class="error err_digit2Common" id="err_digit1_2"> @if($errors->has('digit1_2')) {{ $errors->first('digit1_2') }} @endif </span>
                                    </div>
                                 </div>
                                 <div class="col-sm-3">
                                    <div class="form-group">
                                       <input type="text" name="answer1" placeholder="Answer" style="padding: 8px 10px;" id="answer1" class="form-control answerCommon digitCommon" readonly="readonly" value="<?php if(isset($arrQuestion['answer1'])){ echo $arrQuestion['answer1']; } ?>" >
                                       <span class="error" id="err_answer1"> @if($errors->has('answer1')) {{ $errors->first('answer1') }} @endif </span>
                                    </div>
                                 </div>
                              </div>
                           </div>
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
   $('.dwCommon').selectpicker();
</script>
<script type="text/javascript">
   var row     = 1;
   var column  = 10;
   var i;
   var j;
   var strRow='';
   var strColumn='';
   var strResult = '';
   for(i=1;i<=10;i++){
     strRow+='<div class="cal-default color-bg-col">'+i+'</div>';
     }
     strColumn='<div class="cal-default color-bg-col">X</div>';
     for(j=0;j<=(column-row);j++){
         strColumn+='<div class="cal-default color-bg-col">'+(parseInt(row)+j)+'</div>';
     }
     for(i=1;i<=10;i++){
         for(m=parseInt(row);m<=parseInt(column);m++){
             strResult+='<div class="cal-default">'+m*i+'</div>';
         }
     }
     $('.column').html(strRow);
     $('.rows').html(strColumn);
     $('.result').html(strResult);
     $('.wrapperDiv1').show();

     function validateForm(){
         var row     = 1;
         var column  = 10;
         var direction = $('#direction').val();
         var digit1_1 = $('#digit1_1').val();
         var operator1 = $('#operator1').val();
         var digit1_2 = $('#digit1_2').val();
         var answer1 = $('#answer1').val();
   
         var minute      = $('input[name="minute"]').val();
         var second      = $('input[name="second"]').val();
         var duration    = parseInt(minute)*60 + parseInt(second);
   
         var flag = 0;
           /*var flHorn   = $('#flHorn').val();
           var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);*/
   
         $('#err_row').html('')
         $('#err_column').html('');
         $('#err_direction').html('');
         $('#err_digit1_1').html('');
         $('#err_operator1').html('');
         $('#err_digit1_2').html('');
         $('#err_answer1').html('');
         /*$('#err_flHorn').html('');*/
         $('#err_duration').html('');
         // alert(digit1_1+'/'+row+'/'+column);
          if($.trim(direction)=='')
          {
             $('#err_direction').html('This field is required.');
             flag = 1;  
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
          else if(parseInt(digit1_1) < parseInt(row) || parseInt(digit1_1) > parseInt(column))
          {
             $('#err_digit1_1').html('This field should be between '+row+' and '+column);
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
          else if(digit1_2>10)
          {
             $('#err_digit1_2').html('This field should be less than equal to 10');
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
       
        if(row=='')
         {
             $('#err_row').html('This field is required');
             flag = 1;
         }
         if(column=='')
         {
             $('#err_column').html('This field is required');
             flag = 1;
         }
         if((column-row)>10)
         {
             $('#err_row').html('Can\'t generate more than 10 tables');
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
      if($(".game-img-section").height() != 'undefined')
      { $(".game-fill-text-section").css('height', $(".game-img-section").height());}
  });

     // $('.wrapperDiv1').find('.digitCommon').val('');
  //Generate Table
   var column = 10; var row = 1; var strRow = strColumn = strResult = ''; 
   for(i=1;i<=10;i++){
      strRow+='<div class="cal-default color-bg-col">'+i+'</div>';
      }
      strColumn='<div class="cal-default color-bg-col">X</div>';
      for(j=0;j<=(column-row);j++){
          strColumn+='<div class="cal-default color-bg-col">'+(parseInt(row)+j)+'</div>';
      }
      for(i=1;i<=10;i++){
          for(m=parseInt(row);m<=parseInt(column);m++){
              strResult+='<div class="cal-default">'+m*i+'</div>';
          }
      }
      $('.column').html(strRow);
      $('.rows').html(strColumn);
      $('.result').html(strResult);
      $('.wrapperDiv1').show();
   
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
     $('#btnSubmit1').click(function(){
         var direction = $('#direction').val();
         var digit1_1 = $('#digit1_1').val();
         var operator1 = $('#operator1').val();
         var digit1_2 = $('#digit1_2').val();
         var answer1 = $('#answer1').val();
         /*var flHorn   = $('#flHorn').val();
         var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);*/
         var flag = 0;
   
         $('#err_direction').html('');
         $('#err_flQuestion').html('');
         $('#err_digit1_1').html('');
         $('#err_operator1').html('');
         $('#err_digit1_2').html('');
         $('#err_answer1').html('');
         /*$('#err_flHorn').html('');*/
   
          if($.trim(direction)=='')
          {
             $('#err_direction').html('This field is required.');
             flag = 1;  
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
   
          /*if(flHorn != '')
          {
             if(!(flHornExt == "mp3" || flHornExt == "MP3" || flHornExt == "wave" || flHornExt == "m4a"))
              {
                  $('#err_flHorn').html('Invalid file type.');
                  flag = 1;
              }    
          }*/
   
          if(flag==1)
          {
           return false;
          }
          else
          {
           return true;
          }
     })
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
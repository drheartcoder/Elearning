<div class="devSubWrapper">
<div class="row">
   <div class="col-sm-12">
      <div class="form-group">
         <label class="bmd-label-floating">Direction </label>
         <input type="text" name="direction" id="direction" class="form-control" value="{{ old('direction') }}">
         <span class="error" id="err_direction"> @if($errors->has('direction')) {{ $errors->first('direction') }} @endif </span>
      </div>
   </div>
   <input type="hidden" readonly="" name="row" id="row" class="form-control" value="1">
   <input type="hidden" readonly="" name="column" id="column" class="form-control" value="10">
<!--    <div class="col-sm-3">
      <div class="form-group">
         <label class="bmd-label-floating">Table From<span class="red">*</span></label>
         <span class="error" id="err_row">@if($errors->has('row')) {{ $errors->first('row') }} @endif</span>
      </div>
   </div>
   <div class="col-sm-3">
      <div class="form-group">
         <label class="bmd-label-floating">Table To<span class="red">*</span></label>
         <span class="error" id="err_column">@if($errors->has('column')) {{ $errors->first('column') }} @endif</span>
      </div>
   </div>
   <div class="col-sm-6">
      <div class="gen-table">
         <input type="button" name="" class="btn btn-fill btn-rose ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover generate" value="Generate">
         <span class="note-section-block form-note-section mb20"><b>Note :</b> <span>Enter table range to generate.</span></span>
      </div>
   </div> -->
   <!-- <div class="col-sm-3">
      <span class="note-section-block form-note-section mb20"><b>Note :</b> <span>Allowed file type mp3, m4a, wave (Audio) format.</span></span>
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
   <div class="col-sm-12 wrapperDiv1" style="display: none;">
      <div class="row wrapperDiv">
         <div class="col-sm-3">
            <div class="form-group">
               <label class="bmd-label-floating">Digit 1<span class="red">*</span></label>
               <input type="text" name="digit1_1" id="digit1_1" class="form-control digit1Common digitCommon" value="{{ old('digit1_1') }}">
               <span class="error err_digit1Common" id="err_digit1_1"> @if($errors->has('digit1_1')) {{ $errors->first('digit1_1') }} @endif </span>
            </div>
         </div>
         <div class="col-sm-3">
            <div class="form-group has-default bmd-form-group is-filled">
               <select class="selectpicker dwCommon operatorCommon" data-rule-required="true" data-style="select-with-transition" name="operator1" id="operator1">
                  <option value="x">x</option>
                  <!-- <option value="+">+</option>
                     <option value="-">-</option>
                     <option value="/">&#247;</option> -->
               </select>
               <span class="error err_operatorCommon" id="err_operator1"> @if($errors->has('operator1')) {{ $errors->first('operator1') }} @endif </span>
            </div>
         </div>
         <div class="col-sm-3">
            <div class="form-group">
               <label class="bmd-label-floating">Digit 2<span class="red">*</span></label>
               <input type="text" name="digit1_2" id="digit1_2" class="form-control digit2Common digitCommon" value="{{ old('digit1_2') }}">
               <span class="error err_digit2Common" id="err_digit1_2"> @if($errors->has('digit1_2')) {{ $errors->first('digit1_2') }} @endif </span>
            </div>
         </div>
         <div class="col-sm-3">
            <div class="form-group">
               <input type="text" name="answer1" placeholder="Answer" style="padding: 8px 10px;" id="answer1" class="form-control answerCommon digitCommon" value="{{ old('answer1') }}" readonly="readonly" >
               <span class="error" id="err_answer1"> @if($errors->has('answer1')) {{ $errors->first('answer1') }} @endif </span>
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
   <!-- <div class="col-sm-3">
      <div class="form-group">
          <label class="bmd-label-floating">Digit 1<span class="red">*</span></label>
          <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
          <span class="error">This field is required</span>
      </div>
      </div>
      <div class="col-sm-3">
      <div class="form-group has-default bmd-form-group is-filled">
         <select class="selectpicker" data-rule-required="true" data-style="select-with-transition" name="user_type" id="user_type">
            <option value="">Select Sign</option>
            <option value="program-creator">+</option>
            <option value="supervisor">-</option>                              
         </select>
      </div>                                    
      </div>
      <div class="col-sm-3">
      <div class="form-group">
          <label class="bmd-label-floating">Digit 2<span class="red">*</span></label>
          <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
          <span class="error">This field is required</span>
      </div>  
      </div>
      <div class="col-sm-3">
      <div class="form-group">
          <label class="bmd-label-floating">Answer<span class="red">*</span></label>
          <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
          <span class="error">This field is required</span>
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
      $('.wrapperDiv1').find('.digitCommon').val('');
</script>
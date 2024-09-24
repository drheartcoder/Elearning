@include('creator.template.header')
@if(isset($arr_lang) && sizeof($arr_lang)>0)
<hr/>
<div class="row">
   <div class="col-lg-8">

      @foreach($arr_lang as $lang)        
        <div class="form-group">
           <label class="control-label col-lg-2" for="program_question_{{ $lang['locale'] }}">Question ({{ $lang['title'] }})<i class="red">*</i></label> 
           <div class="col-lg-8">
              <input type="text" name="program_question_{{ $lang['locale'] }}" id="program_question_{{ $lang['locale'] }}" data-local="{{ $lang['locale'] }}" class="form-control program_question" placeholder="Question" data-rule-required="true" data-rule-maxlength="60">
              <span class="error err_question">{{ $errors->first('program_question_'.$lang['locale']) }}</span>
           </div>
        </div>              
        <div class="form-group">
           <label class="control-label col-lg-2" for="option1_{{ $lang['locale'] }}">Option1 ({{ $lang['title'] }})<i class="red">*</i></label> 
           <div class="col-lg-8">
              <input type="text" name="option1_{{ $lang['locale'] }}" id="option1_{{ $lang['locale'] }}" class="form-control program_option" placeholder="Option1" data-rule-required="true" data-cnt="1" data-local="{{ $lang['locale'] }}" data-rule-maxlength="60">
              <span class="error err_option1_{{ $lang['locale'] }}">{{ $errors->first('option1_'.$lang['locale']) }}</span>
           </div>
        </div>

        <div class="form-group">
           <label class="control-label col-lg-2" for="option2_{{ $lang['locale'] }}">Option2 ({{ $lang['title'] }})<i class="red">*</i></label> 
           <div class="col-lg-8">
              <input type="text" name="option2_{{ $lang['locale'] }}" id="option2_{{ $lang['locale'] }}" class="form-control program_option" placeholder="Option2" data-rule-required="true" data-cnt="2" data-local="{{ $lang['locale'] }}" data-rule-maxlength="60">
              <span class="error err_option2_{{ $lang['locale'] }}">{{ $errors->first('option2_'.$lang['locale']) }}</span>
           </div>
        </div>

        <div class="form-group">
           <label class="control-label col-lg-2" for="option3_{{ $lang['locale'] }}">Option3 ({{ $lang['title'] }})<i class="red">*</i></label> 
           <div class="col-lg-8">
              <input type="text" name="option3_{{ $lang['locale'] }}" id="option3_{{ $lang['locale'] }}" class="form-control program_option" placeholder="Option3" data-rule-required="true" data-cnt="3" data-local="{{ $lang['locale'] }}" data-rule-maxlength="60">
              <span class="error err_option3_{{ $lang['locale'] }}">{{ $errors->first('option3_'.$lang['locale']) }}</span>
           </div>
        </div>

        <div class="form-group">
           <label class="control-label col-lg-2" for="option4_{{ $lang['locale'] }}">Option4 ({{ $lang['title'] }})<i class="red">*</i></label> 
           <div class="col-lg-8">
              <input type="text" name="option4_{{ $lang['locale'] }}" id="option4_{{ $lang['locale'] }}" class="form-control program_option" placeholder="Option4" data-rule-required="true" data-cnt="4" data-local="{{ $lang['locale'] }}" data-rule-maxlength="60">
              <span class="error err_option4_{{ $lang['locale'] }}">{{ $errors->first('option4_'.$lang['locale']) }}</span>
           </div>
        </div>
      @endforeach
      <div class="form-group">
         <label class="control-label col-lg-2" for="clock1">Clock A<i class="red">*</i></label> 
         <div class="col-lg-8">
            <input type="text" name="clock1_{{ $lang['locale'] }}" id="clock1" class="form-control program_clock clock" data-cnt="{{1}}" placeholder="Clock A" data-rule-required="true" data-rule-maxlength="60">
            <span class="error err_clock1">{{ $errors->first('clock1') }}</span>
         </div>
      </div>

      <div class="form-group">
         <label class="control-label col-lg-2" for="clock2">Clock B<i class="red">*</i></label> 
         <div class="col-lg-8">
            <input type="text" name="clock2_{{ $lang['locale'] }}" id="clock2" class="form-control program_clock clock" data-cnt="{{2}}" placeholder="Clock B" data-rule-required="true" data-rule-maxlength="60">
            <span class="error err_clock2">{{ $errors->first('clock2') }}</span>
         </div>
      </div>
   </div>   

    @foreach($arr_lang as $lang)    
        <div class="col-lg-4">      
          <div class="form-group">
             <span id="preview_question_{{ $lang['locale'] }}"></span>
          </div>
          <div class="form-group">
             <span id="preview_option1_{{ $lang['locale'] }}"></span>
          </div>
          <div class="form-group">
             <span id="preview_option2_{{ $lang['locale'] }}"></span>
          </div>
          <div class="form-group">
             <span id="preview_option3_{{ $lang['locale'] }}"></span>
          </div>
          <div class="form-group">
             <span id="preview_option4_{{ $lang['locale'] }}"></span>
          </div>
        </div>          
      @endforeach
      <div class="col-lg-4">  
        <div class="form-group">
          <span id="preview_clock1"></span>
        </div>
      </div>
      <div class="col-lg-4">  
        <div class="form-group">
          <span id="preview_clock2"></span>
        </div>
    </div>  
</div>
@endif
<script type="text/javascript">

  $(document).ready(function(){
    $(".clock").datetimepicker();
  });

  function read_program_image(input)
  {
          if (input.files && input.files[0]) {
              var reader = new FileReader();
   
   		reader.onload = function (e) {
   			$('#temp_program_image').attr('src', e.target.result).width(100).height(100);
   		}
   
   		reader.readAsDataURL(input.files[0]);
   	}
  }
   
  $('.program_question').keyup(function(){
    var local = $(this).attr('data-local');
    var program_question = $('#program_question_'+local).val();   
   	if($.trim(program_question) != '')
   	{
   		$('#preview_question_'+local).html(program_question);
   	}
   	else
   	{
   		$('#preview_question_'+local).html('');
   	}
  });

  $('.program_option').keyup(function(){
    var local = $(this).attr('data-local');
    var cnt = $(this).attr('data-cnt');
    var program_option = $('#option'+cnt+'_'+local).val();   
    if($.trim(program_option) != '')
    {
      $('#preview_option'+cnt+'_'+local).html(program_option);
    }
    else
    {
      $('#preview_option'+cnt+'_'+local).html('');
    }
  });

  $('.program_clock').keyup(function(){    
    var cnt = $(this).attr('data-cnt');
    var program_clock = $('#clock'+cnt).val();   
    if($.trim(program_clock) != '')
    {
      $('#preview_clock'+cnt).html(program_clock);
    }
    else
    {
      $('#preview_clock'+cnt).html('');
    }
  });
   
   
  $(document).ready(function()
  {
    $('#frm_create_program').validate(
    {
      ignore: [],
      rules: rules,
      errorPlacement: function(error, element) 
      { 
        var name = $(element).attr("name");
        if (name === "textbook_file_en") 
        {
          error.insertAfter('.err_program_image');
        } 
        else
        {
          error.insertAfter(element);
        }
      },
      invalidHandler: function(e, validator){
        if(validator.errorList.length)
        $('#tabs a[href="#' + jQuery(validator.errorList[0].element).closest(".tab-pane").attr('id') + '"]').tab('show')
      }
    });
  });

  $(document).on("change",".validate_image", function()
  {        
      var file = this.files;
      validateTemplateImage(this.files,1000,1000);
  });
   
</script>
@include('creator.template.footer')
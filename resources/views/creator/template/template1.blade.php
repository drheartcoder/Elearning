@include('creator.template.header')
@if(isset($arr_lang) && sizeof($arr_lang)>0)
	<hr/>

			@foreach($arr_lang as $lang)
				
				@if($lang['locale'] == 'en')
					<div class="form-group">
						<label class="control-label col-lg-2" for="program_image">Upload Image <i class="red">*</i></label> 
					    <div class="col-lg-5">
						   	<input type="file" class="file-styled validate_image" name="program_image_{{ $lang['locale'] }}" id="image" data-rule-required="true" onchange="read_program_image(this);">
						   	<span class="error err_program_image">{{ $errors->first('program_image_'.$lang['locale']) }}</span>
					   	</div>
					</div>
				@endif
				
				<div class="form-group">
					<label class="control-label col-lg-2" for="program">Question ({{ $lang['title'] }})<i class="red">*</i></label> 
					<div class="col-lg-5">
						<input type="text" name="program_name_{{ $lang['locale'] }}" id="program_name_{{ $lang['locale'] }}" class="form-control program_name" placeholder="Question" data-rule-required="true" data-rule-maxlength="60">
						<span class="error err_program">{{ $errors->first('program_name_'.$lang['locale']) }}</span>
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-lg-2" for="program_audio">Upload Audio ({{ $lang['title'] }})<i class="red">*</i></label> 
				    <div class="col-lg-5">
					   	<input type="file" class="file-styled validate_audio" name="program_audio_{{ $lang['locale'] }}" id="program_audio_{{ $lang['locale'] }}" data-rule-required="true" >
					   	<span class="error err_program_audio">{{ $errors->first('program_audio_'.$lang['locale']) }}</span>
				   	</div>
				</div>

			@endforeach
@endif
<script type="text/javascript">
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

  $('#program_audio_en').change(function(){
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function (e) {
        $('#temp_program_audio').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]);
        }
  });

  $('#program_name_en').keyup(function(){
    var program_name = $('#program_name_en').val();
    if($.trim(program_name) != '')
    {
      $('#preview_program').html(program_name);
    }
    else
    {
      $('#preview_program').html('');
    }
  });

    $(document).on("change",".validate_image", function()
    {        
        var file = this.files;
        validateTemplateImage(this.files,1000,1000);
    });

</script>

@include('creator.template.footer')
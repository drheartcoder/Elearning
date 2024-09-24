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
			
			<hr/>
			<div class="add-question-section-main">
                <div class="form-group col-lg-6">
                    <label class="control-label" for="program">Question English<i class="red">*</i></label> 
                    <div class="">
                        <input type="text" name="program_name" id="program_name" class="form-control program_name" placeholder="Question" data-rule-required="true" data-rule-maxlength="60">
                        <span class="error err_program">{{ $errors->first('program_name_'.$lang['locale']) }}</span>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="form-group col-lg-3">                    
                    <div class="user-box">
                        <label class="control-label" for="program">Upload Image<i class="red">*</i></label>
                        <div style="position: relative;" class="profile-img-block">
                            <div class="pro-img"><img src="../assets/images/user.png" class="img-responsive img-preview" alt=""/></div>
                            <input style="height: 100%; width: 100%; z-index: 99;" id="logo-id" name="logo"  type="file" class="attachment_upload">
                        </div>                        
                      </div>
                    
                </div>
                <div class="form-group col-lg-3">
                    <label class="control-label" for="program">Image Name<i class="red">*</i></label> 
                    <div class="">
                        <input type="text" name="program_name" id="program_name" class="form-control program_name" placeholder="Image Name" data-rule-required="true" data-rule-maxlength="60">
                        <span class="error err_program">{{ $errors->first('program_name_'.$lang['locale']) }}</span>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="form-group col-lg-6">
					<label class="control-label" for="program_audio">Upload Audio ({{ $lang['title'] }})<i class="red">*</i></label> 
				    <div class="">
					   	<input type="file" class="file-styled validate_audio" name="program_audio_{{ $lang['locale'] }}" id="program_audio_{{ $lang['locale'] }}" data-rule-required="true" >
					   	<span class="error err_program_audio">{{ $errors->first('program_audio_'.$lang['locale']) }}</span>
				   	</div>
				</div>
           <div class="clearfix"></div>
               <div class="form-group col-lg-6">
                  <label class="control-label" for="time">Time<i class="red">*</i></label>
                  <div class="">                    
                    <div class="col-lg-9" style="padding: 0px;">
                      <input name="program_time_en" id="program_time_en" class="form-control program_time" placeholder="Time" data-rule-required="true" data-rule-maxlength="60" type="text">
                    </div>
                    <div class="col-lg-3" style="padding: 0px;">
                      <select class="form-control question_time_type" id="question_time_type_en" name="question_time_type_en" data-rule-required="true">
                        <option value="" selected="">Select</option>
                        <option value="mins">mins</option>
                        <option value="secs">secs</option>
                      </select>
                    </div>

                    <span class="error"> </span>
                  </div>
                </div>
               <div class="clearfix"></div>
               <div class="form-group col-lg-6">
					<label class="control-label" for="program_audio">Radio Button<i class="red">*</i></label> 
				    <div class="radio-btns">  
                        <div class="radio-btn">
                        <input type="radio" id="f-option" name="selector">
                        <label for="f-option">Male</label>
                        <div class="check"></div>
                        </div>

                        <div class="radio-btn">
                        <input type="radio" id="s-option" name="selector">
                        <label for="s-option">Female</label>

                        <div class="check"><div class="inside"></div></div>
                        </div>

                        </div>
				</div>
               <div class="clearfix"></div>
               <div class="form-group col-lg-6">
                   <div class="check-block">
                        <input id="filled-in-box" class="filled-in" checked="checked" type="checkbox">
                        <label for="filled-in-box">Remember me</label>
                    </div>
                    <div class="check-block">
                        <input id="filled-in-box1" class="filled-in" type="checkbox">
                        <label for="filled-in-box1">Remember me</label>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
			

@endif

<script>    
   $(document).ready(function() {
    var brand = document.getElementById('logo-id');
    brand.className = 'attachment_upload';
    brand.onchange = function() {
        document.getElementById('fakeUploadLogo').value = this.value.substring(12);
    };

    // Source: http://stackoverflow.com/a/4459419/6396981
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function(e) {
                $('.img-preview').attr('src', e.target.result);
              
            };
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#logo-id").change(function() {
        readURL(this);
    });
       
});
</script>   
<!--new profile image upload demo script end-->  
</script>

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

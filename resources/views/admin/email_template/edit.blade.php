
@extends('admin.layout.master')    
@section('main_content')
<!-- Page header -->
   @include('admin.layout.breadcrumb')  
<!-- /page header -->

<!-- BEGIN Main Content -->

<!-- Content area -->
<div class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="card-body-section">
            <div class="card">
               <div class="card-header card-header-icon card-header-rose">
                  <div class="card-icon">
                     <i class="fa fa-envelope"></i>
                  </div>
                  <h4 class="card-title">{{$page_title or ''}}
                  </h4>
               </div>
               <!-- <div class="card "> -->
               <!-- <div class="card-header ">
                  <h4 class="card-title">{{$module_title or ''}}
                  </h4>
                  </div> -->
               	<div class="card-body">
                  	@include('admin.layout._operation_status')                  	
	                  	<form class="form-horizontal" id="frm_edit_email_template" name="frm_edit_email_template" action="{{$module_url_path}}/update/{{$id}}" method="post">
	                     {{csrf_field()}}
                            <h4 class="title"></h4>
	                     <ul class="nav nav-pills nav-pills-warning" role="tablist" id="tabs">
	                        @include('admin.layout._multi_lang_tab')                    
	                     </ul>
	                     <div class="tab-content tab-space">
	                        @if(isset($arr_lang) && sizeof($arr_lang)>0)
	                        @foreach($arr_lang as $lang)
	                        <div class="tab-pane {{ $lang['locale']=='en'?'active':'' }}" id="{{ $lang['locale'] }}">
	                            @if($lang['locale']=='en')	                            
                                 <div class="form-group has-default bmd-form-group is-filled">
                                      <label class="bmd-label-floating">Template From <i class="red">*</i></label>
                                    <input type="text" name="template_from_{{ $lang['locale'] }}" value="{{$arr_email_template['template_from'] or ''}}" id="template_from_{{ $lang['locale'] }}" class="form-control" data-rule-required="true"  data-rule-maxlength="60" value="">
                                    <span class="error">{{ $errors->first('template_from_'.$lang['locale']) }} </span>
                                 </div>	                           	                           
                                 <div class="form-group has-default bmd-form-group is-filled">
                                      <label class="bmd-label-floating">Template From Email <i class="red">*</i></label>
                                   <input type="text" name="template_from_mail_{{ $lang['locale'] }}" value="{{$arr_email_template['template_from_mail'] or ''}}" id="template_from_mail_{{ $lang['locale'] }}" class="form-control" data-rule-required="true"  data-rule-email="true" value="">
                                    <span class="error">{{ $errors->first('template_from_mail_'.$lang['locale']) }} </span>
                                </div>	                             
	                           @endif	                           
                                 <div class="form-group has-default bmd-form-group is-filled">
                                      <label class="bmd-label-floating">Template Name <i class="red">*</i></label>
                                    <input type="text" name="template_name_{{ $lang['locale'] }}" value="{{$arr_email_template['translations'][$lang['locale']]['template_name'] or ''}}" id="template_name_{{ $lang['locale'] }}" class="form-control" data-rule-required="true"  data-rule-maxlength="60" value="">
                                    <span class="error">{{ $errors->first('template_name_'.$lang['locale']) }} </span>
                                 </div>	                             

	                           
                                 <div class="form-group has-default bmd-form-group is-filled">
                                      <label class="bmd-label-floating">Template Subject <i class="red">*</i></label>
                                    <input type="text" name="template_subject_{{ $lang['locale'] }}" value="{{$arr_email_template['translations'][$lang['locale']]['template_subject'] or ''}}" id="template_subject_{{ $lang['locale'] }}" class="form-control" data-rule-required="true"  data-rule-maxlength="60" value="">
                                    <span class="error">{{ $errors->first('template_subject_'.$lang['locale']) }} </span>
                                </div>	                             

	                           
	                                  <label class="bmd-label-floating">Template Body <i class="red">*</i></label>	                              
	                                 <div class="form-group has-default bmd-form-group is-filled">
	                                 	<textarea class="ckeditor template_html" data-attr='textarea' name="template_html_{{$lang['locale']}}" id="template_html_{{$lang['locale']}}" rows="15"  data-rule-required="true">{{$arr_email_template['translations'][$lang['locale']]['template_html'] or ''}}</textarea>
	                                    <span class='help-block'>
	                                    <span class="error err_email_content">{{ $errors->first('template_html_'.$lang['locale']) }} </span>
				                      	<div class="clearfix"></div>
				                      	<br/>
                                <span class="note-section-block form-note-section"><b>Note :</b> <span>Please don't change the following variables in the email template body.</span></span>
	                           		</div>	                              
	                           
	                           
	                        </div>
	                        @endforeach
	                        @endif                   

	                        <div class="row">
	                            <label class="col-md-3 col-form-label">Template Variables </label>
	                            <div class="col-md-9">
		                			@if(isset($arr_variables) && sizeof($arr_variables)>0 && !empty($arr_variables))	                            
		                              @foreach($arr_variables as $variable)
		                                  <br> <label> {{ $variable }} </label> 
		                              @endforeach
		                            @endif
		                        </div>	                        
		                     </div>       

	                     </div>	                     
	                     <button type="submit" class="btn btn-rose pull-right btn_update_email_template">Update</button>	                     
	                     <a href="javascript:void(0)" name="preview" id="preview"  class="btn btn-rose pull-right"><i class="fa fa-eye"></i> Preview</a>
	                     <button type="button" onclick="location.href='{{$module_url_path}}'" class="btn btn-rose pull-right">Cancel</button>
	                     <div class="clearfix"></div>
	                  	</form>
	                  	<form id="preview_form"  method="POST" action="{{$module_url_path}}/preview" target="_blank">
	                	{{csrf_field()}}
	                    <input type="hidden" name="preview_html" id="preview_html" required="" value="{{$arr_email_template['translations'][$lang['locale']]['template_html'] or ''}}"> 
	                  	</form>                 	
               	</div>
               <!-- </div> -->
            </div>
         </div>
      </div>
   </div>
</div>

<input type="hidden" name="json_arr_lang" id="json_arr_lang" value="{{ isset($arr_lang)?json_encode($arr_lang):json_encode(array()) }}">
<script src="{{ url('/') }}/js/admin/pages/tinymce.min.js"></script>
<script>
    $(document).ready(function () {
        tinymce.init({
            selector: '.template_html',
            height: 350,
            theme: "modern",
            required: true,
            paste_data_images: true,
            plugins: [
         'advlist autolink lists link image charmap print preview anchor',
         'searchreplace visualblocks code fullscreen',
         'insertdatetime media table contextmenu paste code'
         ],
            valid_elements: '*[*]',
            toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image ',
            image_advtab: true,
            file_picker_callback: function (callback, value, meta) {
                if (meta.filetype == 'image') {
                    $('.tinymce_upload').trigger('click');
                    $('.tinymce_upload').on('change', function () {
                        var file = this.files[0];
                        var reader = new FileReader();
                        reader.onload = function (e) {
                            callback(e.target.result, {
                                alt: ''
                            });
                        };
                        reader.readAsDataURL(file);
                    });
                }
            },
            content_css: [SITE_URL+'/css/admin/codepen.min.css']
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('.btn_update_email_template').click(function () {
            tinyMCE.triggerSave();
        });

        var rules = new Object();
        $('#frm_edit_email_template').validate({
            highlight: function(element) { },
            ignore: [],
            rules: rules,
            invalidHandler: function(e, validator){
                if(validator.errorList.length)
                {
                    $('#tabs a[href="#' + jQuery(validator.errorList[0].element).closest(".tab-pane").attr('id') + '"]').tab('show')
                }
            }
        });
    });
</script>

<script type="text/javascript">
  $('#preview').on('click',function(){
      $('#preview_form').submit();
  });
</script>

@endsection


			
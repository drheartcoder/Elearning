@extends('admin.layout.master')    
@section('main_content')
<style type="text/css">   
   .hidden { display: none !important;}
</style>
<!-- Page header -->
@include('admin.layout.breadcrumb')  
<!-- /page header -->
<!-- Content area -->
<div class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="card-body-section">
            <div class="card">
               <div class="card-header card-header-icon card-header-rose">
                  <div class="card-icon">
                     <i class="fa fa-comments"></i>
                  </div>
                  <h4 class="card-title">{{$module_title or ''}}
                  </h4>
               </div>
               <!-- <div class="card "> -->
               <!-- <div class="card-header ">
                  <h4 class="card-title">{{$module_title or ''}}
                  </h4>
                  </div> -->
               <div class="card-body">
                  @include('admin.layout._operation_status')                  
                    <form class="form-horizontal" id="frm_create_front_page" name="frm_create_front_page" action="{{$module_url_path}}/store" method="post" enctype="multipart/form-data">
                       {{csrf_field()}}                        
                       <ul class="nav nav-pills nav-pills-warning" role="tablist" id="tabs">
                          @include('admin.layout._multi_lang_tab')                    
                       </ul>
                       <div class="tab-content tab-space">
                          @if(isset($arr_lang) && sizeof($arr_lang)>0)
                          @foreach($arr_lang as $lang)
                          <div class="tab-pane {{ $lang['locale']=='en'?'active':'' }}" id="{{ $lang['locale'] }}">

                            @if($lang['locale'] == 'en')
                              <div class="row">
                                <div class="col-md-4">
                                   <h4 class="title">Profile Image <i class="red">*</i></h4>
                                   <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                      <div class="fileinput-new thumbnail img-circle">

                                      @php $is_profile_image_required = $prev_image_url = ""; @endphp
                                    
                                      @if(isset($arr_admin_details['image']) && !empty($arr_admin_details['image']) && File::exists($image_base_img_path.$arr_admin_details['image']))
                                          <img src="{{$image_public_img_path.$arr_admin_details['image']}}"  style="max-width: 100%; max-height: 100%; line-height: 20px;width: 100%;height: 100%" class="fileupload-preview">
                                          @php 
                                            $prev_image_url = $image_public_img_path.$arr_admin_details['image']; 
                                            $is_image_required = false; 
                                          @endphp
                                      @else
                                          <img src="{{url('/assets/img/placeholder.jpg')}}"  style="max-width: 100%; max-height: 100%; line-height: 20px;width: 100%;height: 100%" class="fileupload-preview">
                                          @php 
                                            $is_image_required = true;
                                            $prev_image_url = url('/').'/uploads/admin/default_image/default-testimonials.png';
                                          @endphp
                                      @endif
                                         
                                      </div>
                                      <div class="fileinput-preview fileinput-exists thumbnail img-circle"></div>
                                      <input type="hidden" name="oldimage" id="oldimage" value="{{ $arr_admin_details['image']  or ''}}"/>
                                      <div>
                                         <span class="btn btn-rose btn-file">
                                         <span class="fileinput-new">Add Photo</span>
                                         <span class="fileinput-exists">Change</span>
                                         <input step="margin:0 0 10px" type="file" data-validation-allowing="jpg, png, gif" class="file-input news-image validate-image" name="testimonial_image_{{$lang['locale']}}" id="image_1"  {{$is_image_required == true ? 'data-rule-required=true' : ''}} data-msg-required="Please select image."><br>
                                          <input type="hidden" name="oldimage" id="oldimage" value="{{ $arr_admin_details['image']  or ''}}"/>

                                          <input type="hidden" name="prev_image_url" id="prev_image_url" value="{{$prev_image_url or ''}}"/>
                                         </span>
                                         <div class="clearfix"></div>
                                         <a href="javascript:void(0)" class="btn btn-danger fileinput-exists remove-btn1" data-dismiss="fileinput" id="remove">Remove</a>
                                      </div>      
                                      <div id="file-upload-error" class="err_image"></div>
                                  <span for="image" id="err-image" class="has-danger">{{ $errors->first('image') }}</span>                        
                                   </div> 
                                   <div class="clearfix"></div>                  
                                    <span class="note-section-block"><b>Note :</b> <span>{!! image_validate_note(250,250,'account_setting') !!}</span></span>
                                  
                                </div>
                              </div>
                            @endif                             
                               <div class="form-group has-default bmd-form-group is-filled">
                                    <label class="bmd-label-floating">Name <i class="red">*</i></label>
                                   <input type="text" class="form-control name-input" name="testimonial_name_{{$lang['locale']}}" id="testimonial_name_{{$lang['locale']}}" data-rule-required="true" data-rule-maxlength="250">
                                  <span class="error">{{ $errors->first('testimonial_name_'.$lang['locale']) }} </span>
                               </div>                                                         
                                <label class="bmd-label-floating">Message <i class="red">*</i></label>
                               <div class="form-group has-default bmd-form-group is-filled">
                                  <textarea class="ckeditor message" data-attr='textarea' name="message_{{$lang['locale']}}" id="message_{{$lang['locale']}}" placeholder="Page Description" rows="15"  data-rule-required="true">{{old('message')}}</textarea>
                                  <span class='help-block'>
                                    {{ $errors->first('message_'.$lang['locale']) }}</span>
                                  <div id="error_message_{{ $lang['locale'] }}"></div>
                                  <span class="err_message"></span>
                               </div>                               

                          </div>
                          @endforeach
                          @endif                   
                       </div>

                       <input name="image[]" type="file" class="hidden tinymce_upload" onchange="">                       
                       <button type="submit" class="btn btn-rose pull-right btn_add_testimonial">Add</button>
                       <button type="button" onclick="location.href='{{$module_url_path}}'" class="btn btn-rose pull-right">Cancel</button>
                       <div class="clearfix"></div>
                    </form>                
               </div>
               <!-- </div> -->
            </div>
         </div>
      </div>
   </div>
</div>
<!-- BEGIN Main Content -->
<input type="hidden" name="json_arr_lang" id="json_arr_lang" value="{{ isset($arr_lang)?json_encode($arr_lang):json_encode(array()) }}">
<script src="{{url('\js\admin\pages\tinymce.min.js')}}"></script>

<script>
  $(document).ready(function()
    {
      tinymce.init({
        selector: '.message',
        height:350,
        theme: "modern",
        required: true,
        paste_data_images: true,
        plugins: [
        'advlist autolink lists link image charmap print preview anchor',
        'searchreplace visualblocks code fullscreen',
        'insertdatetime media table contextmenu paste code'
        ],
        valid_elements : '*[*]',
        toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent',
        image_advtab: true,
        file_picker_callback: function(callback, value, meta) {
          if (meta.filetype == 'image') {
            $('.tinymce_upload').trigger('click');
            $('.tinymce_upload').on('change', function() {
              var file = this.files[0];
              var reader = new FileReader();
              reader.onload = function(e) {
                callback(e.target.result, {
                  alt: ''
                });
                $('.tinymce_upload').val('');
              };
              reader.readAsDataURL(file);
            });
          }
        },
        content_css: [
        SITE_URL+'/css/admin/codepen.min.css'
        ]        

      });  

      

    });
</script>

<script>
$(document).ready(function(){

  $('.btn_add_testimonial').click(function(){
    tinyMCE.triggerSave();
  });

  var rules = new Object();

  $('.message').each(function() {
    rules[this.name] = { required: true };
  });

  jQuery('#frm_create_front_page').validate({
    ignore: [],
    rules: rules,
    errorPlacement: function(error, element) 
    {
      $('.message').each(function() {
        if(element.attr("name") == this.name)
        {
          var name = this.name;
          error.appendTo($(this).closest('.tab-pane').find(".err_message"));
        }
        else
        {
          if(element.attr("data-attr") != "textarea")
          {
            error.insertAfter(element);      
          }
        }
        
        if(element.attr("name") =='testimonial_image_en')
        {
          error.insertAfter('.err_image');
        }

      });
    },
    invalidHandler: function(e, validator){
    if(validator.errorList.length)
        $('#tabs a[href="#' + jQuery(validator.errorList[0].element).closest(".tab-pane").attr('id') + '"]').tab('show')
    }
  });
});

  $('#image_1').change(function(){    
        var file=this.files;
        validateImage(this.files, 250,250);
  })

$(document).on("click","#remove", function()
{   
  removeFile();
});

</script>
@endsection
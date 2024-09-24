@extends('admin.layout.master') @section('main_content')
<style type="text/css">
    .hidden {
        display: none !important;
    }
</style>
@include('admin.layout.breadcrumb')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="card-body-section">
                <div class="card">
                    <div class="card-header card-header-icon card-header-rose">
                        <div class="card-icon">
                            <i class="fa fa-file-text"></i>
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
                        <form class="form-horizontal" id="frm_create_front_page" name="frm_create_front_page" action="{{$module_url_path}}/store" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <h4 class="title"></h4>
                            <ul class="nav nav-pills nav-pills-warning" role="tablist" id="tabs">
                                @include('admin.layout._multi_lang_tab')
                            </ul>
                            <div class="tab-content tab-space">
                                @if(isset($arr_lang) && sizeof($arr_lang)>0) @foreach($arr_lang as $lang)
                                <div class="tab-pane {{ $lang['locale']=='en'?'active':'' }}" id="{{ $lang['locale'] }}">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group has-default bmd-form-group is-filled">
                                                <label class="bmd-label-floating">Page Name <i class="red">*</i></label>
                                                <input type="text" name="page_name_{{$lang['locale']}}" id="page_name_{{$lang['locale']}}" class="form-control" data-rule-required="true" data-rule-maxlength="100">
                                                <span class="error">{{ $errors->first('page_name_'.$lang['locale']) }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group has-default bmd-form-group is-filled">
                                                <label class="bmd-label-floating">Page Title <i class="red">*</i></label>
                                                <input type="text" class="form-control" name="title_{{$lang['locale']}}" id="title_{{$lang['locale']}}" data-rule-required="true" data-rule-maxlength="100">
                                                <span class="error">{{ $errors->first('title_'.$lang['locale']) }} </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group has-default bmd-form-group is-filled">
                                                <label class="bmd-label-floating">Meta Title <i class="red">*</i></label>
                                                <input type="text" class="form-control" name="meta_title_{{$lang['locale']}}" id="meta_title_{{$lang['locale']}}" data-rule-required="true" data-rule-maxlength="100">
                                                <span class="error">{{ $errors->first('meta_title_'.$lang['locale']) }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group has-default bmd-form-group is-filled">
                                                <label class="bmd-label-floating">Meta Keyword <i class="red">*</i></label>
                                                <input type="text" class="form-control" name="meta_keyword_{{$lang['locale']}}" id="meta_keyword_{{$lang['locale']}}" data-rule-required="true" data-rule-maxlength="100" >
                                                <span class="error">{{ $errors->first('meta_keyword_'.$lang['locale']) }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group has-default bmd-form-group is-filled">
                                                <label class="bmd-label-floating">Meta Description <i class="red">*</i></label>
                                                <textarea class="form-control" name="meta_description_{{$lang['locale']}}" id="meta_description_{{$lang['locale']}}" data-rule-required="true"> </textarea>
                                                <span class="error">{{ $errors->first('meta_description_'.$lang['locale']) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="bmd-label-floating">Page Description <i class="red">*</i></label>
                                            <div class="form-group has-default bmd-form-group is-filled">
                                                <textarea class="ckeditor page_description" data-attr='textarea' name="page_description_{{$lang['locale']}}" id="page_description_{{$lang['locale']}}" rows="15" data-rule-required="true"></textarea>
                                                <span class='error err_page_description'>
                                                  {{ $errors->first('page_description_'.$lang['locale']) }}</span><!-- 
                                                <div id="error_page_description_{{ $lang['locale'] }}"></div> -->                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach @endif
                            </div>
                            <input name="image" type="file" class="hidden tinymce_upload" onchange="">                            
                            <button type="submit" class="btn btn-rose pull-right btn_add_front_page">Create</button>
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
    $(document).ready(function () {
        tinymce.init({
            selector: '.page_description',
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
            toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
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
                        };
                        reader.readAsDataURL(file);
                    });
                }
            },
            content_css: [ SITE_URL+'/css/admin/codepen.min.css' ]
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('.btn_add_front_page').click(function () {
            tinyMCE.triggerSave();
        });

        var rules = new Object();
        $('#frm_create_front_page').validate({
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
@endsection
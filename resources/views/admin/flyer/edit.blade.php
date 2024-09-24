@extends('admin.layout.master') @section('main_content')
<!-- Page header -->
@include('admin.layout.breadcrumb')
<!-- /page header -->

<!-- BEGIN Main Content -->

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="card-body-section">
                <div class="card">
                    <div class="card-header card-header-icon card-header-rose">
                        <div class="card-icon">
                            <i class="fa fa-envelope-square"></i>
                        </div>
                        <h4 class="card-title">{{$page_title or ''}}
                  </h4>
                    </div>
                    <div class="card-body">
                        @include('admin.layout._operation_status')
                        <form class="form-horizontal" id="frm_edit_email_template" name="frm_edit_email_template" action="{{$module_url_path}}/update/{{$id}}" method="post">
                            {{csrf_field()}}
                            <h4 class="title"></h4>
                            <input type="hidden" name="id" id="id" value="{{$id}}">
                            <div class="row">                                
                                <div class="col-md-6">
                                    <div class="form-group has-default bmd-form-group is-filled">                                        
                                        <select class="selectpicker" data-rule-required="true" data-style="select-with-transition" name="lang" id="lang">
                                            <option value="">Select Langauge</option>
                                            @if(isset($lang_arr) && count($lang_arr)>0)
                                                @foreach($lang_arr as $row)    
                                                <option value="{{$row['locale']}}" @if(isset($row['locale']) && $row['locale']!='' && $row['locale']==$arr_flyer['locale']) selected="selected" @endif>{{$row['title']}}</option>
                                                @endforeach
                                            @endif    
                                        </select>
                                        <span class="error">{{ $errors->first('user_type') }} </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group has-default bmd-form-group is-filled">
                                        <label class="bmd-label-floating">Template Name <i class="red">*</i></label>
                                        <input type="text" name="template_name" value="{{$arr_flyer['template_name'] or ''}}" id="template_name" class="form-control" data-rule-required="true" data-rule-maxlength="60" value="">
                                        <span class="error">{{ $errors->first('template_name') }} </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group has-default bmd-form-group is-filled">
                                        <label class="bmd-label-floating">Template From <i class="red">*</i></label>
                                        <input type="text" name="template_from" value="{{$arr_flyer['template_from'] or ''}}" id="template_from" class="form-control" data-rule-required="true" data-rule-maxlength="60" value="">
                                        <span class="error">{{ $errors->first('template_from') }} </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group has-default bmd-form-group is-filled">
                                        <label class="bmd-label-floating">Template From Email <i class="red">*</i></label>
                                        <input type="text" name="template_from_mail" value="{{$arr_flyer['template_from_mail'] or ''}}" id="template_from_mail" class="form-control" data-rule-required="true" data-rule-email="true" value="">
                                        <span class="error">{{ $errors->first('template_from_mail') }} </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group has-default bmd-form-group is-filled">
                                        <label class="bmd-label-floating">Template Subject <i class="red">*</i></label>
                                        <input type="text" name="template_subject" value="{{$arr_flyer['template_subject'] or ''}}" id="template_subject" class="form-control" data-rule-required="true" data-rule-maxlength="60" value="">
                                        <span class="error">{{ $errors->first('template_subject') }} </span>
                                    </div>
                                </div>
                            </div>



                            <label class="bmd-label-floating">Template Body <i class="red">*</i></label>
                            <div class="form-group has-default bmd-form-group is-filled">
                                <textarea name="template_html" id="template_html" class="form-control" data-rule-required="true" rows="15">{{$arr_flyer['template_html'] or ''}}</textarea>
                                <span class="error err_email_content">{{ $errors->first('template_html') }} </span>
                                <br/>
                                <span class="note-section-block form-note-section"><b>Note :</b> <span>Please don't change the following variables in the email template body.</span></span>
                            </div>

                            
                            <label class="col-md-3 col-form-label">Template Variables </label>
                            <div class="col-md-9">
                                @if(isset($arr_variables) && sizeof($arr_variables)>0 && !empty($arr_variables)) @foreach($arr_variables as $variable)
                                <br>
                                <label> {{ $variable }} </label>
                                @endforeach @endif
                            </div>
                                                        
                            <button type="submit" class="btn btn-rose pull-right" id="btn_update_email_template">Update</button>                            
                            <button type="button" onclick="location.href='{{$module_url_path}}'" class="btn btn-rose pull-right">Cancel</button>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{url('\js\admin\pages\tinymce.min.js')}}"></script>

<script>
    //<div style=“page-break-after: always”></div>

    tinymce.init({
         selector: '#template_html',
         height:350,
         theme: "modern",
         required: true,
         // force_br_newlines : false,
         force_p_newlines : false,
         // forced_root_block : '',
         paste_data_images: true,
         plugins: [
         'advlist autolink lists link image charmap print preview anchor',
         'searchreplace visualblocks code fullscreen',
         'insertdatetime media table contextmenu paste code'
         ],
         valid_elements : '*[*]',
         toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image ',
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
         content_css: [
         SITE_URL+'/css/admin/codepen.min.css'
         ]        
   
       });  
</script>

<script>
    var rules = new Object();
    $(document).ready(function () {
        $('#btn_update_email_template').click(function () {
            tinyMCE.triggerSave();
        });

        $('#frm_edit_email_template').validate({
            highlight: function (element) {},
            ignore: [],
            rules: rules,
        });
    });
</script>

@endsection
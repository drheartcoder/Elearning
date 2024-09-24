@extends('admin.layout.master') @section('main_content')
<!-- Page header -->
@include('admin.layout.breadcrumb')
<!-- /page header -->

<!-- BEGIN Main Content -->
@if(isset($arr_data) && count($arr_data)>0)
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="card-body-section">
                    <div class="card">
                        <div class="card-header card-header-icon card-header-rose">
                            <div class="card-icon">
                                <i class="{{$module_icon or ''}}"></i>
                            </div>
                            <h4 class="card-title">{{$page_title or ''}}</h4>
                        </div>
                        <div class="card-body">
                            @include('admin.layout._operation_status')
                            <form class="form-horizontal" id="frm_edit_newsletter" name="frm_edit_newsletter" action="{{$module_url_path.'/update/'.$enc_id}}" method="post">
                                {{csrf_field()}}
                                <h4 class="title"></h4> 
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group has-default bmd-form-group is-filled">
                                            <label class="bmd-label-floating">Title <i class="red">*</i></label>
                                            <input type="text" name="title" id="title" class="form-control" data-rule-required="true" data-rule-maxlength="75" data-msg-maxlength="Please enter title" value="{{isset($arr_data['title']) && $arr_data['title']!='' ? $arr_data['title'] : '' }}">
                                            <span class="error">{{ $errors->first('title') }} </span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="bmd-label-floating">User Type <i class="red">*</i></label>
                                        <select class="form-group has-default bmd-form-group is-filled selectpicker" data-rule-required="true" data-style="select-with-transition" name="user_type" id="user_type">
                                            <option value="">Select User Type</option>
                                            <option value="parent" @if($arr_data['user_type']=='parent') selected="" @endif>Parent</option>
                                            <option value="teacher" @if($arr_data['user_type']=='teacher') selected="" @endif>Teacher</option>
                                            <option value="program-creator" @if($arr_data['user_type']=='program-creator') selected="" @endif>Program Creator</option>
                                            <option value="supervisor" @if($arr_data['user_type']=='supervisor') selected="" @endif>Supervisor</option>
                                            <option value="subadmin" @if($arr_data['user_type']=='subadmin') selected="" @endif>Sub-Admin</option>
                                        </select>
                                        <span class="error">{{ $errors->first('user_type') }} </span>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="bmd-label-floating">Boradcast Date <i class="red">*</i></label>
                                        <div class="form-group has-default bmd-form-group is-filled">
                                            <input type="text" name="broadcast_date" id="broadcast_date" class="form-control datepicker" readonly="" data-rule-required="true" data-msg-required="Please select Boradcast Date." value="{{isset($arr_data['broadcast_date']) && $arr_data['broadcast_date']!='' ? date('d-m-Y',strtotime($arr_data['broadcast_date'])) : '' }}">
                                            <span class="error">{{ $errors->first('broadcast_date') }} </span>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                            <label class="bmd-label-floating">Message <i class="red">*</i></label>
                                        <div class="form-group has-default bmd-form-group is-filled">
                                            <textarea class="ckeditor message" data-attr='textarea' name="message" data-rule-maxlength="10000" id="message" rows="15"  data-rule-required="true">{{isset($arr_data['message']) && $arr_data['message']!='' ? $arr_data['message'] : '' }}</textarea>
                                            <span class="error">{{ $errors->first('message') }} </span>
                                        </div>
                                    </div>
                                </div>                                
                                <button type="submit" class="btn btn-rose pull-right btn_create_newsletter">Update</button>
                                <button type="button" onclick="location.href='{{$module_url_path}}'" class="btn btn-rose pull-right">Cancel</button>
                                <div class="clearfix"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
<!-- BEGIN Main Content -->
<script src="{{ url('/') }}/js/admin/pages/tinymce.min.js"></script>
<!-- <link rel = "stylesheet" href = "//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">    
<script type = "text/javascript" src = "https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js"></script> -->

<script>
$(document).ready(function () {        

    $("#broadcast_date").datepicker({
        dateFormat: "dd-mm-yy",
        minDate:0,
        changeMonth: true,
        changeYear: true,
        autoclose: true,
        onSelect: function() {
            //- get date from another datepicker without language dependencies
            var minDate = $('#broadcast_date').datepicker('getDate');       
            $("#end_date").datepicker("change", { minDate: minDate });
        }
    });
});
</script>
<script>
    $(document).ready(function () {
        tinymce.init({
            selector: '.message',
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
        $('.btn_create_newsletter').click(function () {
            tinyMCE.triggerSave();
        });

        var rules = new Object();
        $('#frm_edit_newsletter').validate({
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

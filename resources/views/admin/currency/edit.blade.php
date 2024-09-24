@extends('admin.layout.master')    
@section('main_content')
<style type="text/css">
   .dropdown.bootstrap-select{ width: 100% !important;}
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
                     <i class="fa fa-money"></i>
                  </div>
                  <h4 class="card-title">{{$page_title or ''}}
                  </h4>
               </div>
               <div class="card-body">
                  @include('admin.layout._operation_status')
                  <form class="form-horizontal" id="frm_edit_currency" name="frm_edit_currency" action="{{$module_url_path}}/update" method="post">
                     {{csrf_field()}}                     
                    <h4 class="title"></h4>
                     <input type="hidden" name="currency_id" id="currency_id" value="{{ isset($arr_currency['id']) ? base64_encode($arr_currency['id']) : '' }}">
                       <div class="form-group has-default bmd-form-group is-filled">
                        <label class="bmd-label-floating">Name <i class="red">*</i></label>
                          <input type="text" name="name" id="name" class="form-control name" data-rule-required="true" data-rule-maxlength="60" value="{{ isset($arr_currency['name']) ? $arr_currency['name'] : '' }}">
                    <span class="error">{{ $errors->first('name') }} </span>
                       </div>                                            
                       <div class="form-group has-default bmd-form-group is-filled">
                        <label class="bmd-label-floating">Code <i class="red">*</i></label>
                          <input type="text" name="code" id="code" class="form-control code" data-rule-required="true" data-rule-maxlength="60" value="{{ isset($arr_currency['code']) ? $arr_currency['code'] : '' }}">
                          <span class="error">{{ $errors->first('code') }}</span>
                       </div>                                            
                       <div class="form-group has-default bmd-form-group is-filled">
                        <label class="bmd-label-floating">HTML Code <i class="red">*</i></label>
                          <input type="text" name="html_code" id="html_code" class="form-control html_code" data-rule-required="true" data-rule-maxlength="60" value="{{ isset($arr_currency['html_code']) ? $arr_currency['html_code'] : '' }}">
                          <div class="clearfix"></div>
                          <span class="note-section-block form-note-section"><b>Note :</b> <span>Please add HTML code from Font Awesome website only.</span></span>
                          <span class="error">{{ $errors->first('html_code') }}</span>
                       </div>                     
                     <button type="submit" class="btn btn-rose pull-right">Update</button>
                     <button type="button" onclick="location.href='{{$module_url_path}}'" class="btn btn-rose pull-right">Cancel</button>
                     <div class="clearfix"></div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- BEGIN Main Content -->
    <script>
        var rules = new Object();

        $('.name').each(function()
        {
          rules[this.name] = { required: true };
        });
        $('.code').each(function()
        {
          rules[this.name] = { required: true };
        });
        $('.html_code').each(function()
        {
          rules[this.name] = { required: true };
        });

        $(document).ready(function()
        {
          $('#frm_edit_currency').validate(
          {
            ignore: [],
            rules: rules
          });
        });
    </script>  
@endsection
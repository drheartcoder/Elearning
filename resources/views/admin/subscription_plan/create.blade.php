
@extends('admin.layout.master')    
@section('main_content')
<!-- Page header -->
@include('admin.layout.breadcrumb')  
<!-- /page header -->

<!-- BEGIN Main Content -->
<div class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-md-12">
            <div class="card">
               <div class="card-header card-header-icon card-header-rose">
                  <div class="card-icon">
                     <i class="fa fa-file-text"></i>
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
                  <div class="col-md-8">
                    <form class="form-horizontal" id="frm_create_subscription_plan" name="frm_create_subscription_plan" action="{{ url($admin_panel_slug.'/subscription_plan/store') }}" method="post">
                       {{csrf_field()}}
                       <input type="hidden" name="subscription_plan_id" id="subscription_plan_id" value="{{ isset($arr_subscription_plan['id']) ? base64_encode($arr_subscription_plan['id']) : '' }}">
                       <ul class="nav nav-pills nav-pills-warning" role="tablist" id="tabs">
                          @include('admin.layout._multi_lang_tab')                    
                       </ul>
                       <div class="tab-content tab-space">
                          @if(isset($arr_lang) && sizeof($arr_lang)>0)
                          @foreach($arr_lang as $lang)
                          <div class="tab-pane {{ $lang['locale']=='en'?'active':'' }}" id="{{ $lang['locale'] }}">
                             <div class="row">
                                <label class="col-md-3 col-form-label">Name <i class="red">*</i></label>
                                <div class="col-md-9">
                                   <div class="form-group has-default bmd-form-group is-filled">
                                      <input type="text" name="subscription_plan_name_{{ $lang['locale'] }}" id="subscription_plan_name_{{ $lang['locale'] }}"  class="form-control subscription_plan_name" data-rule-required="true" data-rule-maxlength="60" value="{{ isset($arr_subscription_plan['subscription_plan_translation'][$lang['locale']]['name']) ? $arr_subscription_plan['subscription_plan_translation'][$lang['locale']]['name'] : '' }}">
                                <span class="error">{{ $errors->first('subscription_plan_name') }} </span>
                                   </div>
                                </div>
                             </div>
                            
                            <div class="row">
                                <label class="col-md-3 col-form-label">Details <i class="red">*</i></label>
                                <div class="col-md-9">
                                   <div class="form-group has-default bmd-form-group is-filled">
                                      <textarea name="subscription_plan_details_{{ $lang['locale'] }}" id="subscription_plan_details_{{ $lang['locale'] }}" class="form-control subscription_plan_details"  data-rule-required="true" rows="5">{{ isset($arr_subscription_plan['subscription_plan_translation'][$lang['locale']]['details']) ? $arr_subscription_plan['subscription_plan_translation'][$lang['locale']]['details'] : '' }}</textarea>
                                <span class="error">{{ $errors->first('subscription_plan_details_'.$lang['locale']) }} </span>
                                   </div>
                                </div>
                             </div>

                             @if($lang['locale'] == 'en')
                             <div class="row">
                                <label class="col-md-3 col-form-label">Price @if(isset($currency_sym) && $currency_sym="") {!! $currency_sym !!} @endif<i class="red">*</i></label>
                                <div class="col-md-9">
                                   <div class="form-group has-default bmd-form-group is-filled">
                                      <input type="text" name="subscription_plan_price_{{ $lang['locale'] }}" id="subscription_plan_price_{{ $lang['locale'] }}" class="form-control subscription_plan_price" data-rule-required="true" data-rule-maxlength="60" value="{{ isset($arr_subscription_plan['price']) ? $arr_subscription_plan['price'] : '' }}">
                                     <span class="error">{{ $errors->first('subscription_plan_price_'.$lang['locale']) }}</span>
                                   </div>
                                </div>
                             </div>  
                            @endif   
                            
                          </div>
                          @endforeach
                          @endif                   
                       </div>
                       <input name="image[]" type="file" class="hidden tinymce_upload" onchange="">
                       <button type="button" onclick="location.href='{{$module_url_path}}'" class="btn btn-rose">Cancel</button>
                       <button type="submit" class="btn btn-rose pull-right">Create</button>
                       <div class="clearfix"></div>
                    </form>
                </div>
               </div>
               <!-- </div> -->
            </div>
         </div>
      </div>
   </div>
</div>






    <script>
        var rules = new Object();

        $('.subscription_plan_name').each(function()
        {
          rules[this.name] = { required: true };
        });
        $('.subscription_plan_details').each(function()
        {
          rules[this.name] = { required: true };
        });
        $('.subscription_plan_price').each(function()
        {
          rules[this.name] = { required: true };
        });

        $(document).ready(function()
        {
          $('#frm_create_subscription_plan').validate(
          {
            ignore: [],
            rules: rules,
            invalidHandler: function(e, validator){
                if(validator.errorList.length)
                $('#tabs a[href="#' + jQuery(validator.errorList[0].element).closest(".tab-pane").attr('id') + '"]').tab('show')
            }
          });
        });

        // Allow only Numeric Characters
        $('#subscription_plan_price_en').keyup(function() {
            if (this.value.match(/[^0-9]/g)) {
                this.value = this.value.replace(/[^0-9]/g, '');
            }
        });
    </script>
  

  @endsection



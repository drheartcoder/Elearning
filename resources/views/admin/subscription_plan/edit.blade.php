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
                    <form class="form-horizontal" id="frm_edit_subscription_plan" name="frm_edit_subscription_plan" action="{{ url($admin_panel_slug.'/subscription_plan/update') }}" method="post">
                       {{csrf_field()}}
                        <h4 class="title"></h4>
                       <input type="hidden" name="subscription_plan_id" id="subscription_plan_id" value="{{ isset($arr_subscription_plan['id']) ? base64_encode($arr_subscription_plan['id']) : '' }}">
                       <ul class="nav nav-pills nav-pills-warning" role="tablist" id="tabs">
                          @include('admin.layout._multi_lang_tab')                    
                       </ul>
                       <div class="tab-content tab-space">                    
                          @if(isset($arr_lang) && sizeof($arr_lang)>0)
                          @foreach($arr_lang as $lang)
                          <div class="tab-pane {{ $lang['locale']=='en'?'active':'' }}" id="{{ $lang['locale'] }}">                             
                           <div class="form-group has-default bmd-form-group is-filled">
                                <label class="bmd-label-floating">Name <i class="red">*</i></label>
                              <input type="text" name="subscription_plan_name_{{ $lang['locale'] }}" id="subscription_plan_name_{{ $lang['locale'] }}"  class="form-control subscription_plan_name" data-rule-required="true" data-rule-maxlength="60" value="{{ isset($arr_subscription_plan['subscription_plan_translation'][$lang['locale']]['name']) ? $arr_subscription_plan['subscription_plan_translation'][$lang['locale']]['name'] : '' }}">
                        <span class="error">{{ $errors->first('subscription_plan_name') }} </span>
                           </div>                            
                           <div class="form-group has-default bmd-form-group is-filled">
                                <label class="bmd-label-floating">Details <i class="red">*</i></label>
                              <textarea name="subscription_plan_details_{{ $lang['locale'] }}" id="subscription_plan_details_{{ $lang['locale'] }}" class="form-control subscription_plan_details"  data-rule-required="true" rows="5" style="height: 50px">{{ isset($arr_subscription_plan['subscription_plan_translation'][$lang['locale']]['details']) ? $arr_subscription_plan['subscription_plan_translation'][$lang['locale']]['details'] : '' }}</textarea>
                        <span class="error">{{ $errors->first('subscription_plan_details_'.$lang['locale']) }} </span>
                           </div>                             
                             <?php $currency_sym = isset($arr_currency['html_code']) && !empty($arr_currency['html_code']) ? $arr_currency['html_code'] : ''; ?>
                             @if($lang['locale'] == 'en')                             
                               
                               <div class="form-group has-default bmd-form-group is-filled">
                                    <label class="bmd-label-floating">Price ({!! $currency_sym !!})<i class="red">*</i></label>
                                  <input type="text" name="subscription_plan_price_{{ $lang['locale'] }}" id="subscription_plan_price_{{ $lang['locale'] }}" class="form-control subscription_plan_price" data-rule-required="true" data-rule-maxlength="20" maxlength="20" value="{{ isset($arr_subscription_plan['price']) ? number_format($arr_subscription_plan['price'],2,'.','') : '' }}">
                                 <span class="error">{{ $errors->first('subscription_plan_price_'.$lang['locale']) }}</span>
                               </div>

                               <div class="form-group has-default bmd-form-group is-filled">
                                <label class="bmd-label-floating">Price /Day ({!! $currency_sym !!})</label>
                                  <input type="text" name="price_per_day_{{ $lang['locale'] }}" id="price_per_day_{{ $lang['locale'] }}" class="form-control price_per_day" data-rule-required="true" data-rule-maxlength="10" maxlength="10" value="{{ isset($arr_subscription_plan['per_day_price']) ? number_format($arr_subscription_plan['per_day_price'],2,'.','') : '' }}" >
                                 <span class="error">{{ $errors->first('price_per_day_'.$lang['locale']) }}</span>
                               </div>

                               <div class="form-group has-default bmd-form-group is-filled">
                                    <label class="bmd-label-floating">Cancel Price ({!! $currency_sym !!})<i class="red">*</i></label>
                                  <input type="text" name="subscription_plan_cancel_price_{{ $lang['locale'] }}" id="subscription_plan_cancel_price_{{ $lang['locale'] }}" class="form-control subscription_cancel_plan_price" data-rule-required="true" data-rule-maxlength="20" maxlength="20" value="{{ isset($arr_subscription_plan['scrash_price1']) ? number_format($arr_subscription_plan['scrash_price1'],2,'.','') : '' }}">
                                 <span class="error">{{ $errors->first('subscription_plan_cancel_price_'.$lang['locale']) }}</span>
                               </div>

                               <div class="form-group has-default bmd-form-group is-filled">
                                <label class="bmd-label-floating">Cancel Price /Day ({!! $currency_sym !!})</label>
                                  <input type="text" name="cancel_price_per_day_{{ $lang['locale'] }}" id="cancel_price_per_day_{{ $lang['locale'] }}" class="form-control cancel_price_per_day" data-rule-required="true" data-rule-maxlength="10" maxlength="10" value="{{ isset($arr_subscription_plan['scrash_price2']) ? number_format($arr_subscription_plan['scrash_price2'],2,'.','') : '' }}" >
                                 <span class="error">{{ $errors->first('cancel_price_per_day_'.$lang['locale']) }}</span>
                               </div>

                            @endif   
                            
                          </div>
                          @endforeach
                          @endif                   
                       </div>                                              
                       <button type="submit" class="btn btn-rose pull-right">Update</button>
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
        $('.price_per_day').each(function()
        {
          rules[this.name] = { required: true };
        });
        $('.subscription_cancel_plan_price').each(function()
        {
          rules[this.name] = { required: true };
        });
        $('.cancel_price_per_day').each(function()
        {
          rules[this.name] = { required: true };
        });


        $(document).ready(function()
        {

          /*$(".subscription_plan_price").keyup(function(){
            var subscription_plan_price = $(".subscription_plan_price").val();
            var temp = 0;

            if(subscription_plan_price!='')
            {
              temp = subscription_plan_price/365;
              $(".price_per_day").val(temp.toFixed(2));
            }
          });*/
          

          $('#frm_edit_subscription_plan').validate(
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
        $('#subscription_plan_price_en, .price_per_day, .subscription_cancel_plan_price, .cancel_price_per_day').keyup(function() {
            if (this.value.match(/[^0-9.]/g)) {
                this.value = this.value.replace(/[^0-9.]/g, '');
            }
        });
    </script>
  

  @endsection



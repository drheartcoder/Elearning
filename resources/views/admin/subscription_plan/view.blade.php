@extends('admin.layout.master')    
@section('main_content')
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
                     <i class="fa fa-user-secret"></i>
                  </div>
                  <h4 class="card-title">{{$page_title or ''}}
                  </h4>
               </div>
               <div class="card-body">
                   <h4 class="title"></h4>
                  
                  <div class="program-details-main">
                    <div class="program-details-head">
                        Details
                    </div>
                    <?php $currency_sym = isset($arr_currency['html_code']) && !empty($arr_currency['html_code']) ? $arr_currency['html_code'] : ''; ?>                     
                        <div class="border-bottom padding-10">
                            <div class="row">
                                @if(isset($arr_lang) && sizeof($arr_lang)>0)
                                @foreach($arr_lang as $lang)
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="program-details-section">
                                        <div class="program-head">
                                            <b>Name ({{ $lang['title'] }}) <span>:</span> </b> 
                                        </div>
                                        <div class="program-content-txt">
                                            {{ isset($arr_subscription_plan['subscription_plan_translation'][$lang['locale']]['name']) ? $arr_subscription_plan['subscription_plan_translation'][$lang['locale']]['name'] : '' }}
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                @endif                                
                            </div>
                        </div>
                        <div class="border-bottom padding-10">
                            <div class="row">
                                @if(isset($arr_lang) && sizeof($arr_lang)>0)
                                  @foreach($arr_lang as $lang)
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="program-details-section">
                                        <div class="program-head">
                                            <b>Details ({{ $lang['title'] }}) <span>:</span></b>
                                        </div>
                                        <div class="program-content-txt">
                                            {{ isset($arr_subscription_plan['subscription_plan_translation'][$lang['locale']]['details']) ? $arr_subscription_plan['subscription_plan_translation'][$lang['locale']]['details'] : '' }}
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                @endif
                            </div>
                      </div>
                    
                    <div class="border-bottom padding-10">
                        <div class="row">
                            <div class="col-sm-6 col-md-6 col-lg-6">
                                <div class="program-details-section">
                                    <div class="program-head">
                                        <b>Price ({!! $currency_sym !!}) <span>:</span></b>
                                    </div>
                                    <div class="program-content-txt">
                                        {{isset($arr_subscription_plan['price']) ? number_format($arr_subscription_plan['price'],2,'.','') : ''}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-6">
                                <div class="program-details-section">
                                    <div class="program-head">
                                        <b>Price /Day ({!! $currency_sym !!}) <span>:</span></b>
                                    </div>
                                    <div class="program-content-txt">
                                        {{isset($arr_subscription_plan['per_day_price']) ? number_format($arr_subscription_plan['per_day_price'],2,'.','') : ''}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="border-bottom padding-10">
                        <div class="row">
                            <div class="col-sm-6 col-md-6 col-lg-6">
                                <div class="program-details-section">
                                    <div class="program-head">
                                        <b>Cancel Price ({!! $currency_sym !!}) <span>:</span></b>
                                    </div>
                                    <div class="program-content-txt">
                                        {{isset($arr_subscription_plan['scrash_price1']) ? number_format($arr_subscription_plan['scrash_price1'],2,'.','') : ''}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-6">
                                <div class="program-details-section">
                                    <div class="program-head">
                                        <b>Cancel Price /Day ({!! $currency_sym !!}) <span>:</span></b>
                                    </div>
                                    <div class="program-content-txt">
                                        {{isset($arr_subscription_plan['scrash_price2']) ? number_format($arr_subscription_plan['scrash_price2'],2,'.','') : ''}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
               </div>
               <br>
               <div class="form-group text-center">
                  <div class="col-lg-12">
                     <a href="{{$module_url_path}}" class="btn btn-rose pull-right">Back</a>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- BEGIN Main Content -->
@endsection
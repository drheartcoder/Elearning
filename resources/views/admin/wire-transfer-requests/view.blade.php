
@extends('admin.layout.master')    
@section('main_content')
<!-- Page header -->
@include('admin.layout.breadcrumb')  
<!-- /page header -->

@php
    $transaction_id     = isset($arr_data['transaction_id']) && !empty($arr_data['transaction_id']) ? $arr_data['transaction_id'] : '';
    $amount             = isset($arr_data['amount']) && !empty($arr_data['amount']) ? $arr_data['amount'] : '';
    $child_limit        = isset($arr_data['child_limit']) && !empty($arr_data['child_limit']) ? $arr_data['child_limit'] : '';
    $transaction_date   = isset($arr_data['transaction_date']) && !empty($arr_data['transaction_date']) ? get_added_on_date_time($arr_data['transaction_date']) : '';
    $invoice            = isset($arr_data['invoice']) && !empty($arr_data['invoice']) ? $arr_data['invoice'] : '';

    $plan_name          = isset($arr_data['plan_data']['name']) && !empty($arr_data['plan_data']['name']) ? $arr_data['plan_data']['name'] : '';
    $validity           = isset($arr_data['plan_data']['validity']) && !empty($arr_data['plan_data']['validity']) ? $arr_data['plan_data']['validity'] : '';
    $coupon_code        = isset($arr_data['coupon_data']['coupon_code']) && !empty($arr_data['coupon_data']['coupon_code']) ? $arr_data['coupon_data']['coupon_code'] : '-';
    $owner              = isset($arr_data['coupon_data']['owner']) && !empty($arr_data['coupon_data']['owner']) ? $arr_data['coupon_data']['owner'] : '-';
    $coupon_title       = isset($arr_data['coupon_data']['title']) && !empty($arr_data['coupon_data']['title']) ? $arr_data['coupon_data']['title'] : '-';
    $reward_amount      = isset($arr_data['coupon_data']['reward_amount']) && !empty($arr_data['coupon_data']['reward_amount']) ? $arr_data['coupon_data']['reward_amount'] : '-';
    $validity_extension = isset($arr_data['coupon_data']['validity_extension']) && !empty($arr_data['coupon_data']['validity_extension']) ? $arr_data['coupon_data']['validity_extension'] : '-';

    $first_name         = isset($arr_data['user_data']['first_name']) && !empty($arr_data['user_data']['first_name']) ? $arr_data['user_data']['first_name'] : '';
    $last_name          = isset($arr_data['user_data']['last_name']) && !empty($arr_data['user_data']['last_name']) ? $arr_data['user_data']['last_name'] : '';
    $email              = isset($arr_data['user_data']['email']) && !empty($arr_data['user_data']['email']) ? $arr_data['user_data']['email'] : '';
@endphp

<!-- Content area -->
<div class="content">
    <div class="card-body-section">  
       <div class="card">
            <div class="card-header card-header-icon card-header-rose">
                <div class="card-icon">
                    <i class="fa fa-user"></i>
                </div>
                <h4 class="card-title">{{ $sub_module_title or '' }}</h4>
            </div>

            <div class="card-body">
                <fieldset class="content-group">  

                      <div class="program-details-main">
                        <div class="program-details-head">
                            Details
                        </div>
                        <div class="border-bottom padding-10">
                            <div class="row">
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="program-details-section">
                                        <div class="program-head">
                                            <b>Transaction Id <span>:</span> </b> 
                                        </div>
                                        <div class="program-content-txt">
                                            {{ $transaction_id }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="program-details-section">
                                        <div class="program-head">
                                            <b>Name <span>:</span></b>
                                        </div>
                                        <div class="program-content-txt">
                                            {{ $first_name.' '.$last_name }}
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
                                            <b>Email <span>:</span></b>
                                        </div>
                                        <div class="program-content-txt">
                                            {{ $email }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="program-details-section">
                                        <div class="program-head">
                                            <b>Child Limit <span>:</span></b>
                                        </div>
                                        <div class="program-content-txt">
                                            {{ $child_limit }}
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
                                            <b>Plan <span>:</span></b>
                                        </div>
                                        <div class="program-content-txt">
                                            {{ $plan_name }}
                                        </div>
                                    </div>
                                </div>                        
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="program-details-section">
                                        <div class="program-head">
                                            <b>Transaction Date <span>:</span></b>
                                        </div>
                                        <div class="program-content-txt">
                                            {{ $transaction_date }}
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
                                            <b>Amount (¥) <span>:</span></b>
                                        </div>
                                        <div class="program-content-txt">
                                            {{ $amount }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="program-details-section">
                                        <div class="program-head">
                                            <b>Validity <span>:</span></b>
                                        </div>
                                        <div class="program-content-txt">
                                            {{ $validity }}
                                        </div>
                                    </div>
                                </div>                 
                            </div>
                        </div>

                        <!-- <div class="border-bottom padding-10">
                            <div class="row">
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="program-details-section">
                                        <div class="program-head">
                                            <b>Coupon Code <span>:</span></b>
                                        </div>
                                        <div class="program-content-txt">
                                            {{ $coupon_code }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="program-details-section">
                                        <div class="program-head">
                                            <b>Coupon Owner <span>:</span></b>
                                        </div>
                                        <div class="program-content-txt">
                                            {{ $owner }}
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
                                            <b>Coupon Title <span>:</span></b>
                                        </div>
                                        <div class="program-content-txt">
                                            {{ $coupon_title }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="program-details-section">
                                        <div class="program-head">
                                            <b>Reward Amount (%)<span>:</span></b>
                                        </div>
                                        <div class="program-content-txt">
                                            {{ $reward_amount }}
                                        </div>
                                    </div>
                                </div>                 
                            </div>
                        </div>

                        <div class="border-bottom padding-10 border-none">
                            <div class="row">
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="program-details-section">
                                        <div class="program-head">
                                            <b>Validity Extension (Months)<span>:</span></b>
                                        </div>
                                        <div class="program-content-txt">
                                            {{ $validity_extension }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div> -->
                    
                    <br>
                    <div class="form-group text-center">
                      <div class="col-lg-12">
                        <a href="{{ $module_url_path }}" class="btn btn-rose pull-right">Back</a>
                      </div>
                    </div>
                </fieldset>
            </div>
        </div>
    </div>
</div>

@endsection
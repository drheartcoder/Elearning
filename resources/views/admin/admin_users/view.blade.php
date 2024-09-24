@extends('admin.layout.master') @section('main_content')
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
                            <div class="border-bottom padding-10">
                                <div class="row">
                                    <div class="col-sm-6 col-md-6 col-lg-6">
                                        <div class="program-details-section">
                                            <div class="program-head">
                                                <b>Name <span>:</span> </b> 
                                            </div>
                                            <div class="program-content-txt">
                                                {{isset($arr_data['first_name']) && $arr_data['last_name']?$arr_data['first_name']." ".$arr_data['last_name']:''}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-6">
                                        <div class="program-details-section">
                                            <div class="program-head">
                                                <b>Email <span>:</span></b>
                                            </div>
                                            <div class="program-content-txt">
                                                {{isset($arr_data['email'])?$arr_data['email']:''}}
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
                                                <b>Contact Number <span>:</span></b>
                                            </div>
                                            <div class="program-content-txt">
                                                {{isset($arr_data['contact'])?$arr_data['contact']:''}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-6">
                                        <div class="program-details-section">
                                            <div class="program-head">
                                                <b>Address <span>:</span></b>
                                            </div>
                                            <div class="program-content-txt">
                                                {{isset($arr_data['address'])?$arr_data['address']:''}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if(isset($arr_data['user_type']) && $arr_data['user_type']=='program-creator')
                                <div class="border-bottom padding-10">
                                    <div class="row">
                                        <div class="col-sm-6 col-md-6 col-lg-6">
                                            <div class="program-details-section">
                                                <div class="program-head">
                                                    <b>Reporting To <span>:</span></b>
                                                </div>
                                                <div class="program-content-txt">
                                                    {{isset($arr_data['reporting_to_details']) && count($arr_data['reporting_to_details']) >0 ?$arr_data['reporting_to_details']['first_name'].' '.$arr_data['reporting_to_details']['last_name']:''}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
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
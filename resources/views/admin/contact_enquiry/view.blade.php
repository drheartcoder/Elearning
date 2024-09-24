@extends('admin.layout.master')    
@section('main_content')
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
                     <i class="fa fa-phone"></i>
                  </div>
                  <h4 class="card-title">{{$sub_module_title or ''}}
                  </h4>
               </div>
               <div class="card-body">                     
                    <div class="program-details-main">
                        <div class="program-details-head">
                            Details
                        </div>
                        <div class="border-bottom padding-10">
                            <div class="row">
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="program-details-section">
                                        <div class="program-head">
                                            <b>First Name <span>:</span> </b> 
                                        </div>
                                        <div class="program-content-txt">
                                          {{ isset($arr_data['first_name']) && !empty($arr_data['first_name']) ? $arr_data['first_name'] : '' }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="program-details-section">
                                        <div class="program-head">
                                            <b>Last Name <span>:</span> </b> 
                                        </div>
                                        <div class="program-content-txt">
                                          {{ isset($arr_data['last_name']) && !empty($arr_data['last_name']) ? $arr_data['last_name'] : '' }}
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
                                            <b>Phone Code <span>:</span></b>
                                        </div>
                                        <div class="program-content-txt">
                                          @if(isset($arr_data['phone_code_details']['nicename']) && $arr_data['phone_code_details']['nicename']!="" && isset($arr_data['phone_code_details']['phonecode']) && $arr_data['phone_code_details']['phonecode']!="")
                                             ({{ $arr_data['phone_code_details']['nicename'] }}) +{{ $arr_data['phone_code_details']['phonecode'] }}
                                          @else
                                          {{ '-' }}
                                          @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="program-details-section">
                                        <div class="program-head">
                                            <b>Contact Number <span>:</span></b>
                                        </div>
                                        <div class="program-content-txt">
                                            {{isset($arr_data['mobile'])?$arr_data['mobile']:''}}
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
                                            {{isset($arr_data['email'])?$arr_data['email']:''}}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="program-details-section">
                                        <div class="program-head">
                                            <b>Subject <span>:</span></b>
                                        </div>
                                        <div class="program-content-txt">
                                            {{isset($arr_data['subject'])?$arr_data['subject']:''}}
                                        </div>
                                    </div>
                                </div>
                                
                            </div>

                        </div>   
                          <div class="border-bottom padding-10">
                        <div class="row">
                              <div class="col-sm-6 col-md-12 col-lg-12">
                                    <div class="program-details-section">
                                        <div class="program-head">
                                            <b>Message <span>:</span></b>
                                        </div>
                                        <div class="program-content-txt">
                                            {{isset($arr_data['message'])?$arr_data['message']:''}}
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



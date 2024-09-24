
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
                     <i class="fa fa-comments"></i>
                  </div>
                  <h4 class="card-title">{{$page_title or ''}}
                  </h4>
               </div>
               <div class="card-body">                  
<!--
                     <table class="table table-bordered" style="width: 50%">
                        <tbody>
                          <tr>
                            <th class="col-md-3 col-sm-3">Image</th>
                            <td style="width: 100%">
                              @if(isset($arr_subscription_plan['image']) && !empty($arr_subscription_plan['image']) && File::exists($testimonials_image_base_path.$arr_subscription_plan['image']))
                                  <img src="{{$testimonials_image_public_path.$arr_subscription_plan['image']}}"  style="line-height: 20px;" >
                              @else
                                  <img src="{{url('/assets/img/placeholder.jpg')}}"  style="line-height: 20px;">
                              @endif
                            </td>
                          </tr>
                           @if(isset($arr_lang) && sizeof($arr_lang)>0)
                              @foreach($arr_lang as $lang)
                                <tr>
                                  <th class="col-md-3 col-sm-3">Name ({{ $lang['title'] }})</th>
                                  <td style="width: 100%">{{ isset($arr_subscription_plan['testimonial_translation'][$lang['locale']]['title']) ? $arr_subscription_plan['testimonial_translation'][$lang['locale']]['title'] : '' }}</td>
                                </tr>
                              @endforeach
                            @endif
                            @if(isset($arr_lang) && sizeof($arr_lang)>0)
                              @foreach($arr_lang as $lang)
                                <tr>
                                  <th class="col-md-3 col-sm-3">Message ({{ $lang['title'] }})</th>
                                  <td style="width: 100%">{!! isset($arr_subscription_plan['testimonial_translation'][$lang['locale']]['message']) ? $arr_subscription_plan['testimonial_translation'][$lang['locale']]['message'] : '' !!}</td>
                                </tr>
                              @endforeach
                            @endif                          
                        </tbody>
                     </table>
-->
                     
                     <div class="program-details-main">
                        <div class="program-details-head">
                            Details
                        </div>
                        <div class="border-bottom padding-10">
                            <div class="row">
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="program-details-section">
                                        <div class="program-head">
                                            <b>Image <span>:</span> </b> 
                                        </div>
                                        <div class="program-content-txt testi-img">
                                            @if(isset($arr_subscription_plan['image']) && !empty($arr_subscription_plan['image']) && File::exists($testimonials_image_base_path.$arr_subscription_plan['image']))
                                              <img src="{{$testimonials_image_public_path.$arr_subscription_plan['image']}}"  style="line-height: 20px;" >
                                          @else
                                              <img src="{{url('/assets/img/placeholder.jpg')}}"  style="line-height: 20px;">
                                          @endif
                                        </div>
                                    </div>
                                </div>                                                           
                            </div>
                        </div>
                        <div class="border-bottom padding-10">
                            <div class="row">
                                @if(isset($arr_lang) && sizeof($arr_lang)>0)
                                    @foreach($arr_lang as $lang)
                                    <div class="col-sm-6 col-md-6 col-lg-6">                                    
                                        <div class="program-details-section">
                                            <div class="program-head">
                                                <b>Name ({{ $lang['title'] }})<span>:</span></b>
                                            </div>
                                            <div class="program-content-txt">
                                                {{ isset($arr_subscription_plan['testimonial_translation'][$lang['locale']]['title']) ? $arr_subscription_plan['testimonial_translation'][$lang['locale']]['title'] : '' }}
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
                                            <b>Message ({{ $lang['title'] }}) <span>:</span></b>
                                        </div>
                                        <div class="program-content-txt">
                                            {!! isset($arr_subscription_plan['testimonial_translation'][$lang['locale']]['message']) ? $arr_subscription_plan['testimonial_translation'][$lang['locale']]['message'] : '' !!}
                                        </div>
                                    </div>
                                </div> 
                                @endforeach
                                @endif                       
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

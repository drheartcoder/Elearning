<!--footer section start here-->
<footer>
    <div id="footer">
        <div class="footer-section">
            <div class="container">
                <div class="footer-logo-section">
                    <img src="{{ url('/') }}/images/logo-footer.png" alt="ELearning" />
                </div>
                <div class="menu_name points-footer">                    
                    <ul>
         
                        @if(isset($arr_static_pages) && count($arr_static_pages)>0)
                            @foreach($arr_static_pages as $row)
                             
                                @if($row['page_slug'] == 'home')

                                    <li><a href="{{ url('/') }}" class="@if(Request::segment(1) == '') active @endif">{{$row['translations'][0]['title'] or ''}}</a></li>

                                @elseif($row['page_slug'] == 'price-page')
                                     <li><a href="{{ url('/pricing') }}" class="@if(Request::segment(1) == 'pricing') active @endif" >{{$row['translations'][0]['title'] or ''}}</a></li>

                                @elseif($row['page_slug'] == 'about-us' || $row['page_slug'] == 'help')

                                      <li><a href="{{ url('/').'/'.$row['page_slug'] }}" class="@if(Request::segment(1) == $row['page_slug']) active @endif" >{{$row['translations'][0]['title'] or ''}}</a></li>

                                @elseif($row['page_slug'] == 'contact-us-page')
                                  <li><a href="{{ url('/contact-us') }}" class="@if(Request::segment(1) == 'contact-us') active @endif" >{{trans('home.Contact_Us')}}</a></li>

                                @else
                                    <li><a href="{{ url('/').'/'.$row['page_slug'] }}" class="@if(Request::segment(1) == $row['page_slug']) active @endif" >{{$row['translations'][0]['title'] or ''}}</a></li>
                                @endif


                            @endforeach 
                        @endif
                       
                    </ul>
                </div>
                <div class="clearfix"></div>        
                <div class="social-copy-main">                      
                    <div class="social-block">
                        <ul>
                            <li><a class="fb-block" target="blank" href="{{ (isset($arr_global_site_setting['fb_url'])) ? $arr_global_site_setting['fb_url'] : 'javascript:void(0);' }}"><i class="fab fa-facebook-f"></i></a></li>

                            <li><a class="twitt-block" target="blank" href="{{ (isset($arr_global_site_setting['twitter_url'])) ? $arr_global_site_setting['twitter_url'] : 'javascript:void(0);' }}"><i class="fab fa-twitter"></i></a></li>

                            <li><a class="insta-block" target="blank" href="{{ (isset($arr_global_site_setting['google_plus_url'])) ? $arr_global_site_setting['google_plus_url'] : 'javascript:void(0);' }}"><i class="fab fa-google-plus-g"></i></a></li>

                            @if(isset($arr_global_site_setting['linkedin_url']) && $arr_global_site_setting['linkedin_url']!="")
                             <li><a class="linked-block" target="blank" href="{{ (isset($arr_global_site_setting['linkedin_url'])) ? $arr_global_site_setting['linkedin_url'] : 'javascript:void(0);' }}">
                               <i class="fab fa-linkedin-in"></i></a>
                             </li>   
                            @endif  
                            @if(isset($arr_global_site_setting['youtube_url']) && $arr_global_site_setting['youtube_url']!="")
                            <li><a class="insta-block" target="blank" href="{{ (isset($arr_global_site_setting['youtube_url'])) ? $arr_global_site_setting['youtube_url'] : 'javascript:void(0);' }}"><i class="fab fa-youtube"></i></a></li>
                            @endif

                        </ul>
                    </div>
                    <div class="copyright-txt">
                         {{ trans('home.footer_text') }}

                    {{--     &copy; Copyright {{config('app.project.name')}} {{date('Y')}} {{trans('home.All_rights_reserved')}}. --}}
                    </div>
                    <div class="clearfix"></div>        
                </div>
            </div>
        </div>
        <a class="cd-top hidden-xs" href="#0"><i class="fas fa-angle-up"></i> </a>
        <script type="text/javascript" language="javascript" src="{{ url('/') }}/js/front/backtotop.js"></script>
    </div>
</footer>
<!-- footer section end here -->

<!--Main JS-->
<script type="text/javascript" src="{{ url('/') }}/js/front/bootstrap.min.js"></script>
<!--  Plugin for Sweet Alert -->
<link href="{{ url('/') }}/css/front/sweetalert.css" rel="stylesheet" type="text/css" />
<script src="{{url('/')}}/js/front/pages/sweetalert.min.js"></script>
<!-- My JS -->
<script type="text/javascript" src="{{ url('/') }}/js/front/pages/multiple_image_upload.js"></script>
<script type="text/javascript" src="{{ url('/') }}/js/front/pages/sweetalert_msg.js"></script>

<!--bootstrap datepicker js -->    
<script type="text/javascript" src="{{ url('/') }}/js/front/bootstrap-datepicker.min.js"></script>
<!--bootstrap datepicker js -->
<!--bootstrap datepicker css -->
<link rel="stylesheet" type="text/css" href="{{ url('/') }}/css/front/bootstrap-datepicker.min.css"/>
<!--bootstrap datepicker css -->
<script type="text/javascript" src="{{ url('/') }}/js/front/loader.js"></script>
<!-- gallery sript start -->
<script type="text/javascript" src="{{ url('/') }}/js/front/lightgallery.js"></script>
<script>
$('#fixed-size').lightGallery({
    width: '700px',
    height: '470px',
    mode: 'lg-fade',
    addClass: 'fixed-size',
    counter: false,
    download: false,
    startClass: '',
    enableSwipe: false,
    enableDrag: false,
    speed: 500
});   
function ShowSubscriptionExpiredMsg()
{
   swal("{{trans('JS_Validation.Your_membership_plan_has_been_expired')}}");
    return false;
}
function ShowAddChildLimitErrorMsg()
{
   swal("{{trans('JS_Validation.Your_membership_plan_has_been_expired')}}");
    return false;
} 
function ShowSubscriptionErrorMsg(type)
{
    if(type!="" && type=='pending')
    {
        swal("{{trans('JS_Validation.You_have_not_purchased_subscription_plan_yet')}}");
    }
    else
    {
        swal("{{trans('JS_Validation.Your_wire_transfer_request_is_pending_for_approval')}}");
    }
    return false;
}
</script>
<!-- gallery sript end -->


<!-- Common JS -->
<script type="text/javascript" src="{{ url('/') }}/js/front/common.js"></script>

</body>

</html>
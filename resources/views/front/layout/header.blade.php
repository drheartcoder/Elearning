<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="{{ isset($meta_desc) ? $meta_desc : '' }}" />
    <meta name="keywords" content="{{ isset($meta_keyword) ? $meta_keyword : '' }}" />
    <meta name="author" content="" />
    <title>{{config('app.project.name')}} {{ isset($meta_title) ? '- '.$meta_title : '' }}</title>
    <meta property="og:title" content="{{ isset($meta_title) ? $meta_title : '' }}">
    <meta property="og:description" content="{{ isset($meta_desc) ? $meta_desc : '' }}">
    <meta property="og:image" content="images/logo.png">
    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:image:width" content="1920">
    <meta property="og:image:height" content="1280">
    <meta property="og:locale" content="English">
    <meta property="og:url" content="">
    <meta property="og:site_name" content="ELearning">
    <meta property="og:type" content="website">
    <!-- ======================================================================== -->
    <link rel="icon" href="{{ url('/') }}/favicon.ico">

    <script type="text/javascript" src="{{ url('/') }}/js/front/jquery-1.11.3.min.js"></script>
    
    <!--    gallery css-->
    <link href="{{ url('/') }}/css/front/lightgallery.css" rel="stylesheet" type="text/css" />
    <!--font-awesome-css-start-here-->
    <link href="{{ url('/') }}/css/front/fontawesome-all.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ url('/') }}/css/front/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Bootstrap CSS -->
    <link href="{{ url('/') }}/css/front/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!--Custom Css-->
    <link href="{{ url('/') }}/css/front/elearning.css" rel="stylesheet" type="text/css" />
    <!--  Google Maps Plugin    -->

    <script type="text/javascript" src="{{url('/')}}/js/front/pages/image_validation.js"></script>
    <link href="{{url('/')}}/css/front/loading_animate.css" rel="stylesheet" type="text/css" />

    <!-- <script type="text/javascript" src="{{url('/')}}/js/front/fb_auth.js"></script> -->

    <script type="text/javascript">
        var SITE_URL   = "{{ url('/') }}";
        var csrf_token = "{{ csrf_token() }}";
    </script>
</head>

<body>

    @include('error')
    <div id="main"></div>
    <!--Header section start here-->
    <header id="main_header_section">
        <div id="header-home">

            <!--<div class="main-banner-block">-->
            <div class="header header-home">
                <div class="logo-block">
                    <a href="{{ url('/') }}">
                        <img src="{{ url('/') }}/images/logo.png" alt="Elearning" class="main-logo" />
                    </a>
                </div>
                <span class="menu-icon" onclick="openNav()">&#9776;</span>
                <div class="language-section">                                        
                    <ul>
                        <li><a class="{{ (App::getLocale()=='en') ? 'active' : '' }}" href="{{ url('/lang/en') }}">English</a></li> <span>&nbsp;</span>&nbsp;|&nbsp;<span>&nbsp;</span>
                        <li><a class="chinese-lang {{ (App::getLocale()=='cn') ? 'active' : '' }}" href="{{ url('/lang/cn') }}">中文</a></li>
                    </ul>
                </div>
                <!--Menu Start-->
                <div id="mySidenav" class="sidenav">
                    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                    <div class="banner-img-block">
                        <img src="{{ url('/') }}/images/logo-footer-white.png" alt="alteru" />
                    </div>
                    <div class="min-menu">
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

                                @elseif($row['page_slug']!='terms-&-conditions' &&  $row['page_slug']!='privacy-policy')
                                    <li><a href="{{ url('/').'/'.$row['page_slug'] }}" class="@if(Request::segment(1) == $row['page_slug']) active @endif" >{{$row['title'] or ''}}</a></li>
                                @endif

                            @endforeach 
                        @endif
                       
                        

                        @if(isset($arr_user_details) && !empty($arr_user_details))

                            <?php
                                $first_name = isset($arr_user_details['first_name']) && !empty($arr_user_details['first_name']) ? ucfirst($arr_user_details['first_name']) : '';
                                $last_name  = isset($arr_user_details['last_name']) && !empty($arr_user_details['last_name']) ? ucfirst($arr_user_details['last_name']) : '';
                                $user_type  = isset($arr_user_details['user_type']) && !empty($arr_user_details['user_type']) ? $arr_user_details['user_type'] : '';
                                $is_social  = isset($arr_user_details['is_social']) && !empty($arr_user_details['is_social']) ? $arr_user_details['is_social'] : '';
                            ?>
                            <li class="after-login-show notification-icon-block">
                                <a href="{{ url('/').'/'.$user_type }}/notification">
                                    <i class="fa fa-bell"></i>
                                    <span class="noti-count-section" id="notify">0</span>
                                </a>
                            </li>
                            <li class="after-login-show">
                                <a href="javascript:void(0)">
                                    <span class="user-profile-pic">
                                        @if(isset($arr_user_details['profile_image']) && !empty($arr_user_details['profile_image']) && File::exists($profile_image_base_img_path.$arr_user_details['profile_image']))
                                            <img src="{{ $profile_image_public_img_path.$arr_user_details['profile_image'] }}" alt="user profile pic" />
                                        @else
                                            <img src="{{ $default_image_public_img_path }}/default-profile.png" alt="default profile pic" />
                                        @endif
                                    </span>
                                    <span class="user-name">
                                        {{ $first_name.' '.$last_name }} <i class="fa fa-angle-down"></i>
                                    </span>
                                </a>
                                <ul class="user-submenu-section">
                                    <li><a class="active-menu" href="{{ url('/').'/'.$user_type }}/dashboard">{{trans('home.Dashboard')}}</a></li>
                                    @if($user_type == "parent" || $user_type == "teacher")
                                        <li><a class="active-menu" href="{{ url('/').'/'.$user_type }}/account-setting/my-profile">{{trans('home.Account_Setting')}}</a></li>
                                    @endif
                                    <li><a href="{{ url('/') }}/logout">{{trans('home.Sign_Out')}}</a></li>
                                </ul>
                            </li>
                        @else
                            <li class="after-login-hide"><a href="{{ url('/') }}/signin" class="@if(Request::segment(1) == 'signin' || Request::segment(1) == 'signup') active @endif">{{trans('auth.Sign_in')}}/{{trans('auth.Sign_Up')}}</a></li>
                        @endif
                    </ul>
                    </div>
                    <div class="clearfix"></div>
                </div>    
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
            <!--</div>-->

        </div>
        <div class="blank-div-section"></div>
    </header>
    <!--Header section end here-->

    <script type="text/javascript">
    $(document).ready(function(){
        var user_login = "{{ Auth::user() }}";
        if($.trim(user_login) != '')
        {
            $("#main_header_section").addClass('after-login');
        }
        else
        {
            $("#main_header_section").removeClass('after-login');
        }
    });
    </script>    
    @if(Auth::check()!=false)
    <script type="text/javascript">
    //User Notifications starts here
    $(document).ready(function()
    {
        checkNotification();
        setInterval(function()
        {  
            checkNotification()
        },5000);
    }); 

    function checkNotification()
    {
        var notification_URL = '{{url('/')}}/common/get_notifications';
        
        $.ajax({
            headers:{'X-CSRF-Token': csrf_token},
            url:notification_URL,                    
            type:'get',                
            success:function(res)   
            {
                if($.trim(res)!='')
                {   
                    if($.trim(res)=='logout')
                    {
                        window.location.href=SITE_URL;
                    }
                    else
                    {
                        $('#notify').html(res);
                    }   
                }
            }
        });
    }

    </script>
    @endif

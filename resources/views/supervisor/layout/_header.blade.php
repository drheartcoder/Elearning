<!DOCTYPE html>
<html lang="en">
   <!-- Mirrored from demos.creative-tim.com/material-dashboard-pro/examples/dashboard.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 30 Jun 2018 10:39:04 GMT -->
   <!-- Added by HTTrack -->
   <meta http-equiv="content-type" content="text/html;charset=utf-8" />
   <!-- /Added by HTTrack -->
   <head>
      <meta charset="utf-8" />
      <link rel="apple-touch-icon" sizes="76x76" href="{{url('/')}}/assets/img/apple-icon.png">
      <link rel="icon" type="image/png" href="{{url('/')}}/assets/img/favicon.png">
      <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
      <title>
         {{ isset($page_title)?$page_title:"" }} - {{ config('app.project.name') }}
      </title>
      <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
      <!-- Extra details for Live View on GitHub Pages -->
     
      <!--     Fonts and icons     -->

      <link rel="stylesheet" type="text/css" href="{{url('/')}}/css/admin/roboto.css" />
      <link rel="stylesheet" href="{{url('/')}}/css/admin/font-awesome.min.css">
      <!-- CSS Files -->
      <link href="{{url('/')}}/css/admin/material-dashboard.min40a0.css?v=2.0.2" rel="stylesheet" />
      <!-- CSS Just for demo purpose, don't include it in your project -->

      <link href="{{url('/')}}/assets/demo/demo.css" rel="stylesheet" /> 
      <link href="{{url('/')}}/css/admin/common.css" rel="stylesheet" />   
      
      <!-- JS Files -->
      <script type="text/javascript" src="{{url('/')}}/js/admin/core/jquery.min.js"></script>          
      <script src="{{url('/')}}/js/admin/core/popper.min.js" type="text/javascript"></script>
      <script src="{{url('/')}}/js/admin/core/bootstrap-material-design.min.js" type="text/javascript"></script>

      <script src="{{url('/')}}/js/admin/plugins/perfect-scrollbar.jquery.min.js" ></script>
      
      <script type="text/javascript" src="{{url('/')}}/js/admin/pages/image_validation.js"></script>

      <!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
      <script src="{{url('/')}}/js/admin/plugins/jquery.dataTables.min.js"></script>
      <script src="{{url('/')}}/js/admin/common.js"></script>      
      <!--  Google Maps Plugin    -->

      <input type="hidden" value="{{ csrf_token() }}" name="token" id="token">
      <script type="text/javascript">
         var SITE_URL       = "{{url('/')}}";
         var SITE_ADMIN_URL = "{{url('/')}}/"+"{{config('app.project.supervisor_panel_slug')}}";
         var csrf_token     = "{{ csrf_token() }}";
      </script>
   </head>
   @php
      $supervisor_path = config('app.project.supervisor_panel_slug');
   @endphp
   <body class="">
      <!-- Extra details for Live View on GitHub Pages -->      
      <div class="wrapper ">
         <div class="sidebar" data-color="rose" data-background-color="black" data-image="{{url('/')}}/assets/img/sidebar-1.jpg">
            <!--
               Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"
               
               Tip 2: you can also add an image using data-image tag
               -->
            <div class="logo"><a href="#" class="simple-text logo-mini"></a>
                <a href="{{url('/')}}" class="simple-text logo-normal" target="new">
               {{ config('app.project.name') }}
               </a>
            </div>
            @include('supervisor.layout._sidebar')
         </div>
         <div class="main-panel">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top " id="navigation-example">
               <div class="container-fluid">
                  <div class="navbar-wrapper">
                     <div class="navbar-minimize">
                        <button id="minimizeSidebar" class="btn btn-just-icon btn-white btn-fab btn-round">
                        <i class="material-icons text_align-center visible-on-sidebar-regular">more_vert</i>
                        <i class="material-icons design_bullet-list-67 visible-on-sidebar-mini">view_list</i>
                        </button>
                     </div>
                     <a class="navbar-brand" href="#pablo">{{$module_title or ''}}</a>
                  </div>
                  <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation" data-target="#navigation-example">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="navbar-toggler-icon icon-bar"></span>
                  <span class="navbar-toggler-icon icon-bar"></span>
                  <span class="navbar-toggler-icon icon-bar"></span>
                  </button>
                  <div class="collapse navbar-collapse justify-content-end">
                     <form class="navbar-form">
                        <div class="input-group no-border header-search-section">
                           <input type="text" value="" id="search_menu" class="form-control" placeholder="Search...">
                           <button type="submit" class="btn btn-white btn-round btn-just-icon">
                              <i class="material-icons">search</i>
                              <div class="ripple-container"></div>
                           </button>
                        </div>
                     </form>
                     <ul class="navbar-nav">                      
                        <li class="nav-item dropdown">
                           <a class="nav-link" href="{{url('/').'/'.$supervisor_path.'/notifications'}}">
                              <i class="material-icons">notifications</i>
                              <span class="notification"> 0 </span>                             
                           </a>                         
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" href="#pablo" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="material-icons">person</i>                                                           
                              <p class="d-lg-none d-md-block">
                                 Account
                              </p>                              
                           </a>
                           <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                              <a class="dropdown-item" href="{{url('/').'/'.$supervisor_path.'/account_setting'}}">Edit Profile</a>
                              <a class="dropdown-item" href="{{url('/').'/'.$supervisor_path.'/account_setting/password/change'}}">Change Password</a>
                              <a class="dropdown-item" href="{{ url('/').'/'.$supervisor_path }}/logout">Logout</a>
                           </div>
                        </li>
                     </ul>
                  </div>
               </div>
            </nav>
            <!-- End Navbar -->        
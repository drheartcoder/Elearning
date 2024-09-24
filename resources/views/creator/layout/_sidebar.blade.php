   
<div class="sidebar-wrapper">
   @php
       $admin_profile_img = isset($shared_creator_details['profile_image'])  ? $shared_creator_details['profile_image'] : "";
       $profile_image_src = ""; 
   @endphp
   @if(isset($admin_profile_img) &&  $admin_profile_img!="" && file_exists($profile_image_base_img_path.$admin_profile_img))
       @php
           $profile_image_src = $profile_image_public_img_path.$admin_profile_img;
       @endphp
   @else
       @php
           $profile_image_src = url('/')."/assets/img/placeholder.jpg";
       @endphp
   @endif

   <div class="user">
      <div class="photo">
         <img src="{{$profile_image_src}}" />
      </div>
      <div class="user-info">
         <a data-toggle="collapse" href="#collapseExample" class="username">
         <span>
         {{$shared_creator_details['first_name'] or ''}} {{$shared_creator_details['last_name'] or ''}}
         <b class="caret"></b>
         </span>
         </a>
         <div class="collapse @if(Request::segment(2) == 'account_setting') show @endif" id="collapseExample">
            <ul class="nav @if(Request::segment(2) == 'account_setting') active @endif">
               <li class="nav-item @if(Request::segment(2) == 'account_setting' && Request::segment(3) == '') active @endif">
                  <a class="nav-link" href="{{url($creator_path)}}/account_setting">                              
                     <i class="fa fa-gear"></i>
                     <span class="sidebar-normal"> Edit Profile </span>
                  </a>
               </li>
               <li class="nav-item @if(Request::segment(3) == 'password') active @endif">
                  <a class="nav-link" href="{{url('/').'/'.$creator_path.'/account_setting/password/change'}}">                              
                     <i class="fa fa-key"></i>
                     <span class="sidebar-normal"> Change Password </span>
                  </a>
               </li>                   
            </ul>
         </div>
      </div>
   </div>
   <ul class="nav" id="leftbar_menu_list">                 
      <li class="nav-item @if(Request::segment(2) == 'dashboard') active @endif">
         <a class="nav-link" href="{{url($creator_panel_slug).'/dashboard' }}">
            <i class="fa fa-home"></i>
            <p> Dashboard </p>
         </a>
      </li>           
      <li class="nav-item @if(Request::segment(2) == 'notifications') active @endif">
         <a class="nav-link" href="{{url($creator_panel_slug).'/notifications' }}">
            <i class="fa fa-bell"></i>
            <p> Notifications </p>
         </a>
      </li>
      <li class="nav-item @if(Request::segment(2) == 'program') active @endif">
         <a class="nav-link" href="{{url($creator_panel_slug).'/program' }}">
            <i class="fa fa-tasks"></i>
            <p> Program </p>
         </a>
      </li>
    
      
   </ul>
</div>
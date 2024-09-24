    
<div class="sidebar-wrapper" id="admin_sidebar">
   @php
       $admin_profile_img = isset($shared_admin_details['profile_image'])  ? $shared_admin_details['profile_image'] : "";
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
         {{$shared_admin_details['first_name'] or ''}} {{$shared_admin_details['last_name'] or ''}}
         <b class="caret"></b>
         </span>
         </a>
         <div class="collapse @if(Request::segment(2) == 'account_setting' || Request::segment(2) == 'global_setting' || Request::segment(2) == 'bank_details') show @endif" id="collapseExample">
            <ul class="nav @if(Request::segment(2) == 'account_setting' || Request::segment(2) == 'global_setting' || Request::segment(2) == 'bank_details') active @endif">
               
               <li class="nav-item @if(Request::segment(3) == 'edit_profile') active @endif">
                  <a class="nav-link sidebar_option" href="{{url('')}}/admin/account_setting/edit_profile">             
                     <i class="fa fa-gear"></i>
                     <span class="sidebar-normal"> Edit Profile </span>
                  </a>
               </li>

               <li class="nav-item @if(Request::segment(3) == 'password') active @endif">
                  <a class="nav-link sidebar_option" href="{{url('/').'/'.$admin_path.'/account_setting/password/change'}}">
                     <i class="fa fa-key"></i>
                     <span class="sidebar-normal"> Change Password </span>
                  </a>
               </li>

               @if( ($arr_current_user_access!=null && count($arr_current_user_access)>0 && array_key_exists('account_setting/site_status.list', $arr_current_user_access)) || $shared_admin_details['user_type'] == 'admin')
                  <li class="nav-item @if(Request::segment(3) == 'site_status') active @endif">
                     <a class="nav-link sidebar_option" href="{{url('/').'/'.$admin_path.'/account_setting/site_status'}}">                   
                        <i class="fa fa-gear"></i>
                        <span class="sidebar-normal"> Site Setting </span>
                     </a>
                  </li>
               @endif

               @if( ($arr_current_user_access!=null && count($arr_current_user_access)>0 && array_key_exists('account_setting/contact_address_manage.list', $arr_current_user_access)) || $shared_admin_details['user_type'] == 'admin')
               <li class="nav-item @if(Request::segment(3) == 'contact_address_manage') active @endif">
                  <a class="nav-link sidebar_option" href="{{url('/').'/'.$admin_path.'/account_setting/contact_address_manage'}}">
                     <i class="fa fa-map-marker"></i>
                     <span class="sidebar-normal"> Contact Address Manage </span>
                  </a>
               </li>
               @endif

               @if( ($arr_current_user_access!=null && count($arr_current_user_access)>0 && array_key_exists('account_setting/currency.list', $arr_current_user_access)) || $shared_admin_details['user_type'] == 'admin')   
               <li class="nav-item @if(Request::segment(3) == 'currency') active @endif">
                  <a class="nav-link sidebar_option" href="{{url('/').'/'.$admin_path.'/account_setting/currency'}}">
                     <i class="fa fa-money"></i>
                     <span class="sidebar-normal"> Currency </span>
                  </a>
               </li>
               @endif

               <!-- @if(($arr_current_user_access!=null && count($arr_current_user_access)>0 && array_key_exists('account_setting/reference_code.list', $arr_current_user_access)) || $shared_admin_details['user_type'] == 'admin')   
               <li class="nav-item @if(Request::segment(3) == 'reference_code') active @endif">
                  <a class="nav-link sidebar_option" href="{{url('/').'/'.$admin_path.'/account_setting/reference_code'}}">
                     <i class="fa fa-money"></i>
                     <span class="sidebar-normal"> Reference Code </span>
                  </a>
               </li>
               @endif -->

               <li class="nav-item @if(Request::segment(3) == 'otp') active @endif">
                  <a class="nav-link sidebar_option" href="{{url('/').'/'.$admin_path.'/account_setting/otp'}}">
                     <i class="fa fa-commenting"></i>
                     <span class="sidebar-normal"> OTP </span>
                  </a>
               </li>

               @if( ($arr_current_user_access != null && count($arr_current_user_access) > 0 && array_key_exists('global_setting.list', $arr_current_user_access)) || $shared_admin_details['user_type'] == 'admin')
                  <li class="nav-item @if(Request::segment(2) == 'global_setting') active @endif">
                     <a class="nav-link sidebar_option" href="{{url('/').'/'.$admin_path.'/global_setting'}}">
                        <i class="fa fa-gear"></i>
                        <span class="sidebar-normal"> Global Setting </span>
                     </a>
                  </li>
               @endif

               @if(($arr_current_user_access != null && count($arr_current_user_access) > 0 && array_key_exists('bank_details.list', $arr_current_user_access)) || $shared_admin_details['user_type'] == 'admin')
                  <li class="nav-item @if(Request::segment(2) == 'bank_details') active @endif">
                     <a class="nav-link sidebar_option" href="{{url('/').'/'.$admin_path.'/bank_details'}}">
                        <!-- <i class="fa fa-university"></i> -->
                        <i class="material-icons">account_balance</i>
                        <span class="sidebar-normal"> Bank Details </span>
                     </a>
                  </li>
               @endif

            </ul>
         </div>
      </div>
   </div>
   <ul class="nav" id="leftbar_menu_list">                 
      <li class="nav-item @if(Request::segment(2) == 'dashboard') active @endif">
         <a class="nav-link sidebar_option" href="{{url('/').'/'.$admin_path.'/dashboard' }}">
            <i class="fa fa-home"></i>
            <p> Dashboard </p>
         </a>
      </li>     

      @if( ($arr_current_user_access!=null && count($arr_current_user_access)>0 && array_key_exists('admin_users.list', $arr_current_user_access)) || $shared_admin_details['user_type'] == 'admin')      
      <li class="nav-item @if(Request::segment(2) == 'admin_users') active @endif">
         <a class="nav-link sidebar_option" href="{{url('/').'/'.$admin_path.'/admin_users' }}">
            <i class="fa fa-user-secret"></i>
            <p> Admin Users </p>
         </a>
      </li>
      @endif
      <!-- <li class="nav-item @if(Request::segment(2) == 'subadmin') active @endif">
         <a class="nav-link sidebar_option" href="{{url('/').'/'.$admin_path.'/subadmin' }}">
            <i class="fa fa-user-secret"></i>
            <p> Subadmin </p>
         </a>
      </li> -->
      @if( ($arr_current_user_access!=null && count($arr_current_user_access)>0 && array_key_exists('front_pages.list', $arr_current_user_access)) || $shared_admin_details['user_type'] == 'admin')      
      <li class="nav-item @if(Request::segment(2) == 'front_pages') active @endif">
         <a class="nav-link sidebar_option" href="{{url('/').'/'.$admin_path.'/front_pages' }}">
            <i class="fa fa-file-text"></i>
            <p> Front Pages </p>
         </a>
      </li>
      @endif

      @if( ($arr_current_user_access!=null && count($arr_current_user_access)>0 && array_key_exists('subject.list', $arr_current_user_access)) || $shared_admin_details['user_type'] == 'admin')      
      <li class="nav-item @if(Request::segment(2) == 'subject') active @endif">
         <a class="nav-link sidebar_option" href="{{url('/').'/'.$admin_path.'/subject' }}">
            <i class="fa fa-book"></i>
            <p> Subjects </p>
         </a>
      </li>
      @endif

      @if( ($arr_current_user_access!=null && count($arr_current_user_access)>0 && array_key_exists('email_template.list', $arr_current_user_access)) || $shared_admin_details['user_type'] == 'admin')      
      <li class="nav-item @if(Request::segment(2) == 'email_template') active @endif">
         <a class="nav-link sidebar_option" href="{{url('/').'/'.$admin_path.'/email_template' }}">
            <i class="fa fa-envelope"></i>
            <p> Email Template </p>
         </a>
      </li>      
      @endif

      @if( ($arr_current_user_access!=null && count($arr_current_user_access)>0 && array_key_exists('grade.list', $arr_current_user_access)) || $shared_admin_details['user_type'] == 'admin')      
      <li class="nav-item @if(Request::segment(2) == 'grade') active @endif">
         <a class="nav-link sidebar_option" href="{{url('/').'/'.$admin_path.'/grade' }}">
            <i class="fa fa-graduation-cap"></i>
            <p> Grades </p>
         </a>
      </li>
      @endif

      @if( ($arr_current_user_access!=null && count($arr_current_user_access)>0 && array_key_exists('contact_enquiry.list', $arr_current_user_access)) || $shared_admin_details['user_type'] == 'admin')      
      <li class="nav-item @if(Request::segment(2) == 'contact_enquiry') active @endif">
         <a class="nav-link sidebar_option" href="{{url('/').'/'.$admin_path.'/contact_enquiry' }}">
            <i class="fa fa-phone"></i>
            <p> Contact Enquiries </p>
         </a>
      </li>
      @endif

      @if( ($arr_current_user_access!=null && count($arr_current_user_access)>0 && array_key_exists('newsletter.list', $arr_current_user_access)) || $shared_admin_details['user_type'] == 'admin')      
      <li class="nav-item @if(Request::segment(2) == 'newsletter') active @endif">
         <a class="nav-link sidebar_option" href="{{url('/').'/'.$admin_path.'/newsletter'}}">
            <i class="fa fa-newspaper-o"></i>
            <span class="sidebar-normal"> Newsletter </span>
         </a>
      </li>
      @endif

      @if( ($arr_current_user_access != null && count($arr_current_user_access) > 0 && array_key_exists('subscription_plan.list', $arr_current_user_access)) || $shared_admin_details['user_type'] == 'admin')      
      <li class="nav-item @if(Request::segment(2) == 'subscription_plan') active @endif">
         <a class="nav-link sidebar_option" href="{{url('/').'/'.$admin_path.'/subscription_plan' }}">
            <i class="fa fa-file-text"></i>
            <p> Subscription Plans </p>
         </a>
      </li>
      @endif

      @if( ($arr_current_user_access!=null && count($arr_current_user_access)>0 && array_key_exists('testimonials.list', $arr_current_user_access)) || $shared_admin_details['user_type'] == 'admin')      
      <!-- <li class="nav-item @if(Request::segment(2) == 'testimonials') active @endif">
         <a class="nav-link sidebar_option" href="{{url('/').'/'.$admin_path.'/testimonials' }}">
            <i class="fa fa-comments"></i>
            <p> Testimonials </p>
         </a>
      </li> -->
      @endif

      @if( ($arr_current_user_access!=null && count($arr_current_user_access)>0 && array_key_exists('coupons.list', $arr_current_user_access)) || $shared_admin_details['user_type'] == 'admin')      
      <li class="nav-item @if(Request::segment(2) == 'coupons') active @endif">
         <a class="nav-link sidebar_option" href="{{url('/').'/'.$admin_path.'/coupons' }}">
            <i class="fa fa-trophy"></i>
            <p> Coupons </p>
         </a>
      </li>
      @endif

      @if( ($arr_current_user_access!=null && count($arr_current_user_access)>0 && array_key_exists('notifications.list', $arr_current_user_access)) || $shared_admin_details['user_type'] == 'admin')      
      <li class="nav-item @if(Request::segment(2) == 'notifications') active @endif">
         <a class="nav-link sidebar_option" href="{{url('/').'/'.$admin_path.'/notifications' }}">
            <i class="fa fa-bell"></i>
            <p> Notifications </p>
         </a>
      </li>
      @endif

      @if( ($arr_current_user_access!=null && count($arr_current_user_access)>0 && array_key_exists('classrooms.list', $arr_current_user_access)) || $shared_admin_details['user_type'] == 'admin')      
      <li class="nav-item @if(Request::segment(2) == 'classrooms') active @endif">
         <a class="nav-link sidebar_option" href="{{url('/').'/'.$admin_path.'/classrooms' }}">
            <i class="fa fa-bank"></i>
            <p> Classrooms </p>
         </a>
      </li>
      @endif

      @if( ($arr_current_user_access!=null && count($arr_current_user_access)>0 && array_key_exists('flyer.list', $arr_current_user_access)) || $shared_admin_details['user_type'] == 'admin')      
      <li class="nav-item @if(Request::segment(2) == 'flyer') active @endif">
         <a class="nav-link sidebar_option" href="{{url('/').'/'.$admin_path.'/flyer' }}">
            <i class="fa fa-envelope-square"></i>
            <p> Flyer </p>
         </a>
      </li>
      @endif

      @if( ($arr_current_user_access!=null && count($arr_current_user_access)>0 && array_key_exists('certificate.list', $arr_current_user_access)) || $shared_admin_details['user_type'] == 'admin')      
      <li class="nav-item @if(Request::segment(2) == 'certificate') active @endif">
         <a class="nav-link sidebar_option" href="{{url('/').'/'.$admin_path.'/certificate' }}">
            <i class="fa fa-file-text"></i>
            <p> Certificate </p>
         </a>
      </li>
      @endif     

      @if( ($arr_current_user_access!=null && count($arr_current_user_access)>0 && array_key_exists('users.list', $arr_current_user_access)) || $shared_admin_details['user_type'] == 'admin')      
      <li class="nav-item @if(Request::segment(2) == 'users') active @endif">
         <a class="nav-link sidebar_option" data-toggle="collapse" href="#usersMenu">
            <i class="fa fa-users"></i>
            <p> Users 
               <b class="caret"></b>
            </p>
         </a>
         <div class="collapse @if(Request::segment(2) == 'users') show @endif"" id="usersMenu">
            <ul class="nav @if(Request::segment(2) == 'users') active @endif">
               <li class="nav-item @if(Request::segment(2) == 'users' && Request::segment(3) == 'teacher') active @endif">
                  <a class="nav-link sidebar_option" href="{{ url($admin_panel_slug).'/users/teacher' }}">                              
                     <i class="fa fa-user"></i>
                     <span class="sidebar-normal"> Teacher </span>
                  </a>
               </li>
               <li class="nav-item @if(Request::segment(2) == 'users' && Request::segment(3) == 'student') active @endif">
                  <a class="nav-link sidebar_option" href="{{ url($admin_panel_slug).'/users/student' }}">                              
                     <i class="fa fa-user"></i>
                     <span class="sidebar-normal"> Student </span>
                  </a>
               </li>
               <li class="nav-item @if(Request::segment(2) == 'users' && Request::segment(3) == 'parent') active @endif">
                  <a class="nav-link sidebar_option" href="{{ url($admin_panel_slug).'/users/parent' }}">                              
                     <i class="fa fa-user"></i>
                     <span class="sidebar-normal"> Parent </span>
                  </a>
               </li>                           
            </ul>
         </div>
      </li>
      @endif

      @if( ($arr_current_user_access!=null && count($arr_current_user_access)>0 && array_key_exists('gallery.list', $arr_current_user_access)) || $shared_admin_details['user_type'] == 'admin')      
      <li class="nav-item @if(Request::segment(2) == 'gallery') active @endif">
         <a class="nav-link sidebar_option" href="{{url('/').'/'.$admin_path.'/gallery' }}">
            <i class="fa fa-picture-o"></i>
            <p> Gallery </p>
         </a>
      </li>
      @endif

      @if(($arr_current_user_access!=null && count($arr_current_user_access)>0 && array_key_exists('program.list', $arr_current_user_access)) || $shared_admin_details['user_type'] == 'admin')      
      <!-- <li class="nav-item @if(Request::segment(2) == 'program') active @endif">
         <a class="nav-link sidebar_option" data-toggle="collapse" href="#ProgramMenu">
            <i class="material-icons">local_library</i>
            <p> Program <b class="caret"></b> </p>
         </a>

         <div class="collapse @if(Request::segment(2) == 'program') show @endif"" id="ProgramMenu">
            <ul class="nav @if(Request::segment(2) == 'program') active @endif">
               
               <li class="nav-item @if(Request::segment(2) == 'program' && Request::segment(3) == 'new') active @endif">
                  <a class="nav-link sidebar_option" href="{{ url($admin_panel_slug).'/program/new' }}">
                     <i class="material-icons">playlist_add</i>
                     <span class="sidebar-normal"> New </span>
                  </a>
               </li>
               
               <li class="nav-item @if(Request::segment(2) == 'program' && Request::segment(3) == 'approved') active @endif">
                  <a class="nav-link sidebar_option" href="{{ url($admin_panel_slug).'/program/approved' }}">
                     <i class="material-icons">playlist_add_check</i>
                     <span class="sidebar-normal"> Approved </span>
                  </a>
               </li>

            </ul>
         </div>
      </li> -->
      @endif

      @if(($arr_current_user_access!=null && count($arr_current_user_access)>0 && array_key_exists('program.list', $arr_current_user_access)) || $shared_admin_details['user_type'] == 'admin')      
      <li class="nav-item @if(Request::segment(2) == 'program') active @endif">
         <a class="nav-link sidebar_option" href="{{url('/').'/'.$admin_path.'/program' }}">
            <i class="fa fa-tasks"></i>
            <p> Program </p>
         </a>
      </li>
      @endif

      @if( ($arr_current_user_access!=null && count($arr_current_user_access)>0 && array_key_exists('homework.list', $arr_current_user_access)) || $shared_admin_details['user_type'] == 'admin')      
         <li class="nav-item @if(Request::segment(2) == 'homework') active @endif">
            <a class="nav-link sidebar_option" href="{{url('/').'/'.$admin_path.'/homework' }}">
               <i class="fa fa-pencil"></i>
               <p> Homework </p>
            </a>
         </li>
      @endif

      @if( ($arr_current_user_access!=null && count($arr_current_user_access)>0 && array_key_exists('material.list', $arr_current_user_access)) || $shared_admin_details['user_type'] == 'admin')      
         <li class="nav-item @if(Request::segment(2) == 'material') active @endif">
            <a class="nav-link sidebar_option" href="{{url('/').'/'.$admin_path.'/material' }}">
               <i class="fa fa-book"></i>
               <p> Material </p>
            </a>
         </li>
      @endif

      @if( ($arr_current_user_access!=null && count($arr_current_user_access)>0 && array_key_exists('transaction.list', $arr_current_user_access)) || $shared_admin_details['user_type'] == 'admin')      
         <li class="nav-item @if(Request::segment(2) == 'transaction') active @endif">
            <a class="nav-link sidebar_option" href="{{url('/').'/'.$admin_path.'/transaction' }}">
               <i class="fa fa-money"></i>
               <p> Transaction </p>
            </a>
         </li>
      @endif

      @if( ($arr_current_user_access!=null && count($arr_current_user_access)>0 && array_key_exists('wire-transfer.list', $arr_current_user_access)) || $shared_admin_details['user_type'] == 'admin')
         <li class="nav-item @if(Request::segment(2) == 'wire-transfer') active @endif">
            <a class="nav-link sidebar_option" href="{{url('/').'/'.$admin_path.'/wire-transfer'}}">                   
               <i class="fa fa-money"></i>
               <span class="sidebar-normal"> Wire Transfer Request</span>
            </a>
         </li>
      @endif

   </ul>
</div>
<script type="text/javascript">
   if(sessionStorage.getItem('scroll_position')!=undefined && sessionStorage.getItem('scroll_position')!=null)
   {
      $('#admin_sidebar').scrollTop(parseInt(sessionStorage.getItem('scroll_position')));
   }
   $('.sidebar_option').click(function(){
      var scroll_position = $('#admin_sidebar').scrollTop();
      sessionStorage.setItem('scroll_position',scroll_position);
   });
</script>
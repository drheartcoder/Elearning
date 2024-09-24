            <footer class="footer" >
               <div class="container-fluid">                  
                  <div class="copyright float-right">                    
                    {{date('Y')}} © {{ config('app.project.name') }} {{ ucfirst($shared_creator_details['user_type']) }}                    
                  </div>
               </div>
            </footer>
         </div>
      </div>
      <!-- <div class="fixed-plugin">
         <div class="dropdown show-dropdown">
            <a href="#" data-toggle="dropdown">
            <i class="fa fa-cog fa-2x"> </i>
            </a>
            <ul class="dropdown-menu">
               <li class="header-title"> Sidebar Filters</li>
               <li class="adjustments-line">
                  <a href="javascript:void(0)" class="switch-trigger active-color">
                     <div class="badge-colors ml-auto mr-auto">
                        <span class="badge filter badge-purple" data-color="purple"></span>
                        <span class="badge filter badge-azure" data-color="azure"></span>
                        <span class="badge filter badge-green" data-color="green"></span>
                        <span class="badge filter badge-warning" data-color="orange"></span>
                        <span class="badge filter badge-danger" data-color="danger"></span>
                        <span class="badge filter badge-rose active" data-color="rose"></span>
                     </div>
                     <div class="clearfix"></div>
                  </a>
               </li>
               <li class="header-title">Sidebar Background</li>
               <li class="adjustments-line">
                  <a href="javascript:void(0)" class="switch-trigger background-color">
                     <div class="ml-auto mr-auto">
                        <span class="badge filter badge-black active" data-background-color="black"></span>
                        <span class="badge filter badge-white" data-background-color="white"></span>
                        <span class="badge filter badge-red" data-background-color="red"></span>
                     </div>
                     <div class="clearfix"></div>
                  </a>
               </li>
               <li class="adjustments-line">
                  <a href="javascript:void(0)" class="switch-trigger">
                     <p>Sidebar Mini</p>
                     <label class="ml-auto">
                        <div class="togglebutton switch-sidebar-mini">
                     <label>
                     <input type="checkbox">
                     <span class="toggle"></span>
                     </label>
                     </div>
                     </label>
                     <div class="clearfix"></div>
                  </a>
               </li>
               <li class="adjustments-line">
                  <a href="javascript:void(0)" class="switch-trigger">
                     <p>Sidebar Images</p>
                     <label class="switch-mini ml-auto">
                        <div class="togglebutton switch-sidebar-image">
                     <label>
                     <input type="checkbox" checked="">
                     <span class="toggle"></span>
                     </label>
                     </div>
                     </label>
                     <div class="clearfix"></div>
                  </a>
               </li>
               <li class="header-title">Images</li>
               <li class="active">
                  <a class="img-holder switch-trigger" href="javascript:void(0)">
                  <img src="{{url('/')}}/assets/img/sidebar-1.jpg" alt="">
                  </a>
               </li>
               <li>
                  <a class="img-holder switch-trigger" href="javascript:void(0)">
                  <img src="{{url('/')}}/assets/img/sidebar-2.jpg" alt="">
                  </a>
               </li>
               <li>
                  <a class="img-holder switch-trigger" href="javascript:void(0)">
                  <img src="{{url('/')}}/assets/img/sidebar-3.jpg" alt="">
                  </a>
               </li>
               <li>
                  <a class="img-holder switch-trigger" href="javascript:void(0)">
                  <img src="{{url('/')}}/assets/img/sidebar-4.jpg" alt="">
                  </a>
               </li>
               <li class="button-container">
                  <a href="#" target="_blank" class="btn btn-rose btn-block btn-fill">Buy Now</a>
                  <a href="#" target="_blank" class="btn btn-default btn-block">
                  Documentation
                  </a>
                  <a href="#" target="_blank" class="btn btn-info btn-block">
                  Get Free Demo!
                  </a>
               </li>
               <li class="button-container github-star">
                  <a class="github-button" href="#" data-icon="octicon-star" data-size="large" data-show-count="true" aria-label="Star ntkme/github-buttons on GitHub">Star</a>
               </li>
               <li class="header-title">Thank you for 95 shares!</li>
               <li class="button-container text-center">
                  <button id="twitter" class="btn btn-round btn-twitter"><i class="fa fa-twitter"></i> &middot; 45</button>
                  <button id="facebook" class="btn btn-round btn-facebook"><i class="fa fa-facebook-f"></i> &middot; 50</button>
                  <br>
                  <br>
               </li>
            </ul>
         </div>
      </div> -->
      <!--   Core JS Files   -->
      

       

      
      <!-- Plugin for the momentJs  -->
      <script src="{{url('/')}}/js/admin/plugins/moment.min.js"></script>
      <!--  Plugin for Sweet Alert -->
      <script src="{{url('/')}}/js/admin/plugins/sweetalert2.js"></script>
      <!-- Forms Validations Plugin -->
      <script src="{{url('/')}}/js/admin/plugins/jquery.validate.min.js"></script>
      <!--  Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
      <script src="{{url('/')}}/js/admin/plugins/jquery.bootstrap-wizard.js"></script>
      <!--  Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
      <script src="{{url('/')}}/js/admin/plugins/bootstrap-selectpicker.js" ></script>
      <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
      <script src="{{url('/')}}/js/admin/plugins/bootstrap-datetimepicker.min.js"></script>
      <!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
      <script src="{{url('/')}}/js/admin/plugins/jquery.dataTables.min.js"></script>
      <!--  Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
      <script src="{{url('/')}}/js/admin/plugins/bootstrap-tagsinput.js"></script>
      <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
      <script src="{{url('/')}}/js/admin/plugins/jasny-bootstrap.min.js"></script>
      <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
      <script src="{{url('/')}}/js/admin/plugins/fullcalendar.min.js"></script>
      <!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
      <script src="{{url('/')}}/js/admin/plugins/jquery-jvectormap.js"></script>
      <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
      <script src="{{url('/')}}/js/admin/plugins/nouislider.min.js" ></script>
      <!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
      <script src="{{url('/')}}/js/admin/core.js"></script>
      <!-- Library for adding dinamically elements -->
      <script src="{{url('/')}}/js/admin/plugins/arrive.min.js"></script>
      <!-- Place this tag in your head or just before your close body tag. -->
      <script async defer src="{{url('/')}}/js/admin/buttons.js"></script>
      <!-- Chartist JS -->
      <script src="{{url('/')}}/js/admin/plugins/chartist.min.js"></script>
      <!--  Notifications Plugin    -->
      <script src="{{url('/')}}/js/admin/plugins/bootstrap-notify.js"></script>
      <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
      <script src="{{url('/')}}/js/admin/material-dashboard.min40a0.js?v=2.0.2" type="text/javascript"></script>
      <!-- Material Dashboard DEMO methods, don't include it in your project! -->
      <script src="{{url('/')}}/assets/demo/demo.js"></script>

      <!-- My JS -->
      
      <script type="text/javascript" src="{{url('/')}}/js/admin/pages/multiple_image_upload.js"></script>

      <script type="text/javascript" src="{{url('/')}}/js/admin/pages/jquery.validate.min.js"></script>
      <script type="text/javascript" src="{{url('/')}}/js/admin/pages/additional-methods.js"></script>
      <script type="text/javascript" src="{{url('/')}}/js/admin/pages/sweetalert_msg.js"></script>

      <script type="text/javascript">      
            function chk_all(field)
              {
                  if($(field).prop('checked') == true){
                      $('input[type="checkbox"]').prop('checked',true);
                  }
                  else
                  {
                      $('input[type="checkbox"]').prop('checked',false);
                  }
              }

            $(document).ready(function(){
                $(document).on('change','input[name="checked_record[]"]',function(){
                    if($(this).prop('checked') == false)
                    {
                        $('input[name="selectall"]').prop('checked',false);
                    }

                    var unselected_count = 0;

                    $('input[name="checked_record[]').each(function(){
                        if($(this).prop('checked') == false)
                        {
                            unselected_count ++;
                        }
                        if(unselected_count > 0)
                        {
                            $('input[name="selectall"]').prop('checked',false);
                        }
                        else
                        {
                            $('input[name="selectall"]').prop('checked',true);
                        }
                    });

                });

            });
                      
            $(document).ready(function(){
              setInterval(function()
              {
                  var token = "{{csrf_token()}}";                                                
                  var user_type = "creator";                
                  $.ajax(
                  {
                    'headers':{'X-CSRF-Token': token},
                    'url':SITE_URL+'/common/read',
                    'type':'get',
                    'data':{'user_type':user_type},
                    success:function(res)   
                    {
                      if($.trim(res)!='logout')
                      {
                        $('.notification').html(res);
                      }
                      else
                      {
                        window.location.href = SITE_ADMIN_URL;
                      }
                    }
                  });  
               
              },5000);
                 
              /*},5000);*/

              $('#search_menu').keyup(function() {                   
                searchLeftbar($(this).val());
              });
           });            

            function searchLeftbar(inputVal) {
                var table = $('#leftbar_menu_list');
                var count = 0;
                table.find('li').each(function(index, row) {
                    var allCells = $(row).find('a');
                    if (allCells.length > 0) {
                        var found = false;
                        allCells.each(function(index, li) {
                            var regExp = new RegExp(inputVal, 'i');
                            if (regExp.test($(li).text())) {
                                found = true;
                                return false;
                            }
                        });
                        if (found == true){
                            $(row).show();
                            count = count  + 1;
                        }
                        else {
                            $(row).hide();
                        }
                    }
                });
            }
           </script>

      <script>
         $(document).ready(function(){
           $().ready(function(){
             $sidebar = $('.sidebar');
         
             $sidebar_img_container = $sidebar.find('.sidebar-background');
         
             $full_page = $('.full-page');
         
             $sidebar_responsive = $('body > .navbar-collapse');
         
             window_width = $(window).width();
         
             fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();
         
             if (window_width > 767 && fixed_plugin_open == 'Dashboard') {
                 if ($('.fixed-plugin .dropdown').hasClass('show-dropdown')) {
                     $('.fixed-plugin .dropdown').addClass('open');
                 }
         
             }
         
             $('.fixed-plugin a').click(function(event) {
                 // Alex if we click on switch, stop propagation of the event, so the dropdown will not be hide, otherwise we set the  section active
                 if ($(this).hasClass('switch-trigger')) {
                     if (event.stopPropagation) {
                         event.stopPropagation();
                     } else if (window.event) {
                         window.event.cancelBubble = true;
                     }
                 }
             });
         
             $('.fixed-plugin .active-color span').click(function() {
                 $full_page_background = $('.full-page-background');
         
                 $(this).siblings().removeClass('active');
                 $(this).addClass('active');
         
                 var new_color = $(this).data('color');
         
                 if ($sidebar.length != 0) {
                     $sidebar.attr('data-color', new_color);
                 }
         
                 if ($full_page.length != 0) {
                     $full_page.attr('filter-color', new_color);
                 }
         
                 if ($sidebar_responsive.length != 0) {
                     $sidebar_responsive.attr('data-color', new_color);
                 }
             });
         
             $('.fixed-plugin .background-color .badge').click(function() {
                 $(this).siblings().removeClass('active');
                 $(this).addClass('active');
         
                 var new_color = $(this).data('background-color');
         
                 if ($sidebar.length != 0) {
                     $sidebar.attr('data-background-color', new_color);
                 }
             });
         
             $('.fixed-plugin .img-holder').click(function() {
                 $full_page_background = $('.full-page-background');
         
                 $(this).parent('li').siblings().removeClass('active');
                 $(this).parent('li').addClass('active');
         
         
                 var new_image = $(this).find("img").attr('src');
         
                 if ($sidebar_img_container.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
                     $sidebar_img_container.fadeOut('fast', function() {
                         $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
                         $sidebar_img_container.fadeIn('fast');
                     });
                 }
         
                 if ($full_page_background.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
                     var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');
         
                     $full_page_background.fadeOut('fast', function() {
                         $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
                         $full_page_background.fadeIn('fast');
                     });
                 }
         
                 if ($('.switch-sidebar-image input:checked').length == 0) {
                     var new_image = $('.fixed-plugin li.active .img-holder').find("img").attr('src');
                     var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');
         
                     $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
                     $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
                 }
         
                 if ($sidebar_responsive.length != 0) {
                     $sidebar_responsive.css('background-image', 'url("' + new_image + '")');
                 }
             });
         
             $('.switch-sidebar-image input').change(function() {
                 $full_page_background = $('.full-page-background');
         
                 $input = $(this);
         
                 if ($input.is(':checked')) {
                     if ($sidebar_img_container.length != 0) {
                         $sidebar_img_container.fadeIn('fast');
                         $sidebar.attr('data-image', '#');
                     }
         
                     if ($full_page_background.length != 0) {
                         $full_page_background.fadeIn('fast');
                         $full_page.attr('data-image', '#');
                     }
         
                     background_image = true;
                 } else {
                     if ($sidebar_img_container.length != 0) {
                         $sidebar.removeAttr('data-image');
                         $sidebar_img_container.fadeOut('fast');
                     }
         
                     if ($full_page_background.length != 0) {
                         $full_page.removeAttr('data-image', '#');
                         $full_page_background.fadeOut('fast');
                     }
         
                     background_image = false;
                 }
             });
         
             $('.switch-sidebar-mini input').change(function() {
                 $body = $('body');
         
                 $input = $(this);
         
                 if (md.misc.sidebar_mini_active == true) {
                     $('body').removeClass('sidebar-mini');
                     md.misc.sidebar_mini_active = false;
         
                     $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar();
         
                 } else {
         
                     $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar('destroy');
         
                     setTimeout(function() {
                         $('body').addClass('sidebar-mini');
         
                         md.misc.sidebar_mini_active = true;
                     }, 300);
                 }
         
                 // we simulate the window Resize so the charts will get updated in realtime.
                 var simulateWindowResize = setInterval(function() {
                     window.dispatchEvent(new Event('resize'));
                 }, 180);
         
                 // we stop the simulation of Window Resize after the animations are completed
                 setTimeout(function() {
                     clearInterval(simulateWindowResize);
                 }, 1000);
         
             });
           });
         });
      </script>    

      <script>
         $(document).ready(function(){
           // Javascript method's body can be found in assets/js/demos.js
           md.initDashboardPageCharts();
           
           md.initVectorMap();
           
         });
      </script>
   </body>
   <!-- Mirrored from demos.creative-tim.com/material-dashboard-pro/examples/dashboard.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 30 Jun 2018 10:39:31 GMT -->
</html>
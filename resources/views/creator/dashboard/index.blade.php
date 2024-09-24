@extends('creator.layout.master')    
@section('main_content') 
 
   <div class="container-fluid">

            <div class="dash-top-blocks">
            <div class="row">

               <div class="col-sm-6 col-md-4 col-lg-4 col-xl-3">
                  <a href="{{ $creator_url_path }}/program">
                  <div class="card card-stats">
                     <div class="card-header card-header-warning card-header-icon">
                        <div class="card-icon">
                           <i class="fa fa-users"></i>
                        </div>
                       <p class="card-category">No Of Program</p>
                        <h3 class="card-title">{{ $program_count or 0 }}</h3>
                     </div>
                    <div class="card-footer">
                        <div class="stats">
                           <!-- <i class="material-icons">date_range</i> @if(isset($selected_year) && $selected_year!="") {{ 'student count of year -'.$selected_year }} @else {{ 'Student count of all years' }}  @endif -->
                        </div>
                     </div>
                  </div>
                 </a>
               </div>

               <div class="col-sm-6 col-md-4 col-lg-4 col-xl-3">
                 <a href="{{ $creator_url_path }}/program">
                 <div class="card card-stats">
                    <div class="card-header card-header-rose card-header-icon">
                       <div class="card-icon">
                          <i class="fa fa-user-circle-o"></i>
                       </div><p class="card-category">Approved Program Count</p>
                       <h3 class="card-title">{{ $approved_program_count or 0 }}</h3>
                    </div>
                    <div class="card-footer">
                       <div class="stats">
                       
                       </div>
                    </div>
                 </div>
                </a>
              </div>
              <div class="col-sm-6 col-md-4 col-lg-4 col-xl-3">
                 <a href="{{ $creator_url_path }}/program">
                 <div class="card card-stats">
                    <div class="card-header card-header-success card-header-icon">
                       <div class="card-icon">
                          <i class="fa fa-book"></i>
                       </div>
                       <p class="card-category">Pending Program Count</p>
                       <h3 class="card-title">{{ $pending_program_count or 0 }}</h3>
                    </div>
                    <div class="card-footer">
                      <div class="stats">
                       
                      </div>
                    </div>
                 </div>
                </a>
              </div>
                 <div class="col-sm-6 col-md-4 col-lg-4 col-xl-3">
                  <a href="{{ $creator_url_path }}/notifications">
                  <div class="card card-stats">
                     <div class="card-header card-header-rose card-header-icon">
                        <div class="card-icon">
                           <i class="fa fa-user-circle-o"></i>
                        </div>
                        <p class="card-category">No Of Notification</p>
                        <h3 class="card-title">{{ $notification_count or 0 }}</h3>
                     </div>
                     <div class="card-footer">
                        <div class="stats">
                         <!--   <i class="material-icons">date_range</i>@if(isset($selected_year) && $selected_year!="") {{ 'Parent count of year -'.$selected_year }} @else {{ 'Parent count of all years' }} @endif -->
                        </div>
                     </div>
                  </div>
                 </a>
               </div>
             </div>
            </div>
           <div class="graph-blocks">
            <div class="row">
             <div class="col-md-6">
                 <div class="card">
                   <div class="card-header">
                     <h4 class="card-title dashboard_title">Admin Notifications</h4>
                   </div>
         
                     @if(isset($arr_notification) && sizeof($arr_notification)>0)
                      
                       <div class="card-body notification_div">
                          @foreach($arr_notification as $notification)
                           @if(isset($notification['message']) && $notification['message']!="")
                             <div class="alert alert-info alert-with-icon" data-notify="container">
                               <i class="material-icons" data-notify="icon">notifications</i>
                                   <span data-notify="icon" class="now-ui-icons ui-1_bell-53"></span>
                                   <span data-notify="message">{{ $notification['message'] or '' }}</span>
                             </div>
                          @endif
                         @endforeach
                          <a href="{{ $creator_url_path }}/notifications">View All</a>
                       </div>
                    @else
                       <div class="card-body notification_div">
                          {{ 'You have not received any notification yet.' }}
                       </div>
                    @endif
                 </div>
               </div>
             <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
          </div>

   </div>

<input type="hidden" name="users_count" id="users_count" value="{{ $str_users or '' }}">
<input type="hidden" name="str_transaction_cny" id="str_transaction_cny" value="{{ $str_transaction_cny or '' }}">
<input type="hidden" name="str_transaction_usd" id="str_transaction_usd" value="{{ $str_transaction_usd or '' }}">
<script src="{{ url('/') }}/js/admin/canvasjs.min.js"></script>
<script type="text/javascript">
 
  window.onload = function() 
  {
      drawNoOfUsersPieChart(); 
   
  }
  function drawNoOfUsersPieChart()
  {
      var is_data_exist = 0;
      var data = arr_users_count = [];
      var users_count     = $('#users_count').val();
      if(users_count!=undefined)
      {
         arr_users_count = $.parseJSON(users_count);
      }
      if(arr_users_count.length>0)
      {
          for(var j=0;j<arr_users_count.length; j++)
          {
              if(arr_users_count[j].data==0)
              {
                is_data_exist++;
              }
              data.push({
                   y: arr_users_count[j].data, label: arr_users_count[j].label   
               });
          }
      }
      if(is_data_exist==arr_users_count.length)
      {
          $('#pie_chart_of_registerd_users').html('No Data Found');
      }
      else
      {
         var chart = new CanvasJS.Chart("pie_chart_of_registerd_users", {
          animationEnabled: true,
          title: {
            text: "No Of Registered Users {{ $selected_year or '' }}"
          },
          data: [{
            type: "pie",
            startAngle: 240,
            yValueFormatString: "##0.00\"%\"",
            indexLabel: "{label} {data}",
            dataPoints: data
          }]
        });
        chart.render();
      }
  }
  
  function toggleDataSeries(e) {
  if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
    e.dataSeries.visible = false;
  }
  else {
    e.dataSeries.visible = true;
  }
  chart.render();
}

</script>
@endsection
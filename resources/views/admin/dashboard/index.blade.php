@extends('admin.layout.master')    
@section('main_content') 
 
 {{--  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <h2 style="text-align: center;">Coming Soon</h2>
        <div class="card">
        	<div class="card-body">
        	@include('admin.layout._operation_status')
        	</div>
    	</div>
      </div>
    </div>
  </div> --}}

              {{--  <div class="content"> --}}
                  <div class="container-fluid">
                       <div class="col-sm-6 col-md-4 col-lg-4 col-xl-3">
                           <select onchange="GetDataByYear(this.value)" class="selectpicker" name="selected_year" data-size="7" data-style="btn btn-rose btn-round" title="Select Year">
                            @if(isset($arr_year_range) && sizeof($arr_year_range))
                              @foreach($arr_year_range as $range)
                                 <option @if(isset($selected_year) && $selected_year==$range) selected=""  @endif value="{{ $range }}">{{ $range }}</option>
                              @endforeach
                            @endif
                          </select>
                      </div>
                     <div class="dash-top-blocks">
                     <div class="row">
                        <div class="col-sm-6 col-md-4 col-lg-4 col-xl-3">
                           <a href="{{ $admin_url_path }}/users/student">
                           <div class="card card-stats">
                              <div class="card-header card-header-warning card-header-icon">
                                 <div class="card-icon">
                                    <i class="fa fa-users"></i>
                                 </div>
                                <p class="card-category">No Of Student</p>
                                 <h3 class="card-title">{{ $student_count or 0 }}</h3>
                              </div>
                             <div class="card-footer">
                                 <div class="stats">
                                    <i class="material-icons">date_range</i> @if(isset($selected_year) && $selected_year!="") {{ 'student count of year -'.$selected_year }} @else {{ 'Student count of all years' }}  @endif
                                 </div>
                              </div>
                           </div>
                          </a>
                        </div>
                        <div class="col-sm-6 col-md-4 col-lg-4 col-xl-3">
                           <a href="{{ $admin_url_path }}/users/parent">
                           <div class="card card-stats">
                              <div class="card-header card-header-rose card-header-icon">
                                 <div class="card-icon">
                                    <i class="fa fa-user-circle-o"></i>
                                 </div>
                                 <p class="card-category">No Of Parent</p>
                                 <h3 class="card-title">{{ $parent_count or 0 }}</h3>
                              </div>
                              <div class="card-footer">
                                 <div class="stats">
                                    <i class="material-icons">date_range</i>@if(isset($selected_year) && $selected_year!="") {{ 'Parent count of year -'.$selected_year }} @else {{ 'Parent count of all years' }} @endif
                                 </div>
                              </div>
                           </div>
                          </a>
                        </div>
                        <div class="col-sm-6 col-md-4 col-lg-4 col-xl-3">
                           <a href="{{ $admin_url_path }}/users/teacher">
                           <div class="card card-stats">
                              <div class="card-header card-header-success card-header-icon">
                                 <div class="card-icon">
                                    <i class="fa fa-book"></i>
                                 </div>
                                 <p class="card-category">No Of Teacher</p>
                                 <h3 class="card-title">{{ $teacher_count or 0 }}</h3>
                              </div>
                              <div class="card-footer">
                                 <div class="stats">
                                    <i class="material-icons">date_range</i> @if(isset($selected_year) && $selected_year!="") {{ 'Teacher Count of year -'.$selected_year }} @else {{ 'Teacher count of all years' }} @endif
                                 </div>
                              </div>
                           </div>
                          </a>
                        </div>
                        <div class="col-sm-6 col-md-4 col-lg-4 col-xl-3">
                           <a href="{{ $admin_url_path }}/admin_users?user_type=program-creator">
                           <div class="card card-stats">
                              <div class="card-header card-header-info card-header-icon">
                                 <div class="card-icon">
                                    <i class="fa fa-user"></i>
                                 </div>
                                 <p class="card-category">No Of Program Creator</p>
                                 <h3 class="card-title">{{ $program_creater_count or '' }}</h3>
                              </div>
                             <div class="card-footer">
                                 <div class="stats">
                                    <i class="material-icons">date_range</i> @if(isset($selected_year) && $selected_year!="") {{ 'Program Creator count of year -'.$selected_year }} @else {{ 'Program Creator count of all years' }}  @endif
                                 </div>
                              </div>
                           </div>
                           </a>
                        </div>
                    	<div class="col-sm-6 col-md-4 col-lg-4 col-xl-3">
                           <a href="{{ $admin_url_path }}/admin_users?user_type=supervisor">
                           <div class="card card-stats">
                              <div class="card-header card-header-warning card-header-icon">
                                 <div class="card-icon">
                                    <i class="fa fa-user-circle"></i>
                                 </div>
                                <p class="card-category">No Of Supervisor</p>
                                 <h3 class="card-title">{{ $supervisor_count or 0 }}</h3>
                              </div>
                             <div class="card-footer">
                                 <div class="stats">
                                    <i class="material-icons">date_range</i> @if(isset($selected_year) && $selected_year!="") {{ 'Supervisor count of year -'.$selected_year }} @else {{ 'Supervisor count of all years' }}  @endif
                                 </div>
                              </div>
                           </div>
                          </a>
                        </div>
                        <div class="col-sm-6 col-md-4 col-lg-4 col-xl-3">
                           <a href="{{ $admin_url_path }}/admin_users?user_type=subadmin">
                           <div class="card card-stats">
                              <div class="card-header card-header-rose card-header-icon">
                                 <div class="card-icon">
                                    <i class="fa fa-user-secret"></i>
                                 </div>
                                 <p class="card-category">No Of SubAdmin</p>
                                 <h3 class="card-title">{{ $subadmin_count or 0 }}</h3>
                              </div>
                              <div class="card-footer">
                                 <div class="stats">
                                    <i class="material-icons">date_range</i>@if(isset($selected_year) && $selected_year!="") {{ 'SubAdmin count of year -'.$selected_year }} @else {{ 'SubAdmin count of all years' }} @endif
                                 </div>
                              </div>
                           </div>
                          </a>
                        </div>
                      </div>
                     </div>
                  {{--    <h3>Registered Users</h3> --}}
                     <br>
                     <div class="graph-blocks">
                     <div class="row">
                        <div class="col-md-4">
                            <div id="pie_chart_of_registerd_users"></div>
                        </div>
                         <div class="col-md-8">
                            <div id="column_chart_transaction"></div>
                        </div>
                      <div class="clearfix"></div>
                     </div>
                     <div class="clearfix"></div>
                   </div>

                    <div class="graph-blocks">
                     <div class="row">
                      <div class="col-md-6">
                          <div class="card">
                            <div class="card-header">
                              <h4 class="card-title dashboard_title">Admin Notifications</h4>
                            </div>
                              @if(isset($arr_notifications) && sizeof($arr_notifications)>0)
                               
                                <div class="card-body notification_div">
                                   @foreach($arr_notifications as $notification)

                                  <div class="alert alert-info alert-with-icon" data-notify="container">
                                    <i class="material-icons" data-notify="icon">notifications</i>
                                        <span data-notify="icon" class="now-ui-icons ui-1_bell-53"></span>
                                        <span data-notify="message">
                                       
                                          @if(isset($notification['url']) && $notification['url']!="")
                                          <a href="{{ url('/').$notification['url'] }}">
                                          @else
                                          <a href="javascript:void(0)">
                                          @endif
                                            {{ $notification['message'] or '' }}
                                          </a>
                                         
                                        </span>
                                  </div>
                                  @endforeach
                                   <a href="{{ $admin_url_path }}/notifications">View All</a>
                                </div>
                               
                            @endif
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="card">
                            <div class="card-header">
                              <h4 class="card-title dashboard_title">Coupon Code Usage</h4>
                            </div>
                            <div class="card-body class-info-block">
                                <ul>
                                @if(isset($arr_coupen_usage) && sizeof($arr_coupen_usage)>0)
                                  @foreach($arr_coupen_usage as $usage)
                                      <a href="{{$admin_url_path}}/coupons?search_keyword={{$usage['coupon_code'] or ''}}" style="color: #000000">
                                    <li>
                                      <div class="class-titles"><strong>{{$usage['coupon_code'] or ''}}</strong> - {{ $usage['code_data']['title'] or '' }}  </div>
                                      <div class="class-count">{{ $usage['count'] or '' }}</div>
                                    </li>
                                      </a>
                                  @endforeach
                                   <a href="{{ $admin_url_path }}/coupons">View All</a>
                                @endif
                                </ul>
                            </div>
                          </div>
                        </div>

                      <div class="clearfix"></div>
                     </div>
                     <div class="clearfix"></div>
                   </div>

                  </div>
              {{--  </div> --}}
   
<input type="hidden" name="users_count" id="users_count" value="{{ $str_users or '' }}">
<input type="hidden" name="str_transaction_cny" id="str_transaction_cny" value="{{ $str_transaction_cny or '' }}">
<input type="hidden" name="str_transaction_usd" id="str_transaction_usd" value="{{ $str_transaction_usd or '' }}">
<script src="{{ url('/') }}/js/admin/canvasjs.min.js"></script>
<script type="text/javascript">
  function GetDataByYear(ref)
  { 
      location.href = '{{ $parent_module_url }}/'+ref;
  }
  window.onload = function() 
  {
      drawNoOfUsersPieChart(); 
      drawChartForTransactions();
      
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
  function drawChartForTransactions()
  {
        arr_transaction_amount = arr_transaction_cny =[];
        var str_transaction_cny    = $('#str_transaction_cny').val();
        if(str_transaction_cny!=undefined)
        {
           arr_transaction_cny= $.parseJSON(str_transaction_cny);
        }

        var data_cny = []
        for(var i=0;i<arr_transaction_cny.length;i++)
        {
            data_cny.push({
                 y: arr_transaction_cny[i].amount_cny,label:arr_transaction_cny[i].month_cny   
             });
        }
        arr_transaction_usd = data_usd = [];
        var str_transaction_usd    = $('#str_transaction_usd').val();
        if(str_transaction_usd!=undefined)
        {
           arr_transaction_usd     = $.parseJSON(str_transaction_usd);
        }
        for(var k=0;k<arr_transaction_usd.length;k++)
        {
            data_usd.push({
                 y: arr_transaction_usd[k].amount_usd,label:arr_transaction_usd[k].month_usd   
             });
        }
        
          var chart = new CanvasJS.Chart("column_chart_transaction", 
          {
              animationEnabled: true,
              title:{
                text: "Monthwise Transaction in CNY & USD {{ $selected_year or '' }}"
              },  
              axisY: {
                title: "Amount",
                titleFontColor: "#4F81BC",
                lineColor: "#4F81BC",
                labelFontColor: "#4F81BC",
                tickColor: "#4F81BC"
              },
              toolTip: {
                shared: true
              },
              legend: {
                cursor:"pointer",
                itemclick: toggleDataSeries
              },
              data: [{
                type: "column",
                 axisYindex: 0, 
                name: "Transaction Amount(CNY)",
                legendText: "Transaction Amount(CNY)",
                showInLegend: true, 
                dataPoints:data_cny
              },
              {
                type: "column", 
                 axisYindex: 1, 
                name: "Transaction Amount(USD)",
                legendText: "Transaction Amount(USD)",
                axisYType: "secondary",
                showInLegend: true,
                dataPoints:data_usd
            }]
           });
            chart.render();
       
      
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
@include('front.layout.bredcrum')
    <!-- bredcrum section end -->
    <div class="gray-btn-main-section my-student-middle-section change-program-main parent-my-proram-main">
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-md-3 col-lg-3">
                    @include('front.layout.left_bar')
                </div>
                <div class="col-sm-8 col-md-9 col-lg-9">
                    @include('front.layout._operation_status')
                    @if(isset($data['message']) && $data['message']!="")
                        {{ $data['message'] or 'No data found' }}
                    @else
                    <div class="student-report parent-dash">
                        <div class="student-info">
                            <div class="row">

                                <div class="col-sm-12 col-md-4 col-lg-4">
                                  <div class="form-group" id="year_range_div">
                                        <div class="name-field">
                                          @if(isset($arr_year_range) && sizeof($arr_year_range)>0)
                                            <select name="selected_year" onchange="getperformanceByYear(this.value)" id="selected_year">
                                                <option value="">{{trans('parent.Select_Year')}}</option>
                                              @foreach($arr_year_range as $value)
                                                <option @if(isset($default_year) && $value==$default_year) selected="" @endif value="{{ $value }}">{{ $value or '' }}</option>
                                              @endforeach
                                            </select>
                                          @endif
                                            <i class="fa fa-angle-down"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-4 col-lg-4">
                                   <div class="form-group" style="display:none" id="type_div">
                                        <div class="name-field">
                                             <select onchange="getSelectedType(this.value)" name="type" id="type">
                                               {{--  <option value=" ">Select Type</option> --}}
                                               <option @if(isset($selected_type) && $selected_type=='daily') selected="" @endif value="daily">{{trans('parent.Daily')}}</option>
                                               <option @if(isset($selected_type) && $selected_type=='weekly') selected="" @endif value="weekly">{{trans('parent.Weekly')}}</option>
                                               <option @if(isset($selected_type) && $selected_type=='monthly') selected="" @endif value="monthly" >{{trans('parent.Monthly')}}</option>
                                               <option @if(isset($selected_type) && $selected_type=='yearly') selected="" @endif value="yearly">{{trans('parent.Yearly')}}</option>
                                             </select>
                                            <i class="fa fa-angle-down"></i>
                                        </div>
                                    </div>
                                    </div>
                            </div>
                        </div>
     
                        <div class="report-blocks-section">
                           <div class="col-sm-4 col-md-4 col-lg-4 pad-0">
                                <div class="report-block ans-question">
                                    <div class="icon-block">&nbsp;</div>
                                    <div class="text-block">
                                        <h2>{{ $arr_program_count['total_answered_count'] or '' }}</h2>
                                        <p>{{trans('parent.Total_Answered_Programs')}}</p>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-4 col-lg-4 pad-0">
                                <div class="report-block pending-question">
                                    <div class="icon-block">&nbsp;</div>
                                    <div class="text-block">
                                        <h2>{{ $arr_program_count['total_pending_count'] or 0 }}</h2>
                                        <p>{{trans('parent.Total_Pending_Programs')}}</p>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-4 col-lg-4 pad-0">
                                <div class="report-block time-spent">
                                    <div class="icon-block">&nbsp;</div>
                                    <div class="text-block">
                                        <h2>{{ $total_time_spent->time or 0 }}</h2><span>{{trans('parent.Hours')}}</span>
                                        <p>{{trans('parent.Time_Spent')}}</p>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
               
                        <div class="students-grade-section">
                            <div class="col-sm-12 col-md-4 col-lg-4 pad-0">
                                <div class="stud-grade-block">
                                    <h4>{{trans('parent.Performance_Assessment')}}</h4>
                                    <?php
                                    $grade = isset($arr_data['arr_student_data']['student_grade'])?$arr_data['arr_student_data']['student_grade']:'';  

                                    switch ($grade) {
                                          case "A+":
                                              $class = 'green';
                                              break;
                                          case "A":
                                              $class = 'light-green';
                                              break;
                                          case "B":
                                              $class = 'blue';
                                              break;
                                          case "C":
                                              $class = 'yellow';
                                              break;
                                          case "D":
                                              $class = 'gray';
                                              break;
                                          default:
                                              $class = 'green';
                                      }
                                    
                                    ?>

                                    <div class="grade-ring {{$class}}">@if($grade=='A+') A<sup>+</sup>@else {{$grade}} @endif </div>
                                    <div class="std-points {{$class}}">
                                         <span>{{ $arr_data['arr_student_data']['student_total_points'] or 0 }}
                                         </span> {{trans('parent.Points')}}
                                    </div>
                                   {{--  <div class="grade-list std-grade">
                                        <ul>
                                            <li><div class="color-div green"></div><span>A<sup>+</sup></span></li>
                                            <li><div class="color-div light-green"></div><span>A</span></li>
                                            <li><div class="color-div blue"></div><span>B</span></li>
                                            <li><div class="color-div yellow"></div><span>C</span></li>
                                            <li><div class="color-div gray"></div><span>D</span></li>
                                        </ul>
                                    </div> --}}
                                </div>
                            </div>
            
                            <div class="col-sm-12 col-md-4 col-lg-4 pad-0">
                                <div class="stud-grade-block avg-performance">
                                         <?php
                                          $value = isset($arr_data['arr_student_data']['student_total_points'])?$arr_data['arr_student_data']['student_total_points']:'';
                                          $high = isset($arr_data['arr_student_data']['arr_avg_class_points']['high'])?$arr_data['arr_student_data']['arr_avg_class_points']['high']:'';

                                          $avg  = isset($arr_data['arr_student_data']['arr_avg_class_points']['avg'])?$arr_data['arr_student_data']['arr_avg_class_points']['avg']:'';

                                          $low  = isset($arr_data['arr_student_data']['arr_avg_class_points']['low'])?$arr_data['arr_student_data']['arr_avg_class_points']['low']:'';
                                          ?>
                                          @if($value >= $high)
                                            <?php $class = 'light-green';  ?>
                                          @elseif(($value < $high) && ($value > $avg))
                                            <?php $class = 'orange';  ?>
                                          @elseif(($value <= $low))
                                            <?php $class = 'gray';  ?>
                                          @endif
                                    <h4>{{trans('parent.Class_Comparative_Analysis')}}</h4>
                                    <div class="grade-ring {{ $class }}">{{ $arr_data['arr_student_data']['student_total_points'] or ''}}<span>{{trans('parent.Points')}}</span></div>
                                    <div class="grade-list">
                                         <ul>
                                            <li><span>{{trans('parent.High')}}</span><div class="color-div light-green"></div><span>
                                          {{ $high or '' }}</span></li>
                                          <li><span>{{trans('parent.Average')}}</span><div class="color-div orange"></div><span>
                                          {{ $avg or '' }}</span></li>
                                          <li><span>{{trans('parent.Low')}}</span><div class="color-div gray"></div><span>{{ $low or '' }}</span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                         
                            <div class="col-sm-12 col-md-4 col-lg-4 pad-0">
                                <div class="stud-grade-block avg-performance">
                                    <h4>{{trans('parent.Global_Comparative_Analysis')}}</h4>
                                         <?php
                                          $value = isset($arr_data['arr_student_data']['student_total_points'])?$arr_data['arr_student_data']['student_total_points']:'';
                                          $high = isset($arr_data['arr_student_data']['arr_avg_global_points']['high'])?$arr_data['arr_student_data']['arr_avg_global_points']['high']:'';

                                          $avg  = isset($arr_data['arr_student_data']['arr_avg_global_points']['avg'])?$arr_data['arr_student_data']['arr_avg_global_points']['avg']:'';

                                          $low  = isset($arr_data['arr_student_data']['arr_avg_global_points']['low'])?$arr_data['arr_student_data']['arr_avg_global_points']['low']:'';
                                          ?>  
                                          @if($value >= $high)
                                            <?php $class = 'light-green';  ?>
                                          @elseif(($value < $high) && ($value > $avg))
                                            <?php $class = 'orange';  ?>
                                          @elseif(($value <= $low))
                                            <?php $class = 'gray';  ?>
                                          @endif

                                    <div class="grade-ring {{ $class }}">{{ $arr_data['arr_student_data']['student_total_points'] or ''}}<span>{{trans('parent.Points')}}</span></div>
                                    <div class="grade-list">
                                        <ul>
                                            <li><span>{{trans('parent.High')}}</span><div class="color-div light-green"></div><span>
                                          {{ $high or '' }}</span></li>
                                          <li><span>{{trans('parent.Average')}}</span><div class="color-div orange"></div><span>
                                          {{ $avg or '' }}</span></li>
                                          <li><span>{{trans('parent.Low')}}</span><div class="color-div gray"></div><span>{{ $low or '' }}</span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="students-progress-graph">
                      <h4>{{trans('parent.Student_Progress')}}</h4>
                       <div id="chart-container"></div>
                       <input type="hidden" name="chart_stud_performance" value="{{ $arr_data['str_student_performance'] or 0 }}" id="chart_stud_performance"> 
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="{{url('/')}}/js/front/charts/fusioncharts.js"></script>
    <script type="text/javascript" src="{{url('/')}}/js/front/charts/fusioncharts.theme.fusion.js"></script>
    <script type="text/javascript" src="{{url('/')}}/js/front/charts/fusioncharts.jqueryplugin.min.js"></script>
    <style type="text/css"> g[class^='raphael-group-'][class$='-creditgroup'] { display:none !important;} </style>
    <script type="text/javascript">
    $(document).ready(function(){

       var selected_year = $('#selected_year').val();
       var current_year = '{{ $current_year }}';
        if(selected_year==current_year)
        {
           $('#type_div').show();
        }
        else
        {
           $('#type_div').hide();
        }

       var stud_performance_str = $('#chart_stud_performance').val();
        $("#chart-container").insertFusionCharts({
       type: "mscolumn2d",
       width: "100%",
       height: "100%",
       dataFormat: "json",
       dataSource: stud_performance_str
    });

    })
   
    function getSelectedType(type)
    {
        var enc_class_id     = '{{ $enc_class_id }}';
        var enc_student_id   = '{{ $enc_student_id }}';
        var type             = $('#type').val();
        var selected_year    = $('#selected_year').val();
        location.href= '{{ $module_url_path }}/student_report/'+enc_class_id+'/'+enc_student_id+'/'+type+'/'+selected_year;
      
    }
    function getperformanceByYear(year)
    {
        var enc_class_id     = '{{ $enc_class_id }}';
        var enc_student_id   = '{{ $enc_student_id }}';
        var current_year = '{{ $current_year }}';
        var type = $('#type').val();
        if(year==current_year)
        {
           $('#type_div').show();
           location.href= '{{ $module_url_path }}/student_report/'+enc_class_id+'/'+enc_student_id+'/'+type+'/'+year;
        }
        else
        {
          $('#type_div').hide();
          location.href= '{{ $module_url_path }}/student_report/'+enc_class_id+'/'+enc_student_id+'/'+'yearly/'+year;
        }
    }
  
    </script>
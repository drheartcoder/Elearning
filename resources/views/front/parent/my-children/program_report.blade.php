<!--select css-->
<link rel="stylesheet" type="text/css" href="{{ url('/') }}/css/front/select2.min.css"/>  
<!-- bredcrum section -->
<div class="bredcrum-section-main">
    <div class="container">
        <div class="page-title-main">
            {{$pageTitle}}
        </div>
        <div class="page-bredcrum-section">
            <ul>
                <li><a href="{{ url('/') }}/parent/dashboard">{{trans('parent.Dashboard')}}</a> &nbsp;&nbsp; <i class="fa fa-angle-right"></i> &nbsp;&nbsp; </li>
                <li>{{$pageTitle}}</li>
            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<!-- bredcrum section end -->
        <div class="gray-btn-main-section my-student-middle-section change-program-main parent-my-proram-main">
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-md-3 col-lg-3">
                    @include('front.layout.left_bar')
                </div>
                <div class="col-sm-8 col-md-9 col-lg-9">
                    @include('front.layout._operation_status')
                    <div class="student-report parent-side">
                        <div class="student-info">
                            <div class="row">
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <p><b>{{trans('parent.Kid_Name')}} :</b> {{$student_name}}</p>
                                    <!-- <p><b>Class :</b> A</p> -->
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                @if(isset($arr_all_programs) && count($arr_all_programs)>0)
                                   <div class="form-group">
                                        <div class="name-field">
                                            <select class="program_select" id="program_select" name="program_select">
                                                @foreach($arr_all_programs as $key => $value)
                                                    <option @if($value['program_details']['slug']==$slug) selected="" @endif value="{{$value['program_details']['slug']}}">{{isset($value['program_details']['name']) && $value['program_details']['name']!='' ? ucwords($value['program_details']['name']) : "N/A"}}</option>
                                                @endforeach
                                            </select>
                                            <i class="fa fa-angle-down"></i>
                                        </div>
                                    </div>
                                @endif
                                </div>
                            </div>
                        </div>
                        <div class="report-blocks-section dash-blocks">
                           <div class="col-sm-4 col-md-4 col-lg-4 pad-0">
                                <div class="report-block ans-question">
                                    <div class="icon-block">&nbsp;</div>
                                    <div class="text-block">
                                        <h2>{{$answered_question_count}}</h2>
                                        <p>{{trans('parent.Answered')}} <br> {{trans('parent.Question')}}</p>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-4 col-lg-4 pad-0">
                                <div class="report-block pending-question">
                                    <div class="icon-block">&nbsp;</div>
                                    <div class="text-block">
                                        <h2>{{$pending_question_count}}</h2>
                                        <p>{{trans('parent.Pending')}} <br> {{trans('parent.Question')}}</p>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-4 col-lg-4 pad-0">
                                <div class="report-block time-spent">
                                    <div class="icon-block">&nbsp;</div>
                                    <div class="text-block">
                                        <h2>{{date('H:i:s',strtotime($total_time))}}</h2> <span>{{trans('parent.Hours')}}</span>
                                        <p>{{trans('parent.Time_Spent')}}</p>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        
                    </div>
                    @php
                        // Report B Calculations
                        $report_b_student_performace_points = isset($report_b['student_performace_points']) && $report_b['student_performace_points']!='' ? round($report_b['student_performace_points']) : 0;
                        $report_b_class_average_performace = isset($report_b['class_average_performace']) && $report_b['class_average_performace']!='' ? round($report_b['class_average_performace']) : 0;
                        $report_b_global_average_performace = isset($report_b['global_average_performace']) && $report_b['global_average_performace']!='' ? round($report_b['global_average_performace']) : 0;
                        $report_b_grade = isset($report_b['grade']) && $report_b['grade']!='' ? $report_b['grade'] : "D";
                        
                        $report_b_class_average_high = isset($report_b['class_average_slabs']['high']) && $report_b['class_average_slabs']['high']!='' ? $report_b['class_average_slabs']['high'] : "0";
                        $report_b_class_average_average = isset($report_b['class_average_slabs']['average']) && $report_b['class_average_slabs']['average']!='' ? $report_b['class_average_slabs']['average'] : "0";
                        $report_b_class_average_low = isset($report_b['class_average_slabs']['low']) && $report_b['class_average_slabs']['low']!='' ? $report_b['class_average_slabs']['low'] : "0";

                        $report_b_global_average_high = isset($report_b['global_average_slabs']['high']) && $report_b['global_average_slabs']['high']!='' ? $report_b['global_average_slabs']['high'] : "0";
                        $report_b_global_average_average = isset($report_b['global_average_slabs']['average']) && $report_b['global_average_slabs']['average']!='' ? $report_b['global_average_slabs']['average'] : "0";
                        $report_b_global_average_low = isset($report_b['global_average_slabs']['low']) && $report_b['global_average_slabs']['low']!='' ? $report_b['global_average_slabs']['low'] : "0";
                        
                        if($report_b_student_performace_points >= $report_b_class_average_high)
                        {
                            $report_b_avg_class = 'light-green';
                        }
                        else if($report_b_student_performace_points >= $report_b_class_average_average)
                        {
                            $report_b_avg_class = 'orange';
                        }
                        else if($report_b_student_performace_points >= $report_b_class_average_low)
                        {
                            $report_b_avg_class = 'gray';
                        }
                        else
                        {
                            $report_b_avg_class = 'gray';
                        }

                        if($report_b_student_performace_points >= $report_b_global_average_high)
                        {
                            $report_b_global_class = 'light-green';
                        }
                        else if($report_b_student_performace_points >= $report_b_global_average_average)
                        {
                            $report_b_global_class = 'orange';
                        }
                        else if($report_b_student_performace_points >= $report_b_global_average_low)
                        {
                            $report_b_global_class = 'gray';
                        }
                        else
                        {
                            $report_b_global_class = 'gray';
                        }                        

                        switch($report_b_grade)
                        {
                            case "A+" : 
                                $reportB_class = "green";
                                break;
                            case "A" : 
                                $reportB_class = "light-green";
                                break;
                            case "B" : 
                                $reportB_class = "blue";
                                break;
                            case "C" : 
                                $reportB_class = "yellow";
                                break;
                            case "D" : 
                                $reportB_class = "gray";
                                break;
                            default : 
                                $reportB_class = "gray"; 
                                break;
                        }

                        // Report C Calculations
                        $report_c_student_performace_points = isset($report_c['student_performace_points']) && $report_c['student_performace_points']!='' ? round($report_c['student_performace_points']) : 0;
                        $report_c_class_average_performace = isset($report_c['class_average_performace']) && $report_c['class_average_performace']!='' ? round($report_c['class_average_performace']) : 0;
                        $report_c_global_average_performace = isset($report_c['global_average_performace']) && $report_c['global_average_performace']!='' ? round($report_c['global_average_performace']) : 0;
                        $report_c_grade = isset($report_c['grade']) && $report_c['grade']!='' ? $report_c['grade'] : "D";

                        $report_c_class_average_high = isset($report_c['class_average_slabs']['high']) && $report_c['class_average_slabs']['high']!='' ? $report_c['class_average_slabs']['high'] : "0";
                        $report_c_class_average_average = isset($report_c['class_average_slabs']['average']) && $report_c['class_average_slabs']['average']!='' ? $report_c['class_average_slabs']['average'] : "0";
                        $report_c_class_average_low = isset($report_c['class_average_slabs']['low']) && $report_c['class_average_slabs']['low']!='' ? $report_c['class_average_slabs']['low'] : "0";

                        $report_c_global_average_high = isset($report_c['global_average_slabs']['high']) && $report_c['global_average_slabs']['high']!='' ? $report_c['global_average_slabs']['high'] : "0";
                        $report_c_global_average_average = isset($report_c['global_average_slabs']['average']) && $report_c['global_average_slabs']['average']!='' ? $report_c['global_average_slabs']['average'] : "0";
                        $report_c_global_average_low = isset($report_c['global_average_slabs']['low']) && $report_c['global_average_slabs']['low']!='' ? $report_c['global_average_slabs']['low'] : "0";

                        if($report_c_student_performace_points >= $report_c_class_average_high)
                        {
                            $report_c_avg_class = 'light-green';
                        }
                        else if($report_c_student_performace_points >= $report_c_class_average_average)
                        {
                            $report_c_avg_class = 'orange';
                        }
                        else if($report_c_student_performace_points >= $report_c_class_average_low)
                        {
                            $report_c_avg_class = 'gray';
                        }
                        else
                        {
                            $report_c_avg_class = 'gray';
                        }

                        if($report_c_student_performace_points >= $report_c_global_average_high)
                        {
                            $report_c_global_class = 'light-green';
                        }
                        else if($report_c_student_performace_points >= $report_c_global_average_average)
                        {
                            $report_c_global_class = 'orange';
                        }
                        else if($report_c_student_performace_points >= $report_c_global_average_low)
                        {
                            $report_c_global_class = 'gray';
                        }
                        else
                        {
                            $report_c_global_class = 'gray';
                        }                        

                        switch($report_c_grade)
                        {
                            case "A+" : 
                                $reportC_class = "green";
                                break;
                            case "A" : 
                                $reportC_class = "light-green";
                                break;
                            case "B" : 
                                $reportC_class = "blue";
                                break;
                            case "C" : 
                                $reportC_class = "yellow";
                                break;
                            case "D" : 
                                $reportC_class = "gray";
                                break;
                            default : 
                                $reportC_class = "gray"; 
                                break;
                        }
                        // Report D Calculations
                        $report_d_student_performace_points = isset($report_d['student_performace_points']) && $report_d['student_performace_points']!='' ? round($report_d['student_performace_points']) : 0;
                        $report_d_class_average_performace = isset($report_d['class_average_performace']) && $report_d['class_average_performace']!='' ? round($report_d['class_average_performace']) : 0;
                        $report_d_global_average_performace = isset($report_d['global_average_performace']) && $report_d['global_average_performace']!='' ? round($report_d['global_average_performace']) : 0;
                        $report_d_grade = isset($report_d['grade']) && $report_d['grade']!='' ? $report_d['grade'] : "D";

                        $report_d_class_average_high = isset($report_d['class_average_slabs']['high']) && $report_d['class_average_slabs']['high']!='' ? $report_d['class_average_slabs']['high'] : "0";
                        $report_d_class_average_average = isset($report_d['class_average_slabs']['average']) && $report_d['class_average_slabs']['average']!='' ? $report_d['class_average_slabs']['average'] : "0";
                        $report_d_class_average_low = isset($report_d['class_average_slabs']['low']) && $report_d['class_average_slabs']['low']!='' ? $report_d['class_average_slabs']['low'] : "0";

                        $report_d_global_average_high = isset($report_d['global_average_slabs']['high']) && $report_d['global_average_slabs']['high']!='' ? $report_d['global_average_slabs']['high'] : "0";
                        $report_d_global_average_average = isset($report_d['global_average_slabs']['average']) && $report_d['global_average_slabs']['average']!='' ? $report_d['global_average_slabs']['average'] : "0";
                        $report_d_global_average_low = isset($report_d['global_average_slabs']['low']) && $report_d['global_average_slabs']['low']!='' ? $report_d['global_average_slabs']['low'] : "0";

                        if($report_d_student_performace_points >= $report_d_class_average_high)
                        {
                            $report_d_avg_class = 'light-green';
                        }
                        else if($report_d_student_performace_points >= $report_d_class_average_average)
                        {
                            $report_d_avg_class = 'orange';
                        }
                        else if($report_d_student_performace_points >= $report_d_class_average_low)
                        {
                            $report_d_avg_class = 'gray';
                        }
                        else
                        {
                            $report_d_avg_class = 'gray';
                        }

                        if($report_d_student_performace_points >= $report_d_global_average_high)
                        {
                            $report_d_global_class = 'light-green';
                        }
                        else if($report_d_student_performace_points >= $report_d_global_average_average)
                        {
                            $report_d_global_class = 'orange';
                        }
                        else if($report_d_student_performace_points >= $report_d_global_average_low)
                        {
                            $report_d_global_class = 'gray';
                        }
                        else
                        {
                            $report_d_global_class = 'gray';
                        }

                        switch($report_d_grade)
                        {
                            case "A+" : 
                                $reportD_class = "green";
                                break;
                            case "A" : 
                                $reportD_class = "light-green";
                                break;
                            case "B" : 
                                $reportD_class = "blue";
                                break;
                            case "C" : 
                                $reportD_class = "yellow";
                                break;
                            case "D" : 
                                $reportD_class = "gray";
                                break;
                            default : 
                                $reportD_class = "gray";
                                $report_d_avg_class = 'gray';
                                $report_d_global_class = 'gray';                                 
                                break;
                        }

                        //Total Points
                        $total_points = ($report_b_student_performace_points + $report_c_student_performace_points + $report_d_student_performace_points);
                    @endphp
                    <div class="score-board">
                       <div class="score-title">{{trans('parent.Summative_Assessment')}}</div>
                        <div class="students-grade-section">
                            <div class="col-sm-12 col-md-4 col-lg-4 pad-0">
                                <div class="stud-grade-block">
                                    <h4>{{trans('parent.Performance_Assessment')}}</h4>
                                    <div class="grade-ring {{$reportB_class}}"> @if($report_b_grade=="A+")<span>A<sup>+</sup> @else {{$report_b_grade}} @endif</div>
                                    <div class="std-points {{$reportB_class}}">
                                         <span>{{ $report_b_student_performace_points }}</span> {{trans('parent.Points')}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4 pad-0">
                                <div class="stud-grade-block avg-performance">
                                    <h4>{{trans('parent.Class_Comparative_Analysis')}}</h4>
                                    <div class="grade-ring {{$report_b_avg_class}}">{{ $report_b_student_performace_points }} <span>{{trans('parent.Points')}}</span></div>
                                    <div class="grade-list">
                                        <ul>
                                            <li><span>{{trans('parent.High')}}</span><div class="color-div light-green"></div><span>{{$report_b_class_average_high}}</span></li>
                                            <li><span>{{trans('parent.Average')}}</span><div class="color-div orange"></div><span>{{$report_b_class_average_average}}</span></li>
                                            <li><span>{{trans('parent.Low')}}</span><div class="color-div gray"></div><span>{{$report_b_class_average_low}}</span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4 pad-0">
                                <div class="stud-grade-block avg-performance">
                                    <h4>{{trans('parent.Global_Comparative_Analysis')}}</h4>
                                    <div class="grade-ring {{$report_b_global_class}}">{{ $report_b_student_performace_points }} <span>{{trans('parent.Points')}}</span></div>
                                    <div class="grade-list">
                                        <ul>
                                            <li><span>{{trans('parent.High')}}</span><div class="color-div light-green"></div><span>{{$report_b_global_average_high}}</span></li>
                                            <li><span>{{trans('parent.Average')}}</span><div class="color-div orange"></div><span>{{$report_b_global_average_average}}</span></li>
                                            <li><span>{{trans('parent.Low')}}</span><div class="color-div gray"></div><span>{{$report_b_global_average_low}}</span></li>
                                        </ul>

                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="score-board">
                       <div class="score-title">{{trans('parent.Quantitative_Assessment')}}</div>
                        <div class="students-grade-section">
                            <div class="col-sm-12 col-md-4 col-lg-4 pad-0">
                                <div class="stud-grade-block">
                                    <h4>{{trans('parent.Performance_Assessment')}}</h4>
                                    <div class="grade-ring {{$reportC_class}}"> @if($report_c_grade=="A+")<span>A<sup>+</sup> @else {{$report_c_grade}} @endif</div>
                                    <div class="std-points {{$reportC_class}}">
                                         <span>{{ $report_c_student_performace_points }}</span> {{trans('parent.Points')}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4 pad-0">
                                <div class="stud-grade-block avg-performance">
                                    <h4>{{trans('parent.Class_Comparative_Analysis')}}</h4>
                                    <div class="grade-ring {{$report_c_avg_class}}">{{ $report_c_student_performace_points }} <span>{{trans('parent.Points')}}</span></div>
                                    <div class="grade-list">
                                        <ul>
                                            <li><span>{{trans('parent.High')}}</span><div class="color-div light-green"></div><span>{{$report_c_class_average_high}}</span></li>
                                            <li><span>{{trans('parent.Average')}}</span><div class="color-div orange"></div><span>{{$report_c_class_average_average}}</span></li>
                                            <li><span>{{trans('parent.Low')}}</span><div class="color-div gray"></div><span>{{$report_c_class_average_low}}</span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4 pad-0">
                                <div class="stud-grade-block avg-performance">
                                    <h4>{{trans('parent.Global_Comparative_Analysis')}}</h4>
                                    <div class="grade-ring {{$report_c_global_class}}">{{ $report_c_student_performace_points }} <span>{{trans('parent.Points')}}</span></div>
                                    <div class="grade-list">
                                        <ul>
                                            <li><span>{{trans('parent.High')}}</span><div class="color-div light-green"></div><span>{{$report_c_global_average_high}}</span></li>
                                            <li><span>{{trans('parent.Average')}}</span><div class="color-div orange"></div><span>{{$report_c_global_average_average}}</span></li>
                                            <li><span>{{trans('parent.Low')}}</span><div class="color-div gray"></div><span>{{$report_c_global_average_low}}</span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="score-board">
                       <div class="score-title">{{trans('parent.Challenge_Program_Assessment')}}</div>
                        <div class="students-grade-section">
                            <div class="col-sm-12 col-md-4 col-lg-4 pad-0">
                                <div class="stud-grade-block">
                                    <h4>{{trans('parent.Performance_Assessment')}}</h4>
                                    <div class="grade-ring {{$reportD_class}}"> @if($report_d_grade=="A+")<span>A<sup>+</sup> @else {{$report_d_grade}} @endif</div>
                                    <div class="std-points {{$reportD_class}}">
                                         <span>{{ $report_d_student_performace_points }}</span> {{trans('parent.Points')}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4 pad-0">
                                <div class="stud-grade-block avg-performance">
                                    <h4>{{trans('parent.Class_Comparative_Analysis')}}</h4>
                                    <div class="grade-ring {{$report_d_avg_class}}">{{ $report_d_student_performace_points }} <span>{{trans('parent.Points')}}</span></div>
                                    <div class="grade-list">
                                        <ul>
                                            <li><span>{{trans('parent.High')}}</span><div class="color-div light-green"></div><span>{{$report_d_class_average_high}}</span></li>
                                            <li><span>{{trans('parent.Average')}}</span><div class="color-div orange"></div><span>{{$report_d_class_average_average}}</span></li>
                                            <li><span>{{trans('parent.Low')}}</span><div class="color-div gray"></div><span>{{$report_d_class_average_low}}</span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4 pad-0">
                                <div class="stud-grade-block avg-performance">
                                    <h4>{{trans('parent.Global_Comparative_Analysis')}}</h4>
                                    <div class="grade-ring {{$report_d_global_class}}">{{ $report_d_student_performace_points }} <span>{{trans('parent.Points')}}</span></div>
                                    <div class="grade-list">
                                        <ul>
                                            <li><span>{{trans('parent.High')}}</span><div class="color-div light-green"></div><span>{{$report_d_global_average_high}}</span></li>
                                            <li><span>{{trans('parent.Average')}}</span><div class="color-div orange"></div><span>{{$report_d_global_average_average}}</span></li>
                                            <li><span>{{trans('parent.Low')}}</span><div class="color-div gray"></div><span>{{$report_d_global_average_low}}</span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="students-progress-graph std-program-graph">
                      <!-- <h4>Program Performance</h4> -->
                       <div class="row">
                           <div class="col-sm-12 col-md-8 col-lg-8">
                                <div id="chart-container" class="chart-container"></div>
                                <input type="hidden" name="program_chart" id="program_chart" value="{{$program_chart}}">
                           </div>
                           <div class="col-sm-12 col-md-4 col-lg-4">
                               <div class="total-points">{{trans('parent.Total_Points')}} <h2>{{round($total_points)}}</h2></div>
                           </div>
                       </div>
<!--                        <div class="graph-info-list">
                           <ul>
                               <li><div class="color-div green">&nbsp;</div> Report A</li>
                               <li><div class="color-div orange">&nbsp;</div> Report B</li>
                               <li><div class="color-div red">&nbsp;</div> Report C</li>
                               <li><div class="color-div blue">&nbsp;</div> Report D</li>
                           </ul>
                       </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{url('/')}}/js/front/charts/fusioncharts.js"></script>
    <script type="text/javascript" src="{{url('/')}}/js/front/charts/fusioncharts.theme.fusion.js"></script>
    <script type="text/javascript" src="{{url('/')}}/js/front/charts/fusioncharts.jqueryplugin.min.js"></script>
    <script type="text/javascript" src="{{ url('/') }}/js/front/select2.min.js"></script>        
    <style type="text/css"> g[class^='raphael-group-'][class$='-creditgroup'] { display:none !important;} </style>
    <script type="text/javascript">
         $(document).ready(function(){
           $('.program_select').select2();
         });

        $('.program_select').on('change',function(){
            var program = $.trim($(this).val());
            var enc_student_id = '{{$enc_student_id}}';
            if(program!='')
            {
                var redirect_url = SITE_URL+'/parent/program-report/'+program+'/'+enc_student_id;
                window.location.href = redirect_url;
            }
        });

        $(document).ready(function(){
           var program_chart = $('#program_chart').val();
            $("#chart-container").insertFusionCharts({
            type: "column2d",
            width: "100%",
            height: "100%",
            dataFormat: "json",
            dataSource: program_chart
            });
        });
    </script>
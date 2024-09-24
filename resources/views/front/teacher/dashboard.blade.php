 
@include('front.layout.bredcrum')
    <!-- bredcrum section end -->
    <div class="gray-btn-main-section my-student-middle-section change-program-main parent-my-proram-main">
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-md-3 col-lg-3">
                    @include('front.layout.teacher_left_bar')
                </div>
                <div class="col-sm-8 col-md-9 col-lg-9">
                    @include('front.layout._operation_status')
                    @if(isset($message) && $message!="")
                        {{ $message }}
                    @else
                    <div class="student-report">

     
                        <div class="report-blocks-section">
                          <a href="{{ $module_url_path }}/class">
                           <div class="col-sm-4 col-md-4 col-lg-4 pad-0">
                                <div class="report-block ans-question">
                                    <div class="icon-block">&nbsp;</div>
                                    <div class="text-block">
                                        <h2>{{ $class_count or 0 }}</h2>
                                        <p>{{trans('teacher.Total_Class')}}</p>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                         </a>
                            <div class="col-sm-4 col-md-4 col-lg-4 pad-0">
                                <div class="report-block pending-question">
                                    <div class="icon-block">&nbsp;</div>
                                    <div class="text-block">
                                        <h2>{{ $student_count or 0 }}</h2>
                                        <p>{{trans('teacher.Total_Student')}}</p>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-4 col-lg-4 pad-0">
                                <div class="report-block time-spent">
                                    <div class="icon-block">&nbsp;</div>
                                    <div class="text-block">
                                        <h2>{{ $transfer_count or 0 }}</h2>
                                        <p>{{trans('teacher.Total_Transfered')}}</p>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>

                    </div>
                    <div class="students-progress-graph">
                      <h4>{{trans('teacher.Class_Wise_Report')}}</h4>
                       <div id="chart-container"></div>
                       <input type="hidden" name="arr_json_student_class" value="{{ $str_class_wise_student or json_encode(array()) }}" id="arr_json_student_class"> 
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

           var arr_json_student_class = $('#arr_json_student_class').val();
            $("#chart-container").insertFusionCharts({
           type: "mscolumn2d",
           width: "100%",
           height: "100%",
           dataFormat: "json",
           dataSource: arr_json_student_class
    });
  });

    </script>
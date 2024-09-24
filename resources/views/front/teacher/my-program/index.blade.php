@include('front.layout.bredcrum')

<div class="gray-btn-main-section my-student-middle-section change-program-main">
    <div class="container">            
        <div class="row">
            <div class="col-sm-4 col-md-3 col-lg-3">
                
                @include('front.layout.left_bar')

            </div>

            @php
                $first_name = isset($arr_student['first_name']) && !empty($arr_student['first_name']) ? ucfirst($arr_student['first_name']) : '';
                $last_name  = isset($arr_student['last_name']) && !empty($arr_student['last_name']) ? ucfirst($arr_student['last_name']) : '';
            @endphp

            <div class="col-sm-8 col-md-9 col-lg-9">

                @include('front.layout._operation_status') 

                <div class="class-name-head-section">
                    {{ $first_name.' '.$last_name }}
                </div>
                
                
                    <div class="row responsive-margin">

                        <form id="form_teacher_change_program" method="post" action="{{ url('/') }}/teacher/my-student/change-program">
                        {{ csrf_field() }}

                            <input type="hidden" name="enc_class_id"   value="{{ $enc_class_id   }}" />
                            <input type="hidden" name="enc_student_id" value="{{ $enc_student_id }}" />

                            <div class="col-sm-6 col-md-4 col-lg-4 p-r-5">
                                <div class="form-group">
                                    <div class="name-field">
                                        <select id="change_program" name="change_program">
                                            @if(isset($arr_program) && !empty($arr_program))
                                                <option value="">{{trans('parent.Change_Program')}}</option>
                                                @foreach($arr_program as $program)
                                                    <option value="{{ $program['id'] }}">{{ $program['name'] }}</option>
                                                @endforeach
                                            @else
                                                <option value="">{{trans('teacher.No_Program')}}</option>
                                            @endif
                                        </select>
                                        <i class="fa fa-angle-down"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4 col-md-4 col-lg-4 p-l-5 tab-view-pl-change">
                                <div class="change-program-cancel-done-btn">
                                    <button type="submit" id="btn_submit_teacher_change_program" class="full-fill-button sim-button">{{trans('parent.Change')}}</button>
                                </div>
                            </div>

                        </form>

                        <div class="clr"></div>
						<div class="col-sm-12 col-md-9 col-lg-10">
                       		<form id="form_teacher_search_program" method="get">
                       			<div class="row">
									<div class="col-sm-6 col-md-4 col-lg-3 p-r-5">
										<div class="form-group">
											<div class="name-field calendar-section">
											<input type="text" class="form-control" name="keyword" id="teacher_search_program_keyword" placeholder="{{trans('parent.Program_Name')}}" value="{{ $keyword }}" maxlength="50" />
											</div>
										</div>
									</div>
									<div class="col-sm-6 col-md-4 col-lg-3 p-r-5">
										<div class="form-group">
											<div class="name-field calendar-section">
											<input type="text" class="form-control" name="search" id="teacher_search_program_date" placeholder="{{trans('teacher.Select_Date')}}" value="{{ $serach_date }}" readonly />
												<i class="fa fa-calendar"></i>
											</div>
										</div>
									</div>
									<div class="col-sm-6 col-md-3 col-lg-2">
										<div class="inline-btns">
										<button type="submit" id="btn_submit_teacher_search_program" class="full-orng-btn btn-width-adjustment sim-button m-0"><i class="fa fa-search"></i></button>
										<a href="{{ $cancel_link }}" class="full-orng-btn btn-width-adjustment sim-button m-0"><i class="fa fa-retweet"></i></a>
										</div>
									</div>
                           		</div>
                            </form>
						</div>	
                        <div class="col-sm-12 col-md-3 col-lg-2">
                            <div class="float-right">
                                <button type="button" id="btn_export_data" class="full-orng-btn btn-width-adjustment sim-button m-0"><i class="fas fa-file-excel"></i> {{trans('parent.Export')}}</button>
                            </div>
                        </div>

                    </div>


                <div class="table-responsive table-scroll-section">
                    <table class="table students-list-section">                            
                        <tr>
                            <th>{{trans('parent.Program_Name')}}</th>
                            <th>{{trans('parent.Assigned_Date')}}</th>
                            <th>{{trans('parent.Right')}}</th>
                            <th>{{trans('parent.Wrong')}}</th>
                            <th>{{trans('parent.Delay')}}</th>
                            <th>{{trans('parent.Status')}}</th>
                            <th>{{trans('parent.Homework')}}</th>
                            <th>{{trans('parent.Report')}}</th>
                        </tr>
                        
                        @if(isset($arr_student_program['data']) && !empty($arr_student_program['data']))
                            @foreach($arr_student_program['data'] as $key => $student_program)
                                <tr>
                                    <td>{{ $student_program['program_details']['name'] }}</td>
                                    <td>{{ date('d M Y',strtotime($student_program['created_at'])) }}</td>
                                    <td>
                                        @if($student_program['program_status']=='Completed')
                                            {{$student_program['right_percentage']}}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        @if($student_program['program_status']=='Completed')
                                            {{$student_program['wrong_percentage']}}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        @if($student_program['program_status']=='Completed')
                                            {{$student_program['delay_percentage']}}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        @if($student_program['program_status']=='Completed')
                                            <span class="status-label green-label">{{trans('parent.Completed')}}</span>
                                        @else
                                            <span class="status-label red-label">{{trans('parent.Pending')}}</span>
                                        @endif
                                    </td>
                                    <td style="text-align:center;"><a class="student-list-trash-btn" href="{{ url('/') }}/teacher/homework/{{ $enc_class_id }}/{{ base64_encode($student_program['program_details']['id']) }}"><i class="fas fa-book"></i></a></td>
                                    <td style="text-align:center;">
                                        @if($student_program['program_status']=='Completed')
                                            <a class="student-list-trash-btn" href="{{ url('/') }}/teacher/my-student/{{$enc_class_id}}/program-report/{{ $student_program['program_details']['slug'] }}/{{ base64_encode($arr_student['id']) }}" title="{{trans('parent.Report')}}"><i class="fas fa-print"></i></a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                            @endforeach

                        @else
                            <tr><td colspan="8" class="no-record">{{trans('parent.No_Program_added')}}</td></tr>
                        @endif

                    </table>
                </div>

                <div class="pagination-section-block">
                    <ul>{!! $arr_pagination !!}</ul>
                </div>

            </div>
        </div>                                   
    </div>
</div>

<form id="export_form" method="post" action="{{ url('/') }}/teacher/my-student/my-program/export-csv">
    {{ csrf_field() }}
    <input type="hidden" name="enc_class_id"   id="enc_class_id"   value="{{ $enc_class_id   }}" />
    <input type="hidden" name="enc_student_id" id="enc_student_id" value="{{ $enc_student_id }}" />
    <input type="hidden" name="export_keyword" id="export_keyword" value=""  />
    <input type="hidden" name="export_date"    id="export_date"    value=""  />
</form>

<script type="text/javascript">
    $(document).ready(function(){
        $("#btn_export_data").click(function(){
            var keyword = $('#teacher_search_program_keyword').val();
            var date    = $('#teacher_search_program_date').val();

            if(keyword == '' && date == '')
            {
                swal({
                    title: "{{trans('teacher.Are_you_sure')}}",
                    text: "{{trans('teacher.Do_you_want_to_export_all_record')}}",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#0f6bb0",
                    confirmButtonText: "Yes",
                    cancelButtonText: "No",
                    closeOnConfirm: true,
                    closeOnCancel: true
                },
                function(isConfirm)
                {
                    if(isConfirm)
                    {
                        $('#export_form').submit();

                    }
                });
            }
            else
            {
                $('#export_keyword').val(keyword);
                $('#export_date').val(date);
                $('#export_form').submit();
            }
        });
    });
</script>

    
    @include('front.layout.bredcrum')

    <div class="gray-btn-main-section my-student-middle-section change-program-main">
        <div class="container">            
            <div class="row">
                <div class="col-sm-4 col-md-3 col-lg-3">
                    @include('front.layout.left_bar')
                </div>
                <div class="col-sm-8 col-md-9 col-lg-9">
                    @include('front.layout._operation_status')
                    <div class="class-name-head-section">
                        {{ $studentDetails['first_name'].' '.$studentDetails['last_name'] }}
                    </div>

                    <div class="row responsive-margin">
                       <div class="col-md-9 col-lg-10">
                        <form id="frm_change_program" method="get" action="">
                            <div class="col-sm-6 col-md-3 col-lg-3 p-l-5 p-r-5">
                                <div class="form-group">
                                    <div class="name-field calendar-section">
                                        <input type="text" class="form-control" name="keyword" id="parent_search_program_keyword" placeholder="{{trans('parent.Program_Name')}}" value="{{ $keyword }}" maxlength="50" />
                                    </div>
                                </div> 
                            </div>
                            <div class="col-sm-6 col-md-3 col-lg-3 p-l-5 p-r-5">
                                <div class="form-group">
                                    <div class="name-field calendar-section">
                                        <input type="text" class="form-control" name="search" id="parent_search_program_date" placeholder="{{trans('parent.Select_Date')}}" value="{{ $serach_date }}" readonly />
                                        <i class="fa fa-calendar"></i>
                                    </div> 
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-3 col-lg-2">
                                <div class="inline-btns">
                                <button type="submit" id="btn_submit_parent_search_program" class="full-orng-btn btn-width-adjustment sim-button m-0"><i class="fa fa-search"></i></button>
                                <a href="{{ $cancel_link }}" class="full-orng-btn btn-width-adjustment sim-button m-0"><i class="fa fa-retweet"></i></a>
                                </div>
                            </div>
                        </form>
						</div>
                        <div class="col-md-3 col-lg-2">
                            <button type="button" id="btn_export_data" class="full-orng-btn btn-width-adjustment sim-button m-0 float-right"><i class="fas fa-file-excel"></i> {{trans('parent.Export')}}</button>
                        </div>
                    </div>

                     <div class="table-responsive table-scroll-section">
                        <table class="table students-list-section program-table">                            
                            <tr>
                                <th>{{trans('parent.Program_Name')}}</th>
                                <th>{{trans('parent.Grade')}}</th>
                                <th>{{trans('parent.Subject')}}</th>
                                <th>{{trans('parent.Assigned_By')}}</th>
                                <th>{{trans('parent.Assigned_Date')}}</th>
                                <th>{{trans('parent.Right')}}</th>
                                <th>{{trans('parent.Wrong')}}</th>
                                <th>{{trans('parent.Delay')}} </th>
                                <th>{{trans('parent.Status')}} </th>
                                <th>{{trans('parent.Homework')}}</th>
                                <th>{{trans('parent.Report')}}</th>
                                <th>{{trans('parent.Action')}}</th>
                            </tr>

                            @if(isset($arr_student_program['data']) && !empty($arr_student_program['data']))
                                @foreach($arr_student_program['data'] as $key => $student_program)

                                    <tr>
                                        <td>{{ $student_program['program_details']['name'] or '' }}</td>
                                        <td>{{ $student_program['program_details']['subject_data']['name'] or '' }}
                                        </td>
                                        <td>{{ $student_program['program_details']['grade_data']['name'] or '' }}
                                        </td>

                                        <td>{{ $student_program['user_details']['first_name'].' '.$student_program['user_details']['last_name'] }}</td>
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
                                        <td style="text-align:center;"><a class="student-list-trash-btn" href="{{ url('/') }}/parent/homework/{{ base64_encode($student_program['program_details']['id']) }}" title="{{trans('parent.Homework')}}"><i class="fas fa-book"></i></a></td>
                                        <td style="text-align:center;">
                                            @if($student_program['program_status']=='Completed')
                                                <a class="student-list-trash-btn" href="{{ url('/') }}/parent/program-report/{{ $student_program['program_details']['slug'] }}/{{ base64_encode($studentDetails['id']) }}" title="{{trans('parent.Report')}}"><i class="fas fa-print"></i></a>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>
                                            @if(isset($student_program['program_status']) && $student_program['program_status']=='Pending')
                                                <a class="student-list-trash-btn remove-student-data" onclick="deleteProgram('{{ base64_encode($student_program['id']) }}')" title="{{trans('parent.Delete_Program')}}"><i class="far fa-trash-alt"></i></a>
                                            @else
                                            {{ '--' }}
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @else

                            <tr><td colspan="6" style="text-align: center;">{{trans('parent.No_Program_added')}}</td></tr>

                            @endif
                                
                        </table>
                    </div>
                    @if(isset($arr_pagination) && sizeof($arr_pagination)>0)
                    <div class="pagination-section-block">
                        <ul>{!! $arr_pagination !!}</ul>
                    </div>
                    @endif
                    
                </div>
            </div>                                   
        </div>
    </div>

<form id="export_form" method="post" action="{{ url('/') }}/parent/my-program/export-csv">
    {{ csrf_field() }}
    <input type="hidden" name="enc_student_id" id="enc_student_id" value="{{ $enc_student_id }}" />
    <input type="hidden" name="export_keyword" id="export_keyword" value=""  />
    <input type="hidden" name="export_date"    id="export_date"    value=""  />
</form>

<script type="text/javascript">
    $(document).ready(function(){
        $("#btn_export_data").click(function(){
            var keyword = $('#parent_search_program_keyword').val();
            var date    = $('#parent_search_program_date').val();

            if(keyword == '' && date == '')
            {
                swal({
                    title: "{{trans('parent.Are_you_sure')}}",
                    text: "{{trans('parent.Do_you_want_to_export_all_records')}}",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#0f6bb0",
                    confirmButtonText: "{{trans('parent.Yes')}}",
                    cancelButtonText: "{{trans('parent.No')}}",
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
    function deleteProgram($program_id)
    {
           swal({
                    title: "{{trans('parent.Are_you_sure')}}",
                    text: "{{trans('parent.Do_you_want_to_delete_this_record')}}",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#0f6bb0",
                    confirmButtonText: "{{trans('parent.Yes')}}",
                    cancelButtonText: "{{trans('parent.No')}}",
                    closeOnConfirm: true,
                    closeOnCancel: true
                },
                function(isConfirm)
                {
                    if(isConfirm)
                    {
                       location.href = '{{ url('/') }}/parent/my-program/delete/'+$program_id;
                    }
                });
    }
</script>

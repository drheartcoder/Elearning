@include('front.layout.bredcrum')
    <!-- bredcrum section end -->
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
                    <form id="frm_change_program" method="post" action="">
                        {{csrf_field()}}
                    <div class="row responsive-margin">

                        <div class="col-sm-6 col-md-4 col-lg-4 p-r-5">
                            <div class="form-group">
                                <div class="name-field">
                                    <select id="program" name="program">
                                        <option value="">{{trans('parent.Change_Program')}}</option>
                                        @if(count($grade_program)>0)
                                            @foreach($grade_program as $program)
                                                <option value="{{$program['id']}}">{{$program['name']}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <i class="fa fa-angle-down"></i>
                                </div>
                            </div>
                        </div>
                            
                        <div class="col-sm-12 col-md-4 col-lg-4 p-l-5 tab-view-pl-change">
                            <div class="change-program-cancel-done-btn">
                                <button type="submit" name="btnChangeProgram" id="btnChangeProgram" class="full-fill-button sim-button">{{trans('parent.Change')}}</button>
                            </div>                            
                        </div>
                        <input type="hidden" name="student_id" name="student_id" value="{{base64_decode(Request::segment(3))}}">                        
                    </div>     
                    </form>               
                     <div class="table-responsive table-scroll-section">
                        <table class="table students-list-section">                            
                                <tr>
                                    <th>{{trans('parent.Program_Name')}}</th>
                                    <th>{{trans('parent.Grade')}}</th>
                                    <th>{{trans('parent.Subject')}}</th>
                                    <th>{{trans('parent.Assigned_By')}}</th>
                                    <th>{{trans('parent.Assigned_Date')}}</th>
                                    <th>{{trans('parent.Homework')}}</th>
                                </tr>                          
                                 @if(isset($student_programs['data']) && !empty($student_programs['data']))
                                @foreach($student_programs['data'] as $key => $student) 
                             
                                    <tr>
                                        <td>{{ $student['name'] or ''}}</td>
                                        <td>{{ $student['grade_name'] or '' }}</td>
                                        <td>{{ $student['subject_name'] or '' }}</td>
                                        <td>{{ $student['first_name'].' '.$student['last_name'] }}</td>
                                        <td>{{ date('d M Y',strtotime($student['created_at'])) }}</td>
                                        <td style="text-align:center;">
                                            @if(isset($student['program_id']) && $student['program_id']!="")
                                        <a class="student-list-trash-btn" href="{{ url('/') }}/parent/homework/{{ base64_encode($student['program_id']) }}"><i class="far fa-eye"></i></a>
                                        @else
                                        {{ '--' }}
                                        @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @else

                            <tr><td colspan="4" style="text-align: center;">{{trans('parent.No_Program_added')}}</td></tr>

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

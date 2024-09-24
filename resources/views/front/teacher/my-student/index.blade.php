@include('front.layout.bredcrum')

@if(isset($arr_class) && !empty($arr_class))
    @php
        $class_id     = isset($arr_class['id']) && !empty($arr_class['id']) ? base64_encode($arr_class['id']) : '';
        $class_name   = isset($arr_class['name']) && !empty($arr_class['name']) ? $arr_class['name'] : '';
        $grade_id     = isset($arr_class['grade_id']) && !empty($arr_class['grade_id']) ? $arr_class['grade_id'] : '';
        $grade_name   = isset($arr_class['grade_data']['name']) && !empty($arr_class['grade_data']['name']) ? $arr_class['grade_data']['name'] : '';
        $subject_id   = isset($arr_class['subject_id']) && !empty($arr_class['subject_id']) ? $arr_class['subject_id'] : '';
        $subject_name = isset($arr_class['subject_data']['name']) && !empty($arr_class['subject_data']['name']) ? $arr_class['subject_data']['name'] : '';
        $expired      = isset($expired) && !empty($expired) ? $expired : '';
        
        if($expired == 'yes')
        {
            $add_student = "";
            $style       = "background-color: #808080; border: 1px solid #cccccc;";
        }
        else
        {
            $add_student = "add-student";
            $style       = "";
        }
    @endphp
@endif

<div class="gray-btn-main-section my-student-middle-section">
    <div class="container">            
        <div class="row">
            <div class="col-sm-4 col-md-3 col-lg-3">
                @include('front.layout.left_bar')
            </div>
            
            <div class="col-sm-8 col-md-9 col-lg-9">
                
                @include('front.layout._operation_status')
                
                <div class="class-name-head-section mt-0">
                    {{ $class_name or '' }}
                </div>
                <div class="clearfix"></div>    
                <div style="margin: 25px 0 25px;">
                    <form id="frmSearchClass" name="frmSearchClass" method="get">
                        <div class="row" style="text-align: left;">
                            <div class="col-sm-12 col-md-12 col-lg-3">
                                <div class="form-group">
                                    <input type="text" id="keyword" name="keyword" placeholder="Search Keyword" tabindex="1" value="{{ Request::get('keyword')!=null && Request::get('keyword')!='' ? Request::get('keyword') : '' }}" />
                                    <div class="error" id="err_keyword">{{$errors->first('keyword')}}</div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-4">
                                <div class="form-group">
                                <button class="full-orng-btn btn-width-adjustment sim-button m-0" style="margin: 0px 0 25px;"><i class="fa fa-search"></i></button>
                                @if(isset($class_id) && $class_id!="")
                                <button type="button" onclick="window.location.href='{{url('/teacher/my-student/').'/'.$class_id}}'" class="full-orng-btn btn-width-adjustment sim-button m-0" style="margin: 0px 0 25px;"><i class="fa fa-retweet"></i></button>
                                @endif
                                <button type="button" id="btn_export_data" class="full-orng-btn btn-width-adjustment sim-button m-0"><i class="fas fa-file-excel"></i> {{trans('parent.Export')}}</button>
                            	</div>
							</div>
							<div class="col-sm-12 col-md-6 col-lg-5">
								<div class="add-class-button-section  inline-btns">
									<button type="button" id="btn_transfer_data" class="full-orng-btn btn-width-adjustment sim-button m-0" data-class_id="{{ $class_id or '' }}" style="{{ $style or ''}}">{{trans('teacher.Transfer_Student')}}</button>
									<a class="full-orng-btn btn-width-adjustment sim-button open_add_student_popup m-0" data-toggle="modal" data-target="#{{ $add_student or '' }}" data-backdrop="static" data-keyboard="false" data-class_id="{{ $class_id or '' }}" style="{{ $style or ''}}"><i class="fa fa-plus"></i> {{trans('teacher.Add_Student')}}</a>
								</div>
							</div>
                          </div>
                    </form>
                </div>

                <div class="table-responsive table-scroll-section">
                    <table class="table students-list-section">                            
                            <tr>
                                 <th>
                                    <div class="check-block">
                                        <input id="filled-in-box" class="filled-in" type="checkbox" onclick="selectAllRecords(this);">
                                        <label for="filled-in-box"></label>
                                    </div>
                                </th>
                                <th>{{trans('teacher.Sr_No')}}</th>
                                <th>{{trans('teacher.Name_Of_Student')}}</th>
                                <th>{{trans('teacher.Pin')}}</th>
                                <th>{{trans('parent.Subject')}}</th>
                                <th>{{trans('parent.Grade')}}</th>
                                <th>{{trans('teacher.report')}}</th>
                                <th style="text-align: center;min-width: 120px;">{{trans('teacher.Action')}}</th>
                            </tr>
                            @if(isset($arr_student['data']) && !empty($arr_student['data']))
                                @foreach($arr_student['data'] as $key => $student)
                                    
                                    @php

                                        $student_id = isset($student['student_data']['id']) && !empty($student['student_data']['id']) ? base64_encode($student['student_data']['id']) : '';
                                        $first_name = isset($student['student_data']['first_name']) && !empty($student['student_data']['first_name']) ? $student['student_data']['first_name'] : '';
                                        $last_name  = isset($student['student_data']['last_name']) && !empty($student['student_data']['last_name']) ? $student['student_data']['last_name'] : '';
                                        $pin        = isset($student['student_data']['pin']) && !empty($student['student_data']['pin']) ? $student['student_data']['pin'] : '';

                                    @endphp
                                    <tr>
                                        <td>
                                            <div class="check-block">   
                                                <input id="filled-in-box{{$student['id'] or ''}}" class="filled-in checked_record" type="checkbox" name="checked_record[]" value="{{$student['student_id'] or ''}}">
                                                <label for="filled-in-box{{$student['id'] or ''}}"></label>
                                            </div>                                        
                                        </td>
                                        <td>{{ $key + 1 }}</td>
                                        <td><a class="student-name-list" href="{{ url('/') }}/teacher/my-student/{{ $class_id or ''}}/{{ $student_id }}/my-program" title="View Student Program Details">{{ $first_name.' '.$last_name }}</a>
                                        </td>
                                        <td>{{ $pin }}</td>
                                        <td>{{ $subject_name }}</td>
                                        <td>{{ $grade_name }}</td>
                                        <td>
                                            <a class="student-list-trash-btn remove-student-data" data-toggle="modal"  data-backdrop="static" data-keyboard="false" href="{{ url('/') }}/teacher/student_report/{{ $class_id }}/{{$student_id}}"  ><i class="fas fa-print"></i></a></td>

                                        <td style="text-align: center;">
                                            <a class="student-list-edit-btn edit-student-data" data-toggle="modal" data-target="#edit-student" data-backdrop="static" data-keyboard="false" data-class_id="{{ $class_id or ''}}" data-student_id="{{ $student_id }}" data-first_name="{{ $first_name }}" data-last_name="{{ $last_name }}" data-pin="{{ $pin }}" data-grade_id="{{ $grade_id }}" data-subject_id="{{ $subject_id }}"><i class="far fa-edit"></i></a>
                                            <a class="student-list-trash-btn remove-student-data" data-toggle="modal" data-target="#remove-student" data-backdrop="static" data-keyboard="false" data-class_id="{{ $class_id }}" data-student_id="{{ $student_id }}" data-first_name="{{ $first_name }}" data-last_name="{{ $last_name }}" ><i class="far fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else

                            <tr><td colspan="8" class="no-record" style="width:100%">{{trans('teacher.No_Student_added')}}</td></tr>

                            @endif

                    </table>
                </div>
                <div class="pagination-section-block">                        
                    <ul> {!! $arr_pagination !!}</ul>
                </div>
                
            </div>
        </div>                                   
    </div>
</div>

<div id="transfer-student-modal" class="modal fade inner-page-modal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" id="close_add_student_popup" data-dismiss="modal"></button>
                <div class="modal-head-section">
                   {{trans('teacher.Transfer_Student')}}
                </div>
              
             
                <form id="frm_transfer_student" method="post" action="{{ $module_url_path }}/transfer_student">
                {{ csrf_field() }}
                   <input type="hidden" name="old_class_id" id="old_class_id" value="{{ $class_id or '' }}" >
                    <input type="hidden" id="arr_selected_student" name="arr_selected_student" />
                    <div class="text-block">
                        <div id="form_fields">
                        
                                <div class="form-group removeclass">
                                    <div class="row add_student_row">

                                        <div class="col-sm-4 col-md-4 col-lg-4">
                                            <div class="form-group">
                                                <label>{{trans('teacher.Class_Id')}}<i class="red">*</i></label>
                                                <div class="name-field">
                                                    <input type="text" class="form-control input_field class_enrollment required"  name="class_enrollment" placeholder="{{trans('teacher.Enter_Class_Id')}}" id="class_enrollment" >
                                                </div>
                                                <div class="error err_class_enrollment"></div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                 
                                </div>
                           

                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="modal-button-section">
                        <button type="button" id="cancel_add_student_popup" class="full-fill-button border-button sim-button-blue" data-dismiss="modal">{{trans('parent.Cancel')}}</button>
                       {{--  <button type="submit" id="btn_add_student" class="full-fill-button sim-button">{{trans('teacher.Done')}}</button> --}}
                        <input type="submit" class="full-fill-button sim-button" name="btn_transfer_student" value="{{trans('teacher.Done')}}" id="btn_transfer_student">
                        <button type="button" id="btn_add_student_loder" class="full-fill-button sim-button" style="display: none;"><i class="fa fa-spinner fa-pulse fa-fw" style="font-size:1.5em;"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
@include('front.teacher.my-class.add-student')
@include('front.teacher.my-student.student-options')

<form id="export_form" method="post" action="{{ url('/') }}/teacher/my-student/export-csv">
    {{ csrf_field() }}
    <input type="hidden" name="enc_class_id"   id="enc_class_id"   value="{{ $class_id or ''  }}" />
    <input type="hidden" name="export_keyword" id="export_keyword" value=""  />
</form>

<script type="text/javascript">
    $(document).ready(function(){
        $("#btn_export_data").click(function(){
            var keyword = $('#keyword').val();

            if(keyword == '') {
                swal({
                    title: "{{trans('teacher.Are_you_sure')}}",
                    text: "{{trans('teacher.Do_you_want_to_export_all_record')}}",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#0f6bb0",
                    confirmButtonText: "{{trans('parent.Yes')}}",
                    cancelButtonText: "{{trans('parent.No')}}",
                    closeOnConfirm: true,
                    closeOnCancel: true
                },
                function(isConfirm) {
                    if(isConfirm) {
                        $('#export_form').submit();
                    }
                });
            } else {
                $('#export_keyword').val(keyword);
                $('#export_form').submit();
            }
        });
        
        $("#btn_transfer_data").click(function()
        {
           var checkboxes = $("input[type='checkbox']");
           if(!checkboxes.is(":checked"))
           {
                swal(error_Please_select_atleast_one_record);
           }
           else
           {
                var selected_student = new Array();
                $('input[name="checked_record[]"]:checked').each(function() {

                    selected_student.push(this.value);
                });
               $('#arr_selected_student').val(selected_student);
               $('#transfer-student-modal').modal('show');
           }

        });
    });
    function selectAllRecords(ref)
    {       
        if($(ref).prop('checked') == true)
        {
            $('input[type="checkbox"]').prop('checked',true);
        }
        else
        {
            $('input[type="checkbox"]').prop('checked',false);
        }
    }
    $('#frm_transfer_student').on('submit',function(){
        if($('#class_enrollment').val()=="")
        {
            $('.err_class_enrollment').html(error_This_field_is_required);
            // swal("Enter class id");
             return false;
        }
    })
</script>

<div id="add-class" class="modal fade inner-page-modal edit-class-info-modal add-class" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" id="close_add_class_popup"></button>
                <div class="modal-head-section">
                    {{trans('teacher.Add_Class')}}
                </div>
                <form id="form_add_class" method="post" action="{{ url('/') }}/teacher/my-class/add">
                {{ csrf_field() }}
                    <div class="row">
                        
                        <div class="col-sm-6 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>{{trans('teacher.Name')}}<i class="red">*</i></label>
                                <div class="name-field">
                                    <input type="text" class="form-control" id="class_name" name="class_name" placeholder="{{trans('teacher.Enter_Class_Name')}}" />
                                </div>
                                <div class="error" id="err_class_name">{{ $errors->first('class_name') }}</div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>{{trans('teacher.Class_Ends')}}<i class="red">*</i></label>
                                <div class="name-field">
                                    <input type="text" name="end_date" class="form-control" id="end_date" placeholder="{{trans('teacher.Select_Date')}}" readonly />
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <div class="error" id="err_end_date">{{ $errors->first('end_date') }}</div>
                            </div>
                        </div>
                        
                        @if( isset($arr_subject) && !empty($arr_subject) )
                            <div class="col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>{{trans('parent.Subject')}}<i class="red">*</i></label>
                                    <div class="name-field">
                                        <select name="subject" id="subject">
                                            <option value="">{{trans('parent.Select_Subject')}}</option>
                                            @foreach($arr_subject as $subject)
                                                <option value="{{ $subject['id'] }}">{{ $subject['name'] }}</option>
                                            @endforeach
                                        </select>
                                        <i class="fa fa-angle-down"></i>
                                    </div>
                                    <div class="error" id="err_subject">{{ $errors->first('subject') }}</div>
                                </div>
                            </div>
                        @endif

                        <!-- @if( isset($arr_grade) && !empty($arr_grade) ) -->
                            <div class="col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>{{trans('parent.Grade')}}<i class="red">*</i></label>
                                    <div class="name-field">
                                        <select name="grade" id="grade">
                                            <option value="">{{trans('parent.Select_Grade')}}</option>
                                            <!-- @foreach($arr_grade as $grade)
                                                <option value="{{ $grade['id'] }}">{{ $grade['name'] }}</option>
                                            @endforeach -->
                                        </select>
                                        <i class="fa fa-angle-down"></i>
                                    </div>
                                    <div class="error" id="err_grade">{{ $errors->first('grade') }}</div>
                                </div>
                            </div>
                        <!-- @endif -->

                        <!-- @if( isset($arr_program) && !empty($arr_program) ) -->
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>{{trans('parent.Program')}}</label>
                                    <div class="name-field">
                                        <select name="program" id="program">
                                            <option value="">{{trans('parent.Select_Program')}}</option>
                                            <!-- @foreach($arr_program as $program)
                                                <option value="{{ $program['id'] }}">{{ $program['name'] }}</option>
                                            @endforeach -->
                                        </select>
                                        <i class="fa fa-angle-down"></i>
                                    </div>
                                    <div class="error" id="err_program">{{ $errors->first('program') }}</div>
                                </div>
                            </div>
                        <!-- @endif -->

                    </div>                    
                    <div class="modal-button-section">
                        <button type="button" id="cancel_add_class_popup" class="full-fill-button border-button sim-button-blue" data-dismiss="modal">{{trans('parent.Cancel')}}</button>
                        <button type="submit" id="btn_add_class" class="full-fill-button sim-button">{{trans('teacher.Done')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="edit-class" class="modal fade inner-page-modal edit-class-info-modal edit-class" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" id="close_edit_class" class="close" data-dismiss="modal"></button>
                <div class="modal-head-section">
                    {{trans('teacher.Edit_Class')}}
                </div>
                <form id="form_edit_class" method="post" action="{{ url('/') }}/teacher/my-class/update">
                {{ csrf_field() }}
                <div class="row">
                    
                    <input type="hidden" id="edit_class_id" name="class_id" />

                    <div class="col-sm-6 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label>{{trans('teacher.Name')}}<i class="red">*</i></label>
                            <div class="name-field">
                                <input type="text" class="form-control" id="edit_class_name" name="class_name" placeholder="{{trans('teacher.Enter_Class_Name')}}" />
                            </div>
                            <div class="error" id="err_edit_class_name">{{ $errors->first('class_name') }}</div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label>{{trans('teacher.Class_Ends')}}<i class="red">*</i></label>
                            <div class="name-field calendar-section">
                                <input type="text" class="form-control edit_end_date" id="edit_end_date" name="end_date" placeholder="{{trans('parent.Select_Date')}}" readonly />
                                <i class="fa fa-calendar"></i>
                            </div>
                            <div class="error" id="err_edit_end_date">{{ $errors->first('end_date') }}</div>
                        </div>
                    </div>

                    @if( isset($arr_subject) && !empty($arr_subject) )
                        <div class="col-sm-6 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>{{trans('parent.Subject')}}<i class="red">*</i></label>
                                <div class="name-field">
                                    <select name="subject" id="edit_subject">
                                        <option value="">{{trans('parent.Select_Subject')}}</option>
                                        @foreach($arr_subject as $subject)
                                            <option value="{{ $subject['id'] }}">{{ $subject['name'] }}</option>
                                        @endforeach
                                    </select>
                                    <i class="fa fa-angle-down"></i>
                                </div>
                                <div class="error" id="err_edit_subject">{{ $errors->first('subject') }}</div>
                            </div>
                        </div>
                    @endif

                    <!-- @if( isset($arr_grade) && !empty($arr_grade) ) -->
                        <div class="col-sm-6 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>{{trans('parent.Grade')}}<i class="red">*</i></label>
                                <div class="name-field">
                                    <select name="grade" id="edit_grade">
                                        <option value="">{{trans('teacher.Select_Grade')}}</option>
                                        <!-- @foreach($arr_grade as $grade)
                                            <option value="{{ $grade['id'] }}">{{ $grade['name'] }}</option>
                                        @endforeach -->
                                    </select>
                                    <i class="fa fa-angle-down"></i>
                                </div>
                                <div class="error" id="err_edit_grade">{{ $errors->first('grade') }}</div>
                            </div>
                        </div>
                    <!-- @endif -->

                    <!-- @if( isset($arr_program) && !empty($arr_program) ) -->
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group">
                                <label>{{trans('parent.Program')}}</label>
                                <div class="name-field">
                                    <select name="program" id="edit_program">
                                        <option value="">{{trans('parent.Select_Program')}}</option>
                                        <!-- @foreach($arr_program as $program)
                                            <option value="{{ $program['id'] }}">{{ $program['name'] }}</option>
                                        @endforeach -->
                                    </select>
                                    <i class="fa fa-angle-down"></i>
                                </div>
                                <div class="error" id="err_edit_program">{{ $errors->first('program') }}</div>
                            </div>
                        </div>
                    <!-- @endif -->

                </div> 
                <div class="modal-button-section">
                    <button type="button" id="cancel_edit_class" class="full-fill-button border-button sim-button-blue" data-dismiss="modal">{{trans('parent.Cancel')}}</button>
                    <button type="submit" id="btn_edit_class" class="full-fill-button sim-button">{{trans('teacher.Done')}}</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="remove-class" class="modal fade inner-page-modal remove-class-modal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal"></button>
                <div class="modal-head-section">
                    {{trans('teacher.Remove_Class')}}
                </div>
                <div class="remove-modal-txt-block">
                    {{trans('teacher.Do_you_really_want_to_Remove_this_Class')}}
                </div>
                <div class="modal-note-section">
                    {{trans('teacher.Remove_class_confirm_message')}}
                </div>
                <form id="form_delete_class" method="post" action="{{ url('/') }}/teacher/my-class/delete">
                    {{ csrf_field() }}
                    <input type="hidden" name="delete_class_id" id="txt_delete_class_id" value="" />
                    <div class="modal-button-section">
                        <button type="button" class="full-fill-button border-button sim-button-blue" data-dismiss="modal">{{trans('parent.Cancel')}}</button>
                        <button type="submit" id="btn_delete_class" class="full-fill-button sim-button">{{trans('auth.Confirm')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

function getGrade(subject_id = false, grade_id = false, event = false)
{
    $.ajax({
        url : SITE_URL+"/teacher/my-class/getgrade",
        type : "POST",
        data : { _token:csrf_token, subject_id:subject_id, grade_id:grade_id },
        success : function(result)
        {
            if(event == 'add')
            {
                $("#grade").html(result);
            }
            else if(event == 'edit')
            {
                $("#edit_grade").html(result);
            }
        }
    });
}

$('#subject').change(function() {
    var subject_id = $('#subject').val();
    getGrade(subject_id, '', 'add');
});

$('#edit_subject').change(function() {
    var subject_id = $('#edit_subject').val();
    getGrade(subject_id, '', 'edit');
});

</script>
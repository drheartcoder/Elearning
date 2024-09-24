<div id="edit-student" class="modal fade inner-page-modal edit-class-info-modal edit-student" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" id="close_edit_class" class="close" data-dismiss="modal"></button>
                <div class="modal-head-section">
                    Edit Student
                </div>
                <form id="form_edit_submit" method="post" action="{{ url('/') }}/teacher/my-student/update">
                {{ csrf_field() }}
                <div class="row">
                    
                    <input type="hidden" id="edit_class_id" name="class_id" />
                    <input type="hidden" id="edit_student_id" name="student_id" />

                    <div class="col-sm-6 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label>{{trans('auth.First_Name')}}<i class="red">*</i></label>
                            <div class="name-field">
                                <input type="text" class="form-control alphabets" id="edit_first_name" name="first_name" placeholder="{{trans('parent.Enter_first_name')}}" maxlength="50" />
                            </div>
                            <div class="error" id="err_edit_first_name">{{ $errors->first('first_name') }}</div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label>{{trans('auth.Last_Name')}}<i class="red">*</i></label>
                            <div class="name-field">
                                <input type="text" class="form-control alphabets" id="edit_last_name" name="last_name" placeholder="{{trans('parent.Enter_last_name')}}" maxlength="50" />
                            </div>
                            <div class="error" id="err_edit_last_name">{{ $errors->first('last_name') }}</div>
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

                    <div class="col-sm-6 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label>{{trans('parent.Grade')}}<i class="red">*</i></label>
                            <div class="name-field">
                                <select name="grade" id="edit_grade">
                                    <option value="">{{trans('parent.Select_Grade')}}</option>
                                </select>
                                <i class="fa fa-angle-down"></i>
                            </div>
                            <div class="error" id="err_edit_grade">{{ $errors->first('grade') }}</div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label>{{trans('auth.PIN')}}</label>
                            <div class="name-field">
                                <input type="text" class="form-control digits" id="edit_pin" name="pin" placeholder="{{trans('auth.Enter_your_PIN')}}" maxlength="4" readonly />
                            </div>
                            <div class="error" id="err_edit_pin">{{ $errors->first('pin') }}</div>
                        </div>
                    </div>

                </div> 
                <div class="modal-button-section">
                    <button type="button" id="btn_cancel_edit_student" class="full-fill-button border-button sim-button-blue" data-dismiss="modal">{{trans('parent.Cancel')}}</button>
                    <button type="submit" id="btn_submit_edit_student" class="full-fill-button sim-button">{{trans('parent.Update')}}</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="remove-student" class="modal fade inner-page-modal remove-class-modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal"></button>
                <div class="modal-head-section">
                    {{trans('teacher.Remove_Student')}}
                </div>
                <div class="remove-modal-txt-block">
                    {{trans('parent.Do_you_really_want_to_remove')}}
                </div>
                <form id="form_remove_student" method="post" action="{{ url('/') }}/teacher/my-student/remove">
                    {{ csrf_field() }}
                    <input type="hidden" name="remove_class_id"   id="remove_class_id"   value="" />
                    <input type="hidden" name="remove_student_id" id="remove_student_id" value="" />
                    <input type="hidden" name="remove_first_name" id="remove_first_name" value="" />
                    <input type="hidden" name="remove_last_name"  id="remove_last_name"  value="" />
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
    $(document).ready(function(){
    });
</script>

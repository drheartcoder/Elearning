<div id="add-student" class="modal fade inner-page-modal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" id="close_add_student_popup" data-dismiss="modal"></button>
                <div class="modal-head-section">
                   {{trans('teacher.Add_Students')}}
                </div>
                <div class="modal-note-section">
                     {{trans('teacher.Add_Students_note')}}
                </div>
                
                <input type="hidden" id="temp_pin" value="">

                <form id="form_add_student" method="post" action="{{ url('/') }}/teacher/my-student/add">
                {{ csrf_field() }}

                    <input type="hidden" id="add_student_in_class"   name="class_id"   />
                    <input type="hidden" id="add_student_grade_id"   name="grade_id"   />
                    <input type="hidden" id="add_student_subject_id" name="subject_id" />
                    <input type="hidden" id="add_student_program_id" name="program_id" />

                    <div class="student-type-section">
                        <div class="student-type-head">
                            {{trans('teacher.Type_of_Student')}}
                        </div>
                        <div class="students-type">
                            <div class="radio-btns">
                                <div class="radio-btn">
                                    <input type="radio" class="student_type" id="new_student" name="student_type" value="new_student" checked >
                                    <label for="new_student">{{trans('teacher.New_Student')}}</label>
                                    <div class="check"></div>
                                </div>
                                <div class="radio-btn">
                                    <input type="radio" class="student_type" id="transfer_from_another" name="student_type" value="transfer_from_another">
                                    <label for="transfer_from_another">{{trans('teacher.Transfer_Student_anather_class')}}</label>
                                    <div class="check"></div>
                                </div>
                                <div class="radio-btn">
                                    <input type="radio" class="student_type" id="existing_student" name="student_type" value="existing_student">
                                    <label for="existing_student">{{trans('teacher.Existing_student_pin')}}</label>
                                    <div class="check"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-block">
                        <div class="main-col-block">
                            <a class="add-remove-btn" id="add_student_fields">{{trans('teacher.Add_Student')}}</a>
                            <a class="add-remove-btn" id="transfer_student_fields">{{trans('teacher.Transfer_Student')}}</a>
                            <a class="add-remove-btn" id="existing_student_fields">{{trans('teacher.Existing_Student')}}</a>
                            <div class="clearfix"></div>
                        </div>
                        <div id="form_fields">
                            <div class="add_new_student_fields">
                                <div class="form-group removeclass">
                                    <div class="row add_student_row">
                                        <div class="col-sm-4 col-md-4 col-lg-4">
                                            <div class="form-group">
                                                <label>{{trans('auth.First_Name')}}<i class="red">*</i></label>
                                                <div class="name-field">
                                                    <input type="text" class="form-control input_field alphabets student_first_name required" name="student_first_name[]" placeholder="{{trans('parent.Enter_first_name')}}" maxlength="50" data-name="first name">
                                                </div>
                                                <div class="error err_student_first_name"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 col-md-4 col-lg-4">
                                            <div class="form-group">
                                                <label>{{trans('auth.Last_Name')}}<i class="red">*</i></label>
                                                <div class="name-field">
                                                    <input type="text" class="form-control input_field alphabets student_last_name required" name="student_last_name[]" placeholder="{{trans('parent.Enter_last_name')}}" maxlength="50" data-name="last name">
                                                </div>
                                                <div class="error err_student_last_name"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 col-md-4 col-lg-4">
                                            <div class="form-group">
                                                <label>{{trans('auth.PIN')}}<i class="red">*</i></label>
                                                <div class="name-field">
                                                    <input type="text" class="form-control digits input_field student_pin required" name="student_pin[]" maxlength="4" placeholder="{{trans('auth.Enter_your_PIN')}}" value="{{ RandomPin() }}" readonly data-name="student pin">
                                                </div>
                                                <div class="error err_student_pin"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <a type="button" class="remove-btn-block btn_remove_student" onclick="remove_new_student(this);">{{trans('teacher.Remove_Student')}}</a>
                                    <div class="error last_count_error"></div>
                                    <div class="clear"></div>
                                </div>
                            </div>
                            <div class="add_transfer_student_fields">
                                <div class="form-group removeclass">
                                    <div class="row add_student_row">
                                        
                                        <div class="col-sm-6 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label>{{trans('parent.Teachers_Email_Mobile')}}<i class="red">*</i></label>
                                                <div class="name-field">
                                                   <input type="text" class="form-control input_field old_teacher_email required" name="old_teacher_email[]" placeholder="{{trans('teacher.Enter_Teacher_Email_or_Mobile')}}" maxlength="70" data-name="teacher email/mobile" >
                                                </div>
                                                <div class="error err_old_teacher_email"></div>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label>{{trans('auth.PIN')}}<i class="red">*</i></label>
                                                <div class="name-field">
                                                    <input type="text" class="form-control digits input_field old_student_pin required" name="old_student_pin[]" maxlength="4" placeholder="{{trans('auth.Enter_your_PIN')}}" data-name="student pin" >
                                                </div>
                                                <div class="error err_old_student_pin"></div>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label>{{trans('auth.First_Name')}}</label>
                                                <div class="name-field">
                                                    <input type="text" class="form-control input_field alphabets old_student_first_name" name="old_student_first_name[]" placeholder="{{trans('parent.Enter_first_name')}}" maxlength="50" data-name="first name" >
                                                </div>
                                                <div class="error err_old_student_first_name"></div>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label>{{trans('auth.Last_Name')}}</label>
                                                <div class="name-field">
                                                    <input type="text" class="form-control input_field alphabets old_student_last_name" name="old_student_last_name[]" placeholder="{{trans('parent.Enter_last_name')}}" maxlength="50" data-name="last name" >
                                                </div>
                                                <div class="error err_old_student_last_name"></div>
                                            </div>
                                        </div>

                                    </div>
                                    <a type="button" class="remove-btn-block btn_remove_student" onclick="remove_transfer_student(this);">{{trans('teacher.Remove_Student')}}</a>
                                    <div class="error last_count_error"></div>
                                    <div class="clear"></div>
                                </div>
                            </div>
                            <div class="add_existing_student_fields">
                                <div class="form-group removeclass">
                                    <div class="row add_student_row">
                                        <div class="col-sm-6 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label>{{trans('parent.Teachers_Email_Mobile')}}</label>
                                                <div class="name-field">
                                                    <input type="text" class="form-control input_field parent_teacher_email" name="parent_teacher_email[]" placeholder="{{trans('teacher.Enter_Teacher_Email_or_Mobile')}}" maxlength="70" data-name="email/mobile" data-required="no">
                                                </div>
                                                <div class="error err_parent_teacher_email"></div>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label>{{trans('auth.PIN')}}<i class="red">*</i></label>
                                                <div class="name-field">
                                                    <input type="text" class="form-control input_field pin" name="pin[]" placeholder="{{trans('teacher.Enter_your_Pin')}}" data-name="pin" maxlength="4" data-required="yes" >
                                                </div>
                                                <div class="error err_pin"></div>
                                            </div>
                                        </div>

                                    </div>
                                    <a type="button" class="remove-btn-block btn_remove_student" onclick="remove_existing_student(this);">{{trans('teacher.Remove_Student')}}</a>
                                    <div class="error last_count_error"></div>
                                    <div class="clear"></div>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="modal-button-section">
                        <button type="button" id="cancel_add_student_popup" class="full-fill-button border-button sim-button-blue" data-dismiss="modal">{{trans('parent.Cancel')}}</button>
                        <button type="submit" id="btn_add_student" class="full-fill-button sim-button">{{trans('teacher.Done')}}</button>
                        <button type="button" id="btn_add_student_loder" class="full-fill-button sim-button" style="display: none;"><i class="fa fa-spinner fa-pulse fa-fw" style="font-size:1.5em;"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function check_radio_btn() {
        var checked_student_type = $('input[name=student_type]:checked').val();
        if(checked_student_type == 'new_student') {
            $("#add_student_fields").css('display', 'block');
            $("#transfer_student_fields").css('display', 'none');
            $("#existing_student_fields").css('display', 'none');
            
            $(".add_new_student_fields").css('display', 'block');
            $(".add_transfer_student_fields").css('display', 'none');
            $(".add_existing_student_fields").css('display', 'none');

            /*$(".clone_div").find('input,select').val('');
            $(".clone_div").remove();*/

        } else if(checked_student_type == 'transfer_from_another') {
            $("#add_student_fields").css('display', 'none');
            $("#transfer_student_fields").css('display', 'block');
            $("#existing_student_fields").css('display', 'none');
            
            $(".add_new_student_fields").css('display', 'none');
            $(".add_transfer_student_fields").css('display', 'block');
            $(".add_existing_student_fields").css('display', 'none');

            /*$(".clone_div").find('input,select').val('');
            $(".clone_div").remove();*/

        } else if(checked_student_type == 'existing_student') {
            $("#add_student_fields").css('display', 'none');
            $("#transfer_student_fields").css('display', 'none');
            $("#existing_student_fields").css('display', 'block');
            
            $(".add_new_student_fields").css('display', 'none');
            $(".add_transfer_student_fields").css('display', 'none');
            $(".add_existing_student_fields").css('display', 'block');

            /*$(".clone_div").find('input,select').val('');
            $(".clone_div").remove();*/
        }
    }

    function remove_new_student(ref) {
        if( $(".add_new_student_fields").length > 1 ) {
            $(ref).closest( $(".add_new_student_fields") ).remove();
        }
        else {
            swal("",error_You_cant_remove_last_record ,"error");
        }
    }

    function remove_transfer_student(ref) {
        if( $(".add_transfer_student_fields").length > 1 ) {
            $(ref).closest( $(".add_transfer_student_fields") ).remove();
        }
        else {
            swal("",error_You_cant_remove_last_record ,"error");
        }
    }

    function remove_existing_student(ref) {
        if( $(".add_existing_student_fields").length > 1 ) {
            $(ref).closest( $(".add_existing_student_fields") ).remove();
        }
        else {
            swal("",error_You_cant_remove_last_record ,"error");
        }
    }

    function get_student_pin() {
        var token = $('input[name="_token"]').val();
        $.ajax({
            url      : "{{ url('/') }}/teacher/my-student/get/student/pin",
            type     : "POST",
            dataType : 'json',
            data     : { _token : token },
            success  : function(result) {
                $("#temp_pin").val(result);
            }
        });
    }

    function check_email_data(teacher_email, student_pin) {
        var output;

        $("#btn_add_student").hide();
        $("#btn_add_student_loder").show();

        $.ajax({
            url   : SITE_URL+"/teacher/my-student/add/transfer/check-email-data",
            type : "POST",
            dataType :'json',
            async : false,
            data: { _token:csrf_token, teacher_email:teacher_email, student_pin:student_pin },
            success : function(result)
            {
                $("#btn_add_student_loder").hide();
                $("#btn_add_student").show();
                output = result;
            }
        });
        return output;
    }

    /*function check_code_email(email, enrollment_code) {
        var flag;

        $.ajax({
            url   : SITE_URL+"/teacher/my-student/add/existing/check-email-code",
            type : "POST",
            async : false,
            data: { _token:csrf_token, email:email, enrollment_code:enrollment_code },
            success : function(result)
            {
                if($.trim(result) == 'success')
                {
                    flag = 1;
                }
                else if($.trim(result) == 'error')
                {
                    flag = 0;
                }
            }
        });
        return flag;
    }*/

    $(document).ready(function() {

        check_radio_btn();
        get_student_pin();

        $('.student_type').change(function() {
            check_radio_btn();
        });

        $(".open_add_student_popup").click(function() {
            var class_id   = $(this).data('class_id');
            var grade_id   = $(this).data('grade_id');
            var subject_id = $(this).data('subject_id');
            var program_id = $(this).data('program_id');

            $("#add_student_in_class").val(class_id);
            $("#add_student_grade_id").val(grade_id);
            $("#add_student_subject_id").val(subject_id);
            $("#add_student_program_id").val(program_id);
        });

        $('#add_student_fields').click(function() {
            var flag = 1;

            get_student_pin();

            $(".add_new_student_fields").each(function() {
                var student_pin_temp   = $("#temp_pin").val();
                var student_first_name = $(this).find('.student_first_name').val();
                var student_last_name  = $(this).find('.student_last_name').val();
                var student_pin        = $(this).find('.student_pin').val();

                if($.trim(student_first_name) == '') {
                    $(this).last().find('.err_student_first_name').html(error_first_name);
                    $(this).find('.student_first_name').on('click',function(){ $(this).find('.err_student_first_name').html(""); });
                    flag = 0;
                } else {
                    $(this).find('.err_student_first_name').html('');
                    flag = 1;
                }

                if($.trim(student_last_name) == '') {
                    $(this).last().find('.err_student_last_name').html(error_last_name);
                    $(this).find('.student_last_name').on('click',function(){ $(this).find('.err_student_last_name').html(""); });
                    flag = 0;
                } else {
                    $(this).find('.err_student_last_name').html('');
                    flag = 1;
                }

                if(student_pin == student_pin_temp) {
                    get_student_pin();
                }
                
            });
            
            if(flag == 1) {
                var student_pin = $("#temp_pin").val();
                $('.add_new_student_fields').last().clone().insertAfter( $('.add_new_student_fields').last() ).addClass('clone_div');
                $('.add_new_student_fields').last().find('input').val('');
                $('.student_pin').last().val(student_pin);
            }

        });

        $('#transfer_student_fields').click(function() {
            var email_filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            var flag         = 1;

            $(".add_transfer_student_fields").each(function() {
                var old_teacher_email      = $(this).find('.old_teacher_email').val();
                var old_student_pin        = $(this).find('.old_student_pin').val();

                if($.trim(old_teacher_email) == '') {
                    $(this).last().find('.err_old_teacher_email').show().html(error_teacher_email_mobile);
                    $(this).find('.old_teacher_email').on('click',function(){ $(this).find('.err_old_teacher_email').html(""); });
                    flag = 0;
                } else if($.trim(old_teacher_email) != '') {

                } else {
                    $(this).find('.err_old_teacher_email').html("");
                    flag = 1;
                }

                if($.trim(old_student_pin) == '') {
                    $(this).last().find('.err_old_student_pin').show().html(error_student_pin);
                    $(this).find('.old_student_pin').on('click',function(){ $(this).find('.err_old_student_pin').html(""); });
                    flag = 0;
                } else {
                    $(this).find('.err_old_student_pin').html("");
                    flag = 1;
                }
            });
            
            if(flag == 1) {
                $('.add_transfer_student_fields').last().clone().insertAfter( $('.add_transfer_student_fields').last() ).addClass('clone_div');
                $('.add_transfer_student_fields').last().find('input').val('');
            }

        });

        $('#existing_student_fields').click(function() {
            var email_filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            var flag         = 1;

           $(".add_existing_student_fields").each(function() {
                var parent_teacher_email = $(this).find('.parent_teacher_email').val();
                var pin                  = $(this).find('.pin').val();

                if($.trim(parent_teacher_email) != '') 
                {
                    if($.isNumeric(parent_teacher_email)) {
                        var value_is = 'mobile';
                    } else {
                        var value_is = 'email';
                    }
                    
                    if(!email_filter.test(parent_teacher_email) && value_is == 'email') {
                        $(this).last().find('.err_parent_teacher_email').html(error_valid_parent_teacher_email);
                        $(this).find('.parent_teacher_email').on('click',function(){ $(this).find('.err_parent_teacher_email').html(""); });
                        flag = 0;
                    } else if(email_filter.test(parent_teacher_email) && value_is == 'email') {
                        $(this).find('.err_parent_teacher_email').html("");
                    }

                    if($.trim(parent_teacher_email).length < 8 && value_is == 'mobile') {
                        $(this).last().find('.err_parent_teacher_email').html(err_mobile_length_min);
                        $(this).find('.parent_teacher_email').on('click',function(){ $(this).find('.err_parent_teacher_email').html(""); });
                        flag = 0;
                    } else if($.trim(parent_teacher_email).length > 8 && value_is == 'mobile') {
                        $(this).find('.err_parent_teacher_email').html("");
                    }

                } else {
                    $(this).find('.err_parent_teacher_email').html("");
                }

                if($.trim(pin) == '') {
                    $(this).last().find('.err_pin').html(error_pin);
                    $(this).find('.pin').on('click',function(){ $(this).find('.err_pin').html(""); });
                    flag = 0;
                } else if($.trim(pin) != '' && $.trim(pin).length != 4) {
                    $(this).last().find('.err_pin').html(error_pin_length);
                    $(this).find('.pin').on('click',function(){ $(this).find('.err_pin').html(""); });
                    flag = 0;
                } else if($.trim(pin).length == 4) {
                    $(this).find('.err_pin').html("");
                }
            });
            
            if(flag == 1) {
                $('.add_existing_student_fields').last().clone().insertAfter( $('.add_existing_student_fields').last() ).addClass('clone_div');
                $('.add_existing_student_fields').last().find('input').val('');
            }

        });

        $("#close_add_student_popup, #cancel_add_student_popup").click(function() {
            $('#form_add_student')[0].reset();
            $("#education_fields").html('');
            $(".error").html('');
            check_radio_btn();
        });

        //$('#btn_add_student').click( function() {
        $(document).on('click','#btn_add_student',function() {
            var email_filter     = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            var email_flag       = 1;
            var add_student_flag = 1;

            var checked_student_type = $('input[name=student_type]:checked').val();

            if(checked_student_type == 'new_student') {
                $('.add_new_student_fields .required').each( function() {
                    var element = $(this);
                    var value   = element.val();
                    var name    = element.data('name');

                    if ( value == "" ) {
                        add_student_flag = 0;
                        element.closest('.name-field').next().html(error_Please_enter+name);
                        element.on('keyup', function(){ element.closest('.name-field').next().html(''); });
                    }

                });
            } else if(checked_student_type == 'transfer_from_another') {

                $('.add_transfer_student_fields .required').each( function() {
                    var element = $(this);
                    var value   = element.val();
                    var name    = element.data('name');

                    if ( value == "" ) {
                        add_student_flag = 0;
                        element.closest('.name-field').next().html(error_Please_enter+name);
                        element.on('keyup', function(){ element.closest('.name-field').next().html(''); });
                    }
                    
                    if( value != "" && name.indexOf('email') != -1) {

                        if($.isNumeric(value)) {
                            var value_is = 'mobile';
                        } else {
                            var value_is = 'email';
                        }

                        if(!email_filter.test(value) && value_is == 'email') {
                            add_student_flag = 0;
                            element.closest('.name-field').next().html(error_valid_email);
                            element.on('keyup', function(){ element.closest('.name-field').next().html(''); });
                        }
                        if($.trim(value).length < 8 && value_is == 'mobile') {
                            add_student_flag = 0;
                            element.closest('.name-field').next().html(err_mobile_length_min);
                            element.on('keyup', function(){ element.closest('.name-field').next().html(''); });
                        }
                    }

                });

            } else if(checked_student_type == 'existing_student') {

                $('.add_existing_student_fields input[type="text"]').each( function() {
                    var element  = $(this);
                    var value    = element.val();
                    var name     = element.data('name');
                    var required = element.data('required');

                    if ( value == "" && required == "yes" ) {
                        add_student_flag = 0;
                        element.closest('.name-field').next().html(error_Please_enter+name);
                        element.on('keyup', function(){ element.closest('.name-field').next().html(''); });
                    }

                    if( value != "" && name.indexOf('email') != -1) {

                        if($.isNumeric(value)) {
                            var value_is = 'mobile';
                        } else {
                            var value_is = 'email';
                        }

                        if(!email_filter.test(value) && value_is == 'email') {
                            add_student_flag = 0;
                            element.closest('.name-field').next().html(error_valid_email);
                            element.on('keyup', function(){ element.closest('.name-field').next().html(''); });
                        }
                        if($.trim(value).length < 8 && value_is == 'mobile') {
                            add_student_flag = 0;
                            element.closest('.name-field').next().html(err_mobile_length_min);
                            element.on('keyup', function(){ element.closest('.name-field').next().html(''); });
                        }
                    }

                });
            }

            if( add_student_flag == 0 ) {
                return false;
            } else {
                return true;
            }
        });

        // For transfer student fields starts
        $(document).on('blur click','.old_teacher_email',function() {
            var old_teacher_email = $(this).val();
            var old_student_pin   = $(this).closest('.name-field').closest('.add_transfer_student_fields').find('.old_student_pin').val();
            var flag              = 1;

            if($.trim(old_teacher_email) != '' && $.trim(old_student_pin) != '' ) {
                var output = check_email_data(old_teacher_email, old_student_pin);
                
                if($.trim(output) != '')
                {
                    $(this).closest('.name-field').closest('.add_transfer_student_fields').find('.old_student_first_name').val( output['first_name'] );
                    $(this).closest('.name-field').closest('.add_transfer_student_fields').find('.old_student_last_name').val( output['last_name'] );
                }
                else
                {
                    $(this).closest('.name-field').closest('.add_transfer_student_fields').find('.old_student_first_name').val( "" );
                    $(this).closest('.name-field').closest('.add_transfer_student_fields').find('.old_student_last_name').val( "" );
                    flag = 0;
                }

                if(flag == 0) {
                    $(this).closest('.name-field').next().closest('.add_transfer_student_fields').find('.err_old_teacher_email').html(error_email_mobile_doesnt_belong);
                    return false;
                } else {
                    $(this).closest('.name-field').next().closest('.add_transfer_student_fields').find('.err_old_teacher_email').html("");
                    return true;
                }
            }
        });

        $(document).on('blur click','.old_student_pin',function() {
            var old_teacher_email = $(this).closest('.name-field').closest('.add_transfer_student_fields').find('.old_teacher_email').val();
            var old_student_pin   = $(this).val();
            var flag              = 1;

            if($.trim(old_teacher_email) != '' && $.trim(old_student_pin) != '' ) {
                var output = check_email_data(old_teacher_email, old_student_pin);

                if($.trim(output) != '')
                {
                    $(this).closest('.name-field').closest('.add_transfer_student_fields').find('.old_student_first_name').val( output['first_name'] );
                    $(this).closest('.name-field').closest('.add_transfer_student_fields').find('.old_student_last_name').val( output['last_name'] );
                }
                else
                {
                    $(this).closest('.name-field').closest('.add_transfer_student_fields').find('.old_student_first_name').val( "" );
                    $(this).closest('.name-field').closest('.add_transfer_student_fields').find('.old_student_last_name').val( "" );
                    flag = 0;
                }

                if(flag == 0) {
                    $(this).closest('.name-field').next().closest('.add_transfer_student_fields').find('.err_old_student_pin').html(error_student_pin_doesnt_belong);
                    return false;
                } else {
                    $(this).closest('.name-field').next().closest('.add_transfer_student_fields').find('.err_old_student_pin').html("");
                    return true;
                }
            }
        });
        // transfer student fields ends

    });
</script>
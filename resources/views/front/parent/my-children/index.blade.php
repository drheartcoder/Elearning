@include('front.layout.bredcrum')

<div class="gray-btn-main-section dashboard-middle-section">
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-md-3 col-lg-3">
                @include('front.layout.left_bar')
            </div>
            <div class="col-sm-8 col-md-9 col-lg-9">
                <div class="add-class-button-section">
                  @if($subscription_plan_status==true)
                     <a class="full-orng-btn btn-width-adjustment sim-button" onclick="ShowSubscriptionExpiredMsg()" data-backdrop="static" data-keyboard="false"><i class="fa fa-plus"></i> {{trans('parent.Add_Child')}} </a>
                  @elseif($plan_purchased_status=='pending')
                    <a class="full-orng-btn btn-width-adjustment sim-button" onclick="ShowSubscriptionErrorMsg('pending')" data-backdrop="static" data-keyboard="false"><i class="fa fa-plus"></i> {{trans('parent.Add_Child')}} </a>
                  @elseif($is_user_request_wire_transfer==false)
                    <a class="full-orng-btn btn-width-adjustment sim-button" onclick="ShowSubscriptionErrorMsg()" data-backdrop="static" data-keyboard="false"><i class="fa fa-plus"></i> {{trans('parent.Add_Child')}} </a>
                  @elseif($global_add_child_limit_status==false)
                    <a class="full-orng-btn btn-width-adjustment sim-button" onclick="ShowAddChildLimitErrorMsg()" data-backdrop="static" data-keyboard="false"><i class="fa fa-plus"></i> {{trans('parent.Add_Child')}} </a>
                  @else 
                    @if($allow_to_add_child == "yes")
                    <a class="full-orng-btn btn-width-adjustment sim-button" data-toggle="modal" data-target="#add-child" data-backdrop="static" data-keyboard="false"><i class="fa fa-plus"></i> {{trans('parent.Add_Child')}} </a>
                    @elseif($allow_to_add_child == "no")
                    <a class="full-orng-btn btn-width-adjustment sim-button" data-toggle="modal" data-target="#child-not-allowed" data-backdrop="static" data-keyboard="false"><i class="fa fa-plus"></i> {{trans('parent.Add_Child')}} </a>
                    @endif
                @endif
                </div>   
                @if($subscription_plan_status==true)
                <div class="alert alert-danger">
                    <i class="fa fa-exclamation-triangle fa-lg"></i>
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{trans('parent.Your_Membership_Plan_Expired_Now_Msg')}} 
                </div>  
                @endif
                @include('front.layout._operation_status')

                <div class="row">
                    
                    @if( isset($arr_children) && !empty($arr_children) )
                    
                        @foreach($arr_children as $child)

                            @php
                                $child_id    = isset($child['user_data']['id']) && !empty($child['user_data']['id']) ? base64_encode($child['user_data']['id']) : '';
                                $child_fname = isset($child['user_data']['first_name']) && !empty($child['user_data']['first_name']) ? ucfirst($child['user_data']['first_name']) : '';
                                $child_lname = isset($child['user_data']['last_name']) && !empty($child['user_data']['last_name']) ? ucfirst($child['user_data']['last_name']) : '';
                                $child_pin   = isset($child['user_data']['pin']) && !empty($child['user_data']['pin']) ? $child['user_data']['pin'] : '';

                                $subject_id    = isset($child['subject_data']['id']) && !empty($child['subject_data']['id']) ? $child['subject_data']['id'] : '';
                                $subject_name  = isset($child['subject_data']['name']) && !empty($child['subject_data']['name']) ? ucfirst($child['subject_data']['name']) : '-';

                                $grade_id    = isset($child['grade_data']['id']) && !empty($child['grade_data']['id']) ? $child['grade_data']['id'] : '';
                                $grade_name  = isset($child['grade_data']['name']) && !empty($child['grade_data']['name']) ? $child['grade_data']['name'] : '-';
                            @endphp

                            <div class="col-sm-6 col-md-4 col-lg-4">
                                <div class="class-section-block">
                                    
                                    <div class="class-head-section">
                                        <div class="class-head-block"><a style="color: white" href="{{url('/parent/my-program/').'/'.$child_id}}">{{ $child_fname.' '.$child_lname }}</a></div>
                                        <div class="class-action-section">
                                            
                                            <a href="javascript:void(0)" class="edit_child" data-toggle="modal" data-target="#edit-child" data-backdrop="static" data-keyboard="false" data-child_id="{{ $child_id }}" data-class_fname="{{ $child_fname }}" data-class_lname="{{ $child_lname }}" data-subject_id="{{ $subject_id }}" data-grade_id="{{ $grade_id }}" data-child_pin="{{ $child_pin }}"><i class="far fa-edit"></i> </a>

                                            <a href="javascript:void(0)" class="delete_child" data-toggle="modal" data-target="#remove-child" data-backdrop="static" data-keyboard="false" data-child_id="{{ $child_id }}" ><i class="far fa-trash-alt"></i> </a>

                                        </div>
                                        <div class="clearfix"></div>
                                    </div>

                                    <div class="class-details-section">
                                        
                                        <div class="class-details-icon-txt-section">
                                            <div class="class-details-icon-section">
                                               <i class="fa fa-user-o"></i>
                                            </div>
                                            <div class="class-details-txt-section">
                                                <span>{{trans('parent.Subject')}} : </span> {{ $subject_name }}
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>

                                        <div class="class-details-icon-txt-section">
                                            <div class="class-details-icon-section">
                                               <i class="fa fa-user-o"></i>
                                            </div>
                                            <div class="class-details-txt-section">
                                                <span>{{trans('parent.Grade')}}  : </span> {{ $grade_name }}
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>

                                        <div class="class-details-icon-txt-section">
                                            <div class="class-details-icon-section">
                                                <img src="{{ url('/') }}/images/my-children-pin-icon.png" alt="pin icon" />
                                            </div>
                                            <div class="class-details-txt-section">
                                                <span> {{trans('auth.PIN')}} : </span> {{ $child_pin }}
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>

                                        <!-- <div class="class-details-icon-txt-section class-details-end-date">
                                            <div class="class-details-icon-section">
                                               <img src="{{ url('/') }}/images/my-children-program-icon.png" alt="pin icon" />
                                            </div>
                                            <div class="class-details-txt-section">
                                                <span>Program : </span>Addition
                                            </div>
                                            <div class="clearfix"></div>
                                        </div> -->

                                        <div class="add-stu-my-stu-btn-section">
                                            @if($subscription_plan_status==true)

                                            <a class="full-orng-btn sim-button" onclick="ShowSubscriptionExpiredMsg()" >{{trans('parent.Change_Program')}}</a>


                                            @else
                                            <a class="full-orng-btn sim-button" href="{{url('/parent/change-program/').'/'.$child_id}}">{{trans('parent.Change_Program')}}</a>

                                            @endif
                                            <a class="full-orng-btn my-stydent-section sim-button-blue" href="{{url('/parent/my-program/').'/'.$child_id}}">{{trans('parent.My_Programs')}}</a>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="class-section-block">
                                <div class="class-details-section">
                                    <div class="class-details-icon-txt-section">
                                        <div class="class-details-txt-section" style="text-align: center;">
                                            {{trans('parent.There_are_no_children_to_show')}}
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>   
    </div>
</div>

<!-- Modal -->
<div id="add-child" class="modal fade inner-page-modal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" id="close_add_children_popup"></button>
                <div class="modal-head-section">
                    {{trans('parent.Add_Child')}}
                </div>

                <form id="form_parent_add_child" method="post" action="{{ url('/') }}/parent/my-children/add">
                {{ csrf_field() }}

                <div class="student-type-section">
                    <div class="student-type-head">
                        {{trans('parent.Type_of_Child')}}
                    </div>

                    <div class="students-type">
                        
                        <div class="radio-btns">
                            
                            <div class="radio-btn">
                                <input type="radio" class="child_type" name="child_type" id="not_using_system" value="not_using_system" data-terms="yes" checked />
                                <label for="not_using_system">{{trans('parent.Child_not_using_our_System')}}</label>
                                <div class="check"></div>
                            </div>
                            
<!--                             <div class="radio-btn">
                                <input type="radio" class="child_type" name="child_type" id="with_using_system" value="with_using_system" data-terms="yes" />
                                <label for="with_using_system">{{trans('parent.Child_with_our_System_Account')}}</label>
                                <div class="check"></div>
                            </div> -->

                            <div class="radio-btn">
                                <input type="radio" class="child_type" name="child_type" id="using_system" value="using_system" data-terms="no">
                                <label for="using_system">{{trans('parent.Child_using_our_system_at_School')}}</label>
                                <div class="check"></div>
                            </div>

                        </div>

                        <div class="form-section-add-child form_fields" id="div_not_using_system" style="display: none;" >

                            <div class="row">
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>{{trans('auth.First_Name')}}<i class="red">*</i></label>
                                        <div class="name-field">
                                            <input type="text" class="form-control alphabets" id="new_first_name" name="new_first_name" placeholder="{{trans('parent.Enter_first_name')}}"  maxlength="50" data-name="first name" />
                                        </div>
                                        <div class="error" id="err_new_first_name"></div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>{{trans('auth.Last_Name')}}<i class="red">*</i></label>
                                        <div class="name-field">
                                            <input type="text" class="form-control alphabets" id="new_last_name" name="new_last_name" placeholder="{{trans('parent.Enter_last_name')}}"  maxlength="50" data-name="last name" />
                                        </div>
                                        <div class="error" id="err_new_last_name"></div>
                                    </div>
                                </div>

                                <!-- @if( isset($arr_subject) && !empty($arr_subject) )
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Subject<i class="red">*</i></label>
                                        <div class="name-field">
                                            <select name="subject" id="subject">
                                                <option value="">Select Subject</option>
                                                @foreach($arr_subject as $subject)
                                                    <option value="{{ $subject['id'] }}">{{ $subject['name'] }}</option>
                                                @endforeach
                                            </select>
                                            <i class="fa fa-angle-down"></i>
                                        </div>
                                        <div class="error" id="err_subject"></div>
                                    </div>
                                </div>
                                @endif

                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Grade<i class="red">*</i></label>
                                        <div class="name-field">
                                            <select name="grade" id="grade">
                                                <option value="">Select Grade</option>
                                            </select>
                                            <i class="fa fa-angle-down"></i>
                                        </div>
                                        <div class="error" id="err_grade"></div>
                                    </div>
                                </div> -->

                            </div>

                        </div>

                        <div class="form-section-add-child form_fields" id="div_with_using_system" style="display: none;" >
                            
                            <div class="row">
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>{{trans('auth.First_Name')}}<i class="red">*</i></label>
                                        <div class="name-field">
                                            <input type="text" class="form-control alphabets" id="old_first_name" name="old_first_name" placeholder="{{trans('parent.Enter_first_name')}}"  maxlength="50" data-name="first name" />
                                        </div>
                                        <div class="error" id="err_old_first_name"></div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>{{trans('auth.Last_Name')}}<i class="red">*</i></label>
                                        <div class="name-field">
                                            <input type="text" class="form-control alphabets" id="old_last_name" name="old_last_name" placeholder="{{trans('parent.Enter_last_name')}}"  maxlength="50" data-name="last name" />
                                        </div>
                                        <div class="error" id="err_old_last_name"></div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>{{trans('parent.Teachers_Email_Mobile')}}<i class="red">*</i></label>
                                        <div class="name-field">
                                            <input type="text" class="form-control" id="teacher_email" name="teacher_email" placeholder="{{trans('teacher.Enter_Teacher_Email_or_Mobile')}}" maxlength="70" />
                                        </div>
                                        <div class="error" id="err_teacher_email"></div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>{{trans('auth.PIN')}}<i class="red">*</i></label>
                                        <div class="name-field">
                                            <input type="text" class="form-control digits" id="old_pin" name="pin" maxlength="4" placeholder="{{trans('auth.Enter_your_PIN')}}" maxlength="4" />
                                        </div>
                                        <div class="error" id="err_old_pin"></div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="form-section-add-child form_fields" id="div_using_system" style="display: none;" >
                            
                            <div class="row">
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>{{trans('parent.Teachers_Email_Mobile')}}<i class="red">*</i></label>
                                        <div class="name-field">
                                            <input type="text" class="form-control" id="code_teacher_email" name="code_teacher_email" placeholder="{{trans('teacher.Enter_Teacher_Email_or_Mobile')}}" maxlength="70" />
                                        </div>
                                        <div class="error" id="err_code_teacher_email"></div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>{{trans('auth.Enrollment_Code')}}<i class="red">*</i></label>
                                        <div class="name-field">
                                            <input type="text" class="form-control" id="enrollment_code" name="enrollment_code" placeholder="{{trans('teacher.Enter_your_Enrollment_Code')}}" minlength="14" maxlength="15" />
                                        </div>
                                        <div class="error" id="err_enrollment_code"></div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row" id="addition_div" style="display: none;">
                            @if(isset($arr_subject) && !empty($arr_subject))
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
                                    <div class="error" id="err_subject"></div>
                                </div>
                            </div>
                            @endif

                            <div class="col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>{{trans('parent.Grade')}}<i class="red">*</i></label>
                                    <div class="name-field">
                                        <select name="grade" id="grade">
                                            <option value="">{{trans('parent.Select_Grade')}}</option>
                                        </select>
                                        <i class="fa fa-angle-down"></i>
                                    </div>
                                    <div class="error" id="err_grade"></div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>{{trans('parent.Program')}}<i class="red">*</i></label>
                                    <div class="name-field">
                                        <select name="program" id="program">
                                            <option value="">{{trans('parent.Select_Program')}}</option>
                                        </select>
                                        <i class="fa fa-angle-down"></i>
                                    </div>
                                    <div class="error" id="err_program"></div>
                                </div>
                            </div>
                        </div>

                        <!-- <div class="form-group" id="div_termsconditions">
                            <div class="check-block">
                                <input type="checkbox" class="filled-in" id="termsconditions" name="termsconditions" >
                                <label for="termsconditions">By enrolling my child in Merit Learning, I give my consent for Merit Learning to record my child's skill progress, generate reports summarizing my child's progress, and use my child's information consistent with Merit Learning's <a href="javascript:void(0)">Terms of Service</a>, <a href="javascript:void(0)">Privacy Policy</a> and <a href="javascript:void(0)">Data Retention Policy</a>.</label>
                            </div>
                            <div class="error" id="err_termsconditions"></div>
                        </div> -->

                    </div>
                </div>                    
                <div class="modal-button-section">                        
                    <button type="submit" class="full-fill-button sim-button" id="btn_submit_add_child">{{trans('parent.Submit')}}</button>
                </div>

                </form>

            </div>
        </div>
    </div>
</div>

<div id="edit-child" class="modal fade inner-page-modal edit-class-info-modal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" id="close_edit_child_pop" data-dismiss="modal"></button>
                <div class="modal-head-section">
                    {{trans('parent.Edit_Child')}}
                </div>

                <form id="form_edit_child" method="post" action="{{ url('/') }}/parent/my-children/update">
                {{ csrf_field() }}

                <div class="row">
                    
                <input type="hidden" id="edit_child_id" name="child_id" />

                    <div class="col-sm-6 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label>{{trans('auth.First_Name')}}<i class="red">*</i></label>
                            <div class="name-field">
                                <input type="text" class="form-control alphabets" id="edit_first_name" name="first_name" placeholder="{{trans('parent.Enter_first_name')}}" value="" maxlength="50" />
                            </div>
                            <div class="error" id="err_edit_first_name"></div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label>{{trans('auth.Last_Name')}}<i class="red">*</i></label>
                            <div class="name-field">
                                <input type="text" class="form-control alphabets" id="edit_last_name" name="last_name" placeholder="{{trans('auth.Enter_last_name')}}" value="" maxlength="50" />
                            </div>
                            <div class="error" id="err_edit_last_name"></div>
                        </div>
                    </div>

                    @if( isset($arr_subject) && !empty($arr_subject) )
                    <div class="col-sm-6 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label>{{trans('parent.Subject')}}<i class="red">*</i></label>
                            <div class="name-field">
                                <select id="edit_subject" name="subject" >
                                    <option value="">{{trans('parent.Select_Subject')}}</option>
                                    @foreach($arr_subject as $subject)
                                        <option value="{{ $subject['id'] }}">{{ $subject['name'] }}</option>
                                    @endforeach
                                </select>
                                <i class="fa fa-angle-down"></i>
                            </div>
                            <div class="error" id="err_edit_subject"></div>
                        </div>
                    </div>
                    @endif

                    <!-- @if( isset($arr_grade) && !empty($arr_grade) ) -->
                    <div class="col-sm-6 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label>{{trans('parent.Grade')}}<i class="red">*</i></label>
                            <div class="name-field">
                                <select id="edit_grade" name="grade" >
                                    <option value="">{{trans('parent.Select_Grade')}}</option>
                                    <!-- @foreach($arr_grade as $grade)
                                        <option value="{{ $grade['id'] }}">{{ $grade['name'] }}</option>
                                    @endforeach -->
                                </select>
                                <i class="fa fa-angle-down"></i>
                            </div>
                            <div class="error" id="err_edit_grade"></div>
                        </div>
                    </div>
                    <!-- @endif -->

                    <div class="col-sm-6 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label>{{trans('auth.PIN')}}</label>
                            <div class="name-field">
                                <input type="text" class="form-control digits" id="edit_pin" name="pin" placeholder="{{trans('auth.Enter_your_PIN')}}" value="" maxlength="4" readonly />
                            </div>
                            <div class="error" id="err_edit_pin"></div>
                        </div>
                    </div>

                </div>
                <div class="modal-button-section">
                    <button type="button" class="full-fill-button border-button sim-button-blue" id="btn_cancel_edit_child" data-dismiss="modal">{{trans('parent.Cancel')}}</button>
                    <button type="submit" class="full-fill-button sim-button" id="btn_submit_edit_child">{{trans('parent.Update')}}</button>
                </div>

                </form>

            </div>
        </div>
    </div>
</div>

<div id="remove-child" class="modal fade inner-page-modal remove-class-modal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal"></button>
                <div class="modal-head-section">
                    {{trans('parent.Remove_Child')}}
                </div>
                <div class="remove-modal-txt-block">
                    {{trans('parent.Do_you_really_want_to_remove')}}
                </div>
                <div class="modal-note-section">
                    {{trans('parent.If_the_child_account_is_not_associated')}} 
                </div>
                <form id="form_delete_child" method="post" action="{{ url('/') }}/parent/my-children/delete">
                    {{ csrf_field() }}
                    <input type="hidden" name="delete_child_id" id="txt_delete_child_id" value="" />
                    <div class="modal-button-section">
                        <button type="button" class="full-fill-button border-button sim-button-blue" data-dismiss="modal">{{trans('parent.Cancel')}}</button>
                        <button type="submit" id="btn_delete_child" class="full-fill-button sim-button">{{trans('auth.Confirm')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="child-not-allowed" class="modal fade inner-page-modal remove-class-modal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal"></button>
                <div class="modal-head-section">
                   {{trans('auth.Note')}} 
                </div>
                <div class="remove-modal-txt-block">
                  {{trans('parent.As_per_your_selected_subscription')}}<br/><br/>{{trans('parent.To_add_more_child_upgrade_subscription')}}
                </div>
                <div class="modal-button-section">
                    <button type="button" class="full-fill-button sim-button" data-dismiss="modal">{{trans('parent.Close')}}</button>
                </div>
            </div>
        </div>
    </div>
</div>

@include('front.layout.bredcrum')

<div class="gray-btn-main-section dashboard-middle-section page-middle-section">
    <div class="container">
        <div class="clearfix"></div>
        @include('front.layout._operation_status')

        <div class="row">
             <div class="col-sm-4 col-md-3 col-lg-3">
                @include('front.layout.teacher_left_bar')
             </div>
             <div class="col-sm-8 col-md-9 col-lg-9">
                 <div class="add-class-button-section">      
                    <form id="frmSearchClass" name="frmSearchClass" method="get">
                        <div style="text-align: left;">
                            <div class="row">
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">                    
                                        <input type="text" id="keyword" name="keyword" placeholder="{{trans('parent.Search_Keyword')}}" tabindex="1" value="{{ Request::get('keyword')!=null && Request::get('keyword')!='' ? Request::get('keyword') : '' }}" />
                                        <div class="error" id="err_keyword">{{$errors->first('keyword')}}</div>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
                                    <button class="full-orng-btn btn-width-adjustment sim-button" style="margin: 0px 0 25px;"><i class="fa fa-search"></i></button>
                                    <button type="button" onclick="window.location.href='{{url('/teacher/class')}}'" class="full-orng-btn btn-width-adjustment sim-button" style="margin: 0px 0 25px;"><i class="fa fa-retweet"></i></button>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
                                    <a class="full-orng-btn btn-width-adjustment sim-button mar0" data-toggle="modal" data-target="#add-class" data-backdrop="static" data-keyboard="false"><i class="fa fa-plus"></i> {{trans('teacher.Add_Class')}} </a>
                                </div>
                            </div>
                        </div>
                     </form>
                    </div>
                <div class="clearfix"></div>
                <div class="row">
                    @if( isset($arr_classes['data']) && !empty($arr_classes['data']))
                        
                        @foreach($arr_classes['data'] as $class)                
                            @php 
                                $class_id     = isset($class['id']) && !empty($class['id']) ? base64_encode($class['id']) : '';
                                $class_name   = isset($class['name']) && !empty($class['name']) ? ucfirst($class['name']) : '';
                                $grade_id     = isset($class['grade_details']['id']) && !empty($class['grade_details']['id']) ? $class['grade_details']['id'] : '';
                                $grade_name   = isset($class['grade_details']['name']) && !empty($class['grade_details']['name']) ? $class['grade_details']['name'] : '';
                                $subject_id   = isset($class['subject_details']['id']) && !empty($class['subject_details']['id']) ? $class['subject_details']['id'] : '';
                                $subject_name = isset($class['subject_details']['name']) && !empty($class['subject_details']['name']) ? ucfirst($class['subject_details']['name']) : '';
                                $program_id   = isset($class['program_details']['id']) && !empty($class['program_details']['id']) ? $class['program_details']['id'] : '';
                                $start_date   = isset($class['start_date']) && !empty($class['start_date']) ? get_added_on_date($class['start_date']) : '';
                                $end_date     = isset($class['end_date']) && !empty($class['end_date']) ? get_added_on_date($class['end_date']) : '';
                                $current_date = isset($current_date) && !empty($current_date) ? get_added_on_date($current_date) : '';
                                $share_class  = isset($class['share_class_id']) && !empty($class['share_class_id']) ? $class['share_class_id'] : '';

                                if( !empty($share_class) && $share_class != null )
                                {
                                    $share = '<i class="fa fa-share-alt" aria-hidden="true" style="color: #fff;"></i>';
                                }
                                else
                                {
                                    $share = '';
                                }

                                if(strtotime($current_date) <= strtotime($end_date))
                                {
                                    $expired       = "no";
                                    $edit_class    = "edit-class";
                                    $add_student   = "add-student";
                                    $expired_class = "";
                                    $disable_link  = "";
                                }
                                else
                                {
                                    $expired       = "yes";
                                    $edit_class    = "";
                                    $add_student   = "";
                                    $expired_class = "background:#808080; border: 1px solid #cccccc; color: #fff;";
                                    $disable_link  = "cursor: not-allowed;";
                                }
                            @endphp
                            <div class="col-sm-6 col-md-6 col-lg-4">
                                <div class="class-section-block height-auto">
                                    <div class="class-head-section" style="{{ $expired_class }}">
                                        <a class="class-head-block" href="{{ url('/') }}/teacher/my-student/{{ $class_id }}">{{ $class_name }}</a>
                                        <div class="class-action-section">
                                            {!! $share !!}
                                            <a href="javascript:void(0)" class="edit_class" data-toggle="modal" data-target="#{{ $edit_class }}" data-backdrop="static" data-keyboard="false" data-id="{{ $class_id }}" data-class_name="{{ $class_name }}" data-grade_id="{{ $grade_id }}" data-subject_id="{{ $subject_id }}" data-program_id="{{ $program_id }}" data-end_date="{{ $end_date }}" style="{{ $disable_link }}"><i class="far fa-edit"></i> </a>
                                            <a href="javascript:void(0)" class="delete_class" data-toggle="modal" data-target="#remove-class" data-backdrop="static" data-keyboard="false" data-id="{{ $class_id }}" ><i class="far fa-trash-alt"></i> </a>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="class-details-section">
                                        <div class="class-details-icon-txt-section">
                                            <div class="class-details-icon-section">
                                               <i class="fa fa-user-o"></i>
                                            </div>
                                            <div class="class-details-txt-section">
                                                <span>{{trans('teacher.Class_Id')}} : </span> {{ isset($class['class_enrollment_code']) && !empty($class['class_enrollment_code']) ? $class['class_enrollment_code'] : '' }}
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="class-details-icon-txt-section">
                                            <div class="class-details-icon-section">
                                               <i class="fa fa-user-o"></i>
                                            </div>
                                            <div class="class-details-txt-section">
                                                <span>{{trans('parent.Grade')}} : </span> {{ $grade_name }}
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="class-details-icon-txt-section">
                                            <div class="class-details-icon-section">
                                                <i class="fa fa-book"></i>
                                            </div>
                                            <div class="class-details-txt-section">
                                                <span>{{trans('parent.Subject')}} : </span> {{ $subject_name }}
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="class-details-icon-txt-section class-details-end-date">
                                            <div class="class-details-icon-section">
                                               <i class="far fa-calendar-alt"></i>
                                            </div>
                                            <div class="class-details-txt-section">
                                                <span>{{trans('teacher.End_Date')}} : </span> {{ $end_date }}
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="add-stu-my-stu-btn-section">

                                            <a class="full-orng-btn sim-button open_add_student_popup" data-toggle="modal" data-target="#{{ $add_student }}" data-backdrop="static" data-keyboard="false" data-class_id="{{ $class_id }}" data-grade_id="{{ $grade_id }}" data-subject_id="{{ $subject_id }}" data-program_id="{{ $program_id }}" style="{{ $expired_class.';'.$disable_link }}"><i class="fa fa-plus"></i> {{trans('teacher.Add_Student')}}</a>
                                            <a class="full-orng-btn my-stydent-section sim-button-blue" href="{{ url('/') }}/teacher/my-student/{{ $class_id }}" style="{{ $expired_class }}">{{trans('teacher.My_Student')}}</a>
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
                                            {{trans('teacher.no_classes_to_show')}}
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
        
        <div class="pagination-section-block">
            <ul>{!! $arr_pagination !!}</ul>
        </div>

    </div>
</div>

<!-- Modal -->
@include('front.teacher.my-class.add-student')
@include('front.teacher.my-class.class-options')

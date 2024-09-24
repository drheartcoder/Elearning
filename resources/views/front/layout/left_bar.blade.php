<?php $arr_user_details = $arr_user_details->toArray(); ?>

<div class="my-student-leftbar-section">
    <div class="left-menus">Menu <span class="left-menu-open">&#9776;</span></div>
    <ul class="left-emnu-ul">
        
        @if($arr_user_details['user_type']=='parent')        
            <li><a href="{{url('/'.$arr_user_details['user_type'].'/dashboard')}}" @if(Request::segment(2)=='dashboard') class="active" @endif>{{trans('home.Dashboard')}}</a></li>
            <li><a href="{{url('/'.$arr_user_details['user_type'].'/account-setting/my-profile')}}" @if(Request::segment(2)=='account-setting' && Request::segment(3)=='my-profile') class="active" @endif>{{trans('home.My_Profile')}}</a></li>
            <li><a href="{{url('/'.$arr_user_details['user_type'].'/my-kids')}}" @if(Request::segment(2)=='my-kids' || Request::segment(2)=='my-program' || Request::segment(2)=='change-program' || Request::segment(2)=='program-report') class="active" @endif>{{trans('home.My_Kids')}}</a></li>
            <!-- <li><a href="{{url('/'.$arr_user_details['user_type'].'/my-program/'.Request::segment(3))}}" @if(Request::segment(2)=='my-programs') class="active" @endif>Child Program</a></li> -->
            <li><a href="{{url('/'.$arr_user_details['user_type'].'/kids-pins')}}" @if(Request::segment(2)=='kids-pins') class="active" @endif>{{trans('home.Print_Pins')}}</a></li>
            <li @if(Request::segment(2)=='homework' || Request::segment(2)=='textbook') class="active" @endif>
                <a class="open-submenu" href="javascript:void(0)">{{trans('home.Downloads')}} <i class="fa fa-angle-down"></i></a>
                <ul class="leftbar-drop-section">
                    <!-- <li><a href="{{url('/'.$arr_user_details['user_type'].'/download/textbooks')}}" @if(Request::segment(2)=='transactions') class="active" @endif>Textbook</a></li>
                    <li><a href="{{url('/'.$arr_user_details['user_type'].'/download/homeworks')}}" @if(Request::segment(2)=='transactions') class="active" @endif>Homeworks</a></li> -->
                    <li><a href="{{ url('/'.$arr_user_details['user_type'].'/textbook') }}" @if(Request::segment(2)=='textbook') class="active" @endif>{{trans('home.Textbook')}}</a></li>
                    <li><a href="{{ url('/'.$arr_user_details['user_type'].'/homework') }}" @if(Request::segment(2)=='homework') class="active" @endif>{{trans('home.Homework')}}</a></li>
                </ul>
            </li>
            <li><a href="{{url('/'.$arr_user_details['user_type'].'/transactions')}}" @if(Request::segment(2)=='transactions') class="active" @endif>{{trans('home.Transactions')}}</a></li>
            <li><a href="{{url('/'.$arr_user_details['user_type'].'/notification')}}" @if(Request::segment(2)=='notification') class="active" @endif>{{trans('home.Notifications')}}</a></li>
            @if($arr_user_details['is_social'] == "no")
                <li><a href="{{url('/'.$arr_user_details['user_type'].'/account-setting/password/change')}}" @if(Request::segment(2)=='account-setting' && Request::segment(3)=='password') class="active" @endif>{{trans('home.Change_Password')}}</a></li>
            @endif
        <div class="reward-points-block">
            <h4>{{trans('home.Incentive_Amount')}}</h4>
            <div class="reward-points">
                <i class="fa fa-trophy"></i> ¥ {{get_incentive_amount($arr_user_details['id'])}}
            </div>
        </div>
        @elseif($arr_user_details['user_type']=='student')
            <li><a href="{{url('/'.$arr_user_details['user_type'].'/dashboard')}}" @if(Request::segment(2)=='dashboard' || Request::segment(2)=='my-program') class="active" @endif>{{trans('home.Dashboard')}}</a></li>
            @php
                $arr_programs = get_program_list($arr_user_details['id']);
                $arr_completed_programs = [];
                if(isset($arr_programs) && count($arr_programs))
                {
                    foreach ($arr_programs as $key => $value) {
                        $program_status = CheckProgramStatus($value['program_id'],$arr_user_details['id']);
                        if($program_status!='Pending')
                        {
                            array_push($arr_completed_programs, $value);
                        }
                    }
                }
             @endphp
            <li>
                @if(isset($arr_programs) && count($arr_programs)>0)
                    <a href="{{url('/'.$arr_user_details['user_type'].'/program/details/'.$arr_programs[0]['program_details']['slug'])}}" @if(Request::segment(2)=='program' && (Request::segment(3)=='details' || Request::segment(3)=='certificate')) class="active" @endif>{{trans('student.My_Programs')}}</a>
                @else
                    <a href="{{url('/')}}/{{$arr_user_details['user_type']}}/program/details/" @if(Request::segment(2)=='program' && (Request::segment(3)=='details' || Request::segment(3)=='certificate')) class="active" @endif>{{trans('student.My_Programs')}}</a>
                @endif
            </li>
            @if(isset($arr_completed_programs) && count($arr_completed_programs)>0)
            <li>
                    <a href="{{url('/'.$arr_user_details['user_type'].'/program/report/'.$arr_completed_programs[0]['program_details']['slug'])}}" @if(Request::segment(2)=='program' && (Request::segment(3)=='report')) class="active" @endif>{{trans('student.My_Reports')}}</a>
            </li>
            @endif
            <li @if(Request::segment(2)=='homework' || Request::segment(2)=='textbook') class="active" @endif>
                <a class="open-submenu" href="javascript:void(0)">{{trans('home.Downloads')}} <i class="fa fa-angle-down"></i></a>
                <ul class="leftbar-drop-section">
                    <li><a href="{{ url('/'.$arr_user_details['user_type'].'/textbook') }}" @if(Request::segment(2)=='textbook') class="active" @endif>{{trans('home.Textbook')}}</a></li>
                    <li><a href="{{ url('/'.$arr_user_details['user_type'].'/homework') }}" @if(Request::segment(2)=='homework') class="active" @endif>{{trans('home.Homework')}}</a></li>
                </ul>    
            </li>
            <li><a href="{{url('/'.$arr_user_details['user_type'].'/notification')}}" @if(Request::segment(2)=='notification') class="active" @endif>{{trans('home.Notifications')}}</a></li>
        @else        
            <?php
                $share_link = $expired_class = $transfer_link ='';
                if(Request::segment(3) != '')
                {
                    $arr_class = getClassData(Request::segment(3));
                    if($arr_class)
                    {
                        if(strtotime( date("Y-m-d") ) <= strtotime( $arr_class['end_date'] ))
                        {
                            $expired       = "no";
                            $expired_class = "";
                            $share_link    = url('/'.$arr_user_details['user_type'].'/share-class/'.Request::segment(3));
                            $transfer_link = url('/'.$arr_user_details['user_type'].'/transfer-class/'.Request::segment(3));
                        }
                        else
                        {
                            $expired       = "yes";
                            $expired_class = "background:#E3E3E3; border: 1px solid #E3E3E3; color: #333; cursor: not-allowed;";
                            $share_link    = "javascript:void(0);";
                            $transfer_link = "javascript:void(0);";
                        }
                    }
                }
            ?>
             <li><a href="{{url('/'.$arr_user_details['user_type'].'/dashboard')}}" @if(Request::segment(2)=='dashboard') class="active" @endif>{{trans('home.Dashboard')}}</a></li>
            <li><a @if(Request::segment(2)=='my-student' || Request::segment(2)=='student_report') class="active" @endif href="{{url('/'.$arr_user_details['user_type'].'/my-student/'.Request::segment(3))}}">{{trans('home.My_Students')}}</a></li>

            <li @if(Request::segment(2)=='student-flyers' || Request::segment(2)=='student-certificates' || Request::segment(2)=='student-pins') class="active" @endif>
                <a class="open-submenu" href="javascript:void(0)">{{trans('home.Print')}} <i class="fa fa-angle-down"></i></a>
                <ul class="leftbar-drop-section">
                    <li><a href="{{url('/'.$arr_user_details['user_type'].'/student-pins/'.Request::segment(3))}}" @if(Request::segment(2)=='student-pins') class="active" @endif>-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{trans('home.Pins')}}</a></li>
                    <li><a href="{{url('/'.$arr_user_details['user_type'].'/student-flyers/'.Request::segment(3))}}" @if(Request::segment(2)=='student-flyers') class="active" @endif>-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{trans('home.Flyers')}}</a></li>
                    <li><a href="{{url('/'.$arr_user_details['user_type'].'/student-certificates/'.Request::segment(3))}}" @if(Request::segment(2)=='student-certificates') class="active" @endif>-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{trans('home.Certificate')}}</a></li>
                </ul>
            </li>
            <li><a href="{{ $share_link }}" @if(Request::segment(2)=='share-class') class="active" @endif style="{{ $expired_class }}">{{trans('home.Share_Class')}}</a></li>
            <li><a href="{{ $transfer_link }}" @if(Request::segment(2)=='transfer-class') class="active" @endif style="{{ $expired_class }}">{{trans('home.Transfer_Class')}}</a></li>
            <li><a href="{{url('/'.$arr_user_details['user_type'].'/transfered-class-listing/'.Request::segment(3))}}" @if(Request::segment(2)=='transfered-class-listing') class="active" @endif>{{trans('home.Transfered_Class')}}</a></li>
            <li @if(Request::segment(2)=='homework' || Request::segment(2)=='textbook') class="active" @endif>
                <a class="open-submenu" href="javascript:void(0)">{{trans('home.Downloads')}} <i class="fa fa-angle-down"></i></a>
                <ul class="leftbar-drop-section">
                    <!-- <li><a href="{{url('/'.$arr_user_details['user_type'].'/download/textbooks')}}" @if(Request::segment(2)=='transactions') class="active" @endif>Textbook</a></li>
                    <li><a href="{{url('/'.$arr_user_details['user_type'].'/download/homeworks')}}" @if(Request::segment(2)=='transactions') class="active" @endif>Homeworks</a></li> -->
                    <li><a href="{{ url('/'.$arr_user_details['user_type'].'/textbook/'.Request::segment(3)) }}" @if(Request::segment(2)=='textbook') class="active" @endif>{{trans('home.Textbook')}}</a></li>
                    <li><a href="{{ url('/'.$arr_user_details['user_type'].'/homework/'.Request::segment(3)) }}" @if(Request::segment(2)=='homework') class="active" @endif>{{trans('home.Homework')}}</a></li>
                </ul>
            </li>
            <div class="reward-points-block">
                <h4>{{trans('home.Incentive_Amount')}}</h4>
                <div class="reward-points">
                    <i class="fa fa-trophy"></i> ¥ {{get_incentive_amount($arr_user_details['id'])}}
                </div>
            </div>            
        @endif
    </ul>
</div>
<!-- <div class="reward-points-block">
	<h4>Reward Points</h4>
	<div class="reward-points">
		<i class="fa fa-trophy"></i> ¥ {{get_incentive_amount($arr_user_details['id'])}}
	</div>
</div> -->

<script type="text/javascript">
    $(".left-menu-open").on("click", function(){
        $(this).parent().siblings(".left-emnu-ul").slideToggle("slow");
    });

    /*menu dropdown open close script*/
    $(".open-submenu").on("click", function(){
        $(this).parent().toggleClass("active");
        $(this).parent().siblings().removeClass("active");
    });
    /*menu dropdown open close script end*/
</script>

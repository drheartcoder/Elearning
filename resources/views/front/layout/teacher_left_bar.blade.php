<div class="my-student-leftbar-section">
    <div class="left-menus">Menu <span class="left-menu-open">&#9776;</span></div>
    <ul class="left-emnu-ul">
        <li><a href="{{url('/teacher/dashboard')}}" @if(Request::segment(2)=='dashboard') class="active" @endif>{{trans('home.Dashboard')}}</a></li>
        
        <li><a href="{{url('/teacher/account-setting/my-profile')}}" @if(Request::segment(2)=='account-setting' && Request::segment(3)=='my-profile') class="active" @endif>{{trans('home.My_Profile')}}</a></li>

         <li><a href="{{url('/teacher/account-setting/password/change')}}" @if(Request::segment(2)=='account-setting' && Request::segment(3)=='password') class="active" @endif>{{trans('home.Change_Password')}}</a></li>

        <li><a href="{{url('/teacher/class')}}" @if(Request::segment(2)=='class') class="active" @endif>{{trans('home.My_Class')}}</a></li>

        <li><a href="{{url('/teacher/notification')}}" @if(Request::segment(2)=='notification') class="active" @endif>{{trans('home.Notifications')}}</a></li>
        <div class="reward-points-block">
            <h4>{{trans('home.Incentive_Amount')}}</h4>
            <div class="reward-points">
                <i class="fa fa-trophy"></i> ¥ {{get_incentive_amount($arr_user_details['id'])}}
            </div>
        </div>        
    </ul>
</div>

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

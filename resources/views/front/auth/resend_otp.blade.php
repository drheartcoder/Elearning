<div class="gray-btn-main-section">
    <div class="container">
        <div class="signup-block-wrapper forgot-pass-block-wrapper">                
            
            @include('front.layout._operation_status')

            <div class="signup-block">
                <h2>{{ $pageTitle or '' }}</h2>
                <h5>{{trans('auth.Enter_mobile_number_resend_OTP')}}</h5>
                <form method="post" action="{{ url('/') }}/resend-otp/request">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label>{{trans('auth.Mobile_Number')}}<i class="red">*</i></label>
                        <input type="text" class="digits" id="resend_mobile" name="resend_mobile" placeholder="{{trans('auth.Enter_your_mobile_number')}}" minlength="6" maxlength="16" />
                         <div class="error" id="err_resend_mobile">{{ $errors->first('resend_mobile') }}</div>
                    </div>
                    <button type="submit" id="btn_request_resend_mobile_otp" class="full-orng-btn sim-button">{{trans('auth.Request')}}</button>
                    <div class="join-block">                            
                        <h5>{{trans('auth.Back_to')}} <a href="{{ url('/') }}/signin">{{trans('auth.Sign_in')}}</a></h5>
                    </div>
                 </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $("#btn_request_resend_mobile_otp").click(function(){
            var mobile = $("#resend_mobile").val();
            var flag   = 1;

            if($.trim(mobile) == '')
            {
                $("#err_resend_mobile").html(err_mobile_number);
                $("#resend_mobile").focus();
                $("#resend_mobile").on('keyup',function(){ $("#err_resend_mobile").html(""); });
                return false;
            }
            else if($.trim(mobile).length < 8)
            {
                $("#err_resend_mobile").html(err_mobile_length_min);
                $("#resend_mobile").focus();
                $("#resend_mobile").on('keyup',function(){ $("#err_resend_mobile").html("");});
                return false;
            }
            
            if(flag == 0)
            {
                return false;
            }
            else
            {
                return true;
            }

        });
    });
</script>
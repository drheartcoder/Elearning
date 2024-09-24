<div class="gray-btn-main-section">
    <div class="container">
        <div class="signup-block-wrapper forgot-pass-block-wrapper">                
            
            @include('front.layout._operation_status')

            <div class="signup-block">
                <h2>{{ $pageTitle or '' }}</h2>
                <h5>Please enter OTP which is send to your mobile number below</h5>
                <form method="post" action="{{ url('/') }}/resend-otp/change">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label>{{trans('auth.OTP')}}<i class="red">*</i></label>
                        <input type="text" class="digits" id="verify_otp" name="verify_otp" placeholder="{{trans('auth.Enter_OTP_number')}}" minlength="5" maxlength="6" />
                         <div class="error" id="err_verify_otp">{{ $errors->first('verify_otp') }}</div>
                    </div>
                    <button type="submit" id="btn_verify_resend_mobile_otp" class="full-orng-btn sim-button">{{trans('auth.Confirm')}}</button>
                    <div class="join-block">                            
                        <h5>{{trans('auth.Back_to')}}<a href="{{ url('/') }}/signin">{{trans('auth.Sign_in')}}</a></h5>
                    </div>
                 </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $("#btn_verify_resend_mobile_otp").click(function(){
            var otp  = $("#verify_otp").val();
            var flag = 1;

            if($.trim(otp) == '')
            {
                $("#err_verify_otp").html('Please enter otp');
                $("#verify_otp").focus();
                $("#verify_otp").on('keyup',function(){ $("#err_verify_otp").html(""); });
                return false;
            }
            else if($.trim(otp).length != 6)
            {
                $("#err_verify_otp").html("OTP number length should be equal 6");
                $("#verify_otp").focus();
                $("#verify_otp").on('keyup',function(){ $("#err_verify_otp").html("");});
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
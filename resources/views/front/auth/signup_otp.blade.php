<div class="gray-btn-main-section">
    <div class="container">
        <div class="signup-block-wrapper forgot-pass-block-wrapper">                
            
            @include('front.layout._operation_status')

            <div class="signup-block">
                <h2>{{trans('auth.OTP_Verification')}}</h2>
                <h5>{{trans('auth.Enter_OTP_Message')}}</h5>
                <form method="post" id="form_signup_otp" action="{{ url('/') }}/signup/otp-process">
                    {{ csrf_field() }}
                    
                    <input type="hidden" id="user_id" name="user_id" value="{{ isset($userid) && !empty($userid) ? $userid : '' }}" />

                    <div class="form-group">
                        <label>{{trans('auth.OTP')}}<i class="red">*</i></label>
                        <input type="text" class="digits" id="signup_otp" name="signup_otp" placeholder="{{trans('auth.Enter_OTP_number')}}" minlength="4" maxlength="6" />
                         <div class="error" id="err_signup_otp">{{ $errors->first('signup_otp') }}</div>
                    </div>
                    
                    <button type="submit" id="btn_signup_otp" class="full-orng-btn sim-button">{{trans('auth.Verify')}}</button>
                    <div class="join-block">                            
                        <h5>{{trans('auth.Back_to')}} <a href="{{ url('/') }}/signin">{{trans('auth.Sign_in')}}</a></h5>
                    </div>
                 </form>
            </div>
        </div>
    </div>
</div>
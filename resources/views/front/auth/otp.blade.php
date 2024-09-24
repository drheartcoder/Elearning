<div class="gray-btn-main-section">
    <div class="container">
        <div class="signup-block-wrapper forgot-pass-block-wrapper">                
            
            @include('front.layout._operation_status')

            <div class="signup-block">
                <h2>{{trans('auth.OTP_Verification')}}</h2>
                <h5>{{trans('auth.OTP_note_message')}}</h5>
                <form method="post" action="{{ url('/') }}/forget-password/otp/process">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label>{{trans('auth.OTP')}}<i class="red">*</i></label>
                        <input type="text" class="digits" id="forget_password_otp" name="forget_password_otp" placeholder="{{trans('auth.Enter_OTP_number')}}" minlength="4" maxlength="6" />
                         <div class="error" id="err_forget_password_otp">{{ $errors->first('forget_password_otp') }}</div>
                    </div>
                    <button type="submit" id="btn_forget_password_otp" class="full-orng-btn sim-button">{{trans('auth.Verify')}}</button>
                    <div class="join-block">                            
                        <h5>{{trans('auth.Back_to')}} <a href="{{ url('/') }}/signin">{{trans('auth.Sign_in')}}</a></h5>
                    </div>
                 </form>
            </div>
        </div>
    </div>
</div>
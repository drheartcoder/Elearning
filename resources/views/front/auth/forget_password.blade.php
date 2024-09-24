<div class="gray-btn-main-section">
    <div class="container">
        <div class="signup-block-wrapper forgot-pass-block-wrapper">                
            
            @include('front.layout._operation_status')

            <div class="signup-block">
                <h2>{{trans('auth.Forgot_password')}}</h2>
                <h5>{{trans('auth.Forgot_password_note_message')}}</h5>
                <form method="post" id="frm_forget_password" action="{{ url('/') }}/forget-password/process">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label>{{trans('auth.Email')}} / {{trans('auth.Mobile')}}<i class="red">*</i></label>
                        <input type="text" id="email_mobile" name="email_mobile" placeholder="{{trans('auth.Enter_email_or_mobile')}}" />
                         <div class="error" id="err_email_mobile">{{ $errors->first('email_mobile') }}</div>
                    </div>
                    <button type="submit" id="btn_forget_password" class="full-orng-btn sim-button">{{trans('auth.Get_New_Password')}}</button>
                    <div class="join-block">                            
                        <h5>{{trans('auth.Back_to')}} <a href="{{ url('/') }}/signin">{{trans('auth.Sign_in')}}</a> <!-- <br/>Or <a href="{{ url('/') }}/resend-otp">{{trans('auth.Resend_OTP')}}</a> --></h5>
                    </div>
                 </form>
            </div>
        </div>
    </div>
</div>
<div class="gray-btn-main-section">
    <div class="container">
        <div class="signup-block-wrapper forgot-pass-block-wrapper">
            
            @include('front.layout._operation_status')

            <div class="signup-block">
                <h2>{{trans('auth.Forgot_Pin')}}</h2>
                <h5>{{trans('auth.Forgot_pin_note_message')}}</h5>
                <form method="post" id="frm_forget_pin" action="{{ url('/') }}/forget-pin/process">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label>{{trans('auth.Email')}} / {{trans('auth.Mobile')}}<i class="red">*</i></label>
                        <input type="text" id="email_mobile" maxlength="70" name="email_mobile" placeholder="{{trans('auth.Enter_email_or_mobile')}}" />
                         <div class="error" id="err_email_mobile">{{ $errors->first('email_mobile') }}</div>
                    </div>
                    <button type="submit" id="btn_forget_pin" class="full-orng-btn sim-button">{{trans('auth.Get_Pin')}}</button>
                    <div class="join-block">                            
                        <h5>{{trans('auth.Back_to')}} <a href="{{ url('/') }}/signin">{{trans('auth.Sign_in')}}</a></h5>
                    </div>
                 </form>
            </div>
        </div>
    </div>
</div>
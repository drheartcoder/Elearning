<div class="gray-btn-main-section">
    <div class="container">
        <div class="signup-block-wrapper forgot-pass-block-wrapper">                

            @include('front.layout._operation_status')

            <div class="signup-block">
                <h2>{{trans('auth.Reset_Password')}}</h2>
                <h5>{{trans('auth.Please_enter_new_password')}}</h5>
                <form id="form_reset_password" method="post" action="{{ url('/') }}/reset-password/process">

                    {{ csrf_field() }}

                    <input type="hidden" readonly="" id="enc_id" name="enc_id" value="{{ $enc_id }}">
                    <input type="hidden" readonly="" id="enc_reset_code" name="enc_reset_code" value="{{ $enc_reset_code }}">

                    <div class="form-group">
                        <label>{{trans('auth.Password')}}<i class="red">*</i></label>
                        <input type="password" name="password" id="password" minlength="6" maxlength="16" placeholder="{{trans('auth.Enter_your_password')}}" oncopy="return false" oncut="return false" onpaste="return false" autocomplete="off" />
                         <div class="error" id="err_password">{{ $errors->first('password') }}</div>
                    </div>

                    <div class="form-group">
                        <label> <span class="label label-danger">{{trans('auth.Note')}}:</span> {{trans('auth.Password_must_vailidation')}}</label>
                    </div>

                    <div class="form-group">
                        <label>{{trans('auth.Confirm_Password')}}<i class="red">*</i></label>
                        <input type="password" name="confirm_password" id="confirm_password" minlength="6" maxlength="16" placeholder="{{trans('auth.Re_enter_your_password')}}" oncopy="return false" oncut="return false" onpaste="return false" autocomplete="off" />
                         <div class="error" id="err_confirm_password">{{ $errors->first('confirm_password') }}</div>
                    </div>

                    <button type="submit" id="btn_reset_password" class="full-orng-btn sim-button">{{trans('auth.Save_Password')}}</button>

                    <div class="join-block">
                        <h5>{{trans('auth.Back_to')}}<a href="{{ url('/') }}/signin">{{trans('auth.Sign_in')}}</a></h5>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
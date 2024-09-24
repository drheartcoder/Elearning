<!-- bredcrum section -->
<div class="bredcrum-section-main">
    <div class="container">
        <div class="page-title-main">
            OTP Verification
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!-- bredcrum section end -->

<div class="gray-btn-main-section dashboard-middle-section">
    <div class="container">
        <div class="my-profile-section">
            <div class="row">
                @include('front.layout._operation_status')
                <form id="form_teacher_change_password" method="POST" action="{{ url('/') }}/teacher/account-setting/otp/process">
                    {{ csrf_field() }}
                    
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group">
                            <label>{{trans('auth.OTP')}}</label>
                            <input type="text" class="digits" id="confirm_otp" name="confirm_otp" placeholder="Enter OTP" minlength="5" maxlength="6" autocomplete="off" />
                            <div class="error" id="err_confirm_otp">{{ $errors->first('confirm_otp') }}</div>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="form-button-section">
                            <button type="submit" id="btn_teacher_confirm_otp" class="full-fill-button sim-button">{{trans('parent.Confirm')}}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $("#btn_teacher_confirm_otp").click(function(){
            var confirm_otp = $("#confirm_otp").val();
            
            if($.trim(confirm_otp) == '')
            {
                $("#err_confirm_otp").html("{{trans('parent.Please_enter_otp')}}");
                $("#confirm_otp").focus();
                $("#confirm_otp").on('keyup',function(){ $("#err_confirm_otp").html(""); });
                return false;
            }
        });
    });
</script>

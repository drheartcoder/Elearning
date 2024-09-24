
<div class="gray-btn-main-section">
    <div class="container">
        <div class="signup-block-wrapper">
            @include('front.layout._operation_status')            
            <div class="signup-block">
                <h2>{{trans('auth.Sign_in')}}</h2>
                <h5>{{trans('auth.Please_Sign_in_to_your_account')}}.</h5>
                <form id="form_signin" method="POST" action="{{ url('/') }}/signin/process">
                    {{ csrf_field() }}
                    
                    <div class="radio-btns">
                        <div class="radio-btn">
                            <input type="radio" class="user_type" id="parent_users" value="parent" name="users" />
                            <label for="parent_users">{{trans('auth.Parent')}}</label>
                            <div class="check"></div>
                        </div>
                        <div class="radio-btn">
                            <input type="radio" class="user_type" id="student_users" value="student" name="users" />
                            <label for="student_users">{{trans('auth.Student')}}</label>
                            <div class="check"><div class="inside"></div></div>
                        </div>
                        <div class="radio-btn">
                            <input type="radio" class="user_type" id="teacher_users" value="teacher" name="users" />
                            <label for="teacher_users">{{trans('auth.Teacher')}}</label>
                            <div class="check"><div class="inside"></div></div>
                        </div>
                        <div class="form-group">
                            <div class="error center-error" id="err_user_type">{{ $errors->first('users') }}</div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>{{trans('auth.Email')}} / {{trans('auth.Mobile')}}<i class="red">*</i></label>
                        <input type="text" id="email_mobile" name="email_mobile" value="{{isset($_COOKIE['remember_me_email']) && !empty($_COOKIE['remember_me_email'])?$_COOKIE['remember_me_email']:''}}" maxlength="75" placeholder="{{trans('auth.Enter_email_or_mobile')}}" />
                        <div class="error" id="err_email_mobile">{{ $errors->first('email_mobile') }}</div>
                    </div>
                    <div class="form-group" id="for_others">
                        <label>{{trans('auth.Password')}}<i class="red">*</i></label>
                        <input type="password" name="password" id="password" maxlength="50" placeholder="{{trans('auth.Enter_your_Password')}}" value="{{isset($_COOKIE['remember_me_token']) && !empty($_COOKIE['remember_me_token'])?decrypt($_COOKIE['remember_me_token']):''}}"/>
                        <div class="error" id="err_password">{{ $errors->first('password') }}</div>
                    </div>
                    <div class="form-group" id="for_student" style="display: none;">
                        <label>{{trans('auth.PIN')}}<i class="red">*</i></label>
                        <input type="text" class="digits" id="pin" name="pin" minlength="4" maxlength="4" placeholder="{{trans('auth.Enter_your_PIN')}}" autocomplete="off" value="{{isset($_COOKIE['remember_me_pin_token']) && !empty($_COOKIE['remember_me_pin_token'])?decrypt($_COOKIE['remember_me_pin_token']):''}}" />
                        <div class="error" id="err_pin">{{ $errors->first('pin') }}</div>
                    </div>
                    <div class="terms-block text-left">
                        <div class="check-block">
                            <input id="remember_me" name="remember_me" class="filled-in" type="checkbox" @if(isset($_COOKIE['is_checked']) && $_COOKIE['is_checked']=='yes')   checked="checked" @endif>
                            <label for="remember_me">{{trans('auth.Remember_me')}}</label>
                        </div>
                        <a class="forget-pwd" id="forget_password" href="{{ url('/') }}/forget-password">{{trans('auth.Forgot_password')}}?</a>
                        <a class="forget-pwd" id="forget_pin" href="{{ url('/') }}/forget-pin" style="display: none;">{{trans('auth.Forgot_pin')}}</a>
                    </div>
                    <button type="submit" id="btn_signin" class="full-orng-btn sim-button">{{trans('auth.Sign_in')}}</button>

                    <div class="join-block" id="div_social_media">
                        <p>{{trans('auth.Sign_in_with_social_media')}}</p>
                        <ul>

                            <li>
                                <a class="fb-section social_login" href="javascript:void(0)" data-social="facebook">
                                    <i class="fa fa-facebook"></i>
                                </a>
                            </li>
                            <li>
                                <a class="twitter-section social_login" href="javascript:void(0)" data-social="twitter">
                                    <i class="fa fa-twitter"></i>
                                </a>
                            </li>
                            <li>
                                <a class="google-section social_login" href="javascript:void(0)" data-social="google">
                                    <i class="fa fa-google-plus"></i>
                                </a>
                            </li>
                            <li>
                                <a class="linkedin-section social_login" href="javascript:void(0)" data-social="linkedin">
                                    <i class="fa fa-linkedin"></i>
                                </a>
                            </li>
                            <!-- <li>
                                <a href="javascript:void(0)" id="wechat_login">
                                    <img src="{{ url('/') }}/images/login-chat-icon.png" alt="elearning" />
                                </a>
                            </li> -->
                        </ul>
                        <div class="join-block already-registered-section">
                        <h5>{{trans('auth.Dont_have_an_account')}} <a href="{{ url('/') }}/signup">{{trans('auth.Sign_Up')}}</a></h5>
                        </div>
                    </div>
                    
                 </form>
            </div>
        </div>
    </div>
</div>

<input type="hidden" id="appid" name="appid" value="{{ env('WECHAT_OFFICIAL_ACCOUNT_APPID') }}" />
<!-- <input type="hidden" id="oauth_callback" name="oauth_callback" value="{{ url('/') }}{{ env('WECHAT_OFFICIAL_ACCOUNT_OAUTH_CALLBACK') }}" /> -->
<input type="hidden" id="oauth_callback" name="oauth_callback" value="https://www.meritted.com/signin/wechat/callback" />

<!-- <script src="http://res.wx.qq.com/connect/zh_CN/htmledition/js/wxLogin.js"></script> -->
<!-- <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script> -->

<script type="text/javascript">
    $(document).ready(function() {
        $("#wechat_login").click(function(){
            var user_type      = $("input[name='users']:checked").val();
            var appid          = $("#appid").val();
            /*var oauth_callback = encodeURIComponent("https://www.meritted.com/signin/wechat/callback?&usertype="+user_type);*/
            var oauth_callback = encodeURIComponent($("#oauth_callback").val()+"?&usertype="+user_type);
            //var oauth_callback = $("#oauth_callback").val()+"?&usertype="+user_type;
            
            if($.trim(user_type) == undefined || user_type == null)
            {
                swal("","Please select user type first" ,"error");
            }
            else
            {
                // Working using just link
                window.location.href = "https://open.weixin.qq.com/connect/qrconnect?appid="+appid+"&redirect_uri="+oauth_callback+"&response_type=code&scope=snsapi_login";

                /*var wx = new WxLogin({
                                        id           : "login_container",
                                        appid        : appid,
                                        scope        : "snsapi_login", // snsapi_login, snsapi_base, snsapi_userinfo
                                        redirect_uri : oauth_callback,
                                        state        : "",
                                        style        : "black",
                                        href         : ""
                                    });*/

                /*wx.config({
                    debug: true, // Enables debugging mode. Return values of all APIs called will be shown on the client. To view the sent parameters, open the log view of developer tools on a computer browser. The parameter information can only be printed when viewed from a computer.
                    appId: appid, // Required, unique identifier of the Official Account
                    timestamp: '', // Required, timestamp for the generated signature
                    nonceStr: '', // Required, random string for the generated signature
                    signature: '', // Required, signature. See Appendix 1.
                    jsApiList: [] // Required, list of JS APIs to be used. See Appendix 2 for the list of all JS APIs
                });

                wx.ready(function(){
                    // The callback function of the ready API will be executed after a successful config authentication, and each API calling must be done after the config API obtains a result. As config is an asynchronous operation, all relevant API calling must be put in the callback function if it needs to be called while the page loads. A user-initiated API call can be called directly without needing to be put in the callback function.

                    //alert("ready");
                });

                wx.error(function(res){
                    // The callback function of the error API will be executed if config authentication fails. If authentication failure is due to an expired signature, the detailed error information can be viewed by enabling the debugging mode within config API, or via the returned res parameter. The signature can be updated here for the SPA.

                    //alert("error"+res);
                });*/
            }
        });
    });
</script>
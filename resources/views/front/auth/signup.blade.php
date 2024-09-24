<style type="text/css">
    .error{ display: none; }
</style>

    <div class="gray-btn-main-section">
        <div class="container">
            <div class="signup-block-wrapper">

                @include('front.layout._operation_status')

                <div class="signup-block">
                    <h2>{{trans('auth.Sign_Up')}}</h2>
                    <h5>{{trans('auth.Create_your_account')}}</h5>
                    <form id="form_signup" method="POST" action="{{ url('/') }}/signup/store">
                        {{ csrf_field() }}

                         <?php $email =''; $style = '';
                            if(Request::get('e')!=null)
                            {
                                $email = base64_decode(Request::get('e'));
                                $style = 'readonly';
                            }
                            if(old('email')!=null)
                            {
                                $email = old('email');
                                $style = '';
                            }?>

                        <div class="radio-btns">  
                            <div class="radio-btn" tabindex="1">   
                                <input type="hidden" name="users" id="usersType" value="">                             
                                <input type="radio"  class="users" id="parent_users" name="users" value="parent" {{ old('users')=="parent"?'checked':'' }}/>
                                <label for="parent_users">{{trans('auth.Parent')}}</label>
                                <div class="check"><div class="inside"></div></div>
                            </div>
                            <div class="radio-btn">
                                <input type="radio" class="users" id="teacher_users" name="users" value="teacher" {{ old('users')=="teacher" || Request::get('e')!=null ?'checked':'' }}/>
                                <label for="teacher_users">{{trans('auth.Teacher')}}</label>
                                <div class="check"><div class="inside"></div></div>
                            </div>
                            <div class="radio-btn">
                                <input type="radio" class="users" id="enroll" name="users" value="enroll" {{ old('users')=="enroll"?'checked':'' }}/>
                                <label for="enroll">{{trans('auth.Enroll')}}</label>
                                <div class="check"><div class="inside"></div></div>
                            </div>
                            <div class="error center-error" id="err_users"></div>
                        </div>

                        <div class="form-group enrollment" style="display: none">
                            <label>{{trans('auth.Enrollment_Code')}}</label>
                            <input type="hidden" name="invalid_enroll" id="invalid_enroll" value="">
                            <input type="text" name="enrollment" id="enrollment" placeholder="Enter enrollment code" value="{{ old('enrollment')}}"/>
                            <div class="error" id="err_enrollment">{{ $errors->first('enrollment') }}</div>
                        </div>

                        <div class="form-group">
                            <label>{{trans('auth.First_Name')}}<i class="red">*</i></label>
                            <input type="text" class="alphabets" name="first_name" id="first_name" maxlength="50" placeholder="{{trans('auth.Enter_your_first_name')}}" value="{{ old('first_name')}}" tabindex="2"/>
                             <div class="error" id="err_first_name">{{ $errors->first('first_name') }}</div>
                        </div>
                        <div class="form-group">
                            <label>{{trans('auth.Last_Name')}}<i class="red">*</i></label>
                            <input type="text" class="alphabets" name="last_name" id="last_name" maxlength="50" placeholder="{{trans('auth.Enter_your_last_name')}}" value="{{ old('last_name')}}" tabindex="3"/>
                             <div class="error" id="err_last_name">{{ $errors->first('last_name') }}</div>
                        </div>
                        <input type="hidden" name="classcode" id="classcode" value="{{Request::get('c')}}">
                        <input type="hidden" name="process_type" id="process_type" value="{{Request::get('t')}}">
                        <div class="form-group">
                            <label>{{trans('auth.Email')}}<i class="red">*</i></label>
                            <input type="text" name="email" id="email" maxlength="60" placeholder="{{trans('auth.Enter_your_email')}}" value="{{ $email }}" {{$style}} tabindex="4"/>
                             <div class="error" id="err_email">{{ $errors->first('email') }}</div>
                        </div>
                        
                        
                        <div class="form-group">
                            <label>{{trans('auth.Mobile_Number')}}<i class="red">*</i></label>
                            <div class="row">
                                    <div class="col-lg-4">
                                        <div class="phone-code">
                                        @php
                                            $arr_phone_code = [];
                                            $arr_phone_code = get_country_phone_code();
                                            //dd($arr_phone_code);
                                        @endphp
                                        @if(isset($arr_phone_code) && sizeof($arr_phone_code)>0)
                                            <select id="phone_code" name="phone_code">
                                                <option value="">{{trans('auth.Select_PhoneCode')}}</option>
                                                @foreach($arr_phone_code as $phone_code)
                                                 @if(isset($phone_code['nicename']) && $phone_code['nicename']!="")
                                                      <option value="{{ $phone_code['id'] }}">
                                                     ({{ $phone_code['nicename'] }}) +{{ $phone_code['phonecode'] }}</option>
                                                 @endif
                                                @endforeach
                                            </select>
                                             <div class="error" id="err_phone_code">{{ $errors->first('phone_code') }}</div>
                                        @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                         <div class="phone-code">
                                             <input type="text" class="digits" name="mobile" id="mobile" minlength="6" maxlength="16" placeholder="{{trans('auth.Enter_your_mobile_number')}}" value="{{ old('mobile')}}" tabindex="5"/>
                                             <div class="error" id="err_mobile">{{ $errors->first('mobile') }}</div>
                                         </div>
                                    </div>
                            </div> 
                           
                        </div>

                        <div class="form-group">
                            <label>{{trans('auth.Password')}}<i class="red">*</i></label>
                            <input type="password" name="password" id="password" minlength="6" maxlength="16" placeholder="{{trans('auth.Enter_your_password')}}" oncopy="return false" oncut="return false" onpaste="return false" autocomplete="off" tabindex="6"/>
                            <div class="error" id="err_password">{{ $errors->first('password') }}</div>
                        </div>
                        <div class="form-group">
                            <label> <span class="label label-danger">{{trans('auth.Note')}}:</span> {{trans('auth.Password_must_vailidation')}}</label>
                        </div>
                        <div class="form-group">
                            <label>{{trans('auth.Confirm_Password')}}<i class="red">*</i></label>
                            <input type="password" name="confirm_password" id="confirm_password" minlength="6" maxlength="16" placeholder="{{trans('auth.Re_enter_your_password')}}" oncopy="return false" oncut="return false" onpaste="return false" autocomplete="off" tabindex="7"/>
                            <div class="error" id="err_confirm_password">{{ $errors->first('confirm_password') }}</div>
                        </div>
                        <div class="terms-block text-left">
                            <div class="check-block" tabindex="8">
                                <input id="iagree" name="iagree" class="filled-in" type="checkbox">
                                <label for="iagree">{{trans('auth.Note')}}</label> <a href="{{url('/terms-&-conditions')}}" target="_blank">{{trans('auth.Terms_and_Conditions')}}<i class="red">*</i></a>
                                <div class="error" id="err_iagree">{{ $errors->first('iagree') }}</div>
                            </div>                            
                        </div>
                        <button type="submit" id="btn_signup" class="full-orng-btn sim-button">{{trans('auth.Sign_Up')}}</button>                        
                        <div class="join-block" id="div_social_media">
                            <p>{{trans('auth.Sign_up_with_social_media')}}</p>
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
                                    <a href="javascript:void(0)">
                                        <img src="{{ url('/') }}/images/login-chat-icon.png" alt="elearning" />
                                    </a>
                                </li> -->
                            </ul>                            
                        </div>
                        <div class="join-block already-registered-section">                            
                            <h5>{{trans('auth.Already_Registered')}} <a href="{{ url('/') }}/signin">{{trans('auth.Sign_in')}}</a></h5>
                        </div>
                     </form>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function()
        {
            $('.users').removeAttr('disabled');

            getUser();            
            $('.users').click(function(){            
                getUser();
            });
        });

        function getUser()
        {
            var parent_users = $("input[name='users']:checked"). val();
            var email = '{{base64_decode(Request::get('e'))}}';    
            $("#usersType").val(parent_users);
            if(parent_users=='enroll')
            {
                $('.enrollment').show();
                $('#div_social_media').hide();
            }
            else
            {
                $('.enrollment').hide();   
                $('#div_social_media').show();

                if(email!='' && parent_users=='teacher')
                {
                    $('.users').attr('disabled','true');
                }
                else
                {
                    $('.users').removeAttr('disabled');
                }
            }
        }

        $("#enrollment").on('keyup',function(){
            var enrollment = $(this).val();     
            $('#invalid_enroll').val('');
            $.ajax({    
                headers:{'X-CSRF-Token':csrf_token},
                url:SITE_URL+'/check_enrollment_code',
                type:'post',
                data:{enrollment:enrollment},
                success:function(resp)
                {
                    if(resp=='error')
                    {
                        $("#err_enrollment").html(err_enrollment_code_invalid);                
                        $("#err_enrollment").css('display', 'block');
                        $(".enrollment").focus();
                        $(".enrollment").on('click',function(){ $("#err_enrollment").html(""); });
                        $('#invalid_enroll').val('invalid');
                    }

                }

            });

        });
        
    </script>

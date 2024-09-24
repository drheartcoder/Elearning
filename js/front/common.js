$(document).ready(function(){


    /*---------------Common Starts---------------*/

    // for google address
  // $("#address").geocomplete();

    $( "#datepicker" ).datepicker({ 
        todayHighlight: true, 
        autoclose: true, 
    });


    // number validation for mobile
    $(document).on('keydown blur', '.digits', function() {
        $(this).val($(this).val().replace(/[^\d]/,''));
        $(this).keyup(function(){
            $(this).val($(this).val().replace(/[^\d]/,''));
        });
    });

    // Allow only Alphabet Characters
    $(document).on('keydown blur', '.alphabets', function() {
        if (this.value.match(/[^a-zA-Z]/g)) {
            this.value = this.value.replace(/[^a-zA-Z]/g, '');
        }
    });

    /*---------------Common Ends---------------*/





    /*---------------Sign Up Page Starts---------------*/

    $("#email").blur(function(){
        var email        = $("#email").val();
        var email_filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

        if($.trim(email) != '')
        {
            if(!email_filter.test(email))
            {
                $("#err_email").html('Please enter vaild email');
                $("#err_email").css('display', 'block');
                //$("#email").focus();
                $("#email").on('keyup',function(){ $("#err_email").html(""); });
                return false;
            }
            var token = $('input[name="_token"]').val();
            $.ajax({
                url : SITE_URL+"/email/duplicate",
                type : "POST",
                dataType :'json',
                data: { _token:token, email:email},
                success : function(res)
                {
                    if($.trim(res) == 'error')
                    {
                        $('#err_email').show();
                        $('#err_email').html(email_already_exists);
                        $('#form_signup').attr('disabled',true);
                        //$('#email').focus();
                        return false; 
                    }
                    else if($.trim(res)=='success')
                    {
                        $('#err_email').hide();
                        $('#err_email').html('');
                        $('#form_signup').attr('disabled',false);
                        return true;
                    }
                    else
                    {
                        $('#err_email').show();
                        //$('#email').focus();
                        $('#err_email').html(Something_has_get_wrong);
                        return false;
                    }
                }
            });
        }
    });

    $("#mobile").blur(function(){
        var mobile = $("#mobile").val();

        if($.trim(mobile) != '')
        {
            if($.trim(mobile).length < 8)
            {
                $("#err_mobile").html(err_mobile_length_min);
                $("#err_mobile").css('display', 'block');
                //$("#mobile").focus();
                $("#mobile").on('keyup',function(){ $("#err_mobile").html("");});
                return false;
            }
            var token = $('input[name="_token"]').val();
            $.ajax({
                url : SITE_URL+"/mobile/duplicate",
                type : "POST",
                dataType :'json',
                data: { _token:token, mobile:mobile},
                success : function(res)
                {
                    if($.trim(res) == 'error')
                    {
                        $('#err_mobile').show();
                        $('#err_mobile').html('');
                        $('#form_signup').attr('disabled',true);
                        //$('#mobile').focus();
                        return false; 
                    }
                    else if($.trim(res)=='success')
                    {
                        $('#err_mobile').hide();
                        $('#err_mobile').html('');
                        $('#form_signup').attr('disabled',false);
                        return true;
                    }
                    else
                    {
                        //$('#mobile').focus();
                        $('#err_mobile').show();
                        $('#err_mobile').html(Something_has_get_wrong);
                        return false;
                    }
                }
            });
        }
    });

    $("#btn_signup").click(function(){

        var email_filter     = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        var password_filter  = /^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^])([a-zA-Z0-9!@#$%^]{6,})$/;
        var users            = $(".users").val();
        var first_name       = $("#first_name").val();
        var last_name        = $("#last_name").val();
        var email            = $("#email").val();
        var mobile           = $("#mobile").val();
        var password         = $("#password").val();
        var confirm_password = $("#confirm_password").val();
        var iagree           = $("#iagree").is(":checked");
        var users            = $("input[name='users']:checked").val();
        var enrollment       = $('#enrollment').val();    
        var phone_code       = $('#phone_code').val();     
        var flag             = 1;
        
        $("#err_iagree").html("");
        $("#err_confirm_password").html("");
        $("#err_password").html("");
        $("#err_mobile").html("");
        $("#err_email").html("");
        $("#err_last_name").html("");
        $("#err_first_name").html("");

        if(iagree == false)
        {
            $("#err_iagree").html(error_terms_and_conditions);
            $("#err_iagree").css('display', 'block');
            $("#iagree").focus();
            //$("#iagree").on('keyup',function(){ $("#err_iagree").html(""); });
            flag = 0;
        }
        if($.trim(confirm_password) == '')
        {
            $("#err_confirm_password").html(error_confirm_password);
            $("#err_confirm_password").css('display', 'block');
            $("#confirm_password").focus();
            //$("#confirm_password").on('keyup',function(){ $("#err_confirm_password").html(""); });
            flag = 0;
        }
        /*else if(!password_filter.test(confirm_password))
        {
            $("#err_confirm_password").html(error_valid_confirm_password);
            $("#err_confirm_password").css('display', 'block');
            $("#confirm_password").focus();
            $("#confirm_password").on('keyup',function(){ $("#err_confirm_password").html(""); });
            flag = 0;
        }*/
        else if($.trim(confirm_password).length < 6)
        {
            $("#err_confirm_password").html(error_confirm_password_min_length);
            $("#err_confirm_password").css('display', 'block');
            $("#confirm_password").focus();
            //$("#confirm_password").on('keyup',function(){ $("#err_confirm_password").html("");});
            flag = 0;
        }
        else if($.trim(confirm_password) != $.trim(password))
        {
            $("#err_confirm_password").html(error_password_not_match);
            $("#err_confirm_password").css('display', 'block');
            $("#confirm_password").focus();
            //$("#confirm_password").on('keyup',function(){ $("#err_confirm_password").html(""); });
            flag = 0;
        }
        if($.trim(password) == '')
        {
            $("#err_password").html(error_password);
            $("#err_password").css('display', 'block');
            $("#password").focus();
            //$("#password").on('keyup',function(){ $("#err_password").html(""); });
            flag = 0;
        }
        else if(!password_filter.test(password))
        {
            $("#err_password").html(error_valid_password);
            $("#err_password").css('display', 'block');
            $("#password").focus();
            //$("#password").on('keyup',function(){ $("#err_password").html(""); });
            flag = 0;
        }
        else if($.trim(password).length < 6)
        {
            $("#err_password").html(error_password_min_length);
            $("#err_password").css('display', 'block');
            $("#password").focus();
            //$("#password").on('keyup',function(){ $("#err_password").html("");});
            flag = 0;
        }
        if($.trim(mobile) == '')
        {
            $("#err_mobile").html(error_mobile_no);
            $("#err_mobile").css('display', 'block');
            $("#mobile").focus();
            //$("#mobile").on('keyup',function(){ $("#err_mobile").html(""); });
            flag = 0;
        }
        else if($.trim(mobile).length < 8)
        {
            $("#err_mobile").html(err_mobile_length_min);
            $("#err_mobile").css('display', 'block');
            $("#mobile").focus();
            //$("#mobile").on('keyup',function(){ $("#err_mobile").html("");});
            flag = 0;
        }
        if($.trim(email) == '')
        {
            $("#err_email").html(error_email);
            $("#err_email").css('display', 'block');
            $("#email").focus();
            //$("#email").on('keyup',function(){ $("#err_email").html(""); });
            flag = 0;
        }
        else if(!email_filter.test(email))
        {
            $("#err_email").html(error_valid_email);
            $("#err_email").css('display', 'block');
            $("#email").focus();
            //$("#email").on('keyup',function(){ $("#err_email").html(""); });
            flag = 0;
        }
        if($.trim(last_name) == '')
        {
            $("#err_last_name").html(error_last_name);
            $("#err_last_name").css('display', 'block');
            $("#last_name").focus();
            //$("#last_name").on('keyup',function(){ $("#err_last_name").html(""); });
            flag = 0;
        }
        if($.trim(phone_code) == '')
        {
            $("#err_phone_code").html(err_phone_code);
            $("#err_phone_code").css('display', 'block');
            $("#phone_code").focus();
            //$("#last_name").on('keyup',function(){ $("#err_last_name").html(""); });
            flag = 0;
        }
        if($.trim(first_name) == '')
        {
            $("#err_first_name").html(error_first_name);
            $("#err_first_name").css('display', 'block');
            $("#first_name").focus();
            //$("#first_name").on('keyup',function(){ $("#err_first_name").html(""); });
            flag = 0;
        }
        if(users!=undefined)
        {
           if(users=='enroll')
           {
                if(enrollment=='')
                {
                    $("#err_enrollment").html(Please_enter_enrollment_code);                
                    $("#err_enrollment").css('display', 'block');
                    $(".enrollment").focus();
                    $(".enrollment").on('click',function(){ $("#err_enrollment").html(""); });
                    flag = 0;       
                }
                if($("#invalid_enroll").val()=='invalid')                
                {
                    $("#err_enrollment").html(error_valid_enrollment_code);                
                    $("#err_enrollment").css('display', 'block');
                    $(".enrollment").focus();
                    $(".enrollment").on('click',function(){ $("#err_enrollment").html(""); });
                    flag = 0;   
                }
           }
        }
        if(users==undefined)
        {
            $("#err_users").html(Please_select_user_type);
            $("#err_users").css('display', 'block');
            $(".users").focus();
            $(".users").on('click',function(){ $("#err_users").html(""); });
            flag = 0;
        }

        if(flag == 0)
        {
            return false;
        }
        else
        {
            $('#btn_signup').attr('disabled',true);
            $('#form_signup').submit();
            //return true;
        }
    });

    /*---------------Sign Up Page Ends---------------*/





    /*---------------Sign Up OTP Page Starts---------------*/

    $("#btn_signup_otp").click(function() 
    {
        var otp  = $("#signup_otp").val();
        var flag = 1;
        $("#err_signup_otp").html("");

        if($.trim(otp) == '') 
        {
            $("#err_signup_otp").html(error_otp);
            $("#signup_otp").focus();
            //$("#signup_otp").on('keyup',function(){  });
            flag = 0;
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
    
    /*---------------Sign Up OTP Page Ends---------------*/





    /*---------------Sign In Page Starts---------------*/

    $(".user_type").click(function(){
        CheckUserType();
    });

    CheckUserType();

    function CheckUserType()
    {
        var user_type = $("input[name='users']:checked").val();

        if(user_type == 'student')
        {
            $('#for_others').css('display', 'none');
            $('#for_student').css('display', 'block');

            $("#forget_password").css('display', 'none');
            $("#forget_pin").css('display', 'block');

            $('#div_social_media').css('display', 'none');
        }
        else
        {
            $('#for_student').css('display', 'none');
            $('#for_others').css('display', 'block');

            $("#forget_pin").css('display', 'none');
            $("#forget_password").css('display', 'block');

            $('#div_social_media').css('display', 'block');
        }
    }

    $("#btn_signin").click(function(){
        var email_filter       = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        var password_filter    = /^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^])([a-zA-Z0-9!@#$%^]{6,})$/;
        var user_type          = $("input[name='users']:checked").val();
        var email_mobile       = $("#email_mobile").val();
        var password           = $("#password").val();
        var pin                = $("#pin").val();
        var flag               = 1;
        var email_mobile_value = $.trim(email_mobile);
        $("#err_email_mobile").html("");
        $("#err_password").html("");
        $("#err_pin").html("");

        if(user_type == 'student')
        {
            if($.trim(pin) == '')
            {
                $("#err_pin").html(error_pin);
                $("#err_pin").css('display', 'block');
                $("#pin").focus();
                //$("#pin").on('keyup',function(){ $("#err_pin").html(""); });
                flag = 0;
            }
            else if($.trim(pin).length != 4)
            {
                $("#err_pin").html(error_pin_length);
                $("#err_pin").css('display', 'block');
                $("#pin").focus();
                //$("#pin").on('keyup',function(){ $("#err_pin").html("");});
                flag = 0;
            }
        }
        else
        {
            if($.trim(password) == '')
            {
                $("#err_password").html(error_password);
                $("#err_password").css('display', 'block');
                $("#password").focus();
                //$("#password").on('keyup',function(){ $("#err_password").html(""); });
                flag = 0;
            }
            /*else if(!password_filter.test(password))
            {
                $("#err_password").html(error_valid_password);
                $("#err_password").css('display', 'block');
                $("#password").focus();
                $("#password").on('keyup',function(){ $("#err_password").html(""); });
                flag = 0;
            }
            else if($.trim(password).length < 6)
            {
                $("#err_password").html(error_password_min_length);
                $("#err_password").css('display', 'block');
                $("#password").focus();
                $("#password").on('keyup',function(){ $("#err_password").html("");});
                flag = 0;
            }*/
        }
        if($.trim(email_mobile) != '')
        {
            if($.isNumeric(email_mobile_value))
            {
                var value_is = 'mobile';
            }
            else
            {
                var value_is = 'email';
            }
            
            if(!email_filter.test(email_mobile) && value_is == 'email')
            {
                $("#err_email_mobile").html(error_valid_email);
                $("#err_email_mobile").css('display', 'block');
                $("#email_mobile").focus();
                //$("#email_mobile").on('keyup',function(){ $("#err_email_mobile").html(""); });
                flag = 0;
            }
            if($.trim(email_mobile).length < 8 && value_is == 'mobile')
            {
                $("#err_email_mobile").html(err_mobile_length_min);
                $("#err_email_mobile").css('display', 'block');
                $("#email_mobile").focus();
                //$("#email_mobile").on('keyup',function(){ $("#err_email_mobile").html("");});
                flag = 0;
            }
        }
        if($.trim(email_mobile) == '')
        {
            $("#err_email_mobile").html(error_email_mobile);
            $("#err_email_mobile").css('display', 'block');
            $("#email_mobile").focus();
            //$("#email_mobile").on('keyup',function(){ $("#err_email_mobile").html(""); });
            flag = 0;
        }
        if($.trim(user_type) == 'undefined' || user_type == null)
        {
            $("#err_user_type").html(Please_select_user_type);
            $(".user_type").on('click',function(){ $("#err_user_type").html(""); });
            flag = 0;
        }

        if(flag == 0)
        {
            return false;
        }
        else
        {
            $('#btn_signin').attr('disabled',true);
            $('#form_signin').submit();
            //return true;
        }
    });

    $(".social_login").click(function(){
        var user_type = $("input[name='users']:checked").val();
        var social = $(this).data('social');
        
        if($.trim(user_type) == undefined || user_type == null)
        {
            swal("","Please select user type first" ,"error");
        }
        else
        {
            window.location.href = SITE_URL+"/signin/"+social+"/"+user_type;
        }
    });

    /*---------------Sign In Page Ends---------------*/





    /*---------------Forget Password Page Starts---------------*/

    function CheckEmailExists(email)
    {
        var result;
        $.ajax({
            url : SITE_URL+"/email/duplicate",
            type : "POST",
            dataType :'json',
            async : false,
            data : { _token:csrf_token, email:email},
            success : function(res)
            {
                result = res;
            }
        });
        return result;
    }

    function CheckMobileExists(mobile)
    {
        var result;
        $.ajax({
            url : SITE_URL+"/mobile/duplicate",
            type : "POST",
            dataType :'json',
            async : false,
            data : { _token:csrf_token, mobile:mobile},
            success : function(res)
            {
                result = res;
            }
        });
        return result;
    }


    $("#btn_forget_password").click(function(){
            
        var email_filter       = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        var email_mobile       = $("#email_mobile").val();
        var email_mobile_value = $.trim(email_mobile);
        var flag               = 1;

        $("#err_email_mobile").html("");

        if($.trim(email_mobile) == '')
        {
            $("#err_email_mobile").html(error_email_mobile);
            $("#email_mobile").focus();
            //$("#email_mobile").on('keyup',function(){ $("#err_email_mobile").html(""); });
            flag = 0;
        }

        if($.trim(email_mobile) != '')
        {
            if($.isNumeric(email_mobile_value))
            {
                var value_is = 'mobile';
            }
            else
            {
                var value_is = 'email';
            }
            
            if(!email_filter.test(email_mobile) && value_is == 'email')
            {
                $("#err_email_mobile").html(error_valid_email);
                $("#email_mobile").focus();
                //$("#email_mobile").on('keyup',function(){ $("#err_email_mobile").html(""); });
                flag = 0;
            }
            else if(email_filter.test(email_mobile) && value_is == 'email')
            {
                var output = CheckEmailExists(email_mobile);
                if($.trim(output) == 'success')
                {
                    $("#err_email_mobile").html(error_email_not_exist);
                    $("#email_mobile").focus();
                    //$("#email_mobile").on('keyup',function(){ $("#err_email_mobile").html(""); });
                    flag = 0;
                }
                else
                {
                    flag = 1;
                }
            }

            if($.trim(email_mobile).length < 8 && value_is == 'mobile')
            {
                $("#err_email_mobile").html(err_mobile_length_min);
                $("#email_mobile").focus();
                //$("#email_mobile").on('keyup',function(){ $("#err_email_mobile").html("");});
                flag = 0;
            }
            else if($.trim(email_mobile).length > 16 && value_is == 'mobile')
            {
                $("#err_email_mobile").html(err_mobile_length_max);
                $("#email_mobile").focus();
                //$("#email_mobile").on('keyup',function(){ $("#err_email_mobile").html("");});
                flag = 0;
            }
            else if($.trim(email_mobile).length > 8 && $.trim(email_mobile).length < 16 && value_is == 'mobile')
            {
                var output = CheckMobileExists(email_mobile);
                if($.trim(output) == 'success')
                {
                    $("#err_email_mobile").html(error_mobile_not_exist);
                    $("#email_mobile").focus();
                    //$("#email_mobile").on('keyup',function(){ $("#err_email_mobile").html(""); });
                    flag = 0;
                }
                else
                {
                    flag = 1;
                }
            }
        }

        if(flag == 0)
        {
            return false;
        }
        else
        {
            $('#btn_forget_password').attr('disabled',true);
            $('#frm_forget_password').submit();
        }

    });

    /*---------------Forget Password Page Ends---------------*/





    /*---------------Reset Password Page Starts---------------*/

    $("#btn_reset_password").click(function(){
        var password         = $("#password").val();
        var confirm_password = $("#confirm_password").val();
        var password_filter  = /^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^])([a-zA-Z0-9!@#$%^]{6,})$/;
        var flag             = 1;

        $("#err_password").html("");
        $("#err_confirm_password").html("");

        if($.trim(password) == '')
        {
            $("#err_password").html(error_password);
            $("#password").focus();
            //$("#password").on('keyup',function(){ $("#err_password").html(""); });
            flag = 0;
        }
        else if(!password_filter.test(password))
        {
            $("#err_password").html(error_valid_password);
            $("#password").focus();
            //$("#password").on('keyup',function(){ $("#err_password").html(""); });
            flag = 0;
        }
        else if($.trim(password).length < 6)
        {
            $("#err_password").html(error_password_min_length);
            $("#password").focus();
            //$("#password").on('keyup',function(){ $("#err_password").html("");});
            flag = 0;
        }
        
        if($.trim(confirm_password) == '')
        {
            $("#err_confirm_password").html(error_confirm_password);
            $("#confirm_password").focus();
            //$("#confirm_password").on('keyup',function(){ $("#err_confirm_password").html(""); });
            flag = 0;
        }
        /*else if(!password_filter.test(confirm_password))
        {
            $("#err_confirm_password").html(error_valid_confirm_password);
            $("#confirm_password").focus();
            $("#confirm_password").on('keyup',function(){ $("#err_confirm_password").html(""); });
            flag = 0;
        }*/
        else if($.trim(confirm_password).length < 6)
        {
            $("#err_confirm_password").html(error_confirm_password_min_length);
            $("#confirm_password").focus();
            //$("#confirm_password").on('keyup',function(){ $("#err_confirm_password").html("");});
            flag = 0;
        }

        if($.trim(confirm_password) != $.trim(password))
        {
            $("#err_confirm_password").html(error_password_not_match);
            $("#confirm_password").focus();
            //$("#confirm_password").on('keyup',function(){ $("#err_confirm_password").html(""); });
            flag = 0;
        }

        if(flag == 0)
        {
            return false;
        }
        else
        {
            $('#btn_reset_password').attr('disabled',true);
            $('#form_reset_password').submit();
            //return true;
        }
    });

    /*---------------Reset Password Page Ends---------------*/





    /*---------------Forget Password OTP Page Starts---------------*/

    $("#btn_forget_password_otp").click(function(){
        var otp  = $("#forget_password_otp").val();
        var flag = 1;
        
        $("#err_forget_password_otp").html("");

        if($.trim(otp) == '')
        {
            $("#err_forget_password_otp").html(error_otp);
            $("#forget_password_otp").focus();
            //$("#forget_password_otp").on('keyup',function(){ $("#err_forget_password_otp").html(""); });
            flag = 0;
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
    
    /*---------------Forget Password OTP Page Ends---------------*/



    /*---------------Forget Pin OTP Page Starts---------------*/

    $("#btn_forget_pin_otp").click(function(){
        var otp  = $("#forget_pin_otp").val();
        var flag = 1;
        
        $("#err_forget_pin_otp").html("");

        if($.trim(otp) == '')
        {
            $("#err_forget_pin_otp").html(error_otp);
            $("#forget_pin_otp").focus();
            //$("#forget_pin_otp").on('keyup',function(){ $("#err_forget_pin_otp").html(""); });
            flag = 0;
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
    
    /*---------------Forget Password OTP Page Ends---------------*/





    /*---------------Forget Pin Page Starts---------------*/

    $("#btn_forget_pin").click(function(){

        var email_filter       = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        var email_mobile       = $("#email_mobile").val();
        var email_mobile_value = $.trim(email_mobile);
        var flag               = 1;
        
        $("#err_email_mobile").html("");

        if($.trim(email_mobile) == '')
        {
            $("#err_email_mobile").html(error_email_mobile);
            $("#email_mobile").focus();
            //$("#email_mobile").on('keyup',function(){ $("#err_email_mobile").html(""); });
            flag = 0;
        }

        if($.trim(email_mobile) != '')
        {
            if($.isNumeric(email_mobile_value))
            {
                var value_is = 'mobile';
            }
            else
            {
                var value_is = 'email';
            }
            
            if(!email_filter.test(email_mobile) && value_is == 'email')
            {
                $("#err_email_mobile").html(error_valid_email);
                $("#email_mobile").focus();
                //$("#email_mobile").on('keyup',function(){ $("#err_email_mobile").html(""); });
                flag = 0;
            }
            else if(email_filter.test(email_mobile) && value_is == 'email')
            {
                var output = CheckEmailExists(email_mobile);
                if($.trim(output) == 'success')
                {
                    $("#err_email_mobile").html(error_email_not_exist);
                    $("#email_mobile").focus();
                    //$("#email_mobile").on('keyup',function(){ $("#err_email_mobile").html(""); });
                    flag = 0;
                }
                else
                {
                    flag = 1;
                }
            }

            if($.trim(email_mobile).length < 8 && value_is == 'mobile')
            {
                $("#err_email_mobile").html(err_mobile_length_min);
                $("#email_mobile").focus();
                //$("#email_mobile").on('keyup',function(){ $("#err_email_mobile").html("");});
                flag = 0;
            }
            else if($.trim(email_mobile).length > 16 && value_is == 'mobile')
            {
                $("#err_email_mobile").html(err_mobile_length_max);
                $("#email_mobile").focus();
                //$("#email_mobile").on('keyup',function(){ $("#err_email_mobile").html("");});
                flag = 0;
            }
            else if($.trim(email_mobile).length > 8 && $.trim(email_mobile).length < 16 && value_is == 'mobile')
            {
                var output = CheckMobileExists(email_mobile);
                if($.trim(output) == 'success')
                {
                    $("#err_email_mobile").html(error_mobile_not_exist);
                    $("#email_mobile").focus();
                    //$("#email_mobile").on('keyup',function(){ $("#err_email_mobile").html(""); });
                    flag = 0;
                }
                else
                {
                    flag = 1;
                }
            }
        }

        if(flag == 0)
        {
            return false;
        }
        else
        {
            $('#btn_forget_pin').attr('disabled',true);
            $('#frm_forget_pin').submit();
            //return true;
        }

    });
    
    /*---------------Forget Pin Page Ends---------------*/





    /*---------------Teacher Profile Page Starts---------------*/

    $("#teacher_email").blur(function(){
        var email        = $("#teacher_email").val();
        var email_filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

        if($.trim(email) != '')
        {
            if(!email_filter.test(email))
            {
                $("#err_email").html(error_valid_email);
                $("#teacher_email").focus();
                $("#teacher_email").on('keyup',function(){ $("#err_email").html(""); });
                return false;
            }
            var token = $('input[name="_token"]').val();
            $.ajax({
                url : SITE_URL+"/email/duplicate",
                type : "POST",
                dataType :'json',
                data: { _token:token, email:email},
                success : function(res)
                {
                    if($.trim(res) == 'error')
                    {
                        $('#err_email').html(email_already_exists);
                        $('#form_teacher_profile').attr('disabled',true);
                        $('#teacher_email').focus();   
                        return false; 
                    }
                    else if($.trim(res)=='success')
                    {
                        $('#err_email').html('');
                        $('#form_teacher_profile').attr('disabled',false);
                        return true;
                    }
                    else
                    {
                        $('#teacher_email').focus();
                        $('#err_email').html(Something_has_get_wrong);
                        $('#form_teacher_profile').attr('disabled',true);
                        return false;
                    }
                }
            });
        }
    });

    $("#teacher_mobile").blur(function(){
        var mobile = $("#teacher_mobile").val();

        if($.trim(mobile) != '')
        {
            if($.trim(mobile).length < 8)
            {
                $("#err_mobile").html(err_mobile_length_min);
                $("#teacher_mobile").focus();
                $("#teacher_mobile").on('keyup',function(){ $("#err_mobile").html("");});
                return false;
            }
            var token = $('input[name="_token"]').val();
            $.ajax({
                url : SITE_URL+"/mobile/duplicate",
                type : "POST",
                dataType :'json',
                data: { _token:token, mobile:mobile},
                success : function(res)
                {
                    if($.trim(res) == 'error')
                    {
                        $('#teacher_mobile').focus();
                        $('#err_mobile').html(mobile_already_exists);
                        $('#btn_teacher_profile_update').attr('disabled',true);
                        return false; 
                    }
                    else if($.trim(res)=='success')
                    {
                        $('#err_mobile').html('');
                        $('#btn_teacher_profile_update').attr('disabled',false);
                        return true;
                    }
                    else
                    {
                        $('#teacher_mobile').focus();
                        $('#err_mobile').html(Something_has_get_wrong);
                        $('#btn_teacher_profile_update').attr('disabled',true);
                        return false;
                    }
                }
            });
        }
    });

    $("#btn_teacher_profile_update").click(function(){
        var profile_image      = $("#profile_image").val();
        var oldimage           = $("#oldimage").val();
        var first_name         = $("#first_name").val();
        var last_name          = $("#last_name").val();
        var mobile             = $("#teacher_mobile").val();
        var address            = $("#address").val();
        var gender             = $("#gender").val();
        var phone_code         = $("#phone_code").val();
        var preferred_language = $("#preferred_language").val();
        var flag               = 1;

        if($.trim(oldimage) == '' && $.trim(profile_image) == '')
        {
            $("#err_profile_image").html(error_profile_image);
            $("#profile_image").on('change',function(){ $("#err_profile_image").html(""); });
            flag = 0;
        }
        if($.trim(first_name) == '')
        {
            $("#err_first_name").html(error_first_name);
            $("#first_name").focus();
            $("#first_name").on('keyup',function(){ $("#err_first_name").html(""); });
            flag = 0;
        }
        if($.trim(last_name) == '')
        {
            $("#err_last_name").html(error_last_name);
            $("#last_name").focus();
            $("#last_name").on('keyup',function(){ $("#err_last_name").html(""); });
            flag = 0;
        }
        if($.trim(mobile) == '')
        {
            $("#err_mobile").html(error_mobile_no);
            $("#teacher_mobile").focus();
            $("#teacher_mobile").on('keyup',function(){ $("#err_mobile").html(""); });
            flag = 0;
        }
        else if($.trim(mobile).length < 8)
        {
            $("#err_mobile").html(err_mobile_length_min);
            $("#teacher_mobile").focus();
            $("#teacher_mobile").on('keyup',function(){ $("#err_mobile").html("");});
            flag = 0;
        }
        if($.trim(address) == '')
        {
            $("#err_address").html(error_address);
            $("#address").focus();
            $("#address").on('keyup',function(){ $("#err_address").html(""); });
            flag = 0;
        }
        if($.trim(gender) == '')
        {
            $("#err_gender").html(error_gender);
            $("#gender").focus();
            $("#gender").on('change',function(){ $("#err_gender").html(""); });
            flag = 0;
        }
        if($.trim(preferred_language) == '')
        {
            $("#err_preferred_language").html(error_preferred_language);
            $("#preferred_language").focus();
            $("#preferred_language").on('change',function(){ $("#err_preferred_language").html(""); });
            flag = 0;
        }
        if($.trim(phone_code) == '')
        {
            $("#err_phone_code").html(err_phone_code);
            $("#phone_code").focus();
            $("#phone_code").on('keyup',function(){ $("#err_phone_code").html(""); });
            flag = 0;
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

    $("#teacher_verify_mobile").click(function(){

        var mobile     = $("#teacher_mobile").val();
        var phone_code = $("#phone_code").val();
        if($.trim(phone_code) == '')
        {
            $("#err_phone_code").html('This field is required');
            $("#phone_code").focus();
            $("#phone_code").on('keyup',function(){ $("#err_phone_code").html(""); });
             return false;
        }
        if($.trim(mobile) == '')
        {
            $("#err_mobile").html(error_mobile_no);
            $("#teacher_mobile").focus();
            $("#teacher_mobile").on('keyup',function(){ $("#err_mobile").html(""); });
            return false;
        }
        else if($.trim(mobile).length < 8)
        {
            $("#err_mobile").html(err_mobile_length_min);
            $("#teacher_mobile").focus();
            $("#teacher_mobile").on('keyup',function(){ $("#err_mobile").html("");});
            return false;
        }
        else
        {
            var output = CheckMobileExists(mobile);

            if($.trim(output) == 'error')
            {
                swal("",error_Mobile_already_exists ,"error");
            }
            else if($.trim(output) == 'success')
            {
                $.ajax({
                    url : SITE_URL+"/teacher/account-setting/otp-request",
                    type : "POST",
                    data: { _token:csrf_token, mobile:mobile,phone_code:phone_code},
                    beforeSend:showProcessingOverlay(),
                    success : function(res)
                    {
                        if($.trim(res) == 'error')
                        {
                            swal("",error_Mobile_number_required ,"error");
                            return false;
                        }
                        else if($.trim(res.status) == 'already_verified')
                        {
                             window.location.href = SITE_URL+"/teacher/account-setting/my-profile";
                        }
                        else
                        {
                            window.location.href = SITE_URL+"/teacher/account-setting/otp-verify";
                        }
                    }
                });
            }
        }

    });

    $("#btn_teacher_profile_cancel").click(function(){
        window.location.href = SITE_URL+"/teacher/dashboard";
    });

    $('#profile_image').change(function(){  
          
        var file = this.files;
        validateImage(this.files, 250,250);
    })

    /*---------------Teacher Profile Page Ends---------------*/





    /*---------------Teacher Change Password Page Starts---------------*/

    $("#btn_change_password").click(function(){
        var password_filter      = /^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^])([a-zA-Z0-9!@#$%^]{6,})$/;
        var current_password     = $("#current_password").val();
        var new_password         = $("#new_password").val();
        var confirm_new_password = $("#confirm_new_password").val();
        var flag                 = 1;

        if($.trim(current_password) == '')
        {
            $("#err_current_password").html(error_current_password);
            $("#current_password").focus();
            $("#current_password").on('keyup',function(){ $("#err_current_password").html(""); });
            flag = 0;
        }
        else if(!password_filter.test(current_password))
        {
            $("#err_current_password").html(error_valid_current_password);
            $("#current_password").focus();
            $("#current_password").on('keyup',function(){ $("#err_current_password").html(""); });
            flag = 0;
        }
        else if($.trim(current_password).length < 6)
        {
            $("#err_current_password").html(error_current_password_min);
            $("#current_password").focus();
            $("#current_password").on('keyup',function(){ $("#err_current_password").html("");});
            flag = 0;
        }

        if($.trim(new_password) == '')
        {
            $("#err_new_password").html(error_new_password);
            $("#new_password").focus();
            $("#new_password").on('keyup',function(){ $("#err_new_password").html(""); });
            flag = 0;
        }
        else if(!password_filter.test(new_password))
        {
            $("#err_new_password").html(error_valid_new_password);
            $("#new_password").focus();
            $("#new_password").on('keyup',function(){ $("#err_new_password").html(""); });
            flag = 0;
        }
        else if($.trim(new_password).length < 6)
        {
            $("#err_new_password").html(error_new_password_min);
            $("#new_password").focus();
            $("#new_password").on('keyup',function(){ $("#err_new_password").html("");});
            flag = 0;
        }
        else if($.trim(current_password) == $.trim(new_password))
        {
            $("#err_new_password").html(error_password_match);
            $("#new_password").focus();
            $("#new_password").on('keyup',function(){ $("#err_new_password").html(""); });
            flag = 0;
        }

        if($.trim(confirm_new_password) == '')
        {
            $("#err_confirm_new_password").html(error_new_confirm_password);
            $("#confirm_new_password").focus();
            $("#confirm_new_password").on('keyup',function(){ $("#err_confirm_new_password").html(""); });
            flag = 0;
        }
        else if(!password_filter.test(confirm_new_password))
        {
            $("#err_confirm_new_password").html(error_valid_new_confirm_password);
            $("#confirm_new_password").focus();
            $("#confirm_new_password").on('keyup',function(){ $("#err_confirm_new_password").html(""); });
            flag = 0;
        }
        else if($.trim(confirm_new_password).length < 6)
        {
            $("#err_confirm_new_password").html(error_new_confirm_password_min);
            $("#confirm_new_password").focus();
            $("#confirm_new_password").on('keyup',function(){ $("#err_confirm_new_password").html("");});
            flag = 0;
        }
        else if($.trim(confirm_new_password) != $.trim(new_password))
        {
            $("#err_confirm_new_password").html(error_both_new_password);
            $("#confirm_new_password").focus();
            $("#confirm_new_password").on('keyup',function(){ $("#err_confirm_new_password").html(""); });
            flag = 0;
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
    
    /*---------------Teacher Change Password Page Ends---------------*/





    /*---------------Teacher My Class Page Starts---------------*/

    $("#btn_add_class").click(function(){
        var class_name = $("#class_name").val();
        var subject    = $("#subject").val();
        var grade      = $("#grade").val();
        var end_date   = $("#end_date").val();
        var program    = $("#program").val();
        var flag       = 1;

        if($.trim(grade) == '')
        {
            $("#err_grade").html(error_grade);
            $("#grade").focus();
            $("#grade").on('change',function(){ $("#err_grade").html(""); });
            flag = 0;
        }
        if($.trim(subject) == '')
        {
            $("#err_subject").html(error_subject);
            $("#subject").focus();
            $("#subject").on('change',function(){ $("#err_subject").html(""); });
            flag = 0;
        }
        if($.trim(end_date) == '')
        {
            $("#err_end_date").html(error_end_date);
            //$("#end_date").focus();
            $("#end_date").on('change',function(){ $("#err_end_date").html(""); });
            flag = 0;
        }
        if($.trim(class_name) == '')
        {
            $("#err_class_name").html(error_class_name);
            $("#class_name").focus();
            $("#class_name").on('keyup',function(){ $("#err_class_name").html(""); });
            flag = 0;
        }
    
        /*if($.trim(program) == '')
        {
            $("#err_program").html('Please select program');
            $("#program").focus();
            $("#program").on('keyup',function(){ $("#err_program").html(""); });
            flag = 0;
        }*/

        if(flag == 0)
        {
            return false;
        }
        else
        {
            return true;
        }
    });

    $(".delete_class").click(function(){
        var class_id = $(this).data("id");
        $("#txt_delete_class_id").val(class_id);
    });

    $(".edit_class").click(function(){
        var class_id   = $(this).data("id");
        var class_name = $(this).data("class_name");
        var grade_id   = $(this).data("grade_id");
        var subject_id = $(this).data("subject_id");
        var program_id = $(this).data("program_id");
        var end_date   = $(this).data("end_date");
        
        getGrade(subject_id, grade_id, 'edit');
        getProgram(subject_id, grade_id, program_id, 'edit');
        
        $("#edit_class_id").val(class_id);
        $("#edit_class_name").val(class_name);
        $('#edit_subject').val(subject_id).attr("selected", "selected");
        /*$('#edit_grade').val(grade_id).attr("selected", "selected");
        $('#edit_program').val(program_id).attr("selected", "selected");*/

        $( "#edit_end_date" ).val(end_date);

        $( "#edit_end_date" ).datepicker({
            startDate: new Date(),
            todayHighlight: true,
            autoclose: true,
            format: 'dd-M-yyyy'
        });

    });

    $("#btn_edit_class").click(function(){
        var class_name = $("#edit_class_name").val();
        var subject    = $("#edit_subject").val();
        var grade      = $("#edit_grade").val();
        var end_date   = $("#edit_end_date").val();
        var program    = $("#edit_program").val();
        var flag       = 1;

        if($.trim(grade) == '')
        {
            $("#err_edit_grade").html(error_grade);
            $("#edit_grade").focus();
            $("#edit_grade").on('change',function(){ $("#err_edit_grade").html(""); });
            flag = 0;
        }
        if($.trim(subject) == '')
        {
            $("#err_edit_subject").html(error_subject);
            $("#edit_subject").focus();
            $("#edit_subject").on('change',function(){ $("#err_edit_subject").html(""); });
            flag = 0;
        }
        if($.trim(end_date) == '')
        {
            $("#err_edit_subject").html(error_end_date);
            //$("#end_date").focus();
            $("#edit_subject").on('change',function(){ $("#err_edit_subject").html(""); });
            flag = 0;
        }
        if($.trim(class_name) == '')
        {
            $("#err_edit_class_name").html(error_class_name);
            $("#edit_class_name").focus();
            $("#edit_class_name").on('keyup',function(){ $("#err_edit_class_name").html(""); });
            flag = 0;
        }
        /*if($.trim(program) == '')
        {
            $("#err_edit_program").html('Please select program');
            $("#edit_program").focus();
            $("#edit_program").on('keyup',function(){ $("#err_edit_program").html(""); });
            flag = 0;
        }*/

        if(flag == 0)
        {
            return false;
        }
        else
        {
            return true;
        }
    });

    $( "#close_edit_class, #cancel_edit_class" ).click(function(){
        $( "#edit_end_date" ).datepicker('remove');
        $("#form_edit_class").find('.error').html('');
    });

    $( "#end_date" ).datepicker({
        startDate: new Date(),
        todayHighlight: true,
        autoclose: true,
        format: 'dd-M-yyyy'
    });

    $("#close_add_class_popup, #cancel_add_class_popup").click(function() {
        $('#form_add_class')[0].reset();
    });



        /*-----Teacher Add My student Page Starts-----*/

        
        
        /*-----Teacher Add My student Page Ends-----*/




    /*---------------Teacher My Class Page Ends---------------*/





    /*---------------Teacher Notification Page Ends---------------*/

    $(".open_teacher_notification_popup").click(function(){
        var id = $(this).data("id");
        $("#txt_delete_notification_id").val(id);
    });

    /*---------------Teacher Notification Page Ends---------------*/






    /*---------------Parent Profile Page Starts---------------*/

    $("#parent_email").blur(function(){
        var email        = $("#parent_email").val();
        var email_filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

        if($.trim(email) != '')
        {
            if(!email_filter.test(email))
            {
                $("#err_email").html(error_valid_email);
                $("#parent_email").focus();
                $("#parent_email").on('keyup',function(){ $("#err_email").html(""); });
                return false;
            }
            var token = $('input[name="_token"]').val();
            $.ajax({
                url : SITE_URL+"/email/duplicate",
                type : "POST",
                dataType :'json',
                data: { _token:token, email:email},
                success : function(res)
                {
                    if($.trim(res) == 'error')
                    {
                        $('#err_email').html(email_already_exists);
                        $('#btn_parent_profile_update').attr('disabled',true);
                        $('#parent_email').focus();   
                        return false; 
                    }
                    else if($.trim(res)=='success')
                    {
                        $('#err_email').html('');
                        $('#btn_parent_profile_update').attr('disabled',false);
                        return true;
                    }
                    else
                    {
                        $('#parent_email').focus();
                        $('#err_email').html(Something_has_get_wrong);
                        $('#btn_parent_profile_update').attr('disabled',true);
                        return false;
                    }
                }
            });
        }
    });

    $("#parent_mobile").blur(function(){
        var mobile = $("#parent_mobile").val();

        if($.trim(mobile) != '')
        {
            if($.trim(mobile).length < 8)
            {
                $("#err_mobile").html(err_mobile_length_min);
                $("#parent_mobile").focus();
                $("#parent_mobile").on('keyup',function(){ $("#err_mobile").html("");});
                return false;
            }
            var token = $('input[name="_token"]').val();
            $.ajax({
                url : SITE_URL+"/mobile/duplicate",
                type : "POST",
                dataType :'json',
                data: { _token:token, mobile:mobile},
                success : function(res)
                {
                    if($.trim(res) == 'error')
                    {
                        $('#parent_mobile').focus();
                        $('#err_mobile').html(mobile_already_exists);
                        $('#btn_parent_profile_update').attr('disabled',true);
                        return false; 
                    }
                    else if($.trim(res)=='success')
                    {
                        $('#err_mobile').html('');
                        $('#btn_parent_profile_update').attr('disabled',false);
                        return true;
                    }
                    else
                    {
                        $('#parent_mobile').focus();
                        $('#err_mobile').html(Something_has_get_wrong);
                        $('#btn_parent_profile_update').attr('disabled',true);
                        return false;
                    }
                }
            });
        }
    });

    $("#btn_parent_profile_update").click(function(){
        var profile_image      = $("#profile_image").val();
        var oldimage           = $("#oldimage").val();
        var first_name         = $("#first_name").val();
        var last_name          = $("#last_name").val();
        var mobile             = $("#parent_mobile").val();
        var phone_code         = $("#phone_code").val();
        var old_mobile         = $("#old_mobile").val();
        var address            = $("#address").val();
        var gender             = $("#gender").val();
        var preferred_language = $("#preferred_language").val();
        var flag               = 1;

        if($.trim(preferred_language) == '')
        {
            $("#err_preferred_language").html(error_preferred_language);
            $("#preferred_language").focus();
            $("#preferred_language").on('change',function(){ $("#err_preferred_language").html(""); });
            flag = 0;
        }
        if($.trim(gender) == '')
        {
            $("#err_gender").html(error_gender);
            $("#gender").focus();
            $("#gender").on('change',function(){ $("#err_gender").html(""); });
            flag = 0;
        }
        if($.trim(address) == '')
        {
            $("#err_address").html(error_address);
            $("#address").focus();
            $("#address").on('keyup',function(){ $("#err_address").html(""); });
            flag = 0;
        }
        if($.trim(mobile) == '')
        {
            $("#err_mobile").html(error_mobile_no);
            $("#parent_mobile").focus();
            $("#parent_mobile").on('keyup',function(){ $("#err_mobile").html(""); });
            flag = 0;
        }
        else if($.trim(mobile).length < 8)
        {
            $("#err_mobile").html(err_mobile_length_min);
            $("#parent_mobile").focus();
            $("#parent_mobile").on('keyup',function(){ $("#err_mobile").html("");});
            flag = 0;
        }
        if($.trim(last_name) == '')
        {
            $("#err_last_name").html(error_last_name);
            $("#last_name").focus();
            $("#last_name").on('keyup',function(){ $("#err_last_name").html(""); });
            flag = 0;
        }
        if($.trim(first_name) == '')
        {
            $("#err_first_name").html(error_first_name);
            $("#first_name").focus();
            $("#first_name").on('keyup',function(){ $("#err_first_name").html(""); });
            flag = 0;
        }
        if($.trim(oldimage) == '' && $.trim(profile_image) == '')
        {
            $("#err_profile_image").html(error_profile_image);
            $("#profile_image").on('change',function(){ $("#err_profile_image").html(""); });
            flag = 0;
        }
        if($.trim(phone_code) == '')
        {
            $("#err_phone_code").html(err_phone_code);
            $("#phone_code").focus();
            $("#phone_code").on('keyup',function(){ $("#err_phone_code").html(""); });
            flag = 0;
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

    $("#parent_verify_mobile").click(function(){
        var mobile = $("#parent_mobile").val();
        var phone_code = $("#phone_code").val();
        if($.trim(phone_code) == '')
        {
            $("#err_phone_code").html('This field is required');
            $("#phone_code").focus();
            $("#phone_code").on('keyup',function(){ $("#err_phone_code").html(""); });
            return false;
        }
        if($.trim(mobile) == '')
        {
            $("#err_mobile").html(error_mobile_no);
            $("#parent_mobile").focus();
            $("#parent_mobile").on('keyup',function(){ $("#err_mobile").html(""); });
            return false;
        }
        else if($.trim(mobile).length < 8)
        {
            $("#err_mobile").html(err_mobile_length_min);
            $("#parent_mobile").focus();
            $("#parent_mobile").on('keyup',function(){ $("#err_mobile").html("");});
            return false;
        }
        else
        {
            var output = CheckMobileExists(mobile);
            if($.trim(output) == 'error')
            {
                swal("","Mobile already exists try different mobile number." ,"error");
            }
            else if($.trim(output) == 'success')
            {
                $.ajax({
                    url : SITE_URL+"/parent/account-setting/otp-request",
                    type : "POST",
                    data: { _token:csrf_token,mobile:mobile,phone_code:phone_code},
                    beforeSend:showProcessingOverlay(),
                    success : function(res)
                    {
                        if($.trim(res) == 'error')
                        {
                            swal("","Mobile number is required." ,"error");
                            return false;
                        }
                        else if(res.status=='already_verified')
                        {
                            window.location.href = SITE_URL+"/parent/account-setting/my-profile";
                        }
                        else
                        {
                            window.location.href = SITE_URL+"/parent/account-setting/otp-verify";
                        }
                    }
                });
            }
        }

    });

    $("#btn_parent_profile_cancel").click(function(){
        window.location.href = SITE_URL+"/parent/dashboard";
    });

    $('#profile_image').change(function(){
        var file = this.files;
        validateImage(this.files, 250,250);
    })

    /*---------------Parent Profile Page Ends---------------*/





    /*---------------Parent Change Password Page Starts---------------*/

    $("#btn_parent_change_password").click(function(){
        var password_filter      = /^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^])([a-zA-Z0-9!@#$%^]{6,})$/;
        var current_password     = $("#current_password").val();
        var new_password         = $("#new_password").val();
        var confirm_new_password = $("#confirm_new_password").val();
        var flag                 = 1;

        if($.trim(confirm_new_password) == '')
        {
            $("#err_confirm_new_password").html(error_new_confirm_password);
            $("#confirm_new_password").focus();
            $("#confirm_new_password").on('keyup',function(){ $("#err_confirm_new_password").html(""); });
            flag = 0;
        }
        else if(!password_filter.test(confirm_new_password))
        {
            $("#err_confirm_new_password").html(error_valid_new_confirm_password);
            $("#confirm_new_password").focus();
            $("#confirm_new_password").on('keyup',function(){ $("#err_confirm_new_password").html(""); });
            flag = 0;
        }
        else if($.trim(confirm_new_password).length < 6)
        {
            $("#err_confirm_new_password").html(error_new_confirm_password_min);
            $("#confirm_new_password").focus();
            $("#confirm_new_password").on('keyup',function(){ $("#err_confirm_new_password").html("");});
            flag = 0;
        }
        else if($.trim(confirm_new_password) != $.trim(new_password))
        {
            $("#err_confirm_new_password").html(error_both_new_password);
            $("#confirm_new_password").focus();
            $("#confirm_new_password").on('keyup',function(){ $("#err_confirm_new_password").html(""); });
            flag = 0;
        }
        if($.trim(new_password) == '')
        {
            $("#err_new_password").html(error_new_password);
            $("#new_password").focus();
            $("#new_password").on('keyup',function(){ $("#err_new_password").html(""); });
            flag = 0;
        }
        else if(!password_filter.test(new_password))
        {
            $("#err_new_password").html(error_valid_new_password);
            $("#new_password").focus();
            $("#new_password").on('keyup',function(){ $("#err_new_password").html(""); });
            flag = 0;
        }
        else if($.trim(new_password).length < 6)
        {
            $("#err_new_password").html(error_password_match);
            $("#new_password").focus();
            $("#new_password").on('keyup',function(){ $("#err_new_password").html("");});
            flag = 0;
        }
        else if($.trim(current_password) == $.trim(new_password))
        {
            $("#err_new_password").html(error_password_match);
            $("#new_password").focus();
            $("#new_password").on('keyup',function(){ $("#err_new_password").html(""); });
            flag = 0;
        }
        if($.trim(current_password) == '')
        {
            $("#err_current_password").html(error_current_password);
            $("#current_password").focus();
            $("#current_password").on('keyup',function(){ $("#err_current_password").html(""); });
            flag = 0;
        }
        else if(!password_filter.test(current_password))
        {
            $("#err_current_password").html(error_valid_current_password);
            $("#current_password").focus();
            $("#current_password").on('keyup',function(){ $("#err_current_password").html(""); });
            flag = 0;
        }
        else if($.trim(current_password).length < 6)
        {
            $("#err_current_password").html(error_current_password_min);
            $("#current_password").focus();
            $("#current_password").on('keyup',function(){ $("#err_current_password").html("");});
            flag = 0;
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
    
    /*---------------Parent Change Password Page Ends---------------*/




    /*---------------Parent My Children Page Starts---------------*/

    $(".edit_child").click(function(){
        var child_id    = $(this).data('child_id');
        var class_fname = $(this).data('class_fname');
        var class_lname = $(this).data('class_lname');
        var subject_id  = $(this).data('subject_id');
        var grade_id    = $(this).data('grade_id');
        var child_pin   = $(this).data('child_pin');

        getGrade(subject_id, grade_id, 'edit');

        $("#edit_child_id").val(child_id);
        $("#edit_first_name").val(class_fname);
        $("#edit_last_name").val(class_lname);
        $('#edit_subject').val(subject_id).attr("selected", "selected");
        /*$('#edit_grade').val(grade_id).attr("selected", "selected");*/
        $("#edit_pin").val(child_pin);
    });

    $("#btn_submit_edit_child").click(function(){
        var first_name = $("#edit_first_name").val();
        var last_name  = $("#edit_last_name").val();
        var subject    = $("#edit_subject").val();
        var grade      = $("#edit_grade").val();
        //var pin        = $("#edit_pin").val();
        var flag       = 1;

        if($.trim(first_name) == '')
        {
            $("#err_edit_first_name").html(error_first_name);
            $("#edit_first_name").focus();
            $("#edit_first_name").on('keyup',function(){ $("#err_edit_first_name").html(""); });
            flag = 0;
        }
        if($.trim(last_name) == '')
        {
            $("#err_edit_last_name").html(error_last_name);
            $("#edit_last_name").focus();
            $("#edit_last_name").on('keyup',function(){ $("#err_edit_last_name").html(""); });
            flag = 0;
        }
        if($.trim(subject) == '')
        {
            $("#err_edit_subject").html(error_subject);
            $("#edit_subject").focus();
            $("#edit_subject").on('change',function(){ $("#err_edit_subject").html(""); });
            flag = 0;
        }
        if($.trim(grade) == '')
        {
            $("#err_edit_grade").html(error_grade);
            $("#edit_grade").focus();
            $("#edit_grade").on('change',function(){ $("#err_edit_grade").html(""); });
            flag = 0;
        }
        /*if($.trim(pin) == '')
        {
            $("#err_edit_pin").html('Please enter pin');
            $("#edit_pin").focus();
            $("#edit_pin").on('change',function(){ $("#err_edit_pin").html(""); });
            flag = 0;
        }*/

        if(flag == 0)
        {
            return false;
        }
        else
        {
            return true;
        }
    });

    $("#close_edit_child_pop, #btn_cancel_edit_child").click(function(){
        $("#form_edit_child").find('.error').html('');
    });

    $(".delete_child").click(function(){
        var child_id = $(this).data("child_id");
        $("#txt_delete_child_id").val(child_id);
    });





    function parent_check_radio()
    {
        var checked_child_type = $('input[name=child_type]:checked').val();

        $(".form_fields").css('display', 'none');
        $("#div_"+checked_child_type).css('display', 'block');
        //$("#div_"+checked_child_type).find('input,select').val('');
        //$("#addition_div").find('input,select').val('');
        //$(".error").html("");

        var terms = $('input[name=child_type]:checked').data('terms');
        if(terms == 'yes')
        {
            $('#addition_div').css('display','block');
            $("#div_termsconditions").css('display', 'block');
        }
        else
        {
            $('#addition_div').css('display','none');
            $("#div_termsconditions").css('display', 'none');
        }
    }

    function getGrade(subject_id = false, grade_id = false, event = false)
    {
        $.ajax({
            url : SITE_URL+"/common/getgrade",
            type : "POST",
            data : { _token:csrf_token, subject_id:subject_id, grade_id:grade_id },
            success : function(result)
            {
                if(event == 'add')
                {
                    $("#grade").html(result);
                }
                else if(event == 'edit')
                {
                    $("#edit_grade").html(result);
                }
            }
        });
    }

    function getProgram(subject_id = false, grade_id = false, program_id = false, event = false)
    {
        $.ajax({
            url : SITE_URL+"/common/getprogram",
            type : "POST",
            data : { _token:csrf_token, subject_id:subject_id, grade_id:grade_id, program_id:program_id },
            success : function(result)
            {
                if(event == 'add')
                {
                    $("#program").html(result);
                }
                else if(event == 'edit')
                {
                    $("#edit_program").html(result);
                }
            }
        });
    }


    parent_check_radio();

    $('.child_type').change(function(){

        parent_check_radio();
    });

    $("#btn_submit_add_child").click(function(){

        var email_filter       = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        var child_type         = $('input[name=child_type]:checked').val();

        var new_first_name     = $("#new_first_name").val();
        var new_last_name      = $("#new_last_name").val();

        var old_first_name     = $("#old_first_name").val();
        var old_last_name      = $("#old_last_name").val();
        var teacher_email      = $("#teacher_email").val();
        var pin                = $("#old_pin").val();

        var code_teacher_email = $("#code_teacher_email").val();
        var enrollment_code    = $("#enrollment_code").val();
        var termsconditions    = $('#termsconditions').is(":checked");

        var subject            = $("#subject").val();
        var grade              = $("#grade").val();
        var program            = $("#program").val();

        var flag               = 1;


        if(child_type == 'not_using_system')
        {
            if($.trim(new_first_name) == '')
            {
                $("#err_new_first_name").html(error_first_name);
                $("#new_first_name").focus();
                $("#new_first_name").on('keyup',function(){ $("#err_new_first_name").html(""); });
                flag = 0;
            }

            if($.trim(new_last_name) == '')
            {
                $("#err_new_last_name").html(error_last_name);
                $("#new_last_name").focus();
                $("#new_last_name").on('keyup',function(){ $("#err_new_last_name").html(""); });
                flag = 0;
            }
            if($.trim(subject) == '')
            {
                $("#err_subject").html(error_subject);
                $("#subject").focus();
                $("#subject").on('change',function(){ $("#err_subject").html(""); });
                flag = 0;
            }

            if($.trim(grade) == '')
            {
                $("#err_grade").html(error_grade);
                $("#grade").focus();
                $("#grade").on('change',function(){ $("#err_grade").html(""); });
                flag = 0;
            }

            if($.trim(program) == '')
            {
                $("#err_program").html(error_program);
                $("#program").focus();
                $("#program").on('change',function(){ $("#err_program").html(""); });
                flag = 0;
            }

            /*if(termsconditions == false)
            {
                $("#err_termsconditions").html('Please agree with all our terms and conditions, policy');
                $("#termsconditions").on('click',function(){ $("#err_termsconditions").html(""); });
                flag = 0;
            }*/
        }
        else if(child_type == 'with_using_system')
        {
            if($.trim(old_first_name) == '')
            {
                $("#err_old_first_name").html(error_first_name);
                $("#old_first_name").focus();
                $("#old_first_name").on('keyup',function(){ $("#err_old_first_name").html(""); });
                flag = 0;
            }

            if($.trim(old_last_name) == '')
            {
                $("#err_old_last_name").html(error_last_name);
                $("#old_last_name").focus();
                $("#old_last_name").on('keyup',function(){ $("#err_old_last_name").html(""); });
                flag = 0;
            }

            if($.trim(teacher_email) == '')
            {
                $("#err_teacher_email").html(error_email_mobile);
                $("#teacher_email").focus();
                $("#teacher_email").on('keyup',function(){ $("#err_teacher_email").html(""); });
                flag = 0;
            }
            else if($.trim(teacher_email) != '')
            {
                if($.isNumeric(teacher_email))
                {
                    var value_is = 'mobile';
                }
                else
                {
                    var value_is = 'email';
                }
                
                if(!email_filter.test(teacher_email) && value_is == 'email')
                {
                    $("#err_teacher_email").html(error_valid_email);
                    $("#teacher_email").focus();
                    $("#teacher_email").on('keyup',function(){ $("#err_teacher_email").html(""); });
                    flag = 0;
                }
                else if(email_filter.test(teacher_email) && value_is == 'email')
                {
                    var id_name = 'teacher_email';
                    flag        = check_teacher_email(id_name);
                }

                if($.trim(teacher_email).length < 8 && value_is == 'mobile')
                {
                    $("#err_teacher_email").html(err_mobile_length_min);
                    $("#teacher_email").focus();
                    $("#teacher_email").on('keyup',function(){ $("#err_teacher_email").html("");});
                    flag = 0;
                }
                else if($.trim(teacher_email).length > 8 && value_is == 'mobile')
                {
                    var output = CheckMobileExists(teacher_email);
                    
                    if($.trim(output) == 'success')
                    {
                        $("#err_teacher_email").html(error_mobile_not_exist);
                        $("#teacher_email").focus();
                        $("#teacher_email").on('keyup',function(){ $("#err_teacher_email").html(""); });
                        flag = 0;
                    }
                    else
                    {
                        flag = 1;
                    }
                }
            }
            if($.trim(subject) == '')
            {
                $("#err_subject").html(error_subject);
                $("#subject").focus();
                $("#subject").on('change',function(){ $("#err_subject").html(""); });
                flag = 0;
            }

            if($.trim(grade) == '')
            {
                $("#err_grade").html(error_grade);
                $("#grade").focus();
                $("#grade").on('change',function(){ $("#err_grade").html(""); });
                flag = 0;
            }

            if($.trim(program) == '')
            {
                $("#err_program").html(error_program);
                $("#program").focus();
                $("#program").on('change',function(){ $("#err_program").html(""); });
                flag = 0;
            }

            /*if($.trim(teacher_email) == '')
            {
                $("#err_teacher_email").html('Please enter email');
                $("#teacher_email").focus();
                $("#teacher_email").on('keyup',function(){ $("#err_teacher_email").html(""); });
                flag = 0;
            }
            else if(!email_filter.test(teacher_email))
            {
                $("#err_teacher_email").html('Please enter vaild email');
                $("#teacher_email").focus();
                $("#teacher_email").on('keyup',function(){ $("#err_teacher_email").html(""); });
                flag = 0;
            }
            else
            {
                var id_name = 'teacher_email';
                flag        = check_teacher_email(id_name);
            }*/

            if($.trim(pin) == '')
            {
                $("#err_old_pin").html(error_pin);
                $("#old_pin").focus();
                $("#old_pin").on('keyup',function(){ $("#err_old_pin").html(""); });
                flag = 0;
            }
            else
            {
                flag = check_pin_exists();
            }

            /*if(termsconditions == false)
            {
                $("#err_termsconditions").html('Please agree with all our terms and conditions, policy');
                $("#termsconditions").on('click',function(){ $("#err_termsconditions").html(""); });
                flag = 0;
            }*/
        }
        else if(child_type == 'using_system')
        {
            if($.trim(code_teacher_email) == '')
            {
                $("#err_code_teacher_email").html(error_email_mobile);
                $("#code_teacher_email").focus();
                $("#code_teacher_email").on('keyup',function(){ $("#err_code_teacher_email").html(""); });
                flag = 0;
            }
            else if($.trim(code_teacher_email) == '')
            {
                if($.isNumeric(code_teacher_email))
                {
                    var value_is = 'mobile';
                }
                else
                {
                    var value_is = 'email';
                }

                if(!email_filter.test(code_teacher_email) && value_is == 'email')
                {
                    $("#err_code_teacher_email").html(error_valid_email);
                    $("#code_teacher_email").focus();
                    $("#code_teacher_email").on('keyup',function(){ $("#err_code_teacher_email").html(""); });
                    flag = 0;
                }
                else if(email_filter.test(code_teacher_email) && value_is == 'email')
                {
                    var id_name = 'code_teacher_email';
                    flag        = check_teacher_email(id_name);
                }

                if($.trim(code_teacher_email).length < 8 && value_is == 'mobile')
                {
                    $("#err_code_teacher_email").html(err_mobile_length_min);
                    $("#code_teacher_email").focus();
                    $("#code_teacher_email").on('keyup',function(){ $("#err_code_teacher_email").html("");});
                    flag = 0;
                }
                else if($.trim(code_teacher_email).length > 8 && value_is == 'mobile')
                {
                    var output = CheckMobileExists(code_teacher_email);
                    
                    if($.trim(output) == 'success')
                    {
                        $("#err_code_teacher_email").html(error_mobile_not_exist);
                        $("#code_teacher_email").focus();
                        $("#code_teacher_email").on('keyup',function(){ $("#err_code_teacher_email").html(""); });
                        flag = 0;
                    }
                    else
                    {
                        flag = 1;
                    }
                }
            }
            if($.trim(enrollment_code) == '')
            {
                $("#err_enrollment_code").html(error_enrollment_code);
                $("#enrollment_code").focus();
                $("#enrollment_code").on('keyup',function(){ $("#err_enrollment_code").html(""); });
                flag = 0;
            }
            else if($.trim(enrollment_code).length != 15)
            {
                $("#err_enrollment_code").html(error_enrollment_code_length);
                $("#enrollment_code").focus();
                $("#enrollment_code").on('keyup',function(){ $("#err_enrollment_code").html("");});
                flag = 0;
            }
            else
            {
                flag = check_enrollment_code_exists();
            }
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
    function validate_email()
    {
        var code_teacher_email = $("#code_teacher_email").val();
        var  flag = 1;
        if($.trim(code_teacher_email) == '')
        {
            $("#err_code_teacher_email").html(error_email_mobile);
            $("#code_teacher_email").focus();
            $("#code_teacher_email").on('keyup',function(){ $("#err_code_teacher_email").html(""); });
            flag = 0;
        }
        else if($.trim(code_teacher_email) == '')
        {
            if($.isNumeric(code_teacher_email))
            {
                var value_is = 'mobile';
            }
            else
            {
                var value_is = 'email';
            }

            if(!email_filter.test(code_teacher_email) && value_is == 'email')
            {
                $("#err_code_teacher_email").html(error_valid_email);
                $("#code_teacher_email").focus();
                $("#code_teacher_email").on('keyup',function(){ $("#err_code_teacher_email").html(""); });
                flag = 0;
            }
            else if(email_filter.test(code_teacher_email) && value_is == 'email')
            {
                var id_name = 'code_teacher_email';
                flag        = check_teacher_email(id_name);
            }

            if($.trim(code_teacher_email).length < 8 && value_is == 'mobile')
            {
                $("#err_code_teacher_email").html(err_mobile_length_min);
                $("#code_teacher_email").focus();
                $("#code_teacher_email").on('keyup',function(){ $("#err_code_teacher_email").html("");});
                flag = 0;
            }
            else if($.trim(code_teacher_email).length > 8 && value_is == 'mobile')
            {
                var output = CheckMobileExists(code_teacher_email);
                
                if($.trim(output) == 'success')
                {
                    $("#err_code_teacher_email").html(error_mobile_not_exist);
                    $("#code_teacher_email").focus();
                    $("#code_teacher_email").on('keyup',function(){ $("#err_code_teacher_email").html(""); });
                    flag = 0;
                }
                else
                {
                    flag = 1;
                }
            }
        }
        return flag;
    }
    $("#close_add_children_popup, #cancel_add_children_popup").click(function() {
        count = 0;
        $('#form_parent_add_child')[0].reset();
        $('.error').html('');
        parent_check_radio();
    });

    $('#subject').change(function() {
        var subject_id = $('#subject').val();
        getGrade(subject_id, '', 'add');
    });

    $('#edit_subject').change(function() {
        var subject_id = $('#edit_subject').val();
        getGrade(subject_id, '', 'edit');
    });

    $('#grade').change(function() {
        var subject_id = $('#subject').val();
        var grade_id   = $('#grade').val();

        getProgram(subject_id, grade_id, '', 'add');
    });

    $('#edit_grade').change(function() {
        var subject_id = $('#edit_subject').val();
        var grade_id   = $('#edit_grade').val();

        getProgram(subject_id, grade_id, '', 'edit');
    });


    function check_teacher_email(id_name)
    {
        var email_filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        var teacher_email = $("#"+id_name).val();

        if($.trim(teacher_email) == '')
        {
            $("#err_"+id_name).html(error_email_mobile);
            $("#"+id_name).focus();
            $("#"+id_name).on('keyup',function(){ $("#err_"+id_name).html(""); });
            flag = 0;
        }
        else if($.trim(teacher_email) != '')
        {
            if($.isNumeric(teacher_email))
            {
                var value_is = 'mobile';
            }
            else
            {
                var value_is = 'email';
            }

            if(!email_filter.test(teacher_email) && value_is == 'email')
            {
                $("#err_"+id_name).html(error_valid_email);
                $("#"+id_name).focus();
                $("#"+id_name).on('keyup',function(){ $("#err_"+id_name).html(""); });
                flag = 0;
            }
            else if(email_filter.test(teacher_email) && value_is == 'email')
            {
                var output = CheckEmailExists(teacher_email);

                if($.trim(output) == 'success')
                {
                    $("#err_"+id_name).html(error_email_not_exist);
                    $("#"+id_name).focus();
                    $("#"+id_name).on('keyup',function(){ $("#err_"+id_name).html(""); });
                    flag = 0;
                }
                else if($.trim(output) == 'error')
                {
                    $("#err_"+id_name).html('');
                    flag = 1;
                }
            }

            if($.trim(teacher_email).length < 8 && value_is == 'mobile')
            {
                $("#err_"+id_name).html(err_mobile_length_min);
                $("#"+id_name).focus();
                $("#"+id_name).on('keyup',function(){ $("#err_"+id_name).html("");});
                flag = 0;
            }
            else if($.trim(teacher_email).length > 8 && value_is == 'mobile')
            {
                var output = CheckMobileExists(teacher_email);
                    
                if($.trim(output) == 'success')
                {
                    $("#err_"+id_name).html(error_mobile_not_exist);
                    $("#"+id_name).focus();
                    $("#"+id_name).on('keyup',function(){ $("#err_"+id_name).html(""); });
                    flag = 0;
                }
                else
                {
                    flag = 1;
                }
            }
        }

        return flag;
    }

    $("#teacher_email").blur(function(){
        var id_name = 'teacher_email';
        var flag = check_teacher_email(id_name);

        if(flag == 0)
        {
            return false;
        }
        else
        {
            return true;
        }

    });


    function check_pin_exists()
    {
        var old_first_name = $("#old_first_name").val();
        var old_last_name  = $("#old_last_name").val();
        var pin            = $("#old_pin").val();

        if($.trim(old_first_name) == '')
        {
            $("#err_old_first_name").html(error_first_name);
            $("#old_first_name").focus();
            $("#old_first_name").on('keyup',function(){ $("#err_old_first_name").html(""); });
            flag = 0;
        }
        if($.trim(old_last_name) == '')
        {
            $("#err_old_last_name").html(error_last_name);
            $("#old_last_name").focus();
            $("#old_last_name").on('keyup',function(){ $("#err_old_last_name").html(""); });
            flag = 0;
        }
        if($.trim(pin) == '')
        {
            $("#err_old_pin").html(error_pin);
            $("#old_pin").focus();
            $("#old_pin").on('keyup',function(){ $("#err_old_pin").html(""); });
            flag = 0;
        }
        else if($.trim(pin).length != 4)
        {
            $("#err_old_pin").html(error_pin_length);
            $("#old_pin").focus();
            $("#old_pin").on('keyup',function(){ $("#err_old_pin").html("");});
            flag = 0;
        }
        
        if($.trim(old_first_name) != '' && $.trim(old_last_name) != '' && $.trim(pin) != '' && $.trim(pin).length == 4)
        {
            $.ajax({
                url : SITE_URL+"/parent/my-children/pin-exists",
                type : "POST",
                async : false,
                data : { _token:csrf_token, first_name:old_first_name, last_name:old_last_name, pin:pin },
                success : function(result)
                {
                    if($.trim(result) == 'error')
                    {
                        /*$("#err_old_pin").html('Pin does not exists');
                        $("#old_pin").focus();
                        $("#old_pin").on('keyup',function(){ $("#err_old_pin").html(""); });*/
                        swal("","First name, Last name or Pin may does nor exists or may not match to same child." ,"error");
                        flag = 0;
                    }
                    else if($.trim(result) == 'success')
                    {
                        /*$("#err_old_pin").html('');*/
                        flag = 1;
                    }
                }
            });
        }

        return flag;
    }

    $("#old_pin").blur(function() 
    {
        var flag = check_pin_exists();

        if(flag == 0)
        {
            return false;
        }
        else
        {
            return true;
        }

    });




    // ------ for using_system starts ------ //


    $("#code_teacher_email").blur(function() {
        var id_name = 'code_teacher_email';
        var flag = check_teacher_email(id_name);

        if(flag == 0)
        {
            return false;
        }
        else
        {
            return true;
        }

    });

    function check_enrollment_code_exists()
    {


        var enrollment_code = $("#enrollment_code").val();

        if($.trim(enrollment_code) == '')
        {
            $("#err_enrollment_code").html(error_enrollment_code);
            $("#enrollment_code").focus();
            $("#enrollment_code").on('keyup',function(){ $("#err_enrollment_code").html(""); });
            flag = 0;
        }
        else if($.trim(enrollment_code).length != 15)
        {
            $("#err_enrollment_code").html(error_enrollment_code_length);
            $("#enrollment_code").focus();
            $("#enrollment_code").on('keyup',function(){ $("#err_enrollment_code").html("");});
            flag = 0;
        }
        
        if($.trim(enrollment_code) != '' && $.trim(enrollment_code).length == 15)
        {
            $.ajax({
                url : SITE_URL+"/parent/my-children/enrollment-code-exists",
                type : "POST",
                async : false,
                data : { _token:csrf_token, enrollment_code:enrollment_code },
                success : function(result)
                {
                    if($.trim(result) == 'error')
                    {
                        $("#err_enrollment_code").html(error_enrollment_code_not_exist);
                        $("#enrollment_code").focus();
                        $("#enrollment_code").on('keyup',function(){ $("#err_enrollment_code").html(""); });
                        flag = 0;
                    }
                    else if($.trim(result) == 'success')
                    {
                        $("#err_enrollment_code").html('');
                        flag = 1;
                    }
                }
            });
        }

        return flag;
    }

    $("#enrollment_code").blur(function()
    {
        var flag = check_enrollment_code_exists();
        
        if(flag == 0)
        {
            return false;
        }
        else
        {
            return true;
        }

    });


    // ------ for using_system ends ------ //



    /*---------------Parent My Children Page Ends---------------*/



    /*---------------Parent Notification Page Ends---------------*/

    $(".open_parent_notification_popup").click(function(){
        var id = $(this).data("id");
        $("#txt_delete_notification_id").val(id);
    });

    /*---------------Parent Notification Page Ends---------------*/




    /*---------------Contact Us Page Starts---------------*/


    $("#btn_submit_contact_us").click(function(){
        var email_filter     = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        var first_name = $("#first_name").val();
        var last_name  = $("#last_name").val();
        var mobile     = $("#contact_mobile").val();
        var email      = $("#contact_email").val();
        var subject    = $("#subject").val();
        var message    = $("#message").val();
        var phone_code = $("#phone_code").val();
        var flag       = 1;

        if($.trim(message) == '')
        {
            $("#err_message").html(error_message);
            $("#message").focus();
            $("#message").on('keyup',function(){ $("#err_message").html(""); });
            flag = 0;
        }
        if($.trim(subject) == '')
        {
            $("#err_subject").html(error_subject);
            $("#subject").focus();
            $("#subject").on('keyup',function(){ $("#err_subject").html(""); });
            flag = 0;
        }
        if($.trim(email) == '')
        {
            $("#err_email").html(error_email);
            $("#contact_email").focus();
            $("#contact_email").on('keyup',function(){ $("#err_email").html(""); });
            flag = 0;
        }
        else if(!email_filter.test(email))
        {
            $("#err_email").html(error_valid_email);
            $("#contact_email").focus();
            $("#contact_email").on('keyup',function(){ $("#err_email").html(""); });
            flag = 0;
        }
        if($.trim(mobile) == '')
        {
            $("#err_mobile").html(error_contact_number);
            $("#contact_mobile").focus();
            $("#contact_mobile").on('keyup',function(){ $("#err_mobile").html(""); });
            flag = 0;
        }
        else if($.trim(mobile).length < 10)
        {
            $("#err_mobile").html(error_contact_number_min);
            $("#contact_mobile").focus();
            $("#contact_mobile").on('keyup',function(){ $("#err_mobile").html("");});
            flag = 0;
        }
        if($.trim(first_name) == '')
        {
            $("#err_first_name").html(error_first_name);
            $("#first_name").focus();
            $("#first_name").on('keyup',function(){ $("#err_last_name").html(""); });
            flag = 0;
        }
        if($.trim(last_name) == '')
        {
            $("#err_last_name").html(error_last_name);
            $("#last_name").focus();
            $("#last_name").on('keyup',function(){ $("#err_last_name").html(""); });
            flag = 0;
        }
        if($.trim(phone_code) == '')
        {
            $("#err_phone_code").html(err_phone_code);
            $("#phone_code").focus();
            $("#phone_code").on('keyup',function(){ $("#err_phone_code").html(""); });
            flag = 0;
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


    /*---------------Contact Us Page Ends---------------*/



    /*---------------Teacher Change Program Page Starts---------------*/


    $("#btn_submit_teacher_change_program").click(function() {
        var change_program = $("#change_program").val();
        var flag           = 1;

        if( $.trim(change_program) == '' ) {
            swal("","Please select program first." ,"error");
            flag = 0;
        }

        if(flag == 0) {
            return false;
        } else {
            return true;
        }
    });

    $("#btn_submit_teacher_search_program").click(function() {
        var search_date    = $("#teacher_search_program_date").val();
        var search_keyword = $("#teacher_search_program_keyword").val();
        var flag           = 1;

        if( $.trim(search_keyword) == '' && $.trim(search_date) == '' ) {
            swal("","Please enter program name or date to search." ,"error");
            flag = 0;
        }

        if(flag == 0) {
            return false;
        } else {
            return true;
        }
    });

    $( "#teacher_search_program_date" ).datepicker({
        todayHighlight: true,
        autoclose: true,
        format: 'dd M yyyy',
        clearBtn: true,
    });

    /*---------------Teacher Change Program Page Ends---------------*/


    /*---------------Teacher Edit My Student Page Starts---------------*/


    $(".edit-student-data").click(function(){
        var class_id   = $(this).data('class_id');
        var student_id = $(this).data('student_id');
        var first_name = $(this).data('first_name');
        var last_name  = $(this).data('last_name');
        var pin        = $(this).data('pin');
        var grade_id   = $(this).data('grade_id');
        var subject_id = $(this).data('subject_id');

        getGrade(subject_id, grade_id, 'edit');

        $("#edit_class_id").val(class_id);
        $("#edit_student_id").val(student_id);
        $("#edit_first_name").val(first_name);
        $("#edit_last_name").val(last_name);
        $("#edit_pin").val(pin);
        $('#edit_subject').val(subject_id).attr("selected", "selected");
        /*$('#edit_grade').val(grade_id).attr("selected", "selected");*/
    });

    $("#btn_submit_edit_student").click(function(){
        var first_name = $("#edit_first_name").val();
        var last_name  = $("#edit_last_name").val();
        /*var pin        = $("#edit_pin").val();*/
        var grade      = $("#edit_grade").val();
        var flag       = 1;

        if($.trim(first_name) == '')
        {
            $("#err_edit_first_name").html(error_first_name);
            $("#edit_first_name").focus();
            $("#edit_first_name").on('keyup',function(){ $("#err_edit_first_name").html(""); });
            flag = 0;
        }
        if($.trim(last_name) == '')
        {
            $("#err_edit_last_name").html(error_last_name);
            $("#edit_last_name").focus();
            $("#edit_last_name").on('keyup',function(){ $("#err_edit_last_name").html(""); });
            flag = 0;
        }
        /*if($.trim(pin) == '')
        {
            $("#err_edit_pin").html('Please enter pin');
            $("#edit_pin").focus();
            $("#edit_pin").on('change',function(){ $("#err_edit_pin").html(""); });
            flag = 0;
        }*/
        if($.trim(grade) == '')
        {
            $("#err_edit_grade").html(error_grade);
            $("#edit_grade").focus();
            $("#edit_grade").on('change',function(){ $("#err_edit_grade").html(""); });
            flag = 0;
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

    $(".remove-student-data").click(function(){
        var class_id   = $(this).data('class_id');
        var student_id = $(this).data('student_id');
        var first_name = $(this).data('first_name');
        var last_name  = $(this).data('last_name');

        $("#remove_class_id").val(class_id);
        $("#remove_student_id").val(student_id);
        $("#remove_first_name").val(first_name);
        $("#remove_last_name").val(last_name);
    });

    /*---------------Teacher Edit My Student Page Ends---------------*/



    /*---------------Parent Search Program Page Starts---------------*/


    $("#btn_submit_parent_search_program").click(function() {
        var search_date    = $("#parent_search_program_date").val();
        var search_keyword = $("#parent_search_program_keyword").val();
        var flag           = 1;

        if( $.trim(search_keyword) == '' && $.trim(search_date) == '' ) {
            swal("","Please enter program name or date to search." ,"error");
            flag = 0;
        }

        if(flag == 0) {
            return false;
        } else {
            return true;
        }
    });

    $( "#parent_search_program_date" ).datepicker({
        todayHighlight: true,
        autoclose: true,
        format: 'dd M yyyy'
    });

    /*---------------Parent Search Program Page Ends---------------*/


    // Cancel Shareclass
    $('#btnShareClassCancel').on('click',function(){
        $('#share_email').val('');
    });


    //Shareclass validation
    $('#btnShareClass').on('click',function()
    {
        var email_filter     = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        var email            = $("#share_email").val();

        if($.trim(email) == '')
        {
            $("#err_share_email").html(error_email);            
            $("#share_email").focus();
            $("#share_email").on('keyup',function(){ $("#err_share_email").html(""); });
            return false;
        }
        else if(!email_filter.test(email))
        {
            $("#err_share_email").html(error_valid_email);            
            $("#share_email").focus();
            $("#share_email").on('keyup',function(){ $("#err_share_email").html(""); });
            return false;
        }
        else
        {
            return true;
        }
    });


});


/*-----------Textbook and Homework Page Starts-----------*/

$('#enc_subject').change(function() {
    var subject_id = $('#enc_subject').val();
    getEncGrade(subject_id, '', 'add');
});

$('#enc_grade').change(function() {
    var subject_id = $('#enc_subject').val();
    var grade_id   = $('#enc_grade').val();

    getEncProgram(subject_id, grade_id, '', 'add');
});

$('#enc_program').change(function() {
    var subject_id = $('#enc_subject').val();
    var grade_id   = $('#enc_grade').val();
    var program_id = $('#enc_program').val();

    getEncLesson(subject_id, grade_id, program_id, '', 'add');
});

function getEncGrade(subject_id = false, grade_id = false, event = false)
{
    $.ajax({
        url : SITE_URL+"/common/getencgrade",
        type : "POST",
        data : { _token:csrf_token, subject_id:subject_id, grade_id:grade_id },
        success : function(result)
        {
            if(event == 'add')
            {
                $("#enc_grade").html(result);
            }
            else if(event == 'edit')
            {
                $("#enc_edit_grade").html(result);
            }
        }
    });
}

function getEncProgram(subject_id = false, grade_id = false, program_id = false, event = false)
{
    $.ajax({
        url : SITE_URL+"/common/getencprogram",
        type : "POST",
        data : { _token:csrf_token, subject_id:subject_id, grade_id:grade_id, program_id:program_id },
        success : function(result)
        {
            if(event == 'add')
            {
                $("#enc_program").html(result);
            }
            else if(event == 'edit')
            {
                $("#enc_edit_program").html(result);
            }
        }
    });
}

function getEncLesson(subject_id = false, grade_id = false, program_id = false, lesson_id = false, event = false)
{
    $.ajax({
        url : SITE_URL+"/common/getenclesson",
        type : "POST",
        data : { _token:csrf_token, subject_id:subject_id, grade_id:grade_id, program_id:program_id, lesson_id:lesson_id },
        success : function(result)
        {
            if(event == 'add')
            {
                $("#enc_lesson").html(result);
            }
            else if(event == 'edit')
            {
                $("#enc_edit_lesson").html(result);
            }
        }
    });
}

/*-----------Textbook and Homework Page Ends-----------*/

/*header script end*/
    function openNav() {
        document.getElementById("mySidenav").style.width = "250px";
        $("body").css({
            "margin-left": "250px",
            "overflow-x": "hidden",
            "transition": "margin-left .5s",
            "position": "fixed"
        });
        $("#main").addClass("overlay");
    }

    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
        $("body").css({
            "margin-left": "0px",
            "transition": "margin-left .5s",
            "position": "relative"
        });
        $("#main").removeClass("overlay");
    }
    /*header script end*/

     var doc_width = $(window).width();
    if (doc_width < 992) {
        $(".after-login-show").on("click", function(){
            $(this).toggleClass("active");
        });
    };    
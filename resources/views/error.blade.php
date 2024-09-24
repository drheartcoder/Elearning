<script type="text/javascript">

// COMMON
 var err_enrollment_code_invalid    	 	= "{{trans('JS_Validation.err_enrollment_code_invalid')}}";
 var err_mobile_number     				 	= "{{trans('JS_Validation.err_mobile_number')}}";
 var err_mobile_length_min     			 	= "{{trans('JS_Validation.err_mobile_length_min')}}";
 var err_mobile_length_max     			 	= "{{trans('JS_Validation.err_mobile_length_max')}}";
 var email_already_exists     			 	= "{{trans('JS_Validation.email_already_exists')}}";
 var Something_has_get_wrong     	 	 	= "{{trans('JS_Validation.Something_has_get_wrong')}}";
 var mobile_already_exists     			 	= "{{trans('JS_Validation.mobile_already_exists')}}";

 /*Sign up*/
 var Please_select_user_type     			= "{{trans('JS_Validation.Please_select_user_type')}}";
 var Please_enter_enrollment_code     		= "{{trans('JS_Validation.Please_enter_enrollment_code')}}";
 var error_valid_enrollment_code     		= "{{trans('JS_Validation.err_valid_enrollment_code')}}";
 var error_first_name     			 		= "{{trans('JS_Validation.error_first_name')}}";
 var error_last_name     			 		= "{{trans('JS_Validation.error_last_name')}}";
 var error_email     			 			= "{{trans('JS_Validation.error_email')}}";
 var error_valid_email     			 		= "{{trans('JS_Validation.error_valid_email')}}";
 var error_mobile_no     			 		= "{{trans('JS_Validation.error_mobile_no')}}";
 var error_password     			 		= "{{trans('JS_Validation.error_password')}}";
 var error_valid_password     			 	= "{{trans('JS_Validation.error_valid_password')}}";
 var error_password_min_length     			= "{{trans('JS_Validation.error_password_min_length')}}";
 var error_confirm_password     			= "{{trans('JS_Validation.error_confirm_password')}}";
 var error_confirm_password_min_length      = "{{trans('JS_Validation.error_confirm_password_min_length')}}";
 var error_password_not_match      			= "{{trans('JS_Validation.error_password_not_match')}}";
 var error_terms_and_conditions      		= "{{trans('JS_Validation.error_terms_and_conditions')}}";
 var error_otp      						= "{{trans('JS_Validation.error_otp')}}";
 var err_phone_code      				    = "{{trans('JS_Validation.err_phone_code')}}";

 /*Sign in*/
 var error_email_mobile      				= "{{trans('JS_Validation.error_email_mobile')}}";
 var error_pin      						= "{{trans('JS_Validation.error_pin')}}";
 var error_pin_length      					= "{{trans('JS_Validation.error_pin_length')}}";

  /*Forgot Password*/
 var error_email_not_exist      			= "{{trans('JS_Validation.error_email_not_exist')}}";
 var error_mobile_not_exist      			= "{{trans('JS_Validation.error_mobile_not_exist')}}";

    /* Profile*/
 var error_address      					= "{{trans('JS_Validation.error_address')}}";
 var error_gender      						= "{{trans('JS_Validation.error_gender')}}";
 var error_preferred_language      			= "{{trans('JS_Validation.error_preferred_language')}}";
 var error_profile_image      				= "{{trans('JS_Validation.error_profile_image')}}";
 
   /* Change Password */
 var error_current_password      			= "{{trans('JS_Validation.error_current_password')}}";
 var error_valid_current_password      		= "{{trans('JS_Validation.error_valid_current_password')}}";
 var error_current_password_min      		= "{{trans('JS_Validation.error_current_password_min')}}";
 var error_new_password      				= "{{trans('JS_Validation.error_new_password')}}";
 var error_valid_new_password      			= "{{trans('JS_Validation.error_valid_new_password')}}";
 var error_new_password_min      			= "{{trans('JS_Validation.error_new_password_min')}}";
 var error_password_match      				= "{{trans('JS_Validation.error_password_match')}}";
 var error_new_confirm_password      	    = "{{trans('JS_Validation.error_new_confirm_password')}}";
 var error_valid_new_confirm_password      	= "{{trans('JS_Validation.error_valid_new_confirm_password')}}";
 var error_new_confirm_password_min      	= "{{trans('JS_Validation.error_new_confirm_password_min')}}";
 var error_both_new_password      			= "{{trans('JS_Validation.error_both_new_password')}}";

  /*Add class*/
 var error_class_name      					= "{{trans('JS_Validation.error_class_name')}}";
 var error_subject      					= "{{trans('JS_Validation.error_subject')}}";
 var error_grade      						= "{{trans('JS_Validation.error_grade')}}";
 var error_end_date      					= "{{trans('JS_Validation.error_end_date')}}";

  /*Add Child*/
 var error_enrollment_code      			= "{{trans('JS_Validation.error_enrollment_code')}}";
 var error_enrollment_code_not_exist      	= "{{trans('JS_Validation.error_enrollment_code_not_exist')}}";
 var error_enrollment_code_length      		= "{{trans('JS_Validation.error_enrollment_code_length')}}";
 var error_program      					= "{{trans('JS_Validation.error_program')}}";
 var error_contact_number      				= "{{trans('JS_Validation.error_contact_number')}}";
 var error_contact_number_min      			= "{{trans('JS_Validation.error_contact_number_min')}}";
 var error_message      					= "{{trans('JS_Validation.error_message')}}";


 var error_student_pin_doesnt_belong        = "{{trans('JS_Validation.error_student_pin_doesnt_belong')}}";
 var error_email_mobile_doesnt_belong       = "{{trans('JS_Validation.error_email_mobile_doesnt_belong')}}";
 var error_valid_parent_teacher_email       = "{{trans('JS_Validation.error_valid_parent_teacher_email')}}";
 var error_student_pin       				= "{{trans('JS_Validation.error_student_pin')}}";
 var error_teacher_email_mobile       		= "{{trans('JS_Validation.error_teacher_email_mobile')}}";
 var error_Please_enter       				= "{{trans('JS_Validation.error_Please_enter')}}";
 var error_Mobile_already_exists       		= "{{trans('JS_Validation.error_Mobile_already_exists')}}";
 var error_Mobile_number_required       	= "{{trans('JS_Validation.error_Mobile_number_required')}}";

 /* Payment checkout */
 var error_Please_enter_coupon_code       		= "{{trans('JS_Validation.Please_enter_coupon_code')}}";
 var error_Please_enter_valid_coupon_code       = "{{trans('JS_Validation.Please_enter_valid_coupon_code')}}";
 var error_This_coupon_cant_used_more_than_once = "{{trans('JS_Validation.This_coupon_cant_used_more_than_once')}}";
 var error_This_coupon_has_been_expired       	= "{{trans('JS_Validation.This_coupon_has_been_expired')}}";

 var error_Please_select_atleast_one_record     = "{{trans('JS_Validation.Please_select_atleast_one_record')}}";
 var error_You_cant_remove_last_record          = "{{trans('JS_Validation.You_cant_remove_last_record')}}";
 var error_This_field_is_required          		= "{{trans('JS_Validation.This_field_is_required')}}";

</script>
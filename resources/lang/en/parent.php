<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.

    //Start by Kavita
    /*Profile */

    'Class_Rooms'                               =>  'Class Rooms',
    'Parents'                                   =>  'Parents',
    'success'                                   =>  'success',
    'error'                                     =>  'error',
    'Address'                                   =>  'Address',
    'Close'                                     =>  'Close',
    'Enter_your_Address'                        =>  'Enter your Address',
    'Gender'                                    =>  'Gender',
    'Cancel'                                    =>  'Cancel',
    'Update'                                    =>  'Update',
    'Preferred_Language'                        =>  'Preferred Language',
    'Gender'                                    =>  'Gender',
    'Select_Gender'                             =>  'Select Gender',
    'Male'                                      =>  'Male',
    'Female'                                    =>  'Female',
    'Verify'                                    =>  'Verify',
    'Dashboard'                                 =>  'Dashboard',
    'Profile_updated_successfully'              =>  'Profile updated successfully',
    'Problem_occurred_updating_profile'         =>  'Problem occurred, while updating profile',
    'Password_change_successfully'              =>  'Password change successfully',
    'Error_occured_password_change'             =>  'Error occured during password change.',
    'Password_not_match'                        =>  'Current password does not match with your password.',

    /*Chenge Password*/
    'Change_Password'                           =>  'Change Password',
    'Current_Password'                          =>  'Current Password',
    'New_Password'                              =>  'New Password',
    'Confirm_New_Password'                      =>  'Confirm New Password',
    'Enter_Current_Password'                    =>  'Enter Current Password',
    'Enter_New_Password'                        =>  'Enter New Password',
    'Enter_Confirm_New_Password'                =>  'Enter Confirm New Password',
    'Save'                                      =>  'Save',
    'Confirm'                                   =>  'Confirm',

    /*Print Pins*/
    'Print_Student_PINs'                        =>  "Print Student PINs",
    'Print'                                     =>  'Print',

    /*Homework*/
    'Select_Subject'                            =>  'Select Subject',
    'No_homework_available'                     =>  'No homework available',
    'Download'                                  =>  'Download',
    'Select_Lesson'                             =>  'Select Lesson',
    'Select_Program'                            =>  'Select Program',
    'Select_Grade'                              =>  'Select Grade',
    'No_textbook_available'                     =>  'No textbook available',

    /*Dashboard*/

    'Subject'                                   =>  'Subject',
    'Grade'                                     =>  'Grade',
    'Add_Child'                                 =>  'Add Child',
    'Change_Program'                            =>  'Change Program',
    'My_Programs'                               =>  'My Programs',
    'There_are_no_children_to_show'             =>  'There are no children to show',
    'Type_of_Child'                             =>  'Type of Child',
    'Child_not_using_our_System'                =>  'Child not using our System',
    'Child_with_our_System_Account'             =>  'Child with our System Account',
    'Child_using_our_system_at_School'          =>  'Child using our system at School',
    'Teachers_Email_Mobile'                     =>  "Teacher's Email/Mobile",
    'Program'                                   =>  'Program',
    'Submit'                                    =>  'Submit',
    'Edit_Child'                                =>  'Edit Child',
    'Enter_first_name'                          =>  'Enter first name',
    'Enter_last_name'                           =>  'Enter last name',
    'Remove_Child'                              =>  'Remove Child',
    'Assigned_By'                               =>  'Assigned By',
    'Assigned_Date'                             =>  'Assigned Date',
    'Right'                                     =>  'Right %',
    'Export'                                    =>  'Export',
    'Wrong'                                     =>  'Wrong  %',
    'Delay'                                     =>  'Delay %',
    'Homework'                                  =>  'Homework',
    'Report'                                    =>  'Report',
    'Select_Date'                               =>  'Select Date',
    'No_Program_added'                          =>  'No Program added',
    'Change'                                    =>  'Change',
    'new_child_add_success'                     =>  'New Child added successfully.',
    'new_child_add_error'                       =>  'Problem occured while adding new child! Please try again later.',
    'child_data_delete_success'                 =>  'Your Child data deleted successfully.',
    'child_data_delete_error'                   =>  'Problem occured while deleting your child! Please try again later.',
    'something_went_wrong'                      =>  'Something went wrong! Please try again later.',
    'something_went_wrong_assign_program'       =>  'Something went wrong while assigning program.',
    'child_update_success'                      =>  'Your Child data updated successfully.',
    'child_update_error'                        =>  'Problem occured while updating your child data! Please try again later.',
    'All_fields_are_required'                   =>  'All fields are required.',
    //'child_update_error'                      =>  'All fields are required.',
    'Please_add_student_in_this_class'          =>  'Please add student in this class.',
    'Program_changed_success'                   =>  'Program changed successfully',
    'Program_already_assigned'                  =>  'Program already assigned',
    'exist_child_add_success'                   =>  'You have successfully added existing child in your account.',
    'exist_child_already_add_success'           =>  'You have successfully added existing child in your account but program is already assigned.',
    'enterd_student_not_assign'                 =>  'Entered student is not assign to given teacher. Please check teacher email or student data.',
    'exist_child_add_enrollment_success'        =>  'You have successfully added existing child in your account using enrollment code.',
    'exist_child_already_add_enroll_success'    =>  'You have successfully added existing child in your account using enrollment code And program is already assigned to the child.',
    'enterd_student_not_assign_enrollment'      =>  'Entered student is not assign to given teacher. Please check teacher email or student enrollment code.',
    'Do_you_really_want_to_remove'              =>  'Do you really want to remove this child from your account?',
    'If_the_child_account_is_not_associated'    =>  'If the child account is not associated with another parent or teacher account it will be deleted. You cannot undo this operation.',
    'As_per_your_selected_subscription'         =>  " As per your selected subscription plan, you can't add more child to your account.",
    'To_add_more_child_upgrade_subscription'    =>  'To add more child please contact Admin for more information.',

    /*Notification*/

    'Remove_Notification'                       =>  'Remove Notification',
    'Confirm_remove_notification'               =>  'Do you really want to Remove this Notification',
    'no_notifications_to_show'                  =>  'There are no notifications to show',
    'Notification_removed_success'              =>  'Notification is removed successfully.',
    'Notification_removed_error'                =>  'Problem occurred, while removing the notification.',

    /*Transaction*/
    'Transaction_Id'                            =>  'Transaction Id',
    'Plan_Name'                                 =>  'Plan Name',
    'Amount'                                    =>  'Amount',
    'Child_Limit'                               =>  'Child Limit',
    'Status'                                    =>  'Status',
    'Expiry_Date'                               =>  'Expiry Date',
    'No_Record_Found'                           =>  'No Record Found',
    'Search_Keyword'                            =>  'Search Keyword',
    'Action'                                    =>  'Action',

    /*controlller*/
    'Mobile_change_success'                     =>  'Your mobile verification done successfully.',
    'Incorrect_OTP_entered'                     =>  'Incorrect OTP entered',
    
    /*Page title*/
    'Account_Setting'                           =>  'Account Setting',
    'My_Profile'                                =>  'My Profile',
    'Notification'                              =>  'Notification',
    'My_Transactions'                           =>  'My Transactions',
    'Print_Pins'                                =>  'Print Pins',
    'My_Kids_Program'                           =>  'My Kids Programs',
    'My_Kids'                                   =>  'My Kids',
    'Textbook'                                  =>  'Textbook',
    'Pricing'                                   =>  'Pricing',
    'Payment_Checkout'                          =>  'Payment Checkout',
    'Take_Picture'                              =>  'Take Picture',
    'wire_transfer_request_sent'                =>   'Your request has been sent successfully,Please wait a while until admin approve your request.',

    /*Dashboard*/
    'No_Data_Found'                             =>  'No Data Found',
    'You_have_added_a_new_child'                =>  'You have added a new child',
    'You_have_been_successfully_added_by'       =>  'You have been successfully added by ',
    'You_have_successfully_added_existing_child_to_your_account'       =>  'You have successfully added existing child to your account',
    'You_have_successfully_added_existing_child_to_your_account_using_enrollment_code'       =>  'You have successfully added existing child to your account using enrollment code',
    'You_have_successfully_deleted_your_child'  =>  'You have successfully deleted your child',
    'You_have_successfully_updated_a_child'     =>  'You have successfully updated a child',
    'Your_name'                                 =>  'Your name ',
    'has_been_updated_by'                       =>  ' has been updated by ',
    'Total_Answered_Programs'                   =>  'Total Answered Programs',
    'Total_Pending_Programs'                    =>  'Total Pending Programs',
    'Student_Progress'                          =>  'Student Progress',
    'Performance_Assessment'                    =>  'Performance Assessment',
    'Class_Comparative_Analysis'                =>  'Class Comparative Analysis',
    'Global_Comparative_Analysis'               =>  'Global Comparative Analysis',
    'Points'                                    =>  'Points',
    'High'                                      =>  'High',
    'Average'                                   =>  'Average',
    'Low'                                       =>  'Low',
    'Summative_Assessment'                      =>  'Summative Assessment',
    'Quantitative_Assessment'                   =>  'Quantitative Assessment',
    'Challenge_Program_Assessment'              =>  'Challenge Program Assessment',
    'Total_Points'                              =>  'Total Points',
    'Reports'                                   =>  'Reports',
    'Hours'                                     =>  'Hours',
    'Time_Spent'                                =>  'Time Spent',
    'Daily'                                     =>  'Daily',
    'Weekly'                                    =>  'Weekly',
    'Monthly'                                   =>  'Monthly',
    'Yearly'                                    =>  'Yearly',
    'Select_Student'                            =>  'Select Student',
    'Select_Year'                               =>  'Select Year',
    'Days'                                      =>  'Days',
    'Current_Month'                             =>  'Current Month',
    'Performance'                               =>  'Performance',

    /*OTP*/
    'Please_enter_otp'                          =>  'Please enter otp',

    /*Add Child*/
    'Your_Membership_Plan_Expired_Now_Msg'      =>  'Your Membership Plan Expired Now, Please Renew Your Membership Plan,Then only you can perform action.',
    'No_Lesson_available'                       =>  'No Lesson available',        
    'No_Subject_available'                      =>  'No Subject available',        
    'No_Grade_available'                        =>  'No Grade available',        
    'No_Program_available'                      =>  'No Program available',  

    /*My Programs*/
    'Are_you_sure'                              =>  'Are you sure?',
    'Do_you_want_to_export_all_records'         =>  'Do you want to export all records?',
    'Yes'                                       =>  'Yes',
    'No'                                        =>  'No',
    'Program_Description'                       =>  'Program Description',
    'Program_Details'                           =>  'Program Details',
    'Program_Certificate'                       =>  'Program Certificate',
    'Program_Name'                              =>  'Program Name',

    /*Program Report*/
    'Answered'                                  =>  'Answered',
    'Pending'                                   =>  'Pending',
    'Question'                                  =>  'Question',
    'Kid_Name'                                  =>  'Kid Name',
    'Program_Report'                            =>  'Program Report',
    'No_of_Questions'                           =>  'No of Questions',
    'No_of_Lessons'                             =>  'No of Lessons',
    'Lessons'                                   =>  'Lessons',
    'Pending'                                   =>  'Pending',
    'On-Going'                                  =>  'On-Going',
    'Completed'                                 =>  'Completed',
    'Start'                                     =>  'Start',
    'Program_Test'                              =>  'Program Test',
    'Payment_Status'                            =>  'Payment Status',
    'Program_Id'                                =>  'Program Id',

    /* Transactions */
    'Paid'                                      =>  'Paid',    
    'Unpaid'                                    =>  'Unpaid',    
    'Expired'                                   =>  'Expired',    
    'Active'                                    =>  'Active',    
    'My_Kids_Programs'                          =>  'My kids programs',
    'OTP_Sent_Success_Msg'                      =>  'Otp sent successfully in your mobile number.',
    'OTP_Sent_Error_Msg'                        =>  'Error occured while sending a sms',
    'Can_not_sent_on_same_number'               =>  'Otp could not be sent on verified mobile number.',
    'Do_you_want_to_delete_this_record'         =>  'Do you want to delete this record?',
    'paypal'                                    =>  'Paypal',
    'offline'                                   =>  'Offline',
    'alipay'                                    =>  'Alipay',
    'wechat'                                    =>  'Wechat',
    'Payment_via'                               =>  'Payment Via'

];

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

    'Class_Rooms'                               =>  '教室',
    'Parents'                                   =>  '家⻓',
    'success'                                   =>  '成功',
    'error'                                     =>  '错误',
    'Address'                                   =>  '地址',
    'Close'                                     =>  '关闭',
    'Enter_your_Address'                        =>  '输入您的地址',
    'Gender'                                    =>  '性别',
    'Cancel'                                    =>  '取消',
    'Update'                                    =>  '更新',
    'Preferred_Language'                        =>  '首选语言',
    'Gender'                                    =>  '性别',
    'Select_Gender'                             =>  '性别选择',
    'Male'                                      =>  '男性',
    'Female'                                    =>  '女性',
    'Verify'                                    =>  '验证',
    'Dashboard'                                 =>  '仪表板',
    'Profile_updated_successfully'              =>  '资料更新成功',
    'Problem_occurred_updating_profile'         =>  '更新资料时发生错误',
    'Password_change_successfully'              =>  '密码更改成功',
    'Error_occured_password_change'             =>  '密码更改时出错。',
    'Password_not_match'                        =>  '当前密码与预留密码不匹配。',

    /*Chenge Password*/
    'Change_Password'                           =>  '修改密码',
    'Current_Password'                          =>  '当前密码',
    'New_Password'                              =>  '新密码',
    'Confirm_New_Password'                      =>  '确认新密码',
    'Enter_Current_Password'                    =>  '输入新密码',
    'Enter_New_Password'                        =>  '输入新密码',
    'Enter_Confirm_New_Password'                =>  '输入确认新密码',
    'Save'                                      =>  '保存',
    'Confirm'                                   =>  '确认',

    /*Print Pins*/
    'Print_Student_PINs'                        =>  "打印学生学号",
    'Print'                                     =>  '打印',

    /*Homework*/
    'Select_Subject'                            =>  '选择主题',
    'No_homework_available'                     =>  '无可用作业',
    'Download'                                  =>  '下载',
    'Select_Lesson'                             =>  '选课时',
    'Select_Program'                            =>  '选择课程',
    'Select_Grade'                              =>  '选择年级',
    'No_textbook_available'                     =>  '无可用书',

    /*Dashboard*/

    'Subject'                                   =>  '主题',
    'Grade'                                     =>  '年级',
    'Add_Child'                                 =>  '添加学生',
    'Change_Program'                            =>  '更改项目',
    'My_Programs'                               =>  '我的课程',
    'There_are_no_children_to_show'             =>  '没有孩子信息',
    'Type_of_Child'                             =>  '儿童类型',
    'Child_not_using_our_System'                =>  '孩子还没使用我们的系统',
    'Child_with_our_System_Account'             =>  '已经拥有系统账户的孩子',
    'Child_using_our_system_at_School'          =>  '孩子在学校使用我们的系统',
    'Teachers_Email_Mobile'                     =>  "老师的电子邮件/手机号码",
    'Program'                                   =>  '课程',
    'Submit'                                    =>  '提交',
    'Edit_Child'                                =>  '编辑孩子信息',
    'Enter_first_name'                          =>  '输入名字',
    'Enter_last_name'                           =>  '输入姓氏',
    'Remove_Child'                              =>  '移除孩子',
    'Assigned_By'                               =>  '指定的',
    'Assigned_Date'                             =>  '分发日期',
    'Right'                                     =>  '正确百分比',
    'Export'                                    =>  '导出',
    'Wrong'                                     =>  '错误百分比',
    'Delay'                                     =>  '延迟百分比',
    'Homework'                                  =>  '作业',
    'Report'                                    =>  '报告',
    'Select_Date'                               =>  '选择日期',
    'No_Program_added'                          =>  '没有添加的科目',
    'Change'                                    =>  '更改',
    'new_child_add_success'                     =>  '新的儿童添加成功。',
    'new_child_add_error'                       =>  '添加新孩子时出现问题！请稍后再试',
    'child_data_delete_success'                 =>  '您的孩子数据已成功删除。',
    'child_data_delete_error'                   =>  '删除您的孩子数据时出现错误！请稍后再试。',
    'something_went_wrong'                      =>  '系统错误！请稍后再试。',
    'something_went_wrong_assign_program'       =>  '分配课程时出了问题。请稍后再试。',
    'child_update_success'                      =>  '您孩子的数据已成功更新。',
    'child_update_error'                        =>  '更新您孩子的数据时出现问题！请稍后再试。',
    'All_fields_are_required'                   =>  '所有字段都是必需的。',
    //'child_update_error'                      =>  'All fields are required.',
    'Please_add_student_in_this_class'          =>  '请为这个班级增加学生',
    'Program_changed_success'                   =>  '课程已成功更改',
    'Program_already_assigned'                  =>  '已经成功指定科目',
    'exist_child_add_success'                   =>  '您已经成功地将存在的儿童添加到你的帐户。',
    'exist_child_already_add_success'           =>  '您已成功地将存在的儿童添加到帐户中，科目已分配。',
    'enterd_student_not_assign'                 =>  '输入的学生没有分配给指定的教师。请检查老师的电子邮件或学生数据。',
    'exist_child_add_enrollment_success'        =>  '您已使用注册码成功将已存在的儿童添加到您的帐户',
    'exist_child_already_add_enroll_success'    =>  '您已经成功地使用注册代码将现有的儿童添加到帐户中。',
    'enterd_student_not_assign_enrollment'      =>  '输入的学生没有分配给指定的教师。请检查教师电子邮件或学生入学代码。',
    'Do_you_really_want_to_remove'              =>  '您真的想从帐户中删除此儿童信息吗？',
    'If_the_child_account_is_not_associated'    =>  '如果儿童帐户与另一个家长或教师帐户不关联，则将被删除。无法撤消此操作。',
    'As_per_your_selected_subscription'         =>  "根据您选择的订阅计划，您不能向您的帐户中添加更多的儿童。",
    'To_add_more_child_upgrade_subscription'    =>  '为了增加更多的儿童，请联系管理员了解更多信息。',

    /*Notification*/

    'Remove_Notification'                       =>  '删除通知',
    'Confirm_remove_notification'               =>  '你真的想删除这个通知吗？',
    'no_notifications_to_show'                  =>  '没有通知显示',
    'Notification_removed_success'              =>  '已成功删除通知。',
    'Notification_removed_error'                =>  '删除通知时发生问题。',

    /*Transaction*/
    'Transaction_Id'                            =>  '交易ID',
    'Plan_Name'                                 =>  '会员服务名称',
    'Amount'                                    =>  '金额',
    'Child_Limit'                               =>  '儿童数量限制',
    'Status'                                    =>  '状态',
    'Expiry_Date'                               =>  '到期日',
    'No_Record_Found'                           =>  '没有找到记录',
    'Search_Keyword'                            =>  '检索关键字',
    'Action'                                    =>  '操作',

    /*controlller*/
    'Mobile_change_success'                     =>  '成功更改移动号码',
    'Incorrect_OTP_entered'                     =>  '未输入正确的验证码',
    
    /*Page title*/
    'Account_Setting'                           =>  '帐户设置',
    'My_Profile'                                =>  '我的资料',
    'Notification'                              =>  '通知',
    'My_Transactions'                           =>  '我的交易',
    'Print_Pins'                                =>  '打印学号',
    'My_Kids_Program'                           =>  '我孩子们的课程',
    'Textbook'                                  =>  '书',
    'Pricing'                                   =>  '价格',
    'Payment_Checkout'                          =>  '付款结帐',
    'Take_Picture'                              =>  '拍照',
    'wire_transfer_request_sent'                =>  '您的请求已成功发送，请稍候，管理员确认您的请求。',

    /*Dashboard*/
    'No_Data_Found'                             =>  '没有找到数据',
    'You_have_added_a_new_child'                =>  '您增加了一个新儿童',
    'You_have_been_successfully_added_by'       =>  '您已经被成功地添加',
    'You_have_successfully_added_existing_child_to_your_account'       =>  '您已经成功地将现有的儿童添加到你的帐户中。',
    'You_have_successfully_added_existing_child_to_your_account_using_enrollment_code'       =>  '您已经成功地使用注册代码将现有的孩子添加到你的帐户。',
    'You_have_successfully_deleted_your_child'  =>  '您已成功删除了您孩子的数据',
    'You_have_successfully_updated_a_child'     =>  '你已经成功地更新了一个孩子的数据',
    'Your_name'                                 =>  '你的名字',
    'has_been_updated_by'                       =>  '已更新',
    'Total_Answered_Programs'                   =>  '所有已应答课程',
    'Total_Pending_Programs'                    =>  '所有暂停的课程',
    'Student_Progress'                          =>  '学生学习进展',
    'Performance_Assessment'                    =>  '绩效评估',
    'Class_Comparative_Analysis'                =>  '班级比较分析',
    'Global_Comparative_Analysis'               =>  '全球比较分析',
    'Points'                                    =>  '分',
    'High'                                      =>  '高',
    'Average'                                   =>  '平均值',
    'Low'                                       =>  '低',
    'Summative_Assessment'                      =>  '总结性评估',
    'Quantitative_Assessment'                   =>  '定量评估',
    'Challenge_Program_Assessment'              =>  '挑战课程评估',
    'Total_Points'                              =>  '总分',
    'Reports'                                   =>  '报告',
    'Hours'                                     =>  '小时',
    'Time_Spent'                                =>  '使用时间',
    'Daily'                                     =>  '每日',
    'Weekly'                                    =>  '每周',
    'Monthly'                                   =>  '每月',
    'Yearly'                                    =>  '每年',
    'Select_Student'                            =>  '选择学生',
    'Select_Year'                               =>  '选择年份',
    'Days'                                      =>  '天数',
    'Current_Month'                             =>  '当月',
    'Performance'                               =>  '成绩',

    /*OTP*/
    'Please_enter_otp'                           =>  '请输入验证码',

    /*Add Child*/
    'Your_Membership_Plan_Expired_Now_Msg'      =>  '您的会员计划现在到期，请更新您的会员计划后，再进行操作。',    
    'No_Lesson_available'                       =>  '没有可用的课时',        
    'No_Subject_available'                      =>  '没有可用的主题',        
    'No_Grade_available'                        =>  '没有可用的年级',        
    'No_Program_available'                      =>  '没有可用的课程',

    /*My Programs*/
    'Are_you_sure'                              =>  '你确定吗？',
    'Do_you_want_to_export_all_records'         =>  '是否要导出所有记录？',
    'Yes'                                       =>  '是的',
    'No'                                        =>  '不',
    'Program_Description'                       =>  '课程描述',
    'Program_Details'                           =>  '课程细节',
    'Program_Certificate'                       =>  '课程证书',
    'Program_Name'                              =>  '课程名称',

    /*Program Report*/
    'Answered'                                  =>  '已答',
    'Pending'                                   =>  '暂停',
    'Question'                                  =>  '问题',    
    'Kid_Name'                                  =>  '孩子名字',
    'Program_Report'                            =>  '课程报告',
    'No_of_Questions'                           =>  '问题数量',
    'No_of_Lessons'                             =>  '课时数量',    
    'Lessons'                                   =>  '课时',
    'Pending'                                   =>  '暂停',
    'On-Going'                                  =>  '继续进行',
    'Completed'                                 =>  '完成',    
    'Start'                                     =>  '开始',
    'Program_Test'                              =>  '课程测试',
    'Payment_Status'                            =>  '付款状态',
    'Program_Id'                                =>  '课程Id',

    /* Transactions */
    'Paid'                                      =>  '已付',    
    'Unpaid'                                    =>  '未支付',    
    'Expired'                                   =>  '过期',
    'Active'                                    =>  '激活',  
    'OTP_Sent_Success_Msg'                      =>  'Otp已成功发送您的手机号码',
    'OTP_Sent_Error_Msg'                        =>  '发送短信时出错',

    'paypal'                                    =>  '贝宝',
    'offline'                                   =>  '离线',
    'alipay'                                    =>  '支付宝',
    'wechat'                                    =>  '微信',
    'Payment_via'                               =>  '付款通过'
];
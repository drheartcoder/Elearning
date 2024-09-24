@extends('admin.layout.master') @section('main_content')
<style type="text/css">
    .dropdown.bootstrap-select {
        width: 100% !important;
    }
</style>
<!-- Page header -->
@include('admin.layout.breadcrumb')
<!-- /page header -->
<!-- Content area -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="card-body-section">
                <div class="card">
                    <div class="card-header card-header-icon card-header-rose">
                        <div class="card-icon">
                            <i class="fa fa-user-secret"></i>
                        </div>
                        <h4 class="card-title">{{$page_title or ''}}</h4>
                    </div>
                    <div class="card-body">
                        @include('admin.layout._operation_status')
                        <form class="form-horizontal" id="frm_account_setting" name="frm_account_setting" action="{{$module_url_path}}/store" method="post">
                            {{csrf_field()}}                            
                            <div class="row">
                                <div class="col-md-4">
                                    <!--<label class="bmd-label-floating">User Type <i class="red">*</i></label>-->
                                    <div class="form-group has-default bmd-form-group is-filled">
                                        <select class="selectpicker" data-rule-required="true" data-style="select-with-transition" name="user_type" id="user_type">
                                            <option value="">Select User Type</option>
                                            <option value="program-creator">Program Creator</option>
                                            <option value="supervisor">Supervisor</option>
                                            <option value="subadmin">Subadmin</option>
                                        </select>
                                        <span class="error">{{ $errors->first('user_type') }} </span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group has-default bmd-form-group is-filled">
                                        <label class="bmd-label-floating">First Name <i class="red">*</i></label>
                                        <input type="text" name="first_name" id="first_name" class="form-control" data-rule-required="true" data-rule-maxlength="60" value="{{$arr_admin_details['first_name'] or ''}}" onkeyup="chk_validation(this)">
                                        <span class="error">{{ $errors->first('first_name') }} </span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group has-default bmd-form-group is-filled">
                                        <label class="bmd-label-floating">Last Name <i class="red">*</i></label>
                                        <input type="text" name="last_name" id="last_name" class="form-control" data-rule-required="true" data-rule-maxlength="60" value="{{$arr_admin_details['last_name'] or ''}}" onkeyup="chk_validation(this)">
                                        <span class="error">{{ $errors->first('last_name') }} </span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group has-default bmd-form-group is-filled">
                                        <label class="bmd-label-floating">Email <i class="red">*</i></label>
                                        <input type="text" name="email" id="email" class="form-control chk_email" data-rule-required="true" data-rule-maxlength="256" data-rule-email value="{{$arr_admin_details['email'] or ''}}">
                                        <span class="error" id="err_email">{{ $errors->first('email') }} </span>
                                        <div id="err_email"></div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                 @php
                                        $arr_phone_code = [];
                                        $arr_phone_code = get_country_phone_code();
                                    @endphp
                                    @if(isset($arr_phone_code) && sizeof($arr_phone_code)>0)
                                     <div class="form-group has-default bmd-form-group is-filled">
                                        <select id="phone_code" data-rule-required="true" class="form-control" name="phone_code">
                                            <option value="">Select PhoneCode</option>
                                            @foreach($arr_phone_code as $phone_code)
                                             @if(isset($phone_code['nicename']) && $phone_code['nicename']!="")
                                                  <option value="{{ $phone_code['id'] }}"> 
                                                  ({{ $phone_code['nicename'] }}) +{{ $phone_code['phonecode'] }}  
                                                  </option>
                                             @endif
                                            @endforeach
                                        </select>
                                      
                                    </div>
                                    <div class="error" id="err_phone_code">{{ $errors->first('phone_code') }}</div>
                                    @endif
                                </div>
                                <div class="col-md-4">
                                   
                                    <div class="form-group has-default bmd-form-group is-filled">
                                        <label class="bmd-label-floating">Phone Number <i class="red">*</i></label>
                                        <input type="text" name="contact" id="contact" class="form-control" data-rule-required="true" data-rule-pattern="[- +()0-9]+" data-rule-minlength="7" data-rule-maxlength="16" data-msg-minlength="Phone no should be atleast 7 numbers" data-msg-maxlength="Phone no should not be more than 16 numbers" value="{{$arr_admin_details['contact'] or ''}}">
                                        <span class="error">{{ $errors->first('contact') }} </span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group has-default bmd-form-group is-filled">
                                        <label class="bmd-label-floating">Address <i class="red">*</i></label>
                                        <input type="text" name="address" id="address" class="form-control" placeholder="" data-rule-required="true" data-rule-maxlength="255" value="{{$arr_admin_details['address'] or ''}}">
                                        <span class="error">{{ $errors->first('address') }} </span>
                                    </div>
                                </div>
                                @if(isset($arr_supervisor) && count($arr_supervisor)>0)
                                  <div class="col-md-4" id="show_reporting_to" style="display: none;">
                                      <div class="form-group has-default bmd-form-group is-filled">
                                        <label class="bmd-label-floating">Reporting To <i class="red">*</i></label>
                                          <select class="selectpicker" data-style="select-with-transition" name="reporting_to" id="reporting_to">
                                              <option value="">Select Reporting Supervisor</option>
                                              @foreach($arr_supervisor as $key => $supervisor_data)
                                                <option value="{{base64_encode($supervisor_data['id'])}}">{{$supervisor_data['first_name'].' '.$supervisor_data['last_name']}}</option>
                                              @endforeach
                                          </select>
                                          <span class="error">{{ $errors->first('reporting_to') }} </span>
                                      </div>
                                  </div>
                                @endif
                                <div class="col-md-4">
                                    <div class="form-group has-default bmd-form-group is-filled">
                                        <label class="bmd-label-floating">Password <i class="red">*</i></label>
                                        <input type="password" name="password" id="password" class="form-control" data-rule-pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^])(?=.*\d).*" data-rule-required="true" data-rule-maxlength="50" value="">
                                        <span class="error">{{ $errors->first('password') }} </span>
                                        <div class="clearfix"></div>                                        
                                    </div>
                                    <span class="note-section-block form-note-section"><b>Note :</b> <span>Password must contain at least (1) lowercase and (1) uppercase and (1) special character and greater than or equal to 6 character.</span></span>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group has-default bmd-form-group is-filled">
                                        <label class="bmd-label-floating">Confirm Password <i class="red">*</i></label>
                                        <input type="password" name="confirm_password" id="confirm_password" class="form-control" data-rule-required="true" data-rule-maxlength="50" data-rule-equalto="#password" value="">
                                        <span class="error">{{ $errors->first('confirm_password') }} </span>
                                    </div>
                                </div> 
                                <div class="col-md-12 permissions-div" style="display: none;">
                                   <div class="form-group">
                                      <label style="margin-top: 30px;" class="control-label">Permissions <i class="red">*</i></label>
                                      <div class="controls">
                                         <div class="material-datatables subadmin-create-table">
                                            <div class="table-responsive" style="border:0">
                                               <table class="table table-striped table-no-bordered table-hover" id="table_module" cellspacing="0" width="100%" style="width:100%">
                                                  <thead>
                                                     <tr>
                                                        <th style="">Module Name</th>
                                                        <th style="text-align:center;">List / View</th>
                                                        <th style="text-align:center;">Create</th>
                                                        <th style="text-align:center;">Update (Single/MultipleStatus)</th>
                                                        <th style="text-align:center;">Delete (Single/Multiple delete)</th>
                                                     </tr>
                                                  </thead>
                                                  <tbody>
                                                     <tr class="info">
                                                        <td><b>All</b></td>
                                                        <td>
                                                           <!--                                                                <input class="form-control" type="checkbox" data-module-action="List" onclick="selectAll(this)" style="height: 14px;">-->
                                                           <div class="form-check">
                                                              <label class="form-check-label">
                                                              <input class="form-check-input" type="checkbox" name="selectall" data-module-action="List" onclick="selectAll(this)">
                                                              <span class="form-check-sign">
                                                              <span class="check"></span>
                                                              </span>
                                                              </label>
                                                           </div>
                                                        </td>
                                                        <td>
                                                           <!--                                                                <input class="form-control" type="checkbox" data-module-action="Create" onclick="selectAll(this)" style="height: 14px;"> -->
                                                           <div class="form-check">
                                                              <label class="form-check-label">
                                                              <input class="form-check-input" type="checkbox" name="selectall" data-module-action="Create" onclick="selectAll(this)">
                                                              <span class="form-check-sign">
                                                              <span class="check"></span>
                                                              </span>
                                                              </label>
                                                           </div>
                                                        </td>
                                                        <td>
                                                           <!--                                                                <input class="form-control" type="checkbox" data-module-action="Update" onclick="selectAll(this)" style="height: 14px;">-->
                                                           <div class="form-check">
                                                              <label class="form-check-label">
                                                              <input class="form-check-input" type="checkbox" name="selectall" data-module-action="Update" onclick="selectAll(this)">
                                                              <span class="form-check-sign">
                                                              <span class="check"></span>
                                                              </span>
                                                              </label>
                                                           </div>
                                                        </td>
                                                        <td>
                                                           <!--                                                                <input class="form-control" type="checkbox" data-module-action="Delete" onclick="selectAll(this)" style="height: 14px;">     -->
                                                           <div class="form-check">
                                                              <label class="form-check-label">
                                                              <input class="form-check-input" type="checkbox" name="selectall" data-module-action="Delete" onclick="selectAll(this)">
                                                              <span class="form-check-sign">
                                                              <span class="check"></span>
                                                              </span>
                                                              </label>
                                                           </div>
                                                        </td>
                                                     </tr>                                                     
                                                    @if(isset($arr_modules) && sizeof($arr_modules)>0) 
                                                    @foreach($arr_modules as $key => $row )
                                                     <tr class="info">
                                                        <td><b>{{$row['title']}}</b></td>
                                                        <?php 
                                                           $slug = $row['slug']; 
                                                           $checkbox_checked = '';                                              
                                                           
                                                           if($row['slug'] == 'account_setting/edit_profile' || $row['slug'] == 'account_setting/password/change')
                                                           {
                                                             $checkbox_checked ="checked='checked' readonly='readonly' onclick='return false;'";
                                                           }
                                                           ?>
                                                        <td>
                                                            <div class="form-check">
                                                              <label class="form-check-label">
                                                              <input class="form-check-input select-checkbox" {!!$checkbox_checked!!} type="checkbox" data-module-ref="{{$slug}}" data-module-action-ref="List" name="arr_permisssion[subadmin][{{$slug}}.list]" value="true">
                                                              <span class="form-check-sign">
                                                              <span class="check"></span>
                                                              </span>
                                                              </label>
                                                           </div>

                                                           <!-- <input class="form-control" {{$checkbox_checked}} type="checkbox" data-module-ref="{{$slug}}" data-module-action-ref="List" name="arr_permisssion[subadmin][{{$slug}}.list]" value="true" style="height: 14px;"> -->
                                                        </td>
                                                       
                                                        <td>
                                                           @if(!in_array($slug, $arr_not_to_create_list))

                                                           <div class="form-check">
                                                              <label class="form-check-label">
                                                              <input class="form-check-input select-checkbox" type="checkbox" {!! $checkbox_checked !!} data-module-ref="{{$slug}}" data-module-action-ref="Create" name="arr_permisssion[subadmin][{{$slug}}.create]" value="true">
                                                              <span class="form-check-sign">
                                                              <span class="check"></span>
                                                              </span>
                                                              </label>
                                                           </div>

                                                           <!-- <input class="form-control" type="checkbox" {{$checkbox_checked}} data-module-ref="{{$slug}}" data-module-action-ref="Create" name="arr_permisssion[subadmin][{{$slug}}.create]" value="true" style="height: 14px;"> --> 
                                                           @endif
                                                        </td>
                                                        <td>
                                                           @if(!in_array($slug, $arr_not_to_update_list))

                                                           <div class="form-check">
                                                              <label class="form-check-label">
                                                              <input class="form-check-input select-checkbox" type="checkbox" {!! $checkbox_checked !!} data-module-ref="{{$slug}}" data-module-action-ref="Update" name="arr_permisssion[subadmin][{{$slug}}.update]" value="true">
                                                              <span class="form-check-sign">
                                                              <span class="check"></span>
                                                              </span>
                                                              </label>
                                                           </div>

                                                           <!-- <input class="form-control" type="checkbox" {{$checkbox_checked}} data-module-ref="{{$slug}}" data-module-action-ref="Update" name="arr_permisssion[subadmin][{{$slug}}.update]" value="true" style="height: 14px;"> -->
                                                           @endif
                                                        </td>
                                                        <td>
                                                           @if(!in_array($slug, $arr_not_to_delete_list))

                                                           <div class="form-check">
                                                              <label class="form-check-label">
                                                              <input class="form-check-input select-checkbox" type="checkbox" data-module-ref="{{$slug}}" data-module-action-ref="Delete" name="arr_permisssion[subadmin][{{$slug}}.delete]" value="true">
                                                              <span class="form-check-sign">
                                                              <span class="check"></span>
                                                              </span>
                                                              </label>
                                                           </div>

                                                           <!-- <input class="form-control" type="checkbox" data-module-ref="{{$slug}}" data-module-action-ref="Delete" name="arr_permisssion[subadmin][{{$slug}}.delete]" value="true" style="height: 14px;"> -->
                                                           @endif
                                                        </td>
                                                     </tr>
                                                    @endforeach 
                                                    @endif
                                                  </tbody>
                                               </table>
                                               <span class="error select-checkbox-error"></span>
                                            </div>
                                         </div>
                                      </div>
                                   </div>
                                </div>                               
                            </div>                            
                            <button type="submit" class="btn btn-rose pull-right add">Add</button>
                            <button type="button" onclick="location.href='{{$module_url_path}}'" class="btn btn-rose pull-right">Cancel</button>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- BEGIN Main Content -->
<script>
    $(document).ready(function () {
        //$("#address").geocomplete();
        $("#user_type").on('change',function()
        {            
            if($("#user_type").val()=='subadmin')    
            {                
                $('.permissions-div').show();
            }
            else
            {
                $('.permissions-div').hide();
            }
            
            if($("#user_type").val()=='program-creator')
            {
              $('#show_reporting_to').show();
              $('#show_reporting_to').attr('data-rule-required',true);
            }
            else
            {
              $('#show_reporting_to').attr('data-rule-required',false);
              $('#show_reporting_to').hide();
            }
        });
    });

    $(document).on("change", ".validate-image", function () {
        var file = this.files;
        validateImage(this.files, 250, 250);
    });

    $(document).on("click", "#remove", function () {
        removeFile();
    });

    function selectAll(ref)
    {
        var action = $(ref).attr('data-module-action');

        var is_checked = $(ref).is(":checked");

        var arr_input = $('input[data-module-action-ref="'+action+'"]');  

        if(is_checked)
        {
            $.each(arr_input,function(index,elem)
            {
                $(elem).prop('checked', true);
            });  
        }
        else
        {          
            $.each(arr_input,function(index,elem)
            {
                if(action=='List')
                {
                    if(jQuery.inArray(index, [1, 7]) == -1)                
                    {                    
                        $(elem).prop('checked', false);                    
                    }    
                } 
                if(action=='Update')
                {
                    if(jQuery.inArray(index, [1, 5]) == -1)                
                    {                    
                        $(elem).prop('checked', false);                    
                    }    
                } 
                if(action=='Create' || action=='Delete')
                {
                    $(elem).prop('checked', false);
                }              
            });   
        }        
    }

    $(document).ready(function () {
        $('#frm_account_setting').validate({
            ignore: [],
            highlight: function (element) {},
            rules: {
                email: {
                    required: true,
                    email: true,
                    pattern: /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/
                }
            },
            messages: {
                email: {
                    pattern: "Please enter a valid email address.",

                },
            },
            errorPlacement: function (error, element) {
                var name = $(element).attr("name");
                if (name === "profile_image") {
                    error.insertAfter('.err_image');
                }
                if (name === "email")
                {
                    error.insertAfter('#err_email');
                }
                else if(name==='phone_code')
                {
                   error.insertAfter('#err_phone_code');
                } 
                else
                {
                    error.insertAfter(element);
                }

            }
        });

        $('#frm_account_setting').submit(function () 
        {
            // var check_val = $("#user_type").val();

            if ($('#frm_account_setting').valid() == true) {
                var isvalid = $("input[name='isvalid']").val();
                if (isvalid == 'invalid') {
                    return false;
                } else {
                    return true;
                }
            }

           /* if(check_val=='submit')
            {
                if($('.select-checkbox').is(":checked")==false)
                {
                    $('.select-checkbox-error').html('Please select atleast one permission')
                    return false;
                }
                else
                {                    
                    return true;    
                }
            }
            else
            {
                return true;
            }*/
            

        });

    }); 

    /*$(".select-checkbox").click(function(){

        var arr_input = $(this).attr('data-module-action-ref');  
        var is_checked = $(this).is(":checked");
        if(is_checked)
        {
            $.each(arr_input,function(index,elem)
            {
                $(elem).prop('checked', true);
            });  
        }
        else
        {          
            $.each(arr_input,function(index,elem)
            {
                if(action=='List')
                {
                    if(jQuery.inArray(index, [0, 6]) == -1)                
                    {                    
                        $(elem).prop('checked', false);                    
                    }    
                } 
                if(action=='Update')
                {
                    if(jQuery.inArray(index, [0, 4]) == -1)                
                    {                    
                        $(elem).prop('checked', false);                    
                    }    
                }               
            });   
        }        
    });*/

    function chk_validation(ref) {
        var yourInput = $(ref).val();
        re = /[0-9`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi;
        var isSplChar = re.test(yourInput);
        if (isSplChar) {
            var no_spl_char = yourInput.replace(/[0-9`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi, '');
            $(ref).val(no_spl_char);
        }
    }

    function readOnlyCheckBox()
    {
        alert();
        return false;
    }
</script>
@endsection
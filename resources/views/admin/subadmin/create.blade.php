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
                        <h4 class="card-title">{{$module_title or ''}}</h4>
                    </div>
                    <div class="card-body">
                        @include('admin.layout._operation_status')
                        <form class="form-horizontal" id="frm_account_setting" name="frm_account_setting" action="{{$module_url_path}}/store" method="post">
                            {{csrf_field()}}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group has-default bmd-form-group is-filled">
                                        <label class="bmd-label-floating">First Name <i class="red">*</i></label>
                                        <input type="text" name="first_name" id="first_name" class="form-control" data-rule-required="true" data-rule-maxlength="60" value="{{$arr_admin_details['first_name'] or ''}}" onkeyup="chk_validation(this)">
                                        <span class="error">{{ $errors->first('first_name') }} </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group has-default bmd-form-group is-filled">
                                        <label class="bmd-label-floating">Last Name <i class="red">*</i></label>
                                        <input type="text" name="last_name" id="last_name" class="form-control" data-rule-required="true" data-rule-maxlength="60" value="{{$arr_admin_details['last_name'] or ''}}" onkeyup="chk_validation(this)">
                                        <span class="error">{{ $errors->first('last_name') }} </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group has-default bmd-form-group is-filled">
                                        <label class="bmd-label-floating">Email <i class="red">*</i></label>
                                        <input type="text" name="email" id="email" class="form-control chk_email" data-rule-required="true" data-rule-email value="{{$arr_admin_details['email'] or ''}}">
                                        <span class="error" id="err_email">{{ $errors->first('email') }} </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group has-default bmd-form-group is-filled">
                                        <label class="bmd-label-floating">Phone Number <i class="red">*</i></label>
                                        <input type="text" name="contact" id="contact" class="form-control" data-rule-required="true" data-rule-pattern="[- +()0-9]+" data-rule-minlength="7" data-rule-maxlength="16" data-msg-minlength="Phone no should be atleast 7 numbers" data-msg-maxlength="Phone no should not be more than 16 numbers" value="{{$arr_admin_details['contact'] or ''}}">
                                        <span class="error">{{ $errors->first('contact') }} </span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group has-default bmd-form-group is-filled">
                                        <label class="bmd-label-floating">Address <i class="red">*</i></label>
                                        <input type="text" name="address" id="address" class="form-control" placeholder="" data-rule-required="true" data-rule-maxlength="255" value="{{$arr_admin_details['address'] or ''}}">
                                        <span class="error">{{ $errors->first('address') }} </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group has-default bmd-form-group is-filled">
                                        <label class="bmd-label-floating">Password <i class="red">*</i></label>
                                        <input type="password" name="password" id="password" class="form-control" data-rule-pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^])(?=.*\d).*" data-rule-required="true" data-rule-maxlength="255" value="">
                                        <span class="error">{{ $errors->first('password') }} </span>
                                        <div class="clearfix"></div>
                                    </div>
                                    <span class="note-section-block form-note-section"><b>Note :</b> <span>Password must contain at least (1) lowercase and (1) uppercase and (1) special character and greater than or equal to 6 character.</span></span>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group has-default bmd-form-group is-filled">
                                        <label class="bmd-label-floating">Confirm Password <i class="red">*</i></label>
                                        <input type="password" name="confirm_password" id="confirm_password" class="form-control" data-rule-required="true" data-rule-maxlength="255" data-rule-equalto="#password" value="">
                                        <span class="error">{{ $errors->first('confirm_password') }} </span>
                                    </div>
                                </div>
                                <div class="col-md-12">
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
                                                            <th style="text-align:center;">Update / Multiple Action</th>
                                                            <th style="text-align:center;">Delete(Single delete)</th>
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

                                                        @if(isset($arr_modules) && sizeof($arr_modules)>0) @foreach($arr_modules as $key => $row )
                                                        <tr class="info">
                                                            <td><b>{{$row['title']}}</b></td>

                                                            <?php 
                                                                      $slug = $row['slug']; 
                                                                      $checkbox_checked = '';                                              

                                                                      if($row['slug'] == 'account_settings' || $row['slug'] == 'change_password')
                                                                      {
                                                                        $checkbox_checked ='checked=checked';
                                                                      }
                                                                ?>
                                                                <td>
                                                                    <input class="form-control" {{$checkbox_checked}} type="checkbox" data-module-ref="{{$slug}}" data-module-action-ref="List" name="arr_permisssion[subadmin][{{$slug}}.list]" value="true" style="height: 14px;">
                                                                </td>

                                                                <td>
                                                                    @if(!in_array($slug, $arr_not_to_create_list))
                                                                    <input class="form-control" type="checkbox" {{$checkbox_checked}} data-module-ref="{{$slug}}" data-module-action-ref="Create" name="arr_permisssion[subadmin][{{$slug}}.create]" value="true" style="height: 14px;"> @endif
                                                                </td>

                                                                <td>
                                                                    @if(!in_array($slug, $arr_not_to_update_list))
                                                                    <input class="form-control" type="checkbox" {{$checkbox_checked}} data-module-ref="{{$slug}}" data-module-action-ref="Update" name="arr_permisssion[subadmin][{{$slug}}.update]" value="true" style="height: 14px;"> @endif
                                                                </td>


                                                                <td>
                                                                    @if(!in_array($slug, $arr_not_to_delete_list))
                                                                    <input class="form-control" type="checkbox" data-module-ref="{{$slug}}" data-module-action-ref="Delete" name="arr_permisssion[subadmin][{{$slug}}.delete]" value="true" style="height: 14px;"> @endif
                                                                </td>


                                                        </tr>
                                                        @endforeach @endif
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-rose pull-right">Add</button>
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
    /*$(document).ready(function () {
        $("#address").geocomplete();
    });*/

    $(document).on("change", ".validate-image", function () {
        var file = this.files;
        validateImage(this.files, 250, 250);
    });

    $(document).on("click", "#remove", function () {
        removeFile();
    });



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
                } else {
                    error.insertAfter(element);
                }

            }
        });

        $('#frm_account_setting').submit(function () {

            if ($('#frm_account_setting').valid() == true) {
                var isvalid = $("input[name='isvalid']").val();
                if (isvalid == 'invalid') {
                    return false;
                } else {
                    return true;
                }
            }

        });
    });

    function chk_validation(ref) {
        var yourInput = $(ref).val();
        re = /[0-9`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi;
        var isSplChar = re.test(yourInput);
        if (isSplChar) {
            var no_spl_char = yourInput.replace(/[0-9`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi, '');
            $(ref).val(no_spl_char);
        }
    }
</script>
@endsection
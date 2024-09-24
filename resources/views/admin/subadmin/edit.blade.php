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
                        <h4 class="card-title">{{$module_title or ''}}
                  </h4>
                    </div>
                    <div class="card-body">
                        @include('admin.layout._operation_status')
                        <form class="form-horizontal" id="frm_account_setting" name="frm_account_setting" action="{{$module_url_path}}/update/{{$id}}" method="post">
                            {{csrf_field()}}
                            <input type="hidden" name="id" id="id" value="{{$id}}">
                            <input type="hidden" name="user_id" id="user_id" value="{{$id}}">
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <!--<label class="bmd-label-floating">User Type <i class="red">*</i></label>-->
                                    <div class="form-group has-default bmd-form-group is-filled">
                                        <select class="selectpicker" data-rule-required="true" data-style="select-with-transition" name="user_type" id="user_type" disabled="">
                                            <option value="program-creator" @if(isset($arr_user[ 'user_type']) && $arr_user[ 'user_type']!='' && $arr_user[ 'user_type']=='program-creator' ) selected @endif>Program Creator</option>
                                            <option value="supervisor" @if(isset($arr_user[ 'user_type']) && $arr_user[ 'user_type']!='' && $arr_user[ 'user_type']=='supervisor' ) selected @endif>Supervisor</option>
                                        </select>
                                        <span class="error">{{ $errors->first('user_type') }} </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group has-default bmd-form-group is-filled">
                                        <label class="bmd-label-floating">First Name <i class="red">*</i></label>
                                        <input type="text" name="first_name" id="first_name" class="form-control" data-rule-required="true" data-rule-maxlength="60" value="@if(isset($arr_user['first_name']) && $arr_user['first_name']!=''){{$arr_user['first_name']}}@endif" onkeyup="chk_validation(this)">
                                        <span class="error">{{ $errors->first('first_name') }} </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group has-default bmd-form-group is-filled">
                                        <label class="bmd-label-floating">Last Name <i class="red">*</i></label>
                                        <input type="text" name="last_name" id="last_name" class="form-control" data-rule-required="true" data-rule-maxlength="60" value="@if(isset($arr_user['last_name']) && $arr_user['last_name']!=''){{$arr_user['last_name']}}@endif" onkeyup="chk_validation(this)">
                                        <span class="error">{{ $errors->first('last_name') }} </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group has-default bmd-form-group is-filled">
                                        <label class="bmd-label-floating">Email <i class="red">*</i></label>
                                        <input type="text" name="email" id="email" class="form-control chk_email" data-rule-required="true" data-rule-email value="@if(isset($arr_user['email']) && $arr_user['email']!=''){{$arr_user['email']}}@endif" readonly="">
                                        <span class="error" id="err_email">{{ $errors->first('email') }} </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group has-default bmd-form-group is-filled">
                                        <label class="bmd-label-floating">Phone Number <i class="red">*</i></label>
                                        <input type="text" name="contact" id="contact" class="form-control" data-rule-required="true" data-rule-pattern="[- +()0-9]+" data-rule-minlength="7" data-rule-maxlength="16" data-msg-minlength="Phone no should be atleast 7 numbers" data-msg-maxlength="Phone no should not be more than 16 numbers" value="@if(isset($arr_user['contact']) && $arr_user['contact']!=''){{$arr_user['contact']}}@endif">
                                        <span class="error">{{ $errors->first('contact') }} </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group has-default bmd-form-group is-filled">
                                        <label class="bmd-label-floating">Address <i class="red">*</i></label>
                                        <input type="text" name="address" id="address" class="form-control" placeholder="" data-rule-required="true" data-rule-maxlength="255" value="@if(isset($arr_user['address']) && $arr_user['address']!=''){{$arr_user['address']}}@endif">
                                        <span class="error">{{ $errors->first('address') }} </span>
                                    </div>
                                </div>                                
                            </div>                                                        
                            <button type="submit" class="btn btn-rose pull-right">Update</button>
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
        $('#frm_bank_account').validate({
            ignore: [],
            highlight: function (element) {},
            rules: {},
            messages: {},
            errorPlacement: function (error, element) {
                var name = $(element).attr("name");
                error.insertAfter(element);
            }
        });

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
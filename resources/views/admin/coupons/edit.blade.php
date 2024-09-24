@extends('admin.layout.master') @section('main_content')
<!-- Page header -->
@include('admin.layout.breadcrumb')
<!-- /page header -->

<!-- BEGIN Main Content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="card-body-section">
                <div class="card">
                    <div class="card-header card-header-icon card-header-rose">
                        <div class="card-icon">
                            <i class="{{$module_icon or ''}}"></i>
                        </div>
                        <h4 class="card-title">{{$page_title or ''}}</h4>
                    </div>
                    <div class="card-body">
                        @include('admin.layout._operation_status')
                        <form class="form-horizontal" id="frm_add_coupon" name="frm_add_coupon" action="{{$module_url_path}}/update/{{isset($id) ? $id : ''}}" method="post">
                            {{csrf_field()}}
                            <h4 class="title"></h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group has-default bmd-form-group is-filled">
                                        <label class="bmd-label-floating">Coupon Code <i class="red">*</i></label>
                                        <input type="text" name="coupon_code" readonly id="coupon_code" class="form-control" data-rule-required="true" data-rule-maxlength="10" data-msg-maxlength="Please enter no more than 10 numbers." value="{{$arr_coupons['coupon_code'] or ''}}">
                                        <span class="error">{{ $errors->first('coupon_code') }} </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group has-default bmd-form-group is-filled">
                                        <label class="bmd-label-floating">Title <i class="red">*</i></label>
                                        <input type="text" name="title" id="title" class="form-control" data-rule-required="true" data-rule-maxlength="100" value="{{$arr_coupons['title'] or ''}}">
                                        <span class="error">{{ $errors->first('title') }} </span>
                                    </div>
                                </div>
                            </div>                            
                            <?php $currency_sym = isset($arr_currency['html_code']) && !empty($arr_currency['html_code']) ? $arr_currency['html_code'] : ''; ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group has-default bmd-form-group is-filled">
                                        <label class="bmd-label-floating">Discount Amount ({!! $currency_sym !!}) <i class="red">*</i></label>
                                        <input type="text" name="discount_amount" id="discount_amount" class="form-control" data-rule-required="true" data-rule-maxlength="8" data-msg-maxlength="Please enter no more than 8 digits." data-rule-number="true" data-msg-number="Please enter valid discount amount." value="{{$arr_coupons['discount_amount'] or ''}}">
                                        <span class="error">{{ $errors->first('discount_amount') }} </span>
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                    <div class="form-group has-default bmd-form-group is-filled">
                                        <label class="bmd-label-floating">Number of times use <i class="red">*</i></label>
                                        <input type="text" name="number_of_times" id="number_of_times" class="form-control"  data-rule-maxlength="8" data-msg-maxlength="Please enter no more than 8 digits." data-rule-number="true" data-msg-number="Please enter valid use count." value="{{$arr_coupons['coupon_option'] or ''}}"><span class="error">{{ $errors->first('number_of_times') }} </span>
                                    </div>
                                </div>
                            </div>                                
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group has-default bmd-form-group is-filled">
                                        <label class="bmd-label-floating">Start Date <i class="red">*</i></label>
                                        <input type="text" name="start_date" id="start_date" class="form-control" data-rule-required="true" data-msg-required="Please select start date." value="{{isset($arr_coupons['start_date']) ? date('d-m-Y',strtotime($arr_coupons['start_date'])) : ''}}">
                                        <span class="error">{{ $errors->first('start_date') }} </span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group has-default bmd-form-group is-filled">
                                        <label class="bmd-label-floating">End Date <i class="red">*</i></label>
                                        <input type="text" name="end_date" id="end_date" class="form-control" data-rule-required="true" data-msg-required="Please select end date." value="{{isset($arr_coupons['end_date']) ? date('d-m-Y',strtotime($arr_coupons['end_date'])) : ''}}">
                                        <span class="error">{{ $errors->first('end_date') }} </span>
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
    $(document).ready(function () {
        /*var today = new Date();
        //var date = new Date(today.getTime() + 24 * 60 * 60 * 1000);
        $('#start_date,#end_date').datetimepicker({
            format: 'DD-MM-YYYY',
            minDate: today,
            useCurrent: false,
        });

        $('#start_date,#end_date').parent().addClass('is-filled');

        $("#start_date").on("dp.change", function (e) {
            $('#end_date').data("DateTimePicker").minDate(e.date);
        });
        $("#end_date").on("change", function (e) {
            $('#start_date').data("DateTimePicker").maxDate(e.date);
        });*/



        $("#start_date").datepicker({
            dateFormat: "dd-mm-yy",
            minDate:0,
            changeMonth: true,
            changeYear: true,
            autoclose: true,
            onSelect: function() {
                //- get date from another datepicker without language dependencies
                var minDate = $('#start_date').datepicker('getDate');       
                $("#end_date").datepicker("change", { minDate: minDate });
            }
        });

        $("#end_date").datepicker({
            dateFormat: "dd-mm-yy",
            minDate:0,
            changeMonth: true,
            changeYear: true,
            autoclose: true,
            onSelect: function() {
                //- get date from another datepicker without language dependencies
                var maxDate = $('#end_date').datepicker('getDate');
                $("#start_date").datepicker("change", { maxDate: maxDate });
            }
        });










        /*$('#start_date').change(function(){
            $('#end_date').val('');
            $('#end_date').datepicker('destroy');

            $('#end_date').datepicker({
              autoclose: true,
              startDate:new Date(),
              format: 'dd-mm-yyyy',
              todayHighlight: true,
              startDate: $('#start_date').val()
            });
            
          });*/

        /* $('#end_date').change(function(){
          var start_date = $('#start_date').val();
          var end_date   = $('#end_date').val();

          if(new Date(start_date) > new Date(end_date))
          {
            $("#err_end_date").html("End date can't be smaller than Start date");
            $("#err_end_date").focus();
            $("#err_end_date").fadeOut(8000);
            $('#end_date').val("");
          }
        });
*/
        $('#frm_add_coupon').validate({
            ignore: [],
            highlight: function (element) {},
            rules: {

            },
            messages: {

            },
            errorPlacement: function (error, element) {
                var name = $(element).attr("name");
                if (name === "coupon_option") {
                    error.insertAfter('.err_option');
                } else {
                    error.insertAfter(element);
                }

            }
        });
    });
</script>

@endsection
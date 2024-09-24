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
                        <form class="form-horizontal" id="frm_add_coupon" name="frm_add_coupon" action="{{$module_url_path}}/store" method="post">
                            {{csrf_field()}}
                            <h4 class="title"></h4>
                            <div class="checkbox-radios text-center">
                                <div class="form-check form-check-inline">
                                  <label class="form-check-label">
                                    <input class="form-check-input coupon-type" type="radio" name="coupon_type" value="add" checked> Add Coupon
                                    <span class="form-check-sign">
                                      <span class="check"></span>
                                    </span>
                                  </label>
                                </div>
                                <div class="form-check form-check-inline">
                                  <label class="form-check-label">
                                    <input class="form-check-input coupon-type" type="radio" name="coupon_type" value="system"> System Coupon
                                    <span class="form-check-sign">
                                      <span class="check"></span>
                                    </span>
                                  </label>
                                </div>                              
                            </div>         
                            <div class="admin-coupon-code-section">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group has-default bmd-form-group is-filled">
                                        <label class="bmd-label-floating">Coupon Code <i class="red">*</i></label>
                                        <input type="text" name="coupon_code" id="coupon_code" class="form-control" data-rule-required="true" data-rule-maxlength="10" data-msg-maxlength="Please enter no more than 10 numbers." value="{{$coupon_code}}">
                                        <span class="error">{{ $errors->first('coupon_code') }} </span>
                                    </div>
                                </div>                                
                                <div class="col-md-6">
                                    <div class="form-group has-default bmd-form-group is-filled">
                                        <label class="bmd-label-floating">Owner</label>
                                        <input type="text" value="Admin" class="form-control" readonly="">                                        
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group has-default bmd-form-group is-filled">
                                        <label class="bmd-label-floating">Title <i class="red">*</i></label>
                                        <input type="text" name="title" id="title" class="form-control" data-rule-required="true" data-rule-maxlength="100" value="{{old('title')}}">
                                        <span class="error">{{ $errors->first('title') }} </span>
                                    </div>
                                </div>
                                <?php $currency_sym = isset($arr_currency['html_code']) && !empty($arr_currency['html_code']) ? $arr_currency['html_code'] : ''; ?>
                                <div class="col-md-6">
                                    <div class="form-group has-default bmd-form-group is-filled">
                                        <label class="bmd-label-floating">Discount Amount ({!! $currency_sym !!}) <i class="red">*</i></label>
                                        <input type="text" name="discount_amount" id="discount_amount" class="form-control" data-rule-required="true" data-rule-maxlength="8" data-msg-maxlength="Please enter no more than 8 digits." data-rule-number="true" data-msg-number="Please enter valid discount amount." value="{{old('discount_amount')}}">
                                        <span class="error">{{ $errors->first('discount_amount') }} </span>
                                    </div>    
                                </div>                                
                                <div class="col-md-6">
                                    <label class="bmd-label-floating">Start Date <i class="red">*</i></label>
                                    <div class="form-group has-default bmd-form-group is-filled">
                                        <input type="text" name="start_date" id="start_date" class="form-control datepicker" data-rule-required="true" data-msg-required="Please select start date." value="{{old('start_date')}}">
                                        <span class="error">{{ $errors->first('start_date') }} </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="bmd-label-floating">End Date <i class="red">*</i></label>
                                    <div class="form-group has-default bmd-form-group is-filled">
                                        <input type="text" name="end_date" id="end_date" class="form-control datepicker" data-rule-required="true" data-msg-required="Please select end date." value="{{old('end_date')}}">
                                        <span class="error">{{ $errors->first('end_date') }} </span>
                                    </div>    
                                </div>
                                <div class="col-md-5">
                                    <label class="bmd-label-floating">Options  <i class="red">*</i></label>                                              
                                    <div class="form-check">
                                      <label class="form-check-label">                              
                                        <input class="form-check-input option-type" type="radio" name="coupen_option" value="one" checked=""> One Time Use
                                        <span class="circle">
                                          <span class="check"></span>
                                        </span>
                                      </label>                     
                                      <label class="form-check-label">
                                        <input class="form-check-input option-type" type="radio" name="coupen_option" value="multiple"> Multiple Time Use
                                        <span class="circle">
                                          <span class="check"></span>
                                        </span>
                                      </label>
                                    </div>
                                </div>
                                <div class="col-md-3 number_of_times" style="display: none;">
                                    <div class="form-group has-default bmd-form-group is-filled" >
                                        <label class="bmd-label-floating">Number of times use </label>
                                        <input type="text" name="number_of_times" id="number_of_times" class="form-control"  data-rule-maxlength="8" data-msg-maxlength="Please enter no more than 8 digits." data-rule-number="true" data-msg-number="Please enter valid use count." value="{{old('number_of_times')}}">
                                        <span class="error">{{ $errors->first('number_of_times') }} </span>
                                    </div>    
                                </div>                                
                            </div>                                
                            <button type="submit" class="btn btn-rose pull-right">Add</button>
                            <button type="button" onclick="location.href='{{$module_url_path}}'" class="btn btn-rose pull-right">Cancel</button>
                            <div class="clearfix"></div>
                            </div>
                        </form>
                        <div class="system-coupon-code-section" style="display: none;">
                            <?php
                                $currency_sym          = isset($arr_currency['html_code']) && !empty($arr_currency['html_code']) ? $arr_currency['html_code'] : '';
                                $discount_amount       = isset($arr_reference_code[0]['discount_amount']) && !empty($arr_reference_code[0]['discount_amount']) ? $arr_reference_code[0]['discount_amount'] : '';
                                $validity_extension    = isset($arr_reference_code[0]['validity_extension']) && !empty($arr_reference_code[0]['validity_extension']) ? $arr_reference_code[0]['validity_extension'] : '';
                                $reward_amount         = isset($arr_reference_code[0]['reward_amount']) && !empty($arr_reference_code[0]['reward_amount']) ? $arr_reference_code[0]['reward_amount'] : '';
                                $reference_reward_type = isset($arr_reference_code[0]['reference_reward_type']) && !empty($arr_reference_code[0]['reference_reward_type']) ? $arr_reference_code[0]['reference_reward_type'] : '';

                                $parent_validity_start_date = isset($arr_reference_code[0]['start_date']) && !empty($arr_reference_code[0]['start_date']) ? $arr_reference_code[0]['start_date'] : '';

                                $parent_validity_end_date   = isset($arr_reference_code[0]['end_date']) && !empty($arr_reference_code[0]['end_date']) ? $arr_reference_code[0]['end_date'] : '';

                                $discount_amount_by_teacher = isset($arr_reference_code[1]['discount_amount']) && !empty($arr_reference_code[1]['discount_amount']) ? $arr_reference_code[1]['discount_amount'] : '';

                                $insentive_amount = isset($arr_reference_code[1]['reward_amount']) && !empty($arr_reference_code[1]['reward_amount']) ? $arr_reference_code[1]['reward_amount'] : '';
                             $teacher_validity_start_date = isset($arr_reference_code[1]['start_date']) && !empty($arr_reference_code[1]['start_date']) ? $arr_reference_code[1]['start_date'] : '';

                              $teacher_validity_end_date = isset($arr_reference_code[1]['end_date']) && !empty($arr_reference_code[1]['end_date']) ? $arr_reference_code[1]['end_date'] : '';
                            ?>
						  <!--tabbing section start-->
                         <div data-responsive-tabs class="responsive-tabs">
							<nav>
								<ul>
									<li>
										<a href="#one">Parent</a>
									</li>
									<li>
										<a href="#two">Teacher</a>
									</li>
								</ul>
							</nav>
							<div class="content">
						       <section id="one">
        							<form class="form-horizontal" id="frm_reference_code_parent" name="frm_reference_code" action="{{url('/admin/reference_code/update')}}" method="post">
                                    {{csrf_field()}}
                                    <h4 class="title">&nbsp;</h4> 
                                        <input type="hidden" name="coupon_type" value="PARENT">
                                        <div class="form-group has-default bmd-form-group is-filled">
                                            <label class="bmd-label-floating">Discount Amount ({!! $currency_sym !!}) <i class="red">*</i></label>
                                            <input type="text" name="reward_amount_for_reference_parent" id="reward_amount_for_reference_parent" class="form-control" value="{{ $discount_amount }}">
                                            <span class="error" id="err_reward_amount_for_reference_parent">{{ $errors->first('reward_amount_for_reference_parent') }}</span>
                                        </div>
                                        <div class="row">
                                        <div class="col-md-5">
                                            <label class="bmd-label-floating">Reference Reward Type<i class="red">*</i> </label>                                                
                                            <div class="form-check">
                                              <label class="form-check-label">                              
                                                <input class="form-check-input reference_reward_type" type="radio" name="reference_reward_type" value="validity_extension" @if($reference_reward_type == 'validity_extension') checked="" @endif> Validity Extension
                                                <span class="circle">
                                                  <span class="check"></span>
                                                </span>
                                              </label>                     
                                              <label class="form-check-label">
                                                <input class="form-check-input reference_reward_type" type="radio" name="reference_reward_type" value="reference_amount" @if($reference_reward_type == 'reference_amount') checked="" @endif> Incentive Amount
                                                <span class="circle">
                                                  <span class="check"></span>
                                                </span>
                                              </label>
                                              <label class="form-check-label">
                                                <input class="form-check-input reference_reward_type" type="radio" name="reference_reward_type" value="both" @if($reference_reward_type == 'both') checked="" @endif> Both
                                                <span class="circle">
                                                  <span class="check"></span>
                                                </span>
                                              </label>
                                            </div>
                                            <span class="error" id="err_reference_reward_type">{{ $errors->first('reference_reward_type') }}</span>
                                        </div>
                                        <div class="col-md-3 validity_extension" style="display: none;">
                                            <div class="form-group has-default bmd-form-group is-filled">
                                                <label class="bmd-label-floating">Validity Extension (Months) <i class="red">*</i></label>
                                                <input type="text" name="validity_extension" id="validity_extension" class="form-control" value="{{ $validity_extension }}">
                                                <span class="error" id="err_validity_extension">{{ $errors->first('validity_extension') }}</span>
                                            </div>
                                        </div>                                                
                                        <div class="col-md-3 reward_amount" style="display: none;">
                                            <div class="form-group has-default bmd-form-group is-filled">
                                                <label class="bmd-label-floating">Incentive Amount ({!! $currency_sym !!}) <i class="red">*</i></label>
                                                <input type="text" name="reward_amount" id="reward_amount" class="form-control" value="{{ $reward_amount }}">
                                                <span class="error" id="err_reward_amount">{{ $errors->first('reward_amount') }} </span>
                                            </div>                   
                                        </div>
                                        <div class="col-md-6">
                                            <label class="bmd-label-floating">Validity Start Date <i class="red">*</i></label>
                                            <div class="form-group has-default bmd-form-group is-filled">
                                                <input type="text" name="parent_validity_start_date" id="parent_validity_start_date" class="form-control datepicker" data-rule-required="true" data-msg-required="Please select start date." value="{{ $parent_validity_start_date or '' }}">
                                                <span class="error">{{ $errors->first('parent_validity_start_date') }} </span>
                                                 <div class="error" id="err_validity_start_date"></div>
                                            </div>
                                            
                                        </div>
                                        <div class="col-md-6">
                                            <label class="bmd-label-floating">Validity End Date <i class="red">*</i></label>
                                            <div class="form-group has-default bmd-form-group is-filled">
                                                <input type="text" name="parent_validity_end_date" id="parent_validity_end_date" class="form-control datepicker" data-rule-required="true" data-msg-required="Please select end date." value="{{ $parent_validity_end_date or '' }}">
                                                <span class="error">{{ $errors->first('parent_validity_end_date') }} </span>
                                                 <div class="error" id="err_validity_end_date"></div>  
                                            </div>  
                                        </div>    
                                    </div>
                                    <button type="submit" class="btn btn-rose pull-right" id="btnReferenceAmountByParent">Update</button>
                                    <button type="button" onclick="location.href='{{$module_url_path}}'" class="btn btn-rose pull-right">Cancel</button>
                                    <div class="clearfix"></div>
                                   </form>    

							    </section>
							    <section id="two">
								    <form class="form-horizontal" id="frm_reference_code_teacher" name="frm_reference_code" action="{{url('/admin/reference_code/update')}}" method="post">
                                     {{csrf_field()}}
                                        <h4 class="title">&nbsp;</h4> 
                                        <input type="hidden" name="coupon_type" value="TEACHER">
                                        <div class="form-group has-default bmd-form-group is-filled">
                                            <label class="bmd-label-floating">Discount Amount ({!! $currency_sym !!}) <i class="red">*</i></label>
                                            <input type="text" data-rule-required="true" data-rule-min=1 name="discount_amount_by_teacher" id="discount_amount_by_teacher" class="form-control" value="{{ $discount_amount_by_teacher or '' }}">
                                            <span class="error" id="err_discount_amount_by_teacher">{{ $errors->first('discount_amount_by_teacher') }}</span>
                                        </div>
                                        <div class="row">                               
                                        <div class="col-md-12 reward_amount">
                                            <div class="form-group has-default bmd-form-group is-filled">
                                                <label class="bmd-label-floating">Incentive Amount ({!! $currency_sym !!}) <i class="red">*</i></label>
                                                <input type="text" data-rule-required="true" data-rule-min=1 name="insentive_amount" id="insentive_amount" class="form-control" value="{{ $insentive_amount or '' }}">
                                                <span class="error" id="err_insentive_amount">{{ $errors->first('insentive_amount') }} </span>
                                            </div>                   
                                        </div>    
                                        </div>
                                     <div class="row">           
                                        <div class="col-md-6">
                                            <label class="bmd-label-floating">Start Date <i class="red">*</i></label>
                                            <div class="form-group has-default bmd-form-group is-filled">
                                                <input type="text" name="teacher_validity_start_date" id="teacher_validity_start_date" class="form-control datepicker" data-rule-required="true" data-msg-required="Please select start date." value="{{ $teacher_validity_start_date or '' }}">
                                                <span class="error">{{ $errors->first('teacher_validity_start_date') }} </span>

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="bmd-label-floating">End Date <i class="red">*</i></label>
                                            <div class="form-group has-default bmd-form-group is-filled">
                                                <input type="text" name="teacher_validity_end_date" id="teacher_validity_end_date" class="form-control datepicker" data-rule-required="true" data-msg-required="Please select end date." value="{{ $teacher_validity_end_date or '' }}">
                                                <span class="error">{{ $errors->first('teacher_validity_end_date') }} </span>
                                            </div>    
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-rose pull-right" id="btnReferenceAmountByTeacher">Update</button>
                                    <button type="button" onclick="location.href='{{$module_url_path}}'" class="btn btn-rose pull-right">Cancel</button>
                                    <div class="clearfix"></div>
                                     </form>   
								</section>
							</div>
						</div>
                        <!--tabbing section end-->
                         
                         
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- BEGIN Main Content -->

<!-- <link rel = "stylesheet" href = "//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">    
<script type = "text/javascript" src = "https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js"></script> -->

<script>
$(document).ready(function () {        

    check_coupon_type();
    check_reference_reward_type();

    function check_coupon_type(){
        var coupon_type = $('.coupon-type:checked').val();

        if(coupon_type == 'add') {
            $(".system-coupon-code-section").hide();
            $(".admin-coupon-code-section").show();
        }
        if(coupon_type == 'system') {
            $(".system-coupon-code-section").show();
            $(".admin-coupon-code-section").hide();
        }
    }

    function check_reference_reward_type(){
        var reference_reward_type = $('.reference_reward_type:checked').val();

        if(reference_reward_type == 'validity_extension') {
            $(".validity_extension").show();
            $(".reward_amount").hide();
        }
        if(reference_reward_type == 'reference_amount') {
            $(".validity_extension").hide();
            $(".reward_amount").show();
        }
        if(reference_reward_type == 'both') {
            $(".validity_extension").show();
            $(".reward_amount").show();
        }
    }

    $('.coupon-type').on('click',function(){
        check_coupon_type();
    });


    $('.reference_reward_type').on('click',function(){        
        check_reference_reward_type();
    });    

    $('.option-type').on('click',function(){
        if($(this).val()=='one') {
            $('#number_of_times').removeAttr('data-rule-required');
            $(".number_of_times").hide();
        }
        if($(this).val()=='multiple') {
            $('#number_of_times').attr('data-rule-required',true);
            $(".number_of_times").show();
        }
    });
        
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

    $("#parent_validity_start_date").datepicker({
        dateFormat: "dd-mm-yy",
        minDate:0,
        changeMonth: true,
        changeYear: true,
        autoclose: true,
        onSelect: function() {
            //- get date from another datepicker without language dependencies
            var minDate = $('#parent_validity_start_date').datepicker('getDate');       
            $("#parent_validity_end_date").datepicker("change", { minDate: minDate });
        }
    });
    
    $("#parent_validity_end_date").datepicker({
        dateFormat: "dd-mm-yy",
        minDate:0,
        changeMonth: true,
        changeYear: true,
        autoclose: true,
        onSelect: function() {
            //- get date from another datepicker without language dependencies
            var maxDate = $('#parent_validity_end_date').datepicker('getDate');
            $("#parent_validity_start_date").datepicker("change", { maxDate: maxDate });
        }
    });

     $("#teacher_validity_start_date").datepicker({
        dateFormat: "dd-mm-yy",
        minDate:0,
        changeMonth: true,
        changeYear: true,
        autoclose: true,
        onSelect: function() {
            //- get date from another datepicker without language dependencies
            var minDate = $('#teacher_validity_start_date').datepicker('getDate');       
            $("#teacher_validity_end_date").datepicker("change", { minDate: minDate });
        }
    });
    
    $("#teacher_validity_end_date").datepicker({
        dateFormat: "dd-mm-yy",
        minDate:0,
        changeMonth: true,
        changeYear: true,
        autoclose: true,
        onSelect: function() {
            //- get date from another datepicker without language dependencies
            var maxDate = $('#teacher_validity_end_date').datepicker('getDate');
            $("#teacher_validity_start_date").datepicker("change", { maxDate: maxDate });
        }
    });


    $('#frm_add_coupon').validate({
        ignore: [],
        highlight: function (element) {},
        rules: {  },
        messages: {  },
        errorPlacement: function (error, element) {
            var name = $(element).attr("name");
            if (name === "coupon_option") {
                error.insertAfter('.err_option');
            } else {
                error.insertAfter(element);
            }
        }
    });

    $('#btnReferenceAmountByParent').on('click',function(){
        
        var discount_amount     = $('#reward_amount_for_reference_parent').val();
        var reward_type         = $("input[name='reference_reward_type']:checked"). val();
        var validity_extension  = $('#validity_extension').val();
        var reward_amount       = $('#reward_amount').val();
        var validity_start_date = $('#parent_validity_start_date').val();
        var validity_end_date   = $('#parent_validity_end_date').val();
        var flag = 1;
        if($.trim(discount_amount)=='')
        {
            $('#err_reward_amount_for_reference_parent').html('Please enter reward amount');
            $('#discount_amount').on('keyup',function(){$('#err_reward_amount_for_reference_parent').html('');});            
            flag = 0;
        }
        if($.trim(validity_start_date)=="")
        {
                $('#err_validity_start_date').html('Please enter validity start date.');          
                flag = 0;
        } 
        if($.trim(validity_end_date)=="")
        {
                $('#err_validity_end_date').html('Please enter validity end date.');           
                flag = 0;
        } 
        if($.trim(reward_type)=='')
        {
            $('#err_reference_reward_type').html('Please enter reward type');
            $('#reward_amount').on('keyup',function(){$('#err_reference_reward_type').html('');});            
            flag = 0;
        }
        else if($.trim(reward_type)!='' && $.trim(reward_type)=='validity_extension')
        {
            if($.trim(validity_extension)=='')
            {
                $('#err_validity_extension').html('Please enter validity extension');
                $('#validity_extension').on('keyup',function(){$('#err_validity_extension').html('');});            
                flag = 0;   
            }            
        }        
        else if($.trim(reward_type)!='' && $.trim(reward_type)=='reference_amount')
        {         
            if($.trim(reward_amount)=='')
            {
                $('#err_reward_amount').html('Please enter reward amount');
                $('#reward_amount').on('keyup',function(){$('#err_reward_amount').html('');});            
                flag = 0;
            }
        }        
        else if($.trim(reward_type)!='' && $.trim(reward_type)=='both')
        {     
            if($.trim(validity_extension)=='')
            {
                $('#err_validity_extension').html('Please enter validity extension');
                $('#validity_extension').on('keyup',function(){$('#err_validity_extension').html('');});            
                flag = 0;   
            }     
            if($.trim(reward_amount)=='')
            {
                $('#err_reward_amount').html('Please enter reward amount');
                $('#reward_amount').on('keyup',function(){$('#err_reward_amount').html('');});            
                flag = 0;
            }
        }
        else
        {
            flag = 1;
        }
            
        if(flag==1)
        {
            showProcessingOverlay();
            return true;
        }
        else
        {
            return false;
        }
       /* ignore: [],
        highlight: function (element) {},
        rules: {  },
        messages: {  },
        errorPlacement: function(error, element) 
        { 
            var name = $(element).attr("name");            
            if (name === "reference_reward_type") 
            {
                error.insertAfter('.err_reference_code');
            } 
            else
            {
                error.insertAfter(element);
            }
        } */
    });
    $('#frm_reference_code_teacher').validate({
        ignore: [],
        highlight: function (element) {},
        rules: {  },
        messages: {  },
        
    });

    $('#frm_reference_code_teacher').on('submit',function(){

       if($('#frm_reference_code_teacher').valid())
       {
            showProcessingOverlay();
            return true;
       } 

    });

    $('#validity_extension').blur(function(){
        var extention = $('#validity_extension').val();
        if(parseFloat(extention)==0)
        {
            this.value = this.value.replace(/[^.0-9]/g, '');
        }


    });

    // Allow only Numeric Characters
    $('#validity_extension, #reward_amount, #reward_amount_for_reference_parent').keyup(function() {
        if (this.value.match(/[^.0-9]/g)) {
            this.value = this.value.replace(/[^.0-9]/g, '');
        }
    });
});
</script>
<script>
$(document).ready(function ()
{	
	$(document).on('responsive-tabs.initialised', function (event, el)
	{console.log(el);});
	$(document).on('responsive-tabs.change', function (event, el, newPanel)
	{
		console.log(el);
		console.log(newPanel);
	});

	$('[data-responsive-tabs]').responsivetabs(
	{
		initialised : function ()
		{
			console.log(this);
		},

		change : function (newPanel)
		{
			console.log(newPanel);
		}
	});


});
</script>
@endsection

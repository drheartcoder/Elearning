<!-- bredcrum section -->
<div class="bredcrum-section-main">
	<div class="container">
		<div class="page-title-main">
			{{trans('home.Payment')}}
		</div>
		<div class="page-bredcrum-section">
			 <ul>
                <li><a href="{{url('/')}}">{{trans('home.Home')}}</a> &nbsp;&nbsp; <i class="fa fa-angle-right"></i> &nbsp;&nbsp; </li>
                <li><a href="{{ URL::previous() }}">{{trans('home.Pricing')}}</a> &nbsp;&nbsp; <i class="fa fa-angle-right"></i> &nbsp;&nbsp; </li>
                <li>{{trans('home.Payment')}}</li>
            </ul>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
<!-- bredcrum section end -->
<div class="payment-paypal-section">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-4 col-lg-3">
				 
				<div class="payment-menu">
					<ul>
						<li>
							<a class="payment-checkout active" id="wechat" data-payment="wechat"> <span class="payment-img we-chat-icon"></span> <span class="payment-name">{{trans('home.WeChat_Pay')}}</span> </a>
						</li>

						<li>
							<a class="payment-checkout" id="alipay" data-payment="alipay"> <span class="payment-img"></span> <span class="payment-name">{{trans('home.Alipay')}}</span> </a>
						</li>

						<li>
							<a class="payment-checkout" id="paypal" data-payment="paypal"> <span class="payment-img paypal-icon"></span> <span class="payment-name">{{trans('home.Paypal')}}</span> </a>
						</li>
						<li>
							<a class="payment-checkout" id="wire-transfer" data-payment="wire-transfer"> <span class="payment-img Transfer-icon"></span> <span class="payment-name">{{trans('home.Wire_Transfer')}}</span> </a>
						</li>
					</ul>
				</div>
			</div>

			<div class="col-sm-12 col-md-8 col-lg-9">
				@include('front.layout._operation_status')
				<form action="{{url('/')}}/wechat/payment/{{uniqid()}}" method="post" id="frmPayment">
					{{csrf_field()}}	
					<div class="alipay-section coupon-section" style="display: block;">
						<div class="alipay-box">
							<div class="alipay-title pay-title">{{trans('home.WeChat_Pay')}}</div>
							<div class="alipay-plan-section">
							<div class="coupon-block">
								<div class="silver-plan-title">{{ $pricing_arr['name'] or '' }}: &#165; {{$pricing_arr['price'] or ''}}</div>

								<div class="row">
									<div class="col-sm-9 col-md-9 col-lg-9">
										<div class="form-group">
											<label>{{trans('home.Discount_Coupon')}}</label>
											<input type="text" placeholder="{{trans('home.Enter_your_Discount_Coupon')}}" id="coupon_code" name="coupon_code" />
											<input type="hidden" name="isvalid" id="isvalid">
											<span class="error" id="err_coupon_code"></span>
										</div>

									</div>

									<div class="col-sm-3 col-md-3 col-lg-3">
										<button type="button" class="full-orng-btn sim-button apply-payment">{{trans('home.Apply')}}</button>
									</div>
								</div>
							</div>

							<div class="price-details">
								<div class="label-strip">{{trans('home.Actual_Price')}}</div>
									<div class="price-strip">
										<div class="row">

										 <div id="actual_price_div_paypal" style="display: none">
											<div class="col-sm-6 col-md-6 col-lg-6">
												<label>1 ¥  :</label>
												<p> {!! $per_currency_rate or '' !!}</p>
												<div class="clearfix"></div>
											</div>
											<div class="col-sm-6 col-md-6 col-lg-6">
												<label>{{ $pricing_arr['price'] or '' }} ¥ :</label>
												<p>{!! $to_currency_symbol or '' !!}
												@if(isset($converted_total_price) && $converted_total_price!="")
													{{number_format($converted_total_price,'2')}} 
												@endif</p>
												<div class="clearfix"></div>
											</div>
										 </div>

										 <div id="actual_price_div_alipay">
											<div class="col-sm-6 col-md-6 col-lg-6">
												<label>{{ $pricing_arr['price'] or '' }} ¥ </label>
												<div class="clearfix"></div>
											</div>
										 </div>

										</div>
									</div>

									@if(Auth::check()!=false)
									<?php $user = Auth::user(); ?>
									@if($user->user_type =='parent' && $user->insentive_amount!='0')
										
										@if(isset($pricing_arr['price']) && $pricing_arr['price']<=$user->insentive_amount)
											<div class="label-strip">{{trans('home.Deduct_from_incentive')}}</div>
											<div class="price-strip">
												<div class="row">
													<div class="col-sm-6 col-md-6 col-lg-6">
														<label>{{trans('home.Incentive_Amount')}} ¥  :</label>
														<p> {{ $user->insentive_amount or ''}}</p>
														<div class="clearfix"></div>
													</div>
													<div class="col-sm-6 col-md-6 col-lg-6">
														<label>{{trans('home.Remaining_Incentive_Amount')}} ¥ :</label>
														<p>{{ $user_insentive_amount_in_cny or '' }}</p>
														<div class="clearfix"></div>
													</div>
												</div>
											</div>
										@endif

									@endif
									@endif
								<div class="coupen-section" style="display: none">
									<div class="label-strip">Discount</div>
									<div class="price-strip">
										<div class="row">
											<div class="col-sm-6 col-md-6 col-lg-6">
												<label>{{trans('home.Discount_Amount')}} (¥)</label>
												<p class="actual_discount_amount"></p>
												<div class="clearfix"></div>
											</div>
											<div class="col-sm-6 col-md-6 col-lg-6">
												<label>{{trans('home.Apply_Discount_Amount')}} (¥)</label>
												<p class="apply-discount-amount"></p>
												<div class="clearfix"></div>
											</div>
										</div>
									</div>
								</div>
								<div class="total_price_section">
								<div class="label-strip">{{trans('home.Total_Price')}}</div>
								<div class="price-strip">
									<div class="row">
									
									<div id="alipay_amount_div">
										<div class="col-sm-6 col-md-6 col-lg-6">
											<label>{{trans('home.Final_Amount')}} (¥)</label>
											<p class="total_price">{{ $pricing_arr['price'] or '' }} ¥</p>
											<div class="clearfix"></div>
										</div>
									</div>

									<div id="paypal_amount_div" style="display: none">
										<div class="col-sm-6 col-md-6 col-lg-6">
											<label>{{trans('home.Final_Amount')}} ($)</label>
											<p class="converted_total_price">
											{!! $to_currency_symbol or '' !!}
											@if(isset($converted_total_price) && $converted_total_price!="")	
											{{number_format($converted_total_price,'2')}}
											@endif

											</p>
										</div>
										<div class="clearfix"></div>
									</div>
									</div>
								</div>
							   </div>
							</div>


							<div class="alipay-plan-section acc-details wire-transfer" style="display: none">
							<div class="silver-plan-title">{{trans('home.Account_Details')}}</div>
							
							<div class="wire-transfer-details-bx">
								<div class="wire-details"><span class="wire-bank-name">{{trans('home.Account_Holder_Name')}}</span> <span class="wire-bank-details">{{ $arr_bank_details['bank_translation'][0]['account_holder_name'] or '' }}</span> </div>
									<div class="wire-details"><span class="wire-bank-name">{{trans('home.Bank_Name')}}</span> <span class="wire-bank-details">{{ isset($arr_bank_details['bank_translation'][0]['bank_name']) && $arr_bank_details['bank_translation'][0]['bank_name']!='' ? $arr_bank_details['bank_translation'][0]['bank_name'] : '-' }}</span> </div>
									<div class="wire-details"><span class="wire-bank-name">{{trans('home.Bank_Account_Number')}}</span> <span class="wire-bank-details">{{ isset($arr_bank_details['account_number']) && $arr_bank_details['account_number']!='' ? $arr_bank_details['account_number'] : '-' }}</span> </div>
									<div class="wire-details"><span class="wire-bank-name">{{trans('home.Branch_Name')}}</span> <span class="wire-bank-details">{{ isset($arr_bank_details['bank_translation'][0]['branch']) && $arr_bank_details['bank_translation'][0]['branch']!='' ? $arr_bank_details['bank_translation'][0]['branch'] : '-' }}</span> </div>
									<div class="wire-details"><span class="wire-bank-name">{{trans('home.IFSC_Code')}}</span> <span class="wire-bank-details">{{ isset($arr_bank_details['ifsc_code']) && $arr_bank_details['ifsc_code']!='' ? $arr_bank_details['ifsc_code'] : '-' }}</span> </div>
									<div class="wire-details"><span class="wire-bank-name">{{trans('home.SWIFT_Code')}}</span> <span class="wire-bank-details">{{ isset($arr_bank_details['swift_code']) && $arr_bank_details['swift_code']!='' ? $arr_bank_details['swift_code'] : '-' }}</span> </div>
									<div class="wire-details"><span class="wire-bank-name">{{trans('home.NOTE')}}</span> <span class="wire-bank-details">{{ isset($arr_bank_details['bank_translation'][0]['note']) && $arr_bank_details['bank_translation'][0]['note']!='' ? $arr_bank_details['bank_translation'][0]['note'] : '-' }}</span> </div>
									</div>
							</div>
					
							</div>

							<br>
							<div class="clearfix"></div>
								<div class="row">
									<div class="col-sm-9 col-md-9 col-lg-9">
										<div class="form-group">
											<label>{{trans('home.Enter_Note')}}</label>
											<textarea placeholder="{{trans('home.Enter_Note')}}" id="note" name="payment_note"></textarea>
										</div>

									</div>
								</div>


								@if(Auth::check()!=false)
								<?php $user = Auth::user(); ?>
									@if($user->user_type =='parent' && $user->insentive_amount!='0')
										@if(isset($pricing_arr['price']) && $pricing_arr['price']<=$user->insentive_amount)
										<div class="pay-discount-btn">
											<button type="button" class="full-orng-btn sim-button deduct-from-insentive" style="max-width: 220px !important;">{{trans('home.Deduct_from_incentive')}}</button>
										</div>
										<div class="silver-plan-title invest-member">{{trans('home.OR')}} </div>

										@endif
									@endif
								@endif		
								
								<div class="pay-discount-btn">
									<button type="submit" class="full-orng-btn sim-button">{{trans('home.Pay')}}</button>
								</div>
								<div class="silver-plan-title invest-member"> {{trans('home.Become_a_member_Invest_In_Your_Childs_Future')}}</div>
							</div>
						</div>
					</div>	


				<input type="hidden" placeholder="coupon_code_owner_id" name="coupon_code_owner_id" id="coupon_code_owner_id" value="">
				<input type="hidden" placeholder="converted_total_price" name="converted_total_price" id="converted_total_price" value='{{ $converted_total_price or '' }}'>									
				<input type="hidden" placeholder="total_price_cny_amount" name="total_price_cny_amount" id="total_price_cny_amount" value='{{ $total_price_cny_amount or ''  }}'>									
				<input type="hidden" placeholder="per_unit_conversion_rate" name="per_unit_conversion_rate" id="per_unit_conversion_rate" value='{{ $without_symbol_per_currency_rate or '' }}'>	
				<input type="hidden" name="from_currency" id="from_currency" value='{{ $from_currency or '' }}'>	
				<input type="hidden" name="to_currency" id="to_currency" value='{{ $to_currency or ''  }}'>	
				<input type="hidden" name="discount_amount" id="discount_amount" value="">				
				<input type="hidden" name="selected_payment" id="selected_payment">			

				</form>
			</div>				
		</div>
	</div>
</div>
<script type="text/javascript">

	$(".payment-checkout").on('click',function()
	{
		var payment = $(this).data('payment');
		var text    = "{{trans('home.WeChat_Pay')}}";
		var action  = SITE_URL+'/wechat/payment/{{uniqid()}}';
		$('.wire-transfer').hide();
		if(payment=='alipay')
		{
			text = "{{trans('home.Alipay')}}";

			$('#alipay_amount_div').show();
			$('#actual_price_div_paypal').hide();
			$('#actual_price_div_alipay').show();
			$('#paypal_amount_div').hide();
			$('.wire-transfer').hide();
			$('.all-type-payment').show();
			action = SITE_URL+'/alipay/payment';
		}
		if(payment=='paypal')
		{
			text = "{{trans('home.Paypal')}}";
			$('.wire-transfer').hide();
			$('#actual_price_div_paypal').show();
			$('#actual_price_div_alipay').hide();
			$('#alipay_amount_div').hide();
			$('#paypal_amount_div').show();
			$('.all-type-payment').show();
			action = SITE_URL+'/paypal/payment';
		}
		if(payment=='wechat')
		{
			text = "{{trans('home.WeChat_Pay')}}";
			$('#actual_price_div_paypal').hide();
			$('#actual_price_div_alipay').show();
			$('.wire-transfer').hide();
			$('.all-type-payment').show();
			action = SITE_URL+'/wechat/payment/{{uniqid()}}';
		}
		if(payment=='wire-transfer')
		{
			text = "{{trans('home.Wire_Transfer')}}";
			$('#actual_price_div_paypal').hide();
			$('#actual_price_div_alipay').show();
			$('.all-type-payment').show();
			$('.wire-transfer').show();	
			action = SITE_URL+'/wire-transfer/payment';	
		}
		$('#selected_payment').val(payment);
		$("#frmPayment").attr('action',action);
		$(this).each(function(){
			$(".payment-checkout").removeClass('active');
		});

		$(this).addClass('active');
		$('.pay-title').empty('');		
		$('.pay-title').append(text);		
	});

	$(".apply-payment").on('click',function()
	{
		
		var coupon_code = $('#coupon_code').val();		
		$('.coupen-section').hide();		
		if($.trim(coupon_code)=='')
		{
			$('#err_coupon_code').html(error_Please_enter_coupon_code);
			$('#coupon_code').focus();
			$('#coupon_code').keyup(function(){$('#err_coupon_code').html('');});
			return false;
		}
		else
		{
			$.ajax({
				headers:{'X-CSRF-Token':csrf_token},
				url:SITE_URL+'/check_coupen_code',
				data:{coupon_code:coupon_code},
				type:'post',
				dataType:'json',
				beforeSend:showProcessingOverlay(),
				success:function(resp)
				{
					console.log(resp);
					hideProcessingOverlay();
					if(resp.status=='invalid')
					{
						$("#coupon_code").val('');
						$('#err_coupon_code').html(error_Please_enter_valid_coupon_code);
						$('#coupon_code').focus();
						$('#coupon_code').keyup(function(){$('#err_coupon_code').html('');});
						$("#isvalid").val('invalid');						
						return false;
					}
					else if(resp.status=='used')
					{
						$("#coupon_code").val('');
						$('#err_coupon_code').html(error_This_coupon_cant_used_more_than_once);
						$('#coupon_code').focus();
						$('#coupon_code').keyup(function(){$('#err_coupon_code').html('');});
						$("#isvalid").val('invalid');						
						return false;
					}
					else if(resp.status=='expired')
					{
						$("#coupon_code").val('');
						$('#err_coupon_code').html(error_This_coupon_has_been_expired);
						$('#coupon_code').focus();
						$('#coupon_code').keyup(function(){$('#err_coupon_code').html('');});
						$("#isvalid").val('invalid');						
						return false;
					}
					else
					{
						$("#isvalid").val('');
						$('#err_coupon_code').html('');
						if(resp.owner!='admin')
						{
							$("#coupon_code_owner_id").val(resp.owner);												
						}
						var total_price_cny_amount   = '<span class="actual-price-no"> '+resp.from_currency_symbol+' '+resp.total_price_cny_amount+' </span>';
						//var discount_in_percent   = '<span class="actual-price-pay">Discount Amount('+resp.in_percent+')</span>';
						var per_currency_rate     = '<span class="actual-price-no"> '+resp.per_currency_rate+'  </span>';
						var final_amount          = '<span class="actual-price-no"> '+resp.final_converted_rate+'  </span>';
						var total_price           = '<span class="actual-price-no">'+resp.from_currency_symbol+''+resp.total_price+'</span>';
						var converted_total_price = '<span class="actual-price-no">'+resp.to_currency_symbol+''+resp.converted_total_price+'</span>';

						var discount_amount      = resp.from_currency_symbol+' '+resp.discount_amount;
						$('.actual_discount_amount').html(discount_amount);
						$('.deducted-discount-amount').html(total_price_cny_amount);
						//$('.in_percent').html(discount_in_percent);
						$('.apply-discount-amount').html(total_price);
						$('.per_currency_rate').html(per_currency_rate);
						$('.final_amount').html(final_amount);
						$('.total_price').html(total_price);
						$('.converted_total_price').html(converted_total_price);

						if(resp.is_apply_coupen == 'no')
						{
							$('.coupen-section').show();
							$('.total_price_section').show();
							$('.discount-div').hide();
						}
						else
						{
							$('.coupen-section').hide();
							$('.total_price_section').hide();
							$('.discount-div').show();
						}
						$('.conversion-section').show();
						var payment_method = $('#selected_payment').val();
						console.log(payment_method);
						if(payment_method!='wire-transfer')
						{
							$('.wire-transfer').hide();
						}
						//alert(resp.without_symbol_converted_total_price);
						
						$("#total_price_cny_amount").val(resp.total_price_cny_amount);
						$("#converted_total_price").val(resp.converted_total_price);
						$("#discount_amount").val(resp.discount_amount);							
						$("#per_unit_conversion_rate").val(resp.without_symbol_per_currency_rate);
						$("#from_currency").val(resp.from_currency);
						$("#to_currency").val(resp.to_currency);

						return true;
					}
				}
			});			
		}
	});

	$("#coupon_code").on('keyup',function(){
		var coupon_code = $(this).val();

		if($.trim(coupon_code)=='')
		{
			$(this).val('');
			$('.coupen-section').hide();

			$('#converted_total_price').val('{{ $converted_total_price or '' }}');
		}
	});
	//4283
	$('.deduct-from-insentive').on('click',function(){

		var coupon_code_owner_id     = $("#coupon_code_owner_id").val();
		var coupon_code              = $("#coupon_code").val();
		var payable_cny_amount       = $("#total_price_cny_amount").val();
		var converted_total_price    = $("#converted_total_price").val();
		var per_unit_conversion_rate = $("#per_unit_conversion_rate").val();


		window.location.href=SITE_URL+'/deduct_from_insentive_amount?coupon_code_owner_id='+coupon_code_owner_id+'&coupon_code='+coupon_code+'&payable_cny_amount='+payable_cny_amount+'&converted_total_price='+converted_total_price+'&per_unit_conversion_rate='+per_unit_conversion_rate;		
	});
	$('#frmPayment').submit(function() {
   			showProcessingOverlay();
	});

</script>
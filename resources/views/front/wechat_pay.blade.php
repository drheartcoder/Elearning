@if(isset($plan_details_arr) && count($plan_details_arr)>0)
@php

	//date_default_timezone_set("Asia/Shanghai");
	require_once base_path()."/Wechat/lib/WxPay.Api.php";
	require_once base_path()."/Wechat/example/WxPay.NativePay.php";
	require_once base_path()."/Wechat/example/log.php";

	//初始化日志

	$logHandler = new CLogFileHandler(base_path()."/Wechat/logs/".date('Y-m-d').'.log');
	$log 		= Log::Init($logHandler, 15);
	$notify 	= new NativePay();
	$input  	= new WxPayUnifiedOrder();
	$input->SetBody(isset($plan_details_arr['slug']) && $plan_details_arr['slug']!='' ? $plan_details_arr['slug'] : "");
	$input->SetAttach($plan_details_arr['uniq_id']);
	$input->SetOut_trade_no(Session::get('membership.plan_id').date("YmdHis"));
	$input->SetTotal_fee((float)Session::get('membership.total_price_cny_amount')*100);
	$input->SetTime_start(date("YmdHis"));
	$input->SetTime_expire(date("YmdHis", time() + 11000));
	$input->SetGoods_tag(isset($plan_details_arr['slug']) && $plan_details_arr['slug']!='' ? $plan_details_arr['slug'] : "");
	$input->SetNotify_url("https://meritted.com/wechat/callback");
	$input->SetTrade_type("NATIVE");
	$input->SetProduct_id(Session::get('membership.plan_id'));
	$result = $notify->GetPayUrl($input);

	if (isset($result["code_url"])) {
		$qr_code_url = $result["code_url"];
	}else{
		$qr_code_url = "";
	}
@endphp
<!-- bredcrum section -->
<div class="bredcrum-section-main">
	<div class="container">
		<div class="page-title-main">
			{{trans('home.WeChat_Pay')}}
		</div>
		<div class="page-bredcrum-section">
			 <!--<ul>
                <li><a href="{{url('/')}}">{{trans('home.Home')}}</a> &nbsp;&nbsp; <i class="fa fa-angle-right"></i> &nbsp;&nbsp; </li>
                <li><a href="{{ URL::previous() }}">{{trans('home.Payment')}}</a> &nbsp;&nbsp; <i class="fa fa-angle-right"></i> &nbsp;&nbsp; </li>
                <li>{{trans('home.Wechat_pay')}}</li>
            </ul>-->
		</div>
		<div class="clearfix"></div>
	</div>
</div>
<!-- bredcrum section end -->
<div class="payment-paypal-section gray-btn-main-section">
	<div class="container">
		@include('front.layout._operation_status')
			<div class="qr-code-section text-center">
			    <h2><i class="fab fa-weixin"></i>{{trans('home.WeChat_Pay')}}</h2>
			    <div class="qr-code-block">
			        <h4>Scan this QR code</h4>
			        <div class="qr-code"><img src="../../Wechat/example/qrcode.php?data={{urlencode($qr_code_url)}}" style="width:220px;height:220px;" class="img-responsive" alt="QR Code"/></div>
			        <div class="price">Total Price <span>¥ {{Session::get('membership.total_price_cny_amount')}}</span></div>
			    </div>
			</div>		
	</div>
</div>
<script type="text/javascript">
	 
	 setInterval(function(){
	 	checkTransaction();
	 }, 3000);

	 function checkTransaction(){
        var csrf_token = '{{csrf_token()}}';
        var uniq_id    = '{{$plan_details_arr["uniq_id"]}}';
        $.ajax({
            headers:{'X-CSRF-Token': csrf_token},
            url:'{{url("/")}}/wechat/checkTransaction',                    
            type:'post',                
            data:{
            		'uniq_id' : uniq_id,
            	 },
            success:function(res)   
            {
            	console.log($.trim(res.msg));
                if($.trim(res.msg)=='success')
                {   
                    window.location.href=res.redirect_url;  
                }
            }
        });
	 }
</script>
@endif
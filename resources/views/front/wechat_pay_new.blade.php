@if(isset($plan_details_arr) && count($plan_details_arr)>0)
	@php
	$arr_membership_details = json_encode(Session::get('membership'));
	
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
	$input->SetAttach($arr_membership_details);
	$input->SetOut_trade_no(Session::get('membership.plan_id').Session::get('membership.userid').date("YmdHis"));
	$input->SetTotal_fee(Session::get('membership.total_price_cny_amount'));
	$input->SetTime_start(date("YmdHis"));
	$input->SetTime_expire(date("YmdHis", time() + 600));
	$input->SetGoods_tag(isset($plan_details_arr['slug']) && $plan_details_arr['slug']!='' ? $plan_details_arr['slug'] : "");
	$input->SetNotify_url("http://meritted.com/wechat/callback");
	$input->SetTrade_type("NATIVE");
	$input->SetProduct_id(Session::get('membership.plan_id'));
	$result = $notify->GetPayUrl($input);

	if (isset($result["code_url"])) {
		$qr_code_url = $result["code_url"];
	}else{
		$qr_code_url = "";
	}
	@endphp
	<html>
	<head>
	    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
	    <meta name="viewport" content="width=device-width, initial-scale=1" /> 
	    <title>QR Code Scan Method</title>
	</head>
	<body>
		<div style="margin-left: 10px;color:#556B2F;font-size:30px;font-weight: bolder;">QR Code Scan Method</div><br/>
		<img alt="QR Code Scan Method" src="../Wechat/qrcode.php?data={{urlencode($qr_code_url)}}" style="width:150px;height:150px;"/>
		<div style="color:#ff0000"><b>Please Scan the code</b></div>
	</body>
	</html>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.js"></script>
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
	            	console.log($.trim(res));
	                if($.trim(res.msg)=='success')
	                {   
	                    window.location.href=res.redirect_url;  
	                }
	            }
	        });
		 }
	</script>
@endif
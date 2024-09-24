$(document).ready(function()
{
	/*Check Email duplication*/
	$(".chk_email").on("blur", function()	
	{
		var email = $("#email").val();
		var user_id = $("#user_id").val();
		var token = $("input[name=_token]").val();
		var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		var flag   = 1;

		if($.trim(email)=='')  
		{
			$("#err_email").html("Please enter email id");
			$("#email").on('keyup',function(){ $("#err_email").html("");});
			flag = 0;
			return false;
		}
		else if(!filter.test($.trim(email)))
		{
			$("#err_email").html("Please enter valid email id");
			$("#email").on('keyup',function(){ $("#err_email").html("");});
			flag = 0;
			return false;
		}
		else
		{
			$.ajax({
				headers:{'X-CSRF-Token': csrf_token},
				url       : SITE_URL+'/common/check_email_duplicate',
				type      : "post",
				dataType  : 'json',
				data : {email:email,user_id:user_id},
				beforeSend:function(){

				},
				success:function(resp)
				{ 
					if(resp.status=="exist" && resp.msg!="")
					{
						$("#err_email").html(resp.msg);
						$("#email").focus();
						$("#isvalid").val('invalid');
					}				
					else
					{	                
						$("#err_email").html('');					
						$("#isvalid").val('');
					}					
				}
			});
		}
	});
});
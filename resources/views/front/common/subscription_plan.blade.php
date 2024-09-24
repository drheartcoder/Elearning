<div class="get-access-child-main">
    <div class="get-access-child-head">
        {{trans('home.Get_Great_Access_for_Your_Child_Invest_in_Your_Childs_Future')}} !
    </div>            
    <input type="hidden" name="check_signup" id="check_signup" value="{{Request::get('url')}}">
    <div class="row">

        <?php 
            $arr_transactions=$user=[];  
            $is_user_login = false;                
            if(Auth::check()!=false)
            {
                $is_user_login = true;
                $user = Auth::user();
                if($user->user_type=='parent')
                {
                    $arr_transactions = getActiveMembershipPlan(Auth::id()); 
                    $userid = base64_encode(Auth::id());
                } 
               
            } 

            ?>

        @if(isset($pricingData) && count($pricingData)>0)    
            @foreach($pricingData as $row)
            <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3 responsive-change-section">
                <div class="price-block-section {{ (isset($arr_transactions['plan_id']) && $arr_transactions['plan_id']!='' && $arr_transactions['plan_id']==$row['id']) ? 'active' : '' }}">
                    <div class="price-top-gray-block"></div>
                    <div class="year-count-section">
                        <div class="year-count-content">
                            <?php 
                            $arr = [];
                            if(isset($row['name']) && $row['name']!="")
                            {
                                 $arr = explode(' ', $row['name']);
                            }
                           ?>
                            @if(isset($arr) && count($arr)>0)
                            {{$arr[0] or ''}}
                            <br>
                            <span>{{$arr[1] or ''}}</span>                                            
                            @endif
                            <!-- 1 <br> <span>Year</span> -->
                        </div>                                
                    </div>
                    <div class="pricing-price-btn-section">
                        <div class="pricing-old-price-section">
                            <div class="old-price-one">
                               {!! $currency_symbol or '' !!}  {{$row['total_cancel_price'] or ''}}
                            </div>
                            <div class="old-price-one">
                               {!! $currency_symbol or '' !!}  {{$row['cancel_price_per_day'] or ''}} / day
                            </div>
                        </div>
                        <div class="pricing-new-price-section">
                            <div class="new-price-one">
                               {!! $currency_symbol or '' !!}  {{$row['plan_price'] or ''}}
                            </div>
                            <div class="new-price-one">
                               {!! $currency_symbol or '' !!}  {{$row['plan_price_per_day'] or '' }} / day
                            </div>
                        </div>
                        <div class="pay-once-text-section">
                            {{$row['details'] or ''}}
                        </div>


                        @if(isset($arr_transactions) && count($arr_transactions)>0)

                            {{-- @if($arr_transactions['plan_id'] == $row['id'])

                            <a class="full-fill-button border-button sim-button-blue pricing-join-btn">Activated</a>

                            @elseif($arr_transactions['plan_id'] <= $row['id']) --}}
                            @if($row['id'] == 4 && $arr_transactions['plan_id']==$row['id'])
                                <a class="full-fill-button border-button sim-button-blue pricing-join-btn">Activated</a>
                            @elseif($arr_transactions['plan_id']!=4)
                                 @if(isset($arr_transactions['payment_via']) && $arr_transactions['payment_via']=='offline' && $arr_transactions['payment_status']=='unpaid' && $arr_transactions['plan_id']==$row['id'])
                                    <a id="btn_checkout_{{$row['id']}}" class="full-fill-button border-button sim-button-blue pricing-join-btn ">Request Sent
                                    </a>
                                 @else
                                    <a id="btn_checkout_{{$row['id']}}" data-plan_id="{{$row['id']}}" data-userid="{{isset($userid) && $userid!='' ? $userid : ''}}" data-usertoken="{{isset($usertoken) && $usertoken!='' ? $usertoken : ''}}" class="full-fill-button border-button sim-button-blue pricing-join-btn checkout">Upgrade
                                    </a>
                                @endif
                            @endif
                            {{-- @endif --}}

                        @else

                        @if(Auth::check()!=false && $user->user_type!='parent')
                            <a href="javascript:void(0);" class="full-fill-button border-button sim-button-blue pricing-join-btn invalid-user">Join</a>
                        @else
                            <a id="btn_checkout_{{$row['id']}}" data-plan_id="{{$row['id']}}" data-userid="{{isset($userid) && $userid!='' ? $userid : ''}}" data-usertoken="{{isset($usertoken) && $usertoken!='' ? $usertoken : ''}}" class="full-fill-button border-button sim-button-blue pricing-join-btn checkout">Join</a>

                        @endif

                        @endif
                        
                    </div>
                </div>
            </div>
            @endforeach
        @endif             
    </div>
</div>
<script type="text/javascript">
  $(".checkout").on('click',function(){
    var plan_id          = $(this).data("plan_id");
    var user_login_id    = $(this).data("userid");
    var usertoken        = $(this).data("usertoken");
    var sendingRequest=null;                
    sendingRequest = $.ajax({
            headers   : {'X-CSRF-Token': csrf_token},  
            url       : SITE_URL+'/store_checkout_data', 
            type      : "post",       
            dataType  : 'json',        
            data      : {plan_id:plan_id,userid:user_login_id,usertoken:usertoken},
            beforeSend:function(data, statusText, xhr, wrapper)
            {
              if(sendingRequest != null){
                swal("Server busy please wait.");
                return false;
              }
              $("#btn_checkout"+plan_id).attr('disabled', true);   
              $("#btn_checkout"+plan_id).html('Processing...<i style="font-size:30px;color:#1f4e78;text-align: center;" class="fa fa-spinner fa-pulse"></i><span class="bigger-110"></span>');
            },
            success   :function (data, statusText, xhr, wrapper) 
            {
                sendingRequest = null;
                if(data.status == 'success')
                {
                    $("#btn_checkout"+plan_id).attr('disabled', false);                                                          
                    if(user_login_id!='')
                    {                        
                        location.href=SITE_URL+'/payment/checkout';
                    }
                    else if(data.is_social=='yes')
                    {
                        location.href=SITE_URL+'/payment/checkout';
                    }
                    else
                    {   
                        location.href=SITE_URL+'/signup';
                    }
                } 
            }
        });
  });

  $('.invalid-user').on('click',function(){
    swal("","Your are not a valid user to purchase plan" ,"error");
  });

</script>
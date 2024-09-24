<table width="100%" border="0" cellspacing="0" cellpadding="5" style="border:0px solid #ddd;font-family:Arial, Helvetica, sans-serif;">

<tr>
    <td width="80%"><img src="<?php if(isset($Data) && count($Data)>0) { echo $Data['logo']; }?>" width="200px" alt=""/></td>
    <td>
          <table width="100%" border="0" cellspacing="0" cellpadding="5" style="font-size:14px;">
            <tr>
                <td width="35%"><b style="text-align: right;display: block;"><span style="float: left;">Invoice No.</span> : </b><div style="clear:both"></div></td>
                <td><?php if(isset($TrasactionData) && count($TrasactionData)>0){ echo "ID ".$TrasactionData->id; }?></td>
            </tr>             
            <tr>
                <td width="35%"><b style="text-align: right;display: block;"><span style="float: left;">Date</span> : </b><div style="clear:both"></div></td>
                <td><?php echo date('d-m-Y'); ?></td>
            </tr>
          
        </table>
    </td>
</tr>
<tr>
    <td style="height:50px"></td>
    <td style="height:50px"></td>
</tr>
<tr>
     <td width="60%">
        <table width="100%" border="0" cellspacing="0" cellpadding="5" style="font-size:14px;">         
         
                <tr>
                    <td style="width:20%;vertical-align: top;"><b style="text-align: right;display: block;"><span style="float: left;">To</span> : </b><div style="clear:both"></div></td>
                    <td style="vertical-align: top;"><?php if(isset($SenderData) && count($SenderData)>0) {  echo ucfirst($SenderData->first_name.' '.$SenderData->last_name);  }?></td>
                </tr>
                <tr>
                    <td style="width:20%;vertical-align: top;"><b style="text-align: right;display: block;"><span style="float: left;">Email ID</span> : </b><div style="clear:both"></div></td>
                    <td style="vertical-align: top;"><?php if(isset($SenderData) && count($SenderData)>0) { echo $SenderData->email; }?></td>
                </tr>             
            
        </table>
    </td>
    <td style="font-size:14px;">
        <table width="100%" border="0" cellspacing="0" cellpadding="5">    
             <tr>
                 <td style="width:30%;vertical-align: top;"><b style="text-align: right;display: block;"><span style="float: left;">From</span> : </b><div style="clear:both"></div></td>               
                 <td style="vertical-align: top;">
                   <div>
                    <?php if(isset($ReceivedData) && count($ReceivedData)>0) { echo ucfirst($ReceivedData->site_name); }?>
                     </div>
                    <div><?php if(isset($ReceivedData) && count($ReceivedData)>0) { echo $ReceivedData->site_email_address; }?></div>
                    <div>
                    <?php if(isset($ReceivedData) && count($ReceivedData)>0) { echo $ReceivedData->site_contact_number; }?> </div>                    
                 </td>
            </tr>
        </table>    
    </td>
</tr>
<tr>
    <td style="height:50px"></td>
    <td style="height:50px"></td>
</tr>
<tr>
    <td width="100%" colspan="2">
        <table width="100%" border="1" cellspacing="0" cellpadding="5" style="border-color:#ddd;">
            <tr>
                <td style="padding:10px;background-color: #f1f1f1;font-size:9px;font-weight: bold;text-align: center;">Plan Title</td>
                <td style="padding:10px;background-color: #f1f1f1;font-size:9px;font-weight: bold;text-align: center;">Validity(In Year)</td>                
                <td style="padding:10px;background-color: #f1f1f1;font-size:9px;font-weight: bold;text-align: center; ">Plan Start Date</td>
                <td style="padding:10px;background-color: #f1f1f1;font-size:9px;font-weight: bold;text-align: center;">Plan End Date</td>
                <td style="padding:10px;background-color: #f1f1f1;font-size:9px;font-weight: bold;text-align: center; ">Plan Price(CNY)</td>
                <?php if(isset($TrasactionData) && count($TrasactionData)>0 && $TrasactionData->discount_amount!=null) { ?>
                <td style="padding:10px;background-color: #f1f1f1;font-size:9px;font-weight: bold;text-align: center; ">Discount(CNY)</td>
                <?php } ?>

                <?php if(isset($TrasactionData) &&  $TrasactionData->coupon_code!=null) { ?>
                <td style="padding:10px;background-color: #f1f1f1;font-size:9px;font-weight: bold;text-align: center;">coupon Code</td>
                <?php } ?>

                <?php if(isset($TrasactionData) &&  $TrasactionData->payment_via!=null) { ?>
                <td style="padding:10px;background-color: #f1f1f1;font-size:9px;font-weight: bold;text-align: center;">Payment Via</td>
                <?php } ?>

                 <?php if(isset($TrasactionData) &&  $TrasactionData->payment_via=='paypal') 
                 { ?>
                    <td style="padding:10px;background-color: #f1f1f1;font-size:9px;font-weight: bold;text-align: center;">Total Price(USD)</td>
                <?php  
                 }
                else
                 {

                    ?>
                 <td style="padding:10px;background-color: #f1f1f1;font-size:9px;font-weight: bold;text-align: center;">Total Price(CNY)</td>
                    <?php
                } ?>
               

               

            </tr>
            <tr>
                <td style="padding:10px;font-size:9px;text-align: center;"><?php if(isset($TrasactionData) && count($TrasactionData)>0) { echo $TrasactionData->name; }?> </td>
                <td style="padding:10px;font-size:9px;text-align: center;"><?php if(isset($TrasactionData) && count($TrasactionData)>0) { echo $TrasactionData->validity; }?></td>                
                <td style="padding:10px;font-size:9px;text-align: center; ">

                    <?php if(isset($TrasactionData->transaction_date) && $TrasactionData->transaction_date!="" && $TrasactionData->transaction_date!='0000-00-00') 
                    { echo date('d-m-Y',strtotime($TrasactionData->transaction_date)); }
                    ?>
                        
                    </td>
                <td style="padding:10px;font-size:9px;text-align: center;">
                    <?php if(isset($TrasactionData->expiry_date) && $TrasactionData->expiry_date!="" && $TrasactionData->expiry_date!='0000-00-00') 
                        { echo date('d-m-Y',strtotime($TrasactionData->expiry_date)); }
                         else
                        { echo "unlimited"; }
                    ?>      
                </td>
                <td style="padding:10px;font-size:9px;text-align: center; "><?php if(isset($TrasactionData) && count($TrasactionData)>0) { echo $TrasactionData->amount; }?></td>

                <?php if(isset($TrasactionData) && count($TrasactionData)>0 && $TrasactionData->discount_amount!=null) { ?>
                <td style="padding:10px;font-size:9px;text-align: center; "><?php if(isset($TrasactionData) && count($TrasactionData)>0) { echo $TrasactionData->discount_amount; }?></td>
                <?php } ?>

                <?php if(isset($TrasactionData) &&  $TrasactionData->coupon_code!=null) { ?>
                 <td style="padding:10px;font-size:9px;text-align: center; "><?php  { echo $TrasactionData->coupon_code; }?></td>
                <?php } ?>


                <?php if(isset($TrasactionData) &&  $TrasactionData->payment_via!=null) { ?>
                <td style="padding:10px;font-size:9px;text-align: center;"><?php  { echo $TrasactionData->payment_via; }?></td>
                <?php } ?>

            
                  <?php if(isset($TrasactionData) &&  $TrasactionData->payment_via=='paypal') 
                  { ?>

                     <td style="padding:10px;font-size:9px;text-align: center; "><?php if(isset($TrasactionData) && count($TrasactionData)>0) { echo $TrasactionData->total_converted_amount; }?></td>
                  <?php
                  }
                  else
                  {
                    ?>
                    <td style="padding:10px;font-size:9px;text-align: center; "><?php if(isset($TrasactionData) && count($TrasactionData)>0 && isset($TrasactionData->discount_amount)) { echo ($TrasactionData->amount-$TrasactionData->discount_amount); } else { echo $TrasactionData->amount; } ?></td>
                   <?php 
                  }
                  ?>
            </tr>
            <!-- <tr>
                <?php 
                 if(isset($TrasactionData) && count($TrasactionData)>0 && $TrasactionData->coupon_code!=null) 
                      { echo $col = '8';}
                 else
                      { echo $col = '6';  }?>

                 <td colspan="<?php echo $col; ?>" style="padding:10px;text-align: right; font-size:9px;font-weight: bold;">Total Price </td>
                 <td  style="padding:10px;text-align: center; font-size:9px;font-weight: bold;"><?php if(isset($TrasactionData) && count($TrasactionData)>0) { echo $TrasactionData->total_converted_amount; }?> </td>
            </tr> -->
        </table>
    </td>
</tr>
</table>


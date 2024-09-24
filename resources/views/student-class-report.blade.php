<table width="100%" border="0" cellspacing="0" cellpadding="5" style="border:0px solid #ddd;font-family:Arial, Helvetica, sans-serif;">

<tr>
    <td><img src="{{url('/images/logo.png')}}" width="100px" alt=""/></td>    
</tr>

<tr>
     <td width="50%">
        <table width="100%" border="0" cellspacing="0" cellpadding="5" style="font-size:9px;">         
         
                <tr>
                    <td width="35%"><b>To : </b></td>
                    <td width="65%"><?php if(isset($SenderData) && count($SenderData)>0) {  echo ucfirst($SenderData->first_name.' '.$SenderData->last_name);  }?></td>
                </tr>
                <tr>
                    <td width="35%"><b>Email ID : </b></td>
                    <td width="65%"><?php if(isset($SenderData) && count($SenderData)>0) { echo $SenderData->email; }?></td>
                </tr>
                <tr>
                    <td width="35%"><b>Address : </b></td>
                    <td width="65%"><?php if(isset($SenderData) && count($SenderData)>0) { echo $SenderData->address;  }?></td>
                </tr>
            
        </table>
    </td>   
</tr>
<tr>
    <td width="100%" >
        <table width="100%" border="1" cellspacing="0" cellpadding="5" style="border-color:#ddd;">
            <tr>
                <td style="background-color: #f1f1f1;font-size:9px;font-weight: bold;text-align: center;">Plan Title</td>
                <td style="background-color: #f1f1f1;font-size:9px;font-weight: bold;text-align: center;">Validity(In Year)</td>
                <td style="background-color: #f1f1f1;font-size:9px;font-weight: bold;text-align: center;">Child Limit</td>
                <td style="background-color: #f1f1f1;font-size:9px;font-weight: bold;text-align: center; ">Plan Start Date</td>
                <td style="background-color: #f1f1f1;font-size:9px;font-weight: bold;text-align: center;">Plan End Date</td>
                <td style="background-color: #f1f1f1;font-size:9px;font-weight: bold;text-align: center; ">Price</td>
            </tr>
            <tr>
                <td style="font-size:9px;text-align: center;"><?php if(isset($TrasactionData) && count($TrasactionData)>0) { echo $TrasactionData->name; }?> </td>
                <td style="font-size:9px;text-align: center;"><?php if(isset($TrasactionData) && count($TrasactionData)>0) { echo $TrasactionData->validity; }?></td>
                <td style="font-size:9px;text-align: center;"><?php if(isset($TrasactionData) && count($TrasactionData)>0) { echo $TrasactionData->child_limit; }?></td>
                <td style="font-size:9px;text-align: center; "><?php if(isset($TrasactionData) && count($TrasactionData)>0) { echo date('d-m-Y',strtotime($TrasactionData->transaction_date)); }?></td>
                <td style="font-size:9px;text-align: center;"><?php if(isset($TrasactionData) && count($TrasactionData)>0) { echo date('d-m-Y',strtotime($TrasactionData->expiry_date)); }?></td>
                <td style="font-size:9px;text-align: center; "><?php if(isset($TrasactionData) && count($TrasactionData)>0) { echo $TrasactionData->amount; }?></td>
            </tr>
            <tr>
                 <td colspan="5" style="text-align: right; font-size:9px;font-weight: bold;">Total Price </td>
                 <td style="text-align: center; font-size:9px;font-weight: bold;"><?php if(isset($TrasactionData) && count($TrasactionData)>0) { echo $TrasactionData->amount; }?> USD</td>
            </tr>
        </table>
    </td>
</tr>
</table>


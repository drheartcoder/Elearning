<table width="100%" border="0" cellspacing="0" cellpadding="5" style="border:0px solid #ddd;font-family:Arial, Helvetica, sans-serif;">
<tr>
    <td><img src="{{url('/images/logo.png')}}" width="100px" alt=""/></td>
</tr>    
<tr>
    <td width="100%">
        <table width="100%" border="0" cellspacing="0" cellpadding="5" style="font-size:9px;">         
            <tr>
                <td style="background-color: #f1f1f1;font-size:16px;font-weight: bold;text-align: center;">Student Name</td>
                <td style="background-color: #f1f1f1;font-size:16px;font-weight: bold;text-align: center;">Pin</td>                    
            </tr>     
            @if(isset($student_info) && count($student_info)>0)
                @foreach($student_info as $row)                
                <tr>
                    <td style="font-size:14px;text-align: center;">{{ ucfirst($row['student_data']['first_name'].' '.$row['student_data']['last_name']) }}</td>
                    <td style="font-size:14px;text-align: center;">{{ $row['student_data']['pin'] }}</td>
                </tr>
                @endforeach
            @endif
        </table>
    </td>    
</tr>
</table>


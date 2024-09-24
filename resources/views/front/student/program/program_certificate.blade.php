<!-- bredcrum section -->
<div class="bredcrum-section-main">
    <div class="container">
        <div class="page-title-main">
            {{$pageTitle}}
        </div>
        <div class="page-bredcrum-section">
            <ul>
                <li><a href="{{ url('/') }}/student/dashboard">{{trans('parent.Dashboard')}}</a> &nbsp;&nbsp; <i class="fa fa-angle-right"></i> &nbsp;&nbsp; </li>
                <li>{{$pageTitle}}</li>
            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!-- bredcrum section end -->
    <div class="gray-btn-main-section page-middle-section">
        <div class="container">  
            <div class="row">
                <div class="col-sm-4 col-md-3 col-lg-3">
                @include('front.layout.left_bar')
                </div>
                <div class="col-sm-8 col-md-9 col-lg-9">
                    @include('front.layout._operation_status')
                    <div class="class-name-head-section">
                        {{ $pageTitle }}
                    </div>
                        <br><br><br><br>
                        <div id="DivIdToPrint">
                            <table style="font-family: Arial, Helvetica, sans-serif; font-size: 14px;background-position: center 0;" width="100%" cellspacing="0" cellpadding="0" border="0">
                                <tbody>
                                <tr>
                                <td style="text-align: center; padding: 0px 30px; background-image: url('../../../images/certificate-merit-top.png'); background-repeat: no-repeat;background-position: center top;" height="60px">&nbsp;</td>
                                </tr>
                                <tr>
                                <td style="text-align: center; padding: 10px 30px; background-image: url('../../../images/cetificate-middal.png'); background-repeat: repeat-y;background-position: center center;"><img src="../../images/emailer-logo.png" alt="" /></td>
                                </tr>
                                <tr>
                                <td style="text-align: center; padding: 0px 30px; background-image: url('../../../images/cetificate-middal.png'); background-repeat: repeat-y;background-position: center center;" height="20px">&nbsp;</td>
                                </tr>
                                <tr>
                                <td style="text-align: center; padding: 10px 30px; background-image: url('../../../images/cetificate-middal.png'); background-repeat: repeat-y; font-size: 30px;background-position: center center;">Certificate of Achievement in<br /> &nbsp;&nbsp;&nbsp;<center><span style="border-bottom: 1px solid #ccc; display: inline-block; width: 300px; margin: 0 auto;">{{$program_name}}</span></center>&nbsp;&nbsp;&nbsp;</td>
                                </tr>
                                <tr>
                                <td style="text-align: center; padding: 20px 30px; background-image: url('../../../images/cetificate-middal.png'); background-repeat: repeat-y; font-size: 16px;background-position: center center;"><center>for demonstrating mastery of the subtraction table by answering all <br /> <span style="display: inline-block;">Subtraction facts in under</span> &nbsp;&nbsp;&nbsp;<span style="border-bottom: 1px solid #ccc; display: inline-block;">{{date('i',strtotime($total_time))}}</span> &nbsp;&nbsp;&nbsp;<span>Minutes</span> &nbsp;&nbsp;&nbsp;<span style="border-bottom: 1px solid #ccc; display: inline-block;">{{date('s',strtotime($total_time))}}</span> &nbsp;&nbsp;&nbsp;<span>Seconds</span></center></td>
                                </tr>
                                <tr>
                                <td style="text-align: center; padding: 10px 30px; background-image: url('../../../images/cetificate-middal.png'); background-repeat: repeat-y;background-position: center center;" height="20px">&nbsp;</td>
                                </tr>
                                <tr>
                                <td style="text-align: center; padding: 10px 30px; background-image: url('../../../images/cetificate-middal.png'); background-repeat: repeat-y; font-size: 40px;background-position: center center;">Congratulations</td>
                                </tr>
                                <tr>
                                <td style="text-align: center; padding: 20px 30px; background-image: url('../../../images/cetificate-middal.png'); background-repeat: repeat-y;background-position: center center;" height="10px">&nbsp;</td>
                                </tr>
                                <tr>
                                <td style="text-align: center; padding: 10px 30px; background-image: url('../../../images/cetificate-middal.png'); background-repeat: repeat-y; font-size: 14px;background-position: center center;"><strong>{{$student_name}}</strong> <br /> STUDENT</td>
                                </tr>
                                <tr>
                                <td style="text-align: center; padding: 10px 30px; background-image: url('../../../images/cetificate-middal.png'); background-repeat: repeat-y;background-position: center center;" height="10px">&nbsp;</td>
                                </tr>
                                @if(isset($teacher_name) && $teacher_name!='')
                                <tr>
                                    <td style="text-align: center; padding: 10px 30px; background-image: url('../../../images/cetificate-middal.png'); background-repeat: repeat-y; font-size: 14px;background-position: center center;"><strong>{{$teacher_name}}</strong> <br /> TEACHER</td>
                                    </tr>
                                <tr>
                                @endif
                                <td style="text-align: center; padding: 10px 30px; background-image: url('../../../images/cetificate-middal.png'); background-repeat: repeat-y;background-position: center center;" height="10px">&nbsp;</td>
                                </tr>
                                <tr>
                                <td style="text-align: center; padding: 10px 30px; background-image: url('../../../images/cetificate-middal.png'); background-repeat: repeat-y; font-size: 14px;background-position: center center;"><strong>{{$date}}</strong> <br /> DATE</td>
                                </tr>
                                <tr>
                                <td style="text-align: center; padding: 10px 30px; background-image: url('../../../images/certificate-merit-footer.png'); background-repeat: no-repeat;background-position: center 0;" height="60px">&nbsp;</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <br>
                        <center><button class="full-fill-button sim-button" onclick="PrintElem()"><i class="fa fa-print"></i> {{trans('parent.Print')}}</button></center>
                </div>
            </div>
        </div>
    </div>

<script type="text/javascript">
function PrintElem(elem)
{
    var mywindow = window.open('', 'PRINT', 'height=400,width=600');

    mywindow.document.write('<html><head><title>' + document.title  + '</title>');
    mywindow.document.write('</head><body >');
    mywindow.document.write('<h1>' + document.title  + '</h1>');
    mywindow.document.write(document.getElementById('DivIdToPrint').innerHTML);
    mywindow.document.write('</body></html>');

    mywindow.document.close(); // necessary for IE >= 10
    mywindow.focus(); // necessary for IE >= 10*/

    mywindow.print();
    mywindow.close();

    return true;
}

jQuery(document).ready(function($) {
  if (window.history && window.history.pushState) {
        window.history.pushState('forward', null, '');
        $(window).on('popstate', function() {
            window.location.reload();
        });
    }
});
</script>
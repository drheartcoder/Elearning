@if(isset($arr_question) && count($arr_question)>0)
@php
    $arr_time = explode(':',$arr_question['duration']);
    $minutes  = $arr_time['1'];
    $seconds  = $arr_time['2'];
@endphp
@php $uniqid = uniqid();  @endphp 
@php
    $arr_position = [];
    $arr_question_text = [];
    
    if(isset($arr_question['answer']) && $arr_question['answer']!='')
    {
        $arr_position = explode(',',$arr_question['answer']);
    }
    if(isset($arr_question['question_text']) && $arr_question['question_text']!='')
    {
        $arr_question_text = explode(',', $arr_question['question_text']);
    }
@endphp
  
  <link href="{{ url('/') }}/css/admin/template-css.css" rel="stylesheet" type="text/css" />

    <!--middle section-->
    <div class="middle-section temp-41-main-section temp-47-main-section">
        <div class="container">
            <div class="fill-in-the-blank-section">
                <div class="question-section">
                    <div class="question-txt-section">
                        <i class="fa fa-angle-double-right"></i> {{isset($arr_question['question']) && $arr_question['question']!='' ? ucwords($arr_question['question'])." : " : "N/A" }} <br>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-mg-12 col-lg-12">
                        @if(count($arr_question_text)>0 && count($arr_position)>0)
                            <div class="game-img-section">
                                <div class="eqation-table">
                                       <table>
                                                <tr>
                                                    <td class="td-input">
                                                    @if($arr_position[0]==1)
                                                        {{$arr_question_text[0]}}
                                                    @else
                                                      <input class="actual-ans" type="text" style="text-align: center;" placeholder="{{$arr_question_text[0]}}" disabled="true" data-answer="{{$arr_question_text[0]}}" name="question1" maxlength="{{strlen($arr_question_text[0])}}">
                                                    @endif
                                                    </td>
                                                    <td class="td-input">
                                                    @if($arr_position[1]==1)
                                                        {{$arr_question_text[1]}}
                                                    @else
                                                      <input class="actual-ans" type="text" style="text-align: center;" placeholder="{{$arr_question_text[1]}}" disabled="true" data-answer="{{$arr_question_text[1]}}" name="question2" maxlength="{{strlen($arr_question_text[1])}}">
                                                    @endif
                                                    </td>
                                                    <td class="td-input">
                                                    @if($arr_position[2]==1)
                                                        {{$arr_question_text[2]}}
                                                    @else
                                                      <input class="actual-ans" type="text" style="text-align: center;" placeholder="{{$arr_question_text[2]}}" disabled="true" data-answer="{{$arr_question_text[2]}}" name="question3" maxlength="{{strlen($arr_question_text[2])}}">
                                                    @endif
                                                    </td>
                                                    <td class="td-input">
                                                    @if($arr_position[3]==1)
                                                        {{$arr_question_text[3]}}
                                                    @else
                                                      <input class="actual-ans" type="text" style="text-align: center;" placeholder="{{$arr_question_text[3]}}" disabled="true" data-answer="{{$arr_question_text[3]}}" name="question4" maxlength="{{strlen($arr_question_text[3])}}">
                                                    @endif
                                                    </td>
                                                    <td class="td-input">
                                                    @if($arr_position[4]==1)
                                                        {{$arr_question_text[4]}}
                                                    @else
                                                      <input class="actual-ans" type="text" style="text-align: center;" placeholder="{{$arr_question_text[4]}}" disabled="true" data-answer="{{$arr_question_text[4]}}" name="question5" maxlength="{{strlen($arr_question_text[4])}}">
                                                    @endif
                                                    </td>
                                                    <td></td>
                                                    <td class="td-input">
                                                    @if($arr_position[5]==1)
                                                        {{$arr_question_text[5]}}
                                                    @else
                                                      <input class="actual-ans" type="text" style="text-align: center;" placeholder="{{$arr_question_text[5]}}" disabled="true" data-answer="{{$arr_question_text[5]}}" name="question6" maxlength="{{strlen($arr_question_text[5])}}">
                                                    @endif
                                                    </td>
                                                    <td class="td-input">
                                                    @if($arr_position[6]==1)
                                                        {{$arr_question_text[6]}}
                                                    @else
                                                      <input class="actual-ans" type="text" style="text-align: center;" placeholder="{{$arr_question_text[6]}}" disabled="true" data-answer="{{$arr_question_text[6]}}" name="question7" maxlength="{{strlen($arr_question_text[6])}}">
                                                    @endif
                                                    </td>
                                                    <td class="td-input">
                                                    @if($arr_position[7]==1)
                                                        {{$arr_question_text[7]}}
                                                    @else
                                                      <input class="actual-ans" type="text" style="text-align: center;" placeholder="{{$arr_question_text[7]}}" disabled="true" data-answer="{{$arr_question_text[7]}}" name="question8" maxlength="{{strlen($arr_question_text[7])}}">
                                                    @endif
                                                    </td>
                                                    <td class="td-input">
                                                    @if($arr_position[8]==1)
                                                        {{$arr_question_text[8]}}
                                                    @else
                                                      <input class="actual-ans" type="text" style="text-align: center;" placeholder="{{$arr_question_text[8]}}" disabled="true" data-answer="{{$arr_question_text[8]}}" name="question9" maxlength="{{strlen($arr_question_text[8])}}">
                                                    @endif
                                                    </td>
                                                    <td class="td-input">
                                                    @if($arr_position[9]==1)
                                                        {{$arr_question_text[9]}}
                                                    @else
                                                      <input class="actual-ans" type="text" style="text-align: center;" placeholder="{{$arr_question_text[9]}}" disabled="true" data-answer="{{$arr_question_text[9]}}" name="question10" maxlength="{{strlen($arr_question_text[9])}}">
                                                    @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="td-input">
                                                    @if($arr_position[10]==1)
                                                        {{$arr_question_text[10]}}
                                                    @else
                                                      <input class="actual-ans" type="text" style="text-align: center;" placeholder="{{$arr_question_text[10]}}" disabled="true" data-answer="{{$arr_question_text[10]}}" name="question11" maxlength="{{strlen($arr_question_text[10])}}">
                                                    @endif
                                                    </td>
                                                    <td></td>
                                                    <td class="td-input">
                                                    @if($arr_position[11]==1)
                                                        {{$arr_question_text[11]}}
                                                    @else
                                                      <input class="actual-ans" type="text" style="text-align: center;" placeholder="{{$arr_question_text[11]}}" disabled="true" data-answer="{{$arr_question_text[11]}}" name="question12" maxlength="{{strlen($arr_question_text[11])}}">
                                                    @endif
                                                    </td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td class="td-input">
                                                    @if($arr_position[12]==1)
                                                        {{$arr_question_text[12]}}
                                                    @else
                                                      <input class="actual-ans" type="text" style="text-align: center;" placeholder="{{$arr_question_text[12]}}" disabled="true" data-answer="{{$arr_question_text[12]}}" name="question13" maxlength="{{strlen($arr_question_text[12])}}">
                                                    @endif
                                                    </td>
                                                    <td class="td-input">
                                                    @if($arr_position[13]==1)
                                                        {{$arr_question_text[13]}}
                                                    @else
                                                      <input class="actual-ans" type="text" style="text-align: center;" placeholder="{{$arr_question_text[13]}}" disabled="true" data-answer="{{$arr_question_text[13]}}" name="question14" maxlength="{{strlen($arr_question_text[13])}}">
                                                    @endif
                                                    </td>
                                                    <td class="td-input">
                                                    @if($arr_position[14]==1)
                                                        {{$arr_question_text[14]}}
                                                    @else
                                                      <input class="actual-ans" type="text" style="text-align: center;" placeholder="{{$arr_question_text[14]}}" disabled="true" data-answer="{{$arr_question_text[14]}}" name="question15" maxlength="{{strlen($arr_question_text[14])}}">
                                                    @endif
                                                    </td>
                                                    <td class="td-input">
                                                    @if($arr_position[15]==1)
                                                        {{$arr_question_text[15]}}
                                                    @else
                                                      <input class="actual-ans" type="text" style="text-align: center;" placeholder="{{$arr_question_text[15]}}" disabled="true" data-answer="{{$arr_question_text[15]}}" name="question16" maxlength="{{strlen($arr_question_text[15])}}">
                                                    @endif
                                                    </td>
                                                    <td class="td-input">
                                                    @if($arr_position[16]==1)
                                                        {{$arr_question_text[16]}}
                                                    @else
                                                      <input class="actual-ans" type="text" style="text-align: center;" placeholder="{{$arr_question_text[16]}}" disabled="true" data-answer="{{$arr_question_text[16]}}" name="question17" maxlength="{{strlen($arr_question_text[16])}}">
                                                    @endif
                                                    </td>
                                                    <td></td>
                                                    <td class="td-input">
                                                    @if($arr_position[17]==1)
                                                        {{$arr_question_text[17]}}
                                                    @else
                                                      <input class="actual-ans" type="text" style="text-align: center;" placeholder="{{$arr_question_text[17]}}" disabled="true" data-answer="{{$arr_question_text[17]}}" name="question18" maxlength="{{strlen($arr_question_text[17])}}">
                                                    @endif
                                                    </td>
                                                    <td class="td-input">
                                                    @if($arr_position[18]==1)
                                                        {{$arr_question_text[18]}}
                                                    @else
                                                      <input class="actual-ans" type="text" style="text-align: center;" placeholder="{{$arr_question_text[18]}}" disabled="true" data-answer="{{$arr_question_text[18]}}" name="question19" maxlength="{{strlen($arr_question_text[18])}}">
                                                    @endif
                                                    </td>
                                                    <td class="td-input">
                                                    @if($arr_position[19]==1)
                                                        {{$arr_question_text[19]}}
                                                    @else
                                                      <input class="actual-ans" type="text" style="text-align: center;" placeholder="{{$arr_question_text[19]}}" disabled="true" data-answer="{{$arr_question_text[19]}}" name="question20" maxlength="{{strlen($arr_question_text[19])}}">
                                                    @endif
                                                    </td>
                                                    <td class="td-input">
                                                    @if($arr_position[20]==1)
                                                        {{$arr_question_text[20]}}
                                                    @else
                                                      <input class="actual-ans" type="text" style="text-align: center;" placeholder="{{$arr_question_text[20]}}" disabled="true" data-answer="{{$arr_question_text[20]}}" name="question20" maxlength="{{strlen($arr_question_text[20])}}">
                                                    @endif
                                                    </td>
                                                    <td class="td-input">
                                                    @if($arr_position[21]==1)
                                                        {{$arr_question_text[21]}}
                                                    @else
                                                      <input class="actual-ans" type="text" style="text-align: center;" placeholder="{{$arr_question_text[21]}}" disabled="true" data-answer="{{$arr_question_text[21]}}" name="question20" maxlength="{{strlen($arr_question_text[21])}}">
                                                    @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="td-input">
                                                    @if($arr_position[22]==1)
                                                        {{$arr_question_text[22]}}
                                                    @else
                                                      <input class="actual-ans" type="text" style="text-align: center;" placeholder="{{$arr_question_text[22]}}" disabled="true" data-answer="{{$arr_question_text[22]}}" name="question20" maxlength="{{strlen($arr_question_text[22])}}">
                                                    @endif
                                                    </td>
                                                    <td></td>
                                                    <td class="td-input">
                                                    @if($arr_position[23]==1)
                                                        {{$arr_question_text[23]}}
                                                    @else
                                                      <input class="actual-ans" type="text" style="text-align: center;" placeholder="{{$arr_question_text[23]}}" disabled="true" data-answer="{{$arr_question_text[23]}}" name="question20" maxlength="{{strlen($arr_question_text[23])}}">
                                                    @endif
                                                    </td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="td-input">
                                                    @if($arr_position[24]==1)
                                                        {{$arr_question_text[24]}}
                                                    @else
                                                      <input class="actual-ans" type="text" style="text-align: center;" placeholder="{{$arr_question_text[24]}}" disabled="true" data-answer="{{$arr_question_text[24]}}" name="question20" maxlength="{{strlen($arr_question_text[24])}}">
                                                    @endif
                                                    </td>
                                                    <td class="td-input">
                                                    @if($arr_position[25]==1)
                                                        {{$arr_question_text[25]}}
                                                    @else
                                                      <input class="actual-ans" type="text" style="text-align: center;" placeholder="{{$arr_question_text[25]}}" disabled="true" data-answer="{{$arr_question_text[25]}}" name="question20" maxlength="{{strlen($arr_question_text[25])}}">
                                                    @endif
                                                    </td>
                                                    <td class="td-input">
                                                    @if($arr_position[26]==1)
                                                        {{$arr_question_text[26]}}
                                                    @else
                                                      <input class="actual-ans" type="text" style="text-align: center;" placeholder="{{$arr_question_text[26]}}" disabled="true" data-answer="{{$arr_question_text[26]}}" name="question20" maxlength="{{strlen($arr_question_text[26])}}">
                                                    @endif
                                                    </td>
                                                    <td class="td-input">
                                                    @if($arr_position[27]==1)
                                                        {{$arr_question_text[27]}}
                                                    @else
                                                      <input class="actual-ans" type="text" style="text-align: center;" placeholder="{{$arr_question_text[27]}}" disabled="true" data-answer="{{$arr_question_text[27]}}" name="question20" maxlength="{{strlen($arr_question_text[27])}}">
                                                    @endif
                                                    </td>
                                                    <td class="td-input">
                                                    @if($arr_position[28]==1)
                                                        {{$arr_question_text[28]}}
                                                    @else
                                                      <input class="actual-ans" type="text" style="text-align: center;" placeholder="{{$arr_question_text[28]}}" disabled="true" data-answer="{{$arr_question_text[28]}}" name="question20" maxlength="{{strlen($arr_question_text[28])}}">
                                                    @endif
                                                    </td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                    </table>
                                </div>                       
                            </div>
                        @endif
                    </div>                    
                </div>                               
                <div class="clearfix"></div>
            </div>
            <div class="row">
                <div class="col-md-6 col-lg-6">
                    <div class="specker-mic-section" style="display: none">
                        <button onclick="togglePlay()" id="hornButton">
                            <img src="{{url('/')}}/images/template/specker-icon-img.png" alt="speaker-icon" />
                            <audio id="horn" src="{{$question_audio_public_path.$arr_question['horn']}}"></audio>
                        </button>
                        <button data-id="no">
                            <img src="{{url('/')}}/images/template/mic-icon-img.png" alt="mic-icon" />
                            <img class="red-ring" src="{{url('/')}}/images/recording-ring.png" alt="mic-icon" />
                        </button>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6">
                    <div class="timer-section">
                        <div class="time-head-section">
                            <span>Min</span>
                            <span>Sec</span>
                        </div>
                        <div class="hm-timer-section">
                            <span id="hm_timer_{{$uniqid}}"></span>
                        </div>
                    </div>                     
                </div>
            </div>
            <span id="flashcontent"></span>                       
        </div>
    </div>
    <!--middle section end-->
<link rel="stylesheet" type="text/css" href="{{url('/')}}/css/front/jquery.countdownTimer.css" />
<script type="text/javascript">
    $(function(){
        var t_minutes = '{{$minutes}}';
        var t_seconds = '{{$seconds}}';
        var uniqid    = '{{$uniqid}}';
        /*hours           = parseInt(hours);*/
        t_minutes       = parseInt(t_minutes);
        t_seconds       = parseInt(t_seconds);
        var script_url = SITE_URL+"/js/front/custom/jquery.countdownTimer.js";
        $.getScript( script_url, function() {
            $('#hm_timer_'+uniqid).countdowntimer({
                method       : "init",
                minutes      : t_minutes,
                seconds      : t_seconds,
                displayFormat: "MS",
                tickInterval : 0,
                size         : "md"
            });
        });
    });
</script>

@endif

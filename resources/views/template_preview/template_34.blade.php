@if(isset($arr_question) && count($arr_question)>0)
@php $uniqid = uniqid();  @endphp
@php
    $arr_time = explode(':',$arr_question['duration']);
    $minutes  = $arr_time['1'];
    $seconds  = $arr_time['2'];
@endphp
<link href="{{ url('/') }}/css/admin/template-css.css" rel="stylesheet" type="text/css" />
    <!--middle section-->
    <div class="middle-section temp-34-main-section">
        <div class="container">
            <div class="fill-in-the-blank-section">
                <div class="question-section">
                    <div class="question-txt-section">
                        <i class="fa fa-angle-double-right"></i> {{isset($arr_question['question']) && $arr_question['question']!='' ? ucwords($arr_question['question'])." : " : "N/A" }} <br>
                    </div>
                  
                    <div class="clearfix"></div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-lg-6">

                        <div class="game-img-section">
                            @if(isset($arr_question['question_file']) && $arr_question['question_file']!='')
                                @php $result = get_image_public_path($arr_question['question_file'],'image');  @endphp
                                <img src="{{$result['image_url']}}" alt="tamplate-four" />
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="game-fill-text-section">
                            <div class="fill-txt-section img-calculations">
                                <ul>
                                  <li>{{isset($arr_question['digit1_1']) && $arr_question['digit1_1']!='' ? $arr_question['digit1_1'] : 0 }}</li>
                                  <li>
                                    @if($arr_question['operator1'] && $arr_question['operator1']!='')
                                        @if($arr_question['operator1'] != '/')
                                          {{$arr_question['operator1']}}
                                        @else
                                          &#247;
                                        @endif
                                    @endif
                                  </li>
                                  <li>{{isset($arr_question['digit1_2']) && $arr_question['digit1_2']!='' ? $arr_question['digit1_2'] : 0 }}</li>
                                  <li>=</li>
                                  <li>
                                     
                                    <input class="actual-ans" type="text" style="text-align: center;" value="{{$arr_question['answer1']}}" disabled="true" data-answer="{{$arr_question['answer1']}}" name="question1" maxlength="{{strlen($arr_question['answer1'])}}">
                                  
                                 </li>
                               </ul>
                            </div>
                           
                        </div>
                    </div>
                </div>                                
                <div class="clearfix"></div>
            </div>
           
            <div class="row">
               <div class="col-md-6 col-lg-6">
                   {{--  <div class="specker-mic-section" style="display: none">
                        <button onclick="togglePlay()" id="hornButton">
                            <img src="{{url('/')}}/images/template/specker-icon-img.png" alt="speaker-icon" />
                            <audio id="horn" src="{{$question_audio_public_path.$arr_question['horn']}}"></audio>
                        </button>
                        <button data-id="no">
                            <img src="{{url('/')}}/images/template/mic-icon-img.png" alt="mic-icon" />
                            <img class="red-ring" src="{{url('/')}}/images/recording-ring.png" alt="mic-icon" />
                        </button>
                    </div>--}}
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
 
@endif

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
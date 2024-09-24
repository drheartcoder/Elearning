@if(isset($arr_question) && count($arr_question)>0)
@php $uniqid = uniqid();  @endphp 
@php
    $arr_time = explode(':',$arr_question['duration']);
    $minutes  = $arr_time['1'];
    $seconds  = $arr_time['2'];
@endphp
<link href="{{ url('/') }}/css/admin/template-css.css" rel="stylesheet" type="text/css" />
<script>window.MathJax = { MathML: { extensions: ["mml3.js", "content-mathml.js"]}};</script>
    <!--middle section-->
    <div class="middle-section temp-36-main-section temp-41-main-section">
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
                        <div class="game-img-section">
                            <div class="temp-41-ques-text">Multiply or Divide to find a common denominator. Then compare the numerator.<br> Write ( <i class="fa fa-angle-right"></i> ), ( <i class="fa fa-angle-left"></i> ), or ( = ) in the circle.</div>
                            <div class="division-wrapper equation-block">
                                <div class="row">
                                    <div class="col-md-4 col-lg-4">
                                        @if(isset($arr_question['question1_1']) && $arr_question['question1_1']!='')
                                          <div class="question-nos-section">
                                              <div class="equa-num">                                    
                                                  <b>{!!isset($arr_question['question1_1']) && $arr_question['question1_1']!='' ? $arr_question['question1_1'] : "N/A" !!}</b>
                                              </div>
                                              <div class="answer-section-block">
                                                    <input class="actual-ans" type="text" style="text-align: center;" placeholder="{{$arr_question['answer_1']}}" disabled="true" data-answer="{{$arr_question['answer_1']}}" name="question1" maxlength="{{strlen($arr_question['answer_1'])}}">
                                              </div>
                                              <div class="equa-num">                                    
                                                  <b>{!!isset($arr_question['question1_2']) && $arr_question['question1_2']!='' ? $arr_question['question1_2'] : "N/A" !!}</b>
                                              </div>                                
                                          </div>
                                        @endif
                                        @if(isset($arr_question['question4_1']) && $arr_question['question4_1']!='')
                                              <div class="question-nos-section">
                                                  <div class="equa-num">                                    
                                                      <b>{!!isset($arr_question['question4_1']) && $arr_question['question4_1']!='' ? $arr_question['question4_1'] : "N/A" !!}</b>
                                                  </div>
                                                  <div class="answer-section-block">
                                                        <input class="actual-ans" type="text" style="text-align: center;" placeholder="{{$arr_question['answer_4']}}" disabled="true" data-answer="{{$arr_question['answer_4']}}" name="question4" maxlength="{{strlen($arr_question['answer_4'])}}">
                                                  </div>
                                                  <div class="equa-num">                                    
                                                      <b>{!!isset($arr_question['question4_2']) && $arr_question['question4_2']!='' ? $arr_question['question4_2'] : "N/A" !!}</b>
                                                  </div>                                
                                              </div>
                                        @endif
                                    </div>
                                    <div class="col-md-4 col-lg-4">
                                        <div class="for-align-center-text">
                                            @if(isset($arr_question['question2_1']) && $arr_question['question2_1']!='')
                                              <div class="question-nos-section">
                                                  <div class="equa-num">                                    
                                                      <b>{!!isset($arr_question['question2_1']) && $arr_question['question2_1']!='' ? $arr_question['question2_1'] : "N/A" !!}</b>
                                                  </div>
                                                  <div class="answer-section-block">
                                                        <input class="actual-ans" type="text" style="text-align: center;" placeholder="{{$arr_question['answer_2']}}" disabled="true" data-answer="{{$arr_question['answer_2']}}" name="question2" maxlength="{{strlen($arr_question['answer_2'])}}">
                                                  </div>
                                                  <div class="equa-num">                                    
                                                      <b>{!!isset($arr_question['question2_2']) && $arr_question['question2_2']!='' ? $arr_question['question2_2'] : "N/A" !!}</b>
                                                  </div>                                
                                              </div>
                                            @endif
                                            @if(isset($arr_question['question5_1']) && $arr_question['question5_1']!='')
                                              <div class="question-nos-section">
                                                  <div class="equa-num">                                    
                                                      <b>{!!isset($arr_question['question5_1']) && $arr_question['question5_1']!='' ? $arr_question['question5_1'] : "N/A" !!}</b>
                                                  </div>
                                                  <div class="answer-section-block">
                                                        <input class="actual-ans" type="text" style="text-align: center;" placeholder="{{$arr_question['answer_5']}}" disabled="true" data-answer="{{$arr_question['answer_5']}}" name="question5" maxlength="{{strlen($arr_question['answer_5'])}}">
                                                  </div>
                                                  <div class="equa-num">                                    
                                                      <b>{!!isset($arr_question['question5_2']) && $arr_question['question5_2']!='' ? $arr_question['question5_2'] : "N/A" !!}</b>
                                                  </div>                                
                                              </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-4">
                                        <div class="for-align-right-section">
                                            @if(isset($arr_question['question3_1']) && $arr_question['question3_1']!='')
                                              <div class="question-nos-section">
                                                  <div class="equa-num">                                    
                                                      <b>{!!isset($arr_question['question3_1']) && $arr_question['question3_1']!='' ? $arr_question['question3_1'] : "N/A" !!}</b>
                                                  </div>
                                                  <div class="answer-section-block">
                                                        <input class="actual-ans" type="text" style="text-align: center;" placeholder="{{$arr_question['answer_3']}}" disabled="true" data-answer="{{$arr_question['answer_3']}}" name="question3" maxlength="{{strlen($arr_question['answer_3'])}}">
                                                  </div>
                                                  <div class="equa-num">                                    
                                                      <b>{!!isset($arr_question['question3_2']) && $arr_question['question3_2']!='' ? $arr_question['question3_2'] : "N/A" !!}</b>
                                                  </div>                                
                                              </div>
                                            @endif
                                            @if(isset($arr_question['question6_1']) && $arr_question['question6_1']!='')
                                              <div class="question-nos-section">
                                                  <div class="equa-num">                                    
                                                      <b>{!!isset($arr_question['question6_1']) && $arr_question['question6_1']!='' ? $arr_question['question6_1'] : "N/A" !!}</b>
                                                  </div>
                                                  <div class="answer-section-block">
                                                        <input class="actual-ans" type="text" style="text-align: center;" placeholder="{{$arr_question['answer_6']}}" disabled="true" data-answer="{{$arr_question['answer_6']}}" name="question6" maxlength="{{strlen($arr_question['answer_6'])}}">
                                                  </div>
                                                  <div class="equa-num">                                    
                                                      <b>{!!isset($arr_question['question6_2']) && $arr_question['question6_2']!='' ? $arr_question['question6_2'] : "N/A" !!}</b>
                                                  </div>                                
                                              </div>
                                            @endif
                                        </div>
                                    </div>                                    
                                </div>                                
                            </div>                            
                        </div>
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
                        <button>
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
 <script type="text/javascript" src="{{url('/')}}/js/MathJax-master/MathJax.js?config=TeX-AMS-MML_HTMLorMML" ></script>
<script type="text/javascript" src="{{url('/')}}/js/MathJax-master/MathJax.js?config=TeX-AMS_HTML" ></script>
<script type="text/javascript" src="{{url('/')}}/js/MathJax-master/MathJax.js?config=MML_HTMLorMML" ></script>
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
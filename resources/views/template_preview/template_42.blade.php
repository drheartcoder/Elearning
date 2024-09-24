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
    <div class="middle-section temp-36-main-section temp-42-main-section">
        <div class="container">
            <div class="fill-in-the-blank-section">
                <div class="question-section">
                    <div class="question-txt-section">
                        <i class="fa fa-angle-double-right"></i> {{isset($arr_question['question']) && $arr_question['question']!='' ? ucwords($arr_question['question'])." : " : "N/A" }} <br>
                    </div>
                    <div class="clearfix"></div>
                </div>
                @php
                  $arr_answer1 = $arr_answer2 = $arr_answer3 = $arr_answer4 = $arr_answer5 = $arr_answer6 = [];
                  if(isset($arr_question['answer1']) && $arr_question['answer1']!=''){
                    $arr_answer1 = explode(',',$arr_question['answer1']);
                  }
                  if(isset($arr_question['answer2']) && $arr_question['answer2']!=''){
                    $arr_answer2 = explode(',',$arr_question['answer2']);
                  }
                  if(isset($arr_question['answer3']) && $arr_question['answer3']!=''){
                    $arr_answer3 = explode(',',$arr_question['answer3']);
                  }
                  if(isset($arr_question['answer4']) && $arr_question['answer4']!=''){
                    $arr_answer4 = explode(',',$arr_question['answer4']);
                  }
                  if(isset($arr_question['answer5']) && $arr_question['answer5']!=''){
                    $arr_answer5 = explode(',',$arr_question['answer5']);
                  }
                  if(isset($arr_question['answer6']) && $arr_question['answer6']!=''){
                    $arr_answer6 = explode(',',$arr_question['answer6']);
                  }
                @endphp
                <div class="row">
                    <div class="col-md-6 col-lg-6">
                        <div class="game-img-section">
                            @if(isset($arr_question['question1']) && $arr_question['question1']!='')
                              <div class="division-wrapper equation-block">
                                  <div class="equa-num">                                    
                                      <b>{!!isset($arr_question['question1']) && $arr_question['question1']!='' ? $arr_question['question1'] : "N/A" !!}</b>
                                  </div>
                                  <div class="equa-sign">=</div>        
                                  <div class="equa-num temp-42-input-section">
                                      <div class="div-num">
                                        @if(count($arr_answer1)>0)
                                          @foreach($arr_answer1 as $key => $val)
                                            <span>
                                              <input class="input-number correct-sans" type="text" style="text-align: center;" placeholder="{{$val}}" disabled="true" data-answer="{{$val}}" name="question1" maxlength="{{strlen($val)}}">
                                            </span>
                                            @endforeach
                                        @endif
                                      </div>
                                  </div>                                
                              </div>
                            @endif
                          @if(isset($arr_question['question3']) && $arr_question['question3']!='')
                              <div class="division-wrapper equation-block">
                                  <div class="equa-num">                                    
                                      <b>{!!isset($arr_question['question3']) && $arr_question['question3']!='' ? $arr_question['question3'] : "N/A" !!}</b>
                                  </div>
                                  <div class="equa-sign">=</div>        
                                  <div class="equa-num temp-42-input-section">
                                      <div class="div-num">
                                        @if(count($arr_answer3)>0)
                                          @foreach($arr_answer3 as $key => $val)
                                            <span>
                                              <input class="input-number actual-ans" type="text" style="text-align: center;" placeholder="{{$val}}" disabled="true" data-answer="{{$val}}" name="question3" maxlength="{{strlen($val)}}">
                                            </span>
                                            @endforeach
                                        @endif
                                      </div>
                                  </div>                                
                              </div>
                          @endif
                          @if(isset($arr_question['question5']) && $arr_question['question5']!='')
                                  <div class="division-wrapper equation-block">
                                      <div class="equa-num">                                    
                                          <b>{!!isset($arr_question['question5']) && $arr_question['question5']!='' ? $arr_question['question5'] : "N/A" !!}</b>
                                      </div>
                                      <div class="equa-sign">=</div>        
                                      <div class="equa-num temp-42-input-section">
                                          <div class="div-num">
                                            @if(count($arr_answer5)>0)
                                              @foreach($arr_answer5 as $key => $val)
                                                <span>
                                                  <input class="input-number actual-ans" type="text" style="text-align: center;" placeholder="{{$val}}" disabled="true" data-answer="{{$val}}" name="question5" maxlength="{{strlen($val)}}">
                                                </span>
                                                @endforeach
                                            @endif
                                          </div>
                                      </div>                                
                                  </div>
                          @endif
               
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="game-fill-text-section">
                            <div class="fill-txt-section">
                                @if(isset($arr_question['question2']) && $arr_question['question2']!='')
                                  <div class="division-wrapper equation-block">
                                      <div class="equa-num">                                    
                                          <b>{!!isset($arr_question['question2']) && $arr_question['question2']!='' ? $arr_question['question2'] : "N/A" !!}</b>
                                      </div>
                                      <div class="equa-sign">=</div>        
                                      <div class="equa-num temp-42-input-section">
                                          <div class="div-num">
                                            @if(count($arr_answer2)>0)
                                              @foreach($arr_answer2 as $key => $val)
                                                <span>
                                                  <input class="input-number actual-ans" type="text" style="text-align: center;" placeholder="{{$val}}" disabled="true" data-answer="{{$val}}" name="question2" maxlength="{{strlen($val)}}">
                                                </span>
                                                @endforeach
                                            @endif
                                          </div>
                                      </div>                                
                                  </div>
                              @endif           
                              @if(isset($arr_question['question4']) && $arr_question['question4']!='')  
                                  <div class="division-wrapper equation-block">
                                      <div class="equa-num">                                    
                                          <b>{!!isset($arr_question['question4']) && $arr_question['question4']!='' ? $arr_question['question4'] : "N/A" !!}</b>
                                      </div>
                                      <div class="equa-sign">=</div>        
                                      <div class="equa-num temp-42-input-section">
                                          <div class="div-num">
                                            @if(count($arr_answer4)>0)
                                              @foreach($arr_answer4 as $key => $val)
                                                <span>
                                                  <input class="input-number actual-ans" type="text" style="text-align: center;" placeholder="{{$val}}" disabled="true" data-answer="{{$val}}" name="question4" maxlength="{{strlen($val)}}">
                                                </span>
                                                @endforeach
                                            @endif
                                          </div>
                                      </div>                                
                                  </div>
                              @endif
                              @if(isset($arr_question['question6']) && $arr_question['question6']!='')
                                  <div class="division-wrapper equation-block">
                                      <div class="equa-num">                                    
                                          <b>{!!isset($arr_question['question6']) && $arr_question['question6']!='' ? $arr_question['question6'] : "N/A" !!}</b>
                                      </div>
                                      <div class="equa-sign">=</div>        
                                      <div class="equa-num temp-42-input-section">
                                          <div class="div-num">
                                            @if(count($arr_answer6)>0)
                                              @foreach($arr_answer6 as $key => $val)
                                                <span>
                                                  <input class="input-number actual-ans" type="text" style="text-align: center;" placeholder="{{$val}}" disabled="true" data-answer="{{$val}}" name="question6" maxlength="{{strlen($val)}}">
                                                </span>
                                                @endforeach
                                            @endif
                                          </div>
                                      </div>                                
                                  </div>
                              @endif
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
    <!--middle section end-->
    
<script type="text/javascript" src="{{url('/')}}/js/MathJax-master/MathJax.js?config=TeX-AMS-MML_HTMLorMML" ></script>
<script type="text/javascript" src="{{url('/')}}/js/MathJax-master/MathJax.js?config=TeX-AMS_HTML" ></script>
<script type="text/javascript" src="{{url('/')}}/js/MathJax-master/MathJax.js?config=MML_HTMLorMML" ></script>
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
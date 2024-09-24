@if(isset($arr_question) && count($arr_question)>0)
@php $uniqid = uniqid(); @endphp 
@php
    $arr_time = explode(':',$arr_question['duration']);
    $minutes  = $arr_time['1'];
    $seconds  = $arr_time['2'];
@endphp
<link href="{{ url('/') }}/css/admin/template-css.css" rel="stylesheet" type="text/css" />
<!--middle section-->
<div class="middle-section temp-35-main-section">
    <div class="container">
        <div class="fill-in-the-blank-section">
            <div class="question-section">
                <div class="question-txt-section">
                    <i class="fa fa-angle-double-right"></i> {{isset($arr_question['question']) && $arr_question['question']!='' ? ucwords($arr_question['question']) : "N/A" }}
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="row">
                    <div class="col-md-6 col-lg-6">
                        <div class="game-img-section multiple-imgs">
                            <div class="small-img-block">
                              @if(isset($arr_question['question_1_file']) && $arr_question['question_1_file']!='')
                              @php $result = get_image_public_path($arr_question['question_1_file'],'image');  @endphp
                              <div class="small-img img-responsive">{{-- <div class="num-block">1</div> --}}
                                  <img src="{{$result['image_url']}}" alt="tamplate 12" />
                              </div>
                              @endif                           
                              @if(isset($arr_question['question_2_file']) && $arr_question['question_2_file']!='')
                              @php $result = get_image_public_path($arr_question['question_2_file'],'image');  @endphp
                              <div class="small-img img-responsive">{{-- <div class="num-block">2</div> --}}
                                  <img src="{{$result['image_url']}}" alt="tamplate 12" />
                              </div>
                              @endif
                              @if(isset($arr_question['question_3_file']) && $arr_question['question_3_file']!='')
                              @php $result = get_image_public_path($arr_question['question_3_file'],'image');  @endphp
                              <div class="small-img img-responsive">{{-- <div class="num-block">3</div> --}}
                                  <img src="{{$result['image_url']}}" alt="tamplate 13" />
                              </div>
                              @endif
                              @if(isset($arr_question['question_4_file']) && $arr_question['question_4_file']!='')
                              @php $result = get_image_public_path($arr_question['question_4_file'],'image');  @endphp
                              <div class="small-img img-responsive">{{-- <div class="num-block">4</div> --}}
                                  <img src="{{$result['image_url']}}" alt="tamplate 12" />
                              </div>
                              @endif
                              <div class="clearfix"></div>
                            </div>
                            @if(isset($arr_question['question_5_file']) && $arr_question['question_5_file']!='')
                            <div class="big-img-block">
                              @php $result = get_image_public_path($arr_question['question_5_file'],'image');  @endphp
                              <div class="big-img img-responsive">{{-- <div class="num-block">5</div> --}}
                                  <img src="{{$result['image_url']}}" alt="tamplate 12" />
                              </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    @php
                    $arr_position1 = str_split($arr_question['answer1Position'], 1);
                    if(isset($arr_question['digit2_1']) && $arr_question['digit2_1']!=''){
                      $arr_position2 = str_split($arr_question['answer2Position'], 1);
                    }
                    if(isset($arr_question['digit3_1']) && $arr_question['digit3_1']!=''){
                      $arr_position3 = str_split($arr_question['answer3Position'], 1);
                    }
                    if(isset($arr_question['digit4_1']) && $arr_question['digit4_1']!=''){
                      $arr_position4 = str_split($arr_question['answer4Position'], 1);
                    }
                    if(isset($arr_question['digit5_1']) && $arr_question['digit5_1']!=''){
                      $arr_position5 = str_split($arr_question['answer5Position'], 1);
                    }
                    @endphp
                    <div class="col-md-6 col-lg-6">
                        <div class="game-fill-text-section">
                            <div class="fill-txt-section">
                                <ul class="main-ques-list">
                                  @if(isset($arr_question['digit1_1']) && $arr_question['digit1_1']!='')
                                    <li>
                                        {{-- <div class="num-block">1.</div> --}}
                                        <ul class="input-list">
                                            @if(isset($arr_position1) && count($arr_position1)>0)
                                                @if($arr_position1[0]==1)  
                                                  <li>
                                                    {{isset($arr_question['digit1_1']) && $arr_question['digit1_1']!='' ? $arr_question['digit1_1'] : 0 }}
                                                  </li>
                                                @else
                                                   <li>
                                                     
                                                        <input class="actual-ans" type="text" style="text-align: center;" value="{{$arr_question['digit1_1']}}" disabled="true" data-answer="{{$arr_question['digit1_1']}}" name="question1" maxlength="{{strlen($arr_question['digit1_1'])}}">
                                                     
                                                   </li>
                                                @endif
                                                  <li>
                                                    @if($arr_question['operator1'] && $arr_question['operator1']!='')
                                                        @if($arr_question['operator1'] != '/')
                                                          {{$arr_question['operator1']}}
                                                        @else
                                                          &#247;
                                                        @endif
                                                    @endif
                                                  </li>
                                                @if($arr_position1[1]==1)  
                                                  <li>
                                                    {{isset($arr_question['digit1_2']) && $arr_question['digit1_2']!='' ? $arr_question['digit1_2'] : 0 }}
                                                  </li>
                                                @else
                                                   <li>
                                                      
                                                      <input class="actual-ans" type="text" style="text-align: center;" value="{{$arr_question['digit1_2']}}" disabled="true" data-answer="{{$arr_question['digit1_2']}}" name="question1" maxlength="{{strlen($arr_question['digit1_2'])}}">
                                                     
                                                   </li>
                                                @endif
                                                  <li>=</li>
                                                @if($arr_position1[2]==1)  
                                                  <li>
                                                      {{isset($arr_question['answer1']) && $arr_question['answer1']!='' ? $arr_question['answer1'] : 0 }}
                                                 </li>
                                                 @else
                                                    <li>
                                                       
                                                      <input class="actual-ans" type="text" style="text-align: center;" value="{{$arr_question['answer1']}}" disabled="true" data-answer="{{$arr_question['answer1']}}" name="question1" maxlength="{{strlen($arr_question['answer1'])}}">
                                                       
                                                    </li>
                                                 @endif
                                             @endif
                                        </ul>
                                        <div class="clearfix"></div>
                                    </li>
                                  @endif
                                  @if(isset($arr_question['digit2_1']) && $arr_question['digit2_1']!='')
                                    <li>
                                        {{-- <div class="num-block">2.</div> --}}
                                        <ul class="input-list">
                                            @if(isset($arr_position2) && count($arr_position2)>0)
                                                @if($arr_position2[0]==1)  
                                                  <li>
                                                    {{isset($arr_question['digit2_1']) && $arr_question['digit2_1']!='' ? $arr_question['digit2_1'] : 0 }}
                                                  </li>
                                                @else
                                                   <li>
                                                     
                                                      <input class="actual-ans" type="text" style="text-align: center;" value="{{$arr_question['digit2_1']}}" disabled="true" data-answer="{{$arr_question['digit2_1']}}" name="question2" maxlength="{{strlen($arr_question['digit2_1'])}}">
                                                    
                                                   </li>
                                                @endif
                                                  <li>
                                                    @if($arr_question['operator2'] && $arr_question['operator2']!='')
                                                        @if($arr_question['operator2'] != '/')
                                                          {{$arr_question['operator2']}}
                                                        @else
                                                          &#247;
                                                        @endif
                                                    @endif
                                                  </li>
                                                @if($arr_position2[1]==1)  
                                                  <li>
                                                    {{isset($arr_question['digit2_2']) && $arr_question['digit2_2']!='' ? $arr_question['digit2_2'] : 0 }}
                                                  </li>
                                                @else
                                                   <li>
                                                      
                                                    <input class="actual-ans" type="text" style="text-align: center;" value="{{$arr_question['digit2_2']}}" disabled="true" data-answer="{{$arr_question['digit2_2']}}" name="question2" maxlength="{{strlen($arr_question['digit2_2'])}}">
                                                   
                                                   </li>
                                                @endif
                                                  <li>=</li>
                                                @if($arr_position2[2]==1)  
                                                  <li>
                                                      {{isset($arr_question['answer2']) && $arr_question['answer2']!='' ? $arr_question['answer2'] : 0 }}
                                                 </li>
                                                 @else
                                                    <li>
                                                      
                                                      <input class="actual-ans" type="text" style="text-align: center;" value="{{$arr_question['answer2']}}" disabled="true" data-answer="{{$arr_question['answer2']}}" name="question2" maxlength="{{strlen($arr_question['answer2'])}}">
                                                       
                                                    </li>
                                                 @endif
                                             @endif
                                        </ul>
                                        <div class="clearfix"></div>
                                    </li>
                                  @endif
                                  @if(isset($arr_question['digit3_1']) && $arr_question['digit3_1']!='')
                                    <li>
                                        {{-- <div class="num-block">3.</div> --}}
                                        <ul class="input-list">
                                            @if(isset($arr_position3) && count($arr_position3)>0)
                                                @if($arr_position3[0]==1)  
                                                  <li>
                                                    {{isset($arr_question['digit3_1']) && $arr_question['digit3_1']!='' ? $arr_question['digit3_1'] : 0 }}
                                                  </li>
                                                @else
                                                   <li>
                                                     
                                                    <input class="actual-ans" type="text" style="text-align: center;" value="{{$arr_question['digit3_1']}}" disabled="true" data-answer="{{$arr_question['digit3_1']}}" name="question3" maxlength="{{strlen($arr_question['digit3_1'])}}">
                                                    
                                                   </li>
                                                @endif
                                                  <li>
                                                    @if($arr_question['operator3'] && $arr_question['operator3']!='')
                                                        @if($arr_question['operator3'] != '/')
                                                          {{$arr_question['operator3']}}
                                                        @else
                                                          &#247;
                                                        @endif
                                                    @endif
                                                  </li>
                                                @if($arr_position3[1]==1)  
                                                  <li>
                                                    {{isset($arr_question['digit3_2']) && $arr_question['digit3_2']!='' ? $arr_question['digit3_2'] : 0 }}
                                                  </li>
                                                @else
                                                   <li>
                                                      
                                                      <input class="actual-ans" type="text" style="text-align: center;" value="{{$arr_question['digit3_2']}}" disabled="true" data-answer="{{$arr_question['digit3_2']}}" name="question3" maxlength="{{strlen($arr_question['digit3_2'])}}">
                                                      
                                                   </li>
                                                @endif
                                                  <li>=</li>
                                                @if($arr_position3[2]==1)  
                                                  <li>
                                                      {{isset($arr_question['answer3']) && $arr_question['answer3']!='' ? $arr_question['answer3'] : 0 }}
                                                 </li>
                                                 @else
                                                    <li>
                                                      
                                                        <input class="actual-ans" type="text" style="text-align: center;" value="{{$arr_question['answer3']}}" disabled="true" data-answer="{{$arr_question['answer3']}}" name="question3" maxlength="{{strlen($arr_question['answer3'])}}">
                                                        
                                                    </li>
                                                 @endif
                                             @endif
                                        </ul>
                                        <div class="clearfix"></div>
                                    </li>
                                  @endif
                                  @if(isset($arr_question['digit4_1']) && $arr_question['digit4_1']!='')
                                    <li>
                                        {{-- <div class="num-block">4.</div> --}}
                                        <ul class="input-list">
                                            @if(isset($arr_position4) && count($arr_position4)>0)
                                                @if($arr_position4[0]==1)  
                                                  <li>
                                                    {{isset($arr_question['digit4_1']) && $arr_question['digit4_1']!='' ? $arr_question['digit4_1'] : 0 }}
                                                  </li>
                                                @else
                                                   <li>
                                                    
                                                        <input class="actual-ans" type="text" style="text-align: center;" value="{{$arr_question['digit4_1']}}" disabled="true" data-answer="{{$arr_question['digit4_1']}}" name="question4" maxlength="{{strlen($arr_question['digit4_1'])}}">
                                                    
                                                   </li>
                                                @endif
                                                  <li>
                                                    @if($arr_question['operator4'] && $arr_question['operator4']!='')
                                                        @if($arr_question['operator4'] != '/')
                                                          {{$arr_question['operator4']}}
                                                        @else
                                                          &#247;
                                                        @endif
                                                    @endif
                                                  </li>
                                                @if($arr_position4[1]==1)  
                                                  <li>
                                                    {{isset($arr_question['digit4_2']) && $arr_question['digit4_2']!='' ? $arr_question['digit4_2'] : 0 }}
                                                  </li>
                                                @else
                                                   <li>
                                                      
                                                      <input class="actual-ans" type="text" style="text-align: center;" value="{{$arr_question['digit4_2']}}" disabled="true" data-answer="{{$arr_question['digit4_2']}}" name="question4" maxlength="{{strlen($arr_question['digit4_2'])}}">
                                                    
                                                   </li>
                                                @endif
                                                  <li>=</li>
                                                @if($arr_position4[2]==1)  
                                                  <li>
                                                      {{isset($arr_question['answer4']) && $arr_question['answer4']!='' ? $arr_question['answer4'] : 0 }}
                                                 </li>
                                                 @else
                                                    <li>
      
                                                       <input class="actual-ans" type="text" style="text-align: center;" value="{{$arr_question['answer4']}}" disabled="true" data-answer="{{$arr_question['answer4']}}" name="question4" maxlength="{{strlen($arr_question['answer4'])}}">
                                                   
                                                    </li>
                                                 @endif
                                             @endif
                                        </ul>
                                        <div class="clearfix"></div>
                                    </li>
                                  @endif
                                  @if(isset($arr_question['digit5_1']) && $arr_question['digit5_1']!='')
                                    <li>
                                        {{-- <div class="num-block">5.</div> --}}
                                        <ul class="input-list">
                                            @if(isset($arr_position5) && count($arr_position5)>0)
                                                @if($arr_position5[0]==1)  
                                                  <li>
                                                    {{isset($arr_question['digit5_1']) && $arr_question['digit5_1']!='' ? $arr_question['digit5_1'] : 0 }}
                                                  </li>
                                                @else
                                                   <li>
                                                     
                                                        <input class="actual-ans" type="text" style="text-align: center;" value="{{$arr_question['digit5_1']}}" disabled="true" data-answer="{{$arr_question['digit5_1']}}" name="question5" maxlength="{{strlen($arr_question['digit5_1'])}}">
                                                 
                                                   </li>
                                                @endif
                                                  <li>
                                                    @if($arr_question['operator5'] && $arr_question['operator5']!='')
                                                        @if($arr_question['operator5'] != '/')
                                                          {{$arr_question['operator5']}}
                                                        @else
                                                          &#247;
                                                        @endif
                                                    @endif
                                                  </li>
                                                @if($arr_position5[1]==1)  
                                                  <li>
                                                    {{isset($arr_question['digit5_2']) && $arr_question['digit5_2']!='' ? $arr_question['digit5_2'] : 0 }}
                                                  </li>
                                                @else
                                                   <li>
                                                     
                                                        <input class="actual-ans" type="text" style="text-align: center;" value="{{$arr_question['digit5_2']}}" disabled="true" data-answer="{{$arr_question['digit5_2']}}" name="question5" maxlength="{{strlen($arr_question['digit5_2'])}}">
                                                   
                                                   </li>
                                                @endif
                                                  <li>=</li>
                                                @if($arr_position5[2]==1)  
                                                  <li>
                                                      {{isset($arr_question['answer5']) && $arr_question['answer5']!='' ? $arr_question['answer5'] : 0 }}
                                                 </li>
                                                 @else
                                                    <li>
                                                     
                                                     <input class="actual-ans" type="text" style="text-align: center;" value="{{$arr_question['answer5']}}" disabled="true" data-answer="{{$arr_question['answer5']}}" name="question5" maxlength="{{strlen($arr_question['answer5'])}}">
                                                       
                                                    </li>
                                                 @endif
                                             @endif
                                        </ul>
                                        <div class="clearfix"></div>
                                    </li>
                                  @endif
                                </ul>
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
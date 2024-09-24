@if(isset($arr_question) && count($arr_question)>0)
@php $uniqid = uniqid();  @endphp
@php
    $arr_time = explode(':',$arr_question['duration']);
    $minutes  = $arr_time['1'];
    $seconds  = $arr_time['2'];
@endphp
<link href="{{ url('/') }}/css/admin/template-css.css" rel="stylesheet" type="text/css" />
    <!--middle section-->
    <div class="middle-section temp-36-main-section temp-39-main-section">
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
                           @if(isset($arr_question['digit1_1']) && $arr_question['digit1_1']!='')
                           <div class="division-wrapper">
                               <div class="division-block">
                                   <div class="division-num">
                                       <b>{{isset($arr_question['digit1_1']) && $arr_question['digit1_1']!='' ? $arr_question['digit1_1'] : 0 }}</b>
                                       <b>
                                         @if($arr_question['operator1'] && $arr_question['operator1']!='')
                                                @if($arr_question['operator1'] != '/')
                                                  {{$arr_question['operator1']}}
                                                @else
                                                  &#247;
                                                @endif
                                          @endif
                                        {{isset($arr_question['digit1_2']) && $arr_question['digit1_2']!='' ? $arr_question['digit1_2'] : 0 }}
                                       </b>
                                   </div>
                                   
                                  <input class="input-number actual-ans" type="text" style="text-align: center;" value="{{$arr_question['answer1']}}" disabled="true" data-answer="{{$arr_question['answer1']}}" name="question1" maxlength="{{strlen($arr_question['answer1'])}}">
                                    
                               </div>
                           </div>
                           @endif
                           
                           @if(isset($arr_question['digit3_1']) && $arr_question['digit3_1']!='')
                           <div class="division-wrapper">
                               <div class="division-block">
                                   <div class="division-num">
                                       <b>{{isset($arr_question['digit3_1']) && $arr_question['digit3_1']!='' ? $arr_question['digit3_1'] : 0 }}</b>
                                       <b>
                                        @if($arr_question['operator3'] && $arr_question['operator3']!='')
                                                @if($arr_question['operator3'] != '/')
                                                  {{$arr_question['operator3']}}
                                                @else
                                                  &#247;
                                                @endif
                                          @endif
                                        {{isset($arr_question['digit3_2']) && $arr_question['digit3_2']!='' ? $arr_question['digit3_2'] : 0 }}
                                       </b>
                                   </div>
                                  
                                        <input class="input-number actual-ans" type="text" style="text-align: center;" value="{{$arr_question['answer3']}}" disabled="true" data-answer="{{$arr_question['answer3']}}" name="question3" maxlength="{{strlen($arr_question['answer3'])}}">
                                  
                               </div>
                           </div>
                           @endif

                           @if(isset($arr_question['digit5_1']) && $arr_question['digit5_1']!='')
                             <div class="division-wrapper">
                                 <div class="division-block">
                                     <div class="division-num">
                                         <b>{{isset($arr_question['digit5_1']) && $arr_question['digit5_1']!='' ? $arr_question['digit5_1'] : 0 }}</b>
                                         <b>
                                         @if($arr_question['operator5'] && $arr_question['operator5']!='')
                                            @if($arr_question['operator5'] != '/')
                                              {{$arr_question['operator5']}}
                                            @else
                                              &#247;
                                            @endif
                                         @endif
                                         {{isset($arr_question['digit5_2']) && $arr_question['digit5_2']!='' ? $arr_question['digit5_2'] : 0 }}
                                         </b>
                                     </div>
                                    
                                      <input class="input-number actual-ans" type="text" style="text-align: center;" value="{{$arr_question['answer5']}}" disabled="true" data-answer="{{$arr_question['answer5']}}" name="question5" maxlength="{{strlen($arr_question['answer5'])}}">
                                   
                                 </div>
                             </div>
                           @endif                           
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="game-fill-text-section">
                            <div class="fill-txt-section">
                                @if(isset($arr_question['digit2_1']) && $arr_question['digit2_1']!='')
                                 <div class="division-wrapper">
                                     <div class="division-block">
                                         <div class="division-num">
                                             <b>{{isset($arr_question['digit2_1']) && $arr_question['digit2_1']!='' ? $arr_question['digit2_1'] : 0 }}</b>
                                             <b>
                                              @if($arr_question['operator2'] && $arr_question['operator2']!='')
                                                    @if($arr_question['operator2'] != '/')
                                                      {{$arr_question['operator2']}}
                                                    @else
                                                      &#247;
                                                    @endif
                                              @endif
                                             {{isset($arr_question['digit2_2']) && $arr_question['digit2_2']!='' ? $arr_question['digit2_2'] : 0 }}
                                           </b>
                                         </div>
                                          
                                        <input class="input-number actual-ans" type="text" style="text-align: center;" value="{{$arr_question['answer2']}}" disabled="true" data-answer="{{$arr_question['answer2']}}" name="question2" maxlength="{{strlen($arr_question['answer2'])}}">
                                        
                                     </div>
                                 </div>
                                @endif
                                @if(isset($arr_question['digit4_1']) && $arr_question['digit4_1']!='')
                                 <div class="division-wrapper">
                                     <div class="division-block">
                                         <div class="division-num">
                                             <b>{{isset($arr_question['digit4_1']) && $arr_question['digit4_1']!='' ? $arr_question['digit4_1'] : 0 }}</b>
                                             <b>
                                             @if($arr_question['operator4'] && $arr_question['operator4']!='')
                                                @if($arr_question['operator4'] != '/')
                                                  {{$arr_question['operator4']}}
                                                @else
                                                  &#247;
                                                @endif
                                              @endif
                                             {{isset($arr_question['digit4_2']) && $arr_question['digit4_2']!='' ? $arr_question['digit4_2'] : 0 }}
                                             </b>
                                         </div>
                                        
                                          <input class="input-number actual-ans" type="text" style="text-align: center;" value="{{$arr_question['answer4']}}" disabled="true" data-answer="{{$arr_question['answer4']}}" name="question4" maxlength="{{strlen($arr_question['answer4'])}}">
                                          
                                     </div>
                                 </div>
                               @endif
                               @if(isset($arr_question['digit6_1']) && $arr_question['digit6_1']!='')
                                 <div class="division-wrapper">
                                     <div class="division-block">
                                         <div class="division-num">
                                             <b>{{isset($arr_question['digit6_1']) && $arr_question['digit6_1']!='' ? $arr_question['digit6_1'] : 0 }}</b>
                                             <b>
                                              @if($arr_question['operator6'] && $arr_question['operator6']!='')
                                                @if($arr_question['operator6'] != '/')
                                                  {{$arr_question['operator6']}}
                                                @else
                                                  &#247;
                                                @endif
                                              @endif
                                             {{isset($arr_question['digit6_2']) && $arr_question['digit6_2']!='' ? $arr_question['digit6_2'] : 0 }}</b>
                                         </div>
                                         
                                          <input class="input-number actual-ans" type="text" style="text-align: center;" value="{{$arr_question['answer6']}}" disabled="true" data-answer="{{$arr_question['answer6']}}" name="question6" maxlength="{{strlen($arr_question['answer6'])}}">
                                       
                                     </div>
                                 </div>
                               @endif
                            </div>
                             
                        </div>
                    </div>
                </div>                                
                <div class="clearfix"></div>
            </div>
           
            <span id="flashcontent"></span>          
            <div class="row">
              <div class="col-md-6 col-lg-6">
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
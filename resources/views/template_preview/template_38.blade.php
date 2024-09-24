@if(isset($arr_question) && count($arr_question)>0)
@php $uniqid = uniqid();  @endphp 
@php
    $arr_time = explode(':',$arr_question['duration']);
    $minutes  = $arr_time['1'];
    $seconds  = $arr_time['2'];
@endphp
<link href="{{ url('/') }}/css/admin/template-css.css" rel="stylesheet" type="text/css" />
    <!--middle section-->
    <div class="middle-section temp-36-main-section temp-38-main-section">
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
                           <div class="temp-36-img">
                               @if(isset($arr_question['question_file']) && $arr_question['question_file']!='')
                                @php $result = get_image_public_path($arr_question['question_file'],'image');  @endphp
                                <img src="{{$result['image_url']}}" alt="tamplate 38" />
                               @endif 
                           </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="game-fill-text-section">
                            <div class="fill-txt-section">
                              @if(isset($arr_question['question_1']) && $arr_question['question_1']!='')
                                 <div class="temp-38-textblock-w">
                                     <div class="temp-38-textblock">
                                         <p>{{ucfirst($arr_question['question_1'])}}</p>
                                        
                                            <input class="input-number actual-ans" type="text" style="text-align: center;" value="{{$arr_question['answer_1']}}" disabled="true" data-answer="{{$arr_question['answer_1']}}" name="question1" maxlength="{{strlen($arr_question['answer_1'])}}">
                                         
                                     </div>
                                 </div>
                               @endif
                               @if(isset($arr_question['question_2']) && $arr_question['question_2']!='')
                                 <div class="temp-38-textblock-w">
                                     <div class="temp-38-textblock">
                                         <p>{{ucfirst($arr_question['question_2'])}}</p>
                                 
                                            <input class="input-number actual-ans" type="text" style="text-align: center;" value="{{$arr_question['answer_2']}}" disabled="true" data-answer="{{$arr_question['answer_2']}}" name="question2" maxlength="{{strlen($arr_question['answer_2'])}}">
                                     
                                     </div>
                                 </div>
                               @endif
                               @if(isset($arr_question['question_3']) && $arr_question['question_3']!='')
                                 <div class="temp-38-textblock-w">
                                     <div class="temp-38-textblock">
                                         <p>{{ucfirst($arr_question['question_3'])}}</p>
                                        
                                            <input class="input-number actual-ans" type="text" style="text-align: center;" value="{{$arr_question['answer_3']}}" disabled="true" data-answer="{{$arr_question['answer_3']}}" name="question3" maxlength="{{strlen($arr_question['answer_3'])}}">
                                        
                                     </div>
                                 </div>
                               @endif
                               @if(isset($arr_question['question_4']) && $arr_question['question_4']!='')
                                 <div class="temp-38-textblock-w">
                                     <div class="temp-38-textblock">
                                         <p>{{ucfirst($arr_question['question_4'])}}</p>
                                         
                                            <input class="input-number actual-ans" type="text" style="text-align: center;" value="{{$arr_question['answer_4']}}" disabled="true" data-answer="{{$arr_question['answer_4']}}" name="question4" maxlength="{{strlen($arr_question['answer_4'])}}">
                                         
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
                <div class="col-sm-12 col-md-12 col-lg-12">
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
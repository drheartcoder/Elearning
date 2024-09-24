@if(isset($arr_question) && count($arr_question)>0)
@php
    $arr_time = explode(':',$arr_question['duration']);
    $minutes  = $arr_time['1'];
    $seconds  = $arr_time['2'];
@endphp
@php $uniqid = uniqid();  @endphp 
<script>window.MathJax = { MathML: { extensions: ["mml3.js", "content-mathml.js"]}};</script>
<link href="{{ url('/') }}/css/admin/template-css.css" rel="stylesheet" type="text/css" />

    <!--middle section-->
    <div class="middle-section temp-41-main-section temp-49-main-section">
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
                            <div class="temp-41-ques-text">{{isset($arr_question['question']) && $arr_question['question']!='' ? ucwords($arr_question['question']) : "N/A" }}</div>
                            <div class="equation-block">                                
                                <div class="question-nos-section">
                                    <div class="equa-num">
                                        <b>{!! isset($arr_question['question_1']) && $arr_question['question_1']!='' ? ucwords($arr_question['question_1']) : "N/A" !!}</b>
                                    </div>                                                                           
                                </div>
                                <div class="radio-btns">  
                                    @if(isset($arr_question['option_1']) && $arr_question['option_1']!="")
                                    <div class="radio-btn">
                                        <input type="radio" id="f-option" name="template49_checkbox" value="1" disabled="true" @if($arr_question['answer']==1) checked="true" @endif>
                                        <label for="f-option">
                                            <span class="equation-block">
                                                <span class="equa-num">
                                                    {!! isset($arr_question['option_1']) && $arr_question['option_1']!='' ? ucwords($arr_question['option_1']) : "N/A" !!}
                                                </span> 
                                            </span>
                                        </label>
                                        <div class="check"></div>
                                    </div>
                                    @endif
                                     @if(isset($arr_question['option_2']) && $arr_question['option_2']!="")
                                    <div class="radio-btn">
                                        <input type="radio" id="s-option" name="template49_checkbox" value="2" disabled="true" @if($arr_question['answer']==2) checked="true" @endif>
                                        <label for="s-option">
                                            <span class="equation-block">
                                                <span class="equa-num">
                                                    {!! isset($arr_question['option_2']) && $arr_question['option_2']!='' ? ucwords($arr_question['option_2']) : "N/A" !!}
                                                </span> 
                                            </span>
                                        </label>
                                        <div class="check"></div>
                                    </div>
                                    @endif
                                     @if(isset($arr_question['option_3']) && $arr_question['option_3']!="")
                                    <div class="radio-btn">
                                        <input type="radio" id="t-option" name="template49_checkbox" value="3" disabled="true" @if($arr_question['answer']==3) checked="true" @endif>
                                        <label for="t-option">
                                            <span class="equation-block">
                                                <span class="equa-num">
                                                    {!! isset($arr_question['option_3']) && $arr_question['option_3']!='' ? ucwords($arr_question['option_3']) : "N/A" !!}
                                                </span> 
                                            </span>
                                        </label>
                                        <div class="check"></div>
                                    </div>
                                    @endif
                                     @if(isset($arr_question['option_4']) && $arr_question['option_4']!="")
                                    <div class="radio-btn">
                                        <input type="radio" id="ft-option" name="template49_checkbox" value="4" disabled="true" @if($arr_question['answer']==4) checked="true" @endif>
                                        <label for="ft-option">
                                            <span class="equation-block">
                                                <span class="equa-num">
                                                    {!! isset($arr_question['option_4']) && $arr_question['option_4']!='' ? ucwords($arr_question['option_4']) : "N/A" !!}
                                                </span> 
                                            </span>
                                        </label>
                                        <div class="check"></div>
                                    </div>
                                    @endif
                                </div>                                
                            </div>                            
                        </div>
                    </div>                    
                </div>                         
                <div class="clearfix"></div>
            </div>
            <div class="row">
                <div class="col-md-6 col-lg-6"></div>
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
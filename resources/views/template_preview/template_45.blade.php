@if(isset($arr_question) && count($arr_question)>0)
@php
    $arr_time = explode(':',$arr_question['duration']);
    $minutes  = $arr_time['1'];
    $seconds  = $arr_time['2'];
@endphp
@php
    $uniqid = uniqid();
    $question1    = $question2 = $question3 = $question4 = $question5 = $question6 = '';
    if(isset($arr_question['question1_1']) && $arr_question['question1_1']!=''){
      $str_options1 = $arr_question['answer1_1'];
      $arr_options1 = explode(',',$str_options1);
      $question1    = $arr_question['question1_1'];
    }
    if(isset($arr_question['question1_2']) && $arr_question['question1_2']!=''){
      $str_options2 = $arr_question['answer1_2'];
      $arr_options2 = explode(',',$str_options2);
      $question2    = $arr_question['question1_2'];
    }
    if(isset($arr_question['question1_3']) && $arr_question['question1_3']!=''){
      $str_options3 = $arr_question['answer1_3'];
      $arr_options3 = explode(',',$str_options3);
      $question3    = $arr_question['question1_3'];
    }
    if(isset($arr_question['question2_1']) && $arr_question['question2_1']!=''){
      $str_options4 = $arr_question['answer2_1'];
      $arr_options4 = explode(',',$str_options4);
      $question4    = $arr_question['question2_1'];
    }
    if(isset($arr_question['question2_2']) && $arr_question['question2_2']!=''){
      $str_options5 = $arr_question['answer2_2'];
      $arr_options5 = explode(',',$str_options5);
      $question5    = $arr_question['question2_2'];
    }
    if(isset($arr_question['question2_3']) && $arr_question['question2_3']!=''){
      $str_options6 = $arr_question['answer2_3'];
      $arr_options6 = explode(',',$str_options6);
      $question6    = $arr_question['question2_3'];
    }
    $maxlength   = 0;
@endphp
@if(isset($arr_options1) && count($arr_options1)>0)
    @foreach($arr_options1 as $key => $val)
        @php
            if($maxlength < strlen($val))
            {
                $maxlength = strlen($val);
            }
        @endphp
            @php $replace    = '<input class="actual-ans" type="text" style="text-align: center" name="question" value="'.strtolower($val).'" disabled="true" />'; @endphp
        @php
         $question1 = preg_replace('/#BLANK#/', $replace, $question1,1);
        @endphp
    @endforeach
@endif

@if(isset($arr_options2) && count($arr_options2)>0)
    @foreach($arr_options2 as $key => $val)
        @php
            if($maxlength < strlen($val))
            {
                $maxlength = strlen($val);
            }
        @endphp
            @php $replace    = '<input class="actual-ans" type="text" style="text-align: center" name="question" value="'.strtolower($val).'" disabled="true" />'; @endphp
        @php
         $question2 = preg_replace('/#BLANK#/', $replace, $question2,1);
        @endphp
    @endforeach
@endif

@if(isset($arr_options3) && count($arr_options3)>0)
    @foreach($arr_options3 as $key => $val)
        @php
            if($maxlength < strlen($val))
            {
                $maxlength = strlen($val);
            }
        @endphp
            @php $replace    = '<input class="actual-ans" type="text" style="text-align: center" name="question" value="'.strtolower($val).'" disabled="true" />'; @endphp
        @php
         $question3 = preg_replace('/#BLANK#/', $replace, $question3,1);
        @endphp
    @endforeach
@endif

@if(isset($arr_options4) && count($arr_options4)>0)
    @foreach($arr_options4 as $key => $val)
        @php
            if($maxlength < strlen($val))
            {
                $maxlength = strlen($val);
            }
        @endphp
            @php $replace    = '<input class="actual-ans" type="text" style="text-align: center" name="question" value="'.strtolower($val).'" disabled="true" />'; @endphp
        @php
         $question4 = preg_replace('/#BLANK#/', $replace, $question4,1);
        @endphp
    @endforeach
@endif

@if(isset($arr_options5) && count($arr_options5)>0)
    @foreach($arr_options5 as $key => $val)
        @php
            if($maxlength < strlen($val))
            {
                $maxlength = strlen($val);
            }
        @endphp
            @php $replace    = '<input class="actual-ans" type="text" style="text-align: center" name="question" value="'.strtolower($val).'" disabled="true" />'; @endphp
        @php
         $question5 = preg_replace('/#BLANK#/', $replace, $question5,1);
        @endphp
    @endforeach
@endif
@if(isset($arr_options6) && count($arr_options6)>0)
    @foreach($arr_options6 as $key => $val)
        @php
            if($maxlength < strlen($val))
            {
                $maxlength = strlen($val);
            }
        @endphp
            @php $replace    = '<input class="actual-ans" type="text" style="text-align: center" name="question" value="'.strtolower($val).'" disabled="true" />'; @endphp
        @php
         $question6 = preg_replace('/#BLANK#/', $replace, $question6,1);
        @endphp
    @endforeach
@endif
<link href="{{ url('/') }}/css/admin/template-css.css" rel="stylesheet" type="text/css" />
<!--middle section-->
<div class="middle-section temp-45-main-section">
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
                    <div class="game-fill-text-section">
                        <div class="fill-txt-section">
                            @if(isset($arr_question['question_1_file']) && $arr_question['question_1_file']!='')
                                @php $result = get_image_public_path($arr_question['question_1_file'],'image');  @endphp
                                <img src="{{$result['image_url']}}" alt="tamplate seven" />
                            @endif
                            <div class="question-txt-secton">
                                @if(isset($arr_question['question1_1']) && $arr_question['question1_1']!='')
                                    <div class="question-section-txt">{!! $question1 !!}</div>
                                @endif
                                @if(isset($arr_question['question1_2']) && $arr_question['question1_2']!='')
                                    <div class="question-section-txt">{!! $question2 !!}</div>
                                @endif
                                @if(isset($arr_question['question1_3']) && $arr_question['question1_3']!='')
                                    <div class="question-section-txt">{!! $question3 !!}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6">
                    <div class="game-fill-text-section">
                        <div class="fill-txt-section">
                            @if(isset($arr_question['question_2_file']) && $arr_question['question_2_file']!='')
                                @php $result = get_image_public_path($arr_question['question_2_file'],'image');  @endphp
                                <img src="{{$result['image_url']}}" alt="tamplate seven" />
                            @endif
                            <div class="question-txt-secton">
                                @if(isset($arr_question['question2_1']) && $arr_question['question2_1']!='')
                                    <div class="question-section-txt">{!! $question4 !!}</div>
                                @endif
                                @if(isset($arr_question['question2_2']) && $arr_question['question2_2']!='')
                                    <div class="question-section-txt">{!! $question5 !!}</div>
                                @endif
                                @if(isset($arr_question['question2_3']) && $arr_question['question2_3']!='')
                                    <div class="question-section-txt">{!! $question6 !!}</div>
                                @endif
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

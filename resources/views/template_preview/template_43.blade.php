@if(isset($arr_question) && count($arr_question)>0)
@php
    $arr_time = explode(':',$arr_question['duration']);
    $minutes  = $arr_time['1'];
    $seconds  = $arr_time['2'];
@endphp
@php
    $uniqid = uniqid();
    
    $question1    = $question2 = $question3 = '';
    if(isset($arr_question['question_1']) && $arr_question['question_1']!=''){
      $str_options1 = $arr_question['answer_1'];
      $arr_options1 = explode(',',$str_options1);
      $question1    = $arr_question['question_1'];
    }
    if(isset($arr_question['question_2']) && $arr_question['question_2']!=''){
      $str_options2 = $arr_question['answer_2'];
      $arr_options2 = explode(',',$str_options2);
      $question2    = $arr_question['question_2'];
    }
    if(isset($arr_question['question_3']) && $arr_question['question_3']!=''){
      $str_options3 = $arr_question['answer_3'];
      $arr_options3 = explode(',',$str_options3);
      $question3    = $arr_question['question_3'];
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
<link href="{{ url('/') }}/css/admin/template-css.css" rel="stylesheet" type="text/css" />
<!--middle section-->
<div class="middle-section temp-43-main-section">
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
                    <div class="game-img-section">
                        <div class="template-43-question-img">
                            @if(isset($arr_question['question_file']) && $arr_question['question_file']!='')
                                @php $result = get_image_public_path($arr_question['question_file'],'image');  @endphp
                                <img src="{{$result['image_url']}}" alt="tamplate seven" />
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6">
                    <div class="game-fill-text-section">
                        <div class="fill-txt-section">
                            @if(isset($arr_question['question_1']) && $arr_question['question_1']!='')
                              <div class="division-wrapper equation-block">
                                  <div class="question-section-txt">                                
                                      {!! $question1 !!}
                                  </div>
                              </div>
                            @endif
                            @if(isset($arr_question['question_2']) && $arr_question['question_2']!='')
                              <div class="division-wrapper equation-block">
                                  <div class="question-section-txt">                                
                                      {!! $question2 !!}
                                  </div>
                              </div>
                            @endif
                            @if(isset($arr_question['question_3']) && $arr_question['question_3']!='')
                              <div class="division-wrapper equation-block">
                                  <div class="question-section-txt">                                
                                      {!! $question3 !!}
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
                    <button >
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

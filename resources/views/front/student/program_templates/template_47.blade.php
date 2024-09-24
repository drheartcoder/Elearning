@if(isset($arr_question) && count($arr_question)>0)
@php
    $uniqid = uniqid();
    $arr_position = [];
    $arr_question_text = [];
    
    if(isset($arr_question['template47']['answer']) && $arr_question['template47']['answer']!='')
    {
        $arr_position = explode(',',$arr_question['template47']['answer']);
    }
    if(isset($arr_question['template47']['question_text']) && $arr_question['template47']['question_text']!='')
    {
        $arr_question_text = explode(',', $arr_question['template47']['question_text']);
    }
@endphp
    <!--middle section-->
    <div class="middle-section temp-41-main-section temp-47-main-section">
        <div class="container">
            <div class="fill-in-the-blank-section">
                <div class="question-section">
                    <div class="question-txt-section">
                        <i class="fa fa-angle-double-right"></i> {{isset($arr_question['template47']['question']) && $arr_question['template47']['question']!='' ? ucwords($arr_question['template47']['question'])." : " : "N/A" }} <br>
                    </div>
                    <div class="question-count">
                        Question: <span>{{$current_question}}/{{$total_question_count}}</span>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-mg-12 col-lg-12">
                        @if($current_question>1)
                        <div class="arrow-prev-section-block" onclick="previousQuestion()">
                            <a href="javascript:void(0);" class="arrow-prev-img">
                                <img class="arrow-img" src="{{url('/')}}/images/template/question-back-arrow-img.png" alt="">
                                <img class="arrow-over-img" src="{{url('/')}}/images/template/question-back-arrow-over-img.png" alt="">
                            </a>
                        </div>
                        @endif
                        @if(count($arr_question_text)>0 && count($arr_position)>0)
                            <div class="game-img-section">
                                <div class="eqation-table">
                                       <table>
                                                <tr>
                                                    <td class="td-input">
                                                    @if($arr_position[0]==1)
                                                        {{$arr_question_text[0]}}
                                                    @else
                                                          @if($arr_question['is_answer']=='yes')
                                                            <input class="correct-ans" type="text" style="text-align: center;" value="{{$arr_question_text[0]}}" disabled="true" data-answer="{{$arr_question_text[0]}}" name="question1" maxlength="{{strlen($arr_question_text[0])}}">
                                                          @else
                                                            <input class="actual-ans questionCls" style="text-align: center;" onkeyup="checkAnswer(this,event)" value="" data-answer="{{$arr_question_text[0]}}" type="text" name="question1" maxlength="{{strlen($arr_question_text[0])}}" />
                                                          @endif
                                                    @endif
                                                    </td>
                                                    <td class="td-input">
                                                    @if($arr_position[1]==1)
                                                        {{$arr_question_text[1]}}
                                                    @else
                                                          @if($arr_question['is_answer']=='yes')
                                                            <input class="correct-ans" type="text" style="text-align: center;" value="{{$arr_question_text[1]}}" disabled="true" data-answer="{{$arr_question_text[1]}}" name="question2" maxlength="{{strlen($arr_question_text[1])}}">
                                                          @else
                                                            <input class="actual-ans questionCls" style="text-align: center;" onkeyup="checkAnswer(this,event)" value="" data-answer="{{$arr_question_text[1]}}" type="text" name="question2" maxlength="{{strlen($arr_question_text[1])}}" />
                                                          @endif
                                                    @endif
                                                    </td>
                                                    <td class="td-input">
                                                    @if($arr_position[2]==1)
                                                        {{$arr_question_text[2]}}
                                                    @else
                                                          @if($arr_question['is_answer']=='yes')
                                                            <input class="correct-ans" type="text" style="text-align: center;" value="{{$arr_question_text[2]}}" disabled="true" data-answer="{{$arr_question_text[2]}}" name="question3" maxlength="{{strlen($arr_question_text[2])}}">
                                                          @else
                                                            <input class="actual-ans questionCls" style="text-align: center;" onkeyup="checkAnswer(this,event)" value="" data-answer="{{$arr_question_text[2]}}" type="text" name="question3" maxlength="{{strlen($arr_question_text[2])}}" />
                                                          @endif
                                                    @endif
                                                    </td>
                                                    <td class="td-input">
                                                    @if($arr_position[3]==1)
                                                        {{$arr_question_text[3]}}
                                                    @else
                                                          @if($arr_question['is_answer']=='yes')
                                                            <input class="correct-ans" type="text" style="text-align: center;" value="{{$arr_question_text[3]}}" disabled="true" data-answer="{{$arr_question_text[3]}}" name="question4" maxlength="{{strlen($arr_question_text[3])}}">
                                                          @else
                                                            <input class="actual-ans questionCls" style="text-align: center;" onkeyup="checkAnswer(this,event)" value="" data-answer="{{$arr_question_text[3]}}" type="text" name="question4" maxlength="{{strlen($arr_question_text[3])}}" />
                                                          @endif
                                                    @endif
                                                    </td>
                                                    <td class="td-input">
                                                    @if($arr_position[4]==1)
                                                        {{$arr_question_text[4]}}
                                                    @else
                                                          @if($arr_question['is_answer']=='yes')
                                                            <input class="correct-ans" type="text" style="text-align: center;" value="{{$arr_question_text[4]}}" disabled="true" data-answer="{{$arr_question_text[4]}}" name="question5" maxlength="{{strlen($arr_question_text[4])}}">
                                                          @else
                                                            <input class="actual-ans questionCls" style="text-align: center;" onkeyup="checkAnswer(this,event)" value="" data-answer="{{$arr_question_text[4]}}" type="text" name="question5" maxlength="{{strlen($arr_question_text[4])}}" />
                                                          @endif
                                                    @endif
                                                    </td>
                                                    <td></td>
                                                    <td class="td-input">
                                                    @if($arr_position[5]==1)
                                                        {{$arr_question_text[5]}}
                                                    @else
                                                          @if($arr_question['is_answer']=='yes')
                                                            <input class="correct-ans" type="text" style="text-align: center;" value="{{$arr_question_text[5]}}" disabled="true" data-answer="{{$arr_question_text[5]}}" name="question6" maxlength="{{strlen($arr_question_text[5])}}">
                                                          @else
                                                            <input class="actual-ans questionCls" style="text-align: center;" onkeyup="checkAnswer(this,event)" value="" data-answer="{{$arr_question_text[5]}}" type="text" name="question6" maxlength="{{strlen($arr_question_text[5])}}" />
                                                          @endif
                                                    @endif
                                                    </td>
                                                    <td class="td-input">
                                                    @if($arr_position[6]==1)
                                                        {{$arr_question_text[6]}}
                                                    @else
                                                          @if($arr_question['is_answer']=='yes')
                                                            <input class="correct-ans" type="text" style="text-align: center;" value="{{$arr_question_text[6]}}" disabled="true" data-answer="{{$arr_question_text[6]}}" name="question7" maxlength="{{strlen($arr_question_text[6])}}">
                                                          @else
                                                            <input class="actual-ans questionCls" style="text-align: center;" onkeyup="checkAnswer(this,event)" value="" data-answer="{{$arr_question_text[6]}}" type="text" name="question7" maxlength="{{strlen($arr_question_text[6])}}" />
                                                          @endif
                                                    @endif
                                                    </td>
                                                    <td class="td-input">
                                                    @if($arr_position[7]==1)
                                                        {{$arr_question_text[7]}}
                                                    @else
                                                          @if($arr_question['is_answer']=='yes')
                                                            <input class="correct-ans" type="text" style="text-align: center;" value="{{$arr_question_text[7]}}" disabled="true" data-answer="{{$arr_question_text[7]}}" name="question8" maxlength="{{strlen($arr_question_text[7])}}">
                                                          @else
                                                            <input class="actual-ans questionCls" style="text-align: center;" onkeyup="checkAnswer(this,event)" value="" data-answer="{{$arr_question_text[7]}}" type="text" name="question8" maxlength="{{strlen($arr_question_text[7])}}" />
                                                          @endif
                                                    @endif
                                                    </td>
                                                    <td class="td-input">
                                                    @if($arr_position[8]==1)
                                                        {{$arr_question_text[8]}}
                                                    @else
                                                          @if($arr_question['is_answer']=='yes')
                                                            <input class="correct-ans" type="text" style="text-align: center;" value="{{$arr_question_text[8]}}" disabled="true" data-answer="{{$arr_question_text[8]}}" name="question9" maxlength="{{strlen($arr_question_text[8])}}">
                                                          @else
                                                            <input class="actual-ans questionCls" style="text-align: center;" onkeyup="checkAnswer(this,event)" value="" data-answer="{{$arr_question_text[8]}}" type="text" name="question9" maxlength="{{strlen($arr_question_text[8])}}" />
                                                          @endif
                                                    @endif
                                                    </td>
                                                    <td class="td-input">
                                                    @if($arr_position[9]==1)
                                                        {{$arr_question_text[9]}}
                                                    @else
                                                          @if($arr_question['is_answer']=='yes')
                                                            <input class="correct-ans" type="text" style="text-align: center;" value="{{$arr_question_text[9]}}" disabled="true" data-answer="{{$arr_question_text[9]}}" name="question10" maxlength="{{strlen($arr_question_text[9])}}">
                                                          @else
                                                            <input class="actual-ans questionCls" style="text-align: center;" onkeyup="checkAnswer(this,event)" value="" data-answer="{{$arr_question_text[9]}}" type="text" name="question10" maxlength="{{strlen($arr_question_text[9])}}" />
                                                          @endif
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
                                                          @if($arr_question['is_answer']=='yes')
                                                            <input class="correct-ans" type="text" style="text-align: center;" value="{{$arr_question_text[10]}}" disabled="true" data-answer="{{$arr_question_text[10]}}" name="question11" maxlength="{{strlen($arr_question_text[10])}}">
                                                          @else
                                                            <input class="actual-ans questionCls" style="text-align: center;" onkeyup="checkAnswer(this,event)" value="" data-answer="{{$arr_question_text[10]}}" type="text" name="question11" maxlength="{{strlen($arr_question_text[10])}}" />
                                                          @endif
                                                    @endif
                                                    </td>
                                                    <td></td>
                                                    <td class="td-input">
                                                    @if($arr_position[11]==1)
                                                        {{$arr_question_text[11]}}
                                                    @else
                                                          @if($arr_question['is_answer']=='yes')
                                                            <input class="correct-ans" type="text" style="text-align: center;" value="{{$arr_question_text[11]}}" disabled="true" data-answer="{{$arr_question_text[11]}}" name="question12" maxlength="{{strlen($arr_question_text[11])}}">
                                                          @else
                                                            <input class="actual-ans questionCls" style="text-align: center;" onkeyup="checkAnswer(this,event)" value="" data-answer="{{$arr_question_text[11]}}" type="text" name="question12" maxlength="{{strlen($arr_question_text[11])}}" />
                                                          @endif
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
                                                          @if($arr_question['is_answer']=='yes')
                                                            <input class="correct-ans" type="text" style="text-align: center;" value="{{$arr_question_text[12]}}" disabled="true" data-answer="{{$arr_question_text[12]}}" name="question13" maxlength="{{strlen($arr_question_text[12])}}">
                                                          @else
                                                            <input class="actual-ans questionCls" style="text-align: center;" onkeyup="checkAnswer(this,event)" value="" data-answer="{{$arr_question_text[12]}}" type="text" name="question13" maxlength="{{strlen($arr_question_text[12])}}" />
                                                          @endif
                                                    @endif
                                                    </td>
                                                    <td class="td-input">
                                                    @if($arr_position[13]==1)
                                                        {{$arr_question_text[13]}}
                                                    @else
                                                          @if($arr_question['is_answer']=='yes')
                                                            <input class="correct-ans" type="text" style="text-align: center;" value="{{$arr_question_text[13]}}" disabled="true" data-answer="{{$arr_question_text[13]}}" name="question14" maxlength="{{strlen($arr_question_text[13])}}">
                                                          @else
                                                            <input class="actual-ans questionCls" style="text-align: center;" onkeyup="checkAnswer(this,event)" value="" data-answer="{{$arr_question_text[13]}}" type="text" name="question14" maxlength="{{strlen($arr_question_text[13])}}" />
                                                          @endif
                                                    @endif
                                                    </td>
                                                    <td class="td-input">
                                                    @if($arr_position[14]==1)
                                                        {{$arr_question_text[14]}}
                                                    @else
                                                          @if($arr_question['is_answer']=='yes')
                                                            <input class="correct-ans" type="text" style="text-align: center;" value="{{$arr_question_text[14]}}" disabled="true" data-answer="{{$arr_question_text[14]}}" name="question15" maxlength="{{strlen($arr_question_text[14])}}">
                                                          @else
                                                            <input class="actual-ans questionCls" style="text-align: center;" onkeyup="checkAnswer(this,event)" value="" data-answer="{{$arr_question_text[14]}}" type="text" name="question15" maxlength="{{strlen($arr_question_text[14])}}" />
                                                          @endif
                                                    @endif
                                                    </td>
                                                    <td class="td-input">
                                                    @if($arr_position[15]==1)
                                                        {{$arr_question_text[15]}}
                                                    @else
                                                          @if($arr_question['is_answer']=='yes')
                                                            <input class="correct-ans" type="text" style="text-align: center;" value="{{$arr_question_text[15]}}" disabled="true" data-answer="{{$arr_question_text[15]}}" name="question16" maxlength="{{strlen($arr_question_text[15])}}">
                                                          @else
                                                            <input class="actual-ans questionCls" style="text-align: center;" onkeyup="checkAnswer(this,event)" value="" data-answer="{{$arr_question_text[15]}}" type="text" name="question16" maxlength="{{strlen($arr_question_text[15])}}" />
                                                          @endif
                                                    @endif
                                                    </td>
                                                    <td class="td-input">
                                                    @if($arr_position[16]==1)
                                                        {{$arr_question_text[16]}}
                                                    @else
                                                          @if($arr_question['is_answer']=='yes')
                                                            <input class="correct-ans" type="text" style="text-align: center;" value="{{$arr_question_text[16]}}" disabled="true" data-answer="{{$arr_question_text[16]}}" name="question17" maxlength="{{strlen($arr_question_text[16])}}">
                                                          @else
                                                            <input class="actual-ans questionCls" style="text-align: center;" onkeyup="checkAnswer(this,event)" value="" data-answer="{{$arr_question_text[16]}}" type="text" name="question17" maxlength="{{strlen($arr_question_text[16])}}" />
                                                          @endif
                                                    @endif
                                                    </td>
                                                    <td></td>
                                                    <td class="td-input">
                                                    @if($arr_position[17]==1)
                                                        {{$arr_question_text[17]}}
                                                    @else
                                                          @if($arr_question['is_answer']=='yes')
                                                            <input class="correct-ans" type="text" style="text-align: center;" value="{{$arr_question_text[17]}}" disabled="true" data-answer="{{$arr_question_text[17]}}" name="question18" maxlength="{{strlen($arr_question_text[17])}}">
                                                          @else
                                                            <input class="actual-ans questionCls" style="text-align: center;" onkeyup="checkAnswer(this,event)" value="" data-answer="{{$arr_question_text[17]}}" type="text" name="question18" maxlength="{{strlen($arr_question_text[17])}}" />
                                                          @endif
                                                    @endif
                                                    </td>
                                                    <td class="td-input">
                                                    @if($arr_position[18]==1)
                                                        {{$arr_question_text[18]}}
                                                    @else
                                                          @if($arr_question['is_answer']=='yes')
                                                            <input class="correct-ans" type="text" style="text-align: center;" value="{{$arr_question_text[18]}}" disabled="true" data-answer="{{$arr_question_text[18]}}" name="question19" maxlength="{{strlen($arr_question_text[18])}}">
                                                          @else
                                                            <input class="actual-ans questionCls" style="text-align: center;" onkeyup="checkAnswer(this,event)" value="" data-answer="{{$arr_question_text[18]}}" type="text" name="question19" maxlength="{{strlen($arr_question_text[18])}}" />
                                                          @endif
                                                    @endif
                                                    </td>
                                                    <td class="td-input">
                                                    @if($arr_position[19]==1)
                                                        {{$arr_question_text[19]}}
                                                    @else
                                                          @if($arr_question['is_answer']=='yes')
                                                            <input class="correct-ans" type="text" style="text-align: center;" value="{{$arr_question_text[19]}}" disabled="true" data-answer="{{$arr_question_text[19]}}" name="question20" maxlength="{{strlen($arr_question_text[19])}}">
                                                          @else
                                                            <input class="actual-ans questionCls" style="text-align: center;" onkeyup="checkAnswer(this,event)" value="" data-answer="{{$arr_question_text[19]}}" type="text" name="question20" maxlength="{{strlen($arr_question_text[19])}}" />
                                                          @endif
                                                    @endif
                                                    </td>
                                                    <td class="td-input">
                                                    @if($arr_position[20]==1)
                                                        {{$arr_question_text[20]}}
                                                    @else
                                                          @if($arr_question['is_answer']=='yes')
                                                            <input class="correct-ans" type="text" style="text-align: center;" value="{{$arr_question_text[20]}}" disabled="true" data-answer="{{$arr_question_text[20]}}" name="question20" maxlength="{{strlen($arr_question_text[20])}}">
                                                          @else
                                                            <input class="actual-ans questionCls" style="text-align: center;" onkeyup="checkAnswer(this,event)" value="" data-answer="{{$arr_question_text[20]}}" type="text" name="question20" maxlength="{{strlen($arr_question_text[20])}}" />
                                                          @endif
                                                    @endif
                                                    </td>
                                                    <td class="td-input">
                                                    @if($arr_position[21]==1)
                                                        {{$arr_question_text[21]}}
                                                    @else
                                                          @if($arr_question['is_answer']=='yes')
                                                            <input class="correct-ans" type="text" style="text-align: center;" value="{{$arr_question_text[21]}}" disabled="true" data-answer="{{$arr_question_text[21]}}" name="question20" maxlength="{{strlen($arr_question_text[21])}}">
                                                          @else
                                                            <input class="actual-ans questionCls" style="text-align: center;" onkeyup="checkAnswer(this,event)" value="" data-answer="{{$arr_question_text[21]}}" type="text" name="question20" maxlength="{{strlen($arr_question_text[21])}}" />
                                                          @endif
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
                                                          @if($arr_question['is_answer']=='yes')
                                                            <input class="correct-ans" type="text" style="text-align: center;" value="{{$arr_question_text[22]}}" disabled="true" data-answer="{{$arr_question_text[22]}}" name="question20" maxlength="{{strlen($arr_question_text[22])}}">
                                                          @else
                                                            <input class="actual-ans questionCls" style="text-align: center;" onkeyup="checkAnswer(this,event)" value="" data-answer="{{$arr_question_text[22]}}" type="text" name="question20" maxlength="{{strlen($arr_question_text[22])}}" />
                                                          @endif
                                                    @endif
                                                    </td>
                                                    <td></td>
                                                    <td class="td-input">
                                                    @if($arr_position[23]==1)
                                                        {{$arr_question_text[23]}}
                                                    @else
                                                          @if($arr_question['is_answer']=='yes')
                                                            <input class="correct-ans" type="text" style="text-align: center;" value="{{$arr_question_text[23]}}" disabled="true" data-answer="{{$arr_question_text[23]}}" name="question20" maxlength="{{strlen($arr_question_text[23])}}">
                                                          @else
                                                            <input class="actual-ans questionCls" style="text-align: center;" onkeyup="checkAnswer(this,event)" value="" data-answer="{{$arr_question_text[23]}}" type="text" name="question20" maxlength="{{strlen($arr_question_text[23])}}" />
                                                          @endif
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
                                                          @if($arr_question['is_answer']=='yes')
                                                            <input class="correct-ans" type="text" style="text-align: center;" value="{{$arr_question_text[24]}}" disabled="true" data-answer="{{$arr_question_text[24]}}" name="question20" maxlength="{{strlen($arr_question_text[24])}}">
                                                          @else
                                                            <input class="actual-ans questionCls" style="text-align: center;" onkeyup="checkAnswer(this,event)" value="" data-answer="{{$arr_question_text[24]}}" type="text" name="question20" maxlength="{{strlen($arr_question_text[24])}}" />
                                                          @endif
                                                    @endif
                                                    </td>
                                                    <td class="td-input">
                                                    @if($arr_position[25]==1)
                                                        {{$arr_question_text[25]}}
                                                    @else
                                                          @if($arr_question['is_answer']=='yes')
                                                            <input class="correct-ans" type="text" style="text-align: center;" value="{{$arr_question_text[25]}}" disabled="true" data-answer="{{$arr_question_text[25]}}" name="question20" maxlength="{{strlen($arr_question_text[25])}}">
                                                          @else
                                                            <input class="actual-ans questionCls" style="text-align: center;" onkeyup="checkAnswer(this,event)" value="" data-answer="{{$arr_question_text[25]}}" type="text" name="question20" maxlength="{{strlen($arr_question_text[25])}}" />
                                                          @endif
                                                    @endif
                                                    </td>
                                                    <td class="td-input">
                                                    @if($arr_position[26]==1)
                                                        {{$arr_question_text[26]}}
                                                    @else
                                                          @if($arr_question['is_answer']=='yes')
                                                            <input class="correct-ans" type="text" style="text-align: center;" value="{{$arr_question_text[26]}}" disabled="true" data-answer="{{$arr_question_text[26]}}" name="question20" maxlength="{{strlen($arr_question_text[26])}}">
                                                          @else
                                                            <input class="actual-ans questionCls" style="text-align: center;" onkeyup="checkAnswer(this,event)" value="" data-answer="{{$arr_question_text[26]}}" type="text" name="question20" maxlength="{{strlen($arr_question_text[26])}}" />
                                                          @endif
                                                    @endif
                                                    </td>
                                                    <td class="td-input">
                                                    @if($arr_position[27]==1)
                                                        {{$arr_question_text[27]}}
                                                    @else
                                                          @if($arr_question['is_answer']=='yes')
                                                            <input class="correct-ans" type="text" style="text-align: center;" value="{{$arr_question_text[27]}}" disabled="true" data-answer="{{$arr_question_text[27]}}" name="question20" maxlength="{{strlen($arr_question_text[27])}}">
                                                          @else
                                                            <input class="actual-ans questionCls" style="text-align: center;" onkeyup="checkAnswer(this,event)" value="" data-answer="{{$arr_question_text[27]}}" type="text" name="question20" maxlength="{{strlen($arr_question_text[27])}}" />
                                                          @endif
                                                    @endif
                                                    </td>
                                                    <td class="td-input">
                                                    @if($arr_position[28]==1)
                                                        {{$arr_question_text[28]}}
                                                    @else
                                                          @if($arr_question['is_answer']=='yes')
                                                            <input class="correct-ans" type="text" style="text-align: center;" value="{{$arr_question_text[28]}}" disabled="true" data-answer="{{$arr_question_text[28]}}" name="question20" maxlength="{{strlen($arr_question_text[28])}}">
                                                          @else
                                                            <input class="actual-ans questionCls" style="text-align: center;" onkeyup="checkAnswer(this,event)" value="" data-answer="{{$arr_question_text[28]}}" type="text" name="question20" maxlength="{{strlen($arr_question_text[28])}}" />
                                                          @endif
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
                        @if($current_question<$total_question_count)
                          <div class="arrow-next-section-block" @if($arr_question['is_answer']=='yes') onclick="nextQuestion('manual')" @endif> 
                              <a href="javascript:void(0);" class="arrow-next-img">
                                  <img class="arrow-img" src="{{url('/')}}/images/template/question-next-arrow-img.png" alt="" />
                                  <img class="arrow-over-img" src="{{url('/')}}/images/template/question-next-arrow-over-img.png" alt="" />
                              </a>
                          </div>
                        @endif
                    </div>                    
                </div>                               
                <div class="clearfix"></div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="specker-mic-section" style="display: none">
                        <button onclick="togglePlay()" id="hornButton">
                            <img src="{{url('/')}}/images/template/specker-icon-img.png" alt="speaker-icon" />
                            <audio id="horn" src="{{$question_audio_public_path.$arr_question['template47']['horn']}}"></audio>
                        </button>
                        <button @if($arr_question['is_answer']=='no') id="recordButton" @endif data-id="no">
                            <img src="{{url('/')}}/images/template/mic-icon-img.png" alt="mic-icon" />
                            <img class="red-ring" src="{{url('/')}}/images/recording-ring.png" alt="mic-icon" />
                        </button>
                    </div>
                </div>
                <div class="col-sm-12 col-md-5 col-lg-6 tab-view-adjustment">
                    <div class="error-message-section error-show" style="display: none;" id="wrong_answer_msg_box">
                        <span class="error-img-section">
                            <img src="{{url('/')}}/images/template/error-oops-img.png" alt="error-img" />
                        </span>
                        <span class="error-txt-section">
                            Oops, Try again!
                        </span>
                    </div>
                    <div class="error-message-section" style="display: none;" id="right_answer_msg_box">
                        <span class="error-img-section">
                            <img src="{{url('/')}}/images/template/error-funtastic-img.png" alt="error-img" />
                        </span>
                        <span class="error-txt-section" id="right_answer_msg"></span>
                    </div>
                    <div class="error-message-section" style="display: none;" id="answer_not_recorded_msg_box">
                        <span class="error-img-section">
                            <img src="{{url('/')}}/images/template/error-funtastic-img.png" alt="error-img" />
                        </span>
                        <span class="error-txt-section"> Please Record your voice!</span>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3 col-lg-3">
                    <div class="timer-section">
                        <div class="time-head-section">
                            <span>Min</span>
                            <span>Sec</span>
                        </div>
                        <div class="hm-timer-section">
                            <span id="hm_timer_{{$uniqid}}"></span>
                        </div>
                        <input type="hidden" name="remaining_minutes" id="remaining_minutes" readonly="" value="">
                        <input type="hidden" name="remaining_seconds" id="remaining_seconds" readonly="" value="">
                    </div>                     
                </div>
            </div>
            <span id="flashcontent"></span>                       
        </div>
    </div>
    <!--middle section end-->
    
    @php
        if($arr_question['is_answer']=='yes' || $arr_question['is_delay']=='yes')
        {
            $hours = $minutes = $seconds = 0;
        }
        else
        {
            $hours       = date('H',strtotime($arr_question['template47']['duration']));
            $minutes     = date('i',strtotime($arr_question['template47']['duration']));
            $seconds     = date('s',strtotime($arr_question['template47']['duration']));
        }
        $actual_time = $arr_question['template47']['duration'];
        $template_id = base64_encode($arr_question['template_id']);
        $question_id = base64_encode($arr_question['question_id']);
    @endphp
@endif
<script type="text/javascript">
    
    var t_minutes                     = "{{$minutes}}";
    var t_seconds                     = "{{$seconds}}";
    var actual_time                   = "{{$actual_time}}";
    var program_id                    = "{{$program_id}}";
    var lesson_id                     = "{{$lesson_id}}";
    var template_id                   = "{{$template_id}}";
    var question_id                   = "{{$question_id}}";
    var next_question_template_id     = "{{$next_question_template_id}}";
    var next_question_id              = "{{$next_question_id}}";
    var previous_question_template_id = "{{$previous_question_template_id}}";
    var previous_question_id          = "{{$previous_question_id}}";
    var temp_id                       = "{{$arr_question['template_id']}}";
    var storage_id                    = "{{$arr_question['id']}}";
    var uniqid                        = "{{$uniqid}}";
    var is_answer                     = "{{$arr_question['is_answer']}}";
    var is_delay                      = "{{$arr_question['is_delay']}}";
    var question_audio_base_path      = "{{$question_audio_base_path}}";
</script>
<script type="text/javascript" src="{{url('/')}}/js/front/custom/template.js"></script>

<link rel="stylesheet" type="text/css" href="{{url('/')}}/css/front/jquery.countdownTimer.css" />
<script type="text/javascript" src="{{url('/')}}/js/MathJax-master/MathJax.js?config=TeX-AMS-MML_HTMLorMML" ></script>
<script type="text/javascript" src="{{url('/')}}/js/MathJax-master/MathJax.js?config=TeX-AMS_HTML" ></script> 
<script type="text/javascript">
    
    $(':input:enabled:visible:first').focus();
    
    function checkAnswer(ref,event)
    {
        var maxlength = $(ref).attr('maxlength');
        $(ref).val($.trim($(ref).val()));
        if($(ref).val().length==1){
            $(ref).nextAll('input').first().focus();
        }
        var key = event.keyCode || event.charCode;
        if( key == 8)
        {
            $(ref).prevAll('input').first().focus();
        }

        $(ref).removeClass('wrong-ans');
        $(ref).removeClass('correct-ans');
        $(ref).addClass('actual-ans');
        
        var given_answer  = $(ref).val();
        var actual_answer = $(ref).data('answer');
        if(given_answer!='')
        {
            given_answer = given_answer;
            actual_answer = actual_answer;
            if(given_answer==actual_answer && maxlength==given_answer.length)
            {
                $(ref).removeClass('wrong-ans');
                $(ref).removeClass('actual-ans');
                $(ref).addClass('correct-ans');
                $(ref).attr('disabled',true);
            }
            if(given_answer!=actual_answer && maxlength==given_answer.length)
            {
                $(ref).addClass('wrong-ans');
                $(ref).removeClass('actual-ans');
                $(ref).removeClass('correct-ans');
                
                if ((key > 64 && key < 91) || (key > 96 && key < 123)) {
                    insertWrongAttempts();
                }
            }
        }
        checkFinalAnswer();
    }
    /* Check If given answer is right or not and change classes */
    //checkFinalAnswer();
    function checkFinalAnswer()
    {
        var isAudioRequired    = $('#recordButton').data('id');
        $('#wrong_answer_msg_box').hide();
        $('#right_answer_msg_box').hide();
        $('#answer_not_recorded_msg_box').hide();

        if($('.actual-ans').length == $('.questionCls').length)
        {
            $('#wrong_answer_msg_box').hide();
        }
        if($('.wrong-ans').length > 0)
        {
            $('#wrong_answer_msg_box').show();
            return false;
        }
        if($('.correct-ans').length == $('.questionCls').length)
        {
            $('.questionCls').attr('disabled',true);
            if(isAudioRequired=='yes')
            {
                if(sessionStorage.getItem('isRecorded_'+storage_id)=='no')
                {
                    $('#wrong_answer_msg_box').hide();
                    $('#answer_not_recorded_msg_box').show();
                    return false;
                }
            }
            var success_msg = getSuccessMessage();
            $('#right_answer_msg').html(success_msg);
            $('#right_answer_msg_box').show();
            
            setTimeout(function(){
              nextQuestion('save');
            }, 1000);
        }
    }
    /* Check If given answer is right or not and change classes ends here */

    /* Return the randomly generated success messages */
    var success_messages = ["Good Job!", "Great!", "Awesome!", "Superb!", "Fantastic!"];
    function getSuccessMessage() {
       return success_messages[Math.floor(Math.random() * success_messages.length)];
    }

    /* When Timer is Over starts here */
    if(is_answer=='no' && is_delay=='yes')
    {
        $('.questionCls').each(function(){
              $(this).attr('placeholder',$(this).data('answer'));
        });
    }
    function timeisUp()
    {
        if(is_answer=='no')
        {
            $('.questionCls').each(function(){
                $(this).attr('placeholder',$(this).data('answer'));
            });
        
            $.ajax({
                  type: 'POST',
                  url: SITE_URL+'/student/program/update_delay_flag',
                  data: {
                            _token      : csrf_token,
                            program_id  : program_id,
                            lesson_id   : lesson_id,
                            template_id : template_id,
                            question_id : question_id
                        },
                  success: function(resultData)
                  {
                }
            });
        }
    }
    /* When Timer is Over ends here */

</script>
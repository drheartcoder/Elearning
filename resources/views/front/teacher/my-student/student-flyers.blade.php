@include('front.layout.bredcrum') 
<!-- bredcrum section end -->
<div class="gray-btn-main-section my-student-middle-section change-program-main">
    <div class="container">            
        <div class="row">
            <div class="col-sm-4 col-md-3 col-lg-3">
                @include('front.layout.left_bar')
            </div>
            <div class="col-sm-8 col-md-9 col-lg-9"> 
                @include('front.layout._operation_status')                   
                @if(isset($student_arr['data']) && count($student_arr['data'])>0)                
                <div class="row responsive-margin">
                    <div class="col-sm-8 col-md-8 col-lg-8 p-r-5">
                        <div class="select-the-flyers-section">
                           {{trans('teacher.flyers_print_note_message')}} 
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4 col-lg-4 p-l-5 tab-view-pl-change">
                        <div class="change-program-cancel-done-btn">
                            <!-- <button type="button" class="full-fill-button sim-button" onclick="printFlyers('FrmStudentFlyer','send')"> {{trans('teacher.Send')}} </button> -->
                            <button type="button" class="full-fill-button sim-button pull-right" onclick="printFlyers('FrmStudentFlyer','print')">{{trans('parent.Print')}}</button>

                             <button type="button" id="btn_export_data" class="full-orng-btn btn-width-adjustment sim-button m-0"><i class="fas fa-file-excel"></i> {{trans('parent.Export')}}</button>                            
                            @if(Session::has('file'))                                                        
                            <script type="text/javascript">
                                $(document).ready(function(){
                                    window.open('{{Session::get("file")}}', '_blank');                                   
                                });
                            </script>
                            @endif
                        </div>
                    </div>                        
                </div>        
                <div class="table-responsive table-scroll-section">
                    <form id="FrmStudentFlyer" method="post" action="{{url('/teacher/send-multiple-flyers')}}">    
                        {{csrf_field()}}
                        <input type="hidden" name="indi_flyer_email" id="indi_flyer_email" value="">
                        <table class="table students-list-section">                            
                            <tr>
                                <th>
                                    <div class="check-block">
                                        <input id="filled-in-box" class="filled-in" type="checkbox" onclick="selectAll(this);">
                                        <label for="filled-in-box"></label>
                                    </div>
                                </th>
                                <th>{{trans('teacher.Student')}}</th>
                                <th>{{trans('teacher.Pin')}}</th>
                                <th>{{trans('parent.Grade')}}</th>
                                <th>{{trans('parent.Subject')}}</th>
                                <th>{{trans('auth.Enrollment_Code')}}</th>
                                <th>{{trans('teacher.Enrolled')}}</th>
                                <th>{{trans('parent.Program')}}</th>
                                <th>{{trans('teacher.Language')}}</th> 
                                <th>{{trans('parent.Action')}}</th>                                    
                            </tr>       
                            <input type="hidden" name="enc_class_id" readonly="" value="{{$enc_id}}">
                            <input type="hidden" name="multi_action" id="multi_action" value="">
                                @foreach($student_arr['data'] as $row)    
                  
                                <tr>
                                    <td>
                                        <div class="check-block">
                                            <input id="filled-in-box{{$row['id']}}" class="filled-in checked_record" type="checkbox" name="checked_record[]" data-parent-id ="{{$row['subject_parent_data']['parent_id']}}"  value="{{$row['student_id']}}">
                                            <label for="filled-in-box{{$row['id']}}"></label>                                            
                                            <input type="hidden" name="parent_{{$row['student_id']}}" id="parent_{{$row['id']}}" value="{{$row['subject_parent_data']['parent_id']}}">
                                        </div>                                        
                                    </td>
                                    <td>
                                        {{ ucfirst($row['student_data']['first_name'].' '.$row['student_data']['last_name']) }}
                                    </td>
                                    <td>
                                        {{ $row['student_data']['pin'] or '' }}
                                    </td>
                                    <td>
                                        {{ $row['class_data']['grade_data']['name']  or '' }}
                                    </td>
                                    <td>
                                        {{ $row['class_data']['subject_data']['name'] or '' }}
                                    </td>
                                    <td>{{ $row['student_data']['enrollment_code'] or '' }}</td>
                                    <td>
                                        @if($row['subject_parent_data']['parent_id']!='0')
                                        <span class="enrolled-check-img"></span>
                                        @else
                                        {{ '-' }}
                                        @endif
                                        
                                    </td>
                                    <td>{{ $row['class_data']['program_details']['name'] or '' }}</td>
                                    <td>
                                        <div class="form-group" style="margin-bottom: 0;">                                            
                                            <div class="name-field">
                                                <select name="language[{{$row['student_id']}}]" class="language">
                                                    @if(isset($lang_arr) && count($lang_arr)>0)
                                                        @foreach($lang_arr as $lang)                                                        
                                                        <option value="{{$lang['locale']}}">{{$lang['title']}}</option>

                                                        @endforeach
                                                    @endif                                                    
                                                </select>
                                                <i class="fa fa-angle-down"></i>
                                            </div>
                                        </div>
                                    </td>  
                                    <td>
                                        @if($row['subject_parent_data']['parent_id']=='0')
                                        <button type="button" class="full-fill-button sim-button" onclick="sendFlyers({{$row['id']}})"> {{trans('teacher.Send')}} </button>
                                        @else
                                        <button type="button" disabled="disabled" class="full-fill-button sim-button"> {{trans('teacher.Send')}} </button>
                                        @endif
                                    </td>                                  
                                </tr>
                                @endforeach                            
                        </table>
                    </form>
                </div>
                @else
                <table style="width: 100%;max-width: 100%;">
                    <tr>
                        <td colspan="4">
                            <div class="no-record">
                               {{trans('parent.No_Record_Found')}}
                            </div>
                        </td>                                                                      
                    </tr>
                </table>
                @endif          
                <div class="pagination-section-block">                        
                    <ul>
                        {!! $pagination_links_arr !!}
                    </ul>                        
                </div>
            </div>
        </div>                                   
    </div>
</div>

<div id="PrintStudentFlyers" class="modal fade inner-page-modal remove-class-modal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <!-- <button type="button" class="close" data-dismiss="modal"></button> -->
                <!-- <div class="modal-head-section">
                    Print Flyers
                </div> -->
                <div class="remove-modal-txt-block">
                    {{trans('teacher.Please_select_atleast_one_record')}}
                </div>                
                <div class="modal-button-section">                        
                    <button type="submit" id="btn_delete_class" class="full-fill-button sim-button" data-dismiss="modal">{{trans('teacher.Ok')}}</button>
                </div>                
            </div>
        </div>
    </div>
</div>


<div id="StudentFlyersEmail" class="modal fade inner-page-modal remove-class-modal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-group">
                    <input type="text" class="form-control" id="flyer_email" name="flyer_email" placeholder="{{trans('auth.Email')}}" maxlength="50" />
                    <span class="error" id="err_flyer_email"></span>
                </div>
                <div class="modal-button-section">                        
                    <button type="button" onclick="cancelFlyers()" class="full-fill-button border-button sim-button-blue" data-dismiss="modal">{{trans('auth.Cancel')}}</button>
                    <button type="button" id="sendFlyersInd" onclick="printFlyers('FrmStudentFlyer','send','individual')" class="full-fill-button sim-button">{{trans('teacher.Send')}}</button>
                </div>                
            </div>
        </div>
    </div>
</div>
<form id="export_form" method="post" action="{{ url('/') }}/teacher/my-student/export-csv">
    {{ csrf_field() }}
    <input type="hidden" name="enc_class_id"   id="enc_class_id"   value="{{ $class_id or ''  }}" />
</form>
<script type="text/javascript">
    function selectAll(ref)
    {       
        if($(ref).prop('checked') == true)
        {
            $('input[type="checkbox"]').prop('checked',true);
        }
        else
        {
            $('input[type="checkbox"]').prop('checked',false);
        }
    }

    function printFlyers(frm_id,action,individual = false)
    {
        var Enter_your_email  = '<?php echo trans("auth.Enter_your_email"); ?>';
        var Enter_valid_email = '<?php echo trans("auth.Enter_valid_email"); ?>';

        $('#err_flyer_email').html('');
        var len = $('input[name="checked_record[]"]:checked').length;    
        var flag=1;
        if(len<=0)
        {
            $('#PrintStudentFlyers').modal('show');
            return false;
        }
        if(individual == 'individual'){
            var indi_flyer_email = $('#flyer_email').val();
            var filter   = /^[a-zA-Z0-9._-]+@([a-zA-Z0-9.-]+\.)+[a-zA-Z0-9.-]{2,4}$/;
            if(indi_flyer_email ==""){
                $('#err_flyer_email').html(Enter_your_email);
                return false;
            }
            if(indi_flyer_email !="" && !filter.test(indi_flyer_email)){
                $('#err_flyer_email').html(Enter_valid_email);
                return false;
            }
        }
        var frm_ref = $("#"+frm_id);
        $('#multi_action').val(action);        
        $(frm_ref)[0].submit();
    }  
    function sendFlyers(student_id){
        $('.checked_record').prop( "checked", false );
        $('#filled-in-box'+student_id).prop( "checked", true );
        $('#StudentFlyersEmail').modal({backdrop: 'static', keyboard: false}); 
        $('#StudentFlyersEmail').modal('show');
        $('#indi_flyer_email').val('');
        $('#err_flyer_email').html('');
    }
    function cancelFlyers(){
        $('.checked_record').prop( "checked", false );
        $('#indi_flyer_email').val('');
        $('#flyer_email').val('');
    }
    $(document).ready(function(){
      $('#indi_flyer_email').val('');  
      $('#flyer_email').keyup(function(){
          $('#indi_flyer_email').val($(this).val());
      });
      $('#flyer_email').blur(function(){
          $('#indi_flyer_email').val($(this).val());
      });

       $("#btn_export_data").click(function(){
            var keyword = $('#keyword').val();

            if(keyword == '') {
                swal({
                    title: "{{trans('teacher.Are_you_sure')}}",
                    text: "{{trans('teacher.Do_you_want_to_export_all_record')}}",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#0f6bb0",
                    confirmButtonText: "{{trans('teacher.Yes')}}",
                    cancelButtonText: "{{trans('teacher.No')}}",
                    closeOnConfirm: true,
                    closeOnCancel: true
                },
                function(isConfirm) {
                    if(isConfirm) {
                        $('#export_form').submit();
                    }
                });
            } else {
                $('#export_keyword').val(keyword);
                $('#export_form').submit();
            }
        });
    });
</script>

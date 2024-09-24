<!-- bredcrum section -->
    <div class="bredcrum-section-main">
        <div class="container">
            <div class="page-title-main">
                {{$pageTitle}}
            </div>
            <div class="page-bredcrum-section">
                <ul>                    
                    <li><a href="{{url('/teacher/dashboard')}}"> {{trans('parent.Dashboard')}}</a> &nbsp;&nbsp; <i class="fa fa-angle-right"></i> &nbsp;&nbsp; </li>                    
                    <li>{{$pageTitle}}</li>
                </ul>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
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
                    <div class="row">
                        <div class="col-sm-8 col-md-8 col-lg-8 p-r-5">
                            <div class="select-the-certificates">
                                {{trans('teacher.certificate_print_note_message')}}
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4 col-lg-4 p-l-5 tab-view-pl-change">
                            <div class="change-program-cancel-done-btn">
                                <!-- <button type="button" class="full-fill-button border-button sim-button-blue" data-dismiss="modal">Cancel</button> -->    

                                  <button type="button" id="btn_export_data" class="full-orng-btn btn-width-adjustment sim-button m-0"><i class="fas fa-file-excel"></i> {{trans('parent.Export')}}</button>

                                <button type="button" class="full-fill-button sim-button" onclick="printCertificate('FrmStudentCertificate','print')">{{trans('parent.Print')}}</button>
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
                    <div class="addition-multiplication-button">
                        <a id="sample-pdf" style="max-width: 125px !important;"> {{trans('teacher.Certificate_Sample')}}</a>
                    </div>                    
                    <div class="table-responsive table-scroll-section">
                        <form id="FrmStudentCertificate" method="post" action="{{url('/teacher/print-multiple-certificates')}}">    
                        {{csrf_field()}}
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
                                    <th>{{trans('teacher.Programs')}}</th>
                                    <th>{{trans('auth.Enrollment_Code')}}</th>
                                    <th>{{trans('teacher.Program_Status')}}</th>
                                    <th>{{trans('teacher.Language')}}</th>
                                    <th>{{trans('teacher.Action')}}</th>                                    
                                </tr> 
                                @php $i = 0; @endphp
                                @foreach($student_arr['data'] as $row)     
                                @if(isset($row['student_details']['classes_data']) && sizeof($row['student_details']['classes_data'])>0)     
                                @php $i++; @endphp            
                                <tr>
                                    <td>
                                        <div class="check-block">
                                            <input id="filled-in-box{{$row['student_id'] or ''}}" class="filled-in checked_record" type="checkbox" name="checked_record[]" value="{{$row['student_id']}}">
                                            <label for="filled-in-box{{$row['student_id']  or ''}}"></label>
                                        </div>
                                    </td>
                                    <input type="hidden" name="multi_action" id="multi_action" value="">
                                    <input type="hidden" name="program_name[{{$row['student_id']  or '' }}]" id="program_name_{{$row['student_id'] or ''}}" value="{{$row['program_details']['name']  or ''}}">
                                    <input type="hidden" name="program_id[{{$row['student_id']  or ''}}]" id="program_id_{{$row['student_id']}}" value="{{$row['program_details']['id']  or ''}}">
                                    <td>{{ucfirst($row['student_details']['first_name'].' '.$row['student_details']['last_name'])}}</td>
                                    <td>{{$row['student_details']['pin'] or ''}}</td>
                                    <td>{{$row['program_details']['grade_data']['name'] or ''}}</td>
                                    <td>{{$row['program_details']['subject_data']['name'] or ''}}</td>
                                    <td>{{$row['program_details']['name'] or ''}}</td>
                                    <td>{{$row['student_details']['enrollment_code'] or ''}}</td>
                                    <?php $program_id = isset($row['program_id'])?$row['program_id']:'';  ?>
                                    <?php $student_id = isset($row['student_id'])?$row['student_id']:'';  ?>
                                    <?php $program_status = ''; $program_status = checkProgramStatus($program_id,$student_id); ?>
                                    <td>
                                        @if($program_status=='Completed')
                                            <span class="status-label green-label">{{trans('parent.Completed')}}</span>
                                        @else
                                            <span class="status-label red-label">{{trans('parent.Pending')}}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="form-group" style="margin-bottom: 0;">
                                            <div class="name-field">
                                                <select name="language[{{$row['student_id']  or ''}}]" class="language" data-student_id="{{ $row['student_id']  or '' }}">
                                                    @if(isset($lang_arr) && count($lang_arr)>0)
                                                        @foreach($lang_arr as $lang)                                                        
                                                            <option value="{{$lang['locale']  or ''}}" @if(Session::get('locale')==$lang['locale']) selected @endif>{{$lang['title']  or ''}}</option>
                                                        @endforeach
                                                    @endif                                                    
                                                </select>
                                            </div>
                                        </div>    
                                    </td>

                                    <td>
                                        <!-- <a class="student-list-trash-btn" href="{{url('/teacher/print-certificate/').'/'.base64_encode($row['student_id']).'/'.base64_encode($row['program_details']['name'])  or ''}}"><i class="fa fa-print"></i> </a> -->
                                        <a class="student-list-trash-btn print_btn" id="print_btn_{{$row['student_id']}}" data-student_id="{{ base64_encode($row['student_id']) }}" data-program_name="{{ base64_encode($row['program_details']['name']) }}" data-program_id="{{ base64_encode($row['program_details']['id']) }}" data-language="en"><i class="fa fa-print"></i> </a>
                                    </td>
                                </tr>

                                @endif
                                @endforeach

                            </table>
                            @if(isset($i) && $i==0)
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
    <div id="PrintStudentCertificate" class="modal fade inner-page-modal remove-class-modal" role="dialog">
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
<form id="frm_export" method="post" action="{{ url('/') }}/teacher/export-student-certificates">
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

    function printCertificate(frm_id,action)
    {
        var len = $('input[name="checked_record[]"]:checked').length;    
        var flag=1;
        if(len<=0)
        {
            $('#PrintStudentCertificate').modal('show');
            return false;
        }
        
        var frm_ref = $("#"+frm_id);
        $('#multi_action').val(action);        
        $(frm_ref)[0].submit();
    }  

    $(".print_btn").click(function(){
        var student_id = $(this).data('student_id');
        var program_name = $(this).data('program_name');
        var program_id = $(this).data('program_id');
        var language = $(this).data('language');

        if(language!='' && program_name!='' && student_id!='' && program_id!='')
        {
            window.location.href = SITE_URL+"/teacher/print-certificate/"+student_id+"/"+program_name+"/"+language+"/"+program_id; 
        }
    });

    $('#sample-pdf').on('click',function(){
        window.open(SITE_URL+'/sample-certificate.pdf', '_blank');
    });

    $(".language").on('change',function()
    {
        var value    = $(this).val();
        var stude_id = $(this).attr('data-student_id');

        $('#print_btn_'+stude_id).attr('data-language',value);
    });
     $(document).ready(function(){
        $("#btn_export_data").click(function(){
           $('#frm_export').submit();
        });
    });  
</script>
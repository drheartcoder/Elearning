@include('front.layout.bredcrum')
    <!-- bredcrum section end -->
    <div class="gray-btn-main-section my-student-middle-section teacher-export-share-main">
        <div class="container">            
            <div class="row">
                <div class="col-sm-4 col-md-3 col-lg-3">
                    @include('front.layout.left_bar')
                </div>
                <div class="col-sm-8 col-md-9 col-lg-9">                                                            
                    @include('front.layout._operation_status')
                    <form id="frmShareClass" method="post" action="">
                        {{csrf_field()}}
                        <div class="class-name-head-section">
                            {{$pageTitle}}
                        </div>
                        <div class="select-the-certificates">
                           {{trans('teacher.Share_class_note_message')}}
                        </div>
                        <div class="row">
                            <div class="col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>{{trans('teacher.Teacher_Email')}}</label>
                                    <input type="text" id="share_email" name="share_email" placeholder="{{trans('teacher.Enter_Teacher_Email_Address')}}" class="teacher-email" tabindex="1"/>
                                    <div class="error" id="err_share_email">{{$errors->first('email')}}</div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="classid" id="classid" value="{{Request::segment(3)}}">
                        <div class="button-class">
                            <button type="button" class="full-fill-button border-button sim-button-blue" id="btnShareClassCancel">{{trans('parent.Cancel')}}</button>
                            <button type="submit" class="full-fill-button sim-button" id="btnShareClass" name="btnShareClass">{{trans('teacher.Share')}}</button>
                        </div>
                    </form>
                    <div class="table-responsive table-scroll-section">
                        <table class="table students-list-section">  
                            <thead>
                            <tr>                                
                                <th>{{trans('teacher.Teacher_Email')}}</th>
                                <th>{{trans('teacher.Class_Name')}}</th>
                            </tr>
                            </thead>
                            <tbody class="">                                
                                @if(isset($share_class_info['data']) && count($share_class_info['data'])>0)
                                    @foreach($share_class_info['data'] as $row)
                                    <tr>                                
                                        <td>{{$row['to_teacher']}}</td>
                                        <td>{{$row['class_data']['name']}}</td>                                
                                    </tr>
                                    @endforeach
                                @else                                    
                                <tr>
                                    <td colspan="2" style="width:100%">
                                        <div class="no-record">
                                          {{trans('parent.No_Record_Found')}}
                                        </div>
                                    </td>                                                                      
                                </tr>                                                                        
                                @endif
                            </tbody>
                        </table>
                    </div>                   
                    <div class="pagination-section-block">                        
                        <ul>
                            {!! $pagination_links_arr !!}
                        </ul>                        
                    </div>                    
                </div>
            </div>                                   
        </div>
    </div>   
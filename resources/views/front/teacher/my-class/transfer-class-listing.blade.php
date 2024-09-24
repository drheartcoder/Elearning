 <!-- bredcrum section -->
    <div class="bredcrum-section-main">
        <div class="container">
            <div class="page-title-main">
                {{$pageTitle}}
            </div>
            <div class="page-bredcrum-section">
                <ul>                    
                    <li><a href="{{url('/teacher/dashboard')}}">{{trans('home.Dashboard')}}</a> &nbsp;&nbsp; <i class="fa fa-angle-right"></i> &nbsp;&nbsp; </li>
                    <li>{{$pageTitle}}</li>
                </ul>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <!-- bredcrum section end -->
    <div class="gray-btn-main-section my-student-middle-section">
        <!-- <div class="col-sm-12 col-md-12 col-lg-12"> -->
            <div class="container">            
                <div class="row">
                    <div class="col-sm-4 col-md-3 col-lg-3">
                        @include('front.layout.left_bar')
                    </div>
                    <div class="col-sm-8 col-md-9 col-lg-9">
                        @include('front.layout._operation_status')                  
                        <div class="profile-wrapper">
                            <div class="class-name-head-section">
                                {{$pageTitle}}
                            </div>                       
                            <div class="table-responsive table-scroll-section">
                                <table class="table students-list-section">                              
                                    <thead>
                                    <tr>                                
                                        <th>{{trans('teacher.Teacher_Email')}}</th>
                                        <th>{{trans('teacher.Class_Name')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody class="">       
                                        @if(isset($transfer_class_info['data']) && count($transfer_class_info['data'])>0)
                                            @foreach($transfer_class_info['data'] as $row)
                                            <tr>                                
                                                <td>{{$row['transfer_user_details']['first_name'].' '.$row['transfer_user_details']['last_name']}}</td>
                                                <td>{{$row['name']}}</td>                                
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
        <!-- </div> -->
    </div>   
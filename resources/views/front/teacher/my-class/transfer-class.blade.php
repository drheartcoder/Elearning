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
                            <button type="submit" class="full-fill-button sim-button" id="btnShareClass" name="btnTransferClass">{{trans('teacher.Transfer')}}</button>
                        </div>
                    </form>                            
                </div>
            </div>                                   
        </div>
    </div>   
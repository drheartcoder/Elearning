<!-- bredcrum section -->
<div class="bredcrum-section-main">
    <div class="container">
        <div class="page-title-main">
            {{trans('parent.Change_Password')}}
        </div>
        <div class="page-bredcrum-section">
            <ul>
                <li><a href="{{ url('/') }}/teacher/dashboard">{{trans('parent.Dashboard')}}</a> &nbsp;&nbsp; <i class="fa fa-angle-right"></i> &nbsp;&nbsp; </li>
                <li>{{trans('parent.Change_Password')}}</li>
            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!-- bredcrum section end -->

<div class="gray-btn-main-section dashboard-middle-section">
    <div class="container">
        {{-- <div class="my-profile-section"> --}}
            <div class="row">
                    <div class="col-sm-4 col-md-3 col-lg-3">
                        @include('front.layout.teacher_left_bar')
                    </div>
                    <div class="col-sm-8 col-md-9 col-lg-9">


                    @include('front.layout._operation_status')
                   <form id="form_change_password" method="POST" action="{{ url('/') }}/teacher/account-setting/password/update">
                    {{ csrf_field() }}
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group">
                            <label>{{trans('parent.Current_Password')}}</label>
                            <input type="password" id="current_password" name="current_password" placeholder="{{trans('parent.Enter_Current_Password')}}" minlength="6" maxlength="16" oncopy="return false" oncut="return false" onpaste="return false" autocomplete="off" />
                            <div class="error" id="err_current_password">{{ $errors->first('current_password') }}</div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group">
                            <label>{{trans('parent.New_Password')}}</label>
                            <input type="password" id="new_password" name="new_password" placeholder="{{trans('parent.Enter_New_Password')}}" minlength="6" maxlength="16" oncopy="return false" oncut="return false" onpaste="return false" autocomplete="off" />
                            <div class="error" id="err_new_password">{{ $errors->first('new_password') }}</div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group">
                            <label>{{trans('parent.Confirm_New_Password')}}</label>
                            <input type="password" id="confirm_new_password" name="confirm_new_password" placeholder="{{trans('parent.Enter_Confirm_New_Password')}}" minlength="6" maxlength="16" oncopy="return false" oncut="return false" onpaste="return false" autocomplete="off" />
                            <div class="error" id="err_confirm_new_password">{{ $errors->first('confirm_new_password') }}</div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group">
                            <label> <span class="label label-danger">{{trans('auth.Note')}}:</span> {{trans('auth.Password_must_vailidation')}}</label>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="form-button-section">
                            <button type="submit" id="btn_change_password" class="full-fill-button sim-button">{{trans('parent.Save')}}</button>
                        </div>
                    </div>
                   </form>
                   </div>
                </div>
            {{-- </div> --}}
        </div>
    </div>
</div>

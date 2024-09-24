@include('front.layout.bredcrum')

<?php
    $profile_image      = isset($user_data->profile_image) && !empty($user_data->profile_image) ? $user_data->profile_image : '';
    $first_name         = isset($user_data->first_name) && !empty($user_data->first_name) ? $user_data->first_name : '';
    $last_name          = isset($user_data->last_name) && !empty($user_data->last_name) ? $user_data->last_name : '';
    $email              = isset($user_data->email) && !empty($user_data->email) ? $user_data->email : '';
    $contact            = isset($user_data->contact) && !empty($user_data->contact) ? $user_data->contact : '';
    $address            = isset($user_data->address) && !empty($user_data->address) ? $user_data->address : '';
    $gender             = isset($user_data->gender) && !empty($user_data->gender) ? $user_data->gender : '';
    $preferred_language = isset($user_data->preferred_language) && !empty($user_data->preferred_language) ? $user_data->preferred_language : '';
    $phone_code_id         = isset($user_data->phone_code) && !empty($user_data->phone_code) ? $user_data->phone_code : '';
?>

<div class="gray-btn-main-section dashboard-middle-section">
    <div class="container">     
        <div class="col-sm-4 col-md-3 col-lg-3">
            @include('front.layout.left_bar')
        </div>
        <div class="col-sm-8 col-md-9 col-lg-9">                     
            <form id="form_parent_profile" method="POST" action="{{ url('/') }}/parent/account-setting/profile-update" enctype="multipart/form-data">
                {{ csrf_field() }} 
                <div class="my-profile-section">
                    @include('front.layout._operation_status')
                    <div class="profile-img-wrapper">
                        <div style="position: relative;" class="profile-img-block">
                            <div class="pro-img">
                                <input type="hidden" id="oldimage" name="oldimage" value="{{ $profile_image }}" />
                                <input type="hidden" id="default_image" value="{{ url('/') }}/images/my-profile-uplopad-default-img.png" />
                                @if(isset($user_data['profile_image']) && !empty($user_data['profile_image']) && File::exists($profile_image_base_img_path.$user_data['profile_image']))
                                    <img src="{{ $profile_image_public_img_path.$user_data['profile_image'] }}" class="img-responsive img-preview" alt=""/>
                                @else
                                    <img src="{{ url('/') }}/images/my-profile-uplopad-default-img.png" class="img-responsive img-preview" alt=""/>
                                @endif
                            </div>
                            <input id="profile_image" name="profile_image" type="file" class="attachment_upload">
                            <div class="error" id="err_profile_image">{{ $errors->first('profile_image') }}</div>
                            <input type="hidden" readonly id="cam_image" name="cam_image">
                        </div>
                        <div class="camera-icons">
                           <a><i class="fa fa-folder-open"></i></a>
                           <a onclick="open_popup()"><i class="fa fa-camera"></i></a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>{{trans('auth.First_Name')}}</label>
                                <input type="text" class="alphabets" id="first_name" name="first_name" placeholder="{{trans('auth.Enter_your_first_name')}}" value="{{ $first_name }}" maxlength="50" />
                                <div class="error" id="err_first_name">{{ $errors->first('first_name') }}</div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>{{trans('auth.Last_Name')}}</label>
                                <input type="text" class="alphabets" id="last_name" name="last_name" placeholder="{{trans('auth.Enter_your_last_name')}}" value="{{ $last_name }}" maxlength="50" />
                                 <div class="error" id="err_last_name"></div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>{{trans('auth.Email')}}</label>
                                <input type="text" class="" id="parent_email" name="email" placeholder="{{trans('auth.Enter_your_email')}}" value="{{ $email }}" maxlength="60" disabled="" />
                                <div class="error" id="err_email"></div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6">
                            <div class="form-group" style="margin: 0">
                                 <label>{{trans('auth.Mobile_Number')}}</label>
                                 <div class="row">
                                    <div class="col-sm-4" style="padding-right: 0">
                                          @php
                                            $arr_phone_code = [];
                                            $arr_phone_code = get_country_phone_code();
                                            @endphp
                                            @if(isset($arr_phone_code) && sizeof($arr_phone_code)>0)
                                             <div class="form-group">
                                                <select id="phone_code" name="phone_code">
                                                    <option value="">{{trans('auth.Select_PhoneCode')}}</option>
                                                    @foreach($arr_phone_code as $phone_code)
                                                     @if(isset($phone_code['iso']) && $phone_code['iso']!="")
                                                          <option @if(isset($phone_code_id) && $phone_code_id==$phone_code['id']) selected="" @endif value="{{ $phone_code['id'] }}">
                                                              
                                                             ({{ $phone_code['nicename'] }}) +{{ $phone_code['phonecode'] }}  
                                                          </option>
                                                     @endif
                                                    @endforeach
                                                </select>
                                                 <div class="error" id="err_phone_code">{{ $errors->first('phone_code') }}</div>
                                            </div>
                                            @endif
                                    </div>
                                    <div class="col-sm-8">
                                         <div class="form-group">
                                            <label id="parent_verify_mobile" style="display: inline; cursor: pointer;margin-top: -25px;">{{trans('parent.Verify')}}</label>
                                            <input type="text" class="digits" id="parent_mobile" name="mobile" placeholder="{{trans('auth.Enter_your_mobile_number')}}" value="{{ $contact }}" minlength="6" maxlength="16"  />
                                            <div class="error" id="err_mobile"></div>
                                        </div>
                                    </div>
                                </div>
                           </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group">
                                <label>{{trans('parent.Address')}}</label>
                                <input type="text" class="" id="address" name="address" placeholder="{{trans('parent.Enter_your_Address')}}" value="{{ $address }}" maxlength="255" />
                                 <div class="error" id="err_address"></div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>{{trans('parent.Gender')}}</label>
                                <div class="name-field">
                                    <select id="gender" name="gender">
                                        <option value="">{{trans('parent.Select_Gender')}}</option>
                                        <option value="male" @if($gender == 'male') selected @endif>{{trans('parent.Male')}}</option>
                                        <option value="female" @if($gender == 'female') selected @endif >{{trans('parent.Female')}}</option>
                                    </select>
                                    <i class="fa fa-angle-down"></i>
                                </div>
                                <div class="error" id="err_gender"></div>
                            </div>
                        </div>
                        @if(isset($arr_lang) && !empty($arr_lang))
                            <div class="col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>{{trans('parent.Preferred_Language')}}</label>
                                    <div class="name-field">
                                        <select id="preferred_language" name="preferred_language">
                                            @foreach($arr_lang as $lang)
                                                <option value="{{ $lang['locale'] }}" @if($preferred_language == $lang['locale']) selected @endif >{{ $lang['title'] }}</option>
                                            @endforeach
                                        </select>
                                        <i class="fa fa-angle-down"></i>
                                    </div>
                                    <div class="error" id="err_preferred_language"></div>
                                </div>
                            </div>
                        @endif
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="form-button-section">
                                <button type="button" id="btn_parent_profile_cancel" class="full-fill-button border-button sim-button-blue" data-dismiss="modal">{{trans('parent.Cancel')}}</button>
                                <button type="submit" id="btn_parent_profile_update" class="full-fill-button sim-button">{{trans('parent.Update')}}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>      
        </div>             
    </div>
</div>

<!-- Modal for Web Camp Images-->
<div id="image_popup" class="modal fade inner-page-modal remove-class-modal webcam-modal" role="dialog" >
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <div id="Cam">
                    <div id="my_camera"></div>
                </div>
                <div id="Cam" class="modal-button-section">
                    <button type="button" class="full-fill-button sim-button" data-dismiss="modal" onClick="take_snapshot()">{{trans('parent.Take_Picture')}}</button>
                    <button type="button" class="full-fill-button border-button sim-button-blue" data-dismiss="modal">{{trans('parent.Cancel')}}</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var error_msg = "{{trans('JS_Validation.Could_not_access_webcam')}}";
</script>

<script type="text/javascript" src="{{url('/') }}/js/front/bootstrap.min.js"></script>
<script type="text/javascript" src="{{url('/')}}/js/front/webcam.min.js"></script>
<script type="text/javascript">
$('#cam_image').val('');

function open_popup()
{
    ShowCam();
    $('#image_popup').modal({
        backdrop: 'static',
        keyboard: false,
        show: true
    });
}

function take_snapshot() {
    Webcam.snap(function(data_uri) {
        $('.img-preview').attr('src',data_uri);
        $('#cam_image').val(data_uri);
    });
}

function ShowCam(){
    Webcam.set({
    width: 500,
    height: 500,
    image_format: 'jpeg',
    jpeg_quality: 100
    });
    Webcam.attach('#my_camera');
   
    $('#my_camera video').css('width','100%');
    $('#my_camera video').css('height','100%');
   
}
</script>
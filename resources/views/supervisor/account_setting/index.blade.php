@extends('supervisor.layout.master')    
@section('main_content')
<!-- BEGIN Main Content -->
<!-- Page header -->
    @include('supervisor.layout.breadcrumb')  
<!-- /page header -->

<!-- Content area -->
<div class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="card-body-section">
            <div class="card">
               <div class="card-header card-header-icon card-header-rose">
                  <div class="card-icon">
                     <i class="fa fa-gear"></i>
                  </div>
                  <h4 class="card-title">{{$module_title or ''}} -
                     <small class="category">Complete your profile</small>
                  </h4>
               </div>
               <div class="card-body">
               	@include('supervisor.layout._operation_status')
                  <form class="form-horizontal" id="frm_account_setting" name="frm_account_setting" action="{{$module_url_path}}/profile_update" method="post" enctype="multipart/form-data">
                  	{{csrf_field()}}
                     <div class="row">
                        <div class="col-md-12">
                           <h4 class="title">Profile Image</h4>
                           <div class="profile-img-w fileinput fileinput-new" data-provides="fileinput">
                              <div class="profile-img-up fileinput-new thumbnail img-circle">

                              	@php $is_profile_image_required = $prev_image_url = ""; @endphp
		                        
			                        @if(isset($arr_supervisor_details['profile_image']) && !empty($arr_supervisor_details['profile_image']) && File::exists($profile_image_base_img_path.$arr_supervisor_details['profile_image']))
			                            <img src="{{$profile_image_public_img_path.$arr_supervisor_details['profile_image']}}"  style="max-width: 100%; max-height: 100%; line-height: 20px;width: 100%;height: 100%" class="fileupload-preview">
			                            @php 
			                            	$prev_image_url = $profile_image_public_img_path.$arr_supervisor_details['profile_image']; 
			                            	$is_profile_image_required = false; 
			                            @endphp
			                        @else
			                            <img src="{{url('/assets/img/placeholder.jpg')}}"  style="max-width: 100%; max-height: 100%; line-height: 20px;width: 100%;height: 100%" class="fileupload-preview">
			                            @php 
			                            	$is_profile_image_required = true;
			                            	$prev_image_url = url('/').'/uploads/admin/default_image/default-profile.png';
			                            @endphp
			                        @endif
                                 
                              </div>
                              <input type="hidden" name="default_image" id="default_image" value="{{ $prev_image_url or '' }}">
                              <div class="fileinput-preview fileinput-exists thumbnail img-circle"></div>
                              <input type="hidden" name="oldimage" id="oldimage"value="{{ $arr_supervisor_details['profile_image']  or ''}}"/>
                              <input type="hidden" readonly id="cam_image" name="cam_image">

                                <div class="camera-icons">
                                       <a><i class="fa fa-folder-open"></i></a>
                                       <a onclick="open_popup()"><i class="fa fa-camera"></i></a>
                                       <!--<span class="fileinput-exists">Change</span>-->
                                       <!-- <input type="file" data-validation-allowing="jpg, png, gif" class="up-btn1" name="profile_image" id="image_1"  {{$is_profile_image_required == true ? 'data-rule-required=true' : ''}} data-msg-required="Please select profile image."/> -->
                                       <input type="file" data-validation-allowing="jpg, png, gif" class="up-btn1" name="profile_image" id="profile_image"/>
                                       
                                 </div>
                                 <a href="#pablo" class="fileinput-exists remove-btn" data-dismiss="fileinput"><i class="fa fa-times"></i></a>
<!--
                                 <span class="btn btn-rose btn-file">
                                 <span class="fileinput-new">Add Photo</span>
                                 <span class="fileinput-exists">Change</span>
                                 <input type="file" data-validation-allowing="jpg, png, gif" class="jai" name="profile_image" id="image_1"  {{$is_profile_image_required == true ? 'data-rule-required=true' : ''}} data-msg-required="Please select profile image."/>
                                 </span>
-->
                                 
                                 <div class="clearfix"></div>
                             
                              <span class="note-section-block"><b>Note :</b> <span>{!! image_validate_note(250,250,'account_setting') !!}</span></span>
                           </div> 
                           <div class="clearfix"></div>                                           
                          <div id="file-upload-error" class="err_image"></div>
                          <span for="image" id="err-image" class="has-danger">{{ $errors->first('image') }}</span>
                        </div>
                     </div>
                     <br/>  
                     <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label class="bmd-label-floating">Username <i class="red">*</i></label>
                              <input type="text" class="form-control" name="user_name" id="user_name" class="form-control" data-rule-required="true" data-rule-alphanumeric="true" data-rule-maxlength="60" value="{{$arr_supervisor_details['user_name'] or ''}}">
                           </div>
                        </div>
                        <div class="col-md-6">
                        	<input type="hidden" name="isvalid" id="isvalid" value="">	
							<input type="hidden" name="user_id" id="user_id" value="{{base64_encode($arr_supervisor_details['id'])}}">		
                           <div class="form-group">
                              <label class="bmd-label-floating">Email address <i class="red">*</i></label>
                              <input type="email" class="form-control chk_email" name="email" id="email" data-rule-required="true" data-rule-email value="{{$arr_supervisor_details['email'] or ''}}">
                              <span class="has-danger" id="err_email">{{ $errors->first('email') }} </span>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label class="bmd-label-floating">First Name <i class="red">*</i></label>
                              <input type="text" class="form-control" name="first_name" id="first_name" data-rule-required="true" data-rule-maxlength="60" value="{{$arr_supervisor_details['first_name'] or ''}}" onkeyup="chk_validation(this)">                              
                              <span class="has-danger">{{ $errors->first('first_name') }} </span>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label class="bmd-label-floating">Last Name <i class="red">*</i></label>
                              <input type="text" class="form-control" name="last_name" id="last_name" data-rule-required="true" data-rule-maxlength="60" value="{{$arr_supervisor_details['last_name'] or ''}}" onkeyup="chk_validation(this)">
                              <span class="has-danger">{{ $errors->first('last_name') }} </span>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        @php
                            $arr_phone_code = [];
                            $arr_phone_code = get_country_phone_code();
                        @endphp
                        @if(isset($arr_phone_code) && sizeof($arr_phone_code)>0)
                        <div class="col-md-6">
                         <div class="form-group">
                            <select id="phone_code" data-rule-required="true" class="form-control" name="phone_code">
                                <option value="">Select PhoneCode</option>
                                @foreach($arr_phone_code as $phone_code)
                                 @if(isset($phone_code['iso']) && $phone_code['iso']!="")
                                      <option @if(isset($arr_supervisor_details['phone_code']) && $arr_supervisor_details['phone_code']==$phone_code['id']) selected="" @endif value="{{ $phone_code['id'] }}">({{ $phone_code['nicename'] }}) +{{ $phone_code['phonecode'] }}</option>
                                 @endif
                                @endforeach

                            </select>
                            <div class="error">{{ $errors->first('phone_code') }}</div>
                        </div>
                         <div id="err_phone_code"></div>
                        </div>
                        @endif
                        <div class="col-md-6">
                           <div class="form-group">
                              <label class="bmd-label-floating">Phone Number <i class="red">*</i></label>
                              <input type="text" class="form-control" name="contact" id="contact" data-rule-required="true" data-rule-pattern="[- +()0-9]+" data-rule-minlength="7" data-rule-maxlength="16" data-msg-minlength="Phone no should be atleast 7 numbers" data-msg-maxlength="Phone no should not be more than 16 numbers" value="{{$arr_supervisor_details['contact'] or ''}}">
                              <span class="has-danger">{{ $errors->first('cantact') }} </span>
                           </div>
                        </div>
                        <!-- <div class="col-md-6">
                           <div class="form-group">
                              <label class="bmd-label-floating">Fax Number <i class="red">*</i></label>
                              <input type="text" class="form-control" name="fax_number" id="fax_number"data-rule-required="true" data-rule-pattern="[- +()0-9]+" data-rule-minlength="7" data-rule-maxlength="16" data-msg-minlength="Fax no should be atleast 7 numbers" data-msg-maxlength="Fax no should not be more than 16 numbers" value="{{$arr_supervisor_details['fax_number'] or ''}}">
                              <span class="has-danger">{{ $errors->first('fax_number') }} </span>
                           </div>
                        </div> -->
                     </div>    
                      <div class="row">
                        <div class="col-md-12">
                           <div class="form-group">
                              <label class="bmd-label-floating">Address <i class="red">*</i></label>
                              <input type="text" class="form-control" name="address" id="address" data-rule-required="true" data-rule-maxlength="255" placeholder="" value="{{$arr_supervisor_details['address'] or ''}}">
                              <span class="has-danger">{{ $errors->first('address') }} </span>
                           </div>
                        </div>                      
                     </div>                     
                     <button type="submit" class="btn btn-rose pull-right">Update Profile</button>
                     <div class="clearfix"></div>
                  </form>
               </div>
            </div>
         </div>                 
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
                    <button type="button" class="btn btn-rose" data-dismiss="modal" onClick="take_snapshot()">{{trans('parent.Take_Picture')}}</button>
                    <button onClick="close_popup()" type="button" class="btn btn-rose" data-dismiss="modal">{{trans('parent.Cancel')}}</button>
                </div>
            </div>
        </div>
    </div>
</div>


<script>

	/*$(document).ready(function(){
      $("#address").geocomplete();
    });*/

	$('#profile_image').change(function(){		
        var file=this.files;
        validateImage(this.files, 250,250);
	})
    

    $(document).on("click","#remove", function()
    {   
        removeFile();
    });



    $(document).ready(function(){
    	$('#frm_account_setting').validate({      		
    		ignore: [],
    		highlight: function(element) { },
    		rules: {
			    email: {
			      required: true,
			      email: true,
			      pattern: /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/
			    }
			  },
			  messages: {
                email: {
                    pattern: "Please enter a valid email address.",

                },
            },
            errorPlacement: function(error, element) 
            { 
                var name = $(element).attr("name");                
                if (name === "profile_image") 
                {
                   error.insertAfter('.err_image');
                } 
                else if (name === "phone_code") 
                {
                   error.insertAfter('#err_phone_code');
                }                	 
                else
                {
                   error.insertAfter(element);
                }
            } 
    	});


    	$('#frm_account_setting').submit(function(){
			
			if($('#frm_account_setting').valid() == true)  
			{
				var isvalid = $("input[name='isvalid']").val();	    		
	    		if(isvalid == 'invalid')
				{
					return false;
				}
				else
				{
					return true;	
				}
			}			

    	});
    });

	function chk_validation(ref)
	{
		var yourInput = $(ref).val();
		var re = /[0-9`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi;
		var isSplChar = re.test(yourInput);
		if(isSplChar)
		{
			var no_spl_char = yourInput.replace(/[0-9`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi, '');
			$(ref).val(no_spl_char);
		}
	}

</script>

<script type="text/javascript" src="{{ url('/') }}/js/front/bootstrap.min.js"></script>
<script type="text/javascript" src="{{url('/')}}/js/front/webcam.min.js"></script>
<script type="text/javascript">
$('#cam_image').val('');

function open_popup()
{
    $('html').removeClass('perfect-scrollbar-on');
    ShowCam();
    $('#image_popup').modal({
        backdrop: 'static',
        keyboard: false,
        show: true
    });
    
}
function close_popup(){
    $('html').addClass('perfect-scrollbar-on');
}    

function take_snapshot() {
    Webcam.snap(function(data_uri) {
        $('.fileupload-preview').attr('src',data_uri);
        $('#cam_image').val(data_uri);
    });
    close_popup();
}

function ShowCam(){
    Webcam.set({
    width: 500,
    height: 380,
    image_format: 'jpeg',
    jpeg_quality: 100
    });
    Webcam.attach('#my_camera');
   
    $('#my_camera video').css('width','100%');
    $('#my_camera video').css('height','100%');
   
}
</script>


@endsection


			
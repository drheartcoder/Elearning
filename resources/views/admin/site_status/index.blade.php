@extends('admin.layout.master')    
@section('main_content')
<!-- Content area -->
<!-- Page header -->
    @include('admin.layout.breadcrumb')  
<!-- /page header -->
<div class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="card-body-section">
            <div class="card">
               <div class="card-header card-header-icon card-header-rose">
                  <div class="card-icon">
                     <i class="fa fa-gear"></i>
                  </div>
                  <h4 class="card-title">{{$module_title or ''}}
                  </h4>
               </div>
               <div class="card-body">
               	@include('admin.layout._operation_status')
                  <form class="form-horizontal" id="frm_site_setting" name="frm_site_setting" action="{{$module_url_path}}/update" method="post">
                  	{{csrf_field()}}
                    <h4 class="title">&nbsp;</h4>
                  	
                  	<div class="row">
		              	<div class="col-md-6">		
		              		<div class="form-group has-default bmd-form-group is-filled">	              	
	                            <label class="bmd-label-floating">Site Name <i class="red">*</i></label>
			                  	<input type="text" name="site_name" id="site_name" onkeyup="chk_validation(this)" class="form-control" data-rule-required="true" data-rule-maxlength="100" value="{{$arr_site_settings['site_name'] or ''}}">
								<span class="error">{{ $errors->first('site_name') }} </span>
							</div>													
						</div>						
		              <div class="col-md-6">
		                <div class="form-group has-default bmd-form-group is-filled">
                            <label class="bmd-label-floating">Email <i class="red">*</i></label>
		                  	<input type="text" name="site_email_address" id="site_email_address" class="form-control" data-rule-required="true" data-rule-email="true" data-rule-maxlength="100" value="{{$arr_site_settings['site_email_address'] or ''}}">
							<span class="error">{{ $errors->first('site_email_address') }} </span>
		                </div>
		              </div>					
						
						
		              
		              <div class="col-md-6">
		                <div class="form-group has-default bmd-form-group is-filled">
                            <label class="bmd-label-floating">Contact Number <i class="red">*</i></label>
		                  	<input type="text" name="site_contact_number" id="site_contact_number" class="form-control" data-rule-required="true" data-rule-number="true" data-rule-minlength="8" data-rule-maxlength="12" value="{{$arr_site_settings['site_contact_number'] or ''}}">
							<span class="error">{{ $errors->first('site_contact_number') }} </span>
		                </div>
		              </div>
		            

		            
		              	<div class="col-md-6">
                            <label class="bmd-label-floating">Site Status </label>		              			              	
		                	<div class="form-check">
			                  <label class="form-check-label">			                  	
			                    <input class="form-check-input" type="radio" name="site_status" value="1"  @if(isset($arr_site_settings['site_status']) && $arr_site_settings['site_status']==1) checked="" @endif> Online
			                    <span class="circle">
			                      <span class="check"></span>
			                    </span>
			                  </label>		               
			                  <label class="form-check-label">
			                    <input class="form-check-input" type="radio" name="site_status" value="0" @if(isset($arr_site_settings['site_status']) && $arr_site_settings['site_status']==0) checked="" @endif> Offline
			                    <span class="circle">
			                      <span class="check"></span>
			                    </span>
			                  </label>
			                </div>
		              	</div>
		            

		            
						<div class="col-md-6">
							<div class="form-group has-default bmd-form-group is-filled">
						        <label class="bmd-label-floating">Site Video <i class="red">*</i></label>
								<input type="text" name="site_video" class="form-control" id="site_video" value="{{$arr_site_settings['site_video']}}" required="true">
								<span class='help-block with-errors' id="err_site_video">{{ $errors->first('site_video') }}</span>
								<div class="clearfix"></div>
								<span class="note-block"><i class="fa fa-exclamation-triangle" style="font-weight: 10px;color: red;"><span style="font-family: 'heeboregular', sans-serif;">Note</span></i> : Copy and paste youtube video URL link here</span>
							</div>
						</div>						
					
		              	<div class="col-md-6">
			                <div class="form-group has-default bmd-form-group is-filled">
		              	        <label class="bmd-label-floating">Meta Keyword </label>
			                  	<input type="text" name="meta_keyword" id="meta_keyword" class="form-control" class="form-control" value="{{$arr_site_settings['meta_keyword'] or ''}}">
								<span class="error">{{ $errors->first('meta_keyword') }} </span>
			                </div>
		              	</div>
		            



		            
		              	<div class="col-md-6">
			                <div class="form-group has-default bmd-form-group is-filled">
		              	        <label class="bmd-label-floating">Meta Description </label>
					            <input type="text" name="meta_description" id="meta_description" class="form-control" value="{{$arr_site_settings['meta_desc'] or ''}}">
								<span class="error">{{ $errors->first('meta_description') }} </span>
							</div>
		              	</div>
		            

		            
		              	<div class="col-md-6">
			                <div class="form-group has-default bmd-form-group is-filled">
		              	        <label class="bmd-label-floating">Facebook URL <i class="red">*</i></label>
			                  	<input type="text" name="facebook_url" id="facebook_url" class="form-control" data-rule-required="true" data-rule-url="true" data-rule-maxlength="500" value="{{$arr_site_settings['fb_url'] or ''}}">
								<span class="error">{{ $errors->first('facebook_url') }} </span>
			                </div>
		              	</div>
		            

		            
		              	<div class="col-md-6">
			                <div class="form-group has-default bmd-form-group is-filled">
		              	        <label class="bmd-label-floating">Twitter URL <i class="red">*</i></label>
					            <input type="text" name="twitter_url" id="twitter_url" class="form-control" data-rule-required="true" data-rule-url="true" data-rule-maxlength="500" value="{{$arr_site_settings['twitter_url'] or ''}}">
								<span class="error">{{ $errors->first('twitter_url') }} </span>
							</div>
		              	</div>
		            

		            
		              	<div class="col-md-6">
			                <div class="form-group has-default bmd-form-group is-filled">
                              <label class="bmd-label-floating">Google+ URL <i class="red">*</i></label>
					            <input type="text" name="google_plus_url" id="google_plus_url" class="form-control"data-rule-required="true" data-rule-url="true" data-rule-maxlength="500" value="{{$arr_site_settings['google_plus_url'] or ''}}">
								<span class="error">{{ $errors->first('google_plus_url') }} </span>
							</div>
		              	</div>		            
		            
		            
		              	<div class="col-md-12">
			                <div class="form-group has-default bmd-form-group is-filled">
		              	        <label class="bmd-label-floating">Linkedin URL </label>
					            <input type="text" name="linkedin_url" id="linkedin_url" class="form-control" value="{{$arr_site_settings['linkedin_url'] or ''}}">
								<span class="error">{{ $errors->first('linkedin_url') }} </span>
							</div>
		              	</div>
                        
		              	<div class="col-md-12">
			                <div class="form-group has-default bmd-form-group is-filled">
		              	        <label class="bmd-label-floating">Download Apple URL <i class="red">*</i></label>
					            <input type="text" data-rule-required="true" data-rule-url="true" name="apple_url" id="apple_url" class="form-control" value="{{$arr_site_settings['apple_url'] or ''}}">
								<span class="error">{{ $errors->first('apple_url') }} </span>
							</div>
		              	</div>

		              	<div class="col-md-12">
			                <div class="form-group has-default bmd-form-group is-filled">
		              	        <label class="bmd-label-floating">Download Google Play URL <i class="red">*</i></label>
					            <input type="text" data-rule-required="true" data-rule-url="true" name="google_play_url" id="google_play_url" class="form-control" value="{{$arr_site_settings['google_play_url'] or ''}}">
								<span class="error">{{ $errors->first('google_play_url') }} </span>
							</div>
		              	</div>

		              	<div class="col-md-12">
			                <div class="form-group has-default bmd-form-group is-filled">
		              	        <label class="bmd-label-floating">Download Acrobat URL </label>
					            <input type="text" name="acrobat_url" id="acrobat_url" class="form-control" value="{{$arr_site_settings['acrobat_url'] or ''}}">
								<span class="error">{{ $errors->first('acrobat_url') }} </span>
							</div>
		              	</div>

		              	<div class="col-md-12">
			                <div class="form-group has-default bmd-form-group is-filled">
		              	        <label class="bmd-label-floating">Download Chrome URL </label>
					            <input type="text" name="chrome_url" id="chrome_url" class="form-control" value="{{$arr_site_settings['chrome_url'] or ''}}">
								<span class="error">{{ $errors->first('chrome_url') }} </span>
							</div>
		              	</div>

		              	<div class="col-md-12">
			                <div class="form-group has-default bmd-form-group is-filled">
		              	        <label class="bmd-label-floating">Youtube URL </label>
					            <input type="text" name="youtube_url" id="youtube_url" class="form-control" value="{{$arr_site_settings['youtube_url'] or ''}}">
								<span class="error">{{ $errors->first('youtube_url') }} </span>
							</div>
		              	</div>


                      </div>		            

                        <div class="form-group text-center">                
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-rose pull-right">Update</button>
                            </div>
                        </div>
                    <div class="clearfix"></div>
                  </form>
               </div>
            </div>
         </div>                 
      </div>
   </div>
</div>

	<script>
		$(document).ready(function(){
			$("#site_address").geocomplete();
		});

		$(document).ready(function(){
			$('#frm_site_setting').validate({
				ignore: [],
				errorPlacement: function(error, element) 
				{ 
					var name = $(element).attr("name");
					if (name === "site_status") 
					{
						error.insertAfter('.err_site_status');
					} 
					else
					{
						error.insertAfter(element);
					}
				} 
			});

			$("#linkedin_url").keyup(function(){

				if($('#linkedin_url').val()!='')
				{
					$('#linkedin_url').attr('data-rule-required','true');
					$('#linkedin_url').attr('data-rule-url','true');
					$('#linkedin_url').attr('data-rule-maxlength','500');
				}
			});

		});
	</script>

	@endsection

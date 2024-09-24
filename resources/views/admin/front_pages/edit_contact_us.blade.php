@extends('admin.layout.master') @section('main_content')
<style type="text/css">
    .hidden {
        display: none !important;
    }
</style>
@include('admin.layout.breadcrumb')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="card-body-section">
                <div class="card">
                    <div class="card-header card-header-icon card-header-rose">
                        <div class="card-icon">
                            <i class="fa fa-file-text"></i>
                        </div>
                        <h4 class="card-title">{{$page_title or ''}}
                  </h4>
                    </div>
                    <!-- <div class="card "> -->
                    <!-- <div class="card-header ">
                  <h4 class="card-title">{{$module_title or ''}}
                  </h4>
                  </div> -->
                    <div class="card-body">
                        @include('admin.layout._operation_status')
                        <form class="form-horizontal" id="frm_create_front_page" name="frm_create_front_page" action="{{$module_url_path}}/update_contact_us" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <h4 class="title"></h4>
                            <div class="tab-content tab-space">
                                <div class="row">
                                  <div class="col-sm-12">
                                     <label class="col-form-label">Question File (Image) <span class="red">*</span></label>
                                     <div style="position: relative;" class="form-group">
                                        <div class="profile-img-block temp-img-block">
                                           <div class="pro-img">
                                            @if($page_details['banner_image']!=null && $page_details['banner_image']!='')
                                              <img src="{{ $contact_us_banner_image_public_img_path.'/'.$page_details['banner_image']}}" id="imgFilePreview" class="img-responsive img-preview imgFilePreview" alt=""/>
                                            @else
                                              <img src="{{ url('/') }}/images/default.jpg" id="imgFilePreview" class="img-responsive img-preview imgFilePreview" alt=""/>
                                            @endif
                                              <input style="height: 100%; width: 100%; z-index: 99;" id="banner_image" name="banner_image"  type="file" class="attachment_upload imgFile" data-rule-required="true" value="" />
                                              <input type="hidden" name="old_banner_image" id="old_banner_image" value="{{$page_details['banner_image']}}">
                                           </div>
                                           <span class="error" id="err_banner_image"> @if($errors->has('banner_image')) {{ $errors->first('banner_image') }} @endif </span>
                                           <span class="note-section-block"><b>Note :</b> <span>Allowed only jpg | jpeg | png, <br/> Upload image greater than or equal to 1700 X 500 for best result.</span></span>
                                        </div>
                                     </div>
                                  </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-rose pull-right btn_add_front_page">Update</button>
                            <button type="button" onclick="location.href='{{$module_url_path}}'" class="btn btn-rose pull-right">Cancel</button>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                    <!-- </div> -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- BEGIN Main Content -->
<script type="text/javascript">
    $('.imgFile').change(function(){
       var tempThis = $(this);
       var files = $(this.files);
       imageSizeValidate(tempThis, files, '1500', '500');
    });
    function imageSizeValidate (tempThis,files,width,height) 
    {
      var image_height = height || 0;
      var image_width = width || 0;
      var max_file_size = 400;
      var file_size     = 0;
      if (typeof files !== "undefined") 
      {
        for (var i=0, l=files.length; i<l; i++) 
        {
              var blnValid = false;
              var ext = files[0]['name'].substring(files[0]['name'].lastIndexOf('.') + 1);
              var file_size =  Math.round((files[0].size/ 1024) * 100) / 100;
              if(ext == "JPEG" || ext == "jpeg" || ext == "jpg" || ext == "JPG" || ext == "png" || ext == "PNG")
              {
                  blnValid = true;
              }
              
              if(blnValid ==false) 
              {
                  showAlert("Sorry, " + files[0]['name'] + " is invalid, allowed extensions are: jpeg , jpg , png","error");
                  $(".fileupload-preview").html("");
                  $(".fileupload").attr('class',"fileupload fileupload-new");
                  $("#banner_image").val('');
                  return false;
              }
              else
              {              
                    var reader = new FileReader();
/*                    if(file_size>max_file_size)

                  {
                      swal("Sorry, max "+max_file_size+" Kb size is allowed");
                      
                      $(".imgFile").val('');
                      return false;
                  }*/
                    reader.readAsDataURL(files[0]);
                    reader.onload = function (e) 
                    {
                      var image = new Image();
                      image.src = e.target.result;
                         
                      image.onload = function () 
                      {
                          var height = this.height;
                          var width = this.width;
                          console.log("current height:"+height+"  validate height:"+image_height );

                          console.log("current width:"+width+" validate width:"+image_width);

                          if (height < image_height || width < image_width ) 
                          {
                              swal("File must be grater than / equal to "+image_width+" X "+image_height);
                              $(".imgFile").val('');
                              return false;
                          }
                          else
                          {
                            var id = tempThis.closest('.profile-img-block').find('.imgFilePreview').attr('id');
                             $('#'+id).attr('src', e.target.result);
                             //swal("Uploaded image has valid Height and Width.");
                             return true;
                          }
                      };
                    }
              }                
          }
      }
      else
      {
        swal("No support for the File API in this web browser" ,"error");
      } 
    }
</script>
@endsection

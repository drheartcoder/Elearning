@extends('admin.layout.master')    
@section('main_content') 

<style>
    .main-box-section{}
</style>

<div class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-md-12">
            
            @include('admin.layout._operation_status')
            <br/>
              @if(isset($arr_gallery) && count($arr_gallery) > 0)
                @foreach($arr_gallery as $gallery)
                  <span class="main-box-section">                    

                    <a href="javascript:void(0);" class="delete_img" data-id="{{ base64_encode($gallery['id']) }}" data-name="{{ base64_encode($gallery['name']) }}" ><i class="fa fa-trash-o"></i></a>

                    @if(File::exists($gallery_base_img_path.'/'.$gallery['name']))
                      <img alt="gallery img" src="{{ $gallery_public_img_path.'/'.$gallery['name'] }}" width="150" height="150">
                    @else
                      <img alt="gallery img" src="{{ url('/') }}/uploads/default_image/default.png" width="150" height="150">
                    @endif

                  </span>
                @endforeach
              @endif
              
            <span class="main-box-section">
              <form id="frm_gallery" action="{{ url('/') }}/admin/gallery/store" enctype="multipart/form-data" method="post">
              {{ csrf_field() }}
                 <img src="{{ url ( '/' ) }}/images/plus-img.jpg" alt="plus img">
                 <input type="file" class="upload_pic_btn" name="gallery_img" id="gallery_img" value="Change Picture">
              </form>
            </span>
            <div class="error" id="err_upload"></div>

            <form method="post" id="frm_delete_gallery" action="{{ url('/') }}/admin/gallery/delete">
              {{ csrf_field() }}
              <input type="hidden" name="id" id="delete_id" >
              <input type="hidden" name="name" id="delete_name">
            </form>

         </div>
      </div>
   </div>
</div>

<script type="text/javascript">
  $(document).ready(function(){
    
    $("#gallery_img").change(function(){

      var fileExtension = ['jpg','jpeg','png'];
      if($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) 
      {
          swal("Please upload valid image with valid extension i.e "+fileExtension.join(', '));
          $("#gallery_img").val('');
          return false;
      }
      else if(this.files[0].size > 2000000)
      {
          swal('Max size allowed is 2mb.');
          $("#gallery_img").val('');
          return false;
      }
      else
      {
        $("#frm_gallery").submit();
      }

    });

    $(".delete_img").click(function(){
      var id   = $(this).data('id');
      var name = $(this).data('name');
      
      if($.trim(id) != '' && $.trim(name) != '')
      {
        $("#delete_id").val(id);
        $("#delete_name").val(name);

        $("#frm_delete_gallery").submit();
      }
    });

  });
</script>

@endsection

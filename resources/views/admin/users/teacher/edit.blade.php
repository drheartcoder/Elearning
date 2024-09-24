
@extends('admin.layout.master')    
@section('main_content')
 <!-- Page header -->
         @include('admin.layout.breadcrumb')  
<!-- /page header -->

<!-- BEGIN Main Content -->

  <!-- Content area -->
  <div class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-flat">
          @include('admin.layout._operation_status')
        <div class="panel-heading">
          <h5 class="panel-title">{{$module_title or ''}}</h5>
        </div>

        <div class="panel-body">
          <form class="form-horizontal" id="frm_account_setting" name="frm_account_setting" action="{{$module_url_path}}/update/{{$id}}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            
            <fieldset class="content-group">  
              <input type="hidden" name="id" id="id" value="{{$id}}">  
              <div class="form-group">
                <label class="control-label col-lg-2" for="contact">User Type<i class="red">*</i></label>
                <div class="col-lg-5">
                  <select class="form-control" data-rule-required="true" name="user_type" id="user_type" disabled="">                    
                    <option value="program-creator" @if(isset($arr_user['user_type']) && $arr_user['user_type']!='' && $arr_user['user_type']=='program-creator') selected @endif>Program Creator</option>  
                    <option value="supervisor" @if(isset($arr_user['user_type']) && $arr_user['user_type']!='' && $arr_user['user_type']=='supervisor') selected @endif>Supervisor</option>  
                  </select> 
                  <span class="error">{{ $errors->first('user_type') }} </span>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-lg-2" for="first_name">First Name<i class="red">*</i></label>
                <div class="col-lg-5">
                  <input type="text" name="first_name" id="first_name"  class="form-control" placeholder="First Name" data-rule-required="true" data-rule-maxlength="60" value="@if(isset($arr_user['first_name']) && $arr_user['first_name']!=''){{$arr_user['first_name']}}@endif" onkeyup="chk_validation(this)">
                  <span class="error">{{ $errors->first('first_name') }} </span>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-lg-2" for="last_name">Last Name<i class="red">*</i></label>
                <div class="col-lg-5">
                  <input type="text" name="last_name" id="last_name"  class="form-control" placeholder="Last Name" data-rule-required="true" data-rule-maxlength="60" value="@if(isset($arr_user['last_name']) && $arr_user['last_name']!=''){{$arr_user['last_name']}}@endif" onkeyup="chk_validation(this)">
                  <span class="error">{{ $errors->first('last_name') }} </span>
                </div>
              </div>              
              <div class="form-group">
                <label class="control-label col-lg-2" for="email">Email<i class="red">*</i></label>
                <div class="col-lg-5">
                  <input type="text" name="email" id="email" class="form-control" placeholder="Email" data-rule-required="true" data-rule-email value="@if(isset($arr_user['email']) && $arr_user['email']!=''){{$arr_user['email']}}@endif" readonly="">
                  <span class="error">{{ $errors->first('email') }} </span>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-lg-2" for="contact">Phone Number<i class="red">*</i></label>
                <div class="col-lg-5">
                  <input type="text" name="contact" id="contact" class="form-control" data-rule-required="true" data-rule-pattern="[- +()0-9]+" data-rule-minlength="7" data-rule-maxlength="16" data-msg-minlength="Phone no should be atleast 7 numbers" data-msg-maxlength="Phone no should not be more than 16 numbers" placeholder="Phone Number" value="@if(isset($arr_user['contact']) && $arr_user['contact']!=''){{$arr_user['contact']}}@endif">
                  <span class="error">{{ $errors->first('contact') }} </span>
                </div>
              </div>              
              <div class="form-group">
                <label class="control-label col-lg-2" for="address">Address<i class="red">*</i></label>
                <div class="col-lg-5">
                  <input type="text" name="address" id="address" class="form-control" data-rule-required="true" data-rule-maxlength="255" placeholder="Address" value="@if(isset($arr_user['address']) && $arr_user['address']!=''){{$arr_user['address']}}@endif">
                  <span class="error">{{ $errors->first('address') }} </span>
                </div>
              </div>              
              <div class="form-group text-center">
                <div class="col-lg-7">
                  <button type="submit" class="btn btn-primary">Update</button>
                  <a href="{{$module_url_path}}" class="btn btn-primary">Cancel</a>
                </div>
              </div>
            </fieldset>

          </form>
        </div>
      </div>
    </div>
  </div>



{{-- <script src="https://maps.googleapis.com/maps/api/js?v=3&key=AIzaSyCccvQtzVx4aAt05YnfzJDSWEzPiVnNVsY&libraries=places"></script>

<script src="{{ url('/') }}/web_admin/assets/js/pages/jquery.geocomplete.js"></script>
 --}}
<script>

  /*$(document).ready(function(){
      $("#address").geocomplete();
    });*/

    $(document).on("change",".validate-image", function()
    {        
        var file=this.files;
        validateImage(this.files, 250,250);
    });

    $(document).on("click","#remove", function()
    {   
        removeFile();
    });



    $(document).ready(function(){
      $('#frm_bank_account').validate({
        ignore: [],
        highlight: function(element) { },
        rules: { },
      messages: { },
      errorPlacement: function(error, element) 
      { 
        var name = $(element).attr("name");
        error.insertAfter(element);
      } 
      });

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
                  else
                  {
                    error.insertAfter(element);
                  }
                
               } 
      });
    });

    function chk_validation(ref)
      {
          var yourInput = $(ref).val();
          re = /[0-9`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi;
          var isSplChar = re.test(yourInput);
          if(isSplChar)
          {
            var no_spl_char = yourInput.replace(/[0-9`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi, '');
            $(ref).val(no_spl_char);
          }
      }

</script>

@endsection


      
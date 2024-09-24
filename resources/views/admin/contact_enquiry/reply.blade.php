
@extends('admin.layout.master')    
@section('main_content')
<!-- Page header -->
@include('admin.layout.breadcrumb')  
<!-- /page header -->

<!-- BEGIN Main Content -->
<div class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="card-body-section">
            <div class="card">
               <div class="card-header card-header-icon card-header-rose">
                  <div class="card-icon">
                     <i class="fa fa-phone"></i>
                  </div>
                  <h4 class="card-title">{{$sub_module_title or ''}}
                  </h4>
               </div>
               <div class="card-body">
                  @include('admin.layout._operation_status')                  
                    <form class="form-horizontal" id="frm_send_reply" name="frm_send_reply" action="{{url($module_url_path.'/send_reply')}}" method="post">
                      {{csrf_field()}}
                        <h4 class="title"></h4>
                      
					<input type="hidden" value="{{ isset($arr_data['first_name']) ? $arr_data['first_name'] : '' }}" name="first_name"></input>
					<input type="hidden" value="{{ isset($arr_data['last_name'])  ? $arr_data['last_name']  : '' }}" name="last_name"></input>
					<input type="hidden" value="{{ isset($arr_data['email'])      ? $arr_data['email']      : '' }}" name="email"></input>
                      
                     <div class="form-group has-default bmd-form-group is-filled">
                          <label class="bmd-label-floating">Email <i class="red">*</i></label>
                        <input type="text" name="email" id="email"  class="form-control email" value="{{isset($arr_data['email'])?$arr_data['email']:''}}" readonly="">
                     </div>                                           
                         <div class="form-group has-default bmd-form-group is-filled">
                          <label class="bmd-label-floating">Mesaage <i class="red">*</i></label>
                            <textarea rows="5" cols="5" class="form-control" name="message" id="message" data-rule-required="true"></textarea>
                            <span class="error">{{ $errors->first('message') }}</span>
                         </div>                                                
                       <button type="submit" class="btn btn-rose pull-right" name="send_reply" id="send_reply">Send</button>
                       <button type="button" onclick="location.href='{{$module_url_path}}'" class="btn btn-rose pull-right">Cancel</button>
                       <div class="clearfix"></div>
                    </form>                  
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- BEGIN Main Content -->
<script type="text/javascript">
 $(document).ready(function(){
      $('#frm_send_reply').validate();
  });
</script>
@endsection



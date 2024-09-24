
@extends('admin.layout.master')    
@section('main_content')
<!-- Page header -->
@include('admin.layout.breadcrumb')  
<!-- /page header -->

<!-- Content area -->
<div class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="card-body-section">
            <div class="card">
               <div class="card-header card-header-icon card-header-rose">
                  <div class="card-icon">
                     <i class="fa fa-book"></i>
                  </div>
                  <h4 class="card-title">{{$page_title or ''}}
                  </h4>
               </div>
                <div class="card-body">
                    @include('admin.layout._operation_status')                    
                    <form class="form-horizontal" id="frm_create_subject" name="frm_create_subject" action="{{$module_url_path}}/store" method="post">
                       {{csrf_field()}}
                        <h4 class="title"></h4>
                       <ul class="nav nav-pills nav-pills-warning" role="tablist" id="tabs">
                          @include('admin.layout._multi_lang_tab')                    
                       </ul>
                       <div class="tab-content tab-space">
                          @if(isset($arr_lang) && sizeof($arr_lang)>0)
                          @foreach($arr_lang as $lang)
                          <div class="tab-pane {{ $lang['locale']=='en'?'active':'' }}" id="{{ $lang['locale'] }}">                             
                               <div class="form-group has-default bmd-form-group is-filled">
                                  
                                  <label class="bmd-label-floating">Name ({{ $lang['title'] }}) <i class="red">*</i></label>
                                  <input type="text" name="subject_name_{{$lang['locale']}}" id="subject_name_{{$lang['locale']}}" class="form-control subject_name" data-rule-required="true" data-rule-maxlength="60">
                                  <span class="error">{{ $errors->first('subject_name_'.$lang['locale']) }}</span>

                               </div>                                
                          </div>                          
                          @endforeach
                          @endif                   
                       </div>                       
                       <button type="submit" class="btn btn-rose pull-right">Add</button>
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

    <script>
      var rules = new Object();
      $(document).ready(function(){

          $('#frm_create_subject').validate({
              highlight: function(element) { },
              ignore: [],
              rules: rules,
              invalidHandler: function(e, validator){
                  if(validator.errorList.length){
                    $('#tabs a[href="#' + jQuery(validator.errorList[0].element).closest(".tab-pane").attr('id') + '"]').tab('show')
                  }
              }
          });
      });
    </script>

  @endsection

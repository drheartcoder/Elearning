
@extends('creator.layout.master')    
@section('main_content')
<!-- Page header -->
@include('creator.layout.breadcrumb')  
<!-- /page header -->

<!-- BEGIN Main Content -->

<!-- Content area -->
<div class="content">

  <div class="panel panel-flat">
    @include('creator.layout._operation_status')
    <div class="panel-heading">
      <h5 class="panel-title">{{$sub_module_title or ''}}</h5>
    </div>

    <div class="panel-body">
      <form class="form-horizontal" id="frm_edit_program" name="frm_edit_program" action="{{ url($module_url_path.'/update') }}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <input type="hidden" name="program_id" id="program_id" value="{{ isset($arr_program['id']) ? base64_encode($arr_program['id']) : '' }}">
        <fieldset class="content-group">  
                <ul  class="nav nav-tabs">
                    @include('creator.layout._multi_lang_tab')
                </ul>
                <div  class="tab-content">

                    @if(isset($arr_lang) && sizeof($arr_lang)>0)
                      @foreach($arr_lang as $lang)
                        
                        @php
                          $title       = isset($arr_program['program_translation'][$lang['locale']]['title']) ? $arr_program['program_translation'][$lang['locale']]['title']:'';
                          $description = isset($arr_program['program_translation'][$lang['locale']]['description']) ? $arr_program['program_translation'][$lang['locale']]['description']:'';
                        @endphp

                        <div class="tab-pane {{ $lang['locale'] == 'en' ? 'in active' : '' }}" id="{{ $lang['locale'] }}">
                          
                          <div class="form-group">
                            <label class="control-label col-lg-2" for="name">Name<i class="red">*</i></label>
                            <div class="col-lg-5">
                              <input type="text" name="program_name_{{ $lang['locale'] }}" id="program_name_{{ $lang['locale'] }}" class="form-control program_name" placeholder="Name" data-rule-required="true" data-rule-maxlength="60" value="{{ $title }}">
                              <span class="error">{{ $errors->first('program_name_'.$lang['locale']) }} </span>
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-lg-2" for="description">Description<i class="red">*</i></label>
                            <div class="col-lg-5">
                              <textarea class="form-control program_description" placeholder="Description" data-rule-required="true" data-rule-maxlength="500" name="program_description_{{ $lang['locale'] }}" id="program_description_{{ $lang['locale'] }}">{{ $description }}</textarea>
                              <span class="error">{{ $errors->first('program_description_'.$lang['locale']) }} </span>
                            </div>
                          </div>

                        </div>
                      @endforeach
                    @endif


                </div>
                <div class="form-group text-center">
                  <div class="col-lg-7">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ $module_url_path }}" class="btn btn-primary">Back</a>
                  </div>
                </div>
        </fieldset>
      </form>
    </div>

    <script>
        var rules = new Object();

        $('.program_name').each(function()
        {
          rules[this.name] = { required: true };
        });
        $('.program_description').each(function()
        {
          rules[this.name] = { required: true };
        });

        $(document).ready(function()
        {
          
          $('#frm_edit_program').validate(
          {
            ignore: [],
            rules: rules,
            invalidHandler: function(e, validator){
              if(validator.errorList.length)
              $('#tabs a[href="#' + jQuery(validator.errorList[0].element).closest(".tab-pane").attr('id') + '"]').tab('show')
            }
          });
          
        });
    </script>
  

  @endsection



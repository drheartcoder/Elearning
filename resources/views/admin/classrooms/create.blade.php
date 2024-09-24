
@extends('admin.layout.master')    
@section('main_content')
<!-- Page header -->
@include('admin.layout.breadcrumb')  
<!-- /page header -->

<!-- BEGIN Main Content -->

<!-- Content area -->
<div class="content">

  <div class="panel panel-flat">
    @include('admin.layout._operation_status')
    <div class="panel-heading">
      <h5 class="panel-title">{{ $sub_module_title or '' }}</h5>
    </div>

    <div class="panel-body">
      <form class="form-horizontal" id="frm_create_textbook" name="frm_create_textbook" action="{{ url($module_url_path.'/store') }}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <fieldset class="content-group">  
                <ul  class="nav nav-tabs" id="tabs">
                    @include('admin.layout._multi_lang_tab')
                </ul>
                <div  class="tab-content">
                     
                      @if(isset($arr_lang) && sizeof($arr_lang)>0)
                        @foreach($arr_lang as $lang)
                          <div class="tab-pane {{ $lang['locale'] == 'en' ? 'in active' : '' }}" id="{{ $lang['locale'] }}">
                            
                            <div class="form-group">
                              <label class="control-label col-lg-2" for="name">Name<i class="red">*</i></label>
                              <div class="col-lg-5">
                                <input type="text" name="textbook_name_{{ $lang['locale'] }}" id="textbook_name_{{ $lang['locale'] }}" class="form-control textbook_name" placeholder="Name" data-rule-required="true" data-rule-maxlength="60">
                                <span class="error">{{ $errors->first('textbook_name_'.$lang['locale']) }} </span>
                              </div>
                            </div>

                            @if($lang['locale'] == 'en')
                              @if(isset($arr_subject) && !empty($arr_subject))
                                <div class="form-group">
                                  <label class="control-label col-lg-2" for="subject">Subject<i class="red">*</i></label>
                                  <div class="col-lg-5">
                                    <select class="form-control textbook_subject" id="textbook_subject_{{ $lang['locale'] }}" name="textbook_subject_{{ $lang['locale'] }}" data-rule-required="true">
                                      <option value="">Select Subject</option>
                                      @foreach($arr_subject as $subject)
                                        <option value="{{ $subject['id'] }}">{{ $subject['name'] }}</option>
                                      @endforeach
                                    </select>
                                    <span class="error">{{ $errors->first('textbook_subject_'.$lang['locale']) }}</span>
                                  </div>
                                </div>
                              @endif

                              @if(isset($arr_grade) && !empty($arr_grade))
                                <div class="form-group">
                                  <label class="control-label col-lg-2" for="grade">Grade<i class="red">*</i></label>
                                  <div class="col-lg-5">
                                    <select class="form-control textbook_grade" id="textbook_grade_{{ $lang['locale'] }}" name="textbook_grade_{{ $lang['locale'] }}" data-rule-required="true">
                                      <option value="">Select Grade</option>
                                      @foreach($arr_grade as $grade)
                                        <option value="{{ $grade['id'] }}">{{ $grade['name'] }}</option>
                                      @endforeach
                                    </select>
                                    <span class="error">{{ $errors->first('textbook_grade_'.$lang['locale']) }}</span>
                                  </div>
                                </div>
                              @endif

                              @if(isset($arr_template) && !empty($arr_template))
                                <div class="form-group">
                                  <label class="control-label col-lg-2" for="template">Template<i class="red">*</i></label>
                                  <div class="col-lg-5">
                                    <select class="form-control textbook_template" id="textbook_template_{{ $lang['locale'] }}" name="textbook_template_{{ $lang['locale'] }}" data-rule-required="true">
                                      <option value="">Select Template</option>
                                      @foreach($arr_template as $template)
                                        <option value="{{ $template['id'] }}">{{ $template['name'] }}</option>
                                      @endforeach
                                    </select>
                                    <span class="error">{{ $errors->first('textbook_template_'.$lang['locale']) }}</span>
                                  </div>
                                </div>
                              @endif

                              <div class="form-group">
                                <label class="control-label col-lg-2" for="price">Textbook Upload<i class="red">*</i></label>
                                <div class="col-lg-5">
                                  <input type="file" class="file-styled validate_file" name="textbook_file_{{ $lang['locale'] }}" id="uploaded_file" data-rule-required="true">
                                  <span class="error err_textbook_file_en">{{ $errors->first('textbook_file_'.$lang['locale']) }}</span>
                                </div>
                              </div>

                            @endif

                          </div>
                        @endforeach
                      @endif



                </div>

                <div class="form-group text-center">
                  <div class="col-lg-7">
                    <button type="submit" class="btn btn-primary">Add</button>
                    <a href="" class="btn btn-primary">Cancel</a>
                  </div>
                </div>
        </fieldset>
      </form>
    </div>

    <script>
        var rules = new Object();

        $('.textbook_name').each(function()
        {
          rules[this.name] = { required: true };
        });
        $('.textbook_subject').each(function()
        {
          rules[this.name] = { required: true };
        });
        $('.textbook_grade').each(function()
        {
          rules[this.name] = { required: true };
        });
        $('.textbook_template').each(function()
        {
          rules[this.name] = { required: true };
        });
        $('.validate_file').each(function()
        {
          rules[this.name] = { required: true };
        });

        $(document).ready(function()
        {
          $('#frm_create_textbook').validate(
          {
            ignore: [],
            rules: rules,
            errorPlacement: function(error, element) 
            { 
              var name = $(element).attr("name");
              if (name === "textbook_file_en") 
              {
                error.insertAfter('.err_textbook_file_en');
              } 
              else
              {
                error.insertAfter(element);
              }
            },
            invalidHandler: function(e, validator){
              if(validator.errorList.length)
              $('#tabs a[href="#' + jQuery(validator.errorList[0].element).closest(".tab-pane").attr('id') + '"]').tab('show')
            }
          });
        });

        $(document).on("change",".validate_file", function()
        {        
            var file = this.files;
            validateFile(this.files);
        });
    </script>
  

  @endsection



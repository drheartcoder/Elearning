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
      <h5 class="panel-title">{{ $sub_module_title or '' }}</h5>
    </div>

    <div class="panel-body">
      <form class="form-horizontal" id="frm_create_program" name="frm_create_program" action="{{ url($module_url_path.'/store') }}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <fieldset class="content-group">  

          <div class="tab-content">
            <div class="row">
              <div class="col-lg-8">

                    @if(isset($arr_lang) && sizeof($arr_lang)>0)
                      @foreach($arr_lang as $lang)

                          <div class="form-group">
                            <label class="control-label col-lg-2" for="name">Name ({{ $lang['title'] }})<i class="red">*</i></label>
                            <div class="col-lg-8">
                              <input type="text" name="question_name_{{ $lang['locale'] }}" id="question_name_{{ $lang['locale'] }}" class="form-control question_name" placeholder="Name" data-rule-required="true" data-rule-maxlength="60">
                              <span class="error">{{ $errors->first('question_name_'.$lang['locale']) }} </span>
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-lg-2" for="description">Description ({{ $lang['title'] }})<i class="red">*</i></label>
                            <div class="col-lg-8">
                              <textarea class="form-control question_description" placeholder="Description" data-rule-required="true" data-rule-maxlength="500" name="question_description_{{ $lang['locale'] }}" id="question_description_{{ $lang['locale'] }}"></textarea>
                              <span class="error">{{ $errors->first('question_name_'.$lang['locale']) }} </span>
                            </div>
                          </div>

                      @endforeach
                    @endif

                    @if(isset($arr_subject) && !empty($arr_subject))
                      <div class="form-group">
                        <label class="control-label col-lg-2" for="subject">Subject<i class="red">*</i></label>
                        <div class="col-lg-8">
                          <select class="form-control question_subject" id="question_subject_{{ $lang['locale'] }}" name="question_subject_{{ $lang['locale'] }}" data-rule-required="true">
                            <option value="">Select Subject</option>
                            @foreach($arr_subject as $subject)
                              <option value="{{ $subject['id'] }}">{{ $subject['name'] }}</option>
                            @endforeach
                          </select>
                          <span class="error">{{ $errors->first('question_subject_'.$lang['locale']) }}</span>
                        </div>
                      </div>
                    @endif

                    @if(isset($arr_grade) && !empty($arr_grade))
                      <div class="form-group">
                        <label class="control-label col-lg-2" for="grade">Grade<i class="red">*</i></label>
                        <div class="col-lg-8">
                          <select class="form-control question_grade" id="question_grade_{{ $lang['locale'] }}" name="question_grade_{{ $lang['locale'] }}" data-rule-required="true">
                            <option value="">Select Grade</option>
                            @foreach($arr_grade as $grade)
                              <option value="{{ $grade['id'] }}">{{ $grade['name'] }}</option>
                            @endforeach
                          </select>
                          <span class="error">{{ $errors->first('question_grade_'.$lang['locale']) }}</span>
                        </div>
                      </div>
                    @endif

                    @if(isset($arr_program) && !empty($arr_program))
                      <div class="form-group">
                        <label class="control-label col-lg-2" for="program">Program<i class="red">*</i></label>
                        <div class="col-lg-8">
                          <select class="form-control question_program" id="question_program_{{ $lang['locale'] }}" name="question_program_{{ $lang['locale'] }}" data-rule-required="true">
                            <option value="">Select Program</option>
                            @foreach($arr_program as $program)
                              <option value="{{ $program['id'] }}">{{ $program['title'] }}</option>
                            @endforeach
                          </select>
                          <span class="error">{{ $errors->first('question_program_'.$lang['locale']) }}</span>
                        </div>
                      </div>
                    @endif

                    @if(isset($arr_template) && !empty($arr_template))
                      <div class="form-group">
                        <label class="control-label col-lg-2" for="template">Template<i class="red">*</i></label>
                        <div class="col-lg-8">
                          <select class="form-control question_template" id="question_template_{{ $lang['locale'] }}" name="question_template_{{ $lang['locale'] }}" data-rule-required="true">
                            <option value="">Select Template</option>
                            @foreach($arr_template as $template)
                              <option value="{{ $template['id'] }}">{{ $template['name'] }}</option>
                            @endforeach
                          </select>
                          <span class="error">{{ $errors->first('question_template_'.$lang['locale']) }}</span>
                        </div>
                      </div>
                    @endif

              </div>
            </div>

            <div id="template_form_fields"></div>

          </div>

          <div class="form-group text-center">
            <div class="col-lg-7">
              <button type="submit" class="btn btn-primary">Save</button>
              <a href="{{ $module_url_path }}" class="btn btn-primary">Back</a>
            </div>
          </div>
        </fieldset>
      </form>
    </div>

    <script>
        var rules = new Object();

        $('.question_name').each(function(){ 
          rules[this.name] = { required: true }; 
        });

        $(document).ready(function() { 
          $('#frm_create_question').validate({ 
            ignore: [], rules: rules 
          }); 
        });

        $(document).on("change",".question_template", function()
        {
          var question_template = $('.question_template').val();
          if($.trim(question_template) != '')
          {
            $.ajax({
              url : '{{ url($module_url_path."/load_template/") }}'+question_template,
              type : 'get',
              //data : {  },
              success : function(data)
              {
                $('#template_form_fields').html(data);
              }
            });

          }
          else
          {
            $("#template_form_fields").html('');
          }
        });


    </script>
  

  @endsection



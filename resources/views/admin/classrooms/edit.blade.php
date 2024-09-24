
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
                    <form class="form-horizontal" id="frm_edit_class" name="frm_edit_class" action="{{ url($module_url_path.'/update') }}" method="post" enctype="multipart/form-data">
                      {{csrf_field()}}

                          @if(isset($arr_classrooms) && sizeof($arr_classrooms)>0)
                              <input type="hidden" name="class_id" value="{{ $arr_classrooms['id'] }}">
                              <input type="hidden" name="teacher_id" value="{{ $arr_classrooms['teacher_id'] }}">
                                
                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="form-group has-default bmd-form-group is-filled">
                                      <label class="bmd-label-floating">Name <i class="red">*</i></label>
                                      <input type="text" name="class_name" id="class_name" class="form-control" data-rule-required="true" data-rule-maxlength="60" value="{{ $arr_classrooms['name'] }}">
                                      <span class="error">{{ $errors->first('name') }}</span>
                                    </div>
                                  </div>

                                  <div class="col-md-6">
                                    <div class="form-group has-default bmd-form-group is-filled">
                                      <label class="bmd-label-floating">End Date <i class="red">*</i></label>
                                      <input type="text" name="end_date" id="end_date" class="form-control datepicker" data-rule-required="true" data-rule-maxlength="60" value="{{ date('d-M-Y',strtotime($arr_classrooms['end_date'])) }}">
                                      <span class="error">{{ $errors->first('end_date') }}</span>
                                    </div>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="form-group has-default bmd-form-group is-filled">
                                      <select class="selectpicker" data-rule-required="true" data-style="select-with-transition" name="subject" id="subject">
                                        <option value="">Select Subject</option>
                                        @if(isset($subject_arr) && count($subject_arr)>0)
                                          @foreach($subject_arr as $row)                            
                                          <option value="{{$row['id']}}" @if($row['id']==$arr_classrooms['subject_id']) selected="" @endif>{{$row['subject_traslation'][0]['name'].' / '.$row['subject_traslation'][1]['name']}}</option>
                                          @endforeach
                                        @endif                          
                                      </select>
                                    </div>
                                  </div>
                  
                                  
                                  <div class="col-md-6">
                                    <div class="form-group has-default bmd-form-group is-filled">
                                      <select class="selectpicker" data-rule-required="true" data-style="select-with-transition" name="grade" id="grade">
                                      <option value="">Select Grade</option>
                                        @if(isset($arr_grade) && !empty($arr_grade))
                                          @foreach($arr_grade as $grade)
                                            <option value="{{ $grade['id'] }}" @if($arr_classrooms['grade_id'] == $grade['id']) selected @endif>{{$grade['grade_traslation'][0]['name'].' / '.$grade['grade_traslation'][1]['name']}}
                                            </option>
                                          @endforeach
                                        @endif
                                        </select>
                                    </div>
                                  </div>
                                </div>

                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group has-default bmd-form-group is-filled">
                                    <select class="selectpicker" data-style="select-with-transition" name="program" id="program">
                                      <option value="">Select Program</option>
                                      @if(isset($arr_program) && !empty($arr_program))
                                        @foreach($arr_program as $program)
                                          <option value="{{ $program['id'] }}" @if($arr_classrooms['program_id'] == $program['id']) selected @endif>{{ $program['name'] }}</option>
                                        @endforeach
                                      @endif
                                    </select>
                                  </div>
                                </div>
                              </div>

                          @endif

                          <button type="submit" class="btn btn-rose pull-right">Update</button>
                          <a href="{{ $module_url_path }}" class="btn btn-rose pull-right">Cancel</a>

                    </form>
                 </div>
            </div>
         </div>
      </div>
   </div>
</div>

<input type="hidden" name="txt_class_end_date" value="{{ isset($arr_classrooms['teacher_id']) && !empty($arr_classrooms['teacher_id']) ? $arr_classrooms['teacher_id'] : '' }}">

<script>
  var rules = new Object();
  $(document).ready(function(){
      var class_end_date = $("#txt_class_end_date").val();

      jQuery('#frm_edit_class').validate({
          highlight: function (element) {},
          ignore: [],
          rules: rules,
          errorPlacement: function(error, element) 
          { 
            var name = $(element).attr("name");
            error.insertAfter(element);
          }
      });

      var rules = new Object();
      $('.class_name').each(function()
      {
        rules[this.name] = { required: true };
      });
       $('.end_date').each(function()
      {
        rules[this.name] = { required: true };
      });
      $('.subject').each(function()
      {
        rules[this.name] = { required: true };
      });
      $('.grade').each(function()
      {
        rules[this.name] = { required: true };
      });

      $(document).on('change', '#grade', function(){
        var grade = $(this).val();
        var subject = $('#subject').val();
        if(grade!='' && subject != ''){
          $.ajax({
            headers : {'X-CSRF-Token': $('input[name="_token"]').val() },
            url     : '{{ $module_url_path }}/getProgram',
            type    : 'post',
            dataType: 'json',
            data    : {grade:grade,subject:subject},
            success:function(resp){
              if(resp.status=='success')
              {
                if(parseInt(resp.strHTML.length) > 0)
                {
                  $('#program').html(resp.strHTML);
                  $('#program').selectpicker('refresh');
                }
                else
                {
                  $('#program').html('<option value="">No Program Available</option>');
                  $('#program').selectpicker('refresh');
                }
              }
            },
            error:function(resp){

            }
          })
        }
      });

      $(document).on('change', '#subject', function(){
          var subject = $(this).val();
          if(subject!=''){
            $.ajax({
              headers : {'X-CSRF-Token': $('input[name="_token"]').val() },
              url     : '{{ $module_url_path }}/getGrade',
              type    : 'post',
              dataType: 'json',
              data    : {subject:subject},
              success:function(resp){
                if(resp.status=='success')
                {
                  if(parseInt(resp.strHTML.length) > 0)
                  {
                    $('#grade').html(resp.strHTML);
                    $('#grade').selectpicker('refresh');
                  }
                  else
                  {
                    $('#grade').html('<option value="">No Grade Available</option>');
                    $('#grade').selectpicker('refresh');
                  } 
                }
              },
              error:function(resp){

              }
            })
          }
      });

  });
</script>
@endsection
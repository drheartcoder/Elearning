@extends($role_slug.'.layout.master') @section('main_content')
<!-- Page header -->
<!-- @include($role_slug.'.layout.breadcrumb') -->
<style type="text/css">  
  input{cursor: pointer;}
  .breadcrumb ul li{display:inline-block;}
</style>
<ul class="breadcrumb">
  <li class="{{isset($module_title) && !empty($module_title) ? '' : 'active'}}">
      @if(isset($module_title) && !empty($module_title))
          <a href="{{isset($module_title) && isset($parent_module_url) ? $parent_module_url : 'javascript:void(0)'}}">
            {{$parent_module_title or ''}}&nbsp;
            <span class=""><i class="fa fa-angle-right"></i> </span>&nbsp;
          </a>
      @else
          {{$parent_module_title or ''}}
      @endif
  </li>
  <li class="{{isset($module_title) && !empty($module_title) ? '' : 'active'}}">
          <a href="{{ $module_url_path }}">
            Manage Program&nbsp;
            <span class=""><i class="fa fa-angle-right"></i> </span>&nbsp;
          </a>
  </li>
  @if(isset($module_title) && !empty($module_title))
      <li class="">
        {{$module_title or ''}}
      </li>
  @endif
</ul>
<!-- /page header -->
<!-- BEGIN Main Content -->
<script src="{{url('/')}}/js/admin/jquery.form.js"></script> 
<!-- Content area -->
<style type="text/css">
  .form-back-button{position: absolute;top: -15px;right: 0;}
</style>
<div class="content" style="position: relative;">
<a href="{{ $module_url_path.'/view/'.$programId }}" class="btn btn-rose form-back-button">Back</a>
<div class="panel panel-flat">
<div class="container-fluid">
   <div class="row">
      <div class="col-md-12">
        <div class="card-body-section">
         <div class="card ">
            <div class="card-header card-header-rose card-header-text">
               <div class="card-text">
                  <h4 class="card-title">{{ $module_title or 'Select Template' }}</h4>
               </div>
            </div>
            <div class="card-body ">
              
              @include($role_slug.'.layout._operation_status')
               <form name="frmTemplateCreate" id="frmTemplateCreate" class="form-horizontal" method="post" enctype="multipart/form-data" action="{{ $module_form_url }}" >
                  {{ csrf_field() }}
                  <!-- TEMPLATE : SLIDER -->
                  @if(count($arrTemplate) > 0)
                  <div class="select-template-main">
                     <div id="demo" class="carousel slide" data-ride="carousel">
                        <!-- The slideshow -->
                        <div class="carousel-inner">
                           <?php
                              $arrTemplateDivision = array_chunk($arrTemplate, 9);
                              if(count($arrTemplateDivision) > 0)
                              {
                                  $arrTemplateDivisionCount = 1;
                                  foreach ($arrTemplateDivision as $arrTemplateDivisionVal)
                                  {
                                    ?>
                                   <div class="carousel-item @if($arrTemplateDivisionCount==1) active @endif">
                                      <?php
                                         if(count($arrTemplateDivisionVal) > 0)
                                         {
                                             foreach ($arrTemplateDivisionVal as $arrTemplateDivisionValVal)
                                             {
                                                ?>
                                                  <div class="template-img-box-section templateSelector" data-templateId="{{ (isset($arrTemplateDivisionValVal['id']) && $arrTemplateDivisionValVal['id']!='') ? ucfirst($arrTemplateDivisionValVal['id']) : '' }}" >
                                                     <?php
                                                        $imgTemplateURL = $template_public_img_path.'default.png';
                                                        if(isset($arrTemplateDivisionValVal['image']) && $arrTemplateDivisionValVal['image']!='')
                                                        {
                                                            if(file_exists($template_base_img_path.'/'.$arrTemplateDivisionValVal['image']))
                                                            {
                                                                $imgTemplateURL = $template_public_img_path.'/'.$arrTemplateDivisionValVal['image'];
                                                            }    
                                                        }
                                                        ?>
                                                     <img src="{{ $imgTemplateURL }}" />
                                                     <div class="tamplate-name-section">{{ (isset($arrTemplateDivisionValVal['name']) && $arrTemplateDivisionValVal['name']!='') ? ucfirst($arrTemplateDivisionValVal['name']) : '' }}</div>
                                                  </div>                                                  
                                                <?php
                                               }
                                         }
                                         ?>
                                         <div class="clearfix"></div>
                                   </div>
                                    <?php
                                    $arrTemplateDivisionCount++;
                                   }
                              }
                              ?>
                        </div>
                        <!-- Left and right controls -->
                        <a class="carousel-control-prev" href="#demo" data-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                        </a>
                        <a class="carousel-control-next" href="#demo" data-slide="next">
                        <span class="carousel-control-next-icon"></span>
                        </a>
                     </div>
                  </div>
                  @endif
                  <div class="row lesson-section-main-block">                     
                     <div class="col-lg-10">
                        <input type="hidden" name="" id="lastlesson" class="form-control" value="@if(isset($next_lession) && $next_lession !=""){{(isset($next_lession)) ? $next_lession : 'Lesson-1'}}@endif">
                        <div class="form-group" id="TemplateStart">
                            <label class="col-form-label bmd-label-floating">Lesson <span class="red">*</span></label>
                            <!-- <input type="text" name="lessonName" id="lessonName" class="form-control" value="@if(count($arrLesson) > 0) {{ (isset($arrLesson['name'])) ? $arrLesson['name'] : '' }} @endif"> -->
                            <input readonly="readonly" type="text" name="lessonName" id="lessonName" class="form-control" value="@if(isset($next_lession) && $next_lession !=""){{(isset($next_lession)) ? $next_lession : 'Lesson-1'}}@endif">
                            <span class="error" id="err_lessonName"> @if($errors->has('lessonName')) {{ $errors->first('lessonName') }} @endif</span>
                        </div>
                     </div>
                     <div class="col-lg-2">
                        <div class="form-group">
                            <label class="col-form-label bmd-label-floating">Question <span class="red">*</span></label>
                            <input readonly="readonly" type="text" name="" id="NextQuestion" class="form-control" value="@if(isset($nextQueCount) && $nextQueCount !=""){{(isset($nextQueCount)) ? $nextQueCount : '1'}}@endif">
                        </div>
                     </div>
                  </div>
                  <!-- LOAD : TEMPLATE -->
                  <div class="devWrapper">
                    
                  </div>
                  <!-- LOAD : TEMPLATE -->
                  <div class="row">
                     <div class="col-md-6">
                        <button type="button" id="btnAddQuiz" class="btn btn-fill btn-rose">+ Add Quizzes</button>
                       
                        @if(isset($lesson_id) && $lesson_id != "")
                        @else
                        <button type="button" id="btnAddLesson" class="btn btn-fill btn-rose">+ Add Lessons</button>
                        @endif
                        
                     </div>
                     <div class="col-md-6">
                        <div class="right-align-button">
                          <?php
                          $uploadHomeworkURL = $uploadMaterialURL = 'javascript::void(0)';
                          if(count($arrLesson) > 0)
                          {
                            if(isset($arrLesson['id']) && $arrLesson['id']!='')
                            {
                              $uploadHomeworkURL = $module_url_path.'/homework/create/'.base64_encode($subject_id).'/'.base64_encode($grade_id).'/'.$programId.'/'.base64_encode($arrLesson['id']);
                              $uploadMaterialURL = $module_url_path.'/material/create/'.base64_encode($subject_id).'/'.base64_encode($grade_id).'/'.$programId.'/'.base64_encode($arrLesson['id']);
                            }
                          }
                          ?>
                           <!-- <button type="button" id="btnUploadHomework" class="btn btn-fill btn-rose" onClick="javascript:swal('Sorry, It is pending now.')">Upload Homework</button> -->
                          
                           <!-- <button type="button" id="btnUploadMaterials" class="btn btn-fill btn-rose" onClick="javascript:swal('Sorry, It is pending now.')">Upload Materials</button> -->
                           <a href="{{ $uploadMaterialURL }}" id="btnUploadMaterials" class="btn btn-fill btn-rose">Upload Materials</a>
                           <a href="{{ $uploadHomeworkURL }}" id="btnUploadMaterials" class="btn btn-fill btn-rose">Upload Homework</a>
                          
                           <input type="hidden" name="hiddenAction" id="btnAction" value="btnAddQuiz" >
                           <input type="hidden" name="hiddenTemplate" id="hiddenTemplate" value="">
                        </div>
                     </div>
                  </div>
                
				  <div class="right-align-button submit-btns">
						<button type="button" id="btnShowPreview" class="btn btn-fill btn-rose"> Preview</button>
						<button type="button" id="btnSubmit" class="btn btn-fill btn-rose">Submit</button>
				  </div>
                 
               </form>
            </div>
         </div>
          </div>
      </div>
   </div>
</div>

<!-- Template Preview Modal Start  -->
  <div id="popup_template_preview" class="modal fade temp-preview" role="dialog">
    <div class="modal-dialog">
       <div class="modal-content">
           <div class="close-temp" onClick="close_popup()" data-dismiss="modal"><img src="{{url('/')}}/images/close.png" alt="close" /></div>
            <div class="modal-body">
                <span id="resultPreview"></span>
                <!-- <div class="modal-button-section text-right">
                    <button onClick="close_popup()" type="button" class="btn btn-fill btn-rose" data-dismiss="modal">{{trans('home.Ok')}}</button>
                 </div>-->
             </div>
        </div>
    </div>
  </div>
<!-- Template Preview Modal End  -->

<!-- DEVELOPEMENT -->
<script type="text/javascript">
   /*LOAD TEMPLATE via SLIDER*/
   $(document).on('click', '.templateSelector', function(){
       var tempThis       = $(this);
       var jsURL          = '{{ $template_js_path }}template.js';
       var templateId     = $(this).attr('data-templateId');
       var ckeditorJsURL  = '{{ url("/") }}'+'/ckeditor/ckeditor.js';
       var ckeditorJsURL1 = '{{ url("/") }}'+'/js/MathJax-master/MathJax.js?config=TeX-AMS-MML_HTMLorMML';
       var ckeditorJsURL2 = '{{ url("/") }}'+'/js/MathJax-master/MathJax.js?config=TeX-AMS_HTML';
       if(templateId!='')
       {
           $.ajax({
               headers : {'X-CSRF-Token': $('input[name="_token"]').val()},
               url     : '{{ $module_url_path }}/load_template/'+templateId,
               type    : 'GET',
               dataType: 'JSON',
               success:function(res)
               {
                   if(res.status == 'success')
                   {
                      $('.templateSelector').removeClass('tamplate-active');
                      tempThis.addClass('tamplate-active');
                       $.getScript(jsURL);
                       $('#hiddenTemplate').val(templateId);
                       $(".devWrapper").html(res.view);
                        $('html, body').animate({
                            scrollTop: $("#TemplateStart").offset().top
                        }, 700);
                   }
                   else if(res.status == 'error')
                   {
   
                   }
               },
               error:function(res)
               {
   
               }
           })
       }
   });
   /*LESSON : ADD*/
   $(document).on('click', '#btnAddLesson', function(){
       var current_question_number = $('#NextQuestion').val();
       var get_last_lession = $('#lastlesson').val();
       if(get_last_lession == ""){
         $('#lessonName').val('Lesson-1');         
         $('html, body').animate({
            scrollTop: $("#TemplateStart").offset().top
        }, 700);
       } else {
         if(current_question_number>1)
         {
           var splitdata = get_last_lession.split('-');
           if(splitdata[1] != ""){
           var next_lession = (parseInt(1)+parseInt(splitdata[1]));
           $('#lessonName').val('Lesson-'+next_lession);
           } else {
           $('#lessonName').val('Lesson-1');
           }
           $('html, body').animate({
                scrollTop: $("#TemplateStart").offset().top
            }, 700);
         }
         else
         {
            swal('Lesson should contain atleast 1 question');
         }
       }

        /* get nextQuestion */
        var lessonName     = $('#lessonName').val();
        var programId      = '{{$programId}}';
        var csrf_field     = "<?php echo csrf_token(); ?>";
        var url            = '{{ url('/') }}/program-creator/program/nextquecount';
        $.ajax({
          type:"POST",
          url:url,
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          data:{programId:programId,lessonName:lessonName,_token:csrf_field},
          success: function(response){
            //console.log(response);
            $('#NextQuestion').val(response);
          }
        });   

   });
   /*QUIZ : ADD & CLOSE PROGRAM*/
   $(document).on('click', '#btnSubmit', function(){
       $('#btnAction').val('btnSubmit');
       $('#btnAddQuiz').trigger('click');
   });

   /*function imageSizeValidate(tempThis, files, width, height)
   {
       var ext = tempThis.val().split('.').pop().toLowerCase();
       if(!(ext == "jpg" || ext == "jpeg" || ext == "gif" || ext == "png" || ext == "GIF" || ext == "JPG" || ext == "JPEG" || ext == "PNG"))
       {
          swal("Invalid file type.");

          var id = tempThis.closest('.profile-img-block').find('.imgFilePreview').attr('id');
          $('#'+id).attr('src', '{{ url("/") }}/images/default.jpg');
          $('.imgFile').val('');
       }
       else if ((file = files[0])) 
        {
          var _URL = window.URL || window.webkitURL;
          var file, img;
          img = new Image();
            img.onload = function() 
            {
              if(this.width<width && this.height<height )
              {
                  tempThis.attr('data-error','yes');
                  swal("File must be grater than / equal to "+width+" X "+height);

                  var id = tempThis.closest('.profile-img-block').find('.imgFilePreview').attr('id');
                  $('#'+id).attr('src', '{{ url("/") }}/images/default.jpg');
                  $('.imgFile').val('');
              }
              else
              {
                tempThis.attr('data-error','no');
              }
            };
            img.src = _URL.createObjectURL(file);
        }
   }*/

    function imageSizeValidate (tempThis,files,width,height) 
    {
      var image_height  = height || 0;
      var image_width   = width || 0;
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
                swal("Sorry, " + files[0]['name'] + " is invalid, allowed extensions are: jpeg , jpg , png");
                var id = tempThis.closest('.profile-img-block').find('.imgFilePreview').attr('id');
                $('#'+id).attr('src', '{{ url("/") }}/images/default.jpg');
                $(".imgFile").val('');
                return false;
              } 
              else
              {              
                  if(file_size>max_file_size)
                  {
                      swal("Sorry, max "+max_file_size+" Kb size is allowed");
                      var id = tempThis.closest('.profile-img-block').find('.imgFilePreview').attr('id');
                      $('#'+id).attr('src', '{{ url("/") }}/images/default.jpg');
                      $(tempThis).val('');
                      return false;
                  }
                    var reader = new FileReader();
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
                              var id = tempThis.closest('.profile-img-block').find('.imgFilePreview').attr('id');
                              $('#'+id).attr('src', '{{ url("/") }}/images/default.jpg');
                              $(tempThis).val('');
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

   
   /*QUIZ : ADD*/
   $(document).on('click', '#btnAddQuiz', function(){
       var btnAction  = $('#btnAction').val();
       var hiddenTemplate = $('#hiddenTemplate').val();
       var lessonName = $('#lessonName').val();
       var flag = 0;
       var formActionURL = '';
       
       if(hiddenTemplate=='')
       {
           swal("Please Select a Template.");
           return false;
       }
       else
       {
/*           $('#btnAddLesson').attr('disabled', true);
           $('#btnAddQuiz').attr('disabled', true);
           $('#btnSubmit').attr('disabled', true);*/
           /*if(btnAction=='btnAddQuiz')
           {
              $('#btnAddQuiz').html("+ Processing...");
           }
           else if(btnAction=='btnSubmit')
           {
              $('#btnSubmit').html("Processing...");
           }*/

           var formActionURL =  '{{ $module_form_url }}/'+hiddenTemplate;
           $('#err_lessonName').html('');
           if(lessonName=='')
           {
               $('#err_lessonName').html('The lesson name field is required.');
               flag = 1;
           }
           /*TEMPLATE : VALIDATION*/
           if(parseInt(hiddenTemplate)==1)
           {
               var direction = $('#direction').val();
               var fileType = $('#fileType').val();
               var question = $('#question').val();
               var flHorn   = $('#flHorn').val();
               var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);
               var duration = $('#duration').val();

               $('#err_direction').html('');
               $('#err_fileType').html('');
               $('#err_imgFile').html('');
               $('#err_vdoFile').html('');
               $('#err_question').html('');
               $('#err_flHorn').html('');
               $('#err_duration').html('');
               
               if($.trim(direction)=='')
               {
                  $('#err_direction').html('This field is required.');
                  flag = 1;
               }
               
               if(fileType=='')
               {
                   $('#err_fileType').html('This field is required.');
                   flag = 1;
               }
               else if(fileType=='image')
               {
                   var imgFile = $('#imgFile').val();
                   var imgFileExt = imgFile.substring(imgFile.lastIndexOf('.') + 1);
                   if(imgFile == '')
                   {
                       $('#err_imgFile').html('This field is required.');
                       flag = 1;
                   }
                   else if(!(imgFileExt == "jpg" || imgFileExt == "jpeg" || imgFileExt == "gif" || imgFileExt == "png" || imgFileExt == "GIF" || imgFileExt == "JPG" || imgFileExt == "JPEG" || imgFileExt == "PNG"))
                   {
                       $('#err_imgFile').html('Invalid file type.');
                       flag=1;
                   }
                   else if($('#imgFile').attr('data-error')=='yes')
                   {
                      $('#err_imgFile').html('File must be grater than / equal to 570 X 442.');
                      flag=1;  
                   }

               }
               else if(fileType=='video')
               {
                   var vdoFile = $('#vdoFile').val();
                   var vdoFileExt = vdoFile.substring(vdoFile.lastIndexOf('.') + 1);
                   
                   if(vdoFile == '')
                   {
                       $('#err_vdoFile').html('This field is required.');
                       flag = 1;
                   }
                   else if(!(vdoFileExt == "mp4" || vdoFileExt == "MP4"))
                   {
                       $('#err_vdoFile').html('Invalid file type.');
                       flag = 1;
                   }
               }
   
               if($.trim(question)=='')
               {
                   $('#err_question').html('This field is required.');
                   flag = 1;
               }
   
               if(flHorn == '')
               {
                   $('#err_flHorn').html('This field is required.');
                   flag = 1;
               }
               else if(!(flHornExt == "mp3" || flHornExt == "MP3" || flHornExt == "wave" || flHornExt == "m4a"))
               {
                   $('#err_flHorn').html('Invalid file type.');
                   flag = 1;
               }

               /*if(parseInt(duration)==0 && parseInt(duration)=='')*/
               if($.trim(duration)=='' || parseInt(duration)==0)
               {
                  $('#err_duration').html('This field is required.');
                  flag = 1;
               }
               else if(isNaN(duration))
               {
                  $('#err_duration').html('Invalid time.');
                  flag = 1;
               }
   
           }

           else if(parseInt(hiddenTemplate)==2)
           {
               var direction = $('#direction').val();
               var fileType = $('#fileType').val();
               var question = $('#question').val();
               var flHorn   = $('#flHorn').val();
               var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);
               var duration = $('#duration').val();
    
               $('#err_direction').html('');
               $('#err_fileType').html('');
               $('#err_imgFile').html('');
               $('#err_vdoFile').html('');
               $('#err_question').html('');
               $('#err_flHorn').html('');
               $('#err_chkBlankLetter').html('');
               $('#err_duration').html('');

               if($.trim(direction)=='')
               {
                  $('#err_direction').html('This field is required.');
                  flag = 1;
               }

               if(fileType=='')
               {
                   $('#err_fileType').html('This field is required.');
                   flag = 1;
               }
               else if(fileType=='image')
               {
                   var imgFile = $('#imgFile').val();
                   var imgFileExt = imgFile.substring(imgFile.lastIndexOf('.') + 1);
                   if(imgFile == '')
                   {
                       $('#err_imgFile').html('This field is required.');
                       flag = 1;
                   }
                   else if(!(imgFileExt == "jpg" || imgFileExt == "jpeg" || imgFileExt == "gif" || imgFileExt == "png" || imgFileExt == "GIF" || imgFileExt == "JPG" || imgFileExt == "JPEG" || imgFileExt == "PNG"))
                   {
                       $('#err_imgFile').html('Invalid file type.');
                       flag=1;
                   }
                   else if($('#imgFile').attr('data-error')=='yes')
                   {
                      $('#err_imgFile').html('File must be grater than / equal to 570 X 442.');
                      flag=1;  
                   }
               }
               else if(fileType=='video')
               {
                   var vdoFile = $('#vdoFile').val();
                   var vdoFileExt = vdoFile.substring(vdoFile.lastIndexOf('.') + 1);
                   
                   if(vdoFile == '')
                   {
                       $('#err_vdoFile').html('This field is required.');
                       flag = 1;
                   }
                   else if(!(vdoFileExt == "mp4" || vdoFileExt == "MP4"))
                   {
                       $('#err_vdoFile').html('Invalid file type.');
                       flag = 1;
                   }
               }

               if($.trim(question)=='')
               {
                   $('#err_question').html('This field is required.');
                   flag = 1;
               }
               else
               {
                  if($('input[name="chkBlankLetter[]"]:checked').length == 0)
                  {
                    $('#err_chkBlankLetter').html('Please checked atleast one checkbox');
                    flag = 1;    
                  }
               }

               if(flHorn == '')
               {
                   $('#err_flHorn').html('This field is required.');
                   flag = 1;
               }
               else if(!(flHornExt == "mp3" || flHornExt == "MP3" || flHornExt == "wave" || flHornExt == "m4a"))
               {
                   $('#err_flHorn').html('Invalid file type.');
                   flag = 1;
               }

               if($.trim(duration)=='' || parseInt(duration)==0)
               {
                  $('#err_duration').html('This field is required.');
                  flag = 1;
               }
               else if(isNaN(duration))
               {
                  $('#err_duration').html('Invalid time.');
                  flag = 1;
               }
           }

           else if(parseInt(hiddenTemplate)==3)
           {
               var direction = $('#direction').val();
               var answer = $('#answer').val();
               
               var flQuestion1 = $('#flQuestion1').val();
               var flQuestion1Ext = flQuestion1.substring(flQuestion1.lastIndexOf('.')+1);
               var question1 = $('#question1').val();

               var flQuestion2 = $('#flQuestion2').val();
               var flQuestion2Ext = flQuestion2.substring(flQuestion2.lastIndexOf('.')+1);
               var question2 = $('#question2').val();

               var flHorn   = $('#flHorn').val();
               var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);

               var duration = $('#duration').val();

               $('#err_direction').html('');
               $('#err_answer').html('');
               $('#err_flQuestion1').html('');
               $('#err_question1').html('');
               $('#err_flQuestion2').html('');
               $('#err_question2').html('');
               $('#err_flHorn').html('');
               $('#err_duration').html('');

               if($.trim(direction)=='')
               {
                  $('#err_direction').html('This field is required.');
                  flag = 1;
               }
               
               if($.trim(answer)=='')
               {
                  $('#err_answer').html('This field is required.');
                  flag = 1;
               }

               if(flQuestion1=='')
               {
                  $('#err_flQuestion1').html('This field is required.');
                  flag = 1;
               }
               else if(!(flQuestion1Ext == "jpg" || flQuestion1Ext == "jpeg" || flQuestion1Ext == "gif" || flQuestion1Ext == "png" || flQuestion1Ext == "GIF" || flQuestion1Ext == "JPG" || flQuestion1Ext == "JPEG" || flQuestion1Ext == "PNG"))
               {
                  $('#err_flQuestion1').html('Invalid file type.');
                  flag=1;
               }
               else if($('#flQuestion1').attr('data-error')=='yes')
               {
                  $('#err_flQuestion1').html('File must be grater than / equal to 570 X 442.');
                  flag=1;  
               }

               if($.trim(question1)=='')
               {
                  $('#err_question1').html('This field is required.');
                  flag = 1;
               }
               else if(!question1.toLowerCase().match(answer.toLowerCase()))
               {
                  $('#err_question1').html('Question must contain answer value word.');
                  flag = 1;
               }

               if(flQuestion2=='')
               {
                  $('#err_flQuestion2').html('This field is required.');
                  flag = 1;
               }
               else if(!(flQuestion2Ext == "jpg" || flQuestion2Ext == "jpeg" || flQuestion2Ext == "gif" || flQuestion2Ext == "png" || flQuestion2Ext == "GIF" || flQuestion2Ext == "JPG" || flQuestion2Ext == "JPEG" || flQuestion2Ext == "PNG"))
               {
                  $('#err_flQuestion2').html('Invalid file type.');
                  flag=1;
               }
               else if($('#flQuestion2').attr('data-error')=='yes')
               {
                  $('#err_flQuestion2').html('File must be grater than / equal to 570 X 442.');
                  flag=1;  
               }
               
               if($.trim(question2)=='')
               {
                  $('#err_question2').html('This field is required.');
                  flag = 1;
               }
               else if(!question2.toLowerCase().match(answer.toLowerCase()))
               {
                  $('#err_question2').html('Question must contain answer value word.');
                  flag = 1;
               }

               if(flHorn == '')
               {
                   $('#err_flHorn').html('This field is required.');
                   flag = 1;
               }
               else if(!(flHornExt == "mp3" || flHornExt == "MP3" || flHornExt == "wave" || flHornExt == "m4a"))
               {
                   $('#err_flHorn').html('Invalid file type.');
                   flag = 1;
               }

                if($.trim(duration)=='' || parseInt(duration)==0)
                {
                  $('#err_duration').html('This field is required.');
                  flag = 1;
                }
                else if(isNaN(duration))
                {
                  $('#err_duration').html('Invalid time.');
                  flag = 1;
                }

           }

           else if(parseInt(hiddenTemplate)==4)
           {
               var direction = $('#direction').val();
               var answer = $('#answer').val();
               
               var flQuestion1 = $('#flQuestion1').val();
               var flQuestion1Ext = flQuestion1.substring(flQuestion1.lastIndexOf('.')+1);
               var question1 = $('#question1').val();

               var flQuestion2 = $('#flQuestion2').val();
               var flQuestion2Ext = flQuestion2.substring(flQuestion2.lastIndexOf('.')+1);
               var question2 = $('#question2').val();

               var flQuestion3 = $('#flQuestion3').val();
               var flQuestion3Ext = flQuestion3.substring(flQuestion3.lastIndexOf('.')+1);
               var question3 = $('#question3').val();

               var flHorn   = $('#flHorn').val();
               var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);

               var duration = $('#duration').val();
               var matchFlag = 1;


               $('#err_direction').html('');
               $('#err_answer').html('');
               $('#err_flQuestion1').html('');
               $('#err_question1').html('');
               $('#err_flQuestion2').html('');
               $('#err_question2').html('');
               $('#err_flQuestion3').html('');
               $('#err_question3').html('');
               $('#err_flHorn').html('');
               $('#err_duration').html('');

               if($.trim(direction)=='')
               {
                  $('#err_direction').html('This field is required.');
                  flag = 1;
               }
               
               if($.trim(answer)=='')
               {
                  $('#err_answer').html('This field is required.');
                  flag = 1;
               }

               if(flQuestion1=='')
               {
                  $('#err_flQuestion1').html('This field is required.');
                  flag = 1;
               }
               else if(!(flQuestion1Ext == "jpg" || flQuestion1Ext == "jpeg" || flQuestion1Ext == "gif" || flQuestion1Ext == "png" || flQuestion1Ext == "GIF" || flQuestion1Ext == "JPG" || flQuestion1Ext == "JPEG" || flQuestion1Ext == "PNG"))
               {
                  $('#err_flQuestion1').html('Invalid file type.');
                  flag=1;
               }
               else if($('#flQuestion1').attr('data-error')=='yes')
               {
                  $('#err_flQuestion1').html('File must be grater than / equal to 270 X 270.');
                  flag=1;  
               }

               if($.trim(question1)=='')
               {
                  $('#err_question1').html('This field is required.');
                  flag = 1;
               }


               if(flQuestion2=='')
               {
                  $('#err_flQuestion2').html('This field is required.');
                  flag = 1;
               }
               else if(!(flQuestion2Ext == "jpg" || flQuestion2Ext == "jpeg" || flQuestion2Ext == "gif" || flQuestion2Ext == "png" || flQuestion2Ext == "GIF" || flQuestion2Ext == "JPG" || flQuestion2Ext == "JPEG" || flQuestion2Ext == "PNG"))
               {
                  $('#err_flQuestion2').html('Invalid file type.');
                  flag=1;
               }
               else if($('#flQuestion2').attr('data-error')=='yes')
               {
                  $('#err_flQuestion2').html('File must be grater than / equal to 270 X 270.');
                  flag=1;  
               }

               if($.trim(question2)=='')
               {
                  $('#err_question2').html('This field is required.');
                  flag = 1;
               }

               if(flQuestion3=='')
               {
                  $('#err_flQuestion3').html('This field is required.');
                  flag = 1;
               }
               else if(!(flQuestion3Ext == "jpg" || flQuestion3Ext == "jpeg" || flQuestion3Ext == "gif" || flQuestion3Ext == "png" || flQuestion3Ext == "GIF" || flQuestion3Ext == "JPG" || flQuestion3Ext == "JPEG" || flQuestion3Ext == "PNG"))
               {
                  $('#err_flQuestion3').html('Invalid file type.');
                  flag=1;
               }
               else if($('#flQuestion3').attr('data-error')=='yes')
               {
                  $('#err_flQuestion3').html('File must be grater than / equal to 270 X 270.');
                  flag=1;  
               }

               if($.trim(question3)=='')
               {
                  $('#err_question3').html('This field is required.');
                  flag = 1;
               }

               if(flHorn == '')
               {
                   $('#err_flHorn').html('This field is required.');
                   flag = 1;
               }
               else if(!(flHornExt == "mp3" || flHornExt == "MP3" || flHornExt == "wave" || flHornExt == "m4a"))
               {
                   $('#err_flHorn').html('Invalid file type.');
                   flag = 1;
               }

               if(question1.toLowerCase().match(answer.toLowerCase()))
               {
                  matchFlag = 0;
               }
               if(question2.toLowerCase().match(answer.toLowerCase()))
               {
                  matchFlag = 0;
               }
               if(question3.toLowerCase().match(answer.toLowerCase()))
               {
                  matchFlag = 0;
               }

               if(parseInt(matchFlag)==1)
               {
                  swal('Atleast one question should contain "'+answer+'" value.');
                  flag = 1;
               }

               if($.trim(duration)=='' || parseInt(duration)==0)
                {
                  $('#err_duration').html('This field is required.');
                  flag = 1;
                }
                else if(isNaN(duration))
                {
                  $('#err_duration').html('Invalid time.');
                  flag = 1;
                }

           }

           else if(parseInt(hiddenTemplate)==5)
           {
               var fileType = $('#fileType').val();
               var direction = $('#direction').val();
               var option1 = $('#option1').val();
               var option2 = $('#option2').val();
               var rdoOption = $('input[name="rdoOption"]:checked').val();
               var flHorn   = $('#flHorn').val();
               var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);
               var duration = $('#duration').val();
   
               $('#err_fileType').html('');
               $('#err_imgFile').html('');
               $('#err_vdoFile').html('');
               $('#err_direction').html('');
               $('#err_option1').html('');
               $('#err_option2').html('');
               $('#err_rdoOption').html('');
               $('#err_flHorn').html('');
               $('#err_duration').html('');
   
               if(fileType=='')
               {
                   $('#err_fileType').html('This field is required.');
                   flag = 1;
               }
               else if(fileType=='image')
               {
                   var imgFile = $('#imgFile').val();
                   var imgFileExt = imgFile.substring(imgFile.lastIndexOf('.') + 1);
                   if(imgFile == '')
                   {
                       $('#err_imgFile').html('This field is required.');
                       flag = 1;
                   }
                   else if(!(imgFileExt == "jpg" || imgFileExt == "jpeg" || imgFileExt == "gif" || imgFileExt == "png" || imgFileExt == "GIF" || imgFileExt == "JPG" || imgFileExt == "JPEG" || imgFileExt == "PNG"))
                   {
                       $('#err_imgFile').html('Invalid file type.');
                       flag=1;
                   }
                   else if($('#imgFile').attr('data-error')=='yes')
                   {
                      $('#err_imgFile').html('File must be grater than / equal to 570 X 442.');
                      flag=1;  
                   }
               }
               else if(fileType=='video')
               {
                   var vdoFile = $('#vdoFile').val();
                   var vdoFileExt = vdoFile.substring(vdoFile.lastIndexOf('.') + 1);
                   
                   if(vdoFile == '')
                   {
                       $('#err_vdoFile').html('This field is required.');
                       flag = 1;
                   }
                   else if(!(vdoFileExt == "mp4" || vdoFileExt == "MP4"))
                   {
                       $('#err_vdoFile').html('Invalid file type.');
                       flag = 1;
                   }
               }
   
               if($.trim(direction)=='')
               {
                   $('#err_direction').html('This field is required.');
                   flag = 1;
               }

               if($.trim(option1)=='')
               {
                   $('#err_option1').html('This field is required.');
                   flag = 1;
               }

               if($.trim(option2)=='')
               {
                   $('#err_option2').html('This field is required.');
                   flag = 1;
               }

               if(rdoOption==null)
               {
                   $('#err_rdoOption').html('Check one option as answer');
                   flag = 1;
               }
               
               if(flHorn == '')
               {
                   $('#err_flHorn').html('This field is required.');
                   flag = 1;
               }
               else if(!(flHornExt == "mp3" || flHornExt == "MP3" || flHornExt == "wave" || flHornExt == "m4a"))
               {
                   $('#err_flHorn').html('Invalid file type.');
                   flag = 1;
               }

               if($.trim(duration)=='' || parseInt(duration)==0)
                {
                  $('#err_duration').html('This field is required.');
                  flag = 1;
                }
                else if(isNaN(duration))
                {
                  $('#err_duration').html('Invalid time.');
                  flag = 1;
                }
   
           }

           else if(parseInt(hiddenTemplate)==6)
           {
               var direction = $('#direction').val();
               var flQuestion = $('#flQuestion').val();
               var flQuestionExt = flQuestion.substring(flQuestion.lastIndexOf('.')+1);
               var option1 = $('#option1').val();
               var option2 = $('#option2').val();
               var rdoOption = $('input[name="rdoOption"]:checked').val();
               var flHorn   = $('#flHorn').val();
               var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);
               var duration = $('#duration').val();

               $('#err_direction').html('');
               $('#err_flQuestion').html('');
               $('#err_option1').html('');
               $('#err_option2').html('');
               $('#err_rdoOption').html('');
               $('#err_flHorn').html('');
               $('#err_duration').html('');

               if($.trim(direction)=='')
               {
                  $('#err_direction').html('This field is required.');
                  flag = 1;
               }

               if(flQuestion=='')
               {
                  $('#err_flQuestion').html('This field is required.');
                  flag = 1;
               }
               else if(!(flQuestionExt == "mp4" || flQuestionExt == "MP4"))
               {
                  $('#err_flQuestion').html('Invalid file type.');
                  flag=1;
               }

               if($.trim(option1)=='')
               {
                   $('#err_option1').html('This field is required.');
                   flag = 1;
               }

               if($.trim(option2)=='')
               {
                   $('#err_option2').html('This field is required.');
                   flag = 1;
               }

               if(rdoOption==null)
               {
                   $('#err_rdoOption').html('Check one option as answer');
                   flag = 1;
               }
               
               if(flHorn == '')
               {
                   $('#err_flHorn').html('This field is required.');
                   flag = 1;
               }
               else if(!(flHornExt == "mp3" || flHornExt == "MP3" || flHornExt == "wave" || flHornExt == "m4a"))
               {
                   $('#err_flHorn').html('Invalid file type.');
                   flag = 1;
               }

               if($.trim(duration)=='' || parseInt(duration)==0)
                {
                  $('#err_duration').html('This field is required.');
                  flag = 1;
                }
                else if(isNaN(duration))
                {
                  $('#err_duration').html('Invalid time.');
                  flag = 1;
                }
           }

           else if(parseInt(hiddenTemplate)==7)
           {
               var direction = $('#direction').val();
               var flQuestion1 = $('#flQuestion1').val();
               var flQuestion1Ext = flQuestion1.substring(flQuestion1.lastIndexOf('.')+1);
               var answer1 = $('#answer1').val();
               var flQuestion2 = $('#flQuestion2').val();
               var flQuestion2Ext = flQuestion2.substring(flQuestion2.lastIndexOf('.')+1);
               var answer2 = $('#answer2').val();
               var flQuestion3 = $('#flQuestion3').val();
               var flQuestion3Ext = flQuestion3.substring(flQuestion3.lastIndexOf('.')+1);
               var answer3 = $('#answer3').val();
               var flQuestion4 = $('#flQuestion4').val();
               var flQuestion4Ext = flQuestion4.substring(flQuestion4.lastIndexOf('.')+1);
               var answer4 = $('#answer4').val();
               var flQuestion5 = $('#flQuestion5').val();
               var flQuestion5Ext = flQuestion5.substring(flQuestion5.lastIndexOf('.')+1);
               var answer5 = $('#answer5').val();
               var flHorn   = $('#flHorn').val();
               var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);
               var duration = $('#duration').val();

               $('#err_direction').html('');
               $('#err_flQuestion1').html('');
               $('#err_answer1').html('');
               $('#err_flQuestion2').html('');
               $('#err_answer2').html('');
               $('#err_flQuestion3').html('');
               $('#err_answer3').html('');
               $('#err_flQuestion4').html('');
               $('#err_answer4').html('');
               $('#err_flQuestion5').html('');
               $('#err_answer5').html('');
               $('#err_flHorn').html('');
               $('#err_duration').html('');

               //alert($('#flQuestion1').attr('data-error'));

               if($.trim(direction)=='')
               {
                  $('#err_direction').html('This field is required.');
                  flag = 1;
               }

               if(flQuestion1 == '')
               {
                   $('#err_flQuestion1').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion1Ext == "jpg" || flQuestion1Ext == "jpeg" || flQuestion1Ext == "gif" || flQuestion1Ext == "png" || flQuestion1Ext == "GIF" || flQuestion1Ext == "JPG" || flQuestion1Ext == "JPEG" || flQuestion1Ext == "PNG"))
               {
                   $('#err_flQuestion1').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion1').attr('data-error')=='yes')
               {
                  $('#err_flQuestion1').html('File must be grater than / equal to 210 X 210.');
                  flag=1;  
               }
               if($.trim(answer1)=='')
               {
                  $('#err_answer1').html('This field is required.');
                  flag = 1;
               }


               if(flQuestion2 == '')
               {
                   $('#err_flQuestion2').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion2Ext == "jpg" || flQuestion2Ext == "jpeg" || flQuestion2Ext == "gif" || flQuestion2Ext == "png" || flQuestion2Ext == "GIF" || flQuestion2Ext == "JPG" || flQuestion2Ext == "JPEG" || flQuestion2Ext == "PNG"))
               {
                   $('#err_flQuestion2').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion2').attr('data-error')=='yes')
               {
                  $('#err_flQuestion2').html('File must be grater than / equal to 210 X 210.');
                  flag=1;  
               }
               if($.trim(answer2)=='')
               {
                  $('#err_answer2').html('This field is required.');
                  flag = 1;
               }

               if(flQuestion3 == '')
               {
                   $('#err_flQuestion3').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion3Ext == "jpg" || flQuestion3Ext == "jpeg" || flQuestion3Ext == "gif" || flQuestion3Ext == "png" || flQuestion3Ext == "GIF" || flQuestion3Ext == "JPG" || flQuestion3Ext == "JPEG" || flQuestion3Ext == "PNG"))
               {
                   $('#err_flQuestion3').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion3').attr('data-error')=='yes')
               {
                  $('#err_flQuestion3').html('File must be grater than / equal to 210 X 210.');
                  flag=1;  
               }
               if($.trim(answer3)=='')
               {
                  $('#err_answer3').html('This field is required.');
                  flag = 1;
               }

               if(flQuestion4 == '')
               {
                   $('#err_flQuestion4').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion4Ext == "jpg" || flQuestion4Ext == "jpeg" || flQuestion4Ext == "gif" || flQuestion4Ext == "png" || flQuestion4Ext == "GIF" || flQuestion4Ext == "JPG" || flQuestion4Ext == "JPEG" || flQuestion4Ext == "PNG"))
               {
                   $('#err_flQuestion4').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion4').attr('data-error')=='yes')
               {
                  $('#err_flQuestion4').html('File must be grater than / equal to 210 X 210.');
                  flag=1;  
               }
               if($.trim(answer4)=='')
               {
                  $('#err_answer4').html('This field is required.');
                  flag = 1;
               }

               if(flQuestion5 == '')
               {
                   $('#err_flQuestion5').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion5Ext == "jpg" || flQuestion5Ext == "jpeg" || flQuestion5Ext == "gif" || flQuestion5Ext == "png" || flQuestion5Ext == "GIF" || flQuestion5Ext == "JPG" || flQuestion5Ext == "JPEG" || flQuestion5Ext == "PNG"))
               {
                   $('#err_flQuestion5').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion5').attr('data-error')=='yes')
               {
                  $('#err_flQuestion5').html('File must be grater than / equal to 210 X 210.');
                  flag=1;  
               }
               if($.trim(answer5)=='')
               {
                  $('#err_answer5').html('This field is required.');
                  flag = 1;
               }

               if(flHorn == '')
               {
                   $('#err_flHorn').html('This field is required.');
                   flag = 1;
               }
               else if(!(flHornExt == "mp3" || flHornExt == "MP3" || flHornExt == "wave" || flHornExt == "m4a"))
               {
                   $('#err_flHorn').html('Invalid file type.');
                   flag = 1;
               }

               if($.trim(duration)=='' || parseInt(duration)==0)
               {
                  $('#err_duration').html('This field is required.');
                  flag = 1;
               }
               else if(isNaN(duration))
               {
                  $('#err_duration').html('Invalid time.');
                  flag = 1;
               }

           }

           else if(parseInt(hiddenTemplate)==8)
           {
               var direction = $('#direction').val();
               var flQuestion1 = $('#flQuestion1').val();
               var flQuestion1Ext = flQuestion1.substring(flQuestion1.lastIndexOf('.')+1);
               var question1 = $('#question1').val();
               var answer1 = $('#answer1').val();
               var flQuestion2 = $('#flQuestion2').val();
               var flQuestion2Ext = flQuestion2.substring(flQuestion2.lastIndexOf('.')+1);
               var question2 = $('#question2').val();
               var answer2 = $('#answer2').val();
               var flHorn   = $('#flHorn').val();
               var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);
               var duration = $('#duration').val();

               $('#err_direction').html('');
               $('#err_flQuestion1').html('');
               $('#err_question1').html('');
               $('#err_answer1').html('');
               $('#err_flQuestion2').html('');
               $('#err_question2').html('');
               $('#err_answer2').html('');
               $('#err_flHorn').html('');
               $('#err_duration').html('');

               if($.trim(direction)=='')
               {
                  $('#err_direction').html('This field is required.');
                  flag = 1;
               }

               if(flQuestion1 == '')
               {
                   $('#err_flQuestion1').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion1Ext == "jpg" || flQuestion1Ext == "jpeg" || flQuestion1Ext == "gif" || flQuestion1Ext == "png" || flQuestion1Ext == "GIF" || flQuestion1Ext == "JPG" || flQuestion1Ext == "JPEG" || flQuestion1Ext == "PNG"))
               {
                   $('#err_flQuestion1').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion1').attr('data-error')=='yes')
               {
                  $('#err_flQuestion1').html('File must be grater than / equal to 570 X 442.');
                  flag=1;  
               }
               if($.trim(question1)=='')
               {
                  $('#err_question1').html('This field is required.');
                  flag = 1;
               }
               else
               {
                  var questionAnsArr = question1.match(/#BLANK#/g);
                  if(questionAnsArr==null)
                  {
                    $('#err_question1').html('#BLANK# is missing');
                    flag = 1;    
                  }
                  else
                  {
                    var questionAnsCount = questionAnsArr.length;  
                    if(parseInt(questionAnsCount)!=1)
                    {
                      $('#err_question1').html('Only one #BLANK# is allowed');
                      flag = 1;       
                    }
                  }
               }
               
               if($.trim(answer1)=='')
               {
                  $('#err_answer1').html('This field is required.');
                  flag = 1;
               }

               if(flQuestion2 == '')
               {
                   $('#err_flQuestion2').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion2Ext == "jpg" || flQuestion2Ext == "jpeg" || flQuestion2Ext == "gif" || flQuestion2Ext == "png" || flQuestion2Ext == "GIF" || flQuestion2Ext == "JPG" || flQuestion2Ext == "JPEG" || flQuestion2Ext == "PNG"))
               {
                   $('#err_flQuestion2').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion2').attr('data-error')=='yes')
               {
                  $('#err_flQuestion2').html('File must be grater than / equal to 570 X 442.');
                  flag=1;  
               }
               if($.trim(question2)=='')
               {
                  $('#err_question2').html('This field is required.');
                  flag = 1;
               }
               else
               {
                  var questionAnsArr = question2.match(/#BLANK#/g);
                  if(questionAnsArr==null)
                  {
                    $('#err_question2').html('#BLANK# is missing');
                    flag = 1;    
                  }
                  else
                  {
                    var questionAnsCount = questionAnsArr.length;  
                    if(parseInt(questionAnsCount)!=1)
                    {
                      $('#err_question2').html('Only one #BLANK# is allowed');
                      flag = 1;       
                    }
                  }
               }
               if($.trim(answer2)=='')
               {
                  $('#err_answer2').html('This field is required.');
                  flag = 1;
               }

               if(flHorn == '')
               {
                   $('#err_flHorn').html('This field is required.');
                   flag = 1;
               }
               else if(!(flHornExt == "mp3" || flHornExt == "MP3" || flHornExt == "wave" || flHornExt == "m4a"))
               {
                   $('#err_flHorn').html('Invalid file type.');
                   flag = 1;
               }

               if($.trim(duration)=='' || parseInt(duration)==0)
               {
                  $('#err_duration').html('This field is required.');
                  flag = 1;
               }
               else if(isNaN(duration))
               {
                  $('#err_duration').html('Invalid time.');
                  flag = 1;
               }
           }

           else if(parseInt(hiddenTemplate)==9)
           {
               var direction = $('#direction').val();
               var question = $('#question').val();
               var option1 = $('#option1').val();
               var option2 = $('#option2').val();
               var option3 = $('#option3').val();
               var option4 = $('#option4').val();
               var rdoOption = $('input[name="rdoOption"]:checked').val();
               var flHorn   = $('#flHorn').val();
               var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);
               var duration = $('#duration').val();

               $('#err_direction').html('');
               $('#err_question').html('');
               $('#err_option1').html('');
               $('#err_option2').html('');
               $('#err_option3').html('');
               $('#err_option4').html('');
               $('#err_rdoOption').html('');
               $('#err_flHorn').html('');
               $('#err_duration').html('');

               if($.trim(direction)=='')
               {
                  $('#err_direction').html('This field is required.');
                  flag = 1;
               }

               if($.trim(question)=='')
               {
                  $('#err_question').html('This field is required.');
                  flag = 1;
               }
               else
               {
                  var questionAnsArr = question.match(/#BLANK#/g);
                  if(questionAnsArr==null)
                  {
                    $('#err_question').html('#BLANK# is missing');
                    flag = 1;    
                  }
                  else
                  {
                    var questionAnsCount = questionAnsArr.length;  
                    if(parseInt(questionAnsCount)!=1)
                    {
                      $('#err_question').html('Only one #BLANK# is allowed');
                      flag = 1;       
                    }
                  }
               }

               if($.trim(option1)=='')
               {
                  $('#err_option1').html('This field is required.');
                  flag = 1;
               }

               if($.trim(option2)=='')
               {
                  $('#err_option2').html('This field is required.');
                  flag = 1;
               }

               if($.trim(option3)=='')
               {
                  $('#err_option3').html('This field is required.');
                  flag = 1;
               }

               if($.trim(option4)=='')
               {
                  $('#err_option4').html('This field is required.');
                  flag = 1;
               }

               if(rdoOption==null)
               {
                   $('#err_rdoOption').html('Check one option as answer');
                   flag = 1;
               }

               if(flHorn == '')
               {
                   $('#err_flHorn').html('This field is required.');
                   flag = 1;
               }
               else if(!(flHornExt == "mp3" || flHornExt == "MP3" || flHornExt == "wave" || flHornExt == "m4a"))
               {
                   $('#err_flHorn').html('Invalid file type.');
                   flag = 1;
               }

               if($.trim(duration)=='' || parseInt(duration)==0)
               {
                  $('#err_duration').html('This field is required.');
                  flag = 1;
               }
               else if(isNaN(duration))
               {
                  $('#err_duration').html('Invalid time.');
                  flag = 1;
               }

           }

           else if(parseInt(hiddenTemplate)==10)
           {
               var direction = $('#direction').val();
               var flQuestion = $('#flQuestion').val();
               var flQuestionExt = flQuestion.substring(flQuestion.lastIndexOf('.')+1);
               var question = $('#question').val();
               var option1 = $('#option1').val();
               var option2 = $('#option2').val();
               var rdoOption = $('input[name="rdoOption"]:checked').val();
               var flHorn   = $('#flHorn').val();
               var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);
               var duration = $('#duration').val();

               $('#err_direction').html('');
               $('#err_flQuestion').html('');
               $('#err_question').html('');
               $('#err_option1').html('');
               $('#err_option2').html('');
               $('#err_rdoOption').html('');
               $('#err_flHorn').html('');
               $('#err_duration').html('');

               if($.trim(direction)=='')
               {
                  $('#err_direction').html('This field is required.');
                  flag = 1;
               }

               if(flQuestion == '')
               {
                   $('#err_flQuestion').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestionExt == "jpg" || flQuestionExt == "jpeg" || flQuestionExt == "gif" || flQuestionExt == "png" || flQuestionExt == "GIF" || flQuestionExt == "JPG" || flQuestionExt == "JPEG" || flQuestionExt == "PNG"))
               {
                   $('#err_flQuestion').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion').attr('data-error')=='yes')
               {
                  $('#err_flQuestion').html('File must be grater than / equal to 570 X 442.');
                  flag=1;  
               }

               if($.trim(question)=='')
               {
                  $('#err_question').html('This field is required.');
                  flag = 1;
               }
               else
               {
                  var questionAnsArr = question.match(/#BLANK#/g);
                  if(questionAnsArr==null)
                  {
                    $('#err_question').html('#BLANK# is missing');
                    flag = 1;    
                  }
                  else
                  {
                    var questionAnsCount = questionAnsArr.length;  
                    if(parseInt(questionAnsCount)!=1)
                    {
                      $('#err_question').html('Only one #BLANK# is allowed');
                      flag = 1;       
                    }
                  }
               }

               if($.trim(option1)=='')
               {
                   $('#err_option1').html('This field is required.');
                   flag = 1;
               }

               if($.trim(option2)=='')
               {
                   $('#err_option2').html('This field is required.');
                   flag = 1;
               }

               if(rdoOption==null)
               {
                   $('#err_rdoOption').html('Check one option as answer');
                   flag = 1;
               }
               
               if(flHorn == '')
               {
                   $('#err_flHorn').html('This field is required.');
                   flag = 1;
               }
               else if(!(flHornExt == "mp3" || flHornExt == "MP3" || flHornExt == "wave" || flHornExt == "m4a"))
               {
                   $('#err_flHorn').html('Invalid file type.');
                   flag = 1;
               }

               if($.trim(duration)=='' || parseInt(duration)==0)
               {
                  $('#err_duration').html('This field is required.');
                  flag = 1;
               }
               else if(isNaN(duration))
               {
                  $('#err_duration').html('Invalid time.');
                  flag = 1;
               }
           }

           else if(parseInt(hiddenTemplate)==11)
           {
               var direction = $('#direction').val();
               var flQuestion1 = $('#flQuestion1').val();
               var flQuestion1Ext = flQuestion1.substring(flQuestion1.lastIndexOf('.')+1);
               var answer1 = $('#answer1').val();
               var flQuestion2 = $('#flQuestion2').val();
               var flQuestion2Ext = flQuestion2.substring(flQuestion2.lastIndexOf('.')+1);
               var answer2 = $('#answer2').val();
               var flQuestion3 = $('#flQuestion3').val();
               var flQuestion3Ext = flQuestion3.substring(flQuestion3.lastIndexOf('.')+1);
               var answer3 = $('#answer3').val();
               var flQuestion4 = $('#flQuestion4').val();
               var flQuestion4Ext = flQuestion4.substring(flQuestion4.lastIndexOf('.')+1);
               var answer4 = $('#answer4').val();
               /*var flHorn   = $('#flHorn').val();
               var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);*/
               var duration = $('#duration').val();

               $('#err_direction').html('');
               $('#err_flQuestion1').html('');
               $('#err_answer1').html('');
               $('#err_flQuestion2').html('');
               $('#err_answer2').html('');
               $('#err_flQuestion3').html('');
               $('#err_answer3').html('');
               $('#err_flQuestion4').html('');
               $('#err_answer4').html('');
               /*$('#err_flHorn').html('');*/
               $('#err_duration').html('');

               if($.trim(direction)=='')
               {
                  $('#err_direction').html('This field is required.');
                  flag = 1;
               }

               if(flQuestion1 == '')
               {
                   $('#err_flQuestion1').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion1Ext == "jpg" || flQuestion1Ext == "jpeg" || flQuestion1Ext == "gif" || flQuestion1Ext == "png" || flQuestion1Ext == "GIF" || flQuestion1Ext == "JPG" || flQuestion1Ext == "JPEG" || flQuestion1Ext == "PNG"))
               {
                   $('#err_flQuestion1').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion1').attr('data-error')=='yes')
               {
                  $('#err_flQuestion1').html('File must be grater than / equal to 270 X 270.');
                  flag=1;  
               }
               if($.trim(answer1)=='')
               {
                  $('#err_answer1').html('This field is required.');
                  flag = 1;
               }


               if(flQuestion2 == '')
               {
                   $('#err_flQuestion2').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion2Ext == "jpg" || flQuestion2Ext == "jpeg" || flQuestion2Ext == "gif" || flQuestion2Ext == "png" || flQuestion2Ext == "GIF" || flQuestion2Ext == "JPG" || flQuestion2Ext == "JPEG" || flQuestion2Ext == "PNG"))
               {
                   $('#err_flQuestion2').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion2').attr('data-error')=='yes')
               {
                  $('#err_flQuestion2').html('File must be grater than / equal to 270 X 270.');
                  flag=1;  
               }
               if($.trim(answer2)=='')
               {
                  $('#err_answer2').html('This field is required.');
                  flag = 1;
               }

               if(flQuestion3 == '')
               {
                   $('#err_flQuestion3').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion3Ext == "jpg" || flQuestion3Ext == "jpeg" || flQuestion3Ext == "gif" || flQuestion3Ext == "png" || flQuestion3Ext == "GIF" || flQuestion3Ext == "JPG" || flQuestion3Ext == "JPEG" || flQuestion3Ext == "PNG"))
               {
                   $('#err_flQuestion3').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion3').attr('data-error')=='yes')
               {
                  $('#err_flQuestion3').html('File must be grater than / equal to 270 X 270.');
                  flag=1;  
               }
               if($.trim(answer3)=='')
               {
                  $('#err_answer3').html('This field is required.');
                  flag = 1;
               }

               if(flQuestion4 == '')
               {
                   $('#err_flQuestion4').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion4Ext == "jpg" || flQuestion4Ext == "jpeg" || flQuestion4Ext == "gif" || flQuestion4Ext == "png" || flQuestion4Ext == "GIF" || flQuestion4Ext == "JPG" || flQuestion4Ext == "JPEG" || flQuestion4Ext == "PNG"))
               {
                   $('#err_flQuestion4').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion4').attr('data-error')=='yes')
               {
                  $('#err_flQuestion4').html('File must be grater than / equal to 270 X 270.');
                  flag=1;  
               }
               if($.trim(answer4)=='')
               {
                  $('#err_answer4').html('This field is required.');
                  flag = 1;
               }

               /*if(flHorn == '')
               {
                   $('#err_flHorn').html('This field is required.');
                   flag = 1;
               }
               else if(!(flHornExt == "mp3" || flHornExt == "MP3" || flHornExt == "wave" || flHornExt == "m4a"))
               {
                   $('#err_flHorn').html('Invalid file type.');
                   flag = 1;
               }*/

               if($.trim(duration)=='' || parseInt(duration)==0)
               {
                  $('#err_duration').html('This field is required.');
                  flag = 1;
               }
               else if(isNaN(duration))
               {
                  $('#err_duration').html('Invalid time.');
                  flag = 1;
               }

           }

           else if(parseInt(hiddenTemplate)==12)
           {
               var direction = $('#direction').val();
               var flQuestion1 = $('#flQuestion1').val();
               var flQuestion1Ext = flQuestion1.substring(flQuestion1.lastIndexOf('.')+1);
               var flQuestion2 = $('#flQuestion2').val();
               var flQuestion2Ext = flQuestion2.substring(flQuestion2.lastIndexOf('.')+1);
               var answer2 = $('#answer2').val();
               var answer1 = $('#answer1').val();
               var flHorn   = $('#flHorn').val();
               var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);
               var duration = $('#duration').val();

               $('#err_direction').html('');
               $('#err_flQuestion1').html('');
               $('#err_flQuestion2').html('');
               $('#err_answer1').html('');
               $('#err_answer2').html('');
               $('#err_flHorn').html('');
               $('#err_duration').html('');

               if($.trim(direction)=='')
               {
                  $('#err_direction').html('This field is required.');
                  flag = 1;
               }

               if(flQuestion1 == '')
               {
                   $('#err_flQuestion1').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion1Ext == "jpg" || flQuestion1Ext == "jpeg" || flQuestion1Ext == "gif" || flQuestion1Ext == "png" || flQuestion1Ext == "GIF" || flQuestion1Ext == "JPG" || flQuestion1Ext == "JPEG" || flQuestion1Ext == "PNG"))
               {
                   $('#err_flQuestion1').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion1').attr('data-error')=='yes')
               {
                  $('#err_flQuestion1').html('File must be grater than / equal to 570 X 442.');
                  flag=1;  
               }
               if($.trim(answer1)=='')
               {
                  $('#err_answer1').html('This field is required.');
                  flag = 1;
               }

               if(flQuestion2 == '')
               {
                   $('#err_flQuestion2').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion2Ext == "jpg" || flQuestion2Ext == "jpeg" || flQuestion2Ext == "gif" || flQuestion2Ext == "png" || flQuestion2Ext == "GIF" || flQuestion2Ext == "JPG" || flQuestion2Ext == "JPEG" || flQuestion2Ext == "PNG"))
               {
                   $('#err_flQuestion2').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion2').attr('data-error')=='yes')
               {
                  $('#err_flQuestion2').html('File must be grater than / equal to 570 X 442.');
                  flag=1;  
               }
               if($.trim(answer2)=='')
               {
                  $('#err_answer2').html('This field is required.');
                  flag = 1;
               }

               if(flHorn == '')
               {
                   $('#err_flHorn').html('This field is required.');
                   flag = 1;
               }
               else if(!(flHornExt == "mp3" || flHornExt == "MP3" || flHornExt == "wave" || flHornExt == "m4a"))
               {
                   $('#err_flHorn').html('Invalid file type.');
                   flag = 1;
               }
               if($.trim(duration)=='' || parseInt(duration)==0)
               {
                  $('#err_duration').html('This field is required.');
                  flag = 1;
               }
               else if(isNaN(duration))
               {
                  $('#err_duration').html('Invalid time.');
                  flag = 1;
               }
           }

           else if(parseInt(hiddenTemplate)==13)
           {
               var direction = $('#direction').val();
               var flQuestion1 = $('#flQuestion1').val();
               var flQuestion1Ext = flQuestion1.substring(flQuestion1.lastIndexOf('.')+1);
               var answer1 = $('#answer1').val();
               var flQuestion2 = $('#flQuestion2').val();
               var flQuestion2Ext = flQuestion2.substring(flQuestion2.lastIndexOf('.')+1);
               var answer2 = $('#answer2').val();
               var flQuestion3 = $('#flQuestion3').val();
               var flQuestion3Ext = flQuestion3.substring(flQuestion3.lastIndexOf('.')+1);
               var answer3 = $('#answer3').val();
               var flQuestion4 = $('#flQuestion4').val();
               var flQuestion4Ext = flQuestion4.substring(flQuestion4.lastIndexOf('.')+1);
               var answer4 = $('#answer4').val();
               var flQuestion5 = $('#flQuestion5').val();
               var flQuestion5Ext = flQuestion5.substring(flQuestion5.lastIndexOf('.')+1);
               var answer5 = $('#answer5').val();
               var flQuestion6 = $('#flQuestion6').val();
               var flQuestion6Ext = flQuestion6.substring(flQuestion6.lastIndexOf('.')+1);
               var answer6 = $('#answer6').val();
               var flHorn   = $('#flHorn').val();
               var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);
               var duration = $('#duration').val();

               $('#err_direction').html('');
               $('#err_flQuestion1').html('');
               $('#err_answer1').html('');
               $('#err_flQuestion2').html('');
               $('#err_answer2').html('');
               $('#err_flQuestion3').html('');
               $('#err_answer3').html('');
               $('#err_flQuestion4').html('');
               $('#err_answer4').html('');
               $('#err_flQuestion5').html('');
               $('#err_answer5').html('');
               $('#err_flQuestion6').html('');
               $('#err_answer6').html('');
               $('#err_flHorn').html('');
               $('#err_duration').html('');

               if($.trim(direction)=='')
               {
                  $('#err_direction').html('This field is required.');
                  flag = 1;
               }

               if(flQuestion1 == '')
               {
                   $('#err_flQuestion1').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion1Ext == "jpg" || flQuestion1Ext == "jpeg" || flQuestion1Ext == "gif" || flQuestion1Ext == "png" || flQuestion1Ext == "GIF" || flQuestion1Ext == "JPG" || flQuestion1Ext == "JPEG" || flQuestion1Ext == "PNG"))
               {
                   $('#err_flQuestion1').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion1').attr('data-error')=='yes')
               {
                  $('#err_flQuestion1').html('File must be grater than / equal to 165 X 165.');
                  flag=1;  
               }
               if($.trim(answer1)=='')
               {
                  $('#err_answer1').html('This field is required.');
                  flag = 1;
               }


               if(flQuestion2 == '')
               {
                   $('#err_flQuestion2').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion2Ext == "jpg" || flQuestion2Ext == "jpeg" || flQuestion2Ext == "gif" || flQuestion2Ext == "png" || flQuestion2Ext == "GIF" || flQuestion2Ext == "JPG" || flQuestion2Ext == "JPEG" || flQuestion2Ext == "PNG"))
               {
                   $('#err_flQuestion2').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion2').attr('data-error')=='yes')
               {
                  $('#err_flQuestion2').html('File must be grater than / equal to 165 X 165.');
                  flag=1;  
               }
               if($.trim(answer2)=='')
               {
                  $('#err_answer2').html('This field is required.');
                  flag = 1;
               }

               if(flQuestion3 == '')
               {
                   $('#err_flQuestion3').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion3Ext == "jpg" || flQuestion3Ext == "jpeg" || flQuestion3Ext == "gif" || flQuestion3Ext == "png" || flQuestion3Ext == "GIF" || flQuestion3Ext == "JPG" || flQuestion3Ext == "JPEG" || flQuestion3Ext == "PNG"))
               {
                   $('#err_flQuestion3').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion3').attr('data-error')=='yes')
               {
                  $('#err_flQuestion3').html('File must be grater than / equal to 165 X 165.');
                  flag=1;  
               }
               if($.trim(answer3)=='')
               {
                  $('#err_answer3').html('This field is required.');
                  flag = 1;
               }

               if(flQuestion4 == '')
               {
                   $('#err_flQuestion4').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion4Ext == "jpg" || flQuestion4Ext == "jpeg" || flQuestion4Ext == "gif" || flQuestion4Ext == "png" || flQuestion4Ext == "GIF" || flQuestion4Ext == "JPG" || flQuestion4Ext == "JPEG" || flQuestion4Ext == "PNG"))
               {
                   $('#err_flQuestion4').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion4').attr('data-error')=='yes')
               {
                  $('#err_flQuestion4').html('File must be grater than / equal to 165 X 165.');
                  flag=1;  
               }
               if($.trim(answer4)=='')
               {
                  $('#err_answer4').html('This field is required.');
                  flag = 1;
               }

               if(flQuestion5 == '')
               {
                   $('#err_flQuestion5').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion5Ext == "jpg" || flQuestion5Ext == "jpeg" || flQuestion5Ext == "gif" || flQuestion5Ext == "png" || flQuestion5Ext == "GIF" || flQuestion5Ext == "JPG" || flQuestion5Ext == "JPEG" || flQuestion5Ext == "PNG"))
               {
                   $('#err_flQuestion5').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion5').attr('data-error')=='yes')
               {
                  $('#err_flQuestion5').html('File must be grater than / equal to 165 X 165.');
                  flag=1;  
               }
               if($.trim(answer5)=='')
               {
                  $('#err_answer5').html('This field is required.');
                  flag = 1;
               }

               if(flQuestion6 == '')
               {
                   $('#err_flQuestion6').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion6Ext == "jpg" || flQuestion6Ext == "jpeg" || flQuestion6Ext == "gif" || flQuestion6Ext == "png" || flQuestion6Ext == "GIF" || flQuestion6Ext == "JPG" || flQuestion6Ext == "JPEG" || flQuestion6Ext == "PNG"))
               {
                   $('#err_flQuestion6').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion6').attr('data-error')=='yes')
               {
                  $('#err_flQuestion6').html('File must be grater than / equal to 165 X 165.');
                  flag=1;  
               }
               if($.trim(answer6)=='')
               {
                  $('#err_answer6').html('This field is required.');
                  flag = 1;
               }

               if(flHorn == '')
               {
                   $('#err_flHorn').html('This field is required.');
                   flag = 1;
               }
               else if(!(flHornExt == "mp3" || flHornExt == "MP3" || flHornExt == "wave" || flHornExt == "m4a"))
               {
                   $('#err_flHorn').html('Invalid file type.');
                   flag = 1;
               }

               if($.trim(duration)=='' || parseInt(duration)==0)
               {
                  $('#err_duration').html('This field is required.');
                  flag = 1;
               }
               else if(isNaN(duration))
               {
                  $('#err_duration').html('Invalid time.');
                  flag = 1;
               }

           }

           else if(parseInt(hiddenTemplate)==14)
           {
               var direction = $('#direction').val();
               var flQuestion1 = $('#flQuestion1').val();
               var flQuestion1Ext = flQuestion1.substring(flQuestion1.lastIndexOf('.')+1);
               var answer1 = $('#answer1').val();
               var flQuestion2 = $('#flQuestion2').val();
               var flQuestion2Ext = flQuestion2.substring(flQuestion2.lastIndexOf('.')+1);
               var answer2 = $('#answer2').val();
               var flQuestion3 = $('#flQuestion3').val();
               var flQuestion3Ext = flQuestion3.substring(flQuestion3.lastIndexOf('.')+1);
               var answer3 = $('#answer3').val();
               var flQuestion4 = $('#flQuestion4').val();
               var flQuestion4Ext = flQuestion4.substring(flQuestion4.lastIndexOf('.')+1);
               var answer4 = $('#answer4').val();
               var flQuestion5 = $('#flQuestion5').val();
               var flQuestion5Ext = flQuestion5.substring(flQuestion5.lastIndexOf('.')+1);
               var answer5 = $('#answer5').val();
               var flQuestion6 = $('#flQuestion6').val();
               var flQuestion6Ext = flQuestion6.substring(flQuestion6.lastIndexOf('.')+1);
               var answer6 = $('#answer6').val();
               var flHorn   = $('#flHorn').val();
               var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);
               var duration = $('#duration').val();

               $('#err_direction').html('');
               $('#err_flQuestion1').html('');
               $('#err_answer1').html('');
               $('#err_flQuestion2').html('');
               $('#err_answer2').html('');
               $('#err_flQuestion3').html('');
               $('#err_answer3').html('');
               $('#err_flQuestion4').html('');
               $('#err_answer4').html('');
               $('#err_flQuestion5').html('');
               $('#err_answer5').html('');
               $('#err_flQuestion6').html('');
               $('#err_answer6').html('');
               $('#err_flHorn').html('');
               $('#err_duration').html('');

               if($.trim(direction)=='')
               {
                  $('#err_direction').html('This field is required.');
                  flag = 1;
               }

               if(flQuestion1 == '')
               {
                   $('#err_flQuestion1').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion1Ext == "jpg" || flQuestion1Ext == "jpeg" || flQuestion1Ext == "gif" || flQuestion1Ext == "png" || flQuestion1Ext == "GIF" || flQuestion1Ext == "JPG" || flQuestion1Ext == "JPEG" || flQuestion1Ext == "PNG"))
               {
                   $('#err_flQuestion1').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion1').attr('data-error')=='yes')
               {
                  $('#err_flQuestion1').html('File must be grater than / equal to 200 X 138.');
                  flag=1;  
               }
               if($.trim(answer1)=='')
               {
                  $('#err_answer1').html('This field is required.');
                  flag = 1;
               }


               if(flQuestion2 == '')
               {
                   $('#err_flQuestion2').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion2Ext == "jpg" || flQuestion2Ext == "jpeg" || flQuestion2Ext == "gif" || flQuestion2Ext == "png" || flQuestion2Ext == "GIF" || flQuestion2Ext == "JPG" || flQuestion2Ext == "JPEG" || flQuestion2Ext == "PNG"))
               {
                   $('#err_flQuestion2').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion2').attr('data-error')=='yes')
               {
                  $('#err_flQuestion2').html('File must be grater than / equal to 200 X 138.');
                  flag=1;  
               }
               if($.trim(answer2)=='')
               {
                  $('#err_answer2').html('This field is required.');
                  flag = 1;
               }

               if(flQuestion3 == '')
               {
                   $('#err_flQuestion3').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion3Ext == "jpg" || flQuestion3Ext == "jpeg" || flQuestion3Ext == "gif" || flQuestion3Ext == "png" || flQuestion3Ext == "GIF" || flQuestion3Ext == "JPG" || flQuestion3Ext == "JPEG" || flQuestion3Ext == "PNG"))
               {
                   $('#err_flQuestion3').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion3').attr('data-error')=='yes')
               {
                  $('#err_flQuestion3').html('File must be grater than / equal to 200 X 138.');
                  flag=1;  
               }
               if($.trim(answer3)=='')
               {
                  $('#err_answer3').html('This field is required.');
                  flag = 1;
               }

               if(flQuestion4 == '')
               {
                   $('#err_flQuestion4').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion4Ext == "jpg" || flQuestion4Ext == "jpeg" || flQuestion4Ext == "gif" || flQuestion4Ext == "png" || flQuestion4Ext == "GIF" || flQuestion4Ext == "JPG" || flQuestion4Ext == "JPEG" || flQuestion4Ext == "PNG"))
               {
                   $('#err_flQuestion4').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion4').attr('data-error')=='yes')
               {
                  $('#err_flQuestion4').html('File must be grater than / equal to 200 X 138.');
                  flag=1;  
               }
               if($.trim(answer4)=='')
               {
                  $('#err_answer4').html('This field is required.');
                  flag = 1;
               }

               if(flQuestion5 == '')
               {
                   $('#err_flQuestion5').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion5Ext == "jpg" || flQuestion5Ext == "jpeg" || flQuestion5Ext == "gif" || flQuestion5Ext == "png" || flQuestion5Ext == "GIF" || flQuestion5Ext == "JPG" || flQuestion5Ext == "JPEG" || flQuestion5Ext == "PNG"))
               {
                   $('#err_flQuestion5').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion5').attr('data-error')=='yes')
               {
                  $('#err_flQuestion5').html('File must be grater than / equal to 200 X 138.');
                  flag=1;  
               }
               if($.trim(answer5)=='')
               {
                  $('#err_answer5').html('This field is required.');
                  flag = 1;
               }

               if(flQuestion6 == '')
               {
                   $('#err_flQuestion6').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion6Ext == "jpg" || flQuestion6Ext == "jpeg" || flQuestion6Ext == "gif" || flQuestion6Ext == "png" || flQuestion6Ext == "GIF" || flQuestion6Ext == "JPG" || flQuestion6Ext == "JPEG" || flQuestion6Ext == "PNG"))
               {
                   $('#err_flQuestion6').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion6').attr('data-error')=='yes')
               {
                  $('#err_flQuestion6').html('File must be grater than / equal to 200 X 138.');
                  flag=1;  
               }
               if($.trim(answer6)=='')
               {
                  $('#err_answer6').html('This field is required.');
                  flag = 1;
               }

               if(flHorn == '')
               {
                   $('#err_flHorn').html('This field is required.');
                   flag = 1;
               }
               else if(!(flHornExt == "mp3" || flHornExt == "MP3" || flHornExt == "wave" || flHornExt == "m4a"))
               {
                   $('#err_flHorn').html('Invalid file type.');
                   flag = 1;
               }

               if($.trim(duration)=='' || parseInt(duration)==0)
               {
                  $('#err_duration').html('This field is required.');
                  flag = 1;
               }
               else if(isNaN(duration))
               {
                  $('#err_duration').html('Invalid time.');
                  flag = 1;
               }

           }

           else if(parseInt(hiddenTemplate)==15)
           {
              var direction = $('#direction').val();  
              var flQuestion1 = $('#flQuestion1').val();
              var flQuestion1Ext = flQuestion1.substring(flQuestion1.lastIndexOf('.')+1);
              var question1 = $('#question1').val();
              var rdoQuestion1 = $('input[name="rdoQuestion1"]:checked').val();
              var flQuestion2 = $('#flQuestion2').val();
              var flQuestion2Ext = flQuestion2.substring(flQuestion2.lastIndexOf('.')+1);
              var question2 = $('#question2').val();
              var rdoQuestion2 = $('input[name="rdoQuestion2"]:checked').val();
              var flHorn   = $('#flHorn').val();
              var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);
              var duration = $('#duration').val();

              $('#err_direction').html('');
              $('#err_flQuestion1').html('');
              $('#err_question1').html('');
              $('#err_rdoQuestion1').html('');
              $('#err_flQuestion2').html('');
              $('#err_question2').html('');
              $('#err_rdoQuestion2').html('');
              $('#err_flHorn').html('');
              $('#err_duration').html('');

              if($.trim(direction)=='')
               {
                  $('#err_direction').html('This field is required.');
                  flag = 1;
               }

               if(flQuestion1 == '')
               {
                   $('#err_flQuestion1').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion1Ext == "jpg" || flQuestion1Ext == "jpeg" || flQuestion1Ext == "gif" || flQuestion1Ext == "png" || flQuestion1Ext == "GIF" || flQuestion1Ext == "JPG" || flQuestion1Ext == "JPEG" || flQuestion1Ext == "PNG"))
               {
                   $('#err_flQuestion1').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion1').attr('data-error')=='yes')
               {
                  $('#err_flQuestion1').html('File must be grater than / equal to 570 X 442.');
                  flag=1;  
               }
               if($.trim(question1)=='')
               {
                  $('#err_question1').html('This field is required.');
                  flag = 1;
               }
               else
               {
                   if(rdoQuestion1==null)
                   {
                      $('#err_rdoQuestion1').html('This field is required.');
                      flag = 1;
                   }
               }

               if(flQuestion2 == '')
               {
                   $('#err_flQuestion2').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion2Ext == "jpg" || flQuestion2Ext == "jpeg" || flQuestion2Ext == "gif" || flQuestion2Ext == "png" || flQuestion2Ext == "GIF" || flQuestion2Ext == "JPG" || flQuestion2Ext == "JPEG" || flQuestion2Ext == "PNG"))
               {
                   $('#err_flQuestion2').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion2').attr('data-error')=='yes')
               {
                  $('#err_flQuestion2').html('File must be grater than / equal to 570 X 442.');
                  flag=1;  
               }
               if($.trim(question2)=='')
               {
                  $('#err_question2').html('This field is required.');
                  flag = 1;
               }
               else
               {
                   if(rdoQuestion2==null)
                   {
                      $('#err_rdoQuestion2').html('This field is required.');
                      flag = 1;
                   }
               }

               if(flHorn == '')
               {
                   $('#err_flHorn').html('This field is required.');
                   flag = 1;
               }
               else if(!(flHornExt == "mp3" || flHornExt == "MP3" || flHornExt == "wave" || flHornExt == "m4a"))
               {
                   $('#err_flHorn').html('Invalid file type.');
                   flag = 1;
               }

               if($.trim(duration)=='' || parseInt(duration)==0)
               {
                  $('#err_duration').html('This field is required.');
                  flag = 1;
               }
               else if(isNaN(duration))
               {
                  $('#err_duration').html('Invalid time.');
                  flag = 1;
               }

           }

           else if(parseInt(hiddenTemplate)==16)
           {
               var direction = $('#direction').val();
               var flQuestion1 = $('#flQuestion1').val();
               var flQuestion1Ext = flQuestion1.substring(flQuestion1.lastIndexOf('.')+1);
               var question1 = $('#question1').val();
               var answer1 = $('#answer1').val();
               var flQuestion2 = $('#flQuestion2').val();
               var flQuestion2Ext = flQuestion2.substring(flQuestion2.lastIndexOf('.')+1);
               var question2 = $('#question2').val();
               var answer2 = $('#answer2').val();
               var flHorn   = $('#flHorn').val();
               var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);
               var duration = $('#duration').val();

               $('#err_direction').html('');
               $('#err_flQuestion1').html('');
               $('#err_question1').html('');
               $('#err_answer1').html('');
               $('#err_flQuestion2').html('');
               $('#err_question2').html('');
               $('#err_answer2').html('');
               $('#err_flHorn').html('');
               $('#err_duration').html('');

               if($.trim(direction)=='')
               {
                  $('#err_direction').html('This field is required.');
                  flag = 1;
               }

               if(flQuestion1 == '')
               {
                   $('#err_flQuestion1').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion1Ext == "jpg" || flQuestion1Ext == "jpeg" || flQuestion1Ext == "gif" || flQuestion1Ext == "png" || flQuestion1Ext == "GIF" || flQuestion1Ext == "JPG" || flQuestion1Ext == "JPEG" || flQuestion1Ext == "PNG"))
               {
                   $('#err_flQuestion1').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion1').attr('data-error')=='yes')
               {
                  $('#err_flQuestion1').html('File must be grater than / equal to 570 X 442.');
                  flag=1;  
               }
               if($.trim(question1)=='')
               {
                  $('#err_question1').html('This field is required.');
                  flag = 1;
               }
               else
               {
                  var questionAnsArr = question1.match(/#BLANK#/g);
                  if(questionAnsArr==null)
                  {
                    $('#err_question1').html('#BLANK# is missing');
                    flag = 1;    
                  }
                  else
                  {
                    var questionAnsCount = questionAnsArr.length;  
                    if(parseInt(questionAnsCount)!=1)
                    {
                      $('#err_question1').html('Only one #BLANK# is allowed');
                      flag = 1;       
                    }
                  }
               }
               if($.trim(answer1)=='')
               {
                  $('#err_answer1').html('This field is required.');
                  flag = 1;
               }

               if(flQuestion2 == '')
               {
                   $('#err_flQuestion2').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion2Ext == "jpg" || flQuestion2Ext == "jpeg" || flQuestion2Ext == "gif" || flQuestion2Ext == "png" || flQuestion2Ext == "GIF" || flQuestion2Ext == "JPG" || flQuestion2Ext == "JPEG" || flQuestion2Ext == "PNG"))
               {
                   $('#err_flQuestion2').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion2').attr('data-error')=='yes')
               {
                  $('#err_flQuestion2').html('File must be grater than / equal to 570 X 442.');
                  flag=1;  
               }
               if($.trim(question2)=='')
               {
                  $('#err_question2').html('This field is required.');
                  flag = 1;
               }
               else
               {
                  var questionAnsArr = question2.match(/#BLANK#/g);
                  if(questionAnsArr==null)
                  {
                    $('#err_question2').html('#BLANK# is missing');
                    flag = 1;    
                  }
                  else
                  {
                    var questionAnsCount = questionAnsArr.length;  
                    if(parseInt(questionAnsCount)!=1)
                    {
                      $('#err_question2').html('Only one #BLANK# is allowed');
                      flag = 1;       
                    }
                  }
               }
               if($.trim(answer2)=='')
               {
                  $('#err_answer2').html('This field is required.');
                  flag = 1;
               }

               if(flHorn == '')
               {
                   $('#err_flHorn').html('This field is required.');
                   flag = 1;
               }
               else if(!(flHornExt == "mp3" || flHornExt == "MP3" || flHornExt == "wave" || flHornExt == "m4a"))
               {
                   $('#err_flHorn').html('Invalid file type.');
                   flag = 1;
               }

               if($.trim(duration)=='' || parseInt(duration)==0)
               {
                  $('#err_duration').html('This field is required.');
                  flag = 1;
               }
               else if(isNaN(duration))
               {
                  $('#err_duration').html('Invalid time.');
                  flag = 1;
               }
           }

           else if(parseInt(hiddenTemplate)==17)
           {
               var direction = $('#direction').val();
               var question1 = $('#question1').val();
               var option1_1 = $('#option1_1').val();
               var option1_2 = $('#option1_2').val();
               var option1_3 = $('#option1_3').val();
               var rdoOption1 = $('input[name="rdoOption1"]:checked').val();
               var question2 = $('#question2').val();
               var option2_1 = $('#option2_1').val();
               var option2_2 = $('#option2_2').val();
               var option2_3 = $('#option2_3').val();
               var rdoOption2 = $('input[name="rdoOption2"]:checked').val();
               var flHorn   = $('#flHorn').val();
               var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);
               var duration = $('#duration').val();

               $('#err_direction').html('');
               $('#err_question1').html('');
               $('#err_option1_1').html('');
               $('#err_option1_2').html('');
               $('#err_option1_3').html('');
               $('#err_rdoOption1').html('');
               $('#err_question2').html('');
               $('#err_option2_1').html('');
               $('#err_option2_2').html('');
               $('#err_option2_3').html('');
               $('#err_rdoOption2').html('');
               $('#err_flHorn').html('');
               $('#err_duration').html('');

               if($.trim(direction)=='')
               {
                  $('#err_direction').html('This field is required.');
                  flag = 1;
               }

               if($.trim(question1)=='')
               {
                  $('#err_question1').html('This field is required.');
                  flag = 1;
               }
               else
               {
                  var questionAnsArr = question1.match(/#BLANK#/g);
                  if(questionAnsArr==null)
                  {
                    $('#err_question1').html('#BLANK# is missing');
                    flag = 1;    
                  }
                  else
                  {
                    var questionAnsCount = questionAnsArr.length;  
                    if(parseInt(questionAnsCount)!=1)
                    {
                      $('#err_question1').html('Only one #BLANK# is allowed');
                      flag = 1;       
                    }
                  }
               }
               if($.trim(option1_1)=='')
               {
                  $('#err_option1_1').html('This field is required.');
                  flag = 1;
               }
               if($.trim(option1_2)=='')
               {
                  $('#err_option1_2').html('This field is required.');
                  flag = 1;
               }
               if($.trim(option1_3)=='')
               {
                  $('#err_option1_3').html('This field is required.');
                  flag = 1;
               }
               if(rdoOption1==null)
               {
                   $('#err_rdoOption1').html('Choose one option as answer');
                   flag = 1;
               }

               if($.trim(question2)=='')
               {
                  $('#err_question2').html('This field is required.');
                  flag = 1;
               }
               else
               {
                  var questionAnsArr = question2.match(/#BLANK#/g);
                  if(questionAnsArr==null)
                  {
                    $('#err_question2').html('#BLANK# is missing');
                    flag = 1;    
                  }
                  else
                  {
                    var questionAnsCount = questionAnsArr.length;  
                    if(parseInt(questionAnsCount)!=1)
                    {
                      $('#err_question2').html('Only one #BLANK# is allowed');
                      flag = 1;       
                    }
                  }
               }
               if($.trim(option2_1)=='')
               {
                  $('#err_option2_1').html('This field is required.');
                  flag = 1;
               }
               if($.trim(option2_2)=='')
               {
                  $('#err_option2_2').html('This field is required.');
                  flag = 1;
               }
               if($.trim(option2_3)=='')
               {
                  $('#err_option2_3').html('This field is required.');
                  flag = 1;
               }
               if(rdoOption2==null)
               {
                   $('#err_rdoOption2').html('Choose one option as answer');
                   flag = 1;
               }
               
               if(flHorn == '')
               {
                   $('#err_flHorn').html('This field is required.');
                   flag = 1;
               }
               else if(!(flHornExt == "mp3" || flHornExt == "MP3" || flHornExt == "wave" || flHornExt == "m4a"))
               {
                   $('#err_flHorn').html('Invalid file type.');
                   flag = 1;
               }

               if($.trim(duration)=='' || parseInt(duration)==0)
               {
                  $('#err_duration').html('This field is required.');
                  flag = 1;
               }
               else if(isNaN(duration))
               {
                  $('#err_duration').html('Invalid time.');
                  flag = 1;
               }
           }

           else if(parseInt(hiddenTemplate)==18)
           {
               var direction = $('#direction').val();

               var flQuestion1 = $('#flQuestion1').val();
               var flQuestion1Ext = flQuestion1.substring(flQuestion1.lastIndexOf('.') + 1);
               var question1 = $('#question1').val();

               var flQuestion2 = $('#flQuestion2').val();
               var flQuestion2Ext = flQuestion2.substring(flQuestion2.lastIndexOf('.') + 1);
               var question2 = $('#question2').val();

               var flQuestion3 = $('#flQuestion3').val();
               var flQuestion3Ext = flQuestion3.substring(flQuestion3.lastIndexOf('.') + 1);
               var question3 = $('#question3').val();

               var flQuestion4 = $('#flQuestion4').val();
               var flQuestion4Ext = flQuestion4.substring(flQuestion4.lastIndexOf('.') + 1);
               var question4 = $('#question4').val();

               var flQuestion5 = $('#flQuestion5').val();
               var flQuestion5Ext = flQuestion5.substring(flQuestion5.lastIndexOf('.') + 1);
               var question5 = $('#question5').val();

               var flQuestion6 = $('#flQuestion6').val();
               var flQuestion6Ext = flQuestion6.substring(flQuestion6.lastIndexOf('.') + 1);
               var question6 = $('#question6').val();

               var flHorn   = $('#flHorn').val();
               var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);
               var duration = $('#duration').val();
   
               $('#err_direction').html('');
               
               $('#err_flQuestion1').html('');
               $('#err_question1').html('');
               $('#err_chkBlankLetter1').html('');

               $('#err_flQuestion2').html('');
               $('#err_question2').html('');
               $('#err_chkBlankLetter2').html('');

               $('#err_flQuestion3').html('');
               $('#err_question3').html('');
               $('#err_chkBlankLetter3').html('');

               $('#err_flQuestion4').html('');
               $('#err_question4').html('');
               $('#err_chkBlankLetter4').html('');

               $('#err_flQuestion5').html('');
               $('#err_question5').html('');
               $('#err_chkBlankLetter5').html('');

               $('#err_flQuestion6').html('');
               $('#err_question6').html('');
               $('#err_chkBlankLetter6').html('');

               $('#err_flHorn').html('');
               $('#err_duration').html('');

               if($.trim(direction)=='')
               {
                  $('#err_direction').html('This field is required.');
                  flag = 1;  
               }

               if(flQuestion1 == '')
               {
                   $('#err_flQuestion1').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion1Ext == "jpg" || flQuestion1Ext == "jpeg" || flQuestion1Ext == "gif" || flQuestion1Ext == "png" || flQuestion1Ext == "GIF" || flQuestion1Ext == "JPG" || flQuestion1Ext == "JPEG" || flQuestion1Ext == "PNG"))
               {
                   $('#err_flQuestion1').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion1').attr('data-error')=='yes')
               {
                  $('#err_flQuestion1').html('File must be grater than / equal to 185 X 121.');
                  flag=1;  
               }
               if($.trim(question1)=='')
               {
                  $('#err_question1').html('This field is required.');
                  flag = 1;
               }
               else
               {
                  if($('input[name="chkBlankLetter1[]"]:checked').length == 0)
                  {
                    $('#err_chkBlankLetter1').html('Please checked atleast one checkbox');
                    flag = 1;
                  }
               }

               if(flQuestion2 == '')
               {
                   $('#err_flQuestion2').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion2Ext == "jpg" || flQuestion2Ext == "jpeg" || flQuestion2Ext == "gif" || flQuestion2Ext == "png" || flQuestion2Ext == "GIF" || flQuestion2Ext == "JPG" || flQuestion2Ext == "JPEG" || flQuestion2Ext == "PNG"))
               {
                   $('#err_flQuestion2').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion2').attr('data-error')=='yes')
               {
                  $('#err_flQuestion2').html('File must be grater than / equal to 185 X 121.');
                  flag=1;  
               }
               if($.trim(question2)=='')
               {
                  $('#err_question2').html('This field is required.');
                  flag = 1;
               }
               else
               {
                  if($('input[name="chkBlankLetter2[]"]:checked').length == 0)
                  {
                    $('#err_chkBlankLetter2').html('Please checked atleast one checkbox');
                    flag = 1;
                  }
               }

               if(flQuestion3 == '')
               {
                   $('#err_flQuestion3').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion3Ext == "jpg" || flQuestion3Ext == "jpeg" || flQuestion3Ext == "gif" || flQuestion3Ext == "png" || flQuestion3Ext == "GIF" || flQuestion3Ext == "JPG" || flQuestion3Ext == "JPEG" || flQuestion3Ext == "PNG"))
               {
                   $('#err_flQuestion3').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion3').attr('data-error')=='yes')
               {
                  $('#err_flQuestion3').html('File must be grater than / equal to 185 X 121.');
                  flag=1;  
               }
               if($.trim(question3)=='')
               {
                  $('#err_question3').html('This field is required.');
                  flag = 1;
               }
               else
               {
                  if($('input[name="chkBlankLetter3[]"]:checked').length == 0)
                  {
                    $('#err_chkBlankLetter3').html('Please checked atleast one checkbox');
                    flag = 1;
                  }
               }

               if(flQuestion4 == '')
               {
                   $('#err_flQuestion4').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion4Ext == "jpg" || flQuestion4Ext == "jpeg" || flQuestion4Ext == "gif" || flQuestion4Ext == "png" || flQuestion4Ext == "GIF" || flQuestion4Ext == "JPG" || flQuestion4Ext == "JPEG" || flQuestion4Ext == "PNG"))
               {
                   $('#err_flQuestion4').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion4').attr('data-error')=='yes')
               {
                  $('#err_flQuestion4').html('File must be grater than / equal to 185 X 121.');
                  flag=1;  
               }
               if($.trim(question4)=='')
               {
                  $('#err_question4').html('This field is required.');
                  flag = 1;
               }
               else
               {
                  if($('input[name="chkBlankLetter4[]"]:checked').length == 0)
                  {
                    $('#err_chkBlankLetter4').html('Please checked atleast one checkbox');
                    flag = 1;
                  }
               }

               if(flQuestion5 == '')
               {
                   $('#err_flQuestion5').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion5Ext == "jpg" || flQuestion5Ext == "jpeg" || flQuestion5Ext == "gif" || flQuestion5Ext == "png" || flQuestion5Ext == "GIF" || flQuestion5Ext == "JPG" || flQuestion5Ext == "JPEG" || flQuestion5Ext == "PNG"))
               {
                   $('#err_flQuestion5').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion5').attr('data-error')=='yes')
               {
                  $('#err_flQuestion5').html('File must be grater than / equal to 185 X 121.');
                  flag=1;  
               }
               if($.trim(question5)=='')
               {
                  $('#err_question5').html('This field is required.');
                  flag = 1;
               }
               else
               {
                  if($('input[name="chkBlankLetter5[]"]:checked').length == 0)
                  {
                    $('#err_chkBlankLetter5').html('Please checked atleast one checkbox');
                    flag = 1;
                  }
               }

               if(flQuestion6 == '')
               {
                   $('#err_flQuestion6').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion6Ext == "jpg" || flQuestion6Ext == "jpeg" || flQuestion6Ext == "gif" || flQuestion6Ext == "png" || flQuestion6Ext == "GIF" || flQuestion6Ext == "JPG" || flQuestion6Ext == "JPEG" || flQuestion6Ext == "PNG"))
               {
                   $('#err_flQuestion6').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion6').attr('data-error')=='yes')
               {
                  $('#err_flQuestion6').html('File must be grater than / equal to 185 X 121.');
                  flag=1;  
               }
               if($.trim(question6)=='')
               {
                  $('#err_question6').html('This field is required.');
                  flag = 1;
               }
               else
               {
                  if($('input[name="chkBlankLetter6[]"]:checked').length == 0)
                  {
                    $('#err_chkBlankLetter6').html('Please checked atleast one checkbox');
                    flag = 1;
                  }
               }

               if(flHorn == '')
               {
                   $('#err_flHorn').html('This field is required.');
                   flag = 1;
               }
               else if(!(flHornExt == "mp3" || flHornExt == "MP3" || flHornExt == "wave" || flHornExt == "m4a"))
               {
                   $('#err_flHorn').html('Invalid file type.');
                   flag = 1;
               }

               if($.trim(duration)=='' || parseInt(duration)==0)
               {
                  $('#err_duration').html('This field is required.');
                  flag = 1;
               }
               else if(isNaN(duration))
               {
                  $('#err_duration').html('Invalid time.');
                  flag = 1;
               }
           }

           else if(parseInt(hiddenTemplate)==19)
           {
               var direction = $('#direction').val();
               var flQuestion1 = $('#flQuestion1').val();
               var flQuestion1Ext = flQuestion1.substring(flQuestion1.lastIndexOf('.') + 1);
               var answer1 = $('#answer1').val();
               var flQuestion2 = $('#flQuestion2').val();
               var flQuestion2Ext = flQuestion2.substring(flQuestion2.lastIndexOf('.') + 1);
               var answer2 = $('#answer2').val();
               var flQuestion3 = $('#flQuestion3').val();
               var flQuestion3Ext = flQuestion3.substring(flQuestion3.lastIndexOf('.') + 1);
               var answer3 = $('#answer3').val();
               var flQuestion4 = $('#flQuestion4').val();
               var flQuestion4Ext = flQuestion4.substring(flQuestion4.lastIndexOf('.') + 1);
               var answer4 = $('#answer4').val();
               var flQuestion5 = $('#flQuestion5').val();
               var flQuestion5Ext = flQuestion5.substring(flQuestion5.lastIndexOf('.') + 1);
               var answer5 = $('#answer5').val();
               var flQuestion6 = $('#flQuestion6').val();
               var flQuestion6Ext = flQuestion6.substring(flQuestion6.lastIndexOf('.') + 1);
               var answer6 = $('#answer6').val();
               var flHorn   = $('#flHorn').val();
               var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);
               var duration = $('#duration').val();
   
               $('#err_direction').html('');
               $('#err_flQuestion1').html('');
               $('#err_answer1').html('');
               $('#err_flQuestion2').html('');
               $('#err_answer2').html('');
               $('#err_flQuestion3').html('');
               $('#err_answer3').html('');
               $('#err_flQuestion4').html('');
               $('#err_answer4').html('');
               $('#err_flQuestion5').html('');
               $('#err_answer5').html('');
               $('#err_flQuestion6').html('');
               $('#err_answer6').html('');
               $('#err_flHorn').html('');
               $('#err_duration').html('');

               if($.trim(direction)=='')
               {
                  $('#err_direction').html('This field is required.');
                  flag = 1;  
               }

               if(flQuestion1 == '')
               {
                   $('#err_flQuestion1').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion1Ext == "jpg" || flQuestion1Ext == "jpeg" || flQuestion1Ext == "gif" || flQuestion1Ext == "png" || flQuestion1Ext == "GIF" || flQuestion1Ext == "JPG" || flQuestion1Ext == "JPEG" || flQuestion1Ext == "PNG"))
               {
                   $('#err_flQuestion1').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion1').attr('data-error')=='yes')
               {
                  $('#err_flQuestion1').html('File must be grater than / equal to 185 X 121.');
                  flag=1;  
               }
               if($.trim(answer1)=='')
               {
                  $('#err_answer1').html('This field is required.');
                  flag = 1;
               }
               
               if(flQuestion2 == '')
               {
                   $('#err_flQuestion2').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion2Ext == "jpg" || flQuestion2Ext == "jpeg" || flQuestion2Ext == "gif" || flQuestion2Ext == "png" || flQuestion2Ext == "GIF" || flQuestion2Ext == "JPG" || flQuestion2Ext == "JPEG" || flQuestion2Ext == "PNG"))
               {
                   $('#err_flQuestion2').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion2').attr('data-error')=='yes')
               {
                  $('#err_flQuestion2').html('File must be grater than / equal to 185 X 121.');
                  flag=1;  
               }
               if($.trim(answer2)=='')
               {
                  $('#err_answer2').html('This field is required.');
                  flag = 1;
               }
               
               if(flQuestion3 == '')
               {
                   $('#err_flQuestion3').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion3Ext == "jpg" || flQuestion3Ext == "jpeg" || flQuestion3Ext == "gif" || flQuestion3Ext == "png" || flQuestion3Ext == "GIF" || flQuestion3Ext == "JPG" || flQuestion3Ext == "JPEG" || flQuestion3Ext == "PNG"))
               {
                   $('#err_flQuestion3').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion3').attr('data-error')=='yes')
               {
                  $('#err_flQuestion3').html('File must be grater than / equal to 185 X 121.');
                  flag=1;  
               }
               if($.trim(answer3)=='')
               {
                  $('#err_answer3').html('This field is required.');
                  flag = 1;
               }
               
               if(flQuestion4 == '')
               {
                   $('#err_flQuestion4').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion4Ext == "jpg" || flQuestion4Ext == "jpeg" || flQuestion4Ext == "gif" || flQuestion4Ext == "png" || flQuestion4Ext == "GIF" || flQuestion4Ext == "JPG" || flQuestion4Ext == "JPEG" || flQuestion4Ext == "PNG"))
               {
                   $('#err_flQuestion4').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion4').attr('data-error')=='yes')
               {
                  $('#err_flQuestion4').html('File must be grater than / equal to 185 X 121.');
                  flag=1;  
               }
               if($.trim(answer4)=='')
               {
                  $('#err_answer4').html('This field is required.');
                  flag = 1;
               }
               
               if(flQuestion5 == '')
               {
                   $('#err_flQuestion5').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion5Ext == "jpg" || flQuestion5Ext == "jpeg" || flQuestion5Ext == "gif" || flQuestion5Ext == "png" || flQuestion5Ext == "GIF" || flQuestion5Ext == "JPG" || flQuestion5Ext == "JPEG" || flQuestion5Ext == "PNG"))
               {
                   $('#err_flQuestion5').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion5').attr('data-error')=='yes')
               {
                  $('#err_flQuestion5').html('File must be grater than / equal to 185 X 121.');
                  flag=1;  
               }
               if($.trim(answer5)=='')
               {
                  $('#err_answer5').html('This field is required.');
                  flag = 1;
               }
               
               if(flQuestion6 == '')
               {
                   $('#err_flQuestion6').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion6Ext == "jpg" || flQuestion6Ext == "jpeg" || flQuestion6Ext == "gif" || flQuestion6Ext == "png" || flQuestion6Ext == "GIF" || flQuestion6Ext == "JPG" || flQuestion6Ext == "JPEG" || flQuestion6Ext == "PNG"))
               {
                   $('#err_flQuestion6').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion6').attr('data-error')=='yes')
               {
                  $('#err_flQuestion6').html('File must be grater than / equal to 185 X 121.');
                  flag=1;  
               }
               if($.trim(answer6)=='')
               {
                  $('#err_answer6').html('This field is required.');
                  flag = 1;
               }
               
               if(flHorn == '')
               {
                   $('#err_flHorn').html('This field is required.');
                   flag = 1;
               }
               else if(!(flHornExt == "mp3" || flHornExt == "MP3" || flHornExt == "wave" || flHornExt == "m4a"))
               {
                   $('#err_flHorn').html('Invalid file type.');
                   flag = 1;
               }

               if($.trim(duration)=='' || parseInt(duration)==0)
               {
                  $('#err_duration').html('This field is required.');
                  flag = 1;
               }
               else if(isNaN(duration))
               {
                  $('#err_duration').html('Invalid time.');
                  flag = 1;
               }
           }

           else if(parseInt(hiddenTemplate)==20)
           {
              var direction = $('#direction').val();
              var flQuestion1 = $('#flQuestion1').val();
              var flQuestion1Ext = flQuestion1.substring(flQuestion1.lastIndexOf('.') + 1);
              var option1_1 = $('#option1_1').val();
              var option1_2 = $('#option1_2').val();
              var option1_3 = $('#option1_3').val();
              var rdoOption1 = $('input[name="rdoOption1"]:checked').val();
              var flQuestion2 = $('#flQuestion2').val();
              var flQuestion2Ext = flQuestion2.substring(flQuestion2.lastIndexOf('.') + 1);
              var option2_1 = $('#option2_1').val();
              var option2_2 = $('#option2_2').val();
              var option2_3 = $('#option2_3').val();
              var rdoOption2 = $('input[name="rdoOption2"]:checked').val();
              var flHorn   = $('#flHorn').val();
              var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);
              var duration = $('#duration').val();

              $('#err_direction').html('');

              $('#err_flQuestion1').html('');
              $('#err_option1_1').html('');
              $('#err_option1_2').html('');
              $('#err_option1_3').html('');
              $('#err_rdoOption1').html('');
              $('#err_flQuestion2').html('');
              $('#err_option2_1').html('');
              $('#err_option2_2').html('');
              $('#err_option2_3').html('');
              $('#err_rdoOption2').html('');
              $('#err_flHorn').html('');
              $('#err_duration').html('');

               if($.trim(direction)=='')
               {
                  $('#err_direction').html('This field is required.');
                  flag = 1;  
               }

               if(flQuestion1 == '')
               {
                   $('#err_flQuestion1').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion1Ext == "jpg" || flQuestion1Ext == "jpeg" || flQuestion1Ext == "gif" || flQuestion1Ext == "png" || flQuestion1Ext == "GIF" || flQuestion1Ext == "JPG" || flQuestion1Ext == "JPEG" || flQuestion1Ext == "PNG"))
               {
                   $('#err_flQuestion1').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion1').attr('data-error')=='yes')
               {
                  $('#err_flQuestion1').html('File must be grater than / equal to 570 X 442.');
                  flag=1;  
               }
               if($.trim(option1_1)=='')
               {
                  $('#err_option1_1').html('This field is required.');
                  flag = 1;  
               }
               if($.trim(option1_2)=='')
               {
                  $('#err_option1_2').html('This field is required.');
                  flag = 1;  
               }
               if($.trim(option1_3)=='')
               {
                  $('#err_option1_3').html('This field is required.');
                  flag = 1;  
               }
               if(rdoOption1==null)
               {
                   $('#err_rdoOption1').html('Choose one option as answer');
                   flag = 1;
               }

               if(flQuestion2 == '')
               {
                   $('#err_flQuestion2').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion2Ext == "jpg" || flQuestion2Ext == "jpeg" || flQuestion2Ext == "gif" || flQuestion2Ext == "png" || flQuestion2Ext == "GIF" || flQuestion2Ext == "JPG" || flQuestion2Ext == "JPEG" || flQuestion2Ext == "PNG"))
               {
                   $('#err_flQuestion2').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion2').attr('data-error')=='yes')
               {
                  $('#err_flQuestion2').html('File must be grater than / equal to 570 X 442.');
                  flag=1;  
               }
               if($.trim(option2_1)=='')
               {
                  $('#err_option2_1').html('This field is required.');
                  flag = 1;  
               }
               if($.trim(option2_2)=='')
               {
                  $('#err_option2_2').html('This field is required.');
                  flag = 1;  
               }
               if($.trim(option2_3)=='')
               {
                  $('#err_option2_3').html('This field is required.');
                  flag = 1;  
               }
               if(rdoOption2==null)
               {
                   $('#err_rdoOption2').html('Choose one option as answer');
                   flag = 1;
               }

               if(flHorn == '')
               {
                   $('#err_flHorn').html('This field is required.');
                   flag = 1;
               }
               else if(!(flHornExt == "mp3" || flHornExt == "MP3" || flHornExt == "wave" || flHornExt == "m4a"))
               {
                   $('#err_flHorn').html('Invalid file type.');
                   flag = 1;
               }

               if($.trim(duration)=='' || parseInt(duration)==0)
               {
                  $('#err_duration').html('This field is required.');
                  flag = 1;
               }
               else if(isNaN(duration))
               {
                  $('#err_duration').html('Invalid time.');
                  flag = 1;
               }

           }

           else if(parseInt(hiddenTemplate)==21)
           {
              var direction = $('#direction').val();
              var question1 = $('#question1').val();
              var answer1 = $('#answer1').val();
              var question2 = $('#question2').val();
              var answer2 = $('#answer2').val();
              var question3 = $('#question3').val();
              var answer3 = $('#answer3').val();
              var question4 = $('#question4').val();
              var answer4 = $('#answer4').val();
              var question5 = $('#question5').val();
              var answer5 = $('#answer5').val();
              var question6 = $('#question6').val();
              var answer6 = $('#answer6').val();
              var flHorn   = $('#flHorn').val();
              var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);
              var duration = $('#duration').val();

              $('#err_direction').html('');
              $('#err_question1').html('');
              $('#err_answer1').html('');
              $('#err_question2').html('');
              $('#err_answer2').html('');
              $('#err_question3').html('');
              $('#err_answer3').html('');
              $('#err_question4').html('');
              $('#err_answer4').html('');
              $('#err_question5').html('');
              $('#err_answer5').html('');
              $('#err_question6').html('');
              $('#err_answer6').html('');
              $('#err_flHorn').html('');
              $('#err_duration').html('');

               if($.trim(direction)=='')
               {
                  $('#err_direction').html('This field is required.');
                  flag = 1;  
               }

               if($.trim(question1)=='')
               {
                  $('#err_question1').html('This field is required.');
                  flag = 1;  
               }
               if($.trim(answer1)=='')
               {
                  $('#err_answer1').html('This field is required.');
                  flag = 1;  
               }

               if($.trim(question2)=='')
               {
                  $('#err_question2').html('This field is required.');
                  flag = 1;  
               }
               if($.trim(answer2)=='')
               {
                  $('#err_answer2').html('This field is required.');
                  flag = 1;  
               }

               if($.trim(question3)=='')
               {
                  $('#err_question3').html('This field is required.');
                  flag = 1;  
               }
               if($.trim(answer3)=='')
               {
                  $('#err_answer3').html('This field is required.');
                  flag = 1;  
               }

               if($.trim(question4)=='')
               {
                  $('#err_question4').html('This field is required.');
                  flag = 1;  
               }
               if($.trim(answer4)=='')
               {
                  $('#err_answer4').html('This field is required.');
                  flag = 1;  
               }

               if($.trim(question5)=='')
               {
                  $('#err_question5').html('This field is required.');
                  flag = 1;  
               }
               if($.trim(answer5)=='')
               {
                  $('#err_answer5').html('This field is required.');
                  flag = 1;  
               }

               if($.trim(question6)=='')
               {
                  $('#err_question6').html('This field is required.');
                  flag = 1;  
               }
               if($.trim(answer6)=='')
               {
                  $('#err_answer6').html('This field is required.');
                  flag = 1;  
               }

               if(flHorn == '')
               {
                   $('#err_flHorn').html('This field is required.');
                   flag = 1;
               }
               else if(!(flHornExt == "mp3" || flHornExt == "MP3" || flHornExt == "wave" || flHornExt == "m4a"))
               {
                   $('#err_flHorn').html('Invalid file type.');
                   flag = 1;
               }

               if($.trim(duration)=='' || parseInt(duration)==0)
               {
                  $('#err_duration').html('This field is required.');
                  flag = 1;
               }
               else if(isNaN(duration))
               {
                  $('#err_duration').html('Invalid time.');
                  flag = 1;
               }

           }

           else if(parseInt(hiddenTemplate)==22)
           {
              var direction = $('#direction').val();
              var question1 = $('#question1').val();
              var answer1 = $('#answer1').val();
              var question2 = $('#question2').val();
              var answer2 = $('#answer2').val();
              var flHorn   = $('#flHorn').val();
              var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);
              var duration = $('#duration').val();

              $('#err_direction').html('');
              $('#err_question1').html('');
              $('#err_answer1').html('');
              $('#err_question2').html('');
              $('#err_answer2').html('');
              $('#err_flHorn').html('');
              $('#err_duration').html('');

               if($.trim(direction)=='')
               {
                  $('#err_direction').html('This field is required.');
                  flag = 1;  
               }

               if($.trim(question1)=='')
               {
                  $('#err_question1').html('This field is required.');
                  flag = 1;  
               }
               else
               {
                  var questionAnsArr = question1.match(/#BLANK#/g);
                  if(questionAnsArr==null)
                  {
                    $('#err_question1').html('#BLANK# is missing');
                    flag = 1;    
                  }
                  else
                  {
                    var questionAnsCount = questionAnsArr.length;  
                    if(parseInt(questionAnsCount)!=1)
                    {
                      $('#err_question1').html('Only one #BLANK# is allowed');
                      flag = 1;       
                    }
                  }
               }
               if($.trim(answer1)=='')
               {
                  $('#err_answer1').html('This field is required.');
                  flag = 1;  
               }

               if($.trim(question2)=='')
               {
                  $('#err_question2').html('This field is required.');
                  flag = 1;  
               }
               else
               {
                  var questionAnsArr = question2.match(/#BLANK#/g);
                  if(questionAnsArr==null)
                  {
                    $('#err_question2').html('#BLANK# is missing');
                    flag = 1;    
                  }
                  else
                  {
                    var questionAnsCount = questionAnsArr.length;  
                    if(parseInt(questionAnsCount)!=1)
                    {
                      $('#err_question2').html('Only one #BLANK# is allowed');
                      flag = 1;       
                    }
                  }
               }
               if($.trim(answer2)=='')
               {
                  $('#err_answer2').html('This field is required.');
                  flag = 1;  
               }

               if(flHorn == '')
               {
                   $('#err_flHorn').html('This field is required.');
                   flag = 1;
               }
               else if(!(flHornExt == "mp3" || flHornExt == "MP3" || flHornExt == "wave" || flHornExt == "m4a"))
               {
                   $('#err_flHorn').html('Invalid file type.');
                   flag = 1;
               }

               if($.trim(duration)=='' || parseInt(duration)==0)
               {
                  $('#err_duration').html('This field is required.');
                  flag = 1;
               }
               else if(isNaN(duration))
               {
                  $('#err_duration').html('Invalid time.');
                  flag = 1;
               }

           }

           else if(parseInt(hiddenTemplate)==23)
           {
              var direction = $('#direction').val();
              var question = $('#question').val();
              var flHorn   = $('#flHorn').val();
              var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);
              var duration = $('#duration').val();

              $('#err_direction').html('');
              $('#err_question').html('');
              $('#err_flHorn').html('');
              $('#err_duration').html('');

               if($.trim(direction)=='')
               {
                  $('#err_direction').html('This field is required.');
                  flag = 1;  
               }

               if($.trim(question)=='')
               {
                  $('#err_question').html('This field is required.');
                  flag = 1;  
               }
               
               if(flHorn == '')
               {
                   $('#err_flHorn').html('This field is required.');
                   flag = 1;
               }
               else if(!(flHornExt == "mp3" || flHornExt == "MP3" || flHornExt == "wave" || flHornExt == "m4a"))
               {
                   $('#err_flHorn').html('Invalid file type.');
                   flag = 1;
               }

               if($.trim(duration)=='' || parseInt(duration)==0)
               {
                  $('#err_duration').html('This field is required.');
                  flag = 1;
               }
               else if(isNaN(duration))
               {
                  $('#err_duration').html('Invalid time.');
                  flag = 1;
               }

           }

           else if(parseInt(hiddenTemplate)==24)
           {
              var direction = $('#direction').val();
              var question1 = $('#question1').val();
              var answer1 = $('#answer1').val();
              var question2 = $('#question2').val();
              var answer2 = $('#answer2').val();
              var question3 = $('#question3').val();
              var answer3 = $('#answer3').val();
              var question4 = $('#question4').val();
              var answer4 = $('#answer4').val();
              var question5 = $('#question5').val();
              var answer5 = $('#answer5').val();
              var question6 = $('#question6').val();
              var answer6 = $('#answer6').val();
              var question7 = $('#question7').val();
              var answer7 = $('#answer7').val();
              var question8 = $('#question8').val();
              var answer8 = $('#answer8').val();
              var flHorn   = $('#flHorn').val();
              var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);
              var duration = $('#duration').val();

              $('#err_direction').html('');
              $('#err_question1').html('');
              $('#err_answer1').html('');
              $('#err_question2').html('');
              $('#err_answer2').html('');
              $('#err_question3').html('');
              $('#err_answer3').html('');
              $('#err_question4').html('');
              $('#err_answer4').html('');
              $('#err_question5').html('');
              $('#err_answer5').html('');
              $('#err_question6').html('');
              $('#err_answer6').html('');
              $('#err_question7').html('');
              $('#err_answer7').html('');
              $('#err_question8').html('');
              $('#err_answer8').html('');
              $('#err_flHorn').html('');
              $('#err_duration').html('');

               if($.trim(direction)=='')
               {
                  $('#err_direction').html('This field is required.');
                  flag = 1;  
               }

               if($.trim(question1)=='')
               {
                  $('#err_question1').html('This field is required.');
                  flag = 1;  
               }
               if($.trim(answer1)=='')
               {
                  $('#err_answer1').html('This field is required.');
                  flag = 1;  
               }

               if($.trim(question2)=='')
               {
                  $('#err_question2').html('This field is required.');
                  flag = 1;  
               }
               if($.trim(answer2)=='')
               {
                  $('#err_answer2').html('This field is required.');
                  flag = 1;  
               }

               if($.trim(question3)=='')
               {
                  $('#err_question3').html('This field is required.');
                  flag = 1;  
               }
               if($.trim(answer3)=='')
               {
                  $('#err_answer3').html('This field is required.');
                  flag = 1;  
               }

               if($.trim(question4)=='')
               {
                  $('#err_question4').html('This field is required.');
                  flag = 1;  
               }
               if($.trim(answer4)=='')
               {
                  $('#err_answer4').html('This field is required.');
                  flag = 1;  
               }

               if($.trim(question5)!='' || $.trim(answer5)!='')
               {
                 if($.trim(question5)=='')
                 {
                    $('#err_question5').html('This field is required.');
                    flag = 1;
                 }
                 if($.trim(answer5)=='')
                 {
                    $('#err_answer5').html('This field is required.');
                    flag = 1;  
                 }
               }

               if($.trim(question6)!='' || $.trim(answer6)!='')
               {
                 if($.trim(question6)=='')
                 {
                    $('#err_question6').html('This field is required.');
                    flag = 1;  
                 }
                 if($.trim(answer6)=='')
                 {
                    $('#err_answer6').html('This field is required.');
                    flag = 1;  
                 }
               }

               if($.trim(question7)!='' || $.trim(answer7)!='')
               {
                 if($.trim(question7)=='')
                 {
                    $('#err_question7').html('This field is required.');
                    flag = 1;  
                 }
                 if($.trim(answer7)=='')
                 {
                    $('#err_answer7').html('This field is required.');
                    flag = 1;  
                 }
               }

               if($.trim(question8)!='' || $.trim(answer8)!='')
               {
                 if($.trim(question8)=='')
                 {
                    $('#err_question8').html('This field is required.');
                    flag = 1;  
                 }
                 if($.trim(answer8)=='')
                 {
                    $('#err_answer8').html('This field is required.');
                    flag = 1;  
                 }
               }

               if(flHorn == '')
               {
                   $('#err_flHorn').html('This field is required.');
                   flag = 1;
               }
               else if(!(flHornExt == "mp3" || flHornExt == "MP3" || flHornExt == "wave" || flHornExt == "m4a"))
               {
                   $('#err_flHorn').html('Invalid file type.');
                   flag = 1;
               }

               if($.trim(duration)=='' || parseInt(duration)==0)
               {
                  $('#err_duration').html('This field is required.');
                  flag = 1;
               }
               else if(isNaN(duration))
               {
                  $('#err_duration').html('Invalid time.');
                  flag = 1;
               }
           }

           else if(parseInt(hiddenTemplate)==25)
           {
              var direction = $('#direction').val();
              var flQuestion = $('#flQuestion').val();
              var flQuestionExt = flQuestion.substring(flQuestion.lastIndexOf('.') + 1);
              var question   = $('#question').val();
              var flHorn   = $('#flHorn').val();
              var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);
              var duration = $('#duration').val();

              $('#err_direction').html('');
              $('#err_flQuestion').html('');
              $('#err_question').html('');
              $('#err_flHorn').html('');
              $('#err_duration').html('');

               if($.trim(direction)=='')
               {
                  $('#err_direction').html('This field is required.');
                  flag = 1;  
               }

               if(flQuestion=='')
               {
                  $('#err_flQuestion').html('This field is required.');
                  flag = 1;
               }
               else if(!(flQuestionExt == "mp4" || flQuestionExt == "MP4"))
               {
                  $('#err_flQuestion').html('Invalid file type.');
                  flag=1;
               }

               if($.trim(question)=='')
               {
                  $('#err_question').html('This field is required.');
                  flag = 1;  
               }

               if(flHorn == '')
               {
                   $('#err_flHorn').html('This field is required.');
                   flag = 1;
               }
               else if(!(flHornExt == "mp3" || flHornExt == "MP3" || flHornExt == "wave" || flHornExt == "m4a"))
               {
                   $('#err_flHorn').html('Invalid file type.');
                   flag = 1;
               }

               if($.trim(duration)=='' || parseInt(duration)==0)
               {
                  $('#err_duration').html('This field is required.');
                  flag = 1;
               }
               else if(isNaN(duration))
               {
                  $('#err_duration').html('Invalid time.');
                  flag = 1;
               }

           }

           else if(parseInt(hiddenTemplate)==26)
           {
               var direction = $('#direction').val();
               var question1 = $('#question1').val();
               var option1_1 = $('#option1_1').val();
               var option1_2 = $('#option1_2').val();
               var option1_3 = $('#option1_3').val();
               var rdoOption1 = $('input[name="rdoOption1"]:checked').val();
               var question2 = $('#question2').val();
               var option2_1 = $('#option2_1').val();
               var option2_2 = $('#option2_2').val();
               var option2_3 = $('#option2_3').val();
               var rdoOption2 = $('input[name="rdoOption2"]:checked').val();
               var question3 = $('#question3').val();
               var option3_1 = $('#option3_1').val();
               var option3_2 = $('#option3_2').val();
               var option3_3 = $('#option3_3').val();
               var rdoOption3 = $('input[name="rdoOption3"]:checked').val();
               var flHorn   = $('#flHorn').val();
               var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);
               var duration = $('#duration').val();

               $('#err_direction').html('');
               $('#err_question1').html('');
               $('#err_option1_1').html('');
               $('#err_option1_2').html('');
               $('#err_option1_3').html('');
               $('#err_rdoOption1').html('');
               $('#err_question2').html('');
               $('#err_option2_1').html('');
               $('#err_option2_2').html('');
               $('#err_option2_3').html('');
               $('#err_rdoOption2').html('');
               $('#err_question3').html('');
               $('#err_option3_1').html('');
               $('#err_option3_2').html('');
               $('#err_option3_3').html('');
               $('#err_rdoOption3').html('');
               $('#err_flHorn').html('');
               $('#err_duration').html('');

               if($.trim(direction)=='')
               {
                  $('#err_direction').html('This field is required.');
                  flag = 1;
               }

               if($.trim(question1)=='')
               {
                  $('#err_question1').html('This field is required.');
                  flag = 1;
               }
               if($.trim(option1_1)=='')
               {
                  $('#err_option1_1').html('This field is required.');
                  flag = 1;
               }
               if($.trim(option1_2)=='')
               {
                  $('#err_option1_2').html('This field is required.');
                  flag = 1;
               }
               if($.trim(option1_3)=='')
               {
                  $('#err_option1_3').html('This field is required.');
                  flag = 1;
               }
               if(rdoOption1==null)
               {
                   $('#err_rdoOption1').html('Choose one option as answer');
                   flag = 1;
               }

               if($.trim(question2)=='')
               {
                  $('#err_question2').html('This field is required.');
                  flag = 1;
               }
               if($.trim(option2_1)=='')
               {
                  $('#err_option2_1').html('This field is required.');
                  flag = 1;
               }
               if($.trim(option2_2)=='')
               {
                  $('#err_option2_2').html('This field is required.');
                  flag = 1;
               }
               if($.trim(option2_3)=='')
               {
                  $('#err_option2_3').html('This field is required.');
                  flag = 1;
               }
               if(rdoOption2==null)
               {
                   $('#err_rdoOption2').html('Choose one option as answer');
                   flag = 1;
               }

               if($.trim(question3)=='')
               {
                  $('#err_question3').html('This field is required.');
                  flag = 1;
               }
               if($.trim(option3_1)=='')
               {
                  $('#err_option3_1').html('This field is required.');
                  flag = 1;
               }
               if($.trim(option3_2)=='')
               {
                  $('#err_option3_2').html('This field is required.');
                  flag = 1;
               }
               if($.trim(option3_3)=='')
               {
                  $('#err_option3_3').html('This field is required.');
                  flag = 1;
               }
               if(rdoOption3==null)
               {
                   $('#err_rdoOption3').html('Choose one option as answer');
                   flag = 1;
               }
               
               if(flHorn == '')
               {
                   $('#err_flHorn').html('This field is required.');
                   flag = 1;
               }
               else if(!(flHornExt == "mp3" || flHornExt == "MP3" || flHornExt == "wave" || flHornExt == "m4a"))
               {
                   $('#err_flHorn').html('Invalid file type.');
                   flag = 1;
               }

               if($.trim(duration)=='' || parseInt(duration)==0)
               {
                  $('#err_duration').html('This field is required.');
                  flag = 1;
               }
               else if(isNaN(duration))
               {
                  $('#err_duration').html('Invalid time.');
                  flag = 1;
               }
           }

           else if(parseInt(hiddenTemplate)==27)
           {
              var direction = $('#direction').val();
              var question1 = $('#question1').val();
              var answer1 = $('#answer1').val();
              var question2 = $('#question2').val();
              var answer2 = $('#answer2').val();
              var question3 = $('#question3').val();
              var answer3 = $('#answer3').val();
              var flHorn   = $('#flHorn').val();
              var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);
              var duration = $('#duration').val();

              $('#err_direction').html('');
              $('#err_question1').html('');
              $('#err_answer1').html('');
              $('#err_question2').html('');
              $('#err_answer2').html('');
              $('#err_question3').html('');
              $('#err_answer3').html('');
              $('#err_flHorn').html('');
              $('#err_duration').html('');

               if($.trim(direction)=='')
               {
                  $('#err_direction').html('This field is required.');
                  flag = 1;  
               }

               if($.trim(question1)=='')
               {
                  $('#err_question1').html('This field is required.');
                  flag = 1;  
               }
               if($.trim(answer1)=='')
               {
                  $('#err_answer1').html('This field is required.');
                  flag = 1;  
               }

               if($.trim(question2)=='')
               {
                  $('#err_question2').html('This field is required.');
                  flag = 1;  
               }
               if($.trim(answer2)=='')
               {
                  $('#err_answer2').html('This field is required.');
                  flag = 1;  
               }

               if($.trim(question3)=='')
               {
                  $('#err_question3').html('This field is required.');
                  flag = 1;  
               }
               if($.trim(answer3)=='')
               {
                  $('#err_answer3').html('This field is required.');
                  flag = 1;  
               }

               if(flHorn == '')
               {
                   $('#err_flHorn').html('This field is required.');
                   flag = 1;
               }
               else if(!(flHornExt == "mp3" || flHornExt == "MP3" || flHornExt == "wave" || flHornExt == "m4a"))
               {
                   $('#err_flHorn').html('Invalid file type.');
                   flag = 1;
               }
               if($.trim(duration)=='' || parseInt(duration)==0)
               {
                  $('#err_duration').html('This field is required.');
                  flag = 1;
               }
               else if(isNaN(duration))
               {
                  $('#err_duration').html('Invalid time.');
                  flag = 1;
               }

           }

           else if(parseInt(hiddenTemplate)==28)
           {
              var direction = $('#direction').val();
              var question1 = $('#question1').val();
              var rdoOption1 = $('input[name="rdoOption1"]:checked').val();
              var question2 = $('#question2').val();
              var rdoOption2 = $('input[name="rdoOption2"]:checked').val();
              var question3 = $('#question3').val();
              var rdoOption3 = $('input[name="rdoOption3"]:checked').val();
              var question4 = $('#question4').val();
              var rdoOption4 = $('input[name="rdoOption4"]:checked').val();
              var question5 = $('#question5').val();
              var rdoOption5 = $('input[name="rdoOption5"]:checked').val();
              var flHorn   = $('#flHorn').val();
              var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);
              var duration = $('#duration').val();

              $('#err_direction').html('');
              $('#err_question1').html('');
              $('#err_rdoOption1').html('');
              $('#err_question2').html('');
              $('#err_rdoOption2').html('');
              $('#err_question3').html('');
              $('#err_rdoOption3').html('');
              $('#err_question4').html('');
              $('#err_rdoOption4').html('');
              $('#err_question5').html('');
              $('#err_rdoOption5').html('');
              $('#err_flHorn').html('');
              $('#err_duration').html('');

               if($.trim(direction)=='')
               {
                  $('#err_direction').html('This field is required.');
                  flag = 1;  
               }

               if($.trim(question1)=='')
               {
                  $('#err_question1').html('This field is required.');
                  flag = 1;  
               }
               if(rdoOption1==null)
               {
                  $('#err_rdoOption1').html('This field is required.');
                  flag = 1;  
               }

               if($.trim(question2)!='')
               {
                 if(rdoOption2==null)
                 {
                    $('#err_rdoOption2').html('This field is required.');
                    flag = 1;  
                 }
               }

               if($.trim(question3)!='')
               {
                 if(rdoOption3==null)
                 {
                    $('#err_rdoOption3').html('This field is required.');
                    flag = 1;  
                 }
               }

               if($.trim(question4)!='')
               {
                 if(rdoOption4==null)
                 {
                    $('#err_rdoOption4').html('This field is required.');
                    flag = 1;  
                 }
               }

               if($.trim(question5)!='')
               {
                 if(rdoOption5==null)
                 {
                    $('#err_rdoOption5').html('This field is required.');
                    flag = 1;  
                 }
               }

               if(flHorn == '')
               {
                   $('#err_flHorn').html('This field is required.');
                   flag = 1;
               }
               else if(!(flHornExt == "mp3" || flHornExt == "MP3" || flHornExt == "wave" || flHornExt == "m4a"))
               {
                   $('#err_flHorn').html('Invalid file type.');
                   flag = 1;
               }
               if($.trim(duration)=='' || parseInt(duration)==0)
               {
                  $('#err_duration').html('This field is required.');
                  flag = 1;
               }
               else if(isNaN(duration))
               {
                  $('#err_duration').html('Invalid time.');
                  flag = 1;
               }

           }

           else if(parseInt(hiddenTemplate)==29)
           {
              var direction = $('#direction').val();
              var answer = $('#answer').val();
              var question1 = $('#question1').val();
              var question2 = $('#question2').val();
              var question3 = $('#question3').val();
              var question4 = $('#question4').val();
              var question5 = $('#question5').val();
              var flHorn   = $('#flHorn').val();
              var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);
              var duration = $('#duration').val();

              $('#err_direction').html('');
              $('#err_answer').html('');
              $('#err_question1').html('');
              $('#err_question2').html('');
              $('#err_question3').html('');
              $('#err_question4').html('');
              $('#err_question5').html('');
              $('#err_flHorn').html('');
              $('#err_duration').html('');

               if($.trim(direction)=='')
               {
                  $('#err_direction').html('This field is required.');
                  flag = 1;  
               }

               if($.trim(answer)=='')
               {
                  $('#err_answer').html('This field is required.');
                  flag = 1;  
               }

               if($.trim(question1)=='')
               {
                  $('#err_question1').html('This field is required.');
                  flag = 1;  
               }
               
/*               if($.trim(question2)=='')
               {
                  $('#err_question2').html('This field is required.');
                  flag = 1;  
               }
               
               if($.trim(question3)=='')
               {
                  $('#err_question3').html('This field is required.');
                  flag = 1;  
               }
               
               if($.trim(question4)=='')
               {
                  $('#err_question4').html('This field is required.');
                  flag = 1;  
               }
               
               if($.trim(question5)=='')
               {
                  $('#err_question5').html('This field is required.');
                  flag = 1;  
               }*/
               
               if(flHorn == '')
               {
                   $('#err_flHorn').html('This field is required.');
                   flag = 1;
               }
               else if(!(flHornExt == "mp3" || flHornExt == "MP3" || flHornExt == "wave" || flHornExt == "m4a"))
               {
                   $('#err_flHorn').html('Invalid file type.');
                   flag = 1;
               }
               if($.trim(duration)=='' || parseInt(duration)==0)
               {
                  $('#err_duration').html('This field is required.');
                  flag = 1;
               }
               else if(isNaN(duration))
               {
                  $('#err_duration').html('Invalid time.');
                  flag = 1;
               }

           }

           else if(parseInt(hiddenTemplate)==30)
           {
              var direction = $('#direction').val();
              var question1 = $('#question1').val();
              var answer1 = $('#answer1').val();
              var question2 = $('#question2').val();
              var answer2 = $('#answer2').val();
              var question3 = $('#question3').val();
              var answer3 = $('#answer3').val();
              var question4 = $('#question4').val();
              var answer4 = $('#answer4').val();
              var question5 = $('#question5').val();
              var answer5 = $('#answer5').val();
              var flHorn   = $('#flHorn').val();
              var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);
              var duration = $('#duration').val();

              $('#err_direction').html('');
              $('#err_question1').html('');
              $('#err_answer1').html('');
              $('#err_question2').html('');
              $('#err_answer2').html('');
              $('#err_question3').html('');
              $('#err_answer3').html('');
              $('#err_question4').html('');
              $('#err_answer4').html('');
              $('#err_question5').html('');
              $('#err_answer5').html('');
              $('#err_flHorn').html('');
              $('#err_duration').html('');

               if($.trim(direction)=='')
               {
                  $('#err_direction').html('This field is required.');
                  flag = 1;  
               }

                if($.trim(question1)=='')
                {
                   $('#err_question1').html('This field is required.');
                   flag = 1;  
                }
                if($.trim(answer1)=='')
                {
                   $('#err_answer1').html('This field is required.');
                   flag = 1;  
                }
           
                if($.trim(question2)=='')
                {
                   $('#err_question2').html('This field is required.');
                   flag = 1;  
                }
                if($.trim(answer2)=='')
                {
                   $('#err_answer2').html('This field is required.');
                   flag = 1;  
                }
           
                if($.trim(question3)=='')
                {
                   $('#err_question3').html('This field is required.');
                   flag = 1;  
                }
                if($.trim(answer3)=='')
                {
                   $('#err_answer3').html('This field is required.');
                   flag = 1;  
                }
           
                if($.trim(question4)=='')
                {
                   $('#err_question4').html('This field is required.');
                   flag = 1;  
                }
                if($.trim(answer4)=='')
                {
                   $('#err_answer4').html('This field is required.');
                   flag = 1;  
                }
           
                if($.trim(question5)=='')
                {
                   $('#err_question5').html('This field is required.');
                   flag = 1;  
                }
                if($.trim(answer5)=='')
                {
                   $('#err_answer5').html('This field is required.');
                   flag = 1;  
                }

               if(flHorn == '')
               {
                   $('#err_flHorn').html('This field is required.');
                   flag = 1;
               }
               else if(!(flHornExt == "mp3" || flHornExt == "MP3" || flHornExt == "wave" || flHornExt == "m4a"))
               {
                   $('#err_flHorn').html('Invalid file type.');
                   flag = 1;
               }
               if($.trim(duration)=='' || parseInt(duration)==0)
               {
                  $('#err_duration').html('This field is required.');
                  flag = 1;
               }
               else if(isNaN(duration))
               {
                  $('#err_duration').html('Invalid time.');
                  flag = 1;
               }

           }

           else if(parseInt(hiddenTemplate)==31)
           {
              var direction = $('#direction').val();
              var question = $('#question').val();
              var questionAnsArr = questionAnsCount = '';
              var answer = $('#answer').val();
              var flHorn   = $('#flHorn').val();
              var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);
              var duration = $('#duration').val();

              $('#err_direction').html('');
              $('#err_question').html('');
              $('#err_answer').html('');
              $('#err_flHorn').html('');
              $('#err_duration').html('');

               if($.trim(direction)=='')
               {
                  $('#err_direction').html('This field is required.');
                  flag = 1;  
               }

               if($.trim(question)=='')
               {
                  $('#err_question').html('This field is required.');
                  flag = 1;  
               }
               else
               {
                  var questionAnsArr = question.match(/#BLANK#/g);
                  if(questionAnsArr==null)
                  {
                    $('#err_question').html('#BLANK# is missing');
                    flag = 1;    
                  }
                  /*else
                  {
                    var questionAnsCount = questionAnsArr.length;  
                    if(parseInt(questionAnsCount)!=1)
                    {
                      $('#err_question').html('Only one #BLANK# is allowed');
                      flag = 1;       
                    }
                  }*/
               }

               if($.trim(answer)=='')
               {
                  $('#err_answer').html('This field is required.');
                  flag = 1;  
               }
               else
               {
                   if($.trim(question)!='')
                   {
                      var questionAnsArr = question.match(/#BLANK#/g);
                      var questionAnsCount = questionAnsArr.length;
                      var answerCount = answer.split(',').length;
                      if(parseInt(answerCount) != parseInt(questionAnsCount))
                      {
                        $('#err_answer').html('Please enter all answers.');
                        flag = 1;          
                      }
                   }  
                   else
                   {
                    $('#err_question').html('This field is required.');
                      flag = 1;  
                   }              
               }
               
               if(flHorn == '')
               {
                   $('#err_flHorn').html('This field is required.');
                   flag = 1;
               }
               else if(!(flHornExt == "mp3" || flHornExt == "MP3" || flHornExt == "wave" || flHornExt == "m4a"))
               {
                   $('#err_flHorn').html('Invalid file type.');
                   flag = 1;
               }
               if($.trim(duration)=='' || parseInt(duration)==0)
               {
                  $('#err_duration').html('This field is required.');
                  flag = 1;
               }
               else if(isNaN(duration))
               {
                  $('#err_duration').html('Invalid time.');
                  flag = 1;
               }
           }

           else if(parseInt(hiddenTemplate)==32)
           {
              var direction = $('#direction').val();
              var question = $('#question').val();
              var answer = $('#answer').val();
              var flHorn   = $('#flHorn').val();
              var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);
              var duration = $('#duration').val();

              $('#err_direction').html('');
              $('#err_question').html('');
              $('#err_answer').html('');
              $('#err_flHorn').html('');
              $('#err_duration').html('');

               if($.trim(direction)=='')
               {
                  $('#err_direction').html('This field is required.');
                  flag = 1;  
               }

               if($.trim(question)=='')
               {
                  $('#err_question').html('This field is required.');
                  flag = 1;  
               }

               if($.trim(answer)=='')
               {
                  $('#err_answer').html('This field is required.');
                  flag = 1;  
               }
               else
               {
                   if($.trim(question)=='')
                   {
                      $('#err_question').html('This field is required.');
                      flag = 1;  
                   }
                   else if(flag!=1)
                   {
                     var arr_answer = answer.split(',');
                     $.each(arr_answer, function( index, val ) {
                       if(!question.match(val))
                       {
                         $('#err_answer').html('Answer not match.');
                         flag = 1;
                       }
                     });
                   }
               }
               
               if(flHorn == '')
               {
                   $('#err_flHorn').html('This field is required.');
                   flag = 1;
               }
               else if(!(flHornExt == "mp3" || flHornExt == "MP3" || flHornExt == "wave" || flHornExt == "m4a"))
               {
                   $('#err_flHorn').html('Invalid file type.');
                   flag = 1;
               }

               if($.trim(duration)=='' || parseInt(duration)==0)
               {
                  $('#err_duration').html('This field is required.');
                  flag = 1;
               }
               else if(isNaN(duration))
               {
                  $('#err_duration').html('Invalid time.');
                  flag = 1;
               }
           }

           else if(parseInt(hiddenTemplate)==33)
           {
              var direction = $('#direction').val();
              var duration = $('#duration').val();
              /*var flHorn   = $('#flHorn').val();
              var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);*/

              $('#err_direction').html('');

              /*$('#err_flHorn').html('');*/
                var digit1_1 = $('#digit1_1').val();
                var operator1 = $('#operator1').val();
                var digit2_1 = $('#digit1_2').val();
                var answer_1 = $('#answer1').val();

                $('#err_digit1_1').html('');
                $('#err_operator1').html('');
                $('#err_digit1_2').html('');
                $('#err_answer1').html('');
                $('#err_duration').html('');

                if($.trim(digit1_1)=='')
                {
                    $('#err_digit1_1').html('This field is required.');
                    flag = 1;    
                }
                else if(isNaN(digit1_1))
                {
                  $('#err_digit1_1').html('Invalid field value.');
                  flag = 1;  
                }
                if($.trim(operator1)=='')
                {
                  $('#err_operator1').html('This field is required.');
                  flag = 1;  
                }
                if($.trim(digit2_1)=='')
                {
                    $('#err_digit1_2').html('This field is required.');
                    flag = 1;    
                }
                else if(isNaN(digit2_1))
                {
                  $('#err_digit1_2').html('Invalid field value.');
                  flag = 1;  
                }
                if($.trim(answer_1)=='')
                {
                  $('#err_answer1').html('This field is required.');
                  flag = 1;  
                }
                else if(isNaN(answer_1))
                {
                  $('#err_answer1').html('Invalid field value.');
                  flag = 1;  
                }              

              for (var i = 2; i <= 12; i++)
              {
                var digit1 = $('#digit'+i+'_1').val();
                var operator = $('#operator'+i).val();
                var digit2 = $('#digit'+i+'_2').val();
                var answer = $('#answer'+i).val();
                
                $('#err_digit'+i+'_1').html('');
                $('#err_operator'+i).html('');
                $('#err_digit'+i+'_2').html('');
                $('#err_answer'+i).html('');
                $('#err_duration').html('');

                if($.trim(digit1)!='' || $.trim(operator)!='' || $.trim(digit2)!='' || $.trim(answer)!='')
                {
                  if($.trim(digit1)=='')
                  {
                      $('#err_digit'+i+'_1').html('This field is required.');
                      flag = 1;    
                  }
                  else if(isNaN(digit1))
                  {
                    $('#err_digit'+i+'_1').html('Invalid field value.');
                    flag = 1;  
                  }
                  if($.trim(operator)=='')
                  {
                    $('#err_operator'+i).html('This field is required.');
                    flag = 1;  
                  }
                  if($.trim(digit2)=='')
                  {
                      $('#err_digit'+i+'_2').html('This field is required.');
                      flag = 1;    
                  }
                  else if(isNaN(digit2))
                  {
                    $('#err_digit'+i+'_2').html('Invalid field value.');
                    flag = 1;  
                  }
                  if($.trim(answer)=='')
                  {
                    $('#err_answer'+i).html('This field is required.');
                    flag = 1;  
                  }
                  else if(isNaN(answer))
                  {
                    $('#err_answer'+i).html('Invalid field value.');
                    flag = 1;  
                  }
                }
              }

               if($.trim(direction)=='')
               {
                  $('#err_direction').html('This field is required.');
                  flag = 1;  
               }

               /*if(flHorn == '')
               {
                   $('#err_flHorn').html('This field is required.');
                   flag = 1;
               }
               else if(!(flHornExt == "mp3" || flHornExt == "MP3" || flHornExt == "wave" || flHornExt == "m4a"))
               {
                   $('#err_flHorn').html('Invalid file type.');
                   flag = 1;
               }*/

               if($.trim(duration)=='' || parseInt(duration)==0)
               {
                  $('#err_duration').html('This field is required.');
                  flag = 1;
               }
               else if(isNaN(duration))
               {
                  $('#err_duration').html('Invalid time.');
                  flag = 1;
               }
               
           }

           else if(parseInt(hiddenTemplate)==34)
           {
              var direction = $('#direction').val();
              var flQuestion = $('#flQuestion').val();
              var flQuestionExt = flQuestion.substring(flQuestion.lastIndexOf('.')+1);
              var digit1_1 = $('#digit1_1').val();
              var operator1 = $('#operator1').val();
              var digit1_2 = $('#digit1_2').val();
              var answer1 = $('#answer1').val();
              /*var flHorn   = $('#flHorn').val();
              var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);*/
              var duration = $('#duration').val();

              $('#err_direction').html('');
              $('#err_flQuestion').html('');
              $('#err_digit1_1').html('');
              $('#err_operator1').html('');
              $('#err_digit1_2').html('');
              $('#err_answer1').html('');
              /*$('#err_flHorn').html('');*/
              $('#err_duration').html('');

               if($.trim(direction)=='')
               {
                  $('#err_direction').html('This field is required.');
                  flag = 1;  
               }

               if(flQuestion == '')
               {
                   $('#err_flQuestion').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestionExt == "jpg" || flQuestionExt == "jpeg" || flQuestionExt == "gif" || flQuestionExt == "png" || flQuestionExt == "GIF" || flQuestionExt == "JPG" || flQuestionExt == "JPEG" || flQuestionExt == "PNG"))
               {
                   $('#err_flQuestion').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion').attr('data-error')=='yes')
               {
                  $('#err_flQuestion').html('File must be grater than / equal to 583 X 560.');
                  flag=1;  
               }

               if($.trim(digit1_1)=='')
               {
                  $('#err_digit1_1').html('This field is required.');
                  flag=1;
               }
               else if(isNaN(digit1_1))
               {
                  $('#err_digit1_1').html('Invalid field value.');
                  flag=1;
               }
               if($.trim(operator1)=='')
               {
                  $('#err_operator1').html('This field is required.');
                  flag=1;
               }
               if($.trim(digit1_2)=='')
               {
                  $('#err_digit1_2').html('This field is required.');
                  flag=1;
               }
               else if(isNaN(digit1_2))
               {
                  $('#err_digit1_2').html('Invalid field value.');
                  flag=1;
               }
               if($.trim(answer1)=='')
               {
                  $('#err_answer1').html('This field is required.');
                  flag=1;
               }
               else if(isNaN(answer1))
               {
                  $('#err_answer1').html('Invalid field value.');
                  flag=1;
               }

               /*if(flHorn == '')
               {
                   $('#err_flHorn').html('This field is required.');
                   flag = 1;
               }
               else if(!(flHornExt == "mp3" || flHornExt == "MP3" || flHornExt == "wave" || flHornExt == "m4a"))
               {
                   $('#err_flHorn').html('Invalid file type.');
                   flag = 1;
               }*/

               if($.trim(duration)=='' || parseInt(duration)==0)
               {
                  $('#err_duration').html('This field is required.');
                  flag = 1;
               }
               else if(isNaN(duration))
               {
                  $('#err_duration').html('Invalid time.');
                  flag = 1;
               }
               
           }

           else if(parseInt(hiddenTemplate)==35)
           {
              var direction = $('#direction').val();
              /*var flHorn   = $('#flHorn').val();
              var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);*/
              var duration = $('#duration').val();

              $('#err_direction').html('');
              /*$('#err_flHorn').html('');*/
              $('#err_duration').html('');

              var digit1_1 = $('#digit1_1').val();
              var operator1 = $('#operator1').val();
              var digit2_1 = $('#digit1_2').val();
              var answer_1 = $('#answer1').val();
              var chkBlankLetter1 = $('input[name="chkBlankLetter_1[]"]:checked').length;

              $('#err_digit1_1').html('');
              $('#err_operator1').html('');
              $('#err_digit1_2').html('');
              $('#err_answer1').html('');
              $('#err_duration').html('');

              if($.trim(digit1_1)=='')
              {
                  $('#err_digit1_1').html('This field is required.');
                  flag = 1;    
              }
              else if(isNaN(digit1_1))
              {
                $('#err_digit1_1').html('Invalid field value.');
                flag = 1;  
              }
              if($.trim(operator1)=='')
              {
                $('#err_operator1').html('This field is required.');
                flag = 1;  
              }
              if($.trim(digit2_1)=='')
              {
                  $('#err_digit1_2').html('This field is required.');
                  flag = 1;    
              }
              else if(isNaN(digit2_1))
              {
                $('#err_digit1_2').html('Invalid field value.');
                flag = 1;  
              }
              if($.trim(answer_1)=='')
              {
                $('#err_answer1').html('This field is required.');
                flag = 1;  
              }
              else if(isNaN(answer_1))
              {
                $('#err_answer1').html('Invalid field value.');
                flag = 1;  
              }
              if(parseInt(chkBlankLetter1)==0)
              {
                $('#err_chkBlankLetter_1').html('Invalid field value.');
                flag = 1;   
              }

              if($('#flQuestion1').val()== '')
              {
                 $('#err_flQuestion1').html('This field is required.');
                 flag=1;
              }
             else if($('#flQuestion1').val()!= '')
             {
                 if(!($('#flQuestion1').val().substring($('#flQuestion1').val().lastIndexOf('.')+1) == "jpg" || $('#flQuestion1').val().substring($('#flQuestion1').val().lastIndexOf('.')+1) == "jpeg" || $('#flQuestion1').val().substring($('#flQuestion1').val().lastIndexOf('.')+1) == "gif" || $('#flQuestion1').val().substring($('#flQuestion1').val().lastIndexOf('.')+1) == "png" || $('#flQuestion1').val().substring($('#flQuestion1').val().lastIndexOf('.')+1) == "GIF" || $('#flQuestion1').val().substring($('#flQuestion1').val().lastIndexOf('.')+1) == "JPG" || $('#flQuestion1').val().substring($('#flQuestion1').val().lastIndexOf('.')+1) == "JPEG" || $('#flQuestion1').val().substring($('#flQuestion1').val().lastIndexOf('.')+1) == "PNG"))
                 {
                     $('#err_flQuestion1').html('Invalid file type.');
                     flag=1;
                 }    
             }

              for (var i = 2; i <= 5; i++)
              {
                var digit1 = $('#digit'+i+'_1').val();
                var operator = $('#operator'+i).val();
                var digit2 = $('#digit'+i+'_2').val();
                var answer = $('#answer'+i).val();
                var chkBlankLetter = $('input[name="chkBlankLetter_'+i+'[]"]:checked').length;
                
                $('#err_digit'+i+'_1').html('');
                $('#err_operator'+i).html('');
                $('#err_digit'+i+'_2').html('');
                $('#err_answer'+i).html('');
                $('#err_chkBlankLetter_'+i).html('');

                if($.trim(digit1)!='' || $.trim(operator)!='' || $.trim(digit2)!='' || $.trim(answer)!='' || $('#flQuestion'+i).val()!= '')
                {
                  if($.trim(digit1)=='')
                  {
                      $('#err_digit'+i+'_1').html('This field is required.');
                      flag = 1;    
                  }
                  else if(isNaN(digit1))
                  {
                    $('#err_digit'+i+'_1').html('Invalid field value.');
                    flag = 1;  
                  }
                  if($.trim(operator)=='')
                  {
                    $('#err_operator'+i).html('This field is required.');
                    flag = 1;  
                  }
                  if($.trim(digit2)=='')
                  {
                      $('#err_digit'+i+'_2').html('This field is required.');
                      flag = 1;    
                  }
                  else if(isNaN(digit2))
                  {
                    $('#err_digit'+i+'_2').html('Invalid field value.');
                    flag = 1;  
                  }
                  if($.trim(answer)=='')
                  {
                    $('#err_answer'+i).html('This field is required.');
                    flag = 1;  
                  }
                  else if(isNaN(answer))
                  {
                    $('#err_answer'+i).html('Invalid field value.');
                    flag = 1;  
                  }
                  if(parseInt(chkBlankLetter)==0)
                  {
                    $('#err_chkBlankLetter_'+i).html('Invalid field value.');
                    flag = 1;   
                  }
                   if($('#flQuestion'+i).val()== '')
                   {
                     $('#err_flQuestion'+i).html('This field is required.');
                   }
                   else if($('#flQuestion'+i).val()!= '')
                   {
                       if(!($('#flQuestion'+i).val().substring($('#flQuestion'+i).val().lastIndexOf('.')+1) == "jpg" || $('#flQuestion'+i).val().substring($('#flQuestion'+i).val().lastIndexOf('.')+1) == "jpeg" || $('#flQuestion'+i).val().substring($('#flQuestion'+i).val().lastIndexOf('.')+1) == "gif" || $('#flQuestion'+i).val().substring($('#flQuestion'+i).val().lastIndexOf('.')+1) == "png" || $('#flQuestion'+i).val().substring($('#flQuestion'+i).val().lastIndexOf('.')+1) == "GIF" || $('#flQuestion'+i).val().substring($('#flQuestion'+i).val().lastIndexOf('.')+1) == "JPG" || $('#flQuestion'+i).val().substring($('#flQuestion'+i).val().lastIndexOf('.')+1) == "JPEG" || $('#flQuestion'+i).val().substring($('#flQuestion'+i).val().lastIndexOf('.')+1) == "PNG"))
                       {
                           $('#err_flQuestion'+i).html('Invalid file type.');
                           flag=1;
                       }    
                   }
                }
              }

               if($.trim(direction)=='')
               {
                  $('#err_direction').html('This field is required.');
                  flag = 1;  
               }
               /*if(flHorn == '')
               {
                   $('#err_flHorn').html('This field is required.');
                   flag = 1;
               }
               else if(!(flHornExt == "mp3" || flHornExt == "MP3" || flHornExt == "wave" || flHornExt == "m4a"))
               {
                   $('#err_flHorn').html('Invalid file type.');
                   flag = 1;
               }*/
               if($.trim(duration)=='' || parseInt(duration)==0)
               {
                  $('#err_duration').html('This field is required.');
                  flag = 1;
               }
               else if(isNaN(duration))
               {
                  $('#err_duration').html('Invalid time.');
                  flag = 1;
               }
              
               
           }

           else if(parseInt(hiddenTemplate)==36)
           {
              var direction = $('#direction').val();
              var flQuestion1 = $('#flQuestion1').val();
              var flQuestion1Ext = flQuestion1.substring(flQuestion1.lastIndexOf('.')+1);
              /*var flQuestion2 = $('#flQuestion2').val();
              var flQuestion2Ext = flQuestion2.substring(flQuestion2.lastIndexOf('.')+1);*/
              var answer = $('#answer').val();
              /*var flHorn   = $('#flHorn').val();
              var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);*/
              var duration = $('#duration').val();

              $('#err_direction').html('');
              $('#err_flQuestion1').html('');
              $('#err_flQuestion2').html('');
              $('#err_answer').html('');
              /*$('#err_flHorn').html('');*/
              $('#err_duration').html('');

               if($.trim(direction)=='')
               {
                  $('#err_direction').html('This field is required.');
                  flag = 1;  
               }

               if(flQuestion1 == '')
               {
                   $('#err_flQuestion1').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion1Ext == "jpg" || flQuestion1Ext == "jpeg" || flQuestion1Ext == "gif" || flQuestion1Ext == "png" || flQuestion1Ext == "GIF" || flQuestion1Ext == "JPG" || flQuestion1Ext == "JPEG" || flQuestion1Ext == "PNG"))
               {
                   $('#err_flQuestion1').html('Invalid file type.');
                   flag=1;
               }

/*               if(flQuestion2 != '')
               {
                   if(!(flQuestion2Ext == "jpg" || flQuestion2Ext == "jpeg" || flQuestion2Ext == "gif" || flQuestion2Ext == "png" || flQuestion2Ext == "GIF" || flQuestion2Ext == "JPG" || flQuestion2Ext == "JPEG" || flQuestion2Ext == "PNG"))
                   {
                       $('#err_flQuestion2').html('Invalid file type.');
                       flag=1;
                   }    
               }*/

               if($.trim(answer)=='')
               {
                  $('#err_answer').html('This field is required.');
                  flag=1;
               }
               else if(isNaN(answer))
               {
                  $('#err_answer').html('Invalid field value.');
                  flag=1;
               }

               /*if(flHorn == '')
               {
                   $('#err_flHorn').html('This field is required.');
                   flag = 1;
               }
               else if(!(flHornExt == "mp3" || flHornExt == "MP3" || flHornExt == "wave" || flHornExt == "m4a"))
               {
                   $('#err_flHorn').html('Invalid file type.');
                   flag = 1;
               }*/
               if($.trim(duration)=='' || parseInt(duration)==0)
               {
                  $('#err_duration').html('This field is required.');
                  flag = 1;
               }
               else if(isNaN(duration))
               {
                  $('#err_duration').html('Invalid time.');
                  flag = 1;
               }
               
           }

           else if(parseInt(hiddenTemplate)==37)
           {

              var direction = $('#direction').val();
              
              var flQuestion1    = $('#flQuestion1').val();
              var flQuestion1Ext = flQuestion1.substring(flQuestion1.lastIndexOf('.')+1);
              var digit1_1       = $('#digit1_1').val();
              var operator1      = $('#operator1').val();
              var digit1_2       = $('#digit1_2').val();
              var answer1        = $('#answer1').val();

              var flQuestion2    = $('#flQuestion2').val();
              var flQuestion2Ext = flQuestion2.substring(flQuestion2.lastIndexOf('.')+1);
              var digit2_1       = $('#digit2_1').val();
              var operator2      = $('#operator2').val();
              var digit2_2       = $('#digit2_2').val();
              var answer2        = $('#answer2').val();

              var flQuestion3     = $('#flQuestion3').val();
              var flQuestion3Ext  = flQuestion3.substring(flQuestion3.lastIndexOf('.')+1);
              var digit3_1        = $('#digit3_1').val();
              var operator3       = $('#operator3').val();
              var digit3_2        = $('#digit3_2').val();
              var answer3         = $('#answer3').val();

              var flQuestion4     = $('#flQuestion4').val();
              var flQuestion4Ext  = flQuestion4.substring(flQuestion4.lastIndexOf('.')+1);
              var digit4_1        = $('#digit4_1').val();
              var operator4       = $('#operator4').val();
              var digit4_2        = $('#digit4_2').val();
              var answer4         = $('#answer4').val();

              /*var flHorn   = $('#flHorn').val();
              var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);*/
              var duration = $('#duration').val();

              $('#err_direction').html('');

              $('#err_flQuestion1').html('');
              $('#err_digit1_1').html('');
              $('#err_operator1').html('');
              $('#err_digit1_2').html('');
              $('#err_answer1').html('');

              $('#err_flQuestion2').html('');
              $('#err_digit2_1').html('');
              $('#err_operator2').html('');
              $('#err_digit2_2').html('');
              $('#err_answer2').html('');

              $('#err_flQuestion3').html('');
              $('#err_digit3_1').html('');
              $('#err_operator3').html('');
              $('#err_digit3_2').html('');
              $('#err_answer3').html('');

              $('#err_flQuestion4').html('');
              $('#err_digit4_1').html('');
              $('#err_operator4').html('');
              $('#err_digit4_2').html('');
              $('#err_answer4').html('');
              
              /*$('#err_flHorn').html('');*/
              $('#err_duration').html('');

               if($.trim(direction)=='')
               {
                  $('#err_direction').html('This field is required.');
                  flag = 1;  
               }

               if(flQuestion1 == '')
               {
                   $('#err_flQuestion1').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion1Ext == "jpg" || flQuestion1Ext == "jpeg" || flQuestion1Ext == "gif" || flQuestion1Ext == "png" || flQuestion1Ext == "GIF" || flQuestion1Ext == "JPG" || flQuestion1Ext == "JPEG" || flQuestion1Ext == "PNG"))
               {
                   $('#err_flQuestion1').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion1').attr('data-error')=='yes')
               {
                  $('#err_flQuestion1').html('File must be grater than / equal to 504 X 67.');
                  flag=1;  
               }

               if($.trim(digit1_1)=='')
               {
                  $('#err_digit1_1').html('This field is required.');
                  flag=1;
               }
               else if(isNaN(digit1_1))
               {
                  $('#err_digit1_1').html('Invalid field value.');
                  flag=1;
               }
               if($.trim(operator1)=='')
               {
                  $('#err_operator1').html('This field is required.');
                  flag=1;
               }
               if($.trim(digit1_2)=='')
               {
                  $('#err_digit1_2').html('This field is required.');
                  flag=1;
               }
               else if(isNaN(digit1_2))
               {
                  $('#err_digit1_2').html('Invalid field value.');
                  flag=1;
               }
               if($.trim(answer1)=='')
               {
                  $('#err_answer1').html('This field is required.');
                  flag=1;
               }
               else if(isNaN(answer1))
               {
                  $('#err_answer1').html('Invalid field value.');
                  flag=1;
               }

               if(flQuestion2 != '')
               {
                   if(!(flQuestion2Ext == "jpg" || flQuestion2Ext == "jpeg" || flQuestion2Ext == "gif" || flQuestion2Ext == "png" || flQuestion2Ext == "GIF" || flQuestion2Ext == "JPG" || flQuestion2Ext == "JPEG" || flQuestion2Ext == "PNG"))
                   {
                       $('#err_flQuestion2').html('Invalid file type.');
                       flag=1;
                   }
                   else if($('#flQuestion2').attr('data-error')=='yes')
                   {
                      $('#err_flQuestion2').html('File must be grater than / equal to 504 X 67.');
                      flag=1;  
                   }
                   if($.trim(digit2_1)=='')
                   {
                      $('#err_digit2_1').html('This field is required.');
                      flag=1;
                   }
                   else if(isNaN(digit2_1))
                   {
                      $('#err_digit2_1').html('Invalid field value.');
                      flag=1;
                   }
                   if($.trim(operator2)=='')
                   {
                      $('#err_operator2').html('This field is required.');
                      flag=1;
                   }
                   if($.trim(digit2_2)=='')
                   {
                      $('#err_digit2_2').html('This field is required.');
                      flag=1;
                   }
                   else if(isNaN(digit2_2))
                   {
                      $('#err_digit2_2').html('Invalid field value.');
                      flag=1;
                   }
                   if($.trim(answer2)=='')
                   {
                      $('#err_answer2').html('This field is required.');
                      flag=1;
                   }
                   else if(isNaN(answer2))
                   {
                      $('#err_answer2').html('Invalid field value.');
                      flag=1;
                   }
               }
               if($.trim(digit2_1)!='' || $.trim(operator2)!='' || $.trim(digit2_2)!='' || $.trim(answer2)!='')
               {
                   if(flQuestion2 == '')
                   {
                       $('#err_flQuestion2').html('This field is required.');
                       flag = 1;
                   }
                   else if(!(flQuestion2Ext == "jpg" || flQuestion2Ext == "jpeg" || flQuestion2Ext == "gif" || flQuestion2Ext == "png" || flQuestion2Ext == "GIF" || flQuestion2Ext == "JPG" || flQuestion2Ext == "JPEG" || flQuestion2Ext == "PNG"))
                   {
                       $('#err_flQuestion2').html('Invalid file type.');
                       flag=1;
                   }
                   else if($('#flQuestion2').attr('data-error')=='yes')
                   {
                      $('#err_flQuestion2').html('File must be grater than / equal to 504 X 67.');
                      flag=1;  
                   }
                   if($.trim(digit2_1)=='')
                   {
                      $('#err_digit2_1').html('This field is required.');
                      flag=1;
                   }
                   else if(isNaN(digit2_1))
                   {
                      $('#err_digit2_1').html('Invalid field value.');
                      flag=1;
                   }
                   if($.trim(operator2)=='')
                   {
                      $('#err_operator2').html('This field is required.');
                      flag=1;
                   }
                   if($.trim(digit2_2)=='')
                   {
                      $('#err_digit2_2').html('This field is required.');
                      flag=1;
                   }
                   else if(isNaN(digit2_2))
                   {
                      $('#err_digit2_2').html('Invalid field value.');
                      flag=1;
                   }
                   if($.trim(answer2)=='')
                   {
                      $('#err_answer2').html('This field is required.');
                      flag=1;
                   }
                   else if(isNaN(answer2))
                   {
                      $('#err_answer2').html('Invalid field value.');
                      flag=1;
                   }
               }

               if(flQuestion3 != '')
               {
                   if(!(flQuestion3Ext == "jpg" || flQuestion3Ext == "jpeg" || flQuestion3Ext == "gif" || flQuestion3Ext == "png" || flQuestion3Ext == "GIF" || flQuestion3Ext == "JPG" || flQuestion3Ext == "JPEG" || flQuestion3Ext == "PNG"))
                   {
                       $('#err_flQuestion3').html('Invalid file type.');
                       flag=1;
                   }
                   else if($('#flQuestion3').attr('data-error')=='yes')
                   {
                      $('#err_flQuestion3').html('File must be grater than / equal to 504 X 67.');
                      flag=1;  
                   }
                   if($.trim(digit3_1)=='')
                   {
                      $('#err_digit3_1').html('This field is required.');
                      flag=1;
                   }
                   else if(isNaN(digit3_1))
                   {
                      $('#err_digit3_1').html('Invalid field value.');
                      flag=1;
                   }
                   if($.trim(operator3)=='')
                   {
                      $('#err_operator3').html('This field is required.');
                      flag=1;
                   }
                   if($.trim(digit3_2)=='')
                   {
                      $('#err_digit3_2').html('This field is required.');
                      flag=1;
                   }
                   else if(isNaN(digit3_2))
                   {
                      $('#err_digit3_2').html('Invalid field value.');
                      flag=1;
                   }
                   if($.trim(answer3)=='')
                   {
                      $('#err_answer3').html('This field is required.');
                      flag=1;
                   }
                   else if(isNaN(answer3))
                   {
                      $('#err_answer3').html('Invalid field value.');
                      flag=1;
                   }
               }
               if($.trim(digit3_1)!='' || $.trim(operator3)!='' || $.trim(digit3_2)!='' || $.trim(answer3)!='')
               {
                   if(flQuestion3 == '')
                   {
                       $('#err_flQuestion3').html('This field is required.');
                       flag = 1;
                   }
                   else if(!(flQuestion3Ext == "jpg" || flQuestion3Ext == "jpeg" || flQuestion3Ext == "gif" || flQuestion3Ext == "png" || flQuestion3Ext == "GIF" || flQuestion3Ext == "JPG" || flQuestion3Ext == "JPEG" || flQuestion3Ext == "PNG"))
                   {
                       $('#err_flQuestion3').html('Invalid file type.');
                       flag=1;
                   }
                   else if($('#flQuestion3').attr('data-error')=='yes')
                   {
                      $('#err_flQuestion3').html('File must be grater than / equal to 504 X 67.');
                      flag=1;  
                   }
                   if($.trim(digit3_1)=='')
                   {
                      $('#err_digit3_1').html('This field is required.');
                      flag=1;
                   }
                   else if(isNaN(digit3_1))
                   {
                      $('#err_digit3_1').html('Invalid field value.');
                      flag=1;
                   }
                   if($.trim(operator3)=='')
                   {
                      $('#err_operator3').html('This field is required.');
                      flag=1;
                   }
                   if($.trim(digit3_2)=='')
                   {
                      $('#err_digit3_2').html('This field is required.');
                      flag=1;
                   }
                   else if(isNaN(digit3_2))
                   {
                      $('#err_digit3_2').html('Invalid field value.');
                      flag=1;
                   }
                   if($.trim(answer3)=='')
                   {
                      $('#err_answer3').html('This field is required.');
                      flag=1;
                   }
                   else if(isNaN(answer3))
                   {
                      $('#err_answer3').html('Invalid field value.');
                      flag=1;
                   }
               }

               if(flQuestion4 != '')
               {
                   if(!(flQuestion4Ext == "jpg" || flQuestion4Ext == "jpeg" || flQuestion4Ext == "gif" || flQuestion4Ext == "png" || flQuestion4Ext == "GIF" || flQuestion4Ext == "JPG" || flQuestion4Ext == "JPEG" || flQuestion4Ext == "PNG"))
                   {
                       $('#err_flQuestion4').html('Invalid file type.');
                       flag=1;
                   }
                   else if($('#flQuestion4').attr('data-error')=='yes')
                   {
                      $('#err_flQuestion4').html('File must be grater than / equal to 504 X 67.');
                      flag=1;  
                   }
                   if($.trim(digit4_1)=='')
                   {
                      $('#err_digit4_1').html('This field is required.');
                      flag=1;
                   }
                   else if(isNaN(digit4_1))
                   {
                      $('#err_digit4_1').html('Invalid field value.');
                      flag=1;
                   }
                   if($.trim(operator4)=='')
                   {
                      $('#err_operator4').html('This field is required.');
                      flag=1;
                   }
                   if($.trim(digit4_2)=='')
                   {
                      $('#err_digit4_2').html('This field is required.');
                      flag=1;
                   }
                   else if(isNaN(digit4_2))
                   {
                      $('#err_digit4_2').html('Invalid field value.');
                      flag=1;
                   }
                   if($.trim(answer4)=='')
                   {
                      $('#err_answer4').html('This field is required.');
                      flag=1;
                   }
                   else if(isNaN(answer4))
                   {
                      $('#err_answer4').html('Invalid field value.');
                      flag=1;
                   }
               }
               if($.trim(digit4_1)!='' || $.trim(operator4)!='' || $.trim(digit4_2)!='' || $.trim(answer4)!='')
               {
                   if(flQuestion4 == '')
                   {
                       $('#err_flQuestion4').html('This field is required.');
                       flag = 1;
                   }
                   else if(!(flQuestion4Ext == "jpg" || flQuestion4Ext == "jpeg" || flQuestion4Ext == "gif" || flQuestion4Ext == "png" || flQuestion4Ext == "GIF" || flQuestion4Ext == "JPG" || flQuestion4Ext == "JPEG" || flQuestion4Ext == "PNG"))
                   {
                       $('#err_flQuestion4').html('Invalid file type.');
                       flag=1;
                   }
                   else if($('#flQuestion4').attr('data-error')=='yes')
                   {
                      $('#err_flQuestion4').html('File must be grater than / equal to 504 X 67.');
                      flag=1;  
                   }
                   if($.trim(digit4_1)=='')
                   {
                      $('#err_digit4_1').html('This field is required.');
                      flag=1;
                   }
                   else if(isNaN(digit4_1))
                   {
                      $('#err_digit4_1').html('Invalid field value.');
                      flag=1;
                   }
                   if($.trim(operator4)=='')
                   {
                      $('#err_operator4').html('This field is required.');
                      flag=1;
                   }
                   if($.trim(digit4_2)=='')
                   {
                      $('#err_digit4_2').html('This field is required.');
                      flag=1;
                   }
                   else if(isNaN(digit4_2))
                   {
                      $('#err_digit4_2').html('Invalid field value.');
                      flag=1;
                   }
                   if($.trim(answer4)=='')
                   {
                      $('#err_answer4').html('This field is required.');
                      flag=1;
                   }
                   else if(isNaN(answer4))
                   {
                      $('#err_answer4').html('Invalid field value.');
                      flag=1;
                   }
               }

               /*if(flHorn == '')
               {
                   $('#err_flHorn').html('This field is required.');
                   flag = 1;
               }
               else if(!(flHornExt == "mp3" || flHornExt == "MP3" || flHornExt == "wave" || flHornExt == "m4a"))
               {
                   $('#err_flHorn').html('Invalid file type.');
                   flag = 1;
               }*/

               if($.trim(duration)=='' || parseInt(duration)==0)
               {
                  $('#err_duration').html('This field is required.');
                  flag = 1;
               }
               else if(isNaN(duration))
               {
                  $('#err_duration').html('Invalid time.');
                  flag = 1;
               }
               
           }

           else if(parseInt(hiddenTemplate)==38)
           {
              var direction = $('#direction').val();
              var flQuestion1 = $('#flQuestion1').val();
              var flQuestion1Ext = flQuestion1.substring(flQuestion1.lastIndexOf('.') + 1);
              var question1 = $('#question1').val();
              var answer1 = $('#answer1').val();
              var question2 = $('#question2').val();
              var answer2 = $('#answer2').val();
              var question3 = $('#question3').val();
              var answer3 = $('#answer3').val();
              var question4 = $('#question4').val();
              var answer4 = $('#answer4').val();
              /*var flHorn   = $('#flHorn').val();
              var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);*/
              var duration = $('#duration').val();

              $('#err_direction').html('');
              $('#err_flQuestion1').html('');
              $('#err_question1').html('');
              $('#err_answer1').html('');
              $('#err_question2').html('');
              $('#err_answer2').html('');
              $('#err_question3').html('');
              $('#err_answer3').html('');
              $('#err_question4').html('');
              $('#err_answer4').html('');
              /*$('#err_flHorn').html('');*/
              $('#err_duration').html('');

               if($.trim(direction)=='')
               {
                  $('#err_direction').html('This field is required.');
                  flag = 1;  
               }

               if(flQuestion1 == '')
               {
                   $('#err_flQuestion1').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion1Ext == "jpg" || flQuestion1Ext == "jpeg" || flQuestion1Ext == "gif" || flQuestion1Ext == "png" || flQuestion1Ext == "GIF" || flQuestion1Ext == "JPG" || flQuestion1Ext == "JPEG" || flQuestion1Ext == "PNG"))
               {
                   $('#err_flQuestion1').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion1').attr('data-error')=='yes')
               {
                  $('#err_flQuestion1').html('File must be grater than / equal to 498 X 384.');
                  flag=1;  
               }

               if($.trim(question1)=='')
               {
                  $('#err_question1').html('This field is required.');
                  flag = 1;  
               }
               if($.trim(answer1)=='')
               {
                  $('#err_answer1').html('This field is required.');
                  flag = 1;  
               }

               if($.trim(question2)!='')
               {
                  if($.trim(answer2)=='')
                  {
                     $('#err_answer2').html('This field is required.');
                     flag = 1;  
                  }
               }
               if($.trim(answer2)!='')
               {
                   if($.trim(question2)=='')
                   {
                      $('#err_question2').html('This field is required.');
                      flag = 1;  
                   }
               }


               if($.trim(question3)!='')
               {
                   if($.trim(answer3)=='')
                   {
                      $('#err_answer3').html('This field is required.');
                      flag = 1;  
                   }
               }
               if($.trim(answer3)!='')
               {
                   if($.trim(question3)=='')
                   {
                      $('#err_question3').html('This field is required.');
                      flag = 1;  
                   }
               }

               if($.trim(question4)!='')
               {
                   if($.trim(answer4)=='')
                   {
                      $('#err_answer4').html('This field is required.');
                      flag = 1;  
                   }
               }
               if($.trim(answer4)!='')
               {
                   if($.trim(question4)=='')
                   {
                      $('#err_question4').html('This field is required.');
                      flag = 1;  
                   }
               }

               /*if(flHorn == '')
               {
                   $('#err_flHorn').html('This field is required.');
                   flag = 1;
               }
               else if(!(flHornExt == "mp3" || flHornExt == "MP3" || flHornExt == "wave" || flHornExt == "m4a"))
               {
                   $('#err_flHorn').html('Invalid file type.');
                   flag = 1;
               }*/

               if($.trim(duration)=='' || parseInt(duration)==0)
               {
                  $('#err_duration').html('This field is required.');
                  flag = 1;
               }
               else if(isNaN(duration))
               {
                  $('#err_duration').html('Invalid time.');
                  flag = 1;
               }
           }

           else if(parseInt(hiddenTemplate)==39)
           {
              var direction = $('#direction').val();
              /*var flHorn   = $('#flHorn').val();
              var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);*/
              var duration = $('#duration').val();

              $('#err_direction').html('');
              $('#err_duration').html('');

              /*$('#err_flHorn').html('');*/

              for (var i = 1; i <= 6; i++)
              {
                var digit1 = $('#digit'+i+'_1').val();
                var operator = $('#operator'+i).val();
                var digit2 = $('#digit'+i+'_2').val();
                var answer = $('#answer'+i).val();
                
                $('#err_digit'+i+'_1').html('');
                $('#err_operator'+i).html('');
                $('#err_digit'+i+'_2').html('');
                $('#err_answer'+i).html('');

                if(i==1)
                {
                  if($.trim(digit1)=='')
                  {
                      $('#err_digit'+i+'_1').html('This field is required.');
                      flag = 1;    
                  }
                  else if(isNaN(digit1))
                  {
                    $('#err_digit'+i+'_1').html('Invalid field value.');
                    flag = 1;  
                  }
                  if($.trim(operator)=='')
                  {
                    $('#err_operator'+i).html('This field is required.');
                    flag = 1;  
                  }
                  if($.trim(digit2)=='')
                  {
                      $('#err_digit'+i+'_2').html('This field is required.');
                      flag = 1;    
                  }
                  else if(isNaN(digit2))
                  {
                    $('#err_digit'+i+'_2').html('Invalid field value.');
                    flag = 1;  
                  }
                  if($.trim(answer)=='')
                  {
                    $('#err_answer'+i).html('This field is required.');
                    flag = 1;  
                  }
                  else if(isNaN(answer))
                  {
                    $('#err_answer'+i).html('Invalid field value.');
                    flag = 1;  
                  }
                }
                else
                {
                  if(digit1!='' || operator!='' || digit2!='' || answer!='')
                  {
                    if($.trim(digit1)=='')
                    {
                        $('#err_digit'+i+'_1').html('This field is required.');
                        flag = 1;    
                    }
                    else if(isNaN(digit1))
                    {
                      $('#err_digit'+i+'_1').html('Invalid field value.');
                      flag = 1;  
                    }
                    if($.trim(operator)=='')
                    {
                      $('#err_operator'+i).html('This field is required.');
                      flag = 1;  
                    }
                    if($.trim(digit2)=='')
                    {
                        $('#err_digit'+i+'_2').html('This field is required.');
                        flag = 1;    
                    }
                    else if(isNaN(digit2))
                    {
                      $('#err_digit'+i+'_2').html('Invalid field value.');
                      flag = 1;  
                    }
                    if($.trim(answer)=='')
                    {
                      $('#err_answer'+i).html('This field is required.');
                      flag = 1;  
                    }
                    else if(isNaN(answer))
                    {
                      $('#err_answer'+i).html('Invalid field value.');
                      flag = 1;  
                    }
                  }
                }
              }

               if($.trim(direction)=='')
               {
                  $('#err_direction').html('This field is required.');
                  flag = 1;  
               }

               /*if(flHorn == '')
               {
                   $('#err_flHorn').html('This field is required.');
                   flag = 1;
               }
               else if(!(flHornExt == "mp3" || flHornExt == "MP3" || flHornExt == "wave" || flHornExt == "m4a"))
               {
                   $('#err_flHorn').html('Invalid file type.');
                   flag = 1;
               }*/
               if($.trim(duration)=='' || parseInt(duration)==0)
               {
                  $('#err_duration').html('This field is required.');
                  flag = 1;
               }
               else if(isNaN(duration))
               {
                  $('#err_duration').html('Invalid time.');
                  flag = 1;
               }
           }

           else if(parseInt(hiddenTemplate)==40)
           {
              var direction = $('#direction').val();
              
              var question1_1=CKEDITOR.instances['question1_1'].getData().replace(/<[^>]*>/gi, '').length;
              var question1_2=CKEDITOR.instances['question1_2'].getData().replace(/<[^>]*>/gi, '').length;
              var operator1 = $('#operator1').val();
              
              /*var flHorn   = $('#flHorn').val();
              var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);*/
              var duration = $('#duration').val();

              $('#err_direction').html('');

              $('#err_question1_1').html('');
              $('#err_question1_2').html('');
              $('#err_operator1').html('');
              
              /*$('#err_flHorn').html('');*/

              $('#err_duration').html('');
              
               if($.trim(direction)=='')
               {
                   $('#err_direction').html('This field is required.');
                   flag = 1;
               }

               if(question1_1=='')
               {
                   $('#err_question1_1').html('This field is required.');
                   flag = 1;
               }
               if(question1_2=='')
               {
                   $('#err_question1_2').html('This field is required.');
                   flag = 1;
               }
               if(operator1=='')
               {
                   $('#err_operator1').html('This field is required.');
                   flag = 1;
               }

              for (var i = 2; i <= 6; i++)
              {
                   var question1=CKEDITOR.instances['question'+i+'_1'].getData().replace(/<[^>]*>/gi, '').length;
                   var question2=CKEDITOR.instances['question'+i+'_2'].getData().replace(/<[^>]*>/gi, '').length;
                   var operator = $('#operator'+i).val();
                   console.log(operator);
                    $('#err_question'+i+'_1').html('');
                    $('#err_question'+i+'_2').html('');
                    $('#err_operator'+i).html('');

                    if($.trim(question1)!=0 || $.trim(question2)!=0 || $.trim(operator)!='')
                    {
                       if(question1=='')
                       {
                           $('#err_question'+i+'_1').html('This field is required.');
                           flag = 1;
                       }
                       if(question2=='')
                       {
                           $('#err_question'+i+'_2').html('This field is required.');
                           flag = 1;
                       }
                       if(operator=='')
                       {
                           $('#err_operator'+i).html('This field is required.');
                           flag = 1;
                       }
                    }

                  
                   if($.trim(duration)=='' || parseInt(duration)==0)
                   {
                      $('#err_duration').html('This field is required.');
                      flag = 1;
                   }
                   else if(isNaN(duration))
                   {
                      $('#err_duration').html('Invalid time.');
                      flag = 1;
                   }
              }
           }

           else if(parseInt(hiddenTemplate)==41)
           {
              var direction = $('#direction').val();
              
              var question1_1 = CKEDITOR.instances['question1_1'].getData().replace(/<[^>]*>/gi, '').length;
              var question1_2 = CKEDITOR.instances['question1_2'].getData().replace(/<[^>]*>/gi, '').length;
              var operator1   = $('#operator1').val();

              var duration = $('#duration').val();

              $('#err_direction').html('');
              $('#err_question1_1').html('');
              $('#err_question1_2').html('');
              $('#err_operator1').html('');

               if($.trim(direction)=='')
               {
                   $('#err_direction').html('This field is required.');
                   flag = 1;
               }

               if(question1_1=='')
               {
                   $('#err_question1_1').html('This field is required.');
                   flag = 1;
               }
               if(question1_2=='')
               {
                   $('#err_question1_2').html('This field is required.');
                   flag = 1;
               }
               if(operator1=='')
               {
                   $('#err_operator1').html('This field is required.');
                   flag = 1;
               }
              for(var i = 2; i <= 6; i++)
              {
                  $('#err_question'+i+'_1').html('');
                  $('#err_question'+i+'_2').html('');
                  $('#err_operator'+i).html('');
                  
                  var question1   = CKEDITOR.instances['question'+i+'_1'].getData().replace(/<[^>]*>/gi, '').length;
                  var question2   = CKEDITOR.instances['question'+i+'_2'].getData().replace(/<[^>]*>/gi, '').length;
                  var operator2   = $('#operator'+i).val();
                  if($.trim(question1)!=0 || $.trim(question2)!=0 || $.trim(operator2)!='')
                  {
                     if(question1=='')
                     {
                         $('#err_question'+i+'_1').html('This field is required.');
                         flag = 1;
                     }
                     if(question2=='')
                     {
                         $('#err_question'+i+'_2').html('This field is required.');
                         flag = 1;
                     }
                     if(operator2=='')
                     {
                         $('#err_operator'+i).html('This field is required.');
                         flag = 1;
                     }
                  }
              }
               /*if(flHorn == '')
               {
                   $('#err_flHorn').html('This field is required.');
                   flag = 1;
               }
               else if(!(flHornExt == "mp3" || flHornExt == "MP3" || flHornExt == "wave" || flHornExt == "m4a"))
               {
                   $('#err_flHorn').html('Invalid file type.');
                   flag = 1;
               }*/
               if($.trim(duration)=='' || parseInt(duration)==0)
               {
                  $('#err_duration').html('This field is required.');
                  flag = 1;
               }
               else if(isNaN(duration))
               {
                  $('#err_duration').html('Invalid time.');
                  flag = 1;
               }
              
           }

           else if(parseInt(hiddenTemplate)==42)
           {
              var direction = $('#direction').val();
              
              var question1_1=CKEDITOR.instances['question1_1'].getData().replace(/<[^>]*>/gi, '').length;
              var answer1_1 = $('#answer1_1').val();
              var answer1_2 = $('#answer1_2').val();
              
              /*var flHorn   = $('#flHorn').val();
              var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);*/
              var duration = $('#duration').val();

              $('#err_direction').html('');

              $('#err_question1_1').html('');
              $('#err_answer1_1').html('');
              $('#err_answer1_2').html('');

              
              /*$('#err_flHorn').html('');*/

              $('#err_duration').html('');
              
               if($.trim(direction)=='')
               {
                   $('#err_direction').html('This field is required.');
                   flag = 1;
               }

               if(question1_1=='')
               {
                   $('#err_question1_1').html('This field is required.');
                   flag = 1;
               }
               if(answer1_1=='')
               {
                   $('#err_answer1_1').html('This field is required.');
                   flag = 1;
               }
               else if(isNaN(answer1_1))
               {
                   $('#err_answer1_1').html('Invalid field value.');
                   flag = 1;
               }
               if(answer1_2=='')
               {
                   $('#err_answer1_2').html('This field is required.');
                   flag = 1;
               }
               else if(isNaN(answer1_2))
               {
                   $('#err_answer1_2').html('Invalid field value.');
                   flag = 1;
               }
               for (var i = 2; i <= 6; i++)
               {

                  var question  =CKEDITOR.instances['question'+i+'_1'].getData().replace(/<[^>]*>/gi, '').length;
                  var answer1 = $('#answer'+i+'_1').val();
                  var answer2 = $('#answer'+i+'_2').val();

                  $('#err_question'+i+'_1').html('');
                  $('#err_answer'+i+'_1').html('');
                  $('#err_answer'+i+'_2').html('');

                  if($.trim(question)!=0 || $.trim(answer1)!='' || $.trim(answer2)!='')
                  {
                     if(question=='')
                     {
                         $('#err_question'+i+'_1').html('This field is required.');
                         flag = 1;
                     }
                     if(answer1=='')
                     {
                         $('#err_answer'+i+'_1').html('This field is required.');
                         flag = 1;
                     }
                     else if(isNaN(answer1))
                     {
                         $('#err_answer'+i+'_1').html('Invalid field value.');
                         flag = 1;
                     }
                     if(answer2=='')
                     {
                         $('#err_answer'+i+'_2').html('This field is required.');
                         flag = 1;
                     }
                     else if(isNaN(answer2))
                     {
                         $('#err_answer'+i+'_2').html('Invalid field value.');
                         flag = 1;
                     }
                  }
                }
                if($.trim(duration)=='' || parseInt(duration)==0)
                {
                    $('#err_duration').html('This field is required.');
                    flag = 1;
                }
                else if(isNaN(duration))
                {
                    $('#err_duration').html('Invalid time.');
                    flag = 1;
                }
              
           }

           else if(parseInt(hiddenTemplate)==43)
           {
              var direction = $('#direction').val();

              var flQuestion = $('#flQuestion').val();
              var flQuestionExt = flQuestion.substring(flQuestion.lastIndexOf('.')+1);
              
              var question1 = $('#question1').val();
              var answer1 = $('#answer1').val();

              var question2 = $('#question2').val();
              var answer2 = $('#answer2').val();

              var question3 = $('#question3').val();
              var answer3 = $('#answer3').val();

              /*var flHorn   = $('#flHorn').val();
              var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);*/
              var duration = $('#duration').val();

              $('#err_direction').html('');
              $('#err_flQuestion').html('');

              $('#err_question1').html('');
              $('#err_answer1').html('');

              $('#err_question2').html('');
              $('#err_answer2').html('');

              $('#err_question3').html('');
              $('#err_answer3').html('');

              /*$('#err_flHorn').html('');*/

              $('#err_duration').html('');

               if($.trim(direction)=='')
               {
                  $('#err_direction').html('This field is required.');
                  flag = 1;  
               }

               if(flQuestion == '')
               {
                   $('#err_flQuestion').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestionExt == "jpg" || flQuestionExt == "jpeg" || flQuestionExt == "gif" || flQuestionExt == "png" || flQuestionExt == "GIF" || flQuestionExt == "JPG" || flQuestionExt == "JPEG" || flQuestionExt == "PNG"))
               {
                   $('#err_flQuestion').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion').attr('data-error')=='yes')
               {
                  $('#err_flQuestion').html('File must be grater than / equal to 570 X 540.');
                  flag=1;  
               }

               if($.trim(question1)=='')
               {
                  $('#err_question1').html('This field is required.');
                  flag = 1;  
               }
               else
               {
                  var questionAnsArr = question1.match(/#BLANK#/g);
                  if(questionAnsArr==null)
                  {
                    $('#err_question1').html('#BLANK# is missing');
                    flag = 1;    
                  }
                  /*else
                  {
                    var questionAnsCount = questionAnsArr.length;  
                    if(parseInt(questionAnsCount)!=1)
                    {
                      $('#err_question1').html('Only one #BLANK# is allowed');
                      flag = 1;       
                    }
                  }*/
               }
               if($.trim(answer1)=='')
               {
                  $('#err_answer1').html('This field is required.');
                  flag = 1;  
               }
               else
               {
                   if($.trim(question1)!='')
                   {
                      var questionAnsArr = question1.match(/#BLANK#/g);
                      var questionAnsCount = questionAnsArr.length;
                      var answerCount = answer1.split(',').length;
                      if(parseInt(answerCount) != parseInt(questionAnsCount))
                      {
                        $('#err_answer1').html('Please enter all answers.');
                        flag = 1;          
                      }
                   }  
                   else
                   {
                    $('#err_question1').html('This field is required.');
                      flag = 1;  
                   }              
               }

               if($.trim(answer2)!='')
               {
                 if($.trim(question2)=='')
                 {
                    $('#err_question2').html('This field is required.');
                    flag = 1;  
                 }
                 else
                 {
                    var questionAnsArr = question2.match(/#BLANK#/g);
                    if(questionAnsArr==null)
                    {
                      $('#err_question2').html('#BLANK# is missing');
                      flag = 1;    
                    }
                 }
               }

               if($.trim(question2)!='')
               {
                 if($.trim(answer2)=='')
                 {
                    $('#err_answer2').html('This field is required.');
                    flag = 1;  
                 }
                 else
                 {
                     if($.trim(question2)!='')
                     {
                        var questionAnsArr = question2.match(/#BLANK#/g);
                        var questionAnsCount = questionAnsArr.length;
                        var answerCount = answer2.split(',').length;
                        if(parseInt(answerCount) != parseInt(questionAnsCount))
                        {
                          $('#err_answer2').html('Please enter all answers.');
                          flag = 1;          
                        }
                     }  
                     else
                     {
                      $('#err_question2').html('This field is required.');
                        flag = 1;  
                     }              
                 }
               }
               
               if($.trim(answer3)!='')
               {
                 if($.trim(question3)=='')
                 {
                    $('#err_question3').html('This field is required.');
                    flag = 1;  
                 }
                 else
                 {
                    var questionAnsArr = question3.match(/#BLANK#/g);
                    if(questionAnsArr==null)
                    {
                      $('#err_question3').html('#BLANK# is missing');
                      flag = 1;    
                    }
                 }
               }
               
               if($.trim(question3)!='')
               {
                 if($.trim(answer3)=='')
                 {
                    $('#err_answer3').html('This field is required.');
                    flag = 1;  
                 }
                 else
                 {
                     if($.trim(question3)!='')
                     {
                        var questionAnsArr = question3.match(/#BLANK#/g);
                        var questionAnsCount = questionAnsArr.length;
                        var answerCount = answer3.split(',').length;
                        if(parseInt(answerCount) != parseInt(questionAnsCount))
                        {
                          $('#err_answer3').html('Please enter all answers.');
                          flag = 1;          
                        }
                     }  
                     else
                     {
                      $('#err_question3').html('This field is required.');
                        flag = 1;  
                     }              
                 }
               }
               
               /*if(flHorn == '')
               {
                   $('#err_flHorn').html('This field is required.');
                   flag = 1;
               }
               else if(!(flHornExt == "mp3" || flHornExt == "MP3" || flHornExt == "wave" || flHornExt == "m4a"))
               {
                   $('#err_flHorn').html('Invalid file type.');
                   flag = 1;
               }*/

               if($.trim(duration)=='' || parseInt(duration)==0)
               {
                  $('#err_duration').html('This field is required.');
                  flag = 1;
               }
               else if(isNaN(duration))
               {
                  $('#err_duration').html('Invalid time.');
                  flag = 1;
               }
           }
           else if(parseInt(hiddenTemplate)==44)
           {
              var row     = $('#row').val();
              var column  = $('#column').val();
              var direction = $('#direction').val();
              var digit1_1 = $('#digit1_1').val();
              var operator1 = $('#operator1').val();
              var digit1_2 = $('#digit1_2').val();
              var answer1 = $('#answer1').val();
              /*var flHorn   = $('#flHorn').val();
              var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);*/
              var duration = $('#duration').val();
                

              $('#err_row').html('')
              $('#err_column').html('');
              $('#err_direction').html('');
              $('#err_digit1_1').html('');
              $('#err_operator1').html('');
              $('#err_digit1_2').html('');
              $('#err_answer1').html('');
              /*$('#err_flHorn').html('');*/
              $('#err_duration').html('');

              // alert(digit1_1+'/'+row+'/'+column);
               if($.trim(direction)=='')
               {
                  $('#err_direction').html('This field is required.');
                  flag = 1;  
               }

               if($.trim(digit1_1)=='')
               {
                  $('#err_digit1_1').html('This field is required.');
                  flag=1;
               }
               else if(isNaN(digit1_1))
               {
                  $('#err_digit1_1').html('Invalid field value.');
                  flag=1;
               }
               else if(parseInt(digit1_1) < parseInt(row) || parseInt(digit1_1) > parseInt(column))
               {
                  $('#err_digit1_1').html('This field should be between '+row+' and '+column);
                  flag=1;
               }
               if($.trim(operator1)=='')
               {
                  $('#err_operator1').html('This field is required.');
                  flag=1;
               }
               if($.trim(digit1_2)=='')
               {
                  $('#err_digit1_2').html('This field is required.');
                  flag=1;
               }
               else if(isNaN(digit1_2))
               {
                  $('#err_digit1_2').html('Invalid field value.');
                  flag=1;
               }
               else if(digit1_2>10)
               {
                  $('#err_digit1_2').html('Second digit should be less than equal to 10');
                  flag=1;
               }
               if($.trim(answer1)=='')
               {
                  $('#err_answer1').html('This field is required.');
                  flag=1;
               }
               else if(isNaN(answer1))
               {
                  $('#err_answer1').html('Invalid field value.');
                  flag=1;
               }
            
             if(row=='')
              {
                  $('#err_row').html('This field is required');
                  flag = 0;
              }
              if(column=='')
              {
                  $('#err_column').html('This field is required');
                  flag = 0;
              }
              if((column-row)>10)
              {
                  $('#err_row').html('Can\'t generate more than 10 tables');
                  flag = 0;
              }

              if($.trim(duration)=='' || parseInt(duration)==0)
               {
                  $('#err_duration').html('This field is required.');
                  flag = 1;
               }
               else if(isNaN(duration))
               {
                  $('#err_duration').html('Invalid time.');
                  flag = 1;
               }
           }
           else if(parseInt(hiddenTemplate)==45)
           {
              var direction = $('#direction').val();

              var flQuestion1 = $('#flQuestion1').val();
              var flQuestion1Ext = flQuestion1.substring(flQuestion1.lastIndexOf('.')+1);
              var question1_1 = $('#question1_1').val();
              var answer1_1 = $('#answer1_1').val();
              var question1_2 = $('#question1_2').val();
              var answer1_2 = $('#answer1_2').val();
              var question1_3 = $('#question1_3').val();
              var answer1_3 = $('#answer1_3').val();

              var flQuestion2 = $('#flQuestion2').val();
              var flQuestion2Ext = flQuestion2.substring(flQuestion2.lastIndexOf('.')+1);
              var question2_1 = $('#question2_1').val();
              var answer2_1 = $('#answer2_1').val();
              var question2_2 = $('#question2_2').val();
              var answer2_2 = $('#answer2_2').val();
              var question2_3 = $('#question2_3').val();
              var answer2_3 = $('#answer2_3').val();

              /*var flHorn   = $('#flHorn').val();
              var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);*/
              var duration = $('#duration').val();

              $('#err_direction').html('');
              
              $('#err_flQuestion1').html('');
              $('#err_question1_1').html('');
              $('#err_answer1_1').html('');
              $('#err_question1_2').html('');
              $('#err_answer1_2').html('');
              $('#err_question1_3').html('');
              $('#err_answer1_3').html('');

              $('#err_flQuestion2').html('');
              $('#err_question2_1').html('');
              $('#err_answer2_1').html('');
              $('#err_question2_2').html('');
              $('#err_answer2_2').html('');
              $('#err_question2_3').html('');
              $('#err_answer2_3').html('');

              /*$('#err_flHorn').html('');*/
              $('#err_duration').html('');

               if($.trim(direction)=='')
               {
                  $('#err_direction').html('This field is required.');
                  flag = 1;  
               }

               /*Question : 1*/
               if(flQuestion1 == '')
               {
                   $('#err_flQuestion1').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion1Ext == "jpg" || flQuestion1Ext == "jpeg" || flQuestion1Ext == "gif" || flQuestion1Ext == "png" || flQuestion1Ext == "GIF" || flQuestion1Ext == "JPG" || flQuestion1Ext == "JPEG" || flQuestion1Ext == "PNG"))
               {
                   $('#err_flQuestion1').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion1').attr('data-error')=='yes')
               {
                  $('#err_flQuestion1').html('File must be grater than / equal to 429 X 269.');
                  flag=1;  
               }

               if($.trim(question1_1)=='')
               {
                  $('#err_question1_1').html('This field is required.');
                  flag = 1;  
               }
               else
               {
                  var questionAnsArr = question1_1.match(/#BLANK#/g);
                  if(questionAnsArr==null)
                  {
                    $('#err_question1_1').html('#BLANK# is missing');
                    flag = 1;    
                  }
                  /*else
                  {
                    var questionAnsCount = questionAnsArr.length;  
                    if(parseInt(questionAnsCount)!=1)
                    {
                      $('#err_question1_1').html('Only one #BLANK# is allowed');
                      flag = 1;       
                    }
                  }*/
               }
               if($.trim(answer1_1)=='')
               {
                  $('#err_answer1_1').html('This field is required.');
                  flag = 1;  
               }
               else
               {
                   if($.trim(question1_1)!='')
                   {
                      var questionAnsArr = question1_1.match(/#BLANK#/g);
                      var questionAnsCount = questionAnsArr.length;
                      var answerCount = answer1_1.split(',').length;
                      if(parseInt(answerCount) != parseInt(questionAnsCount))
                      {
                        $('#err_answer1_1').html('Please enter all answers.');
                        flag = 1;          
                      }
                   }  
                   else
                   {
                    $('#err_question1_1').html('This field is required.');
                      flag = 1;  
                   }              
               }
               
               if($.trim(question1_2)!='' || $.trim(answer1_2)!='')
               {
                 if($.trim(question1_2)=='')
                 {
                    $('#err_question1_2').html('This field is required.');
                    flag = 1;  
                 }
                 else
                 {
                    var questionAnsArr = question1_2.match(/#BLANK#/g);
                    if(questionAnsArr==null)
                    {
                      $('#err_question1_2').html('#BLANK# is missing');
                      flag = 1;    
                    }
                 }

                 if($.trim(answer1_2)=='')
                 {
                    $('#err_answer1_2').html('This field is required.');
                    flag = 1;  
                 }
                 else
                 {
                     if($.trim(question1_2)!='')
                     {
                        var questionAnsArr = question1_2.match(/#BLANK#/g);
                        var questionAnsCount = questionAnsArr.length;
                        var answerCount = answer1_2.split(',').length;
                        if(parseInt(answerCount) != parseInt(questionAnsCount))
                        {
                          $('#err_answer1_2').html('Please enter all answers.');
                          flag = 1;          
                        }
                     }  
                     else
                     {
                      $('#err_question1_2').html('This field is required.');
                        flag = 1;  
                     }              
                 }
               }

               if($.trim(question1_3)!='' || $.trim(answer1_3)!='')
               {
                   if($.trim(question1_3)=='')
                   {
                      $('#err_question1_3').html('This field is required.');
                      flag = 1;  
                   }
                   else
                   {
                      var questionAnsArr = question1_3.match(/#BLANK#/g);
                      if(questionAnsArr==null)
                      {
                        $('#err_question1_3').html('#BLANK# is missing');
                        flag = 1;    
                      }
                   }
                   if($.trim(answer1_3)=='')
                   {
                      $('#err_answer1_3').html('This field is required.');
                      flag = 1;  
                   }
                   else
                   {
                       if($.trim(question1_3)!='')
                       {
                          var questionAnsArr = question1_3.match(/#BLANK#/g);
                          var questionAnsCount = questionAnsArr.length;
                          var answerCount = answer1_3.split(',').length;
                          if(parseInt(answerCount) != parseInt(questionAnsCount))
                          {
                            $('#err_answer1_3').html('Please enter all answers.');
                            flag = 1;          
                          }
                       }  
                       else
                       {
                        $('#err_question1_3').html('This field is required.');
                          flag = 1;
                       }              
                   }
               }

               /*Question : 2*/
               if(flQuestion2 == '')
               {
                   $('#err_flQuestion2').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion2Ext == "jpg" || flQuestion2Ext == "jpeg" || flQuestion2Ext == "gif" || flQuestion2Ext == "png" || flQuestion2Ext == "GIF" || flQuestion2Ext == "JPG" || flQuestion2Ext == "JPEG" || flQuestion2Ext == "PNG"))
               {
                   $('#err_flQuestion2').html('Invalid file type.');
                   flag=1;
               }

               if($.trim(question2_1)=='')
               {
                  $('#err_question2_1').html('This field is required.');
                  flag = 1;  
               }
               else
               {
                  var questionAnsArr = question2_1.match(/#BLANK#/g);
                  if(questionAnsArr==null)
                  {
                    $('#err_question2_1').html('#BLANK# is missing');
                    flag = 1;    
                  }
                  /*else
                  {
                    var questionAnsCount = questionAnsArr.length;  
                    if(parseInt(questionAnsCount)!=1)
                    {
                      $('#err_question2_1').html('Only one #BLANK# is allowed');
                      flag = 1;       
                    }
                  }*/
               }
               if($.trim(answer2_1)=='')
               {
                  $('#err_answer2_1').html('This field is required.');
                  flag = 1;  
               }
               else
               {
                   if($.trim(question2_1)!='')
                   {
                      var questionAnsArr = question2_1.match(/#BLANK#/g);
                      var questionAnsCount = questionAnsArr.length;
                      var answerCount = answer2_1.split(',').length;
                      if(parseInt(answerCount) != parseInt(questionAnsCount))
                      {
                        $('#err_answer2_1').html('Please enter all answers.');
                        flag = 1;          
                      }
                   }  
                   else
                   {
                    $('#err_question2_1').html('This field is required.');
                      flag = 1;  
                   }              
               }
               
               if($.trim(question2_2)!='' || $.trim(answer2_2)!='')
               {
                 if($.trim(question2_2)=='')
                 {
                    $('#err_question2_2').html('This field is required.');
                    flag = 1;  
                 }
                 else
                 {
                    var questionAnsArr = question2_2.match(/#BLANK#/g);
                    if(questionAnsArr==null)
                    {
                      $('#err_question2_2').html('#BLANK# is missing');
                      flag = 1;    
                    }
                    
                 }

                 if($.trim(answer2_2)=='')
                 {
                    $('#err_answer2_2').html('This field is required.');
                    flag = 1;  
                 }
                 else
                 {
                     if($.trim(question2_2)!='')
                     {
                        var questionAnsArr = question2_2.match(/#BLANK#/g);
                        var questionAnsCount = questionAnsArr.length;
                        var answerCount = answer2_2.split(',').length;
                        if(parseInt(answerCount) != parseInt(questionAnsCount))
                        {
                          $('#err_answer2_2').html('Please enter all answers.');
                          flag = 1;          
                        }
                     }  
                     else
                     {
                      $('#err_question2_2').html('This field is required.');
                        flag = 1;  
                     }              
                 }
               }

               if($.trim(question2_3)!='' || $.trim(answer2_3)!='')
               {
                 if($.trim(question2_3)=='')
                 {
                    $('#err_question2_3').html('This field is required.');
                    flag = 1;  
                 }
                 else
                 {
                    var questionAnsArr = question2_3.match(/#BLANK#/g);
                    if(questionAnsArr==null)
                    {
                      $('#err_question2_3').html('#BLANK# is missing');
                      flag = 1;    
                    }
                    /*else
                    {
                      var questionAnsCount = questionAnsArr.length;  
                      if(parseInt(questionAnsCount)!=1)
                      {
                        $('#err_question2_3').html('Only one #BLANK# is allowed');
                        flag = 1;       
                      }
                    }*/
                 }
                 if($.trim(answer2_3)=='')
                 {
                    $('#err_answer2_3').html('This field is required.');
                    flag = 1;  
                 }
                 else
                 {
                     if($.trim(question2_3)!='')
                     {
                        var questionAnsArr = question2_3.match(/#BLANK#/g);
                        var questionAnsCount = questionAnsArr.length;
                        var answerCount = answer2_3.split(',').length;
                        if(parseInt(answerCount) != parseInt(questionAnsCount))
                        {
                          $('#err_answer2_3').html('Please enter all answers.');
                          flag = 1;          
                        }
                     }  
                     else
                     {
                      $('#err_question2_3').html('This field is required.');
                        flag = 1;  
                     }              
                 }
               }
             
               if($.trim(duration)=='' || parseInt(duration)==0)
               {
                  $('#err_duration').html('This field is required.');
                  flag = 1;
               }
               else if(isNaN(duration))
               {
                  $('#err_duration').html('Invalid time.');
                  flag = 1;
               }
           }

           else if(parseInt(hiddenTemplate)==46)
           {
              var direction = $('#direction').val();
              var flQuestion1 = $('#flQuestion1').val();
              var flQuestion1Ext = flQuestion1.substring(flQuestion1.lastIndexOf('.') + 1);
              var question1 = $('#question1').val();
              var answer1   = $('#answer1').val();

              var duration = $('#duration').val();

              $('#err_direction').html('');
              $('#err_flQuestion1').html('');
              $('#err_question1').html('');
              $('#err_answer1').html('');
              $('#err_question2').html('');
              $('#err_answer2').html('');
              
              /*$('#err_flHorn').html('');*/
              $('#err_duration').html('');

               if($.trim(direction)=='')
               {
                  $('#err_direction').html('This field is required.');
                  flag = 1;  
               }

               if(flQuestion1 == '')
               {
                   $('#err_flQuestion1').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion1Ext == "jpg" || flQuestion1Ext == "jpeg" || flQuestion1Ext == "gif" || flQuestion1Ext == "png" || flQuestion1Ext == "GIF" || flQuestion1Ext == "JPG" || flQuestion1Ext == "JPEG" || flQuestion1Ext == "PNG"))
               {
                   $('#err_flQuestion1').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion1').attr('data-error')=='yes')
               {
                  $('#err_flQuestion1').html('File must be grater than / equal to 570 X 442.');
                  flag=1;  
               }

               if($.trim(question1)=='')
               {
                  $('#err_question1').html('This field is required.');
                  flag = 1;  
               }
               if($.trim(answer1)=='')
               {
                  $('#err_answer1').html('This field is required.');
                  flag = 1;  
               }
               for (var i = 2; i <= 5; i++)
               {
                  var question  = $('#question'+i).val();
                  var answer    = $('#answer'+i).val();
                  if($.trim(question)!='' || $.trim(answer)!='')
                  {
                     if($.trim(question)=='')
                     {
                        $('#err_question'+i).html('This field is required.');
                        flag = 1;  
                     }
                     if($.trim(answer)=='')
                     {
                        $('#err_answer'+i).html('This field is required.');
                        flag = 1;  
                     }
                  }
               }
               if($.trim(duration)=='' || parseInt(duration)==0)
               {
                  $('#err_duration').html('This field is required.');
                  flag = 1;
               }
               else if(isNaN(duration))
               {
                  $('#err_duration').html('Invalid time.');
                  flag = 1;
               }

           }
           else if(parseInt(hiddenTemplate)==47)
           {
              var direction = $('#direction').val();
              var questionFlag = 0;
              var chkBlankLetterFlag = 0;
              var duration = $('#duration').val();
              
              $('#err_direction').html('');
              $('#err_duration').html('');

              if($.trim(direction)=='')
              {
                  $('#err_direction').html('This field is required.');
                  flag = 1;
              }

              $('.classQuestion').each(function(){
                if($(this).val() == '')
                {
                  questionFlag = 1;
                }
              });

              if(parseInt(questionFlag) == 1)
              {
                swal('Please enter all question values.');
                flag = 1;
              }

              $('.chkBlankLetter').each(function(){
                if($(this).prop("checked") == true)
                {
                  chkBlankLetterFlag = 1;
                }
              });

              if(parseInt(chkBlankLetterFlag) == 0)
              {
                swal('Please check atleast one checkbox.');
                flag = 1;
              }


              if($.trim(duration)=='' || parseInt(duration)==0)
              {
                  $('#err_duration').html('This field is required.');
                  flag = 1;
              }
              else if(isNaN(duration))
              {
                  $('#err_duration').html('Invalid time.');
                  flag = 1;
              }
           }
           else if(parseInt(hiddenTemplate)==48)
           {
               var direction = $('#direction').val();
               var question = $('#question').val();
               /*var flHorn   = $('#flHorn').val();
               var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);*/
               var duration = $('#duration').val();
   
               $('#err_direction').html('');
               $('#err_question').html('');
               /*$('#err_flHorn').html('');*/
               $('#err_chkBlankLetter').html('');
               $('#err_duration').html('');

               if($.trim(direction)=='')
               {
                   $('#err_direction').html('This field is required.');
                   flag = 1;
               }
               if($.trim(question)=='')
               {
                   $('#err_question').html('This field is required.');
                   flag = 1;
               }
               else
               {
                  if($('input[name="chkBlankLetter[]"]:checked').length == 0)
                  {
                    $('#err_chkBlankLetter').html('Please checked atleast one checkbox');
                    flag = 1;    
                  }
               }

               /*if(flHorn == '')
               {
                   $('#err_flHorn').html('This field is required.');
                   flag = 1;
               }
               else if(!(flHornExt == "mp3" || flHornExt == "MP3" || flHornExt == "wave" || flHornExt == "m4a"))
               {
                   $('#err_flHorn').html('Invalid file type.');
                   flag = 1;
               }*/

               if($.trim(duration)=='' || parseInt(duration)==0)
               {
                  $('#err_duration').html('This field is required.');
                  flag = 1;
               }
               else if(isNaN(duration))
               {
                  $('#err_duration').html('Invalid time.');
                  flag = 1;
               }
           }
           else if(parseInt(hiddenTemplate)==49)
           {
              var direction = $('#direction').val();
              var question=CKEDITOR.instances['question'].getData().replace(/<[^>]*>/gi, '').length;
              var option_1=CKEDITOR.instances['option_1'].getData().replace(/<[^>]*>/gi, '').length;
            
              var rdoOption = $('input[name="rdoOption"]:checked').val();
              /*var flHorn   = $('#flHorn').val();
              var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);*/
              var duration = $('#duration').val();


              $('#err_direction').html('');
              $('#err_question').html('');
              /*$('#err_flHorn').html('');*/
              $('#err_duration').html('');
              
               if($.trim(direction)=='')
               {
                   $('#err_direction').html('This field is required.');
                   flag = 1;
               }

               if(question=='')
               {
                   $('#err_question').html('This field is required.');
                   flag = 1;
               }
                if(option_1=='')
               {
                   $('#err_option_1').html('This field is required.');
                   flag = 1;
               }
               for (var i = 2; i <=4; i++)
               {
                   $('#err_option_'+i).html('');
                   var option = CKEDITOR.instances['option_'+i].getData().replace(/<[^>]*>/gi, '').length;
                   if($("#rdoOption_"+i).prop("checked"))
                   {
                     if(option=='')
                     {
                         $('#err_option_'+i).html('This field is required.');
                         flag = 1;
                     }
                   }
                   
               }   
               if(rdoOption==null)
               {
                  flag = 1;
                  swal('Please select one option who is correct Answer.')
               }

               /*if(flHorn == '')
               {
                   $('#err_flHorn').html('This field is required.');
                   flag = 1;
               }
               else if(!(flHornExt == "mp3" || flHornExt == "MP3" || flHornExt == "wave" || flHornExt == "m4a"))
               {
                   $('#err_flHorn').html('Invalid file type.');
                   flag = 1;
               }*/

               if($.trim(duration)=='' || parseInt(duration)==0)
               {
                  $('#err_duration').html('This field is required.');
                  flag = 1;
               }
               else if(isNaN(duration))
               {
                  $('#err_duration').html('Invalid time.');
                  flag = 1;
               }
              
           }

           else if(parseInt(hiddenTemplate)==50)
           {
              var direction = $('#direction').val();
              var question1 = $('#question1').val();
              var question2 = $('#question2').val();
              var option_1  = $('#option_1').val();

              var rdoOption_1 = $('input[name="rdoOption_1"]:checked').val();
              /*var flHorn   = $('#flHorn').val();
              var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);*/
              var duration = $('#duration').val();

              $('#err_direction').html('');
              $('#err_question1').html('');
              $('#err_question2').html('');
              $('#err_option_1').html('');
              $('#err_rdoOption_1').html('');
              /*$('#err_flHorn').html('');*/
              $('#err_duration').html('');

               if($.trim(direction)=='')
               {
                  $('#err_direction').html('This field is required.');
                  flag = 1;  
               }

               if($.trim(question1)=='')
               {
                  $('#err_question1').html('This field is required.');
                  flag = 1;  
               }
               if($.trim(question2)=='')
               {
                  $('#err_question2').html('This field is required.');
                  flag = 1;  
               }
               if($.trim(option_1)=='')
               {
                  $('#err_option_1').html('This field is required.');
                  flag = 1;  
               }
               if($.trim(rdoOption_1)==null)
               {
                  $('#err_rdoOption_1').html('This field is required.');
                  flag = 1;  
               }
               for(var i = 2; i <= 4; i++)
               {
                  $('#err_option_'+i).html('');
                  var option  = $('#option_'+i).val();
                   if($("#rdoOption_"+i).prop("checked"))
                   {
                       if($.trim(option)=='')
                       {
                          $('#err_option_'+i).html('This field is required.');
                          flag = 1;  
                       }
                   }
               }
               /*if(flHorn == '')
               {
                   $('#err_flHorn').html('This field is required.');
                   flag = 1;
               }
               else if(!(flHornExt == "mp3" || flHornExt == "MP3" || flHornExt == "wave" || flHornExt == "m4a"))
               {
                   $('#err_flHorn').html('Invalid file type.');
                   flag = 1;
               }*/

               if($.trim(duration)=='' || parseInt(duration)==0)
               {
                  $('#err_duration').html('This field is required.');
                  flag = 1;
               }
               else if(isNaN(duration))
               {
                  $('#err_duration').html('Invalid time.');
                  flag = 1;
               }

           }

           /*TEMPLATE : VALIDATION*/
           $('#btnAddLesson').attr('disabled', false);
           $('#btnAddQuiz').attr('disabled', false);
           $('#btnSubmit').attr('disabled', false);
           if(btnAction=='btnAddQuiz')
           {
              $('#btnAddQuiz').html('+ Add Quizzes');
           }
           else if(btnAction=='btnSubmit')
           {
              $('#btnSubmit').html('Submit');
           }

           if(flag == 1)
           {
               return false;
           }
           else
           {
                if(parseInt(hiddenTemplate)==49 || parseInt(hiddenTemplate)==40 || parseInt(hiddenTemplate)==41 || parseInt(hiddenTemplate)==42)
                {
                  for (instance in CKEDITOR.instances) {
                      CKEDITOR.instances[instance].updateElement();
                  }
                }
                $("#frmTemplateCreate").ajaxSubmit({
                   headers:{'X-CSRF-Token': $('input[name="_token"]').val()},
                   dataType: 'json',
                   beforeSend: function(data, statusText, xhr, wrapper) 
                   {
                       
                   },
                   success: function(data, statusText, xhr, wrapper)
                   {
                       if(data.status == "success")
                       {
                           if(data.redirectUrl=='btnSubmit')
                           {
                               window.location.href='{{ $module_url_path }}';
                           }
                           else if(data.redirectUrl=='btnAddQuiz')
                           {
                               window.location.href='{{ $module_url }}';
                           }
                       }
                       else if(data.status == "chkBlankLetter")
                       {
                          swal('Please check atleast one checkbox');
                       }
                       else if(data.status == "question")
                       {
                          swal('Please enter all question values.');
                       }
                       else
                       {
                          $('.error').html('');
                           if(data.status == 'fail'){
                               var errorsHtml = '';
                               $.each( data.errors, function( key, value ) {
                                   $('#err_'+key).addClass('validation-error-label');
                                   errorsHtml = $('#err_'+key).html(value[0]);
                               });
                           }
                       }
                       
                   },
                   error: function(data, statusText, xhr, wrapper)
                   {
                       
                   }
                });
           }
       }
   });

   /*Preview Template */
   $(document).on('click', '#btnShowPreview', function(){
       var btnAction      = $('#btnAction').val();
       var hiddenTemplate = $('#hiddenTemplate').val();
       var lessonName     = $('#lessonName').val();
       var programId      = '{{$programId}}';
       var flag = 0;
       var formActionURL = '';
       
       if(hiddenTemplate=='')
       {
           swal("Please Select a Template.");
           return false;
       }
       else
       {
           /*$('#btnAddLesson').attr('disabled', true);
           $('#btnShowPreview').attr('disabled', true);
           $('#btnSubmit').attr('disabled', true);*/
           /*if(btnAction=='btnShowPreview')
           {
              $('#btnShowPreview').html("+ Processing...");
           }
           else if(btnAction=='btnSubmit')
           {
              $('#btnSubmit').html("Processing...");
           }*/

           var formActionURL =  '{{ $module_form_url }}/'+hiddenTemplate;
           $('#err_lessonName').html('');
           if(lessonName=='')
           {
               $('#err_lessonName').html('The lesson name field is required.');
               flag = 1;
           }
           /*TEMPLATE : VALIDATION*/
           if(parseInt(hiddenTemplate)==1)
           {
               var direction = $('#direction').val();
               var fileType = $('#fileType').val();
               var question = $('#question').val();
               var flHorn   = $('#flHorn').val();
               var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);
               var duration = $('#duration').val();

               $('#err_direction').html('');
               $('#err_fileType').html('');
               $('#err_imgFile').html('');
               $('#err_vdoFile').html('');
               $('#err_question').html('');
               $('#err_flHorn').html('');
               $('#err_duration').html('');
               
               if($.trim(direction)=='')
               {
                  $('#err_direction').html('This field is required.');
                  flag = 1;
               }
               
               if(fileType=='')
               {
                   $('#err_fileType').html('This field is required.');
                   flag = 1;
               }
               else if(fileType=='image')
               {
                   var imgFile = $('#imgFile').val();
                   var imgFileExt = imgFile.substring(imgFile.lastIndexOf('.') + 1);
                   if(imgFile == '')
                   {
                       $('#err_imgFile').html('This field is required.');
                       flag = 1;
                   }
                   else if(!(imgFileExt == "jpg" || imgFileExt == "jpeg" || imgFileExt == "gif" || imgFileExt == "png" || imgFileExt == "GIF" || imgFileExt == "JPG" || imgFileExt == "JPEG" || imgFileExt == "PNG"))
                   {
                       $('#err_imgFile').html('Invalid file type.');
                       flag=1;
                   }
                   else if($('#imgFile').attr('data-error')=='yes')
                   {
                      $('#err_imgFile').html('File must be grater than / equal to 570 X 442.');
                      flag=1;  
                   }

               }
               else if(fileType=='video')
               {
                   var vdoFile = $('#vdoFile').val();
                   var vdoFileExt = vdoFile.substring(vdoFile.lastIndexOf('.') + 1);
                   
                   if(vdoFile == '')
                   {
                       $('#err_vdoFile').html('This field is required.');
                       flag = 1;
                   }
                   else if(!(vdoFileExt == "mp4" || vdoFileExt == "MP4"))
                   {
                       $('#err_vdoFile').html('Invalid file type.');
                       flag = 1;
                   }
               }
   
               if($.trim(question)=='')
               {
                   $('#err_question').html('This field is required.');
                   flag = 1;
               }
   
               if(flHorn == '')
               {
                   $('#err_flHorn').html('This field is required.');
                   flag = 1;
               }
               else if(!(flHornExt == "mp3" || flHornExt == "MP3" || flHornExt == "wave" || flHornExt == "m4a"))
               {
                   $('#err_flHorn').html('Invalid file type.');
                   flag = 1;
               }

               /*if(parseInt(duration)==0 && parseInt(duration)=='')*/
               if($.trim(duration)=='' || parseInt(duration)==0)
               {
                  $('#err_duration').html('This field is required.');
                  flag = 1;
               }
               else if(isNaN(duration))
               {
                  $('#err_duration').html('Invalid time.');
                  flag = 1;
               }
   
           }

           else if(parseInt(hiddenTemplate)==2)
           {
               var direction = $('#direction').val();
               var fileType = $('#fileType').val();
               var question = $('#question').val();
               var flHorn   = $('#flHorn').val();
               var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);
               var duration = $('#duration').val();
    
               $('#err_direction').html('');
               $('#err_fileType').html('');
               $('#err_imgFile').html('');
               $('#err_vdoFile').html('');
               $('#err_question').html('');
               $('#err_flHorn').html('');
               $('#err_chkBlankLetter').html('');
               $('#err_duration').html('');

               if($.trim(direction)=='')
               {
                  $('#err_direction').html('This field is required.');
                  flag = 1;
               }

               if(fileType=='')
               {
                   $('#err_fileType').html('This field is required.');
                   flag = 1;
               }
               else if(fileType=='image')
               {
                   var imgFile = $('#imgFile').val();
                   var imgFileExt = imgFile.substring(imgFile.lastIndexOf('.') + 1);
                   if(imgFile == '')
                   {
                       $('#err_imgFile').html('This field is required.');
                       flag = 1;
                   }
                   else if(!(imgFileExt == "jpg" || imgFileExt == "jpeg" || imgFileExt == "gif" || imgFileExt == "png" || imgFileExt == "GIF" || imgFileExt == "JPG" || imgFileExt == "JPEG" || imgFileExt == "PNG"))
                   {
                       $('#err_imgFile').html('Invalid file type.');
                       flag=1;
                   }
                   else if($('#imgFile').attr('data-error')=='yes')
                   {
                      $('#err_imgFile').html('File must be grater than / equal to 570 X 442.');
                      flag=1;  
                   }
               }
               else if(fileType=='video')
               {
                   var vdoFile = $('#vdoFile').val();
                   var vdoFileExt = vdoFile.substring(vdoFile.lastIndexOf('.') + 1);
                   
                   if(vdoFile == '')
                   {
                       $('#err_vdoFile').html('This field is required.');
                       flag = 1;
                   }
                   else if(!(vdoFileExt == "mp4" || vdoFileExt == "MP4"))
                   {
                       $('#err_vdoFile').html('Invalid file type.');
                       flag = 1;
                   }
               }

               if($.trim(question)=='')
               {
                   $('#err_question').html('This field is required.');
                   flag = 1;
               }
               else
               {
                  if($('input[name="chkBlankLetter[]"]:checked').length == 0)
                  {
                    $('#err_chkBlankLetter').html('Please checked atleast one checkbox');
                    flag = 1;    
                  }
               }

               if(flHorn == '')
               {
                   $('#err_flHorn').html('This field is required.');
                   flag = 1;
               }
               else if(!(flHornExt == "mp3" || flHornExt == "MP3" || flHornExt == "wave" || flHornExt == "m4a"))
               {
                   $('#err_flHorn').html('Invalid file type.');
                   flag = 1;
               }

               if($.trim(duration)=='' || parseInt(duration)==0)
               {
                  $('#err_duration').html('This field is required.');
                  flag = 1;
               }
               else if(isNaN(duration))
               {
                  $('#err_duration').html('Invalid time.');
                  flag = 1;
               }
           }

           else if(parseInt(hiddenTemplate)==3)
           {
               var direction = $('#direction').val();
               var answer = $('#answer').val();
               
               var flQuestion1 = $('#flQuestion1').val();
               var flQuestion1Ext = flQuestion1.substring(flQuestion1.lastIndexOf('.')+1);
               var question1 = $('#question1').val();

               var flQuestion2 = $('#flQuestion2').val();
               var flQuestion2Ext = flQuestion2.substring(flQuestion2.lastIndexOf('.')+1);
               var question2 = $('#question2').val();

               var flHorn   = $('#flHorn').val();
               var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);

               var duration = $('#duration').val();

               $('#err_direction').html('');
               $('#err_answer').html('');
               $('#err_flQuestion1').html('');
               $('#err_question1').html('');
               $('#err_flQuestion2').html('');
               $('#err_question2').html('');
               $('#err_flHorn').html('');
               $('#err_duration').html('');

               if($.trim(direction)=='')
               {
                  $('#err_direction').html('This field is required.');
                  flag = 1;
               }
               
               if($.trim(answer)=='')
               {
                  $('#err_answer').html('This field is required.');
                  flag = 1;
               }

               if(flQuestion1=='')
               {
                  $('#err_flQuestion1').html('This field is required.');
                  flag = 1;
               }
               else if(!(flQuestion1Ext == "jpg" || flQuestion1Ext == "jpeg" || flQuestion1Ext == "gif" || flQuestion1Ext == "png" || flQuestion1Ext == "GIF" || flQuestion1Ext == "JPG" || flQuestion1Ext == "JPEG" || flQuestion1Ext == "PNG"))
               {
                  $('#err_flQuestion1').html('Invalid file type.');
                  flag=1;
               }
               else if($('#flQuestion1').attr('data-error')=='yes')
               {
                  $('#err_flQuestion1').html('File must be grater than / equal to 570 X 442.');
                  flag=1;  
               }

               if($.trim(question1)=='')
               {
                  $('#err_question1').html('This field is required.');
                  flag = 1;
               }
               else if(!question1.toLowerCase().match(answer.toLowerCase()))
               {
                  $('#err_question1').html('Question must contain answer value word.');
                  flag = 1;
               }

               if(flQuestion2=='')
               {
                  $('#err_flQuestion2').html('This field is required.');
                  flag = 1;
               }
               else if(!(flQuestion2Ext == "jpg" || flQuestion2Ext == "jpeg" || flQuestion2Ext == "gif" || flQuestion2Ext == "png" || flQuestion2Ext == "GIF" || flQuestion2Ext == "JPG" || flQuestion2Ext == "JPEG" || flQuestion2Ext == "PNG"))
               {
                  $('#err_flQuestion2').html('Invalid file type.');
                  flag=1;
               }
               else if($('#flQuestion2').attr('data-error')=='yes')
               {
                  $('#err_flQuestion2').html('File must be grater than / equal to 570 X 442.');
                  flag=1;  
               }
               
               if($.trim(question2)=='')
               {
                  $('#err_question2').html('This field is required.');
                  flag = 1;
               }
               else if(!question2.toLowerCase().match(answer.toLowerCase()))
               {
                  $('#err_question2').html('Question must contain answer value word.');
                  flag = 1;
               }

               if(flHorn == '')
               {
                   $('#err_flHorn').html('This field is required.');
                   flag = 1;
               }
               else if(!(flHornExt == "mp3" || flHornExt == "MP3" || flHornExt == "wave" || flHornExt == "m4a"))
               {
                   $('#err_flHorn').html('Invalid file type.');
                   flag = 1;
               }

                if($.trim(duration)=='' || parseInt(duration)==0)
                {
                  $('#err_duration').html('This field is required.');
                  flag = 1;
                }
                else if(isNaN(duration))
                {
                  $('#err_duration').html('Invalid time.');
                  flag = 1;
                }

           }

           else if(parseInt(hiddenTemplate)==4)
           {
               var direction = $('#direction').val();
               var answer = $('#answer').val();
               
               var flQuestion1 = $('#flQuestion1').val();
               var flQuestion1Ext = flQuestion1.substring(flQuestion1.lastIndexOf('.')+1);
               var question1 = $('#question1').val();

               var flQuestion2 = $('#flQuestion2').val();
               var flQuestion2Ext = flQuestion2.substring(flQuestion2.lastIndexOf('.')+1);
               var question2 = $('#question2').val();

               var flQuestion3 = $('#flQuestion3').val();
               var flQuestion3Ext = flQuestion3.substring(flQuestion3.lastIndexOf('.')+1);
               var question3 = $('#question3').val();

               var flHorn   = $('#flHorn').val();
               var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);

               var duration = $('#duration').val();
               var matchFlag = 1;


               $('#err_direction').html('');
               $('#err_answer').html('');
               $('#err_flQuestion1').html('');
               $('#err_question1').html('');
               $('#err_flQuestion2').html('');
               $('#err_question2').html('');
               $('#err_flQuestion3').html('');
               $('#err_question3').html('');
               $('#err_flHorn').html('');
               $('#err_duration').html('');

               if($.trim(direction)=='')
               {
                  $('#err_direction').html('This field is required.');
                  flag = 1;
               }
               
               if($.trim(answer)=='')
               {
                  $('#err_answer').html('This field is required.');
                  flag = 1;
               }

               if(flQuestion1=='')
               {
                  $('#err_flQuestion1').html('This field is required.');
                  flag = 1;
               }
               else if(!(flQuestion1Ext == "jpg" || flQuestion1Ext == "jpeg" || flQuestion1Ext == "gif" || flQuestion1Ext == "png" || flQuestion1Ext == "GIF" || flQuestion1Ext == "JPG" || flQuestion1Ext == "JPEG" || flQuestion1Ext == "PNG"))
               {
                  $('#err_flQuestion1').html('Invalid file type.');
                  flag=1;
               }
               else if($('#flQuestion1').attr('data-error')=='yes')
               {
                  $('#err_flQuestion1').html('File must be grater than / equal to 270 X 270.');
                  flag=1;  
               }

               if($.trim(question1)=='')
               {
                  $('#err_question1').html('This field is required.');
                  flag = 1;
               }


               if(flQuestion2=='')
               {
                  $('#err_flQuestion2').html('This field is required.');
                  flag = 1;
               }
               else if(!(flQuestion2Ext == "jpg" || flQuestion2Ext == "jpeg" || flQuestion2Ext == "gif" || flQuestion2Ext == "png" || flQuestion2Ext == "GIF" || flQuestion2Ext == "JPG" || flQuestion2Ext == "JPEG" || flQuestion2Ext == "PNG"))
               {
                  $('#err_flQuestion2').html('Invalid file type.');
                  flag=1;
               }
               else if($('#flQuestion2').attr('data-error')=='yes')
               {
                  $('#err_flQuestion2').html('File must be grater than / equal to 270 X 270.');
                  flag=1;  
               }

               if($.trim(question2)=='')
               {
                  $('#err_question2').html('This field is required.');
                  flag = 1;
               }

               if(flQuestion3=='')
               {
                  $('#err_flQuestion3').html('This field is required.');
                  flag = 1;
               }
               else if(!(flQuestion3Ext == "jpg" || flQuestion3Ext == "jpeg" || flQuestion3Ext == "gif" || flQuestion3Ext == "png" || flQuestion3Ext == "GIF" || flQuestion3Ext == "JPG" || flQuestion3Ext == "JPEG" || flQuestion3Ext == "PNG"))
               {
                  $('#err_flQuestion3').html('Invalid file type.');
                  flag=1;
               }
               else if($('#flQuestion3').attr('data-error')=='yes')
               {
                  $('#err_flQuestion3').html('File must be grater than / equal to 270 X 270.');
                  flag=1;  
               }

               if($.trim(question3)=='')
               {
                  $('#err_question3').html('This field is required.');
                  flag = 1;
               }

               if(flHorn == '')
               {
                   $('#err_flHorn').html('This field is required.');
                   flag = 1;
               }
               else if(!(flHornExt == "mp3" || flHornExt == "MP3" || flHornExt == "wave" || flHornExt == "m4a"))
               {
                   $('#err_flHorn').html('Invalid file type.');
                   flag = 1;
               }

               if(question1.toLowerCase().match(answer.toLowerCase()))
               {
                  matchFlag = 0;
               }
               if(question2.toLowerCase().match(answer.toLowerCase()))
               {
                  matchFlag = 0;
               }
               if(question3.toLowerCase().match(answer.toLowerCase()))
               {
                  matchFlag = 0;
               }

               if(parseInt(matchFlag)==1)
               {
                  swal('Atleast one question should contain "'+answer+'" value.');
                  flag = 1;
               }

               if($.trim(duration)=='' || parseInt(duration)==0)
                {
                  $('#err_duration').html('This field is required.');
                  flag = 1;
                }
                else if(isNaN(duration))
                {
                  $('#err_duration').html('Invalid time.');
                  flag = 1;
                }

           }

           else if(parseInt(hiddenTemplate)==5)
           {
               var fileType = $('#fileType').val();
               var direction = $('#direction').val();
               var option1 = $('#option1').val();
               var option2 = $('#option2').val();
               var rdoOption = $('input[name="rdoOption"]:checked').val();
               var flHorn   = $('#flHorn').val();
               var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);
               var duration = $('#duration').val();
   
               $('#err_fileType').html('');
               $('#err_imgFile').html('');
               $('#err_vdoFile').html('');
               $('#err_direction').html('');
               $('#err_option1').html('');
               $('#err_option2').html('');
               $('#err_rdoOption').html('');
               $('#err_flHorn').html('');
               $('#err_duration').html('');
   
               if(fileType=='')
               {
                   $('#err_fileType').html('This field is required.');
                   flag = 1;
               }
               else if(fileType=='image')
               {
                   var imgFile = $('#imgFile').val();
                   var imgFileExt = imgFile.substring(imgFile.lastIndexOf('.') + 1);
                   if(imgFile == '')
                   {
                       $('#err_imgFile').html('This field is required.');
                       flag = 1;
                   }
                   else if(!(imgFileExt == "jpg" || imgFileExt == "jpeg" || imgFileExt == "gif" || imgFileExt == "png" || imgFileExt == "GIF" || imgFileExt == "JPG" || imgFileExt == "JPEG" || imgFileExt == "PNG"))
                   {
                       $('#err_imgFile').html('Invalid file type.');
                       flag=1;
                   }
                   else if($('#imgFile').attr('data-error')=='yes')
                   {
                      $('#err_imgFile').html('File must be grater than / equal to 570 X 442.');
                      flag=1;  
                   }
               }
               else if(fileType=='video')
               {
                   var vdoFile = $('#vdoFile').val();
                   var vdoFileExt = vdoFile.substring(vdoFile.lastIndexOf('.') + 1);
                   
                   if(vdoFile == '')
                   {
                       $('#err_vdoFile').html('This field is required.');
                       flag = 1;
                   }
                   else if(!(vdoFileExt == "mp4" || vdoFileExt == "MP4"))
                   {
                       $('#err_vdoFile').html('Invalid file type.');
                       flag = 1;
                   }
               }
   
               if($.trim(direction)=='')
               {
                   $('#err_direction').html('This field is required.');
                   flag = 1;
               }

               if($.trim(option1)=='')
               {
                   $('#err_option1').html('This field is required.');
                   flag = 1;
               }

               if($.trim(option2)=='')
               {
                   $('#err_option2').html('This field is required.');
                   flag = 1;
               }

               if(rdoOption==null)
               {
                   $('#err_rdoOption').html('Check one option as answer');
                   flag = 1;
               }
               
               if(flHorn == '')
               {
                   $('#err_flHorn').html('This field is required.');
                   flag = 1;
               }
               else if(!(flHornExt == "mp3" || flHornExt == "MP3" || flHornExt == "wave" || flHornExt == "m4a"))
               {
                   $('#err_flHorn').html('Invalid file type.');
                   flag = 1;
               }

               if($.trim(duration)=='' || parseInt(duration)==0)
                {
                  $('#err_duration').html('This field is required.');
                  flag = 1;
                }
                else if(isNaN(duration))
                {
                  $('#err_duration').html('Invalid time.');
                  flag = 1;
                }
   
           }

           else if(parseInt(hiddenTemplate)==6)
           {
               var direction = $('#direction').val();
               var flQuestion = $('#flQuestion').val();
               var flQuestionExt = flQuestion.substring(flQuestion.lastIndexOf('.')+1);
               var option1 = $('#option1').val();
               var option2 = $('#option2').val();
               var rdoOption = $('input[name="rdoOption"]:checked').val();
               var flHorn   = $('#flHorn').val();
               var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);
               var duration = $('#duration').val();

               $('#err_direction').html('');
               $('#err_flQuestion').html('');
               $('#err_option1').html('');
               $('#err_option2').html('');
               $('#err_rdoOption').html('');
               $('#err_flHorn').html('');
               $('#err_duration').html('');

               if($.trim(direction)=='')
               {
                  $('#err_direction').html('This field is required.');
                  flag = 1;
               }

               if(flQuestion=='')
               {
                  $('#err_flQuestion').html('This field is required.');
                  flag = 1;
               }
               else if(!(flQuestionExt == "mp4" || flQuestionExt == "MP4"))
               {
                  $('#err_flQuestion').html('Invalid file type.');
                  flag=1;
               }

               if($.trim(option1)=='')
               {
                   $('#err_option1').html('This field is required.');
                   flag = 1;
               }

               if($.trim(option2)=='')
               {
                   $('#err_option2').html('This field is required.');
                   flag = 1;
               }

               if(rdoOption==null)
               {
                   $('#err_rdoOption').html('Check one option as answer');
                   flag = 1;
               }
               
               if(flHorn == '')
               {
                   $('#err_flHorn').html('This field is required.');
                   flag = 1;
               }
               else if(!(flHornExt == "mp3" || flHornExt == "MP3" || flHornExt == "wave" || flHornExt == "m4a"))
               {
                   $('#err_flHorn').html('Invalid file type.');
                   flag = 1;
               }

               if($.trim(duration)=='' || parseInt(duration)==0)
                {
                  $('#err_duration').html('This field is required.');
                  flag = 1;
                }
                else if(isNaN(duration))
                {
                  $('#err_duration').html('Invalid time.');
                  flag = 1;
                }
           }

           else if(parseInt(hiddenTemplate)==7)
           {
               var direction = $('#direction').val();
               var flQuestion1 = $('#flQuestion1').val();
               var flQuestion1Ext = flQuestion1.substring(flQuestion1.lastIndexOf('.')+1);
               var answer1 = $('#answer1').val();
               var flQuestion2 = $('#flQuestion2').val();
               var flQuestion2Ext = flQuestion2.substring(flQuestion2.lastIndexOf('.')+1);
               var answer2 = $('#answer2').val();
               var flQuestion3 = $('#flQuestion3').val();
               var flQuestion3Ext = flQuestion3.substring(flQuestion3.lastIndexOf('.')+1);
               var answer3 = $('#answer3').val();
               var flQuestion4 = $('#flQuestion4').val();
               var flQuestion4Ext = flQuestion4.substring(flQuestion4.lastIndexOf('.')+1);
               var answer4 = $('#answer4').val();
               var flQuestion5 = $('#flQuestion5').val();
               var flQuestion5Ext = flQuestion5.substring(flQuestion5.lastIndexOf('.')+1);
               var answer5 = $('#answer5').val();
               var flHorn   = $('#flHorn').val();
               var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);
               var duration = $('#duration').val();

               $('#err_direction').html('');
               $('#err_flQuestion1').html('');
               $('#err_answer1').html('');
               $('#err_flQuestion2').html('');
               $('#err_answer2').html('');
               $('#err_flQuestion3').html('');
               $('#err_answer3').html('');
               $('#err_flQuestion4').html('');
               $('#err_answer4').html('');
               $('#err_flQuestion5').html('');
               $('#err_answer5').html('');
               $('#err_flHorn').html('');
               $('#err_duration').html('');

               //alert($('#flQuestion1').attr('data-error'));

               if($.trim(direction)=='')
               {
                  $('#err_direction').html('This field is required.');
                  flag = 1;
               }

               if(flQuestion1 == '')
               {
                   $('#err_flQuestion1').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion1Ext == "jpg" || flQuestion1Ext == "jpeg" || flQuestion1Ext == "gif" || flQuestion1Ext == "png" || flQuestion1Ext == "GIF" || flQuestion1Ext == "JPG" || flQuestion1Ext == "JPEG" || flQuestion1Ext == "PNG"))
               {
                   $('#err_flQuestion1').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion1').attr('data-error')=='yes')
               {
                  $('#err_flQuestion1').html('File must be grater than / equal to 210 X 210.');
                  flag=1;  
               }
               if($.trim(answer1)=='')
               {
                  $('#err_answer1').html('This field is required.');
                  flag = 1;
               }


               if(flQuestion2 == '')
               {
                   $('#err_flQuestion2').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion2Ext == "jpg" || flQuestion2Ext == "jpeg" || flQuestion2Ext == "gif" || flQuestion2Ext == "png" || flQuestion2Ext == "GIF" || flQuestion2Ext == "JPG" || flQuestion2Ext == "JPEG" || flQuestion2Ext == "PNG"))
               {
                   $('#err_flQuestion2').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion2').attr('data-error')=='yes')
               {
                  $('#err_flQuestion2').html('File must be grater than / equal to 210 X 210.');
                  flag=1;  
               }
               if($.trim(answer2)=='')
               {
                  $('#err_answer2').html('This field is required.');
                  flag = 1;
               }

               if(flQuestion3 == '')
               {
                   $('#err_flQuestion3').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion3Ext == "jpg" || flQuestion3Ext == "jpeg" || flQuestion3Ext == "gif" || flQuestion3Ext == "png" || flQuestion3Ext == "GIF" || flQuestion3Ext == "JPG" || flQuestion3Ext == "JPEG" || flQuestion3Ext == "PNG"))
               {
                   $('#err_flQuestion3').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion3').attr('data-error')=='yes')
               {
                  $('#err_flQuestion3').html('File must be grater than / equal to 210 X 210.');
                  flag=1;  
               }
               if($.trim(answer3)=='')
               {
                  $('#err_answer3').html('This field is required.');
                  flag = 1;
               }

               if(flQuestion4 == '')
               {
                   $('#err_flQuestion4').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion4Ext == "jpg" || flQuestion4Ext == "jpeg" || flQuestion4Ext == "gif" || flQuestion4Ext == "png" || flQuestion4Ext == "GIF" || flQuestion4Ext == "JPG" || flQuestion4Ext == "JPEG" || flQuestion4Ext == "PNG"))
               {
                   $('#err_flQuestion4').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion4').attr('data-error')=='yes')
               {
                  $('#err_flQuestion4').html('File must be grater than / equal to 210 X 210.');
                  flag=1;  
               }
               if($.trim(answer4)=='')
               {
                  $('#err_answer4').html('This field is required.');
                  flag = 1;
               }

               if(flQuestion5 == '')
               {
                   $('#err_flQuestion5').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion5Ext == "jpg" || flQuestion5Ext == "jpeg" || flQuestion5Ext == "gif" || flQuestion5Ext == "png" || flQuestion5Ext == "GIF" || flQuestion5Ext == "JPG" || flQuestion5Ext == "JPEG" || flQuestion5Ext == "PNG"))
               {
                   $('#err_flQuestion5').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion5').attr('data-error')=='yes')
               {
                  $('#err_flQuestion5').html('File must be grater than / equal to 210 X 210.');
                  flag=1;  
               }
               if($.trim(answer5)=='')
               {
                  $('#err_answer5').html('This field is required.');
                  flag = 1;
               }

               if(flHorn == '')
               {
                   $('#err_flHorn').html('This field is required.');
                   flag = 1;
               }
               else if(!(flHornExt == "mp3" || flHornExt == "MP3" || flHornExt == "wave" || flHornExt == "m4a"))
               {
                   $('#err_flHorn').html('Invalid file type.');
                   flag = 1;
               }

               if($.trim(duration)=='' || parseInt(duration)==0)
               {
                  $('#err_duration').html('This field is required.');
                  flag = 1;
               }
               else if(isNaN(duration))
               {
                  $('#err_duration').html('Invalid time.');
                  flag = 1;
               }

           }

           else if(parseInt(hiddenTemplate)==8)
           {
               var direction = $('#direction').val();
               var flQuestion1 = $('#flQuestion1').val();
               var flQuestion1Ext = flQuestion1.substring(flQuestion1.lastIndexOf('.')+1);
               var question1 = $('#question1').val();
               var answer1 = $('#answer1').val();
               var flQuestion2 = $('#flQuestion2').val();
               var flQuestion2Ext = flQuestion2.substring(flQuestion2.lastIndexOf('.')+1);
               var question2 = $('#question2').val();
               var answer2 = $('#answer2').val();
               var flHorn   = $('#flHorn').val();
               var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);
               var duration = $('#duration').val();

               $('#err_direction').html('');
               $('#err_flQuestion1').html('');
               $('#err_question1').html('');
               $('#err_answer1').html('');
               $('#err_flQuestion2').html('');
               $('#err_question2').html('');
               $('#err_answer2').html('');
               $('#err_flHorn').html('');
               $('#err_duration').html('');

               if($.trim(direction)=='')
               {
                  $('#err_direction').html('This field is required.');
                  flag = 1;
               }

               if(flQuestion1 == '')
               {
                   $('#err_flQuestion1').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion1Ext == "jpg" || flQuestion1Ext == "jpeg" || flQuestion1Ext == "gif" || flQuestion1Ext == "png" || flQuestion1Ext == "GIF" || flQuestion1Ext == "JPG" || flQuestion1Ext == "JPEG" || flQuestion1Ext == "PNG"))
               {
                   $('#err_flQuestion1').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion1').attr('data-error')=='yes')
               {
                  $('#err_flQuestion1').html('File must be grater than / equal to 570 X 442.');
                  flag=1;  
               }
               if($.trim(question1)=='')
               {
                  $('#err_question1').html('This field is required.');
                  flag = 1;
               }
               else
               {
                  var questionAnsArr = question1.match(/#BLANK#/g);
                  if(questionAnsArr==null)
                  {
                    $('#err_question1').html('#BLANK# is missing');
                    flag = 1;    
                  }
                  else
                  {
                    var questionAnsCount = questionAnsArr.length;  
                    if(parseInt(questionAnsCount)!=1)
                    {
                      $('#err_question1').html('Only one #BLANK# is allowed');
                      flag = 1;       
                    }
                  }
               }
               
               if($.trim(answer1)=='')
               {
                  $('#err_answer1').html('This field is required.');
                  flag = 1;
               }

               if(flQuestion2 == '')
               {
                   $('#err_flQuestion2').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion2Ext == "jpg" || flQuestion2Ext == "jpeg" || flQuestion2Ext == "gif" || flQuestion2Ext == "png" || flQuestion2Ext == "GIF" || flQuestion2Ext == "JPG" || flQuestion2Ext == "JPEG" || flQuestion2Ext == "PNG"))
               {
                   $('#err_flQuestion2').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion2').attr('data-error')=='yes')
               {
                  $('#err_flQuestion2').html('File must be grater than / equal to 570 X 442.');
                  flag=1;  
               }
               if($.trim(question2)=='')
               {
                  $('#err_question2').html('This field is required.');
                  flag = 1;
               }
               else
               {
                  var questionAnsArr = question2.match(/#BLANK#/g);
                  if(questionAnsArr==null)
                  {
                    $('#err_question2').html('#BLANK# is missing');
                    flag = 1;    
                  }
                  else
                  {
                    var questionAnsCount = questionAnsArr.length;  
                    if(parseInt(questionAnsCount)!=1)
                    {
                      $('#err_question2').html('Only one #BLANK# is allowed');
                      flag = 1;       
                    }
                  }
               }
               if($.trim(answer2)=='')
               {
                  $('#err_answer2').html('This field is required.');
                  flag = 1;
               }

               if(flHorn == '')
               {
                   $('#err_flHorn').html('This field is required.');
                   flag = 1;
               }
               else if(!(flHornExt == "mp3" || flHornExt == "MP3" || flHornExt == "wave" || flHornExt == "m4a"))
               {
                   $('#err_flHorn').html('Invalid file type.');
                   flag = 1;
               }

               if($.trim(duration)=='' || parseInt(duration)==0)
               {
                  $('#err_duration').html('This field is required.');
                  flag = 1;
               }
               else if(isNaN(duration))
               {
                  $('#err_duration').html('Invalid time.');
                  flag = 1;
               }
           }

           else if(parseInt(hiddenTemplate)==9)
           {
               var direction = $('#direction').val();
               var question = $('#question').val();
               var option1 = $('#option1').val();
               var option2 = $('#option2').val();
               var option3 = $('#option3').val();
               var option4 = $('#option4').val();
               var rdoOption = $('input[name="rdoOption"]:checked').val();
               var flHorn   = $('#flHorn').val();
               var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);
               var duration = $('#duration').val();

               $('#err_direction').html('');
               $('#err_question').html('');
               $('#err_option1').html('');
               $('#err_option2').html('');
               $('#err_option3').html('');
               $('#err_option4').html('');
               $('#err_rdoOption').html('');
               $('#err_flHorn').html('');
               $('#err_duration').html('');

               if($.trim(direction)=='')
               {
                  $('#err_direction').html('This field is required.');
                  flag = 1;
               }

               if($.trim(question)=='')
               {
                  $('#err_question').html('This field is required.');
                  flag = 1;
               }
               else
               {
                  var questionAnsArr = question.match(/#BLANK#/g);
                  if(questionAnsArr==null)
                  {
                    $('#err_question').html('#BLANK# is missing');
                    flag = 1;    
                  }
                  else
                  {
                    var questionAnsCount = questionAnsArr.length;  
                    if(parseInt(questionAnsCount)!=1)
                    {
                      $('#err_question').html('Only one #BLANK# is allowed');
                      flag = 1;       
                    }
                  }
               }

               if($.trim(option1)=='')
               {
                  $('#err_option1').html('This field is required.');
                  flag = 1;
               }

               if($.trim(option2)=='')
               {
                  $('#err_option2').html('This field is required.');
                  flag = 1;
               }

               if($.trim(option3)=='')
               {
                  $('#err_option3').html('This field is required.');
                  flag = 1;
               }

               if($.trim(option4)=='')
               {
                  $('#err_option4').html('This field is required.');
                  flag = 1;
               }

               if(rdoOption==null)
               {
                   $('#err_rdoOption').html('Check one option as answer');
                   flag = 1;
               }

               if(flHorn == '')
               {
                   $('#err_flHorn').html('This field is required.');
                   flag = 1;
               }
               else if(!(flHornExt == "mp3" || flHornExt == "MP3" || flHornExt == "wave" || flHornExt == "m4a"))
               {
                   $('#err_flHorn').html('Invalid file type.');
                   flag = 1;
               }

               if($.trim(duration)=='' || parseInt(duration)==0)
               {
                  $('#err_duration').html('This field is required.');
                  flag = 1;
               }
               else if(isNaN(duration))
               {
                  $('#err_duration').html('Invalid time.');
                  flag = 1;
               }

           }

           else if(parseInt(hiddenTemplate)==10)
           {
               var direction = $('#direction').val();
               var flQuestion = $('#flQuestion').val();
               var flQuestionExt = flQuestion.substring(flQuestion.lastIndexOf('.')+1);
               var question = $('#question').val();
               var option1 = $('#option1').val();
               var option2 = $('#option2').val();
               var rdoOption = $('input[name="rdoOption"]:checked').val();
               var flHorn   = $('#flHorn').val();
               var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);
               var duration = $('#duration').val();

               $('#err_direction').html('');
               $('#err_flQuestion').html('');
               $('#err_question').html('');
               $('#err_option1').html('');
               $('#err_option2').html('');
               $('#err_rdoOption').html('');
               $('#err_flHorn').html('');
               $('#err_duration').html('');

               if($.trim(direction)=='')
               {
                  $('#err_direction').html('This field is required.');
                  flag = 1;
               }

               if(flQuestion == '')
               {
                   $('#err_flQuestion').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestionExt == "jpg" || flQuestionExt == "jpeg" || flQuestionExt == "gif" || flQuestionExt == "png" || flQuestionExt == "GIF" || flQuestionExt == "JPG" || flQuestionExt == "JPEG" || flQuestionExt == "PNG"))
               {
                   $('#err_flQuestion').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion').attr('data-error')=='yes')
               {
                  $('#err_flQuestion').html('File must be grater than / equal to 570 X 442.');
                  flag=1;  
               }

               if($.trim(question)=='')
               {
                  $('#err_question').html('This field is required.');
                  flag = 1;
               }
               else
               {
                  var questionAnsArr = question.match(/#BLANK#/g);
                  if(questionAnsArr==null)
                  {
                    $('#err_question').html('#BLANK# is missing');
                    flag = 1;    
                  }
                  else
                  {
                    var questionAnsCount = questionAnsArr.length;  
                    if(parseInt(questionAnsCount)!=1)
                    {
                      $('#err_question').html('Only one #BLANK# is allowed');
                      flag = 1;       
                    }
                  }
               }

               if($.trim(option1)=='')
               {
                   $('#err_option1').html('This field is required.');
                   flag = 1;
               }

               if($.trim(option2)=='')
               {
                   $('#err_option2').html('This field is required.');
                   flag = 1;
               }

               if(rdoOption==null)
               {
                   $('#err_rdoOption').html('Check one option as answer');
                   flag = 1;
               }
               
               if(flHorn == '')
               {
                   $('#err_flHorn').html('This field is required.');
                   flag = 1;
               }
               else if(!(flHornExt == "mp3" || flHornExt == "MP3" || flHornExt == "wave" || flHornExt == "m4a"))
               {
                   $('#err_flHorn').html('Invalid file type.');
                   flag = 1;
               }

               if($.trim(duration)=='' || parseInt(duration)==0)
               {
                  $('#err_duration').html('This field is required.');
                  flag = 1;
               }
               else if(isNaN(duration))
               {
                  $('#err_duration').html('Invalid time.');
                  flag = 1;
               }
           }

           else if(parseInt(hiddenTemplate)==11)
           {
               var direction = $('#direction').val();
               var flQuestion1 = $('#flQuestion1').val();
               var flQuestion1Ext = flQuestion1.substring(flQuestion1.lastIndexOf('.')+1);
               var answer1 = $('#answer1').val();
               var flQuestion2 = $('#flQuestion2').val();
               var flQuestion2Ext = flQuestion2.substring(flQuestion2.lastIndexOf('.')+1);
               var answer2 = $('#answer2').val();
               var flQuestion3 = $('#flQuestion3').val();
               var flQuestion3Ext = flQuestion3.substring(flQuestion3.lastIndexOf('.')+1);
               var answer3 = $('#answer3').val();
               var flQuestion4 = $('#flQuestion4').val();
               var flQuestion4Ext = flQuestion4.substring(flQuestion4.lastIndexOf('.')+1);
               var answer4 = $('#answer4').val();
               /*var flHorn   = $('#flHorn').val();
               var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);*/
               var duration = $('#duration').val();

               $('#err_direction').html('');
               $('#err_flQuestion1').html('');
               $('#err_answer1').html('');
               $('#err_flQuestion2').html('');
               $('#err_answer2').html('');
               $('#err_flQuestion3').html('');
               $('#err_answer3').html('');
               $('#err_flQuestion4').html('');
               $('#err_answer4').html('');
               /*$('#err_flHorn').html('');*/
               $('#err_duration').html('');

               if($.trim(direction)=='')
               {
                  $('#err_direction').html('This field is required.');
                  flag = 1;
               }

               if(flQuestion1 == '')
               {
                   $('#err_flQuestion1').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion1Ext == "jpg" || flQuestion1Ext == "jpeg" || flQuestion1Ext == "gif" || flQuestion1Ext == "png" || flQuestion1Ext == "GIF" || flQuestion1Ext == "JPG" || flQuestion1Ext == "JPEG" || flQuestion1Ext == "PNG"))
               {
                   $('#err_flQuestion1').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion1').attr('data-error')=='yes')
               {
                  $('#err_flQuestion1').html('File must be grater than / equal to 270 X 270.');
                  flag=1;  
               }
               if($.trim(answer1)=='')
               {
                  $('#err_answer1').html('This field is required.');
                  flag = 1;
               }


               if(flQuestion2 == '')
               {
                   $('#err_flQuestion2').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion2Ext == "jpg" || flQuestion2Ext == "jpeg" || flQuestion2Ext == "gif" || flQuestion2Ext == "png" || flQuestion2Ext == "GIF" || flQuestion2Ext == "JPG" || flQuestion2Ext == "JPEG" || flQuestion2Ext == "PNG"))
               {
                   $('#err_flQuestion2').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion2').attr('data-error')=='yes')
               {
                  $('#err_flQuestion2').html('File must be grater than / equal to 270 X 270.');
                  flag=1;  
               }
               if($.trim(answer2)=='')
               {
                  $('#err_answer2').html('This field is required.');
                  flag = 1;
               }

               if(flQuestion3 == '')
               {
                   $('#err_flQuestion3').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion3Ext == "jpg" || flQuestion3Ext == "jpeg" || flQuestion3Ext == "gif" || flQuestion3Ext == "png" || flQuestion3Ext == "GIF" || flQuestion3Ext == "JPG" || flQuestion3Ext == "JPEG" || flQuestion3Ext == "PNG"))
               {
                   $('#err_flQuestion3').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion3').attr('data-error')=='yes')
               {
                  $('#err_flQuestion3').html('File must be grater than / equal to 270 X 270.');
                  flag=1;  
               }
               if($.trim(answer3)=='')
               {
                  $('#err_answer3').html('This field is required.');
                  flag = 1;
               }

               if(flQuestion4 == '')
               {
                   $('#err_flQuestion4').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion4Ext == "jpg" || flQuestion4Ext == "jpeg" || flQuestion4Ext == "gif" || flQuestion4Ext == "png" || flQuestion4Ext == "GIF" || flQuestion4Ext == "JPG" || flQuestion4Ext == "JPEG" || flQuestion4Ext == "PNG"))
               {
                   $('#err_flQuestion4').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion4').attr('data-error')=='yes')
               {
                  $('#err_flQuestion4').html('File must be grater than / equal to 270 X 270.');
                  flag=1;  
               }
               if($.trim(answer4)=='')
               {
                  $('#err_answer4').html('This field is required.');
                  flag = 1;
               }

               /*if(flHorn == '')
               {
                   $('#err_flHorn').html('This field is required.');
                   flag = 1;
               }
               else if(!(flHornExt == "mp3" || flHornExt == "MP3" || flHornExt == "wave" || flHornExt == "m4a"))
               {
                   $('#err_flHorn').html('Invalid file type.');
                   flag = 1;
               }*/

               if($.trim(duration)=='' || parseInt(duration)==0)
               {
                  $('#err_duration').html('This field is required.');
                  flag = 1;
               }
               else if(isNaN(duration))
               {
                  $('#err_duration').html('Invalid time.');
                  flag = 1;
               }

           }

           else if(parseInt(hiddenTemplate)==12)
           {
               var direction = $('#direction').val();
               var flQuestion1 = $('#flQuestion1').val();
               var flQuestion1Ext = flQuestion1.substring(flQuestion1.lastIndexOf('.')+1);
               var flQuestion2 = $('#flQuestion2').val();
               var flQuestion2Ext = flQuestion2.substring(flQuestion2.lastIndexOf('.')+1);
               var answer2 = $('#answer2').val();
               var answer1 = $('#answer1').val();
               var flHorn   = $('#flHorn').val();
               var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);
               var duration = $('#duration').val();

               $('#err_direction').html('');
               $('#err_flQuestion1').html('');
               $('#err_flQuestion2').html('');
               $('#err_answer1').html('');
               $('#err_answer2').html('');
               $('#err_flHorn').html('');
               $('#err_duration').html('');

               if($.trim(direction)=='')
               {
                  $('#err_direction').html('This field is required.');
                  flag = 1;
               }

               if(flQuestion1 == '')
               {
                   $('#err_flQuestion1').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion1Ext == "jpg" || flQuestion1Ext == "jpeg" || flQuestion1Ext == "gif" || flQuestion1Ext == "png" || flQuestion1Ext == "GIF" || flQuestion1Ext == "JPG" || flQuestion1Ext == "JPEG" || flQuestion1Ext == "PNG"))
               {
                   $('#err_flQuestion1').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion1').attr('data-error')=='yes')
               {
                  $('#err_flQuestion1').html('File must be grater than / equal to 570 X 442.');
                  flag=1;  
               }
               
               if($.trim(answer1)=='')
               {
                  $('#err_answer1').html('This field is required.');
                  flag = 1;
               }

               if(flQuestion2 == '')
               {
                   $('#err_flQuestion2').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion2Ext == "jpg" || flQuestion2Ext == "jpeg" || flQuestion2Ext == "gif" || flQuestion2Ext == "png" || flQuestion2Ext == "GIF" || flQuestion2Ext == "JPG" || flQuestion2Ext == "JPEG" || flQuestion2Ext == "PNG"))
               {
                   $('#err_flQuestion2').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion2').attr('data-error')=='yes')
               {
                  $('#err_flQuestion2').html('File must be grater than / equal to 570 X 442.');
                  flag=1;  
               }
               if($.trim(answer2)=='')
               {
                  $('#err_answer2').html('This field is required.');
                  flag = 1;
               }

               if(flHorn == '')
               {
                   $('#err_flHorn').html('This field is required.');
                   flag = 1;
               }
               else if(!(flHornExt == "mp3" || flHornExt == "MP3" || flHornExt == "wave" || flHornExt == "m4a"))
               {
                   $('#err_flHorn').html('Invalid file type.');
                   flag = 1;
               }
               if($.trim(duration)=='' || parseInt(duration)==0)
               {
                  $('#err_duration').html('This field is required.');
                  flag = 1;
               }
               else if(isNaN(duration))
               {
                  $('#err_duration').html('Invalid time.');
                  flag = 1;
               }
           }

           else if(parseInt(hiddenTemplate)==13)
           {
               var direction = $('#direction').val();
               var flQuestion1 = $('#flQuestion1').val();
               var flQuestion1Ext = flQuestion1.substring(flQuestion1.lastIndexOf('.')+1);
               var answer1 = $('#answer1').val();
               var flQuestion2 = $('#flQuestion2').val();
               var flQuestion2Ext = flQuestion2.substring(flQuestion2.lastIndexOf('.')+1);
               var answer2 = $('#answer2').val();
               var flQuestion3 = $('#flQuestion3').val();
               var flQuestion3Ext = flQuestion3.substring(flQuestion3.lastIndexOf('.')+1);
               var answer3 = $('#answer3').val();
               var flQuestion4 = $('#flQuestion4').val();
               var flQuestion4Ext = flQuestion4.substring(flQuestion4.lastIndexOf('.')+1);
               var answer4 = $('#answer4').val();
               var flQuestion5 = $('#flQuestion5').val();
               var flQuestion5Ext = flQuestion5.substring(flQuestion5.lastIndexOf('.')+1);
               var answer5 = $('#answer5').val();
               var flQuestion6 = $('#flQuestion6').val();
               var flQuestion6Ext = flQuestion6.substring(flQuestion6.lastIndexOf('.')+1);
               var answer6 = $('#answer6').val();
               var flHorn   = $('#flHorn').val();
               var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);
               var duration = $('#duration').val();

               $('#err_direction').html('');
               $('#err_flQuestion1').html('');
               $('#err_answer1').html('');
               $('#err_flQuestion2').html('');
               $('#err_answer2').html('');
               $('#err_flQuestion3').html('');
               $('#err_answer3').html('');
               $('#err_flQuestion4').html('');
               $('#err_answer4').html('');
               $('#err_flQuestion5').html('');
               $('#err_answer5').html('');
               $('#err_flQuestion6').html('');
               $('#err_answer6').html('');
               $('#err_flHorn').html('');
               $('#err_duration').html('');

               if($.trim(direction)=='')
               {
                  $('#err_direction').html('This field is required.');
                  flag = 1;
               }

               if(flQuestion1 == '')
               {
                   $('#err_flQuestion1').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion1Ext == "jpg" || flQuestion1Ext == "jpeg" || flQuestion1Ext == "gif" || flQuestion1Ext == "png" || flQuestion1Ext == "GIF" || flQuestion1Ext == "JPG" || flQuestion1Ext == "JPEG" || flQuestion1Ext == "PNG"))
               {
                   $('#err_flQuestion1').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion1').attr('data-error')=='yes')
               {
                  $('#err_flQuestion1').html('File must be grater than / equal to 165 X 165.');
                  flag=1;  
               }
               if($.trim(answer1)=='')
               {
                  $('#err_answer1').html('This field is required.');
                  flag = 1;
               }


               if(flQuestion2 == '')
               {
                   $('#err_flQuestion2').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion2Ext == "jpg" || flQuestion2Ext == "jpeg" || flQuestion2Ext == "gif" || flQuestion2Ext == "png" || flQuestion2Ext == "GIF" || flQuestion2Ext == "JPG" || flQuestion2Ext == "JPEG" || flQuestion2Ext == "PNG"))
               {
                   $('#err_flQuestion2').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion2').attr('data-error')=='yes')
               {
                  $('#err_flQuestion2').html('File must be grater than / equal to 165 X 165.');
                  flag=1;  
               }
               if($.trim(answer2)=='')
               {
                  $('#err_answer2').html('This field is required.');
                  flag = 1;
               }

               if(flQuestion3 == '')
               {
                   $('#err_flQuestion3').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion3Ext == "jpg" || flQuestion3Ext == "jpeg" || flQuestion3Ext == "gif" || flQuestion3Ext == "png" || flQuestion3Ext == "GIF" || flQuestion3Ext == "JPG" || flQuestion3Ext == "JPEG" || flQuestion3Ext == "PNG"))
               {
                   $('#err_flQuestion3').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion3').attr('data-error')=='yes')
               {
                  $('#err_flQuestion3').html('File must be grater than / equal to 165 X 165.');
                  flag=1;  
               }
               if($.trim(answer3)=='')
               {
                  $('#err_answer3').html('This field is required.');
                  flag = 1;
               }

               if(flQuestion4 == '')
               {
                   $('#err_flQuestion4').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion4Ext == "jpg" || flQuestion4Ext == "jpeg" || flQuestion4Ext == "gif" || flQuestion4Ext == "png" || flQuestion4Ext == "GIF" || flQuestion4Ext == "JPG" || flQuestion4Ext == "JPEG" || flQuestion4Ext == "PNG"))
               {
                   $('#err_flQuestion4').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion4').attr('data-error')=='yes')
               {
                  $('#err_flQuestion4').html('File must be grater than / equal to 165 X 165.');
                  flag=1;  
               }
               if($.trim(answer4)=='')
               {
                  $('#err_answer4').html('This field is required.');
                  flag = 1;
               }

               if(flQuestion5 == '')
               {
                   $('#err_flQuestion5').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion5Ext == "jpg" || flQuestion5Ext == "jpeg" || flQuestion5Ext == "gif" || flQuestion5Ext == "png" || flQuestion5Ext == "GIF" || flQuestion5Ext == "JPG" || flQuestion5Ext == "JPEG" || flQuestion5Ext == "PNG"))
               {
                   $('#err_flQuestion5').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion5').attr('data-error')=='yes')
               {
                  $('#err_flQuestion5').html('File must be grater than / equal to 165 X 165.');
                  flag=1;  
               }
               if($.trim(answer5)=='')
               {
                  $('#err_answer5').html('This field is required.');
                  flag = 1;
               }

               if(flQuestion6 == '')
               {
                   $('#err_flQuestion6').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion6Ext == "jpg" || flQuestion6Ext == "jpeg" || flQuestion6Ext == "gif" || flQuestion6Ext == "png" || flQuestion6Ext == "GIF" || flQuestion6Ext == "JPG" || flQuestion6Ext == "JPEG" || flQuestion6Ext == "PNG"))
               {
                   $('#err_flQuestion6').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion6').attr('data-error')=='yes')
               {
                  $('#err_flQuestion6').html('File must be grater than / equal to 165 X 165.');
                  flag=1;  
               }
               if($.trim(answer6)=='')
               {
                  $('#err_answer6').html('This field is required.');
                  flag = 1;
               }

               if(flHorn == '')
               {
                   $('#err_flHorn').html('This field is required.');
                   flag = 1;
               }
               else if(!(flHornExt == "mp3" || flHornExt == "MP3" || flHornExt == "wave" || flHornExt == "m4a"))
               {
                   $('#err_flHorn').html('Invalid file type.');
                   flag = 1;
               }

               if($.trim(duration)=='' || parseInt(duration)==0)
               {
                  $('#err_duration').html('This field is required.');
                  flag = 1;
               }
               else if(isNaN(duration))
               {
                  $('#err_duration').html('Invalid time.');
                  flag = 1;
               }

           }

           else if(parseInt(hiddenTemplate)==14)
           {
               var direction = $('#direction').val();
               var flQuestion1 = $('#flQuestion1').val();
               var flQuestion1Ext = flQuestion1.substring(flQuestion1.lastIndexOf('.')+1);
               var answer1 = $('#answer1').val();
               var flQuestion2 = $('#flQuestion2').val();
               var flQuestion2Ext = flQuestion2.substring(flQuestion2.lastIndexOf('.')+1);
               var answer2 = $('#answer2').val();
               var flQuestion3 = $('#flQuestion3').val();
               var flQuestion3Ext = flQuestion3.substring(flQuestion3.lastIndexOf('.')+1);
               var answer3 = $('#answer3').val();
               var flQuestion4 = $('#flQuestion4').val();
               var flQuestion4Ext = flQuestion4.substring(flQuestion4.lastIndexOf('.')+1);
               var answer4 = $('#answer4').val();
               var flQuestion5 = $('#flQuestion5').val();
               var flQuestion5Ext = flQuestion5.substring(flQuestion5.lastIndexOf('.')+1);
               var answer5 = $('#answer5').val();
               var flQuestion6 = $('#flQuestion6').val();
               var flQuestion6Ext = flQuestion6.substring(flQuestion6.lastIndexOf('.')+1);
               var answer6 = $('#answer6').val();
               var flHorn   = $('#flHorn').val();
               var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);
               var duration = $('#duration').val();

               $('#err_direction').html('');
               $('#err_flQuestion1').html('');
               $('#err_answer1').html('');
               $('#err_flQuestion2').html('');
               $('#err_answer2').html('');
               $('#err_flQuestion3').html('');
               $('#err_answer3').html('');
               $('#err_flQuestion4').html('');
               $('#err_answer4').html('');
               $('#err_flQuestion5').html('');
               $('#err_answer5').html('');
               $('#err_flQuestion6').html('');
               $('#err_answer6').html('');
               $('#err_flHorn').html('');
               $('#err_duration').html('');

               if($.trim(direction)=='')
               {
                  $('#err_direction').html('This field is required.');
                  flag = 1;
               }

               if(flQuestion1 == '')
               {
                   $('#err_flQuestion1').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion1Ext == "jpg" || flQuestion1Ext == "jpeg" || flQuestion1Ext == "gif" || flQuestion1Ext == "png" || flQuestion1Ext == "GIF" || flQuestion1Ext == "JPG" || flQuestion1Ext == "JPEG" || flQuestion1Ext == "PNG"))
               {
                   $('#err_flQuestion1').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion1').attr('data-error')=='yes')
               {
                  $('#err_flQuestion1').html('File must be grater than / equal to 200 X 138.');
                  flag=1;  
               }
               if($.trim(answer1)=='')
               {
                  $('#err_answer1').html('This field is required.');
                  flag = 1;
               }


               if(flQuestion2 == '')
               {
                   $('#err_flQuestion2').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion2Ext == "jpg" || flQuestion2Ext == "jpeg" || flQuestion2Ext == "gif" || flQuestion2Ext == "png" || flQuestion2Ext == "GIF" || flQuestion2Ext == "JPG" || flQuestion2Ext == "JPEG" || flQuestion2Ext == "PNG"))
               {
                   $('#err_flQuestion2').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion2').attr('data-error')=='yes')
               {
                  $('#err_flQuestion2').html('File must be grater than / equal to 200 X 138.');
                  flag=1;  
               }
               if($.trim(answer2)=='')
               {
                  $('#err_answer2').html('This field is required.');
                  flag = 1;
               }

               if(flQuestion3 == '')
               {
                   $('#err_flQuestion3').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion3Ext == "jpg" || flQuestion3Ext == "jpeg" || flQuestion3Ext == "gif" || flQuestion3Ext == "png" || flQuestion3Ext == "GIF" || flQuestion3Ext == "JPG" || flQuestion3Ext == "JPEG" || flQuestion3Ext == "PNG"))
               {
                   $('#err_flQuestion3').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion3').attr('data-error')=='yes')
               {
                  $('#err_flQuestion3').html('File must be grater than / equal to 200 X 138.');
                  flag=1;  
               }
               if($.trim(answer3)=='')
               {
                  $('#err_answer3').html('This field is required.');
                  flag = 1;
               }

               if(flQuestion4 == '')
               {
                   $('#err_flQuestion4').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion4Ext == "jpg" || flQuestion4Ext == "jpeg" || flQuestion4Ext == "gif" || flQuestion4Ext == "png" || flQuestion4Ext == "GIF" || flQuestion4Ext == "JPG" || flQuestion4Ext == "JPEG" || flQuestion4Ext == "PNG"))
               {
                   $('#err_flQuestion4').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion4').attr('data-error')=='yes')
               {
                  $('#err_flQuestion4').html('File must be grater than / equal to 200 X 138.');
                  flag=1;  
               }
               if($.trim(answer4)=='')
               {
                  $('#err_answer4').html('This field is required.');
                  flag = 1;
               }

               if(flQuestion5 == '')
               {
                   $('#err_flQuestion5').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion5Ext == "jpg" || flQuestion5Ext == "jpeg" || flQuestion5Ext == "gif" || flQuestion5Ext == "png" || flQuestion5Ext == "GIF" || flQuestion5Ext == "JPG" || flQuestion5Ext == "JPEG" || flQuestion5Ext == "PNG"))
               {
                   $('#err_flQuestion5').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion5').attr('data-error')=='yes')
               {
                  $('#err_flQuestion5').html('File must be grater than / equal to 200 X 138.');
                  flag=1;  
               }
               if($.trim(answer5)=='')
               {
                  $('#err_answer5').html('This field is required.');
                  flag = 1;
               }

               if(flQuestion6 == '')
               {
                   $('#err_flQuestion6').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion6Ext == "jpg" || flQuestion6Ext == "jpeg" || flQuestion6Ext == "gif" || flQuestion6Ext == "png" || flQuestion6Ext == "GIF" || flQuestion6Ext == "JPG" || flQuestion6Ext == "JPEG" || flQuestion6Ext == "PNG"))
               {
                   $('#err_flQuestion6').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion6').attr('data-error')=='yes')
               {
                  $('#err_flQuestion6').html('File must be grater than / equal to 200 X 138.');
                  flag=1;  
               }
               if($.trim(answer6)=='')
               {
                  $('#err_answer6').html('This field is required.');
                  flag = 1;
               }

               if(flHorn == '')
               {
                   $('#err_flHorn').html('This field is required.');
                   flag = 1;
               }
               else if(!(flHornExt == "mp3" || flHornExt == "MP3" || flHornExt == "wave" || flHornExt == "m4a"))
               {
                   $('#err_flHorn').html('Invalid file type.');
                   flag = 1;
               }

               if($.trim(duration)=='' || parseInt(duration)==0)
               {
                  $('#err_duration').html('This field is required.');
                  flag = 1;
               }
               else if(isNaN(duration))
               {
                  $('#err_duration').html('Invalid time.');
                  flag = 1;
               }

           }

           else if(parseInt(hiddenTemplate)==15)
           {
              var direction = $('#direction').val();  
              var flQuestion1 = $('#flQuestion1').val();
              var flQuestion1Ext = flQuestion1.substring(flQuestion1.lastIndexOf('.')+1);
              var question1 = $('#question1').val();
              var rdoQuestion1 = $('input[name="rdoQuestion1"]:checked').val();
              var flQuestion2 = $('#flQuestion2').val();
              var flQuestion2Ext = flQuestion2.substring(flQuestion2.lastIndexOf('.')+1);
              var question2 = $('#question2').val();
              var rdoQuestion2 = $('input[name="rdoQuestion2"]:checked').val();
              var flHorn   = $('#flHorn').val();
              var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);
              var duration = $('#duration').val();

              $('#err_direction').html('');
              $('#err_flQuestion1').html('');
              $('#err_question1').html('');
              $('#err_rdoQuestion1').html('');
              $('#err_flQuestion2').html('');
              $('#err_question2').html('');
              $('#err_rdoQuestion2').html('');
              $('#err_flHorn').html('');
              $('#err_duration').html('');

              if($.trim(direction)=='')
               {
                  $('#err_direction').html('This field is required.');
                  flag = 1;
               }

               if(flQuestion1 == '')
               {
                   $('#err_flQuestion1').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion1Ext == "jpg" || flQuestion1Ext == "jpeg" || flQuestion1Ext == "gif" || flQuestion1Ext == "png" || flQuestion1Ext == "GIF" || flQuestion1Ext == "JPG" || flQuestion1Ext == "JPEG" || flQuestion1Ext == "PNG"))
               {
                   $('#err_flQuestion1').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion1').attr('data-error')=='yes')
               {
                  $('#err_flQuestion1').html('File must be grater than / equal to 570 X 442.');
                  flag=1;  
               }
               if($.trim(question1)=='')
               {
                  $('#err_question1').html('This field is required.');
                  flag = 1;
               }
               else
               {
                   if(rdoQuestion1==null)
                   {
                      $('#err_rdoQuestion1').html('This field is required.');
                      flag = 1;
                   }
               }

               if(flQuestion2 == '')
               {
                   $('#err_flQuestion2').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion2Ext == "jpg" || flQuestion2Ext == "jpeg" || flQuestion2Ext == "gif" || flQuestion2Ext == "png" || flQuestion2Ext == "GIF" || flQuestion2Ext == "JPG" || flQuestion2Ext == "JPEG" || flQuestion2Ext == "PNG"))
               {
                   $('#err_flQuestion2').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion2').attr('data-error')=='yes')
               {
                  $('#err_flQuestion2').html('File must be grater than / equal to 570 X 442.');
                  flag=1;  
               }
               if($.trim(question2)=='')
               {
                  $('#err_question2').html('This field is required.');
                  flag = 1;
               }
               else
               {
                   if(rdoQuestion2==null)
                   {
                      $('#err_rdoQuestion2').html('This field is required.');
                      flag = 1;
                   }
               }

               if(flHorn == '')
               {
                   $('#err_flHorn').html('This field is required.');
                   flag = 1;
               }
               else if(!(flHornExt == "mp3" || flHornExt == "MP3" || flHornExt == "wave" || flHornExt == "m4a"))
               {
                   $('#err_flHorn').html('Invalid file type.');
                   flag = 1;
               }

               if($.trim(duration)=='' || parseInt(duration)==0)
               {
                  $('#err_duration').html('This field is required.');
                  flag = 1;
               }
               else if(isNaN(duration))
               {
                  $('#err_duration').html('Invalid time.');
                  flag = 1;
               }

           }

           else if(parseInt(hiddenTemplate)==16)
           {
               var direction = $('#direction').val();
               var flQuestion1 = $('#flQuestion1').val();
               var flQuestion1Ext = flQuestion1.substring(flQuestion1.lastIndexOf('.')+1);
               var question1 = $('#question1').val();
               var answer1 = $('#answer1').val();
               var flQuestion2 = $('#flQuestion2').val();
               var flQuestion2Ext = flQuestion2.substring(flQuestion2.lastIndexOf('.')+1);
               var question2 = $('#question2').val();
               var answer2 = $('#answer2').val();
               var flHorn   = $('#flHorn').val();
               var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);
               var duration = $('#duration').val();

               $('#err_direction').html('');
               $('#err_flQuestion1').html('');
               $('#err_question1').html('');
               $('#err_answer1').html('');
               $('#err_flQuestion2').html('');
               $('#err_question2').html('');
               $('#err_answer2').html('');
               $('#err_flHorn').html('');
               $('#err_duration').html('');

               if($.trim(direction)=='')
               {
                  $('#err_direction').html('This field is required.');
                  flag = 1;
               }

               if(flQuestion1 == '')
               {
                   $('#err_flQuestion1').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion1Ext == "jpg" || flQuestion1Ext == "jpeg" || flQuestion1Ext == "gif" || flQuestion1Ext == "png" || flQuestion1Ext == "GIF" || flQuestion1Ext == "JPG" || flQuestion1Ext == "JPEG" || flQuestion1Ext == "PNG"))
               {
                   $('#err_flQuestion1').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion1').attr('data-error')=='yes')
               {
                  $('#err_flQuestion1').html('File must be grater than / equal to 570 X 442.');
                  flag=1;  
               }
               if($.trim(question1)=='')
               {
                  $('#err_question1').html('This field is required.');
                  flag = 1;
               }
               else
               {
                  var questionAnsArr = question1.match(/#BLANK#/g);
                  if(questionAnsArr==null)
                  {
                    $('#err_question1').html('#BLANK# is missing');
                    flag = 1;    
                  }
                  else
                  {
                    var questionAnsCount = questionAnsArr.length;  
                    if(parseInt(questionAnsCount)!=1)
                    {
                      $('#err_question1').html('Only one #BLANK# is allowed');
                      flag = 1;       
                    }
                  }
               }
               if($.trim(answer1)=='')
               {
                  $('#err_answer1').html('This field is required.');
                  flag = 1;
               }

               if(flQuestion2 == '')
               {
                   $('#err_flQuestion2').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion2Ext == "jpg" || flQuestion2Ext == "jpeg" || flQuestion2Ext == "gif" || flQuestion2Ext == "png" || flQuestion2Ext == "GIF" || flQuestion2Ext == "JPG" || flQuestion2Ext == "JPEG" || flQuestion2Ext == "PNG"))
               {
                   $('#err_flQuestion2').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion2').attr('data-error')=='yes')
               {
                  $('#err_flQuestion2').html('File must be grater than / equal to 570 X 442.');
                  flag=1;  
               }
               if($.trim(question2)=='')
               {
                  $('#err_question2').html('This field is required.');
                  flag = 1;
               }
               else
               {
                  var questionAnsArr = question2.match(/#BLANK#/g);
                  if(questionAnsArr==null)
                  {
                    $('#err_question2').html('#BLANK# is missing');
                    flag = 1;    
                  }
                  else
                  {
                    var questionAnsCount = questionAnsArr.length;  
                    if(parseInt(questionAnsCount)!=1)
                    {
                      $('#err_question2').html('Only one #BLANK# is allowed');
                      flag = 1;       
                    }
                  }
               }
               if($.trim(answer2)=='')
               {
                  $('#err_answer2').html('This field is required.');
                  flag = 1;
               }

               if(flHorn == '')
               {
                   $('#err_flHorn').html('This field is required.');
                   flag = 1;
               }
               else if(!(flHornExt == "mp3" || flHornExt == "MP3" || flHornExt == "wave" || flHornExt == "m4a"))
               {
                   $('#err_flHorn').html('Invalid file type.');
                   flag = 1;
               }

               if($.trim(duration)=='' || parseInt(duration)==0)
               {
                  $('#err_duration').html('This field is required.');
                  flag = 1;
               }
               else if(isNaN(duration))
               {
                  $('#err_duration').html('Invalid time.');
                  flag = 1;
               }
           }

           else if(parseInt(hiddenTemplate)==17)
           {
               var direction = $('#direction').val();
               var question1 = $('#question1').val();
               var option1_1 = $('#option1_1').val();
               var option1_2 = $('#option1_2').val();
               var option1_3 = $('#option1_3').val();
               var rdoOption1 = $('input[name="rdoOption1"]:checked').val();
               var question2 = $('#question2').val();
               var option2_1 = $('#option2_1').val();
               var option2_2 = $('#option2_2').val();
               var option2_3 = $('#option2_3').val();
               var rdoOption2 = $('input[name="rdoOption2"]:checked').val();
               var flHorn   = $('#flHorn').val();
               var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);
               var duration = $('#duration').val();

               $('#err_direction').html('');
               $('#err_question1').html('');
               $('#err_option1_1').html('');
               $('#err_option1_2').html('');
               $('#err_option1_3').html('');
               $('#err_rdoOption1').html('');
               $('#err_question2').html('');
               $('#err_option2_1').html('');
               $('#err_option2_2').html('');
               $('#err_option2_3').html('');
               $('#err_rdoOption2').html('');
               $('#err_flHorn').html('');
               $('#err_duration').html('');

               if($.trim(direction)=='')
               {
                  $('#err_direction').html('This field is required.');
                  flag = 1;
               }

               if($.trim(question1)=='')
               {
                  $('#err_question1').html('This field is required.');
                  flag = 1;
               }
               else
               {
                  var questionAnsArr = question1.match(/#BLANK#/g);
                  if(questionAnsArr==null)
                  {
                    $('#err_question1').html('#BLANK# is missing');
                    flag = 1;    
                  }
                  else
                  {
                    var questionAnsCount = questionAnsArr.length;  
                    if(parseInt(questionAnsCount)!=1)
                    {
                      $('#err_question1').html('Only one #BLANK# is allowed');
                      flag = 1;       
                    }
                  }
               }
               if($.trim(option1_1)=='')
               {
                  $('#err_option1_1').html('This field is required.');
                  flag = 1;
               }
               if($.trim(option1_2)=='')
               {
                  $('#err_option1_2').html('This field is required.');
                  flag = 1;
               }
               if($.trim(option1_3)=='')
               {
                  $('#err_option1_3').html('This field is required.');
                  flag = 1;
               }
               if(rdoOption1==null)
               {
                   $('#err_rdoOption1').html('Choose one option as answer');
                   flag = 1;
               }

               if($.trim(question2)=='')
               {
                  $('#err_question2').html('This field is required.');
                  flag = 1;
               }
               else
               {
                  var questionAnsArr = question2.match(/#BLANK#/g);
                  if(questionAnsArr==null)
                  {
                    $('#err_question2').html('#BLANK# is missing');
                    flag = 1;    
                  }
                  else
                  {
                    var questionAnsCount = questionAnsArr.length;  
                    if(parseInt(questionAnsCount)!=1)
                    {
                      $('#err_question2').html('Only one #BLANK# is allowed');
                      flag = 1;       
                    }
                  }
               }
               if($.trim(option2_1)=='')
               {
                  $('#err_option2_1').html('This field is required.');
                  flag = 1;
               }
               if($.trim(option2_2)=='')
               {
                  $('#err_option2_2').html('This field is required.');
                  flag = 1;
               }
               if($.trim(option2_3)=='')
               {
                  $('#err_option2_3').html('This field is required.');
                  flag = 1;
               }
               if(rdoOption2==null)
               {
                   $('#err_rdoOption2').html('Choose one option as answer');
                   flag = 1;
               }
               
               if(flHorn == '')
               {
                   $('#err_flHorn').html('This field is required.');
                   flag = 1;
               }
               else if(!(flHornExt == "mp3" || flHornExt == "MP3" || flHornExt == "wave" || flHornExt == "m4a"))
               {
                   $('#err_flHorn').html('Invalid file type.');
                   flag = 1;
               }

               if($.trim(duration)=='' || parseInt(duration)==0)
               {
                  $('#err_duration').html('This field is required.');
                  flag = 1;
               }
               else if(isNaN(duration))
               {
                  $('#err_duration').html('Invalid time.');
                  flag = 1;
               }
           }

           else if(parseInt(hiddenTemplate)==18)
           {
               var direction = $('#direction').val();

               var flQuestion1 = $('#flQuestion1').val();
               var flQuestion1Ext = flQuestion1.substring(flQuestion1.lastIndexOf('.') + 1);
               var question1 = $('#question1').val();

               var flQuestion2 = $('#flQuestion2').val();
               var flQuestion2Ext = flQuestion2.substring(flQuestion2.lastIndexOf('.') + 1);
               var question2 = $('#question2').val();

               var flQuestion3 = $('#flQuestion3').val();
               var flQuestion3Ext = flQuestion3.substring(flQuestion3.lastIndexOf('.') + 1);
               var question3 = $('#question3').val();

               var flQuestion4 = $('#flQuestion4').val();
               var flQuestion4Ext = flQuestion4.substring(flQuestion4.lastIndexOf('.') + 1);
               var question4 = $('#question4').val();

               var flQuestion5 = $('#flQuestion5').val();
               var flQuestion5Ext = flQuestion5.substring(flQuestion5.lastIndexOf('.') + 1);
               var question5 = $('#question5').val();

               var flQuestion6 = $('#flQuestion6').val();
               var flQuestion6Ext = flQuestion6.substring(flQuestion6.lastIndexOf('.') + 1);
               var question6 = $('#question6').val();

               var flHorn   = $('#flHorn').val();
               var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);
               var duration = $('#duration').val();
   
               $('#err_direction').html('');
               
               $('#err_flQuestion1').html('');
               $('#err_question1').html('');
               $('#err_chkBlankLetter1').html('');

               $('#err_flQuestion2').html('');
               $('#err_question2').html('');
               $('#err_chkBlankLetter2').html('');

               $('#err_flQuestion3').html('');
               $('#err_question3').html('');
               $('#err_chkBlankLetter3').html('');

               $('#err_flQuestion4').html('');
               $('#err_question4').html('');
               $('#err_chkBlankLetter4').html('');

               $('#err_flQuestion5').html('');
               $('#err_question5').html('');
               $('#err_chkBlankLetter5').html('');

               $('#err_flQuestion6').html('');
               $('#err_question6').html('');
               $('#err_chkBlankLetter6').html('');

               $('#err_flHorn').html('');
               $('#err_duration').html('');

               if($.trim(direction)=='')
               {
                  $('#err_direction').html('This field is required.');
                  flag = 1;  
               }

               if(flQuestion1 == '')
               {
                   $('#err_flQuestion1').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion1Ext == "jpg" || flQuestion1Ext == "jpeg" || flQuestion1Ext == "gif" || flQuestion1Ext == "png" || flQuestion1Ext == "GIF" || flQuestion1Ext == "JPG" || flQuestion1Ext == "JPEG" || flQuestion1Ext == "PNG"))
               {
                   $('#err_flQuestion1').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion1').attr('data-error')=='yes')
               {
                  $('#err_flQuestion1').html('File must be grater than / equal to 185 X 121.');
                  flag=1;  
               }
               if($.trim(question1)=='')
               {
                  $('#err_question1').html('This field is required.');
                  flag = 1;
               }
               else
               {
                  if($('input[name="chkBlankLetter1[]"]:checked').length == 0)
                  {
                    $('#err_chkBlankLetter1').html('Please checked atleast one checkbox');
                    flag = 1;
                  }
               }

               if(flQuestion2 == '')
               {
                   $('#err_flQuestion2').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion2Ext == "jpg" || flQuestion2Ext == "jpeg" || flQuestion2Ext == "gif" || flQuestion2Ext == "png" || flQuestion2Ext == "GIF" || flQuestion2Ext == "JPG" || flQuestion2Ext == "JPEG" || flQuestion2Ext == "PNG"))
               {
                   $('#err_flQuestion2').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion2').attr('data-error')=='yes')
               {
                  $('#err_flQuestion2').html('File must be grater than / equal to 185 X 121.');
                  flag=1;  
               }
               if($.trim(question2)=='')
               {
                  $('#err_question2').html('This field is required.');
                  flag = 1;
               }
               else
               {
                  if($('input[name="chkBlankLetter2[]"]:checked').length == 0)
                  {
                    $('#err_chkBlankLetter2').html('Please checked atleast one checkbox');
                    flag = 1;
                  }
               }

               if(flQuestion3 == '')
               {
                   $('#err_flQuestion3').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion3Ext == "jpg" || flQuestion3Ext == "jpeg" || flQuestion3Ext == "gif" || flQuestion3Ext == "png" || flQuestion3Ext == "GIF" || flQuestion3Ext == "JPG" || flQuestion3Ext == "JPEG" || flQuestion3Ext == "PNG"))
               {
                   $('#err_flQuestion3').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion3').attr('data-error')=='yes')
               {
                  $('#err_flQuestion3').html('File must be grater than / equal to 185 X 121.');
                  flag=1;  
               }
               if($.trim(question3)=='')
               {
                  $('#err_question3').html('This field is required.');
                  flag = 1;
               }
               else
               {
                  if($('input[name="chkBlankLetter3[]"]:checked').length == 0)
                  {
                    $('#err_chkBlankLetter3').html('Please checked atleast one checkbox');
                    flag = 1;
                  }
               }

               if(flQuestion4 == '')
               {
                   $('#err_flQuestion4').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion4Ext == "jpg" || flQuestion4Ext == "jpeg" || flQuestion4Ext == "gif" || flQuestion4Ext == "png" || flQuestion4Ext == "GIF" || flQuestion4Ext == "JPG" || flQuestion4Ext == "JPEG" || flQuestion4Ext == "PNG"))
               {
                   $('#err_flQuestion4').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion4').attr('data-error')=='yes')
               {
                  $('#err_flQuestion4').html('File must be grater than / equal to 185 X 121.');
                  flag=1;  
               }
               if($.trim(question4)=='')
               {
                  $('#err_question4').html('This field is required.');
                  flag = 1;
               }
               else
               {
                  if($('input[name="chkBlankLetter4[]"]:checked').length == 0)
                  {
                    $('#err_chkBlankLetter4').html('Please checked atleast one checkbox');
                    flag = 1;
                  }
               }

               if(flQuestion5 == '')
               {
                   $('#err_flQuestion5').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion5Ext == "jpg" || flQuestion5Ext == "jpeg" || flQuestion5Ext == "gif" || flQuestion5Ext == "png" || flQuestion5Ext == "GIF" || flQuestion5Ext == "JPG" || flQuestion5Ext == "JPEG" || flQuestion5Ext == "PNG"))
               {
                   $('#err_flQuestion5').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion5').attr('data-error')=='yes')
               {
                  $('#err_flQuestion5').html('File must be grater than / equal to 185 X 121.');
                  flag=1;  
               }
               if($.trim(question5)=='')
               {
                  $('#err_question5').html('This field is required.');
                  flag = 1;
               }
               else
               {
                  if($('input[name="chkBlankLetter5[]"]:checked').length == 0)
                  {
                    $('#err_chkBlankLetter5').html('Please checked atleast one checkbox');
                    flag = 1;
                  }
               }

               if(flQuestion6 == '')
               {
                   $('#err_flQuestion6').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion6Ext == "jpg" || flQuestion6Ext == "jpeg" || flQuestion6Ext == "gif" || flQuestion6Ext == "png" || flQuestion6Ext == "GIF" || flQuestion6Ext == "JPG" || flQuestion6Ext == "JPEG" || flQuestion6Ext == "PNG"))
               {
                   $('#err_flQuestion6').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion6').attr('data-error')=='yes')
               {
                  $('#err_flQuestion6').html('File must be grater than / equal to 185 X 121.');
                  flag=1;  
               }
               if($.trim(question6)=='')
               {
                  $('#err_question6').html('This field is required.');
                  flag = 1;
               }
               else
               {
                  if($('input[name="chkBlankLetter6[]"]:checked').length == 0)
                  {
                    $('#err_chkBlankLetter6').html('Please checked atleast one checkbox');
                    flag = 1;
                  }
               }

               if(flHorn == '')
               {
                   $('#err_flHorn').html('This field is required.');
                   flag = 1;
               }
               else if(!(flHornExt == "mp3" || flHornExt == "MP3" || flHornExt == "wave" || flHornExt == "m4a"))
               {
                   $('#err_flHorn').html('Invalid file type.');
                   flag = 1;
               }

               if($.trim(duration)=='' || parseInt(duration)==0)
               {
                  $('#err_duration').html('This field is required.');
                  flag = 1;
               }
               else if(isNaN(duration))
               {
                  $('#err_duration').html('Invalid time.');
                  flag = 1;
               }
           }

           else if(parseInt(hiddenTemplate)==19)
           {
               var direction = $('#direction').val();
               var flQuestion1 = $('#flQuestion1').val();
               var flQuestion1Ext = flQuestion1.substring(flQuestion1.lastIndexOf('.') + 1);
               var answer1 = $('#answer1').val();
               var flQuestion2 = $('#flQuestion2').val();
               var flQuestion2Ext = flQuestion2.substring(flQuestion2.lastIndexOf('.') + 1);
               var answer2 = $('#answer2').val();
               var flQuestion3 = $('#flQuestion3').val();
               var flQuestion3Ext = flQuestion3.substring(flQuestion3.lastIndexOf('.') + 1);
               var answer3 = $('#answer3').val();
               var flQuestion4 = $('#flQuestion4').val();
               var flQuestion4Ext = flQuestion4.substring(flQuestion4.lastIndexOf('.') + 1);
               var answer4 = $('#answer4').val();
               var flQuestion5 = $('#flQuestion5').val();
               var flQuestion5Ext = flQuestion5.substring(flQuestion5.lastIndexOf('.') + 1);
               var answer5 = $('#answer5').val();
               var flQuestion6 = $('#flQuestion6').val();
               var flQuestion6Ext = flQuestion6.substring(flQuestion6.lastIndexOf('.') + 1);
               var answer6 = $('#answer6').val();
               var flHorn   = $('#flHorn').val();
               var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);
               var duration = $('#duration').val();
   
               $('#err_direction').html('');
               $('#err_flQuestion1').html('');
               $('#err_answer1').html('');
               $('#err_flQuestion2').html('');
               $('#err_answer2').html('');
               $('#err_flQuestion3').html('');
               $('#err_answer3').html('');
               $('#err_flQuestion4').html('');
               $('#err_answer4').html('');
               $('#err_flQuestion5').html('');
               $('#err_answer5').html('');
               $('#err_flQuestion6').html('');
               $('#err_answer6').html('');
               $('#err_flHorn').html('');
               $('#err_duration').html('');

               if($.trim(direction)=='')
               {
                  $('#err_direction').html('This field is required.');
                  flag = 1;  
               }

               if(flQuestion1 == '')
               {
                   $('#err_flQuestion1').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion1Ext == "jpg" || flQuestion1Ext == "jpeg" || flQuestion1Ext == "gif" || flQuestion1Ext == "png" || flQuestion1Ext == "GIF" || flQuestion1Ext == "JPG" || flQuestion1Ext == "JPEG" || flQuestion1Ext == "PNG"))
               {
                   $('#err_flQuestion1').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion1').attr('data-error')=='yes')
               {
                  $('#err_flQuestion1').html('File must be grater than / equal to 185 X 121.');
                  flag=1;  
               }
               if($.trim(answer1)=='')
               {
                  $('#err_answer1').html('This field is required.');
                  flag = 1;
               }
               
               if(flQuestion2 == '')
               {
                   $('#err_flQuestion2').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion2Ext == "jpg" || flQuestion2Ext == "jpeg" || flQuestion2Ext == "gif" || flQuestion2Ext == "png" || flQuestion2Ext == "GIF" || flQuestion2Ext == "JPG" || flQuestion2Ext == "JPEG" || flQuestion2Ext == "PNG"))
               {
                   $('#err_flQuestion2').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion2').attr('data-error')=='yes')
               {
                  $('#err_flQuestion2').html('File must be grater than / equal to 185 X 121.');
                  flag=1;  
               }
               if($.trim(answer2)=='')
               {
                  $('#err_answer2').html('This field is required.');
                  flag = 1;
               }
               
               if(flQuestion3 == '')
               {
                   $('#err_flQuestion3').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion3Ext == "jpg" || flQuestion3Ext == "jpeg" || flQuestion3Ext == "gif" || flQuestion3Ext == "png" || flQuestion3Ext == "GIF" || flQuestion3Ext == "JPG" || flQuestion3Ext == "JPEG" || flQuestion3Ext == "PNG"))
               {
                   $('#err_flQuestion3').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion3').attr('data-error')=='yes')
               {
                  $('#err_flQuestion3').html('File must be grater than / equal to 185 X 121.');
                  flag=1;  
               }
               if($.trim(answer3)=='')
               {
                  $('#err_answer3').html('This field is required.');
                  flag = 1;
               }
               
               if(flQuestion4 == '')
               {
                   $('#err_flQuestion4').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion4Ext == "jpg" || flQuestion4Ext == "jpeg" || flQuestion4Ext == "gif" || flQuestion4Ext == "png" || flQuestion4Ext == "GIF" || flQuestion4Ext == "JPG" || flQuestion4Ext == "JPEG" || flQuestion4Ext == "PNG"))
               {
                   $('#err_flQuestion4').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion4').attr('data-error')=='yes')
               {
                  $('#err_flQuestion4').html('File must be grater than / equal to 185 X 121.');
                  flag=1;  
               }
               if($.trim(answer4)=='')
               {
                  $('#err_answer4').html('This field is required.');
                  flag = 1;
               }
               
               if(flQuestion5 == '')
               {
                   $('#err_flQuestion5').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion5Ext == "jpg" || flQuestion5Ext == "jpeg" || flQuestion5Ext == "gif" || flQuestion5Ext == "png" || flQuestion5Ext == "GIF" || flQuestion5Ext == "JPG" || flQuestion5Ext == "JPEG" || flQuestion5Ext == "PNG"))
               {
                   $('#err_flQuestion5').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion5').attr('data-error')=='yes')
               {
                  $('#err_flQuestion5').html('File must be grater than / equal to 185 X 121.');
                  flag=1;  
               }
               if($.trim(answer5)=='')
               {
                  $('#err_answer5').html('This field is required.');
                  flag = 1;
               }
               
               if(flQuestion6 == '')
               {
                   $('#err_flQuestion6').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion6Ext == "jpg" || flQuestion6Ext == "jpeg" || flQuestion6Ext == "gif" || flQuestion6Ext == "png" || flQuestion6Ext == "GIF" || flQuestion6Ext == "JPG" || flQuestion6Ext == "JPEG" || flQuestion6Ext == "PNG"))
               {
                   $('#err_flQuestion6').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion6').attr('data-error')=='yes')
               {
                  $('#err_flQuestion6').html('File must be grater than / equal to 185 X 121.');
                  flag=1;  
               }
               if($.trim(answer6)=='')
               {
                  $('#err_answer6').html('This field is required.');
                  flag = 1;
               }
               
               if(flHorn == '')
               {
                   $('#err_flHorn').html('This field is required.');
                   flag = 1;
               }
               else if(!(flHornExt == "mp3" || flHornExt == "MP3" || flHornExt == "wave" || flHornExt == "m4a"))
               {
                   $('#err_flHorn').html('Invalid file type.');
                   flag = 1;
               }

               if($.trim(duration)=='' || parseInt(duration)==0)
               {
                  $('#err_duration').html('This field is required.');
                  flag = 1;
               }
               else if(isNaN(duration))
               {
                  $('#err_duration').html('Invalid time.');
                  flag = 1;
               }
           }

           else if(parseInt(hiddenTemplate)==20)
           {
              var direction = $('#direction').val();
              var flQuestion1 = $('#flQuestion1').val();
              var flQuestion1Ext = flQuestion1.substring(flQuestion1.lastIndexOf('.') + 1);
              var option1_1 = $('#option1_1').val();
              var option1_2 = $('#option1_2').val();
              var option1_3 = $('#option1_3').val();
              var rdoOption1 = $('input[name="rdoOption1"]:checked').val();
              var flQuestion2 = $('#flQuestion2').val();
              var flQuestion2Ext = flQuestion2.substring(flQuestion2.lastIndexOf('.') + 1);
              var option2_1 = $('#option2_1').val();
              var option2_2 = $('#option2_2').val();
              var option2_3 = $('#option2_3').val();
              var rdoOption2 = $('input[name="rdoOption2"]:checked').val();
              var flHorn   = $('#flHorn').val();
              var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);
              var duration = $('#duration').val();

              $('#err_direction').html('');

              $('#err_flQuestion1').html('');
              $('#err_option1_1').html('');
              $('#err_option1_2').html('');
              $('#err_option1_3').html('');
              $('#err_rdoOption1').html('');
              $('#err_flQuestion2').html('');
              $('#err_option2_1').html('');
              $('#err_option2_2').html('');
              $('#err_option2_3').html('');
              $('#err_rdoOption2').html('');
              $('#err_flHorn').html('');
              $('#err_duration').html('');

               if($.trim(direction)=='')
               {
                  $('#err_direction').html('This field is required.');
                  flag = 1;  
               }

               if(flQuestion1 == '')
               {
                   $('#err_flQuestion1').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion1Ext == "jpg" || flQuestion1Ext == "jpeg" || flQuestion1Ext == "gif" || flQuestion1Ext == "png" || flQuestion1Ext == "GIF" || flQuestion1Ext == "JPG" || flQuestion1Ext == "JPEG" || flQuestion1Ext == "PNG"))
               {
                   $('#err_flQuestion1').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion1').attr('data-error')=='yes')
               {
                  $('#err_flQuestion1').html('File must be grater than / equal to 570 X 442.');
                  flag=1;  
               }
               if($.trim(option1_1)=='')
               {
                  $('#err_option1_1').html('This field is required.');
                  flag = 1;  
               }
               if($.trim(option1_2)=='')
               {
                  $('#err_option1_2').html('This field is required.');
                  flag = 1;  
               }
               if($.trim(option1_3)=='')
               {
                  $('#err_option1_3').html('This field is required.');
                  flag = 1;  
               }
               if(rdoOption1==null)
               {
                   $('#err_rdoOption1').html('Choose one option as answer');
                   flag = 1;
               }

               if(flQuestion2 == '')
               {
                   $('#err_flQuestion2').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion2Ext == "jpg" || flQuestion2Ext == "jpeg" || flQuestion2Ext == "gif" || flQuestion2Ext == "png" || flQuestion2Ext == "GIF" || flQuestion2Ext == "JPG" || flQuestion2Ext == "JPEG" || flQuestion2Ext == "PNG"))
               {
                   $('#err_flQuestion2').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion2').attr('data-error')=='yes')
               {
                  $('#err_flQuestion2').html('File must be grater than / equal to 570 X 442.');
                  flag=1;  
               }
               if($.trim(option2_1)=='')
               {
                  $('#err_option2_1').html('This field is required.');
                  flag = 1;  
               }
               if($.trim(option2_2)=='')
               {
                  $('#err_option2_2').html('This field is required.');
                  flag = 1;  
               }
               if($.trim(option2_3)=='')
               {
                  $('#err_option2_3').html('This field is required.');
                  flag = 1;  
               }
               if(rdoOption2==null)
               {
                   $('#err_rdoOption2').html('Choose one option as answer');
                   flag = 1;
               }

               if(flHorn == '')
               {
                   $('#err_flHorn').html('This field is required.');
                   flag = 1;
               }
               else if(!(flHornExt == "mp3" || flHornExt == "MP3" || flHornExt == "wave" || flHornExt == "m4a"))
               {
                   $('#err_flHorn').html('Invalid file type.');
                   flag = 1;
               }

               if($.trim(duration)=='' || parseInt(duration)==0)
               {
                  $('#err_duration').html('This field is required.');
                  flag = 1;
               }
               else if(isNaN(duration))
               {
                  $('#err_duration').html('Invalid time.');
                  flag = 1;
               }

           }

           else if(parseInt(hiddenTemplate)==21)
           {
              var direction = $('#direction').val();
              var question1 = $('#question1').val();
              var answer1 = $('#answer1').val();
              var question2 = $('#question2').val();
              var answer2 = $('#answer2').val();
              var question3 = $('#question3').val();
              var answer3 = $('#answer3').val();
              var question4 = $('#question4').val();
              var answer4 = $('#answer4').val();
              var question5 = $('#question5').val();
              var answer5 = $('#answer5').val();
              var question6 = $('#question6').val();
              var answer6 = $('#answer6').val();
              var flHorn   = $('#flHorn').val();
              var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);
              var duration = $('#duration').val();

              $('#err_direction').html('');
              $('#err_question1').html('');
              $('#err_answer1').html('');
              $('#err_question2').html('');
              $('#err_answer2').html('');
              $('#err_question3').html('');
              $('#err_answer3').html('');
              $('#err_question4').html('');
              $('#err_answer4').html('');
              $('#err_question5').html('');
              $('#err_answer5').html('');
              $('#err_question6').html('');
              $('#err_answer6').html('');
              $('#err_flHorn').html('');
              $('#err_duration').html('');

               if($.trim(direction)=='')
               {
                  $('#err_direction').html('This field is required.');
                  flag = 1;  
               }

               if($.trim(question1)=='')
               {
                  $('#err_question1').html('This field is required.');
                  flag = 1;  
               }
               if($.trim(answer1)=='')
               {
                  $('#err_answer1').html('This field is required.');
                  flag = 1;  
               }

               if($.trim(question2)=='')
               {
                  $('#err_question2').html('This field is required.');
                  flag = 1;  
               }
               if($.trim(answer2)=='')
               {
                  $('#err_answer2').html('This field is required.');
                  flag = 1;  
               }

               if($.trim(question3)=='')
               {
                  $('#err_question3').html('This field is required.');
                  flag = 1;  
               }
               if($.trim(answer3)=='')
               {
                  $('#err_answer3').html('This field is required.');
                  flag = 1;  
               }

               if($.trim(question4)=='')
               {
                  $('#err_question4').html('This field is required.');
                  flag = 1;  
               }
               if($.trim(answer4)=='')
               {
                  $('#err_answer4').html('This field is required.');
                  flag = 1;  
               }

               if($.trim(question5)=='')
               {
                  $('#err_question5').html('This field is required.');
                  flag = 1;  
               }
               if($.trim(answer5)=='')
               {
                  $('#err_answer5').html('This field is required.');
                  flag = 1;  
               }

               if($.trim(question6)=='')
               {
                  $('#err_question6').html('This field is required.');
                  flag = 1;  
               }
               if($.trim(answer6)=='')
               {
                  $('#err_answer6').html('This field is required.');
                  flag = 1;  
               }

               if(flHorn == '')
               {
                   $('#err_flHorn').html('This field is required.');
                   flag = 1;
               }
               else if(!(flHornExt == "mp3" || flHornExt == "MP3" || flHornExt == "wave" || flHornExt == "m4a"))
               {
                   $('#err_flHorn').html('Invalid file type.');
                   flag = 1;
               }

               if($.trim(duration)=='' || parseInt(duration)==0)
               {
                  $('#err_duration').html('This field is required.');
                  flag = 1;
               }
               else if(isNaN(duration))
               {
                  $('#err_duration').html('Invalid time.');
                  flag = 1;
               }

           }

           else if(parseInt(hiddenTemplate)==22)
           {
              var direction = $('#direction').val();
              var question1 = $('#question1').val();
              var answer1 = $('#answer1').val();
              var question2 = $('#question2').val();
              var answer2 = $('#answer2').val();
              var flHorn   = $('#flHorn').val();
              var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);
              var duration = $('#duration').val();

              $('#err_direction').html('');
              $('#err_question1').html('');
              $('#err_answer1').html('');
              $('#err_question2').html('');
              $('#err_answer2').html('');
              $('#err_flHorn').html('');
              $('#err_duration').html('');

               if($.trim(direction)=='')
               {
                  $('#err_direction').html('This field is required.');
                  flag = 1;  
               }

               if($.trim(question1)=='')
               {
                  $('#err_question1').html('This field is required.');
                  flag = 1;  
               }
               else
               {
                  var questionAnsArr = question1.match(/#BLANK#/g);
                  if(questionAnsArr==null)
                  {
                    $('#err_question1').html('#BLANK# is missing');
                    flag = 1;    
                  }
                  else
                  {
                    var questionAnsCount = questionAnsArr.length;  
                    if(parseInt(questionAnsCount)!=1)
                    {
                      $('#err_question1').html('Only one #BLANK# is allowed');
                      flag = 1;       
                    }
                  }
               }
               if($.trim(answer1)=='')
               {
                  $('#err_answer1').html('This field is required.');
                  flag = 1;  
               }

               if($.trim(question2)=='')
               {
                  $('#err_question2').html('This field is required.');
                  flag = 1;  
               }
               else
               {
                  var questionAnsArr = question2.match(/#BLANK#/g);
                  if(questionAnsArr==null)
                  {
                    $('#err_question2').html('#BLANK# is missing');
                    flag = 1;    
                  }
                  else
                  {
                    var questionAnsCount = questionAnsArr.length;  
                    if(parseInt(questionAnsCount)!=1)
                    {
                      $('#err_question2').html('Only one #BLANK# is allowed');
                      flag = 1;       
                    }
                  }
               }
               if($.trim(answer2)=='')
               {
                  $('#err_answer2').html('This field is required.');
                  flag = 1;  
               }

               if(flHorn == '')
               {
                   $('#err_flHorn').html('This field is required.');
                   flag = 1;
               }
               else if(!(flHornExt == "mp3" || flHornExt == "MP3" || flHornExt == "wave" || flHornExt == "m4a"))
               {
                   $('#err_flHorn').html('Invalid file type.');
                   flag = 1;
               }

               if($.trim(duration)=='' || parseInt(duration)==0)
               {
                  $('#err_duration').html('This field is required.');
                  flag = 1;
               }
               else if(isNaN(duration))
               {
                  $('#err_duration').html('Invalid time.');
                  flag = 1;
               }

           }

           else if(parseInt(hiddenTemplate)==23)
           {
              var direction = $('#direction').val();
              var question = $('#question').val();
              var flHorn   = $('#flHorn').val();
              var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);
              var duration = $('#duration').val();

              $('#err_direction').html('');
              $('#err_question').html('');
              $('#err_flHorn').html('');
              $('#err_duration').html('');

               if($.trim(direction)=='')
               {
                  $('#err_direction').html('This field is required.');
                  flag = 1;  
               }

               if($.trim(question)=='')
               {
                  $('#err_question').html('This field is required.');
                  flag = 1;  
               }
               
               if(flHorn == '')
               {
                   $('#err_flHorn').html('This field is required.');
                   flag = 1;
               }
               else if(!(flHornExt == "mp3" || flHornExt == "MP3" || flHornExt == "wave" || flHornExt == "m4a"))
               {
                   $('#err_flHorn').html('Invalid file type.');
                   flag = 1;
               }

               if($.trim(duration)=='' || parseInt(duration)==0)
               {
                  $('#err_duration').html('This field is required.');
                  flag = 1;
               }
               else if(isNaN(duration))
               {
                  $('#err_duration').html('Invalid time.');
                  flag = 1;
               }

           }

           else if(parseInt(hiddenTemplate)==24)
           {
              var direction = $('#direction').val();
              var question1 = $('#question1').val();
              var answer1 = $('#answer1').val();
              var question2 = $('#question2').val();
              var answer2 = $('#answer2').val();
              var question3 = $('#question3').val();
              var answer3 = $('#answer3').val();
              var question4 = $('#question4').val();
              var answer4 = $('#answer4').val();
              var question5 = $('#question5').val();
              var answer5 = $('#answer5').val();
              var question6 = $('#question6').val();
              var answer6 = $('#answer6').val();
              var question7 = $('#question7').val();
              var answer7 = $('#answer7').val();
              var question8 = $('#question8').val();
              var answer8 = $('#answer8').val();
              var flHorn   = $('#flHorn').val();
              var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);
              var duration = $('#duration').val();

              $('#err_direction').html('');
              $('#err_question1').html('');
              $('#err_answer1').html('');
              $('#err_question2').html('');
              $('#err_answer2').html('');
              $('#err_question3').html('');
              $('#err_answer3').html('');
              $('#err_question4').html('');
              $('#err_answer4').html('');
              $('#err_question5').html('');
              $('#err_answer5').html('');
              $('#err_question6').html('');
              $('#err_answer6').html('');
              $('#err_question7').html('');
              $('#err_answer7').html('');
              $('#err_question8').html('');
              $('#err_answer8').html('');
              $('#err_flHorn').html('');
              $('#err_duration').html('');

               if($.trim(direction)=='')
               {
                  $('#err_direction').html('This field is required.');
                  flag = 1;  
               }

               if($.trim(question1)=='')
               {
                  $('#err_question1').html('This field is required.');
                  flag = 1;  
               }
               if($.trim(answer1)=='')
               {
                  $('#err_answer1').html('This field is required.');
                  flag = 1;  
               }

               if($.trim(question2)=='')
               {
                  $('#err_question2').html('This field is required.');
                  flag = 1;  
               }
               if($.trim(answer2)=='')
               {
                  $('#err_answer2').html('This field is required.');
                  flag = 1;  
               }

               if($.trim(question3)=='')
               {
                  $('#err_question3').html('This field is required.');
                  flag = 1;  
               }
               if($.trim(answer3)=='')
               {
                  $('#err_answer3').html('This field is required.');
                  flag = 1;  
               }

               if($.trim(question4)=='')
               {
                  $('#err_question4').html('This field is required.');
                  flag = 1;  
               }
               if($.trim(answer4)=='')
               {
                  $('#err_answer4').html('This field is required.');
                  flag = 1;  
               }

               if($.trim(question5)!='' || $.trim(answer5)!='')
               {
                 if($.trim(question5)=='')
                 {
                    $('#err_question5').html('This field is required.');
                    flag = 1;  
                 }
                 if($.trim(answer5)=='')
                 {
                    $('#err_answer5').html('This field is required.');
                    flag = 1;  
                 }
               }

               if($.trim(question6)!='' || $.trim(answer6)!='')
               {
                 if($.trim(question6)=='')
                 {
                    $('#err_question6').html('This field is required.');
                    flag = 1;  
                 }
                 if($.trim(answer6)=='')
                 {
                    $('#err_answer6').html('This field is required.');
                    flag = 1;  
                 }
               }

               if($.trim(question7)!='' || $.trim(answer7)!='')
               {
                 if($.trim(question7)=='')
                 {
                    $('#err_question7').html('This field is required.');
                    flag = 1;  
                 }
                 if($.trim(answer7)=='')
                 {
                    $('#err_answer7').html('This field is required.');
                    flag = 1;  
                 }
               }

               if($.trim(question8)!='' || $.trim(answer8)!='')
               {
                 if($.trim(question8)=='')
                 {
                    $('#err_question8').html('This field is required.');
                    flag = 1;  
                 }
                 if($.trim(answer8)=='')
                 {
                    $('#err_answer8').html('This field is required.');
                    flag = 1;  
                 }
               }

               if(flHorn == '')
               {
                   $('#err_flHorn').html('This field is required.');
                   flag = 1;
               }
               else if(!(flHornExt == "mp3" || flHornExt == "MP3" || flHornExt == "wave" || flHornExt == "m4a"))
               {
                   $('#err_flHorn').html('Invalid file type.');
                   flag = 1;
               }

               if($.trim(duration)=='' || parseInt(duration)==0)
               {
                  $('#err_duration').html('This field is required.');
                  flag = 1;
               }
               else if(isNaN(duration))
               {
                  $('#err_duration').html('Invalid time.');
                  flag = 1;
               }

           }

           else if(parseInt(hiddenTemplate)==25)
           {
              var direction = $('#direction').val();
              var flQuestion = $('#flQuestion').val();
              var flQuestionExt = flQuestion.substring(flQuestion.lastIndexOf('.') + 1);
              var question   = $('#question').val();
              var flHorn   = $('#flHorn').val();
              var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);
              var duration = $('#duration').val();

              $('#err_direction').html('');
              $('#err_flQuestion').html('');
              $('#err_question').html('');
              $('#err_flHorn').html('');
              $('#err_duration').html('');

               if($.trim(direction)=='')
               {
                  $('#err_direction').html('This field is required.');
                  flag = 1;  
               }

               if(flQuestion=='')
               {
                  $('#err_flQuestion').html('This field is required.');
                  flag = 1;
               }
               else if(!(flQuestionExt == "mp4" || flQuestionExt == "MP4"))
               {
                  $('#err_flQuestion').html('Invalid file type.');
                  flag=1;
               }

               if($.trim(question)=='')
               {
                  $('#err_question').html('This field is required.');
                  flag = 1;  
               }

               if(flHorn == '')
               {
                   $('#err_flHorn').html('This field is required.');
                   flag = 1;
               }
               else if(!(flHornExt == "mp3" || flHornExt == "MP3" || flHornExt == "wave" || flHornExt == "m4a"))
               {
                   $('#err_flHorn').html('Invalid file type.');
                   flag = 1;
               }

               if($.trim(duration)=='' || parseInt(duration)==0)
               {
                  $('#err_duration').html('This field is required.');
                  flag = 1;
               }
               else if(isNaN(duration))
               {
                  $('#err_duration').html('Invalid time.');
                  flag = 1;
               }

           }

           else if(parseInt(hiddenTemplate)==26)
           {
               var direction = $('#direction').val();
               var question1 = $('#question1').val();
               var option1_1 = $('#option1_1').val();
               var option1_2 = $('#option1_2').val();
               var option1_3 = $('#option1_3').val();
               var rdoOption1 = $('input[name="rdoOption1"]:checked').val();
               var question2 = $('#question2').val();
               var option2_1 = $('#option2_1').val();
               var option2_2 = $('#option2_2').val();
               var option2_3 = $('#option2_3').val();
               var rdoOption2 = $('input[name="rdoOption2"]:checked').val();
               var question3 = $('#question3').val();
               var option3_1 = $('#option3_1').val();
               var option3_2 = $('#option3_2').val();
               var option3_3 = $('#option3_3').val();
               var rdoOption3 = $('input[name="rdoOption3"]:checked').val();
               var flHorn   = $('#flHorn').val();
               var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);
               var duration = $('#duration').val();

               $('#err_direction').html('');
               $('#err_question1').html('');
               $('#err_option1_1').html('');
               $('#err_option1_2').html('');
               $('#err_option1_3').html('');
               $('#err_rdoOption1').html('');
               $('#err_question2').html('');
               $('#err_option2_1').html('');
               $('#err_option2_2').html('');
               $('#err_option2_3').html('');
               $('#err_rdoOption2').html('');
               $('#err_question3').html('');
               $('#err_option3_1').html('');
               $('#err_option3_2').html('');
               $('#err_option3_3').html('');
               $('#err_rdoOption3').html('');
               $('#err_flHorn').html('');
               $('#err_duration').html('');

               if($.trim(direction)=='')
               {
                  $('#err_direction').html('This field is required.');
                  flag = 1;
               }

               if($.trim(question1)=='')
               {
                  $('#err_question1').html('This field is required.');
                  flag = 1;
               }
               if($.trim(option1_1)=='')
               {
                  $('#err_option1_1').html('This field is required.');
                  flag = 1;
               }
               if($.trim(option1_2)=='')
               {
                  $('#err_option1_2').html('This field is required.');
                  flag = 1;
               }
               if($.trim(option1_3)=='')
               {
                  $('#err_option1_3').html('This field is required.');
                  flag = 1;
               }
               if(rdoOption1==null)
               {
                   $('#err_rdoOption1').html('Choose one option as answer');
                   flag = 1;
               }

               if($.trim(question2)=='')
               {
                  $('#err_question2').html('This field is required.');
                  flag = 1;
               }
               if($.trim(option2_1)=='')
               {
                  $('#err_option2_1').html('This field is required.');
                  flag = 1;
               }
               if($.trim(option2_2)=='')
               {
                  $('#err_option2_2').html('This field is required.');
                  flag = 1;
               }
               if($.trim(option2_3)=='')
               {
                  $('#err_option2_3').html('This field is required.');
                  flag = 1;
               }
               if(rdoOption2==null)
               {
                   $('#err_rdoOption2').html('Choose one option as answer');
                   flag = 1;
               }

               if($.trim(question3)=='')
               {
                  $('#err_question3').html('This field is required.');
                  flag = 1;
               }
               if($.trim(option3_1)=='')
               {
                  $('#err_option3_1').html('This field is required.');
                  flag = 1;
               }
               if($.trim(option3_2)=='')
               {
                  $('#err_option3_2').html('This field is required.');
                  flag = 1;
               }
               if($.trim(option3_3)=='')
               {
                  $('#err_option3_3').html('This field is required.');
                  flag = 1;
               }
               if(rdoOption3==null)
               {
                   $('#err_rdoOption3').html('Choose one option as answer');
                   flag = 1;
               }
               
               if(flHorn == '')
               {
                   $('#err_flHorn').html('This field is required.');
                   flag = 1;
               }
               else if(!(flHornExt == "mp3" || flHornExt == "MP3" || flHornExt == "wave" || flHornExt == "m4a"))
               {
                   $('#err_flHorn').html('Invalid file type.');
                   flag = 1;
               }

               if($.trim(duration)=='' || parseInt(duration)==0)
               {
                  $('#err_duration').html('This field is required.');
                  flag = 1;
               }
               else if(isNaN(duration))
               {
                  $('#err_duration').html('Invalid time.');
                  flag = 1;
               }
           }

           else if(parseInt(hiddenTemplate)==27)
           {
              var direction = $('#direction').val();
              var question1 = $('#question1').val();
              var answer1 = $('#answer1').val();
              var question2 = $('#question2').val();
              var answer2 = $('#answer2').val();
              var question3 = $('#question3').val();
              var answer3 = $('#answer3').val();
              var flHorn   = $('#flHorn').val();
              var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);
              var duration = $('#duration').val();

              $('#err_direction').html('');
              $('#err_question1').html('');
              $('#err_answer1').html('');
              $('#err_question2').html('');
              $('#err_answer2').html('');
              $('#err_question3').html('');
              $('#err_answer3').html('');
              $('#err_flHorn').html('');
              $('#err_duration').html('');

               if($.trim(direction)=='')
               {
                  $('#err_direction').html('This field is required.');
                  flag = 1;  
               }

               if($.trim(question1)=='')
               {
                  $('#err_question1').html('This field is required.');
                  flag = 1;  
               }
               if($.trim(answer1)=='')
               {
                  $('#err_answer1').html('This field is required.');
                  flag = 1;  
               }

               if($.trim(question2)=='')
               {
                  $('#err_question2').html('This field is required.');
                  flag = 1;  
               }
               if($.trim(answer2)=='')
               {
                  $('#err_answer2').html('This field is required.');
                  flag = 1;  
               }

               if($.trim(question3)=='')
               {
                  $('#err_question3').html('This field is required.');
                  flag = 1;  
               }
               if($.trim(answer3)=='')
               {
                  $('#err_answer3').html('This field is required.');
                  flag = 1;  
               }

               if(flHorn == '')
               {
                   $('#err_flHorn').html('This field is required.');
                   flag = 1;
               }
               else if(!(flHornExt == "mp3" || flHornExt == "MP3" || flHornExt == "wave" || flHornExt == "m4a"))
               {
                   $('#err_flHorn').html('Invalid file type.');
                   flag = 1;
               }
               if($.trim(duration)=='' || parseInt(duration)==0)
               {
                  $('#err_duration').html('This field is required.');
                  flag = 1;
               }
               else if(isNaN(duration))
               {
                  $('#err_duration').html('Invalid time.');
                  flag = 1;
               }

           }

           else if(parseInt(hiddenTemplate)==28)
           {
              var direction = $('#direction').val();
              var question1 = $('#question1').val();
              var rdoOption1 = $('input[name="rdoOption1"]:checked').val();
              var question2 = $('#question2').val();
              var rdoOption2 = $('input[name="rdoOption2"]:checked').val();
              var question3 = $('#question3').val();
              var rdoOption3 = $('input[name="rdoOption3"]:checked').val();
              var question4 = $('#question4').val();
              var rdoOption4 = $('input[name="rdoOption4"]:checked').val();
              var question5 = $('#question5').val();
              var rdoOption5 = $('input[name="rdoOption5"]:checked').val();
              var flHorn   = $('#flHorn').val();
              var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);
              var duration = $('#duration').val();

              $('#err_direction').html('');
              $('#err_question1').html('');
              $('#err_rdoOption1').html('');
              $('#err_question2').html('');
              $('#err_rdoOption2').html('');
              $('#err_question3').html('');
              $('#err_rdoOption3').html('');
              $('#err_question4').html('');
              $('#err_rdoOption4').html('');
              $('#err_question5').html('');
              $('#err_rdoOption5').html('');
              $('#err_flHorn').html('');
              $('#err_duration').html('');

               if($.trim(direction)=='')
               {
                  $('#err_direction').html('This field is required.');
                  flag = 1;  
               }

               if($.trim(question1)=='')
               {
                  $('#err_question1').html('This field is required.');
                  flag = 1;  
               }
               if(rdoOption1==null)
               {
                  $('#err_rdoOption1').html('This field is required.');
                  flag = 1;  
               }

               if($.trim(question2)!='')
               {
                 if(rdoOption2==null)
                 {
                    $('#err_rdoOption2').html('This field is required.');
                    flag = 1;  
                 }
               }

               if($.trim(question3)!='')
               {
                 if(rdoOption3==null)
                 {
                    $('#err_rdoOption3').html('This field is required.');
                    flag = 1;  
                 }
               }

               if($.trim(question4)!='')
               {
                 if(rdoOption4==null)
                 {
                    $('#err_rdoOption4').html('This field is required.');
                    flag = 1;  
                 }
               }

               if($.trim(question5)!='')
               {
                 if(rdoOption5==null)
                 {
                    $('#err_rdoOption5').html('This field is required.');
                    flag = 1;  
                 }
               }

               if(flHorn == '')
               {
                   $('#err_flHorn').html('This field is required.');
                   flag = 1;
               }
               else if(!(flHornExt == "mp3" || flHornExt == "MP3" || flHornExt == "wave" || flHornExt == "m4a"))
               {
                   $('#err_flHorn').html('Invalid file type.');
                   flag = 1;
               }
               if($.trim(duration)=='' || parseInt(duration)==0)
               {
                  $('#err_duration').html('This field is required.');
                  flag = 1;
               }
               else if(isNaN(duration))
               {
                  $('#err_duration').html('Invalid time.');
                  flag = 1;
               }

           }

           else if(parseInt(hiddenTemplate)==29)
           {
              var direction = $('#direction').val();
              var answer = $('#answer').val();
              var question1 = $('#question1').val();
              var question2 = $('#question2').val();
              var question3 = $('#question3').val();
              var question4 = $('#question4').val();
              var question5 = $('#question5').val();
              var flHorn   = $('#flHorn').val();
              var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);
              var duration = $('#duration').val();

              $('#err_direction').html('');
              $('#err_answer').html('');
              $('#err_question1').html('');
              $('#err_question2').html('');
              $('#err_question3').html('');
              $('#err_question4').html('');
              $('#err_question5').html('');
              $('#err_flHorn').html('');
              $('#err_duration').html('');

               if($.trim(direction)=='')
               {
                  $('#err_direction').html('This field is required.');
                  flag = 1;  
               }

               if($.trim(answer)=='')
               {
                  $('#err_answer').html('This field is required.');
                  flag = 1;  
               }

               if($.trim(question1)=='')
               {
                  $('#err_question1').html('This field is required.');
                  flag = 1;  
               }
               
/*               if($.trim(question2)=='')
               {
                  $('#err_question2').html('This field is required.');
                  flag = 1;  
               }
               
               if($.trim(question3)=='')
               {
                  $('#err_question3').html('This field is required.');
                  flag = 1;  
               }
               
               if($.trim(question4)=='')
               {
                  $('#err_question4').html('This field is required.');
                  flag = 1;  
               }
               
               if($.trim(question5)=='')
               {
                  $('#err_question5').html('This field is required.');
                  flag = 1;  
               }*/
               
               if(flHorn == '')
               {
                   $('#err_flHorn').html('This field is required.');
                   flag = 1;
               }
               else if(!(flHornExt == "mp3" || flHornExt == "MP3" || flHornExt == "wave" || flHornExt == "m4a"))
               {
                   $('#err_flHorn').html('Invalid file type.');
                   flag = 1;
               }
               if($.trim(duration)=='' || parseInt(duration)==0)
               {
                  $('#err_duration').html('This field is required.');
                  flag = 1;
               }
               else if(isNaN(duration))
               {
                  $('#err_duration').html('Invalid time.');
                  flag = 1;
               }

           }

           else if(parseInt(hiddenTemplate)==30)
           {
              var direction = $('#direction').val();
              var question1 = $('#question1').val();
              var answer1 = $('#answer1').val();
              var question2 = $('#question2').val();
              var answer2 = $('#answer2').val();
              var question3 = $('#question3').val();
              var answer3 = $('#answer3').val();
              var question4 = $('#question4').val();
              var answer4 = $('#answer4').val();
              var question5 = $('#question5').val();
              var answer5 = $('#answer5').val();
              var flHorn   = $('#flHorn').val();
              var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);
              var duration = $('#duration').val();

              $('#err_direction').html('');
              $('#err_question1').html('');
              $('#err_answer1').html('');
              $('#err_question2').html('');
              $('#err_answer2').html('');
              $('#err_question3').html('');
              $('#err_answer3').html('');
              $('#err_question4').html('');
              $('#err_answer4').html('');
              $('#err_question5').html('');
              $('#err_answer5').html('');
              $('#err_flHorn').html('');
              $('#err_duration').html('');

               if($.trim(direction)=='')
               {
                  $('#err_direction').html('This field is required.');
                  flag = 1;  
               }

                if($.trim(question1)=='')
                {
                   $('#err_question1').html('This field is required.');
                   flag = 1;  
                }
                if($.trim(answer1)=='')
                {
                   $('#err_answer1').html('This field is required.');
                   flag = 1;  
                }
           
                if($.trim(question2)=='')
                {
                   $('#err_question2').html('This field is required.');
                   flag = 1;  
                }
                if($.trim(answer2)=='')
                {
                   $('#err_answer2').html('This field is required.');
                   flag = 1;  
                }
           
                if($.trim(question3)=='')
                {
                   $('#err_question3').html('This field is required.');
                   flag = 1;  
                }
                if($.trim(answer3)=='')
                {
                   $('#err_answer3').html('This field is required.');
                   flag = 1;  
                }
           
                if($.trim(question4)=='')
                {
                   $('#err_question4').html('This field is required.');
                   flag = 1;  
                }
                if($.trim(answer4)=='')
                {
                   $('#err_answer4').html('This field is required.');
                   flag = 1;  
                }
           
                if($.trim(question5)=='')
                {
                   $('#err_question5').html('This field is required.');
                   flag = 1;  
                }
                if($.trim(answer5)=='')
                {
                   $('#err_answer5').html('This field is required.');
                   flag = 1;  
                }

               if(flHorn == '')
               {
                   $('#err_flHorn').html('This field is required.');
                   flag = 1;
               }
               else if(!(flHornExt == "mp3" || flHornExt == "MP3" || flHornExt == "wave" || flHornExt == "m4a"))
               {
                   $('#err_flHorn').html('Invalid file type.');
                   flag = 1;
               }
               if($.trim(duration)=='' || parseInt(duration)==0)
               {
                  $('#err_duration').html('This field is required.');
                  flag = 1;
               }
               else if(isNaN(duration))
               {
                  $('#err_duration').html('Invalid time.');
                  flag = 1;
               }

           }

           else if(parseInt(hiddenTemplate)==31)
           {
              var direction = $('#direction').val();
              var question = $('#question').val();
              var questionAnsArr = questionAnsCount = '';
              var answer = $('#answer').val();
              var flHorn   = $('#flHorn').val();
              var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);
              var duration = $('#duration').val();

              $('#err_direction').html('');
              $('#err_question').html('');
              $('#err_answer').html('');
              $('#err_flHorn').html('');
              $('#err_duration').html('');

               if($.trim(direction)=='')
               {
                  $('#err_direction').html('This field is required.');
                  flag = 1;  
               }

               if($.trim(question)=='')
               {
                  $('#err_question').html('This field is required.');
                  flag = 1;  
               }
               else
               {
                  var questionAnsArr = question.match(/#BLANK#/g);
                  if(questionAnsArr==null)
                  {
                    $('#err_question').html('#BLANK# is missing');
                    flag = 1;    
                  }
                  /*else
                  {
                    var questionAnsCount = questionAnsArr.length;  
                    if(parseInt(questionAnsCount)!=1)
                    {
                      $('#err_question').html('Only one #BLANK# is allowed');
                      flag = 1;       
                    }
                  }*/
               }

               if($.trim(answer)=='')
               {
                  $('#err_answer').html('This field is required.');
                  flag = 1;  
               }
               else
               {
                   if($.trim(question)!='')
                   {
                      var questionAnsArr = question.match(/#BLANK#/g);
                      var questionAnsCount = questionAnsArr.length;
                      var answerCount = answer.split(',').length;
                      if(parseInt(answerCount) != parseInt(questionAnsCount))
                      {
                        $('#err_answer').html('Please enter all answers.');
                        flag = 1;          
                      }
                   }  
                   else
                   {
                    $('#err_question').html('This field is required.');
                      flag = 1;  
                   }              
               }
               
               if(flHorn == '')
               {
                   $('#err_flHorn').html('This field is required.');
                   flag = 1;
               }
               else if(!(flHornExt == "mp3" || flHornExt == "MP3" || flHornExt == "wave" || flHornExt == "m4a"))
               {
                   $('#err_flHorn').html('Invalid file type.');
                   flag = 1;
               }
               if($.trim(duration)=='' || parseInt(duration)==0)
               {
                  $('#err_duration').html('This field is required.');
                  flag = 1;
               }
               else if(isNaN(duration))
               {
                  $('#err_duration').html('Invalid time.');
                  flag = 1;
               }
           }

           else if(parseInt(hiddenTemplate)==32)
           {
              var direction = $('#direction').val();
              var question = $('#question').val();
              var answer = $('#answer').val();
              var flHorn   = $('#flHorn').val();
              var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);
              var duration = $('#duration').val();

              $('#err_direction').html('');
              $('#err_question').html('');
              $('#err_answer').html('');
              $('#err_flHorn').html('');
              $('#err_duration').html('');

               if($.trim(direction)=='')
               {
                  $('#err_direction').html('This field is required.');
                  flag = 1;  
               }

               if($.trim(question)=='')
               {
                  $('#err_question').html('This field is required.');
                  flag = 1;  
               }

               if($.trim(answer)=='')
               {
                  $('#err_answer').html('This field is required.');
                  flag = 1;  
               }
               else
               {
                   if($.trim(question)=='')
                   {
                      $('#err_question').html('This field is required.');
                      flag = 1;  
                   }
                   else if(flag!=1)
                   {
                     var arr_answer = answer.split(',');
                     $.each(arr_answer, function( index, val ) {
                       if(!question.match(val))
                       {
                         $('#err_answer').html('Answer not match.');
                         flag = 1;
                       }
                     });
                   }
               }
               
               if(flHorn == '')
               {
                   $('#err_flHorn').html('This field is required.');
                   flag = 1;
               }
               else if(!(flHornExt == "mp3" || flHornExt == "MP3" || flHornExt == "wave" || flHornExt == "m4a"))
               {
                   $('#err_flHorn').html('Invalid file type.');
                   flag = 1;
               }

               if($.trim(duration)=='' || parseInt(duration)==0)
               {
                  $('#err_duration').html('This field is required.');
                  flag = 1;
               }
               else if(isNaN(duration))
               {
                  $('#err_duration').html('Invalid time.');
                  flag = 1;
               }
           }

           else if(parseInt(hiddenTemplate)==33)
           {
               var direction = $('#direction').val();
              var duration = $('#duration').val();
              /*var flHorn   = $('#flHorn').val();
              var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);*/

              $('#err_direction').html('');

              /*$('#err_flHorn').html('');*/
                var digit1_1 = $('#digit1_1').val();
                var operator1 = $('#operator1').val();
                var digit2_1 = $('#digit1_2').val();
                var answer_1 = $('#answer1').val();

                $('#err_digit1_1').html('');
                $('#err_operator1').html('');
                $('#err_digit1_2').html('');
                $('#err_answer1').html('');
                $('#err_duration').html('');

                if($.trim(digit1_1)=='')
                {
                    $('#err_digit1_1').html('This field is required.');
                    flag = 1;    
                }
                else if(isNaN(digit1_1))
                {
                  $('#err_digit1_1').html('Invalid field value.');
                  flag = 1;  
                }
                if($.trim(operator1)=='')
                {
                  $('#err_operator1').html('This field is required.');
                  flag = 1;  
                }
                if($.trim(digit2_1)=='')
                {
                    $('#err_digit1_2').html('This field is required.');
                    flag = 1;    
                }
                else if(isNaN(digit2_1))
                {
                  $('#err_digit1_2').html('Invalid field value.');
                  flag = 1;  
                }
                if($.trim(answer_1)=='')
                {
                  $('#err_answer1').html('This field is required.');
                  flag = 1;  
                }
                else if(isNaN(answer_1))
                {
                  $('#err_answer1').html('Invalid field value.');
                  flag = 1;  
                }              

              for (var i = 2; i <= 12; i++)
              {
                var digit1 = $('#digit'+i+'_1').val();
                var operator = $('#operator'+i).val();
                var digit2 = $('#digit'+i+'_2').val();
                var answer = $('#answer'+i).val();
                
                $('#err_digit'+i+'_1').html('');
                $('#err_operator'+i).html('');
                $('#err_digit'+i+'_2').html('');
                $('#err_answer'+i).html('');
                $('#err_duration').html('');

                if($.trim(digit1)!='' || $.trim(operator)!='' || $.trim(digit2)!='' || $.trim(answer)!='')
                {
                  if($.trim(digit1)=='')
                  {
                      $('#err_digit'+i+'_1').html('This field is required.');
                      flag = 1;    
                  }
                  else if(isNaN(digit1))
                  {
                    $('#err_digit'+i+'_1').html('Invalid field value.');
                    flag = 1;  
                  }
                  if($.trim(operator)=='')
                  {
                    $('#err_operator'+i).html('This field is required.');
                    flag = 1;  
                  }
                  if($.trim(digit2)=='')
                  {
                      $('#err_digit'+i+'_2').html('This field is required.');
                      flag = 1;    
                  }
                  else if(isNaN(digit2))
                  {
                    $('#err_digit'+i+'_2').html('Invalid field value.');
                    flag = 1;  
                  }
                  if($.trim(answer)=='')
                  {
                    $('#err_answer'+i).html('This field is required.');
                    flag = 1;  
                  }
                  else if(isNaN(answer))
                  {
                    $('#err_answer'+i).html('Invalid field value.');
                    flag = 1;  
                  }
                }
              }

               if($.trim(direction)=='')
               {
                  $('#err_direction').html('This field is required.');
                  flag = 1;  
               }

               /*if(flHorn == '')
               {
                   $('#err_flHorn').html('This field is required.');
                   flag = 1;
               }
               else if(!(flHornExt == "mp3" || flHornExt == "MP3" || flHornExt == "wave" || flHornExt == "m4a"))
               {
                   $('#err_flHorn').html('Invalid file type.');
                   flag = 1;
               }*/

               if($.trim(duration)=='' || parseInt(duration)==0)
               {
                  $('#err_duration').html('This field is required.');
                  flag = 1;
               }
               else if(isNaN(duration))
               {
                  $('#err_duration').html('Invalid time.');
                  flag = 1;
               }
               
           }

           else if(parseInt(hiddenTemplate)==34)
           {
              var direction = $('#direction').val();
              var flQuestion = $('#flQuestion').val();
              var flQuestionExt = flQuestion.substring(flQuestion.lastIndexOf('.')+1);
              var digit1_1 = $('#digit1_1').val();
              var operator1 = $('#operator1').val();
              var digit1_2 = $('#digit1_2').val();
              var answer1 = $('#answer1').val();
              /*var flHorn   = $('#flHorn').val();
              var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);*/
              var duration = $('#duration').val();

              $('#err_direction').html('');
              $('#err_flQuestion').html('');
              $('#err_digit1_1').html('');
              $('#err_operator1').html('');
              $('#err_digit1_2').html('');
              $('#err_answer1').html('');
              /*$('#err_flHorn').html('');*/
              $('#err_duration').html('');

               if($.trim(direction)=='')
               {
                  $('#err_direction').html('This field is required.');
                  flag = 1;  
               }

               if(flQuestion == '')
               {
                   $('#err_flQuestion').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestionExt == "jpg" || flQuestionExt == "jpeg" || flQuestionExt == "gif" || flQuestionExt == "png" || flQuestionExt == "GIF" || flQuestionExt == "JPG" || flQuestionExt == "JPEG" || flQuestionExt == "PNG"))
               {
                   $('#err_flQuestion').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion').attr('data-error')=='yes')
               {
                  $('#err_flQuestion').html('File must be grater than / equal to 583 X 560.');
                  flag=1;  
               }

               if($.trim(digit1_1)=='')
               {
                  $('#err_digit1_1').html('This field is required.');
                  flag=1;
               }
               else if(isNaN(digit1_1))
               {
                  $('#err_digit1_1').html('Invalid field value.');
                  flag=1;
               }
               if($.trim(operator1)=='')
               {
                  $('#err_operator1').html('This field is required.');
                  flag=1;
               }
               if($.trim(digit1_2)=='')
               {
                  $('#err_digit1_2').html('This field is required.');
                  flag=1;
               }
               else if(isNaN(digit1_2))
               {
                  $('#err_digit1_2').html('Invalid field value.');
                  flag=1;
               }
               if($.trim(answer1)=='')
               {
                  $('#err_answer1').html('This field is required.');
                  flag=1;
               }
               else if(isNaN(answer1))
               {
                  $('#err_answer1').html('Invalid field value.');
                  flag=1;
               }

               /*if(flHorn == '')
               {
                   $('#err_flHorn').html('This field is required.');
                   flag = 1;
               }
               else if(!(flHornExt == "mp3" || flHornExt == "MP3" || flHornExt == "wave"))
               {
                   $('#err_flHorn').html('Invalid file type.');
                   flag = 1;
               }*/

               if($.trim(duration)=='' || parseInt(duration)==0)
               {
                  $('#err_duration').html('This field is required.');
                  flag = 1;
               }
               else if(isNaN(duration))
               {
                  $('#err_duration').html('Invalid time.');
                  flag = 1;
               }
               
           }

           else if(parseInt(hiddenTemplate)==35)
           {
              var direction = $('#direction').val();
              var flQuestion1 = $('#flQuestion1').val();
              var flQuestion1Ext = flQuestion1.substring(flQuestion1.lastIndexOf('.')+1);
              var flQuestion2 = $('#flQuestion2').val();
              var flQuestion2Ext = flQuestion2.substring(flQuestion2.lastIndexOf('.')+1);
              /*var flHorn   = $('#flHorn').val();
              var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);*/
              var duration = $('#duration').val();

              $('#err_direction').html('');
              $('#err_flQuestion1').html('');
              $('#err_flQuestion2').html('');
              /*$('#err_flHorn').html('');*/
              $('#err_duration').html('');

              var digit1_1 = $('#digit1_1').val();
              var operator1 = $('#operator1').val();
              var digit2_1 = $('#digit1_2').val();
              var answer_1 = $('#answer1').val();
              var chkBlankLetter1 = $('input[name="chkBlankLetter_1[]"]:checked').length;

              $('#err_digit1_1').html('');
              $('#err_operator1').html('');
              $('#err_digit1_2').html('');
              $('#err_answer1').html('');
              $('#err_duration').html('');

              if($.trim(digit1_1)=='')
              {
                  $('#err_digit1_1').html('This field is required.');
                  flag = 1;    
              }
              else if(isNaN(digit1_1))
              {
                $('#err_digit1_1').html('Invalid field value.');
                flag = 1;  
              }
              if($.trim(operator1)=='')
              {
                $('#err_operator1').html('This field is required.');
                flag = 1;  
              }
              if($.trim(digit2_1)=='')
              {
                  $('#err_digit1_2').html('This field is required.');
                  flag = 1;    
              }
              else if(isNaN(digit2_1))
              {
                $('#err_digit1_2').html('Invalid field value.');
                flag = 1;  
              }
              if($.trim(answer_1)=='')
              {
                $('#err_answer1').html('This field is required.');
                flag = 1;  
              }
              else if(isNaN(answer_1))
              {
                $('#err_answer1').html('Invalid field value.');
                flag = 1;  
              }
              if(parseInt(chkBlankLetter1)==0)
              {
                $('#err_chkBlankLetter_1').html('Invalid field value.');
                flag = 1;   
              }

              if($('#flQuestion1').val()== '')
              {
                 $('#err_flQuestion1').html('This field is required.');
                 flag=1;
              }
              else if($('#flQuestion1').val()!= '')
              {
                 if(!($('#flQuestion1').val().substring($('#flQuestion1').val().lastIndexOf('.')+1) == "jpg" || $('#flQuestion1').val().substring($('#flQuestion1').val().lastIndexOf('.')+1) == "jpeg" || $('#flQuestion1').val().substring($('#flQuestion1').val().lastIndexOf('.')+1) == "gif" || $('#flQuestion1').val().substring($('#flQuestion1').val().lastIndexOf('.')+1) == "png" || $('#flQuestion1').val().substring($('#flQuestion1').val().lastIndexOf('.')+1) == "GIF" || $('#flQuestion1').val().substring($('#flQuestion1').val().lastIndexOf('.')+1) == "JPG" || $('#flQuestion1').val().substring($('#flQuestion1').val().lastIndexOf('.')+1) == "JPEG" || $('#flQuestion1').val().substring($('#flQuestion1').val().lastIndexOf('.')+1) == "PNG"))
                 {
                     $('#err_flQuestion1').html('Invalid file type.');
                     flag=1;
                 }    
              }

              for (var i = 2; i <= 5; i++)
              {
                var digit1 = $('#digit'+i+'_1').val();
                var operator = $('#operator'+i).val();
                var digit2 = $('#digit'+i+'_2').val();
                var answer = $('#answer'+i).val();
                var chkBlankLetter = $('input[name="chkBlankLetter_'+i+'[]"]:checked').length;
                
                $('#err_digit'+i+'_1').html('');
                $('#err_operator'+i).html('');
                $('#err_digit'+i+'_2').html('');
                $('#err_answer'+i).html('');
                $('#err_chkBlankLetter_'+i).html('');

                if($.trim(digit1)!='' || $.trim(operator)!='' || $.trim(digit2)!='' || $.trim(answer)!='' || $('#flQuestion'+i).val()!= '')
                {
                  if($.trim(digit1)=='')
                  {
                      $('#err_digit'+i+'_1').html('This field is required.');
                      flag = 1;    
                  }
                  else if(isNaN(digit1))
                  {
                    $('#err_digit'+i+'_1').html('Invalid field value.');
                    flag = 1;  
                  }
                  if($.trim(operator)=='')
                  {
                    $('#err_operator'+i).html('This field is required.');
                    flag = 1;  
                  }
                  if($.trim(digit2)=='')
                  {
                      $('#err_digit'+i+'_2').html('This field is required.');
                      flag = 1;    
                  }
                  else if(isNaN(digit2))
                  {
                    $('#err_digit'+i+'_2').html('Invalid field value.');
                    flag = 1;  
                  }
                  if($.trim(answer)=='')
                  {
                    $('#err_answer'+i).html('This field is required.');
                    flag = 1;  
                  }
                  else if(isNaN(answer))
                  {
                    $('#err_answer'+i).html('Invalid field value.');
                    flag = 1;  
                  }
                  if(parseInt(chkBlankLetter)==0)
                  {
                    $('#err_chkBlankLetter_'+i).html('Invalid field value.');
                    flag = 1;   
                  }
                   if($('#flQuestion'+i).val()== '')
                   {
                     $('#err_flQuestion'+i).html('This field is required.');
                   }
                   else if($('#flQuestion'+i).val()!= '')
                   {
                       if(!($('#flQuestion'+i).val().substring($('#flQuestion'+i).val().lastIndexOf('.')+1) == "jpg" || $('#flQuestion'+i).val().substring($('#flQuestion'+i).val().lastIndexOf('.')+1) == "jpeg" || $('#flQuestion'+i).val().substring($('#flQuestion'+i).val().lastIndexOf('.')+1) == "gif" || $('#flQuestion'+i).val().substring($('#flQuestion'+i).val().lastIndexOf('.')+1) == "png" || $('#flQuestion'+i).val().substring($('#flQuestion'+i).val().lastIndexOf('.')+1) == "GIF" || $('#flQuestion'+i).val().substring($('#flQuestion'+i).val().lastIndexOf('.')+1) == "JPG" || $('#flQuestion'+i).val().substring($('#flQuestion'+i).val().lastIndexOf('.')+1) == "JPEG" || $('#flQuestion'+i).val().substring($('#flQuestion'+i).val().lastIndexOf('.')+1) == "PNG"))
                       {
                           $('#err_flQuestion'+i).html('Invalid file type.');
                           flag=1;
                       }    
                   }
                }
              }

               if($.trim(direction)=='')
               {
                  $('#err_direction').html('This field is required.');
                  flag = 1;  
               }

               if(flQuestion1 == '')
               {
                   $('#err_flQuestion1').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion1Ext == "jpg" || flQuestion1Ext == "jpeg" || flQuestion1Ext == "gif" || flQuestion1Ext == "png" || flQuestion1Ext == "GIF" || flQuestion1Ext == "JPG" || flQuestion1Ext == "JPEG" || flQuestion1Ext == "PNG"))
               {
                   $('#err_flQuestion1').html('Invalid file type.');
                   flag=1;
               }

               if(flQuestion2 != '')
               {
                   if(!(flQuestion2Ext == "jpg" || flQuestion2Ext == "jpeg" || flQuestion2Ext == "gif" || flQuestion2Ext == "png" || flQuestion2Ext == "GIF" || flQuestion2Ext == "JPG" || flQuestion2Ext == "JPEG" || flQuestion2Ext == "PNG"))
                   {
                       $('#err_flQuestion2').html('Invalid file type.');
                       flag=1;
                   }    
               }
               

               /*if(flHorn == '')
               {
                   $('#err_flHorn').html('This field is required.');
                   flag = 1;
               }
               else if(!(flHornExt == "mp3" || flHornExt == "MP3" || flHornExt == "wave" || flHornExt == "m4a"))
               {
                   $('#err_flHorn').html('Invalid file type.');
                   flag = 1;
               }*/
               if($.trim(duration)=='' || parseInt(duration)==0)
               {
                  $('#err_duration').html('This field is required.');
                  flag = 1;
               }
               else if(isNaN(duration))
               {
                  $('#err_duration').html('Invalid time.');
                  flag = 1;
               }
              
               
           }

           else if(parseInt(hiddenTemplate)==36)
           {
              var direction = $('#direction').val();
              var flQuestion1 = $('#flQuestion1').val();
              var flQuestion1Ext = flQuestion1.substring(flQuestion1.lastIndexOf('.')+1);
              /*var flQuestion2 = $('#flQuestion2').val();
              var flQuestion2Ext = flQuestion2.substring(flQuestion2.lastIndexOf('.')+1);*/
              var answer = $('#answer').val();
              /*var flHorn   = $('#flHorn').val();
              var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);*/
              var duration = $('#duration').val();

              $('#err_direction').html('');
              $('#err_flQuestion1').html('');
              $('#err_flQuestion2').html('');
              $('#err_answer').html('');
              /*$('#err_flHorn').html('');*/
              $('#err_duration').html('');

               if($.trim(direction)=='')
               {
                  $('#err_direction').html('This field is required.');
                  flag = 1;  
               }

               if(flQuestion1 == '')
               {
                   $('#err_flQuestion1').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion1Ext == "jpg" || flQuestion1Ext == "jpeg" || flQuestion1Ext == "gif" || flQuestion1Ext == "png" || flQuestion1Ext == "GIF" || flQuestion1Ext == "JPG" || flQuestion1Ext == "JPEG" || flQuestion1Ext == "PNG"))
               {
                   $('#err_flQuestion1').html('Invalid file type.');
                   flag=1;
               }

/*               if(flQuestion2 != '')
               {
                   if(!(flQuestion2Ext == "jpg" || flQuestion2Ext == "jpeg" || flQuestion2Ext == "gif" || flQuestion2Ext == "png" || flQuestion2Ext == "GIF" || flQuestion2Ext == "JPG" || flQuestion2Ext == "JPEG" || flQuestion2Ext == "PNG"))
                   {
                       $('#err_flQuestion2').html('Invalid file type.');
                       flag=1;
                   }    
               }*/

               if($.trim(answer)=='')
               {
                  $('#err_answer').html('This field is required.');
                  flag=1;
               }
               else if(isNaN(answer))
               {
                  $('#err_answer').html('Invalid field value.');
                  flag=1;
               }

               /*if(flHorn == '')
               {
                   $('#err_flHorn').html('This field is required.');
                   flag = 1;
               }
               else if(!(flHornExt == "mp3" || flHornExt == "MP3" || flHornExt == "wave" || flHornExt == "m4a"))
               {
                   $('#err_flHorn').html('Invalid file type.');
                   flag = 1;
               }*/
               if($.trim(duration)=='' || parseInt(duration)==0)
               {
                  $('#err_duration').html('This field is required.');
                  flag = 1;
               }
               else if(isNaN(duration))
               {
                  $('#err_duration').html('Invalid time.');
                  flag = 1;
               }
               
           }

           else if(parseInt(hiddenTemplate)==37)
           {
             var direction = $('#direction').val();
              
               var flQuestion1 = $('#flQuestion1').val();
       var flQuestion1Ext = flQuestion1.substring(flQuestion1.lastIndexOf('.')+1);
       var digit1_1 = $('#digit1_1').val();
       var operator1 = $('#operator1').val();
       var digit1_2 = $('#digit1_2').val();
       var answer1 = $('#answer1').val();
   
       var flQuestion2 = $('#flQuestion2').val();
       var flQuestion2Ext = flQuestion2.substring(flQuestion2.lastIndexOf('.')+1);
       var digit2_1 = $('#digit2_1').val();
       var operator2 = $('#operator2').val();
       var digit2_2 = $('#digit2_2').val();
       var answer2 = $('#answer2').val();
   
       var flQuestion3 = $('#flQuestion3').val();
       var flQuestion3Ext = flQuestion3.substring(flQuestion3.lastIndexOf('.')+1);
       var digit3_1 = $('#digit3_1').val();
       var operator3 = $('#operator3').val();
       var digit3_2 = $('#digit3_2').val();
       var answer3 = $('#answer3').val();
   
       var flQuestion4 = $('#flQuestion4').val();
       var flQuestion4Ext = flQuestion4.substring(flQuestion4.lastIndexOf('.')+1);
       var digit4_1 = $('#digit4_1').val();
       var operator4 = $('#operator4').val();
       var digit4_2 = $('#digit4_2').val();
       var answer4 = $('#answer4').val();
   
       /*var flHorn   = $('#flHorn').val();
       var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);*/
   
       var minute      = $('input[name="minute"]').val();
       var second      = $('input[name="second"]').val();
       var duration    = parseInt(minute)*60 + parseInt(second);
   
       var flag = 0;
   
       $('#err_direction').html('');
   
       $('#err_flQuestion1').html('');
       $('#err_digit1_1').html('');
       $('#err_operator1').html('');
       $('#err_digit1_2').html('');
       $('#err_answer1').html('');
   
       $('#err_flQuestion2').html('');
       $('#err_digit2_1').html('');
       $('#err_operator2').html('');
       $('#err_digit2_2').html('');
       $('#err_answer2').html('');
   
       $('#err_flQuestion3').html('');
       $('#err_digit3_1').html('');
       $('#err_operator3').html('');
       $('#err_digit3_2').html('');
       $('#err_answer3').html('');
   
       $('#err_flQuestion4').html('');
       $('#err_digit4_1').html('');
       $('#err_operator4').html('');
       $('#err_digit4_2').html('');
       $('#err_answer4').html('');
       
       /*$('#err_flHorn').html('');*/
   
       $('#err_duration').html('');
   
        if($.trim(direction)=='')
        {
           $('#err_direction').html('This field is required.');
           flag = 1;  
        }
        if(flQuestion1 == '')
        {
           $('#err_flQuestion1').html('This field is required.');
           flag = 1;
        }
        else if(!(flQuestion1Ext == "jpg" || flQuestion1Ext == "jpeg" || flQuestion1Ext == "gif" || flQuestion1Ext == "png" || flQuestion1Ext == "GIF" || flQuestion1Ext == "JPG" || flQuestion1Ext == "JPEG" || flQuestion1Ext == "PNG"))
        {
            $('#err_flQuestion1').html('Invalid file type.');
            flag=1;
        }
        else if($('#flQuestion1').attr('data-error')=='yes')
        {
           $('#err_flQuestion1').html('File must be grater than / equal to 504 X 106.');
           flag=1;  
        }   
        
        if($.trim(digit1_1)=='')
        {
           $('#err_digit1_1').html('This field is required.');
           flag=1;
        }
        else if(isNaN(digit1_1))
        {
           $('#err_digit1_1').html('Invalid field value.');
           flag=1;
        }
        if($.trim(operator1)=='')
        {
           $('#err_operator1').html('This field is required.');
           flag=1;
        }
        if($.trim(digit1_2)=='')
        {
           $('#err_digit1_2').html('This field is required.');
           flag=1;
        }
        else if(isNaN(digit1_2))
        {
           $('#err_digit1_2').html('Invalid field value.');
           flag=1;
        }
        if($.trim(answer1)=='')
        {
           $('#err_answer1').html('This field is required.');
           flag=1;
        }
        else if(isNaN(answer1))
        {
           $('#err_answer1').html('Invalid field value.');
           flag=1;
        }
   
        if(flQuestion2 != '' || $.trim(digit2_1)!='' || $.trim(operator2)!='' || $.trim(digit2_2)!='' || $.trim(answer2)!='')
        {
            if(flQuestion2 == '')
            {
               $('#err_flQuestion2').html('This field is required.');
               flag = 1;
            }
            else if(!(flQuestion2Ext == "jpg" || flQuestion2Ext == "jpeg" || flQuestion2Ext == "gif" || flQuestion2Ext == "png" || flQuestion2Ext == "GIF" || flQuestion2Ext == "JPG" || flQuestion2Ext == "JPEG" || flQuestion2Ext == "PNG"))
            {
                $('#err_flQuestion2').html('Invalid file type.');
                flag=1;
            }
            else if($('#flQuestion2').attr('data-error')=='yes')
            {
               $('#err_flQuestion2').html('File must be grater than / equal to 504 X 106.');
               flag=1;  
            }
            if($.trim(digit2_1)=='')
            {
               $('#err_digit2_1').html('This field is required.');
               flag=1;
            }
            else if(isNaN(digit2_1))
            {
               $('#err_digit2_1').html('Invalid field value.');
               flag=1;
            }
            if($.trim(operator2)=='')
            {
               $('#err_operator2').html('This field is required.');
               flag=1;
            }
            if($.trim(digit2_2)=='')
            {
               $('#err_digit2_2').html('This field is required.');
               flag=1;
            }
            else if(isNaN(digit2_2))
            {
               $('#err_digit2_2').html('Invalid field value.');
               flag=1;
            }
            if($.trim(answer2)=='')
            {
               $('#err_answer2').html('This field is required.');
               flag=1;
            }
            else if(isNaN(answer2))
            {
               $('#err_answer2').html('Invalid field value.');
               flag=1;
            }
        }
        
        if(flQuestion3 != '' || $.trim(digit3_1)!='' || $.trim(operator3)!='' || $.trim(digit3_2)!='' || $.trim(answer3)!='')
        {
            if(flQuestion3 == '')
            {
               $('#err_flQuestion1').html('This field is required.');
               flag = 1;
            }
            else if(!(flQuestion3Ext == "jpg" || flQuestion3Ext == "jpeg" || flQuestion3Ext == "gif" || flQuestion3Ext == "png" || flQuestion3Ext == "GIF" || flQuestion3Ext == "JPG" || flQuestion3Ext == "JPEG" || flQuestion3Ext == "PNG"))
            {
                $('#err_flQuestion3').html('Invalid file type.');
                flag=1;
            }
            else if($('#flQuestion3').attr('data-error')=='yes')
            {
               $('#err_flQuestion3').html('File must be grater than / equal to 504 X 106.');
               flag=1;  
            }
            if($.trim(digit3_1)=='')
            {
               $('#err_digit3_1').html('This field is required.');
               flag=1;
            }
            else if(isNaN(digit3_1))
            {
               $('#err_digit3_1').html('Invalid field value.');
               flag=1;
            }
            if($.trim(operator3)=='')
            {
               $('#err_operator3').html('This field is required.');
               flag=1;
            }
            if($.trim(digit3_2)=='')
            {
               $('#err_digit3_2').html('This field is required.');
               flag=1;
            }
            else if(isNaN(digit3_2))
            {
               $('#err_digit3_2').html('Invalid field value.');
               flag=1;
            }
            if($.trim(answer3)=='')
            {
               $('#err_answer3').html('This field is required.');
               flag=1;
            }
            else if(isNaN(answer3))
            {
               $('#err_answer3').html('Invalid field value.');
               flag=1;
            }
        }
     
        if(flQuestion4 != '' || $.trim(digit4_1)!='' || $.trim(operator4)!='' || $.trim(digit4_2)!='' || $.trim(answer4)!='')
        {
            if(flQuestion4 == '')
            {
               $('#err_flQuestion4').html('This field is required.');
               flag = 1;
            }
            else if(!(flQuestion4Ext == "jpg" || flQuestion4Ext == "jpeg" || flQuestion4Ext == "gif" || flQuestion4Ext == "png" || flQuestion4Ext == "GIF" || flQuestion4Ext == "JPG" || flQuestion4Ext == "JPEG" || flQuestion4Ext == "PNG"))
            {
                $('#err_flQuestion4').html('Invalid file type.');
                flag=1;
            }
            else if($('#flQuestion4').attr('data-error')=='yes')
            {
               $('#err_flQuestion4').html('File must be grater than / equal to 504 X 106.');
               flag=1;  
            }
            if($.trim(digit4_1)=='')
            {
               $('#err_digit4_1').html('This field is required.');
               flag=1;
            }
            else if(isNaN(digit4_1))
            {
               $('#err_digit4_1').html('Invalid field value.');
               flag=1;
            }
            if($.trim(operator4)=='')
            {
               $('#err_operator4').html('This field is required.');
               flag=1;
            }
            if($.trim(digit4_2)=='')
            {
               $('#err_digit4_2').html('This field is required.');
               flag=1;
            }
            else if(isNaN(digit4_2))
            {
               $('#err_digit4_2').html('Invalid field value.');
               flag=1;
            }
            if($.trim(answer4)=='')
            {
               $('#err_answer4').html('This field is required.');
               flag=1;
            }
            else if(isNaN(answer4))
            {
               $('#err_answer4').html('Invalid field value.');
               flag=1;
            }
        }
   
               if($.trim(duration)=='' || parseInt(duration)==0)
               {
                  $('#err_duration').html('This field is required.');
                  flag = 1;
               }
               else if(isNaN(duration))
               {
                  $('#err_duration').html('Invalid time.');
                  flag = 1;
               }
               
           }

           else if(parseInt(hiddenTemplate)==38)
           {
              var direction = $('#direction').val();
              var flQuestion1 = $('#flQuestion1').val();
              var flQuestion1Ext = flQuestion1.substring(flQuestion1.lastIndexOf('.') + 1);
              var question1 = $('#question1').val();
              var answer1 = $('#answer1').val();
              var question2 = $('#question2').val();
              var answer2 = $('#answer2').val();
              var question3 = $('#question3').val();
              var answer3 = $('#answer3').val();
              var question4 = $('#question4').val();
              var answer4 = $('#answer4').val();
              /*var flHorn   = $('#flHorn').val();
              var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);*/
              var duration = $('#duration').val();

              $('#err_direction').html('');
              $('#err_flQuestion1').html('');
              $('#err_question1').html('');
              $('#err_answer1').html('');
              $('#err_question2').html('');
              $('#err_answer2').html('');
              $('#err_question3').html('');
              $('#err_answer3').html('');
              $('#err_question4').html('');
              $('#err_answer4').html('');
              /*$('#err_flHorn').html('');*/
              $('#err_duration').html('');

               if($.trim(direction)=='')
               {
                  $('#err_direction').html('This field is required.');
                  flag = 1;  
               }

               if(flQuestion1 == '')
               {
                   $('#err_flQuestion1').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion1Ext == "jpg" || flQuestion1Ext == "jpeg" || flQuestion1Ext == "gif" || flQuestion1Ext == "png" || flQuestion1Ext == "GIF" || flQuestion1Ext == "JPG" || flQuestion1Ext == "JPEG" || flQuestion1Ext == "PNG"))
               {
                   $('#err_flQuestion1').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion1').attr('data-error')=='yes')
               {
                  $('#err_flQuestion1').html('File must be grater than / equal to 498 X 384.');
                  flag=1;  
               }

               if($.trim(question1)=='')
               {
                  $('#err_question1').html('This field is required.');
                  flag = 1;  
               }
               if($.trim(answer1)=='')
               {
                  $('#err_answer1').html('This field is required.');
                  flag = 1;  
               }

               if($.trim(question2)!='')
               {
                  if($.trim(answer2)=='')
                  {
                     $('#err_answer2').html('This field is required.');
                     flag = 1;  
                  }
               }
               if($.trim(answer2)!='')
               {
                   if($.trim(question2)=='')
                   {
                      $('#err_question2').html('This field is required.');
                      flag = 1;  
                   }
               }

               if($.trim(question3)!='')
               {
                   if($.trim(answer3)=='')
                   {
                      $('#err_answer3').html('This field is required.');
                      flag = 1;  
                   }
               }
               if($.trim(answer3)!='')
               {
                   if($.trim(question3)=='')
                   {
                      $('#err_question3').html('This field is required.');
                      flag = 1;  
                   }
               }

               if($.trim(question4)!='')
               {
                   if($.trim(answer4)=='')
                   {
                      $('#err_answer4').html('This field is required.');
                      flag = 1;  
                   }
               }
               if($.trim(answer4)!='')
               {
                   if($.trim(question4)=='')
                   {
                      $('#err_question4').html('This field is required.');
                      flag = 1;  
                   }
               }

               /*if(flHorn == '')
               {
                   $('#err_flHorn').html('This field is required.');
                   flag = 1;
               }
               else if(!(flHornExt == "mp3" || flHornExt == "MP3" || flHornExt == "wave" || flHornExt == "m4a"))
               {
                   $('#err_flHorn').html('Invalid file type.');
                   flag = 1;
               }*/

               if($.trim(duration)=='' || parseInt(duration)==0)
               {
                  $('#err_duration').html('This field is required.');
                  flag = 1;
               }
               else if(isNaN(duration))
               {
                  $('#err_duration').html('Invalid time.');
                  flag = 1;
               }
           }

           else if(parseInt(hiddenTemplate)==39)
           {
              var direction = $('#direction').val();
              /*var flHorn   = $('#flHorn').val();
              var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);*/
              var duration = $('#duration').val();

              $('#err_direction').html('');
              $('#err_duration').html('');

              /*$('#err_flHorn').html('');*/

              for (var i = 1; i <= 6; i++)
              {
                var digit1 = $('#digit'+i+'_1').val();
                var operator = $('#operator'+i).val();
                var digit2 = $('#digit'+i+'_2').val();
                var answer = $('#answer'+i).val();
                
                $('#err_digit'+i+'_1').html('');
                $('#err_operator'+i).html('');
                $('#err_digit'+i+'_2').html('');
                $('#err_answer'+i).html('');

                if(i==1)
                {
                  if($.trim(digit1)=='')
                  {
                      $('#err_digit'+i+'_1').html('This field is required.');
                      flag = 1;    
                  }
                  else if(isNaN(digit1))
                  {
                    $('#err_digit'+i+'_1').html('Invalid field value.');
                    flag = 1;  
                  }
                  if($.trim(operator)=='')
                  {
                    $('#err_operator'+i).html('This field is required.');
                    flag = 1;  
                  }
                  if($.trim(digit2)=='')
                  {
                      $('#err_digit'+i+'_2').html('This field is required.');
                      flag = 1;    
                  }
                  else if(isNaN(digit2))
                  {
                    $('#err_digit'+i+'_2').html('Invalid field value.');
                    flag = 1;  
                  }
                  if($.trim(answer)=='')
                  {
                    $('#err_answer'+i).html('This field is required.');
                    flag = 1;  
                  }
                  else if(isNaN(answer))
                  {
                    $('#err_answer'+i).html('Invalid field value.');
                    flag = 1;  
                  }
                }
                else
                {
                  if(digit1!='' || operator!='' || digit2!='' || answer!='')
                  {
                    if($.trim(digit1)=='')
                    {
                        $('#err_digit'+i+'_1').html('This field is required.');
                        flag = 1;    
                    }
                    else if(isNaN(digit1))
                    {
                      $('#err_digit'+i+'_1').html('Invalid field value.');
                      flag = 1;  
                    }
                    if($.trim(operator)=='')
                    {
                      $('#err_operator'+i).html('This field is required.');
                      flag = 1;  
                    }
                    if($.trim(digit2)=='')
                    {
                        $('#err_digit'+i+'_2').html('This field is required.');
                        flag = 1;    
                    }
                    else if(isNaN(digit2))
                    {
                      $('#err_digit'+i+'_2').html('Invalid field value.');
                      flag = 1;  
                    }
                    if($.trim(answer)=='')
                    {
                      $('#err_answer'+i).html('This field is required.');
                      flag = 1;  
                    }
                    else if(isNaN(answer))
                    {
                      $('#err_answer'+i).html('Invalid field value.');
                      flag = 1;  
                    }
                  }
                }

              }

               if($.trim(direction)=='')
               {
                  $('#err_direction').html('This field is required.');
                  flag = 1;  
               }

               /*if(flHorn == '')
               {
                   $('#err_flHorn').html('This field is required.');
                   flag = 1;
               }
               else if(!(flHornExt == "mp3" || flHornExt == "MP3" || flHornExt == "wave" || flHornExt == "m4a"))
               {
                   $('#err_flHorn').html('Invalid file type.');
                   flag = 1;
               }*/
               if($.trim(duration)=='' || parseInt(duration)==0)
               {
                  $('#err_duration').html('This field is required.');
                  flag = 1;
               }
               else if(isNaN(duration))
               {
                  $('#err_duration').html('Invalid time.');
                  flag = 1;
               }
           }

           else if(parseInt(hiddenTemplate)==40)
           {
              var direction = $('#direction').val();
              
              var question1_1=CKEDITOR.instances['question1_1'].getData().replace(/<[^>]*>/gi, '').length;
              var question1_2=CKEDITOR.instances['question1_2'].getData().replace(/<[^>]*>/gi, '').length;
              var operator1 = $('#operator1').val();
              
              /*var flHorn   = $('#flHorn').val();
              var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);*/
              var duration = $('#duration').val();

              $('#err_direction').html('');

              $('#err_question1_1').html('');
              $('#err_question1_2').html('');
              $('#err_operator1').html('');
              
              /*$('#err_flHorn').html('');*/

              $('#err_duration').html('');
              
               if($.trim(direction)=='')
               {
                   $('#err_direction').html('This field is required.');
                   flag = 1;
               }

               if(question1_1=='')
               {
                   $('#err_question1_1').html('This field is required.');
                   flag = 1;
               }
               if(question1_2=='')
               {
                   $('#err_question1_2').html('This field is required.');
                   flag = 1;
               }
               if(operator1=='')
               {
                   $('#err_operator1').html('This field is required.');
                   flag = 1;
               }

              for (var i = 2; i <= 6; i++)
              {
                 var question1=CKEDITOR.instances['question'+i+'_1'].getData().replace(/<[^>]*>/gi, '').length;
                 var question2=CKEDITOR.instances['question'+i+'_2'].getData().replace(/<[^>]*>/gi, '').length;
                 var operator = $('#operator'+i).val();

                  $('#err_question'+i+'_1').html('');
                  $('#err_question'+i+'_2').html('');
                  $('#err_operator'+i).html('');

                  if($.trim(question1)!=0 || $.trim(question2)!=0 || $.trim(operator)!='')
                  {
                     if(question1=='')
                     {
                         $('#err_question'+i+'_1').html('This field is required.');
                         flag = 1;
                     }
                     if(question2=='')
                     {
                         $('#err_question'+i+'_2').html('This field is required.');
                         flag = 1;
                     }
                     if(operator2=='')
                     {
                         $('#err_operator'+i).html('This field is required.');
                         flag = 1;
                     }
                  }
                  if($.trim(duration)=='' || parseInt(duration)==0)
                  {
                    $('#err_duration').html('This field is required.');
                    flag = 1;
                  }
                  else if(isNaN(duration))
                  {
                    $('#err_duration').html('Invalid time.');
                    flag = 1;
                  }
              }
              
           }

           else if(parseInt(hiddenTemplate)==41)
           {
               var direction = $('#direction').val();
              
              var question1_1 = CKEDITOR.instances['question1_1'].getData().replace(/<[^>]*>/gi, '').length;
              var question1_2 = CKEDITOR.instances['question1_2'].getData().replace(/<[^>]*>/gi, '').length;
              var operator1   = $('#operator1').val();

              var duration = $('#duration').val();

              $('#err_direction').html('');
              $('#err_question1_1').html('');
              $('#err_question1_2').html('');
              $('#err_operator1').html('');

               if($.trim(direction)=='')
               {
                   $('#err_direction').html('This field is required.');
                   flag = 1;
               }

               if(question1_1=='')
               {
                   $('#err_question1_1').html('This field is required.');
                   flag = 1;
               }
               if(question1_2=='')
               {
                   $('#err_question1_2').html('This field is required.');
                   flag = 1;
               }
               if(operator1=='')
               {
                   $('#err_operator1').html('This field is required.');
                   flag = 1;
               }
              for(var i = 2; i <= 6; i++)
              {
                  $('#err_question'+i+'_1').html('');
                  $('#err_question'+i+'_2').html('');
                  $('#err_operator'+i).html('');
                  
                  var question1   = CKEDITOR.instances['question'+i+'_1'].getData().replace(/<[^>]*>/gi, '').length;
                  var question2   = CKEDITOR.instances['question'+i+'_2'].getData().replace(/<[^>]*>/gi, '').length;
                  var operator2   = $('#operator'+i).val();
                  if($.trim(question1)!=0 || $.trim(question2)!=0 || $.trim(operator2)!='')
                  {
                     if(question1=='')
                     {
                         $('#err_question'+i+'_1').html('This field is required.');
                         flag = 1;
                     }
                     if(question2=='')
                     {
                         $('#err_question'+i+'_2').html('This field is required.');
                         flag = 1;
                     }
                     if(operator2=='')
                     {
                         $('#err_operator'+i).html('This field is required.');
                         flag = 1;
                     }
                  }
              }
               /*if(flHorn == '')
               {
                   $('#err_flHorn').html('This field is required.');
                   flag = 1;
               }
               else if(!(flHornExt == "mp3" || flHornExt == "MP3" || flHornExt == "wave" || flHornExt == "m4a"))
               {
                   $('#err_flHorn').html('Invalid file type.');
                   flag = 1;
               }*/
               if($.trim(duration)=='' || parseInt(duration)==0)
               {
                  $('#err_duration').html('This field is required.');
                  flag = 1;
               }
               else if(isNaN(duration))
               {
                  $('#err_duration').html('Invalid time.');
                  flag = 1;
               }
              
           }

           else if(parseInt(hiddenTemplate)==42)
           {

              var direction = $('#direction').val();
              
              var question1_1=CKEDITOR.instances['question1_1'].getData().replace(/<[^>]*>/gi, '').length;
              var answer1_1 = $('#answer1_1').val();
              var answer1_2 = $('#answer1_2').val();
              
              /*var flHorn   = $('#flHorn').val();
              var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);*/
              var duration = $('#duration').val();

              $('#err_direction').html('');

              $('#err_question1_1').html('');
              $('#err_answer1_1').html('');
              $('#err_answer1_2').html('');

              
              /*$('#err_flHorn').html('');*/

              $('#err_duration').html('');
              
               if($.trim(direction)=='')
               {
                   $('#err_direction').html('This field is required.');
                   flag = 1;
               }

               if(question1_1=='')
               {
                   $('#err_question1_1').html('This field is required.');
                   flag = 1;
               }
               if(answer1_1=='')
               {
                   $('#err_answer1_1').html('This field is required.');
                   flag = 1;
               }
               else if(isNaN(answer1_1))
               {
                   $('#err_answer1_1').html('Invalid field value.');
                   flag = 1;
               }
               if(answer1_2=='')
               {
                   $('#err_answer1_2').html('This field is required.');
                   flag = 1;
               }
               else if(isNaN(answer1_2))
               {
                   $('#err_answer1_2').html('Invalid field value.');
                   flag = 1;
               }
               for (var i = 2; i <= 6; i++)
               {

                  var question  =CKEDITOR.instances['question'+i+'_1'].getData().replace(/<[^>]*>/gi, '').length;
                  var answer1 = $('#answer'+i+'_1').val();
                  var answer2 = $('#answer'+i+'_2').val();

                  $('#err_question'+i+'_1').html('');
                  $('#err_answer'+i+'_1').html('');
                  $('#err_answer'+i+'_2').html('');

                  if($.trim(question)!=0 || $.trim(answer1)!='' || $.trim(answer2)!='')
                  {
                     if(question=='')
                     {
                         $('#err_question'+i+'_1').html('This field is required.');
                         flag = 1;
                     }
                     if(answer1=='')
                     {
                         $('#err_answer'+i+'_1').html('This field is required.');
                         flag = 1;
                     }
                     else if(isNaN(answer1))
                     {
                         $('#err_answer'+i+'_1').html('Invalid field value.');
                         flag = 1;
                     }
                     if(answer2=='')
                     {
                         $('#err_answer'+i+'_2').html('This field is required.');
                         flag = 1;
                     }
                     else if(isNaN(answer2))
                     {
                         $('#err_answer'+i+'_2').html('Invalid field value.');
                         flag = 1;
                     }
                  }
                }
                if($.trim(duration)=='' || parseInt(duration)==0)
                {
                    $('#err_duration').html('This field is required.');
                    flag = 1;
                }
                else if(isNaN(duration))
                {
                    $('#err_duration').html('Invalid time.');
                    flag = 1;
                }
           }

           else if(parseInt(hiddenTemplate)==43)
           {
              var direction = $('#direction').val();

              var flQuestion = $('#flQuestion').val();
              var flQuestionExt = flQuestion.substring(flQuestion.lastIndexOf('.')+1);
              
              var question1 = $('#question1').val();
              var answer1 = $('#answer1').val();

              var question2 = $('#question2').val();
              var answer2 = $('#answer2').val();

              var question3 = $('#question3').val();
              var answer3 = $('#answer3').val();

              /*var flHorn   = $('#flHorn').val();
              var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);*/
              var duration = $('#duration').val();

              $('#err_direction').html('');
              $('#err_flQuestion').html('');

              $('#err_question1').html('');
              $('#err_answer1').html('');

              $('#err_question2').html('');
              $('#err_answer2').html('');

              $('#err_question3').html('');
              $('#err_answer3').html('');

              /*$('#err_flHorn').html('');*/

              $('#err_duration').html('');

               if($.trim(direction)=='')
               {
                  $('#err_direction').html('This field is required.');
                  flag = 1;  
               }

               if(flQuestion == '')
               {
                   $('#err_flQuestion').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestionExt == "jpg" || flQuestionExt == "jpeg" || flQuestionExt == "gif" || flQuestionExt == "png" || flQuestionExt == "GIF" || flQuestionExt == "JPG" || flQuestionExt == "JPEG" || flQuestionExt == "PNG"))
               {
                   $('#err_flQuestion').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion').attr('data-error')=='yes')
               {
                  $('#err_flQuestion').html('File must be grater than / equal to 570 X 540.');
                  flag=1;  
               }

               /*if($.trim(question1)!='')
               {
                  if($.trim(answer1)=='')
                  {
                      $('#err_answer1').html('This field is required.');
                      flag = 1;  
                  }
                  else
                  {
                       if($.trim(question1)!='')
                       {
                          var questionAnsArr = question1.match(/#BLANK#/g);
                          var questionAnsCount = questionAnsArr.length;
                          var answerCount = answer1.split(',').length;
                          if(parseInt(answerCount) != parseInt(questionAnsCount))
                          {
                            $('#err_answer1').html('Please enter all answers.');
                            flag = 1;          
                          }
                       }  
                       else
                       {
                        $('#err_question1').html('This field is required.');
                          flag = 1;  
                       }              
                  }
               }
               if($.trim(answer1)!='')
               {
                  if($.trim(question1)=='')
                  {
                      $('#err_question1').html('This field is required.');
                      flag = 1;  
                  }
                  if($.trim(answer1)=='')
                  {
                      $('#err_answer1').html('This field is required.');
                      flag = 1;  
                  }
                  else
                  {
                       if($.trim(question1)!='')
                       {
                          var questionAnsArr = question1.match(/#BLANK#/g);
                          var questionAnsCount = questionAnsArr.length;
                          var answerCount = answer1.split(',').length;
                          if(parseInt(answerCount) != parseInt(questionAnsCount))
                          {
                            $('#err_answer1').html('Please enter all answers.');
                            flag = 1;          
                          }
                       }  
                       else
                       {
                        $('#err_question1').html('This field is required.');
                          flag = 1;  
                       }              
                  }
               }*/

               if($.trim(question1)=='')
               {
                  $('#err_question1').html('This field is required.');
                  flag = 1;  
               }
               else
               {
                  var questionAnsArr = question1.match(/#BLANK#/g);
                  if(questionAnsArr==null)
                  {
                    $('#err_question1').html('#BLANK# is missing');
                    flag = 1;    
                  }
                  /*else
                  {
                    var questionAnsCount = questionAnsArr.length;  
                    if(parseInt(questionAnsCount)!=1)
                    {
                      $('#err_question1').html('Only one #BLANK# is allowed');
                      flag = 1;       
                    }
                  }*/
               }
               if($.trim(answer1)=='')
               {
                  $('#err_answer1').html('This field is required.');
                  flag = 1;  
               }
               else
               {
                   if($.trim(question1)!='')
                   {
                      var questionAnsArr = question1.match(/#BLANK#/g);
                      var questionAnsCount = questionAnsArr.length;
                      var answerCount = answer1.split(',').length;
                      if(parseInt(answerCount) != parseInt(questionAnsCount))
                      {
                        $('#err_answer1').html('Please enter all answers.');
                        flag = 1;          
                      }
                   }  
                   else
                   {
                    $('#err_question1').html('This field is required.');
                      flag = 1;  
                   }              
               }

               if($.trim(answer2)!='')
               {
                 if($.trim(question2)=='')
                 {
                    $('#err_question2').html('This field is required.');
                    flag = 1;  
                 }
                 else
                 {
                    var questionAnsArr = question2.match(/#BLANK#/g);
                    if(questionAnsArr==null)
                    {
                      $('#err_question2').html('#BLANK# is missing');
                      flag = 1;    
                    }
                 }
               }

               if($.trim(question2)!='')
               {
                 if($.trim(answer2)=='')
                 {
                    $('#err_answer2').html('This field is required.');
                    flag = 1;  
                 }
                 else
                 {
                     if($.trim(question2)!='')
                     {
                        var questionAnsArr = question2.match(/#BLANK#/g);
                        var questionAnsCount = questionAnsArr.length;
                        var answerCount = answer2.split(',').length;
                        if(parseInt(answerCount) != parseInt(questionAnsCount))
                        {
                          $('#err_answer2').html('Please enter all answers.');
                          flag = 1;          
                        }
                     }  
                     else
                     {
                      $('#err_question2').html('This field is required.');
                        flag = 1;  
                     }              
                 }
               }
               
               if($.trim(answer3)!='')
               {
                 if($.trim(question3)=='')
                 {
                    $('#err_question3').html('This field is required.');
                    flag = 1;  
                 }
                 else
                 {
                    var questionAnsArr = question3.match(/#BLANK#/g);
                    if(questionAnsArr==null)
                    {
                      $('#err_question3').html('#BLANK# is missing');
                      flag = 1;    
                    }
                 }
               }

               if($.trim(question3)!='')
               {
                 if($.trim(answer3)=='')
                 {
                    $('#err_answer3').html('This field is required.');
                    flag = 1;  
                 }
                 else
                 {
                     if($.trim(question3)!='')
                     {
                        var questionAnsArr = question3.match(/#BLANK#/g);
                        var questionAnsCount = questionAnsArr.length;
                        var answerCount = answer3.split(',').length;
                        if(parseInt(answerCount) != parseInt(questionAnsCount))
                        {
                          $('#err_answer3').html('Please enter all answers.');
                          flag = 1;          
                        }
                     }  
                     else
                     {
                      $('#err_question3').html('This field is required.');
                        flag = 1;  
                     }              
                 }
               }
               
               /*if(flHorn == '')
               {
                   $('#err_flHorn').html('This field is required.');
                   flag = 1;
               }
               else if(!(flHornExt == "mp3" || flHornExt == "MP3" || flHornExt == "wave" || flHornExt == "m4a"))
               {
                   $('#err_flHorn').html('Invalid file type.');
                   flag = 1;
               }*/

               if($.trim(duration)=='' || parseInt(duration)==0)
               {
                  $('#err_duration').html('This field is required.');
                  flag = 1;
               }
               else if(isNaN(duration))
               {
                  $('#err_duration').html('Invalid time.');
                  flag = 1;
               }
           }
           else if(parseInt(hiddenTemplate)==44)
           {
              var row     = $('#row').val();
              var column  = $('#column').val();
              var direction = $('#direction').val();
              var digit1_1 = $('#digit1_1').val();
              var operator1 = $('#operator1').val();
              var digit1_2 = $('#digit1_2').val();
              var answer1 = $('#answer1').val();
              /*var flHorn   = $('#flHorn').val();
              var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);*/
              var duration = $('#duration').val();
                

              $('#err_row').html('')
              $('#err_column').html('');
              $('#err_direction').html('');
              $('#err_digit1_1').html('');
              $('#err_operator1').html('');
              $('#err_digit1_2').html('');
              $('#err_answer1').html('');
              /*$('#err_flHorn').html('');*/
              $('#err_duration').html('');

              // alert(digit1_1+'/'+row+'/'+column);
               if($.trim(direction)=='')
               {
                  $('#err_direction').html('This field is required.');
                  flag = 1;  
               }

               if($.trim(digit1_1)=='')
               {
                  $('#err_digit1_1').html('This field is required.');
                  flag=1;
               }
               else if(isNaN(digit1_1))
               {
                  $('#err_digit1_1').html('Invalid field value.');
                  flag=1;
               }
               else if(parseInt(digit1_1) < parseInt(row) || parseInt(digit1_1) > parseInt(column))
               {
                  $('#err_digit1_1').html('This field should be between '+row+' and '+column);
                  flag=1;
               }
               if($.trim(operator1)=='')
               {
                  $('#err_operator1').html('This field is required.');
                  flag=1;
               }
               if($.trim(digit1_2)=='')
               {
                  $('#err_digit1_2').html('This field is required.');
                  flag=1;
               }
               else if(isNaN(digit1_2))
               {
                  $('#err_digit1_2').html('Invalid field value.');
                  flag=1;
               }
               else if(digit1_2>10)
               {
                  $('#err_digit1_2').html('Second digit should be less than equal to 10');
                  flag=1;
               }
               if($.trim(answer1)=='')
               {
                  $('#err_answer1').html('This field is required.');
                  flag=1;
               }
               else if(isNaN(answer1))
               {
                  $('#err_answer1').html('Invalid field value.');
                  flag=1;
               }
            
             if(row=='')
              {
                  $('#err_row').html('This field is required');
                  flag = 0;
              }
              if(column=='')
              {
                  $('#err_column').html('This field is required');
                  flag = 0;
              }
              if((column-row)>10)
              {
                  $('#err_row').html('Can\'t generate more than 10 tables');
                  flag = 0;
              }

              if($.trim(duration)=='' || parseInt(duration)==0)
               {
                  $('#err_duration').html('This field is required.');
                  flag = 1;
               }
               else if(isNaN(duration))
               {
                  $('#err_duration').html('Invalid time.');
                  flag = 1;
               }
           }
           else if(parseInt(hiddenTemplate)==45)
           {
              var direction = $('#direction').val();

              var flQuestion1 = $('#flQuestion1').val();
              var flQuestion1Ext = flQuestion1.substring(flQuestion1.lastIndexOf('.')+1);
              var question1_1 = $('#question1_1').val();
              var answer1_1 = $('#answer1_1').val();
              var question1_2 = $('#question1_2').val();
              var answer1_2 = $('#answer1_2').val();
              var question1_3 = $('#question1_3').val();
              var answer1_3 = $('#answer1_3').val();

              var flQuestion2 = $('#flQuestion2').val();
              var flQuestion2Ext = flQuestion2.substring(flQuestion2.lastIndexOf('.')+1);
              var question2_1 = $('#question2_1').val();
              var answer2_1 = $('#answer2_1').val();
              var question2_2 = $('#question2_2').val();
              var answer2_2 = $('#answer2_2').val();
              var question2_3 = $('#question2_3').val();
              var answer2_3 = $('#answer2_3').val();

              /*var flHorn   = $('#flHorn').val();
              var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);*/
              var duration = $('#duration').val();

              $('#err_direction').html('');
              
              $('#err_flQuestion1').html('');
              $('#err_question1_1').html('');
              $('#err_answer1_1').html('');
              $('#err_question1_2').html('');
              $('#err_answer1_2').html('');
              $('#err_question1_3').html('');
              $('#err_answer1_3').html('');

              $('#err_flQuestion2').html('');
              $('#err_question2_1').html('');
              $('#err_answer2_1').html('');
              $('#err_question2_2').html('');
              $('#err_answer2_2').html('');
              $('#err_question2_3').html('');
              $('#err_answer2_3').html('');

              /*$('#err_flHorn').html('');*/
              $('#err_duration').html('');

               if($.trim(direction)=='')
               {
                  $('#err_direction').html('This field is required.');
                  flag = 1;  
               }

               /*Question : 1*/
               if(flQuestion1 == '')
               {
                   $('#err_flQuestion1').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion1Ext == "jpg" || flQuestion1Ext == "jpeg" || flQuestion1Ext == "gif" || flQuestion1Ext == "png" || flQuestion1Ext == "GIF" || flQuestion1Ext == "JPG" || flQuestion1Ext == "JPEG" || flQuestion1Ext == "PNG"))
               {
                   $('#err_flQuestion1').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion1').attr('data-error')=='yes')
               {
                  $('#err_flQuestion1').html('File must be grater than / equal to 429 X 269.');
                  flag=1;  
               }

               if($.trim(question1_1)=='')
               {
                  $('#err_question1_1').html('This field is required.');
                  flag = 1;  
               }
               else
               {
                  var questionAnsArr = question1_1.match(/#BLANK#/g);
                  if(questionAnsArr==null)
                  {
                    $('#err_question1_1').html('#BLANK# is missing');
                    flag = 1;    
                  }
                  /*else
                  {
                    var questionAnsCount = questionAnsArr.length;  
                    if(parseInt(questionAnsCount)!=1)
                    {
                      $('#err_question1_1').html('Only one #BLANK# is allowed');
                      flag = 1;       
                    }
                  }*/
               }
               if($.trim(answer1_1)=='')
               {
                  $('#err_answer1_1').html('This field is required.');
                  flag = 1;  
               }
               else
               {
                   if($.trim(question1_1)!='')
                   {
                      var questionAnsArr = question1_1.match(/#BLANK#/g);
                      var questionAnsCount = questionAnsArr.length;
                      var answerCount = answer1_1.split(',').length;
                      if(parseInt(answerCount) != parseInt(questionAnsCount))
                      {
                        $('#err_answer1_1').html('Please enter all answers.');
                        flag = 1;          
                      }
                   }  
                   else
                   {
                    $('#err_question1_1').html('This field is required.');
                      flag = 1;  
                   }              
               }
               
               if($.trim(question1_2)!='' || $.trim(answer1_2)!='')
               {
                 if($.trim(question1_2)=='')
                 {
                    $('#err_question1_2').html('This field is required.');
                    flag = 1;  
                 }
                 else
                 {
                    var questionAnsArr = question1_2.match(/#BLANK#/g);
                    if(questionAnsArr==null)
                    {
                      $('#err_question1_2').html('#BLANK# is missing');
                      flag = 1;    
                    }
                 }

                 if($.trim(answer1_2)=='')
                 {
                    $('#err_answer1_2').html('This field is required.');
                    flag = 1;  
                 }
                 else
                 {
                     if($.trim(question1_2)!='')
                     {
                        var questionAnsArr = question1_2.match(/#BLANK#/g);
                        var questionAnsCount = questionAnsArr.length;
                        var answerCount = answer1_2.split(',').length;
                        if(parseInt(answerCount) != parseInt(questionAnsCount))
                        {
                          $('#err_answer1_2').html('Please enter all answers.');
                          flag = 1;          
                        }
                     }  
                     else
                     {
                      $('#err_question1_2').html('This field is required.');
                        flag = 1;  
                     }              
                 }
               }

               if($.trim(question1_3)!='' || $.trim(answer1_3)!='')
               {
                   if($.trim(question1_3)=='')
                   {
                      $('#err_question1_3').html('This field is required.');
                      flag = 1;  
                   }
                   else
                   {
                      var questionAnsArr = question1_3.match(/#BLANK#/g);
                      if(questionAnsArr==null)
                      {
                        $('#err_question1_3').html('#BLANK# is missing');
                        flag = 1;    
                      }
                   }
                   if($.trim(answer1_3)=='')
                   {
                      $('#err_answer1_3').html('This field is required.');
                      flag = 1;  
                   }
                   else
                   {
                       if($.trim(question1_3)!='')
                       {
                          var questionAnsArr = question1_3.match(/#BLANK#/g);
                          var questionAnsCount = questionAnsArr.length;
                          var answerCount = answer1_3.split(',').length;
                          if(parseInt(answerCount) != parseInt(questionAnsCount))
                          {
                            $('#err_answer1_3').html('Please enter all answers.');
                            flag = 1;          
                          }
                       }  
                       else
                       {
                        $('#err_question1_3').html('This field is required.');
                          flag = 1;
                       }              
                   }
               }

               /*Question : 2*/
               if(flQuestion2 == '')
               {
                   $('#err_flQuestion2').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion2Ext == "jpg" || flQuestion2Ext == "jpeg" || flQuestion2Ext == "gif" || flQuestion2Ext == "png" || flQuestion2Ext == "GIF" || flQuestion2Ext == "JPG" || flQuestion2Ext == "JPEG" || flQuestion2Ext == "PNG"))
               {
                   $('#err_flQuestion2').html('Invalid file type.');
                   flag=1;
               }

               if($.trim(question2_1)=='')
               {
                  $('#err_question2_1').html('This field is required.');
                  flag = 1;  
               }
               else
               {
                  var questionAnsArr = question2_1.match(/#BLANK#/g);
                  if(questionAnsArr==null)
                  {
                    $('#err_question2_1').html('#BLANK# is missing');
                    flag = 1;    
                  }
               }
               if($.trim(answer2_1)=='')
               {
                  $('#err_answer2_1').html('This field is required.');
                  flag = 1;  
               }
               else
               {
                   if($.trim(question2_1)!='')
                   {
                      var questionAnsArr = question2_1.match(/#BLANK#/g);
                      var questionAnsCount = questionAnsArr.length;
                      var answerCount = answer2_1.split(',').length;
                      if(parseInt(answerCount) != parseInt(questionAnsCount))
                      {
                        $('#err_answer2_1').html('Please enter all answers.');
                        flag = 1;          
                      }
                   }  
                   else
                   {
                    $('#err_question2_1').html('This field is required.');
                      flag = 1;  
                   }              
               }
               
               if($.trim(question2_2)!='' || $.trim(answer2_2)!='')
               {
                 if($.trim(question2_2)=='')
                 {
                    $('#err_question2_2').html('This field is required.');
                    flag = 1;  
                 }
                 else
                 {
                    var questionAnsArr = question2_2.match(/#BLANK#/g);
                    if(questionAnsArr==null)
                    {
                      $('#err_question2_2').html('#BLANK# is missing');
                      flag = 1;    
                    }
                    
                 }

                 if($.trim(answer2_2)=='')
                 {
                    $('#err_answer2_2').html('This field is required.');
                    flag = 1;  
                 }
                 else
                 {
                     if($.trim(question2_2)!='')
                     {
                        var questionAnsArr = question2_2.match(/#BLANK#/g);
                        var questionAnsCount = questionAnsArr.length;
                        var answerCount = answer2_2.split(',').length;
                        if(parseInt(answerCount) != parseInt(questionAnsCount))
                        {
                          $('#err_answer2_2').html('Please enter all answers.');
                          flag = 1;          
                        }
                     }  
                     else
                     {
                      $('#err_question2_2').html('This field is required.');
                        flag = 1;  
                     }              
                 }
               }

               if($.trim(question2_3)!='' || $.trim(answer2_3)!='')
               {
                 if($.trim(question2_3)=='')
                 {
                    $('#err_question2_3').html('This field is required.');
                    flag = 1;  
                 }
                 else
                 {
                    var questionAnsArr = question2_3.match(/#BLANK#/g);
                    if(questionAnsArr==null)
                    {
                      $('#err_question2_3').html('#BLANK# is missing');
                      flag = 1;    
                    }
                    /*else
                    {
                      var questionAnsCount = questionAnsArr.length;  
                      if(parseInt(questionAnsCount)!=1)
                      {
                        $('#err_question2_3').html('Only one #BLANK# is allowed');
                        flag = 1;       
                      }
                    }*/
                 }
                 if($.trim(answer2_3)=='')
                 {
                    $('#err_answer2_3').html('This field is required.');
                    flag = 1;  
                 }
                 else
                 {
                     if($.trim(question2_3)!='')
                     {
                        var questionAnsArr = question2_3.match(/#BLANK#/g);
                        var questionAnsCount = questionAnsArr.length;
                        var answerCount = answer2_3.split(',').length;
                        if(parseInt(answerCount) != parseInt(questionAnsCount))
                        {
                          $('#err_answer2_3').html('Please enter all answers.');
                          flag = 1;          
                        }
                     }  
                     else
                     {
                      $('#err_question2_3').html('This field is required.');
                        flag = 1;  
                     }              
                 }
               }
               /*if(flHorn == '')
               {
                   $('#err_flHorn').html('This field is required.');
                   flag = 1;
               }
               else if(!(flHornExt == "mp3" || flHornExt == "MP3" || flHornExt == "wave"))
               {
                   $('#err_flHorn').html('Invalid file type.');
                   flag = 1;
               }*/

               if($.trim(duration)=='' || parseInt(duration)==0)
               {
                  $('#err_duration').html('This field is required.');
                  flag = 1;
               }
               else if(isNaN(duration))
               {
                  $('#err_duration').html('Invalid time.');
                  flag = 1;
               }
           }

           else if(parseInt(hiddenTemplate)==46)
           {
              var direction = $('#direction').val();
              var flQuestion1 = $('#flQuestion1').val();
              var flQuestion1Ext = flQuestion1.substring(flQuestion1.lastIndexOf('.') + 1);
              var question1 = $('#question1').val();
              var answer1   = $('#answer1').val();

              var duration = $('#duration').val();

              $('#err_direction').html('');
              $('#err_flQuestion1').html('');
              $('#err_question1').html('');
              $('#err_answer1').html('');

              /*$('#err_flHorn').html('');*/
              $('#err_duration').html('');

               if($.trim(direction)=='')
               {
                  $('#err_direction').html('This field is required.');
                  flag = 1;  
               }

               if(flQuestion1 == '')
               {
                   $('#err_flQuestion1').html('This field is required.');
                   flag = 1;
               }
               else if(!(flQuestion1Ext == "jpg" || flQuestion1Ext == "jpeg" || flQuestion1Ext == "gif" || flQuestion1Ext == "png" || flQuestion1Ext == "GIF" || flQuestion1Ext == "JPG" || flQuestion1Ext == "JPEG" || flQuestion1Ext == "PNG"))
               {
                   $('#err_flQuestion1').html('Invalid file type.');
                   flag=1;
               }
               else if($('#flQuestion1').attr('data-error')=='yes')
               {
                  $('#err_flQuestion1').html('File must be grater than / equal to 570 X 442.');
                  flag=1;  
               }

               if($.trim(question1)=='')
               {
                  $('#err_question1').html('This field is required.');
                  flag = 1;  
               }
               if($.trim(answer1)=='')
               {
                  $('#err_answer1').html('This field is required.');
                  flag = 1;  
               }
               for (var i = 2; i <= 6; i++)
               {
                    var question  = $('#question'+i).val();
                    var answer   = $('#answer'+i).val();
                    if($.trim(question)!='' || $.trim(answer)!='')
                    {
                       if($.trim(question)=='')
                       {
                          $('#err_question'+i).html('This field is required.');
                          flag = 1;  
                       }
                       if($.trim(answer)=='')
                       {
                          $('#err_answer'+i).html('This field is required.');
                          flag = 1;  
                       }
                    }
               }
               if($.trim(duration)=='' || parseInt(duration)==0)
               {
                  $('#err_duration').html('This field is required.');
                  flag = 1;
               }
               else if(isNaN(duration))
               {
                  $('#err_duration').html('Invalid time.');
                  flag = 1;
               }
           }

           else if(parseInt(hiddenTemplate)==47)
           {
              var direction = $('#direction').val();
              var questionFlag = 0;
              var chkBlankLetterFlag = 0;
              var duration = $('#duration').val();
              
              $('#err_direction').html('');
              $('#err_duration').html('');

              if($.trim(direction)=='')
              {
                  $('#err_direction').html('This field is required.');
                  flag = 1;
              }

              $('.classQuestion').each(function(){
                if($(this).val() == '')
                {
                  questionFlag = 1;
                }
              });

              if(parseInt(questionFlag) == 1)
              {
                swal('Please enter all question values.');
                flag = 1;
              }

              $('.chkBlankLetter').each(function(){
                if($(this).prop("checked") == true)
                {
                  chkBlankLetterFlag = 1;
                }
              });

              if(parseInt(chkBlankLetterFlag) == 0)
              {
                swal('Please check atleast one checkbox.');
                flag = 1;
              }


              if($.trim(duration)=='' || parseInt(duration)==0)
              {
                  $('#err_duration').html('This field is required.');
                  flag = 1;
              }
              else if(isNaN(duration))
              {
                  $('#err_duration').html('Invalid time.');
                  flag = 1;
              }
           }

           else if(parseInt(hiddenTemplate)==48)
           {
               var direction = $('#direction').val();
               var question = $('#question').val();
               /*var flHorn   = $('#flHorn').val();
               var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);*/
               var duration = $('#duration').val();
   
               $('#err_direction').html('');
               $('#err_question').html('');
               /*$('#err_flHorn').html('');*/
               $('#err_chkBlankLetter').html('');
               $('#err_duration').html('');

               if($.trim(direction)=='')
               {
                   $('#err_direction').html('This field is required.');
                   flag = 1;
               }
               if($.trim(question)=='')
               {
                   $('#err_question').html('This field is required.');
                   flag = 1;
               }
               else
               {
                  if($('input[name="chkBlankLetter[]"]:checked').length == 0)
                  {
                    $('#err_chkBlankLetter').html('Please checked atleast one checkbox');
                    flag = 1;    
                  }
               }

               /*if(flHorn == '')
               {
                   $('#err_flHorn').html('This field is required.');
                   flag = 1;
               }
               else if(!(flHornExt == "mp3" || flHornExt == "MP3" || flHornExt == "wave"))
               {
                   $('#err_flHorn').html('Invalid file type.');
                   flag = 1;
               }*/

               if($.trim(duration)=='' || parseInt(duration)==0)
               {
                  $('#err_duration').html('This field is required.');
                  flag = 1;
               }
               else if(isNaN(duration))
               {
                  $('#err_duration').html('Invalid time.');
                  flag = 1;
               }
           }

           else if(parseInt(hiddenTemplate)==49)
           {
              var direction = $('#direction').val();
              var question  =CKEDITOR.instances['question'].getData().replace(/<[^>]*>/gi, '').length;
              var option_1  =CKEDITOR.instances['option_1'].getData().replace(/<[^>]*>/gi, '').length;
            
              var rdoOption = $('input[name="rdoOption"]:checked').val();
              var duration = $('#duration').val();


              $('#err_direction').html('');
              $('#err_question').html('');
              /*$('#err_flHorn').html('');*/
              $('#err_duration').html('');
              
               if($.trim(direction)=='')
               {
                   $('#err_direction').html('This field is required.');
                   flag = 1;
               }

               if(question=='')
               {
                   $('#err_question').html('This field is required.');
                   flag = 1;
               }
                if(option_1=='')
               {
                   $('#err_option_1').html('This field is required.');
                   flag = 1;
               }
               for (var i = 2; i <=4; i++)
               {
                   $('#err_option_'+i).html('');
                   var option = CKEDITOR.instances['option_'+i].getData().replace(/<[^>]*>/gi, '').length;
                   if($("#rdoOption_"+i).prop("checked"))
                   {
                     if(option=='')
                     {
                         $('#err_option_'+i).html('This field is required.');
                         flag = 1;
                     }
                   }
                   
               }   
               if(rdoOption==null)
               {
                  flag = 1;
                  swal('Please select one option who is correct Answer.')
               }

               if($.trim(duration)=='' || parseInt(duration)==0)
               {
                  $('#err_duration').html('This field is required.');
                  flag = 1;
               }
               else if(isNaN(duration))
               {
                  $('#err_duration').html('Invalid time.');
                  flag = 1;
               }
              
           }

           else if(parseInt(hiddenTemplate)==50)
           {
                var direction = $('#direction').val();
                var question1 = $('#question1').val();
                var question2 = $('#question2').val();
                var option_1  = $('#option_1').val();

                var rdoOption_1 = $('input[name="rdoOption_1"]:checked').val();
                /*var flHorn   = $('#flHorn').val();
                var flHornExt = flHorn.substring(flHorn.lastIndexOf('.') + 1);*/
                var duration = $('#duration').val();

                $('#err_direction').html('');
                $('#err_question1').html('');
                $('#err_question2').html('');
                $('#err_option_1').html('');
                $('#err_rdoOption_1').html('');
                /*$('#err_flHorn').html('');*/
                $('#err_duration').html('');

                 if($.trim(direction)=='')
                 {
                    $('#err_direction').html('This field is required.');
                    flag = 1;  
                 }

                 if($.trim(question1)=='')
                 {
                    $('#err_question1').html('This field is required.');
                    flag = 1;  
                 }
                 if($.trim(question2)=='')
                 {
                    $('#err_question2').html('This field is required.');
                    flag = 1;  
                 }
                 if($.trim(option_1)=='')
                 {
                    $('#err_option_1').html('This field is required.');
                    flag = 1;  
                 }
                 if($.trim(rdoOption_1)==null)
                 {
                    $('#err_rdoOption_1').html('This field is required.');
                    flag = 1;  
                 }
                 for(var i = 2; i <= 4; i++)
                 {
                    $('#err_option_'+i).html('');
                    var option  = $('#option_'+i).val();
                     if($("#rdoOption_"+i).prop("checked"))
                     {
                         if($.trim(option)=='')
                         {
                            $('#err_option_'+i).html('This field is required.');
                            flag = 1;  
                         }
                     }
                 }

                 if($.trim(duration)=='' || parseInt(duration)==0)
                 {
                    $('#err_duration').html('This field is required.');
                    flag = 1;
                 }
                 else if(isNaN(duration))
                 {
                    $('#err_duration').html('Invalid time.');
                    flag = 1;
                 }

           }

           /*TEMPLATE : VALIDATION*/
           $('#btnAddLesson').attr('disabled', false);
           $('#btnAddQuiz').attr('disabled', false);
           $('#btnShowPreview').attr('disabled', false);
           $('#btnSubmit').attr('disabled', false);
           if(btnAction=='btnAddQuiz')
           {
              $('#btnAddQuiz').html('+ Add Quizzes');
           }
           else if(btnAction=='btnSubmit')
           {
              $('#btnSubmit').html('Submit');
           }
           else if(btnAction=='btnShowPreview')
           {
              $('#btnShowPreview').html('Submit');
           }

           if(flag == 1)
           {
               return false;
           }
           else
           {
                if(parseInt(hiddenTemplate)==49 || parseInt(hiddenTemplate)==40 || parseInt(hiddenTemplate)==41 || parseInt(hiddenTemplate)==42)
                {
                  for (instance in CKEDITOR.instances) {
                      CKEDITOR.instances[instance].updateElement();
                  }
                }
                var formData = new FormData($("#frmTemplateCreate")[0]);
                $.ajax({
                  type:"POST",
                  url:'{{ url('/') }}/template_preview/'+programId,
                  data:formData,
                  processData: false,
                  contentType: false,
                  cache: false,
                  success: function(response){
                      if(response.status=='success'){
                        $('#resultPreview').html('');
                        $('#resultPreview').html(response.view);
                        $('#popup_template_preview').modal({
                            backdrop: 'static',
                            keyboard: false,
                            show: true
                        });
                      }
                    }
                });
           }
       }
   });

    $( "#popup_template_preview" ).on('shown.bs.modal', function(){
        $('html').removeClass('perfect-scrollbar-on');
        $('.modal-backdrop').addClass('dark-bg');
        if($(".game-img-section").height() != 'undefined' && $(".game-fill-text-section").height() != 'undefined'){
			if($(".game-img-section").height() > $(".game-fill-text-section").height()){
				$(".game-fill-text-section").css('height', $(".game-img-section").height());
			}else{
				$(".game-img-section").css('height', $(".game-fill-text-section").height());
			}
		}
    });
    
    function close_popup(){
    $('html').addClass('perfect-scrollbar-on');
        $('.modal-backdrop').removeClass('dark-bg');     
    }  

   /*btnUploadHomework*/
   $(document).on('click', '#btnUploadHomework', function(){

   });
</script>

<!-- DESIGN -->
<script type="text/javascript">
    /*SLIDER*/
    $('.carousel').carousel({
       interval: false
    });
    
    /*FILE NAME : PREVIEW*/
    $(document).on('change', '.uploadFile', function(){
        var uploadFile = $(this).val();
        if(uploadFile!='')
        {
          $(this).closest('.upload-block').find('.uploadFileName').val(uploadFile);
        }
    });

    /*IMAGE : PREVIEW*/
    /*$(document).on('change', '.imgFile', function(){
      var id = $(this).closest('.profile-img-block').find('.imgFilePreview').attr('id');
      readURL(this, id);
    });*/

    function readURL(input, id) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        var defaultImage = '{{ url("/") }}/images/default.jpg';
        var extension = input.files[0]['name'].substr( input.files[0]['name'].lastIndexOf('.') +1 );
        /*console.log(defaultImage+'===='+extension);*/
        /*console.log(input);
        console.log(input.files[0]['name']);*/
        reader.onload = function(e) {
          if(extension.toLowerCase()=='jpg' || extension.toLowerCase()=='jpeg' || extension.toLowerCase()=='png')
          {
            $('#'+id).attr('src', e.target.result);
          }
          else
          {
            $('#'+id).attr('src', defaultImage); 
          }
        }
        reader.readAsDataURL(input.files[0]);
      }
    }
</script>
<!-- for template all -->
<link href="{{ url ('/') }}/css/admin/timingfield.css" type="text/css" rel="stylesheet" media="screen" />
<script src="{{ url ('/') }}/js/admin/timingfield.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function($) {
        $(".timing").timingfield();
    });
</script>
<!-- for template all end here -->
@endsection
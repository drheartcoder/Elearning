@extends('creator.layout.master')    
@section('main_content')
<!-- BEGIN Main Content -->
<!-- Page header -->
    @include('creator.layout.breadcrumb')  
<!-- /page header -->

<!-- Content area -->
<div class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="card-body-section material-create-main">
            <div class="card">
               <div class="card-header card-header-icon card-header-rose">
                  <div class="card-icon">
                     <i class="fa fa-gear"></i>
                  </div>
                  <h4 class="card-title">{{$module_title or ''}}</h4>
               </div>
               <div class="card-body">
               	@include('creator.layout._operation_status')
                   <h4 class="title"></h4>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="assignment-gray-main">
                                <div class="select-label-name">
                                    Select
                                </div>
                                <select class="js-example-basic-multiple" multiple="multiple">
                                    <option value="AL">Assignment 4</option>
                                    <option value="AL">Assignment 1</option>
                                    <option value="WY">xyz</option>
                                    <option value="WY">pqr</option>
                                    <option value="AL">Assignment 2</option>
                                </select>
                                <div class="drow-arrow-select">
                                    <i class="fa fa-caret-down"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="border-bottom">
                                <div class="row">
                                    <div class="col-sm-6 col-md-6 col-lg-6">
                                        <div class="program-details-section">
                                            <div class="program-head">
                                                <b>Subject <span>:</span> </b> 
                                            </div>
                                            <div class="program-content-txt">
                                                Maths
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-6">
                                        <div class="program-details-section">
                                            <div class="program-head">
                                                <b>Grade <span>:</span></b>
                                            </div>
                                            <div class="program-content-txt">
                                                A
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                    <form action="/upload-target" class="dropzone">
                        <div class="fallback">
                            <input name="file" type="file" multiple />
                        </div>
                    </form>  
                    <button type="submit" class="btn btn-rose pull-right">Student</button>                 
               </div>
            </div>
         </div>                 
      </div>
   </div>
</div>

<script src="{{ url ( '/' ) }}/js/admin/dropzone.js"></script>
<link rel="stylesheet" href="{{ url ( '/' ) }}/css/admin/dropzone.css">

<link href="{{ url ( '/' ) }}/css/admin/select2.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="{{ url ( '/' ) }}/js/admin/select2.full.js"></script>
<script type="text/javascript">
    $(".js-example-basic-multiple").select2();
    $(".select2").on("click", function(){
        $(this).parent(".assignment-gray-main").addClass("active");
    });
</script>

@endsection


			
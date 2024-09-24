@extends('admin.layout.master')    
@section('main_content')
<!-- Page header -->
@include('admin.layout.breadcrumb')  
<!-- /page header -->		
<div class="content">
<div class="container-fluid">
  <div class="row">
    <div class="card-body-section">
      <div class="card">
        <div class="card-header card-header-primary card-header-icon">
          <div class="card-icon">
            <!-- <i class="material-icons">assignment</i> -->
            <i class="{{ $module_icon or ''}}"> </i>
          </div>
          <h4 class="card-title">{{ $sub_module_title or '' }}</h4>
        </div>
        <div class="card-body">
        	@include('admin.layout._operation_status')			
	            <form class="form-horizontal" id="frm_site_setting" name="frm_site_setting" action="{{$module_url_path}}/store" method="post">
                <ul class="nav nav-pills nav-pills-warning" role="tablist" id="tabs">
                          @include('admin.layout._multi_lang_tab')                    
                </ul>
	               {{csrf_field()}}	    
                  <div class="tab-content tab-space">
                          @if(isset($arr_lang) && sizeof($arr_lang)>0)
                          @foreach($arr_lang as $lang)

                          <div class="tab-pane {{ $lang['locale']=='en'?'active':'' }}" id="{{ $lang['locale'] }}">  
                                      	
                            <div class="form-group has-default bmd-form-group is-filled">
                                <label class="bmd-label-floating">Address <i class="red">*</i></label>
                                <input type="text" name="site_address_{{ $lang['locale'] or '' }}" id="site_address_{{ $lang['locale'] or '' }}" placeholder="" class="form-control" data-rule-required="true" data-rule-maxlength="500" value="{{$arr_site_settings['site_address'] or ''}}">
                                <span class="error">{{ $errors->first('site_address') }} </span>
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
        </div>
        <!-- end content-->
      </div>
      <!--  end card  -->
    </div>
    <!-- end col-md-12 -->
  </div>
  <!-- end row -->
</div>
</div>
<script>
$(document).ready(function(){
	$("#site_address").geocomplete();
});

$(document).ready(function(){
	$('#frm_site_setting').validate({
		ignore: [],
     invalidHandler: function(e, validator){
          if(validator.errorList.length){
            $('#tabs a[href="#' + jQuery(validator.errorList[0].element).closest(".tab-pane").attr('id') + '"]').tab('show')
          }
      },
		errorPlacement: function(error, element) 
		{ 
			var name = $(element).attr("name");
			if (name === "site_status") 
			{
				error.insertAfter('.err_site_status');
			} 
			else
			{
				error.insertAfter(element);
			}
		} 
	});

});
</script>
@endsection
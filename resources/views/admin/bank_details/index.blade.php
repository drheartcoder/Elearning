@extends('admin.layout.master')    
@section('main_content')
<!-- BEGIN Main Content -->
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
                     <!-- <i class="{{ $module_icon }}"></i> --><i class="material-icons">account_balance</i>
                  </div>
                  <h4 class="card-title">{{ $module_title or ''}} </h4>
               </div>
               <div class="card-body">

               	@include('admin.layout._operation_status')
                <?php

                  $account_number      = isset($arr_bank_details['account_number']) && !empty($arr_bank_details['account_number']) ? $arr_bank_details['account_number'] : '';
                  $ifsc_code           = isset($arr_bank_details['ifsc_code']) && !empty($arr_bank_details['ifsc_code']) ? $arr_bank_details['ifsc_code'] : '';
                  $swift_code          = isset($arr_bank_details['swift_code']) && !empty($arr_bank_details['swift_code']) ? $arr_bank_details['swift_code'] : '';
        				?>

                  <form class="form-horizontal" id="frm_bank_details" name="frm_bank_details" action="{{ $module_url_path }}/update" method="post">
                       <ul class="nav nav-pills nav-pills-warning" role="tablist" id="tabs">
                          @include('admin.layout._multi_lang_tab')                    
                       </ul>

                  	{{ csrf_field() }}

                     <div class="tab-content tab-space">
                          @if(isset($arr_lang) && sizeof($arr_lang)>0)
                          @foreach($arr_lang as $lang)

                          <div class="tab-pane {{ $lang['locale']=='en'?'active':'' }}" id="{{ $lang['locale'] }}">  
                            
                            <div class="row">

                            <div class="col-md-6">
                              <div class="form-group has-default bmd-form-group is-filled">
                                  <label class="bmd-label-floating">Account Holder Name ({{ $lang['title'] }}) <i class="red">*</i></label>
                                  <input type="text" name="account_holder_name_{{$lang['locale']}}" id="account_holder_name_{{$lang['locale']}}" class="form-control" data-rule-required="true" data-rule-maxlength="60" maxlength="60" value="{{ $arr_bank_details['bank_translation'][$lang['locale']]['account_holder_name'] or ''}}">
                                  <span class="error">{{ $errors->first('account_holder_name') }} </span>
                              </div>
                            </div>
                            @if($lang['locale']=='en')
                            <div class="col-md-6">
                              <div class="form-group has-default bmd-form-group is-filled">
                                  <label class="bmd-label-floating">Account No. <i class="red">*</i></label>
                                  <input type="text" name="account_number" id="account_number" class="form-control digits" data-rule-required="true" data-rule-maxlength="30" maxlength="30" value="{{ $account_number }}">
                                  <span class="error">{{ $errors->first('account_number') }} </span>
                              </div>
                            </div>
                            @else
                             <div class="col-md-6"></div>                   
                           @endif  
                          </div>  

                          <div class="row">
                             <div class="col-md-6">
                              <div class="form-group has-default bmd-form-group is-filled">
                                  <label class="bmd-label-floating">Bank Name ({{ $lang['title'] }})<i class="red">*</i></label>
                                  <input type="text" name="bank_name_{{$lang['locale']}}" id="bank_name_{{$lang['locale']}}" class="form-control" data-rule-required="true" data-rule-maxlength="60" maxlength="60" value="{{ $arr_bank_details['bank_translation'][$lang['locale']]['bank_name'] or ''}}">
                                  <span class="error">{{ $errors->first('bank_name') }}</span>
                              </div>
                             </div>

                            <div class="col-md-6">
                            <div class="form-group has-default bmd-form-group is-filled">
                                <label class="bmd-label-floating">Branch({{ $lang['title'] }}) <i class="red">*</i></label>
                                <input type="text" name="branch_name_{{$lang['locale']}}" id="branch_{{$lang['locale']}}" class="form-control" data-rule-required="true" data-rule-maxlength="60" maxlength="60" value="{{ $arr_bank_details['bank_translation'][$lang['locale']]['branch'] or ''}}">
                                <span class="error">{{ $errors->first('branch') }} </span>
                            </div>
                            </div>
                          </div>
                          
                          @if($lang['locale']=='en')
                            <div class="row">
                              <div class="col-md-6">
                              <div class="form-group has-default bmd-form-group is-filled">
                                  <label class="bmd-label-floating">IFSC Code</label>
                                  <input type="text" data-rule-required="true" name="ifsc_code" id="ifsc_code" class="form-control digits" data-rule-maxlength="30" maxlength="30" value="{{ $ifsc_code }}">
                                  <span class="error">{{ $errors->first('ifsc_code') }} </span>
                              </div>
                            </div>
                              <div class="col-md-6">
                              <div class="form-group has-default bmd-form-group is-filled">
                                  <label class="bmd-label-floating">SWIFT Code</label>
                                  <input type="text" data-rule-required="true" name="swift_code" id="swift_code" class="form-control digits" data-rule-maxlength="30" maxlength="30" value="{{ $swift_code }}">
                                  <span class="error">{{ $errors->first('swift_code') }} </span>
                              </div>
                              </div>
                          </div>     
                          @endif

                          <div class="row">
                           <div class="col-md-12">
                              <div class="form-group has-default bmd-form-group is-filled">
                                  <label class="bmd-label-floating">Note ({{ $lang['title'] }}) </label>
                                  <textarea name="note_{{$lang['locale']}}" id="note_{{$lang['locale']}}" class="form-control" rows="10">{{ $arr_bank_details['bank_translation'][$lang['locale']]['note'] or ''}}</textarea> 
                                  <span class="error">{{ $errors->first('note') }} </span>
                              </div>
                            </div> 
                          </div>

                          </div> 
                          @endforeach
                          @endif 
                           <button type="submit" class="btn btn-rose pull-right">Add</button>
                          <button type="button" onclick="location.href='{{$module_url_path}}'" class="btn btn-rose pull-right">Cancel</button>
                        <div class="clearfix"></div>                  
                       </div>   

                  </form>
               </div>
            </div>
         </div>                 
      </div>
   </div>
</div>

<script>
		var rules = new Object();
    $(document).ready(function(){
			$('#frm_bank_details').validate({
				highlight: function (element) {},
        ignore: [],
        rules: rules,
        invalidHandler: function(e, validator){
                  if(validator.errorList.length){
                    $('#tabs a[href="#' + jQuery(validator.errorList[0].element).closest(".tab-pane").attr('id') + '"]').tab('show')
                  }
              },
				errorPlacement: function(error, element) 
				{ 
				  var name = $(element).attr("name");
				  error.insertAfter(element);
				} 
			});

			// Allow only Numeric Characters
      $(document).on('keydown blur', '.digits', function() {
        if (this.value.match(/[^.0-9]/g)) {
          this.value = this.value.replace(/[^.0-9]/g, '');
        }
	    });

      // Allow only Alphabet Characters
      $(document).on('keydown blur', '.alphabets', function() {
          if (this.value.match(/[^a-zA-Z ]/g)) {
              this.value = this.value.replace(/[^a-zA-Z ]/g, '');
          }
      });

		});

	</script>

@endsection


			
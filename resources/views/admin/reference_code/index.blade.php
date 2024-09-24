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
                     <i class="fa fa-money"></i>
                  </div>
                  <h4 class="card-title">{{$module_title or ''}} </h4>
               </div>
               <div class="card-body">
               	@include('admin.layout._operation_status')
               	<?php
					$currency_sym          = isset($arr_currency['html_code']) && !empty($arr_currency['html_code']) ? $arr_currency['html_code'] : '';
					$validity_extension    = isset($arr_reference_code['validity_extension']) && !empty($arr_reference_code['validity_extension']) ? $arr_reference_code['validity_extension'] : '';
					$reference_reward_type = isset($arr_reference_code['reference_reward_type']) && !empty($arr_reference_code['reference_reward_type']) ? $arr_reference_code['reference_reward_type'] : '';
				?>
                  <form class="form-horizontal" id="frm_reference_code" name="frm_reference_code" action="{{url('/admin/reference_code/update')}}" method="post">
                  	{{csrf_field()}}
                  	<h4 class="title">&nbsp;</h4>  

                  		<div class="form-group has-default bmd-form-group is-filled">
                            <label class="bmd-label-floating">Reference Reward Type<i class="red">*</i> </label>		              			              	
		                	<div class="form-check">
			                  <label class="form-check-label">			                  	
			                    <input class="form-check-input" type="radio" name="reference_reward_type" value="validity_extension" @if($reference_reward_type == 'validity_extension') checked="" @endif> Validity Extension
			                    <span class="circle">
			                      <span class="check"></span>
			                    </span>
			                  </label>		               
			                  <label class="form-check-label">
			                    <input class="form-check-input" type="radio" name="reference_reward_type" value="reference_amount" @if($reference_reward_type == 'reference_amount') checked="" @endif> Insentive Amount
			                    <span class="circle">
			                      <span class="check"></span>
			                    </span>
			                  </label>
			                  <label class="form-check-label">
			                    <input class="form-check-input" type="radio" name="reference_reward_type" value="both" @if($reference_reward_type == 'both') checked="" @endif> Both
			                    <span class="circle">
			                      <span class="check"></span>
			                    </span>
			                  </label>
			                </div>
			                <span class="error">{{ $errors->first('reference_reward_type') }}</span>
		              	</div>                    
                     
                       	<div class="form-group has-default bmd-form-group is-filled">
                          	<label class="bmd-label-floating">Validity Extension (Months) <i class="red">*</i></label>
                          	<input type="text" name="validity_extension" id="validity_extension" class="form-control" data-rule-required="true" data-rule-maxlength="20" maxlength="20" value="{{$arr_reference_code['validity_extension'] or ''}}">
                          	<span class="error">{{ $errors->first('validity_extension') }}</span>
                       	</div>
                                         								
                       	<div class="form-group has-default bmd-form-group is-filled">
                          	<label class="bmd-label-floating">Insentive Amount ({!! $currency_sym !!}) <i class="red">*</i></label>
                          	<input type="text" name="reward_amount" id="reward_amount" class="form-control" data-rule-required="true" data-rule-maxlength="20" maxlength="20" value="{{$arr_reference_code['reward_amount'] or ''}}">
                          	<span class="error">{{ $errors->first('reward_amount') }} </span>
                       	</div>                   

                 
                   <!--     	<div class="form-group has-default bmd-form-group is-filled">
                          	<label class="bmd-label-floating">Reward Amount for Reference Parent ({!! $currency_sym !!}) <i class="red">*</i></label>
                          	<input type="text" name="reward_amount_for_reference_parent" id="reward_amount_for_reference_parent" class="form-control" data-rule-required="true" data-rule-maxlength="20" maxlength="20" value="{{$arr_reference_code['reward_amount_for_reference_parent'] or ''}}">
                          	<span class="error">{{ $errors->first('reward_amount_for_reference_parent') }}</span>
                       	</div>  -->
                    
                     <button type="submit" class="btn btn-rose pull-right">Update</button>
                     <div class="clearfix"></div>
                  </form>
               </div>
            </div>
         </div>                 
      </div>
   </div>
</div>




<script>
		$(document).ready(function(){
			$('#frm_reference_code').validate({
				ignore: [],
				errorPlacement: function(error, element) 
				{ 
					var name = $(element).attr("name");
					if (name === "reference_reward_type") 
					{
						error.insertAfter('.err_reference_code');
					} 
					else
					{
						error.insertAfter(element);
					}
				} 
			});

			$('#validity_extension').blur(function(){
				var extention = $('#validity_extension').val();
				if(parseFloat(extention)==0)
				{
					this.value = this.value.replace(/[^.0-9]/g, '');
				}


			});

			// Allow only Numeric Characters
		    $('#validity_extension, #reward_amount, #reward_amount_for_reference_parent').keyup(function() {
		        if (this.value.match(/[^.0-9]/g)) {
		            this.value = this.value.replace(/[^.0-9]/g, '');
		        }
		    });
		});
	</script>

@endsection


			
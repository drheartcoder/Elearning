
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
      <h5 class="panel-title">{{$page_title or ''}}</h5>
    </div>

    <?php $currency_sym = isset($arr_currency['html_code']) && !empty($arr_currency['html_code']) ? $arr_currency['html_code'] : ''; ?>
    
    <div class="panel-body">
      <fieldset class="content-group">  
            <div class="table-responsive">
              <table class="table table-bordered" style="width: 80%">
                <tbody>
                  @if(isset($arr_lang) && sizeof($arr_lang)>0)
                    @foreach($arr_lang as $lang)
                      <tr>
                        <th class="col-md-3 col-sm-3">Name ({{ $lang['title'] }})</th>
                        <td>{{ isset($arr_subscription_plan['testimonial_translation'][$lang['locale']]['title']) ? $arr_subscription_plan['testimonial_translation'][$lang['locale']]['title'] : '' }}</td>
                      </tr>
                    @endforeach
                  @endif
                  @if(isset($arr_lang) && sizeof($arr_lang)>0)
                    @foreach($arr_lang as $lang)
                      <tr>
                        <th class="col-md-3 col-sm-3">Message ({{ $lang['title'] }})</th>
                        <td>{!! isset($arr_subscription_plan['testimonial_translation'][$lang['locale']]['message']) ? $arr_subscription_plan['testimonial_translation'][$lang['locale']]['message'] : '' !!}</td>
                      </tr>
                    @endforeach
                  @endif
                </tbody>
              </table>
            </div>
            <br>
            <div class="form-group text-center">
              <div class="col-lg-7">
                <a href="{{ $module_url_path }}" class="btn btn-primary">Back</a>
              </div>
            </div>
        </fieldset>

    </div>

  @endsection

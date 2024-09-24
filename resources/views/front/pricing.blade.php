
<div class="gray-btn-main-section pircing-main-section">
    <div class="container">   
          @include('front.layout._operation_status')
          @if(isset($arr_price_page['description']) && $arr_price_page['description']!="")
          {!!  $arr_price_page['description'] !!}
          @endif
    </div>
</div>

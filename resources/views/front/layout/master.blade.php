<!-- Header -->
@if(isset($pageTitle) && $pageTitle!="")
	@php $pageTitle = $pageTitle @endphp
@else
	@php $pageTitle = '' @endphp
@endif
@include('front.layout.header',['title' => $pageTitle])
<!-- BEGIN Content -->
@include('front.'.$middleContent)
<!-- END Main Content -->

<!-- Footer -->
@include('front.layout.footer')


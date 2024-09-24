<!-- Header -->
@include('front.layout.header',['title' => $pageTitle])

<!-- BEGIN Content -->
@include('front.student.template_layout.masterPage',['templateContent' => $templateContent])
<!-- END Main Content -->

<!-- Footer -->
@include('front.layout.footer')

<!-- bredcrum section -->
<div class="bredcrum-section-main">
    <div class="container">
        <div class="page-title-main">
            {{$pageTitle or ''}}
        </div>
        <div class="page-bredcrum-section">
            <ul>
                <li><a href="{{ url('/') }}/{{ $user_type }}/dashboard">{{ $parentTitle }}</a> &nbsp;&nbsp; <i class="fa fa-angle-right"></i> &nbsp;&nbsp; </li>
                @if(isset($secondParentUrl) && !empty($secondParentUrl) && isset($secondParentTitle) && !empty($secondParentTitle))
                    <li><a href="{{ $secondParentUrl }}">{{ $secondParentTitle }}</a> &nbsp;&nbsp; <i class="fa fa-angle-right"></i> &nbsp;&nbsp; </li>
                @endif
                <li>{{ $pageTitle or '' }}</li>
            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!-- bredcrum section end -->
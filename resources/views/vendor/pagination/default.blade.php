<style type="text/css">
    .pagination-section-block li a.active{background: #0f6bb0;color: #ffffff;};
</style>
@if ($paginator->hasPages())
    <ul class="">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())        
            <li class="disabled"><a  rel="prev"><span><i class="fa fa-angle-left"></i></span></a></li>
        @else
            <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev"><i class="fa fa-angle-left"></i></a></li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="disabled"><span>{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())                    
                        <li><a class="active"><span>{{ $page }}</span></a></li>
                    @else
                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li><a href="{{ $paginator->nextPageUrl() }}" rel="next"><i class="fa fa-angle-right"></i></a></li>
        @else
            <li class="disabled"><a rel="next"><span><i class="fa fa-angle-right"></i></span></a></li>
        @endif
    </ul>
@endif

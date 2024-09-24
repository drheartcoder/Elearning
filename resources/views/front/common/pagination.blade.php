<div class="pagination-section-block">
    <ul>
    	@php $querystringArray['sort_by'] = Request::input('sort_by'); @endphp
         <li>{{ $arr_pagination->appends($querystringArray)->links() }}</li>
    </ul>
</div>


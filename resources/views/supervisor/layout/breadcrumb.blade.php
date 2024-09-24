<style type="text/css">  
  input{cursor: pointer;}
  .breadcrumb ul li{display:inline-block;}
</style>
  
    <ul class="breadcrumb">
      <li class="{{isset($module_title) && !empty($module_title) ? '' : 'active'}}">
          @if(isset($module_title) && !empty($module_title))
              <a href="{{isset($module_title) && isset($parent_module_url) ? $parent_module_url : 'javascript:void(0)'}}">
                <i class="{{$parent_module_icon or ''}}"></i> {{$parent_module_title or ''}}
                <span class="arrow"><i class="fa fa-angle-right"></i> </span>
              </a>
          @else
              <i class="{{$parent_module_icon or ''}}"></i> {{$parent_module_title or ''}}
          @endif 
      </li>
      @if(isset($module_title) && !empty($module_title))
          <li class="{{isset($sub_module_title) && !empty($sub_module_title) ? '' : 'active'}}">
              @if(isset($sub_module_title) && !empty($sub_module_title))
                  <a href="{{$module_url or 'javascript:void(0)'}}">
                      <i class="{{$module_icon or ''}}"> </i> {{$module_title or ''}}
                      <span class="arrow"><i class="fa fa-angle-right"></i> </span>
                  </a>
              @else
                  <i class="{{$module_icon or ''}}"> </i> {{$module_title or ''}}
              @endif
          </li>
      @endif
      @if(isset($sub_module_title) &&  !empty($sub_module_title))
        <li class="active">
            <i class="{{$sub_module_icon or ''}}"> </i> {{$sub_module_title or ''}}
        </li>
      @endif
    </ul>


<style type="text/css">  
  input{cursor: pointer;}
  .breadcrumb ul li{display:inline-block;}
</style>
  
    <ul class="breadcrumb">
      <li class="{{isset($module_title) && !empty($module_title) ? '' : 'active'}}">
          @if(isset($module_title) && !empty($module_title))
              <a href="{{isset($module_title) && isset($parent_module_url) ? $parent_module_url : 'javascript:void(0)'}}">
                {{$parent_module_title or ''}}&nbsp;
                <span class=""><i class="fa fa-angle-right"></i> </span> &nbsp;
              </a>
          @else
              {{$parent_module_title or ''}}
          @endif
      </li>
      @if(isset($module_title) && !empty($module_title))
          <li class="{{isset($sub_module_title) && !empty($sub_module_title) ? '' : 'active'}}">
              @if(isset($sub_module_title) && !empty($sub_module_title))
                  <a href="{{$module_url or 'javascript:void(0)'}}">
                      {{$module_title or ''}}&nbsp;
                      <span class=""><i class="fa fa-angle-right"></i> </span> &nbsp;
                  </a>
              @else
                  {{$module_title or ''}}
              @endif
          </li>
      @endif
      @if(isset($sub_module_title) &&  !empty($sub_module_title))
        <li class="active">
            {{$sub_module_title or ''}}
        </li>
      @endif
    </ul>


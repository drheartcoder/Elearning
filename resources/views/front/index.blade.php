
{!! $pageDescription !!}


@if(isset($arr_gallery) && !empty($arr_gallery))
<!--gallery section start-->
<div class="gallery-wrapper">
    <div class="container">
        <h2>{{trans('home.Our_Gallery')}}</h2>
        <div class="demo-gallery dark mrb35">
                <ul id="fixed-size" class="list-unstyled row">
                    
                @foreach($arr_gallery as $gallery)

                    <?php
                        $img_path     = get_resized_image($gallery['name'],$gallery_base_img_path,'225','360');
                        $gallery_path = get_resized_image($gallery['name'],$gallery_base_img_path,'800','800');
                    ?>

                    <li class="col-xs-6 col-sm-4 col-md-4" data-src="{{ $gallery_path }}">
                        <a class="gallery-block" href="javascript:void(0)">
                            <img class="img-responsive" src="{{ $img_path }}" alt="learning app">
                            <div class="hover-block">&nbsp;</div>
                        </a>
                    </li>

                @endforeach

                </ul>
                <!-- <a href="javascript:void(0)" class="view-gallery">View All Gallery</a> -->
            </div>
    </div>
</div>
<!--gallery section end-->
@endif

<!--video modal start-->
 <div class="modal video-modal fade popup-cls" id="watch_video" role="dialog">
    <div class="modal-dialog modal-lg">
       <div class="modal-content">
          <button type="button" class="modal-close" data-dismiss="modal">&nbsp;</button>
          <div class="modal-body">
               <!-- <video id="video1" controls> -->                
                <?php $arr =$arr1= [];
                    $url = '';
                    if($arr_global_site_setting['site_video']!='')
                    {
                        if (strpos($arr_global_site_setting['site_video'], 'youtube.com') !== false) {
                                $arr = explode('v=',$arr_global_site_setting['site_video']);
                                $arr1 = explode('/',$arr_global_site_setting['site_video']);
                                
                                if(count($arr)>0 && isset($arr[1]) && $arr[1]!='')
                                {
                                    $url = 'https://www.youtube.com/embed/'.$arr[1];
                                }                               
                                else if(count($arr1)>0)
                                {
                                    $end = end($arr1);
                                    $url = 'https://www.youtube.com/embed/'.$end;
                                }
                                else
                                {
                                    $url = $arr_global_site_setting['site_video'];
                                }
                            }
                            else
                            {
                                $url = $arr_global_site_setting['site_video'];
                            } 
                        
                        // dump($url,$arr_ads->promotional_video_link);
                    }
                        
                    ?>

                <iframe width="900" height="393" src="{{$url or ''}}" frameborder="0" allowfullscreen controls></iframe> 
                  <!-- <source src="{{ url('/') }}/video/video1.mp4" type="video/mp4">Your browser does not support HTML5 video. -->
              <!-- </video> -->
          </div>
       </div>
    </div>
</div>
<!--video modal end-->

<script>
    $("#watch_video").on('click', function(){
      $("#video1").get(0).pause();
    });
</script>

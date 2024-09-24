@include('front.layout.bredcrum')

<div class="gray-btn-main-section dashboard-middle-section">
    <div class="container">
        <div class="col-sm-4 col-md-3 col-lg-3">
            @include('front.layout.left_bar')
        </div>
        <div class="col-sm-8 col-md-9 col-lg-9">  
            <div class="my-profile-section"> 

            @include('front.layout._operation_status')
                
                @if(isset($arr_notifications['data']) && !empty($arr_notifications['data']))
                    @foreach($arr_notifications['data'] as $notifications)

                        @php
                            $id  = isset($notifications['id']) && !empty($notifications['id']) ? base64_encode($notifications['id']) : '';
                            $msg  = isset($notifications['message']) && !empty($notifications['message']) ? $notifications['message'] : '';
                            $date = isset($notifications['created_at']) && !empty($notifications['created_at']) ? get_added_on_date_time($notifications['created_at']) : '';
                            $url  = isset($notifications['url']) && !empty($notifications['url']) ?url($notifications['url']) : 'javascript:void(0)';
                        @endphp

                        <div class="notification-content">
                            <div class="noti-head-content">
                                <a href="{{ $url }}"><span>{{ $msg }}</span></a>
                                <button type="button" class="close-noti open_parent_notification_popup" data-toggle="modal" data-target="#remove-notification" data-backdrop="static" data-keyboard="false" data-id="{{ $id }}"></button>
                            </div>
                            <div class="noti-time">{{ $date }}</div>
                        </div>

                    @endforeach

                @else
                    <div class="class-details-txt-section" style="text-align: center;">
                        {{trans('parent.no_notifications_to_show')}}
                    </div>
                    <div class="clearfix"></div>
                @endif

            </div>
            <div class="pagination-section-block">                        
                <ul>{!! $arr_pagination !!} </ul>
            </div>
        </div>    
    </div>
</div>

<!-- Modal -->
<div id="remove-notification" class="modal fade inner-page-modal remove-class-modal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal"></button>
                <div class="modal-head-section">
                    {{trans('parent.Remove_Notification')}}
                </div>
                <div class="remove-modal-txt-block">
                    {{trans('parent.Confirm_remove_notification')}} 
                </div>
                <form id="form_delete_notification" method="post" action="{{ url('/') }}/parent/notification/delete">
                    {{ csrf_field() }}
                    <input type="hidden" name="delete_notification_id" id="txt_delete_notification_id" value="" />
                    <div class="modal-button-section">
                        <button type="button" class="full-fill-button border-button sim-button-blue" data-dismiss="modal">{{trans('parent.Cancel')}}</button>
                        <button type="submit" id="btn_delete_class" class="full-fill-button sim-button">{{trans('auth.Confirm')}} </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

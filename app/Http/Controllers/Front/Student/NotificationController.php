<?php

namespace App\Http\Controllers\Front\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Common\Services\LanguageService;
use App\Common\Services\NotificationService;

use App\Models\UsersModel;
use App\Models\NotificationsModel;

use Validator;
use Response;
use Session;
use flash;
use Auth;
use DB;

class NotificationController extends Controller
{
    public function __construct(NotificationService $notification_service)
    {
        $this->NotificationService = $notification_service;
        $this->NotificationsModel  = new NotificationsModel();
    }

    public function Index()
    {
        $parent_id = Auth::user()->id;

        $obj_notifications = $this->NotificationsModel->where('to_user_id', $parent_id)->orderBy('id', 'DESC')->paginate(10);
        if($obj_notifications)
        {
            $arr_notifications =  $obj_notifications->toArray();
            $arr_pagination    =  $obj_notifications->links();
            $update_is_raed    =  $this->NotificationsModel->where('to_user_id', $parent_id)->where('is_read', '0')->update(['is_read'=>'1']);
        }

        $data['arr_notifications'] =  $arr_notifications;
        $data['arr_pagination']    =  $arr_pagination;
        $data['pageTitle']         =  trans('parent.Notification');
        $data['user_type']         = 'student';
        $data['parentTitle']       = trans('parent.Dashboard');
        $data['middleContent']     = 'student.notification.index';
        
        return view('front.layout.master')->with($data);
    } // end Index


    public function Delete(Request $request)
    {
        $notification_id = $request->input('delete_notification_id');

        if($notification_id)
        {
            $parent_id = Auth::user()->id;
            $id        = base64_decode($notification_id);

            $del_notifications = $this->NotificationsModel->where('to_user_id', $parent_id)->where('id', $id)->delete();
            if($del_notifications)
            {
                Session::flash('success',trans('parent.Notification_removed_success'));
            }
        }
        else
        {
            Session::flash('error',trans('parent.Notification_removed_error'));
        }
        return redirect()->back();
    } // end Delete

}

<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\FrontPagesModel;
use App\Models\SiteStatusModel;
use App\Models\ContactDetailsModel;
use App\Models\ContactEnquiryModel;
use App\Models\ContactAddressTranslationModel;

use App\Common\Services\NotificationService;

use Validator;
use Session;
use App;

class StaticPagesController extends Controller
{
	public function __construct(NotificationService $notification_service)
    {
        $this->FrontPagesModel     = new FrontPagesModel();
        $this->SiteStatusModel     = new SiteStatusModel();
        $this->ContactDetailsModel = new ContactDetailsModel();
        $this->ContactEnquiryModel = new ContactEnquiryModel();
        $this->ContactAddressTranslationModel = new ContactAddressTranslationModel();


        $this->NotificationService                     = $notification_service;
        $this->contact_us_banner_image_base_img_path   = base_path().config('app.project.img_path.contact_us_banner_image');
        $this->contact_us_banner_image_public_img_path = url('/').config('app.project.img_path.contact_us_banner_image');
    }

    public function Index($slug = false)
    {
        $locale = App::getLocale();
    	if($slug!='')
    	{
    		$obj_page = $this->FrontPagesModel->where('page_slug',$slug)
    										 ->where('status','1')
    										 ->first();
            if($obj_page !=false)
            {
                $page = $obj_page->toArray();             
                if(count($page)>0)
                {
                   $data['pageTitle']       = $page['title'];
                   $data['pageDescription'] = $page['description'];
                   $data['meta_keyword']    = $page['meta_keyword'];
                   $data['meta_desc']       = $page['meta_description'];
                   $data['meta_title']      = $page['meta_title'];
                }                    
                
                $data['middleContent'] = 'front-pages.common';
            }
            else
            {
                if ($slug == 'contact-us') {
                    $arr_address = $arr_page = $arr_site_setting = [];
                    $obj_page = $this->FrontPagesModel->where('page_slug','contact-us-page')
                                             ->where('status','1')
                                             ->first();
                    if($obj_page !=false)
                    {
                        $arr_page = $obj_page->toArray(); 
                    }
                    $obj_address = $this->ContactDetailsModel->with(['address_translation'=>function($q1) use($locale){
                                                                    $q1->where('locale','=',$locale);
                                                                 }])
                                                             ->where('status', '1')->get();
                    if($obj_address) 
                    {
                        $arr_address = $obj_address->toArray();
                    }

                    $obj_site_setting = $this->SiteStatusModel->select('site_contact_number', 'site_email_address')
                                                              ->first();
                    
                    if($obj_site_setting) 
                    {
                        $arr_site_setting = $obj_site_setting->toArray();
                    }

                    $data['arr_page']         = $arr_page;
                    $data['arr_site_setting'] = $arr_site_setting;
                    $data['arr_address']      = $arr_address;
                    $data['pageTitle']        = 'contact-us';
                    $data['meta_keyword']     = 'Contact Us';
                    $data['meta_desc']        = 'Contact Us';
                    $data['meta_title']       = 'Contact Us';
                    $data['contact_us_banner_image_base_img_path']   = $this->contact_us_banner_image_base_img_path;
                    $data['contact_us_banner_image_public_img_path'] = $this->contact_us_banner_image_public_img_path;
                    $data['middleContent']    = 'front-pages.contact-us';
                }
                else
                {
                    return redirect()->back();
                }
            }
    	}
    	return view('front.layout.master')->with($data);
    }


    public function StoreContactUs(Request $request)
    {
        $arr_data = $form_data = $arr_rules = array();

        $arr_rules['first_name'] = "required|Max:60";
        $arr_rules['last_name']  = "required|Max:60";
        $arr_rules['email']      = "required|email";
        $arr_rules['mobile']     = "required|min:8|max:16";
        $arr_rules['subject']    = "required";
        $arr_rules['message']    = "required";

        $validator = Validator::make($request->all() , $arr_rules);
        if ($validator->fails())
        {
            Session::flash('error', 'All the fields are required');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $form_data                  = $request->all();
        $arr_data['first_name']     = isset($form_data['first_name']) ? ucfirst($form_data['first_name']) : '';
        $arr_data['last_name']      = isset($form_data['last_name']) ? ucfirst($form_data['last_name']) : '';
        $arr_data['email']          = isset($form_data['email']) ? $form_data['email'] : '';
        $arr_data['mobile']         = isset($form_data['mobile']) ? $form_data['mobile'] : '';
        $arr_data['subject']        = isset($form_data['subject']) ? $form_data['subject'] : '';
        $arr_data['message']        = isset($form_data['message']) ? $form_data['message'] : '';
        $arr_data['phone_code']     = isset($form_data['phone_code']) ? $form_data['phone_code'] : '';
        $arr_data['is_read_status'] = '0';

        $send = $this->ContactEnquiryModel->create($arr_data);

        if($send)
        {
            $id = isset($send->id)?$send->id:'';
            // Store notification for admin
            $arr_noti['message']      = $form_data['first_name'].' '.$form_data['last_name'].' has sent enquiry';
            $arr_noti['from_user_id'] = '';
            $arr_noti['to_user_id']   = 1;
            $arr_noti['url']          = "/admin/contact_enquiry/view/".base64_encode($id);
            $arr_noti['is_read']      = "0";
            $status                   = $this->NotificationService->send_notification($arr_noti);

            Session::flash('success', trans('teacher.message_send_success'));
            return redirect()->back();
        }
        else
        {
            Session::flash('error', trans('parent.something_went_wrong'));
            return redirect()->back();
        }

    } // end StoreContactUs
}

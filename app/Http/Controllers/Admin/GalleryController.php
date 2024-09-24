<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\GalleryModel;

use App\Common\Traits\MultiActionTrait;

use DB;
use Validator;
use Session;
use flash;
//use DataTables;

class GalleryController extends Controller
{
    public function __construct(GalleryModel $gallery_model)
	{
        $this->arr_view_data           = [];
        $this->GalleryModel            = $gallery_model;

        $this->module_title            = "Gallery";
        $this->module_icon             = "fa fa-picture-o";
        $this->module_view_folder      = "admin.gallery";
        $this->admin_url_path          = url(config('app.project.admin_panel_slug'));
        $this->admin_panel_slug        = config('app.project.admin_panel_slug');
        $this->module_url_path         = url(config('app.project.admin_panel_slug')."/gallery");

        $this->gallery_base_img_path   = base_path().config('app.project.img_path.gallery_image');
        $this->gallery_public_img_path = url('/').config('app.project.img_path.gallery_image');
	}

	public function index()
	{
        $arr_gallery = [];

        $obj_gallery = $this->GalleryModel->get();
        if($obj_gallery)
        {
            $arr_gallery = $obj_gallery->toArray();
        }

        $this->arr_view_data['arr_gallery']             = $arr_gallery;
        $this->arr_view_data['page_title']              = "Manage ".$this->module_title;
        $this->arr_view_data['parent_module_icon']      = "fa fa-home";
        $this->arr_view_data['parent_module_title']     = "Dashboard";
        $this->arr_view_data['parent_module_url']       = url('/').'/admin/dashboard';
        $this->arr_view_data['module_icon']             = $this->module_icon;
        $this->arr_view_data['module_title']            = "Manage ".$this->module_title;

        $this->arr_view_data['module_url_path']         = $this->module_url_path;
        $this->arr_view_data['admin_panel_slug']        = $this->admin_panel_slug;

        $this->arr_view_data['gallery_base_img_path']   = $this->gallery_base_img_path;
        $this->arr_view_data['gallery_public_img_path'] = $this->gallery_public_img_path;

		return view($this->module_view_folder.'.index',$this->arr_view_data);
	}

    public function Store(Request $request)
    {
        if($request->hasFile('gallery_img'))
        {
            $file_name = $request->input('gallery_img');

            $file_extension = strtolower($request->file('gallery_img')->getClientOriginalExtension());

            if(in_array($file_extension,['png','jpg','jpeg']))
            {
                $file_name = sha1(uniqid().$file_name.uniqid()).'.'.$file_extension;

                $isUpload = $request->file('gallery_img')->move($this->gallery_base_img_path , $file_name);

                $img_data['name'] = $file_name;
                $created = $this->GalleryModel->create($img_data);
                
                if($created)
                {
                    Session::flash('success','Image uploaded successfully.');
                }
                else
                {
                    Session::flash('error','Error while uploading a image. Please try again');
                }
            }
            else
            {
                Session::flash('error','Invalid File type format. Please upload only png, jpg, jpeg files');
            }
        }
        else
        {
            Session::flash('error','Something went wrong while uploading files');
        }
        return redirect()->back();
    }

    public function Delete(Request $request)
    {
        $arr_user = $form_data = $arr_rules = array();

        $arr_rules['id']   = "required";
        $arr_rules['name'] = "required";

        $validator = Validator::make($request->all() , $arr_rules);
        if ($validator->fails())
        {
          Session::flash('error','Something went wrong. Please try again.');
          return redirect()->back()->withErrors($validator)->withInput();
        }

        $form_data = $request->all();
        $id        = isset($form_data['id']) ? base64_decode($form_data['id']) : '';
        $name      = isset($form_data['name']) ? base64_decode($form_data['name']) : '';

        if(!empty($id) && !empty($name))
        {
            $is_deleted = $this->GalleryModel->where('id', $id)->where('name', $name)->delete();
            if($is_deleted)
            {
                Session::flash('success','Image deleted successfully.');

                if (file_exists($this->gallery_base_img_path.$name))
                {
                    @unlink($this->gallery_base_img_path.$name);
                }
            }
            else
            {
                Session::flash('error','Something went wrong while deleteing image. Please try again.');
            }
        }
        else
        {
            Session::flash('error','Something went wrong. Please try again.');
        }
        return redirect()->back();
    }

}

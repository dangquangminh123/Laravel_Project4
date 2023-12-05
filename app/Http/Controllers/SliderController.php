<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use Illuminate\Support\Facades\DB;
use Session;
use App\Http\Requests;
use Auth;
use Illuminate\Support\Facades\Redirect;
session_start();
class SliderController extends Controller
{
    // public function AuthLogin() {
    //     $admin_id = Session::get('admin_id');
    //     if($admin_id) {
    //         return Redirect::to('dashboard');
    //     } else {
    //         return Redirect::to('admin')->send();
    //     }
    // }
    public function AuthLogin() {
        $admin_id = Auth::id();
        if($admin_id) {
            return Redirect::to('dashboard');
        } else {
            return Redirect::to('admin')->send();
        }
    }


    public function manage_banner() {
        $all_slide = Slider::orderBy('slider_id','DESC')->get();
        return view('admin.slider.list_slider')->with(compact('all_slide'));
    }

    public function add_banner() {
        return view('admin.slider.add_slider');
    }

    public function insert_slider(Request $request) {

        $this->AuthLogin();

        $data = $request->all();
        $get_image =  request('slider_image');

        if($get_image) {
            $get_name_image = $get_image->getClientOriginalExtension();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/slider',$new_image);
           
            $slider = new Slider();
            $slider->slider_name = $data['slider_name'];
            $slider->slider_image = $new_image;
            $slider->slider_status = $data['slider_status'];
            $slider->slider_desc = $data['slider_desc'];
            $slider->save(); 
            Session::put('message','Thêm hình ảnh slider thành công');
            return Redirect::to('add-banner');
        }
        else {
            Session::put('message','làm ơn thêm hình ảnh');
            return Redirect::to('add-banner');
        }
    }

    public function unactive_slider($slider_id) {
        $this->AuthLogin();
        DB::table('tbl_slider')->where('slider_id',$slider_id)->update(['slider_status'=>0]);
        Session::put('message','Tắt slider thành công');
        return Redirect::to('manage-banner');
    }

    public function active_slider($slider_id) {
        $this->AuthLogin();
        DB::table('tbl_slider')->where('slider_id',$slider_id)->update(['slider_status'=>1]);
        Session::put('message','Bật slider thành công');
        return Redirect::to('manage-banner');
    }
}

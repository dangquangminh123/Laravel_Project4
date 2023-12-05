<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Session;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Contact;
use App\Http\Requests;
use App\Models\Icons;
use App\Imports\ImportProduct;
use App\Models\Gallery;
use App\Models\Rating;
use App\Models\Comment;
use Auth;
use File;
use App\Models\CatePost;

class ContactController extends Controller
{
    public function list_nut(){
        $icons = Icons::where('category','icons')->orderBy('id_icons','DESC')->get();
        $output = '';
        $output .= '<table class="table table-bordered">
        <thead>
          <tr>
            <th>Tên icons</th>
            <th>Hình ảnh</th>
            <th>Link</th>
            <th>Quản lý</th>
          </tr>
        </thead>
        <tbody>';
        foreach($icons as $ico){
            $output .= '<tr>
                <td>'.$ico->name.'</td>
                <td><img src="'.url('public/uploads/icons/'.$ico->image).'" height="32px" width="32px" alt=""></td>
                <td>'.$ico->link.'</td>
                <td>
                    <button id="'.$ico->id_icons.'" class="btn btn-danger" onclick="delete_icons(this.id)">Xóa</button>
                </td>
            </tr>';
        }
      $output .= '</tbody>
      </table>';
      echo $output;
    }

    public function delete_icons(){
        $id = $_GET['id'];
        $icons = Icons::find($id);
        $icons->delete();
    }

    public function add_nut(Request $request){

        $data = $request->all();
        $icons = new Icons();

        $name = $data['name'];
        $link = $data['link'];
        $get_image = $request->file('file');

        $path = 'public/uploads/icons/';

        if($get_image) {
            $get_name_image = $get_image->getClientOriginalExtension();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.Str::random(5).'.'.$get_image->getClientOriginalExtension();
            $get_image->move($path,$new_image);
            $icons->image = $new_image;
           
        }
        $icons->name = $name;
        $icons->link = $link;
        $icons->category = 'icons';
        $icons->save();
    }

    public function add_doitac(Request $request){
        $data = $request->all();
        $icons = new Icons();

        $name = $data['name'];
        $link = $data['link'];
        $get_image = $request->file('file');

        $path = 'public/uploads/icons/';

        if($get_image) {
            $get_name_image = $get_image->getClientOriginalExtension();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.Str::random(5).'.'.$get_image->getClientOriginalExtension();
            $get_image->move($path,$new_image);
            $icons->image = $new_image;
           
        }
        $icons->name = $name;
        $icons->link = $link;
        $icons->category = 'doitac';
        $icons->save();
    }

    public function list_doitac(){
        $icons = Icons::where('category','doitac')->orderBy('id_icons','DESC')->get();
        $output = '';
        $output .= '<table class="table table-bordered">
        <thead>
          <tr>
            <th>Tên đối tác</th>
            <th>Hình ảnh đối tác</th>
            <th>Link đối tác</th>
            <th>Quản lý</th>
          </tr>
        </thead>
        <tbody>';
        foreach($icons as $ico){
            $output .= '<tr>
                <td>'.$ico->name.'</td>
                <td><img src="'.url('public/uploads/icons/'.$ico->image).'" height="90px" width="150px" alt=""></td>
                <td>'.$ico->link.'</td>
                <td>
                    <button id="'.$ico->id_icons.'" class="btn btn-warning" onclick="delete_icons(this.id)">Xóa đối tác</button>
                </td>
            </tr>';
        }
      $output .= '</tbody>
      </table>';
      echo $output;
    }

   

    public function lien_he(Request $request){
        //Category post
        $category_post =  CatePost::orderBy('cate_post_id','DESC')->get();

        //Slider
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','1')->take(4)->get();

        //seo
        $meta_desc = "Trang liên hệ đến chúng tối";
        $meta_keywords = "The contacts";
        $meta_title = "Liên hệ | Eshop";
        $url_canonical = $request->url();

        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
        $contact = Contact::where('info_id',1)->get();

        return view('pages.lienhe.contact')->with('category',$cate_product)->with('brand',$brand_product)->with('meta_desc',$meta_desc)
        ->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)
        ->with('slider',$slider)->with('category_post',$category_post)->with('contact',$contact);
    }

    public function information(){
        $contact = Contact::where('info_id',1)->get();
        return view('admin.information.add_information')->with(compact('contact'));
    }

    public function save_info(Request $request) {
        $data = $request->all();
        $contact = new Contact();
        $contact->info_contact = $data['info_contact'];
        $contact->info_map = $data['info_map'];
        $contact->info_fanpage = $data['info_fanpage'];

        $get_image = $request->file('info_logo');
        $path = 'public/uploads/contact/';
        if($get_image) {
            $get_name_image = $get_image->getClientOriginalExtension();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.Str::random(10).'.'.$get_image->getClientOriginalExtension();
            $get_image->move($path,$new_image);
            $contact->info_logo = $new_image;
        }
        $contact->save();
        return redirect()->back()->with('message','Thêm thông tin thành công');
    }

    public function update_info(Request $request, $info_id){
        $data = $request->all();
        $contact = Contact::find($info_id);
        $contact->info_contact = $data['info_contact'];
        $contact->info_map = $data['info_map'];
        $contact->info_fanpage = $data['info_fanpage'];
        $contact->slogan_logo = $data['slogan_logo'];
        $get_image = $request->file('info_logo');
        $path = 'public/uploads/contact/';
        if($get_image) {
            unlink($path.$contact->info_logo);
            $get_name_image = $get_image->getClientOriginalExtension();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.Str::random(10).'.'.$get_image->getClientOriginalExtension();
            $get_image->move($path,$new_image);
            $contact->info_logo = $new_image;
        }
        $contact->save();
        return redirect()->back()->with('message','Cập nhập thông tin thành công');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use App\Models\Slider;
use App\Models\Product;
use App\Http\Requests;
use App\Imports\ImportProduct;
use App\Models\Post;
use App\Models\CatePost;
use Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Redirect;

session_start();

class PostController extends Controller
{
    public function AuthLogin() {
        $admin_id = Auth::id();
        if($admin_id) {
            return Redirect::to('dashboard');
        } else {
            return Redirect::to('admin')->send();
        }
    }

    public function add_post(){
        $this->AuthLogin();
        $cate_post = CatePost::orderBy('cate_post_id','DESC')->get();
       
        return view('admin.post.add_post')->with(compact('cate_post'));
    }



    public function save_post(Request $request) {
        $this->AuthLogin();
        $data = $request->all();
        $post = new Post();

        $post->post_title = $data['post_title'];
        $post->post_slug = $data['post_slug'];
        $post->post_desc = $data['post_desc'];
        $post->post_content = $data['post_content'];
        $post->post_meta_keywords = $data['post_meta_keywords'];
        $post->post_meta_desc = $data['post_meta_desc'];
        $post->cate_post_id = $data['cate_post_id'];
        $post->post_status = $data['post_status'];

        $get_image = $request->file('post_image');
        if($get_image) {
            $get_name_image = $get_image->getClientOriginalExtension();
            $name_image = current(explode('.',$get_name_image));

            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();

            $get_image->move('public/uploads/post',$new_image);

            $post->post_image = $new_image;

            $post->save();
            Session::put('message','Thêm bài viết thành công');
            return redirect()->back();
        }else {
            Session::put('message','Làm ơn hãy thêm hình ảnh');
            return redirect()->back();
        }

        $data['product_image'] = '';
        DB::table('tbl_product')->insert($data);
        Session::put('message','Thêm sản phẩm thành công');
        return Redirect::to('all-product');
    }

    public function all_post() {
        $this->AuthLogin();
        $all_post = Post::with('cate_post')->orderBy('post_id','DESC')->get();
        // $list_post = Post::orderBy('post_id')->paginate(10);

        return view('admin.post.list_post')->with(compact('all_post'));
    }

    public function delete_post($post_id){
        $this->AuthLogin();
        $post = Post::find($post_id);
        $post_image = $post->post_image;
        
        if($post_image){
            $path = 'public/uploads/post/'.$post_image;
            unlink($path);
        }
        $post->delete();
        Session::put('message','Xóa bài viết thành công');
        return redirect()->back();
    }

    public function edit_post($post_id){
        //$this->AuthLogin();
        $edit_post = DB::table('tbl_posts')->where('post_id',$post_id)->get();
        $post=Post::find($post_id);
        $category_post = DB::table('tbl_category_post')->orderby('cate_post_id','desc')->get();
        $manager_post = view('admin.post.edit_post')->with('edit_post', $edit_post)->with('category_post',$category_post);
        return view('admin_layout')->with('admin.post.edit_post', $manager_post)->with('post',$post);
    }

    public function update_post(Request $request, $post_id) {
        //$this->AuthLogin();
        $data = array();
        $post = Post::find($post_id);

        $data['post_title'] = $request->post_title;
        $data['post_slug'] = $request->post_slug;
        $data['post_desc'] = $request->post_desc;
        $data['post_content'] = $request->post_content;
        $data['post_meta_keywords'] = $request->post_meta_keywords;
        $data['post_meta_desc'] = $request->post_meta_desc; 
        $data['post_status'] = $request->post_status;
        // $post->post_title = $data['post_title']; 
        // $post->post_slug = $data['post_slug']; 
        // $post->post_desc = $data['post_desc'];
        // $post->post_content = $data['post_content']; 
        // $post->post_meta_keywords = $data['post_meta_keywords']; 
        // $post->post_meta_desc = $data['post_meta_desc'];
        // $post->post_status = $data['post_status'];

        $get_image = $request->file('post_image');
        if($get_image) {
            $post_image_old = $post->post_image;
            $path = 'public/uploads/post/'.$post_image_old;
            unlink($path);

            $get_name_image = $get_image->getClientOriginalExtension();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/post',$new_image);
            $data['post_image'] = $new_image;
            DB::table('tbl_post')->where('post_id',$post_id)->update($data);
            Session::put('message','Cập nhập bài thành công');
            return redirect('/all-post');
        }
        DB::table('tbl_posts')->where('post_id',$post_id)->update($data);
        Session::put('message','Cập nhập bài viết thành công');
        return redirect('/all-post');
    }

    public function danh_muc_bai_viet(Request $request, $post_slug){
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','1')->take(4)->get();
        //Category post
        $category_post =  CatePost::orderBy('cate_post_id','DESC')->get();

         //Category product
        $category = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();

         //Brand product
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
   
        $catepost= CatePost::where('cate_post_slug',$post_slug)->get();

        foreach($catepost as $key => $cate) {
            $meta_desc = $cate->cate_post_desc;
            $meta_keywords =$cate->cate_post_slug;
            $meta_title = $cate->cate_post_name;
            $cate_id = $cate->cate_post_id;
            $url_canonical = $request->url();
        }

        $post = Post::with('cate_post')->where('post_status',1)->where('cate_post_id',$cate_id)->paginate(3);

        return view('pages.baiviet.danhmucbaiviet')->with('category_post',$category_post)->with('category',$category)->with('brand',$brand_product)
        ->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)
        ->with('url_canonical',$url_canonical)->with('slider',$slider)->with('post',$post);
    }

    public function bai_viet(Request $request, $post_slug) {
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','1')->take(4)->get();
        //Category post
        $category_post =  CatePost::orderBy('cate_post_id','DESC')->get();

        //Category product
        $category = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        //Brand product
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();

        //POST
        $post_by_id = Post::with('cate_post')->where('post_status',1)->where('post_slug',$post_slug)->take(1)->get();
        foreach($post_by_id as $key => $value) {
            $meta_desc = $value->post_meta_desc;
            $meta_keywords =$value->post_meta_keywords;
            $meta_title = $value->post_title;
            $cate_id = $value->cate_post_id;
            $cate_post_id = $value->cate_post_id;
            $url_canonical = $request->url();
            $post_id = $value->post_id;
        }
        
        //Update post views
        $posts=  Post::with('cate_post')->where('post_status',1)->where('post_slug',$post_slug)->first();
        $posts->post_views = $posts->post_views + 1;
        $posts->save();

        //Related post
        $related = Post::with('cate_post')->where('post_status',1)->where('cate_post_id',$cate_post_id)
        ->whereNotIn('post_slug',[$post_slug])->take(5)->get();

        return view('pages.baiviet.baiviet')->with('category_post',$category_post)->with('category',$category)->with('brand',$brand_product)
        ->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('post_by_id',$post_by_id)
        ->with('url_canonical',$url_canonical)->with('slider',$slider)->with('posts',$posts)->with('related',$related);
    }

}

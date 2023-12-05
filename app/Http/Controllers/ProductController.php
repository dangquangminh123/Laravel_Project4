<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Session;
use App\Models\Slider;
use App\Models\Product;
use App\Http\Requests;
use App\Imports\ImportProduct;
use App\Models\Gallery;
use App\Models\Rating;
use App\Models\Comment;
use Auth;
use File;
use App\Models\CatePost;

use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Redirect;
session_start();
class ProductController extends Controller
{
    public function AuthLogin() {
        $admin_id = Auth::id();
        if($admin_id) {
            return Redirect::to('dashboard');
        } else {
            return Redirect::to('admin')->send();
        }
    }

    public function file_browser(Request $request) {
        $path = glob(public_path('uploads/ckeditor/*'));
        $fileNames = array();
        foreach($paths as $path) {
            array_push($fileNames,basename($path));
        }
        $data = array(
            'fileNames' => $fileName
        );
        return view('admin.images.file_browser')->with($data);
    }

    public function add_product(){
        $this->AuthLogin();
        $cate_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->orderby('brand_id','desc')->get();
        return view('admin.add_product')->with('cate_product', $cate_product)->with('brand_product', $brand_product);
    }

    public function all_product() {
        //$this->AuthLogin();
        // $product_all = DB::table('tbl_product')->paginate(10);
        $product_all = DB::table('tbl_product')->get();
        $all_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->orderby('tbl_product.product_id','desc')->get();
        $manager_product = view('admin.all_product')->with('all_product',$all_product);
        return view('admin_layout')->with('admin.all_product', $manager_product)->with('product_all',$product_all);
    }

    public function save_product(Request $request) {
        $this->AuthLogin();

        // $data = array();
        $data = $request->validate([
            'product_name' => 'required|unique:tbl_product|max:200',
            'price_cost' => 'required|numeric|min:1|max:20',
            'product_tags' => 'required',
            'product_quantity' => 'required|numeric|min:1|max:20',
            'product_slug' => 'required',
            'product_price' => 'required|numeric|min:1|max:20',
            'product_desc' => 'required',
            'product_content' => 'required',
            'category_id' => 'required',
            'brand_id' => 'required',
            'product_status' => 'required',
            'product_image' => 'required|image|mines:jpeg,png,jpg,svgmax:2048|dimensions:min_width=100,min_height=100,
            max_width=2000,max_height=2000',
        ],

        [
            'product_name.required' => 'Tên sản phẩm không được trống',
            'product_name.unique' => 'Tên sản phẩm này đã tồn tại vui lòng thay đổi tên mới',
            'price_cost.required' => 'Giá gốc của sản phẩm được trống',
            'product_tags.required' => 'Yêu cầu nhập tags sản phẩm không được trống',
            'product_quantity.required' => 'Số lượng sản phẩm không được trống',
            'product_slug.required' => 'Slug sản phẩm không được trống',
            'product_desc.required' => 'Mô tả sản phẩm không được trống',
            'product_content.required' => 'Nội dung sản phẩm không được trống',
            'category_id.required' => 'Danh mục sản phẩm không được trống',
            'brand_id.required' => 'Thương hiệu sản phẩm không được trống',
            'product_status.required' => 'Trạng thái sản phẩm không được trống',
            'product_image.required' => 'Hình ảnh sản phẩm yêu cầu cần phải có',
            'product_price.required' => 'Giá sản phẩm yêu cầu là kiểu số',
        ]
    );

        $product_price = filter_var($request->product_price, FILTER_SANITIZE_NUMBER_INT);
        $price_cost = filter_var($request->price_cost, FILTER_SANITIZE_NUMBER_INT);

        $data['product_name'] = $request->product_name;
        $data['product_tags'] = $request->product_tags;
        $data['product_quantity'] = $request->product_quantity;
        $data['product_price'] = $product_price;
        $data['price_cost'] = $price_cost;
        $data['product_desc'] = $request->product_desc;
        $data['product_sold'] = 0;
        $data['product_slug'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->product_cate; 
        $data['brand_id'] = $request->product_brand;
        $data['product_status'] = $request->product_status;
        $get_image = $request->file('product_image');
        $get_document = $request->file('document');

        $path = 'public/uploads/product/';
        $path_gallery = 'public/uploads/gallery/';
        $path_document = 'public/uploads/document/';

        if($get_image) {
            $get_name_image = $get_image->getClientOriginalExtension();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.Str::random(10).'.'.$get_image->getClientOriginalExtension();
            $get_image->move($path,$new_image);
            File::copy($path.$new_image,$path_gallery.$new_image);
            $data['product_image'] = $new_image;
        }

        if($get_document) {
            $get_name_document = $get_document->getClientOriginalExtension();
            $name_document = current(explode('.',$get_name_document));
            $new_document = $name_document.Str::random(10).'.'.$get_document->getClientOriginalExtension();
            $get_document->move($path_document,$new_document);
            $data['product_file'] = $new_document;
        }

        $pro_id = DB::table('tbl_product')->insertGetId($data);
        $gallery = new Gallery();
        $gallery->gallery_image = $new_image;
        $gallery->gallery_name = $new_image;
        $gallery->product_id = $pro_id;
        $gallery->save();

        Session::put('message','Thêm sản phẩm thành công');
        return Redirect::to('all-product');
    }

    public function unactive_product($product_id) {
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=>0]);
        Session::put('message','Tắt sản phẩm thành công');
        return Redirect::to('all-product');
    }

    public function active_product($product_id) {
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=>1]);
        Session::put('message','Kích hoạt sản phẩm thành công');
        return Redirect::to('all-product');
    }

    public function edit_product($product_id) {
        //$this->AuthLogin();
        $cate_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->orderby('brand_id','desc')->get();
        $edit_product = DB::table('tbl_product')->where('product_id',$product_id)->get();
      
        $manager_product = view('admin.edit_product')->with('edit_product', $edit_product)->with('cate_product',$cate_product)
        ->with('brand_product',$brand_product);

        return view('admin_layout')->with('admin.edit_product', $manager_product);
    }

    public function update_product(Request $request, $product_id) {
        //$this->AuthLogin();
        $data = array();
        $product_price = filter_var($request->product_price, FILTER_SANITIZE_NUMBER_INT);
        $price_cost = filter_var($request->price_cost, FILTER_SANITIZE_NUMBER_INT);

        $data['product_name'] = $request->product_name;
        $data['product_tags'] = $request->product_tags;
        $data['product_quantity'] = $request->product_quantity;
        $data['product_price'] =  $product_price;
        $data['price_cost'] = $price_cost;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->product_cate; 
        $data['brand_id'] = $request->product_brand;
        $data['product_status'] = $request->product_status;

        $get_document = $request->file('document');
        $get_image = $request->file('product_image');
        $path_document = 'public/uploads/document/';

        //Images
        if($get_image) {
            $get_name_image = $get_image->getClientOriginalExtension();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.Str::random(10).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/product',$new_image);
            $data['product_image'] = $new_image;
            DB::table('tbl_product')->where('product_id',$product_id)->update($data);
            Session::put('message','Cập nhập sản phẩm thành công');
            return Redirect::to('all-product');
        }

        //Document
        if($get_document) {
            $get_name_document = $get_document->getClientOriginalExtension();
            $name_document = current(explode('.',$get_name_document));
            $new_document = $name_document.Str::random(10).'.'.$get_document->getClientOriginalExtension();
            $get_image->move($path_document,$new_document);
            $data['product_file'] = $new_document;
             //Lấy file old document và xóa old document 
            $product = Product::find($product_id);
            if($product->product_file){
                unlink($path_document.$product->product_file);
            }
        }

        DB::table('tbl_product')->where('product_id',$product_id)->update($data);
        
        Session::put('message','Cập nhập sản phẩm thành công');
        return Redirect::to('all-product');
    }

    public function delete_document(Request $request){
        $path_document = 'public/uploads/document/';
        $product = Product::find($request->product_id);
        unlink($path_document.$product->product_file);
        $product->product_file = '';
        $product->save();
    }

    public function delete_product($product_id) {
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id',$product_id)->delete();
        Session::put('message','Xóa sản phẩm thành công');
        return Redirect::to('all-product');
    }
    //End admin

    public function details_product(Request $request, $product_id) {
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','1')->take(4)->get();
        $category_post =  CatePost::orderBy('cate_post_id','DESC')->get();

        //gallery

        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
        $details_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->where('tbl_product.product_id',$product_id)->get();

        foreach($details_product as $key => $value){
            $category_id = $value->category_id;
            $product_id = $value->product_id;
            $product_cate = $value->category_name;
            $cate_slug = $value->slug_category_product;
            //Seo
            $meta_desc = $value->product_desc;
            $meta_keywords = $value->product_id;
            $meta_title = $value->product_name;
            $url_canonical = $request->url();
           //
        }
        //Gallery
        $gallery = Gallery::where('product_id',$product_id)->get();

        //update views
        $product = Product::where('product_id',$product_id)->first();
        $product->product_views = $product->product_views + 1;
        $product->save();

        //Rating
        $rating = Rating::where('product_id',$product_id)->avg('rating');
        $rating = round($rating);

        $related_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->where('tbl_category_product.category_id',$category_id)->whereNotIn('tbl_product.product_id',[$product_id])->get();
        return view('pages.sanpham.show_details')->with('category',$cate_product)->with('brand',$brand_product)
        ->with('product_details',$details_product)->with('relate',$related_product)->with('meta_desc',$meta_desc)
        ->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)
        ->with('category_post',$category_post)->with('slider',$slider)->with('gallery',$gallery)
        ->with('product_cate',$product_cate)->with('cate_slug',$cate_slug)->with('rating',$rating);
    }

    public function tag($product_tag, Request $request){
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','1')->take(4)->get();
        $category_post =  CatePost::orderBy('cate_post_id','DESC')->get();
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
        
        $tag = str_replace("-","-",$product_tag);
        $pro_tag = Product::where('product_status',1)->where('product_name','LIKE','%'.$tag.'%')
        ->orWhere('product_tags','LIKE','%'.$tag.'%')->orWhere('product_slug','LIKE','%'.$tag.'%')->get();

        $meta_desc = 'Tag:'.$product_tag;
        $meta_keywords = 'Tags tìm kiếm:'.$product_tag;
        $meta_title = 'Tags:'.$product_tag;
        $url_canonical = $request->url();
        return view('pages.sanpham.tag')->with('category',$cate_product)->with('brand',$brand_product)
        ->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)
        ->with('category_post',$category_post)->with('slider',$slider)->with('product_tag',$product_tag)->with('pro_tag',$pro_tag);
    }

    // Comment
    public function list_comment(){
        $comment = Comment::with('product')->where('comment_parent_comment','=',0)->orderBy('comment_id','DESC')->get();
        $comment_rep = Comment::with('product')->where('comment_parent_comment','>',0)->get();
        return view('admin.comment.list_comment')->with(compact('comment','comment_rep'));
    }

    public function allow_comment(Request $request) {
        $data = $request->all();
        $comment = Comment::find($data['comment_id']);
        $comment->comment_status = $data['comment_status'];
        $comment->save();
    }

    public function reply_comment(Request $request){
        $data = $request->all();
        $comment = new Comment();
        $comment->comment = $data['comment'];
        $comment->comment_product_id = $data['comment_product_id'];
        $comment->comment_parent_comment = $data['comment_id'];
        $comment->comment_status = 1;
        $comment->comment_name = 'Vũ Admin';
        $comment->save();
    }

    public function load_comment(Request $request){
        $product_id = $request->product_id;
        $comment = Comment::where('comment_product_id',$product_id)->where('comment_status',1)
        ->where('comment_parent_comment','=',0)->get();
        $comment_rep = Comment::with('product')->where('comment_parent_comment','>',0)->get();
        $output = '';
        foreach($comment as $key => $comm){
                $output .= '
                <div class="row style_comment">
                    <div class="col-md-2">
                        <img width="100%" src="'.url('/public/frontend/images/kiemthu.jpg').'" class="img img-responsive img-thumbnail" />
                    </div>
                    <div class="col-md-10">
                        <p style="color: green">'.$comm->comment_name.'</p>
                        <p style="color: #000">@'.$comm->comment_date.'</p>
                        <p>'.$comm->comment.'</p>
                    </div>
                </div><p></p>';
        
            foreach($comment_rep as $key => $rep_comment) {
                if($rep_comment->comment_parent_comment==$comm->comment_id) {
                $output .= '    
                <div class="row style_comment" style="margin:5px 40px">
                    <div class="col-md-2">
                        <img width="80%" src="'.url('/public/frontend/images/thai2.jpg').'" class="img img-responsive img-thumbnail" />
                    </div>
                    <div class="col-md-10">
                        <p style="color: red">@Thằn admin thái</p>
                        <p style="color: #000">'.$rep_comment->comment.'</p>
                        <p></p>
                    </div>
                </div><p></p>';
                }
            }
        }
        echo $output;
    }

    public function send_comment(Request $request){
        $product_id = $request->product_id;
        $comment_name= $request->comment_name;
        $comment_content= $request->comment_content;
        $comment = new Comment();
        $comment->comment = $comment_content;
        $comment->comment_name = $comment_name;
        $comment->comment_product_id = $product_id;
        $comment->comment_status = 0;
        $comment->comment_parent_comment = 0;
        $comment->save();
    }

    // Rating
    public function insert_rating(Request $request) {
        $data = $request->all();
        $rating = new Rating();
        $rating->product_id = $data['product_id'];
        $rating->rating = $data['index'];
        $rating->save();
        echo 'xong';
    }

    public function quickview(Request $request) {
        $product_id = $request->product_id;
        $product = Product::find($product_id);
        $gallery = Gallery::where('product_id',$product_id)->get();
        $output['product_gallery'] = '';
        foreach($gallery as $key => $gal){
            $output['product_gallery'].='<p><img width="100%" src="public/uploads/gallery/'.$gal->gallery_image.'"></p>';
        }
        $output['product_name'] = $product->product_name;
        $output['product_id'] = $product->product_id;
        $output['product_desc'] = $product->product_desc;
        $output['product_content'] = $product->product_content;
        $output['product_price'] = number_format($product->product_price,0,',','.').'$';
        $output['product_image'] = '<p><img width="100%" src="public/uploads/product/'.$gal->product_image.'"></p>';

        $output['product_button'] = '<input type="button" value="Mua ngay" class="btn btn-primary btn-sm add-to-cart-quickview" 
        data-id_product="'.$product->product_id.'" name="add-to-cart" id="buy_quickview" />';
        $output['product_quickview_value'] = '
        <input type="hidden" value="'.$product->product_id.'" class="cart_product_id_'.$product->product_id.'">
		<input type="hidden" value="'.$product->product_name.'" class="cart_product_name_'.$product->product_id.'">
		<input type="hidden" value="'.$product->product_quantity.'" class="cart_product_quantity_'.$product->product_id.'">
		<input type="hidden" value="'.$product->product_image.'" class="cart_product_image_'.$product->product_id.'">
		<input type="hidden" value="'.$product->product_price.'" class="cart_product_price_'.$product->product_id.'">
		<input type="hidden" value="1" class="cart_product_qty_'.$product->product_id.'">
        ';
        echo json_encode($output);
    }

    public function ckeditor_image(Request $request) {
        if($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName.'_'.time().'.'.$extension;
            $request->file('upload')->move('public/uploads/ckeditor',$fileName);
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');

            $url = asset('public/uploads/ckeditor/'.$fileName);
            $msg = 'Tải ảnh thành công';
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
            @header('Content-type: text/html; charset=utf-8');
            echo $response;
        }
    }

    public function export_product(){
        return Excel::download(new ExcelExports , 'category_product.xlsx');
    }

    public function import_product(Request $request){
        $path = $request->file('file')->getRealPath();
        Excel::import(new ImportProduct, $path);
        return back();
    }
}

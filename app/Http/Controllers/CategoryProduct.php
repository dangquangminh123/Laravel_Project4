<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use App\Http\Requests;
use App\Imports\ExcelImports;
use App\Exports\ExcelExports;
use App\Models\CategoryProductModel;
use App\Models\CatePost;
use App\Models\Product;

use App\Models\Slider;
use App\Models\Icons;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Redirect;
use Auth;

class CategoryProduct extends Controller
{

    public function AuthLogin() {
        $admin_id = Auth::id();
        if($admin_id) {
            return Redirect::to('dashboard');
        } else {
            return Redirect::to('admin')->send();
        }
    }

    public function add_category_product(){
        $this->AuthLogin();
      $category = $this->getCategoriesProduct();
        return view('admin.add_category_product')->with(compact('category'));
    }

    public function getCategoriesProduct(){
        $categories=CategoryProductModel::where('category_status',1)->orderBy('category_id','DESC')->get();
        $listCategory = [];
        CategoryProductModel::recursive($categories, $parents = 0, $level = 1, $listCategory);
        return $listCategory;
    }

    public function all_category_product() {
        $this->AuthLogin();
        $category_product=CategoryProductModel::where('category_parent',0)->orderBy('category_id','DESC')->get();
        $all_category_product = DB::table('tbl_category_product')->orderBy('category_parent','DESC')
        ->orderBy('category_order','ASC')->get();
        $manager_category_product = view('admin.all_category_product')->with('all_category_product',$all_category_product)
        ->with('category_product',$category_product);
        return view('admin_layout')->with('admin.all_category_product', $manager_category_product);
    }

    public function save_category_product(Request $request) {
        $this->AuthLogin();
        $data = array();
        $data['category_name'] = $request->category_product_name;
        $data['category_parent'] = $request->category_parent;
        $data['category_desc'] = $request->category_product_desc;
        $data['meta_keywords'] = $request->category_product_keywords;
        $data['slug_category_product'] = \Str::slug($request->category_product_name).'-'.\Carbon\Carbon::now()->timestamp;
        $data['category_status'] = $request->category_product_status;
        $all_category = DB::table('tbl_category_product')->orderBy('category_parent','DESC')
        ->orderBy('category_order','ASC')->get();
        $category_count = $all_category->count();
        $data['category_order'] = $category_count++;
        DB::table('tbl_category_product')->insert($data);
        Session::put('message','Thêm danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');
    }

    public function unactive_category_product($category_product_id) {
        $this->AuthLogin();
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update(['category_status'=>0]);
        Session::put('message','Tắt danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');
    }

    public function active_category_product($category_product_id) {
        $this->AuthLogin();
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update(['category_status'=>1]);
        Session::put('message','Kích hoạt danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');
    }

    public function edit_category_product($category_product_id) {
        $this->AuthLogin();
        $category = $this->getCategoriesProduct();
        $edit_category_product = DB::table('tbl_category_product')->where('category_id',$category_product_id)->get();
        $manager_category_product = view('admin.edit_category_product')->with('edit_category_product', $edit_category_product)
        ->with('category',$category);
        return view('admin_layout')->with('admin.edit_category_product', $manager_category_product);
    }

    public function update_category_product(Request $request, $category_product_id) {
        $this->AuthLogin();
        $data = array();
        $data['category_name'] = $request->category_product_name;
        $data['meta_keywords'] = $request->category_product_keywords;
        $data['slug_category_product'] = \Str::slug($request->category_product_name);
        $data['category_desc'] = $request->category_product_desc;
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update($data);
        Session::put('message','Cập nhật danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');
    }

    public function delete_category_product($category_product_id) {
        $this->AuthLogin();
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->delete();
        Session::put('message','Xóa danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');
    }

    public function product_tabs(Request $request){
        $data = $request->all();
        $output = '';

        $subcategory = CategoryProductModel::where('category_parent',$data['cate_id'])->get();
        $sub_array = array();
        foreach($subcategory as $key => $sub){
            $sub_array[] = $sub->category_id;
        }
        array_push($sub_array, $data['cate_id']);

        $product = Product::whereIn('category_id', $sub_array)->orderBy('product_id','DESC')->get();

        $product_count = $product->count();
        if($product_count>0){
            $output .= '<div class="tab-content">;    
                <div class="tab-pane fade active in" id="t-shirt">';
                foreach($product as $key => $pro){
                $output.='
                <input type="hidden" value="'.$pro->product_id.'" class="cart_product_id_'.$pro->product_id.'">
				<input type="hidden" id="wishlist_productname'.$pro->product_id.'" value="'.$pro->product_name.'" class="cart_product_name_'.$pro->product_id.'">
				<input type="hidden" value="'.$pro->product_quantity.'" class="cart_product_quantity_'.$pro->product_id.'">
				<input type="hidden" value="'.$pro->product_image.'" class="cart_product_image_'.$pro->product_id.'">


				<input type="hidden" id="wishlist_productprice'.$pro->product_id.'" value="'.number_format($pro->product_price,0,',','.').'$">

                <input type="hidden" class="cart_product_price_'.$pro->product_id.'" value="'.$pro->product_price.'" />


				<input type="hidden" value="1" class="cart_product_qty_'.$pro->product_id.'">
				<a id="wishlist_producturl'.$pro->product_id.'" href="'.url('/chi-tiet-san-pham/'.$pro->product_id).'">
                
                <a href="'.url('/chi-tiet-san-pham/'.$pro->product_slug).'"><div class="col-sm-3">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="'.url('public/uploads/product/'.$pro->product_image).'" alt="'.$pro->product_name.'" />
                                    <h2>'.number_format($pro->product_price,0,',','.').'</h2>
                                    <p>'.$pro->product_name.'</p>
                                        </a>
                                   <button class="btn btn-default" id="'.$pro->product_id.'" onclick="Addtocart(this.id);"> <i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</button>
                                </div>

                            </div>
                        </div>';
                $output.=' </div>
                    </div>';
                }
        }else {
            $output .= '<div class="tab-content">
                         <div class="tab-pane fade active in" id="t-shirt">
                            <div class="col-sm-12">
                               <p style="color: red; text-align:center">Hiện chưa có sản phẩm thuộc danh mục này</p>
                            </div>
                        </div>
                </div>';
        };
        echo $output;
    }

    //End admin function

    public function show_category_home(Request $request, $slug_category_product) {
        // $all_slide = Slider::orderBy('slider_id','DESC')->get();
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','1')->take(4)->get();
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->where('slug_category_product',$slug_category_product)->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
        $category_post =  CatePost::orderBy('cate_post_id','DESC')->get();
        $icons = Icons::orderBy('id_icons','DESC')->get();
        $category_by_slug = CategoryProductModel::where('slug_category_product',$slug_category_product)->get();

        $max_price = Product::max('product_price');
            $min_price = Product::min('product_price');
            $min_price_range = $min_price + 50;
            $max_price_range = $max_price + 100;
        foreach($category_by_slug as $key => $cate){
            $category_id = $cate->category_id;
        }
        // $category_by_id = DB::table('tbl_product')
        // ->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')
        // ->where('tbl_category_product.slug_category_product',$slug_category_product)->get();
        $category_name = DB::table('tbl_category_product')->where('tbl_category_product.slug_category_product',$slug_category_product)->limit(1)->get();
        $category_product=CategoryProductModel::where('category_parent',0)->orderBy('category_id','DESC')->get();
        $all_category_product = DB::table('tbl_category_product')->orderBy('category_parent','DESC')
        ->orderBy('category_order','ASC')->get();
        $manager_category_product = view('admin.all_category_product')->with('all_category_product',$all_category_product)
        ->with('category_product',$category_product);
       
        if(isset($_GET['sort_by'])){
            $sort_by = $_GET['sort_by'];
            if($sort_by=='giam_dan'){
                $category_by_id = Product::with('category')->where('category_id',$category_id)->orderBy('product_price','DESC')->paginate(6)->appends(request()->query());
            }elseif($sort_by=='tang_dan'){
                $category_by_id = Product::with('category')->where('category_id',$category_id)->orderBy('product_price','ASC')->paginate(6)->appends(request()->query());
            }elseif($sort_by=='kytu_az'){
                $category_by_id = Product::with('category')->where('category_id',$category_id)->orderBy('product_name','ASC')->paginate(6)->appends(request()->query());
            }elseif($sort_by=='kytu_za'){
                $category_by_id = Product::with('category')->where('category_id',$category_id)->orderBy('product_name','DESC')->paginate(6)->appends(request()->query());
            }
            elseif(isset($_GET['start_price']) && $_GET['end_price']){
                $min_price = $_GET['start_price'];
                $max_price = $_GET['end_price'];
                $category_by_id = Product::with('category')->whereBetween('product_price',[$min_price,$max_price])->orderBy('product_price','ASC')->paginate(6);
            }
            elseif(isset($_GET['cate'])){
                $category_filter = $_GET['cate'];
                $category_arr = explode(",",$category_filter);
                $category_by_id = Product::with('category')->whereIn('category_id',$category_arr)->orderBy('product_price','DESC')->paginate(6)
                ->appends(request()->query());
            }
        }else{
            $category_by_id = Product::with('category')->where('category_id',$category_id)->orderBy('product_id','DESC')->paginate(6);
        }

        foreach($cate_product as $key => $val) {
            $meta_desc = $val->category_desc;
            $meta_keywords = $val->meta_keywords;
            $meta_title =  $val->category_name;
            $url_canonical = $request->url();
        }
        return view('pages.category.show_category')->with('category',$all_category_product)->with('brand',$brand_product)
        ->with('category_by_id',$category_by_id)->with('category_name',$category_name)->with('meta_desc',$meta_desc)
        ->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)
        ->with('slider',$slider)->with('category_post',$category_post)->with('icons',$icons)->with('min_price',$min_price)
            ->with('max_price',$max_price)->with('max_price_range',$max_price_range)->with('min_price_range',$min_price_range);
    }

    public function arrange_category(Request $request){
        $this->AuthLogin();
        $data = $request->all();
        $cate_id = $data["page_id_array"];
        foreach($cate_id as $key => $value){
            $category = CategoryProductModel::find($value);
            $category->category_order = $key;
            $category->save();
        }
        echo "Updated";
    }

    public function export_csv(){
        return Excel::download(new ExcelExports , 'category_product.xlsx');
    }

    public function import_csv(Request $request){
        $path = $request->file('file')->getRealPath();
        Excel::import(new ExcelImports, $path);
        return back();
    }
}

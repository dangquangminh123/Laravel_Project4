<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use App\Http\Requests;
use Mail;
use App\Models\Slider;
use App\Models\Icons;
use App\Models\Gallery;
use App\Models\CatePost;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Rating;
use App\Models\CategoryProductModel;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Redirect;

class SlugController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug, Request $request)
    {
        $category_post =  CatePost::orderBy('cate_post_id','DESC')->get();
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','1')->take(4)->get();
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
        $all_slide = Slider::orderBy('slider_id','DESC')->get();

        $icons = Icons::orderBy('id_icons','DESC')->get();
        $category = CategoryProductModel::where('slug_category_product',$slug)->first();
        $brand = Brand::where('brand_slug',$slug)->first();
        $product = Product::where('product_slug',$slug)->first();

        if($category){
            $category_name = DB::table('tbl_category_product')->
            where('tbl_category_product.slug_category_product',$slug)->limit(1)->get();
            $category_by_id = Product::with('category')->where('category_id',$category->category_id)->orderBy('product_id','DESC')->paginate(6);

            $max_price = Product::max('product_price');
            $min_price = Product::min('product_price');
            $min_price_range = $min_price + 50;
            $max_price_range = $max_price + 100;

            $category_id = $category->category_id;

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
            else{
                $category_by_id = Product::with('category')->where('category_id',$category_id)->orderBy('product_id','DESC')->paginate(6);
            }

            $meta_desc = $category->category_desc;
            
            $meta_keywords = $category->meta_keywords;
            
            $meta_title =  $category->category_name;
            
            $url_canonical = $request->url();

            return view('pages.category.show_category')->with('category',$cate_product)->with('brand',$brand_product)
            ->with('category_by_id',$category_by_id)->with('category_name',$category_name)->with('meta_desc',$meta_desc)
            ->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)
            ->with('slider',$slider)->with('category_post',$category_post)->with('icons',$icons)->with('min_price',$min_price)
            ->with('max_price',$max_price)->with('max_price_range',$max_price_range)->with('min_price_range',$min_price_range);
        }elseif($brand){
            $brand_by_id = DB::table('tbl_product')
            ->join('tbl_brand','tbl_product.brand_id','=','tbl_brand.brand_id')
            ->where('tbl_brand.brand_slug',$slug)->get();

            $brand_name = DB::table('tbl_brand')->where('tbl_brand.brand_slug',$brand->brand_slug)->limit(1)->get();
          
                $meta_desc = $brand->brand_desc;
                $meta_keywords = $brand->brand_slug;
                $meta_title =  $brand->brand_name;
                $url_canonical = $request->url();
        
            return view('pages.brand.show_brand')->with('category',$cate_product)->with('brand',$brand_product)
            ->with('brand_by_id',$brand_by_id)->with('brand_name',$brand_name)->with('meta_desc',$meta_desc)
            ->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)
            ->with('all_slide',$all_slide)->with('category_post',$category_post)->with('slider',$slider);
        }elseif($product){
            $details_product = DB::table('tbl_product')
            ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
            ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
            ->where('tbl_product.product_slug',$slug)->get();
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
            }

            $gallery = Gallery::where('product_id',$product_id)->get();
            $product = Product::where('product_id',$product_id)->first();
            $product->product_views = $product->product_views + 1;
            $product->save();

            $related_product = DB::table('tbl_product')
            ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
            ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
            ->where('tbl_category_product.category_id',$category_id)->whereNotIn('tbl_product.product_slug',[$slug])->get();
            $rating = Rating::where('product_id',$product_id)->avg('rating');
            $rating = round($rating);

            return view('pages.sanpham.show_details')->with('category',$cate_product)->with('brand',$brand_product)
            ->with('product_details',$details_product)->with('relate',$related_product)->with('meta_desc',$meta_desc)
            ->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)
            ->with('category_post',$category_post)->with('slider',$slider)->with('gallery',$gallery)
            ->with('product_cate',$product_cate)->with('cate_slug',$cate_slug)->with('rating',$rating);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

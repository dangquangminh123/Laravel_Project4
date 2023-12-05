<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use App\Http\Requests;
use Mail;
use App\Models\Slider;
use App\Models\Icons;
use App\Models\CatePost;
use App\Models\Product;
use App\Models\CategoryProductModel;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Redirect;
session_start();

class HomeController extends Controller
{
    public function send_mail() {
        $to_name = "Minh Admin tutorial";
        $to_email = "dangquangminhdn76@gmail.com";
        // $link_reset_pass = url('/update-new-pass?email='.$to_email.'&token='.$rand_id);

        $data = array("name"=>"Mail từ tài khoản khách hàng","body"=>"Mail thông báo về đơn hàng");
        Mail::send('pages.send_mail',$data, function($message) use ($to_name,$to_email){
            $message->to($to_email)->subject('kiểm tra thử cách gửi mail');
            $message->from($to_email,$to_name);
        });

        return redirect('/trang-chu')->with('message','');
    }

    public function index(Request $request) {


        //Icons
        $icons = Icons::where('category','icons')->orderBy('id_icons','DESC')->get();

        //Category post
        $category_post =  CatePost::where('cate_post_id','<>',5)->orderBy('cate_post_id','DESC')->get();

        //Slider
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','1')->take(4)->get();

        //seo
        $meta_desc = "Chuyên bán những mô hình và team thảm hại";
        $meta_keywords = "Mô hình và những thằn thảm hại";
        $meta_title = "Home | Eshop";
        $url_canonical = $request->url();
        
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_parent','desc')
        ->orderby('category_order','ASC')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
        // $all_product = DB::table('tbl_product')
        // ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        // ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        // ->orderby('tbl_product.product_id','desc')->get();
        $product_all = DB::table('tbl_product')->paginate(10);
        $all_product = DB::table('tbl_product')->where('product_status','1')->orderby(DB::raw('RAND()'))->limit(6)->get();
        $cate_pro_tabs = CategoryProductModel::where('category_parent',0)->orderBy('category_order','ASC')->get();

        return view('pages.home')->with('category',$cate_product)->with('brand',$brand_product)->with('all_product',$all_product)
        ->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)
        ->with('slider',$slider)->with('category_post',$category_post)->with('product_all',$product_all)->with('cate_pro_tabs',$cate_pro_tabs)
        ->with('icons',$icons);
    }

    public function changlang(Request $request, $lang) {
       App::setLocale($lang);

            //Icons
        $icons = Icons::where('category','icons')->orderBy('id_icons','DESC')->get();

        //Category post
        $category_post =  CatePost::where('cate_post_id','<>',5)->orderBy('cate_post_id','DESC')->get();

        //Slider
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','1')->take(4)->get();

        //seo
        $meta_desc = "Chuyên bán những mô hình và team thảm hại";
        $meta_keywords = "Mô hình và những thằn thảm hại";
        $meta_title = "Home | Eshop";
        $url_canonical = $request->url();
        
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_parent','desc')
        ->orderby('category_order','ASC')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
        // $all_product = DB::table('tbl_product')
        // ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        // ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        // ->orderby('tbl_product.product_id','desc')->get();
        $product_all = DB::table('tbl_product')->paginate(10);
        $all_product = DB::table('tbl_product')->where('product_status','1')->orderby(DB::raw('RAND()'))->limit(6)->get();
        $cate_pro_tabs = CategoryProductModel::where('category_parent',0)->orderBy('category_order','ASC')->get();
           return view('pages.home')->with('category',$cate_product)->with('brand',$brand_product)->with('all_product',$all_product)
           ->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)
           ->with('slider',$slider)->with('category_post',$category_post)->with('product_all',$product_all)->with('cate_pro_tabs',$cate_pro_tabs)
           ->with('icons',$icons);
    }

    public function search(Request $request) {
        $meta_desc = "Tìm kiếm sản phẩm";
        $meta_keywords = "Tìm kiếm sản phẩm";
        $meta_title = "Tìm kiếm sản phẩm";
        $url_canonical = $request->url();
        $category_post =  CatePost::orderBy('cate_post_id','DESC')->get();
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','1')->take(5)->get();
        $keywords =$request->keywords_submit;
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();


        $search_product = DB::table('tbl_product')->where('product_name','like','%'.$keywords.'%')->get();
        return view('pages.sanpham.search')->with('category',$cate_product)->with('brand',$brand_product)
        ->with('search_product',$search_product)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)
        ->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('slider',$slider)
        ->with('category_post',$category_post);
    }

    public function load_more_product(){
        $all_product = Product::where('product_status','1')->orderby(DB::raw('RAND()'))->limit(6)->get();
        $output = '';
        foreach($all_product as $key => $pro){
            $output.= '<div class="col-sm-4">	
            <div class="product-image-wrapper">
                <div class="single-products">
                    <div class="productinfo text-center">
                    <form>
                        '.csrf_field().'
                    <input type="hidden" value="'.$pro->product_id.'" class="cart_product_id_'.$pro->product_id.'">
                    <input type="hidden" id="wishlist_productname'.$pro->product_id.'" value="'.$pro->product_name.'" 
                    class="cart_product_name_'.$pro->product_id.'">

                    <input type="hidden" value="'.$pro->product_quantity.'" class="cart_product_quantity_'.$pro->product_id.'">
                    <input type="hidden" value="'.$pro->product_image.'" class="cart_product_image_'.$pro->product_id.'">
                    <input type="hidden" id="wishlist_productprice'.$pro->product_id.'" value="'.number_format($pro->product_price,0,',','.').'$" 
                    class="cart_product_price_'.$pro->product_id.'">

                    <input type="hidden" value="1" class="cart_product_qty_'.$pro->product_id.'">

                        <a id="wishlist_producturl'.$pro->product_id.'" href="'.url('/chi-tiet-san-pham/'.$pro->product_id).'">
                            <img id="wishlist_productimage'.$pro->product_id.'" 
                            src="'.url('public/uploads/product/'.$pro->product_image).'" alt="'.$pro->product_name.'" />
                            <h2>'.number_format($pro->product_price,0,',','.').'</h2>
                            <p>'.$pro->product_name.'</p>
                        </a>
                        
                    <button class="btn btn-default home_cart_'.$pro->product_id.' addtocart" id="'.$pro->product_id.'" onclick="Addtocart(this.id);" type="button">
                    <i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</button>			
                    
                    <button type="buttons" style="display:none" class="btn btn-danger rm_home_cart_'.$pro->product_id.'" id="'.$pro->product_id.'" onclick="Deletecart(this.id);" >
                    <i class="fa fa-shopping-cart"></i>Bỏ đã thêm</button>

                        <input type="button" data-toggle="modal" data-target="#xemnhanh" onclick="XemNhanh(this.id)" value="Xem nhanh" 
                        class="btn btn-default" id="'.$pro->product_id.'" name="add-to-cart"/>
                        </form>
                    </div>
                </div>
                
            </div>
           
            <div class="choose"> 
				<ul class="nav nav-pills nav-justified">
					<li>
						<i class="fa fa-plus-square"></i>
						<button class="button_wishlist" id="'.$pro->product_id.'" 
						onclick="add_wistlist('.$pro->product_id.');"><span>Yêu thích</span></button>
						
					</li>
					<li><a style="cursor: pointer;" onclick="add_compare('.$pro->product_id.');">
						<i class="fa fa-plus-square"></i>So sánh</a></li>
		
					<div class="container">
						<!-- Modal -->
							<div class="modal fade" id="sosanh" role="dialog">
							  <div class="modal-dialog">
											  
								<!-- Modal content-->
								<div class="modal-content">
								  <div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title"><span id="title-compare"></span></h4>
								  </div>
								  <div class="modal-body">
									<div id="row_compare"></div>
									<table class="table table-hover" id="row_compare">
										<thead>
										  <tr>
											<th>Tên sản phẩm</th>
											<th>Giá sản phẩm</th>
											<th>Hình ảnh</th>
											<th>Thông số sản phẩm</th>
											<th>Xem sản phẩm</th>
											<th>Xóa</th>
										  </tr>
										</thead>
										<tbody>
										 
										</tbody>
									  </table>
								  </div>
								  <div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								  </div>
								</div>
								
							  </div>
							</div>
											
						  </div>
				</ul>
            </div>

		<!-- Modal -->
		<div id="xemnhanh" class="modal fade" role="dialog">
			<div class="modal-dialog">
			<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title product_quickview_title" id="">
							<span id="product_quickview_title"></span>
						</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>

				<div class="modal-body">
				<div class="row">
					<div class="col-md-5">
						<span id="product_quickview_image"></span>
						<span id="product_quickview_gallery"></span>
					</div>
					    <form>
                    '.csrf_field().'
						<div id="product_quickview_value"></div>
						<div class="col-md-7">
							<h2 class="quickview"><span id="product_quickview_title"></span></h2>
							<p>Mã ID:<span id="product_quickview_id"></span></p>
							<span>
								<h2 style="color:#FE980F">Giá sản phẩm
								<span id="product_quickview_price"></span></h2></br>
								<label>Số lượng:</label>
								<input name="qty" type="number" min="1" class="cart_product_qty_" value="1" />
								<input name="productid_hidden" type="hidden" value=""/>
							</span></br>
							<h4 class="quickview">Mô tả sản phẩm</h4>
							<fieldset>
								<span style="width: 100%" id="product_quickview_desc"></span>
								<span style="width: 100%" id="product_quickview_content"></span>
							</fieldset>
							<div id="product_quickview_button"></div>
							<div id="beforesend_quickview"></div>
						</div>
					</form>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-default redirect-cart">Đi tới giỏ hàng</button>
			</div>
				</div>
			</div>
		</div>';
        }
        echo $output;
    }

    public function error_page() {
        return view('errors.404');
    }

    public function autocomplete_ajax(Request $request){
        $data = $request->all();
        if($data['query']){
            $product = Product::where('product_status',1)->where('product_name','LIKE','%'.$data['query'].'%')->get();
            $output = '<ul class="dropdown-menu" style="display: block; position: relative">';
            foreach($product as $key => $val){
                $output .= '
                <li class="li_search_ajax"><a href="#">'.$val->product_name.'</a></li>';
            }
            $output .= '</ul>';
            echo $output;
        }
    }
}

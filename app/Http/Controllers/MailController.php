<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Session;
use App\Models\Customer;
use App\Mail\MailNotify;
use App\Models\Slider;
use App\Models\CatePost;
use App\Models\CategoryProductModel;
use Carbon\Carbon;

class MailController extends Controller
{
    public function index()
    {
        $data = [
            'subject' => 'Minh tutorial Mail',
            'body' => 'Hello this is my email delivery!',
            'email' => 'thongit109@gmail.com',
        ];
        $title_mail = 'Mail test';
        // try {
        //     Mail::to('dangquangminhdn76@gmail.com')->send(new MailNotify($data));
        //     return response()->json(['Great check your mail box']);
        // } catch (Exception $th) {
        //     return response()->json(['có gì sai']);
        // }
        Mail::send('mail.mail', ['data' => $data], function ($message) use ($title_mail, $data) {
            $message->to($data['email'])->subject($title_mail);
            $message->from($data['email'], $title_mail);
        });
        return response()->json(['Great check your mail box']);
    }

    public function send_coupon_vip($coupon_time,$coupon_condition,$coupon_number,$coupon_code)
    {
        //get customer
        $customer_vip = Customer::where('customer_vip', 1)->get();

        $coupon = Coupon::where('coupon_code',$coupon_code)->first();
        $start_coupon = $coupon->coupon_date_start;
        $end_coupon = $coupon->coupon_date_end;
        
        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
        $title_mail = 'Mã khuyến mãi ngày' . ' ' . $now;

        $data = [];
        foreach ($customer_vip as $vip) {
            $data['email'][] = $vip->customer_email;
        }

        $coupon = array(
            'start_coupon' => $start_coupon,
            'end_coupon' => $end_coupon,
            'coupon_time' => $coupon_time,
            'coupon_condition'  => $coupon_condition,
            'coupon_number' => $coupon_number,
            'coupon_code'  => $coupon_code
        );

        Mail::send('pages.send_coupon_vip', ['coupon' => $coupon], function ($message) use ($title_mail, $data) {
            $message->to($data['email'])->subject($title_mail);
            $message->from($data['email'], $title_mail);
        });
        return redirect()->back()->with('message', 'Gửi mã khuyến mãi khách vip thành công');
    }

    public function send_coupon($coupon_time,$coupon_condition,$coupon_number,$coupon_code){
         //get customer
         $customer = Customer::where('customer_vip','=', NULL)->get();

         $coupon = Coupon::where('coupon_code',$coupon_code)->first();
         $start_coupon = $coupon->coupon_date_start;
         $end_coupon = $coupon->coupon_date_end;

         $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
         $title_mail = 'Mã khuyến mãi ngày' . ' ' . $now;
 
         $data = [];
         foreach ($customer as $normal) {
             $data['email'][] = $normal->customer_email;
         }

         $coupon = array(
            'start_coupon' => $start_coupon,
            'end_coupon' => $end_coupon,
            'coupon_time' => $coupon_time,
            'coupon_condition'  => $coupon_condition,
            'coupon_number' => $coupon_number,
            'coupon_code'  => $coupon_code
        );

         Mail::send('pages.send_coupon', ['coupon' => $coupon], function ($message) use ($title_mail, $data) {
             $message->to($data['email'])->subject($title_mail);
             $message->from($data['email'], $title_mail);
         });
         return redirect()->back()->with('message', 'Gửi mã khuyến mãi khách thường thành công');
    }

    public function quen_mat_khau(Request $request){
        //Category post
        $category_post =  CatePost::orderBy('cate_post_id','DESC')->get();

        //Slider
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','1')->take(4)->get();

        //seo
        $meta_desc = "Quên mật khẩu";
        $meta_keywords = "Forget Password";
        $meta_title = "Pass | Eshop";
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
        $cate_pro_tabs = CategoryProductModel::where('category_parent','<>',0)->orderBy('category_order','ASC')->get();

        return view('pages.checkout.forget_pass')->with('category',$cate_product)->with('brand',$brand_product)->with('all_product',$all_product)
        ->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)
        ->with('slider',$slider)->with('category_post',$category_post)->with('product_all',$product_all)->with('cate_pro_tabs',$cate_pro_tabs);
    }

    public function recover_pass(Request $request){
        $data = $request->all();

        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y');
        $title_mail = 'Lấy lại mật khẩu dangquangminh' . ' ' . $now;
        $customer = Customer::where('customer_email','=',$data['email_account'])->get();

        foreach($customer as $key => $value){
            $customer_id = $value->customer_id;
        }

        if($customer){
            $count_customer = $customer->count();
            if($count_customer==0){
                return redirect()->back()->with('error', 'Email này chưa được đăng ký');
            }else {
                $token_random = Str::random();
                $customer = Customer::find($customer_id);
                $customer->customer_token = $token_random;
                $customer->save();

                $to_email = $data['email_account'];
                $link_reset_pass = url('/update-new-pass?email='.$to_email.'&token='.$token_random);
                $data = array("name"=>$title_mail,"body"=>$link_reset_pass,"email"=>$data['email_account']);

                Mail::send('pages.checkout.forget_pass_nofity', ['data'=>$data], function ($message) use ($title_mail, $data) {
                    $message->to($data['email'])->subject($title_mail);
                    $message->from($data['email'], $title_mail);
                });
                //Send mail
                return redirect()->back()->with('message', 'Đã gửi thông báo thành công đến gmail, vui lòng vào gmail để reset password');

            }
        }
    }

    public function update_new_pass(){
         //Category post
         $category_post =  CatePost::orderBy('cate_post_id','DESC')->get();

         //Slider
         $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','1')->take(4)->get();
 
         //seo
         $meta_desc = "Quên mật khẩu";
         $meta_keywords = "Forget Password";
         $meta_title = "Pass | Eshop";
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
         $cate_pro_tabs = CategoryProductModel::where('category_parent','<>',0)->orderBy('category_order','ASC')->get();
 
         return view('pages.checkout.new_pass')->with('category',$cate_product)->with('brand',$brand_product)->with('all_product',$all_product)
         ->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)
         ->with('slider',$slider)->with('category_post',$category_post)->with('product_all',$product_all)->with('cate_pro_tabs',$cate_pro_tabs);
       
    }

    public function reset_new_pass() {
        $data = $request->all();
        $token_random = Str::random();
        $customer = Customer::where('customer_email','=',$data['email'])->where('customer_token','=',$data['token'])->get();
        $count = $customer->count();
        if($count>0){
            foreach($customer as $key => $cus){
                $customer_id = $cus->customer_id;
            }
            $reset = Customer::find($customer_id);
            $reset->customer_password = md5($data['password_account']);
            $reset->customer_token = $rand_id;
            $reset->save();
            return redirect('login-checkout')->with('message','Mật khẩu được đã cập nhập.Vui lòng đăng nhập lại');
        }else {
            return redirect('quen-mat-khau')->with('error','Vui lòng nhập lại email vì link đã quá hạn');
        }
    }

    public function mail_example()
    {
        return view('pages.send_coupon');
    }
}

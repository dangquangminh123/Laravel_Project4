<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- SEO --}}
    <meta name="description" content="{{ $meta_desc }}">
    <meta name="keywords" content="{{ $meta_keywords }}" />
    <meta name="robots" content="INDEX,FOLLOW" />
    <link rel="canonical" href="{{ $url_canonical }}" />
    <meta name="author" content="">


    {{-- END SEO --}}
    <title>{{ $meta_title }}</title>
    <base href="http://localhost:8080/shopbanhang/" />
    {{-- <meta property="og:image" content="{{$image_og}}" /> --}}
    <meta property="og:site_name" content="thiatv.com" />
    <meta property="og:description" content="{{ $meta_desc }}" />
    <meta property="og:title" content="{{ $meta_title }}" />
    <meta property="og:url" content="{{ $url_canonical }}" />
    <meta property="og:type" content="website" />

    <link href="{{ asset('public/frontend/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontend/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontend/css/prettyPhoto.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontend/css/price-range.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontend/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontend/css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontend/css/responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontend/css/sweetalert.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontend/css/sweetalert.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontend/css/sweetalert.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontend/css/lightslider.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontend/css/prettify.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontend/css/lg-transitions.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontend/css/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontend/css/lightgallery-bundle.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontend/css/owl.theme.default.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontend/css/vlite.css') }}" rel="stylesheet">
    <!--[if lt IE 9]>
   
    <![endif]-->
    <link rel="shortcut icon" href="{{ asset('public/frontend/images/logo.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head>
<!--/head-->

<body>
    <?php
    
    ?>
    <header id="header">
        <!--header-->
        <div class="header_top">
            <!--header_top-->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="contactinfo">
                            <ul class="nav nav-pills">
                                <li><a href="#"><i class="fa fa-phone"></i>
                                        <span style="color: red">9501 88 821 - Mr.Thảm hại | 4092030923</span></a></li>
                                <li><a href="#"><i class="fa fa-envelope"></i> shopmohinh@domain.com</a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart" aria-hidden="true"></i>Mua hàng :
                                        8: 00 AM - 21h30PM
                                    </a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="social-icons pull-right">

                            <ul class="nav navbar-nav">
                                @foreach ($icons as $key => $icon)
                                    <li><a target="_blank" title="{{ $icon->name }}" href="{{ $icon->link }}">
                                            <img alt="{{ $icon->name }}" style="margin: 4px" height="32px"
                                                width="32px" src="{{ asset('public/uploads/icons/' . $icon->image) }}">
                                        </a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/header_top-->

        <div class="header-middle">
            <!--header-middle-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="logo pull-left">
                            <a href="index.html"><img src="{{ asset('public/frontend/images/logo.png') }}"
                                    alt="" /></a>
                        </div>
                        <div class="btn-group pull-right">
                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle usa"
                                    data-toggle="dropdown">
                                    @lang('lang.language')
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ url('ngonngu/vi') }}">Tiếng Việt</a></li>
                                    <li><a href="{{ url('ngonngu/en') }}">Tiếng Anh</a></li>
                                    <li><a href="{{ url('ngonngu/cn') }}">Tiếng Trung</a></li>
                                </ul>
                            </div>

                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle usa"
                                    data-toggle="dropdown">
                                    DOLLAR
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Canadian Dollar</a></li>
                                    <li><a href="#">Pound</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="shop-menu pull-right">
                            <ul class="nav navbar-nav">
                                <li><a href="#"><i class="fa fa-star"></i> yêu thích</a></li>
                                <?php 
									$customer_id = Session::get('customer_id');
									$shipping_id = Session::get('shipping_id');
									if($customer_id!=NULL && $shipping_id==NULL) {
								?>
                                <li><a href="{{ url('/checkout') }}"><i class="fa fa-crosshairs"></i> Thanh toán</a>
                                </li>
                                <?php 
								} elseif($customer_id!=NULL && $shipping_id!=NULL) {
								?>
                                <li><a href="{{ url('/payment') }}"><i class="fa fa-crosshairs"></i> Thanh toán</a>
                                </li>
                                <?php
								} else {
								?>
                                <li><a href="{{ url('/login-checkout') }}"><i class="fa fa-crosshairs"></i> Thanh
                                        toán</a></li>
                                <?php 
								}
								?>

                                <li class="cart-hover"><i
                                            class="fa fa-shopping-cart"></i>
                                        Giỏ hàng
                                        <span class="show-cart"></span>
                                        <div class="clearfix"></div>
                                        <span class="giohang-hover">
											<ul class="hover-cart"></ul>
										</span>
                                   </li>

                                <?php
									$customer_id = Session::get('customer_id');
									if($customer_id!=NULL) {
								?>
                                <li>
                                    <a href="{{ url('/history') }}"><i class="fa fa-bell"></i> Lịch sử đơn hàng :
                                    </a>
                                </li>
                                <?php
								} 
								?>


                                {{-- Phần nút đăng nhập --}}
                                <?php 
									$customer_id = Session::get('customer_id');
									if($customer_id!=NULL) {
								?>
                                <li>
                                    <a href="{{ url('/logout-checkout') }}"><i class="fa fa-lock"></i> Đăng xuất :
                                    </a>
                                    <img width="15%" src="{{ Session::get('customer_picture') }}">
                                    {{ Session::get('customer_name') }}
                                </li>
                                <?php 
								} else {
								?>
                                <li><a href="{{ url('/login-checkout') }}"><i class="fa fa-lock"></i> Đăng nhập</a>
                                </li>
                                <?php
								}
								?>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/header-middle-->

        <div class="header-bottom">
            <!--header-bottom-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-7">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse"
                                data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="mainmenu pull-left">
                            <ul class="nav navbar-nav collapse navbar-collapse">
                                <li><a href="{{ url('/trang-chu') }}" class="active">@lang('lang.home')</a></li>
                                <li class="dropdown"><a href="#">{{ __('lang.product') }}<i
                                            class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        @foreach ($category as $key => $danhmuc)
                                            @if ($danhmuc->category_parent == 0)
                                                {{-- <li><a
                                                        href="{{ url('/danh-muc-san-pham/' . $danhmuc->slug_category_product) }}">
                                                        {{ $danhmuc->category_name }}
                                                    </a></li> --}}
                                            <li><a
                                                href="{{route('show.slug', ['slug' => $danhmuc->slug_category_product])}}">
                                                {{ $danhmuc->category_name }}
                                            </a></li>

                                                @foreach ($category as $key => $cate_sub)
                                                    @if ($cate_sub->category_parent == $danhmuc->category_id)
                                                        <ul>
                                                            {{-- <li><a
                                                                    href="{{ url('/danh-muc-san-pham/' . $cate_sub->slug_category_product) }}">
                                                                    {{ $cate_sub->category_name }}
                                                                </a></li> --}}
                                                            <li><a
                                                                href="{{route('show.slug', ['slug' => $cate_sub->slug_category_product])}}">
                                                                {{ $cate_sub->category_name }}
                                                            </a></li>
                                                        </ul>
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </ul>
                                </li>
                                <li class="dropdown"><a href="#">@lang('lang.blogs')<i
                                            class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        @foreach ($category_post as $key => $cate_post)
                                            <li><a href="{{ url('/danh-muc-bai-viet/' . $cate_post->cate_post_slug) }}">
                                                    {{ $cate_post->cate_post_name }}
                                                </a></li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li>
                                    <a href="{{ url('/show-cart') }}">@lang('lang.cart')
                                        <span class="show-cart"></span>
                                    </a>
                                </li>
                                <li><a href="{{ url('/video-shop') }}">@lang('lang.video')</a></li>
                                <li><a href="{{ url('/lien-he') }}">@lang('lang.contact')</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <form action="{{ url('/tim-kiem') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="search_box pull-right">
                                <input type="text" name="keywords_submit" id="keywords"
                                    placeholder="Tìm kiếm sản phẩm của bạn" />
                                <div id="search-ajax">

                                </div>
                                <input type="submit" style="margin-top: 0; color:#666;" name="search_items"
                                    class="btn btn-primary btn-sm" value="Tìm kiếm" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--/header-bottom-->
    </header>
    <!--/header-->

    {{-- Slider --}}
    @yield('slider')

    <section>
        <div class="container">
            <div class="row">

                <div class="col-sm-12 padding-right">
                    @yield('content_category')
                </div>

                @yield('sidebar')

                <div class="col-sm-9 padding-right">
                    @yield('content')
                </div>

                {{-- Đối tác --}}
                <style type="text/css">
                    h3.doitac {
                        text-align: center;
                        font-size: 20px;
                        text-transform: uppercase;
                        margin: 20px;
                        font-weight: bold;
                    }

                    h4.doitac_name {
                        text-align: center;
                        font-size: 13px;
                    }

                    button.owl-prev {
                        font-size: 45px !important;
                    }

                    button.owl-next {
                        font-size: 45px !important;
                    }
                </style>
                <div class="col-md-12">
                    <h3 class="doitac">Đối tác</h3>
                    <div class="owl-carousel owl-theme">
                        @foreach ($doitac as $key => $dt)
                            <div class="item" style="padding-left:0 !important;">
                                <a target="_blank" href="{{ $dt->link }}">
                                    <p><img width="100%" src="{{ asset('public/uploads/icons/' . $dt->image) }}" />
                                    </p>
                                    <h4 class="doitac_name">{{ $dt->name }}</h4>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>



    <footer id="footer">
        <!--Footer-->
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    @foreach ($contact_footer as $key => $logo)
                        <div class="col-sm-5">
                            <div class="companyinfo">
                                <p><img src="{{ asset('public/uploads/contact/' . $logo->info_logo) }}" /></p>
                                <p>{{ $logo->slogan_logo }}</p>
                            </div>
                        </div>
                    @endforeach
                    <div class="col-sm-7">

                    </div>
                </div>
            </div>
        </div>

        <div class="footer-widget">
            <div class="container">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Dịch vụ chúng tôi</h2>
                            <ul class="nav nav-pills nav-stacked">
                                @foreach ($post_footer as $key => $post_foot)
                                    <li><a
                                            href="{{ url('/bai-viet/' . $post_foot->post_slug) }}">{{ $post_foot->post_title }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <style type="text/css">
                        .information_footer ul {
                            padding: 0px;
                        }
                    </style>
                    @foreach ($contact_footer as $key => $contact_foo)
                        <div class="col-sm-3">
                            <div class="single-widget">
                                <h2>Thông tin shop</h2>
                                <div class="information_footer">
                                    <ul>
                                        <li>{!! $contact_foo->info_contact !!}</li>
                                    </ul>
                                </div>
                                {{-- <ul class="nav nav-pills nav-stacked">
								<li>Địa chỉ : </li>
								<li>Số điện thoại : </li>
								<li>Email : </li>
								<li>Mạng xã hội : </li>
							</ul> --}}
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="single-widget">
                                <h2>Fanpage</h2>
                                {{-- <ul class="nav nav-pills nav-stacked">
								<li></li>
							</ul> --}}
                                <img src="{{ asset('public/frontend/images/kiemthu.jpg') }}" width="250px"
                                    height="180px" alt="">
                                <img src="{{ asset('public/frontend/images/thai2.jpg') }}" width="250px"
                                    height="180px" alt="">
                                {!! $contact_foo->info_fanpage !!}
                            </div>
                        </div>
                    @endforeach
                    <div class="col-sm-3 col-sm-offset-1">
                        <div class="single-widget">
                            <h2>ĐĂNG KÝ EMAIL</h2>
                            <form action="#" class="searchform">
                                <input type="text" placeholder="Nhập địa chỉ Email của bạn" />
                                <button type="submit" class="btn btn-default"><i
                                        class="fa fa-arrow-circle-o-right"></i></button>
                                <p>Shop chúng tôi có cập nhập địa chỉ mới nhất <br />Thì chúng tôi sẽ thông báo cho
                                    bạn...</p>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <p class="pull-left">Copyright © 2013 E-SHOPPER Inc. All rights reserved.</p>
                    <p class="pull-right">Designed by <span><a target="_blank"
                                href="http://www.themeum.com">Themeum</a></span></p>
                </div>
            </div>
        </div>

    </footer>
    <!--/Footer-->
    <script src="{{ asset('public/frontend/js/jquery.js') }}"></script>
    <script src="{{ asset('public/frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/jquery.scrollUp.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/price-range.js') }}"></script>
    <script src="{{ asset('public/frontend/js/jquery.prettyPhoto.js') }}"></script>
    <script src="{{ asset('public/frontend/js/main.js') }}"></script>
    <script src="{{ asset('public/frontend/js/sweetalert.js') }}"></script>
    <script src="{{ asset('public/frontend/js/lightslider.js') }}"></script>

    <script src="{{ asset('public/frontend/js/owl.carousel.js') }}"></script>
    <script src="{{ asset('public/frontend/js/prettify.js') }}"></script>
    <script src="{{ asset('public/frontend/js/simple.money.format.js') }}"></script>
    <script src="{{ asset('public/frontend/js/vlite.js') }}"></script>
    <div id="fb-root"></div>

    {{-- Gallery product --}}
    <script type="text/javascript">
        $(document).ready(function() {
            $('#imageGallery').lightSlider({
                gallery: true,
                item: 1,
                loop: true,
                thumbItem: 5,
                slideMargin: 0,
                enableDrag: false,
                currentPagerPosition: 'left',
                onSliderLoad: function(el) {
                    el.lightGallery({
                        selector: '#imageGallery .lslide'
                    });
                }
            });
        });
    </script>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v16.0"
        nonce="AxPbvdVg"></script>

    {{-- Load more product --}}
    <script type="text/javascript">
        load_more_product();
        // function load_more_product(id = ''){
        // 	$.ajax({
        // 		url:"{{ url('/load-more-product') }}",
        // 		method:"POST",
        // 		headers: {
        //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         },
        // 		data:{id:id},
        // 		success:function(data) {
        // 			$('#load_more_button').remove();
        // 			$('#all_product').append(data);

        // 			var id = [];
        // 			$(".cart_id").each(function() {
        // 				id.push($(this).val());
        // 			});

        // 			for(var i = 0; i<id.length; i++){
        // 				$('.home_cart_'+id[i]).hide();
        // 				$('.rm_home_cart_'+id[i]).show();
        // 			}
        // 		}
        // 	});
        // }

        // cart_session();

        // function cart_session() {
        //     $.ajax({
        //         url: "{{ url('/cart-session') }}",
        //         method: "GET",
        //         success: function(data) {
        //             $('#cart_session').html(data);
        //         }
        //     });
        // }

        // htmlLoaded();

        // function htmlLoaded() {
        // 	$(window).load(function() {
        // 		var id = [];
        // 		$(".cart_id").each(function() {
        // 			id.push($(this).val());
        // 		});

        // 		for(var i = 0; i<id.length;i++){
        // 			$('.home_cart_'+id[i]).hide();
        // 			$('.rm_home_cart_'+id[i]).show();
        // 		}
        // 	});
        // }
        function load_more_product() {
            $.ajax({
                url: "{{ url('/load-more-product') }}",
                method: "GET",
                success: function(data) {
                    $('#all_product').html(data);

                    var id = [];

                    $(".cart_id").each(function() {
                        id.push($(this).val());
                    });

                    for (var i = 0; i < id.length; i++) {
                        $('.home_cart_' + id[i]).hide();
                        $('.rm_home_cart_' + id[i]).show();
                    }
                }
            });
        }

        // $(document).on('click','#load_more_button',function(){
        // 	var id = $(this).data('id');
        // 	$('#load_more_button').html('<b>Loading.....</b>');
        // 	load_more_product(id);
        // })
    </script>

    {{-- Hủy đơn hàng --}}
    <script type="text/javascript">
        function Huydonhang(id) {
            var order_code = id;
            var lydo = $('.lydohuydon').val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{ url('/huy-don-hang') }}",
                method: "POST",
                data: {
                    order_code: order_code,
                    lydo: lydo,
                    _token: _token
                },
                success: function(data) {
                    alert('Đã gửi thông báo hủy đơn');
                    location.reload();
                }
            });
        }
    </script>
    {{-- Slider --}}
    <script type="text/javascript">
        $(document).ready(function() {
            $("#slider-range").slider({
                orientation: "horizontal",
                range: true,

                min: {{ $min_price_range }},
                max: {{ $max_price_range }},

                steps: 10,
                values: [{{ $min_price }}, {{ $max_price }}],

                slide: function(event, ui) {
                    $("#amount_start").val(ui.values[0] + "$ -").simpleMoneyFormat();
                    $("#amount_end").val(ui.values[1] + "$").simpleMoneyFormat();
                    $("#start_price").val(ui.values[0]);
                    $("#end_price").val(ui.values[1]);
                }
            });
            $("#amount_start").val($("#slider-range").slider("values", 0) + "$ -").simpleMoneyFormat();
            $("#amount_end").val($("#slider-range").slider("values", 1) + "$").simpleMoneyFormat();

        });
    </script>

    {{-- Đối tác --}}
    <script type="text/javascript">
        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 10,
            dots: false,
            nav: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 5
                }
            }
        })
    </script>

    {{-- Sort --}}
    <script type="text/javascript">
        $(document).ready(function() {
            $('#sort').on('change', function() {
                var url = $(this).val();
                if (url) {
                    window.location = url;
                }
                return false;
            });
        });
    </script>

    {{-- Comment --}}
    <script type="text/javascript">
        $(document).ready(function() {
            load_comment();

            function load_comment() {
                var product_id = $('.comment_product_id').val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{ url('/load-comment') }}",
                    method: "POST",
                    data: {
                        product_id: product_id,
                        _token: _token
                    },
                    success: function(data) {
                        $('#comment_show').html(data);
                    }
                });
            }

            $('.send-comment').click(function() {
                var product_id = $('.comment_product_id').val();
                var comment_name = $('.comment_name').val();
                var comment_content = $('.comment_content').val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{ url('/send-comment') }}",
                    method: "POST",
                    data: {
                        product_id: product_id,
                        comment_name: comment_name,
                        comment_content: comment_content,
                        _token: _token
                    },
                    success: function(data) {
                        $('#notify_comment').html(
                            '<span class="text text-success">Thêm bình luận thành công, bình luận đang chờ duyệt</span>'
                            );
                        load_comment();
                        $('#notify_comment').fadeOut(5000);
                        $('.comment_name').val('');
                        $('.comment_content').val('');
                    }
                });
            });
        });
    </script>

{{-- Filter --}}
    <script type="text/javascript">
        $('.category-filter').click(function(){
            var category = [], tempArray = [];

            $.each($("[data-filters='category']:checked"),function(){
                tempArray.push($(this).val());

            });
            tempArray.reverse();
            if(tempArray.length !== 0){
                category+='?cate='+tempArray.toString();
            }
            window.location.href = category
        })
        //Brand
        $('.brand-filter').click(function(){
            var brand = [], tempArray = [];

            $.each($("[data-filters='brand']:checked"),function(){
                tempArray.push($(this).val());
            });
            tempArray.reverse();
            if(tempArray.length !== 0){
                brand+='?brand='+tempArray.toString();
            }
            window.location.href = brand
        })
    </script>
    {{-- Rating --}}
    <script type="text/javascript">
        function remove_background(product_id) {
            for (var count = 1; count <= 5; count++) {
                $('#' + product_id + '-' + count).css('color', '#ccc');
            }
        }

        //Rê chuột để đánh giá sao
        $(document).on('mouseenter', '.rating', function() {
            var index = $(this).data("index");
            var product_id = $(this).data('product_id');

            remove_background(product_id);
            for (var count = 1; count <= index; count++) {
                $('#' + product_id + '-' + count).css('color', '#ffcc00');
            }
        });

        //Nhả chuột không đánh giá
        $(document).on('mouseleave', '.rating', function() {
            var index = $(this).data("index");
            var product_id = $(this).data('product_id');
            var rating = $(this).data("rating");
            remove_background(product_id);
            for (var count = 1; count <= rating; count++) {
                $('#' + product_id + '-' + count).css('color', '#ffcc00');
            }
        });

        //Click đánh giá sao
        $(document).on('click', '.rating', function() {
            var index = $(this).data("index");
            var product_id = $(this).data('product_id');
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{ url('/insert-rating') }}",
                method: "POST",
                data: {
                    index: index,
                    product_id: product_id,
                    _token: _token
                },
                success: function(data) {
                    if (data == 'xong') {
                        alert("Bạn đã đánh giá" + index + "trên 5");
                    } else {
                        alert("Lỗi đánh giá");
                    }
                }
            });
        });
    </script>

    {{-- compare --}}
    <script type="text/javascript">
        //Add
        function add_compare(product_id) {
            document.getElementById('title-compare').innerText = 'Chỉ cho phép so sánh tối đa 5 phẩm';

            var id = product_id;
            var name = document.getElementById('wishlist_productname' + id).value;
            var content = document.getElementById('wishlist_productcontent' + id).value;
            var price = document.getElementById('wishlist_productprice' + id).value;
            var image = document.getElementById('wishlist_productimage' + id).src;
            var url = document.getElementById('wishlist_producturl' + id).href;

            var newItem = {
                'url': url,
                'id': id,
                'content': content,
                'name': name,
                'price': price,
                'image': image
            }

            if (localStorage.getItem('compare') == null) {
                localStorage.setItem('compare', '[]');
            }

            var old_data = JSON.parse(localStorage.getItem('compare'));

            var matches = $.grep(old_data, function(obj) {
                return obj.id == id;
            })

            if (matches.length) {

            } else {
                if (old_data.length <= 5) {
                    old_data.push(newItem);
                    $("#row_compare").find('tbody').append(`
							<tr id="row_compare` + id + `">
								<td>` + newItem.name + `</td>
								<td>` + newItem.price + `</td>
								<td><img width="200px" width="100%" src="` + image + `"></td>
								<td></td>
								<td></td>
								<td></td>
								<td><a href="` + newItem.url + `">Xem sản phẩm</a></td>
								<td><a style="cursor:pointer;" onclick="delete_compare(` + id + `)">Loại bỏ so sánh</a></td>
							</tr>`);
                }

            }
            localStorage.setItem('compare', JSON.stringify(old_data));
            $('#sosanh').modal();
        }

        // Hiện thị các sản phẩm trong danh sách so sánh
        sosanh();

        function sosanh(product_id) {

            if (localStorage.getItem('compare') != null) {
                var data = JSON.parse(localStorage.getItem('compare'));

                for (i = 0; i < data.length; i++) {
                    var id = data[i].id;
                    var name = data[i].name;
                    var price = data[i].price;
                    var image = data[i].image;
                    var url = data[i].url;
                    $('#row_compare').find('tbody').append(`
					<tr id="row_compare` + id + `">
							<td>` + name + `</td>
							<td>` + price + `</td>
							<td><img width="200px" width="100%" src="` + image + `"></td>
							<td></td>
							<td></td>
							<td></td>
							<td><a href="` + url + `">Xem sản phẩm</a></td>
							<td><a style="cursor:pointer;" onclick="delete_compare(` + id + `)">Loại bỏ so sánh</a></td>
						</tr>
					`);
                }
            }
        }

        //Loại bỏ khỏi danh sách so sánh
        function delete_compare(id) {
            if (localStorage.getItem('compare') != null) {
                var data = JSON.parse(localStorage.getItem('compare'));
                var index = data.findIndex(item => item.id === id);
                data.splice(index, 1);
                //Loại bỏ giá trị phần tử ở localstorage
                localStorage.setItem('compare', JSON.stringify(data));
                //Sau đó xóa bỏ phần tử trong giao diện
                document.getElementById("row_compare" + id).remove();
            }
        }
    </script>

    {{-- Sản phẩm đã xem --}}
    <script type="text/javascript">
        function watched() {
            if (localStorage.getItem('viewed') != null) {
                var data = JSON.parse(localStorage.getItem('viewed'));
                data.reverse();
                document.getElementById('row_viewed').style.overflow = 'scroll';
                document.getElementById('row_viewed').style.height = '600px';
                for (i = 0; i < data.length; i++) {
                    var name = data[i].name;
                    var price = data[i].price;
                    var image = data[i].image;
                    var url = data[i].url;
                    $('#row_viewed').append('<div class="row" style="margin: 10px 0px"><div class="col-md-4"><img src="' +
                        image +
                        '" width="100%"/></div> <div class="col-md-8 info_wishlist"><p>' + name +
                        '</p><p style="color: #FE980F">' +
                        price + '</p><a href="' + url + '">Xem ngay</a></div></div>')
                }
            }
        }
        watched();

        product_viewed();

        function product_viewed() {
            var id_product = $('#product_viewed_id').val();
            if (id_product != undefined) {
                var id = id_product;
                var name = document.getElementById('viewed_productname' + id).value;
                var price = document.getElementById('viewed_productprice' + id).value;
                var image = document.getElementById('viewed_productimage' + id).value;
                var url = document.getElementById('viewed_producturl' + id).value;
                var newItem = {
                    'url': url,
                    'id': id,
                    'name': name,
                    'price': price,
                    'image': image
                }
                var old_data = JSON.parse(localStorage.getItem('viewed'));

                if (localStorage.getItem('viewed') == null) {
                    localStorage.setItem('viewed', '[]');
                }
                var matches = $.grep(old_data, function(obj) {
                    return obj.id == id;
                })

                if (matches.length) {
                    alert('Sản phẩm đã được yêu thích, bạn không thể yêu thích lần nữa');
                } else {
                    old_data.push(newItem);
                    $("#row_viewed").append('<div class="row" style="margin:10px 0"><div class="col-md-4"><img src="' +
                        newItem.image + '" width="100%"></div><div class="col-md-8 info_wishlist"><p>' + newItem.name +
                        '</p><p style="color:#FE980F">' + newItem.price + '</p><a href="' + newItem.url +
                        '">Đặt hàng</a></div></div>');
                }
                localStorage.setItem('viewed', JSON.stringify(old_data));
            }
        }
    </script>

    {{-- Sản phẩm yêu thích --}}
    <script type="text/javascript">
        function view() {
            if (localStorage.getItem('data') != null) {
                var data = JSON.parse(localStorage.getItem('data'));
                data.reverse();
                document.getElementById('row_wishlist').style.overflow = 'scroll';
                document.getElementById('row_wishlist').style.height = '600px';
                for (i = 0; i < data.length; i++) {
                    var name = data[i].name;
                    var price = data[i].price;
                    var image = data[i].image;
                    var url = data[i].url;
                    $('#row_wishlist').append('<div class="row" style="margin: 10px 0px"><div class="col-md-4"><img src="' +
                        image +
                        '" width="100%"/></div> <div class="col-md-8 info_wishlist"><p>' + name +
                        '</p><p style="color: #FE980F">' +
                        price + '</p><a href="' + url + '">Đặt hàng</a></div></div>')
                }
            }
        }
        view();

        function add_wistlist(clicked_id) {
            var id = clicked_id;
            var name = document.getElementById('wishlist_productname' + id).value;
            var price = document.getElementById('wishlist_productprice' + id).value;
            var image = document.getElementById('wishlist_productimage' + id).src;
            var url = document.getElementById('wishlist_producturl' + id).href;
            var newItem = {
                'url': url,
                'id': id,
                'name': name,
                'price': price,
                'image': image
            }
            var old_data = JSON.parse(localStorage.getItem('data'));

            if (localStorage.getItem('data') == null) {
                localStorage.setItem('data', '[]');
            }
            var matches = $.grep(old_data, function(obj) {
                return obj.id == id;
            })

            if (matches.length) {
                alert('Sản phẩm đã được yêu thích, bạn không thể yêu thích lần nữa');
            } else {
                old_data.push(newItem);
                $("#row_wishlist").append('<div class="row" style="margin:10px 0"><div class="col-md-4"><img src="' +
                    newItem.image + '" width="100%"></div><div class="col-md-8 info_wishlist"><p>' + newItem.name +
                    '</p><p style="color:#FE980F">' + newItem.price + '</p><a href="' + newItem.url +
                    '">Đặt hàng</a></div></div>');
            }
            localStorage.setItem('data', JSON.stringify(old_data));
        }
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            //Khi mình không click
            var cate_id = $('.tabs_pro').data('id');
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{ url('/product-tabs') }}",
                method: "POST",
                data: {
                    cate_id: cate_id,
                    _token: _token
                },
                success: function(data) {
                    $('#tabs_product').html(data);
                }
            });

            //Phần code để click thẳng vào danh mục
            $('.tabs_pro').click(function() {
                var cate_id = $(this).data('id');
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{ url('/product-tabs') }}",
                    method: "POST",
                    data: {
                        cate_id: cate_id,
                        _token: _token
                    },
                    success: function(data) {
                        $('#tabs_product').html(data);
                    }
                });
            });
        });
    </script>

    {{-- Quickview --}}
    <script type="text/javascript">
        $('.xemnhanh').click(function() {
            var product_id = $(this).data('id_product');
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{ url('/quickview') }}",
                method: "POST",
                dataType: "JSON",
                data: {
                    product_id: product_id,
                    _token: _token
                },
                success: function(data) {
                    $('#product_quickview_title').html(data.product_name);
                    $('#product_quickview_id').html(data.product_id);
                    $('#product_quickview_price').html(data.product_price);
                    $('#product_quickview_image').html(data.product_image);
                    $('#product_quickview_gallery').html(data.product_gallery);
                    $('#product_quickview_desc').html(data.product_desc);
                    $('#product_quickview_content').html(data.product_content);
                    $('#product_quickview_value').html(data.product_quickview_value);
                    $('#product_quickview_button').html(data.product_button);
                }
            });
        });
    </script>


    <script type="text/javascript">
        $(document).on('click', '.add-to-cart-quickview', function() {
            var id = $(this).data('id_product');
            var cart_product_id = $('.cart_product_id_' + id).val();
            var cart_product_name = $('.cart_product_name_' + id).val();
            var cart_product_image = $('.cart_product_image_' + id).val();
            var cart_product_quantity = $('.cart_product_quantity_' + id).val();
            var cart_product_price = $('.cart_product_price_' + id).val();
            var cart_product_qty = $('.cart_product_qty_' + id).val();
            var _token = $('input[name="_token"]').val();

            if (parseInt(cart_product_qty) > parseInt(cart_product_quantity)) {
                alert('Làm ơn đặt nhỏ hơn' + cart_product_quantity);
            } else {
                $.ajax({
                    url: '{{ url('/add-cart-ajax') }}',
                    method: 'POST',
                    data: {
                        cart_product_id: cart_product_id,
                        cart_product_name: cart_product_name,
                        cart_product_image: cart_product_image,
                        cart_product_price: cart_product_price,
                        cart_product_qty: cart_product_qty,
                        cart_product_quantity: cart_product_quantity,
                        _token: _token
                    },
                    beforeSend: function() {
                        $('#beforesend_quickview').html(
                            "<p class='text text-primary'>Đang thêm sản phẩm vào giỏ hàng</p>");
                    },
                    success: function() {
                        $('#beforesend_quickview').html(
                            "<p class='text text-success'>Sản phẩm đã được thêm vào giỏ hàng</p>");
                    }
                });
            }
        });
        $(document).on('click', '.redirect-cart', function() {
            window.location.href = "{{ url('/gio-hang') }}";
        })
    </script>

    {{-- Video --}}
    <script type="text/javascript">
        $(document).on('click', '.watch-video', function() {
            var video_id = $(this).attr('id');
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: '{{ url('/watch-video') }}',
                method: "POST",
                dataType: "JSON",
                data: {
                    video_id: video_id,
                    _token: _token
                },
                success: function(data) {
                    $('#video_title').html(data.video_title);
                    $('#video_link').html(data.video_link);
                    $('#video_desc').html(data.video_desc);
                }
            });
        });
    </script>

    <script type="text/javascript">
        $('#keywords').keyup(function() {
            var query = $(this).val();
            if (query != '') {
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{ url('/autocomplete-ajax') }}",
                    method: "POST",
                    data: {
                        query: query,
                        _token: _token
                    },
                    success: function(data) {
                        $('#search-ajax').fadeIn();
                        $('#search-ajax').html(data);
                    }
                });
            } else {
                $('#search-ajax').fadeOut();
            }
        });

        $(document).on('click', '.li_search_ajax', function() {
            $('#keywords').val($(this).text());
            $('#search-ajax').fadeOut();
        });
    </script>
    {{-- Order  --}}
    <script type="text/javascript">
        $(document).ready(function() {
            $('.send_order').click(function() {
                swal({
                        title: "Bạn có muốn mặt hàng này thật sự không ?",
                        text: "Đơn hàng này nếu đã xác nhận thì không được hoàn trả",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonClass: "btn-danger",
                        confirmButtonText: "Vâng, tôi muốn mua!",
                        cancelButtonText: "Không, tôi không muốn nữa",
                        closeOnConfirm: false,
                        closeOnCancel: false
                    },
                    function(isConfirm) {
                        if (isConfirm) {
                            var shipping_email = $('.shipping_email').val();
                            var shipping_name = $('.shipping_name').val();
                            var shipping_address = $('.shipping_address').val();
                            var shipping_phone = $('.shipping_phone').val();
                            var shipping_notes = $('.shipping_notes').val();
                            var shipping_method = $('.payment_select').val();
                            var order_fee = $('.order_fee').val();
                            var order_coupon = $('.order_coupon').val();
                            var _token = $('input[name="_token"]').val();
                            $.ajax({
                                url: '{{ url('/confirm-order') }}',
                                method: 'POST',
                                data: {
                                    shipping_email: shipping_email,
                                    shipping_name: shipping_name,
                                    shipping_address: shipping_address,
                                    shipping_phone: shipping_phone,
                                    shipping_notes: shipping_notes,
                                    order_fee: order_fee,
                                    order_coupon: order_coupon,
                                    shipping_method: shipping_method,
                                    _token: _token
                                },
                                success: function(data) {
                                    swal("Cảm ơn!",
                                        "Đơn hàng của bạn đã được gửi cho chúng tôi.",
                                        "success");
                                }
                            });
                            window.setTimeout(function() {
                                window.location.href = "{{ url('/history') }}";
                            }, 3000);
                        } else {
                            swal("Xin lỗi", "Đơn hàng đã được hủy bỏ :)", "error");
                        }
                    });

            });
        });
    </script>


    {{-- Cart --}}
    <script type="text/javascript">
        //Hiển thị cart kiểu hover
        // hover_cart();
		fetchCart();
        // show_cart();
        // //Show cart quantity
        // function show_cart() {
        //     $.ajax({
        //         url: "{{ url('/show-cart') }}",
        //         method: "GET",
        //         success: function(data) {
        //             $('.show-cart').html(data);
        //         }
        //     });
        // }

        // Hover cart
        // function hover_cart() {
        //     var id = $(this).data('id_product');
        //     var cart_product_name = $('.cart_product_name_' + id).val();
        //     var cart_product_image = $('.cart_product_image_' + id).val();
        //     var cart_product_price = $('.cart_product_price_' + id).val();
        //     $.ajax({
        //         url: "{{ url('/hover-cart') }}",
        //         method: "GET",
        //         data: {
        //             cart_product_name: cart_product_name,
        //             cart_product_image: cart_product_image,
        //             cart_product_price: cart_product_price
        //         },
        //         success: function(data) {
        //             $('.giohang-hover').html(data);
        //         }
        //     });
        // }

		function fetchCart(){
			$.ajax({
				url: "{{ url('/hover-cart') }}",
                method: 'GET',
				contentType: "application/json; charset=utf-8",
          		dataType: "json",
                success: function(res) {
					var html = '';
					var carts = res.data;
					var count = '';
				  if(carts.length){
					if(carts.length > 0){
						count+=('<span>'+res.data.length+'</span>');
						for (let i = 0; i < carts.length; i++) {
							html+= ('<li><a href="#">\
			<img src="public/uploads/product/'+carts[i].product_image+'"><p></p>'+ carts[i].product_name +'<p>'+ carts[i].product_price +' </p>\
			<p>Số lượng:'+ carts[i].product_qty +'</p></a><span class="delete-hover-cart" data-session_id="'+carts[i].session_id+'"><i class="fa fa-times"></i></span></li>');
						}
				   }else{
					html+=(' <li><p>Giỏ hàng trống...</p></li>');
				   }
				  }else{
					if (Object.keys(carts).length > 0) {
						count+=('<span>'+Object.keys(carts).length+'</span>');
                   Object.keys(carts).forEach(function (i) {
					html+= ('<li><a href="#">\
			<img src="public/uploads/product/'+carts[i].product_image+'"><p></p>'+ carts[i].product_name +'<p>'+ carts[i].product_price +' </p>\
			<p>Số lượng:'+ carts[i].product_qty +'</p></a><span class="delete-hover-cart" data-session_id="'+carts[i].session_id+'"><i class="fa fa-times"></i></span></li>');
				   });
				  }else{
					html+=(' <li><p>Giỏ hàng trống...</p></li>');
				  }
                }
                $('.hover-cart').html(html);
                $('.show-cart').html(count);
            }
		});
		}
        // Delete Cart
		$(document).on('click','.delete-hover-cart',function(){
			Delete($(this));
		});

		function Delete(params){
			var id = params.data('session_id');
			$.ajax({
                url: '{{ url('/del-product/') }}'+'/'+id,
                method: 'GET',
                data: {
                    id: id
                },
                success: function(res) {
                    if(res.code == 200){
						fetchCart();
                        show_quick_cart();
					}
                }
            });
		}

        function Deletecart(id) {
            var id = id;
            $.ajax({
                url: '{{ url('/remove-item') }}',
                method: 'GET',
                data: {
                    id: id
                },
                success: function(data) {
                    alert('Xóa sản phẩm trong giỏ hàng thành công');
                    document.getElementsByClassName("home_cart_" + id)[0].style.display = "inline";
                    document.getElementsByClassName("rm_home_cart_" + id)[0].style.display = "none";
                    show_cart();
                    // hover_cart();
                    cart_session();
                }
            });
        }

        $(document).ready(function() {
            $('.add-to-cart').click(function() {
                var id = $(this).data('id_product');
                var cart_product_id = $('.cart_product_id_' + id).val();
                var cart_product_name = $('.cart_product_name_' + id).val();
                var cart_product_image = $('.cart_product_image_' + id).val();
                var cart_product_quantity = $('.cart_product_quantity_' + id).val();
                var cart_product_price = $('.cart_product_price_' + id).val();
                var cart_product_qty = $('.cart_product_qty_' + id).val();
                var _token = $('input[name="_token"]').val();

                if (parseInt(cart_product_qty) > parseInt(cart_product_quantity)) {
                    alert('Làm ơn đặt nhỏ hơn' + cart_product_quantity);
                } else {
                    $.ajax({
                        url: '{{ url('/add-cart-ajax') }}',
                        method: 'POST',
                        data: {
                            cart_product_id: cart_product_id,
                            cart_product_name: cart_product_name,
                            cart_product_image: cart_product_image,
                            cart_product_price: cart_product_price,
                            cart_product_qty: cart_product_qty,
                            cart_product_quantity: cart_product_quantity,
                            _token: _token
                        },
                        success: function() {

                            swal({
                                    title: "Đã thêm sản phẩm vào giỏ hàng",
                                    text: "Bạn có thể mua hàng tiếp hoặc tới giỏ hàng để tiến hành thanh toán",
                                    showCancelButton: true,
                                    cancelButtonText: "Xem tiếp",
                                    confirmButtonClass: "btn-success",
                                    confirmButtonText: "Đi đến giỏ hàng",
                                    closeOnConfirm: false
                                },
                                function() {
                                    window.location.href = "{{ url('/gio-hang') }}";
                                });
                            show_cart();
                            // hover_cart();
                            cart_session();

                        }
                    });
                }
            });
        });
    </script>

    {{-- Add to cart onclick --}}
    <script type="text/javascript">
        function show_quick_cart() {
            $.ajax({
                url: '{{ url('/show_quick_cart') }}',
                method: 'GET',
                success: function(data) {
                    $('#show_quick_cart').html(data);
                    $('#quick-cart').modal();
                }
            });
        }

        function DeleteItemCart($session_id) {

            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: '{{ url('/del-product/') }}' + '/' + session_id,
                method: 'GET',
                data: {
                    _token: _token
                },
                success: function() {
                    // $('#show_quick_cart_alert').append(
                    //     '<p class="text text-success">Xóa sản phẩm thành công</p>');
                    // $('#show_quick_cart_alert').fadeOut(1000);
                    // show_quick_cart();
                    fetchCart();
                }
            });
        }

        $(document).on('input', '.cart_qty_update', function() {
            var quantity = $(this).val();
            var session_id = $(this).data('session_id');
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: '{{ url('/update-quick-cart') }}',
                method: 'POST',
                data: {
                    quantity: quantity,
                    session_id: session_id,
                    _token: _token
                },
                success: function() {
                    // $('#show_quick_cart_alert').append('<p class="text text-success">Cập nhập giỏ hàng thành công</p>');
                    // setTimeout(function() {
                    // 	$('#show_quick_cart_alert').fadeOut(1000);
                    // }, 1000);
                    show_quick_cart();
                }
            });
        })

		function Addtocart(id){
            var id = id;
            var cart_product_id = $('.cart_product_id_' + id).val();
            var cart_product_name = $('.cart_product_name_' + id).val();
            var cart_product_image = $('.cart_product_image_' + id).val();
            var cart_product_quantity = $('.cart_product_quantity_' + id).val();
            var cart_product_price = $('.cart_product_price_' + id).val();
            var cart_product_qty = $('.cart_product_qty_' + id).val();
            var _token = $('input[name="_token"]').val();

            if (parseInt(cart_product_qty) > parseInt(cart_product_quantity)) {
                alert('Làm ơn đặt nhỏ hơn' + cart_product_quantity);
            } else {
                $.ajax({
                    url: '{{ url('/add-cart-ajax') }}',
                    method: 'POST',
                    data: {
                        cart_product_id: cart_product_id,
                        cart_product_name: cart_product_name,
                        cart_product_image: cart_product_image,
                        cart_product_price: cart_product_price,
                        cart_product_qty: cart_product_qty,
                        cart_product_quantity: cart_product_quantity,
                        _token: _token
                    },
                    success: function(res) {
						// console.log(res.code);
						// return false;
                        if(res.code == 200){
                            $('.home_cart_'+id).css('display','none');
                            $('.rm_home_cart_'+id).css('display','inline');
                            // document.getElementsByClassName("home_cart_" + id)[0].style.display = "none";
                            // document.getElementsByClassName("rm_home_cart_" + id)[0].style.display =
                            // "inline";
                        // show_cart();
                        // hover_cart();
                        // cart_session();
                        $('#quick-cart').modal();
                        show_quick_cart();
                            fetchCart();
                        }
                        // swal({
                        // 		title: "Đã thêm sản phẩm vào giỏ hàng",
                        // 		text: "Bạn có thể mua hàng tiếp hoặc tới giỏ hàng để tiến hành thanh toán",
                        // 		showCancelButton: true,
                        // 		cancelButtonText: "Xem tiếp",
                        // 		confirmButtonClass: "btn-success",
                        // 		confirmButtonText: "Đi đến giỏ hàng",
                        // 		closeOnConfirm: false
                        // 	},
                        // 	function() {
                        // 		window.location.href = "{{ url('/gio-hang') }}";
                        // 	});
                       
                    }
                });
            }
		}
    </script>

    {{-- Fee shipping --}}
    <script type="text/javascript">
        $(document).ready(function() {
            $('.choose').on('change', function() {
                var action = $(this).attr('id');
                var ma_id = $(this).val();
                var _token = $('input[name="_token"]').val();
                var result = '';
                if (action == 'city') {
                    result = 'province';
                } else {
                    result = 'wards';
                }
                $.ajax({
                    url: '{{ url('/select-delivery-home') }}',
                    method: 'POST',
                    data: {
                        action: action,
                        ma_id: ma_id,
                        _token: _token
                    },
                    success: function(data) {
                        $('#' + result).html(data);
                    }
                });
            });
        })
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.calculate_delivery').click(function() {
                var matp = $('.city').val();
                var maqh = $('.province').val();
                var xaid = $('.wards').val();
                var _token = $('input[name="_token"]').val();
                if (matp == '' && maqh == '' && xaid == '') {
                    alert('Làm ơn chọn để tính phí vận chuyển');
                } else {
                    $.ajax({
                        url: '{{ url('/calculate-fee') }}',
                        method: 'POST',
                        data: {
                            matp: matp,
                            maqh: maqh,
                            xaid: xaid,
                            _token: _token
                        },
                        success: function() {
                            location.reload();
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>

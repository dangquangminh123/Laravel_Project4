<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>

<head>
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords"
        content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!-- bootstrap-css -->
    <link rel="stylesheet" href="{{ asset('public/backend/css/bootstrap.min.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{asset('public/frontend/images/logo.png')}}" type="image/gif" sizes="16x16">
    <!-- //bootstrap-css -->
    <!-- Custom CSS -->
    <link href="{{ asset('public/backend/css/style.css') }}" rel='stylesheet' type='text/css' />
    <link href="{{ asset('public/backend/css/style-responsive.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/backend/css/jquery.dataTables.min.css') }}" rel="stylesheet" />
    <!-- font CSS -->
    <link
        href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic'
        rel='stylesheet' type='text/css'>
    <!-- font-awesome icons -->
    <link rel="stylesheet" href="{{ asset('public/backend/css/font.css') }}" type="text/css" />
    <link href="{{ asset('public/backend/css/font-awesome.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('public/backend/css/morris.css') }}" type="text/css" />
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.3/css/jquery.dataTables.min.css" type="text/css" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">

    <!-- calendar -->
    <link rel="stylesheet" href="{{ asset('public/backend/css/monthly.css') }}">
    <link rel="stylesheet" href="{{ asset('public/backend/css/bootstrap-tagsinput.css') }}">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <!-- //calendar -->
    <!-- //font-awesome icons -->
    <script src="{{ asset('public/backend/js/jquery2.0.3.min.js') }}"></script>
    <script src="{{ asset('public/backend/js/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ asset('public/backend/js/raphael-min.js') }}"></script>
    <script src="{{ asset('public/backend/js/morris.js') }}"></script>


    <script src="//cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
</head>

<body>
    <section id="container">
        <!--header start-->
        <header class="header fixed-top clearfix">
            <!--logo start-->
            <div class="brand">
                <a href="{{ url('/dashboard') }}" class="logo">
                    {{ Session::get('admin_name') }}
                    
                </a>
                <div class="sidebar-toggle-box">
                    <div class="fa fa-bars"></div>
                </div>
            </div>
            <div class="top-nav clearfix">
                <!--search & user info start-->
                <ul class="nav pull-right top-menu">
                    <li>
                        <input type="text" class="form-control search" placeholder=" Search">
                    </li>
                    <!-- user login dropdown start-->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <img alt="" src="{{ 'public/backend/images/2.png' }}">
                            <span class="username">
                                @if(Session::get('admin_name'))
                                    {{Session::get('admin_name')}}
                                @endif
                            </span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout">
                            <li><a href="#"><i class=" fa fa-suitcase"></i>Profile</a></li>
                            <li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>
                            <li><a href="{{ url('/logout-auth') }}"><i class="fa fa-key"></i>Đăng Xuất</a></li>
                        </ul>
                    </li>
                    <!-- user login dropdown end -->

                </ul>
                <!--search & user info end-->
            </div>
        </header>
        <!--header end-->
        <!--sidebar start-->
        <aside>
            <div id="sidebar" class="nav-collapse">
                <!-- sidebar menu start-->
                <div class="leftside-navigation">
                    <ul class="sidebar-menu" id="nav-accordion">
                        <li>
                            <a class="active" href="{{ url('/dashboard') }}">
                                <i class="fa fa-dashboard"></i>
                                <span>Tổng quan</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/information') }}">
                                <i class="fa fa-circle-o"></i>
                                <span>Thông tin website</span>
                            </a>
                        </li>

                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-sliders"></i>
                                <span>Banner/Slider</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{ url('/manage-banner') }}">Liệt kê slider</a></li>
                                <li><a href="{{ url('/add-banner') }}">Thêm slider</a></li>
                            </ul>
                        </li>

                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-shopping-basket"></i>
                                <span>Đơn hàng</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{ url('/manage-order') }}">Quản lý đơn hàng</a></li>
                            </ul>
                        </li>

                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-barcode"></i>
                                <span>Mã giảm giá</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{ url('/insert-coupon') }}">Thêm mã giảm giá</a></li>
                                <li><a href="{{ url('/list-coupon') }}">Liệt kê mã giảm giá</a></li>
                            </ul>
                        </li>

                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-money"></i>
                                <span>Vận chuyển</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{ url('/delivery') }}">Quản lý vận chuyển</a></li>
                            </ul>
                        </li>

                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Danh mục sản phẩm</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{ url('/add-category-product') }}">Thêm danh mục sản phẩm</a></li>
                                <li><a href="{{ url('/all-category-product') }}">Liệt kê danh mục sản phẩm</a></li>
                            </ul>
                        </li>

                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-comments"></i>
                                <span>Bình luận</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{ url('/comment') }}">Liệt kê bình luận</a></li>
                            </ul>
                        </li>

                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Danh mục bài viết</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{ url('/add-category-post') }}">Thêm danh mục bài viết</a></li>
                                <li><a href="{{ url('/all-category-post') }}">Liệt kê danh mục bài viết</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-copyright"></i>
                                <span>Thương hiệu sản phẩm</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{ url('/add-brand-product') }}">Thêm thương hiệu sản phẩm</a></li>
                                <li><a href="{{ url('/all-brand-product') }}">Liệt kê thương hiệu sản phẩm</a></li>
                            </ul>
                        </li>


                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-product-hunt"></i>
                                <span>Sản phẩm</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{ url('/add-product') }}">Thêm sản phẩm</a></li>
                                <li><a href="{{ url('/all-product') }}">Liệt kê sản phẩm</a></li>
                            </ul>
                        </li>

                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Video</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{ url('/video') }}">Thêm video</a></li>
                            </ul>
                        </li>

                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-newspaper-o"></i>
                                <span>Bài viết</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{ url('/add-post') }}">Thêm bài viết</a></li>
                                <li><a href="{{ url('/all-post') }}">Liệt kê bài viết</a></li>
                            </ul>
                        </li>
                        @impersonate
                            <li class="sub-menu">
                                <span><a href="{{ url('/impersonate-destroy') }}">Stop chuyển quyền</a></span>
                            </li>
                        @endimpersonate
                        @hasrole(['admin', 'author'])
                            <li class="sub-menu">
                                <a href="javascript:;">
                                    <i class="fa fa-user-md"></i>
                                    <span>User</span>
                                </a>
                                <ul class="sub">
                                    <li><a href="{{ url('/add-users') }}">Thêm user</a></li>
                                    <li><a href="{{ url('/users') }}">Liệt kê user</a></li>
                                </ul>
                            </li>
                        @endhasrole
                    </ul>
                </div>
                <!-- sidebar menu end-->
            </div>
        </aside>
        <!--sidebar end-->
        <!--main content start-->
        <section id="main-content">
            <section class="wrapper">
                @yield('admin_content')
            </section>
            <!-- footer -->
            <div class="footer">
                <div class="wthree-copyright">
                    <p>© 2017 Visitors. All rights reserved | Design by <a href="http://w3layouts.com">W3layouts</a>
                    </p>
                </div>
            </div>
            <!-- / footer -->
        </section>
        <!--main content end-->
    </section>
    <script src="{{ asset('public/backend/js/bootstrap.js') }}"></script>
    <script src="{{ asset('public/backend/js/jquery.dcjqaccordion.2.7.js') }}"></script>
    <script src="{{ asset('public/backend/js/scripts.js') }}"></script>
    <script src="{{ asset('public/backend/js/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('public/backend/js/jquery.nicescroll.js') }}"></script>
    <script src="{{ asset('public/backend/js/jquery.scrollTo.js') }}"></script>
    <script src="{{ asset('public/backend/ckeditor/ckeditor.js') }}"></script>
    {{-- <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script> --}}
    <script src="{{ asset('public/backend/js/jquery2.0.3.min.js') }}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <script src="{{ asset('public/backend/js/simple.money.format.js') }}"></script>
    <script src="{{ asset('public/backend/js/jquery.form-validator.min.js') }}"></script>
    <script src="{{ asset('public/backend/js/raphael-min.js') }}"></script>
    <script src="{{ asset('public/backend/js/jquery.dataTables.min.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    {{-- <script src="{{ asset('public/backend/js/morris.js') }}"></script> --}}
    <script>

        CKEDITOR.replace('ckeditor');
        CKEDITOR.replace('ckeditor1');
        CKEDITOR.replace('ckeditor2');
        CKEDITOR.replace('ckeditor3');
    
    </script>
    <script type="text/javascript">
        $('.btn-delete-document').click(function() {
            var product_id = $(this).data('document_id');
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{ url('/delete-document') }}",
                method: "POST",
                data: {
                    _token: _token,
                    product_id: product_id
                },
                success: function(data) {
                    alert('Xóa file thành công');
                    location.reload();
                }
            });
        });
    </script>
    <script type="text/javascript">
        $('.comment_duyet_btn').click(function() {
            var comment_status = $(this).data('comment_status');
            var comment_id = $(this).data('comment_id');
            var comment_product_id = $(this).attr('id');
            if (comment_status == 1) {
                var alert = 'Duyệt thành công';
            } else {
                var alert = 'Bỏ duyệt thành công';
            }
            $.ajax({
                url: "{{ url('/allow-comment') }}",
                method: "POST",

                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    comment_status: comment_status,
                    comment_id: comment_id,
                    comment_product_id: comment_product_id
                },
                success: function(data) {
                    location.reload();
                    $('#notify_comment').html('<span class="text text-alert">' + alert + '</span>');
                }
            });
        });

        $('.btn-reply-comment').click(function() {
            var comment_id = $(this).data('comment_id');
            var comment = $('.reply_comment_' + comment_id).val();

            var comment_product_id = $(this).data('product_id');
            $.ajax({
                url: "{{ url('/reply-comment') }}",
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    comment: comment,
                    comment_id: comment_id,
                    comment_product_id: comment_product_id
                },
                success: function(data) {
                    location.reload();
                    $('.reply_comment' + comment_id).val('');
                    $('#notify_comment').html(
                        '<span class="text text-alert">Đã phản hồi bình luận</span>');
                }
            });
        })
    </script>

    <script type="text/javascript">
        $('.price_format').simpleMoneyFormat();
    </script>
    {{-- Sắp xếp --}}
    <script type="text/javascript">
        $(document).ready(function() {
            $('#category_order').sortable({
                placeholder: 'ui-state-highlight',
                update: function(event, ui) {
                    var page_id_array = new Array();
                    var _token = $('input[name="_token"]').val();
                    $('#category_order tr').each(function() {
                        page_id_array.push($(this).attr("id"));
                    });

                    $.ajax({
                        url: "{{ url('/arrange-category') }}",
                        method: "POST",
                        data: {
                            page_id_array: page_id_array,
                            _token: _token
                        },
                        success: function(data) {
                            alert(data);
                        }
                    });
                }
            });
        });
    </script>

    {{-- Slug --}}
    <script type="text/javascript">
        function ChangeToSlug(){
            var slug;
            slug = document.getElementById("slug").value;
            slug = slug.toLowerCase();
            //Đổi ký tự có dấu thành không dâu
            slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẵ|ặ|â|ầ|ấ|ẩ|ẫ|ậ/gi, 'a');
            slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ễ|ệ/gi, 'e');
            slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
            slug = slug.replace(/ủ|ũ|ụ|ù|ú|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
            slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
            slug = slug.replace(/đ/gi, 'd');
            //Xóa các ký tự đặc biệt
            slug = slug.replace(/\‘|\~|\!|\@|\#|\$|\%|\^|\&|\*|\(|\)|\-|\+|\|\.|\/|\?|\<|\>|\'|\"|\:|\;|_/gi, '');
            //Đổi khoản trắng thành ký tự gạch ngang
            slug = slug.replace(/ /gi, "-");
            //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
            //Phòng trường hợp người nhập vào quá nhiều ký tự gạch trắng
            slug = slug.replace(/\-\-\-\-\-\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-/gi, '-');
            //Xóa các ký tự gạch ngang ở đầu và cuối
            slug = '@' + slug + '@';
            slug = slug.replace(/\@\-|\-\@|\@/gi, '');
            //In ra dấu textbox có id "slug"
            document.getElementById("convert_slug").value = slug;
        }
    </script> 

    {{-- Preview Hình --}}
    <script type="text/javascript">
        function previewFile(input){
            var file = $(".image-preview").get(0).files[0];
            if(file){
                var reader = new FileReader();

                reader.onload = function(){
                    $("#previewImg").attr("src",reader.result);
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
{{-- Thư viện phân trang và sắp xếp sản phẩm --}}
    <script type="text/javascript">
        let table = new DataTable('#myTable');
    </script>

    {{-- Coupon --}}
    <script type="text/javascript">
        $(function() {
            $("#start_coupon").datepicker({
                prevText: "Tháng trước",
                nextText: "Tháng sau",
                dateFormat: "dd/mm/yy",
                dayNamesMin: ["Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7", "Chủ nhật"],
                duration: "slow"
            });
            $("#end_coupon").datepicker({
                prevText: "Tháng trước",
                nextText: "Tháng sau",
                dateFormat: "dd/mm/yy",
                dayNamesMin: ["Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7", "Chủ nhật"],
                duration: "slow"
            });
        });
    </script>

    {{-- Icons --}}
    <script type="text/javascript">
        list_nut();
        function list_nut(){
            $.ajax({
                url: "{{ url('/list-nut')}}",
                method: "GET",
                success: function(data) {
                   $('#list_nut').html(data)
                }
            });
        }

        function delete_icons(id){
            $.ajax({
                url: "{{ url('/delete-icons')}}",
                method: "GET",
                data:{id:id},
                success: function(data) {
                    list_nut();
                    list_doitac();
                }
            });
        }

        $('.add-nut').click(function(){
            var name = $('#name').val();
            var link = $('#link').val();
            var image = $('#image_nut')[0].files[0];
            var form_data = new FormData();

            form_data.append('file',image);
            form_data.append('name',name);
            form_data.append('link',link);

            $.ajax({
                url: "{{ url('/add-nut')}}",
                method: "POST",
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },

                contentType: false,
                cache:false,
                processData: false,
                data:form_data,
                success: function(data) {
                    alert('Thêm nút thành công');
                    list_nut();
                    $('#name').val(''); 
                    $('#link').val('');   
                }
            });
        })
    </script>

{{-- Đối tác --}}
    <script type="text/javascript">

        list_doitac();
        function list_doitac(){
            $.ajax({
                url: "{{ url('/list-doitac')}}",
                method: "GET",
                success: function(data) {
                   $('#list_doitac').html(data)
                }
            });
        }

   

        $('.add-doitac').click(function(){
            var name = $('#name_doitac').val();
            var link = $('#link_doitac').val();
            var image = $('#image_doitac')[0].files[0];
            var form_data = new FormData();

            form_data.append('file',image);
            form_data.append('name',name);
            form_data.append('link',link);

            $.ajax({
                url: "{{ url('/add-doitac')}}",
                method: "POST",
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },

                contentType: false,
                cache:false,
                processData: false,
                data:form_data,

                success: function(data) {
                    alert('Thêm đối tác thành công');
                    list_nut();
                    $('#name').val(''); 
                    $('#link').val('');   
                }
            });
        })
    </script>

    {{-- Calendar --}}
    <script type="text/javascript">
        $(function() {
            $("#datepicker").datepicker({
                prevText: "Tháng trước",
                nextText: "Tháng sau",
                dateFormat: "yy-mm-dd",
                dayNamesMin: ["Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7", "Chủ nhật"],
                duration: "slow"
            });
            $("#datepicker2").datepicker({
                prevText: "Tháng trước",
                nextText: "Tháng sau",
                dateFormat: "yy-mm-dd",
                dayNamesMin: ["Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7", "Chủ nhật"],
                duration: "slow"
            });
        });
    </script>

    {{-- Biểu đồ --}}
    <script type="text/javascript">
        $(document).ready(function() {
            chart60daysorder();

            var chart = new Morris.Bar({
                element: 'myfirstchart',
                data: [{
                    "period": "2020-10-31",
                    "order": 1
                }, {
                    "period": "2020-11-01",
                    "order": 1
                }, {
                    "period": "2020-11-06",
                    "order": 1
                }, {
                    "period": "2020-11-07",
                    "order": 6
                }],

                lineColors: ['#819C79', '#fc8710', '#FF6541', '#A4ADD3', '#766B56'],
                pointFillColors: ['#ffffff'],
                pointStrokeColors: ['black'],
                fillOpacity: 0.6,
                hideHover: 'auto',
                parseTime: false,
                xkey: 'period',
                ykeys: ['order', 'sales', 'profit', 'quantity'],
                behaveLikeLine: true,
                labels: ['đơn hàng', 'doanh số', 'lợi nhuận', 'số lượng']
            });

            function chart60daysorder() {
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{ url('/days-order') }}",
                    method: "POST",
                    dataType: "JSON",
                    data: {
                        _token: _token
                    },
                    success: function(data) {
                        chart.setData(data);
                    }
                });
            }

            $('.dashboard-filter').change(function() {
                var dashboard_value = $(this).val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{ url('/dashboard-filter') }}",
                    method: "POST",
                    dataType: "JSON",
                    data: {
                        dashboard_value: dashboard_value,
                        _token: _token
                    },
                    success: function(data) {
                        chart.setData(data);
                    }
                });
            })

            $('#btn-dashboard-filter').click(function() {
                var _token = $('input[name="_token"]').val();
                var from_date = $('#datepicker').val();
                var to_date = $('#datepicker2').val();
                $.ajax({
                    url: "{{ url('/filter-by-date') }}",
                    method: "POST",
                    dataType: "JSON",
                    data: {
                        from_date: from_date,
                        to_date: to_date,
                        _token: _token
                    },
                    success: function(data) {
                        chart.setData(data);
                    }
                });
            });
        });
    </script>

    {{-- Thống kế admin --}}
    <script type="text/javascript">
        $(document).ready(function() {
            var colorDanger = "#FF1744";
            Morris.Donut({
                element: 'donut',
                resize: true,
                colors: [
                    '#ce616a',
                    '#61a1ce',
                    '#ce8f61',
                    '#f5b942',
                    '#4842f5'
                ],
                data: [
                    {label: "Sản Phẩm",value: `<?php echo $app_product; ?>`},
                    {label: "Bài Viết",value: `<?php echo $app_post; ?>`},
                    {label: "Đơn Hàng",value: `<?php echo $app_order; ?>`},
                    {label: "Video",value: `<?php echo $app_video; ?>`},
                    {label: "Khách Hàng",value: `<?php echo $app_customer; ?>`},
                ]
            });
        });
    </script>

{{-- Video --}}
    <script type="text/javascript">
        $(document).ready(function() {
            load_video();

            function load_video() {
                $.ajax({
                    url: "{{ url('/select-video') }}",
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        $('#video_load').html(data);
                    }
                });
            }

            $(document).on('click', '.btn-add-video', function() {
                var video_title = $('.video_title').val();
                var video_slug = $('.video_slug').val();
                var video_desc = $('.video_desc').val();
                var video_link = $('.video_link').val();
                var _token = $('input[name="_token"]').val();

                var form_data = new FormData();
                form_data.append("file", document.getElementById('file_img_video').files[0]);
                form_data.append("video_title", video_title);
                form_data.append("video_slug", video_slug);
                form_data.append("video_desc", video_desc);
                form_data.append("video_link", video_link);
                $.ajax({
                    url: "{{ url('/insert-video') }}",
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: form_data,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        load_video();
                        $('#notify').html(
                            '<span class="text text-success">Thêm video thành công</span');
                    }
                });
            });

            $(document).on('click', '.btn-delete-video', function() {
                var video_id = $(this).data('video_id');
                if (confirm('Bạn muốn xóa video này không?')) {
                    $.ajax({
                        url: "{{ url('/delete-video') }}",
                        method: "POST",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            video_id: video_id
                        },
                        success: function(data) {
                            load_video();
                            $('#notify').html(
                                '<span class="text text-success">Xóa video thành công</span>'
                            );
                        }
                    });
                }
            });

            $(document).on('blur', '.video_edit', function() {
                var video_type = $(this).data('video_type');
                var video_id = $(this).data('video_id');
                if (video_type == 'video_title') {
                    var video_edit = $('#' + video_type + '_' + video_id).text();
                    var video_check = video_type;
                } else if (video_type == 'video_desc') {
                    var video_edit = $('#' + video_type + '_' + video_id).text();
                    var video_check = video_type;
                } else if (video_type == 'video_link') {
                    var video_edit = $('#' + video_type + '_' + video_id).text();
                    var video_check = video_type;
                } else {
                    var video_edit = $('#' + video_type + '_' + video_id).text();
                    var video_check = video_type;
                }
                $.ajax({
                    url: "{{ url('/update-video') }}",
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        video_check: video_check,
                        video_edit: video_edit,
                        video_id: video_id
                    },
                    success: function(data) {
                        load_video();
                        $('#notify').html(
                            '<span class="text text-success">Cập nhập video thành công</span>'
                        );
                    }
                });
            });


            //cập nhập hình ảnh video
            $(document).on('change', '.file_img_video', function() {
                var video_id = $(this).data('video_id');
                var image = document.getElementById('file-video-' + video_id).files[0];
                var form_data = new FormData();

                form_data.append("file", document.getElementById('file-video-' + video_id).files[0]);
                form_data.append("video_id", video_id);
                $.ajax({
                    url: "{{ url('/update-video-image') }}",
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: form_data,

                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        load_video();
                        $('#notify').html(
                            '<span class="text text-success">Cập nhập hình ảnh video thành công</span>'
                        );
                    }
                });
            });

        });
    </script>

{{-- Thư viện hình ảnh  --}}
    <script type="text/javascript">
       
            load_gallery();

            function load_gallery() {
                var pro_id = $('.pro_id').val();
                var _token = $('input[name="_token"]').val();

                $.ajax({
                    url: "{{ url('/select-gallery') }}",
                    method: "POST",
                    data: {
                        pro_id: pro_id,
                        _token: _token
                    },
                    success: function(data) {
                        $('#gallery_load').html(data);
                    }
                });
            }

            $('#file').change(function() {
                var error = '';
                var files = $('#file')[0].files;

                if (files.length > 5) {
                    error += '<p>Bạn chỉ được phép tối là 5 hình ảnh</p>';
                } else if (files.length == '') {
                    error += '<p>Bạn không được phép bỏ trống ảnh </p>';
                } else if (files.size > 2000000) {
                    error += '<p>Bạn không được tải hình ảnh lớn hơn 2MB </p>';
                }

                if (error == '') {

                } else {
                    $('#file').val('');
                    $('#error_gallery').html('<span class="text-danger">' + error + '</span>');
                    return false;
                }
            });

            $(document).on('blur', '.edit_gal_name', function() {

                var gal_id = $(this).data('gal_id');
                var gal_text = $(this).text();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{ url('/update-gallery-name') }}",
                    method: "POST",
                    data: {
                        gal_id: gal_id,
                        gal_text: gal_text,
                        _token: _token
                    },
                    success: function(data) {
                        load_gallery();
                        $('#error_gallery').html(
                            '<span class="text-danger">Cập nhập tên hình ảnh thành công</span>'
                        );
                    }
                });
            });

            $(document).on('click', '.delete-gallery', function() {
                var gal_id = $(this).data('gal_id');
                var _token = $('input[name="_token"]').val();
                if (confirm('Bạn có chắc muốn xóa hình ảnh này không?')) {

                    $.ajax({
                        url: "{{ url('/delete-gallery') }}",
                        method: "POST",
                        data: {
                            gal_id: gal_id,
                            _token: _token
                        },
                        success: function(data) {
                            load_gallery();
                            $('#error_gallery').html(
                                '<span class="text-danger">Xóa hình ảnh thành công</span>');
                        }
                    });
                }
            });

            $(document).on('change', '.file_image', function() {
                var gal_id = $(this).data('gal_id');
                var image = document.getElementById('file-' + gal_id).files[0];
                var form_data = new FormData();

                form_data.append("file", document.getElementById('file-' + gal_id).files[0]);
                form_data.append("gal_id", gal_id);
                $.ajax({
                    url: "{{ url('/update-gallery') }}",
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: form_data,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        load_gallery();
                        $('#error_gallery').html(
                            '<span class="text-danger">Cập nhập hình ảnh thành công</span>');
                    }
                });
            });
    
    </script>

    {{-- Đơn hàng --}}
    <script type="text/javascript">
        $('.update_quantity_order').click(function() {
            var order_product_id = $(this).data('product_id');
            var order_qty = $('.order_qty_' + order_product_id).val();
            var order_code = $('.order_code').val();
            var _token = $('input[name="_token"]').val();

            $.ajax({
                url: '{{ url('/update-qty') }}',
                method: 'POST',
                data: {
                    _token: _token,
                    order_product_id: order_product_id,
                    order_qty: order_qty,
                    order_code: order_code
                },
                success: function(data) {
                    alert('Cập nhập số lượng thành công');
                    location.reload();
                }
            });
        });
    </script>

    <script type="text/javascript">
        $('.order_details').change(function() {
            var order_status = $(this).val();
            var order_id = $(this).children(":selected").attr("id");
            var _token = $('input[name="_token"]').val();

            //Lấy ra số lượng
            quantity = [];
            $("input[name='product_sales_quantity']").each(function() {
                quantity.push($(this).val());
            });

            //Lấy ra product id
            order_product_id = [];
            $("input[name='order_product_id']").each(function() {
                order_product_id.push($(this).val());
            });
            j = 0;
            for (i = 0; i < order_product_id.length; i++) {
                //Số lượng khách mua
                var order_qty = $('.order_qty_' + order_product_id[i]).val();
                //Số lượng tồn
                var order_qty_storage = $('.order_qty_storage_' + order_product_id[i]).val();
                if (parseInt(order_qty) > parseInt(order_qty_storage)) {
                    j = j + 1;
                    if (j == 1) {
                        alert('Số lượng bán trong kho không đủ');
                    }
                    $('.color_qty_' + order_product_id[i]).css('background', '#000');
                }
            }
            if (j == 0) {
                $.ajax({
                    url: '{{ url('/update-order-qty') }}',
                    method: 'POST',
                    data: {
                        _token: _token,
                        order_status: order_status,
                        order_id: order_id,
                        quantity: quantity,
                        order_product_id: order_product_id
                    },
                    success: function(data) {
                        alert('Thay đổi tình trạng đơn hàng thành công');
                        location.reload();
                    }
                });
            }

        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            fetch_delivery();
            //Fetch
            function fetch_delivery() {
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: '{{ url('/select-feeship') }}',
                    method: 'POST',
                    data: {
                        _token: _token
                    },
                    success: function(data) {
                        $('#load_delivery').html(data);
                    }
                });
            }
            //Updated
            $(document).on('blur', '.fee_feeship_edit', function() {
                // alert('Đã click vào')
                var feeship_id = $(this).data('feeship_id');
                var fee_value = $(this).text();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: '{{ url('/update-delivery') }}',
                    method: 'POST',
                    data: {
                        feeship_id: feeship_id,
                        fee_value: fee_value,
                        _token: _token
                    },
                    success: function(data) {
                        fetch_delivery();
                    }
                });
            });
            //add
            $('.add_delivery').click(function() {
                var city = $('.city').val();
                var province = $('.province').val();
                var wards = $('.wards').val();
                var fee_ship = $('.fee_ship').val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: '{{ url('/insert-delivery') }}',
                    method: 'POST',
                    data: {
                        city: city,
                        province: province,
                        _token: _token,
                        wards: wards,
                        fee_ship: fee_ship
                    },
                    success: function(data) {
                        fetch_delivery();
                    }
                });
            });
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
                    url: '{{ url('/select-delivery') }}',
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
            //BOX BUTTON SHOW AND CLOSE
            jQuery('.small-graph-box').hover(function() {
                jQuery(this).find('.box-button').fadeIn('fast');
            }, function() {
                jQuery(this).find('.box-button').fadeOut('fast');
            });
            jQuery('.small-graph-box .box-close').click(function() {
                jQuery(this).closest('.small-graph-box').fadeOut(200);
                return false;
            });

            //CHARTS
            function gd(year, day, month) {
                return new Date(year, month - 1, day).getTime();
            }

            graphArea2 = Morris.Area({
                element: 'hero-area',
                padding: 10,
                behaveLikeLine: true,
                gridEnabled: false,
                gridLineColor: '#dddddd',
                axes: true,
                resize: true,
                smooth: true,
                pointSize: 0,
                lineWidth: 0,
                fillOpacity: 0.85,
                data: [{
                        period: '2015 Q1',
                        iphone: 2668,
                        ipad: null,
                        itouch: 2649
                    },
                    {
                        period: '2015 Q2',
                        iphone: 15780,
                        ipad: 13799,
                        itouch: 12051
                    },
                    {
                        period: '2015 Q3',
                        iphone: 12920,
                        ipad: 10975,
                        itouch: 9910
                    },
                    {
                        period: '2015 Q4',
                        iphone: 8770,
                        ipad: 6600,
                        itouch: 6695
                    },
                    {
                        period: '2016 Q1',
                        iphone: 10820,
                        ipad: 10924,
                        itouch: 12300
                    },
                    {
                        period: '2016 Q2',
                        iphone: 9680,
                        ipad: 9010,
                        itouch: 7891
                    },
                    {
                        period: '2016 Q3',
                        iphone: 4830,
                        ipad: 3805,
                        itouch: 1598
                    },
                    {
                        period: '2016 Q4',
                        iphone: 15083,
                        ipad: 8977,
                        itouch: 5185
                    },
                    {
                        period: '2017 Q1',
                        iphone: 10697,
                        ipad: 4470,
                        itouch: 2038
                    },

                ],
                lineColors: ['#eb6f6f', '#926383', '#eb6f6f'],
                xkey: 'period',
                redraw: true,
                ykeys: ['iphone', 'ipad', 'itouch'],
                labels: ['All Visitors', 'Returning Visitors', 'Unique Visitors'],
                pointSize: 2,
                hideHover: 'auto',
                resize: true
            });


        });
    </script>
    <!-- calendar -->
    <script type="text/javascript" src="<?php echo e(asset('public/backend/js/monthly.js')); ?>"></script>
    <script type="text/javascript">
        $(window).load(function() {

            $('#mycalendar').monthly({
                mode: 'event',

            });

            $('#mycalendar2').monthly({
                mode: 'picker',
                target: '#mytarget',
                setWidth: '250px',
                startHidden: true,
                showTrigger: '#mytarget',
                stylePast: true,
                disablePast: true
            });

            switch (window.location.protocol) {
                case 'http:':
                case 'https:':
                    // running on a server, should be good.
                    break;
                case 'file:':
                    alert('Just a heads-up, events will not work when run locally.');
            }

        });
    </script>
    <!-- //calendar -->
</body>

</html>

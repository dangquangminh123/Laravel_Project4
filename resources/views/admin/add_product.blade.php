@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm sản phẩm
                        </header>
                       
                        <?php 
                            $message = Session::get('message');
                            if($message) {
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
	                    ?>
                        <div class="panel-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="position-center">
                                <form role="form" autocomplete="off" action="{{url('/save-product')}}" method="post" enctype="multipart/form-data">
                                    {{csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên sản phẩm</label>
                                    <input type="text" name="product_name" required class="form-control" id="exampleInputEmail1" 
                                    placeholder="Nhập tên sản phẩm">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số lượng sản phẩm</label>
                                    <input type="number" name="product_quantity" required class="form-control" id="exampleInputEmail1" 
                                    placeholder="Nhập số lượng sản phẩm">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">slug sản phẩm</label>
                                    <input type="text" name="product_slug" required class="form-control"
                                    placeholder="Nhập slug sản phẩm">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giá bán sản phẩm</label>
                                    <input type="text" data-validation="number" required name="product_price" class="form-control price_format" id="" 
                                    placeholder="Nhập giá bán sản phẩm">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giá gốc</label>
                                    <input type="text" data-validation="number" required name="price_cost" class="form-control price_format" id=""
                                    placeholder="Nhập giá gốc sản phẩm">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                                    <input type="file" name="product_image" required onchange="previewFile(this);" required class="form-control image-preview" id="exampleInputEmail1" 
                                    placeholder="hình ảnh sản phẩm">

                                    <img id="previewImg" src="https://www.freeiconspng.com/thumbs/no-image-icon/no-image-icon-6.png" width="30%"/>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tài liệu</label>
                                    <input type="file" name="document" class="form-control" id="exampleInputEmail1" 
                                    placeholder="Tài liệu">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                                    <textarea style="resize: none" rows="8" required type="password" name="product_desc" class="form-control" 
                                    id="ckeditor1" placeholder="Nhập mô tả sản phẩm"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nội dung sản phẩm</label>
                                    <textarea style="resize: none" rows="8" required type="password" name="product_content" class="form-control"
                                    id="ckeditor" placeholder="Nhập nội dung sản phẩm"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Tags sản phẩm</label>
                                    <input type="text" data-role="tagsinput" required name="product_tags" class="form-control"
                                    placeholder="Tags sản phẩm"/>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Danh mục sản phẩm</label>
                                    <select name="product_cate" class="form-control input-sm m-bot15">
                                       @foreach($cate_product as $key => $cate)
                                            @if($cate->category_parent == 0)
                                                <option style="font-size: 15px" value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                                @foreach($cate_product as $key => $cate_sub)
                                                    @if($cate_sub->category_parent != 0 && $cate_sub->category_parent == $cate->category_id)
                                                    <option style="color: red; font-size: 15px" value="{{$cate_sub->category_id}}">{{$cate_sub->category_name}}</option>
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Thương hiệu sản phẩm</label>
                                    <select name="product_brand" class="form-control input-sm m-bot15">
                                        @foreach($brand_product as $key => $brand)
                                            <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                         @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Hiển Thị</label>
                                    <select name="product_status" required class="form-control input-sm m-bot15">
                                        <option value="0">Ẩn</option>
                                        <option value="1">Hiển Thị</option>

                                    </select>
                                </div>
                                <button type="submit" name="add_product" class="btn btn-info">Thêm sản phẩm</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>
        </div>
@endsection
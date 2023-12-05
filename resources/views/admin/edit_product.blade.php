@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Cập nhập sản phẩm
                        </header>
                        <?php 
                            $message = Session::get('message');
                            if($message) {
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
	                    ?>
                        <div class="panel-body">
                            <div class="position-center">
                            @foreach($edit_product as $key => $pro)
                                <form role="form" action="{{url('/update-product/'.$pro->product_id)}}" method="post" enctype="multipart/form-data">
                                        {{csrf_field() }}
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tên sản phẩm</label>
                                        <input type="text" value="{{$pro->product_name}}" name="product_name" class="form-control" id="exampleInputEmail1" 
                                        placeholder="Nhập tên sản phẩm">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Số lượng sản phẩm</label>
                                        <input type="number" value="{{$pro->product_quantity}}" name="product_quantity" class="form-control" id="exampleInputEmail1" 
                                        placeholder="Nhập số lượng sản phẩm">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">slug sản phẩm</label>
                                        <input type="text" data-validation="number" value="{{$pro->product_slug}}" name="product_slug" class="form-control" id="exampleInputEmail1" 
                                        placeholder="Nhập slug sản phẩm">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Giá bán sản phẩm</label>
                                        <input type="text" data-validation="number" value="{{$pro->product_price}}" name="product_price" class="form-control price_format" id="exampleInputEmail1" 
                                        placeholder="Nhập giá bán sản phẩm">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Giá gốc sản phẩm</label>
                                        <input type="text" value="{{$pro->price_cost}}" name="price_cost" class="form-control price_format" id="exampleInputEmail1" 
                                        placeholder="Nhập giá gốc sản phẩm">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                                        <input type="file" name="product_image" onchange="previewFile(this);" class="form-control image-preview" id="exampleInputEmail1" 
                                        placeholder="hình ảnh sản phẩm">
                                        
                                        <img id="previewImg" src="{{url('public/uploads/product/'.$pro->product_image)}}" height="100" width="100">
                                    </div>
                                    <style type="text/css">
                                        p.cofile {
                                            text-align: left;
                                            font-size: 16px;
                                            margin: 5px 0px;
                                        }
                                    </style>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tài liệu</label>
                                        <input type="file" name="document" class="form-control" id="exampleInputEmail1" 
                                        placeholder="Tài liệu">
                                        @if($pro->product_file)
                                            <p class="cofile"><a target="_blank" href="{{asset('public/uploads/document/'.$pro->product_file)}}">
                                                Xem file</a>
                                                <button type="button" data-document_id="{{$pro->product_id}}" class="btn btn-sm btn-danger btn-delete-document">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </p>
                                        @else
                                            <p class="cofile">Không file</p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                                        <textarea style="resize: none" rows="8" type="password" name="product_desc" class="form-control" id="exampleInputPassword1" 
                                        placeholder="Nhập mô tả sản phẩm">{{$pro->product_desc}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Nội dung sản phẩm</label>
                                        <textarea style="resize: none" rows="8" type="password" name="product_content" class="form-control" id="exampleInputPassword1" 
                                        placeholder="Nhập nội dung sản phẩm">{{$pro->product_content}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Danh mục sản phẩm</label>
                                        <select name="product_cate" class="form-control input-sm m-bot15">
                                        @foreach($cate_product as $key => $cate)
                                            @if($cate->category_id == $pro->category_id)
                                                <option selected value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                            @else
                                                <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                            @endif
                                        @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Tags sản phẩm</label>
                                        <input type="text" data-role="tagsinput" value="{{$pro->product_tags}}" name="product_tags" class="form-control"
                                        placeholder="Tags sản phẩm"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Thương hiệu sản phẩm</label>
                                        <select name="product_brand" class="form-control input-sm m-bot15">
                                            @foreach($brand_product as $key => $brand)
                                                @if($brand->brand_id==$pro->brand_id)
                                                    <option selected value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                                @else
                                                    <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Hiển Thị</label>
                                        <select name="product_status" class="form-control input-sm m-bot15">
                                            <option value="0">Ẩn</option>
                                            <option value="1">Hiển Thị</option>

                                        </select>
                                    </div>
                                    <button type="submit" name="add_product" class="btn btn-info">Cập nhập sản phẩm</button>
                                </form>
                            @endforeach
                            </div>

                        </div>
                    </section>

            </div>
        </div>
@endsection
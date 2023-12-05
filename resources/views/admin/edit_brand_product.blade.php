@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Cập nhật thương hiệu sản phẩm
                        </header>
                        <?php 
                            $message = Session::get('message');
                            if($message) {
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
	                    ?>
                        <div class="panel-body">
                             @foreach($edit_brand_product as $key => $edit_value)
                            <div class="position-center">
                                <form role="form" action="{{url('/update-brand-product/'.$edit_value->brand_id)}}" method="post">
                                   {{csrf_field() }}
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tên thương hiệu</label>
                                        <input type="text" value="{{ $edit_value->brand_name}}" name="brand_product_name" class="form-control" id="exampleInputEmail1" 
                                        placeholder="Nhập Tên Danh Mục">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Slug thương hiệu</label>
                                        <input type="text" value="{{ $edit_value->brand_slug}}" name="brand_product_slug" class="form-control" id="exampleInputEmail1" 
                                        placeholder="Nhập Tên Danh Mục">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Mô tả thương hiệu</label>
                                        <textarea style="resize: none" rows="8" type="password" name="brand_product_desc" class="form-control" id="exampleInputPassword1" 
                                        placeholder="Nhập Mô Tả Danh Mục">{{ $edit_value->brand_desc}}</textarea>
                                    </div>
                                    <button type="submit" name="update_brand_product" class="btn btn-info">Cập nhập thương hiệu</button>
                                </form>
                            </div>
                            @endforeach 

                            {{-- Cách 2 --}}
                            {{-- <div class="position-center">
                                <form role="form" action="{{url('/update-brand-product/'.$edit_brand_product->brand_id)}}" method="post">
                                    {{csrf_field() }}
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tên thương hiệu</label>
                                        <input type="text" value="{{ $edit_brand_product->brand_name}}" name="brand_product_name" class="form-control" id="exampleInputEmail1" 
                                        placeholder="Nhập Tên Danh Mục">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Slug thương hiệu</label>
                                        <input type="text" value="{{ $edit_brand_product->brand_slug}}" name="brand_slug" class="form-control" id="exampleInputEmail1" 
                                        placeholder="Nhập Tên Danh Mục">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Mô tả thương hiệu</label>
                                        <textarea style="resize: none" rows="8" type="password" name="brand_product_desc" class="form-control" id="exampleInputPassword1" 
                                        placeholder="Nhập Mô Tả Danh Mục">{{ $edit_brand_product->brand_desc}}</textarea>
                                    </div>
                                    <button type="submit" name="update_brand_product" class="btn btn-info">Cập nhập thương hiệu</button>
                                </form>
                            </div> --}}
                        </div>
                    </section>
            </div>
        </div>
@endsection
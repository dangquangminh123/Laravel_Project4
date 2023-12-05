@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm danh mục sản phẩm
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
                                <form role="form" action="{{url('/save-category-product')}}" method="post">
                                    {{csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên Danh Mục</label>
                                    <input type="text" name="category_product_name" class="form-control" id="slug" onkeyup="ChangeToSlug();"
                                    placeholder="Nhập Tên Danh Mục">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Slug danh mục</label>
                                    <input type="text" name="slug_category_product" class="form-control" id="convert_slug" 
                                    placeholder="Slug danh Mục">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả danh mục</label>
                                    <textarea style="resize: none" rows="8" type="password" name="category_product_desc" class="form-control" id="exampleInputPassword1" 
                                    placeholder="Nhập Mô Tả Danh Mục"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Từ khóa danh mục</label>
                                    <textarea style="resize: none" rows="8" type="password" name="category_product_keywords" class="form-control" id="exampleInputPassword1" 
                                    placeholder="Nhập từ khóa danh mục"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Thuộc danh mục</label>
                                    <select name="category_parent" class="form-control input-sm m-bot15">
                                        <option value="0">---ROOT----</option>
                                        @foreach($category as $key => $val)
                                            <option value="{{$val->category_id}}">
                                            @php
                                                $str = '';
                                                for($i =0; $i < $val->level; $i++){
                                                    echo $str;
                                                    $str.= '-- ';
                                                }
                                            @endphp
                                            {{$val->category_name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Hiển Thị</label>
                                    <select name="category_product_status" class="form-control input-sm m-bot15">
                                        <option value="0">Ẩn</option>
                                        <option value="1">Hiển Thị</option>
                                    </select>
                                </div>
                                <button type="submit" name="add_category_product" class="btn btn-info">Thêm Danh Mục</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>
 
        </div>
@endsection
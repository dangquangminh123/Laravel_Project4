@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Cập nhật danh mục sản phẩm
                        </header>
                        <?php 
                            $message = Session::get('message');
                            if($message) {
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
	                    ?>
                        <div class="panel-body">
                            @foreach($edit_category_product as $key => $edit_value)
                            <div class="position-center">
                                <form role="form" action="{{url('/update-category-product/'.$edit_value->category_id)}}" method="post">
                                    {{csrf_field() }}
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tên Danh Mục</label>
                                        <input type="text" value="{{ $edit_value->category_name}}" name="category_product_name" class="form-control" id="exampleInputEmail1" 
                                        placeholder="Nhập Tên Danh Mục">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Slug danh mục</label>
                                        <input type="text" value="{{$edit_value->slug_category_product}}" name="slug_category_product" class="form-control" id="exampleInputEmail1" 
                                        placeholder="Slug danh Mục">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Mô tả danh mục</label>
                                        <textarea style="resize: none" rows="8" type="password" name="category_product_desc" class="form-control" id="exampleInputPassword1" 
                                        placeholder="Nhập Mô Tả Danh Mục">{{ $edit_value->category_desc}}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Thuộc danh mục</label>
                                        <select name="category_parent" class="form-control input-sm m-bot15">
                                            <option value="0">---Danh mục cha ----</option>
                                            @foreach($category as $key => $val)
                                                <option {{$edit_value->category_id==$val->category_id ? 'selected' : ''}} value="{{$val->category_id}}">
                                                    @php
                                                        $str = '';
                                                        for($i = 0; $i < $val->level; $i++){
                                                            echo $str;
                                                            $str = '-- ';
                                                        }
                                                    @endphp
                                                    {{$val->category_name}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Từ khóa danh mục</label>
                                        <textarea style="resize: none" rows="8" type="password" name="category_product_keywords" class="form-control" id="exampleInputPassword1" 
                                        placeholder="Nhập từ khóa danh mục">{{ $edit_value->meta_keywords }}</textarea>
                                    </div>
                                    <button type="submit" name="update_category_product" class="btn btn-info">Cập nhật Danh Mục</button>
                                </form>
                            </div>
                            @endforeach
                        </div>
                    </section>
            </div>
        </div>
@endsection
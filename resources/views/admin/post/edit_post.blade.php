@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Cập nhập bài viết
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
                            @foreach($edit_post as $key => $post)
                                <form role="form" action="{{url('/update-post/'.$post->post_id)}}" method="post" enctype="multipart/form-data">
                                        {{csrf_field() }}
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tên bài viết</label>
                                        <input type="text" value="{{$post->post_title}}" name="post_title" class="form-control" id="exampleInputEmail1" 
                                        placeholder="Nhập tên sản phẩm">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">slug bài viết</label>
                                        <input type="text" value="{{$post->post_slug}}" name="post_slug" class="form-control" id="exampleInputEmail1" 
                                        placeholder="Nhập slug sản phẩm">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Tóm tắt bài viết</label>
                                        <textarea style="resize: none" rows="8" type="text" name="post_desc" class="form-control" id="ckeditor2"  
                                        placeholder="Nhập mô tả sản phẩm">{{$post->post_desc}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Nội dung bài viết</label>
                                        <textarea style="resize: none" rows="8" type="text" name="post_content" class="form-control" id="ckeditor3"  
                                        placeholder="Nhập nội dung sản phẩm">{{$post->post_content}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Meta từ khóa</label>
                                        <textarea style="resize: none" rows="5" type="text" name="post_meta_keywords" class="form-control" id="exampleInputPassword1" 
                                        placeholder="Mô tả thương hiệu">{{$post->post_meta_keywords}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Meta nội dung</label>
                                        <textarea style="resize: none" rows="5" type="text" name="post_meta_desc" class="form-control" id="exampleInputPassword1" 
                                        placeholder="Mô tả thương hiệu">{{$post->post_meta_desc}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Hình ảnh bài viết</label>
                                        <input type="file" name="product_image" class="form-control" id="exampleInputEmail1" 
                                        placeholder="hình ảnh sản phẩm">
                                        <img src="{{url('public/uploads/post/'.$post->post_image)}}" height="100" width="100">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Danh mục bài viết</label>
                                        <select name="cate_post_id" class="form-control input-sm m-bot15">
                                        @foreach($category_post as $key => $c_post)
                                            @if($c_post->cate_post_id == $post->post_id)
                                                <option selected value="{{$c_post->cate_post_id}}">{{$c_post->cate_post_name}}</option>
                                            @else
                                                <option value="{{$c_post->cate_post_id}}">{{$c_post->cate_post_name}}</option>
                                            @endif
                                        @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Hiển Thị</label>
                                        <select name="post_status" class="form-control input-sm m-bot15">
                                            @if($post->post_status==1)
                                                <option value="0">Ẩn</option>
                                                <option selected value="1">Hiển Thị</option>
                                            @else
                                                <option selected value="0">Ẩn</option>
                                                <option value="1">Hiển Thị</option>
                                            @endif
                                        </select>
                                    </div>
                                    <button type="submit" name="update_post" class="btn btn-info">Cập nhập bài viết</button>
                                </form>
                            @endforeach
                            </div>

                        </div>
                    </section>

            </div>
        </div>
@endsection
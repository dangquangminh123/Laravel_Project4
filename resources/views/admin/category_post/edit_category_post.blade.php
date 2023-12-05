@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Cập nhập danh mục bài viết
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
                                <form role="form" action="{{url('/update-category-post/'.$category_post->cate_post_id)}}" method="post">
                                    {{csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên danh mục</label>
                                    <input type="text" name="cate_post_name" value="{{$category_post->cate_post_name}}" class="form-control" id="exampleInputEmail1" 
                                    onkeyup="ChangeToSlug();" id="slug" placeholder="Nhập tên danh mục bài viết">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Slug danh mục</label>
                                    <input type="text" name="cate_post_slug" value="{{$category_post->cate_post_slug}}" class="form-control" id="exampleInputEmail1" 
                                    placeholder="Nhập slug" id="convert_slug">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả danh mục</label>
                                    <textarea style="resize: none" rows="8" type="password" name="cate_post_desc" class="form-control" id="exampleInputPassword1" 
                                    placeholder="Mô tả thương hiệu">{{$category_post->cate_post_desc}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Hiển Thị</label>
                                    <select name="cate_post_status" class="form-control input-sm m-bot15">
                                        @if($category_post->cate_post_status==1)
                                            <option value="0">Ẩn</option>
                                            <option selected value="1">Hiển Thị</option>
                                        @else
                                            <option selected value="0">Ẩn</option>
                                            <option value="1">Hiển Thị</option>
                                        @endif
                                    </select>
                                </div>
                                <button type="submit" name="update_post_cate" class="btn btn-info">Cập nhập danh mục bài viết</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>
           
        </div>
@endsection
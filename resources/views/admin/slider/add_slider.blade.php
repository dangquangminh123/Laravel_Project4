@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm Slider
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
                                <form role="form" action="{{url('/insert-slider')}}" method="post" enctype="multipart/form-data">
                                    {{csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên slide</label>
                                    <input type="text" name="slider_name" class="form-control" id="exampleInputEmail1" 
                                    placeholder="Tên slider">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Hình ảnh Slider</label>
                                    <input type="file" name="slider_image" class="form-control" id="exampleInputEmail1" 
                                    placeholder="hình ảnh slider">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả Slider</label>
                                    <textarea style="resize: none" rows="8" type="password" name="slider_desc" class="form-control" id="exampleInputPassword1" 
                                    placeholder="Mô tả slide"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Hiển Thị</label>
                                    <select name="slider_status" class="form-control input-sm m-bot15">
                                        <option value="0">Ẩn slide</option>
                                        <option value="1">Hiển thị slide</option>

                                    </select>
                                </div>
                                <button type="submit" name="add_slider" class="btn btn-info">Thêm slide</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>
           
        </div>
@endsection
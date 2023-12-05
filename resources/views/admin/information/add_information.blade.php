@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                {{-- Information socials --}}
            <section class="panel">
                        <header class="panel-heading">
                            Thêm thông tin website
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
                                @foreach($contact as $key => $cont)
                                    <form role="form" action="{{url('/update-info/'.$cont->info_id)}}" method="post" enctype="multipart/form-data">
                                                {{csrf_field() }}
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Thông tin liên hệ</label>
                                                <textarea style="resize: none" rows="8" type="password" name="info_contact" data-validation="length" data-validation-length="min10"
                                                data-validation-error-msg="Làm ơn điền ít nhất 10 ký tự" class="form-control" id="ckeditor" placeholder="Thông tin liên hệ">
                                                {{$cont->info_contact}}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Bản đồ</label>
                                                <textarea style="resize: none" rows="8" type="password" name="info_map"  data-validation="length" data-validation-length="min10"
                                                data-validation-error-msg="Làm ơn điền ít nhất 10 ký tự" class="form-control" id="exampleInputPassword1" 
                                                placeholder="Bản đồ">{{$cont->info_map}}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Fanpage</label>
                                                <textarea style="resize: none" rows="8" type="password" name="info_fanpage" data-validation="length" data-validation-length="min10"
                                                data-validation-error-msg="Làm ơn điền ít nhất 10 ký tự" class="form-control" id="exampleInputPassword1" 
                                                placeholder="Fanpage">{{$cont->info_fanpage}}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Hình ảnh Logo</label>
                                                <input type="file" name="info_logo" class="form-control" id="exampleInputEmail1">
                                                <img src="{{url('/public/uploads/contact/'.$cont->info_logo)}}" height="100px" width="200px"/>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Slogan Logo</label>
                                                <input type="text" name="slogan_logo" value="{{$cont->slogan_logo}}" class="form-control" id="exampleInputEmail1" >
                                            </div>
                                        <button type="submit" name="add_info" class="btn btn-info">Cập nhật thông tin</button>
                                    </form>
                                @endforeach
                            </div>
                        </div>
                    </section>

            {{-- Icons --}}
            <section class="panel">
                        <header class="panel-heading">
                            Cập nhập thông tin mạng xã hội
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
                                    <form role="form">
                                                {{csrf_field() }}
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Tên nút</label>
                                               <input type="text" name="name" id="name" class="form-control"/>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Link nút</label>
                                               <input type="text" name="link" id="link" class="form-control"/>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Hình ảnh nút</label>
                                               <input type="file" name="info_image" id="image_nut" class="form-control"/>
                                            </div>
                                        <button type="submit" name="add_icons" class="btn btn-info add-nut">Thêm nút</button>
                                    </form>
                            </div>
                            <div class="position-center">
                                <div id="list_nut"></div>
                            </div>
                        </div>
            </section>
                
         {{-- đối tác --}}
        <section class="panel">
                        <header class="panel-heading">
                            Cập nhập thông tin đối tác
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
                                    <form role="form">
                                                {{csrf_field() }}
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Tên đối tác</label>
                                               <input type="text" name="name" id="name_doitac" class="form-control"/>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Link đối tác</label>
                                               <input type="text" name="link" id="link_doitac" class="form-control"/>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Hình ảnh đối tác</label>
                                               <input type="file" name="info_image" id="image_doitac" class="form-control"/>
                                            </div>
                                        <button type="submit" name="add_doitac" class="btn btn-info add-doitac">Thêm đối tác</button>
                                    </form>
                            </div>
                            <div class="position-center">
                                <div id="list_doitac"></div>
                            </div>
                        </div>
        </section>
            </div>
           
        </div>
@endsection
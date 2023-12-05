@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
            Liệt kê video
            </div>
        <div class="row w3-res-tb">
                {{-- <div class="col-sm-5 m-b-xs">
                    <select class="input-sm form-control w-sm inline v-middle">
                    <option value="0">Bulk action</option>
                    <option value="1">Delete selected</option>
                    <option value="2">Bulk edit</option>
                    <option value="3">Export</option>
                    </select>
                    <button class="btn btn-sm btn-default">Apply</button>                
                </div> --}}
            <div class="col-sm-12">
                <form>
                    {{csrf_field() }}
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tên video</label>
                        <input type="text" name="video_title" class="form-control video_title" id="exampleInputEmail1" 
                        placeholder="Nhập tên video">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Slug video</label>
                        <input type="text" name="video_slug" class="form-control video_slug" id="exampleInputEmail1" 
                        placeholder="Nhập slug video">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Link video</label>
                        <input type="text" name="video_link" class="form-control video_link" id="exampleInputEmail1" 
                        placeholder="Nhập Link video">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Mô tả video</label>
                        <textarea style="resize: none" rows="8" type="text" name="video_desc" class="form-control video_desc" id="exampleInputPassword1" 
                        placeholder="Mô tả video"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Hình video</label>
                        <input type="file" class="form-control" id="file_img_video" name="file" accept="image/*">
                    </div>
                    
                    <button type="button" name="add_video" class="btn btn-info btn-add-video">Thêm video</button>
                </form>
                <div id="notify"></div>
            </div>
        </div>
            <div class="table-responsive">
                <?php 
                $message = Session::get('message');
                if($message) {
                    echo '<span class="text-alert">'.$message.'</span>';
                    Session::put('message',null);
                }
                ?>
            
                <div id="video_load"></div>
    
                
            </div>
        </div>
</div>
@endsection
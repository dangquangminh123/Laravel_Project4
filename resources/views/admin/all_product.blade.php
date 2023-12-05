@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê sản phẩm
    </div>
    {{-- <div class="row w3-res-tb">
      <div class="col-sm-5 m-b-xs">
        <select class="input-sm form-control w-sm inline v-middle">
          <option value="0">Bulk action</option>
          <option value="1">Delete selected</option>
          <option value="2">Bulk edit</option>
          <option value="3">Export</option>
        </select>
        <button class="btn btn-sm btn-default">Apply</button>                
      </div>
      <div class="col-sm-4">
      </div>
      <div class="col-sm-3">
        <div class="input-group">
          <input type="text" class="input-sm form-control" placeholder="Search">
          <span class="input-group-btn">
            <button class="btn btn-sm btn-default" type="button">Go!</button>
          </span>
        </div>
      </div>
    </div> --}}
    <div class="table-responsive">
        <?php 
          $message = Session::get('message');
          if($message) {
            echo '<span class="text-alert">'.$message.'</span>';
            Session::put('message',null);
          }
	      ?>
      <table class="table table-striped b-t b-light" id="myTable">
        <thead>
          <tr>
            <th style="width:20px;">
              <label class="i-checks m-b-none">
                <input type="checkbox"><i></i>
              </label>
            </th>
            <th>Tên sản phẩm</th>
            <th>Thư viện hình ảnh</th>
            <th>Tài liệu</th>
            <th>Số lượng sản phẩm</th>
            <th>Giá bán</th>
            <th>Giá gốc</th>
            <th>Hình ảnh sản phẩm</th>
            <th>Danh mục sản phẩm</th>
            <th>Thương hiệu sản phẩm</th>
            <th>Mô tả sản phẩm</th>
            <th>Nội dung sản phẩm</th>
            <th>Hiển Thị</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($all_product as $key => $pro)
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>{{$pro->product_name}}</td>
            <td><a href="{{url('/add-gallery/'.$pro->product_id)}}">Thêm thư viện cho ảnh</a></td>
            @if($pro->product_file)
              <td><a target="_blank" href="{{asset('public/uploads/document/'.$pro->product_file)}}">
                {{$pro->product_file}}
              </a></td>
            @else
              <td>Không file</td>
            @endif
            <td>{{$pro->product_quantity}}</td>
            <td>{{number_format($pro->product_price,0,',','.') }}$</td>
            <td>{{number_format($pro->price_cost,0,',','.') }}$</td>
            <td><img src="public/uploads/product/{{$pro->product_image}}" height="100" width="100"></td>
            <td>{{$pro->category_id}}</td>
            <td>{{$pro->brand_id}}</td>
            <td>{{$pro->product_desc}}</td>
            <td>{{$pro->product_content}}</td>
            <td><span class="text-ellipsis">
              <?php 
                if($pro->product_status==1) {
              ?>
                <a href="{{url('/unactive-product/'.$pro->product_id)}}"><span class="fa-thumb-styling fa fa-thumbs-up"></span></a>
              <?php
                }else {
              ?>
                <a href="{{url('/active-product/'.$pro->product_id)}}"><span class="fa-thumb-styling fa fa-thumbs-down"></span></a>
              <?php
                }
              ?>
            </span></td>
           
            <td>
              <a href="{{url('/edit-product/'.$pro->product_id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-success text-active"></i></a>
              <a onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này không ?')" 
              href="{{url('/delete-product/'.$pro->product_id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-times text-danger text"></i></a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>


      {{-- Import data --}}
      <form action="{{url('/import-product')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file" accept=".xlsx"><br>
        <input type="submit" value="Import CSV" name="import_csv" class="btn btn-warning">
      </form>
      {{-- Export Data --}}
      <form action="{{url('/export-product')}}" method="POST">
        @csrf
        <input type="submit" value="Export CSV" name="export_csv" class="btn btn-success">
      </form>

  </div>
</div>
@endsection
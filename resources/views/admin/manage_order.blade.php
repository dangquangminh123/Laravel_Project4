@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê đơn hàng
    </div>
    <div class="row w3-res-tb">
      
    </div>
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
            <th>Thứ tự</th>
            <th>Mã đơn hàng</th>
            <th>Thời gian đặt hàng</th>
            <th>Tình trạng</th>
            <th>Lý do hủy đơn hàng</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @php
              $i = 0;
          @endphp
          @foreach($getorder as $key => $ord)
          @php 
              $i++;
          @endphp
          <tr>
            <td>{{$i}}</td>
            <td>{{$ord->order_code}}</td>
            <td>{{$ord->created_at}}</td>
            <td>
                @if($ord->order_status==1)
                    <span class="text text-success">Đơn hàng mới</span>
                @elseif($ord->order_status==2)
                    <span class="text text-primary">Đã xử lý - Đã giao hàng</span>
                @else
                    <span class="text text-danger">Đơn hàng đã bị hủy bỏ</span>
                @endif
            </td>
            <td>
              @if($ord->order_status==3)
                {{$ord->order_destroy}}
              @endif
            </td>
            <td>
              <a href="{{url('/view-order/'.$ord->order_code)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-eye text-success text-active"></i></a>
              <a onclick="return confirm('Bạn có chắc muốn xóa đơn hàng này không ?')" href="{{url('/delete-order/'.$ord->order_code)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-times text-danger text"></i></a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
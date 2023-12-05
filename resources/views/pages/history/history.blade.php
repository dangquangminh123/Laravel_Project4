@extends('layout')
@section('content')
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
              <!-- Trigger the modal with a button -->
              @if($ord->order_status!=3)
                <p><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#huydon">Hủy đơn hàng</button></p>
              @endif
              <!-- Modal -->
              <div id="huydon" class="modal fade" role="dialog">
                <div class="modal-dialog">

                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Lý do hủy đơn hàng</h4>
                    </div>
                    <div class="modal-body">
                      <p><textarea rows="5" class="lydohuydon" required placeholder="Lý do hủy đơn hàng...(bắt buộc)"></textarea></p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                      <button type="button" id="{{$ord->order_code}}" onclick="Huydonhang(this.id)" class="btn btn-success">Gửi lý do</button>
                    </div>
                  </div>

                </div>
              </div>
              <p><a href="{{url('/view-history-order/'.$ord->order_code)}}" class="active styling-edit" ui-toggle-class="">
                Xem đơn hàng</a></p>
              {{-- <a onclick="return confirm('Bạn có chắc muốn xóa đơn hàng này không ?')" href="{{url('/delete-order/'.$ord->order_code)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-times text-danger text"></i></a> --}}
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <footer class="panel-footer">
        <div class="row">
          
          <div class="col-sm-5 text-center">
            <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
          </div>
          <div class="col-sm-7 text-right text-center-xs">                
            <ul class="pagination pagination-sm m-t-none m-b-none">
               {!!$getorder->links()!!}
            </ul>
          </div>
        </div>
      </footer>

  </div>
</div>
@endsection
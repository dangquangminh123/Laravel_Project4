@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
        Danh sách comment
    </div>
    <div id="notify_comment"></div>
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
            <th>Duyệt</th>
            <th>người bình luân</th>
            <th>Nội dung</th>
            <th>Thời gian</th>
            <th>Sản phẩm</th>
            <th>Quản lý</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($comment as $key => $comm)
          <tr>
            <td>
                @if($comm->comment_status==0)
                    <input type="button" data-comment_status="1" data-comment_id="{{$comm->comment_id}}" id="{{$comm->comment_product_id}}" 
                    class="btn btn-primary btn-xs comment_duyet_btn" value="Duyệt" />
                @else
                    <input type="button" data-comment_status="0" data-comment_id="{{$comm->comment_id}}" id="{{$comm->comment_product_id}}"
                     class="btn btn-danger btn-xs comment_duyet_btn" value="Bỏ duyệt" />
                @endif
            </td>
            <td>{{$comm->comment_name}}</td>
            <td>{{$comm->comment}}
              
              <style type="text/css">
                ul.list_rep li{
                  list-style-type: decimal;
                  color: blue;
                  margin: 5px 40px;
                }
              </style>
              <ul class="list_rep">
                Trả lời: 
                @foreach($comment_rep as $key => $comm_reply)
                    @if($comm_reply->comment_parent_comment==$comm->comment_id)
                      <li>{{$comm_reply->comment}}</li>
                    @endif
                @endforeach
              </ul>
               @if($comm->comment_status==1)
               <br/><textarea class="form-control reply_comment_{{$comm->comment_id}}" rows="5"></textarea>
               <br/><button class="btn btn-default btn-xs btn-reply-comment" data-product_id="{{$comm->comment_product_id}}" 
                data-comment_id="{{$comm->comment_id}}">Phản hổi bình luận</button>
               @endif
            </td>

            <td>{{$comm->comment_date}}</td>

            <td><a href="{{url('/chi-tiet-san-pham/'.$comm->product->product_id)}}">{{$comm->product->product_name}}</a></td>

            <td>
              <a href="" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-success text-active"></i></a>
              <a onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này không ?')" 
              href="" class="active styling-edit" ui-toggle-class="">
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
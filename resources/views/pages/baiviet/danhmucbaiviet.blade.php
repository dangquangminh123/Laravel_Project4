@extends('layout')

@section('sidebar')
	@include('pages.include.sidebar');
@endsection

@section('content')   
    <div class="features_items"><!--features_items-->
		<h2 class="title text-center">{{ $meta_title}}</h2>
        <div class="product-image-wrapper" style="border: none;">
        @foreach($post as $key => $value)
            <div class="single-products" style="margin:10px 0; padding: 2px">
                <div class="text-center">
                    @csrf
                        <img style="float:left; width: 30%; height: 180px; padding: 5px;" src="{{url('public/uploads/post/'.$value->post_image)}}" alt="{{$value->post_slug}}"/>
                        <h4 style="color: #000; padding: 5px;">{{$value->post_title}}</h4>
                        <p>{!!$value->post_desc!!}</p>
                </div>
                <div class="text-right">
                    <a href="{{url('/bai-viet/'.$value->post_slug)}}" class="btn btn-default btn-sm">Xem bài viết</a>
                </div>
            </div>
            <div class="clearfix"></div>			
		@endforeach		
        </div>		
	</div>

    <ul class="pagination pagination-sm m-t-none m-b-none">
        {{$post->links()}}
    </ul>
@endsection
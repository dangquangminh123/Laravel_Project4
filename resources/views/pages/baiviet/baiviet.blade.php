@extends('layout')
@section('content')   
    <div class="features_items"><!--features_items-->
		<h2 style="margin: 0; position: inherit; font-size: 22px" class="text-center">{{$meta_title}}</h2>
        <div class="product-image-wrapper" style="border: none;">
        @foreach($post_by_id as $key => $value)
            <div class="single-products" style="margin:10px 0; padding: 2px">
                <h5 class="text-center" style="color: #FE900F">{{$value->post_title}}</h5>
                {!!$value->post_content!!}
                <img style="float:left; width: 50%; height: 300px; padding: 5px;" src="{{url('public/uploads/post/'.$value->post_image)}}" alt="{{$value->post_slug}}"/>
                <p>{!!$value->post_desc!!}</p>
                <span style="color: #FE900F">Từ khóa:{{$value->post_meta_keywords}}</span>
                <span style="color: #FE900F">Thể loại:{{$value->post_meta_desc}}</span>
            </div>
            <div class="clearfix"></div>
		@endforeach		
        </div>		
	</div>
    {{-- Bài viết liên quan --}}
    <h2 style="margin: 0; position: inherit; font-size: 22px" class="text-center">Bài viết gợi ý</h2>
    <ul class="post-relate">
        @foreach($related as $key => $post_relate)
            <li><a href="{{url('/bai-viet/'.$post_relate->post_slug)}}">{{$post_relate->post_title}}</a></li>

            <img src="{{url('public/uploads/post/'.$post_relate->post_image)}}" style="width: 200px; height: 150px" alt="{{$value->post_slug}}"/>
        @endforeach
    </ul>

    <style>
        ul.post-relate li {
            list-style-type: disc;
            font-size: 16px;
            padding: 6px;
        }

        ul.post-relate li a {
            color: #000;
        }

        ul.post-relate li a:hover {
            color: #FE900F;
        }

        .baiviet ul li {
            list-style-type: decimal-leading-zero;
        }

        .mucluc h1 {
            font-size: 20px;
            color: brown;   
        }
    </style>
@endsection
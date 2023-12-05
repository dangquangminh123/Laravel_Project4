@extends('layout')
@section('content')   
    <div class="features_items"><!--features_items-->
						<h2 class="title text-center">Tag tìm kiếm: {{$product_tag}}</h2>
				@foreach($pro_tag as $key => $tag)
				
						<div class="col-sm-4">	
							<div class="product-image-wrapper">
								<div class="single-products">
									<div class="productinfo text-center">
										<form>
											@csrf
											<input type="hidden" value="{{$tag->product_id}}" class="cart_product_id_{{$tag->product_id}}">
											<input type="hidden" value="{{$tag->product_name}}" class="cart_product_name_{{$tag->product_id}}">
											<input type="hidden" value="{{$tag->product_quantity}}" class="cart_product_quantity_{{$tag->product_id}}">
											<input type="hidden" value="{{$tag->product_image}}" class="cart_product_image_{{$tag->product_id}}">
											<input type="hidden" value="{{$tag->product_price}}" class="cart_product_price_{{$tag->product_id}}">
											<input type="hidden" value="1" class="cart_product_qty_{{$tag->product_id}}">
			
										<a href="{{url('/chi-tiet-san-pham/'.$tag->product_id)}}">
											<img src="{{url('public/uploads/product/'.$tag->product_image)}}" alt="" />
											<h2>{{number_format($tag->product_price).' '.'$'}}</h2>
											<p>{{$tag->product_name}}</p>
										</a>
										<input type="button" value="Thêm giỏ hàng" class="btn btn-default add-to-cart" data-id_product="{{$tag->product_id}}" 
											name="add-to-cart"/>
										</form>
									</div>
								</div>
								<div class="choose">
									<ul class="nav nav-pills nav-justified">
										<li><a href="#"><i class="fa fa-plus-square"></i>Thêm vào danh mục yêu thích</a></li>
										<li><a href="#"><i class="fa fa-plus-square"></i>So sánh</a></li>
									</ul>
								</div>
							</div>
						</div>
			    @endforeach
		</div>
		<ul class="pagination pagination-sm m-t-none m-b-none">
			{{-- {{$product_all->links()}} --}}
		</ul>
@endsection
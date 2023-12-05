@extends('layout')
@section('content')   
    <div class="features_items"><!--features_items-->
						<h2 class="title text-center">Kết quả tìm kiếm</h2>
						@foreach($search_product as $key => $product)
						<form action="{{url('/save-cart')}}" method="POST">
							{{csrf_field()}}
						<a href="{{url('/chi-tiet-san-pham/'.$product->product_id)}}">
								<div class="col-sm-4">	
										<div class="product-image-wrapper">
											<div class="single-products">
													<div class="productinfo text-center">
														<img src="{{url('public/uploads/product/'.$product->product_image)}}" alt="" />
														<h2>{{number_format($product->product_price).' '.'$'}}</h2>
														<p>{{$product->product_name}}</p>
															<input name="qty" type="number" min="1" value="1" />
											<input name="productid_hidden" type="hidden" value="{{$product->product_id}}" />
														<button type="submit" class="btn btn-fefault cart">
															<i class="fa fa-shopping-cart"></i>
															Thêm giỏ hàng
														</button>
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
						</a>
					</form>
						@endforeach				
                        
					</div>

@endsection
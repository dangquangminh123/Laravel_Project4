@extends('layout')
@section('content')   
    <div class="features_items"><!--features_items-->
                    @foreach($brand_name as $key => $name)
                     <h2 class="title text-center">{{$name->brand_name}}</h2>
                    @endforeach
					<div class="row">
						<div class="col-md-12">
							<label for="amount">Lọc thương hiệu</label></br>

							@php 
								$brand_id = [];
								$brand_arr = [];
								if(isset($_GET['brand'])){
									$brand_id = $_GET['brand'];
								}else {
									$brand_id = $name->brand_id.",";
								}
								$brand_arr = explode(",",$brand_id);
							@endphp

							@foreach($brand as $key => $thuonghieu)
								<label class="checkbox-inline">
									<input type="checkbox" {{ in_array($thuonghieu->brand_id, $brand_arr) ? 'checked' : '' }}
									data-filters="brand" name="brand-filter" value="{{$thuonghieu->brand_id}}" class="form-control-checkbox brand-filter" />
									{{$thuonghieu->brand_name}}	
								</label>
							@endforeach</br>
						</div>

					</div>
                    @foreach($brand_by_id as $key => $product)
					<a href="{{url('/chi-tiet-san-pham/'.$product->product_id)}}">						
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
										<div class="productinfo text-center">
											<img src="{{url('public/uploads/product/'.$product->product_image)}}" alt="" />
											<h2>{{number_format($product->product_price).' '.'$'}}</h2>
											<p>{{$product->product_name}}</p>
											<a href="#" class="btn btn-default add-to-cart">
												<i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</a>
										</div>
										{{-- <div class="product-overlay">
											<div class="overlay-content">
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
											</div>
										</div> --}}
								</div>
								<div class="choose">
									<ul class="nav nav-pills nav-justified">
										<li><a href="#"><i class="fa fa-plus-square"></i>Thêm vào danh mục yêu thích</a></li>
										<li><a href="#"><i class="fa fa-plus-square"></i>So sánh</a></li>
									</ul>
								</div>
                                <div class="clearfix"></div>
							</div>
						</div>
					</a>
					@endforeach				
    </div>
@endsection
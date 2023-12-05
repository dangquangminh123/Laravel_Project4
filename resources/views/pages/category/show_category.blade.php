@extends('layout')

@section('slider')
	@include('pages.include.slider');
@endsection

@section('content_category')   
    <div class="features_items"><!--features_items-->
		<div class="fb-like" data-href="{{$url_canonical}}" data-width="" data-layout="" data-action="" data-size="" data-share="true"></div>
                        @foreach($category_name as $key => $name)
                        <h2 class="title text-center">{{$name->category_name}}</h2>
                        @endforeach
							
						<div class="row">

							<div class="col-md-12">
								<label for="amount">Lọc danh mục</label></br>
	
								@php 
									$category_id = [];
									$category_arr = [];
									if(isset($_GET['cate'])){
										$brand_id = $_GET['cate'];
									}else {
										$category_id = $name->category_id.",";
									}
									$category_arr = explode(",",$category_id);
								@endphp
	
								@foreach($category as $key => $cate)
									<label class="checkbox-inline">
										<input type="checkbox" {{ in_array($cate->category_id, $category_arr) ? 'checked' : '' }}
										data-filters="category" name="category-filter" value="{{$cate->category_id}}" class="form-control-checkbox category-filter" />
										{{$cate->category_name}}	
									</label>
								@endforeach</br>
							</div>

							<div class="col-md-4">
								<label for="amount">Sắp xếp theo</label>
								<form>
									@csrf
								<select name="sort" id="sort" class="form-control">
									<option value="{{Request::url()}}?sort_by=name">--Lọc--</option>
									<option value="{{Request::url()}}?sort_by=tang_dan">--Giá giảm dần--</option>
									<option value="{{Request::url()}}?sort_by=giam_dan">--Giá giảm dần--</option>
									<option value="{{Request::url()}}?sort_by=kytu_az">Lọc theo tên A đến Z</option>
									<option value="{{Request::url()}}?sort_by=kytu_za">Lọc theo tên Z về A</option>
								</select>
								</form>
							</div>

							<div class="col-md-4">
								<label for="amount">Lọc giá theo</label>

								<form>
									<div id="slider-range"></div>
									<style type="text/css">
										.style-range p {
											float: left;
											width: 20%;
										}
									</style>
									<div class="style-range">
										<p><input type="text" id="amount_start" readonly style="border:0; color:#f6931f;
										font-weight:bold;"></p>

										<p><input type="text" id="amount_end" readonly style="border:0; color:#f6931f;
										font-weight:bold;"></p>
									</div>
									<input type="hidden" name="start_price" id="start_price">
									<input type="hidden" name="end_price" id="end_price">

									<br> 
									<div class="clearfix"></div>
									<input type="submit" name="filter_price" value="Lọc giá" class="btn btn-sm btn-default">
								</form>
							</div>
						</div>
                        @foreach($category_by_id as $key => $product)
						<a href="{{route('show.slug',[$product->product_slug])}}">	
							<div class="col-sm-3">
								<div class="product-image-wrapper">
									<div class="single-products">
											<div class="productinfo text-center">
												<a href="{{route('show.slug',[$product->product_slug])}}">
													<img src="{{url('public/uploads/product/'.$product->product_image)}}" alt="" />
													<h2>{{number_format($product->product_price).' '.'$'}}</h2>
													<p>{{$product->product_name}}</p>
												</a>
												<button class="btn btn-default home_cart_'.$pro->product_id.' addtocart" id="'.$pro->product_id.'" onclick="Addtocart(this.id);" type="button">
													<i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</button>
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
								</div>
							</div>
							
						</a>
						@endforeach				
    </div>
	<div class="fb-comments" data-href="{{$url_canonical}}" data-width="" data-numposts="15"></div>
	<div class="fb-page" data-href="{{$url_canonical}}" data-tabs="timeline" data-width="" data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"></div>
@endsection
@extends('layout')

@section('slider')
	@include('pages.include.slider');
@endsection

@section('sidebar')
	@include('pages.include.attribute');
@endsection

@section('content')   
    <div class="features_items"><!--features_items-->
		<div class="category-tab"><!--category-tab-->
			<div class="col-sm-12">
				<ul class="nav nav-tabs">
					@php
						$i =0;
					@endphp
					@foreach($cate_pro_tabs as $key => $cat_tabs)
						@php
							$i++;
						@endphp
					<li data-id="{{$cat_tabs->category_id}}" id="{{$i==1 ? 'tabs_id' : ''}}" class="{{$i==1 ? 'active' : ''}} tabs_pro">
						<a href="#{{$cat_tabs->slug_category_product}}" data-toggle="tab">{{$cat_tabs->category_name}}</a>
					</li>
					@endforeach
				</ul>
			</div>

			{{-- Tabs danh mục sản phẩm --}}
			<div id="tabs_product"></div>
			<div class="tab-content">
				<div class="tab-pane fade active in" id="tshirt" >
					<div class="col-sm-3">
						<div class="product-image-wrapper">
							<div class="single-products">
								<div class="productinfo text-center">
									
								</div>
								
							</div>
						</div>
					</div>
				
				</div>
			</div>
		</div><!--/category-tab-->
				<h2 class="title text-center">Sản phẩm mới nhất</h2>
				<div id="all_product">
				
				</div>
				<div id="cart_session"></div>

			<style type="text/css">
				div#quick-cart {
					margin-top: 60px;
				}
			</style>
			{{-- Giỏ hàng Modal --}}
			<div class="modal fade" id="quick-cart" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">Giỏ hàng của bạn</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					</div>
					<div class="modal-body">
						<div id="show_quick_cart_alert"></div>
						<div id="show_quick_cart">

						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					
					</div>
				</div>
				</div>
			</div>

				{{-- @foreach($all_product as $key => $product) --}}
				{{-- <form action="{{url('/save-cart')}}" method="POST">
							{{csrf_field()}} --}}
						{{-- <a href="{{url('/chi-tiet-san-pham/'.$product->product_id)}}"> --}}
						{{-- <div class="col-sm-4">	
							<div class="product-image-wrapper">
								<div class="single-products">
									<div class="productinfo text-center">
									<form>
									@csrf
									<input type="hidden" value="{{$product->product_id}}" class="cart_product_id_{{$product->product_id}}">
									<input type="hidden" id="wishlist_productname{{$product->product_id}}" value="{{$product->product_name}}" 
									class="cart_product_name_{{$product->product_id}}">

									<input type="hidden" value="{{$product->product_quantity}}" class="cart_product_quantity_{{$product->product_id}}">
									<input type="hidden" value="{{$product->product_image}}" class="cart_product_image_{{$product->product_id}}">
									<input type="hidden" id="wishlist_productprice{{$product->product_id}}" value="{{number_format($product->product_price,0,',','.')}}$" 
									class="cart_product_price_{{$product->product_id}}">

									<input type="hidden" id="wishlist_productcontent{{$product->product_id}}" value="{{$product->product_content}}">

									<input type="hidden" value="1" class="cart_product_qty_{{$product->product_id}}">
			
										<a id="wishlist_producturl{{$product->product_id}}" href="{{url('/chi-tiet-san-pham/'.$product->product_id)}}">
											<img id="wishlist_productimage{{$product->product_id}}" src="{{url('public/uploads/product/'.$product->product_image)}}" alt="" />
											<h2>{{number_format($product->product_price).' '.'$'}}</h2>
											<p>{{$product->product_name}}</p> --}}
											{{-- <input name="qty" type="number" min="1" value="1" /> --}}
														{{-- <input name="productid_hidden" type="hidden" value="{{$product->product_id}}" />
											
															<i class="fa fa-shopping-cart"><button type="submit" class="btn btn-fefault cart"></i>
															Thêm giỏ hàng
														</button> --}}
										{{-- </a> --}}
										
										{{-- <input type="button" value="Thêm giỏ hàng" class="btn btn-default add-to-cart" data-id_product="{{$product->product_id}}" 
											name="add-to-cart"/> --}}
										{{-- <button class="btn btn-default home_cart_'.$product->product_id.'" id="'.$product->product_id.'" onclick="Addtocart(this.id);" 
											name="add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</button>			
										
										<button style="display:none" class="btn btn-danger rm_home_cart_'.$product->product_id.'" id="'.$product->product_id.'" onclick="Deletecart(this.id);" 
										name="add-to-cart"><i class="fa fa-shopping-cart"></i>Bỏ đã thêm</button>

										<input type="button" data-toggle="modal" data-target="#xemnhanh" value="Xem nhanh" 
											class="btn btn-default xemnhanh" data-id_product="{{$product->product_id}}" name="add-to-cart"/>
										</form>
									</div>
								</div>
								
							</div> --}}
							{{-- <div class="choose"> 
								<ul class="nav nav-pills nav-justified">
									<li>
										<i class="fa fa-plus-square"></i>
										<button class="button_wishlist" id="{{$product->product_id}}" 
										onclick="add_wistlist(this.id);"><span>Yêu thích</span></button>
										
									</li>
									<li><a style="cursor: pointer;" onclick="add_compare({{$product->product_id}})">
										<i class="fa fa-plus-square"></i>So sánh</a></li>
		
										<div class="container">
										<!-- Modal -->
											<div class="modal fade" id="sosanh" role="dialog">
											  <div class="modal-dialog">
											  
												<!-- Modal content-->
												<div class="modal-content">
												  <div class="modal-header">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<h4 class="modal-title"><span id="title-compare"></span></h4>
												  </div>
												  <div class="modal-body">
													<div id="row_compare"></div>
													<table class="table table-hover" id="row_compare">
														<thead>
														  <tr>
															<th>Tên sản phẩm</th>
															<th>Giá sản phẩm</th>
															<th>Hình ảnh</th>
															<th>Thông số sản phẩm</th>
															<th>Xem sản phẩm</th>
															<th>Xóa</th>
														  </tr>
														</thead>
														<tbody>
														 
														</tbody>
													  </table>
												  </div>
												  <div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
												  </div>
												</div>
												
											  </div>
											</div>
											
										  </div>
								</ul>
							</div>  --}}
						{{-- </div>  --}}
				{{-- </a> --}}
				{{-- </form> --}}
				{{-- @endforeach--}}
				
		{{-- </div> --}}

		 {{-- Xem nhanh --}}

		<!-- Modal -->
		{{-- <div id="xemnhanh" class="modal fade" role="dialog">
				<div class="modal-dialog">
				<!-- Modal content-->
					<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title product_quickview_title" id="">
									<span id="product_quickview_title"></span>
								</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>

						<div class="modal-body">
							<div class="row">
								<div class="col-md-5">
									<span id="product_quickview_image"></span>
									<span id="product_quickview_gallery"></span>
								</div>
								<form>
									@csrf
									<div id="product_quickview_value"></div>
									<div class="col-md-7">
										<h2 class="quickview"><span id="product_quickview_title"></span></h2>
										<p>Mã ID:<span id="product_quickview_id"></span></p>
										<span>
											<h2 style="color:#FE980F">Giá sản phẩm
											<span id="product_quickview_price"></span></h2></br>
											<label>Số lượng:</label>
											<input name="qty" type="number" min="1" class="cart_product_qty_" value="1" />
											<input name="productid_hidden" type="hidden" value=""/>
										</span></br>
										<h4 class="quickview">Mô tả sản phẩm</h4>
										<fieldset>
											<span style="width: 100%" id="product_quickview_desc"></span>
											<span style="width: 100%" id="product_quickview_content"></span>
										</fieldset>
										<div id="product_quickview_button"></div>
										<div id="beforesend_quickview"></div>
									</div>
								</form>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-default redirect-cart">Đi tới giỏ hàng</button>
					</div>
				</div>
			</div>
		</div> --}}

		<ul class="pagination pagination-sm m-t-none m-b-none">
			{{$product_all->links()}}
		</ul>
@endsection
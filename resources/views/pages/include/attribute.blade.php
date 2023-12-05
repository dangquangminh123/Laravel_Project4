<div class="col-sm-3">
    <div class="left-sidebar">
        <h2>@lang('lang.categoryproduct')</h2>
        <div class="panel-group category-products" id="accordian"><!--category-productsr-->
            @foreach($category as $key => $cate)
                <div class="panel panel-default">
                    @if($cate->category_parent==0)
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordian" href="#{{$cate->slug_category_product}}">
                                <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                                {{$cate->category_name}}
                            </a>
                        </h4>
                    </div>
                    <div id="{{$cate->slug_category_product}}" class="panel-collapse collapse">
                        <div class="panel-body">
                            <ul>
                                @foreach($category as $key => $cate_sub)
                                    @if($cate_sub->category_parent==$cate->category_id)
                                        {{-- <li><a href="{{url('/danh-muc-san-pham/'.$cate_sub->slug_category_product)}}">{{$cate_sub->category_name}} </a></li> --}}

                                        <li><a
                                            href="{{route('show.slug', ['slug' => $cate_sub->slug_category_product])}}">
                                            {{ $cate_sub->category_name }}
                                        </a></li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @endif
                </div>						
            @endforeach
        </div><!--/category-products-->
    
        <div class="brands_products"><!--brands_products-->
            <h2>Thương hiệu sản phẩm</h2>
            <div class="brands-name">
                <ul class="nav nav-pills nav-stacked">
                    @foreach($brand as $key => $brand)
                        {{-- <li><a href="{{url('/thuong-hieu-san-pham/'.$brand->brand_slug)}}"> <span class="pull-right">(50)</span>
                            {{$brand->brand_name}}</a></li> --}}

                            <li><a
                                href="{{route('show.slug', ['slug' => $brand->brand_slug])}}">
                                {{ $brand->brand_name }}
                            </a></li>
                    @endforeach
                </ul>
            </div>
        </div><!--/brands_products-->

        <div class="brands_products">
            <h2>Sản phẩm đã xem</h2>
            <div class="brands-name">
                <div id="row_viewed" class="row">

                </div>
            </div>
        </div>

        <div class="brands_products">
            <h2>Sản phẩm yêu thích</h2>
            <div class="brands-name">
                <div id="row_wishlist" class="row">

                </div>
            </div>
        </div>
        {{-- <div class="price-range">
            <h2>Price Range</h2>
            <div class="well text-center">
                 <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
                 <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
            </div>
        </div>
         --}}
        <div class="shipping text-center"><!--shipping-->
            <img src="{{asset('public/frontend/images/shipping.jpg')}}" alt="" />
        </div><!--/shipping-->
    
    </div>
</div>
@extends('welcome')
@section('content')      
            <div class="features_items">
                 <!--features_items-->
                        <h2 class="title text-center">Sản Phẩm Mới Nhất</h2>
                        @foreach($product as $key=>$product_data)
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                        <div class="productinfo text-center">
                                            <div style="width: 200px;height: 200px;margin: 0 auto">
                                              <img src="public/upload/product/{{$product_data->product_image}}" width="100%" height="100%" alt="" />
                                            </div>
                                            <h2>{{number_format($product_data->product_price).' '.'VNĐ' }}</h2>
                                            <p>{{$product_data->product_name}}</p>
                                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</a>
                                        </div>
                                        <div class="product-overlay">
                                            <div class="overlay-content">
                                                <h2>{{number_format($product_data->product_price).' '.'VNĐ' }}</h2>
                                                <p>{{$product_data->product_name}}</p>
                                                <a href="{{URL::to('/chi-tiet-san-pham/'.$product_data->product_id)}}" class="btn btn-default add-to-cart"><i class="fa fa-info-square"></i>Xem chi tiết</a> 
                                            </div>
                                        </div>
                                        <img src="public/frontend/image/new.png" class="new" alt="" />
                                </div>
                                <div class="choose">
                                    <ul class="nav nav-pills nav-justified">
                                        <li><a href="#"><i class="fa fa-plus-square"></i>Thêm yêu thích</a></li>
                                        <li><a href="#"><i class="fa fa-plus-square"></i>So sánh</a></li>
                                    </ul>
                                </div>
                            </div>
                           
                        </div>
                         @endforeach
                    </div><!--features_items-->

 

 
@endsection
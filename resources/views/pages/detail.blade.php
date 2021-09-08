@extends('welcome')
@section('content')
@foreach($detail as $key=>$detail_product)   
           <div class="product-details"><!--product-details-->
                        <div class="col-sm-5">
                            <div class="view-product">
                               
                                 <img src="{{asset('public/upload/product/'.$detail_product->product_image)}}" width="100%" height="100%" alt="" />
                           
                            </div>
                            <div id="similar-product" class="carousel slide" data-ride="carousel">
                                
                                  <!-- Wrapper for slides -->
                                    <div class="carousel-inner">
                                        <div class="item active">
                                          <a href=""><img src="images/product-details/similar1.jpg" alt=""></a>
                                          <a href=""><img src="images/product-details/similar2.jpg" alt=""></a>
                                          <a href=""><img src="images/product-details/similar3.jpg" alt=""></a>
                                        </div>
                                        <div class="item">
                                          <a href=""><img src="images/product-details/similar1.jpg" alt=""></a>
                                          <a href=""><img src="images/product-details/similar2.jpg" alt=""></a>
                                          <a href=""><img src="images/product-details/similar3.jpg" alt=""></a>
                                        </div>
                                        <div class="item">
                                          <a href=""><img src="images/product-details/similar1.jpg" alt=""></a>
                                          <a href=""><img src="images/product-details/similar2.jpg" alt=""></a>
                                          <a href=""><img src="images/product-details/similar3.jpg" alt=""></a>
                                        </div>
                                        
                                    </div>

                                  <!-- Controls -->
                                  <a class="left item-control" href="#similar-product" data-slide="prev">
                                    <i class="fa fa-angle-left"></i>
                                  </a>
                                  <a class="right item-control" href="#similar-product" data-slide="next">
                                    <i class="fa fa-angle-right"></i>
                                  </a>
                            </div>

                        </div>
                        <div class="col-sm-7">
                            <div class="product-information"><!--/product-information-->
                                <img src="images/product-details/new.jpg" class="newarrival" alt="" />
                                <h2>{{$detail_product->product_name}}</h2> 
                                 <span style="font-size: 20px;font-weight: bold;color:#FE980F">{{number_format($detail_product->product_price).' '.'VNĐ' }}</span>                             
                                <img src="images/product-details/rating.png" alt="" />
                                <p><b>Mã SP:</b> {{$detail_product->product_id}}</p>
                                <p><b>Sẵn Có:</b> Còn hàng</p>
                                <p><b>Tình Trạng:</b> New</p>
                                <p><b>Thương Hiệu:</b> {{$detail_product->brand_name}}</p>
                                <form action="{{URL::to('/gio-hang')}}" method="post">
                                    {{csrf_field() }}
                                    <span>
                                        <label>Số Lượng:</label>
                                        <input type="number" name="quantity" min="1" value="1" />
                                        <input type="hidden" name="product_id" value="{{$detail_product->product_id}}">
                                        <button type="submit" class="btn btn-fefault cart">
                                            <i class="fa fa-shopping-cart"></i>
                                            Thêm giỏ hàng
                                        </button>
                                    </span>
                               </form>
                                <a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>
                            </div><!--/product-information-->
                        </div>
                    </div><!--/product-details-->
@endforeach
 <div class="category-tab"><!--category-tab-->
                        <div class="col-sm-12">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#detail" data-toggle="tab">Mô Tả</a></li>
                                <li><a href="#content" data-toggle="tab">Đánh Giá</a></li>
                                <li><a href="#sunglass" data-toggle="tab">Liên Hệ</a></li>
                            
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane fade active in" id="detail" >
                                <p style="font-size: 20px"> {{$detail_product->product_desc}}</p>
                            </div>
                            <div class="tab-pane fade active in" id="content" >
                                <p style="font-size: 20px"> {{$detail_product->product_content}}</p>
                            </div> 
                        </div>
        </div><!--/category-tab-->

 <div class="recommended_items"><!--recommended_items-->
                        <h2 class="title text-center">Sản Phẩm Gợi Ý</h2>
                        
                        <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">

                            <div class="carousel-inner">
                                <div class="item active">   
                                    @foreach($related as $key=>$value)
                                    <div class="col-sm-3">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">
                                                    <div style="width: 100px;height: 100px;margin: 0 auto">
                                                    <img src="{{asset('public/upload/product/'.$value->product_image)}}" alt="" />
                                                    </div>
                                                    <h2 style="font-size: 15px">{{number_format($value->product_price).' '.'VNĐ'}}</h2>
                                                    <p>{{$value->product_name}}</p>
                                                    <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="item"> 
                                    @foreach($related as $key=>$value)
                                    <div class="col-sm-3">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">
                                                    <div style="width: 100px;height: 100px;margin: 0 auto">
                                                    <img src="{{asset('public/upload/product/'.$value->product_image)}}" alt="" />
                                                    </div>
                                                    <h2 style="font-size: 15px">{{number_format($value->product_price).' '.'VNĐ'}}</h2>
                                                    <p>{{$value->product_name}}</p>
                                                    <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                             <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                                <i class="fa fa-angle-left"></i>
                              </a>
                              <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                                <i class="fa fa-angle-right"></i>
                              </a>          
                        </div>
                    </div><!--/recommended_items-->
@endsection
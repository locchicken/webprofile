@extends('adminIndex');
@section('content_main')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Cập nhập sản phẩm
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
                                @foreach($show_update as $key=>$data)
                                <form role="form" action="{{URL::to('/update-data-product/'.$data->product_id)}}" method="post" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên sản phẩm</label>
                                    <input type="text" class="form-control" name="product_name" value="{{$data->product_name}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hình ảnh</label>
                                    <input type="file" class="form-control" name="product_image">
                                    <img src="{{URL::to('public/upload/product/'.$data->product_image)}}" width="70" height="70">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giá sản phẩm</label>
                                    <input type="text" class="form-control" name="product_price" value="{{$data->product_price}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Danh mục sản phẩm</label>
                                    <select name="cate" class="form-control m-bot15">
                                        @foreach($cate_product as $key=>$data_cate)
                                        @if($data_cate->category_id==$data->category_id)
                                            <option selected value="{{$data_cate->category_id}}">{{$data_cate->category_name}}</option>
                                        @else
                                            <option value="{{$data_cate->category_id}}">{{$data_cate->category_name}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Thương hiệu sản phẩm</label>
                                    <select name="brand" class="form-control m-bot15">
                                        @foreach($brand_product as $key=>$data_brand)
                                        @if($data_brand->brand_id==$data->brand_id)
                                            <option selected value="{{$data_brand->brand_id}}">{{$data_brand->brand_name}}</option>
                                        @else
                                            <option value="{{$data_brand->brand_id}}">{{$data_brand->brand_name}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả</label>
                                    <textarea style="resize: none" rows="8" class="form-control" name="product_desc">{{$data->product_desc}}</textarea>
                                </div>
                                 <div class="form-group">
                                    <label for="exampleInputPassword1">Nội dung</label>
                                    <textarea style="resize: none" rows="8" class="form-control" name="product_content">{{$data->product_content}}</textarea>
                                </div>
                                
                                @endforeach
                                <button type="submit" name="update_product" class="btn btn-info">Cập Nhập</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>
@endsection
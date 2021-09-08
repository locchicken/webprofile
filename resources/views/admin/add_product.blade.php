@extends('adminIndex');
@section('content_main')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm sản phẩm
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/save-product')}}" method="post" enctype="multipart/form-data">
                                	{{csrf_field()}}
			                        <?php 
										$message=Session('message');
										if($message)
										{
											echo '<div class="alert alert-success" role="alert">'.$message.'</div>';
											Session::put('message',null);
										}
									?>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên sản phẩm</label>
                                    <input type="text" class="form-control" name="product_name" placeholder="Tên sản phẩm...">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hình ảnh</label>
                                    <input type="file" class="form-control" name="product_image">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giá sản phẩm</label>
                                    <input type="text" class="form-control" name="product_price" placeholder="Giá...">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Danh mục sản phẩm</label>
                                    <select name="cate" class="form-control m-bot15">
                                        @foreach($cate_product as $key=>$data_cate)
                                        <option value="{{$data_cate->category_id}}">{{$data_cate->category_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Thương hiệu sản phẩm</label>
                                    <select name="brand" class="form-control m-bot15">
                                        @foreach($brand_product as $key=>$data_brand)
                                        <option value="{{$data_brand->brand_id}}">{{$data_brand->brand_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả</label>
                                    <textarea style="resize: none" rows="8" class="form-control" name="product_desc" placeholder="Mô tả" id="editor"></textarea>
                                </div>
                                 <div class="form-group">
                                    <label for="exampleInputPassword1">Nội dung</label>
                                    <textarea style="resize: none" rows="8" class="form-control" name="product_content" placeholder="Mô tả"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Hiển thị</label>
                                    <select name="status" class="form-control m-bot15">
		                                <option value="1">Hiển thị</option>
		                                <option value="0">Ẩn</option>
		                               
		                            </select>
                                </div>
                                
                                <button type="submit" name="add_product" class="btn btn-info">Thêm</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>
@endsection
@extends('adminIndex');
@section('content_main')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm danh mục sản phẩm
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/save-category-product')}}" method="post">
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
                                    <label for="exampleInputEmail1">Thêm danh mục</label>
                                    <input type="text" class="form-control" name="product_name" placeholder="Tên danh mục...">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả</label>
                                    <textarea style="resize: none" rows="8" class="form-control" name="product_desc" placeholder="Mô tả"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Hiển thị</label>
                                    <select name="status" class="form-control m-bot15">
		                                <option value="1">Hiển thị</option>
		                                <option value="0">Ẩn</option>
		                               
		                            </select>
                                </div>
                                
                                <button type="submit" name="add_category_product" class="btn btn-info">Thêm</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>
@endsection
@extends('adminIndex');
@section('content_main')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Cập nhập danh mục sản phẩm
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
                                @foreach($show_update as $key=>$result)
                                <form role="form" action="{{URL::to('/update-brand/'.$result->brand_id)}}" method="post">
                                    {{csrf_field()}}
                                 
                                
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Thêm danh mục</label>
                                    <input type="text" value="{{$result->brand_name}}" class="form-control" name="product_name" placeholder="Tên danh mục...">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả</label>
                                    <textarea style="resize: none" rows="8" class="form-control" name="product_desc" placeholder="Mô tả">{{$result->brand_desc}}</textarea>
                                </div>
                                @endforeach
                                <button type="submit" name="add_category_product" class="btn btn-info">Cập Nhập</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>
@endsection
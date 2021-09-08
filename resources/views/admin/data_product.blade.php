@extends('adminIndex');
@section('content_main')
    <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê sản phẩm
    </div>
    <div class="row w3-res-tb">
      <div class="col-sm-5 m-b-xs">
        <select class="input-sm form-control w-sm inline v-middle">
          <option value="0">Bulk action</option>
          <option value="1">Delete selected</option>
          <option value="2">Bulk edit</option>
          <option value="3">Export</option>
        </select>
        <button class="btn btn-sm btn-default">Apply</button>                
      </div>
      <div class="col-sm-4">
      </div>
      <div class="col-sm-3">
        <div class="input-group">
          <input type="text" class="input-sm form-control" placeholder="Search">
          <span class="input-group-btn">
            <button class="btn btn-sm btn-default" type="button">Go!</button>
          </span>
        </div>
      </div>
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <?php 
                    $message=Session('message');
                    if($message)
                    {
                      echo '<div class="alert alert-success" role="alert">'.$message.'</div>';
                      Session::put('message',null);
                    }
                  ?>
        <thead>
          <tr>
            <th style="width:20px;">
              <label class="i-checks m-b-none">
                <input type="checkbox"><i></i>
              </label>
            </th>
            <th>Tên sản phẩm</th>
            <th>Hình ảnh</th>
            <th>Giá</th>
            <th>Danh mục</th>
            <th>Thương hiệu</th>
            <th>Hiển thị</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($data_product as $key=>$data)
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>{{$data->product_name}}</td>
            <td><img src="public/upload/product/{{$data->product_image}}" width="70px" height="70px"></td>
            <td>{{$data->product_price}}</td>
            <td>{{$data->category_name}}</td>
            <td>{{$data->brand_name}}</td>
            <td><span class="text-ellipsis">
              <?php 
                if($data->product_status==1)
                {
               ?>
                 <a href="{{URL::to('/show-product/'.$data->product_id)}}"><i style="color:green;font-size:30px" class="fa fa-eye"></i></a>'
              <?php 
                }
                else{
              ?>
                  <a href="{{URL::to('/hide-product/'.$data->product_id)}}"><i style="color:red;font-size:30px" class="fa fa-eye-slash"></i></a>'
                <?php
                }
              ?>
            </span></td>
          
            <td>
              <a href="{{URL::to('/update-product/'.$data->product_id)}}" class="active" ui-toggle-class=""><i style="color:green;font-size:20px" class="fa fa-pencil-square-o text-success text-active"></i></a>
               <a onClick="return confirm('Bạn có muốn xóa không?')" href="{{URL::to('/delete-product/'.$data->product_id)}}" style="color:green;font-size:20px" class="active" ui-toggle-class=""><i class="fa fa-times text-danger text"></i></a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
      <div class="row">
        
        <div class="col-sm-5 text-center">
          <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
        </div>
        <div class="col-sm-7 text-right text-center-xs">                
          <ul class="pagination pagination-sm m-t-none m-b-none">
            <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
            <li><a href="">1</a></li>
            <li><a href="">2</a></li>
            <li><a href="">3</a></li>
            <li><a href="">4</a></li>
            <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
          </ul>
        </div>
      </div>
    </footer>
  </div>
</div>

 
@endsection
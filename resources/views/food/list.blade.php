@extends('voyager::master')

@section('page_header')
    <h1 class="page-title">
        <i class="voyager-list"></i> Danh sách sản phẩm
    </h1>
    &nbsp;
    <a href="{{ route('admin.food.add') }}" class="btn btn-success">
        <i class="voyager-plus"></i> Thêm mới
    </a>
@stop
@section('content')
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <table id="sample_1" class="table table-hover">
                            <thead>
                            <tr>
                                <th>STT</th>
                                <th>Ảnh</th>
                                <th>Tên Sản phẩm</th>
                                <th>Danh mục</th>
                                <th>Nhà cung cấp</th>
                                <th>Giá</th>
                                <th>Số lượng</th>
                                <th>Trạng thái</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($foods) > 0)
                                <?php $i = 0 ?>
                                @foreach($foods as $food)
                                    <tr>
                                        <td>{{ $i+=1 }}</td>
                                        <td><img width="100" src="{{ Voyager::image( $food->image ) }}" /> </td>
                                        <td>{{ $food->name }}</td>
                                        <td>{{ $food->id_category }}</td>
                                        <td>{{ $food->id_supplier }}</td>
                                        <td>{{ $food->price }}</td>
                                        <td>{{ $food->quantity }}</td>
                                        <td>{{ $food->status }}</td>
                                        <td>
                                            
                                            <a href="{{ route('admin.food.edit',$food->id) }}" title="Chỉnh sửa"
                                               class="btn-sm btn-primary edit">
                                                <i class="voyager-edit"></i> Sửa
                                            </a>
              
                                            <a href="{{ route('admin.food.duplicate', $food->id) }}"
                                               class="btn-sm btn-warning edit" title="Chi tiết">
                                                <i class="voyager-eye"></i> Sao chép
                                            </a>
                                     
                                            <a href="{{ route('admin.food.delete', $food->id) }}" class="btn-sm btn-danger delete" title="Xóa">
                                                <i class="voyager-trash"></i> Xóa
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('javascript')
    <script>

    </script>
@stop
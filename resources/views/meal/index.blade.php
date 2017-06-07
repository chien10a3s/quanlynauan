@extends('voyager::master')

@section('page_header')
    <h1 class="page-title">
        <i class="voyager-list"></i> Danh sách bữa ăn đã dùng
    </h1>
    &nbsp;
    <a href="{{ route('admin.kitchen.add') }}" class="btn btn-success">
        <i class="voyager-plus"></i> Add New
    </a>
@stop
@section('content')
    <div class="page-content container-fluid">
        <div class="row">
            <div class="panel panel-bordered col-md-12">
                <div class="panel-heading col-md-6">
                    <h3 class="panel-title">Ngày đăng ký</h3>
                    <div class="panel-body">
                        <input type="text" class="form-control" name="date">
                    </div>
                </div>
                <div class="panel-heading col-md-6">
                    <h3 class="panel-title">Số xuất ăn</h3>
                    <div class="panel-body">
                        <input type="number" class="form-control" name="number_of_meals">
                    </div>
                </div>
                <div class="panel-heading col-md-12">
                    <h3 class="panel-title">Món ăn</h3>
                    <div class="panel-body">
                        <input type="text" class="form-control" name="date">
                    </div>
                    <div class="form-group col-md-3">

                    </div>
                    <button class="btn btn-success"><i class="voyager-plus"> </i> Thêm nguyên liệu</button>
                </div>
                <button class="btn btn-success"><i class="voyager-plus"> </i> Thêm món</button>
            </div>
        </div>
    </div>
@stop

@section('javascript')
    <!-- DataTables -->
@stop
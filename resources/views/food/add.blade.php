@extends('voyager::master')
@section('css')
    <style>
        .panel .mce-panel {
            border-left-color: #fff;
            border-right-color: #fff;
        }

        .panel .mce-toolbar,
        .panel .mce-statusbar {
            padding-left: 20px;
        }

        .panel .mce-edit-area,
        .panel .mce-edit-area iframe,
        .panel .mce-edit-area iframe html {
            padding: 0 10px;
            min-height: 350px;
        }

        .mce-content-body {
            color: #555;
            font-size: 14px;
        }

        .panel.is-fullscreen .mce-statusbar {
            position: absolute;
            bottom: 0;
            width: 100%;
            z-index: 200000;
        }

        .panel.is-fullscreen .mce-tinymce {
            height:100%;
        }

        .panel.is-fullscreen .mce-edit-area,
        .panel.is-fullscreen .mce-edit-area iframe,
        .panel.is-fullscreen .mce-edit-area iframe html {
            height: 100%;
            position: absolute;
            width: 99%;
            overflow-y: scroll;
            overflow-x: hidden;
            min-height: 100%;
        }
    </style>
@stop
@section('page_header')
    <h1 class="page-title">
        <i class="voyager-plus"></i> Thêm sản phẩm
    </h1>
@stop

@section('content')
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">

                    <div class="panel-heading">
                        <h3 class="panel-title">Thông tin sản phẩm</h3>
                    </div>
                    <div class="panel-body">
                        <form id="my_form" action="{{ route('admin.food.store') }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label>
                                    Tên sản phẩm
                                </label>
                                <input class="form-control" name="name">
                            </div>
                            <div class="form-group">
                                <label>
                                    Mô tả
                                </label>
                                <textarea class="form-control" name="description"></textarea>
                            </div>
                            
                            <div class="form-group">
                                <label>
                                    Ảnh
                                </label>
                                <input type="file" name="image" />
                            </div>
                            
                            <div class="form-group">
                                <label>
                                    Đơn vị
                                </label>
                                <select name="unit" class="form-control">
                                    <option value="kg">Kilogram</option>
                                    <option value="gr">Gram</option>
                                    <option value="litre">Lít</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label>
                                    Số lượng
                                </label>
                                <input type="number" class="form-control" name="quantity"/>
                            </div>
                            
                            <div class="form-group">
                                <label>
                                    Số tiền
                                </label>
                                <input type="number" class="form-control" name="price"/>
                            </div>
                            
                            <div class="form-group">
                                <label>
                                    Danh mục
                                </label>
                                <select name="id_category" class="form-control">
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label>
                                    Nhà cung cấp
                                </label>
                                <select name="id_supplier" class="form-control">
                                    @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}">{{$supplier->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label>
                                    Trạng thái
                                </label>
                                <select name="status" class="form-control">
                                    <option value="0">Vô hiệu</option>
                                    <option value="1">Hoạt động</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <button class="btn btn-success" type="submit">Thêm mới</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('javascript')
<script src="{{ voyager_asset('lib/js/tinymce/tinymce.min.js') }}"></script>
<script src="{{ voyager_asset('js/voyager_tinymce.js') }}"></script>
@stop
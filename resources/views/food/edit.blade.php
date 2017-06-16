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
        <i class="voyager-plus"></i> Sửa sản phẩm
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
                        <form id="my_form" action="{{ route('admin.food.update', $food->id) }}" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="{{ $food->id }}" />
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label>
                                    Tên sản phẩm
                                </label>
                                <input class="form-control" name="name" value="{{ $food->name }}">
                            </div>
                            <div class="form-group">
                                <label>
                                    Mô tả
                                </label>
                                <textarea class="form-control" name="description">{{ $food->description }}</textarea>
                            </div>
                            
                            <div class="form-group">
                                <label>
                                    Ảnh
                                </label>
                                <img src="{{ Voyager::image( $food->image ) }}" style="width:200px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:10px;">
                                <input type="file" name="image" />
                            </div>
                            
                            <div class="form-group">
                                <label>
                                    Đơn vị
                                </label>
                                <select name="unit" class="form-control">
                                    <option @if($food->unit == "kg")selected="selected"@endif value="kg">Kilogram</option>
                                    <option @if($food->unit == "gr")selected="selected"@endif value="gr">Gram</option>
                                    <option @if($food->unit == "litre")selected="selected"@endif value="litre">Lít</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label>
                                    Số lượng
                                </label>
                                <input value="{{ $food->quantity }}" type="number" class="form-control" name="quantity"/>
                            </div>
                            
                            <div class="form-group">
                                <label>
                                    Số tiền
                                </label>
                                <input value="{{ $food->price }}" type="number" class="form-control" name="price"/>
                            </div>
                            
                            <div class="form-group">
                                <label>
                                    Danh mục
                                </label>
                                <select name="id_category" class="form-control">
                                    @foreach($categories as $category)
                                    <option @if($food->id_category == $category->id)selected="selected"@endif value="{{ $category->id }}">{{$category->name}}</option>
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
                                    <option @if($food->status == 1)selected="selected"@endif value="1">Hoạt động</option>
                                    <option @if($food->status == 0)selected="selected"@endif value="0">Vô hiệu</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <button class="btn btn-success" type="submit">Lưu lại</button>
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
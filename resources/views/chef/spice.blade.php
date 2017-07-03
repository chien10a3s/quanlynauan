@extends('voyager::master')

@section('page_header')
    <h1 class="page-title">
        <i class="voyager-list"></i> Danh sách nhà cung cấp
    </h1>
    &nbsp;
    <a href="{{ route('supplier.create') }}" class="btn btn-success">
        <i class="voyager-plus"></i> Mua thêm gia vị
    </a>
@stop

@section('css')
    <style>
        form.delete-form {
            display: inline-block;
        }
    </style>
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
                                <th>Tên</th>
                                <th>Ảnh</th>
                                <th>Thông tin</th>
                                <th>Trạng thái</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data['spice'] as $index => $item)
                                <tr>
                                    <td>{{$index+1}}</td>
                                    <td>{{@$item->food_spice->name}}</td>
                                    <td style="text-align: center;">
                                        <img class="img-circle" style="width: 30px; height: 30px;"
                                             src="{{ asset( \App\Helpers\CommonHelper::getPublicImagePath(@$item->food_spice->image) ) }}">
                                    </td>
                                    <td>
                                        - Số lượng: {{@$item->food_spice->quantity}} {{@$item->food_spice->unit}} <br>
                                        - Đơn giá: <span class="number-format">{{@$item->food_spice->price}}</span>
                                    </td>
                                    <td>
                                        @if($item->status == 0)
                                            <span class="label label-default">Hết</span>
                                        @elseif($item->status == 1)
                                            <span class="label label-warning">Sắp hết</span>
                                        @elseif($item->status == 2)
                                            <span class="label label-success">Còn</span>
                                        @elseif($item->status == 3)
                                            <span class="label label-success">Hủy (không dùng)</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a class="btn-sm btn-primary" style="cursor: pointer;"
                                           title="Cập nhật gia vị"
                                           data-toggle="modal"
                                           data-target="#edit{{@$item->id}}">
                                            <i class="voyager-edit"></i>
                                        </a> &nbsp;

                                        <div class="modal fade" id="edit{{$item->id}}" role="dialog"
                                             tabindex="1">
                                            <div class="modal-dialog">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header"
                                                         style="background: #337ab7; color: #fff;">
                                                        <button type="button" class="close" data-dismiss="modal">
                                                            &times;
                                                        </button>
                                                        <h4 class="modal-title"><i class="voyager-edit"></i> Sửa
                                                            món {{@$item->food->name}}
                                                        </h4>
                                                    </div>
                                                    {!! Form::model($item, ['route' => ['admin.chef.food-over.update', $item->id], 'class' => 'form-horizontal', 'role' => 'form','method' => 'PUT']) !!}
                                                    <div class="modal-body">
                                                        <div class="form-group col-md-12">
                                                            <label class="control-label col-md-4">Tên gia vị</label>
                                                            <div class="col-md-8">
                                                                {!! Form::text('name', $item->food_spice->name, ['class' => 'form-control', 'required'=>true]) !!}
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label class="control-label col-md-4">Số lượng</label>
                                                            <div class="col-md-8">
                                                                {!! Form::text('quantity', $item->food_spice->quantity, ['class' => 'form-control', 'required'=>true]) !!}
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label class="control-label col-md-4">Đơn vị</label>
                                                            <div class="col-md-8">
                                                                {!! Form::text('unit', $item->food_spice->unit, ['class' => 'form-control', 'required'=>true]) !!}
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label class="control-label col-md-4">Đơn giá</label>
                                                            <div class="col-md-8">
                                                                {!! Form::text('price', @$item->food_spice->price, ['class' => 'form-control number-format-edit', 'required'=>true, 'placeholder' => 'VND', 'maxlength' => "8"]) !!}
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label class="control-label col-md-4">Ngày</label>
                                                            <div class="col-md-8">
                                                                {!! Form::text('date', isset($item->date) ? \Carbon\Carbon::parse($item->date)->format('d/m/y H:i:s') : null, ['class' => 'form-control date_time', 'required'=>true]) !!}
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label class="control-label col-md-4">Ghi chú</label>
                                                            <div class="col-md-8">
                                                                {!! Form::textarea('description', $item->food_spice->description, ['class' => 'form-control', 'required'=>true, 'rows' => 3]) !!}
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label class="control-label col-md-4">Ngày</label>
                                                            <div class="col-md-8">
                                                                {!! Form::select('status', [0 => 'Hết', 1 => 'Sắp hết', 2 => 'Còn', 3 => 'Hủy không dùng'], $item->status, ['class' => 'form-control', 'required'=>true]) !!}
                                                            </div>
                                                        </div>
                                                        <div style="clear: both;"></div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-success">Lưu
                                                        </button>
                                                        <button type="button" class="btn btn-default"
                                                                data-dismiss="modal">Close
                                                        </button>
                                                    </div>
                                                    {!! Form::close() !!}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('javascript')
    <script type="text/javascript" src="/js/jquery-number-master/jquery.number.min.js"></script>
    <script>
        $(document).ready(function () {
            var table = $('#sample_1').DataTable({
                "order": []
            });
            $(table.table().container()).removeClass('form-inline');
            $('.number-format').number(true);
            $('.number-format-edit').number(true);
        });
    </script>
@stop
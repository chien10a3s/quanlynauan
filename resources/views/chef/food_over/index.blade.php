@extends('voyager::master')

@section('page_header')
    <h1 class="page-title">
        <i class="voyager-list"></i> Thức ăn thừa của <span style="color: red;">{{@$data['kitchen']->name}}</span>
    </h1>
    <a  class="btn btn-success" data-toggle="modal" data-target="#modal_add">
        <i class="voyager-plus"></i> Thêm thức ăn thừa
    </a>
    <link rel="stylesheet" type="text/css"
          href="{{ voyager_asset('lib/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}">
    <style>
        a, a:hover {
            text-decoration: none !important;
        }

        .modal-header {
            border-bottom: 1px solid #e5e5e5 !important;
        }

        .modal-footer {
            border-top: 1px solid #e5e5e5 !important;
        }

        .modal-body span {
            text-align: center;
        }

        h5 {
            margin-bottom: 0px;
        }

        .item-meal {
            margin-bottom: 20px;
        }

        .btn {
            font-size: 13px;
        }

        /*.form-inline .form-group{*/
        /*margin-bottom: 15px;*/
        /*}*/
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
                                <th>Thực phẩm</th>
                                <th>Số lượng thừa</th>
                                <th>Ngày thừa</th>
                                <th>Lưu ý</th>
                                <th>Trạng thái</th>
                                <th class="actions col-md-4">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($data['food_over']) > 0)
                                <?php $i = 1; ?>
                                @foreach($data['food_over'] as $item)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{@$item->food->name}}</td>
                                        <td>{{@$item->quantity}} {{$item->unit}}</td>
                                        <td>{{\Carbon\Carbon::parse(@$item->date)->format('d/m/Y H:i')}}</td>
                                        <td>{{@$item->description}}</td>
                                        <td>
                                            @if($item->status == 0)
                                                <span class="label label-sm label-success">Đang thừa</span>
                                            @elseif($item->status == 1)
                                                <span class="label label-warning">Đã hết</span>
                                            @else
                                                <span class="label label-danger">Hủy bỏ(Không dùng nữa)</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a class="btn-sm btn-primary" style="cursor: pointer;"
                                               title="Sửa"
                                               data-toggle="modal"
                                               data-target="#edit_food_over{{$item->id}}">
                                                Sửa
                                            </a> &nbsp;
                                            <a class="btn-sm btn-danger" style="cursor: pointer;"
                                               title="Sửa"
                                               data-toggle="modal"
                                               data-target="#delete_food_over{{$item->id}}">
                                                Xóa
                                            </a> &nbsp;
                                            <div class="modal fade" id="edit_food_over{{$item->id}}" role="dialog"
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
                                                                <label class="control-label col-md-4">Chọn thực
                                                                    phẩm</label>
                                                                <div class="col-md-8">
                                                                    <select class="form-control" name="food_id" required>
                                                                        <option value="">Chọn thực phẩm</option>
                                                                        @foreach($data['food'] as $food)
                                                                            <option value="{{$food->id}}" @if($item->food_id == $food->id) selected @endif>{{$food->name}} ({{$food->quantity}} {{$food->quantity}} - Đơn giá {{$food->price}})</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-md-12">
                                                                <label class="control-label col-md-4">Số lượng</label>
                                                                <div class="col-md-8">
                                                                    {!! Form::text('quantity', $item->quantity, ['class' => 'form-control', 'required'=>true]) !!}
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-md-12">
                                                                <label class="control-label col-md-4">Đơn vị</label>
                                                                <div class="col-md-8">
                                                                    {!! Form::text('unit', $item->unit, ['class' => 'form-control', 'required'=>true]) !!}
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
                                                                    {!! Form::textarea('description', $item->unit, ['class' => 'form-control', 'required'=>true, 'rows' => 3]) !!}
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-md-12">
                                                                <label class="control-label col-md-4">Ngày</label>
                                                                <div class="col-md-8">
                                                                    {!! Form::select('status', [0 => 'Đang thừa', 1 => 'Đã hết', 2 => 'Hủy bỏ'], $item->status, ['class' => 'form-control', 'required'=>true]) !!}
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

                                            <div class="modal fade" id="delete_food_over{{$item->id}}" role="dialog"
                                                 tabindex="1">
                                                <div class="modal-dialog">
                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-header"
                                                             style="background: #337ab7; color: #fff;">
                                                            <button type="button" class="close" data-dismiss="modal">
                                                                &times;
                                                            </button>
                                                            <h4 class="modal-title"><i class="voyager-edit"></i> Xóa
                                                                món {{@$item->food->name}}
                                                            </h4>
                                                        </div>
                                                        {!! Form::model($item, ['route' => ['admin.chef.food-over.delete', $item->id], 'class' => 'form-horizontal', 'role' => 'form','method' => 'DELETE']) !!}
                                                        <div class="modal-body">
                                                            <div class="form-group col-md-12">
                                                                Bạn có chắc chắn muốn xóa không?
                                                            </div>
                                                            <div style="clear: both;"></div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-success">Xóa
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
                            @endif
                            </tbody>
                        </table>
                        <div class="modal fade" id="modal_add" role="dialog">
                            <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header"
                                         style="background: #337ab7; color: #fff;">
                                        <button type="button" class="close" data-dismiss="modal">
                                            &times;
                                        </button>
                                        <h4 class="modal-title"><i class="voyager-edit"></i> Thêm thức ăn thừa
                                        </h4>
                                    </div>
                                    {!! Form::open(['route' => ['admin.chef.food-over.store', $data['kitchen']->id], 'class' => 'form-horizontal', 'role' => 'form','method' => 'PATCH']) !!}
                                    <div class="modal-body">
                                        <div class="form-group col-md-12">
                                            <label class="control-label col-md-4">Chọn thực
                                                phẩm</label>
                                            <div class="col-md-8">
                                                <select class="form-control" name="food_id" required>
                                                    <option value="">Chọn thực phẩm</option>
                                                    @foreach($data['food'] as $food)
                                                        <option value="{{$food->id}}">{{$food->name}} ({{$food->quantity}} {{$food->quantity}} - Đơn giá {{$food->price}})</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label class="control-label col-md-4">Số lượng</label>
                                            <div class="col-md-8">
                                                {!! Form::text('quantity', null, ['class' => 'form-control', 'required'=>true]) !!}
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label class="control-label col-md-4">Đơn vị</label>
                                            <div class="col-md-8">
                                                {!! Form::text('unit', null, ['class' => 'form-control', 'required'=>true]) !!}
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label class="control-label col-md-4">Ngày</label>
                                            <div class="col-md-8">
                                                {!! Form::text('date', null, ['class' => 'form-control date_time', 'required'=>true]) !!}
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label class="control-label col-md-4">Ghi chú</label>
                                            <div class="col-md-8">
                                                {!! Form::textarea('description', null, ['class' => 'form-control', 'required'=>true, 'rows' => 3]) !!}
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label class="control-label col-md-4">Ngày</label>
                                            <div class="col-md-8">
                                                {!! Form::select('status', [0 => 'Đang thừa', 1 => 'Đã hết', 2 => 'Hủy bỏ'], null, ['class' => 'form-control', 'required'=>true]) !!}
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('javascript')
    <script type="text/javascript" src="/js/jquery-number-master/jquery.number.min.js"></script>
    <script type="text/javascript"
            src="{{ voyager_asset('lib/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>
    <!-- DataTables -->
    <script>
        $(document).ready(function () {
            var table = $('#sample_1').DataTable({
                "order": []
            });
            $(table.table().container()).removeClass('form-inline');
            $('.number-format').number(true);
            $('.number-format-edit').number(true);
        });
        $('.date_time').datetimepicker({
            startDate: new Date(),
            todayBtn: true,
            language: "en",
            autoclose: true,
            todayHighlight: true,
            format: 'dd/mm/yyyy hh:ii:ss'
        });

    </script>
@stop
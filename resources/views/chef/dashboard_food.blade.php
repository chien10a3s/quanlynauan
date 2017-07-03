@extends('voyager::master')

@section('page_header')

    <h1 class="page-title">
        <i class="voyager-calendar"></i> Xem danh sách thực phẩm cần mua
    </h1>
    <link rel="stylesheet" type="text/css" href="{{asset('css/components.min.css')}}">
    @include('chef.navbar')
    <style>
        a, a:hover {
            text-decoration: none !important;
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

        .list-meal {
            padding: 10px !important;
        }

        .list-meal:not(:last-child) {
            border-bottom: 1px solid #ddd !important;
        }

        #sample_1 thead tr th {
            text-align: center;
        }
        .flat-blue .nav-tabs{
            background-color: #f9f9f9 !important;
        }
        .page-title{
            padding-top: 4px;
            height: 50px;
        }
        .page-title > i{
            top: 5px !important;
        }
    </style>
@stop

@section('content')
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        {{ Form::open(['route' => ['admin.chef.dashboard.supplier'], 'class' => 'form-horizontal', 'role' => 'form','method' => 'GET', 'style' => 'margin-bottom: 40px']) }}
                        <div class="input-group col-md-3" style="float: left;">
                            {{ Form::select('id_supplier', $data['supplier'], null, ['class' => 'form-control', 'placeholder' => 'Chọn danh mục']) }}
                        </div>
                        <button type="submit" class="btn btn-success" style="margin-left: 5px; margin-top: 0px;">
                            Xem
                        </button>
                        <a href="{{route('admin.chef.dashboard.food')}}" type="button" class="btn btn-warning" style="margin-left: 5px; margin-top: 0px;">
                            Xem tất cả
                        </a>
                        {{ Form::close() }}
                        <!-- /.box-header -->
                        <table class="table table-bordered" id="sample_1">
                            <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên thực phẩm</th>
                                <th>Ảnh</th>
                                <th>Số lượng</th>
                                <th>Nhà cung cấp</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 1 ?>
                            @foreach($data['food'] as $id_food => $food)
                                <tr>
                                    <td>{{@$i++}}</td>
                                    <td><b>{{@$food['name']}}</b></td>
                                    <td style="text-align: center;">
                                        <img class="img-circle" style="width: 30px; height: 30px;"
                                             src="{{ asset( \App\Helpers\CommonHelper::getPublicImagePath($food['image']) ) }}">
                                    </td>
                                    <td>
                                        - {{@$food['total_number']}} {{$food['unit']}} <br>
                                        - <span class="number-format">{{$food['price']}}</span> VND/{{$food['unit']}}
                                    </td>
                                    <td>
                                        {{@$food['supplier_name']}}
                                    </td>
                                    <td>
                                        <a class="btn-sm btn-warning" style="cursor: pointer;"
                                           title="Xem chi tiết thực đơn"
                                           data-toggle="modal"
                                           data-target="#detail_meal{{@$id_food}}">
                                            <i class="voyager-eye"></i>
                                        </a> &nbsp;
                                        <div class="modal fade" id="detail_meal{{@$id_food}}" role="dialog">
                                            <div class="modal-dialog">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header"
                                                         style="background: #5bc0de; color: #fff;">
                                                        <button type="button" class="close" data-dismiss="modal">
                                                            &times;
                                                        </button>
                                                        <h4 class="modal-title"><i class="voyager-eye"></i> Các khách
                                                            hàng đã đặt {{@$food['name']}}
                                                        </h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        @foreach($food['kitchen'] as $key_kitchen => $kitchen)
                                                            <h3>{{$kitchen->name}}</h3>
                                                                &nbsp;+ Tài khoản: <span class="number-format">{{@$kitchen->money}}</span> VND <br>
                                                                &nbsp;+ Địa chỉ: <span>{{@$kitchen->address}}</span> <br>
                                                                &nbsp;+ Số lượng đặt mua: <span>{{@$food['number'][$key_kitchen]}}</span> {{$food['unit']}} <br>
                                                        @endforeach
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default"
                                                                data-dismiss="modal">Close
                                                        </button>
                                                    </div>
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
            $('#sample_1').DataTable({
                "order": [],
                "language": {
                    "emptyTable": "Không có thực phẩm"
                },
            });
            $('.number-format').number(true);
        });
    </script>
@stop
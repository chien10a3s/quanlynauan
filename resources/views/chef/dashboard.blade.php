@extends('voyager::master')

@section('page_header')

    <h1 class="page-title">
        <i class="voyager-calendar"></i> Ngày hôm nay có {{$data['count_meal']}} hóa đơn
    </h1>
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
        .list-meal{
            padding: 10px !important;
        }
        .list-meal:not(:last-child){
            border-bottom: 1px solid #ddd !important;
        }
    </style>
@stop

@section('content')
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        {{--<div class="box-header with-border">--}}
                        {{--<h3 class="box-title">Hôm nay có 3 hóa đơn</h3>--}}
                        {{--</div>--}}
                                <!-- /.box-header -->
                        <table class="table table-bordered" id="sample_1">
                            <thead>
                            <tr>
                                <th>STT</th>
                                <th><b>Tên bếp</b></th>
                                <th>Tài khoản</th>
                                <th>Avatar</th>
                                <th>Địa chỉ</th>
                                <th>Chi tiết</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data['kitchen'] as $key => $kitchen)
                                <tr>
                                    <td>{{@$key+1}}</td>
                                    <td><b>{{@$kitchen->name}}</b></td>
                                    <td><span class="number-format">{{@$kitchen->money}}</span></td>
                                    <td style="text-align: center;">
                                        <img class="img-circle" style="width: 30px; height: 30px;"
                                             src="{{ asset( \App\Helpers\CommonHelper::getPublicImagePath($kitchen->avatar) ) }}">
                                    </td>
                                    <td>{{@$kitchen->address}}</td>
                                    <td>
                                        <a class="btn-sm btn-warning" style="cursor: pointer;"
                                           title="Xem chi tiết thực đơn"
                                           data-toggle="modal"
                                           data-target="#detail_meal{{@$kitchen->id}}">
                                            <i class="voyager-eye"></i>
                                        </a> &nbsp;
                                        <div class="modal fade" id="detail_meal{{@$kitchen->id}}" role="dialog">
                                            <div class="modal-dialog">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header"
                                                         style="background: #5bc0de; color: #fff;">
                                                        <button type="button" class="close" data-dismiss="modal">
                                                            &times;
                                                        </button>
                                                        <h4 class="modal-title"><i class="voyager-eye"></i> Danh sách
                                                            thực
                                                            đơn của {{@$kitchen->name}}
                                                        </h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        @if(count($kitchen->daily_meal) > 0)
                                                            @foreach($kitchen->daily_meal as $key_meal => $item)
                                                                @if(count($item->daily_dish) > 0)
                                                                    <div class="list-meal">
                                                                        <h4>Thực đơn thứ {{$key_meal+1}}</h4>
                                                                        @foreach($item->daily_dish as $dish)
                                                                            <div class="item-meal"
                                                                                 style="padding-left: 10px;">
                                                                                <h5>- Món ăn: {{$dish->name}}</h5>
                                                                            <span><i>&nbsp;(Lưu
                                                                                    ý: {{$dish->cooking_note}}
                                                                                    )</i></span> <br>

                                                                                @if(count($dish->detail_dish) > 0)
                                                                                    @foreach($dish->detail_dish as $detail)
                                                                                        + {{$detail->number}} {{$detail->unit}} {{$detail->food->name}}
                                                                                        (Đơn giá: <span
                                                                                                class="number-format">{{$detail->money}}</span>
                                                                                        VND) <br>
                                                                                    @endforeach
                                                                                @endif
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        @endif

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
                    "emptyTable": "Không có bếp"
                },
            });
            $('.number-format').number(true);
        });
    </script>
@stop
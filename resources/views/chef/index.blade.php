@extends('voyager::master')

@section('page_header')

    <h1 class="page-title">
        <i class="voyager-list"></i> Danh sách bếp
    </h1>
    @include('chef.navbar')
    <style>
        a, a:hover {
            text-decoration: none !important;
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
                                <th>Tên bếp</th>
                                <th>Tài khoản</th>
                                <th>Địa chỉ</th>
                                <th>Trạng thái</th>
                                {{--<th>Số thực đơn</th>--}}
                                <th class="actions col-md-4">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($data['kitchen']) > 0)
                                <?php $i = 0 ?>
                                @foreach($data['kitchen'] as $item)
                                    <tr>
                                        <td>{{ @$item['index'] }}</td>
                                        <td>{{ @$item['name'] }}</td>
                                        <td><span class="number-format">{{ @$item['money'] }}</span> VND</td>
                                        <td>{{ @$item['address'] }}</td>
                                        <td>
                                            @if($item['status'] == 0 )
                                                <span class="label label-danger">Đang khóa</span>
                                            @else
                                                <span class="label label-success">Đang kích hoạt</span>
                                            @endif
                                        </td>
                                        {{--<td>--}}
                                        {{--{{ @$item['count_meal'] }}--}}
                                        {{--</td>--}}
                                        <td>
                                            <a href="{{ route('admin.chef.meal', $item['id']) }}"
                                               class="btn-sm btn-warning" title="Danh sách thực đơn">
                                                <i class="voyager-eyes"></i>Thực đơn
                                            </a>&nbsp;

                                            <a href="{{ route('admin.chef.feedback', $item['id']) }}"
                                               class="btn-sm btn-warning" title="Danh sách feedback">
                                                <i class="voyager-comment"></i>Feedback
                                            </a>&nbsp;

                                            <a href="{{ route('admin.chef.spice', $item['id']) }}"
                                               class="btn-sm btn-warning" title="Danh sách thực đơn">
                                                <i class="voyager-eyes"></i>Gia vị
                                            </a>&nbsp;
                                            <a href="{{ route('admin.chef.food-over', $item['id']) }}"
                                               class="btn-sm btn-warning" title="Danh sách thực đơn">
                                                <i class="voyager-eyes"></i>Thức ăn thừa
                                            </a>&nbsp;
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
    <script src="/js/jquery-number-master/jquery.number.min.js"></script>
    <script type="text/javascript" src="{{ voyager_asset('lib/js/bootstrap.min.js') }}"></script>
    <!-- DataTables -->
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
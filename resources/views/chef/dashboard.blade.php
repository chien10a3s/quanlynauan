@extends('voyager::master')

@section('page_header')

    <h1 class="page-title">
        <i class="voyager-calendar"></i> Ngày hôm nay có gì?
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
        <div class="col-md-12">
            <div class="panel panel-bordered">
                <div class="panel-body">
                    <div class="box-header with-border">
                        <h3 class="box-title">Hôm nay có 3 hóa đơn</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered" id="sample_1">
                            <thead>
                            <tr>
                                <th>STT</th>
                                <th><b>Tên bếp</b></th>
                                <th>Tài khoản</th>
                                <th>Địa chỉ</th>
                                <th>Chi tiết</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>1</td>
                                <td><b>Bếp số 2</b></td>
                                <td>Nguyễn Xuân Tiến</td>
                                <td>Số 2, ngõ 59 Láng Hạ, Ba Đình, Hà Nội</td>
                                <td>aa</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="panel-body">
                    <div class="box-header with-border">
                        <h3 class="box-title">Hôm nay có 3 hóa đơn</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered" id="sample_1">
                            <thead>
                            <tr>
                                <th>STT</th>
                                <th><b>Tên bếp</b></th>
                                <th>Tài khoản</th>
                                <th>Địa chỉ</th>
                                <th>Chi tiết</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>1</td>
                                <td><b>Bếp số 2</b></td>
                                <td>Nguyễn Xuân Tiến</td>
                                <td>Số 2, ngõ 59 Láng Hạ, Ba Đình, Hà Nội</td>
                                <td>aa</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('javascript')
    <script type="text/javascript" src="{{ voyager_asset('lib/js/bootstrap.min.js') }}"></script>
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
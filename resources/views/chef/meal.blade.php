@extends('voyager::master')

@section('page_header')
    <h1 class="page-title">
        <i class="voyager-list"></i> Thực đơn của <span style="color: red;">{{@$data['kitchen']->name}} ngày {{ \Carbon\Carbon::parse($data['date'])->format('d/m/Y') }}</span>
    </h1>
    <style>
        a, a:hover{
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
                                <th>Ngày</th>
                                <th>Số bữa ăn</th>
                                <th>Tổng tiền</th>
                                <th class="actions col-md-4">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($data['meals']) > 0)
                                <?php $i = 0 ?>
                                @foreach($data['meals'] as $item)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{\Carbon\Carbon::parse(@$item->day)->format('d/m/Y')}}</td>
                                        <td>{{@$item->number_of_meals}}</td>
                                        <td><span class="number-format">{{ @$item->money_meals }}</span> VND</td>
                                        <td>
                                            <a href="{{ route('admin.kitchen.detail', $item['id']) }}"
                                               class="btn-sm btn-warning" title="Chi tiết">
                                                <i class="voyager-eye"></i> Xem chi tiết thực đơn
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
    <script src="/js/jquery-number-master/jquery.number.min.js"></script>
    <!-- DataTables -->
    <script>
        $(document).ready(function () {
            $('#sample_1').DataTable({"order": []});
            $('.number-format').number(true);
        });
    </script>
@stop
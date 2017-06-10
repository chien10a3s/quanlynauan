@extends('voyager::master')

@section('page_header')
    <h1 class="page-title">
        <i class="voyager-list"></i> Danh sách bếp
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
                                <th>Tên bếp</th>
                                <th>Tài khoản</th>
                                <th>Địa chỉ</th>
                                <th>Trạng thái</th>
                                <th>Số hóa đơn</th>
                                <th class="actions col-md-4">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($data['kitchen']) > 0)
                                <?php $i = 0 ?>
                                @foreach($data['kitchen'] as $item)
                                    <tr>
                                        <td>{{ @$item['index'] }}</td>
                                        <td><a href="{{route('admin.chef.meal', $item['id'])}}">{{ @$item['name'] }}</a></td>
                                        <td><span class="number-format">{{ @$item['money'] }}</span> VND</td>
                                        <td>{{ @$item['address'] }}</td>
                                        <td>
                                            @if($item['status'] == 0 )
                                                <span class="label label-danger">Đang khóa</span>
                                            @else
                                                <span class="label label-success">Đang kích hoạt</span>
                                            @endif
                                        </td>
                                        <td>
                                            {{ @$item['count_meal'] }}
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.kitchen.detail', $item['id']) }}"
                                               class="btn-sm btn-warning" title="Chi tiết">
                                                <i class="voyager-eye"></i> Hóa đơn
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
        //        $('td').on('click', '.delete', function (e) {
        //            var form = $('#delete_form')[0];
        //
        //            form.action = parseActionUrl(form.action, $(this).data('id'));
        //
        //            $('#delete_modal').modal('show');
        //        });

        function parseActionUrl(action, id) {
            return action.match(/\/[0-9]+$/)
                ? action.replace(/([0-9]+$)/, id)
                : action + '/' + id;
        }
    </script>
@stop
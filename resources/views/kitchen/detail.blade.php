@extends('voyager::master')

@section('page_header')
    <h1 class="page-title font-green">
        <i class="voyager-info-circled"></i> Thông tin chi tiết bếp
    </h1>
@stop
@section('content')
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-heading">
                        <h3 class="panel-title">Mã bếp</h3>
                        <div class="panel-body">
                            {{ $data->code }}
                        </div>
                    </div>

                    <div class="panel-heading">
                        <h3 class="panel-title">Tên bếp</h3>
                        <div class="panel-body">
                            {{ $data->name }}
                        </div>
                    </div>

                    <div class="panel-heading">
                        <h3 class="panel-title">Trạng thái</h3>
                        <div class="panel-body">
                            @if($data->status == 0 )
                                <span class="label label-danger">Đang khóa</span>
                            @else
                                <span class="label label-success">Đang kích hoạt</span>
                            @endif
                        </div>
                    </div>

                    <div class="panel-heading">
                        <h3 class="panel-title">Số tiền</h3>
                        <div class="panel-body">
                            {{ number_format($data->money) }}
                        </div>
                    </div>

                    <div class="panel-heading">
                        <h3 class="panel-title">Địa chỉ</h3>
                        <div class="panel-body">
                            {{ $data->address }}
                        </div>
                    </div>

                    <div class="panel-heading">
                        <h3 class="panel-title">Ghi chú</h3>
                        <div class="panel-body">
                            {{ $data->note }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('javascript')
    <!-- DataTables -->
    <script>
        $(document).ready(function () {
            $(document).ready(function () {
                $('#sample_1').DataTable({"order": []});
            });
        });
        $('td').on('click', '.delete', function (e) {
            var form = $('#delete_form')[0];

            form.action = parseActionUrl(form.action, $(this).data('id'));

            $('#delete_modal').modal('show');
        });

        function parseActionUrl(action, id) {
            return action.match(/\/[0-9]+$/)
                ? action.replace(/([0-9]+$)/, id)
                : action + '/' + id;
        }
    </script>
@stop
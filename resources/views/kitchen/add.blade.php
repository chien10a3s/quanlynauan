@extends('voyager::master')

@section('page_header')
    <h1 class="page-title">
        <i class="voyager-plus"></i> Thêm mới bếp
    </h1>
@stop
@section('content')
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">

                    <div class="panel-heading">
                        <h3 class="panel-title">Thông tin bếp</h3>
                    </div>
                    <div class="panel-body">
                        <form id="my_form" class="form-horizontal" action="{{ route('admin.kitchen.store') }}" method="post">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-4 control-label">
                                            Mã bếp
                                        </label>
                                        <div class="col-md-8">
                                            <input class="form-control" name="code">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-4 control-label">
                                            Tên bếp
                                        </label>
                                        <div class="col-md-8">
                                            <input class="form-control " name="name">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-4 control-label">
                                            Trạng thái
                                        </label>
                                        <div class="col-md-8">
                                            <select class="form-control" name="status">
                                                <option value="">Chọn trạng thái</option>
                                                <option value="0">Đang khóa</option>
                                                <option value="1">Kích hoạt</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-4 control-label">
                                            Số tiền
                                        </label>
                                        <div class="col-md-8">
                                            <input type="number" class="form-control" name="money">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-4 control-label">
                                            Địa chỉ
                                        </label>
                                        <div class="col-md-8">
                                            <textarea class="form-control col-md-8" name="address"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-4 control-label">
                                            Ghi chú
                                        </label>
                                        <div class="col-md-8">
                                            <textarea class="form-control col-md-8" name="note"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <button class="btn btn-success pull-right" type="submit">Thêm mới</button>
                                        </div>
                                    </div>
                                </div>

                            </div>


                            
                            
                        </form>
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
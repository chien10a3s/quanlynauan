@extends('voyager::master')

@section('page_header')
    <h1 class="page-title">
        <i class="voyager-edit"></i> Chỉnh sửa thông tin bếp
    </h1>
@stop
@section('content')
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">

                    <div class="panel-heading">
                        <h3 class="panel-title">Chỉnh sửa bếp</h3>
                    </div>
                    <div class="panel-body">
                        <form id="my_form" action="{{ route('admin.kitchen.update',$data->id) }}" method="post">
                            {{ csrf_field() }}
                            <div class="col-md-12 form-group">
                                <label class="col-md-4">
                                    Mã bếp
                                </label>
                                <input disabled class="form-control col-md-8" name="code" value="{{ $data->code }}">
                            </div>
                            <div class="col-md-12 form-group">
                                <label class="col-md-4">
                                    Tên bếp
                                </label>
                                <input class="form-control col-md-8" name="name" value="{{ $data->name }}">
                            </div>
                            <div class="col-md-12 form-group">
                                <label class="col-md-4">
                                    Trạng thái
                                </label>
                                <select class="form-control" name="status">
                                    <option value="">Chọn trạng thái</option>
                                    <option value="0" @if($data->status == 0) selected @endif>Đang khóa</option>
                                    <option value="1" @if($data->status == 1) selected @endif>Kích hoạt</option>
                                </select>
                            </div>
                            <div class="col-md-12 form-group">
                                <label class="col-md-4">
                                    Số tiền
                                </label>
                                <input type="number" class="form-control col-md-8" name="money"
                                       value="{{ $data->money }}">
                            </div>
                            <div class="col-md-12 form-group">
                                <label class="col-md-4">
                                    Địa chỉ
                                </label>
                                <textarea class="form-control col-md-8" name="address">{{ $data->address }}</textarea>
                            </div>
                            <div class="col-md-12 form-group">
                                <label class="col-md-4">
                                    Ghi chú
                                </label>
                                <textarea class="form-control col-md-8" name="note">{{ $data->note }}</textarea>
                            </div>
                            <div class="col-md-12 form-group">
                                <button class="btn btn-success" type="submit">Cập nhật</button>
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
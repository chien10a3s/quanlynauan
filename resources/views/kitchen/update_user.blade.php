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
                        <form id="my_form" action="{{ route('admin.kitchen.update-user',$data->id) }}" method="post">
                            {{ csrf_field() }}
                            <div class="col-md-12 form-group">
                                <label class="col-md-4">
                                    Đầu bếp
                                </label>
                                {!! Form::select('chef', $all_chef, $id_chef, ['class' => 'form-control']) !!}
                            </div>
                            <div class="col-md-12 form-group">
                                <label class="col-md-4">
                                    Khách hàng
                                </label>
                                {!! Form::select('user', $all_user, $id_user, ['class' => 'form-control']) !!}
                            </div>
                            <div class="col-md-12 form-group">
                                <button class="btn btn-success" type="submit">Cập nhật tài khoản</button>
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
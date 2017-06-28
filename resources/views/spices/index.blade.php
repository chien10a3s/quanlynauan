@extends('voyager::master')

@section('page_header')
    <h1 class="page-title">
        <i class="voyager-list"></i> Danh sách nhà cung cấp
    </h1>
    &nbsp;
    <a href="{{ route('supplier.create') }}" class="btn btn-success">
        <i class="voyager-plus"></i> Mua thêm gia vị
    </a>
@stop

@section('css')
    <style>
        form.delete-form {
            display: inline-block;
        }
    </style>
@stop

@section('content')
    @if(Session::has('message'))
        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
    @endif
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <table id="sample_1" class="table table-hover">
                            <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên</th>
                                <th>Đơn vị</th>
                                <th>Trạng thái</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($all_spices as $item_user)
                                @if(count($item_user) > 0)
                                    <?php $i = 0 ?>
                                    @if(count($item_user->kitchen))
                                        @foreach($item_user->kitchen as $item_kitchen)
                                            @if(count($item_kitchen->food))
                                                @foreach($item_kitchen->food as $item_food)
                                                    <tr>
                                                        <td>{{ $i+=1 }}</td>
                                                        <td>{{ $item_food->name }}</td>
                                                        <td>{{ $item_food->unit }}</td>
                                                        <td>
                                                            @if($item_food->pivot->status == 1)
                                                                <span class="label label-default">Sắp hết</span>
                                                            @elseif($item_food->pivot->status == 2)
                                                                <span class="label label-success">Đang còn</span>
                                                            @elseif($item_food->pivot->status == 3)
                                                                <span class="label label-danger">Hủy không dùng</span>
                                                            @else
                                                                <span class="label label-danger">Hết</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            {{--<a href="{{ route('supplier.edit',$item_food->pivot->id) }}"--}}
                                                               {{--title="Chỉnh sửa"--}}
                                                               {{--class="btn-sm btn-primary pull-right edit">--}}
                                                                {{--<i class="voyager-edit"></i> Sửa--}}
                                                            {{--</a>--}}

                                                            <div class="btn-sm btn-danger pull-right delete"
                                                                 data-id="{{ $item_food->pivot->id }}"
                                                                 id="delete-{{ $item_food->pivot->id }}">
                                                                <i class="voyager-trash"></i> Xóa
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        @endforeach
                                    @endif
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal modal-danger fade" tabindex="-1" id="delete_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="voyager-trash"></i> Bạn chắc chắn muốn xóa gia vị này?</h4>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('admin.spices.delete') }}" id="delete_form" method="POST">
                        {{ method_field("DELETE") }}
                        {{ csrf_field() }}
                        <input type="submit" class="btn btn-danger pull-right delete-confirm"
                               value="Đúng, Xóa nó đi">
                    </form>
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Không xóa</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@stop

@section('javascript')
    <script>

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
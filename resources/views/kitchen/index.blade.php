@extends('voyager::master')

@section('page_header')
    <h1 class="page-title">
        <i class="voyager-list"></i> Danh sách bếp
    </h1>
    &nbsp;
    <a href="{{ route('admin.kitchens.addnew',1) }}" class="btn btn-success">
        <i class="voyager-plus"></i> Add New
    </a>
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
                                <th>Trạng thái</th>
                                <th>Đầu bếp</th>
                                <th>Khách hàng</th>
                                <th class="actions col-md-4">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($all_kitchen) > 0)
                                <?php $i = 0 ?>
                                @foreach($all_kitchen as $item)
                                    <?php
                                        $chef_name = "";
                                        $user_name = "";
                                    ?>
                                    @foreach($item->users as $item_user)
                                        @if($item_user->role_id == 2)
                                            <?php $user_name = $item_user->name; ?>
                                        @elseif($item_user->role_id == 3)
                                           <?php $chef_name = $item_user->name; ?>
                                        @endif
                                    @endforeach
                                    <tr>
                                        <td>{{ $i+=1 }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>
                                            @if($item->status == 0 )
                                                <span class="label label-danger">Đang khóa</span>
                                            @else
                                                <span class="label label-success">Đang kích hoạt</span>
                                            @endif

                                        </td>
                                        <td>
                                            {{ $chef_name }}
                                        </td>
                                        <td>
                                            {{ $user_name }}
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.kitchen.detail',$item->id) }}"
                                               class="btn-sm btn-warning" title="Chi tiết">
                                                <i class="voyager-eye"></i> Xem
                                            </a>
                                            <a href="{{ route('admin.kitchen.edit',$item->id) }}" title="Chỉnh sửa"
                                               class="btn-sm btn-primary edit">
                                                <i class="voyager-edit"></i> Sửa
                                            </a>
                                            <a href="{{ route('admin.kitchen.user',$item->id) }}"
                                               title=" Tài khoản trong bếp" class="btn-sm btn-primary edit">
                                                <i class="voyager-people"></i> Tài khoản
                                            </a>

                                            <a href="" class="btn-sm btn-danger delete" data-toggle="modal" title="Xóa"
                                               data-target="#delete_modal-{{ $item->id }}">
                                                <i class="voyager-trash"></i> Xóa
                                            </a>

                                            {{--Modal delete--}}
                                            <div class="modal modal-danger fade" tabindex="-1"
                                                 id="delete_modal-{{ $item->id }}" role="dialog">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close"><span
                                                                        aria-hidden="true">&times;</span></button>
                                                            <h4 class="modal-title"><i class="voyager-trash"></i> Bạn có
                                                                chắc chắn muốn xóa bếp này hay không?</h4>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form action="{{ route('admin.kitchen.delete',$item->id) }}"
                                                                  method="post">
                                                                {{--{{ method_field("DELETE") }}--}}
                                                                {{ csrf_field() }}
                                                                <input type="submit"
                                                                       class="btn btn-danger pull-right delete-confirm"
                                                                       value="Delete">
                                                            </form>
                                                            <button type="button" class="btn btn-default pull-right"
                                                                    data-dismiss="modal">Cancel
                                                            </button>
                                                        </div>
                                                    </div><!-- /.modal-content -->
                                                </div><!-- /.modal-dialog -->
                                            </div><!-- /.modal -->
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
    <!-- DataTables -->
    <script>
        $(document).ready(function () {
            $(document).ready(function () {
                $('#sample_1').DataTable({"order": []});
            });
        });
        function parseActionUrl(action, id) {
            return action.match(/\/[0-9]+$/)
                ? action.replace(/([0-9]+$)/, id)
                : action + '/' + id;
        }
    </script>
@stop
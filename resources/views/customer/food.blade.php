@extends('layouts.1column')

@section('main-content')
    @if(Session::has('message'))
        <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('message') }}</p>
    @endif
    <div class="page-content container">
        <div class="nav-tabs-custom">
        
            @include('customer.nav')

        	<div class="tab-content">
        		<div class="tab-pane active">
                    <table class="table table-bordered">
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Thực phẩm</th>
                            <th>Số lượng</th>
                            <th>Đơn vị</th>
                            <th>Trạng thái</th>
                            <th class="text-center">Hành động</th>
                        </tr>
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
                                                    <td>100</td>
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
                                                        @endif</td>
                                                    <td class="text-center">
                                                        @if($item_food->pivot->status != 3)
                                                            <div class="btn btn-sm btn-danger delete"
                                                                 data-id="{{ $item_food->pivot->id }}"
                                                                 id="delete-{{ $item_food->pivot->id }}">
                                                                <i class="voyager-trash"></i> Bỏ đi
                                                            </div>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    @endforeach
                                @endif
                            @endif
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" id="delete_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-danger ">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="voyager-trash"></i> Bạn chắc chắn muốn xóa thực phẩm này?</h4>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('admin.spices.delete') }}" id="delete_form" method="POST">
                        {{ method_field("DELETE") }}
                        {{ csrf_field() }}
                        <input type="submit" class="btn btn-danger pull-right delete-confirm"
                               value="Đúng, Hủy nó đi">
                    </form>
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Không xóa</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@stop

@section('page-script')
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
@extends('voyager::master')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ voyager_asset('css/ga-embed.css') }}">
    <style>
        .FlexGrid-item {
            margin: 0 0 1em 2em !important;
        }

        .panel-title {
            display: block;
            padding: 0px 10px !important;
            padding-left: 15px;
            font-size: 18px;
            text-align: left;
        }

        .panel-heading {
            background: aliceblue;
            padding: 11px 5px 0px 4px;
            margin-top: 5px;
        }
    </style>
@stop

@section('page_header')
    <h1 class="page-title">
        <i class="voyager-list"></i> Danh sách thực đơn
    </h1>
    &nbsp;
    <a href="{{ route('admin.user.add') }}" class="btn btn-success">
        <i class="voyager-plus"></i> Thêm mới
    </a>
@stop
@section('content')
    <div class="page-content">
        @include('voyager::alerts')
        <div>
            <div class="Dashboard col-md-12" id="">
                <div id="view-selector-container " class="col-md-12">
                    @if(count($all_meal) > 0)
                        @foreach($all_meal as $item_meal)
                            <?php
                                foreach ($item_meal->kitchen as $item_kitchen) {
                                    if (count($item_kitchen->daily_meal) > 0) {
                                        foreach ($item_kitchen->daily_meal as $item_daily_meal) {
                                            $money_meals = 0;
                                            $number_of_meals = 0;
                                            $money_meals = $item_daily_meal->money_meals;
                                            $number_of_meals = $item_daily_meal->number_of_meals;
                                            $green="aliceblue";
                                            if (\Carbon\Carbon::now()->startOfDay()->timestamp == \Carbon\Carbon::parse($item_daily_meal->day)->startOfDay()->timestamp)
                                                {
                                                    $green="#f0fff1";
                                                }
                                            ?>
                                                <div class="panel-heading col-md-12" style="background: {{ $green }}">
                                                    <h3 class="panel-title col-md-8">Bữa ăn
                                                        ngày {{ \Carbon\Carbon::parse($item_daily_meal->day)->format('d/m/Y') }}</h3>
                                                    <div class="panel-body col-md-8">
                                                        Số xuất ăn : {{ $number_of_meals }}<br>
                                                        Số tiền 1 suất ăn : {{ number_format($money_meals) }} VNĐ
                                                    </div>
                                                    <div class="pull-right">
                                                        <a href=""
                                                           class="btn-sm btn-warning" title="Chi tiết">
                                                            <i class="voyager-eye"></i> Xem
                                                        </a>
                                                        @if(\Carbon\Carbon::now()->timestamp < Carbon\Carbon::createFromFormat('Y-m-d H:i:s',\Carbon\Carbon::parse($item_daily_meal->day)->format('Y-m-d')."09:00:00")->timestamp )
                                                            <a href="" title="Chỉnh sửa"
                                                               class="btn-sm btn-primary edit">
                                                                <i class="voyager-edit"></i> Sửa
                                                            </a>
                                                            <a href="" class="btn-sm btn-danger delete" data-toggle="modal" title="Xóa"
                                                               data-target="#delete_modal">
                                                                <i class="voyager-trash"></i> Xóa
                                                            </a>
                                                            <div class="modal modal-danger fade" tabindex="-1"
                                                                 id="delete_modal" role="dialog">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <button type="button" class="close" data-dismiss="modal"
                                                                                    aria-label="Close"><span
                                                                                        aria-hidden="true">&times;</span></button>
                                                                            <h4 class="modal-title"><i class="voyager-trash"></i> Bạn có
                                                                                chắc chắn muốn xóa thực đơn này hay không?</h4>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <form action="#"
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
                                                        @endif
                                                    </div>
                                                </div>
                                            <?php
                                            continue;
                                        }
                                    }
                                }
                            ?>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
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
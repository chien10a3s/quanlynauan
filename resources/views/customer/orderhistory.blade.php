@extends('layouts.1column')

@section('main-content')
    <div class="page-content container">
        <div class="nav-tabs-custom">
            @include('customer.nav')
            <div class="tab-content">
                <div class="tab-pane active">
                    <div class="row">
                        <form role="form" id="all_order_form">
                            <div class="form-group col-md-3">
                                <label>Từ ngày</label>
                                <input type="text" class="form-control datetimepicker1" name="start_date" placeholder="Order Date"
                                       data-date-format="dd/mm/yyyy" id="ord_date" maxlength="10" value="{{ @$start_date_begin }}">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Đến ngày</label>
                                <input type="text" class="form-control datetimepicker1" name="end_date" placeholder="Order Date"
                                       data-date-format="dd/mm/yyyy" id="ord_dt_to" maxlength="10" value="{{ @$end_date_begin }}">
                            </div>

                            <div class="col-md-3">
                                <label style="display: block;">&nbsp;</label>
                                <input type="submit" class="btn btn-info" value="Hiển thị">

                            </div>
                        </form>
                        <div class="col-md-3">
                            <label style="display: block;">&nbsp;</label>
                            <a href="{{ route('admin.user.add') }}" class="btn btn-success pull-right">
                                <i class="voyager-plus"></i> Thêm mới
                            </a>

                        </div>
                    </div>
                    <table class="table table-bordered">
                        <tr>
                            <th>Số đơn hàng</th>
                            <th>Ngày</th>
                            <th>Số tiền</th>
                            <th>Số suất ăn</th>
                            <th class="text-center">Hành động</th>
                        </tr>
                        @if(count($all_meal) > 0)
                            @foreach($all_meal as $item_meal)
                                <?php
                                    foreach ($item_meal->kitchen as $item_kitchen) {
                                        if (count($item_kitchen->daily_meal) > 0) {
                                            $i=0;
                                            foreach ($item_kitchen->daily_meal as $item_daily_meal) {
                                                $money_meals = 0;
                                                $number_of_meals = 0;
                                                $money_meals = $item_daily_meal->money_meals;
                                                $number_of_meals = $item_daily_meal->number_of_meals;
                                                $green = "aliceblue";
                                                if (\Carbon\Carbon::now()->startOfDay()->timestamp == \Carbon\Carbon::parse($item_daily_meal->day)->startOfDay()->timestamp) {
                                                    $green = "#f0fff1";
                                                }
                                                ?>
                                                <tr>
                                                    <td>{{ $i+=1 }}.</td>
                                                    <td>{{ \Carbon\Carbon::parse($item_daily_meal->day)->format('d/m/Y') }}</td>
                                                    <td>{{ number_format($money_meals) }} VNĐ</td>
                                                    <td>{{ $number_of_meals }}</td>
                                                    <td class="text-center">
                                                        <a href="{{ route('admin.user.view',$item_daily_meal->id) }}" class="btn btn-success btn-sm">Xem chi tiết</a>
                                                        <a href="#" class="btn btn-primary btn-sm" onclick="comment({{$item_daily_meal->id}})">Comment</a>
                                                        @if(\Carbon\Carbon::now()->timestamp < Carbon\Carbon::createFromFormat('Y-m-d H:i:s',\Carbon\Carbon::parse($item_daily_meal->day)->format('Y-m-d')."09:00:00")->timestamp )
                                                            <a href="{{ route('admin.user.edit',$item_daily_meal->id) }}" class="btn btn-primary btn-sm">Sửa đơn hàng</a>
                                                            <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" title="Xóa"
                                                               data-target="#delete_modal-{{ $item_daily_meal->id }}">Hủy đơn hàng</a>
                                                            <div class="modal fade" tabindex="-1"
                                                                 id="delete_modal-{{ $item_daily_meal->id }}" role="dialog">
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
                                                                            <form action="{{ route('admin.user.delete',$item_daily_meal->id) }}"
                                                                                  method="post">
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
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                    }
                                ?>
                            @endforeach
                        @endif
                    </table>
                    <div class="modal fade" tabindex="-1" id="commment" role="dialog">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title"><img src="/social/comment-icon.png"> Danh sách comment <label class="date_meal"></label> </h4>
                                </div>

                                <div class="modal-content" id="data_result">

                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default pull-right"
                                            data-dismiss="modal">Đóng
                                    </button>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->
                </div>
            </div>
        </div>
    </div>
@stop

@section('page-script')
    {!! Html::style('plugin/datepicker/datepicker3.css') !!}
    {!! Html::style('plugin/datepicker/bootstrap-datetimepicker.min.css') !!}
    {!! Html::script('plugin/datepicker/bootstrap-datetimepicker.min.js') !!}
    <script src="/plugin/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script>
        $(function () {
            $('.datetimepicker1').datepicker({
                todayBtn: true,
                language: "en",
                autoclose: true,
                todayHighlight: true,
                format: 'dd/mm/yyyy',
            });
            $('#all_order_form').submit(function (){

            })
        });
        function comment(id_meal) {
            $("#commment").modal();
            $.ajax({
                method: "get",
                async: false,
                url: '{{route('admin.account.feedback')}}',
                data: {
                    'daily_meal_id': id_meal
                },
                success: function (data) {
                    $("#data_result").html(data);
                }
            });
        }
    </script>
@stop
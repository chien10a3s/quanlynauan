@extends('layouts.1column')

@section('main-content')
    <div class="page-content container">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="{{ Request::is('account') ? 'active' : '' }}"><a href="{{ url('account') }}">Thông tin
                        chung</a></li>
                <li class="{{ Request::is('account/food') ? 'active' : '' }}"><a href="{{ url('account/food') }}">Thức
                        ăn của tôi</a></li>
                <li class="{{ Request::is('account/orderhistory') ? 'active' : '' }}"><a
                            href="{{ url('account/orderhistory') }}">Lịch sử đặt hàng</a></li>
                <li class="{{ Request::is('account/transaction') ? 'active' : '' }}"><a
                            href="{{ url('account/transaction') }}">Lịch sử giao dịch</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active">
                    <div class="row">
                        <form role="form" id="all_order_form">
                            <div class="form-group col-md-3">
                                <label>Từ ngày</label>
                                <input type="text" class="form-control" name="txtdoi" placeholder="Order Date"
                                       data-date-format="dd/mm/yyyy" id="ord_date" maxlength="10">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Đến ngày</label>
                                <input type="text" class="form-control" name="ord_dt_to" placeholder="Order Date"
                                       data-date-format="dd/mm/yyyy" id="ord_dt_to" maxlength="10">
                            </div>

                            <div class="col-md-3">
                                <label style="display: block;">&nbsp;</label>
                                <input type="button" class="btn btn-info" value="Hiển thị">

                            </div>
                            <div class="col-md-3">
                                <label style="display: block;">&nbsp;</label>
                                <a href="{{ route('admin.user.add') }}" class="btn btn-success pull-right">
                                    <i class="voyager-plus"></i> Thêm mới
                                </a>

                            </div>
                        </form>
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
                                            //                                            continue;
                                            }
                                        }
                                    }
                                ?>
                            @endforeach
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('javascript')

@stop
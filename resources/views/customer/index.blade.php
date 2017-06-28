@extends('layouts.1column')

@section('main-content')
    <div class="page-content container">
        <div class="nav-tabs-custom">
            @include('customer.nav')
            <?php
            $user_info = \Illuminate\Support\Facades\Auth::user();
            $kitchen_info = $user_info->kitchen;
            $money_kitchen = 0;
            $address = "";
            if (count($kitchen_info) > 0) {
                foreach ($kitchen_info as $item_kitchen) {
                    $money_kitchen = $item_kitchen->money;
                    $address = $item_kitchen->address;
                }
            }
            ?>
            <div class="tab-content">
                <div class="tab-pane active">

                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Thông tin tài khoản</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table class="table table-bordered">
                                <tr>
                                    <td width="25%">Tên</td>
                                    <td width="25%"><b>{{ $user_info->name }}</b></td>
                                    <td width="25%">Số bếp quản lý</td>
                                    <td width="25%"><b>{{ count($kitchen_info) }}</b></td>
                                </tr>
                                <tr>
                                    <td>Ngày sinh</td>
                                    <td><b>{{ \Carbon\Carbon::now()->format('d-m-Y') }}</b></td>
                                    <td>Số dư tài khoản</td>
                                    <td><b>{{ number_format($money_kitchen) }}</b></td>
                                </tr>
                                <tr>
                                    <td>Địa chỉ nhận hàng</td>
                                    <td><b>{{ $address }}</b></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <!-- /.box -->
                    @if(count($info_meal) > 0)
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Hôm nay ăn gì?</h3>
                                @if(\Carbon\Carbon::now()->timestamp < Carbon\Carbon::createFromFormat('Y-m-d H:i:s',\Carbon\Carbon::parse($info_meal->day)->format('Y-m-d')."09:00:00")->timestamp )
                                    <a href="{{ route('admin.user.edit',$info_meal->id) }}" class="btn btn-success pull-right">Chỉnh sủa đăng ký</a>
                                @endif
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <?php
                                    $total_money_expected = 0;
                                ?>
                                @if($info_meal->is_permission == 1)
                                    Bạn đã ủy quyền đi chợ và chọn món cho đầu bếp.<br><br>
                                @else
                                    <table class="table table-bordered">
                                    @if(count($info_meal->daily_dish) > 0)
                                        <?php
                                        $i = 0;
                                        $total_money_expected = 0;
                                        ?>
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Tên món</th>
                                            <th>Nguyên liệu</th>
                                            <th>Số lượng</th>
                                            <th>Thành tiền</th>
                                            <th>Công thức</th>
                                            <th>Ghi chú</th>
                                        </tr>
                                        @foreach($info_meal->daily_dish as $item_dish)
                                            <tr>
                                                <?php
                                                $detail_dish = $item_dish->detail_dish;
                                                $rowspan = count($detail_dish);
                                                ?>
                                                <td valign="middle" rowspan="{{ $rowspan }}">{{ $i+=1 }}.
                                                </td>
                                                <td valign="middle"
                                                    rowspan="{{ $rowspan }}">{{$item_dish->name}}</td>
                                                @foreach($detail_dish as $key=>$item_detai_dish)
                                                    <td>{{ @$option[$item_detai_dish->id_food]['name'] }}</td>
                                                    <td>{{ $item_detai_dish->number }}</td>
                                                    <td>{{ number_format(@$option[$item_detai_dish->id_food]['price']).' vnd' }}</td>
                                                    <?php
                                                        $detail_dish->forget($key);
                                                        $total_money_expected += $option[$item_detai_dish->id_food]['price'];
                                                    ?>
                                                    @break;
                                                @endforeach
                                                <td valign="middle"
                                                    rowspan="{{ $rowspan }}">{{$item_dish->cooking_note}}</td>
                                                <td valign="middle"
                                                    rowspan="{{ $rowspan }}">{{$item_dish->note}}</td>
                                            </tr>
                                            @if(count($detail_dish)>0)
                                                @foreach($detail_dish as $key=>$item_detai_dish)
                                                    <?php
                                                        $total_money_expected += $option[$item_detai_dish->id_food]['price'];
                                                    ?>
                                                    <tr>
                                                        <td>{{ @$option[$item_detai_dish->id_food]['name'] }}</td>
                                                        <td>{{ $item_detai_dish->number }}</td>
                                                        <td>{{ number_format(@$option[$item_detai_dish->id_food]['price']).' vnd' }}</td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        @endforeach
                                    @endif
                                    @endif
                                    @if(count($info_meal) > 0)
                                        @if(count($info_meal->daily_dish) > 0)
                                            <tfoot>
                                            <tr>
                                                <td class="text-right" colspan="5"><strong>Tổng tiền dự tính</strong>
                                                </td>
                                                <td colspan="2">
                                                    @if($info_meal->is_permission == 0)
                                                        <strong>{{ number_format($total_money_expected) }} vnd</strong></td>
                                                    @else
                                                        <strong>{{ number_format($info_meal->number_of_meals * $info_meal->money_meals) }} vnd</strong><br><br>
                                                    </td>
                                                    @endif
                                            </tr>
                                            <tr>
                                                <td class="text-right" colspan="5"><strong>Tổng tiền thực</strong></td>
                                                <td colspan="2">
                                                    <strong>{{ number_format($info_meal->total_meal_chef) }} vnd</strong>
                                                </td>
                                            </tr>
                                            </tfoot>
                                        @endif
                                </table>
                                @endif
                            </div>
                        </div>
                        <!-- /.box -->
                    @else
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Bạn chưa đi chợ cho hôm nay.</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <a href="{{ route('admin.user.add') }}" class="btn btn-success">Đi chợ ngay</a>
                            </div>
                        </div>
                        <!-- /.box -->
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop

@section('javascript')

@stop
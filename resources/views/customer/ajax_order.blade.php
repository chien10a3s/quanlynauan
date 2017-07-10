<div class="page-content container" style="width:100% ;">
    <div class="row">
        <div class="col-md-3">
            <label>Ngày đăng ký <b style="color: red">*</b></label>

            <input readonly type="text" class="form-control datetimepicker1" required name="date"
                   value="{{ \Carbon\Carbon::createFromFormat('Y-m-d',$info_meal->day)->format('d/m/Y') }}">

        </div>
        <div class="col-md-3">
            <label>Số xuất ăn <b style="color: red">*</b></label>

            <input readonly type="number" class="form-control" required name="number_of_meals"
                   value="{{$info_meal->number_of_meals}}">

        </div>
        <div class="col-md-3">
            <label>Số tiền 1 suất <b style="color: red">*</b></label>

            <input readonly type="number" class="form-control" required name="money"
                   value="{{$info_meal->money_meals}}">

        </div>
        <div class="radio col-md-3" style="padding-bottom: 10px;">
            <label class="checkbox-inline"><input @if($info_meal->is_permission == 1) checked disabled
                                                  @endif type="checkbox" class="uyquyen" name="uyquyen" value="1">Ủy
                quyền đi chợ,chọn món</label>
        </div>
    </div>
    @if($info_meal->is_permission != 1)
        <table class="table table-hover table-bordered" id="main">
            <thead>
            <tr>
                <th>Tên món</th>
                <th>Nguyên liệu</th>
                <th>Số lượng</th>
                <th>Đơn vị</th>
                <th>Số tiền / đơn vị</th>
                <th>Tổng tiền</th>
            </tr>
            </thead>
            <tbody class="mon_an">
            <?php $i = 0 ?>
            <?php $k = 0;$tongtien=0 ?>
            @foreach($info_meal->daily_dish as $data_dish)
                <?php
                    $i += 1;
                ?>
                <tr class="" id="">
                    <td><input readonly type="text" name="tenmon[{{ $i }}]" required class="tenmon form-control"
                               value="{{ $data_dish->name }}"></td>


                    <td class="">
                        @foreach($data_dish->detail_dish as $item_detail_dish_food)
                            {!! Form::text('nguyen_lieu', $option[$item_detail_dish_food->id_food]['name'], ['class' => 'nguyen_lieu form-control','disabled'=>'true','style'=>'margin-bottom:10px']) !!}
                        @endforeach
                    </td>
                    <td class="">
                        @foreach($data_dish->detail_dish as $item_detail_dish_number)
                            <input readonly style="margin-bottom: 10px" type="number" required
                                   name="so_luong[{{ $i }}][]" class="so_luong form-control"
                                   value="{{ $item_detail_dish_number->number }}">
                        @endforeach
                    </td>
                    <td class="">
                        @foreach($data_dish->detail_dish as $item_detail_dish_unit)
                            <input readonly style="margin-bottom: 10px" type="text" required
                                   name="don_vi[{{ $i }}][]"
                                   class="don_vi form-control" value="{{ $item_detail_dish_unit->unit }}">
                        @endforeach
                    </td>

                    <td class="">
                        <label>
                            @foreach($data_dish->detail_dish as $item_detail_dish_number)
                                <input readonly style="margin-bottom: 10px"  name="" class="so_luong form-control" value="{{ number_format($item_detail_dish_number->money_real) }} đ">
                            @endforeach
                        </label>
                    </td>
                    <td class="">
                        <label>
                            @foreach($data_dish->detail_dish as $item_detail_dish_number)
                                <?php
                                    $tongtien += $item_detail_dish_number->money_real * $item_detail_dish_number->number;
                                ?>
                                <input readonly style="margin-bottom: 10px"  name="" class="so_luong form-control" value="{{ number_format($item_detail_dish_number->money_real * $item_detail_dish_number->number) }} đ">
                            @endforeach
                        </label>
                    </td>
                </tr>
            @endforeach
            <tr>
                <td colspan="5" style="text-align: right">
                    <b>Tổng tiền</b>
                </td>
                <td>
                    <b>{{ number_format($tongtien) }} đ</b>
                </td>
            </tr>
            </tbody>
        </table>
    @endif
</div>
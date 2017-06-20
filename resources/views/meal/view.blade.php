@extends('voyager::master')

@section('page_header')
    {!! Html::script('plugin/datepicker/bootstrap-datepicker.js') !!}
    {!! Html::script('plugin/datepicker/jquery.datetimepicker.min.js') !!}
    {!! Html::style('plugin/datepicker/datepicker3.css') !!}
    {!! Html::style('plugin/datepicker/bootstrap-datetimepicker.min.css') !!}
    {!! Html::script('plugin/datepicker/bootstrap-datetimepicker.min.js') !!}

    {!! Html::script('plugin/multiselect/multiselect.js') !!}
    {!! Html::style('plugin/multiselect/select2.min.js') !!}
    <style>
        .select2-container {
            margin-bottom: 10px;
            width: 100% !important;
        }
    </style>
    <h1 class="page-title">
        <i class="voyager-list"></i> Đăng ký món ăn trong ngày
    </h1>
    &nbsp;
    {{--<a href="{{ route('admin.kitchen.add') }}" class="btn btn-success">--}}
    {{--<i class="voyager-plus"></i> Add New--}}
    {{--</a>--}}
@stop
@section('content')
    <div class="page-content container-fluid">
        <div class="row">
            <div class="panel panel-bordered col-md-12">
                <div class="panel-heading col-md-6">
                    <h3 class="panel-title">Ngày đăng ký <b style="color: red">*</b></h3>
                    <div class="panel-body">
                        <input readonly type="text" class="form-control datetimepicker1" required name="date"
                               value="{{ \Carbon\Carbon::createFromFormat('Y-m-d',$info_meal->day)->format('d/m/Y') }}">
                    </div>
                </div>
                <div class="panel-heading col-md-6">
                    <h3 class="panel-title">Số xuất ăn <b style="color: red">*</b></h3>
                    <div class="panel-body">
                        <input readonly type="number" class="form-control" required name="number_of_meals"
                               value="{{$info_meal->number_of_meals}}">
                    </div>
                </div>
                <div class="panel-heading col-md-6">
                    <h3 class="panel-title">Số tiền 1 suất <b style="color: red">*</b></h3>
                    <div class="panel-body">
                        <input readonly type="number" class="form-control" required name="money"
                               value="{{$info_meal->money_meals}}">
                    </div>
                </div>
                <div class="panel-heading col-md-6" style="padding-bottom: 10px;">
                    <h3 class="panel-title">Ủy quyền đi chợ</h3>
                    <div class="panel-body">
                        <input disabled type="checkbox" @if($info_meal->add_permission == 1) checked @endif class="uyquyen" name="uyquyen" value="1"> Ủy quyền đi chợ,chọn món
                    </div>
                </div>
                <div class="panel-heading col-md-12">
                    <h3 class="panel-title">Món chính</h3>
                </div>
                <table class="table table-hover table-bordered" id="main">
                    <thead>
                    <tr>
                        <th>Tên món</th>
                        <th>Nguyên liệu</th>
                        <th>Số lượng</th>
                        <th>Đơn vị</th>
                        <th>Công thức</th>
                        <th>Ghi chú</th>
                    </tr>
                    </thead>
                    <tbody class="mon_an">
                    <?php $i = 0 ?>
                    <?php $k = 0 ?>
                    @foreach($info_meal->daily_dish as $data_dish)
                        <?php $i += 1 ?>
                        <tr class="tr_mon" id="tr_mon">
                            <td><input readonly type="text" name="tenmon[{{ $i }}]" required class="tenmon form-control"
                                       value="{{ $data_dish->name }}"></td>


                            <td class="td_nguyen_lieu">
                                @foreach($data_dish->detail_dish as $item_detail_dish_food)
                                    {!! Form::select('nguyen_lieu['.$i.'][]', $option, $item_detail_dish_food->id_food, ['class' => 'nguyen_lieu form-control','disabled'=>'true']) !!}
                                @endforeach
                            </td>
                            <td class="td_so_luong">
                                @foreach($data_dish->detail_dish as $item_detail_dish_number)
                                    <input readonly style="margin-bottom: 10px" type="number" required
                                           name="so_luong[{{ $i }}][]" class="so_luong form-control"
                                           value="{{ $item_detail_dish_number->number }}">
                                @endforeach
                            </td>
                            <td class="td_don_vi">
                                @foreach($data_dish->detail_dish as $item_detail_dish_unit)
                                    <input readonly style="margin-bottom: 10px" type="text" required name="don_vi[{{ $i }}][]"
                                           class="don_vi form-control" value="{{ $item_detail_dish_unit->unit }}">
                                @endforeach
                            </td>

                            <td class="td_cong_thuc"><label>{{ $data_dish->cooking_note }}</label>
                            </td>
                            <td class="td_ghi_chu"><label>{{ $data_dish->note }}</label>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
@section('javascript')
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
            $('select').select2();
        });
    </script>
@stop
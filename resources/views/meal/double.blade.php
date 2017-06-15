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
        .td_nguyen_lieu {
            width: 30%;
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
            @if(Session::has('message'))
                <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
            @endif
            <form id="my_form" action="{{ route('admin.user.store') }}" method="post">
                {{ csrf_field() }}
                <div class="panel panel-bordered col-md-12">
                    <div class="panel-heading col-md-6">
                        <h3 class="panel-title">Ngày đăng ký <b style="color: red">*</b></h3>
                        <div class="panel-body">
                            <input type="text" class="form-control datetimepicker1" required name="date" value="{{ \Carbon\Carbon::createFromFormat('Y-m-d',$info_meal->day)->format('d/m/Y') }}">
                        </div>
                    </div>
                    <div class="panel-heading col-md-6">
                        <h3 class="panel-title">Số xuất ăn <b style="color: red">*</b></h3>
                        <div class="panel-body">
                            <input type="number" class="form-control" required name="number_of_meals" value="{{$info_meal->number_of_meals}}">
                        </div>
                    </div>
                    <div class="panel-heading col-md-6">
                        <h3 class="panel-title">Số tiền 1 suất <b style="color: red">*</b></h3>
                        <div class="panel-body">
                            <input type="number" class="form-control" required name="money" value="{{$info_meal->money_meals}}">
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
                            <th></th>
                        </tr>
                        </thead>
                        <tbody class="mon_an">
                        <?php $i=0 ?>
                        <?php $k=0 ?>
                        @foreach($info_meal->daily_dish as $data_dish)
                            <?php $i+=1 ?>
                            <tr class="tr_mon" id="tr_mon">
                                <td><input type="text" name="tenmon[{{ $i }}]" required class="tenmon form-control" value="{{ $data_dish->name }}"></td>


                                    <td class="td_nguyen_lieu">
                                        @foreach($data_dish->detail_dish as $item_detail_dish_food)
                                            {!! Form::select('nguyen_lieu['.$i.'][]', $option, $item_detail_dish_food->id_food, ['class' => 'nguyen_lieu form-control']) !!}
                                        @endforeach
                                    </td>
                                    <td class="td_so_luong">
                                        @foreach($data_dish->detail_dish as $item_detail_dish_number)
                                            <input style="margin-bottom: 10px" type="number" required name="so_luong[{{ $i }}][]" class="so_luong form-control" value="{{ $item_detail_dish_number->number }}">
                                        @endforeach
                                    </td>
                                    <td class="td_don_vi">
                                        @foreach($data_dish->detail_dish as $item_detail_dish_unit)
                                            <input style="margin-bottom: 10px" type="text" required name="don_vi[{{ $i }}][]" class="don_vi form-control"  value="{{ $item_detail_dish_unit->unit }}">
                                        @endforeach
                                    </td>

                                <td class="td_cong_thuc"><textarea name="cong_thuc[{{ $i }}]"
                                                                   class="cong_thuc form-control">{{ $data_dish->cooking_note }}</textarea>
                                </td>
                                <td class="td_ghi_chu"><textarea name="ghi_chu[{{ $i }}]" class="ghi_chu form-control">{{ $data_dish->note }}</textarea>
                                </td>
                                <td>
                                    <input type="hidden" class="hidden_meal" value='{{ $i }}'>
                                    <a href="#" class="btn btn-success" title="Thêm nguyên liệu" id="add_nl">
                                        <i class="voyager-plus"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <button class="btn btn-success add_button pull-right"><i class="voyager-plus"> </i> Thêm món
                    </button>
                    <button type="submit" class="btn btn-primary"><i class="voyager-plus"> </i> Cập nhật</button>
                </div>
            </form>
        </div>
    </div>
@stop

@section('javascript')
    <script src="/plugin/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script>
        $(document).ready(function () {
            var max_fields = 200;
            var x = {{$i}}; //initlal text box count
            var n = 1; //initlal text box count
            $(".add_button").click(function (e) { //on add input button click
                e.preventDefault();
                if (x < max_fields) { //max input box allowed
                    x++; //text box increment
                    var html = '<tr class="tr_mon">';
                    html += '<td><input type="text" name="tenmon[' + x + ']" required class="tenmon form-control"></td>';
                    html += '<td class="td_nguyen_lieu">';
                    html += '<select class="nguyen_lieu" name="nguyen_lieu[' + x + '][]">';
                    @foreach ($option as $key=>$item_nl)
                        html +='<optgroup label="{{$key}}">';
                    @foreach($item_nl as $key_food=>$item_food)
                        html += '<option value="{{ $key_food }}">{{ $item_food }}</option>';
                    @endforeach
                        html +='</optgroup>';
                    @endforeach
                        html += '</select></td>';
                    html += '<td class="td_so_luong"><input type="number" required name="so_luong[' + x + '][]" class="so_luong form-control"></td>';
                    html += '<td class="td_don_vi"><input type="text" required name="don_vi[' + x + '][]" class="don_vi form-control"></td>';
                    html += '<td class="td_cong_thuc"><textarea name="cong_thuc[' + x + ']" class="cong_thuc form-control"></textarea></td>';
                    html += '<td class="td_ghi_chu"><textarea name="ghi_chu[' + x + ']" class="ghi_chu form-control"></textarea></td>';
                    html += '<td>';
                    html += '<input type="hidden" class="hidden_meal" value=' + x + '>';
                    html += '<a href="#" class="btn btn-success" title="Thêm nguyên liệu" id="add_nl" value="' + x + '">';
                    html += '<i class="voyager-plus"></i>';
                    html += '</a>';
                    html += '<a href="#" class="btn btn-danger remove_field" title="Xóa">';
                    html += '<i class="voyager-trash"></i>';
                    html += '</a>';
                    html += '</td>';
                    html += '</tr>';
                    $('.mon_an').append(html);
                    $('select').select2();
                }
            });

            $(".mon_an").on("click", ".remove_field", function (e) { //user click on remove text
                e.preventDefault();
                $(this).parent('td').parent('tr').remove();
//                x--;
            })

            $("#main").on("click", "#add_nl", function (event) {
                var a = $(this).closest("tr").find('.hidden_meal').val();
                var html = '<select class="nguyen_lieu a" required name="nguyen_lieu[' + a + '][]" style="margin-top: 10px">';
                @foreach ($option as $key=>$item_nl)
                    html +='<optgroup label="{{$key}}">';
                @foreach($item_nl as $key_food=>$item_food)
                    html += '<option value="{{ $key_food }}">{{ $item_food }}</option>';
                @endforeach
                    html +='</optgroup>';
                @endforeach
                    html += '</select></td>';
                $(this).closest("tr").find('.td_nguyen_lieu').append(html);
                $(this).closest("tr").find('.td_so_luong').append('<input type="number" required name="so_luong[' + a + '][]" class="so_luong form-control" style="margin-top: 10px">');
                $(this).closest("tr").find('.td_don_vi').append('<input type="text" required name="don_vi[' + a + '][]" class="don_vi form-control" style="margin-top: 10px">');
                $('select').select2();
                $("html, body").animate({ scrollTop: $(this).closest("tr").find('.td_nguyen_lieu').offset().top }, 1);
            });

            //Check Date

            $("#my_form").on("submit", function (e) { //user click on remove text
                var date = $('.datetimepicker1').val();
                var status = 0;
                $.ajax({
                    url: '{{ route('admin.user.check-date-update') }}',
                    type: 'get',
                    async: false,
                    data: {
                        "date":date,
                        "id":{{ $info_meal->id }},
                    },
                    success: function(data) {
                        status = data.state;
                        if (data.state == 0){
                            toastr.error(data.name);
                            $('.datetimepicker1').css('border','1px solid #F00')
                            e.preventDefault();
                        }
                    }
                });
            })
        });

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
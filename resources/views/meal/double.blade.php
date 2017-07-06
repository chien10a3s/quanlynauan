@extends('layouts.1column')

@section('header')
    {!! Html::script('plugin/datepicker/bootstrap-datepicker.js') !!}
    {!! Html::script('plugin/datepicker/jquery.datetimepicker.min.js') !!}
    {!! Html::style('plugin/datepicker/datepicker3.css') !!}
    {!! Html::style('plugin/datepicker/bootstrap-datetimepicker.min.css') !!}
    {!! Html::script('plugin/datepicker/bootstrap-datetimepicker.min.js') !!}

    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/select2/3.4.5/select2.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/select2/3.4.5/select2.min.js"></script>
    <style>
        .td_nguyen_lieu .dropdown-menu {
            min-width: 100% !important;
            width: 400%;
            box-shadow: 5px 3px #eee;
            max-height: 300px;
            overflow: auto;
        }
    </style>
@stop
@section('main-content')
    <div class="page-content container" style="padding: 0 20px 20px;background: #fff;">
        <h3 class="page-title">
            Đăng ký món ăn
        </h3>
        @if(Session::has('message'))
            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
        @endif
        <form id="my_form" action="{{ route('admin.user.store') }}" method="post">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-3">
                    <label>Ngày đăng ký <b style="color: red">*</b></label>
                    <input type="text" class="form-control datetimepicker1" required name="date"
                           value="{{ \Carbon\Carbon::createFromFormat('Y-m-d',$info_meal->day)->format('d/m/Y') }}">
                </div>
                <div class="col-md-3">
                    <label>Số suất ăn <b style="color: red">*</b></label>
                    <input value="{{$info_meal->number_of_meals}}" type="number" class="form-control" required
                           name="number_of_meals">
                </div>
                <div class="col-md-3">
                    <label>Số tiền 1 suất <b style="color: red">*</b></label>
                    <select class="form-control" name="money">
                        <option value="25000" @if($info_meal->money_meals == 25000) selected @endif>25.000 VDN</option>
                        <option value="30000" @if($info_meal->money_meals == 30000) selected @endif>30.000 VDN</option>
                        <option value="35000" @if($info_meal->money_meals == 35000) selected @endif>35.000 VDN</option>
                        <option value="40000" @if($info_meal->money_meals == 40000) selected @endif>40.000 VDN</option>
                        <option value="45000" @if($info_meal->money_meals == 45000) selected @endif>45.000 VDN</option>
                        <option value="50000" @if($info_meal->money_meals == 50000) selected @endif>50.000 VDN</option>
                        <option value="55000" @if($info_meal->money_meals == 55000) selected @endif>55.000 VDN</option>
                        <option value="60000" @if($info_meal->money_meals == 60000) selected @endif>60.000 VDN</option>
                        <option value="65000" @if($info_meal->money_meals == 65000) selected @endif>65.000 VDN</option>
                        <option value="70000" @if($info_meal->money_meals == 70000) selected @endif>70.000 VDN</option>
                        <option value="75000" @if($info_meal->money_meals == 75000) selected @endif>75.000 VDN</option>
                        <option value="80000" @if($info_meal->money_meals == 80000) selected @endif>80.000 VDN</option>
                        <option value="85000" @if($info_meal->money_meals == 85000) selected @endif>85.000 VDN</option>
                        <option value="90000" @if($info_meal->money_meals == 90000) selected @endif>90.000 VDN</option>
                        <option value="95000" @if($info_meal->money_meals == 95000) selected @endif>95.000 VDN</option>
                        <option value="100000" @if($info_meal->money_meals == 100000) selected @endif>100.000 VDN
                        </option>
                    </select>
                </div>
                <div class="radio col-md-3" style="padding-bottom: 10px;">
                    <label class="checkbox-inline"><input @if($info_meal->is_permission == 1) checked
                                                          @endif type="checkbox" class="uyquyen" name="uyquyen"
                                                          value="1">Ủy quyền đi chợ,chọn món</label>
                </div>

                <div class="col-md-12">
                    <hr/>
                    <table class="table table-hover table-bordered" id="main">
                        <thead>
                        <tr>
                            <th>Tên món</th>
                            <th>Nguyên liệu</th>
                            <th>Số lượng</th>
                            {{--<th>Đơn vị</th>--}}
                            <th>Công thức</th>
                            <th>Ghi chú</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody class="mon_an">
                        <?php $i = 0 ?>
                        <?php $k = 0 ?>
                        @foreach($info_meal->daily_dish as $data_dish)
                            <?php $i += 1 ?>
                            <tr class="tr_mon" id="tr_mon">
                                <td><input type="text" name="tenmon[{{ $i }}]" required class="tenmon form-control"
                                           value="{{ $data_dish->name }}"></td>


                                <td class="td_nguyen_lieu">
                                    @foreach($data_dish->detail_dish as $item_detail_dish_food)
                                        <div class="dropdown">
                                            <input type="hidden" required name="nguyen_lieu[{{$i}}][]" class="luong_val1 form-control" id="id_ten_mon_1" value="{{ $item_detail_dish_food->id_food }}">
                                            <input type="text" required name="" class="val_sl1 form-control" id="ten_mon_1" data-toggle="dropdown" onkeyup="search(this.value,this)" value="{{ @$option[$item_detail_dish_food->id_food] }}" style="margin-bottom: 10px">
                                            <div class="dropdown-menu col-md-12" id="menu_ten_mon_1">

                                            </div>
                                        </div>
                                    @endforeach
                                </td>
                                <td class="td_so_luong">
                                    @foreach($data_dish->detail_dish as $item_detail_dish_number)
                                        <input style="margin-bottom: 10px" type="number" required
                                               name="so_luong[{{ $i }}][]" class="so_luong form-control"
                                               value="{{ $item_detail_dish_number->number }}">
                                    @endforeach
                                </td>

                                <td class="td_cong_thuc"><textarea name="cong_thuc[{{ $i }}]"
                                                                   class="cong_thuc form-control">{{ $data_dish->cooking_note }}</textarea>
                                </td>
                                <td class="td_ghi_chu"><textarea name="ghi_chu[{{ $i }}]"
                                                                 class="ghi_chu form-control">{{ $data_dish->note }}</textarea>
                                </td>
                                <td>
                                    <input type="hidden" class="hidden_meal" value='{{ $i }}'>
                                    <a href="#" class="btn btn-success" title="Thêm nguyên liệu" id="add_nl">
                                        <i class="voyager-plus"></i>
                                    </a>
                                    <a href="#" class="btn btn-danger remove_field" title="Xóa">
                                        <i class="voyager-trash"></i>
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
            </div>
        </form>
    </div>
@stop

@section('page-script')
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
                        html+=' <div class="dropdown">';
                        html += '<input type="text" required name="nguyen_lieu[' + x + '][]" class="luong_val1 form-control" id="id_ten_mon_' + x + '">'
                        html += '<input type="text" required name="" class="val_sl1 form-control" id="ten_mon_' + x + '" data-toggle="dropdown" onkeyup="search(this.value,this)">'
                        html += '<div class="dropdown-menu col-md-12 " id="menu_ten_mon_' + x + '">';

                        html += '</div>';
                        html += '</div>';
                    html += '</td>';
                    html += '<td class="td_so_luong"><input type="number" required name="so_luong[' + x + '][]" class="so_luong form-control"></td>';
//                    html += '<td class="td_don_vi"><input type="text" required name="don_vi[' + x + '][]" class="don_vi form-control"></td>';
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
                    $('select').select2({
                        placeholder: "Select a state or many…",
                        formatResult: format,
                        formatSelection: format,
                        escapeMarkup: function (m) {
                            return m;
                        }
                    });
                }
            });

            $(".mon_an").on("click", ".remove_field", function (e) { //user click on remove text
                e.preventDefault();
                $(this).parent('td').parent('tr').remove();
//                x--;
            })

            $("#main").on("click", "#add_nl", function (event) {
                var a = $(this).closest("tr").find('.hidden_meal').val();
                var html =' <div class="dropdown">';
                html += '<input type="hidden" required name="nguyen_lieu[' + a + '][]" class="luong_val1 form-control">';
                html += '<input type="text" required name="" class="val_sl1 form-control" data-toggle="dropdown" onkeyup="search(this.value,this)"  style="margin-top: 10px">';
                html += '<div class="dropdown-menu col-md-12 ">';

                html += '</div>';
                html += '</div>';
                $(this).closest("tr").find('.td_nguyen_lieu').append(html);
                $(this).closest("tr").find('.td_so_luong').append('<input type="number" required name="so_luong[' + a + '][]" class="so_luong form-control" style="margin-top: 10px">');
//                $(this).closest("tr").find('.td_don_vi').append('<input type="text" required name="don_vi[' + a + '][]" class="don_vi form-control" style="margin-top: 10px">');
//                $('select').select2({
//                    placeholder: "Select a state or many…",
//                    formatResult: format,
//                    formatSelection: format,
//                    escapeMarkup: function (m) {
//                        return m;
//                    }
//                });
                return false;
//                $("html, body").animate({ scrollTop: $(this).closest("tr").find('.td_nguyen_lieu').offset().top }, 1);
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
                        "date": date,
                        "id":{{ $info_meal->id }},
                    },
                    success: function (data) {
                        status = data.state;
                        if (data.state == 0) {
                            toastr.error(data.name);
                            $('.datetimepicker1').css('border', '1px solid #F00')
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
            $('.nguyen_lieu').select2({
                placeholder: "Select a state or many…",
                formatResult: format,
                formatSelection: format,
                escapeMarkup: function (m) {
                    return m;
                }
            });
        });
        $('.uyquyen').change(function () {
            var c = this.checked;
            if (c) {
                $("#main input").attr('disabled', 'true');
                $("#main select").attr('disabled', 'true');
                $("#main textarea").attr('disabled', 'true');
            } else {
                $("#main input").removeAttr('disabled');
                $("#main select").removeAttr('disabled');
                $("#main textarea").removeAttr('disabled');
            }
        });
        function format(state) {
            if (!state.id) return state.text; // optgroup
            return "" + state.text;
        }

        function search(data,cl){
            $.ajax({
                url: '{{ route('admin.user.ajax_search_food') }}',
                type: 'get',
                async: false,
                data: {
                    'val_search':data,
                    'name_click':cl.id
                },
                success: function (data) {
                    var a = $(cl).closest(".dropdown").find('.dropdown-menu').html(data);
                }
            });
        }
        function select_food(id,id_click,name,cl){
            $(cl).closest(".dropdown").find('.luong_val1').val(id);
            $(cl).closest(".dropdown").find('.val_sl1').val(name);
            return false;
        }
    </script>
@stop
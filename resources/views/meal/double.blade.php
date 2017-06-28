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
        .select2-container {
            margin-bottom: 10px;
            width: 100% !important;
        }
        .td_nguyen_lieu {
            width: 30%;
        }

        .select2-results-dept-0 { /* do the columns */
            float: left;
            width: 50%;
        }

        img.flag {
            height: 10px;
            padding-right: 5px;
            width: 15px;
        }

        /* move close cross [x] from left to right on the selected value (tag) */
        #s2id_e2_2.select2-container-multi .select2-choices .select2-search-choice {
            padding: 3px 18px 3px 5px;
        }
        #s2id_e2_2.select2-container-multi .select2-search-choice-close {
            left: auto;
            right: 3px;
        }
        .select2-container .select2-choice {
            height: 34px !important;
            line-height: 34px !important;
        }
        .select2-drop.select2-drop-above.select2-drop-active.select2-display-none {
            width: 900px !important;
            left: 10% !important;
            height: 300px;
            border: 1px solid #eee !important;
        }
        .select2-drop-active {
            width: 900px !important;
            left: 10% !important;
            height: 300px;
            border: 1px solid #eee !important;
        }
        .select2-results {
            background: aliceblue;
        }
    </style>
    &nbsp;
    {{--<a href="{{ route('admin.kitchen.add') }}" class="btn btn-success">--}}
    {{--<i class="voyager-plus"></i> Add New--}}
    {{--</a>--}}
@stop
@section('main-content')
    <div class="page-content container-fluid panel" style="padding: 50px">
        <div class="row">
            @if(Session::has('message'))
                <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
            @endif
                <h1 class="page-title" style="border-bottom: 1px solid #eee;padding-bottom: 15px">
                    Đăng ký món ăn
                </h1>
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
                    <div class="panel-heading col-md-6" style="padding-bottom: 10px;">
                        <h3 class="panel-title">Ủy quyền đi chợ</h3>
                        <div class="panel-body">
                            <input type="checkbox" @if($info_meal->is_permission == 1) checked @endif class="uyquyen" name="uyquyen" value="1"> Ủy quyền đi chợ,chọn món
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
                            {{--<th>Đơn vị</th>--}}
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
                                            {!! Form::select('nguyen_lieu['.$i.'][]', $option, $item_detail_dish_food->id_food, ['class' => 'nguyen_lieu']) !!}
                                        @endforeach
                                    </td>
                                    <td class="td_so_luong">
                                        @foreach($data_dish->detail_dish as $item_detail_dish_number)
                                            <input style="margin-bottom: 10px" type="number" required name="so_luong[{{ $i }}][]" class="so_luong form-control" value="{{ $item_detail_dish_number->number }}">
                                        @endforeach
                                    </td>
                                    {{--<td class="td_don_vi">--}}
                                        {{--@foreach($data_dish->detail_dish as $item_detail_dish_unit)--}}
                                            {{--<input style="margin-bottom: 10px" type="text" required name="don_vi[{{ $i }}][]" class="don_vi form-control"  value="{{ $item_detail_dish_unit->unit }}">--}}
                                        {{--@endforeach--}}
                                    {{--</td>--}}

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
            </form>
        </div>
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
                        escapeMarkup: function(m) { return m; }
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
//                $(this).closest("tr").find('.td_don_vi').append('<input type="text" required name="don_vi[' + a + '][]" class="don_vi form-control" style="margin-top: 10px">');
                $('select').select2({
                    placeholder: "Select a state or many…",
                    formatResult: format,
                    formatSelection: format,
                    escapeMarkup: function(m) { return m; }
                });
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
            $('select').select2({
                placeholder: "Select a state or many…",
                formatResult: format,
                formatSelection: format,
                escapeMarkup: function(m) { return m; }
            });
        });
        $('.uyquyen').change(function(){
            var c = this.checked;
            if (c){
                $("#main input").attr('disabled','true');
                $("#main select").attr('disabled','true');
                $("#main textarea").attr('disabled','true');
            }else {
                $("#main input").removeAttr('disabled');
                $("#main select").removeAttr('disabled');
                $("#main textarea").removeAttr('disabled');
            }
        });
        function format(state) {
            if (!state.id) return state.text; // optgroup
            return "" + state.text;
        }
    </script>
@stop
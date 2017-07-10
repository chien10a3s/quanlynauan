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
        .modal-backdrop {
            position: initial !important;
        }
        .td_nguyen_lieu .dropdown-menu {
            min-width: 100% !important;
            width: 400%;
            box-shadow: 5px 3px #eee;
            max-height: 300px;
            overflow: auto;
        }
        @media screen and (min-width: 768px) {

            #detail_meal .modal-dialog  {width:90%;}

        }
    </style>
@stop
@section('main-content')
    <div class="modal fade" tabindex="-1" id="select_meal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="voyager-plus"></i> Chọn thực đơn đã dùng</h4>
                </div>
                <div class="modal-body" id="data_result" style="height: 300px;overflow: auto;">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-right"
                            data-dismiss="modal">Cancel
                    </button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


    <div class="modal fade" tabindex="-1" id="detail_meal" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" id="data_result_detail">

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <div class="page-content container">
        <h3 class="page-title">
            Đặt món ăn @if($status == 2 ) <b style="color: #00a7d0">Bạn đã ủy quyền cho đầu bếp đi chợ</b> @endif
            @if($status != 2 )
                <a href="#" class="btn btn-success pull-right" data-toggle="modal" title="Chọn thực đơn"
                   onclick="select_meal_list()">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i> Chọn từ danh sách
                </a>
            @endif
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
                           value="{{ \Carbon\Carbon::now()->format('d/m/Y') }}">
                </div>
                <div class="col-md-3">
                    <label>Số suất ăn <b style="color: red">*</b></label>
                    <input type="number" class="form-control" required name="number_of_meals">
                </div>
                <div class="col-md-3">
                    <label>Số tiền 1 suất <b style="color: red">*</b></label>
                    <select class="form-control" name="money">
                        <option value="25000">25.000 VDN</option>
                        <option value="30000">30.000 VDN</option>
                        <option value="35000">35.000 VDN</option>
                        <option value="40000">40.000 VDN</option>
                        <option value="45000">45.000 VDN</option>
                        <option value="50000">50.000 VDN</option>
                        <option value="55000">55.000 VDN</option>
                        <option value="60000">60.000 VDN</option>
                        <option value="65000">65.000 VDN</option>
                        <option value="70000">70.000 VDN</option>
                        <option value="75000">75.000 VDN</option>
                        <option value="80000">80.000 VDN</option>
                        <option value="85000">85.000 VDN</option>
                        <option value="90000">90.000 VDN</option>
                        <option value="95000">95.000 VDN</option>
                        <option value="100000">100.000 VDN</option>
                    </select>
                    {{--<input type="number" class="form-control" required name="money">--}}
                </div>
                <div class="radio col-md-3" style="padding-bottom: 10px;">
                    <label class="checkbox-inline">
                        <input @if($status == 2 ) type="hidden" checked @else type="checkbox" @endif class="uyquyen"
                               name="uyquyen" value="1">@if($status != 2 )Ủy quyền đi chợ,chọn món @endif</label>
                </div>
                @if($status != 2 )
                    <div class="col-md-12">
                        <hr/>
                        <table class="table table-bordered" id="main"
                               style="margin-bottom: 15px;border: 1px solid #eee">
                            <thead>
                            <tr>
                                <th>Tên món</th>
                                <th>Nguyên liệu</th>
                                <th>Số lượng</th>
                                <th>Công thức</th>
                                <th>Ghi chú</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody class="mon_an">
                            <tr class="tr_mon" id="tr_mon">
                                <td><input type="text" name="tenmon[1]" required class="tenmon form-control"></td>
                                <td class="td_nguyen_lieu">
                                    <div class="dropdown">
                                        <input type="hidden" required name="nguyen_lieu[1][]" class="luong_val1 form-control" id="id_ten_mon_1">
                                        <input type="text" required name="" class="val_sl1 form-control" id="ten_mon_1" data-toggle="dropdown" onkeyup="search(this.value,this)" onfocus="search(this.value,this)">
                                        <div class="dropdown-menu col-md-12" id="menu_ten_mon_1">

                                        </div>
                                    </div>
                                </td>
                                <td class="td_so_luong"><input type="number" required name="so_luong[1][]"
                                                               class="so_luong form-control"></td>
                                </td>
                                <td class="td_cong_thuc"><textarea name="cong_thuc[1]"
                                                                   class="cong_thuc form-control"></textarea>
                                </td>
                                <td class="td_ghi_chu"><textarea name="ghi_chu[1]"
                                                                 class="ghi_chu form-control"></textarea>
                                </td>
                                <td>
                                    <input type="hidden" class="hidden_meal" value='1'>
                                    <a href="#" class="btn btn-success" title="Thêm nguyên liệu" id="add_nl">
                                        <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                    </a>
                                </td>
                            </tr>

                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="6">
                                    <button class="btn btn-info add_button pull-right">Thêm món</button>
                                </td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                @endif
                <div class="col-md-12">

                    <button type="submit" class="btn btn-lg btn-primary ">Đặt món</button>
                </div>
            </div>
        </form>
    </div>
@stop

@section('page-script')
    <script src="/plugin/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="/plugin/jquery-loading-overlay-master/src/loadingoverlay.js"></script>
    <script>
        $(document).ready(function () {

            var max_fields = 200;
            var x = 1; //initlal text box count
            var n = 1; //initlal text box count
            $(".add_button").click(function (e) { //on add input button click
                e.preventDefault();
                if (x < max_fields) { //max input box allowed
                    x++; //text box increment
                    var html = '<tr class="tr_mon">';
                    html += '<td><input type="text" name="tenmon[' + x + ']" required class="tenmon form-control"></td>';
                    html += '<td class="td_nguyen_lieu">';
                        html+=' <div class="dropdown">';
                            html += '<input type="hidden" required name="nguyen_lieu[' + x + '][]" class="luong_val1 form-control" id="id_ten_mon_' + x + '">'
                            html += '<input type="text" required name="" class="val_sl1 form-control" id="ten_mon_' + x + '" data-toggle="dropdown" onkeyup="search(this.value,this)" onfocus="search(this.value,this)">'
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
                    html += '<i class="fa fa-plus-circle" aria-hidden="true"></i>';
                    html += '</a>';
                    html += '<a href="#" class="btn btn-danger remove_field" title="Xóa">';
                    html += '<i class="voyager-trash"></i>';
                    html += '</a>';
                    html += '</td>';
                    html += '</tr>';
                    $('.mon_an').append(html);
                }
            });

            $(".mon_an").on("click", ".remove_field", function (e) { //user click on remove text
                e.preventDefault();
                $(this).parent('td').parent('tr').remove();
            })

            $("#main").on("click", "#add_nl", function (event) {
                var a = $(this).closest("tr").find('.hidden_meal').val();

                var html =' <div class="dropdown">';
                html += '<input type="hidden" required name="nguyen_lieu[' + a + '][]" class="luong_val1 form-control">';
                html += '<input type="text" required name="" class="val_sl1 form-control" data-toggle="dropdown" onkeyup="search(this.value,this)" onfocus="search(this.value,this)"  style="margin-top: 10px">';
                html += '<div class="dropdown-menu col-md-12 ">';

                html += '</div>';
                html += '</div>';
                $(this).closest("tr").find('.td_nguyen_lieu').append(html);
                $(this).closest("tr").find('.td_so_luong').append('<input type="number" required name="so_luong[' + a + '][]" class="so_luong form-control" style="margin-top: 10px">');
                return false;
            });

            //Check Date

            $("#my_form").on("submit", function (e) { //user click on remove text
                $.LoadingOverlay("show");
                var date = $('.datetimepicker1').val();
                var status = 0;
                $.ajax({
                    url: '{{ route('admin.user.checkdate') }}',
                    type: 'get',
                    async: false,
                    data: {
                        "date": date,
                    },
                    success: function (data) {
                        status = data.state;
                        if (status == 0) {
                            toastr.error(data.name);
                            $('.datetimepicker1').css('border', '1px solid #F00')
                            e.preventDefault();
                        }
                        setTimeout(function(){
                            $.LoadingOverlay("hide");
                        });
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
            $('#e2_2').select2({
                placeholder: "Select a state or many…",
                formatResult: format,
                formatSelection: format,
                width: 'auto',
                dropdownAutoWidth: true,
                escapeMarkup: function (m) {
                    return m;
                }
            });
        });
        function select_meal_list() {
            $.LoadingOverlay("show");
            $('#select_meal').modal('show');
            $.ajax({
                url: '{{ route('admin.user.ajax_get_list_meal') }}',
                type: 'get',
                async: true,
                data: {},
                success: function (data) {
                    $('#data_result').html(data);
                    setTimeout(function(){
                        $.LoadingOverlay("hide");
                    });
                }
            });
        }
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
            $(cl).closest(".dropdown").find('.dropdown-menu').LoadingOverlay("show");
            $.ajax({
                url: '{{ route('admin.user.ajax_search_food') }}',
                type: 'get',
                async: true,
                data: {
                    'val_search':data,
                    'name_click':cl.id
                },
                success: function (data) {
                    var a = $(cl).closest(".dropdown").find('.dropdown-menu').html(data);
                    setTimeout(function(){
                        $(cl).closest(".dropdown").find('.dropdown-menu').LoadingOverlay("hide");
                    });
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
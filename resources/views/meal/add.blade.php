@extends('voyager::master')

@section('page_header')
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
                    <h3 class="panel-title">Ngày đăng ký</h3>
                    <div class="panel-body">
                        <input type="text" class="form-control" name="date">
                    </div>
                </div>
                <div class="panel-heading col-md-6">
                    <h3 class="panel-title">Số xuất ăn</h3>
                    <div class="panel-body">
                        <input type="number" class="form-control" name="number_of_meals">
                    </div>
                </div>
                <div class="panel-heading col-md-12">
                    <h3 class="panel-title">Món chính</h3>
                </div>
                <table class="table table-hover table-bordered">
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
                    <tr class="tr_mon">
                        <td><input type="text" name="tenmon[]" class="tenmon form-control"></td>
                        <td class="td_nguyen_lieu"><input type="text" name="nguyen_lieu[]"
                                                          class="nguyen_lieu form-control"></td>
                        <td class="td_so_luong"><input type="text" name="so_luong[]" class="so_luong form-control"></td>
                        <td class="td_don_vi"><input type="text" name="don_vi[]" class="don_vi form-control"></td>
                        <td class="td_cong_thuc"><textarea name="cong_thuc[]" class="cong_thuc form-control"></textarea>
                        </td>
                        <td class="td_ghi_chu"><textarea name="ghi_chu[]" class="ghi_chu form-control"></textarea></td>
                        <td>
                            <a href="#" class="btn btn-success" title="Thêm nguyên liệu" onclick="them_nguyen_lieu()">
                                <i class="voyager-plus"></i>
                            </a>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <button class="btn btn-success add_button"><i class="voyager-plus"> </i> Thêm món</button>
            </div>
        </div>
    </div>
@stop

@section('javascript')
    <script>
        function them_nguyen_lieu() {
            $('.td_nguyen_lieu').append(`<input type="text" name="nguyen_lieu[]" class="nguyen_lieu form-control" style="margin-top: 10px">`);
            $('.td_so_luong').append(`<input type="text" name="so_luong[]" class="so_luong form-control" style="margin-top: 10px">`);
            $('.td_don_vi').append(`<input type="text" name="don_vi[]" class="don_vi form-control" style="margin-top: 10px">`);
        }

        $(document).ready(function () {
            var max_fields = 20;
            var x = 1; //initlal text box count
            var n = 1; //initlal text box count
            $(".add_button").click(function (e) { //on add input button click
                e.preventDefault();
                if (x < max_fields) { //max input box allowed
                    x++; //text box increment
                    $('.mon_an').append(`<tr class="tr_mon">
                            <td><input type="text" name="tenmon[]" class="tenmon form-control"></td>
                            <td class="td_nguyen_lieu"><input type="text" name="nguyen_lieu[]" class="nguyen_lieu form-control"></td>
                            <td class="td_so_luong"><input type="text" name="so_luong[]" class="so_luong form-control"></td>
                            <td class="td_don_vi"><input type="text" name="don_vi[]" class="don_vi form-control"></td>
                            <td class="td_cong_thuc"><textarea name="cong_thuc[]" class="cong_thuc form-control"></textarea></td>
                            <td class="td_ghi_chu"><textarea name="ghi_chu[]" class="ghi_chu form-control"></textarea></td>
                            <td>
                                <a href="#" class="btn btn-success" title="Thêm nguyên liệu" onclick="them_nguyen_lieu()">
                                    <i class="voyager-plus"></i>
                                </a>
                                 <a href="#" class="btn btn-success remove_field" title="Xóa">
                                    <i class="voyager-trash"></i>
                                </a>
                            </td>
                        </tr>`);
                }
            });

            $(".mon_an").on("click", ".remove_field", function (e) { //user click on remove text
                e.preventDefault();
                $(this).parent('td').parent('tr').remove();
                x--;
            })

        });
    </script>
@stop
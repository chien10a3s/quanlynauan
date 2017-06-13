@extends('voyager::master')
@section('page_header')
    <h1 class="page-title">
        <i class="voyager-list"></i> Chi tiết thực đơn ngày
    </h1>
@stop
@section('content')
    <div class="page-content container-fluid">
        <div class="row">
            @if(Session::has('message'))
                <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
            @endif
            {{ csrf_field() }}
            <div class="panel panel-bordered col-md-12">
                <div class="panel-heading col-md-6">
                    <h3 class="panel-title">Ngày đăng ký</h3>
                    <div class="panel-body">
                        <input type="text" class="form-control datetimepicker1" name="date"
                               value="{{ \Carbon\Carbon::now()->format('d/m/Y') }}">
                    </div>
                </div>
                <div class="panel-heading col-md-6">
                    <h3 class="panel-title">Số xuất ăn</h3>
                    <div class="panel-body">
                        <input type="number" class="form-control" name="number_of_meals">
                    </div>
                </div>
                <div class="panel-heading col-md-6">
                    <h3 class="panel-title">Số tiền 1 suất</h3>
                    <div class="panel-body">
                        <input type="number" class="form-control" name="money">
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
                    <tr class="tr_mon" id="tr_mon">
                        <td><input type="text" name="tenmon[1]" class="tenmon form-control"></td>
                        <td class="td_nguyen_lieu">
                            {!! Form::select('nguyen_lieu[1][]', $option, 0, ['class' => 'nguyen_lieu form-control']) !!}
                        </td>
                        <td class="td_so_luong"><input type="number" name="so_luong[1][]"
                                                       class="so_luong form-control"></td>
                        <td class="td_don_vi"><input type="text" name="don_vi[1][]" class="don_vi form-control">
                        </td>
                        <td class="td_cong_thuc"><textarea name="cong_thuc[1]"
                                                           class="cong_thuc form-control"></textarea>
                        </td>
                        <td class="td_ghi_chu"><textarea name="ghi_chu[1]" class="ghi_chu form-control"></textarea>
                        </td>
                        <td>
                            <input type="hidden" class="hidden_meal" value='1'>
                            <a href="#" class="btn btn-success" title="Thêm nguyên liệu" id="add_nl">
                                <i class="voyager-plus"></i>
                            </a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
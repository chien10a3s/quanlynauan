@extends('layouts.1column')

@section('main-content')
    <div class="page-content container">
        <div class="nav-tabs-custom">
            @include('customer.nav')
            <div class="tab-content">
                <div class="tab-pane active">
                    <div class="row">
                        <form role="form" id="all_order_form">
                            <div class="form-group col-md-3">
                                <label>Từ ngày</label>
                                <input type="text" class="form-control datetimepicker1" name="start_date"
                                       placeholder="Order Date"
                                       data-date-format="dd/mm/yyyy" id="ord_date" maxlength="10"
                                       value="{{ @$start_date_begin }}">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Đến ngày</label>
                                <input type="text" class="form-control datetimepicker1" name="end_date"
                                       placeholder="Order Date"
                                       data-date-format="dd/mm/yyyy" id="ord_dt_to" maxlength="10"
                                       value="{{ @$end_date_begin }}">
                            </div>

                            <div class="col-md-3">
                                <label style="display: block;">&nbsp;</label>
                                <input type="submit" class="btn btn-info" value="Hiển thị">

                            </div>
                        </form>
                    </div>
                    <hr>
                    <table class="table table-bordered" id="sample_1">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Ngày</th>
                                <th>Số tiền</th>
                                <th>Số đơn hàng</th>
                                <th>Ghi chú</th>
                                <th>Số dư cuối</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 0;
                            ?>
                            @if(count($all_log) > 0)
                                @if(count($all_log->log))
                                    @foreach($all_log->log as $item_log)
                                        <tr>
                                            <td>{{ $i+=1 }}.</td>
                                            <td>{{ $item_log->id }}</td>
                                            <td>100.000đ</td>
                                            <td><a target="_blank" href="/chitietdonhang">Đơn hàng #001</a></td>
                                            <td>Trừ tiền mua thúc ăn bữa trưa 20-06-2017</td>
                                            <td>15.000.000đ</td>
                                        </tr>
                                    @endforeach
                                @endif
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('page-script')
    <link rel="stylesheet" type="text/css" href="{{ voyager_asset('lib/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ voyager_asset('lib/css/dataTables.bootstrap.css') }}">
    {!! Html::style('plugin/datepicker/datepicker3.css') !!}
    {!! Html::style('plugin/datepicker/bootstrap-datetimepicker.min.css') !!}
    {!! Html::script('plugin/datepicker/bootstrap-datetimepicker.min.js') !!}
    <script src="/plugin/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript" src="{{ voyager_asset('lib/js/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ voyager_asset('lib/js/dataTables.bootstrap.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('.datetimepicker1').datepicker({
                todayBtn: true,
                language: "en",
                autoclose: true,
                todayHighlight: true,
                format: 'dd/mm/yyyy',
            });
            $('#sample_1').DataTable({"order": []});
            $('#all_order_form').submit(function () {

            })
        });
    </script>
@stop
@extends('layouts.1column')

@section('main-content')
    <style>
        @media screen and (min-width: 768px) {

            #donhang .modal-dialog  {width:90%;}

        }
    </style>
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
                                <th>Chi tiết đơn hàng</th>
                                <th>Ghi chú</th>
                                <th>Số dư cuối</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 0;
                            ?>
                            @if(count($all_log) > 0)
                                @foreach($all_log as $item_log)
                                    <?php
                                        $data=json_decode($item_log->data);
                                    ?>
                                    <tr>
                                        <td>{{ $i+=1 }}.</td>
                                        <td>{{ \Carbon\Carbon::parse($item_log->updated_at)->format('H:i:s d/m/Y') }}</td>
                                        <td>{{ number_format($data->minus_money) }} đ</td>
                                        @if($item_log->table == "daily_meals")
                                            <td><a href="#" class="btn-sm btn-success" onclick="detail_order({{$item_log->item_id}})">Đơn hàng </a></td>
                                        @else
                                            <td><a target="_blank" href="/chitietdonhang">Chi tiết </a></td>
                                        @endif
                                        <td>Trừ tiền mua thúc ăn bữa trưa {{ \Carbon\Carbon::parse($data->detail->day)->format('d/m/Y') }}</td>
                                        <td>{{ number_format($data->last_money) }} đ</td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{--Modal detail order--}}
    <div class="modal fade" tabindex="-1" id="donhang" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title"><img src="/social/comment-icon.png"> Chi tiết đơn hàng
                        <label class="date_meal"></label>
                    </h4>
                </div>

                <div class="modal-content" id="data_result" style="margin-top: 15px">

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">
                        Đóng
                    </button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@stop

@section('page-script')
    <link rel="stylesheet" type="text/css" href="{{ voyager_asset('lib/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ voyager_asset('lib/css/dataTables.bootstrap.css') }}">
    {!! Html::style('plugin/datepicker/datepicker3.css') !!}
    {!! Html::style('plugin/datepicker/bootstrap-datetimepicker.min.css') !!}
    {!! Html::script('plugin/datepicker/bootstrap-datetimepicker.min.js') !!}
    <script src="/plugin/jquery-loading-overlay-master/src/loadingoverlay.js"></script>
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
        function detail_order(id_meal) {
            $.LoadingOverlay("show");
            $("#donhang").modal('show');
            $.ajax({
                method: "get",
                async: true,
                url: '{{route('user.account.chitietdonhang')}}',
                data: {
                    'daily_meal_id': id_meal
                },
                success: function (data) {
                    $("#data_result").html(data);
                    setTimeout(function(){
                        $.LoadingOverlay("hide");
                    });
                }
            });
        }
    </script>
@stop
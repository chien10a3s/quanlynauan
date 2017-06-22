@extends('voyager::master')

@section('page_header')
    <h1 class="page-title">
        <i class="voyager-list"></i> Feedback của <span style="color: red;">{{@$data['kitchen']->name}}
            ngày {{ \Carbon\Carbon::parse($data['date'])->format('d/m/Y') }}</span>
    </h1>
    <style>
        a, a:hover {
            text-decoration: none !important;
        }

        .modal-header {
            border-bottom: 1px solid #e5e5e5 !important;
        }

        .modal-footer {
            border-top: 1px solid #e5e5e5 !important;
        }

        .modal-body span {
            text-align: center;
        }

        h5 {
            margin-bottom: 0px;
        }

        .item-meal {
            margin-bottom: 20px;
        }

        .btn {
            font-size: 13px;
        }
    </style>
@stop
@section('content')
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">

                    <div class="panel-body">
                        {{ Form::open(['route' => ['admin.chef.feedback', @$data['kitchen_id']], 'class' => 'form-horizontal', 'role' => 'form','method' => 'GET', 'style' => 'margin-bottom:20px']) }}
                        <div class="input-group date date-picker col-md-6" style="float: left;">
                            <div class="col-md-4" style="padding-left: 0px">
                                <input type="text" class="form-control date_time"
                                       value="{{ \Carbon\Carbon::parse($data['date'])->format('d/m/Y') }}" readonly=""
                                       name="day" id="date_meal">
                            </div>

                            <div class="col-md-8">
                                <select class="form-control" name="meal_date" id="meal_date">
                                    <option value="">Chọn thực đơn</option>
                                    @foreach($data['meals'] as $key => $meal)
                                        <option value="{{$meal->id}}">Thực đơn {{$key+1}}: {{$meal->number_of_meals}} suất, {{$meal->money_meals}}/1 suất</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success" style="margin-left: 5px; margin-top: 0px;">
                            Xem
                        </button>
                        {{ Form::close() }}
                        <table id="sample_1" class="table table-hover">
                            <thead>
                            <tr>
                                <th>STT</th>
                                <th>Ngày</th>
                                <th>Tiêu đề</th>
                                <th>Nội dung</th>
                                <th>Thời gian tạo</th>
                                <th>Người tạo</th>
                                <th>Trạng thái</th>
                                {{--<th class="actions col-md-4">Actions</th>--}}
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($data['feedback']) > 0)
                                <?php $i = 1; ?>
                                @foreach($data['feedback'] as $item)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{\Carbon\Carbon::parse(@$item->date)->format('d/m/Y')}}</td>
                                        <td>{{ @$item->title }}</td>
                                        <td>{{ @$item->content }}</td>
                                        <td>{{\Carbon\Carbon::parse(@$item->created_at)->format('H:i:s')}}</td>
                                        <td>{{ @$item->create_user->name }}({{@$item->create_user->email}})</td>
                                        <td>
                                            @if($item->status == 0 )
                                                <span class="label label-warning">Chưa phê duyệt</span>
                                            @else
                                                <span class="label label-success">Đã phê duyệt</span>
                                            @endif
                                        </td>

                                        {{--<td>--}}
                                            {{--<a class="btn-sm btn-warning" style="cursor: pointer;"--}}
                                               {{--title="Xem chi tiết thực đơn"--}}
                                               {{--data-toggle="modal"--}}
                                               {{--data-target="#detail_meal">--}}
                                                {{--<i class="voyager-eye"></i> Xem chi tiết--}}
                                            {{--</a> &nbsp;--}}
                                            {{--<div class="modal fade" id="detail_meal" role="dialog">--}}
                                                {{--<div class="modal-dialog">--}}
                                                    {{--<!-- Modal content-->--}}
                                                    {{--<div class="modal-content">--}}
                                                        {{--<div class="modal-header"--}}
                                                             {{--style="background: #5bc0de; color: #fff;">--}}
                                                            {{--<button type="button" class="close" data-dismiss="modal">--}}
                                                                {{--&times;--}}
                                                            {{--</button>--}}
                                                            {{--<h4 class="modal-title"><i class="voyager-eye"></i> Thực đơn--}}
                                                                {{--ngày {{ \Carbon\Carbon::parse($data['date'])->format('d/m/Y') }}--}}
                                                            {{--</h4>--}}
                                                        {{--</div>--}}
                                                        {{--<div class="modal-body">--}}
                                                            {{--@if(count($item->daily_dish) > 0)--}}
                                                                {{--@foreach($item->daily_dish as $dish)--}}
                                                                    {{--<div class="item-meal">--}}
                                                                        {{--<h5>- Món ăn: {{$dish->name}}</h5>--}}
                                                                        {{--<span><i>&nbsp;(Lưu ý: {{$dish->cooking_note}}--}}
                                                                                {{--)</i></span> <br>--}}

                                                                        {{--@if(count($dish->detail_dish) > 0)--}}
                                                                            {{--@foreach($dish->detail_dish as $detail)--}}
                                                                                {{--+ {{$detail->number}} {{$detail->unit}} {{$detail->name}}--}}
                                                                                {{--(Đơn giá: <span--}}
                                                                                        {{--class="number-format">{{$detail->money}}</span>--}}
                                                                                {{--VND) <br>--}}
                                                                            {{--@endforeach--}}
                                                                        {{--@endif--}}
                                                                    {{--</div>--}}
                                                                {{--@endforeach--}}
                                                            {{--@endif--}}
                                                        {{--</div>--}}
                                                        {{--<div class="modal-footer">--}}
                                                            {{--<button type="button" class="btn btn-default"--}}
                                                                    {{--data-dismiss="modal">Close--}}
                                                            {{--</button>--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}

                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--</td>--}}
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('javascript')
    <!-- DataTables -->
    <script src="/js/jquery-number-master/jquery.number.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#sample_1').DataTable({"order": []});
            $('.number-format').number(true);
            $("#date_meal").on('change', function(){
                $('#meal_date').empty();
                $.ajax({
                    url: '{{route('admin.chef.meal.ajax', $data['kitchen_id'])}}',
                    type: 'get',
                    data: {date: $(this).val()},
                    success: function(data){
                        $('#meal_date').append($('<option></option>').attr("value", null).text('Chọn thực đơn'));
                        $.each(data, function (key, value) {
                            if (value !== null) {
                                $('#meal_date').append($('<option class="number-format"></option>').attr("value", value.id).text('Thực đơn '+(key + 1)+': '+value.number_of_meals+' suất, '+value.money_meals+'/suất'));
                            }
                        });
                    }
                });
            });

        });
        $('.date_time').datepicker({
            todayBtn: false,
            language: "en",
            autoclose: true,
            todayHighlight: true,
            format: 'dd/mm/yyyy'
        });
    </script>
@stop
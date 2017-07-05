@extends('voyager::master')

@section('page_header')
    <h1 class="page-title">
        <i class="voyager-list"></i> Thực đơn của <span style="color: red;">{{@$data['kitchen']->name}}
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
        .post-item{
            overflow-y: scroll; max-height:85%;  margin-top: 50px; margin-bottom:50px;
        }
        .list-comments{
            overflow-y: initial !important
        }
        .list-comments{
            height: 250px;
            overflow-y: auto;
        }
        .img-circle{
            width: 3.8rem !important;
            height: 3.8rem !important;
        }
        .comments-item-child-new .img-circle{
            width: 3rem !important;
            height: 3rem !important;
        }
        .comments-item-child{
            padding-top: 20px !important;
        }
    </style>
    <link rel="stylesheet" type="text/css" href="{{asset('css/feedback.css')}}">
@stop
@section('content')
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}"/>
                        {{ Form::open(['route' => ['admin.chef.meal', @$data['kitchen_id']], 'class' => 'form-horizontal', 'role' => 'form','method' => 'GET']) }}
                        <div class="input-group date date-picker col-md-3" style="float: left;">
                            <input type="text" class="form-control date_time"
                                   value="{{ \Carbon\Carbon::parse($data['date'])->format('d/m/Y') }}" readonly=""
                                   name="day">

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
                                <th>Số suất ăn</th>
                                <th>Số tiền khách hàng đặt/1 suất</th>
                                <th>Số tiền thực tế/1 suất</th>
                                <th>Tình trạng</th>
                                <th class="actions col-md-4">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($data['meals']) > 0)
                                <?php $i = 1; ?>
                                @foreach($data['meals'] as $item)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{\Carbon\Carbon::parse(@$item->day)->format('d/m/Y')}}</td>
                                        <td>{{@$item->number_of_meals}}</td>
                                        <td><span class="number-format">{{ @$item->money_meals }}</span> VND</td>
                                        <td><span class="number-format">{{ @$item->total_meal_chef }}</span> VND</td>
                                        <td>
                                            @if($item->is_permission == 1)
                                                <span class="label label-success">Khách hàng tự đi chợ</span>
                                            @else
                                                <span class="label label-warning">Khách hàng ủy quyền đi chợ</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a class="btn-sm btn-warning" style="cursor: pointer;"
                                               title="Xem chi tiết thực đơn"
                                               data-toggle="modal"
                                               data-target="#detail_meal{{$item->id}}">
                                                <i class="voyager-eye"></i>
                                            </a> &nbsp;

                                            <a class="btn-sm btn-success" style="cursor: pointer;"
                                               title="Nhập số tiền thực tế"
                                               data-toggle="modal"
                                               data-target="#total_meal_chef{{$item->id}}{{$item->is_permission}}">
                                                <i class="voyager-edit"></i>
                                            </a>

                                            <div class="modal fade" id="detail_meal{{$item->id}}" role="dialog">
                                                <div class="modal-dialog modal-lg">
                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-header"
                                                             style="background: #5bc0de; color: #fff;">
                                                            <button type="button" class="close" data-dismiss="modal">
                                                                &times;
                                                            </button>
                                                            <h4 class="modal-title"><i class="voyager-eye"></i> Thực đơn
                                                                ngày {{ \Carbon\Carbon::parse($data['date'])->format('d/m/Y') }}
                                                            </h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            @if(count($item->daily_dish) > 0)
                                                                @foreach($item->daily_dish as $dish)
                                                                    <div class="item-meal">
                                                                        <h5>- Món ăn: {{$dish->name}}</h5>
                                                                        <span><i>&nbsp;(Lưu ý: {{$dish->cooking_note}}
                                                                                )</i></span> <br>

                                                                        @if(count($dish->detail_dish) > 0)
                                                                            @foreach($dish->detail_dish as $detail)
                                                                                + {{$detail->number}} {{$detail->unit}} {{$detail->food->name}}
                                                                                @if(isset($detail->money_real))
                                                                                    (Đơn giá: <span
                                                                                            class="number-format">{{$detail->money}}</span>
                                                                                    VND - Thực tế: <span
                                                                                            class="number-format">{{$detail->money_real}}</span>
                                                                                    VND) <br>
                                                                                @else
                                                                                    (Đơn giá: <span
                                                                                            class="number-format">{{$detail->money}}</span>
                                                                                    VND) <br>
                                                                                @endif
                                                                            @endforeach
                                                                        @endif
                                                                    </div>
                                                                @endforeach
                                                            @endif

                                                            {{--List feedback--}}
                                                            <div class="post-item">
                                                                    <div class="tool">
                                                                        <div class="like-comments">
                                                                            <div class="like">
                                                                                <img src="/social/comment-icon.png"> <span style="font-size: 1.3rem" id="count-feedback">{{$item->feedback_count}} phản hồi</span>
                                                                            </div>
                                                                            <div class="clearfix"></div>
                                                                        </div>
                                                                    </div>
                                                                <div class="list-comments">
                                                                    <div class="content-parent">
                                                                        @foreach($item->feedback as $key => $feedback)
                                                                            @if(empty($feedback['parent_id']))
                                                                                <div class="comments-item">
                                                                                <div class="comment-header">
                                                                                    <div class="comments-avatar">
                                                                                        <img class="img-responsive img-circle"
                                                                                             src="{{ asset( $feedback['avatar'] ) }}">
                                                                                    </div>
                                                                                    <div class="comments-date">
                                                                                        <a>{{@$feedback['user']}}</a>
                                                                                        <div style="color: rgb(140, 140, 140); font-size: 1rem; padding-top: 4px;">
                                                                                            {{ @$feedback['date'] }}
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="clearfix"></div>
                                                                                </div>
                                                                                <div class="comments-content">
                                                                                    {{@$feedback['content']}}
                                                                                </div>

                                                                                <div class="content-child">
                                                                                    @foreach($feedback['child'] as $key_child => $child)
                                                                                        <div class="comments-item-child">
                                                                                            <div class="comment-header">
                                                                                                <div class="comments-avatar">
                                                                                                    <img class="img-responsive img-circle"
                                                                                                         src="{{ asset( $child['avatar'] ) }}">
                                                                                                </div>
                                                                                                <div class="comments-date">
                                                                                                    <a>{{@$child['user']}}</a>
                                                                                                    <div style="color: rgb(140, 140, 140); font-size: 1rem; padding-top: 4px;">
                                                                                                        {{@$child['date']}}
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="clearfix"></div>
                                                                                            </div>
                                                                                            <div class="comments-content">
                                                                                                {{@$child['content']}}
                                                                                            </div>
                                                                                        </div>
                                                                                    @endforeach
                                                                                </div>
                                                                                <div class="comments-item-child-new">
                                                                                    <div class="new-comment">
                                                                                        <div style="padding: 0 0 12px; display: inline-flex;">
                                                                                            <img class="img-responsive img-circle"
                                                                                                 src="{{ asset( Auth()->user()->avatar ) }}"> <textarea id="0" class="enter-comment" data-parent_id="{{@$feedback['id']}}" data-daily_meal_id="{{@$item['id']}}" placeholder="Nhập phản hồi..." rows="1" cols="60"></textarea>
                                                                                            <div class="clearfix"></div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            @endif
                                                                        @endforeach
                                                                    </div>
                                                                    <div class="comments-item-new"
                                                                         style="padding-top: 5px !important; padding-bottom: 5px !important;">
                                                                        <div class="new-comment">
                                                                            <div style="padding: 0 0 12px; display: inline-flex;">
                                                                                <img class="img-responsive img-circle" src="{{ asset( Auth()->user()->avatar ) }}"><textarea id="0" class="enter-comment-parent" data-daily_meal_id="{{@$item['id']}}" data-parent_id="0" placeholder="Nhập phản hồi..." rows="1" cols="60"></textarea>
                                                                                <div class="clearfix"></div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default"
                                                                    data-dismiss="modal">Close
                                                            </button>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="modal fade" id="total_meal_chef{{$item->id}}0" role="dialog">
                                                <div class="modal-dialog">
                                                    {!! Form::model($item, ['route' => ['admin.chef.meal.update', $item->id], 'class' => 'form-horizontal', 'role' => 'form','method' => 'PUT']) !!}
                                                            <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-header"
                                                             style="background: #337ab7; color: #fff;">
                                                            <button type="button" class="close"
                                                                    data-dismiss="modal">
                                                                &times;
                                                            </button>
                                                            <h4 class="modal-title"><i class="voyager-edit"></i>
                                                                Nhập số
                                                                tiền thực tế (Tổng tiền ăn/suất)
                                                            </h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group col-md-12">
                                                                <label class="control-label col-md-4">Nhập số tiền
                                                                    thực
                                                                    tế</label>
                                                                <div class="col-md-7">
                                                                    {!! Form::text('total_meal_chef', @$item->total_meal_chef, ['class' => 'form-control number-format-edit', 'required'=>true, 'placeholder' => 'VND', 'maxlength' => "8"]) !!}
                                                                </div>
                                                            </div>
                                                            <div style="clear: both;"></div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-success">Lưu
                                                            </button>
                                                            <button type="button" class="btn btn-default"
                                                                    data-dismiss="modal">Close
                                                            </button>
                                                        </div>

                                                    </div>
                                                    {!! Form::close() !!}
                                                </div>
                                            </div>
                                            <div class="modal fade" id="total_meal_chef{{$item->id}}1" role="dialog">
                                                <div class="modal-dialog">
                                                    {!! Form::model($item, ['route' => ['admin.chef.meal.update.detail', $item->id], 'class' => 'form-horizontal', 'role' => 'form','method' => 'PUT']) !!}
                                                            <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-header"
                                                             style="background: #337ab7; color: #fff;">
                                                            <button type="button" class="close"
                                                                    data-dismiss="modal">
                                                                &times;
                                                            </button>
                                                            <h4 class="modal-title"><i class="voyager-edit"></i> Nhập số
                                                                tiền thực tế sau khi đi chợ (Đơn giá)
                                                            </h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            @if(count($item->daily_dish) > 0)
                                                                @foreach($item->daily_dish as $dish)
                                                                    <div class="item-meal">
                                                                        @if(count($dish->detail_dish) > 0)
                                                                            @foreach($dish->detail_dish as $detail)
                                                                                + {{$detail->number}} {{$detail->unit}} {{$detail->food->name}}
                                                                                (Đơn giá: <span
                                                                                        class="number-format">{{$detail->money}}</span>
                                                                                VND) <br>
                                                                                {!! Form::text("$detail->id", @$detail->money_real, ['class' => 'form-control number-format-edit', 'required'=>true, 'placeholder' => 'Đơn giá thực tế (VND)', 'maxlength' => "8"]) !!}
                                                                                VND<br><br>
                                                                            @endforeach
                                                                        @endif
                                                                    </div>
                                                                @endforeach
                                                            @endif
                                                            <div style="clear: both;"></div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-success">Lưu
                                                            </button>
                                                            <button type="button" class="btn btn-default"
                                                                    data-dismiss="modal">Close
                                                            </button>
                                                        </div>

                                                    </div>
                                                    {!! Form::close() !!}
                                                </div>
                                            </div>
                                        </td>
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
    <script type="text/javascript" src="/js/jquery-number-master/jquery.number.min.js"></script>
    <!-- DataTables -->
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')}
            });
            $('#sample_1').DataTable({
                "order": [],
                "language": {
                    "emptyTable": "Không có thực đơn"
                },
                lengthMenu: [1, 5, 10, 20, 100, 1000],
                pageLength: 20,
                responsive: true,
                destroy: true,
            });
            $('.number-format').number(true);
            $('.number-format-edit').number(true);
            $('.modal').on('shown.bs.modal', function(){
                newFeedback();
                newFeedbackParent();
            });
            //create new feedback
            function newFeedback() {
                $(".enter-comment").keypress(function (e) {
                    var daily_meal_id = $(this).attr('data-daily_meal_id');
                    var id_kitchen = {{@$data['kitchen_id']}};
                    var parent_id = $(this).attr('data-parent_id');
                    var _token = $("#_token").val();
                    var key = e.which;
                    if (key == 13) {
                        e.preventDefault();
//                    $(e.target).closest('.comments-item-new').LoadingOverlay("show");
                        $.ajax({
                            method: "POST",
                            async: false,
                            url: '{{route('admin.chef.feedback.store')}}',
                            data: {
                                'daily_meal_id': daily_meal_id,
                                'id_kitchen': id_kitchen,
                                'parent_id': parent_id,
                                '_token': _token,
                                'content': $(this).val()
                            },
                            success: function (data) {
                                $(e.target).val(null);
                                $(e.target).closest('.comments-item').find('.content-child').append('<div class="comments-item-child"><div class="comment-header">' +
                                        '<div class="comments-avatar"><img class="img-responsive img-circle" src="' + data.feedback.avatar + '"></div>' +
                                        '<div class="comments-date"><a>' + data.feedback.user + '</a>' +
                                        '<div style="color: rgb(140, 140, 140); font-size: 1rem; padding-top: 4px;">' + data.feedback.date + '</div></div>' +
                                        '<div class="clearfix"></div></div>' +
                                        '<div class="comments-content">' + data.feedback.content + '</div>' +
                                        '</div>');

                                $("#count-feedback").text(data.count_feedback + ' phản hồi');
//                            $(e.target).closest('.comments-item-new').LoadingOverlay("hide");
//                            $(e.target).closest('.list-comments').find('.comments-item').last().hide(10000);
                            }
                        });
                    }
                });
            }
            //create new feedback parent
            function newFeedbackParent() {
                $(".enter-comment-parent").keypress(function (e) {
                    var daily_meal_id = $(this).attr('data-daily_meal_id');
                    var id_kitchen = {{@$data['kitchen_id']}};
                    var parent_id = $(this).attr('data-parent_id');
                    var _token = $("#_token").val();
                    var key = e.which;
                    if (key == 13) {
                        e.preventDefault();
//                    $(e.target).closest('.comments-item-new').LoadingOverlay("show");
                        $.ajax({
                            method: "POST",
                            async: false,
                            url: '{{route('admin.chef.feedback.store')}}',
                            data: {
                                'daily_meal_id': daily_meal_id,
                                'id_kitchen': id_kitchen,
                                'parent_id': parent_id,
                                '_token': _token,
                                'content': $(this).val()
                            },
                            success: function (data) {
                                console.log(data);
                                $(e.target).val(null);
                                $(e.target).closest('.list-comments').find('.content-parent').append('<div class="comments-item"><div class="comment-header">' +
                                        '<div class="comments-avatar"><img class="img-responsive img-circle" src="' + data.feedback.avatar + '"></div>' +
                                        '<div class="comments-date"><a>' + data.feedback.user + '</a>' +
                                        '<div style="color: rgb(140, 140, 140); font-size: 1rem; padding-top: 4px;">' + data.feedback.date + '</div></div>' +
                                        '<div class="clearfix"></div></div>' +
                                        '<div class="comments-content">' + data.feedback.content + '</div>' +
                                        '<div class="content-child"></div><div class="comments-item-child-new">' +
                                        '<div class="new-comment">' +
                                        '<div style="padding: 0 0 12px; display: inline-flex;">' +
                                        '<img class="img-responsive img-circle" src="' + data.feedback.avatar + '">' +
                                        '<textarea id="0" class="enter-comment" data-daily_meal_id="'+daily_meal_id+'" data-parent_id="' + data.feedback.id + '" placeholder="Nhập phản hồi..." rows="1" cols="60"></textarea>' +
                                        '<div class="clearfix"></div>' +
                                        '</div></div></div></div>'
                                );
                                $("#count-feedback").text(data.count_feedback + ' phản hồi');
                                newFeedback();
//                            $(e.target).closest('.comments-item-new').LoadingOverlay("hide");
//                            $(e.target).closest('.list-comments').find('.comments-item').last().hide(10000);
                            }
                        });
                    }
                });
            }
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
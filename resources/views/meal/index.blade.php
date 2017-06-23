@extends('layouts.1column')

@section('header')
    <style>
        .select2-container {
            margin-bottom: 10px;
            width: 100% !important;
        }
        .panel-title{
            font-weight: 600;
        }
        .td_nguyen_lieu {
            width: 30%;
        }
        .container-fluid {
            padding-top: 30px;
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
        .FlexGrid-item {
            margin: 0 0 1em 2em !important;
        }

        .panel-title {
            display: block;
            padding: 0px 10px !important;
            padding-left: 15px;
            font-size: 18px;
            text-align: left;
        }

        .panel-heading {
            background: aliceblue;
            padding: 11px 5px 0px 4px;
            margin-top: 5px;
        }
    </style>
@stop
@section('main-content')
    <div class="page-content">
        @include('voyager::alerts')
        <div class="page-content container-fluid panel" style="padding-top:30px;">
            <h1 class="page-title" style="padding-bottom: 30px;border-bottom: 1px solid #eee">
                <i class="voyager-list"></i> Danh sách thực đơn
                <a href="{{ route('admin.user.add') }}" class="btn btn-success pull-right">
                    <i class="voyager-plus"></i> Thêm mới
                </a>
            </h1>
            <div class="Dashboard col-md-12" id="">
                <div id="view-selector-container " class="col-md-12">
                    @if(count($all_meal) > 0)
                        @foreach($all_meal as $item_meal)
                            <?php
                                foreach ($item_meal->kitchen as $item_kitchen) {
                                    if (count($item_kitchen->daily_meal) > 0) {
                                        foreach ($item_kitchen->daily_meal as $item_daily_meal) {
                                            $money_meals = 0;
                                            $number_of_meals = 0;
                                            $money_meals = $item_daily_meal->money_meals;
                                            $number_of_meals = $item_daily_meal->number_of_meals;
                                            $green="aliceblue";
                                            if (\Carbon\Carbon::now()->startOfDay()->timestamp == \Carbon\Carbon::parse($item_daily_meal->day)->startOfDay()->timestamp)
                                                {
                                                    $green="#f0fff1";
                                                }
                                            ?>
                                                <div class="panel-heading col-md-12" style="background: {{ $green }}">
                                                    <h3 class="panel-title col-md-8">Bữa ăn
                                                        ngày {{ \Carbon\Carbon::parse($item_daily_meal->day)->format('d/m/Y') }}</h3>
                                                    <div class="panel-body col-md-8">
                                                        Số xuất ăn : {{ $number_of_meals }}<br>
                                                        Số tiền 1 suất ăn : {{ number_format($money_meals) }} VNĐ
                                                    </div>
                                                    <div class="pull-right">
                                                        <a href="{{ route('admin.user.view',$item_daily_meal->id) }}"
                                                           class="btn-sm btn-warning" title="Chi tiết">
                                                            <i class="voyager-eye"></i> Xem
                                                        </a>
                                                        @if(\Carbon\Carbon::now()->timestamp < Carbon\Carbon::createFromFormat('Y-m-d H:i:s',\Carbon\Carbon::parse($item_daily_meal->day)->format('Y-m-d')."09:00:00")->timestamp )
                                                            <a href="{{ route('admin.user.edit',$item_daily_meal->id) }}" title="Chỉnh sửa"
                                                               class="btn-sm btn-primary edit">
                                                                <i class="voyager-edit"></i> Sửa
                                                            </a>
                                                            <a href="" class="btn-sm btn-danger delete" data-toggle="modal" title="Xóa"
                                                               data-target="#delete_modal-{{ $item_daily_meal->id }}">
                                                                <i class="voyager-trash"></i> Xóa
                                                            </a>
                                                            <div class="modal fade" tabindex="-1"
                                                                 id="delete_modal-{{ $item_daily_meal->id }}" role="dialog">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <button type="button" class="close" data-dismiss="modal"
                                                                                    aria-label="Close"><span
                                                                                        aria-hidden="true">&times;</span></button>
                                                                            <h4 class="modal-title"><i class="voyager-trash"></i> Bạn có
                                                                                chắc chắn muốn xóa thực đơn này hay không?</h4>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <form action="{{ route('admin.user.delete',$item_daily_meal->id) }}"
                                                                                  method="post">
                                                                                {{ csrf_field() }}
                                                                                <input type="submit"
                                                                                       class="btn btn-danger pull-right delete-confirm"
                                                                                       value="Delete">
                                                                            </form>
                                                                            <button type="button" class="btn btn-default pull-right"
                                                                                    data-dismiss="modal">Cancel
                                                                            </button>
                                                                        </div>
                                                                    </div><!-- /.modal-content -->
                                                                </div><!-- /.modal-dialog -->
                                                            </div><!-- /.modal -->
                                                        @endif
                                                    </div>
                                                </div>
                                            <?php
//                                            continue;
                                        }
                                    }
                                }
                            ?>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop
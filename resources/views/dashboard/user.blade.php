@extends('voyager::master')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ voyager_asset('css/ga-embed.css') }}">
    <style>
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

@section('content')
    <div class="page-content">
        @include('voyager::alerts')
        <div style="padding:15px;">
            <div class="Dashboard" id="">
                <div class="FlexGrid">
                    <div class="FlexGrid-item">
                        <div class="Titles">
                            <h1 class="Titles-main " id="view-name"><i class="voyager-bread" style=""></i> Danh sách
                                thực đơn </h1>
                        </div>
                    </div>
                </div>
                <hr>
                <div id="view-selector-container">
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
                                        ?>
                                            <div class="panel-heading">
                                                <h3 class="panel-title">Bữa ăn
                                                    ngày {{ \Carbon\Carbon::parse($item_daily_meal->day)->format('d/m/Y') }}</h3>
                                                <div class="panel-body">
                                                    Số xuất ăn : {{ $number_of_meals }}<br>
                                                    Số tiền 1 suất ăn : {{ number_format($money_meals
                                                ) }} VNĐ
                                                </div>
                                            </div>
                                        <?php
                                        continue;
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
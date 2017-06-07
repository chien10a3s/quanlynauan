@extends('voyager::master')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ voyager_asset('css/ga-embed.css') }}">
    <style>
        .FlexGrid-item {
            margin: 0 0 1em 2em !important;
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
                            <h1 class="Titles-main " id="view-name"><i class="voyager-bread" style=""></i> CHI TIẾT THỰC
                                ĐƠN </h1>
                        </div>
                    </div>
                    <div class="FlexGrid-item FlexGrid-item--fixed">
                        <div id="active-users-container">
                            Ngày {{ \Carbon\Carbon::now()->format('d/m/Y') }}
                        </div>
                    </div>
                </div>
                <hr>
                <div id="view-selector-container">

                </div>
            </div>
        </div>
    </div>
@stop
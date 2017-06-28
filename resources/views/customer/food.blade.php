@extends('layouts.1column')

@section('main-content')
    @if(Session::has('message'))
        <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('message') }}</p>
    @endif
    <div class="page-content container">
        <div class="nav-tabs-custom">
        	<ul class="nav nav-tabs">
        		<li class="{{ Request::is('account') ? 'active' : '' }}"><a href="{{ route() }}">Thông tin chung</a></li>
                <li class="{{ Request::is('account/food') ? 'active' : '' }}"><a href="{{ url('account/food') }}">Thức ăn của tôi</a></li>
        		<li class="{{ Request::is('account/orderhistory') ? 'active' : '' }}"><a href="{{ url('account/orderhistory') }}">Lịch sử đặt hàng</a></li>
                <li class="{{ Request::is('account/transaction') ? 'active' : '' }}"><a href="{{ url('account/transaction') }}">Lịch sử giao dịch</a></li>
            </ul>
        	<div class="tab-content">
        		<div class="tab-pane active">
                    <table class="table table-bordered">
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Thực phẩm</th>
                            <th>Số lượng</th>
                            <th>Đơn vị</th>
                            <th>Ngày mua</th>
                            <th>Ngày hết hạn</th>
                            <th class="text-center">Hành động</th>
                        </tr>
                        <tr>
                            <td>1.</td>
                            <td>Thịt 3 chỉ</td>
                            <td>100</td>
                            <td>Gram</td>
                            <td>08-03-2017</td>
                            <td>10-03-2017</td>
                            <td class="text-center">
                                <a href="#" class="btn btn-success btn-sm">
                                    Bỏ đi
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>2.</td>
                            <td>Thịt 3 chỉ</td>
                            <td>100</td>
                            <td>Gram</td>
                            <td>08-03-2017</td>
                            <td>10-03-2017</td>
                            <td class="text-center">
                                <a href="#" class="btn btn-success btn-sm">
                                    Bỏ đi
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>3.</td>
                            <td>Thịt 3 chỉ</td>
                            <td>100</td>
                            <td>Gram</td>
                            <td>08-03-2017</td>
                            <td>10-03-2017</td>
                            <td class="text-center">
                                <a href="#" class="btn btn-success btn-sm">
                                    Bỏ đi
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>4.</td>
                            <td>Thịt 3 chỉ</td>
                            <td>100</td>
                            <td>Gram</td>
                            <td>08-03-2017</td>
                            <td>10-03-2017</td>
                            <td class="text-center">
                                <a href="#" class="btn btn-success btn-sm">
                                    Bỏ đi
                                </a>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('javascript')

@stop
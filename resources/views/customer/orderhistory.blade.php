@extends('layouts.1column')

@section('main-content')
    <div class="page-content container">
        <div class="nav-tabs-custom">
        	<ul class="nav nav-tabs">
        		<li class="{{ Request::is('account') ? 'active' : '' }}"><a href="{{ url('account') }}">Thông tin chung</a></li>
                <li class="{{ Request::is('account/food') ? 'active' : '' }}"><a href="{{ url('account/food') }}">Thức ăn của tôi</a></li>
        		<li class="{{ Request::is('account/orderhistory') ? 'active' : '' }}"><a href="{{ url('account/orderhistory') }}">Lịch sử đặt hàng</a></li>
                <li class="{{ Request::is('account/transaction') ? 'active' : '' }}"><a href="{{ url('account/transaction') }}">Lịch sử giao dịch</a></li>
            </ul>
        	<div class="tab-content">
        		<div class="tab-pane active">
                    <div class="row">
                        <form role="form" id="all_order_form">
                            <div class="form-group col-md-3">
                                <label>Từ ngày</label>
                                <input type="text" class="form-control" name="txtdoi" placeholder="Order Date" data-date-format="dd/mm/yyyy" id="ord_date" maxlength="10">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Đến ngày</label>
                                <input type="text" class="form-control" name="ord_dt_to" placeholder="Order Date" data-date-format="dd/mm/yyyy" id="ord_dt_to" maxlength="10">
                            </div>
                            
                            <div class="col-md-3">
                                <label style="display: block;">&nbsp;</label>
                                <input type="button" class="btn btn-info" value="Hiển thị">
                        
                            </div>
                        </form>
                    </div>
                    <table class="table table-bordered">
                        <tr>
                            <th>Số đơn hàng</th>
                            <th>Ngày</th>
                            <th>Số tiền</th>
                            <th>Số suất ăn</th>
                            <th class="text-center">Hành động</th>
                        </tr>
                        <tr>
                            <td>1.</td>
                            <td>20-06-2017</td>
                            <td>100.000đ</td>
                            <td>3</td>
                            <td class="text-center">
                                <a href="#" class="btn btn-success btn-sm">Xem chi tiết</a>
                                <a href="#" class="btn btn-danger btn-sm">Hủy đơn hàng</a>
                            </td>
                        </tr>
                        <tr>
                            <td>2.</td>
                            <td>20-06-2017</td>
                            <td>100.000đ</td>
                            <td>3</td>
                            <td class="text-center"><a href="#" class="btn btn-success btn-sm">Xem chi tiết</a></td>
                        </tr>
                        <tr>
                            <td>3.</td>
                            <td>20-06-2017</td>
                            <td>100.000đ</td>
                            <td>3</td>
                            <td class="text-center"><a href="#" class="btn btn-success btn-sm">Xem chi tiết</a></td>
                        </tr>
                        <tr>
                            <td>4.</td>
                            <td>20-06-2017</td>
                            <td>100.000đ</td>
                            <td>3</td>
                            <td class="text-center"><a href="#" class="btn btn-success btn-sm">Xem chi tiết</a></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('javascript')

@stop
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
                            <th style="width: 10px">#</th>
                            <th>Ngày</th>
                            <th>Số tiền</th>
                            <th>Số đơn hàng</th>
                            <th>Ghi chú</th>
                            <th>Số dư cuối</th>
                        </tr>
                        <tr>
                            <td>1.</td>
                            <td>20-06-2017</td>
                            <td>100.000đ</td>
                            <td><a target="_blank" href="/chitietdonhang">Đơn hàng #001</a></td>
                            <td>Trừ tiền mua thúc ăn bữa trưa 20-06-2017</td>
                            <td>20.000.000đ</td>
                        </tr>
                        <tr>
                            <td>2.</td>
                            <td>20-06-2017</td>
                            <td>100.000đ</td>
                            <td><a target="_blank" href="/chitietdonhang">Đơn hàng #001</a></td>
                            <td>Trừ tiền mua thúc ăn bữa trưa 20-06-2017</td>
                            <td>15.000.000đ</td>
                        </tr>
                        <tr>
                            <td>3.</td>
                            <td>20-06-2017</td>
                            <td>100.000đ</td>
                            <td><a target="_blank" href="/chitietdonhang">Đơn hàng #001</a></td>
                            <td>Trừ tiền mua thúc ăn bữa trưa 20-06-2017</td>
                            <td>13.000.000đ</td>
                        </tr>
                        <tr>
                            <td>4.</td>
                            <td>20-06-2017</td>
                            <td>100.000đ</td>
                            <td><a target="_blank" href="/chitietdonhang">Đơn hàng #001</a></td>
                            <td>Trừ tiền mua thúc ăn bữa trưa 20-06-2017</td>
                            <td>10.000.000đ</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('javascript')

@stop
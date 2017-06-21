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
 
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Thông tin tài khoản</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table class="table table-bordered">
                                <tr>
                                   <td width="25%">Tên</td>
                                   <td width="25%">Nguyễn Khắc Hoài</td>
                                   <td width="25%">Số bếp quản lý</td>
                                   <td width="25%">3</td>
                                </tr>
                                <tr>
                                   <td>Ngày sinh</td>
                                   <td>01-01-1990</td>
                                   <td>Số dư tài khoản</td>
                                   <td>20.000.000</td>
                                </tr>
                                <tr>
                                    <td>Địa chỉ nhận hàng</td>
                                    <td>45C, 210 Hoàng Quốc Việt, Cầu Giấy, Hà Nội</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <!-- /.box -->
 
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Hôm nay ăn gì?</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table class="table table-bordered">
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Tên món</th>
                                    <th>Nguyên liệu</th>
                                    <th>Số lượng</th>
                                    <th>Thành tiền</th>
                                    <th>Công thức</th>
                                    <th>Ghi chú</th>
                                </tr>
                                <tr>
                                    <td valign="middle" rowspan="2">1.</td>
                                    <td valign="middle" rowspan="2">Thịt kho tàu</td>
                                    <td>Thịt 3 chỉ</td>
                                    <td>1</td>
                                    <td>50.000đ</td>
                                    <td valign="middle" rowspan="2">Công thức kho thịt</td>
                                    <td valign="middle" rowspan="2">Kho nhừ, không mặn</td>
                                </tr>
                                <tr>
                                    <td>Trứng cút</td>
                                    <td>20</td>
                                    <td>10.000đ</td>
                                </tr>
                                
                                <tr>
                                    <td valign="middle" rowspan="2">2.</td>
                                    <td valign="middle" rowspan="2">Canh rau ngót nấu thịt băm</td>
                                    <td>Rau ngót</td>
                                    <td>1</td>
                                    <td>10.000đ</td>
                                    <td valign="middle" rowspan="2">Công thức canh rau ngót</td>
                                    <td valign="middle" rowspan="2">Ghi chú các kiểu</td>
                                </tr>
                                <tr>
                                    <td>Thịt băm</td>
                                    <td>1</td>
                                    <td>10.000đ</td>
                                </tr>
                                <tfoot>
                                    <tr>
                                        <td class="text-right" colspan="5"><strong>Tổng tiền</strong></td>
                                        <td colspan="2"><strong>500.000đ</strong></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <!-- /.box -->
                    
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Bạn chưa đi chợ cho hôm nay.</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            Form đi chợ
                        </div>
                    </div>
                    <!-- /.box -->
                </div>
            </div>
        </div>
    </div>
@stop

@section('javascript')

@stop
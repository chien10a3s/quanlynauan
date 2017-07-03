<ul class="nav nav-tabs">

    <li class="{{ Request::is('account') ? 'active' : '' }}"><a href="{{ url('account') }}">Thông tin chung</a></li>
    
    
    <li class="{{ Request::is('account/food') ? 'active' : '' }}"><a href="{{ url('account/food') }}">Thức ăn + gia vị</a></li>
    <li class="{{ Request::is('account/orderhistory') ? 'active' : '' }}"><a href="{{ url('account/orderhistory') }}">Lịch sử đặt hàng</a></li>
    <li class="{{ Request::is('account/transaction') ? 'active' : '' }}"><a href="{{ url('account/transaction') }}">Lịch sử giao dịch</a></li>
</ul>
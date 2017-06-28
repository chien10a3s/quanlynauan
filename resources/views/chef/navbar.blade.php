<div class="nav-tabs-custom pull-right">
    <ul class="nav nav-tabs">
        <li class="{{ Request::is('admin/chefs/dashboard') ? 'active' : '' }}"><a href="{{ route('admin.chef.dashboard.index') }}">Trung chủ</a></li>
        <li class="{{ Request::is('admin/chefs') ? 'active' : '' }}"><a href="{{ route('admin.chef.index') }}">Quản lý</a></li>
    </ul>
</div>
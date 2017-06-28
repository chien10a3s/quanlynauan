<div class="nav-tabs-custom pull-right">
    <ul class="nav nav-tabs">
        <li class="{{ Request::is('admin/chefs/dashboard/meal') ? 'active' : '' }}"><a href="{{ route('admin.chef.dashboard.meal') }}">Trung chủ</a></li>
        <li class="{{ Request::is('admin/chefs/dashboard/food') ? 'active' : '' }}"><a href="{{ route('admin.chef.dashboard.food') }}">Trung chủ</a></li>
        <li class="{{ Request::is('admin/chefs') ? 'active' : '' }}"><a href="{{ route('admin.chef.index') }}">Quản lý</a></li>
    </ul>
</div>
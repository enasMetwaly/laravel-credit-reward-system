<aside class="sidebar">
    <div class="sidebar-header">
        <h3>Rewards Admin</h3>
        <p>Credit & Points System</p>
    </div>
    <nav class="sidebar-nav">
        <ul>
            <li class="{{ request()->is('admin/dashboard') ? 'active' : '' }}"><a href="{{ route('admin.dashboard') }}"><i class="icon-dashboard"></i> Dashboard</a></li>
            <li class="{{ request()->is('admin/credit-packages*') ? 'active' : '' }}"><a href="{{ route('admin.credit-packages.index') }}"><i class="icon-credit"></i> Credit packages</a></li>
            <li><a href="#"><i class="icon-rules"></i> Reward Rules</a></li>
            <li class="{{ request()->is('admin/product-catalog*') ? 'active' : '' }}"><a href="{{ route('admin.product-catalog.index') }}"><i class="icon-catalog"></i> Product Catalog</a></li>
            <li><a href="#"><i class="icon-offers"></i> Offers Management</a></li>
            <li><a href="#"><i class="icon-analytics"></i> Analytics</a></li>
            <li><a href="#"><i class="icon-users"></i> Users</a></li>
            <li><a href="#"><i class="icon-settings"></i> Settings</a></li>
        </ul>
    </nav>
</aside>

<style>
    .sidebar { width: 250px; background: #fff; padding: 20px; box-shadow: 2px 0 5px rgba(0,0,0,0.1); position: fixed; height: 100%; overflow-y: auto; }
    .sidebar-header { text-align: center; margin-bottom: 20px; }
    .sidebar-nav ul { list-style: none; padding: 0; }
    .sidebar-nav ul li { padding: 10px; color: #333; cursor: pointer; }
    .sidebar-nav ul li.active { background: #3498db; color: #fff; border-radius: 5px; }
    .sidebar-nav ul li a { color: #333; text-decoration: none; display: block; }
    .sidebar-nav ul li.active a { color: #fff; }
    .sidebar-nav ul li i { margin-right: 10px; }
</style>
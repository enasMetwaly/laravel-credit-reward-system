@extends('layouts.app')

@section('content')
    <div class="dashboard-wrapper">
        @include('admin.partials.sidebar')

        <!-- Main Content -->
        <main class="main-content">
            <div class="dashboard-header">
                <h1>Dashboard Overview</h1>
                <p>Monitor your credit and rewards system performance</p>
                <a href="#" class="settings-btn">Settings</a>
            </div>

            <!-- Metrics Overview -->
            <div class="metrics-grid">
                <div class="metric-card">
                    <h3>Total Revenue</h3>
                    <p class="value">{{ number_format($totalRevenue, 2) }} EGP</p>
                    <p class="change">+{{ number_format($revenueChange, 2) }}% from last month</p>
                </div>
                <div class="metric-card">
                    <h3>Credits Sold</h3>
                    <p class="value">{{ $totalCredits }}</p>
                    <p class="change">+{{ number_format($creditsChange, 2) }}% from last month</p>
                </div>
                <div class="metric-card">
                    <h3>Products Redeemed</h3>
                    <p class="value">{{ $totalRedeemed }}</p>
                    <p class="change">+{{ number_format($redeemedChange, 2) }}% from last month</p>
                </div>
                <div class="metric-card">
                    <h3>Active Users</h3>
                    <p class="value">{{ $activeUsers }}</p>
                    <p class="change">+{{ number_format($usersChange, 2) }}% from last month</p>
                </div>
            </div>

            <!-- Top Products -->
            <div class="top-products-section">
                <h2>Top Products</h2>
                <ul class="products-list">
                    @forelse ($topProducts as $product)
                        <li>{{ $product->name }} <span>{{ $product->points_required ?? 'N/A' }} pts</span></li>
                    @empty
                        <li>No top products available.</li>
                    @endforelse
                </ul>
            </div>

            <!-- Redeemable Products Table -->
            <div class="table-section">
                <h2>Redeemable Products</h2>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Category</th>
                            <th>Name</th>
                            <th>Points Required</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products->where('is_redeemable', true) as $product)
                            <tr>
                                <td>{{ $product->category }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->points_required ?? 'N/A' }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="3">No redeemable products available.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <style>
        .dashboard-wrapper { display: flex; min-height: 100vh; }
        .main-content { flex: 1; padding: 20px; background: #f9f9f9; margin-left: 250px; }
        .dashboard-header { margin-bottom: 20px; }
        .dashboard-header h1 { color: #2c3e50; }
        .settings-btn { float: right; color: #3498db; text-decoration: none; }
        .metrics-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 20px; }
        .metric-card { background: #fff; padding: 15px; border-radius: 5px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); text-align: center; }
        .metric-card h3 { color: #7f8c8d; font-size: 1rem; }
        .metric-card .value { font-size: 1.5rem; color: #2c3e50; margin: 10px 0; }
        .metric-card .change { color: #27ae60; font-size: 0.9rem; }
        .top-products-section, .table-section { background: #fff; padding: 20px; border-radius: 5px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); margin-bottom: 20px; }
        .products-list { list-style: none; padding: 0; }
        .products-list li { display: flex; justify-content: space-between; padding: 10px 0; }
        .products-list li span { color: #7f8c8d; }
        .table { width: 100%; }
        .table th, .table td { text-align: left; padding: 10px; }
        .table th { background-color: #3498db; color: white; }
    </style>
@endsection
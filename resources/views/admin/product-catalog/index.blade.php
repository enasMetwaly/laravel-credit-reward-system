@extends('layouts.app')

@section('content')
    <div class="dashboard-wrapper">
        @include('admin.partials.sidebar')

        <main class="main-content">
            <div class="dashboard-header">
                <h1>Product Catalog</h1>
                <a href="{{ route('admin.product-catalog.create') }}" class="settings-btn">Create New</a>
            </div>

            <div class="table-section">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Category</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Image URL</th>
                            <th>Redeemable</th>
                            <th>Points Required</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr>
                                <td>{{ $product->category }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->description ?? 'N/A' }}</td>
                                <td>{{ $product->image_url ?? 'N/A' }}</td>
                                <td>{{ $product->is_redeemable ? 'Yes' : 'No' }}</td>
                                <td>{{ $product->points_required ?? 'N/A' }}</td>
                                <td>
                                    <a href="{{ route('admin.product-catalog.edit', $product) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('admin.product-catalog.destroy', $product) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="7">No products available.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </main>
    </div>

  <style>
    .dashboard-wrapper { display: flex; min-height: 100vh; }
    .main-content { flex: 1; padding: 20px; background: #f9f9f9; margin-left: 250px; }
    .dashboard-header { margin-bottom: 30px; } /* Increased margin-bottom for more space */
    .dashboard-header h1 { color: #2c3e50; }
    .settings-btn { float: right; color: rgb(8, 19, 43); text-decoration: none; }
    .table-section { background: #fff; padding: 20px; border-radius: 5px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); margin-bottom: 20px; }
    .table { width: 100%; }
    .table th, .table td { text-align: left; padding: 10px; }
    .table th { background-color: #3498db; color: white; }
</style>
@endsection
@extends('layouts.app')

@section('content')
    <div class="dashboard-wrapper">
        @include('admin.partials.sidebar')

        <main class="main-content">
            <div class="dashboard-header">
                <h1>Credit packages</h1>
                <a href="{{ route('admin.credit-packages.create') }}" class="settings-btn">Create New</a>
            </div>

            <div class="table-section">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Price (EGP)</th>
                            <th>Credits</th>
                            <th>Points</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($creditPackages as $package)
                            <tr>
                                <td>{{ $package->name }}</td>
                                <td>{{ number_format($package->price_egp, 2) }}</td>
                                <td>{{ $package->credits }}</td>
                                <td>{{ $package->reward_points }}</td>
                                <td>
                                    <a href="{{ route('admin.credit-packages.edit', $package) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('admin.credit-packages.destroy', $package) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5">No credit packages available.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </main>
    </div>

  <style>
    .dashboard-wrapper { display: flex; min-height: 100vh; }
    .main-content { flex: 1; padding: 20px; background: #f9f9f9; margin-left: 250px; }
    .dashboard-header { margin-bottom: 30px; } /* Increased margin for space */
    .dashboard-header h1 { color: #2c3e50; }
    .settings-btn { float: right; color: rgb(6, 20, 68); margin-bottom: 5px; text-decoration: none; } /* Fixed syntax */
    .table-section { background: #fff; padding: 20px; border-radius: 5px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); margin-bottom: 20px; }
    .table { width: 100%; }
    .table th, .table td { text-align: left; padding: 10px; }
    .table th { background-color: #3498db; color: white; }
</style>
@endsection
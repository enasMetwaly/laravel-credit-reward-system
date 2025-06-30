@extends('layouts.app')

@section('content')
    <div class="dashboard-wrapper">
        @include('admin.partials.sidebar')

        <main class="main-content">
            <div class="dashboard-header">
                <h1>Edit Credit Bundle</h1>
            </div>

            <div class="form-card">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.credit-packages.update', $creditPackage) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $creditPackage->name) }}" required>
                    </div>
                    <div class="form-group">
                        <label for="price_egp">Price (EGP)</label>
                        <input type="number" name="price_egp" id="price_egp" class="form-control" step="0.01" value="{{ old('price_egp', $creditPackage->price_egp) }}" required>
                    </div>
                    <div class="form-group">
                        <label for="credits">Credits</label>
                        <input type="number" name="credits" id="credits" class="form-control" value="{{ old('credits', $creditPackage->credits) }}" required>
                    </div>
                    <div class="form-group">
                        <label for="reward_points">Reward Points</label>
                        <input type="number" name="reward_points" id="reward_points" class="form-control" value="{{ old('reward_points', $creditPackage->reward_points) }}" required>
                    </div>
                    <button type="submit" class="btn cta-btn">Update</button>
                </form>
            </div>
        </main>
    </div>

    <style>
        .main-content { flex: 1; padding: 20px; background: #f9f9f9; margin-left: 250px; }
        .dashboard-header { margin-bottom: 20px; }
        .dashboard-header h1 { color: #2c3e50; }
        .form-card { background: #fff; padding: 25px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); max-width: 500px; }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; color: #2c3e50; margin-bottom: 5px; font-weight: 500; }
        .form-control { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; font-size: 1rem; }
        .form-control:focus { border-color: #3498db; outline: none; box-shadow: 0 0 5px rgba(52,152,219,0.5); }
        .alert { padding: 10px; border-radius: 4px; margin-bottom: 15px; }
        .alert-danger { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        .btn.cta-btn { background-color: #3498db; color: white; padding: 10px 20px; border: none; border-radius: 5px; font-size: 1rem; cursor: pointer; }
        .btn.cta-btn:hover { background-color: #2980b9; }
    </style>
@endsection
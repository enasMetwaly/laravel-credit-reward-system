@extends('layouts.app')

@section('content')
    <div class="dashboard-wrapper">
        @include('admin.partials.sidebar')

        <main class="main-content">
            <div class="dashboard-header">
                <h1>Edit Product</h1>
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

                <form action="{{ route('admin.product-catalog.update', $product) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="category">Category</label>
                        <input type="text" name="category" id="category" class="form-control" value="{{ old('category', $product->category) }}" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $product->name) }}" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control" rows="3">{{ old('description', $product->description) }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="image_url">Image URL</label>
                        <input type="url" name="image_url" id="image_url" class="form-control" value="{{ old('image_url', $product->image_url) }}">
                    </div>
                    <div class="form-group">
                        <label for="is_redeemable">Eligible for Offers/Redemption</label>
                        <select name="is_redeemable" id="is_redeemable" class="form-control" required>
                            <option value="0" {{ old('is_redeemable', $product->is_redeemable) == 0 ? 'selected' : '' }}>No</option>
                            <option value="1" {{ old('is_redeemable', $product->is_redeemable) == 1 ? 'selected' : '' }}>Yes</option>
                        </select>
                    </div>
                    <div class="form-group" id="points_field" style="{{ old('is_redeemable', $product->is_redeemable) == 1 ? 'block' : 'display:none;' }}">
                        <label for="points_required">Points Required</label>
                        <input type="number" name="points_required" id="points_required" class="form-control" value="{{ old('points_required', $product->points_required) }}" min="1">
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

    <script>
        document.getElementById('is_redeemable').addEventListener('change', function() {
            document.getElementById('points_field').style.display = this.value == 1 ? 'block' : 'none';
        });
    </script>
@endsection
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Credit Reward System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .hero {
            background-color: #ecf0f1;
            padding: 60px 0;
            text-align: center;
            position: relative;
        }
        .hero img {
            max-width: 100%;
            height: auto;
            margin-top: 20px;
        }
        .hero h1 {
            color: #2c3e50;
            font-size: 2.5rem;
            margin-bottom: 20px;
        }
        .hero p {
            color: #7f8c8d;
            font-size: 1.2rem;
            margin-bottom: 30px;
        }
        .cta-btn {
            background-color: #3498db;
            color: white;
            padding: 10px 30px;
            border: none;
            border-radius: 5px;
            font-size: 1.1rem;
        }
        .cta-btn:hover {
            background-color: #2980b9;
        }
        .packages-section, .products-section {
            padding: 40px 0;
            background-color: #ffffff;
        }
        .card-package, .card-product {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transition: transform 0.2s;
            background-color: #ffffff;
            color: #2c3e50;
            text-align: center;
            padding: 20px;
        }
        .card-package:hover, .card-product:hover {
            transform: translateY(-5px);
        }
        .card-package h4, .card-product h4 {
            color: #3498db;
            margin-bottom: 10px;
        }
        .card-package p, .card-product p {
            color: #7f8c8d;
        }
        .footer {
            background-color: #2c3e50;
            color: white;
            padding: 20px 0;
            text-align: center;
            margin-top: 40px;
        }
    </style>
</head>
<body>
    <!-- Header -->
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: rgb(6, 20, 68);">
        <div class="container">
            <a class="navbar-brand" href="/">Credit Reward System</a>
            <div class="d-flex">
                @if (Auth::guard('admin')->check())
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-light me-2">Admin Dashboard</a>
                    <form action="{{ route('admin.auth.logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-danger">Logout</button>
                    </form>
                @else
                    <a href="{{ route('admin.auth.login') }}" class="btn btn-light">Admin Login</a>
                @endif
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero">
        <div class="container">
            <h1>Explore Our Credit Packages & Rewards</h1>
            <p>Unlock credits, earn points, and redeem exciting products.</p>
            <img src="{{ asset('images/credits.png') }}" alt="Credit Packages" style="height: 400px;">
        </div>
    </div>

    <!-- Packages Section -->
    <div class="packages-section">
        <div class="container">
            <h2 class="text-center mb-4" style="color: #2c3e50;">Available Credit Packages</h2>
            <div class="row">
                @forelse ($creditPackages as $package)
                    <div class="col-md-4">
                        <div class="card card-package">
                            <h4>{{ $package->name }}</h4>
                            <h3>{{ number_format($package->price_egp, 2) }} EGP</h3>
                            <p>{{ $package->credits }} Credits | {{ $package->reward_points }} Points</p>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p>No credit packages available.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Products Section -->
    <div class="products-section">
        <div class="container">
            <h2 class="text-center mb-4" style="color: #2c3e50;">Redeemable Products</h2>
            <div class="row">
                @forelse ($products as $product)
                    <div class="col-md-4">
                        <div class="card card-product">
                            <h4>{{ $product->name }}</h4>
                            <p>{{ $product->category }} | {{ $product->points_required }} Points</p>
                            <p>{{ $product->description }}</p>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p>No redeemable products available.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <div class="container">
            <p>© 2025 Laravel Credit Reward System. All rights reserved.</p>
            <p><a href="#" class="text-white">Contact Us</a> | <a href="#" class="text-white">Privacy Policy</a></p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
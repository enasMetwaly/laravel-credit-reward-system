<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Laravel Credit Reward System</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; background-color: #f4f4f4; }
        .dashboard-container { max-width: 1200px; margin: 0 auto; background: #fff; padding: 20px; border-radius: 5px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        .header { text-align: center; margin-bottom: 20px; }
        .header h1 { color: #333; }
        .stats { display: flex; justify-content: space-around; margin-bottom: 20px; }
        .stat-box { background: #e9ecef; padding: 10px; border-radius: 5px; text-align: center; width: 30%; }
        .logout-btn { display: block; margin: 20px auto; padding: 10px 20px; background-color: #dc3545; color: white; border: none; border-radius: 5px; cursor: pointer; }
        .logout-btn:hover { background-color: #c82333; }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <div class="header">
            <h1>Welcome, {{ Auth::guard('admin')->user()->name ?? 'Admin' }}!</h1>
            <p>Admin Dashboard - Manage Your Credit Reward System</p>
            <form action="{{ route('admin.auth.logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>
        <div class="stats">
            <div class="stat-box"><h3>Total Users</h3><p>0</p></div>
            <div class="stat-box"><h3>Active Rewards</h3><p>0</p></div>
            <div class="stat-box"><h3>Pending Actions</h3><p>0</p></div>
        </div>
    </div>
</body>
</html>
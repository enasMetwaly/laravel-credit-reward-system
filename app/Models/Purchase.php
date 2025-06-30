<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = ['user_id', 'credit_package_id', 'credits_earned', 'reward_points_earned', 'amount_paid_egp'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function creditPackage()
    {
        return $this->belongsTo(CreditPackage::class);
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RewardPoint extends Model
{
    use HasFactory;
    protected $table='reward_points';
    protected $fillable =[
        'sales_orders_id',
        'user_id',
        'amount',
        'is_active',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesOrder extends Model
{
    use HasFactory;
    protected $table='sales_orders';
    protected $fillable = [
        'user_id',
        'status',
        'amount',
    ];
    
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function sales_item(){
        return $this->hasMany(SalesOrderItems::class,'sales_orders_id','id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesOrderItems extends Model
{
    use HasFactory;
    protected $table='sales_orders_items';
    protected $fillable = [
        'sales_orders_id',
        'quantity',
        'product_id',
    ];
    public function sales_order(){
        return $this->belongsTo(SalesOrder::class,'sales_orders_id','id');
    }
    public function product(){
        return $this->belongsTo(Product::class,'product_id','id');
    }
}

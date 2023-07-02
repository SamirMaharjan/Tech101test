<?php

namespace App\Http\Controllers;

use App\Models\RewardPoint;
use App\Models\SalesOrder;
use App\Models\SalesOrderItems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SalesOrderController extends Controller
{
    public function create_sales_order(){
        $user = Auth::user();
        $carts = $user->cart;
        $sales_order = SalesOrder::create([
            'user_id'=>$user->id,
            'amount'=>$carts->sum('sub_total')
        ]);
        foreach ($carts as $key => $value) {
           SalesOrderItems::create([
            'sales_orders_id'=>$sales_order->id,
            'product_id'=>$value->product_id,
            'quantity'=>$value->quantity
           ]);
           $value->delete();
        }
        return redirect()->route('my_order');

    }
    public function complete_sales_order($id){
        $sales_order= SalesOrder::find($id);
        $sales_order->update([
            'status'=>'Completed'
        ]);
        $reward = RewardPoint::create([
            'sales_orders_id'=>$sales_order->id,
            'user_id'=>$sales_order->user_id,
            'amount'=>$sales_order->amount,
        ]);
        return redirect()->route('my_order');
    }
    public function cancel_sales_order($id){
        $sales_order= SalesOrder::find($id);
        $sales_order->update([
            'status'=>'Cancelled'
        ]);
        
        return redirect()->route('my_order');
    }
}

<?php

namespace App\Http\Middleware;

use App\Models\SalesOrder;
use Closure;
use Illuminate\Http\Request;

class SalesOwnerCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $orderId = $request->route('id');
        $salesOrder = SalesOrder::find($orderId);
        if($salesOrder->user == $request->user()){
        return $next($request);
        }else{
            return redirect()->route('index')->with(['status'=>403,'message'=>'Access denied']);
        }
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function getItems(){
        $items = Product::paginate(8);
        return response()->json(['status'=>200,'items'=>$items]);
    }
    public function filterItems(Request $request){
   
        $filter_packages = Product::query();
        if ( isset($request->category_id) && $request->category_id !== "") {
            $filter_packages->where('category_id', $request->category_id)->get(); 
           
        }
        if ( isset($request->sort) && $request->sort !== "") {
            if ($request->sort == '1') {
               $filter_packages->orderBy('price','desc');
            }
            else{
                $filter_packages->orderBy('price','asc');
            }
            
        }
        $filter_packages= $filter_packages->paginate(8);
    
        return response()->json(['status'=>200,'filter_packages'=>$filter_packages]);
    }
}

<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\Models\SalesOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::paginate(9);
        return view('frontend.pages.index', compact('products'));
    }

   
    public function my_cart()
    {
        if (Auth::check()) {
            $carts = Cart::where('user_id', Auth::user()->id)->get();
        } else {
            $sessionId = session()->getId();
            $carts = Cart::where('session_id', $sessionId)->get();
        }

        return view('frontend.pages.mycart', compact('carts'));
    }
    public function my_order()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $sales_orders = $user->sales_order->where('status','Pending');
            $completed_orders = $user->sales_order->where('status','Completed');
            $cancelled_orders = $user->sales_order->where('status','Cancelled');
           
        } else {
            $sessionId = session()->getId();
            $carts = Cart::where('session_id', $sessionId)->get();
        }

        return view('frontend.pages.myorder', compact('sales_orders','completed_orders','cancelled_orders'));
    }

    public function login()
    {

        return view('frontend.pages.login');
    }
    public function post_login(Request $request)
    {
        // dd($request->all());
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {

            // Auth::id(6);
            return redirect()->intended('/')
                ->withSuccess('Signed in');
        }

        return redirect("login")->with('message', 'Login details are not valid');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->json(['status'=>200,'message'=>'Logout Success']);
    }

    public function countWordsInSentences(Request $request)
    {
        $text = $request->text;
        // Strip punctuation marks except period, comma, question mark, and exclamation point
        $text = preg_replace('/[^\w\s.,?!]/', '', $text);
        $words = preg_split('/\s+/', $text, -1, PREG_SPLIT_NO_EMPTY);
        $sentences = preg_split('/[.?!]+/', $text, -1, PREG_SPLIT_NO_EMPTY);
        // Initialize an array to store the word count for each sentence
        $wordCounts = [];
        // Loop through each sentence and count the words
        foreach ($sentences as $sentence) {
            // Remove leading/trailing whitespaces and hyphens
            $sentence = trim($sentence, " -");
    
            // Split the sentence into words
            $words = preg_split('/\s+/', $sentence, -1, PREG_SPLIT_NO_EMPTY);
    
            // Count the words in the sentence
            $wordCount = count($words);
    
            // Store the word count for the sentence
            $wordCounts[] = $wordCount;
         
        }
    
        return response()->json(['status'=>200,'wordcount'=>$wordCounts]) ;
    }

    
    
   
  
    
    
    
    
    

}

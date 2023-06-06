<?php

namespace App\Http\Controllers\Dash;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sales;
use App\Models\Products;

class DashboardControl extends Controller
{
    //
    public function index(){

        $total_sales = Sales::sum('price');
        $today_sales = Sales::whereDate('created_at', now()->toDateString())->sum('price');
        $today_orders = Sales::whereDate('created_at', now()->toDateString())->count();
        $out_of_stocks = Products::where('quantity', '<=', 1)->paginate(10);
        $out_of_stock_count = $out_of_stocks->total();
    

        //list of products going out of stock soon 

        return view('Dashboard.dash')->with(['total_sales' => $total_sales, 'today_sales'=>$today_sales, 'today_orders'=>$today_orders, 'out_of_stock'=>$out_of_stock_count]);
    }
    
}


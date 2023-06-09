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
        $out_of_stocks = Products::with(['unitInfo'])->where('quantity', '<=', 1)->paginate(5);
        $highest_running_products = Products::withCount('sales')
                                ->orderBy('sales_count', 'desc')
                                ->limit(10)
                                ->get();

        //list of products going out of stock soon 

        return view('Dashboard.dash')->with(['total_sales' => $total_sales, 'today_sales'=>$today_sales, 'today_orders'=>$today_orders, 'out_of_stock'=>$out_of_stocks, 'out_of_stock_count'=>$out_of_stocks->total(), 'highest_sold'=>$highest_running_products]);
    }
    
}


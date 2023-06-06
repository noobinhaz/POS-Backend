<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sales;
use App\Models\Products; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $sales = Sales::with(['product', 'unit', 'user'])->whereNull('deleted_at')->paginate(10);

        return view('Setup.sales')->with(['sales' => $sales]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $query = request('search');
        // dd($query);
        $products = Products::with(['categories', 'unitInfo'])
        // ->whereNull('deleted_at')
                    ->where(function($eloquent)use($query){
                        if($query){
                            $eloquent->where('productName', 'like', '%'.$query.'%');
                        }
                    })
                    ->latest()
                    ->paginate(20);
        return view('Create.sales')->with(['taxRate'=> 15, 'data'=> $products]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $validatedData = $request->validate([
                'products_id' => 'required|array',
                'products_id.*' => 'required|exists:products,id',
                'price' => 'required|array',
                'price.*' => 'required|numeric|min:0',
                'clientName' => 'nullable|string',
                'clientEmail' => 'nullable|email',
                'quantity' => 'required|array',
                'quantity.*' => 'required|integer|min:1',
            ]);
        
            // Create an empty array to store the order items
            $orderItems = [];
        
            // Iterate through each product and create an order item
            foreach ($validatedData['products_id'] as $index => $productId) {
                $product                = Products::find($productId);
                $unit                   = $product->unit;
                $quantity               = $product->quantity;

                $sale                     = new Sales();
                $sale->products_id        = $productId;
                $sale->unit_id            = $unit;
                $sale->price              = $validatedData['price'][$index];
                $sale->quantity           = $validatedData['quantity'][$index];
                $sale->clientName         = isset($validatedData['clientName']) ? $validatedData['clientName'] : null;
                $sale->clientEmail        = isset($validatedData['clientEmail']) ? $validatedData['clientEmail'] : null;
                $sale->created_by         = auth()->user()->id;
                $sale->save();
                
                $product->quantity      = (int)$quantity - (int)$validatedData['quantity'][$index];
                $product->save();
            }
            DB::commit();
            // Redirect or return a response indicating the success
            return redirect()->back()->with('success', 'Order created successfully.');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();
            \Log::error($th);
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $sale = Sales::find($id);

        $product = Products::find($sale->products_id);

        if($product){

            $product->quantity = (int)$product->quantity + (int)$sale->quantity;
            $product->save();
        }

        $sale->delete();

        return back()->with('message', 'Sale Successfully Deleted!');
    }
}

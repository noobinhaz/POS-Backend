<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Categories;
use App\Models\CategoriesProduct;
use App\Models\Units;
use App\Models\Images;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ProductControl extends Controller
{
    //
    public function create(){
        $categories = Categories::where('status', 1)->whereNull('deleted_at')->get();
        $units = Units::where('status', 1)->whereNull('deleted_at')->get();
        return view('Create.product')->with(['categories'=>$categories, 'units'=>$units]);
    }
    public function index(){
        $products = Products::with(['categories', 'unitInfo'])->withCount('sales')->whereNull('deleted_at')->paginate(10);
        return view('Setup.product')->with(['data'=> $products]);
    }

    public function search(){
        $search = request('search');
        $products = Products::with(['categories', 'unitInfo'])->whereNull('deleted_at')
                    -where('productName', 'LIKE', '%'.$query.'%')
                    ->orWhere('description', 'LIKE', '%'.$query.'%')
                    ->paginate(10);

        return view('Create.sales')->with(['data'=> $products, 'taxRate'=>15]);
    }
    
    public function store(Request $request){
        try {
            //code...
            // dd($request->all(), get_type($request->category));
            DB::beginTransaction();
            $form = $request->validate([
                'productName'   => ['required', 'string'], 
                'quantity'      => ['required', 'integer'],
                'unit'          => ['required', 'integer'],
                'priceCode'     => ['required', 'string'],
                'description'   => ['required', 'string'],
            ]);
            $form['uploadedBy'] = Auth::user()->id;

            if(!count($request->category)){
                return back()->with('error', 'Must select Categories');
            }

            $create = Products::create($form);
           
            foreach($request->category as $category){
               
               $catProd = CategoriesProduct::create([
                'categories_id' => (int)$category,
                'products_id'  => $create->id
               ]);
            }

            foreach($request->image as $image){

                if($image){

                    $productImage = new Images;
                    // $image      = $image;
                    $image_name = time() . $image->getClientOriginalName();
                    Storage::disk('public')->put('product/' . $image_name,  File::get($image));

                    $productImage->location = 'uploads/product/'. $image_name;
                    $productImage->name          = $image->getClientOriginalName();
                    $productImage->products_id   = $create->id;

                    $productImage->save();
                }
            }

            DB::commit();

            return redirect('/products/create')->with('success', 'Product Created Successfully');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();
            return back()->with('error', $th->getMessage());

        }
    }
    public function show($id){
        $product= Products::with(['categories', 'unitInfo'])->whereNull('deleted_at')
                    ->where('id', $id)->first();
        return view('Show.product')->with(['product'=>$product]);
    }
    public function edit($id){
        $product = Products::with(['categories', 'unitInfo'])->whereNull('deleted_at')
                    ->where('id', $id)->first();
        $categories = Categories::where('status', 1)->whereNull('deleted_at')->get();
        $units = Units::where('status', 1)->whereNull('deleted_at')->get();
        return view('Edit.product')->with(['product'=>$product, 'categories'=>$categories, 'units'=>$units]);
    }
    public function update(Request $request ,$id){
        try {
            
            DB::beginTransaction();
            $form = $request->validate([
                'productName'   => ['required', 'string'], 
                'quantity'      => ['required', 'integer'],
                'unit'          => ['required', 'integer'],
                'priceCode'     => ['required', 'string'],
                'description'   => ['required', 'string'],
            ]);

            if(!$request->category || !count($request->category)){
                return back()->with('error', 'Must select Categories');
            }

             Products::where('id', $id)->update($form);
            
            CategoriesProduct::where('products_id', $id)->delete();

            foreach($request->category as $category){
               
               $catProd = CategoriesProduct::create([
                'categories_id' => (int)$category,
                'products_id'  => $id
               ]);
            }
            if($request->image){

                foreach($request->image as $image){
    
                    if($image){
    
                        $productImage = new Images;
                        // $image      = $image;
                        $image_name = time() . $image->getClientOriginalName();
                        Storage::disk('public')->put('product/' . $image_name,  File::get($image));
    
                        $productImage->location = 'uploads/product/'. $image_name;
                        $productImage->name          = $image->getClientOriginalName();
                        $productImage->products_id   = $create->id;
    
                        $productImage->save();
                    }
                }
            }

            DB::commit();

            return redirect('/products')->with('success', 'Product updated Successfully');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();
            return back()->with('error', $th->getMessage());

        }
    }
    public function destroy($id){
        Products::with(['categories', 'unitInfo'])->whereNull('deleted_at')
                    ->where('id', $id)->update(['deleted_at'=>now()]);

        return back()->with('success', 'Successfully Deleted Product');
    }
}

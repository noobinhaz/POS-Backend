<?php

namespace App\Http\Controllers\Base;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categories;

class CategoryControl extends Controller
{
    //
    public function index(){

        $categories = Categories::with(['products' => function($query) {
            $query->count('id');
        }])->whereNull('deleted_at')->get();

        return response()->json([
            'isSuccess' => $categories->count() ? true: false,
            'message'   => $categories->count() ? '' : 'No categories found',
            'data'      => $categories

        ], 200);
    }

    public function store(Request $request){
        try {
            //code...
            $form = $request->validate([
                'name' => ['required', 'string']
            ]);

            Categories::create($form);

            return response()->json([
                'isSuccess' => true,
                'message'   => 'Category create successfully',
                'date'      => []
            ], 200);

        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'isSuccess' => false,
                'message'   => $th->getMessage(),
                'date'      => []
            ], 422);
        }
    }

    public function show($id){
        $category = Categories::with(['products'])->find($id);
        
        return response()->json([
            'isSuccess' => $category ? true: false,
            'message'   => $category ? '' : 'No category found',
            'data'      => $category

        ], 200);
    }

    public function update($id){
        try {
            //code...
            $form = $request->validate([
                'name' => ['required', 'string']
            ]);

            Categories::where('id', $id)->update($form);

            return response()->json([
                'isSuccess' => true,
                'message'   => 'Category updated successfully',
                'date'      => []
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'isSuccess' => false,
                'message'   => $th->getMessage(),
                'date'      => []
            ], 422);
        }
    }
    public function destroy($id){
        $delete = Categories::where('id', $id)->update(['deleted_at' => now()]);

        return response()->json([
            'isSuccess' => $delete ? true : false,
            'message'   => $delete ? 'Deleted successfully' : 'Delete failed',
            'date'      => []
        ], $delete ? 200 : 422);
    }
}

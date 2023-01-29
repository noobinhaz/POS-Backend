<?php

namespace App\Http\Controllers\Base;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categories;

class CategoryControl extends Controller
{
    //
    public function index(){

        $categories = Categories::whereNull('categories.deleted_at')->get();

        return view('Setup.category')->with(['categories'=> $categories]);
    }

    public function showForm(){
        return view('Create.category');
    }

    public function store(Request $request){
        
        try {
            //code...
            $form = $request->validate([
                'name' => ['required', 'string'],
                'status' => 'nullable | integer'
            ]);

            Categories::create($form);

            return redirect('/addCat')->with('success','Category Created Successfully');

        } catch (\Throwable $th) {
            //throw $th;
            return back()->withErrors(["name"=>$th->getMessage()]);
        }
    }

    public function show($id){
        // dd($id);
        $category = Categories::find($id);
        
        return view('Edit.category')->with(['category'=>$category]);
    }

    public function update(Request $request, $id){
        // dd($request->all());
        try {
            //code...
            $form = $request->validate([
                'name' => 'nullable | string',
                'status' => 'nullable | integer'
            ]);

            Categories::where('id', $id)->update($form);

            return redirect('/category')->with('message', 'Successfully Updated!');

        } catch (\Throwable $th) {
            dd($th->getMessage());
            return back()->withErrors(["name"=>$th->getMessage()]);
        }
    }
    public function destroy($id){
        $delete = Categories::where('id', $id)->update(['deleted_at' => now()]);

        return redirect('/category')->with('message', 'Successfully Deleted!');
    }
}

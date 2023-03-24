<?php

namespace App\Http\Controllers\Base;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categories;

class CategoryControl extends Controller
{
    //
    public function index(){

        $categories = Categories::whereNull('categories.deleted_at')->paginate(10);

        $fields = ['Serial', 'Category Name', 'Status', 'Action'];

        return view('Setup.base_list')->with(['data'=> $categories, 'fields'=> $fields, 'add_new'=>'/addCat', 'route'=> "/category", 'view'=>true]);
    }

    public function showForm(){
        $fields = ['Category name'=>'name'];
        return view('Create.base_create')->with(['fields' => $fields, 'route'=> "/category"]);
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
        $category = Categories::with(['products'])->find($id);
        return view('Show.productByCategory')->with(['category' => $category]);
        
    }

    public function edit($id){
        $category = Categories::find($id);
        $fields = ['Category name'=>'name'];
        return view('Edit.base_edit')->with(['data'=>$category, 'fields' => $fields, 'route'=> "/category"]);
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
            
            return back()->withErrors(["name"=>$th->getMessage()]);
        }
    }
    public function destroy($id){
        $delete = Categories::where('id', $id)->update(['deleted_at' => now()]);

        return redirect('/category')->with('message', 'Successfully Deleted!');
    }
}

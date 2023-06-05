<?php

namespace App\Http\Controllers\Base;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Units;

class UnitControl extends Controller
{
public function index(){

        $units = Units::whereNull('units.deleted_at')->paginate(10);

        $fields = ['Serial', 'Unit Name', 'description', 'Status', 'Action'];

        return view('Setup.base_list')->with(['data'=> $units, 'fields'=> $fields, 'add_new'=>'/unit/create', 'route'=> "/unit", 'view'=>false]);
    }

    public function create(){
        $fields = ['Unit name'=>'name', 'Description' => 'description'];
        return view('Create.base_create')->with(['fields' => $fields, 'route'=> "/unit"]);
    }

    public function store(Request $request){
        
        try {
            //code...
            $form = $request->validate([
                'name' => ['required', 'string'],
                'description' => ['required', 'string'],
                'status' => 'nullable | integer'
            ]);

            Units::create($form);

            return redirect('/unit/create')->with('success','Units Created Successfully');

        } catch (\Throwable $th) {
            //throw $th;
            return back()->withErrors(["name"=>$th->getMessage(), "description"=>$th->getMessage()]);
        }
    }

    public function show($id){
        // dd($id);
        
    }

    public function edit($id){
        $unit = Units::find($id);
        $fields = ['Unit Name'=>'name', 'Description' => 'description'];
        return view('Edit.base_edit')->with(['data'=>$unit, 'fields' => $fields, 'route'=> "/unit"]);
    }

    public function update(Request $request, $id){
        // dd($request->all());
        // dd($form);
        try {
            //code...
            $form = $request->validate([
                'name' => ['required', 'string'],
                'description' => ['required', 'string'],
                'status' => ['required ',' integer']
            ]);
            // dd($form);
            $unit = Units::find($id);
            $unit->update($form);
            // dd($update);
            return redirect('/unit')->with('message', 'Successfully Updated!');

        } catch (\Throwable $th) {
            // dd($th->getMessage());
            return redirect('/unit')->with('message', $th->getMessage());
        }
    }
    public function destroy($id){
        $delete = Units::where('id', $id)->update(['deleted_at' => now()]);

        return redirect('/unit')->with('message', 'Successfully Deleted!');
    }
}

<?php

namespace App\Http\Controllers\Base;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Units;

class UnitControl extends Controller
{
    //
    public function index(){
        $units = Units::whereNull('deleted_at')->get();

        return $units;
    }
    public function store(Request $request, $id){}
    public function show($id){}
    public function update(Request $request, $id){}
    public function destroy(){}
}

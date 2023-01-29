<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
class ProductControl extends Controller
{
    //
    public function create(){}
    public function index(){
        $products = Products::whereNull('deleted_at')->get();
    }
    public function store(){}
    public function show(){}
    public function edit(){}
    public function update(){}
    public function delete(){}
}

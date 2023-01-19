<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Products;
use App\Models\CategoriesProduct;

class Categories extends Model
{
    use HasFactory;

    Protected $fillable = ['name'];

    public function products(){
        return $this->belongsToMany(Products::class, 'categories_products');
    }

    public function categories_products(){
        return $this->hasMany(CategoriesProduct::class, 'category_id', 'id');
    }
}

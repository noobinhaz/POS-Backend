<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Products;
use App\Models\CategoriesProduct;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categories extends Model
{
    use HasFactory;
    use SoftDeletes;

    Protected $fillable = ['name', 'status'];

    public function products(){
        return $this->belongsToMany(Products::class, 'categories_products');
    }

    public function categories_products(){
        return $this->hasMany(CategoriesProduct::class, 'category_id', 'id');
    }
}

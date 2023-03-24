<?php

namespace App\Models;

use App\Models\Sales;
use App\Models\Images;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuids;
use App\Models\CategoriesProduct;
use App\Models\Categories;
use App\Models\Units;

class Products extends Model
{
    use HasFactory, Uuids;

    protected $fillable = [
        'productName', 'quantity', 'unit', 
        // 'category',
        'priceCode', 'description', 'uploadedBy'
    ];

    public function images(){
        return $this->hasMany(Images::class, 'products_id', 'id')->select('name', 'location', 'products_id');
    }

    public function sales(){
        return $this->hasMany(Sales::class)->select('product', 'price', 'clientName', 'clientEmail', 'soldBy', 'created_at', 'updated_at');
    }

    public function categories(){
        return $this->belongsToMany(Categories::class, 'categories_products');
    }

    public function categories_products(){
        return $this->hasMany(CategoriesProduct::class, 'product_id', 'id');
    }

    public function unitInfo(){
        return $this->belongsTo(Units::class, 'unit', 'id');
    }
}

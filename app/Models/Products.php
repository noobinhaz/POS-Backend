<?php

namespace App\Models;

use App\Models\Sales;
use App\Models\Images;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Products extends Model
{
    use HasFactory;

    protected $fillable = [
        'productName', 'quantity', 'unitCode', 'category',
        'priceCode', 'description', 'uploadedBy'
    ];

    public function images(){
        return $this->hasMany(Images::class)->select('name', 'location', 'product');
    }

    public function sales(){
        return $this->hasMany(Sales::class)->select('product', 'price', 'clientName', 'clientEmail', 'soldBy', 'created_at', 'updated_at');
    }
}

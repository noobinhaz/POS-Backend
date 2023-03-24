<?php

namespace App\Models;

use App\Models\Products;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuids;
class Sales extends Model
{
    use HasFactory, Uuids;

    protected $fillable = [
        'products_id', 'price', 'clientName', 'clientEmail'
    ];

    public function product(){
        return $this->belongsTo(Products::class, 'product')->select('productName', 'quantity', 'unitCode', 
        'priceCode', 'description');
    }
}

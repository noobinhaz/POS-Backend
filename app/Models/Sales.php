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
        'products_id', 'price', 'clientName', 'clientEmail', 'quantity', 'unit_id'
    ];

    public function product(){
        return $this->belongsTo(Products::class, 'products_id', 'id')->select('productName', 'quantity', 'unitCode', 
        'priceCode', 'description');
    }
}

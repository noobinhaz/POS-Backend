<?php

namespace App\Models;

use App\Models\Products;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Images extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'location', 'product'
    ];

    public function product(){
        return $this->belongsTo(Products::class, 'product');
    }
}

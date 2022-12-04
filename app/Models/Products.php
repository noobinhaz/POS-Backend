<?php

namespace App\Models;

use App\Models\Images;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Products extends Model
{
    use HasFactory;

    protected $fillable = [
        'productName', 'quantity', 'unitCode', 
        'priceCode', 'description', 'uploadedBy'
    ];

    public function images(){
        return $this->hasMany(Images::class)->select('name', 'location', 'product');
    }
}

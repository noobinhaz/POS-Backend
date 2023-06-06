<?php

namespace App\Models;

use App\Models\Products;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\SoftDeletes;

class Images extends Model
{
    use HasFactory, Uuids;
    use SoftDeletes;

    protected $fillable = [
        'name', 'location', 'products_id'
    ];

    public function product(){
        return $this->belongsTo(Products::class, 'products_id', 'id');
    }
}

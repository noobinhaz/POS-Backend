<?php

namespace App\Models;

use App\Models\Products;
use App\Models\Units;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sales extends Model
{
    use HasFactory, Uuids;
    use SoftDeletes;

    protected $fillable = [
        'products_id', 'price', 'clientName', 'clientEmail', 'quantity', 'unit_id', 'created_by'
    ];

    public function product(){
        return $this->belongsTo(Products::class, 'products_id', 'id')->select('id','productName', 'quantity', 'unit', 
        'priceCode', 'description');
    }

    public function unit(){
        return $this->belongsTo(Units::class, 'unit_id', 'id')->select('id', 'name');
    }

    public function user(){
        return $this->belongsTo(User::class, 'created_by', 'id')->select('id', 'fullName');
    }
}

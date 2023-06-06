<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class CategoriesProduct extends Model
{
    use HasFactory;
    // use SoftDeletes;

    protected $fillable = ['categories_id', 'products_id'];
}

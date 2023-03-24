<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriesProduct extends Model
{
    use HasFactory;

    protected $fillable = ['categories_id', 'products_id'];
}

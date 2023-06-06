<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expenses extends Model
{
    use HasFactory, Uuids;
    use SoftDeletes;

    protected $fillable = [
        'expenseSector', 'description', 'amount'
    ];
}

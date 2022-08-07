<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Spatie\Translatable\HasTranslations;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = [
        'name',
        'code',
        'price',
        'description'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Spatie\Translatable\HasTranslations;

class Invoice extends Model
{
    protected $table = 'invoices';
    protected $fillable = [
        'user_id',
        'total',
        'is_paid',
        'getway',
        'pinikle_getway'
    ];
}

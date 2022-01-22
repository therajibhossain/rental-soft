<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'type',
        'availability',
        'needing_repair',
        'durability',
        'max_durability',
        'mileage',
        'price',
    ];

    public $guarded = ['id', 'created_at', 'updated_at'];
}

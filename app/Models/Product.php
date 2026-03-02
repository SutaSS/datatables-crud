<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            $product->uuid = Str::uuid();
        });
    }

    protected $fillable = [
        'uuid',
        'name',
        'description',
        'price',
        'stock',
    ];
    
    public function getRouteKeyName()
    {
        return 'uuid';
    }
}
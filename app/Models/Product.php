<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function cart()
    {
        return $this->hasMany(Cart::class,'id');
    }
    use HasFactory;
    protected $fillable = [
       'title',
       'description',
       'image',
       'stock',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'menu_id',
        'content',
        'active',
        'price',
        'price_sale',
        'thumb'
    ];

    public function menu() {
        return $this->hasOne(Menu::class, 'id', 'menu_id');
    }
}

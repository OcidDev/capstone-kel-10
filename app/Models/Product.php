<?php

namespace App\Models;

use App\Models\Shelves;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'categories_id',
        'shelves_id',
        'product_code',
        'name',
        'image',
        'description',
        'price',
        'capital_price',
        'stock'
    ];

    public function category()
    {
       return $this->belongsTo(Category::class,'categories_id');
    }

    public function shelves()
    {
       return $this->belongsTo(Shelves::class,'shelves_id');
    }


}

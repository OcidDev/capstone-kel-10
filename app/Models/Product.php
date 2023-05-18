<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'categories_id',
        'suppliers_id',
        'products_id',
        'raks_id',
        'product_code',
        'name',
        'description',
        'price',
        'modal',
        'stock'
    ];

    public function category()
    {
       return $this->belongsTo(Category::class,'categories_id');
    }

    public function supplier()
    {
       return $this->belongsTo(Supplier::class,'suppliers_id');
    }

    public function rak()
    {
       return $this->belongsTo(Rak::class,'raks_id');
    }


}

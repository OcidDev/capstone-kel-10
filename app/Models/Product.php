<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['categories_id','suppliers_id','products_id','raks_id','produk_code','description','image','price','modal','stock'];

}

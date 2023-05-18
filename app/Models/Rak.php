<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rak extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name','description'];

    public function product(){
        return $this->hasMany(Product::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaction extends Model
{
    use HasFactory,SoftDeletes;
    Protected $fillable = ['transactions_id','products_id','qty'];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transactions_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'products_id');
    }
}

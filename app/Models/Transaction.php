<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory,SoftDeletes;
    Protected $fillable = [
        'cashier_id',
        'buyer_id',
        'invoice_code',
        'date',
        'total',
        'cash',
        'change',
        'status'];
    /**
     * Get the cashier that owns the Transaction
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cashier(): BelongsTo
    {
        return $this->belongsTo(User::class, 'cashier_id', 'id');
    }

    public function buyer(): BelongsTo
    {
        return $this->belongsTo(Buyer::class, 'buyer_id', 'id');
    }

    public function DetailTransaction()
    {
        return $this->hasMany(DetailTransaction::class, 'transactions_id');
    }


}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Komentar extends Model
{
    protected $table = 'komentars';
    protected $primaryKey = 'id_komentar';

    protected $fillable = [
        'id_transactions',
        'pic_k',
        'npk_k',
        'dep_k',
        'komentar',
    ];

    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class, 'id_transactions', 'id_transaction');
    }
}

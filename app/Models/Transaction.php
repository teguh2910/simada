<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;
    protected $table = 'transactions';
    protected $primaryKey = 'id_transaction';

    protected $fillable = [
        'project',
        'due_date',
        'supplier',
        'part_number',
        'status',
        'id_document',
        'file',
        'revise',
        'pic',
        'npk',
        'is_need',
    ];

    protected $casts = [
        'due_date' => 'date',
        'status' => 'integer',
        'revise' => 'integer',
        'is_need' => 'boolean',
    ];

    public function document(): BelongsTo
    {
        return $this->belongsTo(Document::class, 'id_document', 'id');
    }

    public function komentars(): HasMany
    {
        return $this->hasMany(Komentar::class, 'id_transactions', 'id_transaction');
    }
}

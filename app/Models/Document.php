<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Document extends Model
{
    use HasFactory;
    protected $fillable = [
        'kinds_doc',
        'documents',
    ];

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'id_document', 'id');
    }
}

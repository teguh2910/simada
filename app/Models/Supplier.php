<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Supplier extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'contact_person',
        'phone',
        'address',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function rfqs(): BelongsToMany
    {
        return $this->belongsToMany(RFQ::class, 'rfq_supplier', 'supplier_id', 'rfq_id')
            ->withPivot('sent_at')
            ->withTimestamps();
    }
}

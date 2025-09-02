<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use App\Models\Supplier;

class RFQ extends Model
{
    use HasFactory;
    protected $table = 'rfqs';
    
    protected $fillable = [
        'title',
        'description',
        'due_date',
        'project',
        'part_number',
        'status',
        'created_by',
        'sent_at',
        'attachments',
    ];

    protected $casts = [
        'due_date' => 'date',
        'sent_at' => 'datetime',
        'attachments' => 'array',
    ];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function suppliers(): BelongsToMany
    {
        return $this->belongsToMany(Supplier::class, 'rfq_supplier', 'rfq_id', 'supplier_id')
            ->withPivot('sent_at')
            ->withTimestamps();
    }

    /**
     * Store uploaded attachments
     */
    public function storeAttachments($files)
    {
        $attachments = [];

        if ($files) {
            foreach ($files as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('rfq_attachments', $filename, 'public');
                $attachments[] = [
                    'original_name' => $file->getClientOriginalName(),
                    'filename' => $filename,
                    'path' => $path,
                    'size' => $file->getSize(),
                    'mime_type' => $file->getMimeType(),
                ];
            }
        }

        $this->update(['attachments' => $attachments]);
    }

    /**
     * Get attachment file paths for email attachments
     */
    public function getAttachmentPaths()
    {
        $paths = [];

        if ($this->attachments) {
            foreach ($this->attachments as $attachment) {
                $fullPath = storage_path('app/public/' . $attachment['path']);
                if (file_exists($fullPath)) {
                    $paths[] = $fullPath;
                }
            }
        }

        return $paths;
    }
}

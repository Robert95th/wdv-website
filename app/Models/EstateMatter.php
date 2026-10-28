<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstateMatter extends Model
{
    use HasFactory;

    protected $fillable = [
        'estate_matter',
        'reference',
        'status',
        'next_action',
        'date_and_venue',
        'expiry_date',
        'view_status',
        'file_link',
        'document_path'
    ];

    // Cast the new columns to their proper types
    protected $casts = [
        'expiry_date' => 'date',
        'view_status' => 'boolean',
    ];
    public function documents()
    {
        return $this->hasMany(EstateDocument::class, 'estate_matter_id');
    }
}

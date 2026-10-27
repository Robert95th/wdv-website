<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstateDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'estate_matter_id',
        'document_type',
        'asset_id',
        'title',
        'description',
        'filename',
        'size',
        'is_public',
    ];
}

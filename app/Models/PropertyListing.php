<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class PropertyListing extends Model
{
    use HasFactory;

    protected $fillable = [
        'category',
        'title',
        'description',
        'auctioneer',
        'date_and_time',
        'venue',
        'image',
        'view_status',
        'document_path'
    ];
    public function images()
    {
        return $this->hasMany(PropertyImage::class);
    }
}

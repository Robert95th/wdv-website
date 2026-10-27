<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyImage extends Model
{
    use HasFactory;

    protected $fillable = ['property_listing_id', 'image_path', 'is_primary'];

    public function property()
    {
        return $this->belongsTo(PropertyListing::class);
    }
}

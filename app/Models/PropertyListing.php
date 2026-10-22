<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'view_status'
    ];
}

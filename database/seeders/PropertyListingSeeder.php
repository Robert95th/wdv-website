<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PropertyListing;

class PropertyListingSeeder extends Seeder
{
    public function run(): void
    {
        PropertyListing::create([
            'category' => 'Movables',
            'title' => 'Movable assets — office equipment & vehicles',
            'description' => 'Office furniture, 2 delivery vehicles, stock-in-trade, from ABC Trading CC (L12/2025)',
            'auctioneer' => '[Auctioneer name & contact]',
            'date_and_time' => '22 Oct 2026, 10:00',
            'venue' => null,
            // Placeholder image
            'image' => 'https://picsum.photos/seed/office/800/600',
        ]);

        PropertyListing::create([
            'category' => 'Residential',
            'title' => 'Immovable property — Erf 214, Klein Windhoek',
            'description' => '3-bedroom residence, 620m² erf, from Estate Late J. van Wyk (E45/2025)',
            'auctioneer' => '[Auctioneer name & contact]',
            'date_and_time' => '15 Nov 2026, 11:00',
            'venue' => 'On-site, Klein Windhoek',
            // Placeholder image
            'image' => 'https://picsum.photos/seed/house/800/600',
        ]);
    }
}

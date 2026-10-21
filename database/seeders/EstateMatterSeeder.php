<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EstateMatter;

class EstateMatterSeeder extends Seeder
{
    public function run(): void
    {
        $matters = [
            [
                'estate_matter' => 'ABC Trading CC (In Liquidation)',
                'reference' => 'L12/2025',
                'status' => 'First creditors\' meeting',
                'next_action' => 'First meeting of creditors',
                'date_and_venue' => '14 Oct 2026, Master\'s Office, Windhoek',
                'expiry_date' => '2026-10-14',
                'view_status' => true,
            ],
            [
                'estate_matter' => 'Estate Late J. van Wyk',
                'reference' => 'E45/2025',
                'status' => 'Liquidation & distribution',
                'next_action' => 'L&D account lying for inspection',
                'date_and_venue' => 'From 1 Oct 2026, our offices',
                'expiry_date' => '2026-10-01',
                'view_status' => true,
            ],
            [
                'estate_matter' => 'Estate Late M. & T. Amupolo',
                'reference' => 'E12/2026',
                'status' => 'Final distribution',
                'next_action' => 'Final L&D account submitted to Master',
                'date_and_venue' => 'Submitted 3 Sep 2026',
                'expiry_date' => '2026-09-03',
                'view_status' => true,
            ],
            [
                'estate_matter' => 'Riverside Investments (Pty) Ltd',
                'reference' => 'L03/2026',
                'status' => 'Sequestration granted',
                'next_action' => 'Second creditors\' meeting',
                'date_and_venue' => '20 Nov 2026, Master\'s Office, Windhoek',
                'expiry_date' => '2026-11-20',
                'view_status' => true,
            ],
        ];

        foreach ($matters as $matter) {
            EstateMatter::create($matter);
        }
    }
}
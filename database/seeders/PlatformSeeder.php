<?php

namespace Database\Seeders;

use App\Models\Platform;
use Illuminate\Database\Seeder;

class PlatformSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $platforms = [
            'Facebook',
            'Twitter',
            'Instagram',
            'LinkedIn',
            'Pinterest',
            'Snapchat',
            'TikTok',
            'YouTube',
            'Reddit',
            'WhatsApp',
            'Telegram',
            'X',
        ];
        array_map(
            fn($platform) => Platform::updateOrCreate(['name' => $platform], ['name' => $platform]),
            $platforms
        );
    }
}

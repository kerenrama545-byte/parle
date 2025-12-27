<?php

namespace Database\Seeders;

use App\Models\CompanyInformation;
use Illuminate\Database\Seeder;

class CompanyInformationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CompanyInformation::updateOrCreate(
            ['id' => 1],
            [
                'logo' => 'images/logo/logo.png',
                'icon' => 'images/logo/icon-primary.png',
                'phones' => [
                    '+62 8111 341 808',
                    '+62 8111 341 808',
                ],
                'email' => 'info@parle-group.com',
                'address' => "Jl. Gerbang Pemuda No.3, RT.1/RW.3, Gelora,\nKecamatan Tanah Abang, Kota Jakarta Pusat,\nDaerah Khusus Ibukota Jakarta 10270",
                'google_map_link' => 'https://maps.app.goo.gl/yVz9y2EDHgBFwWTT6',
                'opening_hours' => [
                    'MONDAY - WEDNESDAY' => '10:00 - 24:00',
                    'FRIDAY & SATURDAY' => '10:00 - 02:00',
                    'SUNDAY' => '07:00 - 22:00',
                ],
                'video_profile_link' => 'https://www.youtube.com/watch?v=Qaa0KZ9wZeE',
            ]
        );
    }
}

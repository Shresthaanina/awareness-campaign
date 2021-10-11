<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['meta_key' => 'logo'],
            ['meta_key' => 'site_name'],
            ['meta_key' => 'site_tagline'],
        ];

        Setting::insert($data);
    }
}

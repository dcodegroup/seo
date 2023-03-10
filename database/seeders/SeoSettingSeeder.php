<?php

namespace Dcodegroup\SeoSettings\Database\Seeders;

use Dcodegroup\SeoSettings\Models\SeoSetting;
use Illuminate\Database\Seeder;

class SeoSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $defaults = [
            [
                //
            ]
        ];

        foreach($defaults as $setting) {
            SeoSetting::query()->create($setting);
        }
    }
}

<?php

use App\Themes;
use Illuminate\Database\Seeder;

class ThemesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $theme1 =Themes::Create([
            'name' => 'theme1',
            'img' => 'frontend/theme1/previw.png',
            'desc' => '',
            'active'=>'1',
        ]);
        $theme1->save();

        $theme2 =Themes::Create([
            'name' => 'theme2',
            'img' => '',
            'desc' => '',
            'active'=>'0',
        ]);
        $theme2->save();

          $theme3 =Themes::Create([
            'name' => 'theme3',
            'img' => '',
            'desc' => '',
            'active'=>'0',
        ]);
        $theme3->save();

        $theme4 =Themes::Create([
            'name' => 'theme4',
            'img' => '',
            'desc' => '',
            'active'=>'0',
        ]);
        $theme4->save();
        $theme5 =Themes::Create([
            'name' => 'theme5',
            'img' => '',
            'desc' => '',
            'active'=>'0',
        ]);
        $theme5->save();
        $theme6 =Themes::Create([
            'name' => 'theme6',
            'img' => '',
            'desc' => '',
            'active'=>'0',
        ]);
        $theme6->save();
    }
}

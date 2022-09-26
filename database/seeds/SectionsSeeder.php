<?php

use App\Section;
use Illuminate\Database\Seeder;

class SectionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $about =Section::Create([
        //     'name' => 'about-us',
        //      'url'=>'about',
        //     'sh_desc' => '',
        //     'description' =>'',
        //     'type'=>'about',
        //     'order' => '1',
        //     'active'=>'1',
        // ]);
        // $about->setTranslation('name','en', 'about' );

        // $about->save();

        // $feature =Section::Create([
        //     'name' => 'feature',
        //     'url'=>'#feature',
        //     'description' => '',
        //     'backgroundColor'=>'',
        //     'type'=>'feature',
        //     'order' => '2',
        //     'active'=>'1',
        // ]);
        // $feature->setTranslation('name',"en", 'feature' );
        // $feature->save();

        // $portfolio =Section::Create([
        //     'name' => 'portfolio',
        //      'url' => 'portfolio',
        //     'description' => '',
        //     'backgroundColor'=>'#fff',
        //     'type'=>'portfolio',
        //     'order' => '3',
        //     'active'=>'1',
        // ]);
        // $portfolio->setTranslation('name',"en", 'portfolio' );

        // $portfolio->save();

        // $service =Section::Create([
        //     'name' => 'service',
        //     'url'=>'service',
        //     'description' => '',
        //     'backgroundColor'=>'#fff',
        //     'type'=>'service',
        //     'order' => '4',
        //     'active'=>'1',
        // ]);
        // $service->setTranslation('name',"en", 'service' );

        // $service->save();

        // $blog =Section::Create([
        //     'name' => 'blog',
        //     'url'=>'categoryBlog',
        //     'description' => '',
        //     'backgroundColor'=>'#fff',
        //     'type'=>'blog',
        //     'order' => '5',
        //     'active'=>'1',
        // ]);
        // $blog->setTranslation('name',"en", 'blog' );

        // $blog->save();

        // $teacher =Section::Create([
        //     'name' => 'teacher',
        //     'url'=>'teacher',
        //     'description' => '',
        //     'backgroundColor'=>'#fff',
        //     'type'=>'teacher',
        //     'order' => '6',
        //     'active'=>'1',
        // ]);
        // $teacher->setTranslation('name',"en", 'teacher' );

        // $teacher->save();

        // $event =Section::Create([
        //     'name' => 'ar:"event"',
        //     'url'=>'events',
        //     'description' => '',
        //     'backgroundColor'=>'#fff',
        //     'type'=>'event',
        //     'order' => '7',
        //     'active'=>'1',
        // ]);
        // $event->setTranslation('name',"en", 'event' );

        // $event->save();

        // $catProduct=Section::Create([
        //     'name' => 'Products',
        //     'url'=>'categoryProduct',
        //     'description' => '',
        //     'backgroundColor'=>'#fff',
        //     'type'=>'catProduct',
        //     'order' => '8',
        //     'active'=>'1',
        // ]);
        // $catProduct->setTranslation('name',"en", 'Products' );

        // $catProduct->save();

        // $team =Section::Create([
        //     'name' => "Teams",
        //     'url'=>'teams',
        //     'description' => '',
        //     'backgroundColor'=>'#fff',
        //     'type'=>'teams',
        //     'order' => '9',
        //     'active'=>'1',
        // ]);
        // $team->setTranslation('name',"en", 'Team' );

        // $partner =Section::Create([
        //     'name' => 'partner',
        //     'url'=>'#partner',
        //     'type'=>'partner',
        //     'order' => '10',
        //     'active'=>'1',
        // ]);
        // $partner->setTranslation('name',"en", 'partner' );

        // $partner->save();
        // $testmonials =Section::Create([
        //     'name' => 'testmonial',
        //     'url'=>'#testmonials',
        //     'description' => '',
        //     'backgroundColor'=>'',
        //     'type'=>'testmonials',
        //     'order' => '11',
        //     'active'=>'1',
        // ]);
        // $testmonials->setTranslation('name',"en", 'testmonials' );
        // $testmonials->save();
        $freetrial = Section::Create([
            'name' => 'freetrial',
            'url' => 'freeTrial',
            'type' => 'freetrial',
            'order' => '2',
            'active' => '1',
        ]);
        $freetrial->setTranslation('name', "en", 'freetrial');
        $freetrial->save();
    }
}

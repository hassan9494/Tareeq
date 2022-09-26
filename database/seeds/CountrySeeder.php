<?php

use Illuminate\Database\Seeder;
use App\Country;
class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('countries')->delete();
        $countries = Config::get('countries');
        if (!$countries) {
            throw new Exception("Countries config file doesn't exists or empty, did you run: php artisan vendor:publish?");
        }
        foreach ($countries as $country) {
//        dd($country['name']);
            Country::create(['name'=>$country['name']]);
        }
    }
}

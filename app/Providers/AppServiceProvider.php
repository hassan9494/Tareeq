<?php

namespace App\Providers;

use App\CategoryProduct;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Section;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
   public function register()
{
    if ($this->app->environment() == 'local') {
        $this->app->register('Hesto\MultiAuth\MultiAuthServiceProvider');
    }
}

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        $categoriesProduct = CategoryProduct::all();
        $aboutUs =  $aboutUs = Section::Where('type','about')->first();

        View::share('categoriesProduct',$categoriesProduct);
        View::share('aboutUs',$aboutUs);

    }
}

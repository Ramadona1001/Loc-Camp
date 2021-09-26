<?php

namespace App\Providers;

use Areas\Models\Area;
use Banners\Models\Banners;
use Blogs\Models\Blog;
use Categories\Models\Category;
use Developers\Models\Developer;
use Feedback\Models\Feedback;
use Gallery\Models\Gallery;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use MainSettings\Models\MainSetting;
use Menus\Models\Menu;
use Pages\Models\Page;
use Projects\Models\Project;
use Properties\Models\Properties;
use PropertyType\Models\PropertyType;
use Services\Models\Service;
use View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }
}

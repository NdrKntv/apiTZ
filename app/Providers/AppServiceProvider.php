<?php

namespace App\Providers;

use App\Http\Services\ImageServices\Compression\ImageCompressionInterface;
use App\Http\Services\ImageServices\Compression\Tinypng;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ImageCompressionInterface::class, Tinypng::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Model::unguard();
    }
}

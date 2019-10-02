<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Carbon;

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
      config(['app.locale' => 'id_ID.UTF-8']);
      setLocale(LC_ALL, 'id_ID.UTF-8');
      Carbon::setLocale('id_ID.UTF-8');
      date_default_timezone_set('Asia/Jakarta');
        // if(config('app.env') === 'production') {
        //     \URL::forceScheme('https');
        // }
    }
}

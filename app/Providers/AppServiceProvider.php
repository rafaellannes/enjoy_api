<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;

use App\Pagination\CustomPaginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\Pagination\LengthAwarePaginator as LengthAwarePaginatorContract;

use App\Models\{
    Historico,
    Favorito,
};
use App\Observers\{
    HistoricoObserver,
    FavoritoObserver
};


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->alias(CustomPaginator::class, LengthAwarePaginator::class);
        $this->app->alias(CustomPaginator::class, LengthAwarePaginatorContract::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Historico::observe(HistoricoObserver::class);
        Favorito::observe(FavoritoObserver::class);
    }
}

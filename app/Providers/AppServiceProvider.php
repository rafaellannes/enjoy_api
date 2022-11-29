<?php

namespace App\Providers;

use App\Models\Favorito;
use Illuminate\Support\ServiceProvider;

use App\Pagination\CustomPaginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\Pagination\LengthAwarePaginator as LengthAwarePaginatorContract;

use App\Models\Historico;
use App\Observers\FavoritoObserver;
use App\Observers\HistoricoObserver;

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

<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Traduz os nomes do verbos para pt-BR
        Route::resourceVerbs([
            'create' => 'novo',
            'edit' => 'editar',
            'store' => 'salvar',
            'update' => 'salvar',
            'show' => 'exibir',
            'destroy' => 'excluir',
        ]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

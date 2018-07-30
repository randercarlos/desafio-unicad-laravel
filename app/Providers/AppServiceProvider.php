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
        
        
        // traduz as data do Carbon automaticamente para pt-BR
        \Carbon\Carbon::setLocale($this->app->getLocale());
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

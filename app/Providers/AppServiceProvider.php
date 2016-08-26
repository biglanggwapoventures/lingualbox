<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Form;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Form::component('bsText', 'components.form.text', ['name', 'value' => null, 'label', 'attributes' => []]);
        Form::component('bsPassword', 'components.form.password', ['name', 'label', 'attributes' => []]);
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

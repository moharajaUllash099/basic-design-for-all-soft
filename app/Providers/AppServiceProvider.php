<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Blade::component('compo.alerts', 'alert');
        /*panels*/
        Blade::component('compo.panel.default', 'panelDefault');
        Blade::component('compo.panel.primary', 'panelPrimary');
        Blade::component('compo.panel.info', 'panelInfo');
        Blade::component('compo.panel.success', 'panelSuccess');
        Blade::component('compo.panel.warning', 'panelWarning');
        Blade::component('compo.panel.danger', 'panelDanger');
        /*form_open*/
        Blade::component('compo.forms.form_open', 'form_open');
        Blade::component('compo.forms.form_open_upload', 'form_upload');
        /*debug*/
        Blade::component('compo.debug', 'd');
        /*tabs*/
        Blade::component('compo.tabs.tabs','tabs');
        /*modal*/
        Blade::component('compo.modal.modalY','modalY');
        Blade::component('compo.modal.modalblanky','modalblanky');
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

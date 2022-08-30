<?php

namespace Edwardyoug\DictionaryPassValidation;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class PassValidationProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->mergeConfigFrom(__DIR__. '/config/nondict.php', 'nondict');

        Validator::extend('non_dict', function ($attribute, $value){
            $dict = file(base_path(\Illuminate\Support\Facades\Config::get('nondict.file')));
            $dict = array_map('trim', $dict);

            return !in_array($value, $dict);
        });
    }
}

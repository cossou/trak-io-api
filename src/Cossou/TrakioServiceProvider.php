<?php 

namespace Cossou\TrakioApiClient\Client;

use Illuminate\Support\ServiceProvider;

class TrakioServiceProvider extends ServiceProvider {

    public function boot()
    {
        $this->package('cossou/trakioapiclient', 'cossou/trakioapiclient', __DIR__.'/../');
    }

    public function register()
    {
        $this->app['trakio'] = $this->app->share(function($app)
        {
            $config = $app['config']['cossou/trakioapiclient'];

            return new TrakioClient::factory($config);
        });
    }

    public function provides()
    {
        return array('trakio');
    }

}
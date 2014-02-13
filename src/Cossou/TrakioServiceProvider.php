<?php 

namespace Cossou;

use Illuminate\Support\ServiceProvider;

class TrakioServiceProvider extends ServiceProvider {

    public function boot()
    {
        $this->package('cossou/trak-io-api-client', 'cossou/trak-io-api-client', __DIR__.'/../');
    }

    public function register()
    {
        $this->app['trakio'] = $this->app->share(function($app)
        {
            $token = $app['config']['cossou/trak-io-api-client::token'];

            $client = new Trakio;

            return $client::factory(array('token' => $token));
        });
    }

    public function provides()
    {
        return array('trakio');
    }

}
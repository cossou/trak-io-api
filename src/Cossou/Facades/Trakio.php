<?php 

namespace Cossou\Facades;

use Illuminate\Support\Facades\Facade;

class Trakio extends Facade {

    protected static function getFacadeAccessor()
    {
        return 'trakio';
    }

}
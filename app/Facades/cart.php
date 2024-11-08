<?php


namespace App\Facades;

use Illuminate\Support\Facades\Facade;


class cart extends Facade{
    public static function getFacadeAccessor(){
        return 'cart';
    }
}

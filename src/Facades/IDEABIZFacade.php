<?php
/**
 * Created by PhpStorm.
 * User: Dasun Dissanayake
 * Date: 2018-10-28
 * Time: 12:35 PM
 */

namespace Dasun4u\LaravelIDEABIZHandler\Facades;

use \Illuminate\Support\Facades\Facade;

class IDEABIZFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'ideabiz';
    }
}
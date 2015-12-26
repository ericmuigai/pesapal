<?php namespace Ericmuigai\Pesapal\Facades;
use Illuminate\Support\Facades\Facade;
/**
 * Created by PhpStorm.
 * User: eric
 * Date: 6/13/14
 * Time: 12:42 AM
 */


class Pesapal extends Facade {
    protected static function getFacadeAccessor() { return 'pesapal'; }
} 
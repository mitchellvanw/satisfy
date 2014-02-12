<?php namespace Mitch\Satisfy\Drivers;

use Mitch\Satisfy\Guzzle;
use Mitch\Satisfy\Redirectors\NativeRedirector;

class DriverFactory
{
    public static function make($driver, $redirector = null, $config = [], $scopes = [], $headers = [])
    {
        $redirector = $redirector ?: new NativeRedirector;
        $class = static::getDriverClass($driver);
        return new $class(new Guzzle, $redirector, $config, $scopes, $headers);
    }

    private static function getDriverClass($driver)
    {
        $name = ucfirst($driver).'Driver';
        $class = "Mitch\\Satisfy\\Drivers\\$name";
        if ( ! class_exists($class)) return null;
        return $class;
    }
}
<?php

namespace ODC\Factory;

class Strategy
{
    protected static $instance;

    protected function __construct() {}

    protected function __clone() {}

    public function create($name)
    {
        $name = ucfirst($name);
        $reflectionClass = new \ReflectionClass("ODC\\Strategy\\{$name}");

        return $reflectionClass->newInstance();
    }

    public static function instance()
    {
        if(!self::$instance){
            self::$instance = new Self();
        }

        return self::$instance;
    }
}

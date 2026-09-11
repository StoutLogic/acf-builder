<?php

namespace StoutLogic\AcfBuilder\Tests;

class TestUtils
{
    public static function callMethod($obj, $name, array $args) {
        $class = new \ReflectionClass($obj);
        $method = $class->getMethod($name);
        return $method->invokeArgs($obj, $args);
    }
}

<?php

namespace StoutLogic\AcfBuilder\Traits;

trait CanSingularize
{
    /**
     * Inflector reused for every field, building one is expensive.
     * @var \Doctrine\Inflector\Inflector|null
     */
    private static $inflector;

    /**
     * Return a singularized string.
     * @param  string $value
     * @return string
     */
    protected function singularize($value)
    {
        if (class_exists('\Doctrine\Inflector\InflectorFactory')) {
            self::$inflector ??= \Doctrine\Inflector\InflectorFactory::create()->build();

            return self::$inflector->singularize($value);
        }

        return \Doctrine\Common\Inflector\Inflector::singularize($value);
    }
}

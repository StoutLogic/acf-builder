<?php

namespace StoutLogic\AcfBuilder\Traits;

trait CanSingularize
{
    /**
     * Return a singularized string.
     * @param  string $value
     * @return string
     */
    protected function singularize($value)
    {
        if (class_exists('\Doctrine\Inflector\InflectorFactory')) {
            // Building the inflector is costly, share one instance across all users of the trait.
            static $inflector = null;
            $inflector ??= \Doctrine\Inflector\InflectorFactory::create()->build();

            return $inflector->singularize($value);
        }

        return \Doctrine\Common\Inflector\Inflector::singularize($value);
    }
}

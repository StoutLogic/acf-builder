<?php

namespace StoutLogic\AcfBuilder\Transform;

/**
 * Transform applies to all leafs in array, at specific keys
 * using array_walk_recursive
 */
abstract class RecursiveTransform extends Transform
{
    /**
     * Define a list of array keys `transformValue` should apply to.
     * @var array
     */
    protected $keys = [];

    /**
     * @return array
     */
    public function getKeys()
    {
        return $this->keys;
    }

    /**
     * Apply the `transformValue` function to all leafs at the defined keys.
     * @param  array $config
     * @return array transformed config
     */
    public function transform($config)
    {
        array_walk_recursive($config, function(&$value, $key) {
            if (in_array($key, $this->getKeys())) {
                $value = $this->transformValue($value);
            }
        });

        return $config;
    }

    /**
     * Impelment this in all discrete classes
     * @param  mixed $value input
     * @return mixed output value
     */
    abstract public function transformValue($value);
}

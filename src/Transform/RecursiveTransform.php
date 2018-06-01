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
     * Apply the `transformValue` function to all values in multidementional
     * associative array where the key matches one of the keys defined
     * on the RecursiveTransform.
     * @param  array $config
     * @return array transformed config
     */
    public function transform($config)
    {
        foreach ($config as $key => $value ) {
            if ($this->shouldTransformValue($key, $config)) {
                $config = $this->transformConfig($config);
                $config[$key] = $this->transformValue($value);
            } else {
                if ($this->shouldRecurse($value, $key)) {
                    $config[$key] = $this->transform($value);
                }
            }
        }

        return $config;
    }


    /**
     * @param string $key
     * @param array $config
     * @return bool
     */
    public function shouldTransformValue($key, $config)
    {
        return in_array($key, $this->getKeys(), true);
    }

    /**
     * Based upon the value or key, determine if the transform function
     * should recurse.
     * @param $value
     * @param string $key
     * @return bool
     */
    protected function shouldRecurse($value, $key)
    {
        return is_array($value);
    }

    /**
     * Impelment this in all discrete classes
     * @param  mixed $value input
     * @return mixed output value
     */
    abstract public function transformValue($value);


    /**
     * @param array $config
     * @return array
     */
    public function transformConfig($config)
    {
        return $config;
    }
}

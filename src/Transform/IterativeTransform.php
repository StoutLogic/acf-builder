<?php

namespace StoutLogic\AcfBuilder\Transform;

/**
 * Transform applies to all leafs in array at a single field level,
 * it doesn't recurse down fields, sub_fields or layouts.
 */
abstract class IterativeTransform extends RecursiveTransform
{
    /**
     * Define a list of array keys `transform` should not be recursed upon.
     * @var array
     */
   protected $dontRecurseKeys = ['fields', 'sub_fields', 'layouts'];

    /**
     * Apply the `transformValue` function to all values in multidementional
     * associative array where the key matches one of the keys defined
     * on the IterativeTransform.
     * @param  array $config
     * @return array transformed config
     */
    public function transform($config)
    {
        array_walk($config, function (&$value, $key) {
            if (in_array($key, $this->getKeys(), true)) {
                $value = $this->transformValue($value);
            } else {
                if (is_array($value) && !in_array($key, $this->getDontRecurseKeys(), true)) {
                    $value = $this->transform($value);
                }
            }
        });

        return $config;
    }

    public function getDontRecurseKeys()
    {
        return $this->dontRecurseKeys;
    }
}

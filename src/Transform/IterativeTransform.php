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

    protected function shouldRecurse($value, $key)
    {
        return is_array($value) && !in_array($key, $this->dontRecurseKeys, true);
    }
}

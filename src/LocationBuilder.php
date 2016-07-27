<?php

namespace StoutLogic\AcfBuilder;

/**
 * Build field group location configuration
 */
class LocationBuilder extends ConditionalBuilder
{
    /**
     * Create a location condition
     * @param  string $name
     * @param  string $operator
     * @param  string $value
     * @return array
     */
    protected function createCondition($name, $operator, $value)
    {
        return [
            'param' => $name,
            'operator' => $operator,
            'value' => $value,
        ];
    }
}

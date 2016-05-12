<?php

namespace StoutLogic\AcfBuilder;

class LocationBuilder extends ConditionalBuilder
{
    protected function createCondition($name, $operator, $value)
    {
        return [
            'param' => $name,
            'operator' => $operator,
            'value' => $value,
        ];
    }
}

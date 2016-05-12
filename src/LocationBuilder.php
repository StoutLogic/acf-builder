<?php

namespace Understory\Fields;

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

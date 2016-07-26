<?php

namespace StoutLogic\AcfBuilder\Transform;

/**
 * Replace the field name in the 'field' key, with the key of the
 * actual field as defined by the Builder.
 */
class ConditionalField extends RecursiveTransform
{
    protected $keys = ['field'];

    public function transformValue($value)
    {
        $field = $this->getBuilder()->getField($value);
        return $field['key'];
    }
}

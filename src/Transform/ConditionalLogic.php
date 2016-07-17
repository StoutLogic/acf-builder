<?php

namespace StoutLogic\AcfBuilder\Transform;

use StoutLogic\AcfBuilder\ConditionalBuilder;

/**
 * Applies the ConditionalField Transform to the conditional_logic value
 * of each field, in the field group config.
 */
class ConditionalLogic extends RecursiveTransform
{
    protected $keys = ['conditional_logic'];

    /**
     * Replace field values of a ConditionalBuilder with the proper keys using
     * the ConditionalField Transform.
     *
     * @param  ConditionalBuilder $value
     * @return array Transformed config array
     */
    public function transformValue($value)
    {
        $conditionalFieldTransform = new ConditionalField($this->getBuilder());
        return $conditionalFieldTransform->transform($value->build());
    }
}

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
     * @param \StoutLogic\AcfBuilder\FieldsBuilder $builder
     */
    public function __construct(\StoutLogic\AcfBuilder\FieldsBuilder $builder)
    {
        parent::__construct($builder);
    }

    /**
     * @return \StoutLogic\AcfBuilder\FieldsBuilder
     */
    public function getBuilder()
    {
        return parent::getBuilder();
    }

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

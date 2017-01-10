<?php

namespace StoutLogic\AcfBuilder\Transform;

use StoutLogic\AcfBuilder\ConditionalBuilder;

/**
 * Applies the ConditionalField Transform to the conditional_logic value
 * of each field, in the field group config.
 */
class ConditionalLogic extends IterativeTransform
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

    public function transform($config)
    {
        return parent::transform($config);
    }

    /**
     * Replace field values of a ConditionalBuilder with the proper keys using
     * the ConditionalField Transform.
     *
     * @param  array $value
     * @return array Transformed config array
     */
    public function transformValue($value)
    {
        $conditionalFieldTransform = new ConditionalField($this->getBuilder());
        return $conditionalFieldTransform->transform($value);
    }
}

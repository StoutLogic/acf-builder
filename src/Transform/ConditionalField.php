<?php

namespace StoutLogic\AcfBuilder\Transform;

/**
 * Replace the field name in the 'field' key, with the key of the
 * actual field as defined by the Builder.
 */
class ConditionalField extends RecursiveTransform
{
    protected $keys = ['field'];

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

    public function transformValue($value)
    {
        return $this->getBuilder()->getField($value)->getKey();
    }
}

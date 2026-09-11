<?php

namespace StoutLogic\AcfBuilder\Transform;

use StoutLogic\AcfBuilder\FieldsBuilder;

/**
 * Replace the field name in the 'field' key, with the key of the
 * actual field as defined by the Builder.
 */
class ConditionalField extends RecursiveTransform
{
    /**
     * @var array
     */
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

    /**
     * Replace a field name with its key if the field exists.
     *
     * @param mixed $value
     * @return mixed
     */
    public function transformValue($value)
    {
        if ($this->getBuilder()->fieldExists($value)) {
            return $this->getBuilder()->getField($value)->getKey();
        }

        return $value;
    }

    /**
     * Flag the config as having a custom key, or as referencing a field
     * that doesn't exist yet.
     *
     * @param array $config
     * @return array
     */
    public function transformConfig($config)
    {
        if ($this->getBuilder()->fieldExists($config['field']) && $this->getBuilder()->getField($config['field'])->hasCustomKey()) {
            $config['_has_custom_key'] = true;
        } elseif (!$this->getBuilder()->fieldExists($config['field'])) {
            $config['_field_does_not_exist'] = $config['field'];
        }

        return $config;
    }

    /**
     * Determine whether the given key/config pair should be transformed.
     *
     * @param string $key
     * @param array  $config
     * @return bool
     */
    public function shouldTransformValue($key, $config)
    {
        return parent::shouldTransformValue($key, $config) && !(array_key_exists('_has_custom_key', $config) && $config['_has_custom_key'] === true);
    }
}

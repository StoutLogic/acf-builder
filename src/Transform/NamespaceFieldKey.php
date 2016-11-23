<?php

namespace StoutLogic\AcfBuilder\Transform;

/**
 * Namespace a field key by appending the namespace consisting of 'field'
 * and the Builder's name before the defined key.
 *
 * Ensure all lowercase.
 */
class NamespaceFieldKey extends RecursiveTransform
{
    protected $keys = ['key', 'field', 'collapsed'];

    /**
     * @param \StoutLogic\AcfBuilder\NamedBuilder $builder
     */
    public function __construct(\StoutLogic\AcfBuilder\NamedBuilder $builder)
    {
        parent::__construct($builder);
    }

    /**
     * @return \StoutLogic\AcfBuilder\NamedBuilder
     */
    public function getBuilder()
    {
        return parent::getBuilder();
    }

    /**
     * @param  string $value Key
     * @return string Namedspaced key
     */
    public function transformValue($value)
    {
        $namespace = 'field_';
        $groupName = $this->getBuilder()->getName();

        if ($groupName) {
            // remove field_ or group_ if already at the begining of the key
            $value = preg_replace('/^field_|^group_/', '', $value);
            $namespace .= str_replace(' ', '_', $groupName).'_';
        }
        return strtolower($namespace.$value);
    }
}

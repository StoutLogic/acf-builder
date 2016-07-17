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
    protected $keys = ['key', 'field'];

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

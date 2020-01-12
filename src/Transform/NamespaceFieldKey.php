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

    public function transform($config)
    {
        $config = parent::transform($config);

        $config = $this->secondTransformPass($config, $config);

        return $config;
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

    public function shouldTransformValue($key, $config)
    {
        if ($key === 'field' && array_key_exists('_field_does_not_exist', $config)) {
            return false;
        }

        return parent::shouldTransformValue($key, $config) && !$this->hasCustomKey($key, $config) && !$this->hasCustomCollapsedKey($key, $config);
    }

    /**
     * @param $config
     * @return bool
     */
    private function hasCustomKey($key, $config)
    {
        return ($key !== 'collapsed' && array_key_exists('_has_custom_key', $config) && $config['_has_custom_key'] === true);
    }

    /**
     * @param $config
     * @return bool
     */
    private function hasCustomCollapsedKey($key, $config)
    {
        return ($key === 'collapsed' && array_key_exists('_has_custom_collapsed_key', $config) && $config['_has_custom_collapsed_key'] === true);
    }

    private function secondTransformPass(array $config, array $parentConfig)
    {
        foreach ($config as $key => &$value) {
            if (array_key_exists('_field_does_not_exist', $config)) {
                foreach($parentConfig as $parentField) {
                    if (is_array($parentField) &&
                        array_key_exists('name', $parentField) &&
                        $parentField['name'] === $config['_field_does_not_exist']) {
                        $config['field'] = $parentField['key'];
                    }
                }
            }

            if ($this->shouldRecurse($value, $key)) {
                $value = $this->secondTransformPass($value, $parentConfig);
            }
        }

        return $config;
    }
}

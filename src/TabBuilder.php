<?php

namespace StoutLogic\AcfBuilder;

/**
 * Builds configurations for an ACF Field
 */
class TabBuilder extends FieldBuilder
{
    /**
     * @param string $name Field Name, conventionally 'snake_case'.
     * @param string $type Field Type.
     * @param array $config Additional Field Configuration.
     */
    public function __construct($name, $type = 'tab', $config = [])
    {
        $config = array_merge([
            'label' => $this->generateLabel($name),
        ], $config);
        $name = $this->generateName($name).'_'.$type;

        parent::__construct($name, $type, $config);
    }

    public function endpoint()
    {
        return $this->setConfig('endpoint', 1);
    }

    public function removeEndpoint()
    {
        return $this->setConfig('endpoint', 0);
    }
}

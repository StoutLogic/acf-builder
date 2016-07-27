<?php

namespace StoutLogic\AcfBuilder;

/**
 * Repeater field
 */
class RepeaterBuilder extends FieldsBuilder
{
    /**
     * @param string $name Field name
     * @param array $args Field configuration
     */
    public function __construct($name, $args = [])
    {
        $this->name = $name;
        $this->config = array_merge(
            [
                'key' => $name,
                'name' => $name,
                'label' => $this->generateLabel($name),
                'type' => 'repeater',
            ],
            $args
        );
        $this->fieldManager = new FieldManager();
    }

    /**
     * Return a repeater field configuration array
     * @return array
     */
    public function build()
    {
        $config = parent::build();
        $config['sub_fields'] = $config['fields'];
        unset($config['fields']);
        return $config;
    }

    /**
     * Returns call chain to parentContext
     * @return Builder
     */
    public function endRepeater()
    {
        return $this->getParentContext();
    }
}

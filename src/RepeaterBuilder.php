<?php

namespace StoutLogic\AcfBuilder;

class RepeaterBuilder extends FieldsBuilder
{
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

    public function build()
    {
        $config = parent::build();
        $config['sub_fields'] = $config['fields'];
        unset($config['fields']);
        return $config;
    }

    public function endRepeater()
    {
        return $this->getParentContext();
    }
}

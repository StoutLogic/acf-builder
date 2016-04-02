<?php

namespace Understory\Fields;

class FieldsBuilder
{
    private $config = [];
    private $fields = [];

    public function __construct($name, $groupConfig = [])
    {
       $this->configure($name, $groupConfig);
    }

    public function build()
    {
        return array_merge($this->config, [
            'fields' => $this->fields,        
        ]);
    }

    public function addField($name, $args = [])
    {
        $this->fields[] = array_merge([
            'key' => $name,
            'name' => 'field_'.$name,
            'label' => $this->createLabel($name),
        ], $args);
    }

    public function addTextarea($name)
    {
        $this->addField($name, [
            'type' => 'textarea',
        ]);
    }

    public function addWysiwyg($name)
    {
        $this->addField($name, [
            'type' => 'wysiwyg',
        ]);
    }

    protected function configure($name, $groupConfig = [])
    {
        $config = array_merge([
            'key' => 'group_'.$name,
            'title' => $this->createLabel($name),
        ], $groupConfig);

        $this->config = $config;
    }

    protected function createLabel($name)
    {
        return ucwords(str_replace("_", " ", $name));
    }
}

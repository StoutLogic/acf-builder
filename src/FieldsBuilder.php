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
            'key' => 'field_'.$name,
            'name' => $name,
            'label' => $this->createLabel($name),
        ], $args);

        return $this;
    }

    protected function addFieldType($name, $type, $args = [])
    {
        return $this->addField($name, array_merge([
            'type' => $type,
        ], $args));
    } 

    public function addText($name, $args = [])
    {
        return $this->addFieldType($name, 'text', $args);
    }

    public function addTextarea($name, $args = [])
    {
        return $this->addFieldType($name, 'textarea', $args);
    }

    public function addWysiwyg($name, $args = [])
    {
        return $this->addFieldType($name, 'wysiwyg', $args);
    }

    public function addNumber($name, $args = [])
    {
        return $this->addFieldType($name, 'number', $args);
    }

    public function addEmail($name, $args = [])
    {
        return $this->addFieldType($name, 'email', $args);
    }

    public function addUrl($name, $args = [])
    {
        return $this->addFieldType($name, 'url', $args);
    }

    public function addPassword($name, $args = [])
    {
        return $this->addFieldType($name, 'password', $args);
    }

    protected function configure($name, $groupConfig = [])
    {
        $config = array_merge([
            'key' => 'group_'.$name,
            'title' => $this->createLabel($name),
        ], $groupConfig);

        $this->config = $config;

        return $this;
    }

    protected function createLabel($name)
    {
        return ucwords(str_replace("_", " ", $name));
    }
}

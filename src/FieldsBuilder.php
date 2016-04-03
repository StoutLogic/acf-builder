<?php

namespace Understory\Fields;

class FieldsBuilder
{
    private $config = [];
    private $fields = [];

    public function __construct($name, $groupConfig = [])
    {
       $this->setGroupConfig($name, $groupConfig);
    }

    public function setGroupConfig($name, $groupConfig = [])
    {
        $this->config = array_merge(
            $this->config, 
            [
                'key' => 'group_'.$name,
                'title' => $this->generateLabel($name),
            ], 
            $groupConfig
        );

        return $this;
    }

    public function build()
    {
        return array_merge($this->config, [
            'fields' => $this->fields,        
        ]);
    }

    public function addField($name, $args = [])
    {
        $field = array_merge([
            'key' => 'field_'.$name,
            'name' => $name,
            'label' => $this->generateLabel($name),
        ], $args);

        $this->pushField($field);

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

    public function addWysiwyg($name, $args = [])
    {
        return $this->addFieldType($name, 'wysiwyg', $args);
    }

    public function addOembed($name, $args = [])
    {
        return $this->addFieldType($name, 'oembed', $args);
    }

    public function addImage($name, $args = [])
    {
        return $this->addFieldType($name, 'image', $args);
    }

    public function addFile($name, $args = [])
    {
        return $this->addFieldType($name, 'file', $args);
    }

    public function addGallery($name, $args = [])
    {
        return $this->addFieldType($name, 'gallery', $args);
    }

    public function addTrueFalse($name, $args = [])
    {
        return $this->addFieldType($name, 'true_false', $args);
    }

    public function addSelect($name, $args = [])
    {
        return $this->addFieldType($name, 'select', $args);
    }

    public function addRadio($name, $args = [])
    {
        return $this->addFieldType($name, 'radio', $args);
    }

    public function addCheckbox($name, $args = [])
    {
        return $this->addFieldType($name, 'checkbox', $args);
    }

    public function addPostObject($name, $args = [])
    {
        return $this->addFieldType($name, 'post_object', $args);
    }

    public function addPostLink($name, $args = [])
    {
        return $this->addFieldType($name, 'post_link', $args);
    }

    public function addRelationship($name, $args = [])
    {
        return $this->addFieldType($name, 'relationship', $args);
    }

    public function addTaxonomy($name, $args = [])
    {
        return $this->addFieldType($name, 'taxonomy', $args);
    }

    public function addUser($name, $args = [])
    {
        return $this->addFieldType($name, 'user', $args);
    }

    public function addDatePicker($name, $args = [])
    {
        return $this->addFieldType($name, 'date_picker', $args);
    }

    public function addColorPicker($name, $args = [])
    {
        return $this->addFieldType($name, 'color_picker', $args);
    }

    public function addTab($label, $args = [])
    {
        $name = $this->generateName($label).'_tab';
        $args = array_merge([
            'label' => $label,
        ], $args);

        return $this->addFieldType($name, 'tab', $args);
    }

    public function endpoint($value = 1)
    {
        return $this->setConfig('endpoint', $value);
    }

    public function addMessage($label, $message, $args = [])
    {
        $name = $this->generateName($label).'_message';
        $args = array_merge([
            'label' => $label,
            'message' => $message,
        ], $args);

        return $this->addFieldType($name, 'message', $args);
    }

    public function addChoice($choice, $label = null)
    {
        $field = $this->popLastField();

        array_key_exists('choices', $field) ?: $field['choices'] = [];
        $label ?: $label = $choice;

        $field['choices'][$choice] = $label;
        $this->pushField($field);

        return $this;
    }

    public function default($value)
    {
        return $this->setConfig('default_value', $value);
    }

    public function required($value = true)
    {
        return $this->setConfig('required', $value ? 1 : 0);
    }

    public function instructions($value)
    {
        return $this->setConfig('instructions', $value);
    }

    public function setConfig($key, $value)
    {
        $field = $this->popLastField();
        $field[$key] = $value;
        $this->pushField($field);

        return $this;
    }

    protected function popLastField()
    {
        return array_pop($this->fields);
    }

    protected function pushField($field)
    {
        $this->fields[] = $field;
    }

    protected function generateLabel($name)
    {
        return ucwords(str_replace("_", " ", $name));
    }

    protected function generateName($name)
    {
        return strtolower(str_replace(" ", "_", $name));
    }
}

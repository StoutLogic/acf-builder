<?php

namespace StoutLogic\AcfBuilder;

class FieldsBuilder extends Builder
{
    protected $config = [];
    protected $fields = [];
    protected $location = null;
    protected $name;

    public function __construct($name, $groupConfig = [])
    {
        $this->name = $name;
        $this->setGroupConfig('key', 'group_'.$name);
        $this->setGroupConfig('title', $this->generateLabel($name));

        $this->config = array_merge($this->config, $groupConfig);
    }

    public function setGroupConfig($key, $value)
    {
        $this->config[$key] = $value;

        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    /**
     * Build the final config array. Build any other builders that may exist
     * in the config.
     * @return array    final field config
     */
    public function build()
    {
        $fields = $this->getFields();

        $fields = $this->buildFields($fields);

        array_walk_recursive($fields, function(&$value, $key) {

            switch ($key) {
                case 'conditional_logic':
                    $value = $value->build();
                    $value = $this->transformConditionalConfig($value);
                    break;
            }
        });

        $location = $this->getLocation();
        if (is_subclass_of($location, Builder::class)) {
            $location = $location->build();
        }

        return array_merge($this->config, [
            'fields' => $fields,
            'location' => $location,
        ]);
    }

    private function buildFields($fields)
    {
        $builtFields = [];

        foreach ($fields as $i => $field) {
            if (is_subclass_of($field, Builder::class)) {
                $builtFields[] = $field->build();
            } else {
                $builtFields[] = $field;
            }
        }

        return $builtFields;
    }

    /**
     * Replace field values with the field's respective key
     * @param  array $config
     * @return array
     */
    protected function transformConditionalConfig($config)
    {
        // Replace field name with the field's key, default: field_$name
        array_walk_recursive($config, function(&$value, $key) {
            switch ($key) {
                case 'field':
                    if ($field = $this->getFieldByName($value)) {
                        $value = $field['key'];
                    } else {
                        $value = 'field_'.$value;
                    }
                    break;
            }
        });

        return $config;
    }

    /**
     * Add multiple fields either via an array or from another builder
     * @param mixed $fields array of fields or a FieldBuilder
     */
    public function addFields($fields)
    {
        if (is_a($fields, FieldsBuilder::class)) {
            $fields = clone $fields;
            foreach ($fields->getFields() as $field) {
                $this->pushField($field);
            }
        } else {
            foreach ($fields as $field) {
                $this->pushField($field);
            }
        }

        return $this;
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

    public function addTimePicker($name, $args = [])
    {
        return $this->addFieldType($name, 'time_picker', $args);
    }

    public function addDateTimePicker($name, $args = [])
    {
        return $this->addFieldType($name, 'date_time_picker', $args);
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

    public function addRepeater($name, $args = [])
    {
        $repeaterBuilder = new RepeaterBuilder($name, $args);
        $repeaterBuilder->setParentContext($this);
        $this->pushField($repeaterBuilder);

        return $repeaterBuilder;
    }

    public function addFlexibleContent($name, $args = [])
    {
        $flexibleContentBuilder = new FlexibleContentBuilder($name, $args);
        $flexibleContentBuilder->setParentContext($this);
        $this->pushField($flexibleContentBuilder);

        return $flexibleContentBuilder;
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

    public function addChoices()
    {
        foreach (func_get_args() as $choice) {
            if (is_array($choice)) {
                $values = each($choice);
                $this->addChoice($values['key'], $values['value']);
            } else {
                $this->addChoice($choice);
            }
        }

        return $this;
    }

    public function conditional($name, $operator, $value)
    {
        $field = $this->popLastField();
        $conditionalBuilder = new ConditionalBuilder($name, $operator, $value);
        $conditionalBuilder->setParentContext($this);

        $field['conditional_logic'] = $conditionalBuilder;
        $this->pushField($field);

        return $conditionalBuilder;
    }

    public function getFields()
    {
        return $this->fields;
    }

    protected function getFieldByName($name)
    {
        foreach ($this->fields as $field) {
            if ($field['name'] === $name) {
                return $field;
            }
        }

        return false;
    }

    public function defaultValue($value)
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

    public function setLocation($param, $operator, $value)
    {
        if ($this->getParentContext()) {
            return $this->getParentContext()->setLocation($param, $operator, $value);
        }

        $this->location = new LocationBuilder($param, $operator, $value);
        $this->location->setParentContext($this);

        return $this->location;
    }

    public function getLocation()
    {
        return $this->location;
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

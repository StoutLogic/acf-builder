<?php

namespace StoutLogic\AcfBuilder;

class FieldsBuilder extends Builder implements NamedBuilder
{
    protected $config = [];
    protected $fieldManager;
    protected $location = null;
    protected $name;

    public function __construct($name, $groupConfig = [])
    {
        $this->fieldManager = new FieldManager();
        $this->name = $name;
        $this->setGroupConfig('key', $name);
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
     * Namespace a group key
     * Append the namespace 'group' before the set key.
     *
     * @param  string $key Field Key
     * @return string      Field Key
     */
    private function namespaceGroupKey($key)
    {
        if (strpos($key, 'group_') !== 0) {
            $key = 'group_'.$key;
        }
        return $key;
    }

    /**
     * Build the final config array. Build any other builders that may exist
     * in the config.
     * @return array    final field config
     */
    public function build()
    {
        return array_merge($this->config, [
            'fields' => $this->buildFields(),
            'location' => $this->buildLocation(),
            'key' => $this->namespaceGroupKey($this->config['key']),
        ]);
    }

    private function buildFields()
    {
        $fields = array_map(function($field) {
            return ($field instanceof Builder) ? $field->build() : $field;
        }, $this->getFields());

        return $this->transformFields($fields);
    }

    private function transformFields($fields)
    {
        $conditionalTransform = new Transform\ConditionalLogic($this);
        $namespaceFieldKeyTransform = new Transform\NamespaceFieldKey($this);

        return
            $namespaceFieldKeyTransform->transform(
                $conditionalTransform->transform($fields)
            );
    }

    private function buildLocation()
    {
        $location = $this->getLocation();
        return ($location instanceof Builder) ? $location->build() : $location;
    }

    /**
     * Add multiple fields either via an array or from another builder
     * @param mixed $fields array of fields or a FieldBuilder
     */
    public function addFields($fields)
    {
        if ($fields instanceof FieldsBuilder) {
            $builder = clone $fields;
            $fields = $builder->getFields();
        }

        foreach ($fields as $field) {
            $this->getFieldManager()->pushField($field);
        }

        return $this;
    }

    /**
     * Add field to field group
     * @param string $name field name
     * @param array $args field options
     *
     * @throws FieldNameCollisionException if name already exists.
     *
     * @return $this
     */
    public function addField($name, $args = [])
    {
        $field = array_merge([
            'key' => $name,
            'name' => $name,
            'label' => $this->generateLabel($name),
        ], $args);

        $this->getFieldManager()->pushField($field);
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
        $this->getFieldManager()->pushField($repeaterBuilder);

        return $repeaterBuilder;
    }

    public function addFlexibleContent($name, $args = [])
    {
        $flexibleContentBuilder = new FlexibleContentBuilder($name, $args);
        $flexibleContentBuilder->setParentContext($this);
        $this->getFieldManager()->pushField($flexibleContentBuilder);

        return $flexibleContentBuilder;
    }

    public function addChoice($choice, $label = null)
    {
        $field = $this->getFieldManager()->popField();

        array_key_exists('choices', $field) ?: $field['choices'] = [];
        $label ?: $label = $choice;

        $field['choices'][$choice] = $label;
        $this->getFieldManager()->pushField($field);

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
        $field = $this->getFieldManager()->popField();
        $conditionalBuilder = new ConditionalBuilder($name, $operator, $value);
        $conditionalBuilder->setParentContext($this);

        $field['conditional_logic'] = $conditionalBuilder;
        $this->getFieldManager()->pushField($field);

        return $conditionalBuilder;
    }

    protected function getFieldManager()
    {
        return $this->fieldManager;
    }

    public function getFields()
    {
        return $this->getFieldManager()->getFields();
    }

    protected function getFieldIndex($name)
    {
        return $this->getFieldManager()->getFieldIndex($name);
    }
    
    public function getField($name)
    {
        return $this->getFieldManager()->getField($name);
    }

    /**
     * Modify an already defined field
     * @param  string $name   Name of the field
     * @param  mixed  $modify Array of field configs or a closure that accepts
     *                        a FieldsBuilder and returns a FieldsBuilder.
     *
     * @throws ModifyFieldReturnTypeException if $modify is a closure and doesn't
     *                                        return a FieldsBuilder.
     * @throws FieldNotFoundException if the field name doesn't exist.
     *
     * @return FieldsBuilder  $this
     */
    public function modifyField($name, $modify)
    {
        if (is_array($modify)) {
            $this->getFieldManager()->modifyField($name, $modify);
        } else if ($modify instanceof \Closure) {
            $field = $this->getField($name);
            $index = $this->getFieldIndex($name);

            // Initialize Modifying FieldsBuilder
            $modifyBuilder = new FieldsBuilder('');
            $modifyBuilder->addFields([$field]);

            // Modify Field
            $modifyBuilder = $modify($modifyBuilder);

            // Check if a FieldsBuilder is returned
            if (!$modifyBuilder instanceof FieldsBuilder) {
                throw new ModifyFieldReturnTypeException(gettype($modifyBuilder));
            }

            // Build Modifcations
            $modifyConfig = $modifyBuilder->build();

            // Insert field(s)
            $this->getFieldManager()->replaceField($name, $modifyConfig['fields']);
        }

        return $this;
    }

    /**
     * Remove a field by name
     * @param  string $name Field to remove
     *
     * @return FieldsBuilder  $this
     */
    public function removeField($name)
    {
        $this->getFieldManager()->removeField($name);

        return $this;
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
        $field = $this->getFieldManager()->popField();
        $field[$key] = $value;
        $this->getFieldManager()->pushField($field);

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

    protected function generateLabel($name)
    {
        return ucwords(str_replace("_", " ", $name));
    }

    protected function generateName($name)
    {
        return strtolower(str_replace(" ", "_", $name));
    }
}

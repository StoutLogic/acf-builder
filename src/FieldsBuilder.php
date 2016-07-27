<?php

namespace StoutLogic\AcfBuilder;

/**
 * Builds configurations for ACF Field Groups
 */
class FieldsBuilder extends ParentDelegationBuilder implements NamedBuilder
{
    /**
     * Field Group Configuration
     * @var array
     */
    protected $config = [];

    /**
     * Manages the Field Configurations
     * @var FieldManager
     */
    protected $fieldManager;

    /**
     * Location configuration for Field Group
     * @var LocationBuilder
     */
    protected $location = null;

    /**
     * Field Group Name
     * @var string
     */
    protected $name;

    /**
     * @param string $name Field Group name
     * @param array $groupConfig Field Group configuration
     */
    public function __construct($name, $groupConfig = [])
    {
        $this->fieldManager = new FieldManager();
        $this->name = $name;
        $this->setGroupConfig('key', $name);
        $this->setGroupConfig('title', $this->generateLabel($name));

        $this->config = array_merge($this->config, $groupConfig);
    }

    /**
     * Set a value for a particular key in the group config
     * @param string $key
     * @param mixed $value
     */
    public function setGroupConfig($key, $value)
    {
        $this->config[$key] = $value;

        return $this;
    }

    /**
     * @return string
     */
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
     * @return array Final field config
     */
    public function build()
    {
        return array_merge($this->config, [
            'fields' => $this->buildFields(),
            'location' => $this->buildLocation(),
            'key' => $this->namespaceGroupKey($this->config['key']),
        ]);
    }

    /**
     * Return a fields config array
     * @return array
     */
    private function buildFields()
    {
        $fields = array_map(function ($field) {
            return ($field instanceof Builder) ? $field->build() : $field;
        }, $this->getFields());

        return $this->transformFields($fields);
    }

    /**
     * Apply field transforms
     * @param  array $fields
     * @return array Transformed fields config
     */
    private function transformFields($fields)
    {
        $conditionalTransform = new Transform\ConditionalLogic($this);
        $namespaceFieldKeyTransform = new Transform\NamespaceFieldKey($this);

        return
            $namespaceFieldKeyTransform->transform(
                $conditionalTransform->transform($fields)
            );
    }

    /**
     * Return a locations config array
     * @return array
     */
    private function buildLocation()
    {
        $location = $this->getLocation();
        return ($location instanceof Builder) ? $location->build() : $location;
    }

    /**
     * Add multiple fields either via an array or from another builder
     * @param mixed $fields array of fields or a FieldBuilder
     * @return $this
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
     * @throws FieldNameCollisionException if name already exists.
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

    /**
     * Add a field of a specific type
     * @param string $name
     * @param string $type
     * @param array $args field configuration
     * @return $this
     */
    protected function addFieldType($name, $type, $args = [])
    {
        return $this->addField($name, array_merge([
            'type' => $type,
        ], $args));
    }

    /**
     * @param string $name
     * @param array $args field configuration
     * @return $this
     */
    public function addText($name, $args = [])
    {
        return $this->addFieldType($name, 'text', $args);
    }

    /**
     * @param string $name
     * @param array $args field configuration
     * @return $this
     */
    public function addTextarea($name, $args = [])
    {
        return $this->addFieldType($name, 'textarea', $args);
    }

    /**
     * @param string $name
     * @param array $args field configuration
     * @return $this
     */
    public function addNumber($name, $args = [])
    {
        return $this->addFieldType($name, 'number', $args);
    }

    /**
     * @param string $name
     * @param array $args field configuration
     * @return $this
     */
    public function addEmail($name, $args = [])
    {
        return $this->addFieldType($name, 'email', $args);
    }

    /**
     * @param string $name
     * @param array $args field configuration
     * @return $this
     */
    public function addUrl($name, $args = [])
    {
        return $this->addFieldType($name, 'url', $args);
    }

    /**
     * @param string $name
     * @param array $args field configuration
     * @return $this
     */
    public function addPassword($name, $args = [])
    {
        return $this->addFieldType($name, 'password', $args);
    }

    /**
     * @param string $name
     * @param array $args field configuration
     * @return $this
     */
    public function addWysiwyg($name, $args = [])
    {
        return $this->addFieldType($name, 'wysiwyg', $args);
    }

    /**
     * @param string $name
     * @param array $args field configuration
     * @return $this
     */
    public function addOembed($name, $args = [])
    {
        return $this->addFieldType($name, 'oembed', $args);
    }

    /**
     * @param string $name
     * @param array $args field configuration
     * @return $this
     */
    public function addImage($name, $args = [])
    {
        return $this->addFieldType($name, 'image', $args);
    }

    /**
     * @param string $name
     * @param array $args field configuration
     * @return $this
     */
    public function addFile($name, $args = [])
    {
        return $this->addFieldType($name, 'file', $args);
    }

    /**
     * @param string $name
     * @param array $args field configuration
     * @return $this
     */
    public function addGallery($name, $args = [])
    {
        return $this->addFieldType($name, 'gallery', $args);
    }

    /**
     * @param string $name
     * @param array $args field configuration
     * @return $this
     */
    public function addTrueFalse($name, $args = [])
    {
        return $this->addFieldType($name, 'true_false', $args);
    }

    /**
     * @param string $name
     * @param array $args field configuration
     * @return $this
     */
    public function addSelect($name, $args = [])
    {
        return $this->addFieldType($name, 'select', $args);
    }

    /**
     * @param string $name
     * @param array $args field configuration
     * @return $this
     */
    public function addRadio($name, $args = [])
    {
        return $this->addFieldType($name, 'radio', $args);
    }

    /**
     * @param string $name
     * @param array $args field configuration
     * @return $this
     */
    public function addCheckbox($name, $args = [])
    {
        return $this->addFieldType($name, 'checkbox', $args);
    }

    /**
     * @param string $name
     * @param array $args field configuration
     * @return $this
     */
    public function addPostObject($name, $args = [])
    {
        return $this->addFieldType($name, 'post_object', $args);
    }

    /**
     * @param string $name
     * @param array $args field configuration
     * @return $this
     */
    public function addPostLink($name, $args = [])
    {
        return $this->addFieldType($name, 'post_link', $args);
    }

    /**
     * @param string $name
     * @param array $args field configuration
     * @return $this
     */
    public function addRelationship($name, $args = [])
    {
        return $this->addFieldType($name, 'relationship', $args);
    }

    /**
     * @param string $name
     * @param array $args field configuration
     * @return $this
     */
    public function addTaxonomy($name, $args = [])
    {
        return $this->addFieldType($name, 'taxonomy', $args);
    }

    /**
     * @param string $name
     * @param array $args field configuration
     * @return $this
     */
    public function addUser($name, $args = [])
    {
        return $this->addFieldType($name, 'user', $args);
    }

    /**
     * @param string $name
     * @param array $args field configuration
     * @return $this
     */
    public function addDatePicker($name, $args = [])
    {
        return $this->addFieldType($name, 'date_picker', $args);
    }

    /**
     * @param string $name
     * @param array $args field configuration
     * @return $this
     */
    public function addTimePicker($name, $args = [])
    {
        return $this->addFieldType($name, 'time_picker', $args);
    }

    /**
     * @param string $name
     * @param array $args field configuration
     * @return $this
     */
    public function addDateTimePicker($name, $args = [])
    {
        return $this->addFieldType($name, 'date_time_picker', $args);
    }

    /**
     * @param string $name
     * @param array $args field configuration
     * @return $this
     */
    public function addColorPicker($name, $args = [])
    {
        return $this->addFieldType($name, 'color_picker', $args);
    }

    /**
     * All fields added after will appear under this tab, until another tab
     * is added.
     * @param string $label Tab label
     * @param array $args field configuration
     * @return $this
     */
    public function addTab($label, $args = [])
    {
        $name = $this->generateName($label).'_tab';
        $args = array_merge([
            'label' => $label,
        ], $args);

        return $this->addFieldType($name, 'tab', $args);
    }

    /**
     * Configs the tab as an endpoint tab. New tabs will start on another row.
     * @param  int $value boolean 1 or 0
     * @return $this
     */
    public function endpoint($value = 1)
    {
        return $this->setConfig('endpoint', $value);
    }

    /**
     * Addes a message field
     * @param string $label
     * @param string $message
     * @param array $args field configuration
     * @return $this
     */
    public function addMessage($label, $message, $args = [])
    {
        $name = $this->generateName($label).'_message';
        $args = array_merge([
            'label' => $label,
            'message' => $message,
        ], $args);

        return $this->addFieldType($name, 'message', $args);
    }

    /**
     * Add a repeater field. Any fields added after will be added to the repeater
     * until `endRepeater` is called.
     * @param string $name
     * @param array $args field configuration
     * @return RepeaterBuilder
     */
    public function addRepeater($name, $args = [])
    {
        $repeaterBuilder = new RepeaterBuilder($name, $args);
        $repeaterBuilder->setParentContext($this);
        $this->getFieldManager()->pushField($repeaterBuilder);

        return $repeaterBuilder;
    }

    /**
     * Add a flexible content field. Once adding a layout with `addLayout`,
     * any fields added after will be added to that layout until another
     * `addLayout` call is made, or until `endFlexibleContent` is called.
     * @param string $name
     * @param array $args field configuration
     * @return FlexibleContentBuilder
     */
    public function addFlexibleContent($name, $args = [])
    {
        $flexibleContentBuilder = new FlexibleContentBuilder($name, $args);
        $flexibleContentBuilder->setParentContext($this);
        $this->getFieldManager()->pushField($flexibleContentBuilder);

        return $flexibleContentBuilder;
    }

    /**
     * Add a choice to the previously added radio, select or checkbox field
     * @param string $choice
     * @param string $label By default the value of $choice will appear next
     * to the field. Optionally pass in a manual value for the label.
     * @return $this
     */
    public function addChoice($choice, $label = null)
    {
        $field = $this->getFieldManager()->popField();

        array_key_exists('choices', $field) ?: $field['choices'] = [];
        $label ?: $label = $choice;

        $field['choices'][$choice] = $label;
        $this->getFieldManager()->pushField($field);

        return $this;
    }

    /**
     * Add a number of choices to a radio, select or checkbox field at once.
     * Each argument will be a choice. Pass in an array of format ['name' => 'label']
     * to specifiy a manually set label.
     * @return $this
     */
    public function addChoices()
    {
        foreach (func_get_args() as $choice) {
            if (is_array($choice)) {
                $values = each($choice);
                $this->addChoice($values['key'], $values['value']);
                continue;
            }

            $this->addChoice($choice);
        }

        return $this;
    }

    /**
     * Add a conditional logic statement that will determine if the last added
     * field will display or not. You can add `or` or `and` calls after
     * to build complex logic. Any other function call will return you to the
     * parentContext.
     * @param  string $name Dependent field name
     *                      (choice type: radio, checkbox, select, trueFalse)
     * @param  string $operator ==, !=
     * @param  string $value    1 or choice value
     * @return ConditionalBuilder
     */
    public function conditional($name, $operator, $value)
    {
        $field = $this->getFieldManager()->popField();
        $conditionalBuilder = new ConditionalBuilder($name, $operator, $value);
        $conditionalBuilder->setParentContext($this);

        $field['conditional_logic'] = $conditionalBuilder;
        $this->getFieldManager()->pushField($field);

        return $conditionalBuilder;
    }

    /**
     * @return FieldManager
     */
    protected function getFieldManager()
    {
        return $this->fieldManager;
    }

    /**
     * @return array
     */
    public function getFields()
    {
        return $this->getFieldManager()->getFields();
    }

    /**
     * @param string $name [description]
     * @return array|Builder
     */
    public function getField($name)
    {
        return $this->getFieldManager()->getField($name);
    }

    /**
     * Modify an already defined field
     * @param  string $name   Name of the field
     * @param  array|\Closure  $modify Array of field configs or a closure that accepts
     * a FieldsBuilder and returns a FieldsBuilder.
     * @throws ModifyFieldReturnTypeException if $modify is a closure and doesn't
     * return a FieldsBuilder.
     * @throws FieldNotFoundException if the field name doesn't exist.
     * @return $this
     */
    public function modifyField($name, $modify)
    {
        if (is_array($modify)) {
            $this->getFieldManager()->modifyField($name, $modify);
        } elseif ($modify instanceof \Closure) {
            $field = $this->getField($name);

            // Initialize Modifying FieldsBuilder
            $modifyBuilder = new FieldsBuilder('');
            $modifyBuilder->addFields([$field]);

            /**
             * @var FieldsBuilder
             */
            $modifyBuilder = $modify($modifyBuilder);

            // Check if a FieldsBuilder is returned
            if (!$modifyBuilder instanceof FieldsBuilder) {
                throw new ModifyFieldReturnTypeException(gettype($modifyBuilder));
            }

            // Build Modifications
            $modifyConfig = $modifyBuilder->build();

            // Insert field(s)
            $this->getFieldManager()->replaceField($name, $modifyConfig['fields']);
        }

        return $this;
    }

    /**
     * Remove a field by name
     * @param  string $name Field to remove
     * @return $this
     */
    public function removeField($name)
    {
        $this->getFieldManager()->removeField($name);

        return $this;
    }

    /**
     * Set the default value of previously added field
     * @param  string $value
     * @return $this
     */
    public function defaultValue($value)
    {
        return $this->setConfig('default_value', $value);
    }

    /**
     * Mark the previously added field as required
     * @param  bool $value
     * @return $this
     */
    public function required($value = true)
    {
        return $this->setConfig('required', $value ? 1 : 0);
    }

    /**
     * Add instructions for the previously added field
     * @param  string $value
     * @return $this
     */
    public function instructions($value)
    {
        return $this->setConfig('instructions', $value);
    }

    /**
     * Set a configuration by key on the previously added field
     * @param string $key
     * @param string $value
     * @return $this
     */
    public function setConfig($key, $value)
    {
        $field = $this->getFieldManager()->popField();
        $field[$key] = $value;
        $this->getFieldManager()->pushField($field);

        return $this;
    }

    /**
     * Set the location of the field group. See
     * https://github.com/StoutLogic/acf-builder/wiki/location and
     * https://www.advancedcustomfields.com/resources/custom-location-rules/
     * for more details.
     * @param string $param
     * @param string $operator
     * @param string $value
     * @return LocationBuilder
     */
    public function setLocation($param, $operator, $value)
    {
        if ($this->getParentContext()) {
            return $this->getParentContext()->setLocation($param, $operator, $value);
        }

        $this->location = new LocationBuilder($param, $operator, $value);
        $this->location->setParentContext($this);

        return $this->location;
    }

    /**
     * @return LocationBuilder
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Create a field label based on the field's name. Generates title case.
     * @param  string $name
     * @return string label
     */
    protected function generateLabel($name)
    {
        return ucwords(str_replace("_", " ", $name));
    }

    /**
     * Generates a snaked cased name.
     * @param  string $name
     * @return string
     */
    protected function generateName($name)
    {
        return strtolower(str_replace(" ", "_", $name));
    }
}

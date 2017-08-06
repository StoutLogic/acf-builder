<?php

namespace StoutLogic\AcfBuilder;

/**
 * Builds configurations for an ACF Field
 * @method FieldBuilder addField(string $name, string $type, array $args = [])
 * @method FieldBuilder addChoiceField(string $name, string $type, array $args = [])
 * @method FieldBuilder addText(string $name, array $args = [])
 * @method FieldBuilder addTextarea(string $name, array $args = [])
 * @method FieldBuilder addNumber(string $name, array $args = [])
 * @method FieldBuilder addEmail(string $name, array $args = [])
 * @method FieldBuilder addUrl(string $name, array $args = [])
 * @method FieldBuilder addPassword(string $name, array $args = [])
 * @method FieldBuilder addWysiwyg(string $name, array $args = [])
 * @method FieldBuilder addOembed(string $name, array $args = [])
 * @method FieldBuilder addImage(string $name, array $args = [])
 * @method FieldBuilder addFile(string $name, array $args = [])
 * @method FieldBuilder addGallery(string $name, array $args = [])
 * @method FieldBuilder addTrueFalse(string $name, array $args = [])
 * @method FieldBuilder addSelect(string $name, array $args = [])
 * @method FieldBuilder addRadio(string $name, array $args = [])
 * @method FieldBuilder addCheckbox(string $name, array $args = [])
 * @method FieldBuilder addPostObject(string $name, array $args = [])
 * @method FieldBuilder addPageLink(string $name, array $args = [])
 * @method FieldBuilder addTaxonomy(string $name, array $args = [])
 * @method FieldBuilder addUser(string $name, array $args = [])
 * @method FieldBuilder addDatePicker(string $name, array $args = [])
 * @method FieldBuilder addTimePicker(string $name, array $args = [])
 * @method FieldBuilder addDateTimePicker(string $name, array $args = [])
 * @method FieldBuilder addColorPicker(string $name, array $args = [])
 * @method FieldBuilder addGoogleMap(string $name, array $args = [])
 * @method FieldBuilder addLink(string $name, array $args = [])
 * @method FieldBuilder addTab(string $label, array $args = [])
 * @method FieldBuilder addMessage(string $label, string $message, array $args = [])
 * @method GroupBuilder addGroup(string $name, array $args = [])
 * @method RepeaterBuilder addRepeater(string $name, array $args = [])
 * @method FlexibleContentBuilder addFlexibleContent(string $name, array $args = [])
 * @method FieldsBuilder addLayout(string|FieldsBuilder $layout, array $args = [])
 */
class FieldBuilder extends ParentDelegationBuilder implements NamedBuilder
{
    /**
     * Field Type
     * @var string
     */
    private $type;

    /**
     * Additional Field Configuration
     * @var array
     */
    private $config;

    /**
     * @param string $name Field Name, conventionally 'snake_case'.
     * @param string $type Field Type.
     * @param array $config Additional Field Configuration.
     */
    public function __construct($name, $type, $config = [])
    {
        $this->config = [
            'name' => $name,
            'label' => $this->generateLabel($name),
        ];

        $this->type = $type;
        $this->setKey($name);
        $this->updateConfig($config);
    }

    /**
     * @return array
     */
    private function getConfig()
    {
        return $this->config;
    }

    /**
     * Set a config key -> value pair
     * @param string $key
     * @param mixed $value
     * @return $this
     */
    public function setConfig($key, $value)
    {
        return $this->updateConfig([$key => $value]);
    }

    /**
     * Update multiple config values using and array of key -> value pairs.
     * @param  array $config
     * @return $this
     */
    public function updateConfig($config)
    {
        $this->config = array_merge($this->config, $config);
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->config['name'];
    }

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->config['key'];
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->config['label'];
    }

    /**
     * Will prepend `field_` if missing.
     * @param string $key
     * @return $this
     */
    public function setKey($key)
    {
        if (!preg_match('/^field_/', $key)) {
            $key = 'field_'.$key;
        }

        return $this->setConfig('key', $key);
    }

    /**
     * Will set field required.
     * @return $this
     */
    public function setRequired()
    {
        return $this->setConfig('required', 1);
    }

    /**
     * Will set field unrequired.
     * @return $this
     */
    public function setUnrequired()
    {
        return $this->setConfig('required', 0);
    }

    /**
     * Will set field's instructions.
     * @param string $instructions
     * @return $this
     */
    public function setInstructions($instructions)
    {
        return $this->setConfig('instructions', $instructions);
    }

    /**
     * Will set field's defaultValue.
     * @param string $defaultValue
     * @return $this
     */
    public function setDefaultValue($defaultValue)
    {
        return $this->setConfig('default_value', $defaultValue);
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
        $conditionalBuilder = new ConditionalBuilder($name, $operator, $value);
        $conditionalBuilder->setParentContext($this);

        $this->setConfig('conditional_logic', $conditionalBuilder);

        return $conditionalBuilder;
    }

    /**
     * Build the field configuration array
     * @return array Field configuration array
     */
    public function build()
    {
        $config = array_merge([
            'type' => $this->type,
        ], $this->getConfig());

        foreach ($config as $key => $value) {
            if ($value instanceof Builder) {
                $config[$key] = $value->build();
            }
        }

        return $config;
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

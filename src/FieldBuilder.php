<?php

namespace StoutLogic\AcfBuilder;

/**
 * Builds configurations for an ACF Field
 *
 * @method FieldBuilder addField(string $name, string $type, array $args = [])
 * @method FieldBuilder addFields(FieldsBuilder|array $fields)
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
 * @method FieldBuilder addButtonGroup(string $name, array $args = [])
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
 * @method FieldBuilder addRange(string $name, array $args = [])
 * @method FieldBuilder addMessage(string $label, string $message, array $args = [])
 * @method FieldBuilder addRelationship(string $name, array $args = [])
 * @method FieldBuilder addAccordion(string $name, array $args = [])
 * @method TabBuilder endpoint()
 * @method TabBuilder removeEndpoint()
 * @method GroupBuilder addGroup(string $name, array $args = [])
 * @method GroupBuilder endGroup()
 * @method RepeaterBuilder addRepeater(string $name, array $args = [])
 * @method RepeaterBuilder endRepeater()
 * @method FlexibleContentBuilder addFlexibleContent(string $name, array $args = [])
 * @method FieldsBuilder addLayout(string|FieldsBuilder $layout, array $args = [])
 * @method LocationBuilder setLocation(string $param, string $operator, string $value)
 * @mixin \StoutLogic\AcfBuilder\FieldsBuilder
 * @api
 */
class FieldBuilder extends ParentDelegationBuilder implements NamedBuilder
{
    /**
     * Additional Field Configuration
     *
     * @var array
     */
    private $config;

    /**
     * @param string $name Field Name, conventionally 'snake_case'.
     * @param string $type Field Type.
     * @param array  $config Additional Field Configuration.
     */
    public function __construct(
        $name,
        /**
         * Field Type
         */
        private $type,
        $config = []
    ) {
        $this->config = [
            'name' => $name,
            'label' => $this->generateLabel($name),
        ];
        $this->setKey($name);
        $this->updateConfig($config);
    }

    /**
     * Return the field configuration values.
     *
     * @return array
     * @api
     */
    public function getConfig()
    {
        return $this->config;
    }
    
    /**
     * Return the field type.
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set a config key -> value pair
     *
     * @param string $key
     * @param mixed  $value
     * @return $this
     * @example
     *
     * Set a field placeholder.
     *
     * ```php
     * $field->setConfig('placeholder', 'Enter a title');
     * ```
     * @api
     */
    public function setConfig($key, $value)
    {
        return $this->updateConfig([$key => $value]);
    }

    /**
     * Update multiple config values using and array of key -> value pairs.
     *
     * @param  array $config
     * @return $this
     * @example
     *
     * Update several field settings.
     *
     * ```php
     * $field->updateConfig(['required' => 1, 'placeholder' => 'Title']);
     * ```
     * @api
     */
    public function updateConfig($config)
    {
        $this->config = array_merge($this->config, $config);
        return $this;
    }

    /**
     * Return the field name.
     *
     * @return string
     * @api
     */
    public function getName()
    {
        return $this->config['name'];
    }

    /**
     * Return the field key.
     *
     * @return string
     * @api
     */
    public function getKey()
    {
        return $this->config['key'];
    }

    /**
     * Return the field label.
     *
     * @return string
     * @api
     */
    public function getLabel()
    {
        return $this->config['label'];
    }

    /**
     * Will prepend `field_` if missing.
     *
     * @param string $key
     * @return $this
     * @api
     */
    public function setKey($key)
    {
        if (!preg_match('/^field_/', $key)) {
            $key = 'field_' . $key;
        }

        return $this->setConfig('key', $key);
    }

    /**
     * Set a custom field key without applying the automatic namespace.
     *
     * @param string $key Custom field key.
     * @return $this
     * @api
     */
    public function setCustomKey($key)
    {
        return $this
            ->setConfig('key', $key)
            ->setConfig('_has_custom_key', true);
    }

    /**
     * Determine whether this field has a custom key.
     *
     * @return bool
     * @api
     */
    public function hasCustomKey()
    {
        return array_key_exists('_has_custom_key', $this->config) && $this->config['_has_custom_key'];
    }


    /**
     * Will set field required.
     *
     * @return $this
     * @example
     *
     * ```php
     * $fields->addText('title')->setRequired();
     * ```
     * @api
     */
    public function setRequired()
    {
        return $this->setConfig('required', 1);
    }

    /**
     * Will set field unrequired.
     *
     * @return $this
     * @api
     */
    public function setUnrequired()
    {
        return $this->setConfig('required', 0);
    }

    /**
     * Will set field's label.
     *
     * @param string $label
     * @return $this
     * @api
     */
    public function setLabel($label)
    {
        return $this->setConfig('label', $label);
    }

    /**
     * Will set field's instructions.
     *
     * @param string $instructions
     * @return $this
     * @example
     *
     * ```php
     * $fields->addText('title')->setInstructions('Shown below the field.');
     * ```
     * @api
     */
    public function setInstructions($instructions)
    {
        return $this->setConfig('instructions', $instructions);
    }

    /**
     * Will set field's defaultValue.
     *
     * @param string $defaultValue
     * @return $this
     * @example
     *
     * ```php
     * $fields->addColorPicker('background_color')->setDefaultValue('#ffffff');
     * ```
     * @api
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
     *
     * @param  string $name Dependent field name
     *                      (choice type: radio, checkbox, select, trueFalse).
     * @param  string $operator ==, !=.
     * @param  string $value    1 or choice value.
     * @return ConditionalBuilder
     * @example
     *
     * ```php
     * $fields
     *  ->addText('other_value')
     *  ->conditional('color', '==', 'other');
     * ```
     * @api
     */
    public function conditional($name, $operator, $value)
    {
        $conditionalBuilder = new ConditionalBuilder($name, $operator, $value);
        $conditionalBuilder->setParentContext($this);

        $this->setConfig('conditional_logic', $conditionalBuilder);

        return $conditionalBuilder;
    }

    /**
     * Set Wrapper container tag attributes
     *
     * @param array $config
     *
     * @return FieldBuilder
     * @api
     */
    public function setWrapper($config)
    {
        return $this->setConfig('wrapper', $config);
    }

    /**
     * Get Wrapper container tag attributes
     *
     * @return array|mixed
     * @api
     */
    public function getWrapper()
    {
        return $this->config['wrapper'] ?? [];
    }

    /**
     * Set width of a Wrapper container
     *
     * @param string $width Width of a container in % or px.
     *
     * @return FieldBuilder
     * @api
     */
    public function setWidth($width)
    {
        $wrapper = $this->getWrapper();
        $wrapper['width'] = $width;

        return $this->setWrapper($wrapper);
    }

    /**
     * Set specified Attr of a Wrapper container
     *
     * @param string      $name Attribute name, ex. 'class'.
     * @param string|null $value Attribute value, ex. 'my-class'.
     *
     * @return FieldBuilder
     * @api
     */
    public function setAttr($name, $value = null)
    {
        $wrapper = $this->getWrapper();

        // set attribute.
        $wrapper[$name] = $value;

        return $this->setWrapper($wrapper);
    }

    /**
     * Set Class and/or ID attribute of a Wrapper container
     * use CSS-like selector string to specify css or id
     * example: #my-id.foo-class.bar-class
     *
     * @param string $css_selector
     *
     * @return FieldBuilder
     * @api
     */
    public function setSelector($css_selector)
    {
        // if # is the first sign - we start with ID.
        if (str_starts_with($css_selector, '#')) {
            $css_selector .= '.'; // prevent empty second part.
            [$id, $class] = explode('.', $css_selector, 2);
        } else {
            $css_selector .= '#'; // prevent empty second part.
            [$class, $id] = explode('#', $css_selector, 2);
        }

        $id = trim($id, '#');
        $class = trim($class, '.');

        if (!empty($id)) {
            $this->setAttr('id', $id);
        }

        if (!empty($class)) {
            $class = str_replace('.', ' ', $class);
            $this->setAttr('class', $class);
        }

        return $this;
    }

    /**
     * Build the field configuration array
     *
     * @return array Field configuration array
     * @example
     *
     * ```php
     * $config = $field->build();
     * ```
     * @api
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
     *
     * @param  string $name
     * @return string label
     */
    protected function generateLabel($name)
    {
        return ucwords(str_replace('_', ' ', $name));
    }

    /**
     * Generates a snaked cased name.
     *
     * @param  string $name
     * @return string
     */
    protected function generateName($name)
    {
        return strtolower(str_replace(' ', '_', $name));
    }
}

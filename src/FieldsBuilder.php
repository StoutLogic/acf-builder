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
    protected $location;

    /**
     * Field Group Name
     * @var string
     */
    protected $name;

    /**
     * @param string $name Field Group name
     * @param array $groupConfig Field Group configuration
     */
    public function __construct($name, array $groupConfig = [])
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
     * @return $this
     */
    public function setGroupConfig($key, $value)
    {
        $this->config[$key] = $value;

        return $this;
    }

    /**
     * Get a value for a particular key in the group config.
     * Returns null if the key isn't defined in the config.
     * @param string $key
     * @return mixed|null
     */
    public function getGroupConfig($key)
    {
        if (array_key_exists($key, $this->config)) {
            return $this->config[$key];
        }

        return null;
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
        $fields = array_map(function($field) {
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
     * @return array|LocationBuilder
     */
    private function buildLocation()
    {
        $location = $this->getLocation();
        return ($location instanceof Builder) ? $location->build() : $location;
    }

    /**
     * Add multiple fields either via an array or from another builder
     * @param FieldsBuilder|array $fields
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
     * Add a field of a specific type
     * @param string $name
     * @param string $type
     * @param array $args field configuration
     * @throws FieldNameCollisionException if name already exists.
     * @return FieldBuilder
     */
    public function addField($name, $type, array $args = [])
    {
        return $this->initializeField(new FieldBuilder($name, $type, $args));
    }

    /**
     * Add a field of a choice type, allows choices to be added.
     * @param string $name
     * @param string $type 'select', 'radio', 'checkbox'
     * @param array $args field configuration
     * @throws FieldNameCollisionException if name already exists.
     * @return FieldBuilder
     */
    public function addChoiceField($name, $type, array $args = [])
    {
        return $this->initializeField(new ChoiceFieldBuilder($name, $type, $args));
    }

    /**
     * Initialize the FieldBuilder, add to FieldManager
     * @param  FieldBuilder $field
     * @return FieldBuilder
     */
    protected function initializeField($field)
    {
        $field->setParentContext($this);
        $this->getFieldManager()->pushField($field);
        return $field;
    }

    /**
     * @param string $name
     * @param array $args field configuration
     * @throws FieldNameCollisionException if name already exists.
     * @return FieldBuilder
     */
    public function addText($name, array $args = [])
    {
        return $this->addField($name, 'text', $args);
    }

    /**
     * @param string $name
     * @param array $args field configuration
     * @throws FieldNameCollisionException if name already exists.
     * @return FieldBuilder
     */
    public function addTextarea($name, array $args = [])
    {
        return $this->addField($name, 'textarea', $args);
    }

    /**
     * @param string $name
     * @param array $args field configuration
     * @throws FieldNameCollisionException if name already exists.
     * @return FieldBuilder
     */
    public function addNumber($name, array $args = [])
    {
        return $this->addField($name, 'number', $args);
    }

    /**
     * @param string $name
     * @param array $args field configuration
     * @throws FieldNameCollisionException if name already exists.
     * @return FieldBuilder
     */
    public function addEmail($name, array $args = [])
    {
        return $this->addField($name, 'email', $args);
    }

    /**
     * @param string $name
     * @param array $args field configuration
     * @throws FieldNameCollisionException if name already exists.
     * @return FieldBuilder
     */
    public function addUrl($name, array $args = [])
    {
        return $this->addField($name, 'url', $args);
    }

    /**
     * @param string $name
     * @param array $args field configuration
     * @throws FieldNameCollisionException if name already exists.
     * @return FieldBuilder
     */
    public function addPassword($name, array $args = [])
    {
        return $this->addField($name, 'password', $args);
    }

    /**
     * @param string $name
     * @param array $args field configuration
     * @throws FieldNameCollisionException if name already exists.
     * @return FieldBuilder
     */
    public function addWysiwyg($name, array $args = [])
    {
        return $this->addField($name, 'wysiwyg', $args);
    }

    /**
     * @param string $name
     * @param array $args field configuration
     * @throws FieldNameCollisionException if name already exists.
     * @return FieldBuilder
     */
    public function addOembed($name, array $args = [])
    {
        return $this->addField($name, 'oembed', $args);
    }

    /**
     * @param string $name
     * @param array $args field configuration
     * @throws FieldNameCollisionException if name already exists.
     * @return FieldBuilder
     */
    public function addImage($name, array $args = [])
    {
        return $this->addField($name, 'image', $args);
    }

    /**
     * @param string $name
     * @param array $args field configuration
     * @throws FieldNameCollisionException if name already exists.
     * @return FieldBuilder
     */
    public function addFile($name, array $args = [])
    {
        return $this->addField($name, 'file', $args);
    }

    /**
     * @param string $name
     * @param array $args field configuration
     * @throws FieldNameCollisionException if name already exists.
     * @return FieldBuilder
     */
    public function addGallery($name, array $args = [])
    {
        return $this->addField($name, 'gallery', $args);
    }

    /**
     * @param string $name
     * @param array $args field configuration
     * @throws FieldNameCollisionException if name already exists.
     * @return FieldBuilder
     */
    public function addTrueFalse($name, array $args = [])
    {
        return $this->addField($name, 'true_false', $args);
    }

    /**
     * @param string $name
     * @param array $args field configuration
     * @throws FieldNameCollisionException if name already exists.
     * @return FieldBuilder
     */
    public function addSelect($name, array $args = [])
    {
        return $this->addChoiceField($name, 'select', $args);
    }

    /**
     * @param string $name
     * @param array $args field configuration
     * @throws FieldNameCollisionException if name already exists.
     * @return FieldBuilder
     */
    public function addRadio($name, array $args = [])
    {
        return $this->addChoiceField($name, 'radio', $args);
    }

    /**
     * @param string $name
     * @param array $args field configuration
     * @throws FieldNameCollisionException if name already exists.
     * @return FieldBuilder
     */
    public function addCheckbox($name, array $args = [])
    {
        return $this->addChoiceField($name, 'checkbox', $args);
    }

    /**
     * @param string $name
     * @param array $args field configuration
     * @throws FieldNameCollisionException if name already exists.
     * @return FieldBuilder
     */
    public function addButtonGroup($name, array $args = [])
    {
        return $this->addChoiceField($name, 'button_group', $args);
    }

    /**
     * @param string $name
     * @param array $args field configuration
     * @throws FieldNameCollisionException if name already exists.
     * @return FieldBuilder
     */
    public function addPostObject($name, array $args = [])
    {
        return $this->addField($name, 'post_object', $args);
    }

    /**
     * @param string $name
     * @param array $args field configuration
     * @throws FieldNameCollisionException if name already exists.
     * @return FieldBuilder
     */
    public function addPageLink($name, array $args = [])
    {
        return $this->addField($name, 'page_link', $args);
    }

    /**
     * @param string $name
     * @param array $args field configuration
     * @throws FieldNameCollisionException if name already exists.
     * @return FieldBuilder
     */
    public function addRelationship($name, array $args = [])
    {
        return $this->addField($name, 'relationship', $args);
    }

    /**
     * @param string $name
     * @param array $args field configuration
     * @throws FieldNameCollisionException if name already exists.
     * @return FieldBuilder
     */
    public function addTaxonomy($name, array $args = [])
    {
        return $this->addField($name, 'taxonomy', $args);
    }

    /**
     * @param string $name
     * @param array $args field configuration
     * @throws FieldNameCollisionException if name already exists.
     * @return FieldBuilder
     */
    public function addUser($name, array $args = [])
    {
        return $this->addField($name, 'user', $args);
    }

    /**
     * @param string $name
     * @param array $args field configuration
     * @throws FieldNameCollisionException if name already exists.
     * @return FieldBuilder
     */
    public function addDatePicker($name, array $args = [])
    {
        return $this->addField($name, 'date_picker', $args);
    }

    /**
     * @param string $name
     * @param array $args field configuration
     * @throws FieldNameCollisionException if name already exists.
     * @return FieldBuilder
     */
    public function addTimePicker($name, array $args = [])
    {
        return $this->addField($name, 'time_picker', $args);
    }

    /**
     * @param string $name
     * @param array $args field configuration
     * @throws FieldNameCollisionException if name already exists.
     * @return FieldBuilder
     */
    public function addDateTimePicker($name, array $args = [])
    {
        return $this->addField($name, 'date_time_picker', $args);
    }

    /**
     * @param string $name
     * @param array $args field configuration
     * @throws FieldNameCollisionException if name already exists.
     * @return FieldBuilder
     */
    public function addColorPicker($name, array $args = [])
    {
        return $this->addField($name, 'color_picker', $args);
    }

    /**
     * @param string $name
     * @param array $args field configuration
     * @throws FieldNameCollisionException if name already exists.
     * @return FieldBuilder
     */
    public function addGoogleMap($name, array $args = [])
    {
        return $this->addField($name, 'google_map', $args);
    }

    /**
     * @param string $name
     * @param array $args field configuration
     * @throws FieldNameCollisionException if name already exists.
     * @return FieldBuilder
     */
    public function addLink($name, array $args = [])
    {
        return $this->addField($name, 'link', $args);
    }

    /**
     * @param string $name
     * @param array $args field configuration
     * @throws FieldNameCollisionException if name already exists.
     * @return FieldBuilder
     */
    public function addRange($name, array $args = [])
    {
        return $this->addField($name, 'range', $args);
    }

    /**
     * All fields added after will appear under this tab, until another tab
     * is added.
     * @param string $label Tab label
     * @param array $args field configuration
     * @throws FieldNameCollisionException if name already exists.
     * @return FieldBuilder
     */
    public function addTab($label, array $args = [])
    {
        return $this->initializeField(new TabBuilder($label, 'tab', $args));
    }

    /**
     * All fields added after will appear under this accordion, until
     * another accordion is added.
     * @param string $label Accordion label
     * @param array $args field configuration
     * @throws FieldNameCollisionException if name already exists.
     * @return AccordionBuilder
     */
    public function addAccordion($label, array $args = [])
    {
        return $this->initializeField(new AccordionBuilder($label, 'accordion', $args));
    }

    /**
     * Addes a message field
     * @param string $label
     * @param string $message
     * @param array $args field configuration
     * @throws FieldNameCollisionException if name already exists.
     * @return FieldBuilder
     */
    public function addMessage($label, $message, array $args = [])
    {
        $name = $this->generateName($label).'_message';
        $args = array_merge([
            'label' => $label,
            'message' => $message,
        ], $args);

        return $this->addField($name, 'message', $args);
    }

    /**
     * @param string $name
     * @param array $args field configuration
     * @throws FieldNameCollisionException if name already exists.
     * @return GroupBuilder
     */
    public function addGroup($name, array $args = [])
    {
        return $this->initializeField(new GroupBuilder($name, 'group', $args));
    }

    /**
     * Add a repeater field. Any fields added after will be added to the repeater
     * until `endRepeater` is called.
     * @param string $name
     * @param array $args field configuration
     * @throws FieldNameCollisionException if name already exists.
     * @return RepeaterBuilder
     */
    public function addRepeater($name, array $args = [])
    {
        return $this->initializeField(new RepeaterBuilder($name, 'repeater', $args));
    }

    /**
     * Add a flexible content field. Once adding a layout with `addLayout`,
     * any fields added after will be added to that layout until another
     * `addLayout` call is made, or until `endFlexibleContent` is called.
     * @param string $name
     * @param array $args field configuration
     * @throws FieldNameCollisionException if name already exists.
     * @return FlexibleContentBuilder
     */
    public function addFlexibleContent($name, array $args = [])
    {
        return $this->initializeField(new FlexibleContentBuilder($name, 'flexible_content', $args));
    }

    /**
     * @return FieldManager
     */
    protected function getFieldManager()
    {
        return $this->fieldManager;
    }

    /**
     * @return NamedBuilder[]
     */
    public function getFields()
    {
        return $this->getFieldManager()->getFields();
    }

    /**
     * @param string $name [description]
     * @return FieldBuilder
     */
    public function getField($name)
    {
        return $this->getFieldManager()->getField($name);
    }

    public function fieldExists($name)
    {
        return $this->getFieldManager()->fieldNameExists($name);
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

            // Insert field(s)
            $this->getFieldManager()->replaceField($name, $modifyBuilder->getFields());
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
        return ucwords(str_replace('_', ' ', $name));
    }

    /**
     * Generates a snaked cased name.
     * @param  string $name
     * @return string
     */
    protected function generateName($name)
    {
        return strtolower(str_replace(' ', '_', $name));
    }

}

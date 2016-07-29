<?php

namespace StoutLogic\AcfBuilder;

/**
 * Repeater field
 * Can add multiple fields as subfields to the repeater.
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
 * @method FieldBuilder addPostLink(string $name, array $args = [])
 * @method FieldBuilder addTaxonomy(string $name, array $args = [])
 * @method FieldBuilder addUser(string $name, array $args = [])
 * @method FieldBuilder addDatePicker(string $name, array $args = [])
 * @method FieldBuilder addTimePicker(string $name, array $args = [])
 * @method FieldBuilder addDateTimePicker(string $name, array $args = [])
 * @method FieldBuilder addColorPicker(string $name, array $args = [])
 * @method FieldBuilder addTab(string $label, array $args = [])
 * @method FieldBuilder addMessage(string $label, string $message, array $args = [])
 * @method FieldBuilder addRepeater(string $name, array $args = [])
 * @method FieldBuilder addFlexibleContent(string $name, array $args = [])
 */
class RepeaterBuilder extends FieldBuilder
{
    /**
     * Used to contain and add fields
     * @var FieldsBuilder
     */
    protected $fieldsBuilder;

    /**
     * @param string $name Field name
     * @param string $type Field name
     * @param array $config Field configuration
     */
    public function __construct($name, $type = 'repeater', $config = [])
    {
        parent::__construct($name, $type, $config);
        $this->fieldsBuilder = new FieldsBuilder($name);
        $this->fieldsBuilder->setParentContext($this);

        if (!array_key_exists('button_label', $config)) {
            $this->setConfig('button_label', $this->getDefaultButtonLabel());
        }
    }

    /**
     * Return a repeater field configuration array
     * @return array
     */
    public function build()
    {
        $config = parent::build();
        $fields = $this->fieldsBuilder->build();
        $config['sub_fields'] = $fields['fields'];
        return $config;
    }

    /**
     * Returns call chain to parentContext
     * @return Builder
     */
    public function endRepeater()
    {
        return $this->getParentContext();
    }

    /**
     * Add multiple fields either via an array or from another builder
     * @param mixed $fields array of fields or a FieldBuilder
     * @return $this
     */
    public function addFields($fields)
    {
        $this->fieldsBuilder->addFields($fields);
        return $this;
    }

    /**
     * Intercept missing methods, pass any methods that begin with add to the
     * internal fieldsBuilder
     * @param  string $method
     * @param  array $args
     * @return mixed
     */
    public function __call($method, $args)
    {
        if (preg_match('/^add.+/', $method) && method_exists($this->fieldsBuilder, $method)) {
            $field = $this->callAddFieldMethod($method, $args);
            $field->setParentContext($this);
            return $field;
        }

        return parent::__call($method, $args);
    }

    /**
     * Calls an add field method on the FieldsBuilder
     * @param string $method [description]
     * @param array $args
     * @return FieldBuilder
     */
    private function callAddFieldMethod($method, $args)
    {
        return call_user_func_array([$this->fieldsBuilder, $method], $args);
    }

    /**
     * Gerenates the default button label.
     * @return string
     */
    private function getDefaultButtonLabel()
    {
        return 'Add '.rtrim($this->getLabel(), 's');
    }
}

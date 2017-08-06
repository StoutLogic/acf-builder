<?php

namespace StoutLogic\AcfBuilder;

/**
 * Group field
 * Can add multiple fields as subfields to the group.
 */
class GroupBuilder extends FieldBuilder
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
    public function __construct($name, $type = 'group', $config = [])
    {
        parent::__construct($name, $type, $config);
        $this->fieldsBuilder = new FieldsBuilder($name);
        $this->fieldsBuilder->setParentContext($this);
    }

    /**
     * Add multiple fields either via an array or from another builder
     * @param array|FieldsBuilder $fields
     * @return $this
     */
    public function addFields($fields)
    {
        $this->fieldsBuilder->addFields($fields);
        return $this;
    }

    /**
     * Return a group field configuration array
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
     * @return FieldBuilder
     */
    public function endGroup()
    {
        return $this->getParentContext();
    }

    /**
     * Returns call chain to parentContext
     * @return FieldBuilder
     */
    public function end()
    {
        return $this->endGroup();
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
}
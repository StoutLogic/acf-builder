<?php

namespace StoutLogic\AcfBuilder;

use StoutLogic\AcfBuilder\Exceptions\FieldNotFoundException;
use StoutLogic\AcfBuilder\Exceptions\ModifyFieldReturnTypeException;

/**
 * Group field
 * Can add multiple fields as subfields to the group.
 *
 * @api
 */
class GroupBuilder extends FieldBuilder
{
    /**
     * Used to contain and add fields
     *
     * @var FieldsBuilder
     */
    protected $fieldsBuilder;

    /**
     * Create a group field builder.
     *
     * @param string $name Field name.
     * @param string $type Field name.
     * @param array  $config Field configuration.
     * @api
     */
    public function __construct($name, $type = 'group', $config = [])
    {
        parent::__construct($name, $type, $config);
        $this->fieldsBuilder = new FieldsBuilder($name);
        $this->fieldsBuilder->setParentContext($this);
    }

    /**
     * Add multiple fields either via an array or from another builder
     *
     * @param array|FieldsBuilder $fields
     * @return $this
     * @api
     */
    public function addFields($fields)
    {
        $this->fieldsBuilder->addFields($fields);
        return $this;
    }

    /**
     * Return a group field configuration array
     *
     * @return array
     * @api
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
     *
     * @return FieldBuilder
     * @api
     */
    public function endGroup()
    {
        return $this->getParentContext();
    }

    /**
     * Returns call chain to parentContext
     *
     * @return FieldBuilder
     * @api
     */
    public function end()
    {
        return $this->endGroup();
    }

    /**
     * Intercept missing methods, pass any methods that begin with add to the
     * internal fieldsBuilder
     *
     * @param  string $method
     * @param  array  $args
     * @return mixed
     * @api
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
     *
     * @param string $method [description].
     * @param array  $args
     * @return FieldBuilder
     */
    private function callAddFieldMethod($method, $args)
    {
        return call_user_func_array([$this->fieldsBuilder, $method], $args);
    }

    /**
     * Remove a field by name
     *
     * @param  string $name Field to remove.
     * @return $this
     * @api
     */
    public function removeField($name)
    {
        $this->fieldsBuilder->removeField($name);

        return $this;
    }

    /**
     * Modify an already defined field
     *
     * @param  string         $name   Name of the field.
     * @param  array|\Closure $modify Array of field configs or a closure that accepts
     * a FieldsBuilder and returns a FieldsBuilder.
     * @throws ModifyFieldReturnTypeException If $modify is a closure and doesn't
     * return a FieldsBuilder.
     * @throws FieldNotFoundException If the field name doesn't exist.
     * @return $this
     * @api
     */
    public function modifyField($name, $modify)
    {
        $this->fieldsBuilder->modifyField($name, $modify);

        return $this;
    }

    /**
     * Return a nested field by name.
     *
     * @param string $name Field name.
     * @return FieldBuilder
     * @api
     */
    public function getField($name)
    {
        return $this->fieldsBuilder->getField($name);
    }

    /**
     * Determine whether a nested field exists.
     *
     * @param string $name Field name.
     * @return bool
     * @api
     */
    public function fieldExists($name)
    {
        return $this->fieldsBuilder->fieldExists($name);
    }
}

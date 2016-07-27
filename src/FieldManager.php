<?php

namespace StoutLogic\AcfBuilder;

/**
 * Manages an array of field configs
 */
class FieldManager
{
    /**
     * Array of fields
     * @var array
     */
    private $fields;

    /**
     * @param array $fields optional default array of field configs
     */
    public function __construct($fields = [])
    {
        $this->fields = $fields;
    }

    /**
     * @return array field configs
     */
    public function getFields()
    {
        return $this->fields;
    }

    /**
     * Return int of fields
     * @return int field count
     */
    public function getCount()
    {
        return count($this->getFields());
    }

    /**
     * Add field to end of array
     * @param  array|Builder $field Field array config or Builder
     * @return void
     */
    public function pushField($field)
    {
        $this->insertFields($field, $this->getCount());
    }

    /**
     * Remove last field from end of array
     * @throws \OutOfRangeException if array is empty
     * @return array|Builder Field array config or Builder
     */
    public function popField()
    {
        if ($this->getCount() > 0) {
            $fields = $this->removeFieldAtIndex($this->getCount() - 1);
            return $fields[0];
        }

        throw new \OutOfRangeException("Can't call popField when the field count is 0");
    }

    /**
     * Insert of field at a specific index
     * @param  array|Builder $fields a single field or an array of fields
     * @param  int $index  insertion point
     * @return void
     */
    public function insertFields($fields, $index)
    {
        // If a singular field config, put into an array of fields
        if ($this->getFieldName($fields)) {
            $fields = [$fields];
        }

        foreach ($fields as $i => $field) {
            if ($this->validateField($field)) {
                array_splice($this->fields, $index + $i, 0, [$field]);
            }
        }
    }

    /**
     * Remove a field at a specific index
     * @param  int $index
     * @return array  removed field
     */
    private function removeFieldAtIndex($index)
    {
        return array_splice($this->fields, $index, 1);
    }

    /**
     * Remove a speicifc field by name
     * @param  string $name name of the field
     * @return void
     */
    public function removeField($name)
    {
        $index = $this->getFieldIndex($name);
        $this->removeFieldAtIndex($index);
    }

    /**
     * Replace a field with a single field or array of fields
     * @param  string $name  name of field to replace
     * @param  array|Builder $field single or array of fields
     * @return void
     */
    public function replaceField($name, $field)
    {
        $index = $this->getFieldIndex($name);
        $this->removeFieldAtIndex($index);
        $this->insertFields($field, $index);
    }

    /**
     * Check to see if a field name already exists
     * @param  string $name field name
     * @return bool
     */
    public function fieldNameExists($name)
    {
        try {
            $this->getFieldIndex($name);
        } catch (FieldNotFoundException $e) {
            return false;
        }

        return true;
    }

    /**
     * Return a field by name
     * @param  string $name field name
     * @return array|Builder  Field config array or Builder
     */
    public function getField($name)
    {
        return $this->fields[$this->getFieldIndex($name)];
    }

    /**
     * Return the name given a field
     * @param  array|NamedBuilder $field
     * @return string|false field name
     */
    public function getFieldName($field)
    {
        if ($field instanceof NamedBuilder) {
            return $field->getName();
        }

        if (is_array($field) && array_key_exists('name', $field)) {
            return $field['name'];
        }

        return false;
    }

    /**
     * Modify the configuration of a field
     * @param  string $name          field name
     * @param  array $modifications  field configuration
     * @return void
     */
    public function modifyField($name, $modifications)
    {
        $field = $this->getField($name);
        $field = array_merge($field, $modifications);
        $this->replaceField($name, $field);
    }

    /**
     * Validate a field
     * @param  array|Builder $field
     * @return bool
     */
    private function validateField($field)
    {
        return $this->validateFieldName($field);
    }

    /**
     * Validates that a field's name doesn't already exist
     * @param  array|NamedBuilder $field
     * @throws FieldNameCollisionException when the name already exists
     * @return bool
     */
    private function validateFieldName($field)
    {
        $fieldName = $this->getFieldName($field);
        if ($this->fieldNameExists($fieldName)) {
            throw new FieldNameCollisionException("Field Name: `{$fieldName}` already exists.");
        }

        return true;
    }

    /**
     * Return the index in the $this->fields array looked up by the field's name
     * @param  string $name Field Name
     * @throws FieldNotFoundException if the field name doesn't exist
     * @return int Field Index
     */
    public function getFieldIndex($name)
    {
        foreach ($this->getFields() as $index => $field) {
            if ($this->getFieldName($field) === $name) {
                return $index;
            }
        }

        throw new FieldNotFoundException("Field `{$name}` not found.");
    }
}

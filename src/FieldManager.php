<?php

namespace StoutLogic\AcfBuilder;

class FieldManager
{
    private $fields;

    public function __construct($fields = [])
    {
        $this->fields = $fields;
    }

    public function getFields()
    {
        return $this->fields;
    }

    public function getCount()
    {
        return count($this->getFields());
    }

    public function pushField($field)
    {
        $this->insertFields($field, $this->getCount());
    }

    public function popField()
    {
        if ($this->getCount() > 0) {
            $fields = $this->removeFieldAtIndex($this->getCount() - 1);
            return $fields[0];
        }

        throw new \OutOfRangeException("Can't call popField when the field count is 0");
    }

    public function insertFields($fields, $index)
    {
        // If a singular field config, put into an array of fields
        if ($this->getFieldName($fields)) {
            $fields = [$fields];
        }

        foreach($fields as $i => $field) {
            if ($this->validateField($field)) {
                array_splice($this->fields, $index + $i, 0, [$field]);
            }
        }
    }

    private function removeFieldAtIndex($index)
    {
        return array_splice($this->fields, $index, 1);
    }

    public function removeField($name)
    {
        $index = $this->getFieldIndex($name);
        $this->removeFieldAtIndex($index);
    }

    public function replaceField($name, $field)
    {
        $index = $this->getFieldIndex($name);
        $this->removeFieldAtIndex($index);
        $this->insertFields($field, $index);
    }

    public function fieldNameExists($name)
    {
        try {
            $this->getFieldIndex($name);
        } catch (FieldNotFoundException $e) {
            return false;
        }

        return true;
    }

    public function getField($name)
    {
        return $this->fields[$this->getFieldIndex($name)];
    }

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

    public function modifyField($name, $modifications)
    {
        $field = $this->getField($name);
        $field = array_merge($field, $modifications);
        $this->replaceField($name, $field);
    }

    private function validateField($field)
    {
        return $this->validateFieldName($field);
    }

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
     *
     * @throws FieldNotFoundException if the field name doesn't exist
     *
     * @return integer Field Index
     */
    public function getFieldIndex($name)
    {
        foreach($this->getFields() as $index => $field) {
            if ($this->getFieldName($field) === $name) {
                return $index;
            }
        }

        throw new FieldNotFoundException("Field `{$name}` not found.");
    }
}

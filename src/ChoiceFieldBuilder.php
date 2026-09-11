<?php

namespace StoutLogic\AcfBuilder;

/**
 * Builds configurations for an ACF Field
 */
class ChoiceFieldBuilder extends FieldBuilder
{
    /**
     * @var array
     */
    private $choices = [];

    /**
     * @param string $name Field Name, conventionally 'snake_case'.
     * @param string $type Field Type.
     * @param array $config Additional Field Configuration.
     */
    public function __construct($name, $type, $config = [])
    {
        if (array_key_exists('choices', $config)) {
            $this->setChoices($config['choices']);
            unset($config['choices']);
        }
        parent::__construct($name, $type, $config);
    }

    /**
     * Add a choice with optional label. If label not supplied, choice value
     * will be used.
     * @param string $choice choice value
     * @param string $label  label that appears
     * @return $this
     */
    public function addChoice($choice, $label = null)
    {
        $label ?: $label = $choice;
        $this->choices[$choice] = $label;
        return $this;
    }

    /**
     * Add multiple choices. Also accepts multiple arguments, one for each choice.
     * @param array $choices Can be an array of key values ['choice' => 'label']
     * @return $this
     */
    public function addChoices($choices)
    {
        if (func_num_args() > 1) {
            $choices = func_get_args();
        }

        $isIndexedArray = array_keys($choices) === range(0, count($choices) - 1);

        foreach ($choices as $key => $value) {
            $parsed = $this->parseChoiceItem($key, $value, $isIndexedArray);
            $this->addChoice($parsed[0], $parsed[1]);
        }

        return $this;
    }

    /**
     * Parse a choice item to extract the choice value and label.
     * 
     * @param mixed $key The array key
     * @param mixed $value The array value
     * @param bool $isIndexedArray Whether the parent array is indexed (0, 1, 2...)
     * @return array [$choice, $label]
     */
    private function parseChoiceItem($key, $value, $isIndexedArray)
    {
        // Handle associative array choice: ['choice' => 'label']
        if (is_array($value)) {
            $choice = array_keys($value)[0];
            $label = array_values($value)[0];
            return [$choice, $label];
        }

        // Handle a choice without a label, use the value as both choice and label
        if ($isIndexedArray) {
            return [$value, $value];
        }

        // Handle choice array format where the key is explicitly defined
        return [$key, $value];
    }

    /**
     * Discards existing choices and adds multiple choices.
     * Also accepts multiple arguments, one for each choice.
     * @param array $choices Can be an array of key values ['choice' => 'label']
     * @return $this
     */
    public function setChoices($choices)
    {
        if (func_num_args() > 1) {
            $choices = func_get_args();
        }

        $this->choices = [];
        return $this->addChoices($choices);
    }

    /**
     * @return array
     */
    private function getChoices()
    {
        return $this->choices;
    }

    /**
     * Build the field configuration array
     * @return array Field configuration array
     */
    public function build()
    {
        return array_merge([
            'choices' => $this->getChoices()
        ], parent::build());
    }
}

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

        foreach ($choices as $key => $value) {
            $label = $choice = $value;

            if (is_array($choice)) {
                $label = array_values($choice)[0];
                $choice = array_keys($choice)[0];
            } else if (is_string($key)) {
                $choice = $key;
                $label = $value;
            }

            $this->addChoice($choice, $label);
        }

        return $this;
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

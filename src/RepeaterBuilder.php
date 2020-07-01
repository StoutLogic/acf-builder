<?php

namespace StoutLogic\AcfBuilder;

/**
 * Repeater field
 * Can add multiple fields as subfields to the repeater.
 */
class RepeaterBuilder extends GroupBuilder
{
    use Traits\CanSingularize;

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
        if (array_key_exists('collapsed', $config)) {
            $fieldKey = $this->fieldsBuilder->getField($config['collapsed'])->getKey();
            $fieldKey = preg_replace('/^field_/', '', $fieldKey);
            $config['collapsed'] = $this->getName() . '_' . $fieldKey;
        }
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
     * @inheritdoc
     */
    public function end()
    {
        return $this->endRepeater();
    }

    /**
     * Gerenates the default button label.
     * @return string
     */
    private function getDefaultButtonLabel()
    {
        return 'Add ' . $this->singularize($this->getLabel());
    }
}

<?php

namespace StoutLogic\AcfBuilder;

/**
 * Repeater field
 * Can add multiple fields as subfields to the repeater.
 *
 * @api
 */
class RepeaterBuilder extends GroupBuilder
{
    use Traits\CanSingularize;

    /**
     * Used to contain and add fields
     *
     * @var FieldsBuilder
     */
    protected $fieldsBuilder;

    /**
     * Create a repeater field builder.
     *
     * @param string $name Field name.
     * @param string $type Field name.
     * @param array  $config Field configuration.
     * @api
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
     *
     * @return array
     * @api
     */
    public function build()
    {
        $config = parent::build();
        if (array_key_exists('collapsed', $config)) {
            $collapseField = $this->fieldsBuilder->getField($config['collapsed']);
            $fieldKey = $collapseField->getKey();
            if ($collapseField->hasCustomKey()) {
                $config['collapsed'] = $fieldKey;
                $config['_has_custom_collapsed_key'] = true;
            } else {
                $fieldKey = preg_replace('/^field_/', '', $fieldKey);
                $config['collapsed'] = $this->getName() . '_' . $fieldKey;
            }
        }
        return $config;
    }

    /**
     * Returns call chain to parentContext
     *
     * @return Builder
     * @example
     *
     * ```php
     * $fields
     *  ->addRepeater('slides')
     *  ->addText('title')
     *  ->endRepeater();
     * ```
     * @api
     */
    public function endRepeater()
    {
        return $this->getParentContext();
    }

    /**
     * Return to the parent builder context.
     *
     * @inheritdoc
     * @return Builder
     * @api
     */
    public function end()
    {
        return $this->endRepeater();
    }

    /**
     * Generates the default button label.
     *
     * @return string
     */
    private function getDefaultButtonLabel()
    {
        return 'Add ' . $this->singularize($this->getLabel());
    }
}

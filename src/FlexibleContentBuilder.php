<?php

namespace StoutLogic\AcfBuilder;

/**
 * Create a configuration array for an ACF Flexible Content field.
 * A flexible content field can have many different `layouts` which are
 * groups of fields.
 */
class FlexibleContentBuilder extends FieldBuilder
{
    use Traits\CanSingularize;

    /**
     * @var array
     */
    private $layouts = [];

    /**
     * @param string $name Field name
     * @param string $type Field name
     * @param array $config Field configuration
     */
    public function __construct($name, $type = 'flexible_content', $config = [])
    {
        parent::__construct($name, $type, $config);

        if (!isset($config['button_label'])) {
            $this->setConfig('button_label', $this->getDefaultButtonLabel());
        }
    }

    /**
     * Return a configuration array
     * @return array
     */
    public function build()
    {
        return array_merge(parent::build(), [
            'layouts' => $this->buildLayouts(),
        ]);
    }

    /**
     * Return a configuration array for each layout
     * @return array
     */
    private function buildLayouts()
    {
        return array_map(function($layout) {
            $layout = ($layout instanceof Builder) ? $layout->build() : $layout;
            return $this->transformLayout($layout);
        }, $this->getLayouts());
    }

    /**
     * Apply transformations to a layout
     * @param  array $layout Layout configuration array
     * @return array Transformed layout configuration array
     */
    private function transformLayout($layout)
    {
        $layoutTransform = new Transform\FlexibleContentLayout($this);
        $namespaceTransform = new Transform\NamespaceFieldKey($this);

        return
            $namespaceTransform->transform(
                $layoutTransform->transform($layout)
            );
    }

    /**
     * Add a layout, which is a FieldsBuilder. `addLayout` can be chained to add
     * multiple layouts to the Flexible Content field.
     * @param string|FieldsBuilder $layout layout name.
     * Alternatively supply a FieldsBuilder to reuse existing fields. The name
     * will be inferred from the FieldsBuilder's name.
     * @param array $args filed configuration
     * @return FieldsBuilder
     */
    public function addLayout($layout, $args = [])
    {
        if ($layout instanceof FieldsBuilder) {
            $layout = clone $layout;
        } else {
            $layout = new FieldsBuilder($layout, $args);
        }

        $layout = $this->initializeLayout($layout, $args);
        $this->pushLayout($layout);

        return $layout;
    }

    /**
     * Configures the layout FieldsBuilder
     * @param  FieldsBuilder $layout
     * @param  array         $args FieldGroup Configuration
     * @return FieldsBuilder Configured Layout
     */
    protected function initializeLayout(FieldsBuilder $layout, $args = [])
    {
        $layout->setGroupConfig('name', $layout->getName());
        $layout->setGroupConfig('display', 'block');

        foreach ($args as $key => $value) {
            $layout->setGroupConfig($key, $value);
        }

        $layout->setParentContext($this);

        return $layout;
    }

    /**
     * End the current Flexible Content field, return to parent context
     * @return Builder
     */
    public function endFlexibleContent()
    {
        return $this->getParentContext();
    }

    /**
     * Add layout to internal array
     * @param  FieldsBuilder $layout
     * @return void
     */
    protected function pushLayout($layout)
    {
        $this->layouts[] = $layout;
    }

    /**
     * @return FieldsBuilder[]
     */
    public function getLayouts()
    {
        return $this->layouts;
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

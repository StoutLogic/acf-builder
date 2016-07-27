<?php

namespace StoutLogic\AcfBuilder;

/**
 * Create a configuration array for an ACF Flexible Content field.
 * A flexible content field can have many different `layouts` which are
 * groups of fields.
 */
class FlexibleContentBuilder extends Builder implements NamedBuilder
{
    /**
     * @var array
     */
    private $config = [];

    /**
     * @var array
     */
    private $layouts = [];

    /**
     * Field Name
     * @var string
     */
    private $name;

    /**
     * @param string $name
     * @param array $args field configuration
     */
    public function __construct($name, $args = [])
    {
        $this->name = $name;
        $this->config = array_merge(
            [
                'key' => $name,
                'name' => $name,
                'label' => $this->generateLabel($name),
                'type' => 'flexible_content',
            ],
            $args
        );

        if (!isset($this->config['button'])) {
            $this->config['button'] = 'Add '.rtrim($this->config['label'], 's');
        }
    }

    /**
     * Return a configuration array
     * @return array
     */
    public function build()
    {
        return array_merge($this->config, [
            'layouts' => $this->buildLayouts(),
        ]);
    }

    /**
     * Return a configuration array for each layout
     * @return array
     */
    private function buildLayouts()
    {
        return array_map(function ($layout) {
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
     * @return string Flexible Content field name
     */
    public function getName()
    {
        return $this->name;
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

        $layout = $this->configureLayout($layout, $args);
        $this->pushLayout($layout);

        return $layout;
    }

    /**
     * Configures the layout FieldsBuilder
     * @param  FieldsBuilder $layout
     * @param  array         $args FieldGroup Configuration
     * @return FieldsBuilder Configured Layout
     */
    protected function configureLayout(FieldsBuilder $layout, $args = [])
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
     * @return array[FieldsBuilder]
     */
    public function getLayouts()
    {
        return $this->layouts;
    }

    /**
     * Generate a label based on the name. Title case.
     * @param  string $name
     * @return string
     */
    protected function generateLabel($name)
    {
        return ucwords(str_replace("_", " ", $name));
    }
}

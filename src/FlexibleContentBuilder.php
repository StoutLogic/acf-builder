<?php

namespace StoutLogic\AcfBuilder;

use StoutLogic\AcfBuilder\Exceptions\FieldNotFoundException;
use StoutLogic\AcfBuilder\Exceptions\LayoutNotFoundException;

/**
 * Create a configuration array for an ACF Flexible Content field.
 * A flexible content field can have many different `layouts` which are
 * groups of fields.
 *
 * @api
 */
class FlexibleContentBuilder extends FieldBuilder
{
    use Traits\CanSingularize;

    /**
     * @var array
     */
    private $layouts = [];

    /**
     * Create a flexible content field builder.
     *
     * @param string $name Field name.
     * @param string $type Field name.
     * @param array  $config Field configuration.
     * @api
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
     *
     * @return array
     * @api
     */
    public function build()
    {
        return array_merge(parent::build(), [
            'layouts' => $this->buildLayouts(),
        ]);
    }

    /**
     * Return a configuration array for each layout
     *
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
     *
     * @param  array $layout Layout configuration array.
     * @return array Transformed layout configuration array
     */
    private function transformLayout($layout)
    {
        $layoutTransform = new Transform\FlexibleContentLayout($this);
        $namespaceTransform = new Transform\NamespaceFieldKey($this);

        return $namespaceTransform->transform(
            $layoutTransform->transform($layout)
        );
    }

    /**
     * Add a layout, which is a FieldsBuilder. `addLayout` can be chained to add
     * multiple layouts to the Flexible Content field.
     *
     * @param string|FieldsBuilder $layout layout name.
     * Alternatively supply a FieldsBuilder to reuse existing fields. The name
     * will be inferred from the FieldsBuilder's name.
     * @param array                $args filed configuration.
     * @return FieldsBuilder
     * @example
     *
     * ```php
     * $fields
     *  ->addFlexibleContent('sections')
     *  ->addLayout('hero')
     *  ->addText('title');
     * ```
     * @api
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
     * Add multiple layouts either via an array or from another builder
     *
     * @param FieldsBuilder|array $layouts
     * @return $this
     * @api
     */
    public function addLayouts($layouts)
    {
        foreach ($layouts as $layout) {
            $this->addLayout($layout);
        }
        return $this;
    }

    /**
     * Configures the layout FieldsBuilder
     *
     * @param  FieldsBuilder $layout
     * @param  array         $args FieldGroup Configuration.
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
     *
     * @return Builder
     * @example
     *
     * ```php
     * $fields
     *  ->addFlexibleContent('sections')
     *  ->addLayout('hero')
     *  ->endFlexibleContent();
     * ```
     * @api
     */
    public function endFlexibleContent()
    {
        return $this->getParentContext();
    }

    /**
     * Add layout to internal array
     *
     * @param  FieldsBuilder $layout
     * @return void
     */
    protected function pushLayout($layout)
    {
        $this->layouts[] = $layout;
    }

    /**
     * Return all layouts in this flexible content field.
     *
     * @return FieldsBuilder[]
     * @api
     */
    public function getLayouts()
    {
        return $this->layouts;
    }

    /**
     * Return a layout by name.
     *
     * @param string $name Layout name.
     * @return FieldsBuilder
     * @throws LayoutNotFoundException If the layout doesn't exist.
     * @api
     */
    public function getLayout($name)
    {
        $layouts = array_filter($this->getLayouts(), static fn(FieldsBuilder $layout) => $layout->getName() === $name);

        if (count($layouts) === 0) {
            throw new LayoutNotFoundException("Layout `{$name}` not found.");
        }

        return array_shift($layouts);
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

    /**
     * Remove a layout by name.
     *
     * @param string $name Layout name.
     * @return $this
     * @throws LayoutNotFoundException If the layout doesn't exist.
     * @api
     */
    public function removeLayout($name)
    {
        if (!$this->layoutExists($name)) {
            throw new LayoutNotFoundException("Layout `{$name}` not found.");
        }

        $this->layouts = array_values(array_filter($this->getLayouts(), static fn(FieldsBuilder $layout) => $layout->getName() !== $name));

        return $this;
    }

    /**
     * Determine whether a layout exists in this field.
     *
     * @param string $name Layout name.
     * @return bool
     * @api
     */
    public function layoutExists($name)
    {
        $layouts = array_filter($this->getLayouts(), static fn(FieldsBuilder $layout) => $layout->getName() === $name);

        return count($layouts) !== 0;
    }

    /**
     * Modify a layout or nested field.
     *
     * @param string $name
     * @param array  $modify
     * @return $this
     * @throws \Exception If $modify is a closure, which isn't supported for layouts or flexible content.
     * @api
     */
    public function modifyField($name, $modify)
    {
        if ($this->hasDeeplyNestedField($name)) {
            $fieldNames = explode(FieldsBuilder::DEEP_NESTING_DELIMITER, $name, 2);
            $this->getLayout($fieldNames[0])->modifyField($fieldNames[1], $modify);
            return $this;
        }

        if ($this->layoutExists($name)) {
            // Modify layout's FieldsBuilder, update Group Config.
            if (is_array($modify)) {
                $this->getLayout($name)->updateGroupConfig($modify);
            } elseif ($modify instanceof \Closure) {
                throw new \Exception('FieldsBuilder can\'t be modified with a closure.');
            }
        } elseif (is_array($modify)) {
            $this->updateConfig($modify);
        } elseif ($modify instanceof \Closure) {
            throw new \Exception('FlexibleContentBuilder can\'t be modified with a closure.');
        }

        return $this;
    }

    /**
     * Remove a layout or nested field by name.
     *
     * @param string $name Layout or nested field name.
     * @return $this
     * @api
     */
    public function removeField($name)
    {
        if ($this->hasDeeplyNestedField($name)) {
            $fieldNames = explode(FieldsBuilder::DEEP_NESTING_DELIMITER, $name, 2);
            $this->getLayout($fieldNames[0])->removeField($fieldNames[1]);
            return $this;
        }

        $this->removeLayout($name);
        return $this;
    }

    /**
     * @param string $name Deeply nested field name.
     * @return bool
     */
    private function hasDeeplyNestedField($name)
    {
        return strpos($name, FieldsBuilder::DEEP_NESTING_DELIMITER) > 0;
    }
}

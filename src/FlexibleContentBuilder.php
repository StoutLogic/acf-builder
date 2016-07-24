<?php

namespace StoutLogic\AcfBuilder;

class FlexibleContentBuilder extends Builder implements NamedBuilder
{
    private $config = [];
    private $layouts = [];

    private $name;

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

    public function build()
    {
        return array_merge($this->config, [
            'layouts' => $this->buildLayouts(),
        ]);
    }

    private function buildLayouts()
    {
        return array_map(function($layout) {
            $layout = ($layout instanceof Builder) ? $layout->build() : $layout;
            return $this->transformLayout($layout);
        }, $this->getLayouts());
    }

    private function transformLayout($layout)
    {
        $layoutTransform = new Transform\FlexibleContentLayout($this);
        $namespaceTransform = new Transform\NamespaceFieldKey($this);

        return
            $namespaceTransform->transform(
                $layoutTransform->transform($layout)
            );
    }

    public function getName()
    {
        return $this->name;
    }

    public function addLayout($layout, $args = [])
    {
        if ($layout instanceof FieldsBuilder) {
            $layout = clone $layout;
        } else {
            $layout = new FieldsBuilder($layout, $args);
        }

        $layout->setGroupConfig('name', $layout->getName());
        $layout->setGroupConfig('display', 'block');

        foreach ($args as $key => $value) {
            $layout->setGroupConfig($key, $value);
        }

        $layout->setParentContext($this);
        $this->pushLayout($layout);

        return $layout;
    }

    public function endFlexibleContent()
    {
        return $this->getParentContext();
    }

    protected function pushLayout($layout)
    {
        $this->layouts[] = $layout;
    }

    public function getLayouts()
    {
        return $this->layouts;
    }

    protected function generateLabel($name)
    {
        return ucwords(str_replace("_", " ", $name));
    }
}

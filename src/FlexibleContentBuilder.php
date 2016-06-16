<?php

namespace StoutLogic\AcfBuilder;

class FlexibleContentBuilder extends Builder
{
    private $config = [];
    private $layouts = [];

    public function __construct($name, $args = [])
    {
        $this->config = array_merge(
            [
                'key' => 'field_'.$name,
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
        $layouts = $this->getLayouts();

        foreach ($layouts as $i => $layout) {
            if (is_a($layout, Builder::class)) {
                $layout = $layout->build();
            }
            $layouts[$i] = $this->transformLayout($layout);
        }

        return array_merge($this->config, [
            'layouts' => $layouts,
        ]);
    }

    public function transformLayout($layoutConfig)
    {
        $layoutConfig['sub_fields'] = $layoutConfig['fields'];
        unset($layoutConfig['fields']);

        $layoutConfig['label'] = $layoutConfig['title'];
        unset($layoutConfig['title']);

        return $layoutConfig;
    }

    public function addLayout($layout, $args = [])
    {
        if (is_a($layout, Builder::class)) {
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

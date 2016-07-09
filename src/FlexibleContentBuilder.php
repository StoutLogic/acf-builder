<?php

namespace StoutLogic\AcfBuilder;

class FlexibleContentBuilder extends Builder
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

    public function getName()
    {
        return $this->name;
    }

    /**
     * Namespace a field key
     * Append the namespace consitint of 'field' and the group's name before the
     * set key.
     *
     * @param  string $key Field Key
     * @return string      Field Key
     */
    private function namespaceFieldKey($key)
    {
        $namespace = 'field_';

        if ($this->getName()) {
            // remove field_ if already at the begining of the key
            $key = preg_replace('/^field_/', '', $key);
            $key = preg_replace('/^group_/', '', $key);
            $namespace .= str_replace(' ', '_', $this->getName()).'_';
        }
        return strtolower($namespace.$key);
    }

    /**
     * Namespace all field keys so they are unique for each field group
     * @param  array $fields Fields
     * @return array         Fields
     */
    private function namespaceFieldKeys($fields)
    {
        array_walk_recursive($fields, function(&$value, $key) {
            switch ($key) {
                case 'key':
                case 'field':
                    $value = $this->namespaceFieldKey($value);
                    break;
            }
        });
        return $fields;
    }

    public function transformLayout($layoutConfig)
    {
        $layoutConfig['sub_fields'] = $layoutConfig['fields'];
        unset($layoutConfig['fields']);

        $layoutConfig['label'] = $layoutConfig['title'];
        unset($layoutConfig['title']);


        $layoutConfig = $this->namespaceFieldKeys($layoutConfig);
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

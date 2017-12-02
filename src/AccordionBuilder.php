<?php

namespace StoutLogic\AcfBuilder;

class AccordionBuilder extends TabBuilder
{
    public function __construct($name, $type = 'accordion', $config = [])
    {
       parent::__construct($name, $type, $config);
    }

    public function setOpen($value = 1)
    {
        return $this->setConfig('open', $value ? 1 : 0);
    }

    public function setMultiExpand($value = 1)
    {
        return $this->setConfig('multi_expand', $value ? 1 : 0);
    }
}
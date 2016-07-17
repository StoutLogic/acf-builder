<?php

namespace StoutLogic\AcfBuilder\Transform;

use StoutLogic\AcfBuilder\Builder;

abstract class Transform
{
    private $bulider;

    public function __construct(Builder $builder)
    {
        $this->builder = $builder;
    }

    public function getBuilder()
    {
        return $this->builder;
    }

    /**
     * Impelment in all discrete classes
     * @param  array $config input
     * @return array output config
     */
    abstract public function transform($config);
}

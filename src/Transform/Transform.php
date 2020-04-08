<?php

namespace StoutLogic\AcfBuilder\Transform;

use StoutLogic\AcfBuilder\Builder;

/**
 * A Transform that is applied to configuration array of a Builder
 * @template B of Builder
 */
abstract class Transform
{
    /**
     * Used to call funtions on the builder.
     * @var B
     */
    private $builder;

    /**
     * @param B $builder
     */
    public function __construct(Builder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * @return B
     */
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

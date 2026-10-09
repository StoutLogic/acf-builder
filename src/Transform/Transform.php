<?php

namespace StoutLogic\AcfBuilder\Transform;

use StoutLogic\AcfBuilder\Builder;

/**
 * A Transform that is applied to configuration array of a Builder
 */
abstract class Transform
{
    /**
     * @param Builder $builder
     */
    public function __construct(
        /**
         * Used to call functions on the builder.
         */
        private readonly Builder $builder
    )
    {
    }

    /**
     * @return Builder
     */
    public function getBuilder()
    {
        return $this->builder;
    }

    /**
     * Implement in all discrete classes
     *
     * @param  array $config input.
     * @return array output config
     */
    abstract public function transform($config);
}

<?php

namespace StoutLogic\AcfBuilder;

/**
 * Builds a configuration.
 * Can have parent contexts to delegate missing methods to.
 */
abstract class Builder
{
    /**
     * The parent Builder, if this is a child Builder
     * @var Builder
     */
    private $parentContext;

    /**
     * Builds the configuration
     * @return array configuration
     */
    abstract public function build();

    /**
     * @param Builder $builder
     */
    public function setParentContext(Builder $builder)
    {
        $this->parentContext = $builder;
    }

    /**
     * @return Builder
     */
    public function getParentContext()
    {
        return $this->parentContext;
    }

    /**
     * If a method is missing, check to see if it exist on the $parentContext
     * and delegate the call to it.
     * @param  string $method
     * @param  array $args
     * @throws \Exception when a method is not found on the $parentContext
     * @return mixed
     */
    public function __call($method, $args)
    {
        if ($this->parentContext) {
            return call_user_func_array([$this->parentContext, $method], $args);
        }

        throw new \Exception('No such function: '.$method);
    }
}

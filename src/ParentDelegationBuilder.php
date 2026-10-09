<?php

namespace StoutLogic\AcfBuilder;

/**
 * Builds a configuration.
 * Can have parent contexts to delegate missing methods to.
 *
 * @api
 */
abstract class ParentDelegationBuilder implements Builder
{
    /**
     * The parent Builder, if this is a child Builder
     *
     * @var Builder
     */
    private $parentContext;

    /**
     * Builds the configuration
     *
     * @return array configuration
     * @api
     */
    abstract public function build();

    /**
     * Set the parent builder used for delegated method calls.
     *
     * @param Builder $builder
     * @return void
     * @api
     */
    public function setParentContext(Builder $builder)
    {
        $this->parentContext = $builder;
    }

    /**
     * Return the parent builder context.
     *
     * @return Builder
     * @api
     */
    public function getParentContext()
    {
        return $this->parentContext;
    }

    /**
     * Returns the root context
     *
     * @return Builder
     * @api
     */
    public function getRootContext()
    {
        if ($parentContext = $this->getParentContext()) {
            if ($parentContext instanceof ParentDelegationBuilder) {
                return $parentContext->getRootContext();
            }
            return $parentContext;
        }

        return $this;
    }

    /**
     * If a method is missing, check to see if it exist on the $parentContext
     * and delegate the call to it.
     *
     * @param  string $method
     * @param  array  $args
     * @throws \Exception When a method is not found on the $parentContext.
     * @return mixed
     * @api
     */
    public function __call($method, $args)
    {
        if ($this->parentContext) {
            return call_user_func_array([$this->parentContext, $method], $args);
        }

        throw new \Exception('No such function: ' . $method);
    }
}

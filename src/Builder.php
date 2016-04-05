<?php

namespace Understory\Fields;

abstract class Builder
{
    private $parentContext;

    abstract public function build();

    public function setParentContext(Builder $builder)
    {
        $this->parentContext = $builder;
    }

    public function getParentContext()
    {
        return $this->parentContext;
    }

    public function __call($method, $args) {
        if (isset($this->parentContext)) {
            return call_user_func_array([$this->parentContext, $method], $args);
        }    

        throw new \Exception('No such function: '.$method);
    }
}

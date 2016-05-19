<?php

namespace StoutLogic\AcfBuilder;

class ConditionalBuilder extends Builder
{
    private $config = [[]];

    public function __construct($name, $operator, $value)
    {
        $this->and($name, $operator, $value);
    }

    public function build()
    {
        return $this->config;
    }

    public function andCondition($name, $operator, $value)
    {
        $orCondition = $this->popOrCondition();
        $orCondition[] = $this->createCondition($name, $operator, $value);
        $this->pushOrCondition($orCondition);

        return $this;
    }

    public function orCondition($name, $operator, $value)
    {
        $condition = $this->createCondition($name, $operator, $value);
        $this->pushOrCondition([$condition]);

        return $this;
    }

    protected function createCondition($name, $operator, $value)
    {
        return [
            'field' => $name,
            'operator' => $operator,
            'value' => $value,
        ];
    }

    protected function popOrCondition()
    {
        return array_pop($this->config);
    }

    protected function pushOrCondition($condition)
    {
        $this->config[] = $condition;
    }

    /**
     * Allow the use of reserved words and / or for methods
     */
    public function __call($methodName, $arguments) {
        if ($methodName === 'and') {
            list($name, $operator, $value) = $arguments;
            return $this->andCondition($name, $operator, $value);
        }
        else if ($methodName === 'or') {
            list($name, $operator, $value) = $arguments;
            return $this->orCondition($name, $operator, $value);
        }
        else {
            return parent::__call($methodName, $arguments);
        }
    }
}

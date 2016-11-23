<?php

namespace StoutLogic\AcfBuilder;

/**
 * @method ConditionalBuilder and(string $name, string $operator, string $value)
 * @method ConditionalBuilder or(string $name, string $operator, string $value)
 */
class ConditionalBuilder extends ParentDelegationBuilder
{
    /**
     * Conditional Rules
     * @var array[array]
     */
    private $config = [[]];

    /**
     * Creates the first rule. Additional rules can be chained use `or` and `and`
     * @param string $name
     * @param string $operator
     * @param string $value
     */
    public function __construct($name, $operator, $value)
    {
        $this->and($name, $operator, $value);
    }

    /**
     * Build the config
     * @return array
     */
    public function build()
    {
        return $this->config;
    }

    /**
     * Creates an AND condition
     * @param  string $name
     * @param  string $operator
     * @param  string $value
     * @return $this
     */
    public function andCondition($name, $operator, $value)
    {
        $orCondition = $this->popOrCondition();
        $orCondition[] = $this->createCondition($name, $operator, $value);
        $this->pushOrCondition($orCondition);

        return $this;
    }

    /**
     * Creates an OR condition
     * @param  string $name
     * @param  string $operator
     * @param  string $value
     * @return $this
     */
    public function orCondition($name, $operator, $value)
    {
        $condition = $this->createCondition($name, $operator, $value);
        $this->pushOrCondition([$condition]);

        return $this;
    }

    /**
     * Creates a condition
     * @param  string $name
     * @param  string $operator
     * @param  string $value
     * @return array
     */
    protected function createCondition($name, $operator, $value)
    {
        return [
            'field' => $name,
            'operator' => $operator,
            'value' => $value,
        ];
    }

    /**
     * Removes and returns the last top level OR condition
     * @return array
     */
    protected function popOrCondition()
    {
        return array_pop($this->config);
    }

    /**
     * Adds a top level OR condition
     * @param  array $condition
     * @return void
     */
    protected function pushOrCondition($condition)
    {
        $this->config[] = $condition;
    }

    /**
     * Allow the use of reserved words and / or for methods. If `and` or `or`
     * are not matched, call the method on the parentContext
     * @param string $methodName
     * @param array $arguments
     * @return mixed
     */
    public function __call($methodName, $arguments)
    {
        if ($methodName === 'and') {
            list($name, $operator, $value) = $arguments;
            return $this->andCondition($name, $operator, $value);
        } elseif ($methodName === 'or') {
            list($name, $operator, $value) = $arguments;
            return $this->orCondition($name, $operator, $value);
        } else {
            return parent::__call($methodName, $arguments);
        }
    }
}

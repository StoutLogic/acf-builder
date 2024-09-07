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
     * @param string|null $value
     */
    public function __construct($name, $operator, $value = null)
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
     * @param  string|null $value
     * @return $this
     */
    public function andCondition($name, $operator, $value = null)
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
     * @param  string|null $value
     * @return $this
     */
    public function orCondition($name, $operator, $value = null)
    {
        $condition = $this->createCondition($name, $operator, $value);
        $this->pushOrCondition([$condition]);

        return $this;
    }

    /**
     * Creates a condition
     * @param  string $name
     * @param  string $operator
     * @param  string|null $value
     * @return array
     */
    protected function createCondition($name, $operator, $value = null)
    {
        return array_filter([
            'field' => $name,
            'operator' => $operator,
            'value' => $value,
        ], fn($value) => $value !== null);
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

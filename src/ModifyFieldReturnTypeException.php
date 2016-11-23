<?php

namespace StoutLogic\AcfBuilder;

/**
 * When a closure is passed to FieldsBuilder::modifyField, the closure
 * must return a FieldsBuilder or this exception is thrown.
 */
class ModifyFieldReturnTypeException extends \UnexpectedValueException
{
    /**
     * @param string $returnedType
     * @param int $code
     * @param \Exception|null
     */
    public function __construct($returnedType, $code = 0, $previous = null)
    {
        $message = 'Function "modifyField" closure argument is expected to return a StoutLogic\AcfBuilder\FieldsBuilder, '.$returnedType.' returned instead.';

        parent::__construct(trim($message), $code, $previous);
    }
}

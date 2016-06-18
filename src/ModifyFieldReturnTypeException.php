<?php

namespace StoutLogic\AcfBuilder;

class ModifyFieldReturnTypeException extends \UnexpectedValueException
{
    public function __construct($returnedType, $code = 0, $previous = NULL) {
        $message = 'Function "modifyField" closure argument is expected to return a StoutLogic\AcfBuilder\FieldsBuilder, '.$returnedType.' returned instead.';

        parent::__construct(trim($message), $code, $previous);
    }
}

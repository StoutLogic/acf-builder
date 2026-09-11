<?php

namespace StoutLogic\AcfBuilder;

/**
 * Builder with a name
 *
 * @api
 */
interface NamedBuilder extends Builder
{
    /**
     * Returns the name of the builder
     *
     * @return string name
     * @api
     */
    public function getName();
}

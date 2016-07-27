<?php

namespace StoutLogic\AcfBuilder;

/**
 * Interface for Builders that must have a name
 */
interface NamedBuilder
{
    /**
     * Returns the name of the builder
     * @return string name
     */
    public function getName();
}

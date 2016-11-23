<?php

namespace StoutLogic\AcfBuilder;

/**
 * Builder with a name
 */
interface NamedBuilder extends Builder
{
    /**
     * Returns the name of the builder
     * @return string name
     */
    public function getName();
}

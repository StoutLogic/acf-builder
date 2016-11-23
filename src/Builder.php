<?php

namespace StoutLogic\AcfBuilder;

/**
 * Interface for Builder
 * Builds a configuration array
 */
interface Builder
{
    /**
     * Builds the configuration
     * @return array configuration
     */
    public function build();
}

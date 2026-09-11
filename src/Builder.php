<?php

namespace StoutLogic\AcfBuilder;

/**
 * Interface for Builder
 * Builds a configuration array
 *
 * @api
 */
interface Builder
{
    /**
     * Builds the configuration
     *
     * @return array configuration
     * @api
     */
    public function build();
}

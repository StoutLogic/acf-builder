<?php

namespace StoutLogic\AcfBuilder;

/**
 * Builds configurations for an ACF accordion field.
 *
 * @api
 */
class AccordionBuilder extends TabBuilder
{
    /**
     * Create an accordion field builder.
     *
     * @param string $name Field name.
     * @param string $type Field type.
     * @param array  $config Field configuration.
     * @api
     */
    public function __construct($name, $type = 'accordion', $config = [])
    {
        parent::__construct($name, $type, $config);
    }

    /**
     * Set whether the accordion is open by default.
     *
     * @param bool|int $value Whether the accordion should be open.
     * @return $this
     * @api
     */
    public function setOpen($value = 1)
    {
        return $this->setConfig('open', $value ? 1 : 0);
    }

    /**
     * Set whether multiple accordion sections may be expanded.
     *
     * @param bool|int $value Whether multiple sections may be expanded.
     * @return $this
     * @api
     */
    public function setMultiExpand($value = 1)
    {
        return $this->setConfig('multi_expand', $value ? 1 : 0);
    }
}

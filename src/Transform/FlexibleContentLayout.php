<?php

namespace StoutLogic\AcfBuilder\Transform;

/**
 * Change the keys of a Builder to be consistent with an
 * ACF Flexible Content Layout:
 *     fields => sub_fields
 *     title => label
 */
class FlexibleContentLayout extends Transform
{
    /**
     * @param  array $config
     * @return array
     */
    public function transform($config)
    {
        $config['sub_fields'] = $config['fields'];
        unset($config['fields']);

        if (!array_key_exists('label', $config)) {
            $config['label'] = $config['title'];
        }
        unset($config['title']);

        return $config;
    }
}

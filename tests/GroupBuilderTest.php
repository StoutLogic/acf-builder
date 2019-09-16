<?php

namespace StoutLogic\AcfBuilder\Tests;

use StoutLogic\AcfBuilder\FieldsBuilder;
use StoutLogic\AcfBuilder\GroupBuilder;

class GroupBuilderTest extends \PHPUnit_Framework_TestCase
{
    public function testGroupBuilderCanAddFields()
    {
        $builder = new GroupBuilder('background');

        $builder->addColorPicker('color');

        $expectedConfig = [
            'name' => 'background',
            'type' => 'group',
            'sub_fields' => [
                [
                    'type' => 'color_picker',
                    'name' => 'color',
                ],
            ],

        ];

        $this->assertArraySubset($expectedConfig, $builder->build());
    }

    public function testGroupBuilderAddFieldsGroupFields()
    {
        $size = new FieldsBuilder('size');
        $size
            ->addNumber('width')
            ->addNumber('height');

        $builder = new GroupBuilder('background');

        $builder
            ->addColorPicker('color')
            ->addFields($size);

        $expectedConfig = [
            'name' => 'background',
            'type' => 'group',
            'sub_fields' => [
                [
                    'type' => 'color_picker',
                    'name' => 'color',
                ],
                [
                    'type' => 'number',
                    'name' => 'width',
                ],
                [
                    'type' => 'number',
                    'name' => 'height',
                ],
            ],

        ];

        $this->assertArraySubset($expectedConfig, $builder->build());
    }
}

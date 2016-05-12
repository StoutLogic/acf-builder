<?php

namespace StoutLogic\AcfBuilder\Tests;

use StoutLogic\AcfBuilder\ConditionalBuilder;

class ConditionalBuilderTest extends \PHPUnit_Framework_TestCase
{
    public function testContionalLogic()
    {
        $builder = new ConditionalBuilder('color', '==', 'other');

        $expectedConfig = [
            [
                [
                    'field' => 'color',
                    'operator'  =>  '==',
                    'value' => 'other',
                ],
            ]
        ];

        $this->assertArraySubset($expectedConfig, $builder->build());
    }

    public function testAnd()
    {
        $builder = new ConditionalBuilder('color', '==', 'other');
        $builder->and('number', '!=', '');

        $expectedConfig = [
            [
                [
                    'field' => 'color',
                    'operator'  =>  '==',
                    'value' => 'other',
                ],
                [
                    'field' => 'number',
                    'operator'  =>  '!=',
                    'value' => '',
                ],
            ]
        ];

        $this->assertArraySubset($expectedConfig, $builder->build());
    }

    public function testOr()
    {
        $builder = new ConditionalBuilder('color', '==', 'other');
        $builder->or('number', '>', '5')
                ->and('number', '<', '10')
                ->and('color', '!=', 'other');

        $expectedConfig = [
            [
                [
                    'field' => 'color',
                    'operator'  =>  '==',
                    'value' => 'other',
                ],
            ],
            [
                [
                    'field' => 'number',
                    'operator'  =>  '>',
                    'value' => '5',
                ],
                [
                    'field' => 'number',
                    'operator'  =>  '<',
                    'value' => '10',
                ],
                [
                    'field' => 'color',
                    'operator'  =>  '!=',
                    'value' => 'other',
                ],
            ],
        ];

        $this->assertArraySubset($expectedConfig, $builder->build());
    }
}
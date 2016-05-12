<?php

namespace StoutLogic\AcfBuilder\Tests;

use StoutLogic\AcfBuilder\LocationBuilder;

class LocationBuilderTest extends \PHPUnit_Framework_TestCase
{
    public function testLocation()
    {
        $builder = new LocationBuilder('post_type', '==', 'post');

        $expectedConfig = [
            [
                [
                    'param' => 'post_type',
                    'operator'  =>  '==',
                    'value' => 'post',
                ],
            ]
        ];

        $this->assertArraySubset($expectedConfig, $builder->build());
    }

    public function testAnd()
    {
        $builder = new LocationBuilder('post_type', '==', 'post');
        $builder->and('post_id', '!=', '1');

        $expectedConfig = [
            [
                [
                    'param' => 'post_type',
                    'operator'  =>  '==',
                    'value' => 'post',
                ],
                [
                    'param' => 'post_id',
                    'operator'  =>  '!=',
                    'value' => '1',
                ],
            ]
        ];

        $this->assertArraySubset($expectedConfig, $builder->build());
    }

    public function testOr()
    {
        $builder = new LocationBuilder('post_type', '==', 'post');
        $builder->or('post_type', '==', 'page')
                ->and('post_id', '!=', '10')
                ->and('post_id', '!=', '11');

        $expectedConfig = [
            [
                [
                    'param' => 'post_type',
                    'operator'  =>  '==',
                    'value' => 'post',
                ],
            ],
            [
                [
                    'param' => 'post_type',
                    'operator'  =>  '==',
                    'value' => 'page',
                ],
                [
                    'param' => 'post_id',
                    'operator'  =>  '!=',
                    'value' => '10',
                ],
                [
                    'param' => 'post_id',
                    'operator'  =>  '!=',
                    'value' => '11',
                ],
            ],
        ];

        $this->assertArraySubset($expectedConfig, $builder->build());
    }
}
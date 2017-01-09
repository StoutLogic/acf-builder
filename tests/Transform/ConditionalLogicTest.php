<?php

namespace StoutLogic\AcfBuilder\Tests\Transform;

use StoutLogic\AcfBuilder\FieldsBuilder;
use StoutLogic\AcfBuilder\FieldBuilder;
use StoutLogic\AcfBuilder\ConditionalBuilder;
use StoutLogic\AcfBuilder\Transform;

class ConditionalLogicTest extends \PHPUnit_Framework_TestCase
{
    public function testIsIterative()
    {
        $builder = $this->prophesize('\StoutLogic\AcfBuilder\FieldsBuilder');
        $transform = new Transform\ConditionalLogic($builder->reveal());
        $this->assertInstanceOf('\StoutLogic\AcfBuilder\Transform\IterativeTransform', $transform);
    }

    public function testGetKeys()
    {
        $builder = $this->prophesize('\StoutLogic\AcfBuilder\FieldsBuilder');
        $transform = new Transform\ConditionalLogic($builder->reveal());
        $this->assertSame(['conditional_logic'], $transform->getKeys());
    }

    public function testTransformValue()
    {
        $field = $this->prophesize('\StoutLogic\AcfBuilder\FieldBuilder');
        $field
            ->getKey()
            ->willReturn('field_name');

        $builder = $this->prophesize('\StoutLogic\AcfBuilder\FieldsBuilder');
        $builder
            ->getField('name')
            ->willReturn($field->reveal());

        $transform = new Transform\ConditionalLogic($builder->reveal());
        $this->assertSame([[[
            'field' => 'field_name',
            'operator' => '==',
            'value' => 1,
        ]]], $transform->transformValue([[[
            'field' => 'name',
            'operator' => '==',
            'value' => 1,
        ]]]));
    }

    public function testOnlyGetsAppliedOncePerLevel()
    {
        $builder = new \StoutLogic\AcfBuilder\FlexibleContentBuilder('name');
        $builder
            ->addLayout('hero')
                ->addImage( 'hero_image' )
                ->addWysiwyg( 'hero_text' )
                ->addRepeater('cta')
                    ->addSelect('link_type')
                        ->addChoices('internal', 'external', 'text')
                    ->addPageLink('cta_link', [
                        'post_type' => [
                            'page',
                            'post',
                            'product',
                        ],
                    ])
                        ->conditional('link_type', '==', 'internal');


        $expectedConfig = [
            'layouts' => [
                [
                    'name' => 'hero',
                    'sub_fields' => [
                        [
                            'name' => 'hero_image'
                        ],
                        [
                            'name' => 'hero_text'
                        ],
                        [
                            'name' => 'cta',
                            'sub_fields' => [
                                [
                                    'key' => 'field_name_hero_cta_link_type',
                                    'name' => 'link_type'
                                ],
                                [
                                    'key' => 'field_name_hero_cta_cta_link',
                                    'conditional_logic' => [
                                        [
                                            [
                                                'field' => 'field_name_hero_cta_link_type',
                                            ]
                                        ]
                                    ]

                                ]
                            ]
                        ]
                    ]
                ],
            ]
        ];

        $config = $builder->build();
        $this->assertArraySubset($expectedConfig, $config);

    }
}

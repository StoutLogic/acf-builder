<?php

namespace Understory\Fields\Tests;

use Understory\Fields\FlexibleContentBuilder;

class FlexibleContentBuilderTest extends \PHPUnit_Framework_TestCase
{
    public function testBuildFlexibleContent()
    {
        $builder = new FlexibleContentBuilder('content_areas');
        $builder->addLayout('banner')
                    ->addText('title')
                    ->addWysiwyg('content')
                ->addLayout('content_columns')
                    ->addRepeater('columns', ['min' => 1, 'max' => 2])
                        ->addWysiwyg('content');

        $expectedConfig =  [
            'key' => 'field_content_areas',
            'name' => 'content_areas',
            'label' => 'Content Areas',
            'type' => 'flexible_content',
            'button' => 'Add Content Area',
            'layouts' => [
                [
                    'key' => 'group_banner',
                    'name' => 'banner',
                    'label' => 'Banner',
                    'display' => 'block',
                    'sub_fields' => [
                        [
                            'name' => 'title',
                            'type' => 'text',
                        ],
                        [
                            'name' => 'content',
                            'type' => 'wysiwyg',
                        ]
                    ]
                ],
                [
                    'key' => 'group_content_columns',
                    'name' => 'content_columns',
                    'label' => 'Content Columns',
                    'display' => 'block',
                    'sub_fields' => [
                        [
                            'name' => 'columns',
                            'type' => 'repeater',
                            'min' => 1,
                            'max' => 2,
                            'sub_fields' => [
                                [
                                    'name' => 'content',
                                    'type' => 'wysiwyg',
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];
        
        $this->assertArraySubset($expectedConfig, $builder->build());
        $this->assertArrayNotHasKey('fields', $builder->build());
    }

    function testAddingFieldsBuilderAsLayout()
    {
        $banner = $this->getMockBuilder('Understory\Fields\FieldsBuilder')
                        ->setConstructorArgs(['parent'])
                        ->getMock();

        $banner->expects($this->once())->method('build')->willReturn([        
            'key' => 'group_banner',
            'name' => 'banner',
            'title' => 'Banner',
            'display' => 'block',
            'fields' => [
                [
                    'name' => 'title',
                    'type' => 'text',
                ],
                [
                    'name' => 'content',
                    'type' => 'wysiwyg',
                ]
            ]
        ]);

        $builder = new FlexibleContentBuilder('content_areas');
        $builder->addLayout($banner);

        $expectedConfig =  [
            'key' => 'field_content_areas',
            'name' => 'content_areas',
            'label' => 'Content Areas',
            'type' => 'flexible_content',
            'button' => 'Add Content Area',
            'layouts' => [
                [
                    'key' => 'group_banner',
                    'name' => 'banner',
                    'label' => 'Banner',
                    'display' => 'block',
                    'sub_fields' => [
                        [
                            'name' => 'title',
                            'type' => 'text',
                        ],
                        [
                            'name' => 'content',
                            'type' => 'wysiwyg',
                        ]
                    ]
                ],
            ]
        ];
        
        $this->assertArraySubset($expectedConfig, $builder->build());
    }
}

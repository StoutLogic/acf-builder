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

     public function testModifyGroup()
    {
        $subject = new GroupBuilder('test1');

        $subject->addText('text');

        $subject->modifyField('text', ['label' => 'new label']);
        
        $this->assertEquals([
            'key' => 'field_test1',
            'name' => 'test1',
            'label' => 'Test1',
            'type' => 'group',
            'sub_fields' => [
                [
                    'key' => 'field_test1_text',
                    'type' => 'text',
                    'name' => 'text',
                    'label' => 'new label'
                ]
            ]
        ], $subject->build());
    }

    public function testDeepModifyGroupWithArray() {
        $subject = new FieldsBuilder('test');

        $partial = new FieldsBuilder('test-partial');

        $partial
            ->addRepeater('items')
                ->addText('headline')
            ->endRepeater();

        $subject->addFields($partial);

        $subject->modifyField('items->headline', [
            'wrapper' => [
                'width' => '77%'
            ]
        ]);

        $this->assertEquals([
            'key' => 'group_test',
            'title' => 'Test',
            'fields' => [
                [
                    'type' => 'repeater',
                    'name' => 'items',
                    'label' => 'Items',
                    'key' => 'field_test_items',
                    'button_label' => 'Add Item',
                    'sub_fields' => [
                        [
                            'type' => 'text',
                            'label' => 'Headline',
                            'name' => 'headline',
                            'key' => 'field_test_items_headline',
                            'wrapper' => [
                                'width' => '77%'
                            ]
                        ]
                    ]
                ]
            ],
            'location' => null
        ], $subject->build());
    }


    public function testModifyGroupWithArrayWithoutDeepLinking() {
        $subject = new FieldsBuilder('test');
        $subject
            ->addRepeater('items')
                ->addText('headline');

        $subject->getField('items')->modifyField('headline', [
            'wrapper' => [
                'width' => '77%'
            ]
        ]);

        $this->assertEquals([
            'key' => 'group_test',
            'title' => 'Test',
            'fields' => [
                [
                    'type' => 'repeater',
                    'name' => 'items',
                    'label' => 'Items',
                    'key' => 'field_test_items',
                    'button_label' => 'Add Item',
                    'sub_fields' => [
                        [
                            'type' => 'text',
                            'label' => 'Headline',
                            'name' => 'headline',
                            'key' => 'field_test_items_headline',
                            'wrapper' => [
                                'width' => '77%'
                            ]
                        ]
                    ]
                ]
            ],
            'location' => null
        ], $subject->build());
    }

    public function testDeepModifyThreeLevelsGroupWithArray() {
        $subject = new FieldsBuilder('test');

        $subject
            ->addGroup('slides')
                ->addRepeater('slide')->setWidth("25%")
                    ->addText('headline')->setWidth('100%')
                    ->addTextarea('content');

        $subject->modifyField('slides->slide->headline', [
            'wrapper' => [
                'width' => '50%'
            ]
        ]);

        $this->assertArraySubset([
            'key' => 'group_test',
            'title' => 'Test',
            'fields' => [
                [
                    'name' => 'slides',
                    'type' => 'group',
                    'sub_fields' => [
                        [
                            'type' => 'repeater',
                            'name' => 'slide',
                            'wrapper' => [
                                'width' => '25%'
                            ],
                            'sub_fields' => [
                                [
                                    'type' => 'text',
                                    'name' => 'headline',
                                    'wrapper' => [
                                        'width' => '50%'
                                    ]
                                ],
                                [
                                    'type' => 'textarea',
                                    'name' => 'content',
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ], $subject->build());
    }

    public function testDeepModifyGroupWithClosure() {
        $subject = new FieldsBuilder('test');

        $subject
            ->addGroup('slides')
            ->addRepeater('slide')->setWidth("25%")
            ->addText('headline')->setWidth('100%')
            ->addTextarea('content');

        $subject->modifyField('slides->slide', function(FieldsBuilder $builder) {
            $builder
                ->getField('slide')
                    ->setWidth("50%");

            $builder->addLink('cta');

            return $builder;
        });

        $this->assertArraySubset([
            'key' => 'group_test',
            'title' => 'Test',
            'fields' => [
                [
                    'name' => 'slides',
                    'type' => 'group',
                    'sub_fields' => [
                        [
                            'type' => 'repeater',
                            'name' => 'slide',
                            'wrapper' => [
                                'width' => '50%'
                            ],
                            'sub_fields' => [
                                [
                                    'type' => 'text',
                                    'name' => 'headline',
                                    'wrapper' => [
                                        'width' => '100%'
                                    ]
                                ],
                                [
                                    'type' => 'textarea',
                                    'name' => 'content',
                                ],
                            ]
                        ],
                        [
                            'type' => 'link',
                            'name' => 'cta',
                        ],
                    ]
                ]
            ]
        ], $subject->build());
    }

    public function testDeepModifyThreeLevelsGroupWithClosure() {
        $subject = new FieldsBuilder('test');

        $subject
            ->addGroup('slides')
                ->addRepeater('slide')->setWidth("25%")
                    ->addText('headline')->setWidth('100%')
                    ->addTextarea('content');

        $subject->modifyField('slides->slide->headline', function(FieldsBuilder $builder) {
            $builder->addLink('cta');
            return $builder;
        });

        $this->assertArraySubset([
            'key' => 'group_test',
            'title' => 'Test',
            'fields' => [
                [
                    'name' => 'slides',
                    'type' => 'group',
                    'sub_fields' => [
                        [
                            'type' => 'repeater',
                            'name' => 'slide',
                            'wrapper' => [
                                'width' => '25%'
                            ],
                            'sub_fields' => [
                                [
                                    'type' => 'text',
                                    'name' => 'headline',
                                    'wrapper' => [
                                        'width' => '100%'
                                    ]
                                ],
                                [
                                    'type' => 'link',
                                    'name' => 'cta',
                                ],
                                [
                                    'type' => 'textarea',
                                    'name' => 'content',
                                ],
                            ]
                        ]
                    ]
                ]
            ]
        ], $subject->build());
    }

    public function testRemovingGroup()
    {
        $subject = new GroupBuilder('test1');

        $subject->addText('text');
        $subject->addText('text2');
        $subject->addText('text3');

        $subject->removeField('text2');

        $builtSubject = $subject->build();

        $this->assertCount(2, $builtSubject['sub_fields']);
        $this->assertEquals([
            [
                'type' => 'text',
                'name' => 'text',
                'label' => 'Text',
                'key' => 'field_test1_text'
            ],
            [
                'type' => 'text',
                'name' => 'text3',
                'label' => 'Text3',
                'key' => 'field_test1_text3'
            ],
        ], $builtSubject['sub_fields']);
    }

    public function testDeeplyNestedRemoveField() {
        $subject = new FieldsBuilder('test');

        $subject
            ->addGroup('slides')
            ->addRepeater('slide')->setWidth("25%")
                ->addText('headline')->setWidth('100%')
                ->addTextarea('content')
                ->addLink('cta');

        $preConfig = $subject->build();
        $this->assertCount(3, $preConfig['fields'][0]['sub_fields'][0]['sub_fields']);

        $subject->removeField('slides->slide->content');

        $postConfig = $subject->build();
        $this->assertCount(2, $postConfig['fields'][0]['sub_fields'][0]['sub_fields']);
    }

    /**
     * @expectedException StoutLogic\AcfBuilder\FieldNotFoundException
     */
    public function testRemovingGroupNotFound()
    {
        $subject = new GroupBuilder('test1');

        $subject->addText('text');
        $subject->addText('text2');
        $subject->addText('text3');

        $subject->removeField('text4');
    }


}

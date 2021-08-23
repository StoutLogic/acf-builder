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
                ->addText('title')
            ->endRepeater();

        $subject->addFields($partial);

        $subject->modifyField('items.title', [
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
                            'label' => 'Title',
                            'name' => 'title',
                            'key' => 'field_test_items_title',
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

    public function testRemovingGroup()
    {
        $subject = new GroupBuilder('test1');

        $subject->addText('text');
        $subject->addText('text2');
        $subject->addText('text3');

        $subject->removeField('text2');

        $buildedSubject = $subject->build();

        $this->assertEquals(2, sizeof($buildedSubject['sub_fields']));
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
        ], $buildedSubject['sub_fields']);
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

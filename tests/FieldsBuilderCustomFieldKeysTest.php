<?php

namespace StoutLogic\AcfBuilder\Tests;

use StoutLogic\AcfBuilder\FieldsBuilder;

class FieldsBuilderCustomFieldKeysTest extends \PHPUnit_Framework_TestCase
{


    public function testCustomKeys()
    {
        $builder = (new FieldsBuilder('banner'))
            ->addText('title')
            ->setCustomKey('field_234123412341234');

        $this->assertArraySubset([
            'name' => 'title',
            'key' => 'field_234123412341234'
        ], $builder->build());
    }

    public function testConditional()
    {
        $builder = (new FieldsBuilder('banner'));
        $builder
            ->addTrueFalse('enable')
            ->setCustomKey('234123412341234')
            ->addText('title')
            ->conditional('enable', '==', '1');

        $this->assertArraySubset([
            'fields' => [
                [
                    'key' => '234123412341234',
                ],
                [
                    'name' => 'title',
                    'conditional_logic' => [
                        [
                            [
                                'field' => '234123412341234',
                                'operator' => '==',
                                'value' => '1',

                            ],
                        ],
                    ],
                ],
            ]
        ], $builder->build());
    }

    public function testFlexibleContent()
    {
        $builder = new FieldsBuilder('page_content');
        $builder->addFlexibleContent('sections')
            ->addLayout('banner')
            ->addText('title')
            ->setCustomKey('my_custom_key')
            ->addWysiwyg('content')
            ->addLayout('content_columns')
            ->addRepeater('columns', ['min' => 1, 'max' => 2])
            ->addWysiwyg('content');

        $expectedConfig = [
            'fields' => [
                [
                    'key' => 'field_page_content_sections',
                    'name' => 'sections',
                    'label' => 'Sections',
                    'type' => 'flexible_content',
                    'button_label' => 'Add Section',
                    'layouts' => [
                        [
                            'key' => 'field_page_content_sections_banner',
                            'name' => 'banner',
                            'label' => 'Banner',
                            'display' => 'block',
                            'sub_fields' => [
                                [
                                    'key' => 'my_custom_key',
                                    'name' => 'title',
                                    'type' => 'text',
                                ],
                                [
                                    'key' => 'field_page_content_sections_banner_content',
                                    'name' => 'content',
                                    'type' => 'wysiwyg',
                                ]
                            ]
                        ],
                        [
                            'key' => 'field_page_content_sections_content_columns',
                            'name' => 'content_columns',
                            'label' => 'Content Columns',
                            'display' => 'block',
                            'sub_fields' => [
                                [
                                    'key' => 'field_page_content_sections_content_columns_columns',
                                    'name' => 'columns',
                                    'type' => 'repeater',
                                    'min' => 1,
                                    'max' => 2,
                                    'sub_fields' => [
                                        [
                                            'key' => 'field_page_content_sections_content_columns_columns_content',
                                            'name' => 'content',
                                            'type' => 'wysiwyg',
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];
        $this->assertArraySubset($expectedConfig, $builder->build());
    }

    public function testRepeaterCollapse()
    {
        $builder = (new FieldsBuilder('banner'));
        $builder
            ->addRepeater('slides', ['collapsed' => 'title'])
            ->addText('title')
            ->setCustomKey('custom_title_key')
            ->addWysiwyg('content');

        $this->assertArraySubset([
            'fields' => [
                [
                    'name' => 'slides',
                    'collapsed' => 'custom_title_key',
                    'sub_fields' => [
                        [
                            'name' => 'title',
                            'key' => 'custom_title_key',
                        ],
                        [
                            'name' => 'content',
                            'key' => 'field_banner_slides_content',
                        ]
                    ]
                ],
            ]
        ], $builder->build());
    }
}

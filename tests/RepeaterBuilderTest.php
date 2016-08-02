<?php

namespace StoutLogic\AcfBuilder\Tests;

use StoutLogic\AcfBuilder\RepeaterBuilder;
use StoutLogic\AcfBuilder\FieldsBuilder;

class RepeaterBuilderTest extends \PHPUnit_Framework_TestCase
{
    public function testBuildRepeater()
    {
        $builder = new RepeaterBuilder('slides');
        $builder->addText('title')
                ->addWysiwyg('content');

        $expectedConfig =  [
            'name' => 'slides',
            'type' => 'repeater',
            'button_label' => 'Add Slide',
            'sub_fields' => [
                [
                    'name' => 'title',
                ],
                [
                    'name' => 'content',
                ],
            ],
        ];
        $this->assertArraySubset($expectedConfig, $builder->build());
        $this->assertArrayNotHasKey('fields', $builder->build());
    }

    public function testEndRepeater()
    {
        $fieldsBuilder = $this->getMockBuilder('StoutLogic\AcfBuilder\FieldsBuilder')
                              ->setConstructorArgs(['parent'])
                              ->getMock();

        $repeaterBuilder = new RepeaterBuilder('slides');
        $repeaterBuilder->setParentContext($fieldsBuilder);

        $fieldsBuilder->expects($this->once())->method('addText');

        $repeaterBuilder->addText('title')
                ->addWysiwyg('content')
                ->endRepeater()
                ->addText('parent_title');
    }

    public function testSetLocation()
    {
        $fieldsBuilder = $this->getMockBuilder('StoutLogic\AcfBuilder\FieldsBuilder')
                              ->setConstructorArgs(['parent'])
                              ->getMock();

        $repeaterBuilder = new RepeaterBuilder('slides');
        $repeaterBuilder->setParentContext($fieldsBuilder);

        $fieldsBuilder->expects($this->once())->method('setLocation');

        $repeaterBuilder->addText('title')
                ->addWysiwyg('content')
                ->setLocation('post_type', '==', 'page');
    }

    public function testAddFields()
    {
        $banner = new FieldsBuilder('banner');
        $banner
            ->addText('title')
            ->addWysiwyg('content');

        $repeaterBuilder = new RepeaterBuilder('slides');
        $repeaterBuilder
            ->addFields($banner)
            ->addImage('thumbnail');

        $expectedConfig =  [
            'name' => 'slides',
            'type' => 'repeater',
            'sub_fields' => [
                [
                    'name' => 'title',
                ],
                [
                    'name' => 'content',
                ],
                [
                    'name' => 'thumbnail',
                ],
            ],
        ];
        $this->assertArraySubset($expectedConfig, $repeaterBuilder->build());

        $repeaterBuilder = new RepeaterBuilder('slides');
        $repeaterBuilder
            ->addFields([
                $banner->getField('title'),
                $banner->getField('content'),
            ])
            ->addImage('thumbnail');
        $this->assertArraySubset($expectedConfig, $repeaterBuilder->build());
    }

    public function testOverrideButton()
    {
        $builder = new RepeaterBuilder('slides', 'repeater', ['button_label' => 'Add New Slide']);
        $builder->addText('title')
                ->addWysiwyg('content');

        $expectedConfig =  [
            'name' => 'slides',
            'type' => 'repeater',
            'button_label' => 'Add New Slide',
            'sub_fields' => [
                [
                    'name' => 'title',
                ],
                [
                    'name' => 'content',
                ],
            ],
        ];

        $this->assertArraySubset($expectedConfig, $builder->build());
        $this->assertArrayNotHasKey('fields', $builder->build());
    }

    public function testCollapseSetting()
    {
        $builder = new RepeaterBuilder('slides', 'repeater', ['collapsed' => 'title']);
        $builder->addText('title')
            ->addWysiwyg('content');

        $expectedConfig =  [
            'name' => 'slides',
            'type' => 'repeater',
            'collapsed' => 'slides_title',
            'sub_fields' => [
                [
                    'key' => 'field_slides_title',
                    'name' => 'title',
                ],
                [
                    'name' => 'content',
                ],
            ],
        ];

        $this->assertArraySubset($expectedConfig, $builder->build());
    }
}

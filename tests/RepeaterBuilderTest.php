<?php

namespace StoutLogic\AcfBuilder\Tests;

use StoutLogic\AcfBuilder\RepeaterBuilder;

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
}

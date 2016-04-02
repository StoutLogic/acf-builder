<?php

namespace Understory\Fields\Tests;

use Understory\Fields\FieldsBuilder;

class FieldsBuilderTest extends \PHPUnit_Framework_TestCase
{
    public function testClassExists()
    {
        $this->assertTrue(class_exists('Understory\Fields\FieldsBuilder'));
    }

    public function testInstantiation()
    {
        $builder = new FieldsBuilder('fields');

        $this->assertTrue(is_a($builder, 'Understory\Fields\FieldsBuilder'));
    }

    public function testBuildReturnsArray()
    {
        $builder = new FieldsBuilder('fields');

        $this->assertInternalType('array', $builder->build());
    }

    public function testCreateGroup()
    {
        $builder = new FieldsBuilder('my_fields');

        $expectedConfig = [
            'key' => 'group_my_fields',
            'title' => 'My Fields',
        ];

        $this->assertArraySubset($expectedConfig, $builder->build());
    }

    public function testGroupConfig()
    {
        $builder = new FieldsBuilder('my_fields', ['style' => 'seamlees']);

        $expectedConfig = [
            'key' => 'group_my_fields',
            'title' => 'My Fields',
            'style' => 'seamlees',
        ];

        $this->assertArraySubset($expectedConfig, $builder->build());
    }

    public function testCreateLabel()
    {
        $builder = new FieldsBuilder('fields');
        $label = TestUtils::callMethod($builder, 'createLabel', ['my_field_name']);

        $this->assertEquals('My Field Name', $label);
    }

    public function testAddField()
    {
        $builder = new FieldsBuilder('fields');
        $builder->addField('name');
        $builder->addField('name_two');

        $expectedConfig = [
            'fields' => [
                [
                    'key' => 'name',
                    'name' => 'field_name',
                    'label' => 'Name',
                ],
                [
                    'key' => 'name_two',
                    'name' => 'field_name_two',
                    'label' => 'Name Two',
                ],
            ],            
        ];

        $this->assertArraySubset($expectedConfig, $builder->build());
    }

    public function testAddTextarea()
    {
        $builder = new FieldsBuilder('fields');
        $builder->addTextarea('name');

        $expectedConfig =  [
            'fields' => [
                [
                    'key' => 'name',
                    'type' => 'textarea',
                ],
            ],
        ];

        $this->assertArraySubset($expectedConfig, $builder->build());
    }

    public function testAddWysiwyg()
    {
        $builder = new FieldsBuilder('fields');
        $builder->addWysiwyg('name');

        $expectedConfig =  [
            'fields' => [
                [
                    'key' => 'name',
                    'type' => 'wysiwyg',
                ],
            ],
        ];

        $this->assertArraySubset($expectedConfig, $builder->build());
    }

}

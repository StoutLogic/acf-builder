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

    public function testChainableAddField()
    {
        $builder = new FieldsBuilder('fields');
        $builder->addField('name')
                ->addField('name_two');

        $expectedConfig = [
            'fields' => [
                [
                    'key' => 'field_name',
                    'name' => 'name',
                    'label' => 'Name',
                ],
                [
                    'key' => 'field_name_two',
                    'name' => 'name_two',
                    'label' => 'Name Two',
                ],
            ],            
        ];

        $this->assertArraySubset($expectedConfig, $builder->build());
    }    

    public function testAddText()
    {
        $builder = new FieldsBuilder('fields');
        $builder->addText('name');

        $expectedConfig =  [
            'fields' => [
                [
                    'name' => 'name',
                    'type' => 'text',
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
                    'name' => 'name',
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
                    'name' => 'name',
                    'type' => 'wysiwyg',
                ],
            ],
        ];

        $this->assertArraySubset($expectedConfig, $builder->build());
    }

    public function testAddNumber()
    {
        $builder = new FieldsBuilder('fields');
        $builder->addNumber('name', ['min' => '1']);

        $expectedConfig =  [
            'fields' => [
                [
                    'name' => 'name',
                    'type' => 'number',
                    'min' => '1',
                ],
            ],
        ];

        $this->assertArraySubset($expectedConfig, $builder->build());
    }

    public function testAddEmail()
    {
        $builder = new FieldsBuilder('fields');
        $builder->addEmail('email');

        $expectedConfig =  [
            'fields' => [
                [
                    'name' => 'email',
                    'type' => 'email',
                ],
            ],
        ];

        $this->assertArraySubset($expectedConfig, $builder->build());
    }    

    public function testAddUrl()
    {
        $builder = new FieldsBuilder('fields');
        $builder->addUrl('location');

        $expectedConfig =  [
            'fields' => [
                [
                    'name' => 'location',
                    'type' => 'url',
                ],
            ],
        ];

        $this->assertArraySubset($expectedConfig, $builder->build());
    }

    public function testAddPassword()
    {
        $builder = new FieldsBuilder('fields');
        $builder->addPassword('password');

        $expectedConfig =  [
            'fields' => [
                [
                    'name' => 'password',
                    'type' => 'password',
                ],
            ],
        ];

        $this->assertArraySubset($expectedConfig, $builder->build());
    }
}

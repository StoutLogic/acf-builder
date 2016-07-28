<?php

namespace StoutLogic\AcfBuilder\Tests;

use StoutLogic\AcfBuilder\FieldBuilder;

class FieldBuilderTest extends \PHPUnit_Framework_TestCase
{
    public function testClassExists()
    {
        $this->assertTrue(class_exists('StoutLogic\AcfBuilder\FieldBuilder'));
    }

    public function testGetName()
    {
        $subject = new FieldBuilder('my_field', 'text');
        $this->assertSame('my_field', $subject->getName());
    }

    public function testBuild()
    {
        $subject = new FieldBuilder('my_field', 'text', ['prepend' => '$']);
        $this->assertArraySubset([
            'key' => 'field_my_field',
            'name' => 'my_field',
            'label' => 'My Field',
            'type' => 'text',
            'prepend' => '$',
        ], $subject->build());
    }

    public function testSetKey()
    {
        $subject = new FieldBuilder('my_field', 'text', ['prepend' => '$']);
        $this->assertSame($subject, $subject->setKey('field_new_key'));
        $this->assertArraySubset([
            'key' => 'field_new_key',
            'name' => 'my_field',
            'label' => 'My Field',
            'type' => 'text',
            'prepend' => '$',
        ], $subject->build());
    }

    public function testSetKeyWithOutFieldPrepended()
    {
        $subject = new FieldBuilder('my_field', 'text', ['prepend' => '$']);
        $this->assertSame($subject, $subject->setKey('new_key'));
        $this->assertArraySubset([
            'key' => 'field_new_key',
            'name' => 'my_field',
            'label' => 'My Field',
            'type' => 'text',
            'prepend' => '$',
        ], $subject->build());
    }

    public function testSetConfig()
    {
        $subject = new FieldBuilder('my_field', 'text', ['prepend' => '$']);
        $this->assertSame($subject, $subject->setConfig('prepend', '@'));
        $this->assertArraySubset([
            'key' => 'field_my_field',
            'name' => 'my_field',
            'label' => 'My Field',
            'type' => 'text',
            'prepend' => '@',
        ], $subject->build());
    }

    public function testUpdateConfig()
    {
        $subject = new FieldBuilder('my_field', 'text', ['prepend' => '$']);
        $this->assertSame($subject, $subject->updateConfig([
            'prepend' => '@',
            'label' => 'My New Label',
        ]));
        $this->assertArraySubset([
            'key' => 'field_my_field',
            'name' => 'my_field',
            'label' => 'My New Label',
            'type' => 'text',
            'prepend' => '@',
        ], $subject->build());
    }

    public function testSetRequired()
    {
        $subject = new FieldBuilder('my_field', 'text', ['prepend' => '$']);
        $this->assertSame($subject, $subject->setRequired());
        $this->assertArraySubset([
            'key' => 'field_my_field',
            'name' => 'my_field',
            'label' => 'My Field',
            'type' => 'text',
            'prepend' => '$',
            'required' => 1,
        ], $subject->build());

        $this->assertSame($subject, $subject->setUnrequired());
        $this->assertArraySubset([
            'key' => 'field_my_field',
            'name' => 'my_field',
            'label' => 'My Field',
            'type' => 'text',
            'prepend' => '$',
            'required' => 0,
        ], $subject->build());

        $this->assertSame($subject, $subject->setRequired());
        $this->assertArraySubset([
            'key' => 'field_my_field',
            'name' => 'my_field',
            'label' => 'My Field',
            'type' => 'text',
            'prepend' => '$',
            'required' => 1,
        ], $subject->build());
    }

    public function testSetInstructions()
    {
        $subject = new FieldBuilder('my_field', 'text', ['prepend' => '$']);
        $this->assertSame($subject, $subject->setInstructions('My Instructions'));
        $this->assertArraySubset([
            'key' => 'field_my_field',
            'name' => 'my_field',
            'label' => 'My Field',
            'type' => 'text',
            'prepend' => '$',
            'instructions' => 'My Instructions',
        ], $subject->build());
    }

    public function testSetDefaultValue()
    {
        $subject = new FieldBuilder('my_field', 'text', ['prepend' => '$']);
        $this->assertSame($subject, $subject->setDefaultValue('My Default'));
        $this->assertArraySubset([
                'key' => 'field_my_field',
                'name' => 'my_field',
                'label' => 'My Field',
                'type' => 'text',
                'prepend' => '$',
                'default_value' => 'My Default',
            ], $subject->build());
    }

    public function testConditional()
    {
        $subject = new FieldBuilder('my_field', 'text', ['prepend' => '$']);
        $this->assertNotSame($subject, $subject->conditional('other_field', '==', '1'));

        $this->assertArraySubset([
                'key' => 'field_my_field',
                'name' => 'my_field',
                'label' => 'My Field',
                'type' => 'text',
                'prepend' => '$',
                'conditional_logic' => [
                    [
                        [
                            'field' => 'other_field',
                            'operator'  =>  '==',
                            'value' => '1',
                        ],
                    ]
                ],
            ], $subject->build());
    }
}

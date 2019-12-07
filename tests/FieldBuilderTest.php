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

    public function testSetLabel()
    {
        $subject = new FieldBuilder('my_field', 'text', ['prepend' => '$']);
        $this->assertSame($subject, $subject->setLabel('My Label'));
        $this->assertArraySubset([
            'key' => 'field_my_field',
            'name' => 'my_field',
            'label' => 'My Label',
            'type' => 'text',
            'prepend' => '$',
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

    public function testGetWrapper()
    {
        $wrapper = [
            'class' => 'foo',
            'id'    => 'bar',
        ];
        $subject = new FieldBuilder('my_field', 'text', ['wrapper' => $wrapper]);
        $this->assertSame($subject, $subject->setConfig('prepend', '@'));
        $this->assertArraySubset($wrapper, $subject->getWrapper());
    }

    public function testSetWrapper()
    {
        $subject = new FieldBuilder('my_field', 'text');
        $this->assertSame($subject, $subject->setWrapper(['class' => 'foo', 'id' => 'bar']));
        $this->assertArraySubset([
            'key'     => 'field_my_field',
            'name'    => 'my_field',
            'label'   => 'My Field',
            'type'    => 'text',
            'wrapper' => [
                'class' => 'foo',
                'id'    => 'bar',
            ],
        ], $subject->build());
    }

    public function testSetWidth()
    {
        $subject = new FieldBuilder('my_field', 'text');
        $this->assertSame($subject, $subject->setWidth('50%'));
        $this->assertArraySubset([
            'key'     => 'field_my_field',
            'name'    => 'my_field',
            'label'   => 'My Field',
            'type'    => 'text',
            'wrapper' => [
                'width' => '50%',
            ],
        ], $subject->build());
    }

    public function testSetAttr()
    {
        $subject = new FieldBuilder('my_field', 'text');
        $this->assertSame($subject, $subject->setAttr('data-my_attr', 'My Attr'));
        $this->assertArraySubset([
            'key'     => 'field_my_field',
            'name'    => 'my_field',
            'label'   => 'My Field',
            'type'    => 'text',
            'wrapper' => [
                'data-my_attr' => 'My Attr',
            ],
        ], $subject->build());
    }

    public function testSetSelector()
    {
        $subject = new FieldBuilder('my_field', 'text');
        // returns FieldBuilder.
        $this->assertSame($subject, $subject->setSelector('.my-class'));

        // only id.
        $subject->setSelector('#my-id');
        $this->assertArraySubset([
            'id' => 'my-id',
        ], $subject->getWrapper());

        // only class.
        $subject->setSelector('.my-class');
        $this->assertArraySubset([
            'class' => 'my-class',
        ], $subject->getWrapper());

        // only class multiple.
        $subject->setSelector('.class1.class2');
        $this->assertArraySubset([
            'class' => 'class1 class2',
        ], $subject->getWrapper());

        // id / class.
        $subject->setSelector('#my-id.my-class');
        $this->assertArraySubset([
            'id'    => 'my-id',
            'class' => 'my-class',
        ], $subject->getWrapper());

        // id / class multiple.
        $subject->setSelector('#my-id.my-class.more-class');
        $this->assertArraySubset([
            'id'    => 'my-id',
            'class' => 'my-class more-class',
        ], $subject->getWrapper());

        // class /id.
        $subject->setSelector('.my-class#my-id');
        $this->assertArraySubset([
            'id'    => 'my-id',
            'class' => 'my-class',
        ], $subject->getWrapper());

        // class multiple /id.
        $subject->setSelector('.my-class.more-class#my-id');
        $this->assertArraySubset([
            'id'    => 'my-id',
            'class' => 'my-class more-class',
        ], $subject->getWrapper());
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

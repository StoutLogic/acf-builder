<?php

namespace StoutLogic\AcfBuilder\Tests\Transform;

use StoutLogic\AcfBuilder\FieldsBuilder;
use StoutLogic\AcfBuilder\ConditionalBuilder;
use StoutLogic\AcfBuilder\Transform;

class NamespaceFieldKeyTest extends \PHPUnit_Framework_TestCase
{
    public function testIsRecursive()
    {
        $builder = $this->prophesize('\StoutLogic\AcfBuilder\FieldsBuilder');
        $transform = new Transform\NamespaceFieldKey($builder->reveal());
        $this->assertInstanceOf('\StoutLogic\AcfBuilder\Transform\RecursiveTransform', $transform);
    }

    public function testGetKeys()
    {
        $builder = $this->prophesize('\StoutLogic\AcfBuilder\FieldsBuilder');
        $transform = new Transform\NamespaceFieldKey($builder->reveal());
        $this->assertSame(['key', 'field', 'collapsed'], $transform->getKeys());
    }

    public function testTransformValue()
    {
        $builder = $this->prophesize('\StoutLogic\AcfBuilder\FieldsBuilder');
        $builder
            ->getName()
            ->willReturn('Fields Builder Name');

        $transform = new Transform\NamespaceFieldKey($builder->reveal());
        $this->assertSame('field_fields_builder_name_value', $transform->transformValue('field_value'));
        $this->assertSame('field_fields_builder_name_value', $transform->transformValue('group_value'));
    }
}

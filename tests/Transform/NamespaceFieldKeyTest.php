<?php

namespace StoutLogic\AcfBuilder\Tests\Transform;

use StoutLogic\AcfBuilder\FieldsBuilder;
use StoutLogic\AcfBuilder\ConditionalBuilder;
use StoutLogic\AcfBuilder\Transform;
use PHPUnit\Framework\TestCase;

class NamespaceFieldKeyTest extends TestCase
{
    public function testIsRecursive()
    {
        $builder = $this->prophesize(FieldsBuilder::class);
        $transform = new Transform\NamespaceFieldKey($builder->reveal());
        $this->assertInstanceOf(Transform\RecursiveTransform::class, $transform);
    }

    public function testGetKeys()
    {
        $builder = $this->prophesize(FieldsBuilder::class);
        $transform = new Transform\NamespaceFieldKey($builder->reveal());
        $this->assertSame(['key', 'field'], $transform->getKeys());
    }

    public function testTransformValue()
    {
        $builder = $this->prophesize(FieldsBuilder::class);
        $builder
            ->getName()
            ->willReturn('Fields Builder Name');

        $transform = new Transform\NamespaceFieldKey($builder->reveal());
        $this->assertSame('field_fields_builder_name_value', $transform->transformValue('field_value'));
        $this->assertSame('field_fields_builder_name_value', $transform->transformValue('group_value'));
    }
}

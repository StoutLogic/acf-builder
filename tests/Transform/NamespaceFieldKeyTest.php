<?php

namespace StoutLogic\AcfBuilder\Tests\Transform;

use PHPUnit\Framework\TestCase;
use StoutLogic\AcfBuilder\Transform;
use Prophecy\PhpUnit\ProphecyTrait;

class NamespaceFieldKeyTest extends TestCase
{
    use ProphecyTrait;

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



    public function testShouldTransformValue()
    {
        $builder = $this->prophesize('\StoutLogic\AcfBuilder\FieldsBuilder');
        $builder
            ->getName()
            ->willReturn('Fields Builder Name');

        $transform = new Transform\NamespaceFieldKey($builder->reveal());

        $this->assertTrue($transform->shouldTransformValue('key', [
            'key' => 'field_name',
        ]));

        $this->assertFalse($transform->shouldTransformValue('key', [
            'key' => '1234859849584545',
            '_has_custom_key' => true,
        ]));

        $this->assertTrue($transform->shouldTransformValue('key', [
            'key' => 'field_name',
            '_has_custom_key' => false,
        ]));
    }
}

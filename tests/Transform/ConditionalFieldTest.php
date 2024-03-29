<?php

namespace StoutLogic\AcfBuilder\Tests\Transform;

use PHPUnit\Framework\TestCase;
use StoutLogic\AcfBuilder\Transform;
use Prophecy\PhpUnit\ProphecyTrait;

class ConditionalFieldTest extends TestCase
{
    use ProphecyTrait;

    public function testIsRecursive()
    {
        $builder = $this->prophesize('\StoutLogic\AcfBuilder\FieldsBuilder');
        $transform = new Transform\ConditionalField($builder->reveal());
        $this->assertInstanceOf('\StoutLogic\AcfBuilder\Transform\RecursiveTransform', $transform);
    }

    public function testGetKeys()
    {
        $builder = $this->prophesize('\StoutLogic\AcfBuilder\FieldsBuilder');
        $transform = new Transform\ConditionalField($builder->reveal());
        $this->assertSame(['field'], $transform->getKeys());
    }

    public function testTransformValue()
    {
        $field = $this->prophesize('\StoutLogic\AcfBuilder\FieldBuilder');
        $field
            ->getKey()
            ->willReturn('field_key');

        $builder = $this->prophesize('\StoutLogic\AcfBuilder\FieldsBuilder');
        $builder
            ->getField('value')
            ->willReturn($field->reveal());

        $builder
            ->fieldExists('value')
            ->willReturn(true);

        $transform = new Transform\ConditionalField($builder->reveal());
        $this->assertSame('field_key', $transform->transformValue('value'));
    }
}
